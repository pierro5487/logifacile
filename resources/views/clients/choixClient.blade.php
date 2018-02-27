@extends('layouts.app')

@section('title','Choisir un client')

@section('content')
    <div id="choixClient" class="factureBloc">
        <!--<div class="row">
            <div class="col-xs-12 col-sm-4 text-center">
                <div href="#" class="well icon_case icon_case_editable" title="Choisir un autre utilisateur">
                    <i class="fa fa-user-circle fa-4x"></i>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <p>client</p>
            </div>
        </div>-->
        {!! Form::open(['autocomplete'=>"off",'class'=>'form-min-height','id'=>"formChoixClient"]) !!}
            <div class="form-group col-md-6 {{ ($errors->has('client_id'))?'has-error':''}}">
                {!! Form::label('client_id', 'Client',['class'=> 'control-label']) !!}
                {!! Form::select('client_id',$clients,isset($auto)?$auto->client_id:'',['placeholder' => 'Choisissez un client','class' => 'form-control']) !!}
                <div class="control-feedback">{{ ($errors->has('client_id'))?$errors->first('client_id'):''}}</div>
            </div>
            <div class="col-md-12 text-center">
                {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection