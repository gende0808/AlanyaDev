<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 15%;">
    <div class="col-md-4 col-md-offset-4">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center><h4 class="modal-title" id="myModalLabel">Log in</h4></center>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
                <form name="theform" role="form" method="post" action="login.php">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                            <input type="text" onKeyup="checkform()" class="form-control" id="uLogin" name="loginemail" placeholder="E-mail">
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <label for="uPassword" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                            <input type="password" onKeyup="checkform()" class="form-control" id="uPassword" name="loginpass" placeholder="Wachtwoord">
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->
                    <p>Nog geen account? <a href="register.php">Registreren</a></p>
                    <button class="form-control btn orange" id="test" type="submit"  style="color: white;">Login</button>
                </form>
            </div> <!-- /.modal-body -->


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

