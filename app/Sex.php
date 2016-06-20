<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    //
    /**
     * Get the user record associated with the user_type.
     */
    public function user()
    {
        return $this->hasMany('App\User','sex');
    }
}
