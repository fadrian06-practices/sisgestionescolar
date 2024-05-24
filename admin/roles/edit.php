<?php

require __DIR__ . '/../../app/config.php';

$roleId = $_POST['id'] ?? '';
$roleName = mb_convert_case(strip_tags($_POST['name'] ?? ''), MB_CASE_TITLE);

if (!strlen($roleId)) {
  $_SESSION['messages.error'] = 'El ID del rol es requerido';

  return header('location: ./');
} elseif (!$roleName) {
  $_SESSION['messages.error'] = 'El nombre del rol es requerido';

  return header('location: ./');
}

$query = '
  UPDATE roles
  SET nombre = :newName, fechaActualizacion = :updateDateTime
  WHERE id = :id
';

$stmt = $pdo->prepare($query);

try {
  $stmt->execute([
    ':newName' => $roleName,
    ':updateDateTime' => $currentDatetime,
    ':id' => $roleId
  ]);

  $_SESSION['messages.success'] = 'Rol actualizado exitósamente';
} catch (PDOException) {
  $_SESSION['messages.error'] = "Rol $roleName ya existe";
}

header('location: ./');
