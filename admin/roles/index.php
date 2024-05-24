<?php

require_once __DIR__ . '/../../app/config.php';
include __DIR__ . '/../layouts/header.php';

$roles = $pdo
  ->query('SELECT * FROM roles ORDER BY nombre')
  ->fetchAll(PDO::FETCH_CLASS);

$pdo->beginTransaction();

foreach ($roles as $role) {
  try {
    $pdo->query("DELETE FROM roles WHERE id = {$role->id}");
    $role->canBeDeleted = true;
  } catch (PDOException) {
    $role->canBeDeleted = false;
  }
}

$pdo->rollBack();

$error = $_SESSION['messages.error'] ?? '';
$roleName = $_SESSION['role.name'] ?? '';

?>

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
                  id="newRoleToggler"
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
                        value="<?= $roleName ?>"
                      />
                    </label>
                    <button class="btn btn-success btn-block">Añadir</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <table class="table text-center table-sm">
                <thead class="text-left">
                  <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($roles as $role) : ?>
                    <tr>
                      <td class="align-middle">
                        <form
                          action="./admin/roles/edit.php"
                          method="post"
                          novalidate
                          id="editForm-<?= $role->id ?>"
                          class="input-group input-group-sm d-none">
                          <input
                            type="hidden"
                            name="id"
                            required
                            value="<?= $role->id ?>"
                          />
                          <input
                            class="form-control"
                            placeholder="Nombre del rol"
                            name="name"
                            value="<?= $role->nombre ?>"
                            required
                          />
                          <div class="input-group-append">
                            <button class="btn btn-outline-success">
                              <i class="fas fa-save mr-2"></i>
                              Actualizar
                            </button>
                            <button
                              type="button"
                              class="btn btn-outline-secondary"
                              data-action="cancelEdit"
                              data-parent="#editForm-<?= $role->id ?>"
                              data-target="#roleName-<?= $role->id ?>">
                              <i class="fas fa-ban mr-2"></i>
                              Cancelar
                            </button>
                          </div>
                        </form>
                        <div
                          id="roleName-<?= $role->id ?>"
                          class="input-group input-group-sm">
                          <input
                            class="form-control"
                            value="<?= $role->nombre ?>"
                            disabled
                            readonly
                          />
                          <div class="input-group-append">
                            <button
                              class="btn btn-outline-success"
                              data-action="toggleEdit"
                              data-target="#editForm-<?= $role->id ?>"
                              data-parent="#roleName-<?= $role->id ?>">
                              <i class="fas fa-pencil-alt mr-2"></i>
                              Editar
                            </button>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <?php if ($role->activo) : ?>
                          <span class="badge badge-success w-75">
                            Activo
                          </span>
                        <?php else : ?>
                          <span class="badge badge-secondary w-75">
                            Inactivo
                          </span>
                        <?php endif ?>
                      </td>
                      <td class="align-middle">
                        <form
                          method="post"
                          class="btn-group btn-group-sm rounded-lg overflow-hidden w-100">
                          <input
                            type="hidden"
                            name="id"
                            required
                            value="<?= $role->id ?>"
                          />
                          <?php if ($role->activo) : ?>
                            <button
                              formaction="./admin/roles/disactivate.php"
                              <?= $userLogged->rol == $role ? 'disabled' : '' ?>
                              class="w-50 btn btn-secondary d-flex align-items-center justify-content-between">
                              <i class="fas fa-lock" style="width: 20px"></i>
                              <span class="flex-fill">Desactivar</span>
                            </button>
                          <?php else : ?>
                            <button
                              formaction="./admin/roles/activate.php"
                              class="w-50 btn btn-success d-flex align-items-center justify-content-between">
                              <i class="fas fa-lock-open" style="width: 20px"></i>
                              <span class="flex-fill">Activar</span>
                            </button>
                          <?php endif ?>
                          <button
                            data-action="delete"
                            formaction="./admin/roles/delete.php"
                            <?= $userLogged->rol == $role || !$role->canBeDeleted ? 'disabled' : '' ?>
                            class="btn btn-danger">
                            <i class="fas fa-trash mr-2"></i>
                            Eliminar
                          </button>
                        </form>
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

<script>
  <?php if (!empty($error) && !empty($roleName)) : ?>
    $('#newRoleToggler').dropdown('show')
  <?php endif ?>

  document.querySelectorAll('[data-action="toggleEdit"]').forEach($button => {
    $button.addEventListener('click', () => {
      $parent = document.querySelector($button.dataset.parent)
      $target = document.querySelector($button.dataset.target)

      $parent.classList.add('d-none')
      $target.classList.remove('d-none')
    })
  })

  document.querySelectorAll('[data-action="cancelEdit"]').forEach($button => {
    $button.addEventListener('click', () => {
      $parent = document.querySelector($button.dataset.parent)
      $target = document.querySelector($button.dataset.target)

      $parent.classList.add('d-none')
      $target.classList.remove('d-none')
    })
  })

  document.querySelectorAll('[data-action="delete"]').forEach($button => {
    $button.form.addEventListener('submit', async event => {
      event.preventDefault()

      if ($button.disabled) {
        toast.fire({
          title: 'No puedes desactivar este rol',
          icon: 'error',
        })
      }

      const result = await Swal.fire({
        title: '¿Estás seguro que deseas eliminar este rol?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonText: 'Sí',
        showLoaderOnConfirm: true,
        async preConfirm() {
          const response = await fetch($button.getAttribute('formaction'), {
            method: 'post',
            body: new FormData($button.form)
          })

          if (!response.ok) {
            return {
              icon: 'error',
              title: await response.text()
            }
          }

          return {
            icon: 'success',
            title: await response.text()
          }
        }
      })

      if (result.isConfirmed) {
        if (result.value.icon === 'success') {
          $button.closest('tr').remove()
        }

        setTimeout(() => toast.fire({
          title: result.value.title,
          icon: result.value.icon
        }), 400)
      }
    })
  })
</script>

<?php include __DIR__ . '/../layouts/footer.php' ?>
