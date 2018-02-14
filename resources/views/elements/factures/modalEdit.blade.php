<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-edit"></i>
                    Modifier une ligne
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="modalEditErreur" class="col-xs-12">

                    </div>
                    <div class="col-xs-12">
                        <form>
                            <div class="form-group col-md-6">
                                {!! Form::label('libelleEdit', 'Libelle',['class'=> 'control-label']) !!}
                                {!! Form::text('libelleEdit','',['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('quantiteEdit', 'Quantite',['class'=> 'control-label']) !!}
                                {!! Form::number('quantiteEdit',1,['class' => 'form-control','step'=> 1,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('prixEdit', 'Prix HT',['class'=> 'control-label']) !!}
                                {!! Form::number('prixEdit',1,['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('remiseEdit', 'Remise %',['class'=> 'control-label']) !!}
                                {!! Form::number('remiseEdit',0,['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="addEditButton" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){

        addEditBtn = $('#addEditButton');
        modalEditErreur = $('#modalEditErreur');

        addEditBtn.on('click',function(){
            modalEditErreur.empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setAjaxLoaderFullPage(true,'enregistrement en cours');

            $.ajax({
                url:'{{route('ligneFactures.updateLigne')}}',
                dataType:'json',
                type:'post',
                data:{
                    idFacture : idFacture,
                    idGroupe : idGroupeEnCours,
                    idLigne : idLigneEnCours,
                    libelle : $('#libelleEdit').val(),
                    quantite : $('#quantiteEdit').val(),
                    remise : $('#remiseEdit').val(),
                    prix : $('#prixEdit').val(),
                },
                success:function(res){
                    if(typeof(res.success) != 'undefined'){
                        if(res.success){
                            //sweet alert ok
                            updateLigneToGroupe(idGroupeEnCours,res.ligne,res.sousTotalGroupe);
                            updateTotaux(res.totaux);
                            $('#modalEdit').modal('hide');
                        }else{
                            alert(res.message);
                        }
                    }else{
                        //on affiche la liste d'erreurs
                        modalEditErreur.empty().append(formatListeErreur(res));

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