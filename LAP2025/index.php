<?php require_once 'Templates/header.php'; ?>

    <h1 class="h1">Hello There! Welcome to my Online Shop</h1>
    

<?php if (isset($_SESSION['user'])): ?>
    <p>Hello there <?= $_SESSION['user']['first_name'] ?>!</p>
<?php endif; ?>

<?php require_once 'Templates/footer.php'; ?>