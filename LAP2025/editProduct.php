<?php

require_once 'Templates/header.php';

use Controller\ProductController;


$id = $_GET["id"];

if (!$id) {
    header('Location: admin_products.php');
    exit();
}

$product = ProductController::show($id);
if(!$product) {
    header('Location: admin_products.php');
    exit();
}

$errors = [];

if (isset($_POST['update'])) {
    $result = ProductController::update($id,$_POST);
    if ($result === true) {
        header('Location: admin_products.php');
        exit;
    } else {
        $errors = $result;
    }
}



?>


<h1>Admin - Edit a Product</h1>

<form action="" method="POST">

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?= $product['description']?>">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">stock</label>
            <input type="stock" class="form-control" id="stock" name="stock" value="<?= $product['stock'] ?>">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">price</label>
            <input type="text" class="form-control" id="price" name="price" value="<?= $product['price'] ?>">
        </div>

        <div class="mb-3">
            <label for="is_active">Availability</label>
                <select name="is_active" id="is_active">
                    <option value="a" <?= $product['is_active'] ? 'selected' : '' ?>>is_available</option>
                    <option value="i" <?= !$product['is_active'] ? 'selected' : '' ?>>is not available</option>
                </select>
        </div>

        <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>




<?php require_once 'Templates/footer.php'; ?>