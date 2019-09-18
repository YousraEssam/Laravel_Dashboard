@extends('layouts.home')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <ol class="breadcrumb">
            <li>
                <a href="{{route('home')}}">Home</a>
            </li>
            <li>
                <a href="{{route('cities.index')}}">Cities</a>
            </li>
            <li class="active">
                <strong>City "{{$city->name}}" Details</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="order_id">City ID</label>
                    <h4> {{$city->id}} </h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="status">City Name</label>
                    <h4> {{$city->name}} </h4>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="customer">Country</label>
                    <h4> {{$city->country['name']}} </h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 