<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
    * 編集処理
    */
    public function profile() 
    {
        $display = array();
        $display['heading'] = "Profile Update";
        $display['button'] = trans('messages.lbl_update');
        $display['button_act'] = "Update";
        $id = Auth::user()->id;

        // IDに該当する授業情報を取得する
        $data = User::where('id', '=', $id)->find($id);
        // 授業データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('/home');
        }

        return view('admin.profile.addedit', compact('display', 'data'));
    }

    /**
    * 更新処理
    * @param $request
    */
    public function doEdit(Request $request) 
    {
        $id = Auth::user()->id;
        // 更新する
        $user = User::findOrFail($id);
        $user->update($request->all());

        if($user) {
            $message = "Profile Updated successfully!";
            $type = "success";
        } else {
            $message = "Profile Updated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('admin.profile')->with($type, $message);
    }

    /**
    * パスワードリセット処理
    */
    public function resetPassword() 
    {
        $display = array();
        $display['heading'] = "Password Reset";
        $display['button'] = trans('messages.lbl_update');
        $display['button_act'] = "Update";
        $id = Auth::user()->id;

        // IDに該当する授業情報を取得する
        $data = User::where('id', '=', $id)->find($id);
        
        // データは存在しない場合一覧画面へ移動する
        if (!$data) {
            return redirect('/home');
        }

        return view('admin.profile.resetpassword', compact('display', 'data'));
    }

    /**
    * パスワードを変更する
    * @param $request
    */
    public function doResetPassword(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        $data['password'] = Hash::make($request->password);

        // 更新する
        $resetPass = User::findOrFail($id);
        $resetPass->update($data);

        if($resetPass) {
            $message = "Password Updated successfully!";
            $type = "success";
        } else {
            $message = "Password Updated UnSuccessfully!";
            $type = "error";
        }

        return redirect()->route('admin.resetpassword')->with($type, $message);

    }
}