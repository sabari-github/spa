<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Http\Requests\ClassesRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
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
    * 授業一覧画面
    *
    * @param $request
    * @return 授業ビュー画面へ移動する
    */
    public function list()
    {
        $display = array();
        $display['heading'] = trans('messages.lbl_class_list');

        $data = Classes::paginate(10);
        return view('admin.classes.list', compact('display', 'data'));
    }

    /**
    * 授業登録画面
    *
    * @param $request
    * @return 授業ビュー画面へ移動する
    */
    public function add()
    {
        $display = array();
        $dataedit = array();
        $display['heading'] = trans('messages.lbl_class_register');
        $display['button'] = trans('messages.lbl_register');
        $display['button_act'] = "Register";

        return view('admin.classes.addedit', compact('display'));
    }

    /**
    * 授業情報を登録する
    *
    * @param $request
    * @return 授業ビュー画面へ移動する
    */
    public function doAdd(ClassesRequest $request) 
    {
        // 登録する
        $subjects = new Classes($request->all());
        $subjects->save();
        if($subjects) {
          $message = "Class Created successfully!";
          $type = "success";
        } else {
          $message = "Class Created UnSuccessfully!";
          $type = "error";
        }

        return redirect()->route('classes.list')->with($type, $message);
    }

    /**
    * 編集処理
    *
    * @param $id
    * @return 授業編集画面へ移動する
    */
    public function edit($id) 
    {
        $display = array();
        $display['heading'] = trans('messages.lbl_class_update');;
        $display['button'] = trans('messages.lbl_update');
        $display['button_act'] = "Update";

        // IDに該当する授業情報を取得する
        $data = Classes::where('id', '=', $id)->find($id);

        // 授業データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('classes/list');
        }

        return view('admin.classes.addedit', compact('display', 'data'));
    }

    /**
    * 更新処理
    *
    * @param $id
    * @return 授業編集画面へ移動する
    */
    public function doEdit(ClassesRequest $request) 
    {
        // 更新する
        $classes = Classes::findOrFail($request->id);
        $classes->update($request->all());

        if($classes) {
            $message = "Classes Record Updated successfully!";
            $type = "success";
        } else {
            $message = "Classes Record Updated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('classes.list')->with($type, $message);
    }
}