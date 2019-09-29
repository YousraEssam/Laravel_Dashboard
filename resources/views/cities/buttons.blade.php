<td class="center">

        <a href="{{route('cities.show', $id)}}" class="btn btn-success">Show</a>

        @can('city-edit')
        <a href="{{route('cities.edit', $id)}}" class="btn btn-success">Edit</a>
        @endcan
        @can('city-delete')
        <form action="{{route('cities.destroy', $id)}}" method="POST" style="display:inline;">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endcan
    </td>