<?php
ob_start();
include_once "header.php";
include_once "printorder.php";
include_once "classes/Bestelling.php";
include_once "classes/BestellingList.php";
?>

<?php
//id van we aangeklikte bon moet meekomen met ajax om vervolgens de printed op Y te zetten.
$opgestuurdid = htmlentities($_POST['id']);
$bestelling = new Bestelling($DB_con, $opgestuurdid);
    if ($bestelling->getPrinted() == 'Y'){
        $bestelling->setPrinted('N');
    }
    else{
        $bestelling->setPrinted('Y');
    }
$bestelling->update($opgestuurdid);
header('location: keukenaccount');

?>
