<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#wekelijks2").click(function () {
                $("#wekelijks3").show();
                $("#datum3").hide();
                $("#categorie1").show();
                $("#product").show();
                $("#functie1").show();
            });
            $("#datum2").click(function () {
                $("#datum3").show();
                $("#wekelijks3").hide();
                $("#categorie1").show();
                $("#product").show();
                $("#functie1").show();
            });
        });
    </script>
</head>

<div class="modal fade modal-dialog-" id="prodactie" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="col-md-4 col-md-offset-4">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Actie Toevoegen
                    </h4>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        Wat voor soort actie wilt u toevoegen?
                        <div>
                            <div class="form-group">
                                <br><br>
                                <button id="wekelijks2" class="btn btn-primary" style="width: 40%">
                                    Wekelijks<br>
                                    op een dag
                                </button>
                                <button id="datum2" class="btn btn-primary" style="width: 40%">
                                    Met begin <br>
                                    en einddatum
                                </button>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div>
                        <form action="actie_toevoegen.php" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="control-label col-sm-4 " for="Actienummer">Actienummer:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="Actienummer"
                                           placeholder="Actienummer invullen">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4 " for="Actienaam">Actienaam:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="Actienaam"
                                           placeholder="Actienaam invullen">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4 " for="Actieomschrijving">Omschrijving:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="Actieomschrijving"
                                           placeholder="Actieomschrijving invullen" rows=5>
                                </div>
                            </div>
                            <hr>
                            <div id="datum3" style="display: none">
                                <div class="form-group">
                                    <label class="control-label col-sm-4 " for="Begindatum">Begindatum:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="Begindatum" placeholder="Begindatum">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4 " for="Einddatum">Einddatum:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="Einddatum" placeholder="Einddatum">
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div id="wekelijks3" style="display: none">
                                <div class="form-group">
                                    <label class="control-label col-sm-4 " for="Productprijs">Dagen:</label>
                                    <div class="col-sm-8" style="text-align: left;">
                                        <input type="checkbox" name="vehicle" value="Bike"
                                               style="width: 20px">Maandag<br>
                                        <input type="checkbox" name="vehicle" value="Car"
                                               style="width: 20px">Dinsdag<br>
                                        <input type="checkbox" name="vehicle" value="Car"
                                               style="width: 20px">Woensdag<br>
                                        <input type="checkbox" name="vehicle" value="Car"
                                               style="width: 20px">Donderdag<br>
                                        <input type="checkbox" name="vehicle" value="Car"
                                               style="width: 20px">Vrijdag<br>
                                        <input type="checkbox" name="vehicle" value="Car"
                                               style="width: 20px">Zaterdag<br>
                                        <input type="checkbox" name="vehicle" value="Car" style="width: 20px">Zondag<br>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div id="product" class="form-group text-right" style="display: none">
                                <label class="control-label col-sm-4" for="Producten">Producten:</label>

                                    <div class="col-sm-12 dropdown" style="text-align: left;">
                                        <table id="newtable" class='table table-striped table-hover table-responsive' style="margin-top: 10%">
                                            <tbody>
                                            <?PHP
                                        $productlist = new ProductList($DB_con);
                                        $listofproducts = $productlist->getlistofproducts();
                                        foreach ($listofproducts as $product){
                                            echo "<tr id='tr". $product->getProductid() ."'>";
                                            echo "<td id='categorie" . $product->getProductid() ."' style='width: 150px;'>"."<input type='checkbox' style='width: 20px'>" . $product->getCategoryid() . "</td>";
                                            echo "<td id='naam" . $product->getProductid() ."' style='width: 150px;'>". $product->getProductname() . "</td>";
                                            echo "<td id='prijs" . $product->getProductid() ."' style='width: 150px;'>"."<input type='textbox' value='€".$product->getProductprice()."'></td>";
                                        }
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>

                            </div>




                    </div>
                    <div id="functie1" style="display: none">
                        <div class="form-group" style="margin-top: 30px">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">
                                Annuleren
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Opslaan
                            </button>

                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>



