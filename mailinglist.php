<?PHP
include_once "header2.php";
include_once "classes/Account.php";
include_once "classes/AccountList.php";


?>

<div class="container text-center" style="margin-top: 50px;">
    <?PHP
    include_once "modals/prodactie_toevoegen_modal.php";
    include_once "modals/catactie_toevoegen_modal.php";
    ?>
    <div class="col-md-12 col-md-offset-0 text-center" style="margin-top: 50px">
        <!-- Heb hier een margin top ingegooid zodat er niets onder de header verdwijnt. TODO margin bottom op header! -->
        <?PHP
        //TODO _________________________________________________________________________________________________________

        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt

            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        //TODO _________________________________________________________________________________________________________
        ?>

            <?php


            $emaillist = new AccountList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            $listofemails = $emaillist->getlistofaccounts();
            foreach ($listofemails as $email) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array


                echo $email->getUseremail() . ";";

                echo "\n";


            }
            ?>


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


<script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
