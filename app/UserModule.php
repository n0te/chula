<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserModule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_modules';
    //
    /**
     * Get the user record associated with the user.
     */
    public function get_user()
    {
        return $this->belongsTo('App\User','user');
    }

    //
    /**
     * Get the module record associated with the user.
     */
    public function get_module()
    {
        return $this->belongsTo('App\Module','module');
    }

    //
    /**
     * Get the module record associated with the user.
     */
    public function get_status()//error when the function name is the same as column name!!!! so I need to put get_ before
    {
        return $this->belongsTo('App\ModuleStatus','status');
    }
}
