<td class="center">

    <a href="{{route('visitors.show', $row->id)}}" class="btn btn-success">Show</a>

    @can('visitor-edit')
    <a href="{{route('visitors.edit', $row->id)}}" class="btn btn-success">Edit</a>
    @endcan

    @can('visitor-delete')
    <form action="{{route('visitors.destroy', $row->id)}}" method="POST" style="display:inline;">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcan
        
    <div class="toggle-btn @if($row->user->is_active) active @endif">
        <input id="{{$row->user->first_name.$row->id}}" type="checkbox" @if($row->user->is_active) checked @endif 
            class="cb-value" onclick="return confirm('Are You Sure?')" />
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
        url: "{{route('toggleVisitor', $row)}}",
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