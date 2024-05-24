<?php

require __DIR__ . '/../../app/config.php';

$roleId = $_POST['id'] ?? '';
header('content-type: text/plain');

if (!strlen($roleId)) {
  http_response_code(400);

  return print 'El ID del rol es requerido';
}

$stmt = $pdo->prepare('DELETE FROM roles WHERE id = ?');

try {
  $stmt->execute([$roleId]);
} catch (PDOException) {
  http_response_code(409);

  return print 'No puedes desactivar este rol porque tiene usuarios asignados';
}

print 'Rol eliminado exitósamente';
