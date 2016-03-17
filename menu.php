<?PHP
include_once "header.php";
include_once "connection.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";


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

<style type="text/css">
    .button-0 {
        position: relative;
        padding: 5px 30px;
        margin: 0px 5px 5px 0px;

        border-radius: 10px;
        font-family: 'Helvetica', cursive;
        font-size: 25px;
        color: #FFF;
        text-decoration: none;
        background-color: #fe1a00;
        border-bottom: 5px solid #ce0100;
        text-shadow: 0px -2px #2980B9;
        /* Animation */
        transition: all 0.1s;
        -webkit-transition: all 0.1s;
    }

    .button-0:hover,
    .button-0:focus {
        text-decoration: none;
        color: #fff;
    }

    .button-0:active {
        transform: translate(0px,5px);
        -webkit-transform: translate(0px,5px);
        border-bottom: 1px solid;
    }
</style>

<div class="container text-center" style="margin-top: 50px;">
    <div class="col-md-12 col-md-offset-0 text-center" style="margin-top: 50px">
        <div class="col-md-12 col-md-offset-0 text-center">
            <div id="placehere" style="margin-bottom: 5%">
            </div>
        </div>
        <!-- Heb hier een margin top ingegooid zodat er niets onder de header verdwijnt. TODO margin bottom op header! -->
        <?PHP
        //TODO _________________________________________________________________________________________________________

        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            ?>

            <?PHP
            echo '<div class="col-md-12 col-md-offset-0 text-center">';
            foreach ($categorylist->getcategories() as $category) { //hij haalt alle categoriën op in een array.
                echo '<button name="catID" onclick="showProductsMenu(this.value); ShowIMG('.$category->getcatID().')" class="button-0" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button>';
                //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
            }
            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        //TODO _________________________________________________________________________________________________________
        ?>


        <input type="text" id="search" placeholder="Zoeken..." class="col-md-12 col-md-offset-0 search_box"
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
    </div>
</div>
<?php
include_once "footer.php";
?>
<script src="js/menushowcat.js"></script>