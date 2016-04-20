<?PHP
include_once "header.php";
include_once "classes/Product.php";
include_once "classes/City.php";
include_once "classes/Discount.php";

$discountname = $_POST['Actienaam'];
$discountdescription = $_POST['Actieomschrijving'];
$discountstartdate = $_POST['Begindatum'];
$discountenddate = $_POST['Einddatum'];
$discounteuro = $_POST['Producteuro'];
$discountcents = $_POST['Productcent'];
$discountsort = "";

if(!empty($_POST['CategorieID']))
{
    $categorieID = $_POST['CategorieID'];
    $discountsort = true;
}
else
{
    $categorieID = null;
}
if(!empty($_POST['ProductID']))
{
    $productID = $_POST['ProductID'];
    $discountsort = false;

}
else
{
    $productID = null;
}


if(!empty($_POST['maandag']))
{
    $maandag = true;
}
else
{
    $maandag = false;
}
if(!empty($_POST['dinsdag']))
{
    $dindag = true;
}
else
{
    $dindag = false;
}
if(!empty($_POST['woensdag']))
{
    $woensdag = true;
}
else
{
    $woensdag = false;
}
if(!empty($_POST['donderdag']))
{
    $donderdag = true;
}
else
{
    $donderdag = false;
}
if(!empty($_POST['vrijdag']))
{
    $vrijdag = true;
}
else
{
    $vrijdag = false;
}
if(!empty($_POST['zaterdag']))
{
    $zaterdag = true;
}
else
{
    $zaterdag = false;
}
if(!empty($_POST['zondag']))
{
    $zondag = true;
}
else
{
    $zondag = false;
}
//$euro = htmlspecialchars($_POST['Prijs']);
//$cents = htmlspecialchars($_POST['Prijs1']);
//$discount = $_POST['Productcent']; Hier moet nog een variabel om alle dagen te GETTEN (via een POST) wanneer een actie geldt.

$actie = new Discount($DB_con);
$actie->setDiscountname($discountname);
$actie->setDiscounttext($discountdescription);
$actie->setDiscountsort($discountsort);
$actie->setDiscountstartdate($discountstartdate);
$actie->setDiscountenddate($discountenddate);
$actie->setMonday($maandag);
$actie->setTuesday($dindag);
$actie->setWednesday($woensdag);
$actie->setThursday($donderdag);
$actie->setFriday($vrijdag);
$actie->setSaturday($zaterdag);
$actie->setSunday($zondag);
$actie->setCategorieID($categorieID);
$actie->setCategoryprice($discounteuro, $discountcents);
$actie->setProductID($productID);
$actie->setDiscountprice($discounteuro, $discountcents);
$actie->create();




include_once "../footer.php"
?>
<!--<script>-->
<!--    window.location.href = "discountmanager.php";-->
<!--</script>-->
