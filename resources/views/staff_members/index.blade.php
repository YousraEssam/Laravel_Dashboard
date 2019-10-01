@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Staff Members</strong>
</li>
@endsection

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Staff Members Table</h5>
        </div>

        <div class="ibox-content">
        <div class="table-responsive">
            <table id="staff-table" class="table table-striped table-bordered table-hover" role="grid">
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Job</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Role</th>
                        <th>Is Active?</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

@endsection 

@push('scripts')
<script>
$(function(){
    $('#staff-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('staff_members.index') !!}',
        columns: [
            {data: 'id', name:'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'user.email', name: 'email'},
            {data: 'user.phone', name: 'phone'},
            {data: 'job.name', name: 'job'},
            {data: 'city.name', name: 'city'},
            {data: 'city.country.name', name: 'country'},
            {data: 'role.name', name:'role'},
            {data: 'is_active', name: 'is_active'},
            {data: 'actions', name: 'actions'}
        ]
    });
});
</script>
@endpush