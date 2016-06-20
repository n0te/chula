<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    //
    //
    public function user() {
        return $this->hasMany('App\User','occupation');
    }
}
