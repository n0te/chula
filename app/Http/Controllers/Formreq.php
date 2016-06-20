<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserType;
use App\Department;
use App\Nationality;
use Response;
use Illuminate\Support\Facades\Input;
use Redirect;
use DB;
use App\UserDocument;
use App\Module;
use App\Title;
use App\Sex;
use App\Occupation;
use App\UserModule;
use App\Modulestatus;
use Datetime;
use App\Common\Utility;

class Formreq extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function updateForm(Request $request) {
        $user = $request['txtSponser'];
        echo $user;
    }

}
