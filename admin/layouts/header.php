<?php

require_once __DIR__ . '/../../app/config.php';

if (!isset($_SESSION['user.id'])) {
  return header('location: ../ingreso');
}

$query = 'SELECT * FROM usuarios WHERE id = ?';
$stmt = $pdo->prepare($query);
$stmt->execute([$_SESSION['user.id']]);
$userLogged = $stmt->fetchObject();

$role = $pdo
  ->query("SELECT * FROM roles WHERE id = {$userLogged->idRol}")
  ->fetchObject();

$userLogged->rol = $role;

function addActiveMark(string $href): string {
  if (str_starts_with($href, '.')) {
    $href = substr($href, 1);
  }

  if (!str_ends_with($href, '/')) {
    $href .= '/';
  }

  return str_ends_with($_SERVER['REQUEST_URI'], $href) ? 'active' : '';
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title><?= APP_NAME ?></title>
  <base href="<?= APP_URL ?>/" />
  <link
    rel="icon"
    href="https://cdn-icons-png.flaticon.com/512/5526/5526487.png"
  />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
  />
  <link
    rel="stylesheet"
    href="./public/plugins/fontawesome-free/css/all.min.css"
  />
  <link rel="stylesheet" href="./public/dist/css/adminlte.min.css" />
  <script src="./public/plugins/jquery/jquery.min.js"></script>
  <script src="./public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a
            class="nav-link"
            data-widget="pushmenu"
            href="#">
            <i class="fas fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="./admin" class="nav-link"><?= APP_NAME ?></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li
          class="nav-item dropdown"
          data-toggle="tooltip"
          title="Notificaciones">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item d-flex align-items-center">
              <i class="fas fa-envelope text-center" style="width: 30px"></i>
              <span class="flex-fill">4 new messages</span>
              <span class="text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item d-flex align-items-center">
              <i class="fas fa-users text-center" style="width: 30px"></i>
              <span class="flex-fill">8 friend requests</span>
              <span class="text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item d-flex align-items-center">
              <i class="fas fa-file text-center" style="width: 30px"></i>
              <span class="flex-fill">3 new reports</span>
              <span class="text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">
              See All Notifications
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a
            class="nav-link"
            data-widget="control-sidebar"
            data-slide="true"
            href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" title="Cerrar sesión">
          <a
            class="nav-link"
            href="./salir.php">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="./admin" class="brand-link d-flex align-items-center">
        <img
          src="https://cdn-icons-png.flaticon.com/512/5526/5526487.png"
          class="brand-image img-circle elevation-3"
        />
        <span class="brand-text font-weight-light text-wrap">
          <?= APP_NAME ?>
        </span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
          <div class="image">
            <img
              src="https://cdn-icons-png.flaticon.com/512/6073/6073873.png"
              class="img-circle elevation-2"
            />
          </div>
          <div class="info">
            <a href="#" class="text-wrap"><?= $userLogged->nombreCompleto ?></a>
          </div>
        </div>
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            data-accordion="false">
            <li class="nav-item">
              <a
                href="./admin/roles"
                class="nav-link <?= addActiveMark('./admin/roles') ?>">
                <i class="nav-icon fas fa-sitemap"></i>
                Roles
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
