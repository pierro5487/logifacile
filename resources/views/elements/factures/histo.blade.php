@if(!empty($brouillons))
    <div class="alert alert-info">
        <i class="fa fa-info-circle "></i>&nbsp;Attention {{count($brouillons)}} facture(s) a été commencée(s) mais pas valideé(s).Vous pouvez completer une de ses factures ou bien en créer une nouvelle.
    </div>
@endif
@if(!empty($facturesNonReglees))
    <div class="alert alert-warning">
        <i class="fa fa-info-circle "></i>&nbsp;Attention {{count($facturesNonReglees)}} facture(s) n'a toujours pas été réglée(s).
    </div>
@endif
<div class="col-lg-12" id="brouillonBlock">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <span class="row">
                    <span>
                        &nbsp;<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Brouillon en cours
                    </span>
                    <span>
                        <a href="{{route('factures.forceCreateFacture')}}" class="btn btn-success pull-right">Créer une nouvelle facture</a>
                    </span>
                </span>
            </h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Total TTC</th>
                    <td>Actions</td>
                </tr>
                </thead>
                @forelse($brouillons as $brouillon)
                    <tr>
                        <td>
                            {{$brouillon['numero']}}
                        </td>
                        <td>{{number_format($brouillon->totaux['totalTTC'],2,',',' ')}}€</td>
                        <td class="">
                            <a href="{{route('factures.visualise',$brouillon['id'])}}" title="Voir cette facture" target="_blank" class="btn btn-success btn-small">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{route('factures.edit',$brouillon['id'])}}" title="Modifier cette facture" class="btn btn-warning btn-small">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form method="post" action="{{route('factures.delete',$brouillon['id'])}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="idFacture" value="{{$brouillon['id']}}"/>
                                <button type="submit" class="btn btn-small btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Aucun brouillon en cours</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
<div class="col-lg-12" id="nonSoldeBlock">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-euro" aria-hidden="true"></i>
                Factures non réglées
            </h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Total TTC</th>
                        <th>Solde</th>
                        <td>Actions</td>
                    </tr>
                </thead>
                @forelse($facturesNonReglees as $facture)
                    <tr>
                        <td>{{$facture['numero']}}</td>
                        <td class=" visible-sm visible-md visible-lg">{{number_format($facture['totaux']['totalTTC'],2,',',' ')}}€</td>
                        <td class="visible-sm visible-md visible-lg">
                            <span class="label label-danger">Reste {{ number_format($facture->totaux['solde'],2,',',' ')}}€</span>
                        </td>
                        <td class="btn-td">
                            <a href="{{route('factures.visualise',$facture['id'])}}" title="Voir cette facture" target="_blank" class="btn btn-success btn-small">
                                <i class="fa fa-search"></i>
                            </a>
                            <a href="{{route('reglements.add',$facture['id'])}}" title="Ajouter un reglement" class="btn btn-primary btn-small">
                                <i class="fa fa-money"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Aucune facture non soldée</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
<div class="col-lg-12" id="documentBlock">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa fa-history" aria-hidden="true"></i>
                Factures
            </h3>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Total TTC</th>
                    <th>Solde</th>
                    <td>Actions</td>
                </tr>
                </thead>
                @forelse($factures as $facture)
                    <tr>
                        <td>{{$facture['numero']}}</td>
                        <td class=" visible-sm visible-md visible-lg">{{number_format($facture['totaux']['totalTTC'],2,',',' ')}}€</td>
                        <td class="visible-sm visible-md visible-lg">
                            <span class="label label-success">Payé</span>
                        </td>
                        <td class="btn-td">
                            <a href="{{route('factures.visualise',$facture['id'])}}" title="Voir cette facture" target="_blank" class="btn btn-success btn-small">
                                <i class="fa fa-search"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">Aucune facture</td></tr>
                @endforelse
            </table>
        </div>
    </div>
</div>