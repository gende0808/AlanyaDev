<?PHP include_once "header.php"; ?>




<?PHP

include_once "classes/Product.php";

$product = new Product($DB_con);
$product->read(40);
echo 'productnaam: '.$product->getProductname();
echo "<br>";
echo 'beschrijving: '.$product->getProductdescription();
echo "<br>";
echo 'prijs: '.$product->getProductprice();
echo "<br>";
echo 'number: '.$product->getProductnumber();
echo "<br>";



?>





<?PHP include_once "footer.php" ?>