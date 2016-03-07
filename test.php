<?PHP include_once "header.php"; ?>




<?PHP

include_once "classes/Product.php";
include_once "classes/City.php";

//$product = new Product($DB_con);
//$product->read(40);

////Create
//try {
//
//    $plaats = new City($DB_con);
//    $plaats->setCityid(1);
//    $plaats->setCityname("Gregorydorp");
//    $plaats->setAdditionalcost(2);
//
//    $plaats->create();
//
//}
//catch(Exception $e){
//    echo $e->getMessage();
//}

////Read
//try {
//    $plaats = new City($DB_con);
//    $plaats->create(1);
//    echo "<br><br><br><br><br><br>";
//    echo $plaats->getCityid();
//    echo $plaats->getCityname();
//    echo $plaats->getAdditionalcost();
//} catch(Exception $e){
//    echo $e->getMessage();
//}

////delete
//try {
//    $plaats = new City($DB_con);
//    $plaats->delete(1);
//    echo "<br><br><br><br><br><br>";
//    echo $plaats->getCityid();
//    echo $plaats->getCityname();
//    echo $plaats->getAdditionalcost();
//} catch(Exception $e){
//    echo $e->getMessage();
//}

////Update Moet nog gefixt worden
try {
    echo "<br>";
    $plaats = new City($DB_con);
    $plaats->setCityid(2);
    $plaats->setCityname("Gregorydorp");
    $plaats->setAdditionalcost(2);
    $plaats->setOldid(1);

    $plaats->update(1);
    }
 catch(Exception $e){
    echo $e->getMessage();
}

//echo 'productnaam: '.$product->getProductname();
//echo "<br>";
//echo 'beschrijving: '.$product->getProductdescription();
//echo "<br>";
//echo 'prijs: '.$product->getProductprice();
//echo "<br>";
//echo 'number: '.$product->getProductnumber();
//echo "<br>";


?>



<?PHP include_once "footer.php" ?>