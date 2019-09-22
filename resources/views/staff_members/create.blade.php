@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
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
                    {!! Form::open(array('route' => 'staff_members.store','method'=>'POST', 'files' => true)) !!}
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Create New Staff Member</h3>
                        <div class="form-group">
                                {!! Form::label('Member Image', null, ['class' => 'control-label']) !!}

                                {!! Form::file('image', array('id' => 'image', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">

                                {!! Form::label('Member First Name', null, ['class' => 'control-label']) !!}

                                {!! Form::text('first_name', null, array('placeholder' => 'Member First Name', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Last Name', null, ['class' => 'control-label']) !!}

                                {!! Form::text('last_name', null, array('placeholder' => 'Member Last Name', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Email Address', null, ['class' => 'control-label']) !!}

                                {!! Form::email('email', null, array('placeholder' => 'Member Email Address', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Phone Number', null, ['class' => 'control-label']) !!}

                                {!! Form::tel('phone', null, array('placeholder' => 'Member Phone Number', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Gender', null, ['class' => 'control-label']) !!}

                                {!! Form::select('gender', ['Female' => 'Female', 'Male' => 'Male'], array('placeholder' => 'Member Gender', 'class' => 'form-control')) !!}

                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Job', null, ['class' => 'control-label']) !!}

                                {!! Form::select('job_id', $jobs, null, array('placeholder' => 'Member Job','class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Role', null, ['class' => 'control-label']) !!}

                                {!! Form::select('role_id', $roles, null, array('placeholder' => 'Member Role', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member City', null, ['class' => 'control-label']) !!}

                                {!! Form::select('city_id', $cities, null, array('placeholder' => 'Member City', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Country', null, ['class' => 'control-label']) !!}

                                {!! Form::select('country_id', $countries, null, array('placeholder' => 'Member Country', 'class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('Member Activity', null, ['class' => 'control-label']) !!}

                                {!! Form::select('isActive', [1 => 'Active', 0 => 'Not Active'], array('placeholder' => 'Member Gender', 'class' => 'form-control')) !!}
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