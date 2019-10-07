@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>News</strong>
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
                <h5>News Table</h5>
            </div>
    
            <div class="ibox-content">
                <div class="table-responsive">
                    <table id="news-table" class="table table-striped table-bordered table-hover" role="grid">
                        <thead>
                            <tr role="row">
                                <th>#</th>
                                <th>Main Title</th>
                                <th>Secondary Title</th>
                                <th>Content</th>
                                <th>Type</th>
                                <th>Author</th>
                                <th>Is Published?</th>
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
        $('#news-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('news.index') !!}',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'main_title', name: 'main_title'},
                { data: 'secondary_title', name: 'secondary_title'},
                { data: 'content', name: 'content'},
                { data: 'type', name: 'type'},
                { data: 'author', name:'author_id'},
                { data: 'is_published', name: 'is_published'},
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