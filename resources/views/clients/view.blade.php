@extends('layouts.app')

@section('title',$client->fullName)

@section('content')
    <div id="viewClient" class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <div class="panel col-xs-12 col-sm-12 col-md-6">
                <div class="well row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>&nbsp;
                    </div>
                    <div class="col-xs-7">
                        <h4>{{$client->fullName}}</h4>
                        <p>{{$client->adress}}</p>
                        @if(!empty($client->adresse_comp))
                            <p>{{$client->adresse_comp}}</p>
                        @endif
                        <p>{{$client->City->CP.' '.ucfirst($client->City->VILLE)}}</p>
                        <p>{{strtoupper($client->City->CODEPAYS)}}</p>
                    </div>
                    <div class="col-xs-2">
                        <a class="btn btn-warning" href="{{route('clients.edit',$client->id)}}" title="modifier ce profil">
                            <i class="fa fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel col-xs-12 col-sm-12 col-md-6">
                <div class="well row">
                    <div class="col-xs-3">
                        <i class="fa fa-car fa-5x"></i>&nbsp;
                    </div>
                    <div class="col-xs-7">
                        <table class="table">
                            @forelse($autos as $auto)
                                <tr>
                                    <td>{{$auto->marque->nom.' '.$auto->modele->nom}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Aucune auto</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    <div class="col-xs-2">
                        <a class="btn btn-success" href="{{route('autos.add',$client->id)}}" title="ajouter une auto">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="">
                @include('elements/factures/histo')
            </div>
        </div>
    </div>
@endsection