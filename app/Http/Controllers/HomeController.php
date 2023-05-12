<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Students;
use Session;

class HomeController extends Controller
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

    /**
    * Show the application dashboard.
    * ホーム
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        $userRole = Session::get('userRole');
        $display = array();
        $stuPercent = array('fourty' => 0,'fifty' => 0, 'sixty' => 0, 'seventy' => 0,
                            'eighty' => 0, 'ninety' => 0, 'hundred' => 0);
        $passFail = array('pass' => 0,'fail' => 0);
        $display['heading'] = trans('messages.lbl_home');
        // 学生のmark情報を取得する
        $percent = Result::getMarkRange();
        //  科目と授業情報を取得する
        $subClass = Result::getSubjectClassRange();

        $i=1; $j=1; $k=1; $l=1; $m=1; $n=1; $o=1;
        $pass=1; $fail=1;
        foreach ($percent as $key => $value) {

            if($value->percent >= 0 && $value->percent < 40){
                $passFail['pass'] = $pass++;
            } else {
                $passFail['fail'] = $fail++;
            }

            if($value->percent >= 0 && $value->percent <= 40){
                $stuPercent['fourty'] = $i++;
            } else if($value->percent >= 41 && $value->percent <= 50){
                $stuPercent['fifty'] = $j++;
            } else if($value->percent >= 51 && $value->percent <= 60){
                $stuPercent['sixty'] = $k++;
            } else if($value->percent >= 61 && $value->percent <= 70){
                $stuPercent['seventy'] = $l++;
            } else if($value->percent >= 71 && $value->percent <= 80){
                $stuPercent['eighty'] = $m++;
            } else if($value->percent >= 81 && $value->percent <= 90){
                $stuPercent['ninety'] = $n++;
            } else if($value->percent >= 91 && $value->percent <= 100){
                $stuPercent['hundred'] = $o++;
            }
        }

        // 授業と科目を配列でセットする
        $subjectArr = array();
        $clsNameArr = array();
        foreach ($subClass as $key => $value) {
            $subjectArr[$value->class_name] = $value->subject_cnt;
            $clsNameArr[$key] = "'".$value->class_name."'";
        }

        // 授業によって科目のカウントをセットする
        // $subjectCntArr = implode(', ', $subjectArr);
        // 各授業名をセットする
        // $classNameArr = implode(', ', $clsNameArr);
        // グレードによって学生のマークをセットする
        $stuPerRange = implode(', ', array_reverse($stuPercent));
        // 合格と失敗のマークレンジをセットする
        $passFailRange = implode(', ', $passFail);

        return view('admin.home', compact('percent', 'stuPerRange', 'passFailRange', 'display',
                                        'subjectArr', 'clsNameArr', 'userRole'));
    }

    /**
    * Show the application dashboard.
    * ホーム
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function userIndex()
    {
        $userRole = Session::get('userRole');
        $display = array();
        $stuPercent = array('fourty' => 0,'fifty' => 0, 'sixty' => 0, 'seventy' => 0,
                            'eighty' => 0, 'ninety' => 0, 'hundred' => 0);
        $passFail = array('pass' => 0,'fail' => 0);
        $display['heading'] = trans('messages.lbl_home');
        // 学生のmark情報を取得する
        $percent = Result::getMarkRange();
        //  科目と授業情報を取得する
        $subClass = Result::getSubjectClassRange();

        $i=1; $j=1; $k=1; $l=1; $m=1; $n=1; $o=1;
        $pass=1; $fail=1;
        foreach ($percent as $key => $value) {

            if($value->percent >= 0 && $value->percent < 40){
                $passFail['pass'] = $pass++;
            } else {
                $passFail['fail'] = $fail++;
            }

            if($value->percent >= 0 && $value->percent <= 40){
                $stuPercent['fourty'] = $i++;
            } else if($value->percent >= 41 && $value->percent <= 50){
                $stuPercent['fifty'] = $j++;
            } else if($value->percent >= 51 && $value->percent <= 60){
                $stuPercent['sixty'] = $k++;
            } else if($value->percent >= 61 && $value->percent <= 70){
                $stuPercent['seventy'] = $l++;
            } else if($value->percent >= 71 && $value->percent <= 80){
                $stuPercent['eighty'] = $m++;
            } else if($value->percent >= 81 && $value->percent <= 90){
                $stuPercent['ninety'] = $n++;
            } else if($value->percent >= 91 && $value->percent <= 100){
                $stuPercent['hundred'] = $o++;
            }
        }

        // 授業と科目を配列でセットする
        $subjectArr = array();
        $clsNameArr = array();
        foreach ($subClass as $key => $value) {
            $subjectArr[$value->class_name] = $value->subject_cnt;
            $clsNameArr[$key] = "'".$value->class_name."'";
        }

        // 授業によって科目のカウントをセットする
        // $subjectCntArr = implode(', ', $subjectArr);
        // 各授業名をセットする
        // $classNameArr = implode(', ', $clsNameArr);
        // グレードによって学生のマークをセットする
        $stuPerRange = implode(', ', array_reverse($stuPercent));
        // 合格と失敗のマークレンジをセットする
        $passFailRange = implode(', ', $passFail);

        return view('users.home', compact('percent', 'stuPerRange', 'passFailRange', 'display',
                                        'subjectArr', 'clsNameArr', 'userRole'));
    }
}
