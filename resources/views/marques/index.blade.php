@extends('layouts.app')

@section('title','Marques automobiles')
@section('content')
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <a class="btn btn-success pull-right" href="{{route('marques.add')}}">
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
                <th></th>
            </tr>
            </thead>
            <tbody id="marqueList">
            @forelse($marques as $marque)
                <tr>
                    {{--<td>img</td>--}}
                    <td>{{$marque->nom}}</td>
                    <td>
                        <a href="{{route('marques.edit',$marque->id)}}" class="btn btn-warning" title="Modifier cette marque">
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
    <script>
        $(function(){

        });
    </script>
@endsection