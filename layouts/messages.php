<?php

require_once __DIR__ . '/../app/config.php';

$error = $_SESSION['messages.error'] ?? '';
$success = $_SESSION['messages.success'] ?? '';

unset($_SESSION['messages.error']);
unset($_SESSION['messages.success']);

?>

<script>
  <?php if ($error) : ?>
    toast.fire({
      title: `<?= $error ?>`,
      icon: 'error'
    })
  <?php elseif ($success) : ?>
    toast.fire({
      title: `<?= $success ?>`,
      icon: 'success'
    })
  <?php endif ?>
</script>
