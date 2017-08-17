@extends('layouts.app')

@section('title','modification Auto')

@section('content')
    {!! Form::open(['url' => url('autos/update/'.$auto->id),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutAuto"]) !!}
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