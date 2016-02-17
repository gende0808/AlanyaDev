<head>
    <?php header("Content-Type: text/html; charset=utf-8"); ?>
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
    <link rel="stylesheet" href="css/sideshop.css">
    <link rel="stylesheet" href="css/border.css">

    <link href="css/demo-page.css" rel="stylesheet" media="all">
    <link href="css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs/jq-2.2.0,dt-1.10.11/datatables.min.css"/>



</head>

<nav class="navbar navbar-static-top" id="positionfixed">
    <div id="main">
        <div class="container-fluid">
            <div id="nav-trigger">
                <span>Menu</span>
            </div>
            <nav id="nav-main">
                <ul>
                    <li style="height: 40px; border-right: solid 0px #950025!important;"><a href="index.php" class="hvr-float-shadow" style="height: 40px;"><img src="images/alanyaforbanner3.png" style="padding-bottom: 10px;"></a></li>
                    <li><a href="menu.php" class="hvr-float-shadow">Menukaart</a></li>
                    <li><a href="discounts.php" class="hvr-float-shadow">Acties</a></li>
                    <li><a href="contact.php" class="hvr-float-shadow">Contact</a></li>
                    <li><a href="about.php" class="hvr-float-shadow">Over ons</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal" class="hvr-float-shadow">Login</a></li>
                    <li><a href="register.php" class="hvr-float-shadow">Registreer</a></li>
                    <li><a href="tel:0756409003" class="hvr-float-shadow"><span class="glyphicon glyphicon-earphone"></span> 075-6409003 </a></li>
                </ul>
            </nav>
            <nav id="nav-mobile"></nav>
        </div>
    </div><!-- #main -->

</nav>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 15%;">
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
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                            <input type="text" class="form-control" id="uLogin" placeholder="Gebruikersnaam">
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <label for="uPassword" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                            <input type="password" class="form-control" id="uPassword" placeholder="Wachtwoord">
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->

                    <p>Nog geen account? <a href="register.php">Registreer</a></p>
                </form>

            </div> <!-- /.modal-body -->

            <div class="modal-footer">
                <button class="form-control btn orange" style="color: white;">Ok</button>

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

<!--[if lt IE 7]>
<p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->