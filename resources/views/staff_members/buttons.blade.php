<td class="center">

    <a href="{{route('staff_members.show', $row->id)}}" class="btn btn-success">Show</a>

    @can('staffmember-edit')
    <a href="{{route('staff_members.edit', $row->id)}}" class="btn btn-success">Edit</a>
    @endcan

    @can('staffmember-delete')
    <form action="{{route('staff_members.destroy', $row->id)}}" method="POST" style="display:inline;">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcan
    
    <div class="toggle-btn @if($row->user->is_active) active @endif">
    <input type="checkbox" @if($row->user->is_active) checked @endif class="cb-value" onclick="return confirm('Are You Sure?')" id="{{$row->user->first_name.$row->id}}"/>
        <span class="round-btn"></span>
    </div>
</td>

<script>

$('#{{$row->user->first_name.$row->id}}').click(function() {
    var mainParent = $(this).parent('.toggle-btn');
    if($(mainParent).find('input.cb-value').is(':checked')) {
        $(mainParent).addClass('active');
    } else {
        $(mainParent).removeClass('active');
    }
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
console.log(csrf_token)
    $.ajax({
        type: 'PUT',
        url: "{{route('toggleStaff', $row)}}",
        headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success:function(res){
            console.log(res)
        },
        error: function(){
            alert("Error")
        }
    });
});
</script>