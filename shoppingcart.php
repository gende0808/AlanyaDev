<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<!--


-->
<?PHP
include_once "header.php";
include_once "ordersucces.php";
include_once "interfaces/CRUD.php";
include_once "connection.php";
include_once "classes/product.php";
include_once "classes/productlist.php";

if (isset($_GET['sessionid']) && isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    $productid = $_GET['sessionid'];
    if ($delete == "true") {
        try {
            foreach($_SESSION['productencart'] as $k => $v) {
                if($v['productid'] == $productid) {
                    unset($_SESSION['productencart'][$k]);
                }
            }
        } catch (Exception $e) {
            echo "this went wrong: " . $e->getMessage();
        }

    }
}


?>

<head>
    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
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
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
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

                    <p>Nog geen account? <a href="register.html">Registreer</a></p>
                </form>

            </div> <!-- /.modal-body -->

            <div class="modal-footer">
                <button class="form-control btn orange">Ok</button>

                <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                        <span class="sr-only">progress</span>
                    </div>
                </div>
            </div> <!-- /.modal-footer -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /originalsliderplace -->
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table class="table table-hover">
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

                foreach($_SESSION['productencart'] as $arrayproduct) {
                $product = new Product($DB_con, $arrayproduct['productid']);
                $productprijs = $product->getProductpriceformatted();
                $actieprijs = "";
                $data_product_price = $product->getProductprice();
                if ($product->getProductdiscountprice() < $product->getProductprice()) {
                    $actieprijs = $product->getDiscountpriceformatted();
                    $data_product_price = $product->getProductdiscountprice();
                    $productprijs = "<span style=\"color:#FF3333\">Actie</span>" . " " . "<strike>$productprijs</strike>" . " " . $actieprijs;
                }
                ?>
                <tbody>
                <tr>
                    <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $product->getProductname() . "(" . $product->getProductdescription() . ")" ?> </h4>
                                <h5 class="media-heading"> Categorie <a href="#">Italliaanse pizza's</a></h5>
                                <span>Omschrijving:</span><strong> <?php echo $product->getProductdescription() ?> </strong>
                                <h5 class=""><span>Toevoeging:</span><strong> N.v.t</strong></h5>
                            </div>
                        </div>
                    </td>
                    <td class="col-sm-1 col-md-1">
                        <input type="number" class="form-control" name="aantal" id="aantal"  value="<?php echo $arrayproduct['aantal'] ?>">
                    </td>
                    <td class="col-sm-1 col-md-1 text-center"><strong><div id="prijs"><?php echo $product->getProductdiscountprice() ?></div>
                    <td class="col-sm-1 col-md-1 text-center"><strong>€0,00</strong></td>
                    <td class="col-sm-1 col-md-1 text-center"><strong><input type="text" name="result" id="result" value="<?php echo $product->getProductdiscountprice() * $arrayproduct['aantal'] ?>">
                     <?php       echo "<td style='width: 150px;'><a href='shoppingcart.php?sessionid=" . $product->getId() . "&delete=true'".
                        'onclick="return confirm('."'Weet je zeker dat je ".$product->getProductname()." wilt verwijderen?'".')"' .">Verwijderen</a></td>";
                     ?>
                    </td>
                </tr>

                <?php
                }
                ?>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Subtootal</h5></td>
                    <td class="text-right"><h5><strong>€31,00</strong></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Bezorgkosten</h5></td>
                    <td class="text-right"><h5><strong>€0.00</strong></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h3>Totaal</h3></td>
                    <td class="text-right"><h3><strong>€31,00</strong></h3></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> <a href="menu.php" style="color: black"> Terug naar het menu</a>
                        </button></td>
                    <td>
                        <button type="button" class="btn btn-success" data-target="#OrderSuccesModal">
                            <a href="checkout.php" style="color: white"> Afrekenen </a><span class="glyphicon glyphicon-play"></span>
                        </button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?PHP
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
    $("#prijs,#aantal").keyup(function () {
        var myBox1 = '<?php echo $product->getProductdiscountprice(); ?>';
        var myBox2 = document.getElementById('aantal').value;
        var result = document.getElementById('result');
        var myResult = myBox1 * myBox2;
        result.value = myResult;
    });
</script>