@extends('layouts.landing')

@section('content')

<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Pubished Events Table </h5>
        </div>
        <div class="ibox-content">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Main Title</th>
                        <th>Secondary Title</th>
                        <th>Content</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Location</th>
                        {{-- <th>Visitors</th> --}}
                    </tr>
                </thead>
                @foreach ($value as $v)
                <tbody>
                    <tr>
                        <td>{{ $v['id'] }}</td>
                        <td>{{ $v['main_title'] }}</td>
                        <td>{{ $v['secondary_title'] }}</td>
                        <td>{!! $v['content'] !!}</td>
                        <td>{{ $v['start_date'] }}</td>
                        <td>{{ $v['end_date'] }}</td>
                        <td>{{ $v['address_address'] }}</td>
                        {{-- @foreach ($v['visitors'] as $visitor)
                            <td>{{$visitor}}</td>
                        @endforeach --}}
                    </tr>
                </tbody>
                @endforeach

            </table>

        </div>
    </div>
</div>
@endsection
