@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Create New Role Form</strong>
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
                        <div class="col-sm-12 b-r">
                            <form role="form" method="POST" action="{{ route('roles.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Role Name</label> 
                                    <input type="text" placeholder="Role" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Role Description</label>
                                    <input type="text" placeholder="Description" class="form-control" name="description">
                                </div>
                                <div class="form-group">
                                    <label>Role Permissions</label> <br>
                                    @if(!empty($permissions))
                                    @foreach($permissions as $permission)
                                    <input type="checkbox" name="permission[]" value="{{$permission->id}}"> {{$permission->name}}<br>
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