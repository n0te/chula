<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserType;
use App\Department;
use App\Nationality;
use App\Sex;
use App\Title;
use App\UserDocument;
use App\UserModule;
use App\UserRole;
use App\Module;
use App\ModuleStatus;
use App\Occupation;
use App\Role;
use DateTime;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Common\Utility;
use Mail;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

         $v = Validator::make($data, [
            'firstname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'documents.*'=> 'mimes:png,jpg,jpeg,pdf',
            'filedesc.*'=> 'required',
            'type' => 'required',
            'lastname' => 'required|max:255',
            'nationality' => 'required',
            'hidden_module_value' => 'required',
            'title' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'sex' => 'required'
            ], $this->messages());

         $v->sometimes('student_id', 'required|max:500', function($input)
        {
            return $input->occupation == 1;
        });
         $v->sometimes('advisor', 'required', function($input)
        {
            return $input->occupation == 1;
        });
         $v->sometimes('researchtopic', 'required', function($input)
        {
            return $input->occupation == 1;
        });
         $v->sometimes('passport_id', 'required', function($input)
        {
            return $input->nationality > 1;
        });
         $v->sometimes('citizen_id', 'required', function($input)
        {
            return $input->nationality == 1;
        });
         $v->sometimes('occupation', 'required', function($input)
        {
            return $input->type < 3 && $input->type != '';
        });
         $v->sometimes('company', 'required', function($input)
        {
            return $input->type > 2;
        });
         $v->sometimes('department', 'required', function($input)
        {
            return $input->type < 2 && $input->type != '';
        });
         
         return $v;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = new User();

        //details for all type
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->password = bcrypt($data['password']);
        $user->email = $data['email'];  
        $date = DateTime::createFromFormat('d-m-Y H:i:s', $data['dob'].' 00:00:00');
        $user->dob = $date->format('Y-m-d H:i:s');
        
        $title = Title::find($data['title']);
        $user->get_title()->associate($title);
        $sex = Sex::find($data['sex']);
        $user->get_sex()->associate($sex);
        $nationality = Nationality::find($data['nationality']);
        $user->get_nationality()->associate($nationality);
        $type = UserType::find($data['type']);
        $user->get_userType()->associate($type);
        $occupation = Occupation::find($data['occupation']);
        $user->get_occupation()->associate($occupation);

        if($data['department']!=null){
        $department = Department::find($data['department']);
        $user->get_department()->associate($department);
        }

        $user->address = $data["address"];
        $user->tel = $data["tel"];
        $user->student_id = $data['student_id'];
        $user->citizen_id = $data['citizen_id'];
        $user->passport_id = $data['passport_id'];
        $user->status = true;
        $user->advisor = $data['advisor'];
        $user->researchtopic = $data['researchtopic'];
        $user->company = $data['company'];

        $user->save();
        
        //for module
        foreach (Module::all() as $module) {
            if(array_key_exists('module_'.$module->id, $data)){
                $userModule = new UserModule();
                $modulestatus = Modulestatus::find(2);//waiting for approval
                Utility::sendEmailToApprover($user,$module);
                $userModule->get_status()->associate($modulestatus);
                $userModule->get_user()->associate($user);
                $userModule->get_module()->associate($module);
                $userModule->save();
            }else{
                $userModule = new UserModule();
                $modulestatus = Modulestatus::find(1);//not requested
                $userModule->get_status()->associate($modulestatus);
                $userModule->get_user()->associate($user);
                $userModule->get_module()->associate($module);
                $userModule->save();
            }
        }

        //for upload file
        $destinationPath = 'uploads'; // upload path
        $files = $data['documents'];
        $descriptions = $data['filedesc'];

        for($i = 0; $i < count($files); $i++){
            if($files[$i] != null){
            $filename = rand(11111111,99999999).'_'.date('Ymdhis').'.'.$files[$i]->getClientOriginalExtension();
            $files[$i] -> move($destinationPath, $filename);
            

            $userDoc = new UserDocument();
            $userDoc->path = $destinationPath.'/'.$filename;
            $userDoc->description = $descriptions[$i];
            $userDoc->get_user()->associate($user);
            $userDoc->save();
            }
        }

        return $user;
    }
    
    public function profile(){

        return view('updateprofile', ['user' => Auth::user()]);
    }
    
    /*
    *
    * This is for upload files error messages
    */
    public function messages(){
        $messages = [];
        //$nbr = count(\Request::input('documents'));Input::file("documents.".$i)
        $nbr = count(Input::file("documents")) > 1 ? count(Input::file("documents")) : 0 ;
       
        $messages['documents.0.required'] = "Please upload a file to verify your identity";
        //$messages['documents.0.mimes'] = $nbr;
        
        
        for($i = 0;$i<=$nbr;$i++){
            if(Input::file("documents.".$i) != null){
            $messages['documents.'."$i".'.mimes'] = "The file ".Input::file("documents.".$i)->getClientOriginalName()." is in wrong format.";
            }
            
        }
        
            
        return $messages;
    }

    /**
     * override the one in /vendor/laravel/framework/src/Illuminate/Foundation/Auth/RegistersUsers.php
     *
     * 
     */
    public function showRegistrationForm()
    {
        $types = UserType::all();
        $departments = Department::all();
        $nationalities = Nationality::all();
        $sexes = Sex::all();
        $titles = Title::all();
        $modules = Module::all();
        $occupations = Occupation::all();
        $data = [
            'types' => $types,
            'departments' => $departments,
            'nationalities' => $nationalities,
            'sexes' => $sexes,
            'titles' => $titles,
            'modules' => $modules,
            'occupations' => $occupations
        ];
        return view('auth.register')->with($data);
    }

    /**
     * Show the application login form.
     * override the one in /vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticatesUser.php
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
                    ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        $types = UserType::all();
        $departments = Department::all();
        $nationalities = Nationality::all();
        $sexes = Sex::all();
        $titles = Title::all();
        $modules = Module::all();
        $occupations = Occupation::all();
        $data = [
            'types' => $types,
            'departments' => $departments,
            'nationalities' => $nationalities,
            'sexes' => $sexes,
            'titles' => $titles,
            'modules' => $modules,
            'occupations' => $occupations
        ];
        return view('auth.login')->with($data);
    }
}
