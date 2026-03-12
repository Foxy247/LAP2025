<?php

require_once 'Templates/header.php';

use Controller\CartController;

// print_r($_SESSION);
// in Table = Alle Produkte aus der Session anzeigen - Stock durch qty ersetzen aus session 

$products = CartController::showCartProduct();
// print_r($products);

?>

<h1>Cart</h1>

<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">image</th>
            <th scope="col">name</th>
            <th scope="col">Quantity</th>
            <th scope="col">price</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th scope="row"><?= $product['id'] ?></th>
                <td><img src="images/<?= $product['image'] ?>" width="80" </td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['quantity'] ?></td>
                <td><?= $product['price'] ?></td>
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



<?php require_once 'Templates/footer.php'; ?>