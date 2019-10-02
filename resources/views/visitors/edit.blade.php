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
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Edit Visitor</h3>
                            <form role="form" method="POST" action="{{ route('visitors.update',$visitor->id) }}" enctype='multipart/form-data'>
                                @csrf
                                @method('PUT')

                            <div class="form-group">
                                <label>Member Image</label>
                                <input type="file" value={{$visitor->user->image}} class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label>Member First Name</label>
                                <input type="text" value="{{$visitor->user->first_name}}" class="form-control" name="first_name">
                            </div>

                            <div class="form-group">
                                <label>Member Last Name</label>
                                <input type="text" value={{$visitor->user->last_name}} class="form-control" name="last_name">
                            </div>

                            <div class="form-group">
                                <label>Member Email Address</label>
                                <input type="email" value={{$visitor->user->email}} class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>Member Phone Number</label>
                                <input type="tel" value={{$visitor->user->phone}} class="form-control" name="phone">
                            </div>

                            <div class="form-group">
                                <label>Member Gender</label> <br>
                                <select name="gender" class="form-control" value="{{$visitor->gender}}">
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Member Country</label> <br>
                                <select id="country" name="country_id" value="Member Country" class="form-control">
                                    <option value="" disabled selected>{{$visitor->country->name}}</option>
                                    @foreach($countries as $key => $value)
                                        @if($key === $visitor->country->id)
                                            <option selected value="{{ $key }}">{{$value}}</option>
                                        @else
                                            <option value="{{ $key }}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member City</label> <br>
                                <select id="city" name="city_id" value="Member City" class="form-control">
                                    <option value="{{$visitor->city->id}}">{{$visitor->city->name}}</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Member Activity</label> <br>
                                <select name="is_active" value="Member Activity" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
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

@section('cityscript')
<script>
    $('#country').change(function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('get-city-list')}}?country_id="+countryID,
                success:function(res){
                    if(res){
                        $("#city").empty();
                        $("#city").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#city").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }else{
                        $("#city").empty();
                    }
                },
                error: function(err){
                    alert('Error');
                }
            });
        }else{
            $("#city").empty();
        }
    });
</script>
@endsection