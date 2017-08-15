@extends('layouts.app')

@section('title','Clients')

@section('content')
    <table class="table table-bordered table-hover table-striped text-center">
        <thead class="thead-default">
            <tr>
                <th class="text-center">Client</th>
                <th class="text-center">Ville</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr>
                <td>{{$client->fullName}}</td>
                <td>{{$client->city->VILLE}}</td>
                <td>
                    <a href="{{route('clients.edit',$client->id)}}" class="btn btn-warning" title="Modifier ce client">
                        <i class="fa fa-edit"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Aucun résultat</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection