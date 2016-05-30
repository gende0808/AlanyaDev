<?php
include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Category.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";


function getProductPrice()
{
    if (!isset($_GET['catID'])) {
        $category_ID = 1; //als er geen $_GET['catid'] is meegegeven is catid standaard 1
    } else {
        $category_ID = $_GET['catID'];
    }

    $huidigeDatum = date('Y-m-d');
    $huidigeDatum = date('Y-m-d', strtotime($huidigeDatum));

    $huidigeDag = date("l"); //is gelijk aan de dag van vandaag
    $actieshowen = false;

    $productprijs = "";
    $productlist = new ProductList($DB_con, $category_ID); // //de post word meegegeven
    $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten
//    foreach ($listofproducts as $product) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array
//
//        if ($product->getMonday() === $huidigeDag
//            or $product->getTuesday() === $huidigeDag
//            or $product->getWednesday() === $huidigeDag
//            or $product->getThursday() === $huidigeDag
//            or $product->getFriday() === $huidigeDag
//            or $product->getSaturday() === $huidigeDag
//            or $product->getSunday() === $huidigeDag
//        ) {
//            $actieshowen = true;
//        }
//
//        $productprijs = $product->getProductpriceformatted();
//        $actieprijs = "";
//        $data_product_price = $product->getProductprice();
//        if (($product->getActiebegindatum() <= $huidigeDatum
//                && $product->getActieEinddatum() >= $huidigeDatum)
//            or $actieshowen == true
//        ) {
//            if ($product->getProductdiscountprice() < $product->getProductprice()) {
//                $actieprijs = $product->getDiscountpriceformatted();
//                $data_product_price = $product->getProductdiscountprice();
//                $productprijs = "<span style=\"color:#FF3333\">Actie</span>" . " " . "<strike>$productprijs</strike>" . " " . $actieprijs;
//            }
//        }
//    }

    echo $productprijs;
}
getProductPrice();