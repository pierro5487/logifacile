<li class="active">
    <a href="{{route('home')}}"><i class="fa fa-fw fa-dashboard"></i> Tableau de bord</a>
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
            {{--<a href="{{route('autos.liste')}}">Liste</a>--}}
        </li>
        <li>
            <a href="{{route('autos.add')}}">Ajouter</a>
        </li>
    </ul>
</li>
<li>
    <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
</li>
<li>
    <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
</li>