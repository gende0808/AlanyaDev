<?PHP
include_once "header.php";
include_once "classes/Product.php";
include_once "classes/City.php";
include_once "classes/Discount2.php";

$discountnumber = $_POST['Actienummer'];
$discountname = $_POST['Actienaam'];
$discountdescription = $_POST['Actieomschrijving'];
//$discountstartdate = $_POST['Begindatum'];
//$discountenddate = $_POST['Einddatum'];

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
$euro = htmlspecialchars($_POST['Prijs']);
$cents = htmlspecialchars($_POST['Prijs1']);
//$discount = $_POST['Productcent']; Hier moet nog een variabel om alle dagen te GETTEN (via een POST) wanneer een actie geldt.

$actie = new Discount2($DB_con);
$actie->setDiscountname($discountname);
$actie->setDiscounttext($discountdescription);
$actie->setMaandag($maandag);
$actie->setDinsdag($dindag);
$actie->setWoensdag($woensdag);
$actie->setDonderdag($donderdag);
$actie->setVrijdag($vrijdag);
$actie->setZaterdag($zaterdag);
$actie->setZondag($zondag);
$actie->setDiscount($euro, $cents);
$actie->create();

echo $maandag;
echo $dindag;
echo $woensdag;
echo $donderdag;
echo $donderdag;
echo $vrijdag;
echo $zaterdag;
echo $zondag;


include_once "../footer.php"
?>
<script>
    window.location.href = "discountmanager.php";
</script>
