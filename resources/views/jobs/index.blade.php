@extends('layouts.home')

@section('content')

@section('maintitle')
<h2>Data Tables</h2>
@endsection

@section('titlebreadcrumb')
<li class="active">
    <strong>Jobs</strong>
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
            <h5>Jobs Table</h5>
        </div>

        <div class="ibox-content">
        <div class="table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <table class="table table-striped table-bordered table-hover dataTables-example dataTable"
            id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
            <thead>
                <tr role="row">
                    <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" 
                    rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine:
                    activate to sort column descending" style="width: 175px;">#</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                    rowspan="1" colspan="1" aria-label="Browser: activate to sort column 
                    ascending" style="width: 219px;">Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                    rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                    ascending" style="width: 197px;">Description</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                    rowspan="1" colspan="2" aria-label="CSS grade: activate to sort column 
                    ascending" style="width: 105px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($jobs))
                @foreach($jobs as $job)
                <tr class="gradeA odd" role="row">
                    <td class="sorting_1">{{$job->id}}</td>
                    <td>{{$job->name}}</td>
                    <td>{{$job->description}}</td>
                    <td class="center">

                        <a href="{{route('jobs.show', $job->id)}}" class="btn btn-success">Show</a>

                    @if(! ($job->name == 'Writer' || $job->name == 'Reporter' ) )
                        @can('job-edit')
                        <a href="{{route('jobs.edit', $job->id)}}" class="btn btn-success">Edit</a>
                        @endcan
                        @can('job-delete')
                        <form action="{{route('jobs.destroy', $job->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endcan
                    @endif
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{ $jobs->links() }}
            </div>
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
</div>
</div>

@endsection