<?PHP
include_once "header2.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
include_once "modals/product_wijzigen_modal.php";


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

        var modal = $(this);


        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "json",
            success: function(data)
            {
                //console.log(data.omschrijving);
                modal.find('.modal-title').text('Bewerken van productid: ' + productid);
                modal.find('#nummer').val(data.nummer);
                modal.find('#omschrijving').val(data.omschrijving);
                modal.find('#naam').val(data.naam);
                modal.find('#cat').val(data.catid);
                modal.find('#euro').val(data.euro);
                modal.find('#cent').val(data.cent);
                modal.find('#productid').val(data.id);

            }
        });
    });

    $("#opslaan").click(function() {
        //postData = $("#product").serialize();

        productid = $("#productid").val();
        Productnummer = $("#nummer").val();
        omschrijving = $("#omschrijving").val();
        productnaam = $("#naam").val();
        cat= $("#cat").val();
        euro = $("#euro").val();
        prijs = $("#prijs").val();
        cent= $("#cent").val();

        var postData = {
            'productid': productid,
            'Productnummer': Productnummer,
            'omschrijving': omschrijving,
            'productnaam': productnaam,
            'cat':  cat,
            'euro': euro,
            'cent': cent,

        };

        var url = "product_opslaan.php";
        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "text",
            success: function(data)
            {
                $("#nummer" + productid).html(Productnummer);
                $("#naam" + productid).html(productnaam);
                $("#omschrijving" + productid).html(omschrijving);
                $("#price" + productid).html(euro);

                // fade out, hier onder:
                $("#tr" + productid).addClass("success");

                $('#bewerkenmodal').modal('hide');

            }
        });

    })
    });
</script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
