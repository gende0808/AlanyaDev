<?PHP
include_once "header2.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
include_once "classes/Discount.php";
include_once "classes/DiscountList.php";



if (isset($_GET['actieid']) && isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $actieid = $_GET['actieid'];
    if ($delete == "true") {
        try {
            $discountdeletion = new Discount($DB_con);
            $discountdeletion->delete($actieid);
        } catch (Exception $e) {
            echo "this went wrong: " . $e->getMessage();
        }

    }

//    if (!isset($_GET['catID'])) {
//        $discount_ID = 1; //als er geen $_GET['catid'] is meegegeven is catid standaard 1
//    } else {
//        $discount_ID = $_GET['catID'];
//    }
}


?>

<div class="container text-center" style="margin-top: 50px;">
    <?PHP
    include_once "modals/prodactie_toevoegen_modal.php";
    include_once "modals/catactie_toevoegen_modal.php";
    ?>
    <div class="col-md-12 col-md-offset-0 text-center" style="margin-top: 50px">
        <!-- Heb hier een margin top ingegooid zodat er niets onder de header verdwijnt. TODO margin bottom op header! -->
        <?PHP
        //TODO _________________________________________________________________________________________________________

        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt

            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        //TODO _________________________________________________________________________________________________________
        ?>

        <input type="text" id="search" placeholder="Zoeken..." class="col-md-4 col-md-offset-0 search_box"
               onkeyup="doSearch()"/>
        <button class="btn btn-default btn-lg col-md-3 col-md-offset-1" data-toggle="modal" data-target="#prodactie"
                style="margin-top: 25px"> <span class="glyphicon glyphicon-plus"></span> Product Actie toevoegen
        </button>
        <button class="btn btn-default btn-lg col-md-3 col-md-offset-1" data-toggle="modal" data-target="#catactie"
                style="margin-top: 25px"> <span class="glyphicon glyphicon-plus"></span> Categorie Actie toevoegen
        </button>
        <table id="weeklyTable" class='table table-striped table-hover table-responsive' style="margin-top: 15%">
            <thead>
            <tr>
                <th class='text-center'>Actie nummer</th>
                <th class='text-center'>Actie naam</th>
                <th class='text-center'>Omschrijving</th>
                <th class='text-center'>Product/Categorie</th>
                <th class='text-center'>Datum</th>
                <th class='text-center'>Kortingsprijs</th>
                <th class='text-center'>Verwijderen</th>
            </tr>
            </thead>
            <tbody
            <?php


            $discountlist = new DiscountList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            $listofdiscounts = $discountlist->getlistofdiscounts();
            foreach ($listofdiscounts as $discount) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array
                if($discount->getBegindate() != 0 && $discount->getEnddate() != 0)
                {
                    $ActieDatum = $discount->getBegindate() . " t/m "  . $discount->getEnddate();
                }
                else
                {
                    $ActieDatum = $discount->getdays();
                }

                echo "<tr id='tr". $discount->getId() ."'>";
                echo "<td id='nummer" . $discount->getId() ."' style='width: 150px;'>" . $discount->getId() . "</td>";
                echo "<td id='naam" . $discount->getId(). "'style='width: 150px;'>" . $discount->getDiscountname() . "</td>";
                echo "<td id='omschrijving". $discount->getId() ."' style='width: 150px;'>" . $discount->getDiscounttext() . "</td>";
                echo "<td id='soort". $discount->getId() ."' style='width: 150px;'>" . $discount->getProductname() . "</td>";
                echo "<td id='startdate". $discount->getId() ."' style='width: 150px;'>". $ActieDatum . "</td>";
                echo "<td id='prijs". $discount->getId() ."' style='width: 150px;'>" . $discount->getDiscountprice() . "</td>";

                echo "<td style='width: 150px;'><a href='discountmanager.php?actieid=" . $discount->getId() . "&delete=true'".
                    'onclick="return confirm('."'weet je zeker dat je ".$discount->getDiscountname()." wilt verwijderen?'".')"' .">Verwijderen</a></td>";
                echo "</tr>";
                echo "\n";


            }
            ?>
            </tbody>
        </table>

    </div>
</div>


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
<script src="js/custom.js"></script>
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
