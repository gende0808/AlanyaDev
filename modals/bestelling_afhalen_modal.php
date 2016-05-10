<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#bezorgen").click(function () {
                $("#istop").show();
                $("#test").hide();
//                $("#klant").show();
//                $("#mand").show();
//                $("#strand").show();
//                $("#want").show();
            });
            $("#ophalen").click(function () {
                $("#test").show();
                $("#istop").hide();
//                $("#klant").hide();
//                $("#mand").hide();
//                $("#strand").hide();
//                $("#want").hide();
            });
        });
    </script>
</head>

<div class="container">
    <div class="row">
        <button id="bezorgen" class="btn btn-default btn-lg col-md-3 col-md-offset-1" data-toggle="modal"
                data-target="#prodactie"
                style="margin-top: 25px;margin-left: 210px"> Bestelling laten bezorgen
        </button>
        <button id="ophalen" class="btn btn-default btn-lg col-md-3 col-md-offset-1" data-toggle="modal"
                data-target="#prodactie"
                style="margin-top: 25px;margin-left: 0px"> Bestelling ophalen
        </button>
        <div class="col-md-8 col-md-offset-2" id="istop">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h1>Controleer uw gegevens</h1>
                        <form name="theform" method="post" role="form" action="register.php">
                            <div class="modal-body">
                                <form role="form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-user"></label>
                                            <div class="text-field">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="firstname"
                                                       placeholder="Voornaam"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["firstname"])) {
                                                           echo(htmlspecialchars($_POST['firstname']));
                                                       }; ?>">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="lastname"
                                                       placeholder="Achternaam"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["lastname"])) {
                                                           echo(htmlspecialchars($_POST['lastname']));
                                                       }; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                            <div class="text-field">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="phone" placeholder="Telefoonnummer"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["phone"])) {
                                                           echo(htmlspecialchars($_POST['phone']));
                                                       }; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                            <div class="text-field">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="email"
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
                                        <div class="input-group" id="klant">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-home"></label>
                                            <div class="text-field">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="street"
                                                       placeholder="Straatnaam"
                                                       style="width: 70%; border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["street"])) {
                                                           echo(htmlspecialchars($_POST['street']));
                                                       }; ?>">

                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="number"
                                                       placeholder="Nr."
                                                       style="width: 30%; border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["number"])) {
                                                           echo(htmlspecialchars($_POST['number']));
                                                       }; ?>">
                                            </div>
                                            <input type="text" onKeyup="checkform()" class="form-control"
                                                   name="userToevoeging"
                                                   placeholder="Toevoeging adres"
                                                   style="border-style: outset!important; border-width: 1px;"
                                                   value="<?php if (isset($_POST["userToevoeging"])) {
                                                       echo(htmlspecialchars($_POST['userToevoeging']));
                                                   }; ?>"
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <div class="input-group" id="mand">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                                            <select class="form-control" name="city" id="city">
                                                <option value="" selected disabled><b>Woonplaats</b></option>
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
                                    <!-- /.form-group -->
                                    <p id="strand" style="font-family: 'Open Sans', sans-serif">Helaas bezorgen wij niet
                                        buiten de
                                        weergegeven
                                        steden.</p>
                                    <div class="form-group">
                                        <div class="input-group" id="want">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-plus-sign"></label>
                                            <div class="text-field">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="addressadding"
                                                       placeholder="Hier kunt u eventuele bijzonderheden doorgeven..."
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["phone"])) {
                                                           echo(htmlspecialchars($_POST['phone']));
                                                       }; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <p>Al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal"
                                                                   class="hvr-float-shadow">Login</a></p>
                                    <div class="actions">
                                        <button name="registerbutton" class="form-control btn orange"
                                                style="color: white;"
                                                type="submit" disabled="disabled">
                                            Bestelling plaatsen
                                        </button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-8 col-md-offset-2" id="test" style="display: none">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h1>Controleer uw gegevens</h1>
                        <form name="theform" method="post" role="form" action="register.php">
                            <div class="modal-body">
                                <form role="form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-user"></label>
                                            <div class="text-field1">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="firstname"
                                                       placeholder="Voornaam"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["firstname"])) {
                                                           echo(htmlspecialchars($_POST['firstname']));
                                                       }; ?>">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="lastname"
                                                       placeholder="Achternaam"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["lastname"])) {
                                                           echo(htmlspecialchars($_POST['lastname']));
                                                       }; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                            <div class="text-field1">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="phone" placeholder="Telefoonnummer"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["phone"])) {
                                                           echo(htmlspecialchars($_POST['phone']));
                                                       }; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                            <div class="text-field1">
                                                <input type="text" onKeyup="checkform()" class="form-control"
                                                       name="email"
                                                       placeholder="E-mail"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?php if (isset($_POST["email"])) {
                                                           echo(htmlspecialchars($_POST['email']));
                                                       }; ?>">
                                            </div>
                                        </div>
                                    </div>



                                    <p>Al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal"
                                                                   class="hvr-float-shadow">Login</a></p>
                                    <div class="action">
                                        <button name="registerbutton" class="form-control btn orange"
                                                style="color: white;"
                                                type="submit" disabled="disabled">
                                            Bestelling plaatsen
                                        </button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





<script type="text/javascript">
    $(document).ready(function () {
        $('.text-field input').keyup(function () {

            var empty = false;
            $('.text-field input').each(function () {
                if ($(this).val().length == 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.actions button').attr('disabled', 'disabled');
            } else {
                $('.actions button').attr('disabled', false);
            }
        });
    });
    $(document).ready(function () {
        $('.text-field1 input').keyup(function () {

            var empty = false;
            $('.text-field1 input').each(function () {
                if ($(this).val().length == 0) {
                    empty = true;
                }
            });

            if (empty) {
                $('.action button').attr('disabled', 'disabled');
            } else {
                $('.action button').attr('disabled', false);
            }
        });
    });
</script>
