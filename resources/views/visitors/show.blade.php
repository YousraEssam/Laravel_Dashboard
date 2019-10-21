@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('visitors.index')}}">Visitors</a>
</li>
<li class="active">
    <strong>Visitor "{{$visitor->user->getFullNameAttribute()}}" Details</strong>
</li>
@endsection

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="order_id">Visitor ID:</label>
                    <h4> {{$visitor->id}} </h4>
                </div>
            </div>
            @if($visitor->image)
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Visitor Image:</label>
                    <img src="{{Storage::url($visitor->image->url)}}" style="height:50px; width:50px;">
                </div>
            </div>
            @endif
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Visitor Name:</label>
                    <h4> {{$visitor->user->first_name}} {{$visitor->user->last_name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Visitor Email:</label>
                    <h4> {{$visitor->user->email}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Visitor Phone Number:</label>
                    <h4> {{$visitor->user->phone}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Visitor City:</label>
                    <h4> {{$visitor->city->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Visitor Country:</label>
                    <h4> {{$visitor->city->country->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Visitor Status</label>
                    @if($visitor->user->is_active == 1)
                    <h4> Active </h4>
                    @elseif($visitor->user->is_active == 0)
                    <h4> InActive </h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 