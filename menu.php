<?PHP
include_once "header.php";
include_once "connection.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
include_once "classes/ProductAddition.php";
include_once "classes/ProductRadioAddition.php";
include_once "classes/ProductAdditionRemovable.php";
include_once "modals/toevoegingen_modal.php";
include_once "classes/Discount.php";
include_once "classes/DiscountList.php";
include_once "functions.php";

if (isset($_GET['productid']) && isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $productid = $_GET['productid'];
    if ($delete == "true") {
        try {
            $productdeletion = new Product($DB_con);
            $productdeletion->delete($productid);
        } catch (Exception $e) {
            echo "this went wrong: " . $e->getMessage();
        }

    }
}

?>
<link rel="stylesheet" type="text/css" href="css/newshoppingcart.css"/>
<link rel="stylesheet" type="text/css" href="css/background.css"/>


<div class="container-fluid text-center" style="margin-top: 50px;">
    <div class="col-md-7 col-md-offset-1 text-center" style="margin-top: 50px">
        <div class="col-md-12 col-md-offset-0 text-center">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <div id="placehere" style="margin-bottom: 5%">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <?PHP
        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            ?>

            <?PHP
            echo '<div class="col-md-12 col-md-offset-0 text-center">';
            foreach ($categorylist->getcategories() as $category) { //hij haalt alle categoriën op in een array.
                echo '<a href="#cat"><button name="catID" onclick="showProductsMenu(this.value); ShowIMG(' . $category->getcatID() . ')" class="btntest" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button></a>';
                //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
            }
            echo '</div>';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>

        <div id="cat">
            <!--            de div waar naartoe gescrollt wordt-->
        </div>
        <br>
<div id="mobile2"> <h4> <i>De winkelwagen bevindt zich onderaan de pagina</i> </h4> </div>
        <input type="text" id="search" placeholder="Zoeken..." class="col-md-12 marg col-md-offset-0 search_box"
               onkeyup="doSearch()"/>
        <!-- Hier moet een text komen te staan over dat het product aangepasdt kan worden in de winkelwagen. TODO margin bottom op header! -->
        <table id="producttable" class='table table-striped table-responsive'>
            <thead>
            <tr>
                <th class='text-center'>Nummer</th>
                <th class='text-center'>Product</th>
                <th class='text-center'>Omschrijving</th>
                <th class='text-center'>Prijs</th>
                <th class='text-center'><span class="glyphicon glyphicon-shopping-cart"></span> Toevoegen</th>
            </tr>
            </thead>
            <tbody id="tablecontainermenu">
            </tbody>
        </table>
    </div>
    <div id="shoppingcart-container" class="test col-md-4">
    <?php if(isset($_SESSION['productencart'])) {
   echo '
       <div id="content">
            <div class="shoppingCart">
                <summary>
                    <h4>Winkelwagen</h4>
                    <span class="arrow"></span>
                </summary>
                <ul>';
    $totaalprijs = "";
    $prijsvanproduct = "";
                if(isset($_SESSION['productencart'])) {
                    foreach ($_SESSION['productencart'] as $key => $cartproduct) {
                        $product = new Product($DB_con, $cartproduct['productid']);
                        $actieprijs = check_for_discounts($DB_con,$product->getId(), $product->getCategoryid(), $product->getProductprice());
                            if (array_key_exists('addable', $cartproduct)) {
                                $prijsvanaddables = 0;
                                $prijsvanproduct = $actieprijs;
                                foreach ($cartproduct['addable'] as $prijs) {
                                    $adprijs = new ProductAddition($DB_con, $prijs);
                                    $test = $adprijs->getPrice();
                                    $prijsvanaddables += $test;
                                }
                                $prijsvanproduct += $prijsvanaddables;
                            } else{
                                $prijsvanproduct = $actieprijs;
                            }
                        $totaalprijs += $prijsvanproduct * $cartproduct["aantal"];

                        echo '<li>
                        <span><button class="removalproduct btn-danger glyphicon glyphicon-remove" data-sessid="'.$key.'"></button> ' . $cartproduct["aantal"] . ' x <b>' . $product->getProductname() . '</b></a></span> <strong>&euro;' . number_format((float)$prijsvanproduct, 2, ',', '') . '</strong>
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
                                    echo $productremovable->getName()."<br>";
                                }
                                echo '</span></i>';

                            }

                            echo '<br>';
                            if (array_key_exists('radio', $cartproduct)) {
                                echo '<br><span style="color:blue">Keuze: <i>';
                                $keuze = '';
                                foreach ($cartproduct['radio'] as $radioaddition) {
                                    $productradio = new ProductRadioAddition($DB_con, $radioaddition);
                                    $keuze .= $productradio->getName().', ';
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
        if(!$_SESSION['productencart']) {
            echo "<br> <h4 style='color: grey'> Er staan momenteel geen producten in de winkelwagen </h4>";
        }
        if($_SESSION['productencart']) {
        ?>
            <p>
                <span></span><span>Totaal: <strong>&euro;<?php echo number_format((float)$totaalprijs, 2, ',', '') . '';?></strong></span>
            </p>
        <a class="checkout" href="shoppingcart">Bestelling plaatsen</a>
        <?php
    }

    ?>
        </details>
        </section>
            </ul>
        </div>
    <?php } ?>
    </div>
    </div>
</div>
</div>

<?php
include_once "footer.php";
if(isset($_GET['bref'])){
    $bref = htmlspecialchars($_GET['bref']);
    echo '<script>window.onload = function(){buttonreferral('.$bref.')}</script>';
} else {
    echo '<script src="js/menushowcat.js"></script>';
}
?>



