@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Events</strong>
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
                <h5>Events Table</h5>
            </div>
    
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="events-table" class="table table-striped table-bordered table-hover" role="grid">
                        <thead>
                            <tr role="row">
                                <th>#</th>
                                <th>Main Title</th>
                                <th>Secondary Title</th>
                                <th>Content</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Visitors</th>
                                <th>Location</th>
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
        $('#events-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('events.index') !!}',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'main_title', name: 'main_title'},
                { data: 'secondary_title', name: 'secondary_title'},
                { data: 'content', name: 'content'},
                { data: 'start_date', name: 'start_date'},
                { data: 'end_date', name:'end_date'},
                { data: 'visitors', name:'visitors'},
                { data: 'location', name:'location'},
                { data: 'actions', name: 'actions'}
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
@endpush