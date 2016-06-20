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
use App\ModuleStatus;
use Datetime;
use App\Common\Utility;

class UserController extends Controller
{
/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function profile(){
        return view('profile', ['user' => Auth::user(), 'types' => UserType::all(), 'departments' => Department::all(), 'nationalities' => Nationality::all(),
            
            'userDocs' => UserDocument::where('user','=',Auth::user()->id)->get(),
            'titles' => Title::all(),
            'sexes' =>Sex::all(),
            'occupations' => Occupation::all(),
            'modules' => Module::all(),
            'userModules' => UserModule::where('user','=',Auth::user()->id)->get()
            ]);
    }

    public function module(){
        return view('module', ['userModules' => UserModule::where('user','=',Auth::user()->id)->get()]);
    }

    public function getModules(){
        $userModules = DB::table('user_modules')
                    ->join('users as u','user_modules.user','=','u.id')
                    ->join('modules as m','user_modules.module','=','m.id')
                    ->join('module_statuses as ms','user_modules.status','=','ms.id')
                    ->where('u.id','=',Auth::user()->id)
                    ->select('m.id as module_id','m.name as module','ms.name as status','ms.id as status_id')
                    ->get();

            return Response::json($userModules);
    }

    public function requestModule(Request $request, $module_id){
        $userModule = UserModule::where('user','=',Auth::user()->id)->where('module','=',$module_id)->first();
        if($userModule->status == 1 || $userModule->status == 4){
            $modulestatus = ModuleStatus::find(2);//waiting for approval
            $userModule->get_status()->associate($modulestatus);
            $userModule->save();

            $userModules = DB::table('user_modules')
                    ->join('users as u','user_modules.user','=','u.id')
                    ->join('modules as m','user_modules.module','=','m.id')
                    ->join('module_statuses as ms','user_modules.status','=','ms.id')
                    ->where('u.id','=',Auth::user()->id)
                    ->select('m.id as module_id','m.name as module','ms.name as status','ms.id as status_id')
                    ->get();

            Utility::sendEmailToApprover(Auth::user(),Module::find($module_id));
            return Response::json($userModules);
        }
        return Response::json(array('error' => 'unauthorized'),401);
    }

    public function password(){
        return view('changepassword');
    }

    public function changepassword(Request $request){
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required'
        );

        $input = $request->all();

        // Create a new validator instance.
        $validator = Validator::make($input, $rules);

        if (!Auth::validate(array('email' => Auth::user()->email, 'password' => $input['old_password']))) {
            $validator->getMessageBag()->add('old_password', env('V_PASSWORD_INCORRECT'));
        }else{
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->password = bcrypt($input['new_password']);
            $user->save();
            return Response::json(["message"=>env('CHANGEPASSWORD_COMPLETE')],200);
        }

        return Response::json(["error"=>$validator->messages()],422);
    }

    public function updateProfile(Request $request){
        
            $v = Validator::make($request->all(), $this->rulesForUpdateProfile(), $this->messages());

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

             if($v->fails()){
                /*return Redirect::back()
                        ->withErrors($v)
                        ->withInput();*/
                return Response::json(["error"=> $v -> messages()
                    ],422);
             }

            $user = User::find(Auth::user()->id);
             //details for all type
            $user->firstname = $request['firstname'];
            $user->lastname = $request['lastname'];
            $date = DateTime::createFromFormat('d-m-Y H:i:s', $request['dob'].' 00:00:00');
            $user->dob = $date->format('Y-m-d H:i:s');
            
            $title = Title::find($request['title']);
            $user->get_title()->associate($title);
            $sex = Sex::find($request['sex']);
            $user->get_sex()->associate($sex);
            $nationality = Nationality::find($request['nationality']);
            $user->get_nationality()->associate($nationality);
            $type = UserType::find($request['type']);
            $user->get_userType()->associate($type);
            $occupation = Occupation::find($request['occupation']);
            $user->get_occupation()->associate($occupation);

            if($request['department']!=null){
            $department = Department::find($request['department']);
            $user->get_department()->associate($department);
            }

            $user->address = $request["address"];
            $user->tel = $request["tel"];
            $user->student_id = $request['student_id'];
            $user->citizen_id = $request['citizen_id'];
            $user->passport_id = $request['passport_id'];
            $user->advisor = $request['advisor'];
            $user->researchtopic = $request['researchtopic'];
            $user->company = $request['company'];

            $user->save();

            //for upload file
            $destinationPath = 'uploads'; // upload path
            $files = $request['documents'];
            $descriptions = $request['filedesc'];

            for($i = 0; $i < count($files); $i++){
                if($files[$i] != null){
                    if(Input::hasFile('documents')){
                        $filename = rand(11111111,99999999).'_'.date('Ymdhis').'.'.$files[$i]->getClientOriginalExtension();                        
                        $files[$i] -> move($destinationPath, $filename);
                        

                        $userDoc = new UserDocument();
                        $userDoc->path = $destinationPath.'/'.$filename;
                        $userDoc->description = $descriptions[$i];
                        $userDoc->get_user()->associate($user);
                        $userDoc->save();
                    }
                }
            }

            $userModules = UserModule::where('user','=',Auth::user()->id)->get();

            $userDocs = UserDocument::where('user','=',Auth::user()->id)->get();

            /*return Redirect::back()->with(['user' => Auth::user(), 'types' => UserType::all(), 'departments' => Department::all(), 'nationalities' => Nationality::all(),
            'userDocs' => $userDocs,
            'titles' => Title::all(),
            'sexes' =>Sex::all(),
            'occupations' => Occupation::all(),
            'modules' => Module::all(),
            'userModules' => $userModules
            ]);*/
            return Response::json([ "message" => "updated success!"], 200);
            
    }

    public function deleteDoc(Request $request, $id){
            $doc = UserDocument::find($id);

            if($doc->user != Auth::user()->id){
                return Response::json(array('message' => 'Unauthorized!', 401));
            }else if(unlink($doc->path)){
                $doc->delete();
                return Response::json(UserDocument::where('user',Auth::user()->id)->get());
            }else{
                return Response::json(array('message' => 'something wrong!', 500));
            }
     }

    /*
    *
    * This is for upload files error messages
    */
    public function messages(){
        $messages = [];
        $nbr = count(Input::file("documents")) > 1 ? count(Input::file("documents")) : 0 ;
        $messages['documents.0.required'] = "Please upload a file to verify your identity";
        for($i = 0;$i<=$nbr;$i++){
            if(Input::file("documents.".$i) != null){
            $messages['documents.'."$i".'.mimes'] = "The file ".Input::file("documents.".$i)->getClientOriginalName()." is in wrong format.";
            }
            
        }
        return $messages;
    }

    public function rulesForUpdateProfile(){
        if(count(UserDocument::where('user','=',Auth::user()->id)->get()) ==0) {
            return ['firstname' => 'required|max:255',
            'documents.0'=> 'required|mimes:png,jpg,jpeg,pdf',
            'documents.*'=> 'mimes:png,jpg,jpeg,pdf',
            'filedesc.*'=> 'required',
            'type' => 'required',
            'lastname' => 'required|max:255',
            'nationality' => 'required',
            'title' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'sex' => 'required'
            ];
        }else{
            return ['firstname' => 'required|max:255',
            'type' => 'required',
            'lastname' => 'required|max:255',
            'nationality' => 'required',
            'title' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'tel' => 'required',
            'sex' => 'required'
            ];
        }
    }

    public function getDocuments(){
        return Response::json(UserDocument::where('user','=',Auth::user()->id)->get());
    }
}
