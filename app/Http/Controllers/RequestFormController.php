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
use PhpOffice\PhpWord\PhpWord;

class RequestFormController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function check() {
        phpinfo();
    }

    public function CreateDocx($id) {
        if (Auth::check()) {
            $aryid = explode("_", $id);
            $fid = $aryid[0];
            $freq = Formreq::where('FormReqID', '=', $fid)->get();
            $user = User::where('id', '=', $freq[0]->FormReqUserIDCreate)->get();
            //$PHPWord = new \PhpOffice\PhpWord\PhpWord();templatecuwithmemo
            $tmpname = 'templatecu';
            $ismemo = false;
            if (isset($aryid[1])) {
                if (strtolower($aryid[1]) === 'memo') {
                    $tmpname = 'templatecuwithmemo';
                    $ismemo = true;
                }
            }

            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('assets/global/template/' . $tmpname . '.docx');

            $fdepartment = '';
            if ($freq[0]->FormReqDepartment == '22') {
                $fdepartment = $freq[0]->FormReqOtherDepartment;
            } else {
                $alldepartment = Department::where('id', '=', $freq[0]->FormReqDepartment)->get();
                $fdepartment = stristr($alldepartment[0]->name, " ", true);
            }
            $templateProcessor->setValue('FormReqTopic', $freq[0]->FormReqTopic);
            $templateProcessor->setValue('FormReqDepartment', $fdepartment);
            $templateProcessor->setValue('FormReqTel', $freq[0]->FormReqTel);
            $mainTitle = 'กระผม';
            if ($user[0]->sex == 1) {
                $mainTitle = 'ดิฉัน';
            }
            $thaimonth = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
            $templateProcessor->setValue('FormReqTo', $freq[0]->FormReqTo);
            $templateProcessor->setValue('mainTitle', $mainTitle);
            $templateProcessor->setValue('FormReqHeadProjectPerson', $freq[0]->FormReqHeadProjectPerson);
            $templateProcessor->setValue('FormReqSponser', $freq[0]->FormReqSponser);
            $templateProcessor->setValue('FormReqBudgetScholarship', number_format($freq[0]->FormReqBudgetScholarship, 2));
            $templateProcessor->setValue('FormReqBudgetScholarshipText', $this->ThaiBahtConversion($freq[0]->FormReqBudgetScholarship));
            $templateProcessor->setValue('FormReqStartDateScholarship', date("j", strtotime($freq[0]->FormReqStartDateScholarship)) . ' ' . $thaimonth[date("n", strtotime($freq[0]->FormReqStartDateScholarship))] . ' ' . (date("Y", strtotime($freq[0]->FormReqStartDateScholarship)) + 543));
            $templateProcessor->setValue('FormReqEndDateScholarship', date("j", strtotime($freq[0]->FormReqEndDateScholarship)) . ' ' . $thaimonth[date("n", strtotime($freq[0]->FormReqEndDateScholarship))] . ' ' . (date("Y", strtotime($freq[0]->FormReqEndDateScholarship)) + 543));


            $memodate = date("j", strtotime($freq[0]->FormReqMemoDate)) . ' ' . $thaimonth[date("n", strtotime($freq[0]->FormReqMemoDate))] . ' ' . (date("Y", strtotime($freq[0]->FormReqMemoDate)) + 543);
            $memotime = $freq[0]->FormReqMemoRound;
            $templateProcessor->setValue('FormReqMemoDate', $memodate);
            $templateProcessor->setValue('FormReqMemoRound', $memotime);

            $date1 = new DateTime($freq[0]->FormReqEndDateScholarship);
            $date2 = new DateTime($freq[0]->FormReqStartDateScholarship);
            $diff = $date1->diff($date2);
            $DateDifYM = (($diff->y != 0) ? $diff->y . " ปี" : "") . " " . (($diff->m != 0) ? $diff->m . " เดือน" : "") . " " . (($diff->d != 0) ? $diff->d . " วัน" : "");
            $templateProcessor->setValue('DateDifYM', $DateDifYM);

            //1 formreqobjective
            $formreqobjective = '';
            $Formreq_Objective = Formreq_Objective::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Objective) > 0) {
                //$templateProcessor->cloneBlock('formreqobjective', 5, true);
                for ($i = 0; $i < count($Formreq_Objective); $i++) {
                    $obtext = '<w:p>
                            <w:pPr>
                            <w:tabs>
                            <w:tab w:val="left" w:pos="2160"/>
                            <w:r><w:tab/></w:r>
                            </w:tabs>
                            </w:pPr>
                            <w:rPr>
                            <w:rFonts w:ascii="TH SarabunPSK" w:hAnsi="TH SarabunPSK"/>
                            <w:sz w:val="32"/>
                            </w:rPr>
                            <w:r>
                            <w:t>1.' . ($i + 1) . ' ' . $Formreq_Objective[$i]->Objective . '</w:t>
                            </w:r>
                            </w:p>';
                    // $obtext = '1.' . ($i + 1) . ' ' . $Formreq_Objective[$i]->Objective;
                    $formreqobjective .= $obtext;
                }
            }
            $templateProcessor->setValue('formreqobjective', $formreqobjective);

            //2
            $templateProcessor->setValue('FormReqResponsibleProjectPerson', $freq[0]->FormReqResponsibleProjectPerson);
            $formreqmanagementproject = '';
            $Formreq_ManagementProject = Formreq_ManagementProject::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_ManagementProject) > 0) {
                //$templateProcessor->cloneBlock('formreqobjective', 5, true);
                for ($i = 0; $i < count($Formreq_ManagementProject); $i++) {
                    // $obtext = '2.2.' . ($i + 2) . ' ' . $Formreq_ManagementProject[$i]->ManagementProjectName . '          ' . $Formreq_ManagementProject[$i]->ManagementProjectPosition . '<w:br/>';
                    $obtext = '<w:p>
                            <w:pPr>
                            <w:tabs>
                            <w:tab w:val="left" w:pos="1440"/>
                            <w:tab w:val="left" w:pos="6480"/>                         
                            </w:tabs>
                            </w:pPr>
                            <w:r>
                            <w:rPr>                  
                            <w:rFonts w:ascii="TH SarabunPSK" w:hAnsi="TH SarabunPSK"/>
                            <w:sz w:val="32"/>
                            </w:rPr>
                            <w:tab/>
                            <w:t>2.2.' . ($i + 2) . ' ' . $Formreq_ManagementProject[$i]->ManagementProjectName . '</w:t>
                            <w:tab/>                            
                            <w:t>' . $Formreq_ManagementProject[$i]->ManagementProjectPosition . '</w:t>
                            </w:r>
                            </w:p>';
                    $formreqmanagementproject .= $obtext;
                }
            }
            $templateProcessor->setValue('formreqmanagementproject', $formreqmanagementproject);


            //3
            $tbhead = file_get_contents('assets/global/template/tbbudgethead.html');
            $tbheadtopic = file_get_contents('assets/global/template/tbbudgetheadtopic.html');
            $tbbody = file_get_contents('assets/global/template/tbbudgetbody.html');
            $tbfoot = file_get_contents('assets/global/template/tbbudgetfooter.html');
            $tbthaitext = file_get_contents('assets/global/template/tbbudgetthaitext.html');
            $tbnothing = file_get_contents('assets/global/template/tbbudgetnothing.html');

            $formreqbudget31 = '';
            $sum31 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.1', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'หมวดเงินเดือนและค่าจ้าง', $headobtext);
            $Formreq_Budget31 = Formreq_Budget31::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget31) > 0) {
                for ($i = 0; $i < count($Formreq_Budget31); $i++) {
                    $obtext = $tbbody;
                    $numberadd = '3.1.' . ($i + 1);
                    $topicadd = $Formreq_Budget31[$i]->Formreq_Budget_Topic;
                    $amountadd = number_format($Formreq_Budget31[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget31 .= $obtext;
                    $sum31 += (float) $Formreq_Budget31[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum31, 2), $headobtext);
            } else {
                $formreqbudget31 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget31 = $headobtext . $formreqbudget31;


            $formreqbudget32 = '';
            $sum32 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.2', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'หมวดค่าตอบแทน', $headobtext);
            $Formreq_Budget32 = Formreq_Budget32::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget32) > 0) {
                for ($i = 0; $i < count($Formreq_Budget32); $i++) {
                    $obtext = $tbbody;
                    $numberadd = '3.2.' . ($i + 1);
                    $topicadd = $Formreq_Budget32[$i]->Formreq_Budget_Topic;
                    $amountadd = number_format($Formreq_Budget32[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget32 .= $obtext;
                    $sum32 += (float) $Formreq_Budget32[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum32, 2), $headobtext);
            } else {
                $formreqbudget32 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget32 = $headobtext . $formreqbudget32;




            $formreqbudget33 = '';
            $sum33 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.3', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'หมวดค่าใช้สอย', $headobtext);
            $Formreq_Budget33 = Formreq_Budget33::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget33) > 0) {
                for ($i = 0; $i < count($Formreq_Budget33); $i++) {
                    $obtext = $tbbody;
                    $numberadd = '3.3.' . ($i + 1);
                    $topicadd = $Formreq_Budget33[$i]->Formreq_Budget_Topic;
                    $amountadd = number_format($Formreq_Budget33[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget33 .= $obtext;
                    $sum33 += (float) $Formreq_Budget33[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum33, 2), $headobtext);
            } else {
                $formreqbudget33 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget33 = $headobtext . $formreqbudget33;



            $formreqbudget34 = '';
            $sum34 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.4', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'หมวดค่าวัสดุ', $headobtext);
            $Formreq_Budget34 = Formreq_Budget34::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget34) > 0) {
                for ($i = 0; $i < count($Formreq_Budget34); $i++) {
                    $obtext = $tbbody;
                    $numberadd = '3.4.' . ($i + 1);
                    $topicadd = $Formreq_Budget34[$i]->Formreq_Budget_Topic;
                    $amountadd = number_format($Formreq_Budget34[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget34 .= $obtext;
                    $sum34 += (float) $Formreq_Budget34[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum34, 2), $headobtext);
            } else {
                $formreqbudget34 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget34 = $headobtext . $formreqbudget34;


            $formreqbudget35 = '';
            $sum35 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.5', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'หมวดค่าครุภัณฑ์', $headobtext);
            $Formreq_Budget35 = Formreq_Budget35::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget35) > 0) {
                for ($i = 0; $i < count($Formreq_Budget35); $i++) {
                    $obtext = $tbbody;
                    $numberadd = '3.5.' . ($i + 1);
                    $topicadd = $Formreq_Budget35[$i]->Formreq_Budget_Topic;
                    $amountadd = number_format($Formreq_Budget35[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget35 .= $obtext;
                    $sum35 += (float) $Formreq_Budget35[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum35, 2), $headobtext);
            } else {
                $formreqbudget35 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget35 = $headobtext . $formreqbudget35;


            $formreqbudget36 = '';
            $sum36 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.6', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'ค่าสาธารณูปโภค', $headobtext);
            $Formreq_Budget36 = Formreq_Budget36::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget36) > 0) {
                for ($i = 0; $i < count($Formreq_Budget36); $i++) {
                    $excepttext = '';
                    if ($Formreq_Budget36[$i]->Formreq_Budget_Except == 1) {
                        $excepttext = ' ขอยกเว้นเนื่องจากผู้ให้ทุนไม่ได้อนุมัติในหมวดนี้ (ได้รับการยกเว้น โดยมติที่ประชุมจากกรรมการบริหารคณะแพทยศาสตร์ ครั้งที่......เมื่อวันที่....................)';
                        if ($ismemo) {
                            $excepttext = ' ขอยกเว้นเนื่องจากผู้ให้ทุนไม่ได้อนุมัติในหมวดนี้ (ได้รับการยกเว้น โดยมติที่ประชุมจากกรรมการบริหารคณะแพทยศาสตร์ ครั้งที่ ' . $memotime . ' เมื่อวันที่ ' . $memodate . ')';
                        }
                    } else {
                        $excepttext = '';
                    }
                    $obtext = $tbbody;
                    $numberadd = '3.6.' . ($i + 1);
                    $topicadd = $Formreq_Budget36[$i]->Formreq_Budget_Topic . $excepttext;
                    $amountadd = number_format($Formreq_Budget36[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget36 .= $obtext;
                    $sum36 += (float) $Formreq_Budget36[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum36, 2), $headobtext);
            } else {
                $formreqbudget36 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget36 = $headobtext . $formreqbudget36;


            $formreqbudget37 = '';
            $sum37 = 0;
            $headobtext = '';
            $headobtext = $tbheadtopic;
            $headobtext = str_replace('###headnumberadd###', '3.7', $headobtext);
            $headobtext = str_replace('###headtopicadd###', 'หมวดเงินอุดหนุนการดำเนินงานของคณะแพทยศาสตร์', $headobtext);
            $Formreq_Budget37 = Formreq_Budget37::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Budget37) > 0) {
                for ($i = 0; $i < count($Formreq_Budget37); $i++) {
                    $excepttext = '';
                    if ($Formreq_Budget37[$i]->Formreq_Budget_Except == 1) {
                        $excepttext = ' ขอยกเว้นเนื่องจากผู้ให้ทุนไม่ได้อนุมัติในหมวดนี้ (ได้รับการยกเว้น โดยมติที่ประชุมจากกรรมการบริหารคณะแพทยศาสตร์ ครั้งที่......เมื่อวันที่....................)';
                        if ($ismemo) {
                            $excepttext = ' ขอยกเว้นเนื่องจากผู้ให้ทุนไม่ได้อนุมัติในหมวดนี้ (ได้รับการยกเว้น โดยมติที่ประชุมจากกรรมการบริหารคณะแพทยศาสตร์ ครั้งที่ ' . $memotime . ' เมื่อวันที่ ' . $memodate . ')';
                        }
                    } else {
                        $excepttext = '';
                    }
                    $obtext = $tbbody;
                    $numberadd = '3.7.' . ($i + 1);
                    $topicadd = $Formreq_Budget37[$i]->Formreq_Budget_Topic . $excepttext;
                    $amountadd = number_format($Formreq_Budget37[$i]->Formreq_Budget_Amount, 2);
                    $obtext = str_replace('###numberadd###', $numberadd, $obtext);
                    $obtext = str_replace('###topicadd###', $topicadd, $obtext);
                    $obtext = str_replace('###amountadd###', $amountadd, $obtext);
                    //$obtext = $tbbody;
                    $formreqbudget37 .= $obtext;
                    $sum37 += (float) $Formreq_Budget37[$i]->Formreq_Budget_Amount;
                }
                $headobtext = str_replace('###headamountadd###', number_format($sum37, 2), $headobtext);
            } else {
                $formreqbudget37 = $tbnothing;
                $headobtext = str_replace('###headamountadd###', '0.00', $headobtext);
            }
            $formreqbudget37 = $headobtext . $formreqbudget37;

            $sumall = $sum31 + $sum32 + $sum33 + $sum34 + $sum35 + $sum36 + $sum37;
            $tsum = $tbbody;
            $tsum = str_replace('###numberadd###', '', $tsum);
            $tsum = str_replace('###topicadd###', 'รวมเป็นเงินทั้งสิ้น', $tsum);
            $tsum = str_replace('###amountadd###', number_format($sumall, 2), $tsum);
            $tsumtext = $tbthaitext;
            $tsumtext = str_replace('###amountthaitxt###', $this->ThaiBahtConversion($sumall), $tsumtext);
            $tsumtext = $tsum . $tsumtext;
//test
            $templateProcessor->setValue('formreqbudget', $tbhead . $formreqbudget31 . $formreqbudget32 . $formreqbudget33 . $formreqbudget34 . $formreqbudget35 . $formreqbudget36 . $formreqbudget37 . $tsumtext . $tbfoot);
            $templateProcessor->setValue('FormReqCaseIncome', $freq[0]->FormReqCaseIncome);


//4
            $tbbodypayroll = file_get_contents('assets/global/template/tbpayrollbody.html');
            $formreqpayroll = '';
            if (count($Formreq_Budget32) > 0) {
                for ($i = 0; $i < count($Formreq_Budget32); $i++) {
                    $obtext = $tbbodypayroll;
                    $obtext = str_replace('###payrolltopic###', $Formreq_Budget32[$i]->Formreq_Budget_Topic, $obtext);
                    $obtext = str_replace('###payrollamount###', number_format($Formreq_Budget32[$i]->Formreq_Budget_Amount, 2), $obtext);
                    $formreqpayroll .= $obtext;
                }
            }
            $Formreq_Payroll = Formreq_Payroll::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_Payroll) > 0) {
                $payrollcount = count($Formreq_Budget31);
                for ($i = 0; $i < count($Formreq_Payroll); $i++) {
                    $obtext = $tbbodypayroll;
                    $obtext = str_replace('###payrolltopic###', $Formreq_Payroll[$i]->Payroll_Name, $obtext);
                    $obtext = str_replace('###payrollamount###', number_format($Formreq_Payroll[$i]->Payroll_Amount, 2), $obtext);
                    $formreqpayroll .= $obtext;
                }
            }
            $templateProcessor->setValue('formreqpayroll', $tbhead . $formreqpayroll . $tbfoot);


            //5
            $templateProcessor->setValue('FormReqBankName', $freq[0]->FormReqBankName);
            $templateProcessor->setValue('FormReqBranch', $freq[0]->FormReqBranch);
            $templateProcessor->setValue('FormReqAccountName', $freq[0]->FormReqAccountName);
            $templateProcessor->setValue('FormReqAccountNumber', $freq[0]->FormReqAccountNumber);

//6
            $templateProcessor->setValue('FormReqNotation', $freq[0]->FormReqNotation);
            $formreqauthorizedperson = '';
            $Formreq_AuthorizedPerson = Formreq_AuthorizedPerson::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_AuthorizedPerson) > 0) {
                for ($i = 0; $i < count($Formreq_AuthorizedPerson); $i++) {
                    $obtext = '6.' . ($i + 1) . ' ' . $Formreq_AuthorizedPerson[$i]->AuthorizedPersonName . '<w:br/>';
                    $obtext = '<w:p>
                            <w:pPr>
                            <w:tabs>
                            <w:tab w:val="left" w:pos="720"/>                    
                            </w:tabs>
                            </w:pPr>
                            <w:r>
                            <w:rPr>                  
                            <w:rFonts w:ascii="TH SarabunPSK" w:hAnsi="TH SarabunPSK"/>
                            <w:sz w:val="32"/>
                            </w:rPr>
                            <w:tab/>
                            <w:t>' . ($i + 1) . '. ' . $Formreq_AuthorizedPerson[$i]->AuthorizedPersonName . '</w:t>
                            </w:r>
                            </w:p>';
                    $formreqauthorizedperson .= $obtext;
                }
            }
            $templateProcessor->setValue('formreqauthorizedperson', $formreqauthorizedperson);

            //7
            $templateProcessor->setValue('FormReqReport', $freq[0]->FormReqReport);

            //8

            $formreqpaydate = '';
            $Formreq_PayDate = Formreq_PayDate::where('FormReqID', '=', $fid)->get();
            if (count($Formreq_PayDate) > 0) {
                for ($i = 0; $i < count($Formreq_PayDate); $i++) {
                    $obtext = '8.' . ($i + 1) . ' งวดที่ ' . ($i + 1) . '  ' . number_format($Formreq_PayDate[$i]->PayDateAmount, 2) . ' บาท ' . $Formreq_PayDate[$i]->PayDateRemark . '<w:br/>';
                    $obtext = '<w:p>
                            <w:pPr>
                            <w:tabs>
                            <w:tab w:val="left" w:pos="720"/>                    
                            </w:tabs>
                            </w:pPr>
                            <w:r>
                            <w:rPr>                  
                            <w:rFonts w:ascii="TH SarabunPSK" w:hAnsi="TH SarabunPSK"/>
                            <w:sz w:val="32"/>
                            </w:rPr>
                            <w:tab/>
                            <w:t>งวดที่ ' . ($i + 1) . ' เป็นจำนวนเงิน ' . number_format($Formreq_PayDate[$i]->PayDateAmount, 2) . ' บาท (' . $this->ThaiBahtConversion($Formreq_PayDate[$i]->PayDateAmount) . ') ' . $Formreq_PayDate[$i]->PayDateRemark . '</w:t>
                            </w:r>
                            </w:p>';
                    $formreqpaydate .= $obtext;
                }
            }
            $templateProcessor->setValue('formreqpaydate', $formreqpaydate);

            $fn = $freq[0]->FormReqCRCNumber . '-' . Date("Ymd") . '.docx';
            $contentType = 'Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document;';
            if (file_exists($fn)) {
                unlink($fn);
            }
            $templateProcessor->saveAs($fn);
            header("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header($contentType);
            header("Content-Disposition: attachment; filename=" . $fn);
            readfile($fn);
        }
    }

    public function ThaiBahtConversion($amount_number) {
        $amount_number = number_format($amount_number, 2, ".", "");
        //echo "<br/>amount = " . $amount_number . "<br/>";
        $pt = strpos($amount_number, ".");
        $number = $fraction = "";
        if ($pt === false)
            $number = $amount_number;
        else {
            $number = substr($amount_number, 0, $pt);
            $fraction = substr($amount_number, $pt + 1);
        }

        //list($number, $fraction) = explode(".", $number);
        $ret = "";
        $baht = $this->ReadNumber($number);
        if ($baht != "")
            $ret .= $baht . "บาท";

        $satang = $this->ReadNumber($fraction);
        if ($satang != "")
            $ret .= $satang . "สตางค์";
        else
            $ret .= "ถ้วน";
        //return iconv("UTF-8", "TIS-620", $ret);
        return $ret;
    }

    public function ReadNumber($number) {
        $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
        $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
        $number = $number + 0;
        $ret = "";
        if ($number == 0)
            return $ret;
        if ($number > 1000000) {
            $ret .= $this->ReadNumber(intval($number / 1000000)) . "ล้าน";
            $number = intval(fmod($number, 1000000));
        }

        $divider = 100000;
        $pos = 0;
        while ($number > 0) {
            $d = intval($number / $divider);
            $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
                    ((($divider == 10) && ($d == 1)) ? "" :
                            ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
            $ret .= ($d ? $position_call[$pos] : "");
            $number = $number % $divider;
            $divider = $divider / 10;
            $pos++;
        }
        return $ret;
    }

    public function index() {

        if (!Auth::check()) {
            return redirect('login');
        }

        return view('requestform', ['user' => Auth::user(), 'userwithtitle' => DB::table('users')
                    ->leftJoin('titles', 'titles.id', '=', 'users.title')
                    ->where('users.id', '=', Auth::user()->id)
                    ->select('name', 'firstname', 'lastname')
                    ->get(), 'types' => UserType::all(), 'departments' => Department::orderBy('name', 'asc')->get(), 'nationalities' => Nationality::all(),
            'userDocs' => UserDocument::where('user', '=', Auth::user()->id)->get(),
            'titles' => Title::all(),
            'sexes' => Sex::all(),
            'fid' => '',
            'appr' => 'no',
            'occupations' => Occupation::all(),
            'modules' => Module::all(),
            'activestep' => 0,
            'userModules' => UserModule::where('user', '=', Auth::user()->id)->get()
        ]);
    }

    public function contactus() {


        return view('contactus', ['user' => Auth::user()]);
    }

    public function getFormDataByID($id) {

        if (Auth::check()) {
            $freq = Formreq::where('FormReqID', '=', $id)->get();
            $data = array(
                'Formreq' => $freq,
                'Formreq_AuthorizedPerson' => Formreq_AuthorizedPerson::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget31' => Formreq_Budget31::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget32' => Formreq_Budget32::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget33' => Formreq_Budget33::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget34' => Formreq_Budget34::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget35' => Formreq_Budget35::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget36' => Formreq_Budget36::where('FormReqID', '=', $id)->get(),
                'Formreq_Budget37' => Formreq_Budget37::where('FormReqID', '=', $id)->get(),
                'Formreq_ManagementProject' => Formreq_ManagementProject::where('FormReqID', '=', $id)->get(),
                'Formreq_Objective' => Formreq_Objective::where('FormReqID', '=', $id)->get(),
                'Formreq_PayDate' => Formreq_PayDate::where('FormReqID', '=', $id)->get(),
                'Formreq_Payroll' => Formreq_Payroll::where('FormReqID', '=', $id)->get()
            );
        }
        return Response::json($data);
    }

    public function approveformreq($id) {

        if (!Auth::check()) {
            return redirect('login');
        }

        return view('requestform', ['user' => Auth::user(),
            'types' => UserType::all(),
            'departments' => Department::all(),
            'nationalities' => Nationality::all(),
            'userDocs' => UserDocument::where('user', '=', Auth::user()->id)->get(),
            'titles' => Title::all(),
            'sexes' => Sex::all(),
            'occupations' => Occupation::all(),
            'modules' => Module::all(),
            'fid' => $id,
            'appr' => 'yes',
            'userModules' => UserModule::where('user', '=', Auth::user()->id)->get()
        ]);
    }

    public function editrequestform($id) {

        if (!Auth::check()) {
            return redirect('login');
        }
        $getactivestep = DB::table('formreq')
                ->where('FormReqID', '=', $id)
                ->select('FormReqStepOnPage')
                ->get();
        return view('requestform', [
            'user' => Auth::user(),
            'userwithtitle' => DB::table('users')
                    ->leftJoin('titles', 'titles.id', '=', 'users.title')
                    ->where('users.id', '=', Auth::user()->id)
                    ->select('name', 'firstname', 'lastname')
                    ->get(),
            'departments' => Department::all(),
            'fid' => $id,
            'activestep' => $getactivestep[0]->FormReqStepOnPage,
            'appr' => 'no'
        ]);
    }

    public function allformrequest() {

        if (!Auth::check()) {
            return redirect('login');
        }

        $Formreqs = Formreq::where('FormReqStstus', '!=', 0)
                ->where('FormReqUserIDCreate', '=', Auth::user()->id)
                ->orderBy('FormReqSaveDate', 'desc')
                ->get();
        return view('allformrequest', ['user' => Auth::user(), 'Formreqs' => $Formreqs]);
    }

    public function reviewform() {

        if (!Auth::check()) {
            return redirect('login');
        }

        $Formreqs = Formreq::whereIn('FormReqStstus', array(2, 3, 4, 5))
                ->orderBy('FormReqSendDate', 'desc')
                ->get();
        return view('reviewform', ['user' => Auth::user(), 'Formreqs' => $Formreqs]);
    }

    public function approveformbyadmin($id) {

        if (!Auth::check()) {
            return redirect('login');
        }

        $formreq = Formreq::find($id);
        $formreq->FormReqStstus = 3;
        $formreq->FormReqApprovePerson = Auth::user()->id;
        $formreq->FormReqApproveDate = Date("Y/m/d");
        $formreq->save();
        return redirect('reviewform');
    }

    public function deleteformrequest($id) {

        if (!Auth::check()) {
            return redirect('login');
        }
        $Formreqs = Formreq::where('FormReqID', '=', $id)
                ->where('FormReqUserIDCreate', '=', Auth::user()->id)
                ->get();
        if (count($Formreqs) > 0) {
            $formreq = Formreq::find($id);
            $formreq->FormReqStstus = 0;
            $formreq->save();
        }
        $Formreqs = Formreq::where('FormReqStstus', '!=', 0)
                ->where('FormReqUserIDCreate', '=', Auth::user()->id)
                ->orderBy('FormReqSaveDate', 'desc')
                ->get();
        return redirect('allformrequest');
    }

    public function deleteformrequestadmin($id) {

        if (!Auth::check()) {
            return redirect('login');
        }
        $Formreqs = Formreq::where('FormReqID', '=', $id)
                ->where('FormReqUserIDCreate', '=', Auth::user()->id)
                ->get();
        if (count($Formreqs) > 0) {
            $formreq = Formreq::find($id);
            $formreq->FormReqStstus = 0;
            $formreq->save();
        }

        return redirect('reviewform');
    }

    public function SaveReject(Request $request) {

        if (!Auth::check()) {
            return redirect('login');
        }

        $formreq = Formreq::find($request->fid);
        $formreq->FormReqRejectPerson = Auth::user()->id;
        $formreq->FormReqRejectReason = $request->reasontorej;
        $formreq->FormReqRejectDate = Date("Y/m/d");
        $formreq->FormReqStstus = 1;
        $formreq->FormReqStepOnPage = 0;
        $formreq->save();
        return Response::json([ "message" => "saved"], 200);
    }

    public function SaveMemo(Request $request) {

        if (!Auth::check()) {
            return redirect('login');
        }

        $formreq = Formreq::find($request->fid);
        $formreq->FormReqMemoRound = $request->MemoRound;
        $formreq->FormReqMemoDate = date("Y-m-d", strtotime($request->MemoDate));
//        $formreq->FormReqRejectDate = Date("Y/m/d");
        $formreq->FormReqStstus = 4;
//        $formreq->FormReqStepOnPage = 0;
        $formreq->save();
        // $this->CreateDocx($request->fid . '_memo');
        return Response::json([ "message" => "saved"], 200);
    }

    public function SaveAnnouncementNumber(Request $request) {

        if (!Auth::check()) {
            return redirect('login');
        }
        $freq = Formreq::where('FormReqID', '=', $request->fid)->get();
        $filename = $freq[0]->FormReqCRCNumber;
        $formreq = Formreq::find($request->fid);
        $formreq->FormReqStstus = 5;
        $formreq->FormReqAnnouncementNumber = $request->AnnouncementNumber;
        $formreq->save();
        $pdffilename = $filename . ".pdf";
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
            if (file_exists($_FILES["file"]["name"])) {
                unlink($_FILES["file"]["name"]);
            }

            move_uploaded_file($_FILES["file"]["tmp_name"], 'uploads/pdf/' . $pdffilename);
        }
        return Response::json([ "message" => "saved"], 200);
    }

    public function approveForm(Request $request) {

        if (Auth::check()) {
            $formreq = Formreq::find($request->fid);
            $formreq->FormReqStstus = 0;
            $formreq->FormReqStstus = 0;
            $formreq->save();
        }
    }

    public function SaveForm(Request $request) {
//        $user = User::find(Auth::user()->id);
//        $formreq = new Formreq;

        $formreq = new Formreq;
        if ($request->fid !== '') {
            $formreq = Formreq::find($request->fid);
        }
        $formreq->FormReqTopic = $request->txtTopic;
        $formreq->FormReqDepartment = $request->ddlDepartment;
        $formreq->FormReqOtherDepartment = $request->txtOtherDepartment;
        $formreq->FormReqTel = $request->txtTel;
        $formreq->FormReqKnowlageType = $request->ddlKnowlageType;
        $formreq->FormReqTo = $request->txtTo;
        $formreq->FormReqSponser = $request->txtSponser;
        $formreq->FormReqBudgetScholarship = $request->txtBudgetScholarship;
        $formreq->FormReqStartDateScholarship = ($request->txtStartDateScholarship != "") ? date("Y-m-d", strtotime($request->txtStartDateScholarship)) : "NULL";
        $formreq->FormReqEndDateScholarship = ($request->txtEndDateScholarship != "") ? date("Y-m-d", strtotime($request->txtEndDateScholarship)) : "NULL";
        $formreq->FormReqResponsibleProjectPerson = $request->txtResponsibleProjectPerson;
        $formreq->FormReqHeadProjectPerson = $request->txtHeadOfProject;
        $formreq->FormReqCaseIncome = $request->txtCaseIncome;
        $formreq->FormReqBankName = $request->txtBankName;
        $formreq->FormReqBranch = $request->txtBranch;
        $formreq->FormReqAccountName = $request->txtAccountName;
        $formreq->FormReqAccountNumber = $request->txtAccountNumber;
        $formreq->FormReqNotation = $request->txtNotation;
        $formreq->FormReqReport = $request->txtReport;
        $formreq->FormReqStepOnPage = $request->hidCurrentStep;
        if ($request->hidSaveOrSend == 'Save') {
            $formreq->FormReqStstus = 1;
            $formreq->FormReqSaveDate = Date("Y/m/d");
        } elseif ($request->hidSaveOrSend == 'Send') {
            $formreq->FormReqSendDate = Date("Y/m/d");
            $formreq->FormReqSaveDate = Date("Y/m/d");
            $formreq->FormReqStstus = 2;
        }
        $user = Auth::user()->id;
        $formreq->FormReqUserIDCreate = $user;
        $formreq->save();
        $insertedId = $formreq->FormReqID;

        if ($request->hidSaveOrSend == 'Send') {
            $crcnum = "CRC" . str_pad($insertedId, 5, '0', STR_PAD_LEFT);
            $formreq = Formreq::find($request->fid);
            $formreq->FormReqCRCNumber = $crcnum;
            $formreq->save();
        }


        $this->SaveObjective($insertedId, $request->ObjectiveCount, $request);
        $this->SaveManagementProject($insertedId, $request->ManagementProjectCount, $request);
        $this->SaveBudget31($insertedId, $request->BudgetCount1, $request);
        $this->SaveBudget32($insertedId, $request->BudgetCount2, $request);
        $this->SaveBudget33($insertedId, $request->BudgetCount3, $request);
        $this->SaveBudget34($insertedId, $request->BudgetCount4, $request);
        $this->SaveBudget35($insertedId, $request->BudgetCount5, $request);
        $this->SaveBudget36($insertedId, $request->BudgetCount6, $request);
        $this->SaveBudget37($insertedId, $request->BudgetCount7, $request);
        $this->SavePayroll($insertedId, $request->PayrollCount, $request);
        $this->SaveAuthorizedPerson($insertedId, $request->AuthorizedPersonCount, $request);
        $this->SavePayDate($insertedId, $request->PayDateCount, $request);

        return Response::json([ "message" => "saved", "lastid" => $insertedId], 200);
        //echo $request->txtTopic;
    }

    public function SaveObjective($id, $countObjective, $obj) {
        $formreqobj = Formreq_Objective::where('FormReqID', '=', $id);
        if (!is_null($formreqobj)) {
            $formreqobj->delete();
        }
        for ($i = 0; $i < $countObjective; $i++) {
            $formreqobj = new Formreq_Objective;
            $formreqobj->FormReqID = $id;
            $fieldname = 'Objective_' . $i;
            $formreqobj->Objective = $obj->$fieldname;
            $formreqobj->save();
        }
    }

    public function SaveManagementProject($id, $countManagementProject, $obj) {
        $formreqManagementProject = Formreq_ManagementProject::where('FormReqID', '=', $id);
        if (!is_null($formreqManagementProject)) {
            $formreqManagementProject->delete();
        }
        for ($i = 0; $i < $countManagementProject; $i++) {
            $formreqManagementProject = new Formreq_ManagementProject;
            $formreqManagementProject->FormReqID = $id;
            $ManagementProjectName = 'ManagementProject_Name_' . $i;
            $formreqManagementProject->ManagementProjectName = $obj->$ManagementProjectName;
            $ManagementProjectPosition = 'ManagementProject_Position_' . $i;
            $formreqManagementProject->ManagementProjectPosition = $obj->$ManagementProjectPosition;
            $formreqManagementProject->save();
        }
    }

    public function SaveBudget31($id, $BudgetCount1, $obj) {
        $formreqBudget31 = Formreq_Budget31::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget31)) {
            $formreqBudget31->delete();
        }
        for ($i = 0; $i < $BudgetCount1; $i++) {
            $formreqBudget31 = new Formreq_Budget31;
            $formreqBudget31->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget1_Topic_' . $i;
            $formreqBudget31->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget1_Amount_' . $i;
            $formreqBudget31->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $formreqBudget31->save();
        }
    }

    public function SaveBudget32($id, $BudgetCount2, $obj) {
        $formreqBudget32 = Formreq_Budget32::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget32)) {
            $formreqBudget32->delete();
        }
        for ($i = 0; $i < $BudgetCount2; $i++) {
            $formreqBudget32 = new Formreq_Budget32;
            $formreqBudget32->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget2_Topic_' . $i;
            $formreqBudget32->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget2_Amount_' . $i;
            $formreqBudget32->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $formreqBudget32->save();
        }
    }

    public function SaveBudget33($id, $BudgetCount3, $obj) {
        $formreqBudget33 = Formreq_Budget33::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget33)) {
            $formreqBudget33->delete();
        }
        for ($i = 0; $i < $BudgetCount3; $i++) {
            $formreqBudget33 = new Formreq_Budget33;
            $formreqBudget33->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget3_Topic_' . $i;
            $formreqBudget33->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget3_Amount_' . $i;
            $formreqBudget33->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $formreqBudget33->save();
        }
    }

    public function SaveBudget34($id, $BudgetCount4, $obj) {
        $formreqBudget34 = Formreq_Budget34::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget34)) {
            $formreqBudget34->delete();
        }
        for ($i = 0; $i < $BudgetCount4; $i++) {
            $formreqBudget34 = new Formreq_Budget34;
            $formreqBudget34->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget4_Topic_' . $i;
            $formreqBudget34->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget4_Amount_' . $i;
            $formreqBudget34->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $formreqBudget34->save();
        }
    }

    public function SaveBudget35($id, $BudgetCount5, $obj) {
        $formreqBudget35 = Formreq_Budget35::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget35)) {
            $formreqBudget35->delete();
        }
        for ($i = 0; $i < $BudgetCount5; $i++) {
            $formreqBudget35 = new Formreq_Budget35;
            $formreqBudget35->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget5_Topic_' . $i;
            $formreqBudget35->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget5_Amount_' . $i;
            $formreqBudget35->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $formreqBudget35->save();
        }
    }

    public function SaveBudget36($id, $BudgetCount6, $obj) {
        $formreqBudget36 = Formreq_Budget36::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget36)) {
            $formreqBudget36->delete();
        }
        for ($i = 0; $i < $BudgetCount6; $i++) {
            $formreqBudget36 = new Formreq_Budget36;
            $formreqBudget36->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget6_Topic_' . $i;
            $formreqBudget36->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget6_Amount_' . $i;
            $formreqBudget36->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $Formreq_Budget_Except = 'TopicBudget6_Except_' . $i;
            $formreqBudget36->Formreq_Budget_Except = $obj->$Formreq_Budget_Except;
            $formreqBudget36->save();
        }
    }

    public function SaveBudget37($id, $BudgetCount7, $obj) {
        $formreqBudget37 = Formreq_Budget37::where('FormReqID', '=', $id);
        if (!is_null($formreqBudget37)) {
            $formreqBudget37->delete();
        }
        for ($i = 0; $i < $BudgetCount7; $i++) {
            $formreqBudget37 = new Formreq_Budget37;
            $formreqBudget37->FormReqID = $id;
            $Formreq_Budget_Topic = 'TopicBudget7_Topic_' . $i;
            $formreqBudget37->Formreq_Budget_Topic = $obj->$Formreq_Budget_Topic;
            $Formreq_Budget_Amount = 'TopicBudget7_Amount_' . $i;
            $formreqBudget37->Formreq_Budget_Amount = $obj->$Formreq_Budget_Amount;
            $Formreq_Budget_Except = 'TopicBudget7_Except_' . $i;
            $formreqBudget37->Formreq_Budget_Except = $obj->$Formreq_Budget_Except;
            $formreqBudget37->save();
        }
    }

    public function SavePayroll($id, $countPayroll, $obj) {
        $formreqPayroll = Formreq_Payroll::where('FormReqID', '=', $id);
        if (!is_null($formreqPayroll)) {
            $formreqPayroll->delete();
        }
        for ($i = 0; $i < $countPayroll; $i++) {
            $formreqPayroll = new Formreq_Payroll;
            $formreqPayroll->FormReqID = $id;
            $Payroll_Name = 'Payroll_Name_' . $i;
            $formreqPayroll->Payroll_Name = $obj->$Payroll_Name;
            $Payroll_Amount = 'Payroll_Amount_' . $i;
            $formreqPayroll->Payroll_Amount = $obj->$Payroll_Amount;
            $formreqPayroll->save();
        }
    }

    public function SaveAuthorizedPerson($id, $countAuthorizedPerson, $obj) {
        $formreqAuthorizedPerson = Formreq_AuthorizedPerson::where('FormReqID', '=', $id);
        if (!is_null($formreqAuthorizedPerson)) {
            $formreqAuthorizedPerson->delete();
        }
        for ($i = 0; $i < $countAuthorizedPerson; $i++) {
            $formreqAuthorizedPerson = new Formreq_AuthorizedPerson;
            $formreqAuthorizedPerson->FormReqID = $id;
            $AuthorizedPerson_Name = 'AuthorizedPerson_' . $i;
            $formreqAuthorizedPerson->AuthorizedPersonName = $obj->$AuthorizedPerson_Name;
            $formreqAuthorizedPerson->save();
        }
    }

    public function SavePayDate($id, $countPayDate, $obj) {
        $formreqPayDate = Formreq_PayDate::where('FormReqID', '=', $id);
        if (!is_null($formreqPayDate)) {
            $formreqPayDate->delete();
        }
        for ($i = 0; $i < $countPayDate; $i++) {
            $formreqPayDate = new Formreq_PayDate;
            $formreqPayDate->FormReqID = $id;
            $PayDateAmount = 'PayDate_Amount_' . $i;
            $formreqPayDate->PayDateAmount = $obj->$PayDateAmount;
            $PayDateRemark = 'PayDate_Remark_' . $i;
            $formreqPayDate->PayDateRemark = $obj->$PayDateRemark;
            $formreqPayDate->save();
        }
    }

}
