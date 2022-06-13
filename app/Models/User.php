<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function favorites()
    {
        return $this->hasMany('App\Models\Favorite');   
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');   
    }
}
