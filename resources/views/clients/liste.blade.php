@extends('layouts.app')

@section('title','Clients')

@section('content')
    <div class="col-xs-12" style="margin-bottom: 20px">
        <div class="input-group">
            <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-search" title="Rechercher par nom, prénom, ville"></i></span>
            <input id="searchAuto" type="text" class="form-control" placeholder="Zone de recherche" aria-describedby="sizing-addon2">
        </div>
    </div>
    <div class="col-xs-12">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="thead-default">
            <tr>
                <th class="text-center">Client</th>
                <th class="text-center">Ville</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody id="clientList">
            @forelse($clients as $client)
                <tr>
                    <td>{{$client->fullName}}</td>
                    <td>{{$client->city->VILLE}}</td>
                    <td>
                        <a href="{{route('clients.view',$client->id)}}" class="btn btn-success" title="Voir ce client">
                            <i class="fa fa-search"></i>
                        </a>
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
    </div>
    <script>
        $(function(){

            /*-- DOM --*/
            var searchInput = $('#searchAuto');
            var clientList = $('#clientList');

            /*---event ---*/
            searchInput.on('input',function(){
                var search = $(this).val();
                $.ajax({
                    url:'{{route('autos.searchClient')}}',
                    dataType:'html',
                    type:'get',
                    data:{
                        search:search
                    },
                    success:function(html){
                        clientList.empty().append(html);
                    },
                    error:function(){
                        alert('Une erreur est survenue pendant la recherche')
                    }
                });
            });
        });
    </script>
@endsection