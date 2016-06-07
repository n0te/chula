<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * Get the user record associated with the module.
     */
    public function userModule()
    {
        return $this->hasMany('App\UserModule','module');
    }

    /**
     * Get the user record associated with the module.
     */
    public function users()
    {
        return $this->belongToMany('App\User','user_modules','module','user');
    }
}
