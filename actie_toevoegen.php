<?PHP
include_once "header.php";
include_once "classes/Product.php";
include_once "classes/City.php";
include_once "classes/Discount.php";

$discountnumber = $_POST['Actienummer'];
$discountname = $_POST['Actienaam'];
$discountdescription = $_POST['Actieomschrijving'];
$discountstartdate = $_POST['Begindatum'];
$discountenddate = $_POST['Einddatum'];
//$discount = $_POST['Productcent']; Hier moet nog een variabel om alle dagen te GETTEN (via een POST) wanneer een actie geldt.

$actie = new Discount($DB_con);
$actie->setDiscount($discountnumber);
$actie->setDiscountname($discountname);
$actie->setDiscounttext($discountdescription);
$actie->setDiscountstartdate($discountstartdate);
$actie->setDiscountenddate($discountenddate);
$actie->create();

include_once "../footer.php"
?>
<script>
    window.location.href = "discountmanager.php";
</script>
