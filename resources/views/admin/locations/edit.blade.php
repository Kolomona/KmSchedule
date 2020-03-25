@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><strong>Edit Location - {{ $location->name }}</strong></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 offset-md-2" >
                            {!! Form::model($location, ['route' => ['admin.locations.update', $location->id], 'method' => 'PUT']) !!}
                            @include('admin.locations.form')
                        {{ Form::submit('Update Location', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
                        {{Form::close()}}
                        </div>
                    </div>
                </div><!-- end card body-->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row justify-content-center">
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection