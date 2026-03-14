<?php

require_once 'Templates/header.php';

use Controller\CartController;

// print_r($_POST);

if (isset($_POST['update'])) {
    // echo("true");
    $result = CartController::updateQuantity($_POST);
    if ($result === true) {
        header('Location: cart.php');
        
        exit;
    } else {
        $errors = $result;
    }
}

$products = CartController::showCartProduct();
$total = CartController::getCartTotal();


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
                <td><img src="images/<?= $product['image'] ?>" width="80"> </td>
                <td><?= $product['name'] ?></td>
                <td>
                    <form method="POST" action="cart.php">
                        
                        <select name="amount">
                            <?php for ($i = 1; $i <= 20; $i++): ?>
                                <option value="<?= $i ?>" <?= $i === $product['quantity'] ? 'selected' : '' ?>>
                                    <?= $i ?>
                                </option>
                            <?php endfor; ?>
                        </select>

                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <button type="submit" class="btn btn-warning" name="update">update</button>
                    </form>
                </td>

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

<div>
    <h4>Total: <?= number_format($total,2) ?> €</h4>
</div>



<?php require_once 'Templates/footer.php'; ?>