<?php

require_once 'Templates/header.php';

use Controller\ProductController;

$errors = [];

if (isset($_POST['register'])) {
    $result = ProductController::create($_POST, $_FILES);
    if ($result === true) {
        header('Location: admin_products.php');
        exit;
    } else {
        $errors = $result;
    }
}

?>


<h1>Add a new Product</h1>

<div>
    <?php foreach ($errors as $error) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endforeach; ?>
</div>

<form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">product name</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">stock</label>
            <input type="text" class="form-control" id="stock" name="stock">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">price</label>
            <input type="price" class="form-control" id="price" name="price">
        </div>

        <div class="mb-3">
            <label class="form-label">image</label>
            <input type="file" name="file">

        </div>

        <div class="mb-3">
            <label for="is_active">Availability:</label>
                <select name="is_active" id="is_active">
                    <option value="a">Available</option>
                    <option value="i">Unavailable</option>
                </select>
        </div>

        <button type="submit" class="btn btn-primary" name="register">Add new Product</button>
    </form>


<?php require_once 'Templates/footer.php'; ?>