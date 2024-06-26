<?PHP
ob_start();
include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "modals/verwijder_account_modal.php";

if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    if ($_SESSION['user_info']['userLevel'] == '1' || $_SESSION['user_info']['userLevel'] == '3') {
        $id = htmlspecialchars($_SESSION['account_id']);
    } else {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}

function accountcheck($DB_con, $id)
{
    if ($_POST) {
        try {
            $account = new Account($DB_con, $id);

            if (isset($_POST['voornaam'])) {
                $accountvoornaam = htmlspecialchars($_POST['voornaam']);
                $account->setUserfirstname($accountvoornaam);
            }
            if (isset($_POST['achternaam'])) {
                $accountachternaam = htmlspecialchars($_POST['achternaam']);
                $account->setUserlastname($accountachternaam);
            }
            if (isset($_POST['straatnaam'])) {
                $accountstraatnaam = htmlspecialchars($_POST['straatnaam']);
                $account->setUserstreetname($accountstraatnaam);
            }
            if (isset($_POST['huisnummer'])) {
                $accounthuisnummer = htmlspecialchars($_POST['huisnummer']);
                $account->setUserhousenumber($accounthuisnummer);
            }
            if (isset($_POST['toevoeging'])) {
                $accounttoevoeging = htmlspecialchars($_POST['toevoeging']);
                $account->setUseraddition($accounttoevoeging);
            }
            if (isset($_POST['plaats'])) {
                $accountplaats = htmlspecialchars($_POST['plaats']);
                $account->setUsercityid($accountplaats);
            }
            if (isset($_POST['telefoonnummer'])) {
                $accounttelefoonnummer = htmlspecialchars($_POST['telefoonnummer']);
                $account->setUserphonenumber($accounttelefoonnummer);
            }
            if (!empty($_POST['oldpassword']) && !empty($_POST['accwachtwoord1'] && !empty($_POST['accwachtwoord2']))) {
                $accww1 = htmlspecialchars($_POST['accwachtwoord1']);
                $accww2 = htmlspecialchars($_POST['accwachtwoord2']);
                $oldpassword = htmlspecialchars($_POST['oldpassword']);
                if ($accww1 == $accww2) {
                    if (password_verify($oldpassword, $account->getUserpassword())) {
                        $account->setUserpassword($accww1);
                    }
                } else {
                    throw new InvalidArgumentException("wachtwoorden kwamen niet overeen");
                }
            }
            $account->update($id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

try {

    $account = new Account($DB_con, $id)

    ?>
    <div class="logo text-center">
        <img src="images/testlogo3.png">
    </div>


    <div class="col-md-4 col-md-offset-4">
        <div class="modal-dialog text-center">
            <br>

            <div class="modal-content text-center">

                <div class="modal-header">
                    <?PHP accountcheck($DB_con, $id) ?>
                    <h4 class="modal-title" id="myModalLabel">Mijn Profiel</h4>
                </div>
                <!-- /.modal-header -->

                <form name="login-form" method="post" role="form" action="account.php">
                    <div class="modal-body">
                        <form action="account.php" method="post" role="form">
                            <div class="form-group ">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-comment"></label>

                                    <p class="navbar-text"><?php echo $account->getUseremail() ?></p>

                                </div>
                            </div>

                            <!-- /.form-group -->

                            <div class="form-group ">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-lock"></label>
                                    <input type="password" onKeyup="checkform()" class="form-control" name="oldpassword"
                                           id="wachtwoordtest"
                                           placeholder="Huidig wachtwoord"
                                           style="border-style: outset!important; border-width: 1px;">
                                    <input type="password" onkeyup="checkform()"
                                           class="form-control" name="accwachtwoord1" id="accwachtwoord1"
                                           placeholder="Nieuw wachtwoord"
                                           style="border-style: outset!important; border-width: 1px;">
                                    <input type="password" onkeyup="checkform(); checkPassAcc(); return false;"
                                           class="form-control" name="accwachtwoord2" id="accwachtwoord2"
                                           placeholder="verifieer nieuw wachtwoord"
                                           style="border-style: outset!important; border-width: 1px;">
                                    <span id="accconfirmMessage" class="accconfirmMessage"></span>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-user"></label>
                                    <input type="text" onKeyup="checkform()" class="form-control" name="voornaam"
                                           id="voornaam"
                                           value="<?php echo $account->getUserfirstname() ?>"
                                           style="border-style: outset!important; border-width: 1px;">
                                    <input type="text" onKeyup="checkform()" class="form-control" name="achternaam"
                                           id="achternaam"
                                           value="<?php echo $account->getUserlastname() ?>"
                                           style="border-style: outset!important; border-width: 1px;">
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group ">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-home"></label>
                                    <input type="text" onKeyup="checkform()" class="form-control" name="straatnaam"
                                           id="straatnaam"
                                           value="<?php echo $account->getUserstreetname() ?>" style="width: 70%;"
                                           style="border-style: outset!important; border-width: 1px;">


                                    <input type="text" onKeyup="checkform()" class="form-control" name="huisnummer"
                                           id="huisnummer"
                                           value="<?php echo $account->getUserhousenumber() ?>" style="width: 30%;"
                                           style=" border-style: outset!important; border-width: 1px;">

                                    <input type="text" onKeyup="checkform()" class="form-control" name="toevoeging"
                                           id="toevoeging"
                                           value="<?php echo $account->getUseraddition() ?>"
                                           style="border-style: outset!important; border-width: 1px;">
                                </div>
                            </div>
                            <!-- /.form-group -->
                            <br>


                            <div class="form-group">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-map-marker"></label>
                                    <select class="form-control" name='plaats' id='plaats'>

                                        <?php

                                        try {
                                            $accountt = new Account($DB_con, $id);
                                            $listofcities = (new CityList($DB_con))->getlistofcities();
                                            foreach ($listofcities as $city) {
                                                if ($city->getCityid() == $accountt->getUsercityid()) {
                                                    echo "<option value='" . $city->getCityid() . "'selected>" . $city->getCityname() . "</option>";
                                                } else {
                                                    echo "<option value='" . $city->getCityid() . "'>" . $city->getCityname() . "</option>";
                                                }
                                            }
                                        } catch (Exception $e) {
                                          echo "Er is iets foutgegaan met de accountgegevens. Probeert u het lager nogmaals of neem contact op met de administrator.";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <div class="input-group">
                                    <label for="uLogin"
                                           class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                    <input type="text" onKeyup="checkform()" class="form-control" name="telefoonnummer"
                                           id="telefoonnummer"
                                           value="<?php echo $account->getUserphonenumber() ?>"
                                           style="border-style: outset!important; border-width: 1px;">
                                </div>
                            </div>
                            <!-- /.form-group -->

                            <button class="form-control btn orange" id="accountwijzigen" style="color: white;"
                                    name="accountwijzigen" type="submit"
                                    value="submit">
                                Wijzigen opslaan
                            </button>

                            <button type="button" class="btn grey"
                                    data-toggle="modal" data-target="#verwijderverificatie"
                                    style="color: white; margin-top: 3%;">
                                Mijn account verwijderen
                            </button>


                    </div>

                    <!-- /.modal-body -->
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
    <?PHP
} catch (Exception $e) {
    
}
//hier eindigt try/catch voor $account object
?>

<script>


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
                    fullprice = "&#8364; " + euros + "," + cents;
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
<?PHP
include_once "footer.php";
?>
