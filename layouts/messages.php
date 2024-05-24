<?php

require_once __DIR__ . '/../app/config.php';

$error = $_SESSION['messages.error'] ?? '';
$success = $_SESSION['messages.success'] ?? '';

unset($_SESSION['messages.error']);
unset($_SESSION['messages.success']);

?>

<script>
  <?php if ($error) : ?>
    Swal.fire({
      title: `<?= $error ?>`,
      icon: 'error',
      toast: true,
      position: 'top-end',
      timerProgressBar: true,
      timer: 5000,
      showConfirmButton: false
    })
  <?php elseif ($success) : ?>
    Swal.fire({
      title: `<?= $success ?>`,
      icon: 'success',
      toast: true,
      position: 'top-end',
      timerProgressBar: true,
      timer: 5000,
      showConfirmButton: false
    })
  <?php endif ?>
</script>
