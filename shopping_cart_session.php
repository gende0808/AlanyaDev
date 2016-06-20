<?php
session_start();
include_once "interfaces/CRUD.php";
include_once "connection.php";
include_once "classes/Product.php";
include_once "classes/ProductAddition.php";
include_once "classes/ProductAdditionRemovable.php";
include_once "classes/ProductRadioAddition.php";
include_once 'classes/Discount.php';
include_once 'classes/DiscountList.php';
include_once "functions.php";

$currenttime = date('H:i');
if($currenttime > '16:45' && $currenttime < "20:45") {
    if (!empty($_POST['changeamount']) && is_numeric($_POST['changeamount']) && ($_POST['changeamount'] % 1 == 0) && isset($_POST['cartproductid'])) {
        if (!empty($_SESSION['productencart'])) {
            $cartproductid = htmlentities($_POST['cartproductid'], ENT_QUOTES);
            $changeamount = htmlentities($_POST['changeamount'], ENT_QUOTES);
            if ($changeamount == 0) {
                $changeamount = 1;
            }
            $_SESSION['productencart'][$cartproductid]['aantal'] = $changeamount;
        }
    }

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
    if (isset($_POST['deleteproductfromcart']) && is_numeric($_POST['deleteproductfromcart'])) {
        $deleteproductfromcart = htmlspecialchars($_POST['deleteproductfromcart']);
        unset($_SESSION['productencart'][$deleteproductfromcart]);
    }
    $totaalprijs = "";
    $prijsvanproduct = "";

    echo '
       <div id="content">
            <div class="shoppingCart">
                <summary>
                    <h4>Winkelwagen</h4>
                    <span class="arrow"></span>
                </summary>
                <div class="Content">
                <ul>';
    if (isset($_SESSION['productencart'])) {
        foreach ($_SESSION['productencart'] as $key => $cartproduct) {
            $product = new Product($DB_con, $cartproduct['productid']);
            $actieprijs = check_for_discounts($DB_con, $product->getId(), $product->getCategoryid(), $product->getProductprice());
            if (array_key_exists('addable', $cartproduct)) {
                $prijsvanaddables = 0;
                $prijsvanproduct = $actieprijs;
                foreach ($cartproduct['addable'] as $prijs) {
                    $adprijs = new ProductAddition($DB_con, $prijs);
                    $addableprice = $adprijs->getPrice();
                    $prijsvanaddables += $addableprice;
                }
                $prijsvanproduct += $prijsvanaddables;
            } else {
                $prijsvanproduct = $actieprijs;
            }
            $totaalprijs += $prijsvanproduct * $cartproduct["aantal"];

            echo '<li>
                        <span><button class="removalproduct btn-danger glyphicon glyphicon-remove" data-sessid="' . $key . '"></button> ' . $cartproduct["aantal"] . ' x <b>' . $product->getProductname() . '</b></a></span> <strong>&euro;' . number_format((float)$prijsvanproduct, 2, ',', '') . '</strong>
                        ';
            if (array_key_exists('addable', $cartproduct) || array_key_exists('removable', $cartproduct) || array_key_exists('radio', $cartproduct)) {
                if (array_key_exists('addable', $cartproduct)) {
                    echo '<br><br><span style="color:green"> Extra: <i>';
                    foreach ($cartproduct['addable'] as $addableaddition) {
                        $productaddition = new ProductAddition($DB_con, $addableaddition);
                        echo $productaddition->getName();
                        echo '<b> + ' . $productaddition->getPriceformatted() . '</b><br>';
                    }
                    echo '</span></i>';
                }
                echo '<br>';

                if (array_key_exists('removable', $cartproduct)) {
                    echo '<br><span style="color:red"> Zonder: <i>';
                    foreach ($cartproduct['removable'] as $removableaddition) {
                        $productremovable = new ProductAdditionRemovable($DB_con, $removableaddition);
                        echo $productremovable->getName() . '<br>';
                    }
                    echo '</span></i>';
                }
                echo '<br>';

                if (array_key_exists('radio', $cartproduct)) {
                    echo '<br><span style="color:blue">Keuze: <i>';
                    $keuze = '';
                    foreach ($cartproduct['radio'] as $radioaddition) {
                        $productradio = new ProductRadioAddition($DB_con, $radioaddition);
                        $keuze .= $productradio->getName() . ', ';
                    }
                    echo rtrim($keuze, ', ');
                    echo '</span></i>';
                }
            }
            echo '</li>';
        }
    }
    ?>


    <?php
    if (!$_SESSION['productencart']) {
        echo "<br> <h4 style='color: grey'> Er staan momenteel geen producten in de winkelwagen </h4>";
    }
    if ($_SESSION['productencart']) {
        ?>
        <p>
            <span></span><span>Totaal: <strong>&euro;<?php echo number_format((float)$totaalprijs, 2, ',', '') . ''; ?></strong></span>
        </p>

        <?php
    }

    ?>
    </details>
    </section>
    </ul>
    </div>
    <a class="checkout" href="shoppingcart">Bestelling plaatsen</a>
    </div>
    </div>
    </div>
    </div>
    <?PHP
} else {
    echo "<div class=\"col-md-4 text-left alert alert-danger\">
  <strong></strong> U kunt alleen tussen <strong>16:45 en 20:45</strong><br> 
  bestellingen plaatsen via de website.<br> 
  Wij zijn elke dag open vanaf <strong>11:00 tot 21:00 uur</strong><br>en op vrijdag & zaterdag tot <strong>03:00</strong>.<br>
  Wij zijn tussen deze tijden <strong>wel</strong> telefonisch bereikbaar.
</div>";
}
    ?>