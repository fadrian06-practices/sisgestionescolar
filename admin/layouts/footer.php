<?php require_once __DIR__ . '/../../app/config.php' ?>

<aside class="control-sidebar control-sidebar-dark">
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<footer class="main-footer">
  <div class="float-right d-none d-sm-inline">
    <strong>Versión</strong>
    1.0
  </div>
  <strong>
    Copyright &copy; <?= $currentYear ?>
    <a href="https://faslatam.000.pe">FasLatam.000.pe</a>.
  </strong>
  Todos los derechos reservados.
</footer>
</div>
<script src="./public/dist/js/adminlte.min.js"></script>
<?php include __DIR__ . '/../../layouts/messages.php' ?>
<script>
  $('[data-toggle="tooltip"]').tooltip()
</script>
</body>

</html>
