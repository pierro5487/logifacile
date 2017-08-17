@forelse($clients as $client)
    <tr>
        <td>{{mb_strtoupper($client->lastname).' '.ucfirst($client->firstname)}}</td>
        <td>{{$client->VILLE}}</td>
        <td>
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