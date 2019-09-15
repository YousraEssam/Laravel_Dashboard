@extends('layouts.home')

@section('rolestable')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="{{route('home')}}">Home</a>
            </li>
            <li>
                <a href="{{route('roles.index')}}">Roles</a>
            </li>
            <li class="active">
                <strong>Role {{$role->name}} Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="order_id">Role ID</label>
                    <h4> {{$role->id}} </h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">Role Name</label>
                    <h4> {{$role->name}} </h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="customer">Role Description</label>
                    <h4> {{$role->description}} </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="date_added">Assigned Permissions</label>
                    <div class="input-group date">
                        @foreach($rolePermissions as $rp)
                            <ul>
                                <li>{{$rp->name}}</li>
                            </ul>
                            @endforeach                
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection