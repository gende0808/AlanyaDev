<?PHP
include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/AccountList.php";
include_once "classes/Bestelling.php";
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#bezorgen").click(function () {
                $("#istop").show();
                $("#test").hide();
//                $("#klant").show();
//                $("#mand").show();
//                $("#strand").show();
//                $("#want").show();
            });
            $("#ophalen").click(function () {
                $("#test").show();
                $("#istop").hide();
//                $("#klant").hide();
//                $("#mand").hide();
//                $("#strand").hide();
//                $("#want").hide();
            });
        });
    </script>
</head>

<div class="logo">
    <center><img src="images/testlogo3.png"></center>
</div>


<?PHP
if (!empty($_POST)) {

    //als het emailadres niet al bestaat gaat hij hieronder proberen een account aan te maken.
    $bestelling = new Bestelling($DB_con);
    $bestelling->setCustomerfirstname(htmlspecialchars($_POST['fname']));
    $bestelling->setCustomerlastname(htmlspecialchars($_POST['lname']));
    $bestelling->setCustomerphonenumber(htmlspecialchars($_POST['phone']));
    if (isset($_POST["streetn"])){ $bestelling->setCustomerstreetname(htmlspecialchars($_POST['streetn']));}
    if (isset($_POST["housen"])){$bestelling->setCustomerhousenumber(htmlspecialchars($_POST['housen']));}
    if (isset($_POST["cityid"])){$bestelling->setCustomercityid(htmlspecialchars($_POST['cityid']));}
    if (isset($_POST["partic"])){$bestelling->setCustomerparticularities(htmlspecialchars($_POST['partic']));}
    $bestelling->setPrinted('N');
    $bestelling->create();
}

include_once "modals/bestelling_bezorgen_modal.php";
include_once "modals/bestelling_afhalen_modal.php";
include_once "footer.php";
// include_once "sideshoppinglist.php";
?>
