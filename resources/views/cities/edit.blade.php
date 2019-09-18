@extends('layouts.home')

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Edit Form</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{url('/home')}}">Home</a>
            </li>
            <li class="active">
                <strong>Edit Form</strong>
            </li>
        </ol>
    </div>
</div>

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
                    {!! Form::model($city, ['method' => 'PATCH','route' => ['cities.update', $city->id]]) !!}
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Role</h3>
                            <div class="form-group">
                                <strong>City Name</strong>
                                {!! Form::text('name', null, array('placeholder' => 'City Name','class' => 'form-control')) !!}
                            </div>

                            <div class="form-group">
                                <strong>Country Name</strong>
                                {!! Form::select('country_id', $countries,null, array('class' => 'form-control')) !!}
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