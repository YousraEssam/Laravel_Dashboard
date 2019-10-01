<td>
    @if($row)
        {{$row->user->getFullNameAttribute()}}
    @else
        <p>---</p>
    @endif
</td>