@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li>
    <a href="{{route('cities.index')}}">Cities</a>
</li>
<li class="active">
    <strong>City "{{$city->name}}" Details</strong>
</li>
@endsection

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