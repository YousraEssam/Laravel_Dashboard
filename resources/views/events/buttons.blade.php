<a href="{{route('events.show', $id)}}" class="btn btn-success">Show</a>

@can('event-edit')
<a href="{{route('events.edit', $id)}}" class="btn btn-success">Edit</a>
@endcan

@can('event-delete')
<form action="{{route('events.destroy', $id)}}" method="POST" style="display:inline;">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endcan