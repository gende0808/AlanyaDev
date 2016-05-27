<?php
session_start();
include_once "interfaces/CRUD.php";
include_once "connection.php";
include_once "classes/Product.php";
include_once "classes/ProductAddition.php";
include_once "classes/ProductAdditionRemovable.php";
include_once "classes/ProductRadioAddition.php";

if (!empty($_POST['prodid']) && !empty($_POST['aantal'])) {
    $array = array();


    if (empty($_SESSION['productencart'])) {
        $_SESSION['productencart'] = array();
    }
    $array['aantal'] = $_POST['aantal'];
    $array['productid'] = $_POST['prodid'];
    if (!empty($_POST['removable'])) {
        $array['removable'] = $_POST['removable'];
    }
    if (!empty($_POST['addable'])) {
        $array['addable'] = $_POST['addable'];
    }
    if (!empty($_POST['radio'])) {
        $array['radio'] = $_POST['radio'];
    }
    if (!empty($array)) {
        array_push($_SESSION['productencart'], $array);
    }
}
echo '
        <div class="text-left">
            <ul>
                <li class="row list-inline columnCaptions">
                    <span>Aantal</span>
                    <span>Product</span>
                    <span>Prijs</span>
                </li>';
foreach ($_SESSION['productencart'] as $cartproduct) {
    $product = new Product($DB_con, $cartproduct['productid']);
    echo '<div id="product">';
    echo '<li class="row">';
    echo '<span class="quantity">' . $cartproduct["aantal"] . '</span>';
    echo '<span class="itemName">' . $product->getProductname() . '</span>';
    echo '<span class="popbtn"  data-parent="#asd" data-toggle="collapse" data-target="#demo"><a class="glyphicon glyphicon-remove"></a></span>';
    echo '<span class="price">€' . $product->getProductprice() . '</span>';
    echo '</li>';
    echo '<li class="row">';
    if (array_key_exists('addable', $cartproduct)) {
        foreach ($cartproduct['addable'] as $addableaddition) {
            $productaddition = new ProductAddition($DB_con, $addableaddition);
            echo '<span> ' . $productaddition->getName() . ' - </span>';
        }
    }
    if (array_key_exists('removable', $cartproduct)) {
        foreach ($cartproduct['removable'] as $removableaddition) {
            $productremovable = new ProductAdditionRemovable($DB_con, $removableaddition);
            echo '<span> ' . $productremovable->getName() . ' - </span>';
        }
    }
    if (array_key_exists('radio', $cartproduct)) {
        foreach ($cartproduct['radio'] as $radioaddition) {
            $productradio = new ProductRadioAddition($DB_con, $radioaddition);
            echo '<span> ' . $productradio->getName() . ' - </span>';
        }
    }
    echo '</li>';
    echo '<div>';
}

?>
</ul>
</div>
