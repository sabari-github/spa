<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Subjects;
use App\SubjectClassRelation;
use App\Http\Requests\SubjectsRequest;
use App\Http\Requests\SubjectClassRelationRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
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
    * 科目一覧画面
    */
    public function list()
    {
        $display = array();
        $display['heading'] = trans('messages.lbl_subject_list');

        $data = Subjects::paginate(10);
        return view('admin.subjects.list', compact('display', 'data'));
    }

    /**
    * 科目表示画面
    * @param $id
    */
    public function view($id)
    {
        $display = array();
        $classlist = array();
        $display['heading'] = "Subject View";
        $display['back'] = "Back";

        // IDに該当する学生情報を取得する
        $data = Subjects::where('id', '=', $id)->find($id);

        // 学生データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('students/list');
        }

        return view('admin.subjects.view', compact('display', 'data'));
    }

    /**
    * 科目登録画面
    * @param $request
    */
    public function add()
    {
        $display = array();
        $dataedit = array();
        $display['heading'] = "Subject Register";
        $display['button'] = trans('messages.lbl_register');
        $display['button_act'] = "Register";

        return view('admin.subjects.addedit', compact('display'));
    }

    /**
    * 科目情報を登録する
    * @param $request
    */
    public function doAdd(SubjectsRequest $request) 
    {
        // 登録する
        $subjects = new Subjects($request->all());
        $subjects->save();
        if($subjects) {
          $message = "subjects Record Created successfully!";
          $type = "success";
        } else {
          $message = "subjects Record Created UnSuccessfully!";
          $type = "error";
        }

        return redirect()->route('subjects.list')->with($type, $message);
    }

    /**
    * 編集処理
    *
    * @param $id
    * @return 科目編集画面へ移動する
    */
    public function edit($id) 
    {
        $display = array();
        $display['heading'] = "Subject Update";
        $display['button'] = trans('messages.lbl_update');
        $display['button_act'] = "Update";

        // IDに該当する科目情報を取得する
        $data = Subjects::where('id', '=', $id)->find($id);

        // 科目データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('subjects/list');
        }

        return view('admin.subjects.addedit', compact('display', 'data'));
    }

    /**
    * 更新処理
    * @param $request
    */
    public function doEdit(SubjectsRequest $request) 
    {
        // 更新する
        $subjects = Subjects::findOrFail($request->id);
        $subjects->update($request->all());

        if($subjects) {
            $message = "subjects Record Updated successfully!";
            $type = "success";
        } else {
            $message = "subjects Record Updated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('subjects.list')->with($type, $message);
    }

    /**
    * 科目ークラス関連一覧画面
    */
    public function subjectClassRelList()
    {
        $display = array();
        $display['heading'] = "Subject Class Relation List";
        $data = SubjectClassRelation::getSubjectClassDetails();
        return view('admin.subjects.subjectrelationlist', compact('data', 'display'));
    }

    /**
    * 科目クラス関連登録画面
    */
    public function subjectClassRelAdd()
    {
        $display = array();
        $dataedit = array();
        $display['heading'] = "Subject Class Relation Register";
        $display['button'] = trans('messages.lbl_register');
        $display['button_act'] = "Register";

        // 授業一覧
        $classlist = $this->setList(Classes::getClassList());
        $subjectlist = $this->setList(Subjects::getSubjectsList());

        return view('admin.subjects.subjectrelationaddedit', compact('display', 'classlist', 'subjectlist'));
    }

    /**
    * 科目クラス関連情報を登録する
    * @param $request
    */
    public function subjectClassRelDoAdd(SubjectClassRelationRequest $request) 
    {
        // 登録する
        $subjects = new SubjectClassRelation($request->all());
        $subjects->save();
        if($subjects) {
          $message = "subjects Record Created successfully!";
          $type = "success";
        } else {
          $message = "subjects Record Created UnSuccessfully!";
          $type = "error";
        }

        return redirect()->route('subjects.subjectrelationlist')->with($type, $message);
    }

    /**
    * 科目クラス関連更新画面
    * @param $id
    */
    public function subjectClassRelEdit($id)
    {
        $display = array();
        $dataedit = array();
        $display['heading'] = "Subject Class Relation Edit";
        $display['button'] = trans('messages.lbl_update');
        $display['button_act'] = "Update";

        // 授業一覧
        $classlist = $this->setList(Classes::getClassList());
        $subjectlist = $this->setList(Subjects::getSubjectsList());
        
        // IDに該当する学生情報を取得する
        $data = SubjectClassRelation::where('id', '=', $id)->find($id);

        return view('admin.subjects.subjectrelationaddedit', 
                compact('display', 'classlist', 'subjectlist', 'data'));
    }

    /**
    * 科目クラス関連情報を更新する
    * @param $request
    */
    public function subjectClassRelDoEdit(SubjectClassRelationRequest $request) 
    {
        // 更新する
        $sub_rel = SubjectClassRelation::findOrFail($request->id);
        $sub_rel->update($request->all());

        if($sub_rel) {
            $message = "Subject Class Relation Record Updated successfully!";
            $type = "success";
        } else {
            $message = "Subject Class Relation Record Updated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('subjects.subjectrelationlist')->with($type, $message);
    }

    /**
    * 科目クラス関連情報を削除する
    * @param id, valid_flg
    */
    public function subjectClassRelDoDel($id, $valid_flg) 
    {
        // 削除する
        $sub_rel = SubjectClassRelation::findOrFail($id);
        $sub_rel->update(['valid_flg' => $valid_flg]);

        if($sub_rel)
        {
            $message = "Subject Class Relation Record Activated successfully!";
            if ($valid_flg == 1) {
                $message = "Subject Class Relation Record Deactivated successfully!";
            }
            $type = "success";
        } else {
            $message = "Subject Class Relation Record Activated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('subjects.subjectrelationlist')->with($type, $message);
    }

    /*配列の最初の値を空気でセットする*/
    private function setList($listArr) {
        $data = array();
        foreach ($listArr as $key => $value) {
            $data[''] = "";
            $data[$key] = $value;
        }

        return $data;
    }
}