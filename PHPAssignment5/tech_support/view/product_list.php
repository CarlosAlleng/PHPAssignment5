<?php include '../view/header.php'; ?>
<main>
    <h2>Product List</h2>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= htmlspecialchars($product['code']); ?></td>
                <td><?= htmlspecialchars($product['name']); ?></td>
                <td><?= htmlspecialchars($product['version']); ?></td>
                <td><?= htmlspecialchars($product['release_date']); ?></td>
                <td>
                    <a href="?action=delete_product&code=<?= urlencode($product['code']); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="?action=add_product">Add Product</a>
</main>
<?php include '../view/footer.php'; ?>
