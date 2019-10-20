<td class="center">
    @if($row->visitors !== [])
        @foreach ($row->visitors as $visitor)
        <ul>
            <li>{{ $visitor->user->getFullNameAttribute() }}</li>
        </ul>
        @endforeach
    @else
    <ul>
        <li> N/A </li>
    </ul>
    @endif
</td>