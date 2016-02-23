<?PHP include_once "header.php"; ?>




<?PHP

include_once "classes/Product1.php";

$product10 = new Product1($DB_con);

$product10->setproductnumber("100");
$product10->setProductname("Cola");
$product10->setProductdescription("Cola blikje");
$product10->setProductprice("300.00");
$product10->create();


?>





<?PHP include_once "footer.php" ?>