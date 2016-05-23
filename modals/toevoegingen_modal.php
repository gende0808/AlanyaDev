<div class="modal fade" id="myModalToev" tabindex="-1" role="dialog" aria-labelledby="myModalAddedLabel"
     aria-hidden="true" style="padding-top: 5%;">
    <div class="col-md-8 col-md-offset-2">
        <div class="modal-dialog">
            <div id="prodid"> blabla</div>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h2 class="modal-title" id="myModalAddedLabel"><b><i>Pizza Hawaii</b></i></h2><br>
                </div> <!-- /.modal-header -->
                <div class="modal-body col-md-12">
                    <div class="modal-body col-md-4">
                        <h4 align="left"><b>Dingen die ik krijg</b></h4>
                        <div id="verwijderbare_toevoegingen"
                        ">
                    </div>

                </div>
                <div class="modal-body col-md-4">
                    <h4 align="left"><b>Dingen die ik wil</b></h4>
                    <div id="toevoegbare_toevoegingen"></div>
                </div>
                <div class="modal-body col-md-4">
                    <h4 align="left"><b>Dingen die ik mag kiezen</b></h4>
                    <div id="radio_toevoegingen"></div>
                </div>
            </div>
            <div style="margin-bottom: 2%">
                <p>
                <h3><span>&#128; </span><span id="amount" class="amount"></span></h3></p>
                <br>
                Aantal:
                <input type="number" min="1" id="quantity" name="quantity" value="1" class="btn form-control input-md input-qty"
                       placeholder="" style="width: 15%">
                <button type="button" class="btn orange" id="submitproduct" style="color: white">Toevoegen</button>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('change', '[type=checkbox]', function () {
            baseprice = ($('#amount').html()).replace(",", ".");
            addableprice = $(this).data('price');
            if ($(this).prop('checked') == true) {
                totalprice = ( (+baseprice) + (+addableprice) ).toFixed(2);
            } else {
                totalprice = ( (+baseprice) - (+addableprice) ).toFixed(2);
            }
            totalprice = totalprice.replace(".", ",");
            $('#amount').html(totalprice);
        });


        $("#submitproduct").on("click", function () {

            var productid = $("#product_id").val();
            var aantal = $("#quantity").val();
            var removablee = [];
            $("input:checkbox[name=removable]:checked").each(function() {
                removablee.push($(this).val());
            });
            var addablee = [];
            $("input:checkbox[name=addable]:checked").each(function() {
               addablee.push($(this).val());
            });
            //RADIO CHECK WERKT NU
            var radioe = [];
            $("input:radio[id=radio]:checked").each(function() {
                alert('Hallo');
                radioe.push($(this).val());
            });

            radiostuff = $('#radio').val();
            var postData = {
                'prodid': productid,
                'aantal': aantal,
                'removable': removablee,
                'addable': addablee,
                'radio': radioe
            };
            var url = "shopping_cart_session.php";
            $.ajax({
                type: "POST",
                url: url,
                data: postData,
                dataType: "text",
                success: function (data) {
                    $('#myModalToev').modal('hide');
                }
            });
        });
    });

</script>

