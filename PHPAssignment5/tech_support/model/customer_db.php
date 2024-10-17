<?php
// model/customer_db.php

function get_customer_by_email($email) {
    global $db;

    $query = 'SELECT * FROM customers WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    return $customer;
}
?>
