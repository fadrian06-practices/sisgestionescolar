<?php require __DIR__ . '/../app/config.php' ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title><?= APP_NAME ?> | Ingreso</title>
  <base href="<?= APP_URL ?>/" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
  />
  <link
    rel="stylesheet"
    href="./public/plugins/fontawesome-free/css/all.min.css"
  />
  <link
    rel="stylesheet"
    href="./public/dist/css/adminlte.min.css"
  />
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <div class="embed-responsive embed-responsive-1by1 w-50 m-auto">
        <img
          class="embed-responsive-item"
          src="./public/images/20944201.png"
        />
      </div>
      <h1 class="h3 font-weight-bold"><?= APP_NAME ?></h1>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">
          Ingresa tus credenciales para iniciar sesión
        </p>
        <form action="./ingreso/controller.php" method="post">
          <div class="input-group mb-3">
            <input
              type="email"
              name="email"
              required
              class="form-control"
              placeholder="Correo"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input
              type="password"
              name="password"
              required
              class="form-control"
              placeholder="Contraseña"
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block">Ingresar</button>
        </form>
      </div>
    </div>
  </div>

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@4/bootstrap-4/bootstrap-4.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
  <script>
    const toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true
    })
  </script>
  <?php include __DIR__ . '/../layouts/messages.php' ?>
</body>

</html>
