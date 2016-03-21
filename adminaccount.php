<?PHP
include_once "header2.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";


if (isset($_GET['productid']) && isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $productid = $_GET['productid'];
    if ($delete == "true") {
        try {
            $productdeletion = new Product($DB_con);
            $productdeletion->delete($productid);
        } catch (Exception $e) {
            echo "this went wrong: " . $e->getMessage();
        }

    }
}


?>


<div class="container text-center" style="margin-top: 50px;">
    <?PHP
     include_once "modals/product_toevoegen_modal.php";
    ?>
    <div class="col-md-12 col-md-offset-0 text-center" style="margin-top: 50px">
        <!-- Heb hier een margin top ingegooid zodat er niets onder de header verdwijnt. TODO margin bottom op header! -->
        <?PHP
        //TODO _________________________________________________________________________________________________________

        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            ?>

            <?PHP
            echo '<div class="col-md-12 col-md-offset-0 text-center">';
            foreach ($categorylist->getcategories() as $category) { //hij haalt alle categoriën op in een array.
                echo '<button name="catID" onclick="showProducts(this.value)" class="myButton" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button>';
                //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
            }
            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        //TODO _________________________________________________________________________________________________________
        ?>

        <input type="text" id="search" placeholder="Zoeken..." class="col-md-4 col-md-offset-0 search_box"
               onkeyup="doSearch()"/>
        <button class="btn btn-default btn-lg col-md-3 col-md-offset-5" data-toggle="modal" data-target="#myModalNorm"
                style="margin-top: 25px"> <span class="glyphicon glyphicon-plus"></span> Product toevoegen
        </button>
        <table id="producttable" class='table table-striped table-hover table-responsive'>
            <thead>
            <tr>
                <th class='text-center'>Product nummer</th>
                <th class='text-center'>Product naam</th>
                <th class='text-center'>Product omschrijving</th>
                <th class='text-center'>Product prijs</th>
                <th class='text-center'>Optie</th>
                <th class='text-center'>Verwijderen</th>
            </tr>
            </thead>
            <tbody id="tablecontainer">
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade modal-dialog-" id="bewerkenmodal" tabindex="-1" role="dialog"
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
                        Product wijzigen
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="post" class="form-horizontal" role="form" id="product" placeholder="Product nummer">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productnummer">Nummer:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Productnummer" id="Productnummer">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productnaam">Naam:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Productnaam">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productomschrijving">Omschrijving:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="Productomschrijving">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="Productprijs">Prijs:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="Producteuro">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="Productcent">
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
                            <input id="productid" type="hidden" name="productid" value="">
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
                        <button type="submit" id="opslaan" class="btn btn-primary">
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




<script src="js/custom.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/t/bs/jq-2.2.0,dt-1.10.11/datatables.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
<script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/vendor/jquery-1.11.0.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/login.js"></script>
<script src="js/scrolltop.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/adminshowcat.js"></script>
<script>
    $(document).ready(function () {
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function () {
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });
    });
</script>
<script>
    $('#bewerkenmodal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var productid = button.data('productid') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


        // Ajax thingie:
        var postData = {
            'productid': productid
        };

        var url = "product_ophalen.php";

        var modal = $(this)

        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "json",
            success: function(data)
            {
                //console.log(data.omschrijving);
                modal.find('.modal-title').text('Bewerken van productid: ' + productid)
                modal.find('#nummer').val(data.Productnummer)
                modal.find('#omschrijving').val(data.omschrijving)
                modal.find('#cat').val(data.catid)
                modal.find('#productid').val(data.id)

            }
        });
    })

    $("#opslaan").click(function() {
        //postData = $("#product").serialize();

        productid = $("#productid").val();
        Productnummer = $("#nummer").val();

        var postData = {
            'productid': productid,
            'Productnummer': Productnummer
        }

        var url = "product_opslaan.php";

        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "text",
            success: function(data)
            {
                $("#nummer" + productid).html(Productnummer)
                // fade out, hier onder:
                $("#tr" + productid).addClass("success")

                $('#bewerkenmodal').modal('hide')

            }
        });

    })
</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
