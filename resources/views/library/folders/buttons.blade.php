@can('folder-add')
<a href="{{route('library.folders.show', $id)}}" class="btn btn-success">Show</a>
<a href="{{route('library.folders.edit', $id)}}" class="btn btn-success">Edit</a>
<form action="{{route('library.folders.destroy', $id)}}" method="POST" style="display:inline;">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
@endcan
