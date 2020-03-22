@extends('layouts.app')

@section('content')



<div class="col-md-12">
    <h2>Schedule for {{ $schedule->period_date }}</h2>

    {{-- Implement later --}}
    @can('edit-schedules')
    <div class="row">
        <div class="col-md-6">
            {{-- <a href="{{ route('schedule.show', ['schedule' => $schedule->id+1]) }}">Previous</a> - <a href="{{ route('schedule.show', ['schedule' => $schedule->id-1]) }}">Next</a> --}}
        </div>
        <div class="col-md-6" style="text-align: right;">
            <a href="{{ route('schedule.edit', ['schedule' => $schedule->id]) }}">Edit</a><br>
        </div>
    </div>
    @endcan


    <table class="kmScheduleTable">
        {!! convert_schedule_tohtml($schedule->schedule) !!}
    </table>
    Last updated {{ $schedule->updated_at->toDateString() }} ({{ $schedule->updated_at->diffForHumans() }}) <br>
    
</div> <!-- end col -->
<!-- {{ $schedule }} -->
@endsection