@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('library.folders.index')}}">Folders</a>
</li>
<li class="active">
    <strong>Folder "{{$folder->name}}" Details</strong>
</li>
@endsection

<div class="ibox-content m-b-sm border-bottom">
    <div class="row">
        @if(! $folder->image)
        <div class="col-sm-4">
            <div class="form-group">
                <a href="{{ route('library.files.images.create', $folder->id) }}" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
                    Add Image
                </a>
            </div>
        </div>
        @endif
        @if( ! $folder->file)
        <div class="col-sm-4">
            <div class="form-group">
                <a href="{{ route('library.files.files.create', $folder->id) }}" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
                    Add File
                </a>
            </div>
        </div>
        @endif
        @if(! $folder->video)
        <div class="col-sm-4">
            <div class="form-group">
                <a href="{{ route('library.files.videos.create', $folder->id) }}" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>
                    Add Video
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="order_id">Folder ID</label>
                    <h4> {{$folder->id}} </h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">Folder Name</label>
                    <h4> {{$folder->name}} </h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="customer">Folder Description</label>
                    <h4> {{$folder->description}} </h4>
                </div>
            </div>
            @if($folder->image)
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="customer">Image</label>
                    <img src="{{Storage::url($folder->image->url)}}" style="height:80px; width:80px;">
                </div>
                <a href="{{ route('library.files.images.edit', [$folder->id, $folder->image->id]) }}" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    Edit Image
                </a>
                <form action="{{route('library.files.images.destroy', [$folder->id, $folder->image->id])}}" method="POST" style="display:inline;">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            @endif

            @if($folder->file)
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">File</label><br>
                    <a href="{{Storage::url($folder->file->file_url)}}" >{{explode("/",$folder->file->file_url)[3]}}</a><br>
                    <a href="{{ route('library.files.files.edit', [$folder->id, $folder->file->id]) }}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        Edit File
                    </a>
                    <form action="{{route('library.files.files.destroy', [$folder->id, $folder->file->id])}}" method="POST" style="display:inline;">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endif
            @if($folder->video)
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">Video</label><br>
                    <a href="{{Storage::url($folder->video->url)}}" >{{explode("/",$folder->video->url)[3]}}</a><br>
                    <a href="{{ route('library.files.videos.edit', [$folder->id, $folder->video->id]) }}" class="btn btn-primary btn-sm">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        Edit Video
                    </a>
                    <form action="{{route('library.files.videos.destroy', [$folder->id, $folder->video->id])}}" method="POST" style="display:inline;">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
