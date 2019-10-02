<td>
    <div class="toggle-btn @if($row->is_active) active @endif">
        <input type="checkbox" @if($row->is_active) checked @endif 
            class="cb-value" onclick="return confirm('Are You Sure?')" />
        <span class="round-btn"></span>
    </div>
</td>

<script>

$('.cb-value').click(function() {
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