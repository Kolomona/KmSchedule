<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function users()
    {
        return $this->hasMany('App\user');
    }

}
