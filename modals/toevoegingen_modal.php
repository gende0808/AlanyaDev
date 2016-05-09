<div class="modal fade" id="myModalToev" tabindex="-1" role="dialog" aria-labelledby="myModalAddedLabel" aria-hidden="true" style="padding-top: 5%;">
    <div class="col-md-8 col-md-offset-2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title" id="myModalAddedLabel"><b><i>Pizza Hawaii</b></i></h2><br>
                </div> <!-- /.modal-header -->
                <div class="modal-body col-md-12">
                    <div class="modal-body col-md-4" >
                        <h4 align="left"><b>Dingen die ik krijg</b></h4>
                        <div id="verwijderbare_toevoegingen" ">
                        </div>

                    </div>
                    <div class="modal-body col-md-4" >
                        <h4 align="left"><b>Dingen die ik wil</b></h4>
                        <div id="toevoegbare_toevoegingen"></div>
                    </div>
                    <div class="modal-body col-md-4">
                        <h4 align="left"><b>Dingen die ik mag kiezen</b></h4>
                        <div id="radio_toevoegingen"></div>
                    </div>
                </div>
                <div style="margin-bottom: 2%">
                    <p><h3><span id="amount" class="amount"></span></h3></p>
                    <br>
                    Aantal:
                    <input type="number" min="1" name="quantity" value="1" class="btn form-control input-md input-qty" placeholder="" style="width: 15%">
                    <button class="btn orange" style="color: white" href="shoppingcart.php"><a href="shoppingcart.php" style="color:white"> Toevoegen</a></button>
                </div> <!-- /.modal-footer -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div><!-- /.modal -->

<script>
    $(document).on('change' , '.checkbox' , function(){
        if(this.checked) {
            alert('hoi');
        }

    });
</script>

