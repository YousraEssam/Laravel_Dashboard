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
                <div class="ibox-content">
                    <form role="form"  method="POST" action="{{ route('jobs.update',$job->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Job</h3>
                                <div class="form-group">
                                    <strong>Job Name</strong>
                                    <input type="text" value="{{$job->name}}" class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <strong>Job Description</strong>
                                    <input type="text" value="{{$job->description}}" class="form-control" name="description">
                                </div>

                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection