<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Students extends Model {

    protected $table = 'students';

    protected $fillable = [
        // 'student_id',
        'class_id',
        'roll_no',
        'student_name',
        'student_email',
        'gender',
        'dob',
        'valid_flg',
        'created_at',
        'updated_at'
    ];

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'student_id';

    /**
    * 学生詳細情報を取得する.
    * @return Array
    */
    public static function getAllStudent() {

        $query = DB::table('students')
                ->leftJoin('classes', 'students.class_id', '=', 'classes.id')
                ->paginate(10);

        return $query;
    }

    /**
    * 学生詳細情報を取得する.
    * @param id
    */
    public static function getStudentDetails($id) {

        $query = DB::table('students')
                ->leftJoin('result', 'students.student_id', '=', 'result.student_id')
                ->leftJoin('classes', 'classes.id', '=', 'students.class_id')
                ->where('students.student_id', $id)
                ->first();
                // ->get();

        return $query;
    }

    /**
    * 学生名一覧情報を取得する.
    * @return 学生名一覧
    */
    public static function getStudentNameList($class_id) {

        $query = DB::table('students')
                ->select(DB::raw('concat (student_name," - ",roll_no) as student_name, student_id'))
                ->where('class_id', $class_id)
                ->where('valid_flg', 0)
                ->whereNotIn('student_id', DB::table('result')->select('student_id')->where('class_id', '=', $class_id)->where('valid_flg', '0')->get()->pluck('student_id')->toArray())
                ->orderBy('student_name','ASC')
                ->pluck('student_name', 'student_id');

        return $query;
    }
}