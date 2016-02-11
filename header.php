<nav class="navbar navbar-static-top" id="positionfixed">
    <div id="main">
        <div class="container-fluid">
            <div id="nav-trigger">
                <span>Menu</span>
            </div>
            <nav id="nav-main">
                <ul>
                    <li><a href="index.php" class="hvr-float-shadow">Home</a></li>
                    <li><a href="about.php" class="hvr-float-shadow">About</a></li>
                    <li><a href="Contact.php" class="hvr-float-shadow">Contact</a></li>
                    <li><a href="discounts.php" class="hvr-float-shadow">Acties</a></li>
                    <li><a href="menu.php" class="hvr-float-shadow">Menukaart</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal" class="hvr-float-shadow">Login</a></li>
                    <li><a href="register.php" class="hvr-float-shadow">Registreer</a></li>
                    <li><a class="hvr-float-shadow"><span class="glyphicon glyphicon-earphone"></span> 075-6409003 </a></li>
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