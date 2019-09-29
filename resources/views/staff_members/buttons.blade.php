<td class="center">

    <a href="{{route('staff_members.show', $id)}}" class="btn btn-success">Show</a>

    @can('staffmember-edit')
    <a href="{{route('staff_members.edit', $id)}}" class="btn btn-success">Edit</a>
    @endcan

    @can('staffmember-delete')
    <form action="{{route('staff_members.destroy', $id)}}" method="POST" style="display:inline;">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcan
    
</td>