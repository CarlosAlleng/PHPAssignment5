<?php
session_start();

if (!isset($_SESSION['customer'])) {
    header("Location: customer_login.php");
    exit();
}

require('../model/database.php');
require('../model/product_db.php');

$products = get_products();

?>

<?php include '../view/header.php'; ?>
<main>
    <h2>Register Product</h2>
    <form action="register_product.php" method="post">
        <label for="product">Customer:</label>
        <p><?php echo htmlspecialchars($_SESSION['customer']['first_name']) . ' ' . htmlspecialchars($_SESSION['customer']['last_name']); ?></p>

        <label for="product">Product:</label>
        <select id="product" name="product">
            <?php foreach ($products as $product) : ?>
                <option value="<?= htmlspecialchars($product['code']); ?>">
                    <?= htmlspecialchars($product['name']) . ' ' . htmlspecialchars($product['version']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Register Product">
    </form>

    <p>You are logged in as <?= htmlspecialchars($_SESSION['customer']['email']); ?></p>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</main>
<?php include '../view/footer.php'; ?>
