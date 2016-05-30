<?PHP
include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/AccountList.php";
include_once "classes/Bestelling.php";
include_once "classes/BestellingProduct.php";
include_once "classes/BestellingToevoegingen.php";
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
    $bestelling = new Bestelling($DB_con);
    if ( isset( $_POST['submit2'] ) ) {
        echo 'test';
        $bestelling->setAfhalen('Y');
    } else {
        $bestelling->setAfhalen('N');
    }
    $bestelling->setCustomerfirstname(htmlspecialchars($_POST['fname']));
    $bestelling->setCustomerlastname(htmlspecialchars($_POST['lname']));
    $bestelling->setCustomerphonenumber(htmlspecialchars($_POST['phone']));
    if (isset($_POST["streetn"])) {
        $bestelling->setCustomerstreetname(htmlspecialchars($_POST['streetn']));
    }
    if (isset($_POST["housen"])) {
        $bestelling->setCustomerhousenumber(htmlspecialchars($_POST['housen']));
    }
    if (isset($_POST["cityid"])) {
        $bestelling->setCustomercityid(htmlspecialchars($_POST['cityid']));
    }
    if (isset($_POST["partic"])) {
        $bestelling->setCustomerparticularities(htmlspecialchars($_POST['partic']));
    }
    $bestelling->setPrinted('N');
    $bestelling->create();
    $laatsteidbestelling = $bestelling->getLastinsertedid();
    $_SESSION['order_id'] = $laatsteidbestelling;
    foreach ($_SESSION['productencart'] as $cartproduct){
        $bestellingproduct = new BestellingProduct($DB_con);
        $bestellingproduct->setOrderid($laatsteidbestelling);
        $bestellingproduct->setProductid($cartproduct['productid']);
        $bestellingproduct->setNumber($cartproduct['aantal']);
        $bestellingproduct->create();
        $laatsteidproduct = $bestellingproduct->getLastinsertedid();
            //Hij kijkt of de array bestaat
        if (array_key_exists('addable', $cartproduct)) {
            foreach ($cartproduct['addable'] as $addableaddition) {
                $bestellingaddable = new BestellingAddable($DB_con, $cartproduct['productid']);
                $bestellingaddable->setRecordId($laatsteidproduct);
                $bestellingaddable->setAddableId($addableaddition);
                $bestellingaddable->create();
            }
        }
            //Hij kijkt of de array bestaat
            if (array_key_exists('radio', $cartproduct)) {
                foreach ($cartproduct['radio'] as $radioaddition) {
                    $bestellingradio = new BestellingRadio($DB_con, $cartproduct['productid']);
                    $bestellingradio->setRecordId($laatsteidproduct);
                    $bestellingradio->setRadioId($radioaddition);
                    $bestellingradio->create();
                }
            }
            //Hij kijkt of de array bestaat
            if (array_key_exists('removable', $cartproduct)) {
                foreach ($cartproduct['removable'] as $removableaddition) {
                    $bestellingremovable = new BestellingRemovable($DB_con, $cartproduct['productid']);
                    $bestellingremovable->setRecordId($laatsteidproduct);
                    $bestellingremovable->setRemovableId($removableaddition);
                    $bestellingremovable->create();
                }
            }
        }
     echo "<script>window.location.replace(\"confirmorder\");</script>";
}


include_once "modals/bestelling_bezorgen_modal.php";
include_once "modals/bestelling_afhalen_modal.php";
include_once "footer.php";
?>
