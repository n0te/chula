<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    /**
     * Get the user_role record associated with the role.
     */
    public function userRole()
    {
        return $this->hasMany('App\UserRole','role');
    }

    //
    /**
     * Get the modules record associated with the role.
     */
    public function get_module()
    {
        return $this->belongsTo('App\Module','module');
    }

    //
    /**
     * Get the role_type record associated with the role.
     */
    public function get_roletype()
    {
        return $this->belongsTo('App\RoleType','role_type');
    }

    //
    /**
     * Get the users record associated with the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User','user_roles','role','user');
    }
}
