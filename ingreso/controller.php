<?php

require __DIR__ . '/../app/config.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
  $_SESSION['messages.error'] = 'El correo y la contraseña son requeridos';

  return header('location: ./');
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['messages.error'] = 'El correo es inválido';

  return header('location: ./');
}

$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE correo = ?');
$stmt->execute([$email]);
$userFound = $stmt->fetchObject();

if (!$userFound || !password_verify($password, $userFound->clave)) {
  $_SESSION['messages.error'] = 'Usuario o contraseña incorrecta';

  return header('location: ./');
} elseif (!$userFound->activo) {
  $_SESSION['messages.error'] = 'Este usuario se encuentra desactivado';

  return header('location: ./');
}

$role = $pdo
  ->query("SELECT * FROM roles WHERE id = {$userFound->idRol}")
  ->fetchObject();

$userFound->rol = $role;

if (!$userFound->rol->activo) {
  $_SESSION['messages.error'] = 'El rol del usuario se encuentra desactivado';

  return header('location: ./');
}

$_SESSION['user.id'] = $userFound->id;
$_SESSION['messages.success'] = 'Bienvenido al sistema';
header('location: ../admin');
