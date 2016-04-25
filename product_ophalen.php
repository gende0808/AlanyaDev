<?php

include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Product.php";

//TODO IF LEVEL = 3 / ADMIN ~~
if (isset($_POST['productid'])) {
    $id = htmlspecialchars($_POST['productid']);
    try {
        $product = new Product($DB_con, $id);
        $product_array = $product->getProductInfo();
        $eurosandcents = explode('.', $product_array['productPrijs']);
        $product_array['euros'] = $eurosandcents[0];
        $product_array['cents'] = $eurosandcents[1];

        echo json_encode($product_array);


    } catch (Exception $e) {
        echo "Het volgende is foutgegaan bij het ophalen van gegevens van een product: " . $e->getMessage();
    }
}

