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

if(isset($_SESSION['productencart'])){
    unset($_SESSION['productencart']);
}

$bestelling = new Bestelling($DB_con, $_SESSION['order_id']);
echo $bestelling->getCustomerproductid();
$bestelling->Orderproduct();
$productenlijst = $bestelling->getOrderlist();
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="istop">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <div class="alert alert-success" role="alert"><h3>Bedankt voor het plaatsen van uw bestelling!</h3></div>
                        <div class="media" style="width: 100%">


                            <?php foreach ($productenlijst as $product) {
                                $product->ProductAdditions();
                                $newproduct = new Product($DB_con, $product->getProductid());
                                $removablelist = $product->getListofremovables();
                                $addablelist = $product->getListofaddables();
                                $radiolist = $product->getListofradios(); ?>
                                <div class="media" style="width: 100%;float: left">
                                    <div class="alert alert-info" role="alert">
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <?php
                                            echo $newproduct->getProductname() . "<br>";
                                            ?></h4>
                                        <!--                                    <h5 class="media-heading"> Categorie <a href="#">Italliaanse pizza's</a></h5>-->
                                        <!--                                    <span>Omschrijving:</span><strong> Tomaat, kaas, ham, ananas</strong>-->
                                        <div class="media" style="width: 16%; float: right; text-align: right">
                                            <div class="media-body">
                                                <h4 class="media-heading">€<?php echo $newproduct->getProductprice() * $product->getNumber()?></h4>
                                            </div>
                                        </div>
                                        <div class="media" style="width: 16%; float: right; text-align: right">
                                            <div class="media-body">
                                                <h4 class="media-heading"><?php echo $product->getNumber().'x'; ?></h4>
                                            </div>
                                        </div>
                                        <div class="media" style="width: 16%; float: right; text-align: right">
                                            <div class="media-body">
                                                <h4 class="media-heading">€<?php echo $newproduct->getProductprice()?></h4>
                                            </div>
                                        </div>
                                        <h5 class=""><span></span><strong><?php
                                                foreach ($removablelist as $removableobject) {
                                                    echo '- '. $removableobject->getName(). '<br>';
                                                    echo '- '. $removableobject->get(). '<br>';
                                                }
                                                foreach ($addablelist as $addableobject) {
                                                    $adprijs = new ProductAddition($DB_con, $addableobject->getId());
                                                    echo '- '. $addableobject->getName(). '<br>';
                                                    echo '- '. $adprijs->getPrice(). '<br>';
                                                }
                                                foreach ($radiolist as $radioobject) {
                                                    echo '- '. $radioobject->getName(). '<br>';
                                                } ?></strong></h5>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="media" style="width: 100%">
                        <div class="media-body" style="width: 50%; float: left">
                            <h4 class="media-heading">Verzendkosten</h4>
                        </div>
                        <div class="media-body" style="width: 50%; float: right; text-align: right">
                            <h4 class="media-heading">€0,00</h4>
                        </div>
                    </div>
                    <div class="media" style="width: 100%">
                        <div class="media-body" style="width: 50%; float: left">
                            <h4 class="media-heading">Totaalbedrag</h4>
                        </div>
                        <div class="media-body" style="width: 50%; float: right; text-align: right">
                            <h4 class="media-heading">€29,00</h4>
                        </div>
                    </div>
                    <hr>
                    <h1>Gegevens</h1>
                    <div class="media" style="width: 100%">
                        <div class="media-body" style="width: 50%; float: left">
                            <h5 class="media-heading">
                                <?php $bestelling = new Bestelling($DB_con, $_SESSION['order_id']);
                                echo $bestelling->getCustomerfirstname(); ?> <?php echo $bestelling->getCustomerlastname(); ?></h5>
                            <h5 class="media-heading"></h5>
                            <h5 class="media-heading"><?php echo $bestelling->getCustomerstreetname(); ?> <?php echo $bestelling->getCustomerhousenumber(); ?></h5>
                            <h5 class="media-heading"><?php $city = new City($DB_con, $bestelling->getCustomercityid());
                                echo $city->getCityname(); ?></h5>
                            <h5 class="media-heading"><?php echo $bestelling->getCustomerphonenumber(); ?></h5>
                        </div>
                    </div>
                    <hr>

                    <?php
                    $minutes_to_add = 30;
                    $time = new DateTime($bestelling->getOrdertime());
                    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
                    $halfuur = $time->format('H:i');

                    $minutes_to_add2 = 45;
                    $time2 = new DateTime($bestelling->getOrdertime());
                    $time2->add(new DateInterval('PT' . $minutes_to_add2 . 'M'));
                    $driekwartier = $time2->format('H:i');
                    ?>

                    <h1>Bezorgtijd</h1>
                    <div class="media" style="width: 100%">
                        <div class="media-body" style="width: 50%; float: left">
                            <h4 class="media-heading">Tussen: <i><?php echo $halfuur ?> en <?php echo $driekwartier ?></i></h4>
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

