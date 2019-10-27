<a href="{{route('roles.show', $id)}}" class="btn btn-success">Show</a>

@can('role-edit')
<a href="{{route('roles.edit', $id)}}" class="btn btn-success">Edit</a>
@endcan

@can('role-delete')
<form action="{{route('roles.destroy', $id)}}" method="POST" style="display:inline;">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endcan
