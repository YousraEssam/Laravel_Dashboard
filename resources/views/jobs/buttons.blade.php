<td class="center">

        <a href="{{route('jobs.show', $id)}}" class="btn btn-success">Show</a>

    @if(! ($name == 'Writer' || $name == 'Reporter' ) )
        @can('job-edit')
        <a href="{{route('jobs.edit', $id)}}" class="btn btn-success">Edit</a>
        @endcan
        @can('job-delete')
        <form action="{{route('jobs.destroy', $id)}}" method="POST" style="display:inline;">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        @endcan
    @endif
    </td>