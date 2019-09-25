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
                id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
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
                        ascending" style="width: 197px;">Role</th>
                        <!-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column
                        ascending" style="width: 197px;">Is Active?</th> -->
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                        rowspan="1" colspan="2" aria-label="CSS grade: activate to sort column 
                        ascending" style="width: 105px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($staff_members))
                        @foreach($staff_members as $staff)
                        <tr class="gradeA odd" role="row">
                            <td class="sorting_1">{{$staff->id}}</td>
                            <td>
                                <img src="{{Storage::url($staff->image)}}" style="height:50px; width:50px;">
                            </td>

                            <td>{{$staff->user->first_name}} {{$staff->user->last_name}}</td>
                            <td>{{$staff->user->email}}</td>
                            <td>{{$staff->user->phone}}</td>

                            <td>{{$staff->job->name}}</td>

                            <td>{{$staff->city->name}}</td>
                            <td>{{$staff->city->country->name}}</td>

                            <td>{{$staff->role->name}}</td>
                            
                            <!-- <td>{{$staff->isActive}}</td> -->

                            <td class="center">

                                <a href="{{route('staff_members.show', $staff->id)}}" class="btn btn-success">Show</a>

                                @can('staffmember-edit')
                                <a href="{{route('staff_members.edit', $staff->id)}}" class="btn btn-success">Edit</a>
                                @endcan
                                @can('staffmember-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['staff_members.destroy', $staff->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    @endif
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