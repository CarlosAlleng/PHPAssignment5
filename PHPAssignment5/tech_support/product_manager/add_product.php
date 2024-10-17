<?php
require('../model/database.php');
require('../model/product_db.php');

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $version = filter_input(INPUT_POST, 'version', FILTER_SANITIZE_STRING);
    $release_date = filter_input(INPUT_POST, 'release_date');

    // Validate inputs
    if (empty($code) || empty($name) || empty($version) || empty($release_date)) {
        $error = 'Please fill in all fields.';
    } elseif (strlen($code) > 10) {
        $error = 'Code must be less than 10 characters.';
    } elseif (strlen($name) < 3 || strlen($name) > 50) {
        $error = 'Name must be between 3 and 50 characters.';
    } elseif (!preg_match('/^[0-9]{1,2}\.[0-9]{1,2}$/', $version)) {
        $error = 'Version must be in the format x.x or xx.xx.';
    } elseif (!preg_match('/\d{4}-\d{2}-\d{2}/', $release_date)) {
        $error = 'Please enter a valid date in the format YYYY-MM-DD.';
    } else {
        add_product($code, $name, $version, $release_date);
        header("Location: index.php?action=view_products");
        exit();
    }
}
?>

<?php include '../view/header.php'; ?>
<main>
    <h2>Add Product</h2>
    <?php if ($error) : ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="add_product.php" method="post">
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" required maxlength="10" value="<?= htmlspecialchars($code ?? ''); ?>"><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required minlength="3" maxlength="50" value="<?= htmlspecialchars($name ?? ''); ?>"><br>

        <label for="version">Version:</label>
        <input type="text" id="version" name="version" required value="<?= htmlspecialchars($version ?? ''); ?>"><br>

        <label for="release_date">Release Date:</label>
        <input type="date" id="release_date" name="release_date" required value="<?= htmlspecialchars($release_date ?? ''); ?>"><br><br>

        <input type="submit" value="Add Product">
    </form>
    <br>
    <a href="index.php?action=view_products">View Product List</a>
</main>
<?php include '../view/footer.php'; ?>
