<?PHP

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
if(isset($_SESSION['logged']) && ($_SESSION['user_info']['userLevel'] == '2' || '3')) {
}
else {
    header('location: index.php');
}

if ($_SESSION['user_info']['userLevel'] === '3')
{
    include_once "header2.php";
} else {
    include_once "header3.php";
}

include_once "classes/Bestelling.php";
include_once "classes/BestellingList.php";
include_once "classes/Account.php";
include_once "classes/AccountList.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/BestellingProduct.php";
include_once "classes/BestellingToevoegingen.php";
include_once "classes/Product.php";
include_once "classes/ProductList.php";
include_once "classes/ProductAddition.php";
include_once "classes/ProductAdditionRemovable.php";
include_once "classes/ProductRadioAddition.php";
include_once "classes/DiscountList.php";
include_once "classes/Discount.php";
include_once "functions.php";

?>
    <link rel="stylesheet" href="css/sidebar.css">

    <link rel="stylesheet" href="css/opacitybon.css">

<div class="container">
       <div class="row">
           <div class="col-md-10 col-md-offset-1">
           <?php

$bestellinglist = new BestellingList($DB_con);
$listofbestellingen = $bestellinglist->getlistoforders();


foreach ($listofbestellingen as $bestelling){
    $city = new City($DB_con, $bestelling->getCustomercityid());
    $bestelling->Orderproduct();

  ?>



               <div class="test panel panel-default" id="bon<?php echo $bestelling->getOrderid()?>">
                   <div class="panel-body">
                       <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <td style="width: 30%;"><strong><p>Bestellingnummer: </p></strong></td>
                            <td style="width: 30%;"><strong><p id="orderid"><?php echo $bestelling->getOrderid()?></p></strong></td>
                            <td style="width: 40%;" style="text-align: center"><strong><p style="color: red"> <?php echo $bestelling->getOrdertime() ?></p></strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><strong>Product Naam</strong></td>
                            <td class="text-left"><strong>Toevoegingen</strong></td>
                            <td class="text-center"><strong>Prijs</strong></td>
                            <td class="text-center"><strong>Aantal</strong></td>
                            <td class="text-right"><strong>Totaal</strong></td>
                        </tr>
                        </thead>
                        <tbody>

                            <?php
    $productenlijst = $bestelling->getOrderlist();
                            $items = array();
    foreach($productenlijst as $orderproduct){
        $orderproduct->ProductAdditions();
        $product = new product($DB_con, $orderproduct->getProductid());
        $removablelist = $orderproduct->getListofremovables();
        $addablelist = $orderproduct->getListofaddables();
        $radiolist = $orderproduct->getListofradios();



                            ?>
                        <tr>
                            <td style="width: 200px;"><?php echo $product->getProductname()?></td>
                            <td class="highrow">
                                <?php
                                if ($removablelist) {
                                    echo "<b><i>Zonder; </i></b><br>";
                                    echo '- ';
                                }
                                foreach ($removablelist as $removableobject) {
                                    echo $removableobject->getName() . ', ';
                                }
                                $toevoegingen = array();
                                if ($addablelist) {
                                    echo "<b><i>Extra's: </i></b><br>";
                                    echo '- ';
                                }

                                foreach ($addablelist as $addableobject) {
                                    $adprijs = new ProductAddition($DB_con, $addableobject->getId());
                                    echo $addableobject->getName();
                                    echo '(€' . number_format((float)$addableobject->getPrice(), 2, ',', '') . '), ';
                                    $toevoegingen[] = $addableobject->getPrice();
                                }
                                $toevoegingtotaal = array_sum($toevoegingen);
                                echo "<br><br>";
                                if ($radiolist) {
                                    echo "<b><i>Met als keuze: </i></b><br>";
                                }
                                foreach ($radiolist as $radioobject) {
                                    echo '- ' . $radioobject->getName() . '<br>';
                                }
                                ?>
                            </td>

                            <td class="text-center"><?php
                                //$bestelling->getOrdertime()
                                $prodprijstoev = check_for_discounts($DB_con, $product->getId(),$product->getCategoryid() ,$product->getProductprice(),$bestelling->getOrdertime() ) + $toevoegingtotaal;
                                echo "€" . number_format((float)$prodprijstoev, 2, ',', ''); ?></td>
                            <td class="text-center"><?php echo $orderproduct->getNumber() ?></td>
                            <td class="text-right"><?php
                                $totprodprijs = $prodprijstoev * $orderproduct->getNumber();
                                echo "€" . number_format((float)$totprodprijs, 2, ',', '');
                                ?></td>
<!--                            De totaalprijs van de producten moet nog netjes worden gemaakt, zoals ipv 5.5 naar €5.50-->
                            <?php
                            $items[] = $totprodprijs;
                            ?>

                        </tr>
                        <?php
                        }

                        ?>
                        <tr>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow"><strong>Sub totaal</strong></td>
                            <td class="highrow text-right"><?php
                                $subtotaal = array_sum($items);

                                echo "€" . number_format((float)$subtotaal, 2, ',', '')?></td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"><strong>Bezorgingskosten</strong></td>
                            <td class="emptyrow text-right"><?php
                                if($bestelling->getCustomercityid() === '6' || $bestelling->getCustomercityid() === '7' || $bestelling->getCustomercityid() === '8')
                                {
                                $bezorgkosten = 5;

                                }
                                elseif ($subtotaal < 15) {
                                $bezorgkosten = 2;
                                }
                                else {
                                $bezorgkosten = 0;
                                }
                                echo " €" .  number_format((float)$bezorgkosten, 2, ',', '');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"><strong>Totaal</strong></td>
                            <td class="emptyrow text-right"><?php

                                $totaalbedrag = $subtotaal + $bezorgkosten;
                                echo "€" .  number_format((float)$totaalbedrag, 2, ',', '')?></td>
                        </tr>


                        <tr>
                            <td class="emptyrow">
                                <strong>
                                    <p>Naam</p>
                                    <p>Adres</p>
                                    <p>Tel</p>
                                </strong></td>
                            <td class="emptyrow">
                                <strong>
                                    <p> <?php echo $bestelling->getCustomerfirstname() . " " . $bestelling->getCustomerlastname() ?> </p>
                                    <p> <?php echo $bestelling->getCustomerstreetname() . " " . $bestelling->getCustomerhousenumber() . ", " . $city->getCityname() ?></p>
                                    <p> <?php echo $bestelling->getCustomerphonenumber() ?></p>
<!--                                    <p> --><?php //echo $bestelling->getCustomerparticularities() ?><!--</p>-->
                                </strong></td>

                            <td class="emptyrow">
                                <br>
                            </td>


                            <td class="emptyrow">
                                <strong>
                                    <div class="printed searchable-container items col-lg-12" data-orderid="<?PHP echo $bestelling->getOrderid() ?>">
                                        <div class="info-block block-info clearfix">
                                            <div class="square-box pull-left">
                                            </div>
                                            <br>
                                            <div data-toggle="buttons" class="btn-group"">
                                                <label class="btn btn-default">
                                                        <input type="checkbox" name="var_id[]" autocomplete="off" value="">
                                                        <h5>Bon afhandelen</h5>
                                                </label>
                                            </div>
                                        </div>
                                </strong>
                             </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
               <?php
               }
               ?>

</div>
</div>
</div>

<!-- The scroll to top feature -->
<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
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
<script src="js/scrolltop.js"></script>
<script src="js/checkbox.js"></script>
<script src="js/modernizr.custom.js"></script>
<script language="JavaScript" type="text/javascript">
    setTimeout('window.location.reload(true);',30000);//1000 === 1 sec.
    // De timer staat nu op 30 sec.
    // De href moet uiteindelijk nog veranderd worden naar alanya.krommenie
</script>
<script>
    $('.printed').click(function() {
        if ( $( this ).closest('.test').hasClass( "opacitybon" ) ) {
            $( this ).closest(".test").removeClass('opacitybon');
        }
            else{
            $( this ).closest(".test").addClass('opacitybon');
            }
        id = $(this).data('orderid');

        var postData = {
            'id': id
        };

        var url = "print.php";

        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "json",
            success: function(data)
            {

            }

        });
    });

</script>
<?php
foreach ($listofbestellingen as $bestelling) {
    if ($bestelling->getPrinted() == 'Y') {

        echo '<script>$("#bon' . $bestelling->getOrderid() . '").addClass(\'opacitybon\');</script>';
    }
}

?>

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
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>


</body>
</html>