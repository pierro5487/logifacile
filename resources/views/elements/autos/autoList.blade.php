@forelse($autos as $auto)
    <tr>
        <td>{{$auto->immat}}</td>
        <td>{{$auto->marque}}</td>
        <td>{{$auto->modele}}</td>
        <td>{{!empty($auto->lastname)?mb_strtoupper($auto->lastname).' '.ucfirst($auto->firstname):'-'}}</td>
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