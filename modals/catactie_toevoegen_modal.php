<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

$actiesoort = true;
$_SESSION['actieSoort'] = $actiesoort;
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#wekelijks").click(function () {
                $("#wekelijks1").show();
                $("#datum1").hide();
                $("#categorie").show();
                $("#functie").show();
                $("#prijs2").show();
            });
            $("#datum").click(function () {
                $("#datum1").show();
                $("#wekelijks1").hide();
                $("#categorie").show();
                $("#functie").show();
                $("#prijs2").show();
            });
        });
    </script>
</head>

<div class="modal fade modal-dialog-" id="catactie" tabindex="-1" role="dialog"
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
                                <button id="wekelijks" class="btn btn-primary" style="width: 40%">
                                    Wekelijks<br>
                                    op een dag
                                </button>
                                <button id="datum" class="btn btn-primary" style="width: 40%">
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
                            <div id="datum1" style="display: none">
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
                            <div id="wekelijks1" style="display: none">
                                <div class="form-group">
                                    <label class="control-label col-sm-4 " for="Productprijs">Dagen:</label>
                                    <div class="col-sm-8" style="text-align: left;">
                                        <input type="checkbox" name="maandag" value="true"
                                               style="width: 20px">Maandag<br>
                                        <input type="checkbox" name="dinsdag" value="true"
                                               style="width: 20px">Dinsdag<br>
                                        <input type="checkbox" name="woensdag" value="true"
                                               style="width: 20px">Woensdag<br>
                                        <input type="checkbox" name="donderdag" value="true"
                                               style="width: 20px">Donderdag<br>
                                        <input type="checkbox" name="vrijdag" value="true"
                                               style="width: 20px">Vrijdag<br>
                                        <input type="checkbox" name="zaterdag" value="true"
                                               style="width: 20px">Zaterdag<br>
                                        <input type="checkbox" name="zondag" value="true" style="width: 20px">Zondag<br>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div id="categorie" class="form-group text-right" style="display: none">
                                <label class="control-label col-sm-4" for="Productcategorie">Categorie:</label>
                                <div class="text-left">
                                    <div class="col-sm-8 dropdown">
                                        <select name='CategorieID' class="form-control">
                                            <?PHP
                                            $categorylist = new CategoryList($DB_con);
                                            $listofcategories = $categorylist->getcategories();
                                            foreach ($listofcategories as $category){
                                                        echo "<option type='text' class='form-control' value='".$category->getcatID()."'>".$category->getcatname(). "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div id="prijs2" class="form-group text-right" style="display: none">
                                <label class="control-label col-sm-4" for="Prijs">Prijs:</label>
                                <div class="text-left">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="Producteuro" placeholder="00">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="Productcent" placeholder="00">
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div id="functie" style="display: none">
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