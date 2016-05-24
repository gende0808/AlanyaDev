<?PHP
include_once "header.php";
include_once "connection.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
include_once "modals/toevoegingen_modal.php";


if (isset($_GET['productid']) && isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $productid = $_GET['productid'];
    if ($delete == "true") {
        try {
            $productdeletion = new Product($DB_con);
            $productdeletion->delete($productid);
        } catch (Exception $e) {
            echo "this went wrong: " . $e->getMessage();
        }

    }
}

?>
<link rel="stylesheet" type="text/css" href="css/custom.css"/>


<div class="container-fluid text-center" style="margin-top: 50px;">
    <div class="col-md-7 col-md-offset-1 text-center" style="margin-top: 50px">
        <div class="col-md-12 col-md-offset-0 text-center">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <div id="placehere" style="margin-bottom: 5%">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <?PHP
        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            ?>

            <?PHP
            echo '<div class="col-md-12 col-md-offset-0 text-center">';
            foreach ($categorylist->getcategories() as $category) { //hij haalt alle categoriën op in een array.
                echo '<a href="#cat"><button name="catID" onclick="showProductsMenu(this.value); ShowIMG('.$category->getcatID().')" class="btntest" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button></a>';
                //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
            }
            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>

        <div id="cat">
            <!--            de div waar naartoe gescrollt wordt-->
        </div>

        <input type="text" id="search" placeholder="Zoeken..." class="col-md-12 marg col-md-offset-0 search_box"
               onkeyup="doSearch()"/>
        <!-- Hier moet een text komen te staan over dat het product aangepasdt kan worden in de winkelwagen. TODO margin bottom op header! -->
        <table id="producttable" class='table table-striped table-hover table-responsive'>
            <thead>
            <tr>
                <th class='text-center'>Nummer</th>
                <th class='text-center'>Product</th>
                <th class='text-center'>Omschrijving</th>
                <th class='text-center'>Prijs</th>
                <th class='text-center'><span class="glyphicon glyphicon-shopping-cart"></span> Toevoegen</th>
            </tr>
            </thead>
            <tbody id="tablecontainermenu">
            </tbody>
        </table>
    </div>
    <div class="col-md-4">
        <div class="text-left">
            <ul>
                <li class="row list-inline columnCaptions">
                    <span>Aantal</span>
                    <span>Product</span>
                    <span>Prijs</span>
                </li>
                <?PHP
                if(isset($_SESSION['productencart'])) {
                    foreach ($_SESSION['productencart'] as $cartproduct) {
                        $product = new Product($DB_con, $cartproduct['productid']);
                        echo '<div id="product">';
                        echo '<li class="row">';
                        echo '<span class="quantity">' . $cartproduct["aantal"] . '</span>';
                        echo '<span class="itemName">' . $product->getProductname() . '</span>';
                        echo '<span class="popbtn"  data-parent="#asd" data-toggle="collapse" data-target="#demo"><a class="glyphicon glyphicon-remove"></a></span>';
                        echo '<span class="price">€' . $product->getProductprice() . '</span>';
                        echo '</li>';
                        echo '<li class="row">';
                        if (array_key_exists('addable', $cartproduct)) {
                            foreach ($cartproduct['addable'] as $addableaddition) {
                                echo '<span>' . $addableaddition . '</span>';
                            }
                            echo '</li>';
                            echo '<div>';
                        }
                    }
                }

                ?>
            </ul>
        </div>

    </div>
    </div>

<?php
include_once "footer.php";
if(isset($_GET['bref'])){
    $bref = htmlspecialchars($_GET['bref']);
    echo '<script>window.onload = function(){buttonreferral('.$bref.')}</script>';
} else {
    echo '<script src="js/menushowcat.js"></script>';
}
?>
<script src="js/customjs.js"></script>


