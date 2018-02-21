@extends('layouts.app')

@section('title','chargement Modèle')

@section('content')
    {!! Form::open(['url' => url('modeles/upload/'),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutModele",'files'=>true]) !!}
    <div class="col-xs-12 text-center">
        {!! Form::file('file',['class' => '']) !!}
    </div>
    <div class="col-xs-12 text-center">
        {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
    </div>
    {!! Form::close() !!}
@endsection