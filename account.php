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

    $id = htmlspecialchars($_SESSION['account_id']);

    try {
        $account = new Account($DB_con, $id);

    } catch (Exception $e) {
        echo "Het volgende is foutgegaan bij het ophalen van gegevens van het account: " . $e->getMessage();
    }
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

            <form name="theform" method="post" role="form" action="account.php">
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin"
                                       class="input-group-addon orange glyphicon glyphicon-comment"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="email"
                                       value="<?php echo $account->getUseremail() ?>">

                            </div>
                        </div>

                        <!-- /.form-group -->

                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="wachtwoord1"
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
                                       value="<?php echo $account->getUserfirstname() ?>">
                                <input type="text" onKeyup="checkform()" class="form-control" name="lastname"
                                       value="<?php echo $account->getUserlastname() ?>">
                            </div>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group bord">
                            <div class="input-group">
                                <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-home"></label>
                                <input type="text" onKeyup="checkform()" class="form-control" name="street"
                                       value="<?php echo $account->getUserstreetname() ?>" style="width: 70%;">


                                <input type="text" onKeyup="checkform()" class="form-control" name="number"
                                       value="<?php echo $account->getUserhousenumber() ?>" style="width: 30%;">

                                <input type="text" onKeyup="checkform()" class="form-control" name="userToevoeging"
                                       value="<?php echo $account->getUseraddition()?>">
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
                                       value="<?php echo $account->getUserphonenumber() ?>">
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

?>

<script>
    $(document).ready(function () {
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-trigger span").click(function () {
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                $(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                $(this).addClass("open");
            }
        });

        $('#bewerkenaccountmodal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var productid = button.data('productid') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


            // Ajax thingie:
            var postData = {
                'productid': productid
            };

            var url = "account_ophalen.php";

            var modal = $(this);


            $.ajax({
                type: "POST",
                url: url,
                data: postData,
                dataType: "json",
                success: function (data) {
                    //console.log(data.omschrijving);
                    modal.find('.modal-title').text('Bewerken van account:');
                    modal.find('#nummer').val(data.productNummer);
                    modal.find('#omschrijving').val(data.productOmschrijving);
                    modal.find('#naam').val(data.productNaam);
                    modal.find('#cat').val(data.categorieID);
                    modal.find('#euro').val(data.euros);
                    modal.find('#cent').val(data.cents);
                    modal.find('#product_id').val(data.id);

                }
            });
        });

        $("#opslaanaccount").click(function () {
            productid = $("#product_id").val();
            productNummer = $("#nummer").val();
            productOmschrijving = $("#omschrijving").val();
            productNaam = $("#naam").val();
            catID = $("#cat").val();
            euros = $("#euro").val();
            prijs = $("#prijs").val();
            cents = $("#cent").val();

            var postData = {
                'prodid': productid,
                'prodnr': productNummer,
                'proddescription': productOmschrijving,
                'prodname': productNaam,
                'catid': catID,
                'euros': euros,
                'cents': cents
            };

            var url = "account_opslaan.php";
            $.ajax({
                type: "POST",
                url: url,
                data: postData,
                dataType: "text",
                success: function (data) {

                    $("#nummer" + productid).html(productNummer);
                    $("#naam" + productid).html(productNaam);
                    $("#omschrijving" + productid).html(productOmschrijving);
                    fullprice = "&#8364; "+euros+","+cents;
                    $("#price" + productid).html(fullprice);

                    // fade out, hier onder:
                    $("#tr" + productid).addClass("success")
                    setTimeout(function () {
                        $("#tr" + productid).removeClass('success');
                    }, 4000)

                    $('#bewerkenaccountmodal').modal('hide');

                }
            });

        })
    });
</script>