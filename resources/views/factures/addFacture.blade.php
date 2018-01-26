@extends('layouts.app')

@section('title','Facture en cours pour ce client')

@section('content')
    <div id="addFacture" class="">
        @if(!empty($brouillons))
            <div class="alert alert-info">
                <i class="fa fa-info-circle "></i>&nbsp;Attention {{count($brouillons)}} facture(s) a été commencée(s) mais pas valideé(s).Vous pouvez completer une de ses factures ou bien en créer une nouvelle.
            </div>
        @endif
        @if(!empty($brouillons))
            <div class="alert alert-warning">
                <i class="fa fa-info-circle "></i>&nbsp;Attention {{count($brouillons)}} facture(s) n'a toujours pas été réglée(s).
            </div>
        @endif
        <div class="col-lg-12" id="brouillonBlock">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Brouillon en cours</h3>
                </div>
                <div class="panel-body">
                    <table>
                        @forelse($brouillons as $brouillon)
                            <tr>
                                <td>
                                    {{$brouillon['numero']}}
                                </td>
                                <td class="btn-td">
                                    <a href="{{route('factures.visualise',$brouillon['id'])}}" title="Voir cette facture" target="_blank" class="btn btn-success btn-small">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                                <td class="btn-td">
                                    <a href="{{route('factures.edit',$brouillon['id'])}}" title="Modifier cette facture" class="btn btn-warning btn-small">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td class="btn-td">
                                    <form method="post" action="{{route('factures.delete',$brouillon['id'])}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="idFacture" value="{{$brouillon['id']}}"/>
                                        <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td>Aucun brouillon en cours</td></tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12" id="nonSoldeBlock">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-euro" aria-hidden="true"></i>
                        Factures non réglées
                    </h3>
                </div>
                <div class="panel-body">
                    <table>
                        @forelse($facturesNonReglees as $facture)
                            <tr>
                                <td>{{$facture['numero']}}</td>
                                <td class=" visible-sm visible-md visible-lg">{{$facture['totalTTC']}}</td>
                                <td class="visible-sm visible-md visible-lg">{{/*$facture['solde']*/'non dispo'}}</td>
                                <td class="btn-td">
                                    <a href="{{route('factures.visualise',$facture['id'])}}" title="Voir cette facture" target="_blank" class="btn btn-success btn-small">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </td>
                                <td class="btn-td">
                                    <a href="{{route('reglements.ajout',$facture['id'])}}" title="Ajouter un reglement" class="btn btn-primary btn-small">
                                        <i class="fa fa-euro"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <li>Aucune facture non soldée</li>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection