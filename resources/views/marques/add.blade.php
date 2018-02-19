@extends('layouts.app')

@section('title','Nouvelle marque')

@section('content')
    {!! Form::open(['url' => url('marques/create'),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutMarque"]) !!}
    @include('marques.form')
    {!! Form::close() !!}
@endsection