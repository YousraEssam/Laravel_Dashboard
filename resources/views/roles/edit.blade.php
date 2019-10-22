@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Edit Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('roles.index')}}">Roles</a>
</li>
<li class="active">
    <strong>Edit Form</strong>
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
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Role</h3>
                            <form role="form"  method="POST" action="{{ route('roles.update',$role->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Role Name</label> 
                                    <input type="text" class="form-control" value="{{$role->name}}" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Role Description</label> 
                                    <input type="text" class="form-control" value="{{$role->description}}" name="description">
                                </div>
                                <div class="form-group">
                                    <label>Role Permissions</label><br>
                                    @if(!empty($allPermissions)) 
                                    @foreach($allPermissions as $rp)
                                        @if(in_array($rp->name, $rolePermissions))
                                        <input type="checkbox" name="permission[]" value="{{$rp->id}}" checked>{{$rp->name}}
                                        @else
                                        <input type="checkbox" name="permission[]" value="{{$rp->id}}">{{$rp->name}}
                                        @endif
                                    @endforeach
                                    @endif
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
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
{!! JsValidator::formRequest('App\Http\Requests\RoleRequest') !!}
@endpush