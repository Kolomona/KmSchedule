@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Edit Employee | {{ $user->name }}</strong>
                </div>

                <div class="card-body">
                    {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('name', 'First Name:') }}
                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => '']) }}

                            {{ Form::label('lastName', 'Last Name:') }}
                            {{ Form::text('lastName', null, ['class' => 'form-control', 'required' => '']) }}
                            
                            {{ Form::label('nickName', 'Nickame:') }}
                            {{ Form::text('nickName', null, ['class' => 'form-control']) }}
                            
                            {{ Form::label('email', 'Email:') }}
                            {{ Form::text('email', null, ['class' => 'form-control', 'required' => '']) }}
                            
                            {{ Form::label('password', 'Password:') }}
                            {{ Form::password('password', ['placeholder'=>'Password', 'class'=>'form-control' ] ) }}
                        </div>
                        <div class="col-md-6">
                            <p>Roles:</p>
                            
                            
                            @foreach ($roles as $role)
                            
                            @if($role->name == 'admin')
                            
                                @can('edit-admins')
                                    {{-- Only admins can Edit an admin --}}
                                    {{ Form::radio('role', $role->id, $user->Roles()->first()->id == $role->id) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}
                                    <br>
                                @endcan
                            @else
                                {{ Form::radio('role', $role->id, $user->Roles()->first()->id == $role->id) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}
                                <br>
                            @endif
                    @endforeach
                    <hr>
                        {{ Form::label('location', 'Prefered Location:') }}
                        {{ Form::select('location', $locations, $user->location_id, ['class' => 'form-control', 'required' => '']) }}
                        <hr>
                        {{ Form::checkbox('active', null, true) }} 
                        {{ Form::label('active', 'Active Employee?') }}
                        </div>
                    </div> <!-- end row -->
                    {{ Form::submit('Update Employee', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
                    {!! Form::close() !!}
                </div><!-- end card body-->
            </div><!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end container -->

@endsection
