@if (Session::has('success'))
    <div class="alert alert-success col-md-8 offset-md-2" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('failure'))
    <div class="alert alert-danger col-md-8 offset-md-2" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Error:</strong> {{ Session::get('failure') }}
    </div>
@endif

@if (count($errors) > 0)
    <div class="alert alert-danger col-md-8 offset-md-2" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Errors:</strong> {{ Session::get('success') }}
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }} </li>    
            @endforeach 
        </ul>
    </div>
@endif

@if (Session::has('noSchedules'))
    <div class="alert alert-danger col-md-8 offset-md-2" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Error:</strong> {{ Session::get('noSchedules') }}
    </div>
@endif


