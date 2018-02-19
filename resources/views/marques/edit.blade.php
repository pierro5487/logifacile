@extends('layouts.app')

@section('title','modification Auto')

@section('content')
    {!! Form::open(['url' => url('marques/edit/'.$marque->id),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutMarque"]) !!}
    @include('marques.form')
    {{--@include('elements/clientRedirection')--}}
    {!! Form::close() !!}
@endsection