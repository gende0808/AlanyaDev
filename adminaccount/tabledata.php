<?php
/*
 * In dit php script word de tabel voor de adminaccount gemaakt.
 * Dit moet in een apart bestand staan omdat ajax op een bestand wordt uitgevoerd.
 * Als we ajax op adminaccount.php zelf uitvoeren zal hij alles refreshen.
 * in plaats daarvan staan hierin alleen de code betreffende de tabel en zal dus alleen de tabel worden ge-refreshed.
 */

include_once "../connection.php";
include_once "../interfaces/CRUD.php";
include_once "../classes/ProductList.php";
include_once "../classes/Product.php";


// __________________________________
try {

    if (!isset($_GET['catID'])) {
        $category_ID = 1; //als er geen $_GET['catid'] is meegegeven is catid standaard 1
    } else {
        $category_ID = $_GET['catID'];
    }
    $productlist = new ProductList($DB_con, $category_ID); // //de post word meegegeven
    $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten

        echo "";
    foreach ($listofproducts as $product) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array
        echo "<tr>";
        echo "<td style='width: 150px;'>" . $product->getProductnumber() . "</td>";
        echo "<td style='width: 150px;'>" . $product->getProductname() . "</td>";
        echo "<td style='width: 150px;'>" . $product->getProductdescription() . "</td>";
        echo "<td style='width: 150px;'>" . $product->getProductpriceformatted() . "</td>";
        echo "<td style='width: 150px;'><a href='http://www.google.nl'>wijzigen</a></td>";
        echo "<td style='width: 150px;'><a href='adminaccount.php?productid=" . $product->getProductid() . "&delete=true'".
            'onclick="return confirm('."'weet je zeker dat je ".$product->getProductname()." wilt verwijderen?'".')"' .">verwijder</a></td>";
        echo "</tr>";
        echo "\n";
    };
} catch (Exception $e) {
    echo $e->getMessage();
}
?>