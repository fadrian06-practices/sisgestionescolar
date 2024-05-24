<?php

require __DIR__ . '/../../app/config.php';

header('content-type: text/plain');

$name = mb_convert_case(strip_tags($_POST['name'] ?? ''), MB_CASE_TITLE);

if (!$name) {
  $_SESSION['messages.error'] = 'El nombre del rol es requerido';

  return header('location: ./');
}

$query = 'INSERT INTO roles (nombre, fechaRegistro) VALUES (?, ?)';
$stmt = $pdo->prepare($query);

try {
  $stmt->execute([$name, $currentDatetime]);
  $_SESSION['messages.success'] = 'Rol añadido exitósamente';
  unset($_SESSION['role.name']);
} catch (PDOException) {
  $_SESSION['messages.error'] = "El rol $name ya existe";
  $_SESSION['role.name'] = $name;
}

header('location: ./');
