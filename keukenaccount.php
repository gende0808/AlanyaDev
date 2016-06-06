<?PHP

session_start();
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

include_once "printorder.php";
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

?>
<head>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/checkbox.css">
</head>
<div class="container">
       <div class="row">
           <div class="col-md-10">
           <?php

$bestellinglist = new BestellingList($DB_con);
$listofbestellingen = $bestellinglist->getlistoforders();


foreach ($listofbestellingen as $bestelling){
    $city = new City($DB_con, $bestelling->getCustomercityid());
    $bestelling->Orderproduct();

  ?>



               <div class="panel panel-default">
                   <div class="panel-body">
                       <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <td><strong><p>Bestellingnummer: </p></strong></td>
                            <td><strong><p> <?php echo $bestelling->getOrderid()?></p></strong></td>
                            <td><strong><p> <?php echo $bestelling->getOrdertime()?></p></strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><strong>Product Naam</strong></td>
                            <td class="text-center"><strong>Toevoegingen</strong></td>
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
        $product = new product($DB_con, $orderproduct->getProductid());
        $removables = $orderproduct->getListofremovables();
        $addables = $orderproduct->getListofaddables();
        $radios = $orderproduct->getListofradios();



                            ?>
                        <tr>
                            <td><?php echo $product->getProductname()?></td>
                            <td class="highrow">
                                <?php
                               //Hier  moet nog een functie komen die alle toevoegingen met eventuele prijs laat zien.

                                ?>
                            </td>

                            <td class="text-center"><?php echo $product->getProductpriceformatted() ?></td>
                            <td class="text-center"><?php echo $orderproduct->getNumber() ?></td>
                            <td class="text-right"><?php
                                $totprodprijs = ($product->getProductprice() * $orderproduct->getNumber());
                                echo "€" . number_format((float)$totprodprijs, 2, ',', '')
                                ?></td>
<!--                            De totaalprijs van de producten moet nog netjes worden gemaakt, zoals ipv 5.5 naar €5.50-->
                            <?php
                            $items[] = $product->getProductprice() * $orderproduct->getNumber();

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
                                if($bestelling->getCustomercityid() === '5' || $bestelling->getCustomercityid() === '6' || $bestelling->getCustomercityid() === '7')
                                {
                                $bezorgkosten = 5;

                                }
                                elseif ($subtotaal < 15) {
                                $bezorgkosten = 2;
                                }
                                else {
                                $bezorgkosten = 0;
                                }
                                echo "<Br> €" .  number_format((float)$bezorgkosten, 2, ',', '');
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
                                </strong></td>

                            <td class="emptyrow">
                                <br>
                                            <div class="alert alert-danger" role="alert">Deze bon is nog NIET afgedrukt!</div>
                            </td>


                            <td class="emptyrow">
                                <strong>
                                    <div class="searchable-container items col-lg-12">
                                        <div class="info-block block-info clearfix">
                                            <div class="square-box pull-left">
                                            </div>
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="checkbox" name="var_id[]" autocomplete="off" value="">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>Selecteren</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </strong>
                            </td>
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
<script src="js/bootstrap.js"></script>>
<script src="js/scrolltop.js"></script>
<script src="js/checkbox.js"></script>
<script src="js/modernizr.custom.js"></script>

</body>
</html>