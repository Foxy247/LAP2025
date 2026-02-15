<?php
require_once 'Templates/header.php';

use Controller\AuthController;
use Middleware\IsUser;

if (IsUser::handle()) {
    header('Location: index.php');
    exit();
}
$errors = [];

if (isset($_POST['login'])) {
    $result = AuthController::login($_POST);
    if ($result === true) {
        header('Location: index.php');
        exit();
    } else {
        $errors = $result;
    }
}


?>

    <div>
        <?php foreach ($errors as $error) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>


    <form action="" method="POST">

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary" name="login">Login</button>
    </form>

<?php require_once 'Templates/footer.php'; ?>