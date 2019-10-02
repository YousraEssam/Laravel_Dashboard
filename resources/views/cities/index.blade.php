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

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Cities Table</h5>
        </div>

        <div class="ibox-content">
            <div class="table-responsive">
                <table id="cities-table" class="table table-striped table-bordered table-hover" role="grid">
                    <thead>
                        <tr role="row">
                            <th>#</th>
                            <th>Name</th>
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
$(function() {
    $('#cities-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('cities.index') !!}',
        columns: [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name'},
            { data: 'country.name', name: 'country'},
            { data: 'actions', name: 'actions', orderable: false, searchable: false}
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
@endpush