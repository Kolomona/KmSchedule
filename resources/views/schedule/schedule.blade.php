@extends('layouts.app')

@section('content')



<div class="col-md-12">
    <h2>Schedule for the week of {{ Carbon\Carbon::parse($schedule->period_date)->format('M jS, Y')}}</h2>
  
    <div class="row">
        <div class="col-md-6">
            <a href="{{ route('schedule.print', ['id' => $schedule->id]) }}" target="_blank">Print</a>
        </div>
        
        <div class="col-md-6" style="text-align: right;">
            @can('edit-schedules') 
                <a href="{{ route('schedule.edit', ['schedule' => $schedule->id]) }}">Edit</a><br>
            @endcan
        </div>
    </div> <!-- endrow -->
    <table class="kmScheduleTable">
        {!! convert_schedule_tohtml($schedule->schedule) !!}
    </table>
    Last updated {{ $schedule->updated_at->toDateString() }} ({{ $schedule->updated_at->diffForHumans() }}) <br>
    
</div> <!-- end col -->
<!-- {{ $schedule }} -->
@endsection