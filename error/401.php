<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>
<head>

    <?php header("Content-Type: text/html; charset=utf-8"); ?>
    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/templatemo_style.css">
    <link rel="stylesheet" href="../css/templatemo_misc.css">
    <link rel="stylesheet" href="../css/flexslider.css">
    <link rel="stylesheet" href="../css/testimonails-slider.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/orange.css">
    <link rel="stylesheet" href="../css/scrolltop.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/menubuttons.css"
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/sideshop.css">
    <link rel="stylesheet" href="../css/border.css">
    <link href="../css/demo-page.css" rel="stylesheet" media="all">
    <link href="../css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
</head>

<body>

<?php
include_once "../loginmodal.php";
include_once "../connection.php";
include_once "../interfaces/CRUD.php";
?>
<nav class="navbar navbar-fixed-top">
    <div id="nav-trigger">
        <span>Menu</span>
    </div>
    <nav id="nav-main">
        <ul>
            <li style="height: 40px; border-right: solid 0px #950025!important;"><a href="index.php" class="hvr-float-shadow" style="height: 40px;"><img src="../images/alanyaforbanner3.png" style="padding-bottom: 10px;"></a></li>
            <li><a href="../menu.php" class="hvr-float-shadow">Menukaart</a></li>
            <li><a href="../acties.php" class="hvr-float-shadow">Acties</a></li>
            <li><a href="../contact.php" class="hvr-float-shadow">Contact</a></li>
            <li><a href="../about.php" class="hvr-float-shadow">Over ons</a></li>
            <li><a href="tel:0756409003" class="hvr-float-shadow"><span class="glyphicon glyphicon-earphone"></span> 075-6409003 </a></li>
            <li><a href="../shoppingcart.php" class="hvr-float-shadow"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
            <li><a href="#" data-toggle="modal" data-target="#myModal" class="hvr-float-shadow">Inloggen</a></li>
            <li><a href="../register.php" class="hvr-float-shadow">Registreren</a></li>
        </ul>
    </nav>
    <nav id="nav-mobile"></nav>
</nav>

<div class="container-fluid" style="margin-top: 70px;">



    <div>
        <center><h1>Foutcode 401</h1></center><br>
        <center><h3>Er was een probleem met het verkrijgen van authorisatie van de verbinding </h3></center>
    </div>




    <footer>
        <div class="container">
            <div class="top-footer">
                <div class="main-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="About">
                                <h4 class="footer-title">Over Alanya</h4>
                                <p>
                                    Lekker, omdat de Chef van Alanya Krommenie natuurlijk alleen maar werkt met dagverse producten, groenten, eerste klas vlees én vers gemaakte frites. De Hoge Kwaliteit dus die je mag verwachten voor je geld.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="more-info">
                                <h4 class="footer-title">Meer informatie</h4>
                                <ul>
                                    <li><i class="fa fa-phone"></i>075-6409003</li>
                                    <li><i class="fa fa-globe"></i>Padlaan 4, 1561 ZA te Krommenie</li>
                                    <li><i class="fa fa-envelope"></i><a href="#">info@alanya.nl</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="maps">
                                <h4 class="footer-title">Locatie</h4>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19431.315526861035!2d4.769002524235564!3d52.49878833230879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa50dc4a2ab27c24!2sAfhaalcentrum+Alanya!5e0!3m2!1snl!2snl!4v1455526449775" width="300px" height="250px" frameborder="0" style="border:0" allowfullscreen></iframe>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-footer">
                    <p>
                        	<span>Copyright © 2016 <a href="#">Alanya Krommenie</a>
                            | Design: <a rel="nofollow"  target="_parent" href="http://www.jimebbelaar.com"><span class="blue">Alpha</span><span class="green">Insane</span></a></span>
                    </p>
                </div>
            </div>
        </div>
        <!-- The scroll to top feature -->
        <div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
        </div>

        <script type="text/javascript" src="https://cdn.datatables.net/t/bs/jq-2.2.0,dt-1.10.11/datatables.min.js"></script>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
        <script src="../js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/vendor/jquery-1.11.0.min.js"></script>
        <script src="../js/vendor/jquery.gmap3.min.js"></script>
        <script src="../js/plugins.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/login.js"></script>
        <script src="../js/scrolltop.js"></script>
        <script type="text/javascript"></script>
        <script src="../js/custom.js"></script>
        <script>
            $(document).ready(function () {
                ()
                $("#nav-mobile").html($("#nav-main").html());
                $("#nav-trigger span").click(function () {
                    if ($("nav#nav-mobile ul").hasClass("expanded")) {
                        $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                        $(this).removeClass("open");
                    } else {
                        $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                        $(this).addClass("open");
                    }
                });
            });
        </script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#testTable').dataTable();

            } );
        </script>
    </footer>
</body>
</html>