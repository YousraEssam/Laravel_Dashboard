@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Create Form</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Create New Visitor Form</strong>
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
                    <div class="row">
                        <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Create New visitor</h3>
                            <form role="form" method="POST" action="{{ route('visitors.store') }}" enctype='multipart/form-data'>
                                @csrf
                            <div class="form-group">
                                <label>Member Image</label>
                                <input type="file" placeholder="Member Image" class="form-control" name="image">
                            </div>

                            <div class="form-group">
                                <label>Member First Name</label>
                                <input type="text" placeholder="Member First Name" class="form-control" name="first_name">
                            </div> 
                            
                            <div class="form-group">
                                <label>Member Last Name</label>
                                <input type="text" placeholder="Member Last Name" class="form-control" name="last_name">
                            </div>

                            <div class="form-group">
                                <label>Member Email Address</label>
                                <input type="email" placeholder="Member Email Address" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>Member Phone Number</label>
                                <input type="tel" placeholder="Member Phone Number" class="form-control" name="phone">
                            </div>

                            <div class="form-group">
                                <label>Member Gender</label> <br>
                                <select name="gender" class="form-control">
                                    <option value="">Member Gender</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member Country</label> <br>
                                <select id="country" name="country_id" placeholder="Member Country" class="form-control">
                                    <option value="">Member Country</option>
                                    @foreach($countries as $key => $value)
                                    <option {{ (old("country_id") == $key ? "selected":"") }} value="{{ $key }}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Member City</label> <br>
                                <select id="city" name="city_id" placeholder="Member City" class="form-control">
                                    <option value="">Member City</option>  
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
        console.log(countryID);
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('get-city-list')}}/"+countryID,
                success:function(res){
                    if(res){
                        $("#city").empty();
                        $("#city").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#city").append('<option {{ old("city_id") =="'+key+'" ? "selected": ""}} value="'+key+'">'+value+'</option>');
                        });
                    }else{
                        $("#city").empty();
                    }
                }
            });
        }else{
            $("#city").empty();
        }
    });
</script>
@endsection

@push('JsValidatorScript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\VisitorRequest') !!}
@endpush