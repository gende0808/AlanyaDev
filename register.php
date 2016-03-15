<?PHP
session_start();
include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>
<div class="logo">
    <hr>
    <center><img src="images/testlogo2.png"></center>
</div>

<div class="col-md-4 col-md-offset-4">
<div class="modal-dialog text-center">
    <br>
        <div class="modal-content text-center">

                <div class="panel-heading">
                    <?PHP
                    $subject = "Alanya Registratie";


                    if(!empty($_POST)) {
                        try {
                            $account = new Account($DB_con);
                            $account->setUseremail(htmlspecialchars($_POST['email']));
                            $account->setUserfirstname(htmlspecialchars($_POST['firstname']));
                            $account->setUserlastname(htmlspecialchars($_POST['lastname']));
                            $account->setUsercityid(htmlspecialchars($_POST['city']));
                            $account->setUserpassword(htmlspecialchars($_POST['wachtwoord1']));
                            $account->setUserstreetname(htmlspecialchars($_POST['street']));
                            $account->setUserhousenumber(htmlspecialchars($_POST['number']));
                            $account->setUserphonenumber(htmlspecialchars($_POST['phone']));
                            $account->setstatus("N");
                            $account->setToken();
                            $account->create();

                            $tempemail = $account->getUseremail();
                            try {
                                $query = $DB_con->prepare("SELECT userID FROM account WHERE userEmail= :mailadres");
                                $query->bindParam(':mailadres', $tempemail);
                                $query->execute();
                                $resultaat = $query->fetch(PDO::FETCH_ASSOC);
                                $gebruikersID = $resultaat['userID'];
                            } catch (PDOException $e) {
                                echo "Database-error: " . $e->getMessage();
                            }

                            $message = "
						Hallo ".$account->getUserfullname().",
						<br /><br />
						Welkom bij Alanya-Krommenie!<br/>
						To complete your registration  please , just click following link<br/>
						<br /><br />
						<a href='http://localhost/alanyaDev/verify.php?id=".$gebruikersID."&code=".$account->getToken()."'>Click HERE to Activate :)</a>
						<br /><br />
						Thanks,";

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
                            $mail->SetFrom('your_gmail_id_here@gmail.com', 'Coding Cage');
                            $mail->AddReplyTo("your_gmail_id_here@gmail.com", "Coding Cage");
                            $mail->Subject = $subject;
                            $mail->MsgHTML($message);
                            $mail->Send();

    } catch(Exception $e){

                            echo $e->getMessage();
                        }


                    }
                    ?>


                </div>

            <div class="modal-header">


                <h4 class="modal-title" id="myModalLabel">Registreer</h4>
            </div>
            <!-- /.modal-header -->

            <form name="theform" method="post" role="form" action="register.php" >
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="email" placeholder="E-mail" style="border:1px solid lightgrey;">

                            </div>
                        </div>

                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="password" onKeyup="checkform()" class="form-control" name="wachtwoord1" id="wachtwoord1"
                                       placeholder="Wachtwoord">
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="password" onkeyup="checkform(); checkPass(); return false;"  class="form-control" name="wachtwoord2" id="wachtwoord2"
                                       placeholder="verifieer Wachtwoord">
                                <span id="confirmMessage" class="confirmMessage"></span>
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="firstname" placeholder="Voornaam"
                                       style="width: 50%;">

                                <input type="text" onKeyup="checkform()" class="form-control" name="lastname" placeholder="Achternaam."
                                       style="width: 50%;">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-home"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="street" placeholder="Straatnaam"
                                       style="width: 70%;">

                                <input type="text" onKeyup="checkform()" class="form-control" name="number" placeholder="Nr."
                                       style="width: 30%;">
                            </div>
                        </div>
                        <!-- /.form-group -->


<!--                        <div class="form-group">-->
<!--                            <div class="input-group">-->
<!--                                <label for="uLogin"-->
<!--                                       class="input-group-addon orange glyphicon glyphicon-map-marker"></label>-->
<!--                                <select class="form-control" name="city">-->
<!--                                    <option value="" selected disabled><b>Woonplaats</b></option>-->
<!--                                    --><?PHP
//                                    $listofcities = (new CityList($DB_con))->getlistofcities();
//                                    foreach($listofcities as $city){
//                                        echo "<option value='".$city->getCityid()."'>".$city->getCityname()."</option>";
//                                    }
//                                    ?>
<!---->
<!--                                </select>-->
<!--                            </div>-->
<!--                        </div>-->
                        <!-- /.form-group -->
                        <p style="font-family: 'Open Sans', sans-serif">helaas bezorgen wij niet buiten de weergegeve steden.</p>

                        <div class="form-group">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="phone"  placeholder="Telefoonnummer">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <p>al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal"
                                                       class="hvr-float-shadow">Login</a></p>

                        <button class="form-control btn orange" id="test" style="color: white;" type="submit" value="submit" disabled="false">
                            Registeren
                        </button>
                    </form>
                </div>

                <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
</div>
<?PHP
include_once "footer.php";
// include_once "sideshoppinglist.php";
?>

<script type="text/javascript" language="javascript">
    function checkform()
    {
        var f = document.forms["theform"].elements;
        var cansubmit = true;

        for (var i = 0; i < f.length; i++) {
            if (f[i].value.length == 0) cansubmit = false;
        }

        document.getElementById('test').disabled = !cansubmit;
    }
</script>