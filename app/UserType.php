<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserType extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_types';

    /**
     * Get the user record associated with the user_type.
     */
    public function user()
    {
        return $this->hasMany('App\User','type');
    }
}
