<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Classes;
use App\Students;
use App\SubjectClassRelation;
use App\Http\Requests\ResultRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ResultController extends Controller
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
    * 結果一覧画面
    * @return 結果ビュー画面へ移動する
    */
    public function list()
    {
        $display = array();
        $display['heading'] = trans('messages.lbl_result_list');
        // 結果詳細情報を取得する
        $data = Result::getResultList();
        return view('admin.result.list', compact('data', 'display'));
    }

    /**
    * 結果表示画面
    * @param $id
    */
    public function view($id)
    {
        $display = array();
        $classlist = array();
        $display['heading'] = "Result View";
        $display['back'] = "Back";

        // IDに該当する結果情報を取得する
        $data = Students::getStudentDetails($id);

        // 結果データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('result/list');
        }

        return view('admin.result.view', compact('display', 'data'));
    }

    /**
    * 結果登録画面
    */
    public function add()
    {
        $display = array();
        $classlist = array();
        $display['heading'] = "Result Register";
        $display['button'] = trans('messages.lbl_register');
        $display['button_act'] = "Register";

        // 事業一覧
        $classlist = $this->setList(Classes::getClassList());

        return view('admin.result.addedit', compact('display', 'classlist'));
    }

    /**
    * 学生と科目情報を取得する
    * @param $request
    */
    public function getStudentInfo(Request $request)
    {
        // 学生名一覧情報を取得する.
        $stuNameList = $this->setList(Students::getStudentNameList($request->class_id));

        // 授業に関連する科目情報を取得する.
        $subDetails = SubjectClassRelation::getClassSubjectDetails($request->class_id);

        return response()->json(compact('stuNameList', 'subDetails'));
    }

    /**
    * 結果情報を取得する
    * @param $request
    */
    public function chkStuResultInfo(Request $request)
    {
        // 学生名一覧情報を取得する.
        $stuResultInfo = Result::where('class_id' , $request->class_id)
                                ->where('student_id', $request->student_id)
                                ->get();

        return response()->json(compact('stuResultInfo'));
    }

    /**
    * 学生の結果情報を登録する
    * @param $request
    */
    public function doAdd(ResultRequest $request) 
    {
        $data = array();
        $marks = array();
        $marks = $request->marks;

        if (count($marks) <= 0) {
            return redirect()->route('result.list')->with("error", "マークを選んでください。");
        }

        // 登録する
        foreach ($request->marks as $subject_id => $marks) {
            $data['student_id'] = $request->student_id;
            $data['class_id'] = $request->class_id;
            $data['subject_id'] = $subject_id;
            $data['marks'] = $marks;
            $students = Result::insertResult($data);
        }

        if($students) {
          $message = "Result Record Created successfully!";
          $type = "success";
        } else {
          $message = "Result Record Created UnSuccessfully!";
          $type = "error";
        }

        return redirect()->route('result.list')->with($type, $message);
    }

    /**
    * 編集処理
    * @param $id
    */
    public function edit($id)
    {
        $display = array();
        $classlist = array();
        $display['heading'] = "Result Update";
        $display['button'] = trans('messages.lbl_update');
        $display['button_act'] = "Update";

        // 授業一覧
        $classlist = $this->setList(Classes::getClassList());

        // IDに該当する学生情報を取得する
        $data = Students::getStudentDetails($id);
        $student_id = $data->student_id;

        // 学生名一覧情報を取得する.
        // $stuNameList = Students::getStudentNameList($data->class_id);

        // 授業に関連する科目情報を取得する.
        $subList = Result::getStuSubjectMarks($student_id);

        // 結果データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('result/list');
        }

        return view('admin.result.addedit', compact('display', 'data', 'subList', 'classlist'));
    }

    /**
    * 更新処理
    * @param $request
    */
    public function doEdit(Request $request)
    {
        // 更新する
        $data = array();
        foreach ($request->marks as $id => $marks) {
            $data['marks'] = $marks;

            $result = Result::findOrFail($id);
            $result->update($data);
        }

        if($result) {
            $message = "Student Marks Record Updated successfully!";
            $type = "success";
        } else {
            $message = "Student Marks Record Updated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('result.list')->with($type, $message);
    }

    /**
    * 配列の最初の値を空気でセットする
    * @param Array $listArr
    */
    private function setList($listArr) {
        $data = array();
        foreach ($listArr as $key => $value) {
            $data[''] = "";
            $data[$key] = $value;
        }

        return $data;
    }
}