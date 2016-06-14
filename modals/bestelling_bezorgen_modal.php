<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";
?>

<div class="container">
    <div class="row">
        <button id="bezorgen" class="btn btn-default btn-lg col-md-3 col-md-offset-3 col-xs-3 col-xs-offset-2" data-toggle="modal"
                data-target="#prodactie"> Bestelling laten bezorgen
        </button>
        <button id="ophalen" class="btn btn-default btn-lg col-md-3 "  data-toggle="modal"
                data-target="#prodactie"> Bestelling ophalen
        </button>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h1>Controleer uw gegevens</h1>
                        <form name="theform" method="post" role="form" action="checkout.php">
                            <div class="modal-body">
                                <form role="form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-user"></label>
                                            <div class="field">
                                                <input id="fname" type="text" onKeyup="checkform()" class="form-control"
                                                       name="fname"
                                                       placeholder="Voornaam"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?PHP
                                                       if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                           echo $_SESSION['user_info']['userVoornaam'];
                                                       }
                                                       ?>">
                                            </div>
                                            <div class="field">
                                                <input id="lname" type="text" onKeyup="checkform()" class="form-control"
                                                       name="lname"
                                                       placeholder="Achternaam"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?PHP
                                                       if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                           echo $_SESSION['user_info']['userAchternaam'];
                                                       }
                                                       ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                            <div class="field">
                                                <input id="phone" type="text" onKeyup="checkform()" class="form-control"
                                                       name="phone" placeholder="Telefoonnummer"
                                                       style="border-style: outset!important; border-width: 1px;"
                                                       value="<?PHP
                                                       if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                           echo $_SESSION['user_info']['userTelefoonnummer'];
                                                       }
                                                       ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.form-group -->

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-home"></label>
                                                <div class="field">
                                                <input id="streetn" type="text" onKeyup="checkform()" class="form-control"
                                                       name="streetn"
                                                       placeholder="Straatnaam"
                                                       style="width: 70%; border-style: outset!important; border-width: 1px;"
                                                       value="<?PHP
                                                       if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                           echo $_SESSION['user_info']['userStraatnaam'];
                                                       }
                                                       ?>">
                                                </div>
                                                <div class="field">
                                                <input id="housen" type="text" onKeyup="checkform()" class="form-control"
                                                       name="housen"
                                                       placeholder="Nr."
                                                       style="width: 30%; border-style: outset!important; border-width: 1px;"
                                                       value="<?PHP
                                                       if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                           echo $_SESSION['user_info']['userHuisnummer'];
                                                       }
                                                       ?>">
                                                </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                                            <div class="field">
                                            <select class="form-control" name="cityid" id="cityid">
                                                <option value=""><b>Woonplaats</b></option>
                                                <?PHP
                                                $listofcities = (new CityList($DB_con))->getlistofcities();
                                                foreach ($listofcities as $city) {
                                                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
                                                        if ($city->getCityid() == $_SESSION['user_info']['userPlaatsID']) {
                                                            echo "<option value='" . $_SESSION['user_info']['userPlaatsID'] . "'selected>" . $city->getCityname() . "</option>";
                                                        }
                                                        else {
                                                            echo "<option value='" . $city->getCityid() . "'>" . $city->getCityname() . "</option>";
                                                        }}
                                                    else {
                                                        echo "<option value='" . $city->getCityid() . "'>" . $city->getCityname() . "</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                                </div>
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
                                                       name="partic"
                                                       placeholder="Hier kunt u eventuele bijzonderheden doorgeven..."
                                                       style="border-style: outset!important; border-width: 1px;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->

                                    <p>Al een bestaand account? <a href="#" data-toggle="modal" data-target="#myModal"
                                                                   class="hvr-float-shadow">Login</a></p>
                                    <br>
                                    <div class="alert-danger">
                                    <p style="color: darkred;"><b>Let op! De bestelling wordt altijd tussen 30 en 45 minuten bezorgd, het is dus niet mogelijk om voor een later tijdstip te kiezen.</b></p>
                                    </div><br>
                                    <div class="actions">
                                        <button id="submit" name="registerbutton" class="form-control btn orange"
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
<script type="text/javascript">
    $(document).ready(function()
    {
        if ($('#fname').val() == '' || $('#lname').val() == '' || $('#phone').val() == '' || $('#streetn').val() == '' || $('#housen').val() == ''|| $('#cityid').val() == '') {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }
        $('.field').on('keyup change', function(){
            if ($('#fname').val() == '' || $('#lname').val() == '' || $('#phone').val() == '' || $('#streetn').val() == '' || $('#housen').val() == ''|| $('#cityid').val() == '') {
                $('#submit').prop('disabled', true);
            } else {
                $('#submit').prop('disabled', false);
            }
        });
    });
</script>