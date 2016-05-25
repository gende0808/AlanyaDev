<?PHP
include_once "header2.php";
include_once "classes/Product.php";
include_once "classes/City.php";

$productnumber = htmlspecialchars($_POST['Productnummer']);
$productname = htmlspecialchars($_POST['Productnaam']);
$productdescription = htmlspecialchars($_POST['Productomschrijving']);
$categoryid = htmlspecialchars($_POST['CategorieID']);
$producteuro = htmlspecialchars($_POST['Producteuro']);
$productcents = htmlspecialchars($_POST['Productcent']);
$productadditionid = htmlspecialchars($_POST['ToevoegingGroep']);

$product = new Product($DB_con);
$product->setProductnumber($productnumber);
$product->setProductname($productname);
$product->setProductdescription($productdescription);
$product->setProductprice($producteuro, $productcents);
$product->setCategoryid($categoryid);
$product->setAdditionId($productadditionid);
$product->create();
?>
<script>
    window.location.href = "adminaccount.php";
</script>
