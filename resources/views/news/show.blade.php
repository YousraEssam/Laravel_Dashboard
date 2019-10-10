@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('news.index')}}">News</a>
</li>
<li class="active">
    @if($news->type == "News")
    <strong>News "{{$news->main_title}}" Details</strong>
    @elseif($news->type == "Article")
    <strong>Article "{{$news->main_title}}" Details</strong>
    @endif
</li>
@endsection

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="order_id">ID:</label>
                    <h4> {{$news->id}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Main Title:</label>
                    <h4> {{$news->main_title}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Secondary Title:</label>
                    <h4> {{$news->secondary_title}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Content:</label>
                    <h4> {!!$news->content!!} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Type:</label>
                    <h4> {{$news->type}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Author:</label>
                    <h4> {{$news->staffMember->job->name}} ==> {{$news->staffMember->user->getFullNameAttribute()}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Published?</label>
                    @if($news->is_published == 1)
                    <h4> Published </h4>
                    @elseif($news->is_published == 0)
                    <h4> Not Published </h4>
                    @endif
                </div>
            </div>
            @if($news->images)
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Images:</label><br>
                    @foreach($news->images as $image)
                    <img src="{{Storage::url($image->url)}}" style="height:50px; width:50px;">
                    @endforeach
                </div>
            </div>
            @endif
            @if($news->files)
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Files:</label><br>
                    @foreach($news->files as $file)
                    <a href="{{Storage::url($file->file_url)}}" >{{explode("/",$file->file_url)[4]}}</a><br>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection 