@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('staff_members.index')}}">Staff Members</a>
</li>
<li class="active">
    <strong>Staff Member "{{$staffMember->name}}" Details</strong>
</li>
@endsection

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="order_id">Member ID:</label>
                    <h4> {{$staffMember->id}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Image:</label>
                    <img src="{{ asset('images/'. $staffMember->image)}}" style="height:50px; width:50px;">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="status">Member Name:</label>
                    <h4> {{$staffMember->first_name}} {{$staffMember->last_name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member Job:</label>
                    <h4> {{$staffMember->job->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member Role:</label>
                    <h4> {{$staffMember->role->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member City:</label>
                    <h4> {{$staffMember->city->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member Country:</label>
                    <h4> {{$staffMember->city->country->name}} </h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label" for="customer">Member Active?</label>
                    <h4> {{$staffMember->isActive}} </h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 