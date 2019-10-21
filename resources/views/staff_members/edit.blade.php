@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Edit Form</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('staff_members.index')}}">Staff Members</a>
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
                <div class="ibox-title">
                    <h5>Edit form</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Role</h3>
                            <form role="form" method="POST" action="{{ route('staff_members.update',$staffMember->id) }}" enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')

                            <div class="form-group">
                                <label>Member Image</label>
                                <input type="file" value="{{$staffMember->user->image}}" class="form-control" name="image">
                                <img src="{{Storage::url($staffMember->image->url)}}" style='height:50px; width:50px;'>

                            </div>

                            <div class="form-group">
                                <label>Member First Name</label>
                                <input type="text" value="{{$staffMember->user->first_name}}" class="form-control" name="first_name">
                            </div>

                            <div class="form-group">
                                <label>Member Last Name</label>
                                <input type="text" value={{$staffMember->user->last_name}} class="form-control" name="last_name">
                            </div>

                            <div class="form-group">
                                <label>Member Email Address</label>
                                <input type="email" value={{$staffMember->user->email}} class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>Member Phone Number</label>
                                <input type="tel" value={{$staffMember->user->phone}} class="form-control" name="phone">
                            </div>

                            <div class="form-group">
                                <label>Member Gender</label> <br>
                                <select name="gender" class="form-control">
                                    @foreach ($types as $type)
                                        <option value="{{$type}}" {{ $type == $staffMember->user->gender ? "selected" : "" }}>{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member Job</label> <br>
                                <select name="job_id" value="Member Job" class="form-control">
                                    @foreach($jobs as $key => $value)
                                        @if($key === $staffMember->job->id)
                                        <option selected value="{{ $key }}">{{$value}}</option>
                                        @else
                                        <option value="{{ $key }}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Member Role</label> <br>
                                <select name="role_id" value="Member Role" class="form-control">
                                    @foreach($roles as $key => $value)
                                        @if($key === $staffMember->role->id)
                                            <option selected value="{{ $key }}">{{$value}}</option>
                                        @else
                                            <option value="{{ $key }}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Member Country</label> <br>
                                <select id="country" name="country_id" value="Member Country" class="form-control">
                                    <option value="" disabled selected>{{$staffMember->user->country->name}}</option>
                                    @foreach($countries as $key => $value)
                                        <option {{ (old("country_id") == $key ? "selected":"") }} value="{{ $key }}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member City</label> <br>
                                <select id="city" name="city_id" value="Member City" class="form-control">
                                    <option value="{{$staffMember->user->city->id}}">{{$staffMember->user->city->name}}</option>
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