<div id="modalAddAuto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-car"></i>
                    Ajouter une auto
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="modalAddAutoErreur" class="col-xs-12">

                    </div>
                    <div class="col-xs-12">
                        <form>
                            <div class="form-group col-md-12">
                                {!! Form::label('auto', 'Auto',['class'=> 'control-label']) !!}
                                {!! Form::select('auto',$autos,isset($auto)?$auto->client_id:'',['placeholder' => 'Choisissez un véhicule','class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('kilometrage', 'Kilometrage',['class'=> 'control-label']) !!}
                                {!! Form::number('kilometrage',1,['class' => 'form-control','step'=> 0.01,'min'=>1]) !!}
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('date_document', 'Date document',['class'=> 'control-label']) !!}
                                {!! Form::text('date_document','',['id'=> 'dateAddAuto','class' => 'form-control','step'=> 0.01,'min'=>1,'data-date-language'=>"fr"]) !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="addAutoButton" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){

        $('#dateAddAuto').datepicker({
            language :'fr',
            "format": "dd/mm/yyyy",
            "startDate": "-5d",
//            "keyboardNavigation": false
        });
        addAutoBtn = $('#addAutoButton');
        modalAddAutoErreur = $('#modalAddAutoErreur');

        addAutoBtn.on('click',function(){
            modalAddAutoErreur.empty();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setAjaxLoaderFullPage(true,'enregistrement en cours');

            $.ajax({
                url:'{{route('groupeLignes.addAutoHeader')}}',
                dataType:'json',
                type:'post',
                data:{
                    idFacture : idFacture,
                    idGroupe : idGroupeEnCours,
                    auto : $('#auto').find('option:checked').val(),
                    kilometrage : $('#kilometrage').val(),
                    dateAddAuto : $('#dateAddAuto').val()
                },
                success:function(res){
                    if(typeof(res.success) != 'undefined'){
                        if(res.success){
                            //sweet alert ok
                            $('#modalAddAuto').modal('hide');
                            location.reload();
                        }else{
                            alert(res.message);
                        }
                    }else{
                        //on affiche la liste d'erreurs
                        modalAddAutoErreur.empty().append(formatListeErreur(res));

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