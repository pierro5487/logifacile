@extends('layouts.app')

@section('title','Nouveau modèle')

@section('content')
    {!! Form::open(['url' => url('modeles/create'),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutModele"]) !!}
    @include('modeles.form')
    {!! Form::close() !!}
@endsection