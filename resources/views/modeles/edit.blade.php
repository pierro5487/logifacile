@extends('layouts.app')

@section('title','modification Modèle')

@section('content')
    {!! Form::open(['url' => url('modeles/update/'.$modele->id),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutModele"]) !!}
    @include('modeles.form')
    {{--@include('elements/clientRedirection')--}}
    {!! Form::close() !!}
@endsection