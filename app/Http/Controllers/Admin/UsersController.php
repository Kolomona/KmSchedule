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
use Alert;
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
            Alert::toast('The Employee '.$user->name.' was successfully added', 'success');

        } catch (Exception $exception) {
            if (strpos($exception, 'Duplicate') !== false) {
                Alert::toast('The Employee was NOT added. Employee name or email already exists', 'error');
                // Session::flash('failure', "The Employee was NOT added. Employee name or email already exists");
            } else {
                Alert::toast("Unknown Error: $exception", 'error');
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
            Alert::toast('Only Admins or Managers can edit employees', 'error');
            return redirect()->route('admin.users.index');
        }

        $roles = Role::all();
        $locations = Location::pluck('name', 'id');

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'roleCount' => $roleCount,
            'locations' => $locations,
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
            Alert::toast('Only Admins or Managers can edit employees', 'error');
            return redirect()->route('admin.users.index');
        }
        
        // Check to see if the admin role is being changed
        if($user->hasRole('admin') && $request->role != 1 && User::getUserRoleCount()[0]['admin'] == 1){
            Alert::toast('Cannot remove the last admin in the database', 'error');
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
        $user->location_id = $request->location;
        $user->save();
        Alert::toast("Employee \"$user->name $user->lastName\" was successfully updated.", 'success');
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
            Alert::toast('Only Admins can delete employees', 'error');
            return redirect()->route('admin.users.index');
        }

        // check if the last admin is being deleted and fail with message
        // check if deleting own account and fail with message (should solve above problem)
        if(Auth::user()->name == $user->name){
            Alert::toast('You cannot delete the account that you are currently logged in with.', 'error');
            return redirect()->route('admin.users.index');
        }
        $user->roles()->detach();
        $user->delete();
        Alert::toast("Employee \"$user->name $user->lastName\" was successfully deleted forever..", 'error');
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
        Alert::toast("You successfully changed your password. Log out then in again to verify", 'success');
        return redirect()->route('admin.users.index');
    }
}
