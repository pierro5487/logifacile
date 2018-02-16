@extends('layouts.app')

@section('title','Ajouter un réglement')

@section('content')
    <div id="addReglement" class="">
        <div class="row" id="historique">
            <div class="col-sm-12 col-md-4 well">
                <h4><i class="fa fa-user-circle "></i>&nbsp;{{$facture->nom_client}}</h4>
                <p>{{$facture->adresse}}</p>
                @if(!empty($facture->adresse_comp))
                    <p>{{$facture->adresse_comp}}</p>
                @endif
                <p>{{$facture->code_postal.' '.ucfirst($facture->ville)}}</p>
                <p>{{strtoupper($facture->pays)}}</p>
            </div>
            <div class="col-sm-12 col-md-4 well">
                <h4><i class="fa fa-history"></i>&nbsp;Historique</h4>
                <table class="table" style="overflow: scroll;max-height: 50px">
                    @forelse($facture->reglements as $reglement)
                        <tr>
                            <td>{{number_format($reglement->montant,2,',',' ')}}€</td>
                            <td>{{$reglement->mode_reglement}}</td>
                            <td>{{$reglement->date->format('d/m/Y')}}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2">Aucun reglement</td></tr>
                    @endforelse
                </table>
            </div>
            <div class="col-sm-12 col-md-4 well">
                <h4><i class="fa fa-money"></i>&nbsp;Solde</h4>
                <table class="table">
                    <!--<tr>
                        <th>Montant HT</th>
                        <td>{{number_format($facture->totaux['totalHT'],2,',',' ')}}€</td>
                    </tr>
                    <tr>
                        <th>Total TVA</th>
                        <td>{{number_format($facture->totaux['totalTVA'],2,',',' ')}}€</td>
                    </tr>-->
                    <tr>
                        <th>Total TTC</th>
                        <td>{{number_format($facture->totaux['totalTTC'],2,',',' ')}}€</td>
                    </tr>
                    <tr>
                        <th>Déja encaissé</th>
                        <td>{{number_format($facture->totaux['totalEncaissement'],2,',',' ')}}€</td>
                    </tr>
                    <tr class="solde">
                        <th>Solde Restant :</th>
                        <td>{{number_format($facture->totaux['solde'],2,',',' ')}}€</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            {!! Form::open(['url' => route('reglements.create',$facture->id),'autocomplete'=>"off",'class'=>'form-min-height','id'=>"formAjoutAReglement"]) !!}
            {!! Form::token() !!}
            <div class="form-group col-md-6 {{ ($errors->has('montant'))?'has-error':''}}">
                {!! Form::label('montant', 'Montant',['class'=> 'control-label']) !!}
                {!! Form::text('montant','1',['class' => 'form-control','required']) !!}
                <div class="control-feedback">{{ ($errors->has('montant'))?$errors->first('montant'):''}}</div>
            </div>
            <div class="form-group col-md-6 {{ ($errors->has('mode_reglement'))?'has-error':''}}">
                {!! Form::label('mode_reglement', 'Mode de reglement',['class'=> 'control-label']) !!}
                {!! Form::select('mode_reglement',$optionsReglement,'',['placeholder' => 'Choisissez le mode de reglement','class' => 'form-control']) !!}
                <div class="control-feedback">{{ ($errors->has('mode_reglement'))?$errors->first('mode_reglement'):''}}</div>
            </div>
            <div class="col-xs-12 text-center">
                <a class="btn btn-danger" href="{{ URL::previous() }}">Annuler</a>
                {!! Form::submit('Enregistrer',['class' => 'btn btn-success','id'=>'submitBoutton']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection