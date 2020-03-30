@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Locations</strong></div>

                <div class="card-body">
                    @can('create-locations')
                    <div class="row">
                        <div class="col-md-8 offset-md-2" >&nbsp;<a href="{{ route('admin.locations.create') }}">
                            <button style="margin-bottom: 5px;" class="btn btn-outline-primary form-control">Add New location</button></a>
                        </div>
                    </div>
                    @endcan



                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                @can('edit-locations') 
                                    <th scope="col">Actions</th> 
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                            <tr>
                            <th scope="row">{{ $location->id }}</th>
                                <td>{{ $location->name }}</td>                          
                                @can('edit-locations')
                                    <td>
                                        
                                        {!! Form::open(['route' => ['admin.locations.destroy', $location->id], 'method' => 'DELETE'], ['class' => '']) !!}
                                        <a href="{{ route('admin.locations.edit', $location->id) }}"><button type="button" class="btn btn-primary form-control col-md-5 offet-md-1">Edit</button></a>
                                        @can('delete-locations')
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


