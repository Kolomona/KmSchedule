<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Role;
use App\Location;
use Gate;
use Session;
use Exception;


class UsersController extends Controller
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
        $roleCount = User::getUserRoleCount()[0];
        if($request['hide_inactive_employees']=='checked'){
            $hide_inactive_employees = true;
        }else{
            $hide_inactive_employees = false;
        }
        $users = User::all();
        return view('admin.users.index')->with([
            'users' => $users,
            'hide_inactive_employees' => $hide_inactive_employees,
            'roleCount' => $roleCount
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
        $locations = Location::pluck('name', 'id');
        return view('admin.users.create', ['roles' => $roles,'locations' => $locations]);
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

        $this->validate($request, array(
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'roles' => 'required'
        ));

        $location = Location::find($request['location'])->first();


        try {
            if (empty($request['active'])) {
                $active = 0;
            }else{
                $active = 1;
            }

            $user = User::create([
                'name' => $request['name'],
                'lastName' => $request['lastName'],
                'nickName' => $request['nickName'],
                'active'   => $active,
                'email'    => $request['email'],
                'password' => Hash::make($request['password']),
                'location_id' => $location->id
            ]);
            
            $user->roles()->sync($request->roles);
            Session::flash('success', "The Employee \"$user->name\" was successfully added");
            // redirect to another page


        } catch (Exception $exception) {
            if (strpos($exception, 'Duplicate') !== false) {
                Session::flash('failure', "The Employee was NOT added. Employee name or email already exists");
            } else {
                Session::flash('failure', "Unknown Error: $exception");
            }
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roleCount = User::getUserRoleCount();
        if (Gate::denies('edit-users')) {
            Session::flash('failure', "Only Admins or Managers can edit employees");
            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'roleCount' => $roleCount
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if (Gate::denies('edit-users')) {
            Session::flash('failure', "Only Admins or Managers can edit employees");
            return redirect()->route('admin.users.index');
        }
        
        // Check to see if the admin role is being changed
        if($user->hasRole('admin') && $request->role != 1 && User::getUserRoleCount()[0]['admin'] == 1){
            Session::flash('failure', "Cannot remove the last admin in the database");
            return redirect()->route('admin.users.edit', ["user" => $user]);
            
        }
        // If so Check to see if there are any other admins in db
        // If not then deny the change with message
        $user->roles()->sync($request->role);

        if (!empty($request['password'])) {
            $user->password = Hash::make($request['password']);
        }
        if (empty($request['active'])) {
            $user->active = 0;
        }else{
            $user->active = 1;
        }
        
        $user->name = $request->name;
        $user->lastName = $request->lastName;
        $user->nickName = $request->nickName;
        $user->email = $request->email;
        
        $user->save();
        Session::flash('success', "Employee $user->name was successfully updated.");
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::denies('delete-users')) {
            Session::flash('failure', "Only Admins can delete employees");
            return redirect()->route('admin.users.index');
        }

        // check if the last admin is being deleted and fail with message
        // check if deleting own account and fail with message (should solve above problem)
        if(Auth::user()->name == $user->name){
            Session::flash('failure', "You cannot delete the account that you are currently logged in with.");
            return redirect()->route('admin.users.index');
        }
        $user->roles()->detach();
        $user->delete();
        Session::flash('success', "Employee \"$user->name\" was successfully deleted forever.");
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function passwordChange(Request $request, User $user)
    {
        Session::flash('success', "You successfully changed your password. Log out then in again to verify");
        return redirect()->route('admin.users.index');
    }
}
