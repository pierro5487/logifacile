@extends('layouts.app')

@section('title','Ajouter un réglement')

@section('content')
    <div id="addReglement" class="">
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <div class="col-xs-2">
                    <i class="fa fa-user-circle"></i>
                </div>
                <div class="col-xs-10">
                    <h3>{{$facture->nom_client}}</h3>
                    <p>{{$facture->adresse}}</p>
                    @if(!empty($facture->adresse_comp))
                        <p>{{$facture->adresse_comp}}</p>
                    @endif
                    <p>{{$facture->code_postal.' '.ucfirst($facture->ville)}}</p>
                    <p>{{strtoupper($facture->pays)}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">

            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="col-xs-2">
                    <i class="fa fa-money"></i>
                </div>
                <div class="col-xs-10">
                    <table class="table">
                        <tr>
                            <th>Montant HT</th>
                            <td>{{number_format($facture->totaux['totalHT'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Total TVA</th>
                            <td>{{number_format($facture->totaux['totalTVA'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Total TTC</th>
                            <td>{{number_format($facture->totaux['totalTTC'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Déja encaissé</th>
                            <td>{{number_format($facture->totaux['totalEncaissement'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Solde Restant :</th>
                            <td>{{number_format($facture->totaux['solde'],2,',',' ')}}€</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection