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
use App\MRC_Equipment;
use App\MRC_Booking;

class MRCController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct() {
//        if (Auth::check() == false) {
//            return redirect('login');
//        }
//        //echo '555';
//    }

    public function index() {
        $Formreqs = Formreq::whereIn('FormReqStstus', array(2, 3, 4, 5, 6))
                ->orderBy('FormReqStstus', 'asc')
                ->get();
        return view('placemng', ['user' => Auth::user(), 'Formreqs' => $Formreqs]);
    }

    public function mrcbookingmng() {
        return view('mrcbooking', ['user' => Auth::user()]);
    }

    public function mymrcbooking() {
        return view('mymrcbooking', ['user' => Auth::user()]);
    }

    public function mrcbookingmngadmin() {
        return view('mrcbookingmngadmin', ['user' => Auth::user()]);
    }

    public function placemng() {
        return view('placemng', ['user' => Auth::user()]);
    }

    public function groupmng() {
        return view('groupmng', ['user' => Auth::user()]);
    }

    public function cousemng() {
        return view('cousemng', ['user' => Auth::user()]);
    }

    public function equipmentmng() {
        return view('equipmentmng', ['user' => Auth::user(),
            'places' => MRC_Place::where('placeisdelete', '=', 0)->get(),
            'couses' => MRC_Couse::where('couseisdelete', '=', 0)->get(),
            'groups' => MRC_Group::where('groupisdelete', '=', 0)->get()]);
    }

    public function getEquipmentforbooking() {
        $equipment = DB::TABLE('equipmentview')
                ->SELECT('equipmentid', 'equipmentname', 'groupname', 'placename', 'cousename', 'equipmentpicturename')
                ->WHERE('equipmentisdelete', '=', 0)
                ->WHERE('equipmentstatus', '=', 1);
        return Datatables::of($equipment)->make(true);
    }

    public function getEquipment() {
        $equipment = DB::TABLE('mrc_equipment')
                ->JOIN('mrc_group', 'mrc_equipment.equipmentgroup', '=', 'mrc_group.groupid')
                ->JOIN('mrc_place', 'mrc_equipment.equipmentplace', '=', 'mrc_place.placeid')
                ->JOIN('mrc_couse', 'mrc_equipment.equipmentcouse', '=', 'mrc_couse.couseid')
                ->SELECT('equipmentid', 'equipmentname', 'groupname', 'placename', 'equipmentstatus', 'equipmentpicturename', 'equipmentstatus')
                ->WHERE('equipmentisdelete', '=', 0);
        return Datatables::of($equipment)->make(true);
    }

    public function getPlace() {
        $places = DB::table('mrc_place')->select(['placeid', 'placename', 'placeabbreviate', 'placecomputername', 'placeadddate', 'placeaddby', 'placeisdelete'])->where('placeisdelete', '=', 0);
        return Datatables::of($places)->make(true);
    }

    public function getGroup() {

        $groups = DB::table('mrc_group')->select(['groupid', 'groupname', 'groupengname', 'groupabbreviate', 'groupadddte', 'groupaddby', 'groupisdelete'])->where('groupisdelete', '=', 0);
        return Datatables::of($groups)->make(true);
    }

    public function getCouse() {
        $groups = DB::table('mrc_couse')->select(['couseid', 'cousename', 'couseengname', 'couseadddate', 'couseaddby', 'couseisdelete'])->where('couseisdelete', '=', 0);
        return Datatables::of($groups)->make(true);
        //cousename``couseengname``couseadddate``couseaddby``couseisdelete``couseid`
    }

    public function getBookingByUserId() {
        $groups = DB::table('bookingview')->select(['bookingid', 'bookingdate', 'bookingstarttime', 'bookingendtime', 'bookingstatus', 'equipmentname', 'equipmentpicturename', 'firstname', 'lastname'])
                        ->where('bookingisdelete', '=', 0)->where('bookingaddby', '=', Auth::user()->id);
        return Datatables::of($groups)->make(true);
        //`bookingid``bookingdate``bookingstarttime``bookingendtime``equipmentname``equipmentpicturename`
    }

    public function getPlaceByID($id) {
        $MRCPlace = MRC_Place::where('placeid', '=', $id)->get();
        $data = array(
            'MRCPlace' => $MRCPlace
        );
        return Response::json($data);
    }

    public function getGroupByID($id) {
        $MRCGroup = MRC_Group::where('groupid', '=', $id)->get();
        $data = array(
            'MRCGroup' => $MRCGroup
        );
        return Response::json($data);
    }

    public function getCouseByID($id) {
        $MRCCouse = MRC_Couse::where('couseid', '=', $id)->get();
        $data = array(
            'MRCCouse' => $MRCCouse
        );
        return Response::json($data);
    }

    public function getEquipmentByID($id) {
        $MRCEquipment = MRC_Equipment::where('equipmentid', '=', $id)->get();
        $data = array(
            'MRCEquipment' => $MRCEquipment
        );
        return Response::json($data);
    }

    public function deleteEquipmentByID($id) {
        $equipment = MRC_Equipment::find($id);
        $equipment->equipmentisdelete = 1;
        $equipment->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function SaveEquipment(Request $request) {
        $equipment = new MRC_Equipment;
        $equipment->equipmentname = $request->equipmentname;
        $equipment->equipmentenname = $request->equipmentenname;
        $equipment->equipmentdetail = $request->equipmentdetail;
        $equipment->equipmentendetail = $request->equipmentendetail;
        $equipment->equipmenthourallow = $request->equipmenthourallow;
        $equipment->equipmentpricefordoctordepartment = $request->equipmentpricefordoctordepartment;
        $equipment->equipmentpriceforuniversity = $request->equipmentpriceforuniversity;
        $equipment->equipmentforoutsideuniversitygov = $request->equipmentforoutsideuniversitygov;
        $equipment->equipmentforoutsideuniversityprivate = $request->equipmentforoutsideuniversityprivate;
        // $equipment->equipmentpicturename = $request->equipmentpicturename;
        $equipment->equipmentstatus = $request->equipmentstatus;
        $equipment->equipmentcouse = $request->equipmentcouse;
        $equipment->equipmentgroup = $request->equipmentgroup;
        $equipment->equipmentplace = $request->equipmentplace;
        $equipment->equipmentaddate = Date("Y/m/d");
        $equipment->equipmentaddby = Auth::user()->id;
        $equipment->equipmentisdelete = 0;
        $equipment->save();
        $insertedId = $equipment->equipmentid;

        $picname = '';
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
            if (file_exists($_FILES["file"]["name"])) {
                unlink($_FILES["file"]["name"]);
            }
            $exten = explode(".", $_FILES["file"]["name"]);
            $picname = $insertedId . Date("His") . "." . $exten[1];
            move_uploaded_file($_FILES["file"]["tmp_name"], 'public/uploads/equipmentimg/' . $picname);
        }

        $equipmentup = MRC_Equipment::find($insertedId);
        $equipmentup->equipmentpicturename = $picname;
        $equipmentup->save();

        return Response::json(["message" => "saved"], 200);
    }

    public function EditEquipment(Request $request) {
        $equipment = MRC_Equipment::find($request->hidequipmentid);
        $equipment->equipmentname = $request->equipmentname;
        $equipment->equipmentenname = $request->equipmentenname;
        $equipment->equipmentdetail = $request->equipmentdetail;
        $equipment->equipmentendetail = $request->equipmentendetail;
        $equipment->equipmenthourallow = $request->equipmenthourallow;
        $equipment->equipmentpricefordoctordepartment = $request->equipmentpricefordoctordepartment;
        $equipment->equipmentpriceforuniversity = $request->equipmentpriceforuniversity;
        $equipment->equipmentforoutsideuniversitygov = $request->equipmentforoutsideuniversitygov;
        $equipment->equipmentforoutsideuniversityprivate = $request->equipmentforoutsideuniversityprivate;
        // $equipment->equipmentpicturename = $request->equipmentpicturename;
        $equipment->equipmentstatus = $request->equipmentstatus;
        $equipment->equipmentcouse = $request->equipmentcouse;
        $equipment->equipmentgroup = $request->equipmentgroup;
        $equipment->equipmentplace = $request->equipmentplace;
        $equipment->save();
        $picname = '';
        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                if (file_exists($_FILES["file"]["name"])) {
                    unlink($_FILES["file"]["name"]);
                }

                $exten = explode(".", $_FILES["file"]["name"]);
                $picname = $request->hidequipmentid . Date("His") . "." . $exten[1];
                $MRCEquipment = MRC_Equipment::where('equipmentid', '=', $request->hidequipmentid)->get();
                if (file_exists('public/uploads/equipmentimg/' . $MRCEquipment[0]->equipmentpicturename)) {
                    unlink('public/uploads/equipmentimg/' . $MRCEquipment[0]->equipmentpicturename);
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], 'public/uploads/equipmentimg/' . $picname);
                $equipmentup = MRC_Equipment::find($request->hidequipmentid);
                $equipmentup->equipmentpicturename = $picname;
                $equipmentup->save();
            }
        }
        return Response::json(["message" => "saved"], 200);
    }

    public function SavePlace(Request $request) {
        $place = new MRC_Place;
        $place->placename = $request->placename;
        $place->placeabbreviate = $request->placeabbreviate;
        $place->placecomputername = $request->placecomputername;
        $place->placeadddate = Date("Y/m/d");
        $place->placeaddby = Auth::user()->id;
        $place->placeisdelete = 0;
        $place->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function EditPlace(Request $request) {
        $place = MRC_Place::find($request->hidplaceid);
        $place->placename = $request->placename;
        $place->placeabbreviate = $request->placeabbreviate;
        $place->placecomputername = $request->placecomputername;
        $place->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function deletePlaceByID($id) {
        $place = MRC_Place::find($id);
        $place->placeisdelete = 1;
        $place->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function SaveCouse(Request $request) {
        $couse = new MRC_Couse;
        $couse->cousename = $request->cousename;
        $couse->couseengname = $request->couseengname;
        $couse->couseadddate = Date("Y/m/d");
        $couse->couseaddby = Auth::user()->id;
        $couse->couseisdelete = 0;
        $couse->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function EditCouse(Request $request) {
        $couse = MRC_Couse::find($request->hidcouseid);
        $couse->cousename = $request->cousename;
        $couse->couseengname = $request->couseengname;
        $couse->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function deleteCouseByID($id) {
        $couse = MRC_Couse::find($id);
        $couse->couseisdelete = 1;
        $couse->save();
        return Response::json(["message" => "saved"], 200);
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
        return Response::json(["message" => "saved"], 200);
    }

    public function EditGroup(Request $request) {
        $group = MRC_Group::find($request->hidgroupid);
        $group->groupname = $request->groupname;
        $group->groupengname = $request->groupengname;
        $group->groupabbreviate = $request->groupabbreviate;
        $group->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function deleteGroupByID($id) {
        $group = MRC_Group::find($id);
        $group->groupisdelete = 1;
        $group->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function deleteBookingByID($id) {
        $book = MRC_Booking::find($id);
        $book->bookingisdelete = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function BookEquipment(Request $request) {
        $book = new MRC_Booking;
        $book->bookingdate = $request->bookingdate;
        $book->bookingequipmentid = $request->bookingequipmentid;
        $book->bookingstarttime = $request->bookingstarttime;
        $book->bookingendtime = $request->bookingendtime;
        $book->bookingstatus = 0;
        $book->bookingaddby = Auth::user()->id;
        $book->bookingisdelete = 0;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function getBookingbyEquipmentid($id) {
        $freq = DB::select('SELECT * FROM `mrc_booking` WHERE `bookingequipmentid` = ' . $id . ' AND `bookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->bookingid,
                "title" => $freq[$i]->bookingstarttime . ' - ' . $freq[$i]->bookingendtime,
                "start" => $freq[$i]->bookingdate . 'T' . $freq[$i]->bookingstarttime,
                "end" => $freq[$i]->bookingdate . 'T' . $freq[$i]->bookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

}
