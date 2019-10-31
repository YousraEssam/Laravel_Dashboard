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
    <strong>Edit Image Form</strong>
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
                        <div class="col-sm-12 b-r">
                            <h3 class="m-t-none m-b">Edit Image</h3>
                            <form role="form" method="POST"
                                action="{{ route('library.files.images.update', [$folder->id, $image->id]) }}"
                                enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{ $image->name }}" class="form-control"
                                        name="name" id="name">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" value="{{ $image->description }}" class="form-control"
                                        name="description" id="description">
                                </div>

                                <div class="form-group">
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename">{{Storage::url($image->url)}}</span>
                                        </div>
                                        <img src="{{Storage::url($image->url)}}" style="height:80px; width:80px;">
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="image"></span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists"
                                            data-dismiss="fileinput">Remove</a>
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

@push('JSValidatorScript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\ImageRequest') !!}
@endpush
