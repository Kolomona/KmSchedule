<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials._head');
<style type="text/css" media="print">
    @media print{@page {size: landscape}}
</style>
</head>
<body>
    <div class="col-md-12 text-center">
        <h2>
            Schedule for the week of 
            {{ Carbon\Carbon::parse($schedule->period_date)->format('M jS, Y')}}
        </h2>
    
        <table class="kmScheduleTable">
            {!! convert_schedule_tohtml($schedule->schedule) !!}
        </table>
        
    </div>
</body>
</html>