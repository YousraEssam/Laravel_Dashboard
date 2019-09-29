@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Cities</strong>
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
                    <h5>Cities Table</h5>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
                            id="cities-table" aria-describedby="DataTables_Table_0_info" role="grid">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" 
                                    rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine:
                                    activate to sort column descending" style="width: 175px;">Id</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                                    rowspan="1" colspan="1" aria-label="Browser: activate to sort column 
                                    ascending" style="width: 219px;">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                                    rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                                    ascending" style="width: 197px;">Country</th>
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

@endsection 

@push('scripts')
<script>
$(function() {
    $('#cities-table').DataTable({
        processing: true,
        // serverSide: true,
        ajax: '{!! route('cities.index') !!}',
        columns: [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name'},
            { data: 'country.name', name: 'country'},
            { data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush