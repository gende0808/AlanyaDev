<?php
/*
 * In dit php script word de tabel voor de admindata gemaakt.
 * Dit moet in een apart bestand staan omdat ajax op een bestand wordt uitgevoerd.
 * Als we ajax op admindata.php zelf uitvoeren zal hij alles refreshen.
 * in plaats daarvan staan hierin alleen de code betreffende de tabel en zal dus alleen de tabel worden ge-refreshed.
 */

include_once "../connection.php";
include_once "../interfaces/CRUD.php";
include_once "../classes/Category.php";
include_once "../classes/ProductList.php";
include_once "../classes/Product.php";
include_once "../modals/toevoegingen_modal.php";
include_once '../classes/Discount.php';
include_once '../classes/DiscountList.php';
include_once "../functions.php";

// __________________________________
try {

    if (!isset($_GET['catID'])) {
        $category_ID = 1; //als er geen $_GET['catid'] is meegegeven is catid standaard 1
    } else {
        $category_ID = $_GET['catID'];
    }
    $imgcategory = new Category($DB_con, $category_ID);

    $productlist = new ProductList($DB_con, $category_ID); // //de post word meegegeven
    $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten
    foreach ($listofproducts as $product) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array

        $productprijs = $product->getProductpriceformatted();
        $data_product_price = $product->getProductprice();
        $actieprijs = check_for_discounts($DB_con,$product->getId(),$product->getCategoryid(),$product->getProductprice());
            if ($actieprijs < $product->getProductprice()) {
                $data_product_price = $actieprijs;
                $productprijs = "<span style=\"color:#FF3333\">Actie</span>" . " " . "<strike>$productprijs</strike>" . " " . $actieprijs;
            }

        $data_product_price = str_replace(".", ",", $data_product_price);
        echo "<tr>";
        echo "<td class='text-center' style='width: 150px;'>" . $product->getProductnumber() . "</td>";
        echo "<td class='text-center' style='width: 150px;'>" . $product->getProductname() . "</td>";
        echo "<td class='text-center' style='width: 150px;'>" . $product->getProductdescription() . "</td>";
        echo "<td class='text-center' style='width: 150px;'>" . $productprijs . "</td>";
        echo "<td class='text-center' style='width: 150px;'>
        <a id='" . $product->getProductid() . "' href=\"#\" data-toggle=\"modal\" data-target=\"#myModalToev\" data-product-price='" . $data_product_price . "' data-productid='" . $product->getProductid() . "' data-productname='" . $product->getProductname() . "' class=\"hvr-pulse\"><span class=\"glyphicon glyphicon-plus\"></span> Bestellen</a>
        </td>";
        echo "</tr>";
        echo "\n";
    };
} catch (Exception $e) {
    echo $e->getMessage();
}

?>



