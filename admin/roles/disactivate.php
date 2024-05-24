<?php

require __DIR__ . '/../../app/config.php';

$roleId = $_POST['id'] ?? '';

if (!strlen($roleId)) {
  $_SESSION['messages.error'] = 'El ID del rol es requerido';

  return header('location: ./');
}

$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
$stmt->execute([$_SESSION['user.id']]);
$userLogged = $stmt->fetchObject();

if ($userLogged->idRol == $roleId) {
  $_SESSION['messages.error'] = 'No se puede desactivar el rol que tienes asignado';

  return header('location: ./');
}

$stmt = $pdo->prepare('UPDATE roles SET activo = FALSE WHERE id = ?');
$stmt->execute([$roleId]);

$_SESSION['messages.success'] = 'Rol desactivado exitósamente';
header('location: ./');
