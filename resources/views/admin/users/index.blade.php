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
                            {{ Form::open(array('url' => 'admin/users', 'name' => "frm_hide_inactive",'id' => "frm_hide_inactive",  'method' => 'GET')) }}
                            {{ Form::label('searchEmployee', 'Search') }}
                            <input class="form-control" type="text" name="searchEmployee" id="searchEmployee" placeholder="Not implemented yet">
                            <div class="float-right">
                                {{ Form::label('hide_inactive_employees', 'Hide Inactive Employees:') }}
                                {{ Form::checkbox('hide_inactive_employees', 'checked',  $hide_inactive_employees, ['class' => 'align-middle']) }}
                                {!! Form::close() !!}   
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
                                <th scope="col">Prefered Location</th>
                                <th scope="col">Role</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            
                            @if(!$user->active && $hide_inactive_employees == 1)
                                 @continue
                            @endIf
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
                                <td>{{ $user->location()->get()->first()->name }}</td>
                                <td>{{ ucfirst(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}</td>
                                <td>
                                    {{-- Only managers and admins can edit users
                                         Only admins can delete users
                                         Only admins can edit admins or delete users
                                         TODO: Enforce this on backend --}}
                                    @can('edit-users')
                                    {!! Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) !!}
                                        @if ($user->roles()->get()->pluck('name')->first() != 'admin')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary col-md-5">Edit</button></a>
                                        @else
                                        @can('edit-admins')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary col-md-5">Edit</button></a>
                                        @endcan
                                        @endif
                                        
                                        @can('delete-users')
                                            {!! Form::submit('Delete', ['class' => 'btn btn-warning col-md-6']) !!}
                                        @endcan
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    There are {{$roleCount['admin']}} Admins, {{$roleCount['manager']}} Managers, and {{$roleCount['employee']}} Employees


                </div> <!-- end card body-->

            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row justify-content-center">
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection
