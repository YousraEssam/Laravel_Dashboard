@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Edit Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('news.index')}}">News</a>
</li>
<li class="active">
    <strong>Edit News/Articles Form</strong>
</li>
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit form</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit News/Article</h3>
                            <form role="form" method="POST" action="{{ route('news.update',$news->id) }}" enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Main Title</label>
                                    <input type="text" value="{{$news->main_title}}" class="form-control" name="main_title">
                                </div>

                                <div class="form-group">
                                    <label>Secondary Title</label>
                                    <input type="text" value="{{$news->secondary_title}}" class="form-control" name="secondary_title">
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea type="text" class="form-control" name="content" id="content"> {{$news->content}} </textarea>
                                </div>

                                <div class="form-group">
                                    <label>News Type</label> <br>
                                    <select id="type" name="type" class="form-control" >
                                        @foreach ($types as $type)
                                            <option value="{{$type}}" {{ $type == $news->type ? "selected" : "" }}>{{$type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>News Author</label> <br>
                                    <select id="author_name" name="author_id" class="form-control">
                                        <option value="{{$news->staffMember->job->id}}">{{$news->staffMember->user->first_name}} {{$news->staffMember->user->last_name}}</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Upload Images</label>
                                    <div class="dropzone" id="dropzoneFormImage">
                                        
                                    </div>
                                    <label for="images">
                                        @foreach ($images as $image)
                                            {{explode("/",$image->url)[4]}} <br>
                                        @endforeach
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Upload Files</label>
                                    <div class="dropzone" id="dropzoneFormFile">
                                        
                                    </div>
                                    <label for="files">
                                        @foreach ($files as $file)
                                            {{explode("/",$file->file_url)[4]}} <br>
                                        @endforeach
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label>Choose Related News</label>
                                    <select data-placeholder="Choose Related..." class="chosen-select" multiple style="width:350px;" tabindex="4" name="related[]" id="related">
                                        <option value="">Select</option>
                                        @foreach ($all_news as $key => $value)
                                            @if(in_array($key, $related_news))
                                                <option value="{{$key}}" selected>{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('textarea')
<script>
    let editor;

    ClassicEditor
    .create( document.querySelector('#content') )
    .then( newEditor => {
        editor = newEditor;
    })
    .catch( error => {
        console.error( error )
    });
</script>
@endsection

@section('newsscript')
<script>
    $('#type').change(function(){
        var type = $(this).val();
        if(type){
            $.ajax({
                type:"GET",
                url: "{{url('get-author-list')}}/"+type,
                success:function(res){
                    if(res){
                        $("#author_name").empty();
                        $("#author_name").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            console.log("key -> "+key);
                            console.log("value -> ");
                            console.log(value);
                            console.log("value id -> "+value.id);
                            console.log("job id -> "+value.job_id)
                            $("#author_name").append('<option {{old("author_id")=="'+value.job_id+'" ? "selected" : "" }} value="'+value.id+'">'+value.user.first_name+' '+value.user.last_name+'</option>');
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
</script>
@endsection

@section('Imagedropzone')
<script>
    Dropzone.autoDiscover = false;
    var uploadedImageMap = {}
    $(document).ready( function() {
        var imageDropZone = new Dropzone("#dropzoneFormImage",{
            paramName: "image", // The name that will be used to transfer the file
            url: "{{ route('uploadImage') }}",
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            dictDefaultMessage: "<strong>Drop Images here or click to upload. </strong></br>",
            acceptedFiles: ".png,.jpg",
            maxThumbnailFilesize: 1, //MB
            addRemoveLinks: true,
            success: function(file, response) {
                $('form').append('<input type="hidden" name="image[]" value="'+response.name+'" >')
                uploadedImageMap[file.name] = response.name
            },
            removedFile: function(file) {
                file.previewElement.remove()
                var name = ''
                if(typeof(file.file_name !== 'undefined')){
                    name = file.file_name
                }else{
                    name = uploadedImageMap[file.name]
                }
                $('form').find('input[name="image[]"][value="'+name+'"]').remove() 
            },
        });
    });
</script>
@endsection

@section('Filedropzone')
<script>
    Dropzone.autoDiscover = false;
    var uploadedFileMap = {}
    $(document).ready( function() {
        var FileDropZone = new Dropzone("#dropzoneFormFile",{
            paramName: "file", // The name that will be used to transfer the file
            url: "{{ route('uploadFile') }}",
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            dictDefaultMessage: "<strong>Drop Files here or click to upload. </strong></br>",
            acceptedFiles: ".pdf,.xls",
            maxThumbnailFilesize: 1, //MB
            addRemoveLinks: true,
            success: function(file, response) {
                console.log(response.name)
                console.log(file.name)
                $('form').append('<input type="hidden" name="file[]" value="'+response.name+'" >')
                uploadedFileMap[file.name] = response.name
            },
            removedFile: function(file) {
                file.previewElement.remove()
                var name = ''
                if(typeof(file.file_name !== 'undefined')){
                    name = file.file_name
                }else{
                    name = uploadedFileMap[file.name]
                }
                $('form').find('input[name="image[]"][value="'+name+'"]').remove() 
            },
        });
    });
</script>
@endsection

@section('PublishedNews')
<script>
    $('#related').select2({
        placeholder: 'Choose Related News',
        minimumInputLength: 2,
        ajax: {
            url: '{{ route("getPublishedNews") }}',
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
</script>
@endsection

@push('JSValidatorScript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\NewsRequest') !!}
@endpush