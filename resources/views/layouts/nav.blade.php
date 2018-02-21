<li class="active">
    {{--<a href="{{route('home')}}"><i class="fa fa-fw fa-dashboard"></i> Tableau de bord</a>--}}
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#clientsNav"><i class="fa fa-users"></i> Clients <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="clientsNav" class="collapse">
        <li>
            <a href="{{route('clients.liste')}}">Liste</a>
        </li>
        <li>
            <a href="{{route('clients.add')}}">Ajouter</a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#autosNav"><i class="fa fa-car"></i> Autos <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="autosNav" class="collapse">
        <li>
            <a href="{{route('autos.index')}}">Liste</a>
        </li>
        <li>
            <a href="{{route('autos.add')}}">Ajouter</a>
        </li>
        <li>
            <a href="{{route('marques.index')}}">Marques auto</a>
        </li>
        <li>
            <a href="{{route('modeles.index')}}">Modèles auto</a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#adminNav"><i class="fa fa-user-secret"></i> Admin <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="adminNav" class="collapse">
        <li>
            <a href="{{route('modeles.upload')}}">Charge modele</a>
        </li>
        <li>
            <a href="{{route('marques.upload')}}">Charge marque</a>
        </li>
        <li>
            <a href="{{route('autos.upload')}}">Charge auto</a>
        </li>
        <li>
            <a href="{{route('clients.upload')}}">Charge client</a>
        </li>
    </ul>
</li>
<!--<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#montageNav"><i class="fa fa-life-ring"></i> Montages <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="montageNav" class="collapse">
        {{--<li>
            <a href="{{route('autos.index')}}">Liste</a>
        </li>--}}
        <li>
            <a href="{{route('montages.add')}}">Ajouter</a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#depannageNav"><i class="fa fa-road"></i> Dépannage/fourriere <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="depannageNav" class="collapse">²
       <li>
            <a href="{{route('autos.index')}}">Liste</a>
        </li>
        <li>
            <a href="{{route('autos.add')}}">Ajouter</a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#decalaminageNav"><i class="fa fa-leaf"></i> Décalaminage <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="decalaminageNav" class="collapse">
        <li>
            <a href="{{route('autos.index')}}">Liste</a>
        </li>
        <li>
            <a href="{{route('autos.add')}}">Ajouter</a>
        </li>
    </ul>
</li>-->
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#factureNav"><i class="fa fa-archive"></i> Factures <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="factureNav" class="collapse">
        <li>
            <a href="{{route('factures.index')}}">Liste</a>
        </li>
        <li>
            <a href="{{route('factures.add')}}">Ajouter</a>
        </li>
    </ul>
</li>