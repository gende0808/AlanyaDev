<?PHP
include_once "connection.php";
include_once "classes/BestellingProduct.php";
include_once "classes/Bestelling.php";
include_once "classes/BestellingToevoegingen.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="istop">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h1>Bedankt voor het plaatsen van uw bestelling!</h1>
                        <div class="media" style="width: 100%">
                            <div class="media" style="width: 50%;float: left">
                                <div class="media-body">
                                    <h4 class="media-heading">Pizza Hawaii (Tomaat, kaas, ham, ananas)</h4>
<!--                                    <h5 class="media-heading"> Categorie <a href="#">Italliaanse pizza's</a></h5>-->
                                    <span>Omschrijving:</span><strong> Tomaat, kaas, ham, ananas</strong>
                                    <h5 class=""><span>Toevoeging:</span><strong> N.v.t</strong></h5>
                                </div>
                            </div>
                            <div class="media" style="width: 16%; float: right; text-align: right">
                                <div class="media-body">
                                    <h4 class="media-heading">€21,00</h4>
                                </div>
                            </div>
                            <div class="media" style="width: 16%; float: right; text-align: right">
                                <div class="media-body">
                                    <h4 class="media-heading">3x</h4>
                                </div>
                            </div>
                            <div class="media" style="width: 16%; float: right; text-align: right">
                                <div class="media-body">
                                    <h4 class="media-heading">€7,00</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="media" style="width: 100%">
                        <div class="media-body" style="width: 50%; float: left">
                            <h4 class="media-heading">Broodje döner (döner, broodje, sla, saus)</h4>
<!--                            <h5 class="media-heading"> Categorie <a href="#">Broodjes &AMP; Dürüm</a></h5>-->
                            <span>Omschrijving:</span><strong> Broodje met dönervlees</strong>
                            <h5 class=""><span>Toevoeging:</span><strong> Extra vlees</strong></h5>
                        </div>
                        <div class="media" style="width: 16%; float: right; text-align: right">
                            <div class="media-body">
                                <h4 class="media-heading">€8,00</h4>
                            </div>
                        </div>
                        <div class="media" style="width: 16%; float: right; text-align: right">
                            <div class="media-body">
                                <h4 class="media-heading">2x</h4>
                            </div>
                        </div>
                        <div class="media" style="width: 16%; float: right; text-align: right">
                            <div class="media-body">
                                <h4 class="media-heading">€4,00</h4>
                            </div>
                        </div>
                    </div>
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
                                <?php $bestelling = new Bestelling($DB_con, $_SESSION['order_id']); echo $bestelling->getCustomerfirstname();?> <?php echo $bestelling->getCustomerlastname();?></h5>
                            <h5 class="media-heading"></h5>
                            <h5 class="media-heading"><?php echo $bestelling->getCustomerstreetname();?> <?php echo $bestelling->getCustomerhousenumber();?></h5>
                            <h5 class="media-heading"><?php $city = new City($DB_con, $bestelling->getCustomercityid()); echo $city->getCityname();?></h5>
                            <h5 class="media-heading"><?php echo $bestelling->getCustomerphonenumber();?></h5>
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
                            <h4 class="media-heading">Tussen <?php echo $halfuur ?> en <?php echo $driekwartier ?></h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
