@extends('layouts.app')

@section('title','Modeles automobiles')
@section('content')
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <a class="btn btn-success pull-right" href="{{route('modeles.add')}}">
            <i class="fa fa-plus"></i>
            Ajouter
        </a>
    </div>
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="thead-default">
            <tr>
                {{--<th class="text-center">Logo</th>--}}
                <th class="text-center">Marque</th>
                <th class="text-center">Modele</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="modeleList">
            @forelse($modeles as $modele)
                <tr>
                    {{--<td>img</td>--}}
                    <td>{{$modele->Marque->nom}}</td>
                    <td>{{$modele->nom}}</td>
                    <td>
                        <a href="{{route('modeles.edit',$modele->id)}}" class="btn btn-warning" title="Modifier ce modèle">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucun résultat</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection