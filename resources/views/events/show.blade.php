@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('events.index')}}">Events</a>
</li>
<li class="active">
    <strong>Event "{{$event->main_title}}" Details</strong>
</li>
@endsection

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Cover Photo:</label>
                    <img src="{{Storage::url($cover)}}" style="height:70px; width:70px;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Main Title:</label>
                    <h4> {{$event->main_title}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Secondary Title:</label>
                    <h4> {{$event->secondary_title}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Content:</label>
                    <h4> {!!$event->content!!} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Invited:</label>
                    @foreach ($event->visitors as $visitor)
                        <ul>
                            <li>{{ $visitor->user->getFullNameAttribute() }}</li>
                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Start Date:</label>
                    <h4> {{$event->start_date}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">End Date:</label>
                    <h4> {{$event->end_date}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Location:</label>
                    <h4> {{$event->address_address}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Published?</label>
                    @if($event->is_published == 1)
                    <h4> Published </h4>
                    @elseif($event->is_published == 0)
                    <h4> Not Published </h4>
                    @endif
                </div>
            </div>
            @if($event->images)
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Event Images:</label><br>
                    @foreach($event->images as $image)
                    <img src="{{Storage::url($image->url)}}" style="height:50px; width:50px;">
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection 