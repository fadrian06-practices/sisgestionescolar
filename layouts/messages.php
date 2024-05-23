<?php

require_once __DIR__ . '/../app/config.php';

$error = $_SESSION['messages.error'] ?? '';
$success = $_SESSION['messages.success'] ?? '';

unset($_SESSION['messages.error']);
unset($_SESSION['messages.success']);

if (!empty($error) || !empty($success)) {
  echo <<<html
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@sweetalert2/themes@4/bootstrap-4/bootstrap-4.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
  html;
}

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
