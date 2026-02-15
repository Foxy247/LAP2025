<?php

require_once 'Templates/header.php';

use Controller\ProductController;
use Middleware\IsAdmin;

if (!IsAdmin::handle()) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['delete'])){
    ProductController::delete($_POST['id']);
}

$products = ProductController::index();

?>

<h1 class="h1">Products Panel</h1>
<br>

<div class="d-flex justify-content-between">
    <a href="admin.php" class="btn btn-secondary">Back</a>
    <a href="createProduct.php" class="btn btn-primary">Add new product</a>
</div>
<hr>

<!-- Table -->
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">image</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">stock</th>
        <th scope="col">price</th>
        <th scope="col">availability</th>
        
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product) : ?>
        <tr>
            <th scope="row"><?= $product['id'] ?></th>
            <td><?= $product['image'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['stock'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><?= $product['is_active'] ?></td>
            <td>
                <!-- edit product -->
                <a href="editProduct.php?id=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>

                <!-- delete product -->
                <form action="" method="POST">
                    <input type="text" name="id" value="<?= $product['id'] ?>" hidden>
                <button class="btn btn-danger" name="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>


    </tbody>
</table>


<?php

require_once 'Templates/footer.php';
?>
