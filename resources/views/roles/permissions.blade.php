@if($row->permissions !== [])
<td>
    @foreach($row->permissions as $rp)
    <ul style="width:25%; display:inline-block; float:left;">
        <li>{{$rp->name}}</li>
    </ul>
    @endforeach
</td>
@else
<td>
    <ul style="width:25%; display:inline-block; float:left;">
        <li> N/A </li>
    </ul>
</td>
@endif