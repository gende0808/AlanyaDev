<?PHP
include_once "header2.php";
include_once "classes/Product.php";
include_once "classes/City.php";

$productnumber = $_POST['Productnummer'];
$productname = $_POST['Productnaam'];
$productdescription = $_POST['Productomschrijving'];
$categoryid = $_POST['CategorieID'];
$producteuro = $_POST['Producteuro'];
$productcents = $_POST['Productcent'];

$product = new Product($DB_con);
$product->setProductnumber($productnumber);
$product->setProductname($productname);
$product->setProductdescription($productdescription);
$product->setProductprice($producteuro, $productcents);
$product->setCategoryid($categoryid);
$product->create();
?>
<script>
    window.location.href = "adminaccount.php";
</script>
