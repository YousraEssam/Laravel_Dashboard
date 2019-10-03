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

                    <div class="row">
                        <form role="form" method="POST" action="{{ route('cities.update',$city->id) }}">
                                @csrf
                                @method('PUT')
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Role</h3>
                            <div class="form-group">
                                <strong>City Name</strong>

                                <input type="text" class="form-control" value="{{$city->name}}" name="name">

                            </div>

                            <div class="form-group">
                                <strong>Country Name</strong>
                            <select id="country" name="country_id" placeholder="Member Country" class="form-control">
                                    <option value="" disabled selected>{{$city->country->name}}</option>
                                    @foreach ($countries as $key => $value)
                                    <option {{ (old("country_id") == $key ? "selected":"") }} value="{{ $key }}">{{$value}}</option>  
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>
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
{!! JsValidator::formRequest('App\Http\Requests\CityRequest') !!}
@endpush