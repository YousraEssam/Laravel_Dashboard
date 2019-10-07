<td>
    @if($row)
        {{$row->staffMember->user->getFullNameAttribute()}}
    @else
        <p>---</p>
    @endif
</td>