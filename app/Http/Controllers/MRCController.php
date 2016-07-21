<?php

namespace App\Http\Controllers;

use Mail;
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
use App\Formreq;
use App\Formreq_Objective;
use App\Formreq_ManagementProject;
use App\Formreq_Budget31;
use App\Formreq_Budget32;
use App\Formreq_Budget33;
use App\Formreq_Budget34;
use App\Formreq_Budget35;
use App\Formreq_Budget36;
use App\Formreq_Budget37;
use App\Formreq_Payroll;
use App\Formreq_AuthorizedPerson;
use App\Formreq_PayDate;
use App\Role;
use PhpOffice\PhpWord\PhpWord;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Reader_Excel2007;
use Yajra\Datatables\Datatables;
use App\MRC_Couse;
use App\MRC_Group;
use App\MRC_Place;

class MRCController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        if (Auth::check() == false) {
            return redirect('login');
        }
    }

    public function index() {



        $Formreqs = Formreq::whereIn('FormReqStstus', array(2, 3, 4, 5, 6))
                ->orderBy('FormReqStstus', 'asc')
                ->get();
        return view('placemng', ['user' => Auth::user(), 'Formreqs' => $Formreqs]);
    }

    public function placemng() {
        return view('placemng', ['user' => Auth::user()]);
    }

    public function getPlace() {
        return Datatables::of(MRC_Place::query())->make(true);
    }

    public function getGroup() {
        return Datatables::of(MRC_Group::query())->make(true);
    }

    public function getCouse() {
        return Datatables::of(MRC_Couse::query())->make(true);
    }

    public function SavePlace(Request $request) {
        $place = new MRC_Place;
        $place->placename = $request->placename;
        $place->placeabbreviate = $request->placeabbreviate;
        $place->placeadddate = Date("Y/m/d");
        $place->placeaddby = Auth::user()->id;
        $place->placeisdelete = 0;
        $place->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function EditPlace(Request $request) {
        $place = MRC_Place::find($request->placeid);
        $place->placename = $request->placename;
        $place->placeabbreviate = $request->placeabbreviate;
        $place->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function DeletePlace(Request $request) {
        $place = MRC_Place::find($request->placeid);
        $place->placeisdelete = 1;
        $place->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function SaveCouse(Request $request) {
        $couse = new MRC_Couse;
        $couse->cousename = $request->cousename;
        $couse->couseengname = $request->couseengname;
        $couse->couseadddate = Date("Y/m/d");
        $couse->couseaddby = Auth::user()->id;
        $couse->couseisdelete = 0;
        $couse->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function EditCouse(Request $request) {
        $couse = MRC_Couse::find($request->couseid);
        $couse->cousename = $request->cousename;
        $couse->couseengname = $request->couseengname;
        $couse->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function DeleteCouse(Request $request) {
        $couse = MRC_Couse::find($request->couseid);
        $couse->couseisdelete = 1;
        $couse->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function SaveGroup(Request $request) {
        $group = new MRC_Group;
        $group->groupname = $request->groupname;
        $group->groupengname = $request->groupengname;
        $group->groupabbreviate = $request->groupabbreviate;
        $group->groupadddte = Date("Y/m/d");
        $group->groupaddby = Auth::user()->id;
        $group->groupisdelete = 0;
        $group->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function EditGroup(Request $request) {
        $group = MRC_Group::find($request->groupid);
        $group->groupname = $request->groupname;
        $group->groupengname = $request->groupengname;
        $group->groupabbreviate = $request->groupabbreviate;
        $group->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function DeleteGroup(Request $request) {
        $group = MRC_Group::find($request->groupid);
        $group->groupisdelete = 1;
        $group->save();
        return Response::json([ "message" => "saved"], 200);
    }

}
