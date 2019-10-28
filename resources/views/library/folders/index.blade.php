@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Folders</strong>
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
            <h5>Folders Table</h5>
        </div>

        <div class="ibox-content">
            <div class="table-responsive">
                <table id="folders-table" class="table table-striped table-bordered table-hover" role="grid">
                    <thead>
                        <tr role="row">
                            <th>#</th>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>Description</th>
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
    $('#folders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('library.folders.index') !!}',
        columns: [
            { data: 'id', name: 'id'},
            { data: 'icon', name: 'icon'},
            { data: 'name', name: 'name'},
            { data: 'description', name: 'description'},
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