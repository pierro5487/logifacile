<div id="modalDecalaminage" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">
                    <i class="fa fa-leaf"></i>
                    Ajouter un décalaminage
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="modalDecalaminageErreur" class="col-xs-12">

                    </div>
                    <div class="col-xs-12">
                        <form>
                            <div class="form-group col-md-4">
                                {!! Form::label('quantiteDecalaminage', 'Quantite',['class'=> 'control-label']) !!}
                                {!! Form::number('quantiteDecalaminage',1,['class' => 'form-control','step'=> 1,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-4">
                                {!! Form::label('prixDecalaminage', 'Prix HT',['class'=> 'control-label']) !!}
                                {!! Form::number('prixDecalaminage',65,['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-4">
                                {!! Form::label('remiseDecalaminage', 'Remise %',['class'=> 'control-label']) !!}
                                {!! Form::number('remiseDecalaminage',0,['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="addDecalaminageButton" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){

        addDecalaminageBtn = $('#addDecalaminageButton');
        modalDecalaminageErreur = $('#modalDecalaminageErreur');

        addDecalaminageBtn.on('click',function(){
            modalDecalaminageErreur.empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setAjaxLoaderFullPage(true,'enregistrement en cours');

            $.ajax({
                url:'{{route('ligneFactures.addDecalaminage')}}',
                dataType:'json',
                type:'post',
                data:{
                    idFacture : idFacture,
                    idGroupe : idGroupeEnCours,
                    quantite : $('#quantiteDecalaminage').val(),
                    remise : $('#remiseDecalaminage').val(),
                    prix : $('#prixDecalaminage').val(),
                },
                success:function(res){
                    console.log(res.success);
                    if(typeof(res.success) != 'undefined'){
                        console.log('ici');
                        if(res.success){
                            //sweet alert ok
                            addLigneToGroupe(idGroupeEnCours,res.ligne,res.sousTotalGroupe);
                            $('#modalDecalaminage').modal('hide');
                        }else{
                            alert(res.message);
                        }
                    }else{
                        //on affiche la liste d'erreurs
                        console.log(res);
                        modalDecalaminageErreur.empty().append(formatListeErreur(res));

                    }
                },
                error:function(){
                    //erreur prioduite
                    alert('Une erreur s\'est produite');
                },
                complete:function(){
                    setAjaxLoaderFullPage(false);
                }
            });
        });
    })
</script>