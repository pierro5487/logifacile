<div class="row">
    {!! Form::token() !!}
    <div class="form-group col-md-6 {{ ($errors->has('lastname'))?'has-error':''}}">
        {!! Form::label('lastname', 'Nom',['class'=> 'control-label']) !!}
        {!! Form::text('lastname',isset($client)?$client->lastname:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('lastname'))?$errors->first('lastname'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('firstname'))?'has-error':''}}">
        {!! Form::label('firstname', 'Prénom',['class'=> 'control-label']) !!}
        {!! Form::text('firstname',isset($client)?$client->firstname:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('firstname'))?$errors->first('firstname'):''}}</div>
    </div>
    <div class="form-group col-md-8 {{ ($errors->has('adress'))?'has-error':''}}">
        {!! Form::label('adress', 'Adresse',['class'=> 'control-label']) !!}
        {!! Form::text('adress',isset($client)?$client->adress:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('adress'))?$errors->first('adress'):''}}</div>
    </div>
    <div class="form-group col-md-4 {{ ($errors->has('type'))?'has-error':''}}">
        {!! Form::label('type', 'Type',['class'=> 'control-label']) !!}
        {!! Form::select('type',['P' => 'Particulier','E'=>'Entreprise','A' => 'Assureur'],isset($client)?$client->type:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('type'))?$errors->first('type'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('zipcode'))?'has-error':''}}">
        {!! Form::label('zipcode', 'code postal',['class'=> 'control-label']) !!}
        {!! Form::text('zipcode',isset($client)?$client->city->CP:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('zipcode'))?$errors->first('zipcode'):''}}</div>
    </div>
    <div class="form-group col-xs-10 col-md-5 {{ ($errors->has('id_city'))?'has-error':''}}">
        {!! Form::label('id_city', 'Ville',['class'=> 'control-label']) !!}
        {!! Form::select('id_city',isset($client)?$villes:[],isset($client)?$client->id_city:'',['placeholder' => 'Choisissez une commune','class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('id_city'))?$errors->first('id_city'):''}}</div>
    </div>
    <div class="form-group col-xs-2 col-md-1">
        <button id="addCityBtn" type="button" class="btn btn-success">
            <i class="fa fa-plus"></i>&nbsp;Ville
        </button>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('email'))?'has-error':''}}">
        {!! Form::label('email', 'E-mail',['class'=> 'control-label']) !!}
        {!! Form::email('email',isset($client)?$client->email:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('email'))?$errors->first('email'):''}}</div>
    </div>
    <div class="form-group col-md-6 {{ ($errors->has('phone'))?'has-error':''}}">
        {!! Form::label('phone', 'Téléphone',['class'=> 'control-label']) !!}
        {!! Form::text('phone',isset($client)?$client->phone:'',['class' => 'form-control']) !!}
        <div class="control-feedback">{{ ($errors->has('phone'))?$errors->first('phone'):''}}</div>
    </div>
    <div class="col-xs-12 text-center">
        {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
    </div>
</div>
@include('elements/clients/modalAddCity')
<script>
    $(function(){
        //form
        var searchCodePostal = $('input[name=zipcode]');
        var cityInput = $('select[name=id_city]');
        modalAddCity = $('#modalAddCity');
        addCityBtn = $('#addCityBtn');

        /*--event--*/

        addCityBtn.on('click',function(){
            modalAddCity.modal('show');
            $('#modalCp').focus();
        });


      //  changement code postal on carge les villes
        searchCodePostal.on('input',function(){
            var codeP = $(this).val();
            if(codeP.length >= 4){
                $.ajax({
                    url:'{{route('clients.searchCP')}}',
                    dataType:'json',
                    type:'get',
                    data:{
                        search:codeP
                    },
                    success:function(villes){
                        var liste = [];
                        $.each(villes,function(id,ville){
                            liste.push('<option value="'+id+'">'+ville+'</option>')
                        });
                        cityInput.empty();
                        cityInput.append(liste.join(''))
                    },
                    error:function(){
                        alert('Une erreur est survenue');
                    },
                    complete:function(){

                    }
                });
            }
        });
    });
</script>
