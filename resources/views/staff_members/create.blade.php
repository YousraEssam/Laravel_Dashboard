@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('staff_members.index')}}">Staff Members</a>
</li>
<li class="active">
    <strong>Create New Staff Member Form</strong>
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
                <div class="ibox-title">
                    <h5>Create form</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Create New Staff Member</h3>
                            <form role="form" method="POST" action="{{ route('staff_members.store') }}" enctype='multipart/form-data'>
                                @csrf
                            <div class="form-group">
                                <label>Member Image</label>
                                <input type="file" placeholder="Member Image" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label>Member First Name</label>
                                <input type="text" placeholder="Member First Name" class="form-control" name="first_name">
                            </div> 
                            
                            <div class="form-group">
                                <label>Member Last Name</label>
                                <input type="text" placeholder="Member Last Name" class="form-control" name="last_name">
                            </div>

                            <div class="form-group">
                                <label>Member Email Address</label>
                                <input type="email" placeholder="Member Email Address" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>Member Phone Number</label>
                                <input type="tel" placeholder="Member Phone Number" class="form-control" name="phone">
                            </div>

                            <div class="form-group">
                                <label>Member Gender</label> <br>
                                <select name="gender" class="form-control">
                                    <option value="">Member Gender</option>
                                    @foreach ($types as $type)
                                        <option value="{{$type}}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member Job</label> <br>
                                <select name="job_id" placeholder="Member Job" class="form-control">
                                    <option value="">Member Job</option>
                                    @foreach($jobs as $key => $value)
                                    <option value="{{ $key }}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member Role</label> <br>
                                <select name="role_id" placeholder="Member Role" class="form-control">
                                    <option value="">Member Role</option>
                                    @foreach($roles as $key => $value)
                                        <option value="{{ $key }}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member Country</label> <br>
                                <select id="country" name="country_id" placeholder="Member Country" class="form-control">
                                <option value="">Member Country</option>
                                    @foreach($countries as $key => $value)
                                    <option {{ (old("country_id") == $key ? "selected":"") }} value="{{ $key }}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member City</label> <br>
                                <select id="city" name="city_id" placeholder="Member City" class="form-control">
                                    <option value="">Member City</option>  
                                </select>
                            </div>

                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
                            </div>

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
{!! JsValidator::formRequest('App\Http\Requests\StaffMemberRequest') !!}
@endpush