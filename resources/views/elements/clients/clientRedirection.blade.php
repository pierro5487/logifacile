<div id="modalRedirection" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLongTitle">Ajout d'un nouveau client</h4>
            </div>
            <div class="modal-body">
                <p class="text-info">Que voulez vous faire ensuite ?</p>
                <div class="row">
                    <div class="col-xs-4 text-center">
                        <button type="submit" class="btn btn-info submitBtn" name="save" value="1">
                            <i class="fa fa-user-plus  fa-5x" aria-hidden="true"></i>
                            <h4>Seulement enregistrer le client</h4>
                        </button>
                    </div>
                    <div class="col-xs-4 text-center">
                        <button type="submit" class="btn btn-success submitBtn" name="choice" value="1">
                            <i class="fa fa-check-square  fa-5x" aria-hidden="true"></i>
                            <h4>Enregistrer et choisir ce client</h4>
                        </button>
                    </div>
                    <div class="col-xs-4 text-center">
                        <button type="submit" class="btn btn-warning submitBtn" name="auto" value="1">
                            <i class="fa fa-car  fa-5x" aria-hidden="true"></i>
                            <h4>Enregistrer et ajouter une auto</h4>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.submitBtn').on('click',function(){
            var name = $(this).attr('name');
            $('#directionHidden').val(name);
            $('#formAjoutClient').submit();
        });

    });
</script>