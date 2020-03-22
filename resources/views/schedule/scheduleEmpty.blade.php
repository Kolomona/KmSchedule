@extends('layouts.app')

@section('content')



<div class="col-md-8 offset-md-2">
    <h2>No schedules yet</h2>

<a href="{{ route('schedule.create') }}">Create a new schedule</a>
    
</div> <!-- end col -->
@endsection