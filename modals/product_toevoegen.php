<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

?>

<div class="modal fade modal-dialog-" id="myModalNorm" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
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
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-4 marg" for="Productnummer">Product nummer:</label>
                        <div class="col-sm-8">
                            <input type="" class="form-control" id="Productnummer" placeholder="productnummer invullen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 marg" for="Productnaam">Product naam:</label>
                        <div class="col-sm-8">
                            <input type="" class="form-control" id="Productnaam" placeholder="productnaam invullen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 marg" for="Productomschrijving">Product omschrijving:</label>
                        <div class="col-sm-8">
                            <input type="" class="form-control" id="Productomschrijving" placeholder="productomschrijving invullen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 marg" for="Productprijs">Prijs product:</label>
                        <div class="col-sm-8">
                            <input type="" class="form-control" id="Productprijs" placeholder="prijs product invullen">
                        </div>
                    </div>

            </div>
            <div class="form-group text-right">
                <label class="control-label col-sm-4" for="Productcategorie">Categorie:</label>
                <div class="text-left">
                    <div class="col-sm-8 dropdown">
                        <select class="form-control">
                            <?PHP
                            $categorylist = new CategoryList($DB_con);
                            $listofcategories = $categorylist->getcategories();
                            foreach ($listofcategories as $category){
                                echo "<option value='".$category->getcatID()."'>".$category->getcatname()."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="form-group">
                    <br><br>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Annuleren
                    </button>
                    <button type="button" class="btn btn-primary">
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

