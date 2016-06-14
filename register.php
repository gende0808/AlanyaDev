<?PHP
session_start();
if (isset($_SESSION['logged'])) {
    header('location: index.php');
}

include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/AccountList.php";

$accountcreated = null;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["registerbutton"])) {
    $hidden = "test";
    $registreer = "";
} else {
    $hidden = "hidden";
    $registreer = "Registreren";
}
?>
<div class="logo text-center">
    <img src="images/testlogo3.png">
</div>

<div class="col-md-4 col-md-offset-4">
    <div class="modal-dialog text-center">
        <br>

        <div class="modal-content text-center">

            <div class="panel-heading">
                <?PHP
                $subject = "Alanya Registratie";
                $emailalreadyexists = false;

                //als er geen post is meegegeven probeert hij geen account aan te maken.
                if (!empty($_POST)) {


                    try {
                        //hij maakt hieronder een lijst van accounts aan om te vergelijken met het ingevoerde email adres.
                        //als het email adres true is gaat hij niet proberen de account aan te maken. Dan bestaat de email al.
                        $listofaccounts = (new AccountList($DB_con))->getlistofaccounts();
                        foreach ($listofaccounts as $acc) {
                            if ($_POST['email'] === $acc->getUseremail()) {
                                echo '
                                         <div class="modal-header">
                                             <div id="testje" class="<?php echo $hidden ?>">
                                                 <div class="alert alert-danger" role="alert">
                                                  <p><h2><b>Het registreren is mislukt!</b></h2></p>
                                                  <p><h4><i>Dit E-mail adres is al in gebruik.</i></h4></p>
                                                 </div>
                                             </div>
                                         </div>
                ';
                                $emailalreadyexists = true;
                            }
                        }
                    } catch (Exception $e) {
                        echo "er ging iets fout bij het controleren van emailadressen";
                    }

                    if (!$emailalreadyexists) {

                        try {
                            //als het emailadres niet al bestaat gaat hij hieronder proberen een account aan te maken.
                            $account = new Account($DB_con);
                            $account->setUseremail(strtolower(htmlspecialchars($_POST['email'])));
                            $account->setUserfirstname(htmlspecialchars($_POST['firstname']));
                            $account->setUserlastname(htmlspecialchars($_POST['lastname']));
                            $account->setUsercityid(htmlspecialchars($_POST['city']));
                            $account->setUserpassword(htmlspecialchars($_POST['wachtwoord1']));
                            $account->setUserstreetname(htmlspecialchars($_POST['street']));
                            $account->setUserhousenumber(htmlspecialchars($_POST['number']));
                            $account->setUserphonenumber(htmlspecialchars($_POST['phone']));
                            //status is standaard "N", word op "Y" gezet als de verificatie gelukt is.
                            $account->setstatus("N");
                            //onderstaande functie maakt een "token" aan voor de verificatielink.
                            $account->setToken();
                            $account->create();
                            $tempemail = $account->getUseremail();
                            $query = $DB_con->prepare("SELECT userID FROM account WHERE userEmail= :mailadres");
                            $query->bindParam(':mailadres', $tempemail);
                            $query->execute();
                            $resultaat = $query->fetch(PDO::FETCH_ASSOC);
                            $gebruikersID = $resultaat['userID'];
                            $accountcreated = true;

                        } catch
                        (Exception $e) {
                            $accountcreated = false;
                            if ($accountcreated === false) {
                                ?>
                                <div class="modal-header">
                                    <div id="testje" class="<?php echo $hidden ?>">
                                        <div class="alert alert-danger" role="alert">
                                            <p>
                                            <h2><b>Het registreren is mislukt!</b></h2></p>
                                            <p><h4><i>
                                                    <?PHP echo $e->getMessage(); ?>
                                                </i></h4></p>
                                        </div>
                                    </div>
                                </div>
                                <?PHP
                            }

                        }
                        $test1 = false;
                        if ($accountcreated === true or $test1 === true) {
                            $message = "
						Beste " . $account->getUserfullname() . ",
						<br /><br />
						Welkom bij Alanya-Krommenie!<br/>
						Om je registratie op www.alanya-krommenie.nl af te ronden kun je op de onderstaande link klikken.<br/>
						<br /><br />
						<a href='http://localhost/alanyaDev/verify.php?id=" . $gebruikersID . "&code="
                                . $account->getToken() . "'>klik hier om te activeren</a>
						<br /><br />
						Met vriendelijke Groet,<br /><br />

						Alanya Krommenie";
                            //hieronder is de mailer die gebruik maakt van de PHPMailer Class.
                            try {
                                require_once('mailer/class.phpmailer.php');
                                $mail = new PHPMailer();
                                $mail->IsSMTP();
                                $mail->SMTPDebug = 0;
                                $mail->SMTPAuth = true;
                                $mail->SMTPSecure = "ssl";
                                $mail->Host = "smtp.gmail.com";
                                $mail->Port = 465;
                                $mail->AddAddress($account->getUseremail());
                                $mail->Username = "alanyatester@gmail.com";
                                $mail->Password = "alanyatest";
                                $mail->SetFrom('your_gmail_id_here@gmail.com', 'Alanya Krommenie');
                                $mail->AddReplyTo("your_gmail_id_here@gmail.com", "Alanya Krommenie");
                                $mail->Subject = $subject;
                                $mail->MsgHTML($message);
                                $mail->Send();
                            } catch (Exception $e) {
                                echo "Er ging iets fout  bij het versturen van de email.";
                            }
                        }
                    } else {
                        //TODO als email al bestaat geef foutmelding dat email al in gebruik is
                    }
                }

                ?>
            </div>
            <?PHP
            if ($accountcreated === true) {
                echo '
            <div class="modal-header">
                <div id="testje" >
                    <div class="alert alert-success" role="alert">
                        <p><h2><b>Bedankt voor het registreren!</b></h2></p>
                        <p><h4><i>U dient uw account te activeren door op de link te klikken die naar uw E-mail adres verzonden is.</i></h4></p>
                    </div>
                </div>
                </div>
                ';
            }



            ?>


            <!-- /.modal-header -->

            <form name="theform" method="post" role="form" action="register.php">
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                <div class="field text-field">
                                    <input id="email" type="text" onKeyup="checkform()" class="form-control" name="email"
                                           placeholder="E-mail"
                                           style="border-style: outset!important; border-width: 1px;"
                                           value="<?php if (isset($_POST["email"])) {
                                               echo(htmlspecialchars($_POST['email']));
                                           }; ?>">
                                </div>
                            </div>
                        </div>

                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"
                                       style="border-style: solid!important; border-width: 1px;"></label>
                                <div class="field text-field">
                                    <input type="password" class="form-control" name="wachtwoord1"
                                           id="wachtwoord1"
                                           placeholder="Wachtwoord"
                                           style="border-style: outset!important; border-width: 1px;">
                                    <input type="password" onkeyup="checkPass(); return false;"
                                           class="form-control" name="wachtwoord2" id="wachtwoord2"
                                           placeholder="verifieer Wachtwoord"
                                           style="border-style: outset!important; border-width: 1px;">
                                    <span id="confirmMessage" class="confirmMessage"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                                <div class="field text-field">
                                    <input id="fname" type="text" onKeyup="checkform()" class="form-control" name="firstname"
                                           placeholder="Voornaam"
                                           style="border-style: outset!important; border-width: 1px;"
                                           value="<?php if (isset($_POST["firstname"])) {
                                               echo(htmlspecialchars($_POST['firstname']));
                                           }; ?>">
                                    <input id="lname" type="text" onKeyup="checkform()" class="form-control" name="lastname"
                                           placeholder="Achternaam"
                                           style="border-style: outset!important; border-width: 1px;"
                                           value="<?php if (isset($_POST["lastname"])) {
                                               echo(htmlspecialchars($_POST['lastname']));
                                           }; ?>">
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-home"></label>
                                <div class="field text-field">
                                    <input id="streetn" type="text" onKeyup="checkform()" class="form-control" name="street"
                                           placeholder="Straatnaam"
                                           style="width: 70%; border-style: outset!important; border-width: 1px;"
                                           value="<?php if (isset($_POST["street"])) {
                                               echo(htmlspecialchars($_POST['street']));
                                           }; ?>">

                                    <input id="housen" type="text" onKeyup="checkform()" class="form-control" name="number"
                                           placeholder="Nr."
                                           style="width: 30%; border-style: outset!important; border-width: 1px;"
                                           value="<?php if (isset($_POST["number"])) {
                                               echo(htmlspecialchars($_POST['number']));
                                           }; ?>">
                                </div>
                                <input type="text" onKeyup="checkform()" class="form-control" name="userToevoeging"
                                       placeholder="Toevoeging adres"
                                       style="border-style: outset!important; border-width: 1px;"
                                       value="<?php if (isset($_POST["userToevoeging"])) {
                                           echo(htmlspecialchars($_POST['userToevoeging']));
                                       }; ?>"
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <br>
                        <div class="field">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                                <select class="form-control" name="city" id="cityid">
                                    <option value=""><b>Woonplaats</b></option>
                                    <?PHP
                                    $listofcities = (new CityList($DB_con))->getlistofcities();
                                    foreach ($listofcities as $city) {
                                        echo "<option value='" . $city->getCityid() . "'>" . $city->getCityname() . "</option>";
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        document.getElementById('city').value = "<?php echo $_POST['city'];?>";
                                    </script>

                                </select>
                            </div>
                        </div>
                </div>
                        <!-- /.form-group -->
                        <p style="font-family: 'Open Sans', sans-serif">helaas bezorgen wij niet buiten de weergegeven
                            woonplaatsen.</p>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                <div class="field field text-field">
                                    <input id="phone" type="text" onKeyup="checkform()" class="form-control" name="phone"
                                           placeholder="Telefoonnummer"
                                           style="border-style: outset!important; border-width: 1px;"
                                           value="<?php if (isset($_POST["phone"])) {
                                               echo(htmlspecialchars($_POST['phone']));
                                           }; ?>">
                                </div>
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <p>al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal"
                                                       class="hvr-float-shadow">Login</a></p>
                        <div class="actions">
                            <button name="registerbutton" class="form-control btn orange" id="submit"
                                    style="color: white;"
                                    type="submit">
                                Registeren
                            </button>
                        </div>
                    </form>
                </div>

                <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>
</div>

<?PHP
include_once "footer.php";
?>

<script type="text/javascript">
    $(document).ready(function()
    {
        if ($('#fname').val() == '' || $('#lname').val() == '' || $('#email').val() == '' || $('#phone').val() == '' || $('#wachtwoord1').val() == '' || $('#wachtwoord2').val() == '' || $('#streetn').val() == '' || $('#housen').val() == ''|| $('#cityid').val() == '') {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }
        $('.field').on('keyup change', function(){
            if ($('#fname').val() == '' || $('#lname').val() == '' || $('#phone').val() == ''|| $('#email').val() == '' || $('#wachtwoord1').val() == '' || $('#wachtwoord2').val() == '' || $('#streetn').val() == '' || $('#housen').val() == ''|| $('#cityid').val() == '') {
                $('#submit').prop('disabled', true);
            } else {
                $('#submit').prop('disabled', false);
            }
        });
    });
</script>