@extends('layouts.app')

@section('title','Autos')

@section('content')
    <div class="col-xs-12" style="margin-bottom: 20px">
        <div class="input-group">
            <span class="input-group-addon" id="sizing-addon2"><i class="fa fa-search" title="Recercher par modele, marque, proprietaire, immatriculation"></i></span>
            <input id="searchAuto" type="text" class="form-control" placeholder="Zone de recherche" aria-describedby="sizing-addon2">
        </div>
    </div>
    <div class="col-xs-12">
        <table class="table table-bordered table-hover table-striped text-center">
            <thead class="thead-default">
            <tr>
                <th class="text-center">N°Immatriculation</th>
                <th class="text-center">Marque</th>
                <th class="text-center">Model</th>
                <th class="text-center">Propriétaire</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="autoList">
            @forelse($autos as $auto)
                <tr>
                    <td>{{$auto->immat}}</td>
                    <td>{{$auto->Marque->nom}}</td>
                    <td>{{$auto->Modele->nom}}</td>
                    <td>{{!empty($auto->proprietaire)?$auto->proprietaire->fullName:'-'}}</td>
                    <td>
                        <a href="{{route('autos.edit',$auto->id)}}" class="btn btn-warning" title="Modifier cet auto">
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

            /*-- DOM --*/
            var searchInput = $('#searchAuto');
            var autoList = $('#autoList');

            /*---event ---*/
            searchInput.on('input',function(){
                var search = $(this).val();
                $.ajax({
                    url:'{{route('autos.searchAuto')}}',
                    dataType:'html',
                    type:'get',
                    data:{
                        search:search
                    },
                    success:function(html){
                        autoList.empty().append(html);
                    },
                    error:function(){
                        alert('Une erreur est survenue pendant la recherche')
                    }
                });
            });
        });
    </script>
@endsection