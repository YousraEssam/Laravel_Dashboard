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
                    <label class="control-label" for="order_id">Member ID:</label>
                    <h4> {{$visitor->id}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Image:</label>
                    <img src="{{Storage::url($visitor->image)}}" style="height:50px; width:50px;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Name:</label>
                    <h4> {{$visitor->user->first_name}} {{$visitor->user->last_name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Email:</label>
                    <h4> {{$visitor->user->email}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Phone Number:</label>
                    <h4> {{$visitor->user->phone}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member City:</label>
                    <h4> {{$visitor->city->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member Country:</label>
                    <h4> {{$visitor->city->country->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member Active?</label>
                    <h4> {{$visitor->is_active}} </h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 