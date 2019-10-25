@if($row->permissions !== [])
@foreach($row->permissions as $rp)
<ul style="width:25%; display:inline-block; float:left;">
    <li>{{$rp->name}}</li>
</ul>
@endforeach
@else
<ul style="width:25%; display:inline-block; float:left;">
    <li> N/A </li>
</ul>
@endif
