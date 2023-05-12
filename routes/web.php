<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 言語変更
Route::any('language/{locale}', 'LanguageController@index')->name('language');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    
    /*Users Students Home*/
    Route::get('user', 'HomeController@userIndex');

    /*Login*/    
    // Route::get('login', 'CustomAuthController@customLogin')->name('customLogin');
    // Route::get('ecj', 'LoginController@index');
    // Route::post('ecj', 'LoginController@authenticate');
    // Route::any('formValidation', 'LoginController@formValidation');

    /*Profile*/
    Route::get('admin/profile', 'ProfileController@profile')->name('admin.profile');
    Route::post('admin/profile/doEdit', 'ProfileController@doEdit')->name('admin.profile.doEdit');
    Route::get('admin/resetpassword', 'ProfileController@resetPassword')->name('admin.resetpassword');
    Route::post('admin/doResetPassword', 'ProfileController@doResetPassword');

	/*Home*/
	Route::get('/home', 'HomeController@index')->name('home');

	/*Students*/
	Route::get('admin/students/list', 'StudentsController@list')->name('students.list');
	Route::get('admin/students/add', 'StudentsController@add')->name('students.add');
    Route::any('admin/edit/{id}', 'StudentsController@edit')->name('students.edit');
    Route::post('admin/students/doAdd', 'StudentsController@doAdd')->name('students.doAdd');
    Route::post('admin/students/doEdit', 'StudentsController@doEdit')->name('students.doEdit');
    Route::get('admin/students/view/{id}', 'StudentsController@view')->name('students.view');

    /*Subjects*/
	Route::get('admin/subjects/list', 'SubjectsController@list')->name('subjects.list');
	Route::get('admin/subjects/add', 'SubjectsController@add')->name('subjects.add');
    Route::any('admin/subjects/edit/{id}', 'SubjectsController@edit')->name('subjects.edit');
    Route::post('admin/subjects/doAdd', 'SubjectsController@doAdd')->name('subjects.doAdd');
    Route::post('admin/subjects/doEdit', 'SubjectsController@doEdit')->name('subjects.doEdit');
    Route::get('admin/subjects/view/{id}', 'SubjectsController@view')->name('subjects.view');

    /*Subject Class Relation*/
    Route::get('admin/subjects/subjectrelationlist', 'SubjectsController@subjectClassRelList')->name('subjects.subjectrelationlist');
    Route::get('admin/subjects/subjectrelationadd', 'SubjectsController@subjectClassRelAdd')->name('subjects.subjectrelationAdd');
    Route::post('admin/subjects/subjectrelationDoAdd', 'SubjectsController@subjectClassRelDoAdd')->name('subjects.subjectClassRelDoAdd');
    Route::any('admin/subjects/subjectrelationedit/{id}', 'SubjectsController@subjectClassRelEdit')->name('subjects.subjectClassRelEdit');
    Route::any('admin/subjects/subjectrelationDoEdit', 'SubjectsController@subjectClassRelDoEdit')->name('subjects.subjectClassRelDoEdit');
    Route::any('admin/subjects/subjectrelationDoDel/{id}/{valid_flg}', 'SubjectsController@subjectClassRelDoDel')->name('subjects.subjectClassRelDoDel');

    /*Classes*/
	Route::get('admin/classes/list', 'ClassesController@list')->name('classes.list');
	Route::get('admin/classes/add', 'ClassesController@add')->name('classes.add');
    Route::any('admin/classes/edit/{id}', 'ClassesController@edit')->name('classes.edit');
    Route::post('admin/classes/doAdd', 'ClassesController@doAdd')->name('classes.doAdd');
    Route::post('admin/classes/doEdit', 'ClassesController@doEdit')->name('classes.doEdit');

    /*Result*/
    Route::get('admin/result/list', 'ResultController@list')->name('result.list');
    Route::any('admin/result/add', 'ResultController@add')->name('result.add');
    Route::any('admin/result/edit/{id}', 'ResultController@edit')->name('result.edit');
    Route::any('admin/result/view/{id}', 'ResultController@view')->name('result.view');
    Route::post('admin/result/doAdd', 'ResultController@doAdd')->name('result.doAdd');
    Route::post('admin/result/doEdit', 'ResultController@doEdit')->name('result.doEdit');
    Route::any('admin/result/getstudent', 'ResultController@getStudentInfo')->name('result.getstudent');
    Route::any('admin/result/chkStuResult', 'ResultController@chkStuResultInfo')->name('result.chkStuResult');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
