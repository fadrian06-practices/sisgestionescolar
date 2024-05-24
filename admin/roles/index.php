<?php

require_once __DIR__ . '/../../app/config.php';
include __DIR__ . '/../layouts/header.php';

$roles = $pdo
  ->query('SELECT * FROM roles')
  ->fetchAll(PDO::FETCH_CLASS);

$counter = 1;

?>

<link
  rel="stylesheet"
  href="./public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
/>
<link
  rel="stylesheet"
  href="./public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
/>
<link
  rel="stylesheet"
  href="./public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
/>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Listado de roles</h1>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <div class="dropdown">
                <button
                  class="btn btn-success dropdown-toggle"
                  data-toggle="dropdown">
                  <i class="fas fa-plus mr-2"></i>
                  Añadir rol
                </button>
                <div class="dropdown-menu">
                  <form
                    method="post"
                    action="./admin/roles/new.php"
                    class="container"
                    novalidate>
                    <label class="form-group">
                      <span>Nombre del rol</span>
                      <input
                        name="name"
                        class="form-control"
                        required
                        value="<?= $_SESSION['role.name'] ?? '' ?>"
                      />
                    </label>
                    <button class="btn btn-success btn-block">Añadir</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table id="roles" class="table table-hover table-striped table-sm">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($roles as $rol) : ?>
                    <tr>
                      <td class="align-middle"><?= $counter++ ?></td>
                      <td class="align-middle"><?= $rol->nombre ?></td>
                      <td class="align-middle">
                        <?php if ($rol->activo) : ?>
                          <span class="badge badge-success">Activo</span>
                        <?php else : ?>
                          <span class="badge badge-secondary">Inactivo</span>
                        <?php endif ?>
                      </td>
                      <td class="align-middle">
                        <div class="btn-group btn-group-sm w-100">
                          <a
                            data-toggle="tooltip"
                            title="Ver más"
                            href="#"
                            class="btn btn-secondary">
                            <i class="fas fa-info-circle mr-2"></i>
                          </a>
                          <a
                            data-toggle="tooltip"
                            title="Editar"
                            href="#"
                            class="btn btn-outline-dark">
                            <i class="fas fa-pencil-alt mr-2"></i>
                          </a>
                          <?php if ($rol->activo) : ?>
                            <a
                              data-toggle="tooltip"
                              title="Desactivar"
                              href="#"
                              class="btn btn-danger">
                              <i class="fas fa-lock mr-2"></i>
                            </a>
                          <?php else : ?>
                            <a
                              data-toggle="tooltip"
                              title="Activar"
                              href="#"
                              class="btn btn-success">
                              <i class="fas fa-lock-open mr-2"></i>
                              Activar
                            </a>
                          <?php endif ?>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="./public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./public/plugins/jszip/jszip.min.js"></script>
<script src="./public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="./public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="./public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $('#roles').DataTable({
    paging: false,
    lengthChange: false,
    searching: false,
    ordering: true,
    info: false,
    autoWidth: false,
    responsive: true,
  })

  <?php if (!empty($_SESSION['messages.error'])) : ?>
    $('.dropdown-toggle').dropdown('show')
  <?php endif ?>
</script>

<?php include __DIR__ . '/../layouts/footer.php' ?>
