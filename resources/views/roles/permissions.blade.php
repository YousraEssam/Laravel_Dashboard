@if($row->permissions !== [])
<td>
    @foreach($row->permissions as $rp)
    <ul>
        <li>{{$rp->name}}</li>
    </ul>
    @endforeach
</td>
@else
<td>
    <ul>
        <li> N/A </li>
    </ul>
</td>
@endif