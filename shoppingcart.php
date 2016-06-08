<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<!--


-->
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
    $productid = $_GET['sessionid'];
    if ($delete == "true") {
        try {
            foreach ($_SESSION['productencart'] as $k => $v) {
                if ($v['productid'] == $productid) {
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

<head>
    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/testimonails-slider.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/orange.css">
    <link rel="stylesheet" href="css/scrolltop.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/sidebar.css">

    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
</head>
<body>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser
    today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better
    experience this site.</p>
<![endif]-->
<div id="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo">
                    <center><img src="images/testlogo3.png"></center>
                </div>
            </div>
        </div>
    </div>
</div>
</header>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Log in</h4>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="uLogin" placeholder="Gebruikersnaam">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="uPassword" placeholder="Wachtwoord">
                            <label for="uPassword" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->

                    <p>Nog geen account? <a href="register.php">Registreer</a></p>
                </form>

            </div> <!-- /.modal-body -->

            <div class="modal-footer">
                <button class="form-control btn orange">Ok</button>

                <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1"
                         aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                        <span class="sr-only">progress</span>
                    </div>
                </div>
            </div> <!-- /.modal-footer -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /originalsliderplace -->
<?php
if ($productensession) {


    ?>
    <div class="container">
        <div class="row">
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

                    $productlist = new ProductList($DB_con, 1); // //de post word meegegeven
                    $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten
                    $subtotal = 0;
                    foreach ($_SESSION['productencart'] as $arrayproduct) {
                    $product = new Product($DB_con, $arrayproduct['productid']);
                    $productprijs = check_for_discounts($DB_con, $product->getId(), $product->getCategoryid(), $product->getProductprice());
                    $data_product_price = $productprijs;
                    ?>
                    <tbody class="winkelproduct">
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $product->getProductname() . "(" . $product->getProductdescription() . ")" ?> </h4>
                                    <span>Omschrijving:</span><strong> <?php echo $product->getProductdescription() ?> </strong>
                                            <?PHP
                                            $additiontotalprice = 0;
                                            if (array_key_exists('addable', $arrayproduct) || array_key_exists('removable', $arrayproduct) || array_key_exists('radio', $arrayproduct)) {
                                                echo "<br />";
                                                if (array_key_exists('addable', $arrayproduct)) {
                                                    echo '<span style="color:green"> <i>';
                                                    foreach ($arrayproduct['addable'] as $addableaddition) {
                                                        $productaddition = new ProductAddition($DB_con, $addableaddition);
                                                        echo $productaddition->getName();
                                                        $additiontotalprice += $productaddition->getPrice();
                                                        echo '<b> + ('.$productaddition->getPriceformatted().')</b><br>';
                                                    }
                                                    echo '</span></i>';
                                                }
                                                if (array_key_exists('removable', $arrayproduct)) {
                                                    echo '<span style="color:red"> Zonder: <i>';
                                                    foreach ($arrayproduct['removable'] as $removableaddition) {
                                                        $productremovable = new ProductAdditionRemovable($DB_con, $removableaddition);
                                                        echo $productremovable->getName().", ";
                                                    }
                                                    echo '</span></i>';
                                                    echo '<br>';
                                                }
                                                if (array_key_exists('radio', $arrayproduct)) {

                                                    echo '<span style="color:blue"> <i>';
                                                    echo '<span>  Keuze: <i>';
                                                    foreach ($arrayproduct['radio'] as $radioaddition) {
                                                        $productradio = new ProductRadioAddition($DB_con, $radioaddition);
                                                        echo $productradio->getName().", ";
                                                    }
                                                    echo '</span></i>';
                                                }
                                            }
                                            ?>

                                        </strong></h5>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1">
                            <input type="number" pattern="\d*" class="aantal form-control" name="aantal" id="aantal"
                                   value="<?php echo $arrayproduct['aantal'] ?>">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>
                                <div id="prijs"
                                     data-product-price="<?PHP echo $productprijs ?>"><?php echo "€" . str_replace(".", ",", $productprijs) ?></div>
                        <td class="col-sm-1 col-md-1 text-center"><strong>
                                <div class="toevoeging" data-toevoeging-prijs="
                                <?PHP

                                if (isset($additiontotalprice)){
                                    echo $additiontotalprice;
                                } else {
                                    echo 0.00;
                                }
                                ?>">
                                <?PHP
                                if(isset($additiontotalprice) && $additiontotalprice > 0) {
                                    echo "&euro; ".number_format($additiontotalprice, "2", ",", "");
                                } else {
                                    echo "&euro; 0,00";
                                }
                                $productprijs += $additiontotalprice;
                                $subtotal  += $productprijs;
                                ?>
                            </div>
                            </strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><span
                                    id="result" class="result"
                                    data-result="<?PHP echo $productprijs; ?>"><?php echo '&euro; ' . number_format(($productprijs * $arrayproduct['aantal']), 2, ',', ''); ?></span>
                                <?php echo "<td style='width: 150px;'><a href='shoppingcart.php?sessionid=" . $product->getId() . "&delete=true'" .
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
                                    if(!empty($subtotal)) {
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
                            </div>


                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>  </td>
                        <td><h3>Totaal</h3></td>
                        <td class="text-right"><h3><strong>€<span id="Test1"><?php ?></span>
                                </strong></h3></td>
                    </tr>
                    <tr>
                        <td>  </td>
                        <td>  </td>
                        <td>
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-shopping-cart"></span> <a href="menu.php"
                                                                                           style="color: black"> Terug
                                    naar
                                    het menu</a>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-target="#OrderSuccesModal">
                                <a href="checkout.php" style="color: white"> Afrekenen </a><span
                                    class="glyphicon glyphicon-play"></span>
                            </button>
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
                <button type="button" class="btn btn-default" style="margin-top: 5%">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    <a href="menu.php" style="color: black"> Terug naar het menu</a>
                </button>
            </div>
        </div>
    </div>
    <?php
}

include_once "footer.php";
// include_once "sideshoppinglist.php";
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
    $("input[type=number]").bind('keyup input', function () {
        var aantal = $(this).val();
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

    });

</script>