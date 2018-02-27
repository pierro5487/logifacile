@extends('layouts.app')

@section('title','Facture en cours pour ce client')

@section('content')
    <div id="addFacture" class="">
        @include('elements/factures/histo')
    </div>
@endsection