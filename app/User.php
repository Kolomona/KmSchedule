<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastName',
        'nickName',
        'active',
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }

        return false;
    }  

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first()){
            return true;
        }

        return false;
    } 

    public static function getUserRoleCount()
    {
        // Search users and count what roles they are
        // Return an array of roles and counts
        // ['admin' => '1', 'manager' => '2', 'employee' => '5']
        $users = User::all();
        $roles = Role::all();
        $rolecount = []; 

        
        // This is a mess and should be fixed
        foreach ($users as $index=>$user) {
            foreach ($roles as $index => $role) {
                
                if(!array_key_exists($role->name, $rolecount)){
                    //If Role isn't in the array put it in and set count to 0
                    $rolecount[$role->name] = 0;
                }
                //Get the role of the user being checked this round
                $userRole = $user->roles()->where('name', $role->name)->first();
                if($userRole != null && $userRole->name == $role->name){
                    $rolecount[$role->name] ++;       
                }
                
            }
        }
        return [$rolecount];
    }
}
