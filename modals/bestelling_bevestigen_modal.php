<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

?>
<!--<head>-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>-->
<!--    <script>-->
<!--        $(document).ready(function () {-->
<!--            $("#bezorgen").click(function () {-->
<!--                $("#istop").show();-->
<!--                $("#test").hide();-->
<!---->
<!--            });-->
<!--            $("#ophalen").click(function () {-->
<!--                $("#test").show();-->
<!--                $("#istop").hide();-->
<!---->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--</head>-->

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" id="istop">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h1>Uw bestelling is geplaats!</h1>
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
                            <h5 class="media-heading">Meneer Klant</h5>
                            <h5 class="media-heading">Klantstraat 123</h5>
                            <h5 class="media-heading">1234KL Krommenie</h5>
                            <h5 class="media-heading">06-12345678</h5>
                            <h5 class="media-heading">(Optioneel) Klant@gmail.com</h5>
                        </div>
                    </div>
                    <hr>
                    <h1>Bezorgtijden</h1>
                    <div class="media" style="width: 100%">
                        <div class="media-body" style="width: 50%; float: left">
                            <h4 class="media-heading">Uw bestelling zou over een half uur tot 3 kwartier geleverd worden.</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('.text-field input').keyup(function () {

            var empty = false;
            $('.text-field input').each(function () {
                if ($(this).val().length == 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.actions button').attr('disabled', 'disabled');
            } else {
                $('.actions button').attr('disabled', false);
            }
        });
    });
    $(document).ready(function () {
        $('.text-field1 input').keyup(function () {

            var empty = false;
            $('.text-field1 input').each(function () {
                if ($(this).val().length == 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.action button').attr('disabled', 'disabled');
            } else {
                $('.action button').attr('disabled', false);
            }
        });
    });
</script>
