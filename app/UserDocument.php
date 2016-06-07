<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_documents';

    /**
     * Get the user record associated with the user.
     */
    public function get_user()
    {
        return $this->belongsTo('App\User','user');
    }
}
