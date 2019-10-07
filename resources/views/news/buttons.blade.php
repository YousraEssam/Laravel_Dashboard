<td class="center">

    <a href="{{route('news.show', $id)}}" class="btn btn-success">Show</a>

    @can('news-edit')
    <a href="{{route('news.edit', $id)}}" class="btn btn-success">Edit</a>
    @endcan

    @can('news-delete')
    <form action="{{route('news.destroy', $id)}}" method="POST" style="display:inline;">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcan
    
</td>