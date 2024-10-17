<?php
session_start();
require('../model/database.php');
require('../model/customer_db.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    
    if (empty($email)) {
        $error = 'Please enter your email.';
    } else {
        $customer = get_customer_by_email($email);
        
        if ($customer === false) {
            $error = 'Customer not found.';
        } else {
            // Store customer data in session
            $_SESSION['customer'] = $customer;
            header("Location: product_register.php");
            exit();
        }
    }
}
?>

<?php include '../view/header.php'; ?>
<main>
    <h2>Login</h2>
    <?php if ($error) : ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="customer_login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Login">
    </form>
</main>
<?php include '../view/footer.php'; ?>
