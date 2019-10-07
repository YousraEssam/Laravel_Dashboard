@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Create new News Form</strong>
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
                    <h5>Create form</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Create News/Article</h3>
                            <form role="form" method="POST" action="{{ route('news.store') }}" enctype='multipart/form-data'>
                                @csrf
                                <div class="form-group">
                                    <label>Main Title</label>
                                    <input type="text" placeholder="Main Title" class="form-control" name="main_title" id="main">
                                </div>

                                <div class="form-group">
                                    <label>Secondary Title</label>
                                    <input type="text" placeholder="Secondary Title" class="form-control" name="secondary_title" id="secondary">
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea type="text" placeholder="Content" class="form-control" name="content" id="content"> </textarea>
                                </div>

                                <div class="form-group">
                                    <label>News Type</label> <br>
                                    <select id="type" name="type" class="form-control">
                                        <option value="">Type</option>
                                        <option value="News">News</option>
                                        <option value="Article">Article</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>News Author</label> <br>
                                    <select id="author_name" name="author_id" placeholder="Author" class="form-control">
                                        <option value="">Author</option>
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
    ClassicEditor
    .create( document.querySelector('#content') )
    .then( editor => {
        console.log( content )
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
</script>
@endsection

@push('JSValidatorScript')
{{-- <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script> --}}
{{-- {!! JsValidator::formRequest('App\Http\Requests\NewsRequest') !!} --}}
@endpush