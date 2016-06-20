<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleType extends Model
{
    //
    /**
     * Get the user_role record associated with the role.
     */
    public function get_roles()
    {
        return $this->hasMany('App\Role','role_type');
    }
}
