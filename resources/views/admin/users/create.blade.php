@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><strong>Add New Employee</strong></div>

            <div class="card-body">
                {!! Form::open(['route' => 'admin.users.store', 'data-parsley-validate']) !!}
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::checkbox('active', 'checked', true) }} 
                        {{ Form::label('active', 'Active Employee?') }}
                        <br>
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
                                        {{-- Only admins can create an admin --}}
                                        {{ Form::radio('roles[]', $role->id, TRUE) }}
                                        {{ Form::label($role->name, ucfirst($role->name)) }}
                                        <br>
                                    @endcan
                                @else
                                    {{ Form::radio('roles[]', $role->id, TRUE) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}
                                    <br>
                                @endif
                        @endforeach
                    </div>
                </div>

                {{ Form::submit('Add Employee', ['class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;']) }}
                {!! Form::close() !!}
            </div><!-- end card body-->

            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row justify-content-center">
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection