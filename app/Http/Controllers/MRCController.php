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
use PHPExcel_Writer_Excel2007;
use Yajra\Datatables\Datatables;
use App\MRC_Couse;
use App\MRC_Group;
use App\MRC_Place;
use App\MRC_Equipment;
use App\MRC_Booking;
use App\MRC_Ban;

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
    public function __construct() {
        $this->isLogin();
    }

    public function isLogin() {
        if (!empty(Auth::user())) {
            
        } else {
            return redirect('/')->send();
        }
    }

    public function index() {
        $Formreqs = Formreq::whereIn('FormReqStstus', array(2, 3, 4, 5, 6))
                ->orderBy('FormReqStstus', 'asc')
                ->get();
        return view('placemng', ['user' => Auth::user(), 'Formreqs' => $Formreqs]);
    }

    public function setAccess(Request $request) {
        $ckval = '';
        if (isset($_COOKIE['setaccess'])) {
            $ckinexarray = explode('.', $_COOKIE['setaccess']);
            if (!in_array($request->eqipid, $ckinexarray)) {
                $ckval = $_COOKIE['setaccess'] . "." . $request->eqipid;
            } else {
                $ckval = $_COOKIE['setaccess'];
            }
        } else {
            $ckval = $request->eqipid;
        }
        setcookie('setaccess', $ckval, time() + 31556926, '/');
        return Response::json(["message" => "cookieset"], 200);
    }

    public function mrcbookingmng() {

        $chkban = $this->checkgotban();
        if ($chkban == '0') {
            $this->checkbanning();
            $chkban = $this->checkgotban();
            if ($chkban == '0') {
                return view('mrcbooking', ['user' => Auth::user()]);
            } else {
                return view('banning', ['user' => Auth::user(), 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
            }
        } else {
            $bancount = DB::select("SELECT COUNT(`banid`) AS bancount FROM `mrc_ban` WHERE `banuserid` = " . Auth::user()->id);

            return view('banning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
        }
    }

    public function checkgotban() {
        $banlist = DB::select("SELECT * FROM `mrc_ban` WHERE `banuserid` = " . Auth::user()->id . " AND `banenddate` >= NOW() AND banactive = 1  ORDER BY `banid` DESC LIMIT 1");
        if (count($banlist) > 0) {
            return $banlist[0]->banenddate;
        } else {
            return '0';
        }
    }

    public function getchart(Request $request) {
        //$request->hidequipmentid
        $sd = explode("-", $request->sd);
        $ed = explode("-", $request->ed);
        $d1 = date("Y-m-d", strtotime($sd[2] . '-' . $sd[1] . '-' . $sd[0]));
        $d2 = date("Y-m-d", strtotime($ed[2] . '-' . $ed[1] . '-' . $ed[0]));
        //echo "SELECT *,(SELECT COUNT(*) AS ce FROM `mrc_booking` WHERE `bookingequipmentid` = mrc_equipment.`equipmentid` and (`bookingdate` between '2016-10-30' and '2016-11-20')) AS ce FROM `mrc_equipment` WHERE `equipmentisdelete` = 0";
        $eqc = DB::select("SELECT *,(SELECT COUNT(*) AS ce FROM `mrc_booking` WHERE `bookingequipmentid` = mrc_equipment.`equipmentid` and (`bookingdate` between '" . $d1 . "' and '" . $d2 . "')) AS ce FROM `mrc_equipment` WHERE `equipmentisdelete` = 0");
        //return view('mrcbookingstat', ['user' => Auth::user(), 'eqcs' => $eqc]);
        return Response::json($eqc);
    }

    public function mrcexporttoexcel($sdr, $edr) {
        //$request->hidequipmentid
        $sd = explode("-", $sdr);
        $ed = explode("-", $edr);
        $d1 = date("Y-m-d", strtotime($sd[2] . '-' . $sd[1] . '-' . $sd[0]));
        $d2 = date("Y-m-d", strtotime($ed[2] . '-' . $ed[1] . '-' . $ed[0]));


        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'รายงานการใช้งานอุปกรณ์ต่างๆตั้งแต่วันที่ ' . $sdr . ' ถึงวันที่ ' . $edr);
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'อุปกรณ์');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'บุคคลในคณะแพทย์');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'บุคคลากรในจุฬา');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'บุคคลากรในหน่วยงานรัฐ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'บุคคลากรและอื่นๆในภาคเอกชน');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'รวม');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'ไม่เข้าใช้งาน');
        $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'เข้าใช้งาน');
        //$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'สถานที่');

        $freq = DB::select("SELECT *
,(SELECT COUNT(*) AS ce FROM `mrc_booking` WHERE `bookingequipmentid` = mrc_equipment.`equipmentid` AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')) AS ce
,(SELECT COUNT(*) AS cban FROM `mrc_booking` WHERE `bookingstatus` = -1 AND`bookingequipmentid` = mrc_equipment.`equipmentid` AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')) AS cban
,(SELECT COUNT(*) AS cuse FROM `mrc_booking` WHERE `bookingstatus` = 1 AND`bookingequipmentid` = mrc_equipment.`equipmentid` AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')) AS cuse
 FROM `mrc_equipment` WHERE `equipmentisdelete` = 0");
        for ($i = 0; $i < count($freq); $i++) {

            $c1 = DB::select("SELECT COUNT(*) AS c1 FROM `bookingview` WHERE  `equipmentid` = " . $freq[$i]->equipmentid . " AND `bookingstatus` = -1 AND `type` = 1 AND `bookingisdelete` = 0 AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c2 = DB::select("SELECT COUNT(*) AS c2 FROM `bookingview` WHERE  `equipmentid` = " . $freq[$i]->equipmentid . " AND `bookingstatus` = -1 AND `type` = 2 AND `bookingisdelete` = 0 AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c3 = DB::select("SELECT COUNT(*) AS c3 FROM `bookingview` WHERE  `equipmentid` = " . $freq[$i]->equipmentid . " AND `bookingstatus` = -1 AND `type` = 3 AND `bookingisdelete` = 0 AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c4 = DB::select("SELECT COUNT(*) AS c4 FROM `bookingview` WHERE  `equipmentid` = " . $freq[$i]->equipmentid . " AND `bookingstatus` = -1 AND `type` = 4 AND `bookingisdelete` = 0 AND (`bookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i + 3), $freq[$i]->equipmentname);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($i + 3), $c1[0]->c1);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . ($i + 3), $c2[0]->c2);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . ($i + 3), $c3[0]->c3);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . ($i + 3), $c4[0]->c4);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . ($i + 3), $freq[$i]->ce);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . ($i + 3), $freq[$i]->cban);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . ($i + 3), $freq[$i]->cuse);
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=Export.xls");
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    public function checkbanning() {
        $freq = DB::select('SELECT * FROM `mrc_booking` WHERE (`bookingstarttime`+ INTERVAL 15 MINUTE) < NOW() AND `bookingdate` <= NOW() AND bookingstatus = 0 AND bookingisdelete != 1 AND `bookingaddby` = ' . Auth::user()->id);
        if (count($freq) > 0) {
            for ($i = 0; $i < count($freq); $i++) {
                $mybook = MRC_Booking::find($freq[$i]->bookingid);
                $mybook->bookingstatus = -1;
                $mybook->save();

                $banlist = DB::select('SELECT * FROM `mrc_ban` WHERE `banuserid` = ' . Auth::user()->id . ' ORDER BY `banid` DESC LIMIT 1');
                $bantime = 1;
                $banday = 0;
                if (count($banlist) > 0) {
                    $bantime = $bantime + $banlist[0]->bantime;
                }
                if ($bantime == 1) {
                    $banday = 14;
                } else if ($bantime == 2) {
                    $banday = 30;
                } else if ($bantime >= 3) {
                    $banday = 60;
                }

                $banning = new MRC_Ban;
                $banning->banuserid = Auth::user()->id;
                $banning->banfrombookingid = $freq[$i]->bookingid;
                $banning->bantime = $bantime;
                $banning->banstartdate = Date("Y/m/d");
                $banning->banenddate = Date('Y/m/d', strtotime("+" . $banday . " days"));
                $banning->banactive = 1;
                $banning->save();
            }
        }
    }

    public function mymrcbooking() {

        $chkban = $this->checkgotban();
        if ($chkban == '0') {
            $this->checkbanning();
            $chkban = $this->checkgotban();
            if ($chkban == '0') {
                return view('mymrcbooking', ['user' => Auth::user()]);
            } else {
                return view('banning', ['user' => Auth::user(), 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
            }
        } else {
            $bancount = DB::select("SELECT COUNT(`banid`) AS bancount FROM `mrc_ban` WHERE `banuserid` = " . Auth::user()->id);

            return view('banning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
        }
    }

    public function mrcbookingmngadmin() {
        return view('mrcbookingmngadmin', ['user' => Auth::user()]);
    }

    public function placemng() {
        return view('placemng', ['user' => Auth::user()]);
    }

    public function banningadmin() {
        return view('banningadmin', ['user' => Auth::user()]);
    }

    public function mrcbookingstat() {
        // $eqc = DB::select('SELECT *,(SELECT COUNT(*) AS ce  FROM `mrc_booking` WHERE `bookingequipmentid` = mrc_equipment.`equipmentid`) AS ce FROM `mrc_equipment` WHERE `equipmentisdelete` = 0');
        return view('mrcbookingstat', ['user' => Auth::user()]);
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
            'couses' => MRC_Couse::where('couseisdelete', '=', 0)->get()]);
        //'groups' => MRC_Group::where('groupisdelete', '=', 0)->get()]);
    }

    public function getEquipmentforbooking() {
        $equipment = DB::TABLE('equipmentview')
                ->SELECT('equipmentid', 'equipmentname', 'placename', 'cousename', 'equipmentpicturename')
                ->WHERE('equipmentisdelete', '=', 0)
                ->WHERE('equipmentstatus', '=', 1);

        return Datatables::of($equipment)->make(true);
    }

    public function getEquipment() {
        $equipment = DB::TABLE('mrc_equipment')
                //->JOIN('mrc_group', 'mrc_equipment.equipmentgroup', '=', 'mrc_group.groupid')
                ->JOIN('mrc_place', 'mrc_equipment.equipmentplace', '=', 'mrc_place.placeid')
                ->JOIN('mrc_couse', 'mrc_equipment.equipmentcouse', '=', 'mrc_couse.couseid')
                ->SELECT('equipmentid', 'equipmentname', 'placename', 'equipmentstatus', 'equipmentpicturename', 'equipmentstatus')
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

    public function getBanning() {

        $ban = DB::table('banningview')->select(['banid', 'bantime', 'banstartdate', 'banenddate', 'banactive', 'firstname', 'lastname', 'equipmentname'])->where('banenddate', '>', date('Y-m-d'));
        return Datatables::of($ban)->make(true);
    }

    public function activeBanning(Request $request) {
        $ban = MRC_Ban::find($request->bid);
        $ban->banactive = $request->bactive;
        $ban->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function getCouse() {
        $groups = DB::table('mrc_couse')->select(['couseid', 'cousename', 'couseengname', 'couseadddate', 'couseaddby', 'couseisdelete'])->where('couseisdelete', '=', 0);
        return Datatables::of($groups)->make(true);
        //cousename``couseengname``couseadddate``couseaddby``couseisdelete``couseid`
    }

    public function getBookingByUserId() {
        $groups = DB::table('bookingview')->select(['bookingid', 'bookingdate', 'bookingstarttime', 'bookingendtime', 'bookingstatus', 'equipmentid', 'equipmentname', 'equipmentpicturename', 'firstname', 'lastname', 'placecomputername', 'placename'])
                ->where('bookingisdelete', '=', 0)
                ->where('bookingaddby', '=', Auth::user()->id);
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

    public function checkTimeAvailable(Request $request) {
        $qry = DB::select('SELECT * 
FROM `mrc_booking`
WHERE ((`bookingstarttime` BETWEEN \'' . $request->bookingstarttime . '\' AND \'' . $request->bookingendtime . '\') 
  OR (`bookingendtime` BETWEEN \'' . $request->bookingstarttime . '\' AND \'' . $request->bookingendtime . '\')) 
  AND `bookingisdelete` = 0 AND `bookingdate` = \'' . $request->bookingdate . '\'  AND `bookingequipmentid` = ' . $request->bookingequipmentid);

        if (count($qry) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
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
        //$equipment->equipmentgroup = $request->equipmentgroup;
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

    public function uploadpictureforannouncement(Request $request) {
        $allowed = array('png', 'jpg', 'jpeg');
        $rules = [
            'file' => 'required|image|mimes:jpeg,jpg,png'
        ];
        $data = Input::all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return '{"status":"Invalid File type"}';
        }
        if (Input::hasFile('file')) {
            $extension = Input::file('file')->getClientOriginalExtension();
            if (!in_array(strtolower($extension), $allowed)) {
                return '{"status":"Invalid File type"}';
            } else {
                $filename = uniqid() . '_attachment.' . $extension;
                if (Input::file('file')->move('public/uploads/announcement/', $filename)) {
                    echo url('public/uploads/announcement/' . $filename);
                    exit;
                }
            }
        } else {
            return '{"status":"Invalid File type"}';
        }
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
        //$equipment->equipmentgroup = $request->equipmentgroup;
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

    public function deleteBookingByIDByUser($id) {
        $freq = DB::select('SELECT DATEDIFF(`bookingdate`,NOW()) AS difdate,`bookingdate` FROM `mrc_booking` WHERE `bookingid` = ' . $id . ' AND `bookingaddby` = ' . Auth::user()->id);
        if ($freq[0]->difdate < 2) {
            return Response::json(["message" => "cantdel", "message222" => $freq[0]->difdate], 200);
        } else {
            $book = MRC_Booking::find($id);
            $book->bookingisdelete = 1;
            $book->save();
            return Response::json(["message" => "saved"], 200);
        }
    }

    public function cfmBookingByID($id) {
        $book = MRC_Booking::find($id);
        $book->bookingstatus = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function BookEquipment(Request $request) {
        if ($this->checkTimeAvailable($request)) {
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
        } else {
            return Response::json(["message" => "notavi"], 200);
        }
    }

    public function getBookingbyEquipmentid($id) {
        $freq = DB::select('SELECT * FROM `mrc_booking` WHERE `bookingequipmentid` = ' . $id . ' AND `bookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->bookingid,
                "title" => substr($freq[$i]->bookingstarttime, 0, -3) . ' - ' . substr($freq[$i]->bookingendtime, 0, -3),
                "start" => $freq[$i]->bookingdate . 'T' . $freq[$i]->bookingstarttime,
                "end" => $freq[$i]->bookingdate . 'T' . $freq[$i]->bookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

    public function getBookingbyEquipmentidWithUsername($id) {
        $freq = DB::select('SELECT * FROM `bookingview` WHERE `bookingequipmentid` = ' . $id . ' AND `bookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->bookingid,
                "title" => $freq[$i]->firstname . " " . $freq[$i]->lastname . ' ' . substr($freq[$i]->bookingstarttime, 0, -3) . ' - ' . substr($freq[$i]->bookingendtime, 0, -3),
                "start" => $freq[$i]->bookingdate . 'T' . $freq[$i]->bookingstarttime,
                "end" => $freq[$i]->bookingdate . 'T' . $freq[$i]->bookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

    public function testcomname() {
        $freq = DB::select('SELECT now() as aaa');
        echo $freq[0]->aaa;
    }

    public function saveannouncementmrc(Request $request) {
        DB::table('announcement')
                ->where('announcementfor', 'mrc')
                ->update(array('announcementhtml' => $request->antext));
        return Response::json(["message" => "saved"], 200);
    }

    public function mrcannouncementadmin() {

        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'mrc'");
        $dd = $eqc[0]->announcementhtml;
        return view('mrcannouncementadmin', ['user' => Auth::user(), 'eqcs' => $dd]);
    }

    public function gethtmlannouncementmrc() {
        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'mrc'");
        return Response::json($eqc);
    }

    public function mrcannouncement() {
        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'mrc'");
        $dd = $eqc[0]->announcementhtml;
        return view('mrcannoucement', ['user' => Auth::user(), 'eqcs' => $dd]);
    }

}
