<?php require_once 'Templates/header.php'; 

use Controller\ProductController;
use Controller\CartController;

$products = ProductController::userIndex();

$errors = [];

if(isset($_POST['add_to_cart'])) {
    $result = CartController::addProduct($_POST);
    if ($result === true) {
        header('Location: index.php');
        exit();
    } else {
        $errors = $result;
    }
    
}
?>

    <h1 class="h1">Hello There! Welcome to my Online Shop</h1>

    
<?php if (isset($_SESSION['user'])): ?>
    <p>Hello there <?= $_SESSION['user']['first_name'] ?>!</p>
<?php endif; ?>

<!-- Alles Produkte von User anzeigen -->

<?php foreach ($products as $product): ?>

<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Product</h5>
    <p class="card-text">Product description.</p>
    
    

    <form action="index.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <select name="amount" id="amount_<?= $product['id'] ?> ">Amount

            <?php 
                // For schleife. Alle Produkte schleifen. 
                $maxAmount = min($product['stock'], 20);

                for ($i = 1; $i <= $maxAmount; $i++): 
            ?>
            <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit" name="add_to_cart" class="btn btn-warning">Add to Cart</button>


    </form>
  </div>
</div>

<?php endforeach; ?>

<?php require_once 'Templates/footer.php'; ?>