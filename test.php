<?PHP
include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Product.php";

session_start();

$product = new Product($DB_con, 1);

$_SESSION['gebruikersnaam'] = 'pietje@pietje.nl';
$_SESSION['wachtwoord'] = 'mijnwachtwoord123';
$_SESSION['productinwinkelwagen'] = $product;

//$productnumber = $_POST['Productnummer'];
//$productname = $_POST['name'];
//$productdescription = $_POST['description'];
//$categoryid = $_POST['catid'];
//$producteuro = 3;
//$productcents = 20;
//
//$product = new Product($DB_con);
//$product->setProductnumber($productnumber);
//$product->setProductname($productname);
//$product->setProductdescription($productdescription);
//$product->setProductprice($producteuro, $productcents);
//$product->create();

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
//try {
//    echo "<br>";
//    $plaats = new City($DB_con);
//    $plaats->setCityid(2);
//    $plaats->setCityname("Gregorydorp");
//    $plaats->setAdditionalcost(2);
//    $plaats->setOldid(1);
//
//    $plaats->update(1);
//    }
// catch(Exception $e){
//    echo $e->getMessage();
//}

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