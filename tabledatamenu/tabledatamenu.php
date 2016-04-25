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


// __________________________________
try {

    if (!isset($_GET['catID'])) {
        $category_ID = 1; //als er geen $_GET['catid'] is meegegeven is catid standaard 1
    } else {
        $category_ID = $_GET['catID'];
    }
    $imgcategory = new Category($DB_con, $category_ID);

    $huidigeDatum = date('Y-m-d');
    $huidigeDatum = date('Y-m-d', strtotime($huidigeDatum));

    $huidigeDag = date("l"); //is gelijk aan de dag van vandaag
    $actieshowen =false;

    $productlist = new ProductList($DB_con, $category_ID); // //de post word meegegeven
    $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten
    foreach ($listofproducts as $product) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array

        if(    $product->getMonday()  === $huidigeDag
            or $product->getTuesday()  === $huidigeDag
            or $product->getWednesday()  === $huidigeDag
            or $product->getThursday()   === $huidigeDag
            or $product->getFriday() === $huidigeDag
            or $product->getSaturday()  === $huidigeDag
            or $product->getSunday()  === $huidigeDag)
        {
           $actieshowen = true;
        }

        $productprijs = $product->getProductpriceformatted();
        $actieprijs = "";
        if(    ($product->getActiebegindatum() <= $huidigeDatum
            && $product->getActieEinddatum() >= $huidigeDatum)
            or $actieshowen == true) {
            if ($product->getProductdiscountprice() < $product->getProductprice()) {
                $actieprijs = $product->getDiscountpriceformatted();
                $productprijs = "<span style=\"color:#FF3333\">Actie</span>" . " " . "<strike>$productprijs</strike>" . " " . $actieprijs;
            }
        }
        echo "<tr>";
        echo "<td style='width: 150px;'>" . $product->getProductnumber() . "</td>";
        echo "<td style='width: 150px;'>" . $product->getProductname() . "</td>";
        echo "<td style='width: 150px;'>" . $product->getProductdescription() . "</td>";
        echo "<td style='width: 150px;'>" . $productprijs . "</td>";
        echo "<td style='width: 150px;'>
        <a id='" . $product->getProductid() . "' href=\"#\" data-toggle=\"modal\" data-target=\"#myModalToev\" data-productid='".$product->getProductid()."' class=\"hvr-pulse\"><span class=\"glyphicon glyphicon-plus\"></span> Bestellen</a>
        </td>";
        echo "</tr>";
        echo "\n";
    };
} catch (Exception $e) {
    echo $e->getMessage();
}

?>



