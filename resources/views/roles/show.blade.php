@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('roles.index')}}">Roles</a>
</li>
<li class="active">
    <strong>Role "{{$role->name}}" Details</strong>
</li>
@endsection

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