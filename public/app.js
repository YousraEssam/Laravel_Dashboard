//city script
$('#country').change(function(){
    var countryID = $(this).val();
    console.log(countryID);
    if(countryID){
        $.ajax({
            type:"GET",
            url: window.location.origin + "/get-city-list/" + countryID,
            success:function(res){
                if(res){
                    $("#city").empty();
                    $("#city").append('<option>Select</option>');
                    $.each(res,function(key,value){
                        $("#city").append('<option {{ old("city_id") =="'+key+'" ? "selected": ""}} value="'+key+'">'+value+'</option>');
                    });
                }else{
                    $("#city").empty();
                }
            }
        });
    }else{
        $("#city").empty();
    }
});

//textarea script
ClassicEditor
.create( document.querySelector('#content') )
.catch( error => {
    console.error(error)
});

//news author script
$('#type').change(function(){
    var type = $(this).val();
    if(type){
        $.ajax({
            type:"GET",
            url: window.location.origin+'/get-author-list/'+type,
            success:function(res){
                if(res){
                    $("#author_name").empty();
                    $("#author_name").append('<option>Select</option>');
                    $.each(res,function(key,value){
                        console.log("key -> "+key);
                        console.log("value -> ");
                        console.log(value);
                        console.log("value id -> "+value.id);
                        $("#author_name").append('<option {{old("author_id")=="'+key+'" ? "selected" : "" }} value="'+value.id+'">'+value.user.first_name+' '+value.user.last_name+'</option>');
                    });
                }else{
                    $("#author_name").empty();
                }
            }
        });
    }else{
        $("#author_name").empty();
    }
});

//PublishedNews
$('#related').select2({
    placeholder: 'Choose Related News',
    minimumInputLength: 2,
    ajax: {
        url: window.location.origin + '/get_published_news',
        dataType: 'json',
        data: function(params){
            return {
                q: $.trim(params.term)
            }
        },
        processResults: function (data) {
            console.log(data)
            return {
                results: data
            };
        },
        max_selected_options: 10
        // cache: true
    }
});

// DatePicker Script
const options = {
    format: "Y-M-D H:m:s",
    sideBySide: true,
};

$(function() {
    $('#datetimepicker1').datetimepicker(options);
    $('#datetimepicker2').datetimepicker(options);
});

//Event Visitors
$('#visitors').select2({
    placeholder: 'Choose Invited ',
    minimumInputLength: 2,
    ajax: {
        url: window.location.origin + '/get_event_visitors',
        dataType: 'json',
        data: function(params){
            return {
                q: $.trim(params.term)
            }
        },
        processResults: function (data) {
            console.log(data)
            return {
                results: data
            };
        },
    }
});