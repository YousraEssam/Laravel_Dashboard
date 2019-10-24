@foreach ($row->visitors as $visitor)
<ul>
    <li>{{ $visitor->user->getFullNameAttribute() }}</li>
</ul>
@endforeach
