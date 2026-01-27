<?php

require_once 'Templates/header.php';

use Controller\UserController;


$id = $_GET["id"];

if (!$id) {
    header('Location: admin_users.php');
    exit();
}

$user = UserController::show($id);
if(!$user) {
    header('Location: admin_users.php');
    exit();
}

$errors = [];

if (isset($_POST['update'])) {
    $result = UserController::update($id,$_POST);
    if ($result === true) {
        header('Location: admin_users.php');
        exit;
    } else {
        $errors = $result;
    }
}



?>


<h1>Admin - Edit a User</h1>

<form action="" method="POST">

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= $user['first_name']?>">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $user['last_name']?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= $user['phone'] ?>">
        </div>

        <div class="mb-3">
            <label for="role">Role</label>
                <select name="is_admin" id="role">
                    <option value="u" <?= !$user['is_admin'] ? 'selected' : '' ?>>User</option>
                    <option value="a" <?= $user['is_admin'] ? 'selected' : '' ?>>Admin</option>
                </select>
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
                <select name="is_active" id="status">
                    <option value="a" <?= !$user['is_active'] ? 'selected' : '' ?>>is_active</option>
                    <option value="i" <?= $user['is_active'] ? 'selected' : '' ?>>is_inactive</option>
                </select>
        </div>

        <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>




<?php require_once 'Templates/footer.php'; ?>