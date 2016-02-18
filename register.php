<?PHP
include_once "header.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "connection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!empty($_POST))
{
    $account = new Account($DB_con);

    ?>
    <div class="modal-dialog" style="width: 30%;">
        <img src="images/testlogo2.png" style="width: 100%;">

        <div class="modal-content">
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
                                <?PHP

                                try {
                                    $account->setUseremail(htmlspecialchars($_POST['email']));
                                } catch(Exception $e){
                                    echo '&#8226; '.$e->getMessage(); //message rood en/of bold maken?
                                }

                                ?>
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="password" class="form-control" name="password" placeholder="Wachtwoord">
                            <?PHP

                            try {
                                $account->setUserpassword(htmlspecialchars($_POST['password']));
                            } catch(Exception $e){
                                echo '&#8226; '.$e->getMessage(); //message rood en/of bold maken?
                            }

                            ?>
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
                                <?PHP
                                try {
                                    $account->setUserstreetname(htmlspecialchars($_POST['street']));
                                } catch(Exception $e){
                                    echo '&#8226; '.$e->getMessage().'<br>'; //message rood en/of bold maken?
                                }
                                try {
                                    $account->setUserhousenumber(htmlspecialchars($_POST['number']));
                                } catch(Exception $e){
                                    echo '&#8226; '.$e->getMessage(); //message rood en/of bold maken?
                                }

                                ?>
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
                                <?PHP

                                try {
                                    $account->setUserphonenumber(htmlspecialchars($_POST['phone']));
                                } catch(Exception $e){
                                    echo '&#8226; '.$e->getMessage(); //message rood en/of bold maken?
                                }

                                ?>
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

} else {

    ?>


    <div class="modal-dialog" style="width: 30%;">
        <img src="images/testlogo2.png" style="width: 100%;">

        <div class="modal-content">
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
                                <input type="password" class="form-control" name="password"
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
} // sluit else statement als er nog geen invoer is geweest!

include_once "footer.php";
// include_once "sideshoppinglist.php";
?>
