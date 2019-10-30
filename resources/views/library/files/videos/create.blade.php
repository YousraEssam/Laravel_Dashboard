@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('library.folders.show', $folder->id)}}">Folder {{ $folder->name }}</a>
</li>
<li class="active">
    <strong>Create new Video Form</strong>
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
                        <div class="col-sm-12 b-r">
                            <h3 class="m-t-none m-b">Add Video</h3>
                            <form role="form" method="POST"
                                action="{{ route('library.files.videos.store', $folder->id) }}"
                                enctype='multipart/form-data'>
                                @csrf

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" placeholder="File Name" class="form-control" name="name"
                                        id="name">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" placeholder="Description" class="form-control" name="description"
                                        id="description">
                                </div>

                                <div class="form-group">
                                    <div>
                                        <input type="radio" name="radio" id="radio1" value="option1">
                                        <label>Upload From your PC</label>
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename"></span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">Select Video</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="video">
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                                data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>

                                    <div>
                                        <input type="radio" name="radio" id="radio2" value="option2">
                                        <label>Upload From Youtube</label>
                                        <input type="text" class="form-control" name="video" id="video">
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"
                                        type="submit"><strong>Submit</strong></button>
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

@section('uploadVideoScript')
<script>
    $("input[name=radio]").click(function(){
        let radio = $("input[name='radio']:checked");
        radio.parent().siblings().hide();
    })
</script>
@endsection

@push('JSValidatorScript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\VideoRequest') !!}
@endpush
