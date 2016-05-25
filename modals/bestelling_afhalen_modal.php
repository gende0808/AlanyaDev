<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";
?>

<div class="container">
    <div class="row">
<div class="col-md-8 col-md-offset-2" id="test" style="display: none">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <h1>Controleer uw gegevens</h1>
                <form name="theform2" method="post" role="form" action="checkout.php">
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-user"></label>
                                        <div class="field2">
                                        <input id="fname2" type="text" onKeyup="checkform()" class="form-control"
                                               name="fname"
                                               placeholder="Voornaam"
                                               style="border-style: outset!important; border-width: 1px;"
                                               value="<?PHP
                                               if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
                                                   echo $_SESSION['user_info']['userVoornaam'];
                                               }
                                               ?>">
                                            </div>
                                        <div class="field2">
                                        <input id="lname2" type="text" onKeyup="checkform()" class="form-control"
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
                                    <div class="field2">
                                        <input id="phone2" type="text" onKeyup="checkform()" class="form-control"
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
                            <div class="action">
                                <button id="submit2" name="registerbutton" class="form-control btn orange"
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


<script type="text/javascript">
    $(document).ready(function()
    {
        if ($('#fname2').val() == '' || $('#lname2').val() == '' || $('#phone2').val() == '') {
            $('#submit2').prop('disabled', true);
        } else {
            $('#submit2').prop('disabled', false);
        }
        $('.field2').on('keyup change', function(){
            if ($('#fname2').val() == '' || $('#lname2').val() == '' || $('#phone2').val() == '') {
                $('#submit2').prop('disabled', true);
            } else {
                $('#submit2').prop('disabled', false);
            }
        });
    });
</script>

