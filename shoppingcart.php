<?PHP
include_once "header.php";
include_once "ordersucces.php";
include_once "interfaces/CRUD.php";
include_once "connection.php";
include_once "classes/Product.php";
include_once "classes/Productlist.php";
include_once "classes/Discount.php";
include_once "classes/DiscountList.php";
include_once "functions.php";
include_once "classes/ProductAddition.php";
include_once "classes/ProductAdditionRemovable.php";
include_once "classes/ProductRadioAddition.php";

if (isset($_GET['sessionid']) && isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $sessionid = $_GET['sessionid'];
    if ($delete == "true") {
        try {
            foreach ($_SESSION['productencart'] as $k => $v) {
                if ($k == $sessionid) {
                    unset($_SESSION['productencart'][$k]);
                }
            }
        } catch (Exception $e) {
            echo "this went wrong: " . $e->getMessage();
        }

    }
}
if (isset($_SESSION['productencart'])) {
    $productensession = true;
} else {
    $productensession = false;
}

?>
<?php
if ($productensession) {


    ?>

    <div class="container">
        <div class="row">
    <div class="logo">
        <center><img src="images/testlogo3.png"></center>
    </div>
            <div class="col-sm-12 col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th class="text-center">Prijs</th>
                        <th class="text-center">Toevoeging</th>
                        <th class="text-center">Totaal</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <?php
                    $subtotal = 0;
                    $productlist = new ProductList($DB_con, 1); // //de post word meegegeven
                    $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten
                    foreach ($_SESSION['productencart'] as $key => $arrayproduct) {
                    $product = new Product($DB_con, $arrayproduct['productid']);
                    $productprijs = check_for_discounts($DB_con, $product->getId(), $product->getCategoryid(), $product->getProductprice());
                    $data_product_price = $productprijs;
                    ?>
                    <tbody class="winkelproduct">
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <strong><?php echo $product->getProductname(); ?> </strong></h4>
                                    <span>Omschrijving:</span><?php echo $product->getProductdescription() ?>
                                    <?PHP
                                    $additiontotalprice = 0;
                                    if (array_key_exists('addable', $arrayproduct) || array_key_exists('removable', $arrayproduct) || array_key_exists('radio', $arrayproduct)) {

                                        if (array_key_exists('addable', $arrayproduct)) {
                                            echo '<br><br><span style="color:green"> <i>';
                                            foreach ($arrayproduct['addable'] as $addableaddition) {
                                                $productaddition = new ProductAddition($DB_con, $addableaddition);
                                                echo $productaddition->getName();
                                                $additiontotalprice += $productaddition->getPrice();
                                                echo '<b> + (' . $productaddition->getPriceformatted() . ')</b>';
                                            }
                                            echo '</span></i>';
                                        }
                                        if (array_key_exists('removable', $arrayproduct)) {
                                            echo '<br><br><span style="color:red"> Zonder: <i>';
                                            foreach ($arrayproduct['removable'] as $removableaddition) {
                                                $productremovable = new ProductAdditionRemovable($DB_con, $removableaddition);
                                                echo $productremovable->getName() . ", ";
                                            }
                                            echo '</span></i>';
                                        }
                                        if (array_key_exists('radio', $arrayproduct)) {
                                            $keuze = '';
                                            echo '<br><br><span style="color:blue"> <i>';
                                            echo '<span>  Keuze: <i>';
                                            foreach ($arrayproduct['radio'] as $radioaddition) {
                                                $productradio = new ProductRadioAddition($DB_con, $radioaddition);
                                                $keuze .= $productradio->getName() . ", ";
                                            }
                                            echo rtrim($keuze, ', ');
                                            echo '</span></i>';
                                        }
                                    }
                                    ?>
                                    </strong></h5>
                                </div>
                                <br><hr class="style-one">
                            </div>
                        </td>

                        <td class="col-sm-1 col-md-1">
                            <input type="number" pattern="\d*" class="aantal form-control" name="aantal" id="aantal"
                                   data-arrayid="<?PHP echo $key; ?>"
                                   value="<?php echo $arrayproduct['aantal'] ?>">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>
                                <div id="prijs"
                                     data-product-price="<?PHP echo $productprijs ?>"><?php echo "€" . str_replace(".", ",", $productprijs) ?></div>
                                <td class="col-sm-1 col-md-1 text-center"><strong>
                                        <div class="toevoeging" data-toevoeging-prijs="
                                <?PHP

                                        if (isset($additiontotalprice)) {
                                            echo $additiontotalprice;
                                        } else {
                                            echo 0.00;
                                        }
                                        ?>">
                                            <?PHP
                                            if (isset($additiontotalprice) && $additiontotalprice > 0) {
                                                echo "&euro; " . number_format($additiontotalprice, "2", ",", "");
                                            } else {
                                                echo "&euro; 0,00";
                                            }
                                            $productprijs += $additiontotalprice;
                                            $subtotal += ($productprijs * $arrayproduct['aantal']);
                                            ?>
                                        </div>
                                    </strong></td>
                                <td class="col-sm-1 col-md-1 text-center"><strong><span
                                            id="result" class="result"
                                            data-result="<?PHP echo $productprijs; ?>"><?php echo '&euro; ' . number_format(($productprijs * $arrayproduct['aantal']), 2, ',', ''); ?></span>
                                        <?php echo "<td style='width: 150px;'><a href='shoppingcart.php?sessionid=" . $key . "&delete=true'" .
                                            'onclick="return confirm(' . "'Weet je zeker dat je " . $product->getProductname() . " wilt verwijderen?'" . ')"' . ">Verwijderen</a></td>";
                                        ?>
                                </td>
                    </tr>


                    <?php
                    }
                    ?>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td><h5>Subtotaal</h5></td>
                        <td class="text-right"><h5><strong><span id="subtotal">
                                    <?php
                                    if (!empty($subtotal)) {
                                        echo "€ " . number_format($subtotal, "2", ",", "");
                                    }

                                    ?></span></strong></h5></td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td colspan="2">
                            <div class="alert alert-info">
                                <strong>Let op!</strong> Is uw bestelling onder de 15 euro? Dan betaalt u €2,00
                                bezorgkosten.
                                <br>
                                <br>
                                Wilt u laten bezorgen in <strong>Oostknollendam</strong>,<strong> De Woude</strong> of <strong>Westzaan</strong>? Dan betaalt u standaard €5,00 bezorgkosten.
                            </div>


                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>
                            <a href="menu.php">
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-shopping-cart"></span>
                                Terug
                                    naar
                                    het menu
                            </button>
                            </a>
                        </td>
                        <td>
                            <a href="checkout.php" style="color: white">
                                <button type="button" class="btn btn-success" data-target="#OrderSuccesModal">
                                    Bestelling plaatsen <span
                                        class="glyphicon glyphicon-play"></span>
                                </button>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
} else {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h1>Winkelwagen</h1>

                <div class="media">
                    <div class="media-body">
                        <h4>Er staan geen artikelen in het Winkelwagentje</h4>
                    </div>
                </div>
                <a href="menu.php" style="color: black">
                <button type="button" class="btn btn-default" style="margin-top: 5%">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    Terug naar het menu
                </button>
                </a>
            </div>
        </div>
    </div>
    <?php
}

include_once "footer.php";
?>

<!-- The scroll to top feature -->
<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>
<script src="js/vendor/jquery.gmap3.min.js"></script>
</body>
</html>
<script>
    $("input[type=number]").bind('keyup mouseup', function () {
        var aantal = $(this).val();
        var arrayid = $(this).data('arrayid');
        if (aantal < 0) {
            $(this).val(0);
        }
        if (aantal % 1 != 0) {
            $(this).val(Math.round(parseInt(aantal)));
        }

        var subtotal = 0.00;
        $(".winkelproduct").each(function (e) {
            var amount = $(this).find('.aantal').val();
            var productprice = $(this).find('#prijs').data("product-price");
            var additionprice = $(this).find('.toevoeging').data('toevoeging-prijs');
            productprice = parseFloat(productprice) + parseFloat(additionprice);
            pricetotal = parseFloat(((amount * productprice) * 100) / 100).toFixed(2);
            productpricetotal = pricetotal.replace(".", ",");
            $(this).find('#result').html('&euro; ' + productpricetotal);
            $(this).find('#result').attr("result", pricetotal);
            newproductprice = $(this).find('#result').data('result');
            subtotal = subtotal + parseFloat(newproductprice * amount);
        });
        formatted = ((subtotal * 100) / 100).toFixed(2);
        formatted.replace(".", ",");
        $("#subtotal").html("&euro; " + ((subtotal * 100) / 100).toFixed(2));
        change_amount(aantal, arrayid);
    });

    function change_amount(aantal, arrayid) {
        //alert(aantal);
        //console.log("wouter; " + aantal)
        var url = "shopping_cart_session.php";
        var postData = {
            'changeamount': aantal,
            'cartproductid': arrayid
        };
        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "text",
            success: function () {
            }
        });
    }


</script>