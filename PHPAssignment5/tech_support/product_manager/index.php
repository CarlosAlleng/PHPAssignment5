<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'view_products'; // Default action
    }
}

if ($action == 'view_products') {
    $products = get_products();
    include('../view/product_list.php');
} elseif ($action == 'delete_product') {
    $code = filter_input(INPUT_GET, 'code');
    delete_product($code);
    header("Location: index.php?action=view_products");
    exit();
} elseif ($action == 'add_product') {
    include('../product_manager/add_product.php');
} else {
    include('../under_construction.php');
}
?>
