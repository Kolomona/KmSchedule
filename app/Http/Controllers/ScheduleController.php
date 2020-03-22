<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Session;
use Gate;

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
    public function index()
    {
        // Get the most current schedule id
        $schedules = Schedule::all()->sortByDesc("period_date");;
        if (Schedule::select('*')->first() == null){
            Session::flash('noSchedules', 'There are no schedules in the database yet. Please create one');
            return view('schedule.scheduleEmpty');
        }

        // Redirect to the show method
        return view('schedule.scheduleIndex', ["schedules" => $schedules]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('edit-users')){
            Session::flash('failure', "Only Admins or Managers can edit schedules");
            return redirect()->route('home');
        }
        return view('schedule.scheduleCreate');
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
        // dd($request);
        $this->validate($request, array(
            'period_date' => 'required|date_format:Y-m-d',
            'schedule' => 'required'
        ));

        // store in DB
        $schedule = new Schedule;
        $schedule->period_date = $request->period_date;
        $schedule->schedule = $request->schedule;
        if (isset($schedule->is_draft)) {
            $schedule->is_draft = 1;
        }else {
            $schedule->is_draft = 0;
        }

        $schedule->save();

        Session::flash('success', 'The schedule was successfully saved!');


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
        

        if (Schedule::select('*')->first() == null){
            Session::flash('noSchedules', 'There are no schedules in the database yet. Please create one');
            return view('schedule.scheduleEmpty');
        }

        if ($id == "latest") {
            $schedule = Schedule::select('*')->orderBy('period_date', 'desc')->first();
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
        if(Gate::denies('edit-users')){
            Session::flash('failure', "Only Admins or Managers can edit schedules");
            return redirect()->route('home');
        }

        $schedule = Schedule::find($id);

        //return view('schedule.scheduleEdit', ["schedule" => $schedule]);
        return view('schedule.scheduleEdit')->withSchedule($schedule);
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
        $this->validate($request, array(
            'period_date' => 'required|date_format:Y-m-d',
            'schedule' => 'required'
        ));
        
        // Save data to db
        $schedule = Schedule::find($id);

        if (null !== $request->input('is_draft')) {
            $schedule->is_draft = 1;
        }else {
            $schedule->is_draft = 0;
        }

        $schedule->period_date = $request->input('period_date');
        $schedule->schedule = $request->input('schedule');

        $schedule->save();

        // set flash data with success message
        Session::flash('success', "Schedule was successfully updated.");
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

        Session::flash('success', 'Schedule successfully deleted');
        return redirect()->route('schedule.index');
    }
}
