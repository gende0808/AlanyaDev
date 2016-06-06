<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html>
<head>

    <?php header("Content-Type: text/html; charset=utf-8");?>

    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
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
    <link rel="stylesheet" href="css/background.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/menubuttons.css"
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/border.css">
    <link href="css/hover.css" rel="stylesheet" media="all">

</head>

<body>

<?php
include_once "connection.php";
include_once "interfaces/CRUD.php";
?>
<nav class="navbar navbar-fixed-top">
    <div id="nav-trigger">
        <span style="width: 100%!important; height: 70px;">Menu</span>
    </div>
    <nav id="nav-main">
        <ul>
            <li class="logoo" style="border-right: solid 0px #950025!important;"><a href="keukenaccount.php" class="hvr-float-shadow" style="height: 40px;"><img src="images/alanyaforbanner3.png" style="padding-bottom: 10px;"></a></li>
            <li><a href="discountmanager.php" class="hvr-float-shadow">Acties</a></li>
            <li><a href="keukenaccount.php" class="hvr-float-shadow">Bestellingen</a></li>
            <li><a href="adminaccount.php" class="hvr-float-shadow">Producten</a></li>
            <li><a href="logout.php" class="hvr-float-shadow">Uitloggen</a></li>
        </ul>
    </nav>
    <nav id="nav-mobile"></nav>
</nav>

<div class="container-fluid" style="margin-top: 70px;">

