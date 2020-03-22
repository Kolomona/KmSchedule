@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Manage Employees</strong></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="searchEmployee">Search:</label>
                            <input class="form-control" type="text" name="searchEmployee" id="searchEmployee" value="Not implemented yet">
                            <div class="float-right">
                                {{ Form::label('hideinactive', 'Hide Inactive Employees: (Not implemented yet)') }}
                                {{ Form::checkbox('hideinactive', '', false, ['class' => '']) }}    
                            </div>

                        </div>
                        <div class="col-md-6">&nbsp;<a href="{{ route('admin.users.create') }}"><button style="margin-bottom: 0px;" class="btn btn-outline-primary form-control">Add New Employee</button></a></div>
                    </div>

                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Active</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Nickname</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                            <th scope="row">{{ $user->id }}</th>
                                <td>
                                    @if($user->active)
                                    Yes
                                    @else
                                    No
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->nickName }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}</td>
                                <td>
                                    @php
                                        // dd($user->roles()->get()->pluck('name')[0]=='admin');
                                    @endphp
                                    {{-- Only managers and admins can edit users
                                         Only admins can delete users
                                         Only admins can edit admins or delete users
                                         TODO: Enforce this on backend --}}
                                    @can('edit-users')
                                        @if ($user->roles()->get()->pluck('name')[0] != 'admin')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-right">Edit</button></a>
                                        @else
                                        @can('edit-admins')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-right">Edit</button></a>
                                        @endcan
                                        @endif
                                        {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                        
                                        @can('delete-users')
                                            {!! Form::submit('Delete', ['class' => 'btn btn-warning float-right']) !!}
                                        @endcan
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
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