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
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Staff Members Table</h5>
        </div>

        <div class="ibox-content">
        <div class="table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                id="staff-table" aria-describedby="DataTables_Table_0_info" role="grid">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine:
                        activate to sort column descending" style="width: 175px;">#</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column 
                        ascending" style="width: 219px;">Image</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column 
                        ascending" style="width: 219px;">Name</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">Email</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">Phone Number</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">Job</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">City</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">Country</th>
             
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">Is Active?</th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="2" aria-label="CSS grade: activate to sort column 
                        ascending" style="width: 105px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            
        </div>
        </div>
        </div>
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
        // serverSide: true,
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
            {data: 'isActive', name: 'isActive'},
            {data: 'actions', name: 'actions'}
        ]
    });
});
</script>
@endpush