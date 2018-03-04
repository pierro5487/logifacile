@extends('layouts.app')

@section('title','Modifier les prix du montage')

@section('content')
    <div id="Montages" class="">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php $i = 1 ?>
            @forelse($montages as $size => $group)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
                            Montage taille {{$size}}
                        </a>
                    </h4>
                </div>
                <div id="collapse{{$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <form>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center">Montage</th>
                                        <th class="text-center">Equilibrage</th>
                                        <th class="text-center">Valve</th>
                                        <th class="text-center">Alu/Tôle</th>
                                        <th class="text-center">Runflat</th>
                                        <th class="text-center">Camionnette</th>
                                        <th class="text-center">Prix HT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($group as $montage)
                                        <tr data-id-montage="{{$montage->id}}">
                                            <td>{{ ($montage->montage)? 'Montage' : ''}}</td>
                                            <td>{{ ($montage->equilibrage)? 'Equilibrage' : ''}}</td>
                                            <td>{{ ($montage->valve)? 'Valve' : ''}}</td>
                                            <td>{{ ($montage->alu)? 'Alu' : 'Tôle'}}</td>
                                            <td>{{ ($montage->runflat)? 'Runflat' : ''}}</td>
                                            <td>{{ ($montage->truck)? 'Camionnette' : ''}}</td>
                                            <td>
                                                <input type="number" step="0.5" class="text-center prixInput" value="{{$montage->valeur}}"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
            @empty
            @endforelse
        </div>
    </div>

    <script>
        $(function(){
            $('.prixInput').on('blur',function(){
                var idMontage = $(this).parents('tr').data('idMontage');
                var prix = $(this).val();
                setAjaxLoaderFullPage(true,'Enregsitrement en cours...');
                $.ajax({
                    url:'{{route('montages.update')}}',
                    dataType:'json',
                    type:'post',
                    data:{
                        idMontage:idMontage,
                        prix:prix
                    },
                    success:function(res){
                        if(res.success){

                        }else{
                            alert(res.message);
                        }
                    },
                    error:function(){
                        alert('Une erreur est survenue');
                    },
                    complete:function(){
                        setAjaxLoaderFullPage(false);
                    }
                });
            });
        })
    </script>
@endsection
