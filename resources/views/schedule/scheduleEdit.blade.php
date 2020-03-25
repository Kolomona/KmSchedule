@extends('layouts.app')
@section('content')

<div class="col-md-8 offset-md-2">
    <br>

    {!! Form::model($schedule, ['route' => ['schedule.update', $schedule->id], 'method' => 'PUT']) !!}
    <div class="row-">
        <div class="col-md-8 offset-md-2">
            <h3>Editing the schedule for <strong>{{ $schedule->period_date }}</strong></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" >
            
            {{ Form::label('period_date', 'Date:') }}
            {{ Form::text('period_date', null, ['class' => 'form-control', 'required' => '', 'autocomplete'=> 'off']) }}
        </div>
        <div class="col-md-6" style="text-align: right;">
            {{ Form::label('location', 'Location:') }}
            {{ Form::select('location', $locations, $schedule->location_id, ['class' => 'form-control', 'required' => '']) }}
            {{-- {{ Form::label('is_draft', 'Save as draft:') }}
            {{ Form::checkbox('is_draft', 'is_draft', false,  array('class' => '')) }} --}}
        </div>
    </div>
    

    {{ Form::label('schedule', 'Schedule:') }}
    {{ Form::textarea('schedule', null, array('class' => 'form-control', 'required' => '')) }}
    <input type="button" name="reset" value="Clear" id="reset123" onclick="customReset();" style="float: right; margin: 5px 0px 20px 0px;"/>
    {{ Form::submit('Update Schedule', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin: 20px 0px 20px 0px;')) }}
    
    
    {!! Form::close() !!}
    {{-- Handle the Destroy method --}}
    {!! Form::open(['route' => ['schedule.destroy', $schedule->id], 'method' => 'DELETE']) !!}

    {!! Form::submit('Delete Schedule', ['class' => 'btn btn-danger btn-lg btn-block']) !!}
    
    {!! Form::close() !!}


    <br><br>
    <strong>Directions:</strong> <br>
    <ul>
        <li>Make sure you enter the date that <b>begins</b> the time period</li>
        <li>Date must be in the format YYYY-MM-DD format</li>
        <li>Copy the text from the box above and paste into excel</li>
        <li>Make edits in Excel</li>
        <li>Select entire schedule in excel and copy</li>
        <li>Press the Clear button to remove the old text in the box above</li>
        <li>Paste copied text into edit box above</li>
        <li>Click Update Schedule when finished</li>
        <li><b>Note:</b> You may edit manually, just be careful</li>
        <li>If you make a mistake you can always re-edit the schedule</li>
    </ul>



</div> <!-- end col -->
@php
echo '<script>function customReset(){    document.getElementById("schedule").value = "";}</script>'
@endphp
@endsection