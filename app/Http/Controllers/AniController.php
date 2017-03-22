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
use App\Ani_Room;
use App\Ani_Ban;
use App\Ani_Booking;

class AniController extends Controller {

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

    public function aniroommng() {
        return view('aniroommng', ['user' => Auth::user()]);
    }

    public function SaveAniRoom(Request $request) {
        $rooom = new Ani_Room;
        $rooom->aniroomname = $request->aniroomname;
        $rooom->aniroomhourallow = $request->aniroomhourallow;
        $rooom->aniroomfordoctordepartment = $request->aniroomfordoctordepartment;
        $rooom->aniroomforuniversity = $request->aniroomforuniversity;
        $rooom->aniroomforoutsideuniversitygov = $request->aniroomforoutsideuniversitygov;
        $rooom->aniroomforoutsideuniversityprivate = $request->aniroomforoutsideuniversityprivate;
        $rooom->aniroomstatus = $request->aniroomstatus;
        $rooom->aniroomadddate = Date("Y/m/d");
        $rooom->aniroomaddby = Auth::user()->id;
        $rooom->aniroomisdelete = 0;
        $rooom->save();
        // $insertedId = $teacher->bioteacherid;

        return Response::json(["message" => "saved"], 200);
    }

    public function getaniroomfortbl() {
        $room = DB::TABLE('ani_room')
                ->SELECT('aniroomid', 'aniroomname', 'aniroomstatus')
                ->WHERE('aniroomisdelete', '=', 0);
        //->WHERE('aniroomstatus', '=', 1);
        return Datatables::of($room)->make(true);
    }

    public function deleteAniRoomByID($id) {
        $room = Ani_Room::find($id);
        $room->aniroomisdelete = 1;
        $room->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function getAniRoomByID($id) {
        $room = Ani_Room::where('aniroomid', '=', $id)->get();

        $data = array(
            'room' => $room
        );
        return Response::json($data);
    }

    public function EditAniRoom(Request $request) {
        $rooom = Ani_Room::find($request->hidAniRoomid);
        $rooom->aniroomname = $request->aniroomname;
        $rooom->aniroomhourallow = $request->aniroomhourallow;
        $rooom->aniroomfordoctordepartment = $request->aniroomfordoctordepartment;
        $rooom->aniroomforuniversity = $request->aniroomforuniversity;
        $rooom->aniroomforoutsideuniversitygov = $request->aniroomforoutsideuniversitygov;
        $rooom->aniroomforoutsideuniversityprivate = $request->aniroomforoutsideuniversityprivate;
        $rooom->aniroomstatus = $request->aniroomstatus;
        $rooom->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function saveannouncementani(Request $request) {
        DB::table('announcement')
                ->where('announcementfor', 'ani')
                ->update(array('announcementhtml' => $request->antext));
        return Response::json(["message" => "saved"], 200);
    }

    public function gethtmlannouncementani() {
        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'ani'");
        return Response::json($eqc);
    }

    public function aniannouncementadmin() {
        return view('aniannouncementadmin', ['user' => Auth::user()]);
    }

    public function aniannouncement() {
        $eqc = DB::select("SELECT * FROM `announcement` WHERE `announcementfor` = 'ani'");
        $dd = $eqc[0]->announcementhtml;
        return view('aniannoucement', ['user' => Auth::user(), 'eqcs' => $dd]);
    }

    public function anibooking() {

        $chkban = $this->checkgotban();
        if ($chkban == '0') {
            $this->checkbanning();
            $chkban = $this->checkgotban();
            if ($chkban == '0') {
                return view('anibooking', ['user' => Auth::user()]);
            } else {
                $bancount = DB::select("SELECT COUNT(`anibanid`) AS bancount FROM `ani_ban` WHERE `anibanuserid` = " . Auth::user()->id);
                return view('anibanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
            }
        } else {
            $bancount = DB::select("SELECT COUNT(`anibanid`) AS bancount FROM `ani_ban` WHERE `anibanuserid` = " . Auth::user()->id);
            return view('anibanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
        }
    }

    public function checkgotban() {
        $banlist = DB::select("SELECT * FROM `ani_ban` WHERE `anibanuserid` = " . Auth::user()->id . " AND `anibanenddate` >= NOW() AND anibanactive = 1  ORDER BY `anibanid` DESC LIMIT 1");
        if (count($banlist) > 0) {
            return $banlist[0]->anibanenddate;
        } else {
            return '0';
        }
    }

    public function checkbanning() {
        $freq = DB::select('SELECT * FROM `ani_booking` WHERE (`anibookingstarttime`+ INTERVAL 15 MINUTE) < NOW() AND `anibookingdate` <= NOW() AND anibookingstatus = 0 AND anibookingisdelete != 1 AND `anibookingaddby` = ' . Auth::user()->id);
        if (count($freq) > 0) {
            for ($i = 0; $i < count($freq); $i++) {
                $mybook = Ani_Booking::find($freq[$i]->anibookingid);
                $mybook->anibookingstatus = -1;
                $mybook->save();

                $banlist = DB::select('SELECT * FROM `ani_ban` WHERE `anibanuserid` = ' . Auth::user()->id . ' ORDER BY `anibanid` DESC LIMIT 1');
                $bantime = 1;
                $banday = 0;
                if (count($banlist) > 0) {
                    $bantime = $bantime + $banlist[0]->anibantime;
                }
                if ($bantime == 1) {
                    $banday = 14;
                } else if ($bantime == 2) {
                    $banday = 30;
                } else if ($bantime >= 3) {
                    $banday = 60;
                }

                $banning = new Ani_Ban;
                $banning->anibanuserid = Auth::user()->id;
                $banning->anibanfrombookingid = $freq[$i]->anibookingid;
                $banning->anibantime = $bantime;
                $banning->anibanstartdate = Date("Y/m/d");
                $banning->anibanenddate = Date('Y/m/d', strtotime("+" . $banday . " days"));
                $banning->anibanactive = 1;
                $banning->save();
            }
        }
    }

    public function getAniRoomforbooking() {
        $teacher = DB::TABLE('ani_room')
                ->SELECT('aniroomid', 'aniroomname')
                ->WHERE('aniroomisdelete', '=', 0)
                ->WHERE('aniroomstatus', '=', 1);

        return Datatables::of($teacher)->make(true);
    }

    public function getBookingbyAniRoomid($id) {
        $freq = DB::select('SELECT * FROM `ani_booking` WHERE `anibookingroomid` = ' . $id . ' AND `anibookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->anibookingid,
                "title" => substr($freq[$i]->anibookingstarttime, 0, -3) . ' - ' . substr($freq[$i]->anibookingendtime, 0, -3),
                "start" => $freq[$i]->anibookingdate . 'T' . $freq[$i]->anibookingstarttime,
                "end" => $freq[$i]->anibookingdate . 'T' . $freq[$i]->anibookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

    public function anicheckTimeAvailable(Request $request) {
        $qry = DB::select('SELECT * 
FROM `ani_booking`
WHERE ((`anibookingstarttime` BETWEEN \'' . $request->anibookingstarttime . '\' AND \'' . $request->anibookingendtime . '\') 
  OR (`anibookingendtime` BETWEEN \'' . $request->anibookingstarttime . '\' AND \'' . $request->anibookingendtime . '\')) 
  AND `anibookingisdelete` = 0 AND `anibookingdate` = \'' . $request->anibookingdate . '\'  AND `anibookingroomid` = ' . $request->anibookingroomid);

        if (count($qry) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function BookAniRoom(Request $request) {

        if ($this->anicheckTimeAvailable($request)) {
            $room = new Ani_Booking;
            $room->anibookingdate = $request->anibookingdate;
            $room->anibookingroomid = $request->anibookingroomid;
            $room->anibookingstarttime = $request->anibookingstarttime;
            $room->anibookingendtime = $request->anibookingendtime;
            $room->anibookingstatus = 0;
            $room->anibookingaddby = Auth::user()->id;
            $room->anibookingisdelete = 0;
            $room->save();
            return Response::json(["message" => "saved"], 200);
        } else {
            return Response::json(["message" => "notavi"], 200);
        }
    }

    public function getAniBookingByUserId() {
        $groups = DB::table('anibooking')->select([
                    'anibookingid',
                    'anibookingroomid',
                    'anibookingdate',
                    'anibookingstarttime',
                    'anibookingendtime',
                    'anibookingstatus',
                    'aniroomid',
                    'aniroomname',
                    'firstname',
                    'lastname'
                ])
                ->where('anibookingisdelete', '=', 0)
                ->where('anibookingaddby', '=', Auth::user()->id);
        return Datatables::of($groups)->make(true);
        //`bookingid``bookingdate``bookingstarttime``bookingendtime``equipmentname``equipmentpicturename`
    }

    public function myanibooking() {

        $chkban = $this->checkgotban();
        if ($chkban == '0') {
            $this->checkbanning();
            $chkban = $this->checkgotban();
            if ($chkban == '0') {
                return view('myanibooking', ['user' => Auth::user()]);
            } else {
                $bancount = DB::select("SELECT COUNT(`anibanid`) AS bancount FROM `ani_ban` WHERE `anibanuserid` = " . Auth::user()->id);
                return view('anibanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
            }
        } else {
            $bancount = DB::select("SELECT COUNT(`anibanid`) AS bancount FROM `ani_ban` WHERE `anibanuserid` = " . Auth::user()->id);
            return view('anibanning', ['user' => Auth::user(), 'bancounts' => $bancount, 'dateendbanning' => date('d/m/Y', strtotime($chkban . ' +1 day'))]);
        }
    }

    public function deleteAniBookingByIDByUser($id) {
        $freq = DB::select('SELECT DATEDIFF(`anibookingdate`,NOW()) AS difdate,`anibookingdate` FROM `ani_booking` WHERE `anibookingid` = ' . $id . ' AND `anibookingaddby` = ' . Auth::user()->id);
        if ($freq[0]->difdate < 2) {
            return Response::json(["message" => "cantdel", "message222" => $freq[0]->difdate], 200);
        } else {
            $book = Ani_Booking::find($id);
            $book->anibookingisdelete = 1;
            $book->save();
            return Response::json(["message" => "saved"], 200);
        }
    }

    public function cfmAniBookingByID($id) {
        $book = Ani_Booking::find($id);
        $book->anibookingstatus = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function setAccessAni(Request $request) {
        $ckval = '';
        if (isset($_COOKIE['setaccessani'])) {
            $ckinexarray = explode('.', $_COOKIE['setaccessani']);
            if (!in_array($request->aniroomid, $ckinexarray)) {
                $ckval = $_COOKIE['setaccessani'] . "." . $request->aniroomid;
            } else {
                $ckval = $_COOKIE['setaccessani'];
            }
        } else {
            $ckval = $request->aniroomid;
        }
        setcookie('setaccessani', $ckval, time() + 31556926, '/');
        return Response::json(["message" => "cookieset"], 200);
    }

    public function getBookingbyAniRoomIDWithUsername($id) {
        $freq = DB::select('SELECT * FROM `anibooking` WHERE `anibookingroomid` = ' . $id . ' AND `anibookingisdelete` = 0');
        $json_data = [];
        for ($i = 0; $i < count($freq); $i++) {
            $json_data[] = array(
                "id" => $freq[$i]->anibookingid,
                "title" => $freq[$i]->firstname . " " . $freq[$i]->lastname . ' ' . substr($freq[$i]->anibookingstarttime, 0, -3) . ' - ' . substr($freq[$i]->anibookingendtime, 0, -3),
                "start" => $freq[$i]->anibookingdate . 'T' . $freq[$i]->anibookingstarttime,
                "end" => $freq[$i]->anibookingdate . 'T' . $freq[$i]->anibookingendtime,
                "url" => '',
                "allDay" => false
            );
        }
        return Response::json($json_data);
    }

    public function anibookingmngadmin() {
        return view('anibookingmngadmin', ['user' => Auth::user()]);
    }

    public function deleteAniBookingByID($id) {
        $book = Ani_Booking::find($id);
        $book->anibookingisdelete = 1;
        $book->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function getAniBanning() {

        $ban = DB::table('anibanningview')->select(['aniroomname', 'anibanid', 'anibantime', 'anibanstartdate', 'anibanenddate', 'anibanactive', 'firstname', 'lastname'])->where('anibanenddate', '>', date('Y-m-d'));
        return Datatables::of($ban)->make(true);
    }

    public function anibanningadmin() {
        return view('anibanningadmin', ['user' => Auth::user()]);
    }

    public function activeAniBanning(Request $request) {
        $ban = Ani_Ban::find($request->bid);
        $ban->anibanactive = $request->bactive;
        $ban->save();
        return Response::json(["message" => "saved"], 200);
    }

    public function anibookingreport() {
        //$eqc = DB::select('SELECT *,(SELECT COUNT(*) AS ce  FROM `mrc_booking` WHERE `bookingequipmentid` = mrc_equipment.`equipmentid`) AS ce FROM `mrc_equipment` WHERE `equipmentisdelete` = 0');
        return view('anibookingreport', ['user' => Auth::user()]);
    }

    public function getchartani(Request $request) {
        //$request->hidequipmentid
        $sd = explode("-", $request->sd);
        $ed = explode("-", $request->ed);
        $d1 = date("Y-m-d", strtotime($sd[2] . '-' . $sd[1] . '-' . $sd[0]));
        $d2 = date("Y-m-d", strtotime($ed[2] . '-' . $ed[1] . '-' . $ed[0]));

        $eqc = DB::select("SELECT *,(SELECT COUNT(*) AS ce FROM `ani_booking` 
WHERE `anibookingroomid` = `ani_room`.`aniroomid` AND `anibookingisdelete` = 0
AND (`anibookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "')) AS ce 
FROM `ani_room` WHERE `aniroomisdelete` = 0");

        return Response::json($eqc);
    }

    public function aniexporttoexcel($sdr, $edr) {
        //$request->hidequipmentid
        $sd = explode("-", $sdr);
        $ed = explode("-", $edr);
        $d1 = date("Y-m-d", strtotime($sd[2] . '-' . $sd[1] . '-' . $sd[0]));
        $d2 = date("Y-m-d", strtotime($ed[2] . '-' . $ed[1] . '-' . $ed[0]));


        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'รายงานการเข้าใช้งานห้องแล็ปตั้งแต่วันที่ ' . $sdr . ' ถึงวันที่ ' . $edr);
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'ห้องแล็ป');
        $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'บุคคลในคณะแพทย์');
        $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'บุคคลากรในจุฬา');
        $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'บุคคลากรในหน่วยงานรัฐ');
        $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'บุคคลากรและอื่นๆในภาคเอกชน');
        $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'รวม');
        $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'ไม่เข้าใช้งาน');
        $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'เข้าใช้งาน');
        //$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'สถานที่');

        $freq = DB::select("SELECT *
,(SELECT COUNT(*) AS ce FROM `ani_booking` WHERE `anibookingroomid` = `ani_room`.`aniroomid` AND (`anibookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "') AND `anibookingisdelete` = 0) AS ce
,(SELECT COUNT(*) AS cban FROM `ani_booking` WHERE `anibookingstatus` = -1 AND `anibookingroomid` = `ani_room`.`aniroomid` AND (`anibookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "') AND `anibookingisdelete` = 0) AS cban
,(SELECT COUNT(*) AS cuse FROM `ani_booking` WHERE `anibookingstatus` = 1 AND `anibookingroomid` = `ani_room`.`aniroomid` AND (`anibookingdate` BETWEEN '" . $d1 . "' AND '" . $d2 . "') AND `anibookingisdelete` = 0) AS cuse
 FROM `ani_room` WHERE `aniroomisdelete` = 0");
        for ($i = 0; $i < count($freq); $i++) {

            $c1 = DB::select("SELECT COUNT(*) AS c1 FROM `anibooking` WHERE  `aniroomid` = " . $freq[$i]->aniroomid . " AND `type` = 1 AND `anibookingisdelete` = 0 AND (`anibookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c2 = DB::select("SELECT COUNT(*) AS c2 FROM `anibooking` WHERE  `aniroomid` = " . $freq[$i]->aniroomid . " AND `type` = 2 AND `anibookingisdelete` = 0 AND (`anibookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c3 = DB::select("SELECT COUNT(*) AS c3 FROM `anibooking` WHERE  `aniroomid` = " . $freq[$i]->aniroomid . " AND `type` = 3 AND `anibookingisdelete` = 0 AND (`anibookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");
            $c4 = DB::select("SELECT COUNT(*) AS c4 FROM `anibooking` WHERE  `aniroomid` = " . $freq[$i]->aniroomid . " AND `type` = 4 AND `anibookingisdelete` = 0 AND (`anibookingdate` BETWEEN '" . $d1 . "' and '" . $d2 . "')");

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . ($i + 3), $freq[$i]->aniroomname);
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
