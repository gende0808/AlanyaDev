<?PHP
include_once "interfaces/CRUD.php";
include_once "connection.php";
include_once "classes/BestellingToevoegingen.php";
include_once "classes/BestellingProduct.php";
include_once "classes/Bestelling.php";
include_once "classes/Product.php";
include_once "classes/ProductList.php";
include_once "classes/ProductAddition.php";
include_once "classes/ProductAdditionRemovable.php";
include_once "classes/ProductRadioAddition.php";

if (isset($_SESSION['productencart'])) {
    unset($_SESSION['productencart']);
}

$bestelling = new Bestelling($DB_con, $_SESSION['order_id']);
echo $bestelling->getCustomerproductid();
$bestelling->Orderproduct();
$productenlijst = $bestelling->getOrderlist();

$minutes_to_add = 30;
$time = new DateTime($bestelling->getOrdertime());
$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
$halfuur = $time->format('H:i');

$minutes_to_add2 = 45;
$time2 = new DateTime($bestelling->getOrdertime());
$time2->add(new DateInterval('PT' . $minutes_to_add2 . 'M'));
$driekwartier = $time2->format('H:i');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="istop">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="text-center alert alert-success" role="alert"><h3>Bedankt voor het plaatsen van uw
                                bestelling!</h3></div>
                        <div class="media" style="width: 100%">
                            <div class="text-center well well-lg"><h1>Afhalen</h1>
                                <div class="media" style="width: 100%">
                                    <div class="media-body">
                                        <h3 class="media-heading"><u>u kunt uw bestelling afhalen om: <i><?php echo $halfuur ?></u></i></h3>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $productprijzen = array();
                            foreach ($productenlijst as $product) {
                            $product->ProductAdditions();
                            $newproduct = new Product($DB_con, $product->getProductid());
                            $removablelist = $product->getListofremovables();
                            $addablelist = $product->getListofaddables();
                            $radiolist = $product->getListofradios(); ?>
                            <div class="media" style="width: 100%;float: left">
                                <div class="well">
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <?php

                                            echo $newproduct->getProductname() . "<br>";

                                            ?></h4>
                                        <div class="media" style="width: 52%; float: left; text-align: left">
                                            <h5 class=""><span></span><?php
                                                if ($removablelist) {
                                                    echo "Zonder: <br>";
                                                }
                                                foreach ($removablelist as $removableobject) {
                                                    echo '- ' . $removableobject->getName() . '<br>';
                                                }
                                                echo "<br>";
                                                $toevoegingen = array();
                                                if ($addablelist) {
                                                    echo "Extra's: <br>";
                                                }
                                                foreach ($addablelist as $addableobject) {
                                                    $adprijs = new ProductAddition($DB_con, $addableobject->getId());
                                                    echo '- ' . $addableobject->getName() . '<br>';
                                                    $toevoegingen[] = $addableobject->getPrice();
                                                }
                                                $toevoegingtotaal = array_sum($toevoegingen);
                                                echo "<br>";
                                                if ($radiolist) {
                                                    echo "Met als keuze: <br>";
                                                }
                                                foreach ($radiolist as $radioobject) {
                                                    echo '- ' . $radioobject->getName() . '<br>';
                                                }
                                                $productprijs = check_for_discounts($DB_con, $newproduct->getId(),$newproduct->getCategoryid(), $newproduct->getProductprice() ) + $toevoegingtotaal;
                                                $productprijzen[] = $productprijs * $product->getNumber(); ?>
                                            </h5>
                                        </div>
                                        <div class="media" style="width: 16%; float: right; text-align: right">
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    €<?php echo number_format((float)($productprijs) * $product->getNumber(), 2, ',', '') ?></h4>
                                            </div>
                                        </div>
                                        <div class="media" style="width: 16%; float: right; text-align: right">
                                            <div class="media-body">
                                                <h4 class="media-heading"><?php echo $product->getNumber() . 'x'; ?></h4>
                                            </div>
                                        </div>
                                        <div class="media" style="width: 16%; float: right; text-align: right">
                                            <div class="media-body">
                                                <h4 class="media-heading">
                                                    €<?php echo number_format((float)$productprijs , 2, ',', '') ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="well">
                        <div class="media" style="width: 100%">
                            <div class="media-body" style="width: 50%; float: left">
                            </div>
                            <div class="media-body" style="width: 50%; float: right; text-align: right">
                                <?php
                                $subtotaal = array_sum($productprijzen);
                                ?>
                            </div>
                        </div

                        <div class="media" style="width: 100%">
                            <div class="media-body" style="width: 50%; float: left">
                            </div>
                            <div class="media-body" style="width: 50%; float: right; text-align: right">
                                <h4 class="media-heading"><?php
                                    if($bestelling->getCustomercityid() === '6' || $bestelling->getCustomercityid() === '7'|| $bestelling->getCustomercityid() === '8')
                                    {
                                        $bezorgkosten = 5;

                                    }
                                    elseif ($subtotaal < 15) {
                                        $bezorgkosten = 2;
                                    }
                                    else {
                                        $bezorgkosten = 0;
                                    }
                                    ?></h4>
                            </div>
                            <div class="media" style="width: 100%">
                                <div class="media-body" style="width: 50%; float: left">
                                    <h4 class="media-heading">Totaalbedrag</h4>
                                </div>
                                <div class="media-body" style="width: 50%; float: right; text-align: right">
                                    <h4 class="media-heading" style="color: red;"><b><i><u>
                                                    <?php
                                                    echo " €" . number_format((float)$subtotaal, 2, ',', '');
                                                    ?>
                                                </u>
                                            </i>
                                        </b>
                                    </h4>
                                </div>
                            </div
                            <hr>
                        </div>
                        <br>
                        <br>
                        <div class="well">
                            <h1>Gegevens</h1>
                            <div class="media" style="width: 100%">
                                <div class="media-body" style="width: 50%; float: left">
                                    <h5 class="media-heading">
                                        <?php $bestelling = new Bestelling($DB_con, $_SESSION['order_id']);
                                        echo $bestelling->getCustomerfirstname(); ?> <?php echo $bestelling->getCustomerlastname(); ?></h5>
                                    <h5 class="media-heading"><?php echo $bestelling->getCustomerphonenumber(); ?></h5>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="text-center well well-lg"><h1>Fout gemaakt?</h1>
                            <div class="media" style="width: 100%">
                                <div class="media-body">
                                    <h4 class="media-heading">Bel Alanya-Krommenie om eventuele wijzigingen door te geven <br><br><a href="tel:0756409003" class="hvr-float-shadow"><span class="glyphicon glyphicon-earphone"></span>
                                                    075-6409003 </a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>

