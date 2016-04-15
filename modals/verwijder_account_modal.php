<!-- Modal -->
<div class="modal fade" id="verwijderverificatie" tabindex="-1"
     role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 15%;">
    <div class="col-md-4 col-md-offset-4">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="text-align: center;">Account Verwijderen</h4>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <p style="color:red; font-size: 20px;">Weet u zeker dat u uw account wilt verwijderen?</p>
                </div>
                <div class="modal-footer">
                    <form action="index" method="post">
                        <button type="submit" class="btn btn-default" name="deleteaccount" value="true">Ja</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Nee</button>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>