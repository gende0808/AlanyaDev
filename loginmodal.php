<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 15%;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Log in</h4>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                            <input type="text" class="form-control" id="uLogin" placeholder="E-mail">
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <label for="uPassword" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                            <input type="password" class="form-control" id="uPassword" placeholder="Wachtwoord">
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->

                    <p>Nog geen account? <a href="register.php">Registreren</a></p>
                </form>

            </div> <!-- /.modal-body -->

            <div class="modal-footer">
                <button class="form-control btn orange" style="color: white;">Login</button>

                <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: 0%;">
                        <span class="sr-only">progress</span>
                    </div>
                </div>
            </div> <!-- /.modal-footer -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->