<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuleStatus extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'module_statuses';

    /**
     * Get the module record associated with the user.
     */
    public function userModule()
    {
        return $this->hasMany('App\UserModule','status');
    }
}
