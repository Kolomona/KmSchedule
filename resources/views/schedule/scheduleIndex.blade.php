@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Schedules</strong></div>

                <div class="card-body">
                    @can('create-schedules')
                    <div class="row">
                        <div class="col-md-8 offset-md-2" >&nbsp;<a href="{{ route('schedule.create') }}">
                            <button style="margin-bottom: 5px;" class="btn btn-outline-primary form-control">Add New Schedule</button></a>
                        </div>
                    </div>
                    @endcan

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Period Date</th>
                                <th scope="col">
                                    {{ Form::open(['url' => 'schedule', 'name' => "frm-location-filter",'id' => "frm-location-filter",  'method' => 'GET']) }}
                                        {{ Form::select('location', $locations, $locationFilter, ['class' => 'form-control', 'required' => '', 'id' => "location-filter"]) }}
                                    {!! Form::close() !!}
                                </th>
                                @can('edit-schedules') <th scope="col">Actions</th> @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                            <tr>
                            <th scope="row">{{ $schedule->id }}</th>
                                <td><a href="{{route('schedule.show', ['schedule' => $schedule->id]) }}">{{ $schedule->period_date }}</a></td>
                                
                                <td>{{ $schedule->location()->get()->first()->name }}</td>                          

                                @can('edit-schedules')
                                <td>
                                    {!! Form::open(['route' => ['schedule.destroy', $schedule->id], 'method' => 'DELETE']) !!}
                                    
                                    <a href="{{ route('schedule.edit', $schedule->id) }}"><button type="button" class="btn btn-primary form-control col-md-5 offset-md-1">Edit</button></a>
                                   
                                    @can('delete-schedules')
                                    {!! Form::submit('Delete', ['class' => 'btn btn-warning form-control col-md-5']) !!}
                                    @endcan
                                    {!! Form::close() !!}
                                </td>
                                @endcan

                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>


                </div> <!-- end card body-->

            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row justify-content-center">
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection


