@extends('layouts.app')

@section('title','Nouveau client')

@section('content')
    {!! Form::open(['url' => url('clients/sauve'),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutClient"]) !!}
        @include('clients.form')
        @include('elements.clients.clientRedirection')
    {!! Form::close() !!}
    <script>
        $(function(){

            /*--- DOM ---*/
            var modalRedirection = $('#modalRedirection');

            /*--boutton---*/
            var submitBoutton = $('#submitBoutton');

            /*---events--*/

            submitBoutton.on('click',function(event){
                event.preventDefault();
                modalRedirection.modal('show');
            });

        });
    </script>
@endsection