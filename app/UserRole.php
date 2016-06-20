<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * Get the user record associated with the user_type.
     */
    public function user()
    {
        return $this->belongsTo('App\User','user');
    }

    /**
     * Get the user record associated with the user_type.
     */
    public function role()
    {
        return $this->belongsTo('App\Role','role');
    }
}
