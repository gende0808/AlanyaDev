<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<?PHP
include_once "header.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

                                <div class="logo">
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>


    <div class="modal-dialog" style="width: 30%;">
        <img src="images/testlogo2.png" style="width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Registreer</h4>
            </div> <!-- /.modal-header -->

            <?PHP
            ?>
            <form method="post" role="form" action="registersucces.php">
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-comment"></label>
                            <input type="text" class="form-control" name="email" placeholder="E-mail">
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                            <input type="text" class="form-control" name="password" placeholder="Wachtwoord">
                        </div>
                    </div> <!-- /.form-group -->

                          <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-home"></label>
                            <input type="text" class="form-control" name="street" placeholder="Straatnaam" style="width: 70%;">
                            <input type="text" class="form-control" name="number" placeholder="Nr." style="width: 30%;">
                        </div>
                    </div> <!-- /.form-group -->


                          <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                            <input type="text" class="form-control" name="city" placeholder="Plaats">
                        </div>
                    </div> <!-- /.form-group -->

                          <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                            <input type="text" class="form-control" name="phone" placeholder="Telefoonnummer">
                        </div>
                    </div> <!-- /.form-group -->   

                            <p>al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal" class="hvr-float-shadow">Login</a></p>
                    <button class="form-control btn orange" style="color: white;" type="submit" value="submit">Registeren</button>
                </form>
            </div> <!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

<?PHP
include_once "footer.php";
// include_once "sideshoppinglist.php";
?>

<!-- The scroll to top feature -->
<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>


    </body>
</html>

<?PHP

?>