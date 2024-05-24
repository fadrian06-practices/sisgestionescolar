<?php

require __DIR__ . '/../../app/config.php';

$roleId = $_POST['id'] ?? '';

if (!strlen($roleId)) {
  $_SESSION['messages.error'] = 'El ID del rol es requerido';

  return header('location: ./');
}

$stmt = $pdo->prepare('UPDATE roles SET activo = TRUE WHERE id = ?');
$stmt->execute([$roleId]);

$_SESSION['messages.success'] = 'Rol activado exitósamente';
header('location: ./');
