<?php 
namespace App\Common;
 
use Mail;
use DB;
use App\Role;
use App\UserModule;
use App\Log;
use App\UserRole;

class Utility{
   public static function writeLog($msg){
      $log = new Log();
      $log->message = $msg;
      $log->save();
   }

   public static function sendRegisterAcknowledgedEmailtoUser($requestor){
      try{
        Mail::queue('admin.emails.acknowledge', ['requestor_name' => $requestor->firstname], function($message) use ($requestor)
        {
            $message->to($requestor->email, 'RSApp System')->subject('การสมัครใช้งาน Research Application');
        });
      }catch (\Throwable $t) {
        // Executed only in PHP 7, will not match in PHP 5.x
        self::writeLog('from throwable'.$t->getMessage());
        }catch(\Exception $e){
        self::writeLog($e->getMessage());
       }
   }

   public static function sendEmailToApprover($requestor , $module) {
   		$admin_type_id = 1;//fix in DB

   		$admin_emails = [];
        /*$rows = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->where('rt.id','=',$admin_type_id)//admin
                    ->where('m.id','=',$module->id)//module
                    ->select('u.email as emails')
                    ->get();
                foreach($rows as $row){
                    array_push($admin_emails,$row->emails);
                } */
    $users = Role::where('role_type','=',$admin_type_id)->where('module','=',$module->id)->first()->users;
    //$users = Role::find($role->id)->users;

    foreach($users as $user){
      array_push($admin_emails,$user->email);
    }

    $approve_url = url('/reviewprofile/'.$requestor->id);

    try{
		Mail::queue('admin.emails.needapproval', ['requestor_name' => $requestor->firstname, 'module_name' => $module->name, 'approve_url' => $approve_url], function($message) use ($admin_emails, $module)
		{
		    $message->to($admin_emails, 'RSApp System')->subject('แจ้งเตือนการร้องขอสิทธิ '.$module->name);
		});
  }catch (\Throwable $t) {
    // Executed only in PHP 7, will not match in PHP 5.x
    self::writeLog('from throwable'.$t->getMessage());
    }catch(\Exception $e){
    self::writeLog($e->getMessage());
   }
  }
 
  public static function isAdminOfModule($module, $userid){
    $admin_type_id = 1;//fix in DB
    $rows = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->where('m.id','=',$module)
                    ->where('rt.id','=',$admin_type_id)//admin
                    ->where('u.id','=',$userid)->get();
    if(count($rows)==1){
      return true;
    }
    
    return false;
  }

  public static function isMemberOfModule($module, $userid){
    $member_type_id = 2;//fix in DB
    $rows = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->where('m.id','=',$module)
                    ->where('rt.id','=',$member_type_id)//admin
                    ->where('u.id','=',$userid)->get();
    if(count($rows)==1){
      return true;
    }
    
    return false;
  }

  public static function isAdminofAnyModule($userid){
    $admin_type_id = 1;//fix in DB
    $rows = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->where('rt.id','=',$admin_type_id)//admin
                    ->where('u.id','=',$userid)->get();
    if(count($rows)>0){
      return true;
    }
    return false;
  }

  public static function isMemberofAnyModule($userid){
    $member_type_id = 2;//fix in DB
    $rows = DB::table('roles')
                    ->join('user_roles as ur','roles.id','=','ur.role')
                    ->join('users as u','ur.user','=','u.id')
                    ->join('modules as m','roles.module','=','m.id')
                    ->join('role_types as rt','roles.role_type','=','rt.id')
                    ->where('rt.id','=',$member_type_id)//admin
                    ->where('u.id','=',$userid)->get();
    if(count($rows)>0){
      return true;
    }
    return false;
  }

  public static function sendRejectEmailToUser($requestor , $module, $admin, $reason){
    $approve_url = url('/');
    try{
      Mail::queue('admin.emails.reject', ['module_name' => $module->name, 'reason' => $reason, 'admin_email' => $admin->email, 'approve_url' => $approve_url], function($message) use ($requestor, $module)
      {
          $message->to($requestor->email, 'RSApp System')->subject('การร้องขอสิทธิ '.$module->name.' ถูกปฏิเสธ' );
      });
      self::writeLog($module->name.' reject email sent to : '.$requestor->email. ' with reason: '.$reason);
    }catch (\Throwable $t) {
    // Executed only in PHP 7, will not match in PHP 5.x
    self::writeLog('from throwable'.$t->getMessage());
    }catch(\Exception $e){
      self::writeLog($e->getMessage());
    }
  }

  public static function sendApproveEmailToUser($requestor , $module, $admin){
    $approve_url = url('/');
    try{
      Mail::queue('admin.emails.approve', ['module_name' => $module->name, 'admin_email' => $admin->email, 'approve_url' => $approve_url], function($message) use ($requestor, $module)
      {
          $message->to($requestor->email, 'RSApp System')->subject('การร้องขอสิทธิ '.$module->name.' ได้รับการอนุญาต' );
      });
      self::writeLog($module->name.' approve email sent to : '.$requestor->email);
    }catch (\Throwable $t) {
    // Executed only in PHP 7, will not match in PHP 5.x
    self::writeLog('from throwable'.$t->getMessage());
    }catch(\Exception $e){
      self::writeLog($e->getMessage());
    }
  }

  public static function rejectUser($moduleid, $userid){
    //when reject set user's module status to 4
    $um = UserModule::where('user','=',$userid)->where('module','=',$moduleid)->first();
    $um->status = 4;
    $um->save();
  }

  public static function approveUser($moduleid, $userid){
    //when approve set user's module status to 3
    $um = UserModule::where('user','=',$userid)->where('module','=',$moduleid)->first();
    //avoid double approve
    if($um->status == 3){
      throw new Exception("already approved!", 1);
    }
    $um->status = 3;
    $um->save();

    //and add member role for this user
    $role_type= 2;//fix in DB for all member roles
    $member_role_id = Role::where('role_type','=',$role_type)->where('module','=',$moduleid)->first()->id;
    $user_role = new UserRole();
    $user_role->user = $userid;
    $user_role->role = $member_role_id;
    $user_role->save();
  }
}
