<?PHP
session_start();
include_once 'header.php';
include_once 'classes/ListOfAdditionGroups.php';
include_once 'classes/Product.php';
function pr($var)
{
    print '<pre>';
    print_r($var);
    print '</pre>';
}
$product = new Product($DB_con, $stuff);
pr($_SESSION['productencart']);
