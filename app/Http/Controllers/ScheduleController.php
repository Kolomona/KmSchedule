<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use App\Location;
// use Session;
use Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Alert;

class ScheduleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        if($request->location != null){
            $locationFilter = (int)$request->location;
        }else{
            $locationFilter = auth()->user()->location_id;
        }
        // dd($locationFilter, $request->location);

        // get locations, insert an "All locations and " sort
        $locations = Location::pluck('name', 'id');
        $locations["0"] = "All Locations";
        $locations = $locations->sortKeys();

        // Get schedules and filter by prefered location unless locations is in parameters
        if($locationFilter==0){
            $schedules = Schedule::all()->sortByDesc("period_date");;
        }else{
            $schedules = Schedule::get('*')->where('location_id', $locationFilter)->sortByDesc("period_date");;
        }
        
        if (Schedule::select('*')->first() == null) {
            
            Alert::html('There are no schedules in the database',
                        "Please add one. <a href='".route('schedule.create')."'>Add New Schedule</a>",
                        'warning')->autoClose(0); 

            return view('schedule.scheduleEmpty');

            
        }
        // Redirect to the show method
        return view('schedule.scheduleIndex', ["schedules" => $schedules, "locations" => $locations, "locationFilter" => $locationFilter]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('edit-users')) {
            Alert::error('ErrorAlert','Only Admins or Managers can edit schedules')->autoClose(10000);
            return redirect()->route('home');
        }
        $locations = Location::pluck('name', 'id');
        
        return view('schedule.scheduleCreate', ['locations' => $locations]);

        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // validate the data
        $rules = [
            // https://github.com/felixkiss/uniquewith-validator#specify-different-column-names-in-the-database
            'period_date' => 'required|unique_with:schedules,location = location_id',
            'location' => 'required',
            'schedule' => 'required',
        ];
        Validator::make($request->all(), $rules)->validate();

        $location = Location::find($request->location);
        
        $schedule = new Schedule;
        $schedule->period_date = $request->period_date;
        $schedule->schedule = $request->schedule;
        if (isset($schedule->is_draft)) {
            $schedule->is_draft = 1;
        } else {
            $schedule->is_draft = 0;
        }
        $location->schedules()->save($schedule);
        
        Alert::toast('The schedule was successfully saved!', 'success');


        // redirect to another page
        return redirect()->route('schedule.show', $schedule->id);
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    // public function show(Schedule $id) // TODO: Play with this later
    {
        // Make sure the id is in range
        
        $user = auth()->user();
        if (Schedule::select('*')->first() == null || 
            Schedule::select('*')->orderBy('period_date', 'desc')->where('location_id', $user->location_id)->first() == null) {
            
            Alert::error('ErrorAlert','There are no schedules for your preferred location yet.')->autoClose(10000);
            return view('schedule.scheduleEmpty');
        }
        
        if ($id == "latest") {
            // get the latest schedule that matches the user's prefered location
            $schedule = Schedule::select('*')->orderBy('period_date', 'desc')->where('location_id', $user->location_id)->first();
        } else {
            $schedule = Schedule::find($id);
        }
        

        return view('schedule.schedule', ["schedule" => $schedule]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // Only admins or managers can edit schedules
        if (Gate::denies('edit-users')) {
            Alert::error('Error','Only Admins or Managers can edit schedules')->autoClose(10000);
            return redirect()->route('home');
        }

        $schedule = Schedule::find($id);
        $locations = Location::pluck('name', 'id');
        
        return view('schedule.scheduleEdit', compact('schedule', 'locations'));
        // return view('schedule.scheduleEdit', ["schedule" => $schedule, "locations" => $locations]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate data
        // https://github.com/felixkiss/uniquewith-validator
        // unique_with Validator Rule For Laravel
        // '<field1>' => 'unique_with:<table>,<field2>[,<field3>,...,<ignore_rowid>]',
        // <ignore_rowid> is used for updating
        $rules = [
            'period_date' => 'required|unique_with:schedules,location = location_id,'.$id,
            'location' => 'required',
            'schedule' => 'required',
        ];
        Validator::make($request->all(), $rules)->validate();
        
        // Save data to db
        $schedule = Schedule::find($id);
        $location = Location::find($request->location);
        if (null !== $request->input('is_draft')) {
            $schedule->is_draft = 1;
        } else {
            $schedule->is_draft = 0;
        }

        $schedule->period_date = $request->input('period_date');
        $schedule->schedule = $request->input('schedule');

        $location->schedules()->save($schedule); // This seems backwards but it works

        // set flash data with success message
        Alert::toast('Schedule was successfully updated.', 'success');
        // redirect with flash data to show
        return redirect()->route('schedule.show', $schedule->id);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::Find($id);
        $schedule->delete();
        Alert::toast('Schedule successfully deleted!', 'success');
        return redirect()->route('schedule.index');
    }



     /**
     * Display the specified resource for printing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $schedule = Schedule::find($id);
        return view('schedule.schedulePrint', ["schedule" => $schedule]);
    }
}
