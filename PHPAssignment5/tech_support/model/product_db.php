<?php
// model/product_db.php
function get_products() {
    global $db;
    $query = "SELECT code, name, version, release_date FROM products ORDER BY name";
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    return $products;
}

function add_product($code, $name, $version, $release_date) {
    global $db;
    $query = "INSERT INTO products (code, name, version, release_date) 
              VALUES (:code, :name, :version, :release_date)";
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->execute();
    $statement->closeCursor();
}

function delete_product($code) {
    global $db;
    $query = "DELETE FROM products WHERE code = :code";
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->execute();
    $statement->closeCursor();
}
?>
