<?PHP
include_once "classes/ListOfAdditionGroups.php";
?>

<div id="bewerkenmodal" class="modal fade modal-dialog-" tabindex="-1" role="dialog"
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
                    <h4 class="modal-title" id="test">
                        text
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="product" class="form-horizontal">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productnummer">Nummer:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Productnummer" id="nummer">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productnaam">Naam:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="naam" name="productnaam">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productomschrijving">Omschrijving:</label>
                            <div class="col-sm-8">
                                <input type="text" id="omschrijving" class="form-control" name="Productomschrijving">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="product_id"></label>
                            <div class="col-sm-8">
                                <input type="hidden" id="product_id" class="form-control" name="product_id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productprijs">Prijs:</label>
                            <div class="col-sm-4">
                                <input type="text" id="euro" class="form-control" name="Producteuro">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="cent" class="form-control" name="Productcent">
                            </div>
                        </div>
                        <input id="productid" type="hidden" name="productid" value="">

                </div>
                <div class="form-group text-right">
                    <label class="control-label col-sm-4" for="Productcategorie">Categorie:</label>
                        <div class="col-sm-8 dropdown">
                            <select name='CategorieID' id="cat" class="form-control">
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
                <div class="form-group text-right">
                    <label class="control-label col-sm-4" for="toevoeginggroepid">Toevoeginggroep:</label>
                    <div class="col-sm-8 dropdown">
                    <select name="toevoeginggroep" id="addid" class="form-control">
                        <?PHP
                            $additionlist = new ListOfAdditions($DB_con);
                            $listofadditions = $additionlist->getListofadditiongroups();
                            foreach ($listofadditions as $addition){
                                echo "<option type=text' class='form-control' value='".$addition->getAdditiongroupid()."'>".$addition->getAdditiongroupname()."</option>";
                            }
                        ?>
                    </select>
                        </div>
                </div>


                <div>
                    <div class="form-group">
                        <br><br>
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">
                            Annuleren
                        </button>
                        <button type="button" id="opslaan" class="btn btn-primary">
                            Opslaan
                        </button>
                    </div>
                </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>