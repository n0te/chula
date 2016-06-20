<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Role;
use Response;
use App\UserType;
use App\Department;
use App\Nationality;
use App\Title;
use App\Sex;
use App\Occupation;
use App\UserDocument;
use App\Module;
use Auth;
use DB;
use App\Common\Utility;

class AdminController extends Controller
{
    /* Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reviewProfile($userid){
    	//check if the current user is an admin ?
    	$adminid = Auth::user()->id;
    	if(Utility::isAdminOfAnyModule(Auth::user()->id)){
    		$user = User::find($userid);
	    	$title = Title::find($user->title)->name;
	    	$type = UserType::find($user->type)->name;
	    	if(Department::find($user->department) != null){
	    		$department = Department::find($user->department)->name;
	    	}else{
	    		$department = '';
	    	}
	    	$nationality = Nationality::find($user->nationality)->name;
	    	$sex = Sex::find($user->sex)->name;
	    	if(Occupation::find($user->occupation) != null){
	    		$occupation = Occupation::find($user->occupation)->name;
	    	}else{
	    		$occupation = '';
	    	}
	    	
	    	return view('admin.reviewprofile', [
	            'user' => Auth::user(), 'type' => $type, 'department' => $department, 'nationality' => $nationality,
	            
	            'userDocs' => UserDocument::where('user','=',$userid)->get(),
	            'title' => $title,
	            'sex' =>$sex,
	            'occupation' => $occupation, 'reviewuser' => $user
	        ]);
    	}
    	return view('noaccess',['user' => Auth::user()]);
    }

    public function getReviewModules($userid){
    	//query admin's modules with the user status
    	$admin_type_id = 1;//fix in DB

    	$rows = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->join('user_modules as um','m.id','=','um.module')
                    ->join('module_statuses as ms','um.status','=','ms.id')
                    ->where('rt.id','=',$admin_type_id)//admin
                    ->where('u.id','=',Auth::user()->id)
                    ->where('um.user','=',$userid)
                    ->select('m.name as m_name','ms.name as statusname','um.status as status','m.id as m_id')->get();

        return Response::json(json_encode($rows));
    }

    public function managemember(){
    	return view('admin.memberlist', [
            'users' => User::orderBy('created_at', 'asc')->whereIn('mrc_access_status',[1,2])->get()
        ]);
    }

    public function reject(Request $request, $module,$id){
    	//check if this user is an admin of rejected module
        if(Utility::isAdminOfModule($module,Auth::user()->id)){
        	Utility::rejectUser($module, $id);
        	Utility::sendRejectEmailToUser(User::find($id) , Module::find($module), Auth::user(), $request['rejectmsg']);
        	return Response::json(array('message'=>'ดำเนินการเสร็จสิ้น'));
        }
        return Response::json(array('message'=>'unauthorized'),401);
    }

    public function approve($module,$id){
    	//check if this user is an admin of rejected module
        if(Utility::isAdminOfModule($module,Auth::user()->id)){
        	Utility::approveUser($module, $id);
        	Utility::sendApproveEmailToUser(User::find($id) , Module::find($module), Auth::user());
        	return Response::json(array('message'=>'ดำเนินการเสร็จสิ้น'));
        }
        return Response::json(array('message'=>'unauthorized'),401);
    }

    public function getDocuments($userid){
        return Response::json(UserDocument::where('user','=',User::find($userid)->id)->get());
    }

    public function reviewMembers(){
    	$adminid = Auth::user()->id;
    	//check if the current user is an admin ?
    	if(Utility::isAdminofAnyModule($adminid)){
    		//query admin's modules with the user status
	    	$admin_type_id = 1;//fix in DB

	    	$members = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->join('user_modules as um','m.id','=','um.module')
                    ->join('module_statuses as ms','um.status','=','ms.id')
                    ->where('rt.id','=',$admin_type_id)//admin
                    ->where('u.id','=',Auth::user()->id)
                    ->join('users as u2','um.user','=','u2.id')
                    ->select('ms.name as statusname','um.status as status','u2.firstname as firstname', 'u2.lastname as lastname', 'u2.email as email', 'u2.id as userid','m.name as modulename')->get();

            return view('admin.reviewmemberlist',['user' => Auth::user(), 'members'=>$members]);
    	}
    	return view('noaccess',['user' => Auth::user()]);
    }

    public function getReviewMembers(){
    	$adminid = Auth::user()->id;
    	//check if the current user is an admin ?
    	if(Utility::isAdminofAnyModule($adminid)){
    		//query admin's modules with the user status
	    	$admin_type_id = 1;//fix in DB

	    	$members = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->join('user_modules as um','m.id','=','um.module')
                    ->join('module_statuses as ms','um.status','=','ms.id')
                    ->where('rt.id','=',$admin_type_id)//admin
                    ->where('u.id','=',Auth::user()->id)
                    ->join('users as u2','um.user','=','u2.id')
                    ->select('ms.name as statusname','um.status as status','u2.firstname as firstname', 'u2.lastname as lastname', 'u2.email as email', 'u2.id as userid','m.name as modulename')->get();

            return Response::json(json_encode($members));
    	}
    	return Response::json(array('error'=>'unauthorized'),401);
    }
}
