<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        // get the prefered home page based on user role
        if(Auth::user()->hasRole('admin')){
            $homepage = env('USER_ADMIN_HOME_PAGE');
        }elseif(Auth::user()->hasRole('manager')){
            $homepage = env('USER_MANAGER_HOME_PAGE');
        }elseif(Auth::user()->hasRole('employee')){
            $homepage = env('USER_EMPLOYEE_HOME_PAGE');
        }
        // parse the homepage for valid page
        // schedules
        // employees
        // latest
        switch ($homepage) {
            case 'schedules':
                $this->redirectTo = route('schedule.index');
            break;
            case 'employees':
                $this->redirectTo = route('admin.users.index');
            break;
            
            case 'latest':
                $this->redirectTo = route('schedule.show', ['latest']);
            break;
            
            default:
                Session::flash('failure', "Homepage not found, redirecting to latest schedule. Please check .env file for mispellings");
                $this->redirectTo = route('schedule.show', ['latest']);
            break;
        }
        return $this->redirectTo;
    }
}
