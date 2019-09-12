@extends('layouts.home')

@section('rolestable')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Data Tables</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('home')}}">Home</a>
            </li>
            <li class="active">
                <strong>Roles</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Basic Data Tables example with responsive plugin</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">
        <div class="table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="html5buttons">
            <div class="dt-buttons btn-group">
                <a class="btn btn-default buttons-copy buttons-html5" tabindex="0" 
                aria-controls="DataTables_Table_0" href="#">
                    <span>Copy</span></a>
                <a class="btn btn-default buttons-csv buttons-html5" tabindex="0" 
                aria-controls="DataTables_Table_0" href="#">
                    <span>CSV</span></a>
                <a class="btn btn-default buttons-excel buttons-html5" tabindex="0" 
                aria-controls="DataTables_Table_0" href="#">
                    <span>Excel</span></a>
                <a class="btn btn-default buttons-pdf buttons-html5" tabindex="0"
                    aria-controls="DataTables_Table_0" href="#">
                    <span>PDF</span></a>
                <a class="btn btn-default buttons-print" tabindex="0" 
                aria-controls="DataTables_Table_0" href="#">
                    <span>Print</span></a>
            </div>
        </div>
        <div class="dataTables_length" id="DataTables_Table_0_length">
            <label>Show 
                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" 
                class="form-control input-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select> entries
            </label>
        </div>
        <div id="DataTables_Table_0_filter" class="dataTables_filter">
            <label>Search:
                <input type="search" class="form-control input-sm" placeholder="" 
                aria-controls="DataTables_Table_0">
            </label>
        </div>
        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" 
            aria-live="polite">Showing 1 to 25 of 57 entries
        </div>
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
                    rowspan="1" colspan="1" aria-label="Engine version: activate to sort 
                    column ascending" style="width: 149px;">Guard Name</th>
                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" 
                    rowspan="1" colspan="2" aria-label="CSS grade: activate to sort column 
                    ascending" style="width: 105px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr class="gradeA odd" role="row">
                    <td class="sorting_1">{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->description}}</td>
                    <td>{{$role->guard_name}}</td>
                    <td class="center">
                        <a href="{{route('roles.edit', [$role->id])}}" class="btn btn-success">Edit</a>
                    </td>
                    <td class="center">
                        <a href="{{route('roles.destroy', [$role->id])}}" class="btn btn-success">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
            <ul class="pagination">
                <li class="paginate_button previous disabled" 
                id="DataTables_Table_0_previous">
                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" 
                    tabindex="0">Previous</a>
                </li>
                <li class="paginate_button active">
                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" 
                    tabindex="0">1</a>
                </li>
                <li class="paginate_button ">
                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" 
                    tabindex="0">2</a>
                </li>
                <li class="paginate_button ">
                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" 
                    tabindex="0">3</a>
                </li>
                <li class="paginate_button next" id="DataTables_Table_0_next">
                    <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="4"
                        tabindex="0">Next</a>
                </li>
            </ul>
        </div>
        </div>
        </div>
        </div>
    </div>
    </div>
</div>
</div>

@endsection