<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

?>


<div class="modal fade modal-dialog-" id="myModalNorm" tabindex="-1" role="dialog"
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
                    Product Toevoegen
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="product_toevoegen.php" method="post" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="Productnummer">Nummer:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="Productnummer" placeholder="productnummer invullen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="Productnaam">Naam:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="Productnaam" placeholder="productnaam invullen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="Productomschrijving">Omschrijving:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="Productomschrijving" placeholder="productomschrijving invullen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="Productprijs">Prijs:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="Producteuro" placeholder="Euro">
                        </div>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="Productcent" placeholder="Cent">
                        </div>
                    </div>

            </div>
            <div class="form-group text-right">
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
            </div>
            <div>
                <div class="form-group">
                    <br><br>
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

        <!-- Modal Footer -->
        <div class="modal-footer">

        </div>
    </div>
    </div>
</div>

