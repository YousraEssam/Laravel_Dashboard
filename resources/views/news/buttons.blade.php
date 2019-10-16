<td class="center">

    <a href="{{route('news.show', $row->id)}}" class="btn btn-success">Show</a>

    @can('news-edit')
    <a href="{{route('news.edit', $row->id)}}" class="btn btn-success">Edit</a>
    @endcan

    @can('news-delete')
    <form action="{{route('news.destroy', $row->id)}}" method="POST" style="display:inline;">
        @csrf
        @method("DELETE")
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    @endcan
    
    <div class="toggle-btn @if($row->is_published) active @endif">
    <input type="checkbox" id="{{$row->staffMember->user->first_name.$row->id}}" @if($row->is_published) checked @endif class="cb-value" onclick="return confirm('Are You Sure?')" />
        <span class="round-btn"></span>
    </div>
</td>

<script>
    $('#{{$row->staffMember->user->first_name.$row->id}}').click(function() {
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
            url: "{{route('toggleNews', $row)}}",
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