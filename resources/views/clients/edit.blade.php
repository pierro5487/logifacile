@extends('layouts.app')

@section('title','Modification client')

@section('content')
    {!! Form::open(['url' => url('clients/update/'.$client->id),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutClient"]) !!}
    @include('clients.form')
    {!! Form::close() !!}
@endsection