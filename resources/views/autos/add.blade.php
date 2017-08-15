@extends('layouts.app')

@section('title','Nouvel Auto')

@section('content')
    {!! Form::open(['url' => url('autos/sauve'),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutClient"]) !!}
    @include('autos.form')
    {{--@include('elements/clientRedirection')--}}
    {!! Form::close() !!}
    <script>
        $(function(){

            /*--- DOM ---*/
            var modalRedirection = $('#modalRedirection');

            /*--boutton---*/
            var submitBoutton = $('#submitBoutton');

            /*---events--*/

           /* submitBoutton.on('click',function(event){
                event.preventDefault();
                modalRedirection.modal('show');
            });*/

        });
    </script>
@endsection