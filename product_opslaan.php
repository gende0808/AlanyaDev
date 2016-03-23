<?php

include_once 'connection.php';
include_once 'interfaces/CRUD.php';
include_once 'classes/Product.php';

//TODO IF LEVEL IS HIGH ENOUGH AS ADMIN!
if (isset($_POST['prodid']))
{
    $product_id = htmlspecialchars($_POST['prodid']);
    $product_number = htmlspecialchars($_POST['prodnr']);
    $product_description = htmlspecialchars($_POST['proddescription']);
    $product_name = htmlspecialchars($_POST['prodname']);
    $product_catID = htmlspecialchars($_POST['catid']);
    $product_euros = htmlspecialchars($_POST['euros']);
    $product_cents = htmlspecialchars($_POST['cents']);

    try{
    $product = new Product($DB_con);
    $product->setProductname($product_name);
    $product->setProductnumber($product_number);
    $product->setProductdescription($product_description);
    $product->setCategoryid($product_catID);
    $product->setProductprice($product_euros,$product_cents);
    $product->update($product_id);
    } catch(Exception $e){
        echo 'er is hetvolgende foutgegaan bij het aanpassen van een product: '. $e->getMessage();
    }
}


