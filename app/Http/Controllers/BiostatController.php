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
use App\Bio_place;
use App\Bio_Teacher;
use App\Bio_Availableday;
use App\Bio_Booking;
use App\Bio_Ban;

class BiostatController extends Controller {

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

    public function teachermng() {
        return view('teachermng', ['user' => Auth::user(),
            'places' => Bio_place::where('bioplacenameisdelete', '=', 0)->get()]);
    }

    public function getTeacher() {
        $teacher = DB::table('bio_teacher')->select(['bioteacherid', 'bioteachername', 'bioteacherpicturename', 'bioteacherstatus'])->where('bioteacherisdelete', '=', 0);
        return Datatables::of($teacher)->make(true);
    }

    public function deleteTeacherByID($id) {
        $book = Bio_Teacher::find($id);
        $book->bioteacherisdelete = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function getTeacherByID($id) {
        $teacher = Bio_Teacher::where('bioteacherid', '=', $id)->get();
        $tavi = Bio_Availableday::where('bioteacherid', '=', $id)->get();
        $data = array(
            'teacher' => $teacher,
            'tavi' => $tavi
        );
        return Response::json($data);
    }

    public function EditTeacher(Request $request) {
        $teacher = Bio_Teacher::find($request->hidteacherid);
        $teacher->bioteachername = $request->bioteachername;
        $teacher->bioteacheremail = $request->bioteacheremail;
        $teacher->bioteacherhourallow = $request->bioteacherhourallow;
        $teacher->bioteacherfordoctordepartment = $request->bioteacherfordoctordepartment;
        $teacher->bioteacherforuniversity = $request->bioteacherforuniversity;
        $teacher->bioteacherforoutsideuniversitygov = $request->bioteacherforoutsideuniversitygov;
        $teacher->bioteacherforoutsideuniversityprivate = $request->bioteacherforoutsideuniversityprivate;
        $teacher->bioteacherplaceid = $request->bioteacherplaceid;
        $teacher->bioteacherstatus = $request->bioteacherstatus;
        $teacher->save();
        $picname = '';
        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            } else {
                if (file_exists($_FILES["file"]["name"])) {
                    unlink($_FILES["file"]["name"]);
                }

                $exten = explode(".", $_FILES["file"]["name"]);
                $picname = $request->hidteacherid . Date("His") . "." . $exten[1];
                $tc = Bio_Teacher::where('bioteacherid', '=', $request->hidteacherid)->get();
                if (file_exists('public/uploads/teacherimg/' . $tc[0]->bioteacherpicturename)) {
                    unlink('public/uploads/teacherimg/' . $tc[0]->bioteacherpicturename);
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], 'public/uploads/teacherimg/' . $picname);
                $tcup = Bio_Teacher::find($request->hidteacherid);
                $tcup->bioteacherpicturename = $picname;
                $tcup->save();
            }
        }
        $dvi = Bio_Availableday::where('bioteacherid', '=', $request->hidteacherid);
        if (!is_null($dvi)) {
            $dvi->delete();
        }

        $dayarr = array('วันจันทร์', 'วันอังคาร', 'วันพุทธ', 'วันพฤหัสบดี', 'วันศุกร์', 'วันเสาร์', 'วันอาทิตย์');

        if (isset($request->chkb)) {
            $d = explode(",", $request->chkb);
            for ($i = 0; $i < count($d); $i++) {
                //echo $request->chkb[];
                $t1 = 'day' . $d[$i] . 's';
                $t2 = 'day' . $d[$i] . 'n';
                $ta = new Bio_Availableday;
                $ta->bioavailableday = $d[$i];
                $ta->biodayname = $dayarr[($d[$i] - 1)];
                $ta->bioavailablestarttime = $request->$t1;
                $ta->bioavailableendtime = $request->$t2;
                $ta->bioavailableendtime = $request->$t2;
                $ta->bioteacherid = $request->hidteacherid;
                $ta->save();
            }
        }
        return Response::json(["message" => "saved"], 200);
    }

    public function SaveTeacher(Request $request) {
        $teacher = new Bio_Teacher;
        $teacher->bioteachername = $request->bioteachername;
        $teacher->bioteacheremail = $request->bioteacheremail;
        $teacher->bioteacherhourallow = $request->bioteacherhourallow;
        $teacher->bioteacherfordoctordepartment = $request->bioteacherfordoctordepartment;
        $teacher->bioteacherforuniversity = $request->bioteacherforuniversity;
        $teacher->bioteacherforoutsideuniversitygov = $request->bioteacherforoutsideuniversitygov;
        $teacher->bioteacherforoutsideuniversityprivate = $request->bioteacherforoutsideuniversityprivate;
        $teacher->bioteacherplaceid = $request->bioteacherplaceid;
        $teacher->bioteacherstatus = $request->bioteacherstatus;
        $teacher->bioteacheradddate = Date("Y/m/d");
        $teacher->bioteacheraddby = Auth::user()->id;
        $teacher->bioteacherisdelete = 0;
        $teacher->save();
        $insertedId = $teacher->bioteacherid;

        $picname = '';
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
            if (file_exists($_FILES["file"]["name"])) {
                unlink($_FILES["file"]["name"]);
            }
            $exten = explode(".", $_FILES["file"]["name"]);
            $picname = $insertedId . Date("His") . "." . $exten[1];
            move_uploaded_file($_FILES["file"]["tmp_name"], 'public/uploads/teacherimg/' . $picname);
        }

        $teacherup = Bio_Teacher::find($insertedId);
        $teacherup->bioteacherpicturename = $picname;
        $teacherup->save();

        $dayarr = array('วันจันทร์', 'วันอังคาร', 'วันพุทธ', 'วันพฤหัสบดี', 'วันศุกร์', 'วันเสาร์', 'วันอาทิตย์');
        if (isset($request->chkb)) {
            $d = explode(",", $request->chkb);
            for ($i = 0; $i < count($d); $i++) {
                //echo $request->chkb[];
                $t1 = 'day' . $d[$i] . 's';
                $t2 = 'day' . $d[$i] . 'n';
                $ta = new Bio_Availableday;
                $ta->bioavailableday = $d[$i];
                $ta->biodayname = $dayarr[($d[$i] - 1)];
                $ta->bioavailablestarttime = $request->$t1;
                $ta->bioavailableendtime = $request->$t2;
                $ta->bioavailableendtime = $request->$t2;
                $ta->bioteacherid = $insertedId;
                $ta->save();
            }
        }
        //echo $request->chkb;
        return Response::json(["message" => "saved"], 200);
    }

    public function bioannouncementadmin() {
//        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'bio'");
//        $dd = $eqc[0]->announcementhtml;
        return view('biostatannouncementadmin', ['user' => Auth::user()]);
    }

    public function saveannouncementbio(Request $request) {
        DB::table('announcement')
                ->where('announcementfor', 'bio')
                ->update(array('announcementhtml' => $request->antext));
        return Response::json(["message" => "saved"], 200);
    }

    public function gethtmlannouncementbio() {
        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'bio'");
        return Response::json($eqc);
    }

    public function bioannouncement() {
        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'bio'");
        $dd = $eqc[0]->announcementhtml;
        return view('bioannoucement', ['user' => Auth::user(), 'eqcs' => $dd]);
    }

    public function biobooking() {

        $chkban = $this->checkgotban();
        if ($chkban == '0') {
            $this->checkbanning();
            $chkban = $this->checkgotban();
            if ($chkban == '0') {
                return view('biobooking', ['user' => Auth::user()]);
            } else {
                $bancount = DB::select("SELECT COUNT(`biobanid`) AS bancount FROM `bio_ban` WHERE `biobanuserid` = " . Auth::user()->id);

                return view('biobanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
            }
        } else {
            $bancount = DB::select("SELECT COUNT(`biobanid`) AS bancount FROM `bio_ban` WHERE `biobanuserid` = " . Auth::user()->id);

            return view('biobanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
        }
    }

    public function checkgotban() {
        $banlist = DB::select("SELECT * FROM `bio_ban` WHERE `biobanuserid` = " . Auth::user()->id . " AND `biobanenddate` >= NOW() AND biobanactive = 1  ORDER BY `biobanid` DESC LIMIT 1");
        if (count($banlist) > 0) {
            return $banlist[0]->biobanenddate;
        } else {
            return '0';
        }
    }

    public function checkbanning() {
        $freq = DB::select('SELECT * FROM `bio_booking` WHERE (`biobookingstarttime`+ INTERVAL 15 MINUTE) < NOW() AND `biobookingdate` <= NOW() AND biobookingstatus = 0 AND biobookingisdelete != 1 AND `biobookingaddby` = ' . Auth::user()->id);
        if (count($freq) > 0) {
            for ($i = 0; $i < count($freq); $i++) {
                $mybook = Bio_Booking::find($freq[$i]->biobookingid);
                $mybook->biobookingstatus = -1;
                $mybook->save();

                $banlist = DB::select('SELECT * FROM `bio_ban` WHERE `biobanuserid` = ' . Auth::user()->id . ' ORDER BY `biobanid` DESC LIMIT 1');
                $bantime = 1;
                $banday = 0;
                if (count($banlist) > 0) {
                    $bantime = $bantime + $banlist[0]->biobantime;
                }
                if ($bantime == 1) {
                    $banday = 14;
                } else if ($bantime == 2) {
                    $banday = 30;
                } else if ($bantime >= 3) {
                    $banday = 60;
                }

                $banning = new Bio_Ban;
                $banning->biobanuserid = Auth::user()->id;
                $banning->biobanfrombookingid = $freq[$i]->biobookingid;
                $banning->biobantime = $bantime;
                $banning->biobanstartdate = Date("Y/m/d");
                $banning->biobanenddate = Date('Y/m/d', strtotime("+" . $banday . " days"));
                $banning->biobanactive = 1;
                $banning->save();
            }
            
        }
    }

    public function getTeacherforbooking() {
        $teacher = DB::TABLE('bioteacherview')
                ->SELECT('bioteacherid', 'bioteachername', 'bioteacherpicturename', 'bioplacename')
                ->WHERE('bioteacherisdelete', '=', 0)
                ->WHERE('bioteacherstatus', '=', 1);

        return Datatables::of($teacher)->make(true);
    }

    public function getBookingbyTeacherid($id) {
        $freq = DB::select('SELECT * FROM `bio_booking` WHERE `biobookingteacherid` = ' . $id . ' AND `biobookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->biobookingid,
                "title" => substr($freq[$i]->biobookingstarttime, 0, -3) . ' - ' . substr($freq[$i]->biobookingendtime, 0, -3),
                "start" => $freq[$i]->biobookingdate . 'T' . $freq[$i]->biobookingstarttime,
                "end" => $freq[$i]->biobookingdate . 'T' . $freq[$i]->biobookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

    public function biocheckTimeAvailable(Request $request) {
        $qry = DB::select('SELECT * 
FROM `bio_booking`
WHERE ((`biobookingstarttime` BETWEEN \'' . $request->biobookingstarttime . '\' AND \'' . $request->biobookingendtime . '\') 
  OR (`biobookingendtime` BETWEEN \'' . $request->biobookingstarttime . '\' AND \'' . $request->biobookingendtime . '\')) 
  AND `biobookingisdelete` = 0 AND `biobookingdate` = \'' . $request->biobookingdate . '\'  AND `biobookingteacherid` = ' . $request->biobookingteacherid);

        if (count($qry) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function biocheckDayTimeAvailable(Request $request) {
        $qry = DB::select("SELECT * FROM `bio_availableday` where
            `bioavailableday` = " . Date('N', strtotime($request->biobookingdate)) . " 
AND `bioteacherid` = " . $request->biobookingteacherid . " 
AND `bioavailablestarttime` <= '" . $request->biobookingstarttime . "'
AND `bioavailableendtime` >= '" . $request->biobookingendtime . "'");

        if (count($qry) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function BookTeacher(Request $request) {
        if ($this->biocheckDayTimeAvailable($request)) {
            if ($this->biocheckTimeAvailable($request)) {
                $book = new Bio_Booking;
                $book->biobookingdate = $request->biobookingdate;
                $book->biobookingteacherid = $request->biobookingteacherid;
                $book->biobookingstarttime = $request->biobookingstarttime;
                $book->biobookingendtime = $request->biobookingendtime;
                $book->biobookingstatus = 0;
                $book->biobookingaddby = Auth::user()->id;
                $book->biobookingisdelete = 0;
                $book->save();
                return Response::json(["message" => "saved"], 200);
            } else {
                return Response::json(["message" => "notavi"], 200);
            }
        } else {
            return Response::json(["message" => "daytimenotavi"], 200);
        }
    }

    public function getBioBookingByUserId() {
        $groups = DB::table('biobooking')->select(['biobookingid', 'biobookingteacherid', 'biobookingdate', 'biobookingstarttime', 'biobookingendtime', 'biobookingstatus', 'bioteacherid', 'bioteachername', 'bioteacherpicturename', 'firstname', 'lastname', 'bioplacename'])
                ->where('biobookingisdelete', '=', 0)
                ->where('biobookingaddby', '=', Auth::user()->id);
        return Datatables::of($groups)->make(true);
        //`bookingid``bookingdate``bookingstarttime``bookingendtime``equipmentname``equipmentpicturename`
    }

    public function mybiobooking() {

        $chkban = $this->checkgotban();
        if ($chkban == '0') {
            $this->checkbanning();
            $chkban = $this->checkgotban();
            if ($chkban == '0') {
                return view('mybiobooking', ['user' => Auth::user()]);
            } else {
                $bancount = DB::select("SELECT COUNT(`biobanid`) AS bancount FROM `bio_ban` WHERE `biobanuserid` = " . Auth::user()->id);

                return view('biobanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
            }
        } else {
            $bancount = DB::select("SELECT COUNT(`biobanid`) AS bancount FROM `bio_ban` WHERE `biobanuserid` = " . Auth::user()->id);

            return view('biobanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
        }
    }

    public function setAccessBio(Request $request) {
        $ckval = '';
        if (isset($_COOKIE['setaccessbio'])) {
            $ckinexarray = explode('.', $_COOKIE['setaccessbio']);
            if (!in_array($request->teacherid, $ckinexarray)) {
                $ckval = $_COOKIE['setaccessbio'] . "." . $request->teacherid;
            } else {
                $ckval = $_COOKIE['setaccessbio'];
            }
        } else {
            $ckval = $request->teacherid;
        }
        setcookie('setaccessbio', $ckval, time() + 31556926, '/');
        return Response::json(["message" => "cookieset"], 200);
    }

    public function getBookingbyTeacheridWithUsername($id) {
        $freq = DB::select('SELECT * FROM `biobooking` WHERE `biobookingteacherid` = ' . $id . ' AND `biobookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->biobookingid,
                "title" => $freq[$i]->firstname . " " . $freq[$i]->lastname . ' ' . substr($freq[$i]->biobookingstarttime, 0, -3) . ' - ' . substr($freq[$i]->biobookingendtime, 0, -3),
                "start" => $freq[$i]->biobookingdate . 'T' . $freq[$i]->biobookingstarttime,
                "end" => $freq[$i]->biobookingdate . 'T' . $freq[$i]->biobookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

    public function deleteBioBookingByIDByUser($id) {
        $freq = DB::select('SELECT DATEDIFF(`biobookingdate`,NOW()) AS difdate,`biobookingdate` FROM `bio_booking` WHERE `biobookingid` = ' . $id . ' AND `biobookingaddby` = ' . Auth::user()->id);
        if ($freq[0]->difdate < 2) {
            return Response::json(["message" => "cantdel", "message222" => $freq[0]->difdate], 200);
        } else {
            $book = Bio_Booking::find($id);
            $book->biobookingisdelete = 1;
            $book->save();
            return Response::json(["message" => "saved"], 200);
        }
    }

    public function cfmBioBookingByID($id) {
        $book = Bio_Booking::find($id);
        $book->biobookingstatus = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function biobookingmngadmin() {
        return view('biobookingmngadmin', ['user' => Auth::user()]);
    }

    public function deleteBioBookingByID($id) {
        $book = Bio_Booking::find($id);
        $book->biobookingisdelete = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function getBioBanning() {

        $ban = DB::table('biobanningview')->select(['biobanid', 'biobantime', 'biobanstartdate', 'biobanenddate', 'biobanactive', 'firstname', 'lastname', 'bioteachername'])->where('biobanenddate', '>', date('Y-m-d'));
        return Datatables::of($ban)->make(true);
    }

    public function biobanningadmin() {
        return view('biobanningadmin', ['user' => Auth::user()]);
    }

    public function activeBioBanning(Request $request) {
        $ban = Bio_Ban::find($request->bid);
        $ban->biobanactive = $request->bactive;
        $ban->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function biobookingreport() {
        //$eqc = DB::select('SELECT *,(SELECT COUNT(*) AS ce  FROM `mrc_booking` WHERE `bookingequipmentid` = mrc_equipment.`equipmentid`) AS ce FROM `mrc_equipment` WHERE `equipmentisdelete` = 0');
        return view('biobookingreport', ['user' => Auth::user()]);
    }

    public function getchartbio(Request $request) {
        //$request->hidequipmentid
        $sd = explode("-", $request->sd);
        $ed = explode("-", $request->ed);
        $d1 = date("Y-m-d", strtotime($sd[2] . '-' . $sd[1] . '-' . $sd[0]));
        $d2 = date("Y-m-d", strtotime($ed[2] . '-' . $ed[1] . '-' . $ed[0]));

        $eqc = DB::select("SELECT *,(SELECT COUNT(*) AS ce FROM `bio_booking` 
WHERE `biobookingteacherid` = `bio_teacher`.`bioteacherid`
AND (`biobookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "')) AS ce 
FROM `bio_teacher` WHERE `bioteacherisdelete` = 0");

        return Response::json($eqc);
    }

    public function bioexporttoexcel($sdr, $edr) {
        //$request->hidequipmentid
        $sd = explode("-", $sdr);
        $ed = explode("-", $edr);
        $d1 = date("Y-m-d", strtotime($sd[2] . '-' . $sd[1] . '-' . $sd[0]));
        $d2 = date("Y-m-d", strtotime($ed[2] . '-' . $ed[1] . '-' . $ed[0]));


        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'รายงานการนัดพบอาจารย์ตั้งแต่วันที่ ' . $sdr . ' ถึงวันที่ ' . $edr);
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'อาจารย์');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'บุคคลในคณะแพทย์');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'บุคคลากรในจุฬา');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'บุคคลากรในหน่วยงานรัฐ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'บุคคลากรและอื่นๆในภาคเอกชน');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'รวม');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'ไม่เข้าใช้งาน');
        $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'เข้าใช้งาน');
        //$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'สถานที่');

        $freq = DB::select("SELECT *
,(SELECT COUNT(*) AS ce FROM `bio_booking` WHERE `biobookingteacherid` = `bio_teacher`.`bioteacherid` AND (`biobookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "')) AS ce
,(SELECT COUNT(*) AS cban FROM `bio_booking` WHERE `biobookingstatus` = -1 AND `biobookingteacherid` = `bio_teacher`.`bioteacherid` AND (`biobookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "')) AS cban
,(SELECT COUNT(*) AS cuse FROM `bio_booking` WHERE `biobookingstatus` = 1 AND `biobookingteacherid` = `bio_teacher`.`bioteacherid` AND (`biobookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "')) AS cuse
 FROM `bio_teacher` WHERE `bioteacherisdelete` = 0");
        for ($i = 0; $i < count($freq); $i++) {

            $c1 = DB::select("SELECT COUNT(*) AS c1 FROM `biobanningview` WHERE  `bioteacherid` = " . $freq[$i]->bioteacherid . " AND `biobookingstatus` = -1 AND `type` = 1 AND `biobookingisdelete` = 0 AND (`biobookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c2 = DB::select("SELECT COUNT(*) AS c2 FROM `biobanningview` WHERE  `bioteacherid` = " . $freq[$i]->bioteacherid . " AND `biobookingstatus` = -1 AND `type` = 2 AND `biobookingisdelete` = 0 AND (`biobookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c3 = DB::select("SELECT COUNT(*) AS c3 FROM `biobanningview` WHERE  `bioteacherid` = " . $freq[$i]->bioteacherid . " AND `biobookingstatus` = -1 AND `type` = 3 AND `biobookingisdelete` = 0 AND (`biobookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c4 = DB::select("SELECT COUNT(*) AS c4 FROM `biobanningview` WHERE  `bioteacherid` = " . $freq[$i]->bioteacherid . " AND `biobookingstatus` = -1 AND `type` = 4 AND `biobookingisdelete` = 0 AND (`biobookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i + 3), $freq[$i]->bioteachername);
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

}
