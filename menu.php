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
        <!-- Heb hier een margin top ingegooid zodat er niets onder de header verdwijnt. TODO margin bottom op header! -->
        <?PHP
        //TODO _________________________________________________________________________________________________________

        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            ?>

            <?PHP
            echo '<div class="col-md-12 col-md-offset-0 text-center">';
            foreach ($categorylist->getcategories() as $category) { //hij haalt alle categoriën op in een array.
                echo '<button name="catID" onclick="showProductsMenu(this.value)" class="myButton" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button>';
                //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
            }
            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        //TODO _________________________________________________________________________________________________________
        ?>

        <input type="text" id="search" placeholder="Zoeken..." class="col-md-4 col-md-offset-0 search_box"
               onkeyup="doSearch()"/>
        </button>
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


<script src="js/custom.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/t/bs/jq-2.2.0,dt-1.10.11/datatables.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
<script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/vendor/jquery-1.11.0.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/login.js"></script>
<script src="js/scrolltop.js"></script>
<script src="js/modernizr.custom.js"></script>
<script>
    $(document).ready(function () {
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function () {
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>


<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
