<?php

namespace App;

use Datetime;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //
    /**
     * Get the user DOB record associated with the user.
     */
    public function get_userDOB()
    {
        $date = DateTime::createFromFormat('Y-m-d', $this->dob);
        return $date->format('d-m-Y');
    }

    /**
     * Get the type record associated with the user.
     */
    public function get_userType()
    {
        return $this->belongsTo('App\UserType','type');
    }

    /**
     * Get the department record associated with the user.
     */
    public function get_department()
    {
        return $this->belongsTo('App\Department','department');
    }

    /**
     * Get the nationality record associated with the user.
     */
    public function get_nationality()
    {
        return $this->belongsTo('App\Nationality','nationality');
    }

    /**
     * Get the sex record associated with the user.
     */
    public function get_sex()
    {
        return $this->belongsTo('App\Sex','sex');
    }

    /**
     * Get the title record associated with the user.
     */
    public function get_title()
    {
        return $this->belongsTo('App\Title','title');
    }

    /**
     * Get the title record associated with the user.
     */
    public function get_occupation()
    {
        return $this->belongsTo('App\Occupation','occupation');
    }

    /**
     * Get the user_role record associated with the user_type.
     */
    public function get_userRoles()
    {
        return $this->hasMany('App\UserRole','user');
    }

    /**
     * Get the roles record associated with the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role','user_roles','user','role');
    }

    /**
     * Get the user record associated with the user_type.
     */
    public function get_userDocuments()
    {
        return $this->hasMany('App\UserDocument','user');
    }

    /**
     * Get the user_role record associated with the user_type.
     */
    public function get_userModules()
    {
        return $this->hasMany('App\UserModule','user');
    }

    /**
     * Get the modules record associated with the user.
     */
    public function modules()
    {
        return $this->belongsToMany('App\Module','user_modules','user','module');
    }
}
