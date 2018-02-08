@extends('layouts.app')

@section('title',$facture->numero)

@section('content')
    <div id="editFacture">
        @foreach($facture->groupLignes as $groupe)
            <div class="groupeLigne well" data-id-groupe="{{$groupe->id}}">
                <div class="groupeLigneHeader">
                    @if($groupe->no_header)
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" style="width: 60%"></th>
                                <th class="text-right">
                                    <button>Ajouter une auto</button>
                                </th>
                            </tr>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Auto</th>
                                <th>Immatriculation</th>
                                <th>Kilometrage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$groupe->auto_string}}</td>
                                <td>{{$groupe->immatriculation}}</td>
                                <td>{{$groupe->kilometrage}}</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="groupeLigneContent">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Libelle</th>
                            <th>PrixHT</th>
                            <th>Quantité</th>
                            <th>Remise</th>
                            <th>Prix HT Total</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="listeLigneGroupe">
                        <?php $totalGroupe = 0?>
                        @forelse($facture->lignes as $ligne)
                            @if($ligne->groupe_lignes_id == $groupe->id)
                                <?php $totalLigne = $ligne->quantite*($ligne->prix_unitaire_HT*(100-$ligne->remise)/100);
                                $totalGroupe += $totalLigne;
                                ?>
                                <tr data-id-ligne="{{$ligne->id}}">
                                    <td>{{$ligne->libelle}}</td>
                                    <td>{{number_format($ligne->prix_unitaire_HT,2,',',' ')}}</td>
                                    <td>{{$ligne->quantite}}</td>
                                    <td>{{$ligne->remise}}%</td>
                                    <td class="text-right">{{number_format($totalLigne,2,',',' ') }}€</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger deleteLigne">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <button class="btn btn-sm btn-warning editLigne">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @empty

                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" class="text-right">Sous-total</td>
                            <td class="text-right totalGroupe">{{number_format($totalGroupe,2,',',' ')}}€</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="groupeBouttons row">
                        <div class="col col-xs-6 col-sm-3 text-center">
                            <button title="ajouter un décalaminage" class="btn btn-success btn-add-ligne" data-toggle="modal" data-target="#modalDecalaminage">
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-leaf"></i>
                            </button>
                        </div>
                        <div class="col col-xs-6 col-sm-3 text-center">
                            <button title="ajouter un dépannage/fourriere" class="btn btn-warning btn-add-ligne " disabled>
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-road"></i>
                            </button>
                        </div>
                        <div class="divider col-xs-12 hidden-sm hidden-md hidden-lg" style="height: 10px"></div>
                        <div class="col col-xs-6 col-sm-3 text-center">
                            <button title="ajouter un montage pneumatique" class="btn btn-info btn-add-ligne" data-toggle="modal" data-target="#modalMontage">
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-life-ring"></i>
                            </button>
                        </div>
                        <div class="col col-xs-6 col-sm-3 text-center">
                            <button title="ajouter une ligne personnalisée" class="btn btn-danger btn-add-ligne" data-toggle="modal" data-target="#modalCustom">
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>

        /*-----------------------------------------*/
        /*                   init                  */
        /*-----------------------------------------*/

        idFacture = '<?php echo $facture->id ?>';
        idGroupeEnCours = null;

        $(function(){

            init();

            function init(){
                refreshEvent();
            }

            /*-----------------------------------------*/
            /*                  event                  */
            /*-----------------------------------------*/

            $('.deleteLigne').on('click',deleteLigne);
            /**
             *
             * enregistre le groupe en cours de modification
             */
            function refreshEvent(){
                $('.btn-add-ligne').off().on('click',function(){
                    idGroupeEnCours = $(this).parents('.groupeLigne').data('idGroupe');
                });
            }

        });

        function deleteLigne(){
            var ligne = $(this).parents('tr');
            if(confirm('êtes vous sûr de vouloir supprimer cette ligne ?')){
                setAjaxLoaderFullPage(true,'Suppression en cours');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{route('ligneFactures.deleteLigne')}}',
                    dataType:'json',
                    type:'post',
                    data:{
                        idLigne : ligne.data('idLigne')
                    },
                    success:function(res){
                        if(res.success){
                            ligne.remove();
                            updateTotalGroupe(res.idGroupe,res.sousTotalGroupe);
                        }else{
                            alert(res.message);
                        }
                    },
                    error:function () {
                        alert('Une erreur est survenue');
                    },
                    complete:function(){
                        setAjaxLoaderFullPage(false);
                    }
                });
            }
        }

        function addLigneToGroupe(idGroupe,ligne,sousTotalGroupe){
            newLigne = $('<tr data-id-ligne="'+ligne.id+'"><td>'+ligne.libelle+'</td><td>'+ligne.prix_unitaire_HT+'€</td><td>'+ligne.quantite+'</td><td>'+ligne.remise+'%</td><td class="text-right">'+calculTotalLigne(ligne)+'€</td></tr>');
            //on y ajoute le btn suppression
            var tdBtn = $('<td></td>');

            var deleteBtn = $('<button class="btn btn-sm btn-danger deleteLigne"><i class="fa fa-trash"></i></button>');
            deleteBtn.on('click',deleteLigne);
            tdBtn.append(deleteBtn);
            //on y ajoute le bouton d'edition

            //on affiche
            newLigne.append(tdBtn);
            $('.groupeLigne[data-id-groupe="'+idGroupe+'"]').find('.listeLigneGroupe').append(newLigne);
            updateTotalGroupe(idGroupe,sousTotalGroupe);
        }

        function calculTotalLigne(ligne){
            return ligne.quantite*(ligne.prix_unitaire_HT*(100-ligne.remise)/100);
        }

        function updateTotalGroupe(idGroupe,total){
            $('.groupeLigne[data-id-groupe="'+idGroupe+'"]').find('.totalGroupe').html(total+'€');
        }

        function formatListeErreur(erreurs){
            html = '<ul>';
            $.each(erreurs,function(champ,liste){
                $.each(liste,function(key,erreur){
                    html += '<li class="text-danger">'+erreur+'</li>';
                });
            });
            html += '</ul>';
            return html;
        }

    </script>
    @include('elements/factures/modalDecalaminage')
    @include('elements/factures/modalCustom')
    @include('elements/factures/modalMontage')
@endsection