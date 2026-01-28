<?php
require_once 'Templates/header.php';
use Middleware\IsAdmin;

if (!IsAdmin::handle()) {
    header('Location: index.php');
    exit();
}


?>

<h1 class="h1">Admin Panel</h1>
<hr>

<a href="admin_users.php" class="btn btn-primary">Users</a>

<?php require_once 'Templates/footer.php'; ?>

