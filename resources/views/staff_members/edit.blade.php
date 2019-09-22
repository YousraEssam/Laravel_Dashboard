@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Edit Form</h2>
@endsection

@section('titlebreadcrumb')
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
                    {!! Form::model($staffMember, ['method' => 'PATCH','route' => ['staff_members.update', $staffMember->id], 'files' => true]) !!}
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Role</h3>
                            <div class="form-group">
                                {!! Form::label('Member Image', null, ['class' => 'control-label']) !!}

                                {!! Form::file('image', null, array('placeholder' => $staffMember->image, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member First Name', null, ['class' => 'control-label']) !!}

                                {!! Form::text('first_name', null, array('placeholder' => $staffMember->first_name, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Last Name', null, ['class' => 'control-label']) !!}

                                {!! Form::text('last_name', null, array('placeholder' => $staffMember->last_name, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Email Address', null, ['class' => 'control-label']) !!}

                                {!! Form::email('email', null, array('placeholder' => $staffMember->email, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Phone Number', null, ['class' => 'control-label']) !!}

                                {!! Form::tel('phone', null, array('placeholder' => $staffMember->phone, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Gender', null, ['class' => 'control-label']) !!}

                                {!! Form::select('gender', ['Female' => 'Female', 'Male' => 'Male'], array('placeholder' => 'Member Gender', 'class' => 'form-control')) !!}
                            </div>
                            
                            <div class="form-group">
                                {!! Form::label('Member Job', null, ['class' => 'control-label']) !!}

                                {!! Form::select('job_id', $jobs,null, array('placeholder' => $staffMember->job->name,'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Role', null, ['class' => 'control-label']) !!}

                                {!! Form::select('role_id', $roles,null, array('placeholder' => $staffMember->role->name, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member City', null, ['class' => 'control-label']) !!}

                                {!! Form::select('city_id', $cities,null, array('placeholder' => $staffMember->city->name, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Country', null, ['class' => 'control-label']) !!}

                                {!! Form::select('country_id', $countries,null, array('placeholder' => $staffMember->country->name, 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Activity', null, ['class' => 'control-label']) !!}

                                {!! Form::select('isActive', [1 => 'Active', 0 => 'Not Active'], array('placeholder' => $staffMember->isActive, 'class' => 'form-control')) !!}
                            </div>

                            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary pull-right m-t-n-xs']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 