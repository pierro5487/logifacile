<div class="row">
    {!! Form::token() !!}
    <div class="form-group col-md-6 {{ ($errors->has('immat'))?'has-error':''}}">
        {!! Form::label('immat', 'Immatriculation',['class'=> 'control-label']) !!}
        {!! Form::text('immat',isset($auto)?$auto->immat:'',['class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('immat'))?$errors->first('immat'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('client_id'))?'has-error':''}}">
        {!! Form::label('client_id', 'Client',['class'=> 'control-label']) !!}
        {!! Form::select('client_id',$clients,isset($auto)?$auto->client_id:'',['placeholder' => 'Choisissez le propriétaire du véhicules','class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('client_id'))?$errors->first('client_id'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('marque_id'))?'has-error':''}}">
        {!! Form::label('marque_id', 'Marque',['class'=> 'control-label']) !!}
        {!! Form::select('marque_id',$marques,isset($auto)?$auto->marque_id:'',['placeholder' => 'Choisissez une marque de véhicule','class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('marque_id'))?$errors->first('marque_id'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('model_id'))?'has-error':''}}">
        {!! Form::label('model_id', 'Model',['class'=> 'control-label']) !!}
        {!! Form::select('model_id',isset($auto)?$model:[],isset($auto)?$auto->model_id:'',['placeholder' => 'Choisissez un modèle de véhicule','class' => 'form-control','required']) !!}
        <div class="control-feedback">{{ ($errors->has('model_id'))?$errors->first('marque_id'):''}}</div>
    </div>

    <div class="col-xs-12 text-center">
        {!! Form::submit('Enregistrer',['class' => 'btn btn-outline-success','id'=>'submitBoutton']) !!}
    </div>
</div>
<script>
    $(function(){

        /*-- dom --*/
        var selectMarque = $('#marque_id');

        /*---events ---*/

        selectMarque.on('change',function(){
            var idMarque = $(this);
            $.ajax({
                url:'{{route('models.getModelsForMarque')}}',
                dataType:'json',
                type:'get',
                data:{
                    marque:idMarque
                },
                success:function(){

                }
            });
        })
    });
</script>
