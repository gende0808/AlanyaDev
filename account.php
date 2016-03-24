<?PHP
session_start();
include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/AccountList.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



    $iets = new AccountList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt


    echo '<div class="col-md-12 col-md-offset-0 text-center">';
    foreach ($iets->getlistofaccounts() as $mand) { //hij haalt alle categoriën op in een array.
       
    }
echo $mand->getUseremail();
    echo '</div>';



?>
<div class="logo text-center">
    <img src="images/testlogo2.png">
</div>

<div class="col-md-4 col-md-offset-4">
    <div class="modal-dialog text-center">
        <br>

        <div class="modal-content text-center">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Mijn Profiel</h4>
            </div>
            <!-- /.modal-header -->

            <form name="theform" method="post" role="form" action="register.php">
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="email"
                                       placeholder="E-mail">

                            </div>
                        </div>

                        <!-- /.form-group -->

                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="password" onKeyup="checkform()" class="form-control" name="wachtwoord1"
                                       id="wachtwoord1"
                                       placeholder="Huidig wachtwoord">
                                <input type="password" onkeyup="checkform(); checkPass(); return false;"
                                       class="form-control" name="wachtwoord2" id="wachtwoord2"
                                       placeholder="Nieuw wachtwoord">
                                <input type="password" onkeyup="checkform(); checkPass(); return false;"
                                       class="form-control" name="wachtwoord2" id="wachtwoord3"
                                       placeholder="verifieer nieuw wachtwoord">
                                <span id="confirmMessage" class="confirmMessage"></span>
                            </div>
                        </div>

                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="firstname"
                                       placeholder="Voornaam">
                                <input type="text" onKeyup="checkform()" class="form-control" name="lastname"
                                       placeholder="Achternaam">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-home"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="street"
                                       placeholder="Straatnaam"
                                       style="width: 70%;">

                                <input type="text" onKeyup="checkform()" class="form-control" name="number"
                                       placeholder="Nr."
                                       style="width: 30%;">
                                <input type="text" onKeyup="checkform()" class="form-control" name="userToevoeging"
                                       placeholder="Toevoeging adres">
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <br>


                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                                <select class="form-control" name="city">
                                    <option value="" selected disabled><b>Woonplaats</b></option>
                                    <?PHP
                                    $listofcities = (new CityList($DB_con))->getlistofcities();
                                    foreach ($listofcities as $city) {
                                        echo "<option value='" . $city->getCityid() . "'>" . $city->getCityname() . "</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="phone"
                                       placeholder="Telefoonnummer">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <button class="form-control btn orange" id="test" style="color: white;" type="submit"
                                value="submit">
                            Wijzigen opslaan
                        </button>
                    </form>
                </div>

                <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>