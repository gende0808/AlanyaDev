<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 15%;">
    <div class="col-md-4 col-md-offset-4">
        <div id="box">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center><h4 class="modal-title" id="myModalLabel">Inloggen met je persoonlijke Alanya account!</h4></center>
            </div> <!-- /.modal-header -->

            <div class="modal-body">
                <div class="alert alert-danger text-center" role="alert" id="alertReg" style="display: none;">
                    Foutje, bedankt!
                </div>
                <form name="login-form" id="login-form" role="form" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <label for="uLogin" class="input-group-addon orange glyphicon glyphicon-user"></label>
                            <input type="email" class="form-control" id="loginemail" name="loginemail" placeholder="E-mail">
                        </div>
                    </div> <!-- /.form-group -->

                    <div class="form-group">
                        <div class="input-group">
                            <label for="uPassword" class="input-group-addon orange glyphicon glyphicon-lock"></label>
                            <input type="password" class="form-control" id="loginpass" name="loginpass" placeholder="Wachtwoord">
                        </div> <!-- /.input-group -->
                    </div> <!-- /.form-group -->
                    <p>Nog geen account? <a href="register.php">Registreren</a></p>
                    <button type="button" class="form-control btn orange" id="loginbutton" name="loginbutton" style="color: white;">Login</button>
                </form>
                <div id="error"></div>
            </div> <!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
            </div>
</div><!-- /.modal -->
</div>

<script>
    $('#loginbutton').click(function() {


        email = $("input[name='loginemail']").val();
        password = $("input[name='loginpass']").val();

        //alert(email);

        var postData = {
            'loginemail': email,
            'loginpass': password
        }

        var url = "login.php";

        $.ajax({
            type: "POST",
            url: url,
            data: postData,
            dataType: "json",
            success: function(data)
            {
                if (data.logincorrect == false) {
                    $("#alertReg").html(data.loginfoutmelding).show();
                } else {
                    $('#myModal').modal('hide');
                    window.location.replace("index");
                }
            }
        });


    })
</script>

