@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Visitors</strong>
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
            <h5>Visitors Table</h5>
        </div>

        <div class="ibox-content">
        <div class="table-responsive">
            <table id="visitor-table" class="table table-striped table-bordered table-hover" role="grid">
                <thead>
                    <tr role="row">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>City</th>
                        <th>Country</th>
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
    $('#visitor-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('visitors.index') !!}',
        columns: [
            {data: 'id', name:'id'},
            {data: 'image', name: 'image'},
            {data: 'name', name: 'name'},
            {data: 'user.email', name: 'email'},
            {data: 'user.phone', name: 'phone'},
            {data: 'gender', name: 'gender'},
            {data: 'city.name', name: 'city'},
            {data: 'city.country.name', name: 'country'},
            {data: 'actions', name: 'actions'}
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            ]
    });
});
</script>
@endpush