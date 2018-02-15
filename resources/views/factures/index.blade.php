@extends('layouts.app')

@section('title','Factures')

@section('content')
    <table class="table-striped table table-hover">
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>Numero</th>
                <th>Client</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($factures as $facture)
                <tr>
                    <td>{!! $facture->date_document->format('d/m/Y') !!}</td>
                    <td>{!! $facture->type !!}</td>
                    <td>{!! $facture->numero !!}</td>
                    <td>{!! $facture->nom_client !!}</td>
                    <td>{!! number_format($facture->totaux['totalHT'],2,',',' ') !!}</td>
                    <td>
                        <a class="btn btn-success" title="Voir la facture" href="{{route('factures.visualise',$facture->id)}}" target="_blank">
                            <i class="fa fa-search"></i>
                        </a>
                        {{--<button class="btn btn-info"><i class="fa fa-download"></i></button>--}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune facture</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-center">
        {!! $factures->links()!!}
    </div>
@endsection