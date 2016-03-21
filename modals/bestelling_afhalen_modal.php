<?PHP
include_once "connection.php";
include_once "classes/CategoryList.php";
include_once "classes/Category.php";

?>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#">Bestellingen laten bezorgen</a></li>
                <li role="presentation"><a href="#">Bestelling afhalen</a></li>
            </ul>

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <h1>Controleer uw gegevens</h1>
                        <form name="theform" method="post" role="form" action="register.php">
                            <div class="modal-body">
                                <form role="form">
                                    <div class="form-group bord">
                                        <div class="input-group">
                                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                                            <input type="text" onKeyup="checkform()" class="form-control" name="firstname"
                                                   placeholder="Voornaam">
                                            <input type="text" onKeyup="checkform()" class="form-control" name="lastname"
                                                   placeholder="Achternaam">
                                        </div>
                                    </div>
                                    <div class="form-group bord">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-earphone"></label>
                                            <input type="text" onKeyup="checkform()" class="form-control" name="phonenumber"
                                                   placeholder="Telefoonnummer">

                                        </div>
                                    </div>
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
                                    <div class="form-group bord">
                                        <div class="input-group">
                                            <label for="uLogin"
                                                   class="input-group-addon orange glyphicon glyphicon-plus"></label>
                                            <input type="text" onKeyup="checkform()" class="form-control" name="houseadding"
                                                   placeholder="Hier kunt u invullen als het adres iets speciaals heeft zoals niet bellen maar kloppen. ">
                                            <!--                                            Het kan eventueel nog een textarea van gemaakt worden.-->
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <br><br>
                                        <button type="submit" class="btn orange" style="color: white">
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
