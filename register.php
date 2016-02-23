<?PHP
include_once "header.php";

include_once "classes/Account.php";
include_once "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>  <div class="modal-dialog" style="width: 30%;">
        <img src="images/testlogo2.png" style="width: 100%;">
        <div class="modal-content">

                <div class="panel-heading">
                    <?PHP
                    if(!empty($_POST)) {
                        try {
                            $account = new Account($DB_con);
                            $account->setUseremail(htmlspecialchars($_POST['email']));
                            $account->setUserpassword(htmlspecialchars($_POST['password']));
                            $account->setUserstreetname(htmlspecialchars($_POST['street']));
                            $account->setUserhousenumber(htmlspecialchars($_POST['number']));
                            $account->setUserphonenumber(htmlspecialchars($_POST['phone']));
                        } catch(Exception $e){

                            echo $e->getMessage();
                        }
                    }
                    ?>




            <div class="modal-header">


                <h4 class="modal-title" id="myModalLabel">Registreer</h4>
            </div>
            <!-- /.modal-header -->

            <form method="post" role="form" action="register.php">
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                <input type="text" class="form-control" name="email" placeholder="E-mail">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="password" class="form-control" name="password" placeholder="Wachtwoord">
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="password" class="form-control" name="password2"
                                       placeholder="verifieer Wachtwoord">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-home"></label>
                                <input type="text" class="form-control" name="street" placeholder="Straatnaam"
                                       style="width: 70%;">

                                <input type="text" class="form-control" name="number" placeholder="Nr."
                                       style="width: 30%;">
                            </div>
                        </div>
                        <!-- /.form-group -->


                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                                <input type="text" class="form-control" name="city" placeholder="Plaats">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                <input type="text" class="form-control" name="phone" placeholder="Telefoonnummer">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <p>al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal"
                                                       class="hvr-float-shadow">Login</a></p>
                        <button class="form-control btn orange" style="color: white;" type="submit" value="submit">
                            Registeren
                        </button>
                    </form>
                </div>
                <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

<?PHP
include_once "footer.php";
// include_once "sideshoppinglist.php";
?>
