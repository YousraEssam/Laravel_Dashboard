<td class="center">

    <a href="{{route('visitors.show', $id)}}" class="btn btn-success">Show</a>

    @can('visitor-edit')
    <a href="{{route('visitors.edit', $id)}}" class="btn btn-success">Edit</a>
    @endcan

    @can('visitor-delete')
    <form action="{{route('visitors.destroy', $id)}}" method="POST" style="display:inline;">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcan
        
</td>