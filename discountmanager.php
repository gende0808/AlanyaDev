<?PHP
include_once "header2.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
include_once "classes/Discount.php";
include_once "classes/DiscountList.php";
include_once "classes/Discount2.php";
include_once "classes/DiscountList2.php";



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
$discount_ID = 1;
$discountlist = new DiscountList($DB_con, $discount_ID);
$listofdiscounts = $discountlist->getlistofdiscounts();

$discount_ID2 = 1;
$discountlist2 = new DiscountList2($DB_con, $discount_ID2);
$listofdiscounts2 = $discountlist2->getlistofdiscounts2();
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#Wekelijks").click(function () {
                $("#weeklyTable").show();
                $("#dateTable").hide();
            });
            $("#Weekdagen").click(function () {
                $("#dateTable").show();
                $("#weeklyTable").hide();
            });
        });
    </script>
</head>

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
        <button id="Wekelijks" class="btn btn-primary" style="width: 20%">
            Met begin <br>
            en -einddatum
        </button>
        <button id="Weekdagen" class="btn btn-primary" style="width: 20%">
            Wekelijks<br>
            op een dag
        </button>
        <table id="weeklyTable" class='table table-striped table-hover table-responsive' style="margin-top: 15%;display: none">
            <thead>
            <tr>
                <th class='text-center'>Actie nummer</th>
                <th class='text-center'>Actie naam</th>
                <th class='text-center'>Omschrijving</th>
                <th class='text-center'>Begin datum</th>
                <th class='text-center'>Eind datum</th>
                <th class='text-center'>Korting</th>
                <th class='text-center'>Verwijderen</th>
            </tr>
            </thead>
            <tbody
            <?php
            foreach ($listofdiscounts as $discount) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array
                echo "<tr id='tr". $discount->getId() ."'>";
                echo "<td id='nummer" . $discount->getId() ."' style='width: 150px;'>" . $discount->getId() . "</td>";
                echo "<td id='naam" . $discount->getId(). "'style='width: 150px;'>" . $discount->getDiscountname() . "</td>";
                echo "<td id='omschrijving". $discount->getId() ."' style='width: 150px;'>" . $discount->getDiscounttext() . "</td>";
                echo "<td id='startdate". $discount->getId() ."' style='width: 150px;'>" . $discount->getDiscountstartdate() . "</td>";
                echo "<td id='enddate". $discount->getId() ."' style='width: 150px;'>" . $discount->getDiscountenddate() . "</td>";
                echo "<td id='price" . $discount->getId() . "' style='width: 150px;text-align: right'>" ."€". $discount->getDiscount() . "</td>";
//
                echo "<td style='width: 150px;'><a href='discountmanager.php?actieid=" . $discount->getId() . "&delete=true'".
                    'onclick="return confirm('."'weet je zeker dat je ".$discount->getDiscountname()." wilt verwijderen?'".')"' .">Verwijderen</a></td>";
                echo "</tr>";
                echo "\n";
            }
            ?>
            </tbody>
        </table>
        <table id="dateTable" class='table table-striped table-hover table-responsive' style="margin-top: 15%s">
            <thead>
            <tr>
                <th class='text-center'>Actie nummer</th>
                <th class='text-center'>Actie naam</th>
                <th class='text-center'>Omschrijving</th>
                <th class='text-center'>Dagen in de week</th>
                <th class='text-center'>Productnaam</th>
                <th class='text-center'>Korting</th>
                <th class='text-center'>Verwijderen</th>
            </tr>
            </thead>
            <tbody
            <?php
            foreach ($listofdiscounts2 as $discount2) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array
                echo "<tr id='tr". $discount2->getId() ."'>";
                echo "<td id='nummer" . $discount2->getId() ."' style='width: 150px;'>" . $discount2->getId() . "</td>";
                echo "<td id='naam" . $discount2->getId(). "'style='width: 150px;'>" . $discount2->getDiscountname() . "</td>";
                echo "<td id='omschrijving". $discount2->getId() ."' style='width: 150px;'>" . $discount2->getDiscounttext() . "</td>";
                echo "<td id='actiedagen". $discount2->getId() ."' style='width: 150px;'>" . $discount2->getMaandag() . "</td>";
                echo "<td id='enddate". $discount2->getId() ."' style='width: 150px;'>" . $discount2->getDinsdag() . "</td>";
                echo "<td id='price" . $discount2->getId() . "' style='width: 150px;text-align: right'>" ."€". $discount2->getDiscount() . "</td>";
//
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
<script src="js/adminshowcat.js"></script>
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
