<?PHP

// TODO if user logged in, redirect this page to index.
include_once "header.php";
include_once "connection.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
?>
<div class="logo text-center">
    <img src="images/testlogo3.png">
</div>

<div class="col-md-4 col-md-offset-4">
    <div class="modal-dialog text-center">
        <br>

        <div class="modal-content text-center">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Account niet geactiveerd</h4>
            </div>
            <!-- /.modal-header -->

            <form name="theform" method="post" role="form" action="register.php">
                <div class="modal-body">
                    Uw account is niet nog niet geactiveerd!<br />
                    Ga a.u.b. naar uw opgegeven e-mailadres om uw account via de link te activeren. <br />
                    Deze mail kan eventueel in uw spam-box staan.
                </div>

                <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
