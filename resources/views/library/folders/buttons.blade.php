@can('folder-crud')
<a href="{{route('library.folders.show', $row->id)}}" class="btn btn-success">Show</a>
<a href="{{route('library.folders.edit', $row->id)}}" class="btn btn-success">Edit</a>
<form action="{{route('library.folders.destroy', $row->id)}}" method="POST" style="display:inline;">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endcan
