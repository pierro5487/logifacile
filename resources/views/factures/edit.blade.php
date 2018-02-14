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
                                <th colspan="" class="text-center" style="width: 80%">Aucune auto choisi</th>
                                <th class="text-right">
                                    <button class="btn btn-sm btn-success addAutoGroupe" title="Ajouter une auto">
                                        <i class="fa fa-plus"></i>&nbsp;
                                        <i class="fa fa-car"></i>
                                    </button>
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
                                <th>Date</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="autoHeaderAuto">
                                    {{$groupe->auto_string}}
                                    <input class="autoHeaderAutoId" type="hidden" value="{{$groupe->auto_id}}"/>
                                </td>
                                <td class="autoHeaderImmat">{{$groupe->immatriculation}}</td>
                                <td class="autoHeaderKilometrage">{{$groupe->kilometrage}}</td>
                                <td class="autoHeaderDate">{{$groupe->date_document->format('d/m/Y')}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning editCarGroupe" title="modifier cette auto">
                                        <i class="fa fa-pencil"></i>&nbsp;
                                        <i class="fa fa-car"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger deleteCarGroupe" title="Supprimer cette auto">
                                        <i class="fa fa-trash"></i>&nbsp;
                                        <i class="fa fa-car"></i>
                                    </button>
                                </td>
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
                                    <td class="libelle">{{$ligne->libelle}}</td>
                                    <td class="prix">{{number_format($ligne->prix_unitaire_HT,2,',',' ')}}</td>
                                    <td class="quantite">{{$ligne->quantite}}</td>
                                    <td class="remise">{{$ligne->remise}}%</td>
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
        <div class="well">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <a href="{{route('factures.visualise',$facture->id)}}" target="_blank" title="aperçu de la facture" class="btn btn-info"><i class="fa fa-search"></i>&nbsp;visualiser</a>
                    <div class="divider col-xs-12 " style="height: 10px"></div>
                    <form id="valideForm" method="post" action="{{route('factures.valide',$facture->id)}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check"></i>
                            Valider cette facture
                        </button>
                    </form>
                </div>
                <div class="divider col-xs-12 hidden-sm hidden-md hidden-lg" style="height: 10px"></div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <table class="table table-bordered">
                        <tr>
                            <th>Total HT</th>
                            <td id="totauxTotalHT" class="text-right">{{number_format($totaux['totalHT'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Total HT après remise</th>
                            <td id="totauxTotalHTRemise" class="text-right">{{number_format($totaux['totalHTApresRemise'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Total TVA</th>
                            <td id="totauxTotalTva" class="text-right">{{number_format($totaux['totalTVA'],2,',',' ')}}€</td>
                        </tr>
                        <tr>
                            <th>Total TTC</th>
                            <td id="totauxTotalTTC" class="text-right">{{number_format($totaux['totalTTC'],2,',',' ')}}€</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>

        /*-----------------------------------------*/
        /*                   init                  */
        /*-----------------------------------------*/

        idFacture = '<?php echo $facture->id ?>';
        idGroupeEnCours = null;
        idLigneEncours = null;

        $(function(){

            init();

            function init(){
                refreshEvent();
            }

            /*-----------------------------------------*/
            /*                  event                  */
            /*-----------------------------------------*/

            $('.deleteLigne').on('click',deleteLigne);

            $('.editLigne').on('click',editLigne);

            $('.deleteCarGroupe').on('click',deleteAutoGroupe);

            $('.addAutoGroupe').on('click',addAutoGroupe);

            $('.editCarGroupe').on('click',editAutoGroupe);

            $('#valideForm').on('submit',function(e){
                if(!confirm('Êtes vous sûr ? Vous ne pourrez plus modifier cette facture')){
                    e.preventDefault();
                }
            });
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

        function editLigne() {
            idGroupeEnCours = $(this).parents('.groupeLigne').data('idGroupe');
            idLigneEnCours = $(this).parents('tr').data('idLigne');
            loadLigneInEditModal($(this).parents('tr'));
            $('#modalEdit').modal('show');
        }

        function addAutoGroupe(){
            idGroupeEnCours = $(this).parents('.groupeLigne').data('idGroupe');
            $('#modalAddAuto').modal('show');
        }

        function editAutoGroupe(){
            idGroupeEnCours = $(this).parents('.groupeLigne').data('idGroupe');
            loadAutoGroupInfo();
            $('#modalAddAuto').modal('show');
        }

        function deleteAutoGroupe(){
            idGroupeEnCours = $(this).parents('.groupeLigne').data('idGroupe');
            if(confirm('Êtes vous sûr de vouloir supprimer les réréfence à cette auto ?')){
                setAjaxLoaderFullPage(true,'Suppression en cours');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'{{route('groupeLignes.deleteHeader')}}',
                    dataType:'json',
                    type:'post',
                    data:{
                        idGroupe : idGroupeEnCours,
                        idFacture : idFacture
                    },
                    success:function(res){
                        if(res.success){
                            //todo faire ça correctement
                            location.reload();

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
            }
        }

        /**
         *
         * permet de supprimer une ligen
         *
         * */
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
                            updateTotaux(res.totaux);
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
            newLigne = $('<tr data-id-ligne="'+ligne.id+'"><td class="libelle">'+ligne.libelle+'</td><td class="prix">'+ligne.prix_unitaire_HT+'</td><td class="quantite">'+ligne.quantite+'</td><td class="remise">'+ligne.remise+'%</td><td class="text-right">'+calculTotalLigne(ligne)+'€</td></tr>');
            //on y ajoute le btn suppression
            var tdBtn = $('<td></td>');

            var deleteBtn = $('<button class="btn btn-sm btn-danger deleteLigne"><i class="fa fa-trash"></i></button>');
            deleteBtn.on('click',deleteLigne);
            tdBtn.append(deleteBtn);
            //on y ajoute le bouton d'edition
            var editBtn = $('<button class="btn btn-sm btn-warning editLigne"><i class="fa fa-edit"></i></button>');
            editBtn.on('click',editLigne);
            tdBtn.append(editBtn);
            //on affiche
            newLigne.append(tdBtn);
            $('.groupeLigne[data-id-groupe="'+idGroupe+'"]').find('.listeLigneGroupe').append(newLigne);
            updateTotalGroupe(idGroupe,sousTotalGroupe);
        }

        /**
         *
         * met a jour un e;igne modifier ainsi que les totaux
         *
         * */
        function updateLigneToGroupe(idGroupe,ligne,sousTotalGroupe){
            var trLigne = $('tr[data-id-ligne="'+ligne.id+'"]');
            trLigne.find('.libelle').text(ligne.libelle);
            trLigne.find('.quantite').text(ligne.quantite);
            trLigne.find('.prix').text(ligne.prix_unitaire_HT);
            trLigne.find('.remise').text(ligne.remise+'%');
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

        /**
         *
         * @param ligneDom
         * charge les donnees de la ligne dans la modal d'edition de ligne
         */
        function loadLigneInEditModal(ligneDom){
            $('#libelleEdit').val(ligneDom.find('.libelle').text());
            $('#quantiteEdit').val(ligneDom.find('.quantite').text());
            $('#prixEdit').val(ligneDom.find('.prix').text().replace(',','.'));
            $('#remiseEdit').val(ligneDom.find('.remise').text().replace(',','.').replace('%',''));
        }

        function updateTotaux(totaux){
            $('#totauxTotalHT').text(totaux.totalHT+'€');
            $('#totauxTotalHTRemise').text(totaux.totalHTApresRemise+'€');
            $('#totauxTotalTva').text(totaux.totalTVA+'€');
            $('#totauxTotalTTC').text(totaux.totalTTC+'€');
        }

        function loadAutoGroupInfo(){
            var group = $('.groupeLigne[data-id-groupe="'+idGroupeEnCours+'"]');
            console.log(group.find('.autoHeaderAutoId').val());
            $('#auto').val(group.find('.autoHeaderAutoId').val());
            $('#kilometrage').val(group.find('.autoHeaderKilometrage').text());
            $('#dateAddAuto').val(group.find('.autoHeaderDate').text());
        }

    </script>
    @include('elements/factures/modalDecalaminage')
    @include('elements/factures/modalCustom')
    @include('elements/factures/modalMontage')
    @include('elements/factures/modalEdit')
    @include('elements/factures/modalAddAuto')
@endsection