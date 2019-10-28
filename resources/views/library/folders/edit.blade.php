@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('library.folders.index')}}">Folders</a>
</li>
<li class="active">
<strong>Edit Folder {{ $folder->name }} Form</strong>
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
                            <h3 class="m-t-none m-b">Edit Folder</h3>
                            <form role="form" method="POST" action="{{ route('library.folders.update', $folder->id) }}"
                                enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Name</label>
                                <input type="text" value="{{$folder->name}}" class="form-control" name="name" id="name">
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" value="{{$folder->description}}" class="form-control" name="description" id="description">
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
{!! JsValidator::formRequest('App\Http\Requests\FolderRequest') !!}
@endpush
