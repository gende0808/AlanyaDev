<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
if(isset($_SESSION['user_info']) && $_SESSION['user_info']['userLevel'] == 2){
    header("Location: keukenaccount.php");
}

if(isset($_SESSION['logged']))
{
    if ($_SESSION['user_info']['userLevel'] === '3') {
        header('location: adminaccount');
    }
}

$URL = $_SESSION['url'] = $_SERVER['REQUEST_URI'];
$loginenregisterknoppen = "";
$mand = "";
$bestellingenlijst = "";
if (isset($_SESSION['logged'])) {
    $loginenregisterknoppen = "
        <li class='dropdown'>
        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">Mijn Account 
        <span class=\"caret\"></span></a>
        <ul class='dropdown-menu'>
         <li style='border-right: solid 0;'><a href='account.php' style='color: black'>Profiel</a></li>
         <li style='border-right: solid 0;'><a href='logout.php' style='color: black'>Uitloggen</a></li>
        </ul>
      </li>";

} else {
    $loginenregisterknoppen = " <li><a href='#' data-toggle='modal' data-target='#myModal' class='hvr-float-shadow'>Inloggen</a></li>
                <li><a href='register' class='hvr-float-shadow'>Registreren</a></li>";
}

if (isset($_SESSION['logged'])) {
    if ($_SESSION['user_info']['userLevel'] === '2') {
        $bestellingenlijst = '<li><a href="keukenaccount" class="hvr-float-shadow">Bestellingen</a></li>';
    };
}


?>

<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<html>
<head>
    <style>
        .no-js #loader {
            display: none;
        }

        .js #loader {
            display: block;
            position: absolute;
            left: 100px;
            top: 0;
        }

        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(images/loader-64x/Preloader_custom2.gif) center no-repeat #fff;
        }
    </style>
    <link rel="icon" href="images/L2.png">
    <meta name="viewport" content="width=device-width, initial-scale=0.9"/>
    <?php header("Content-Type: text/html; charset=utf-8"); ?>
    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
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
    <link rel="stylesheet" href="css/menubuttons.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/border.css">
    <link rel="stylesheet" href="css/background.css">
    <link rel="stylesheet" href="css/mainfont.css">
    <link href="css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">


    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <script>

        $(window).load(function () {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");
            ;
        });
    </script>

</head>

<body>

<div class="se-pre-con"></div>

<?php
include_once "loginmodal.php";
include_once "connection.php";
include_once "interfaces/CRUD.php";
?>
<nav class="navbar navbar-fixed-top">
    <div id="nav-trigger">
        <span style="width: 100%!important; height: 70px;">Menu</span>
    </div>
    <nav id="nav-main">
        <ul>
            <li class="logoo" style="border-right: solid 0px #950025!important;"><a href="index.php"
                                                                                    class="hvr-float-shadow"
                                                                                    style="height: 40px;"><img
                        src="images/alanyaforbanner3.png" style="padding-bottom: 10px;"></a></li>
            <li><a href="menu" class="hvr-float-shadow">Menukaart</a></li>
            <li><a href="contact" class="hvr-float-shadow">Contact & Info</a></li>
            <li><a href="tel:0756409003" class="hvr-float-shadow"><span class="glyphicon glyphicon-earphone"></span>
                    075-6409003 </a></li>
            <li><a href="shoppingcart" class="hvr-float-shadow"><span class="glyphicon glyphicon-shopping-cart"></span></a>
            </li>
            <?PHP echo $bestellingenlijst;
            ?>
            <?PHP echo $loginenregisterknoppen;
            ?>
        </ul>
    </nav>
    <nav id="nav-mobile"></nav>
</nav>

<div class="container-fluid" style="margin-top: 70px;">

