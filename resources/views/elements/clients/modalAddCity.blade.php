<div id="modalAddCity" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-map-marker"></i>
                    Ajouter une ville
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="modalAddCityError" class="col-xs-12">

                    </div>
                    <div class="col-xs-12">
                        <form>
                            <div class="form-group col-md-12">
                                {!! Form::label('code_postal', 'Code postal',['class'=> 'control-label']) !!}
                                {!! Form::text('code_postal','',['class' => 'form-control','id'=> 'modalCp']) !!}
                                <span class="help-block">Pour pays etranger mettre la lettre du pays devant. Ex: L4814 pour lux</span>
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('nom', 'Nom ville',['class'=> 'control-label']) !!}
                                {!! Form::text('nom','',['class' => 'form-control','id'=> 'modalVille']) !!}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button id="addCityModalButton" type="button" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#addCityModalButton').on('click',function(){
            setAjaxLoaderFullPage(true,'Enregistrement en cours');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'{{route('cps.add')}}',
                dataType:'json',
                type:'post',
                data:{
                    cp:$('#modalCp').val(),
                    ville:$('#modalVille').val()
                },
                success:function(res){
                    if(res.success){
                        modalAddCity.modal('hide');
                        $('#zipcode').val(res.cp.CP);
                        $('#id_city').append('<option value="'+res.cp.id+'" selected>'+res.cp.VILLE+'</option>');
                    }else{
                        $('#modalAddCityError').empty().append('<p class="text-danger">'+res.message+'</p>');
                    }
                },
                error:function(){
                    alert('une erreur est survenue');
                },
                complete:function(){
                    setAjaxLoaderFullPage(false);
                }
            });
        });
    });
</script>