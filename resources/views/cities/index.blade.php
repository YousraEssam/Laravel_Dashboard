@extends('layouts.home')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Data Tables</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('home')}}">Home</a>
            </li>
            <li class="active">
                <strong>Cities</strong>
            </li>
        </ol>
    </div>
</div>

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
                    ascending" style="width: 197px;">Country</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                    rowspan="1" colspan="2" aria-label="CSS grade: activate to sort column 
                    ascending" style="width: 105px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($cities))
                @foreach($cities as $city)
                <tr class="gradeA odd" role="row">
                    <td class="sorting_1">{{$city->id}}</td>
                    <td>{{$city->name}}</td>
                    <td>{{$city->country['name']}}</td>
                    <td class="center">

                        <a href="{{route('cities.show', $city->id)}}" class="btn btn-success">Show</a>
                    
                        @can('city-edit')
                        <a href="{{route('cities.edit', $city->id)}}" class="btn btn-success">Edit</a>
                        @endcan
                        @can('city-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['cities.destroy', $city->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{ $cities->links() }}
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