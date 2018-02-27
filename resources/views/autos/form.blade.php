<div class="row">
    {!! Form::token() !!}
    <div class="form-group col-md-6 {{ ($errors->has('immat'))?'has-error':''}}">
        {!! Form::label('immat', 'Immatriculation',['class'=> 'control-label']) !!}
        {!! Form::text('immat',isset($auto)?$auto->immat:'',['class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('immat'))?$errors->first('immat'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('client_id'))?'has-error':''}}">
        {!! Form::label('client_id', 'Client',['class'=> 'control-label']) !!}
        {!! Form::select('client_id',$clients,isset($auto)?$auto->client_id:(isset($client)?$client->id:''),['placeholder' => 'Choisissez le propriétaire du véhicules','class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('client_id'))?$errors->first('client_id'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('marque_id'))?'has-error':''}}">
        {!! Form::label('marque_id', 'Marque',['class'=> 'control-label']) !!}
        {!! Form::select('marque_id',$marques,isset($auto)?$auto->marque_id:'',['placeholder' => 'Choisissez une marque de véhicule','class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('marque_id'))?$errors->first('marque_id'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('model_id'))?'has-error':''}}">
        {!! Form::label('model_id', 'Model',['class'=> 'control-label']) !!}
        {!! Form::select('model_id',isset($auto)?$modeles:[],isset($auto)?$auto->model_id:'',['placeholder' => 'Choisissez un modèle de véhicule','class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('model_id'))?$errors->first('marque_id'):''}}</div>
    </div>

    <div class="col-xs-12 text-center">
        {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
    </div>
</div>
<script>
    $(function(){

        /*-- dom --*/
        var selectMarque = $('#marque_id');
        var selectModele = $('#model_id');

        /*---events ---*/

        selectMarque.on('change',function(){
            var idMarque = selectMarque.val();
            console.log(idMarque);
            $.ajax({
                url:'{{route('models.getModelesForMarque')}}',
                dataType:'json',
                type:'get',
                data:{
                    marque:idMarque
                },
                success:function(res){
                    var select = [];
                    $.each(res,function(letter,autos){
                        select.push('<optgroup label="'+letter+'" >');
                        $.each(autos,function(id,auto){
                            select.push('<option value="'+id+'">'+auto+'</option>');
                        });
                        select.push('</optgroup>');
                    });
                    selectModele.empty().append(select.join(''));
                }
            });
        })
    });
</script>
