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
       <section id="content">
            <details class="shoppingCart">
                <summary>
                    <h4>Winkelwagen</h4>
                    <span class="arrow"></span>
                </summary>
                <div class="Content"
                <ul>';
if(isset($_SESSION['productencart'])) {
    foreach ($_SESSION['productencart'] as $cartproduct) {
        $product = new Product($DB_con, $cartproduct['productid']);
        echo '<li>
                        <span>' . $cartproduct["aantal"] . ' x <b>' . $product->getProductname() . '</b></a></span> <strong>&euro;' . $product->getProductprice() . '</strong>
                        </li>';
        if (array_key_exists('addable', $cartproduct) || array_key_exists('removable', $cartproduct) || array_key_exists('radio', $cartproduct)) {
            echo '<li>';
            if (array_key_exists('addable', $cartproduct)) {
                echo '<span> extra: <i>';
                foreach ($cartproduct['addable'] as $addableaddition) {
                    $productaddition = new ProductAddition($DB_con, $addableaddition);
                    echo $productaddition->getName();
                }
                echo '</span></i>';
                echo '<br>';
            }
            if (array_key_exists('removable', $cartproduct)) {
                echo '<span> zonder: <i>';
                foreach ($cartproduct['removable'] as $removableaddition) {
                    $productremovable = new ProductAdditionRemovable($DB_con, $removableaddition);
                    echo $productremovable->getName();
                }
                echo '</span></i>';
                echo '<br>';
            }
            if (array_key_exists('radio', $cartproduct)) {
                echo '<span>  keuze: <i>';
                foreach ($cartproduct['radio'] as $radioaddition) {
                    $productradio = new ProductRadioAddition($DB_con, $radioaddition);
                    echo $productradio->getName();
                }
                echo '</span></i>';
            }
            echo '</li>';
        }
    }
}
?>

    <p>
        <span>Producten <strong>8</strong></span> <span>Totaal: <strong>&euro;78,40</strong></span>
    </p>
    <a class="checkout" href="checkout">Afrekenen</a>
    </details>
    </section>
    </ul>
    </div>
</div>
</div>
</div>