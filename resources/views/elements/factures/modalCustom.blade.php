<div id="modalCustom" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-pencil"></i>
                    Ajouter une ligne personnalisé
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="modalCustomErreur" class="col-xs-12">

                    </div>
                    <div class="col-xs-12">
                        <form>
                            <div class="form-group col-md-6">
                                {!! Form::label('libelleCustom', 'Libelle',['class'=> 'control-label']) !!}
                                {!! Form::text('libelleCustom','',['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('quantiteCustom', 'Quantite',['class'=> 'control-label']) !!}
                                {!! Form::number('quantiteCustom','',['class' => 'form-control','step'=> 1,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('prixCustom', 'Prix HT',['class'=> 'control-label']) !!}
                                {!! Form::number('prixCustom','',['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('remiseCustom', 'Remise %',['class'=> 'control-label']) !!}
                                {!! Form::number('remiseCustom',0,['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="addCustomButton" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){

        addCustomBtn = $('#addCustomButton');
        modalCustomErreur = $('#modalCustomErreur');

        addCustomBtn.on('click',function(){
            modalCustomErreur.empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setAjaxLoaderFullPage(true,'enregistrement en cours');

            $.ajax({
                url:'{{route('ligneFactures.addCustomLigne')}}',
                dataType:'json',
                type:'post',
                data:{
                    idFacture : idFacture,
                    idGroupe : idGroupeEnCours,
                    libelle : $('#libelleCustom').val(),
                    quantite : $('#quantiteCustom').val(),
                    remise : $('#remiseCustom').val(),
                    prix : $('#prixCustom').val(),
                },
                success:function(res){
                    if(typeof(res.success) != 'undefined'){
                        if(res.success){
                            //sweet alert ok
                            addLigneToGroupe(idGroupeEnCours,res.ligne,res.sousTotalGroupe);
                            updateTotaux(res.totaux);
                            $('#modalCustom').modal('hide');
                        }else{
                            alert(res.message);
                        }
                    }else{
                        //on affiche la liste d'erreurs
                        modalCustomErreur.empty().append(formatListeErreur(res));

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