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
                echo '<button name="catID" onclick="showProductsMenu(this.value)" class="myButton" id="'. $category->getcatID() .'" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button>';
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
<script src="js/showimg.js"></script>



<script type='text/javascript'>
    var elem = document.createElement('img');
    elem.src = 'images/cat1.png';
    document.getElementById('placehere').appendChild(elem);
</script>




