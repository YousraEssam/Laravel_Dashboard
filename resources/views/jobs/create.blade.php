@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Create New Job Form</strong>
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
                    {!! Form::open(array('route' => 'jobs.store','method'=>'POST')) !!}
                    <div class="row">
                        <div class="col-sm-12 b-r">
                            <div class="form-group">
                                <strong>Job Name</strong>
                                {!! Form::text('name', null, array('placeholder' => 'Job Name','class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                <strong>Job Description</strong>
                                {!! Form::text('description', null, array('placeholder' => 'Job Description','class' => 'form-control')) !!}
                            </div>
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection