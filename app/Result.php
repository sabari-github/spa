<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

class Result extends Model {

    protected $table = 'result';

    protected $fillable = [
        // 'id',
        'student_id',
        'class_id',
        'subject_id',
        'marks',
        'valid_flg',
        'created_at',
        'updated_at'
    ];

    /**
    * The primary key associated with the table.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
    * 結果詳細情報を取得する
    *
    * @return Array
    */
    public static function getResultList() {

        $query = DB::table('result')
                ->select('result.created_at', 'students.student_id', 'students.student_name', 'students.roll_no', 'classes.valid_flg',
                         DB::raw('concat (classes.class_name," (",classes.section,")") as class_name'))
                ->leftJoin('classes', 'result.class_id', '=', 'classes.id')
                ->leftJoin('students', 'result.student_id', '=', 'students.student_id')
                ->groupBy('result.student_id')
                // ->get();
                ->paginate(10);

        return $query;
    }

    /**
    * 学生の科目マーク情報を取得する
    * @param student_id
    * @return Array
    */
    public static function getStuSubjectMarks($student_id) {

        $query = DB::table('result')
                ->select('result.id', 'result.student_id', 'result.subject_id', 'result.marks', 'subjects.subject_name')
                ->leftJoin('subjects', 'subjects.id', '=', 'result.subject_id')
                ->where('result.student_id', $student_id)
                ->groupBy('result.subject_id')
                ->get();

        return $query;
    }

    /**
    * 結果情報登録する.
    * @param Array data
    */
    public static function insertResult($data) {

        $insert = DB::table('result')
                    ->insert([
                        'student_id' => $data['student_id'],
                        'class_id' => $data['class_id'],
                        'subject_id' => $data['subject_id'],
                        'marks' => $data['marks'],
                        'valid_flg' => '0',
                        'created_by' => Auth::user()->name,
                        'updated_by' => Auth::user()->name,
                        'created_at' => date('YmdHis'),
                        'updated_at' => date('YmdHis')
                    ]);

        return $insert;
    }

    /**
    * 学生のmark情報を取得する
    */
    public static function getMarkRange() {

        $query = DB::table('result')
                ->select(DB::raw('(round((sum(marks)*100)/(100*count(subject_id))))as percent'))
                ->groupBy('class_id', 'student_id')
                ->get();

        return $query;
    }

    /**
    * 授業と科目のレンジを取得する
    */
    public static function getSubjectClassRange() {

        $query = DB::table('subject_class_relation')
                ->select('subject_class_relation.class_id', 'classes.class_name', DB::raw('count(subject_class_relation.subject_id) as subject_cnt'))
                ->leftJoin('classes', 'classes.id', '=', 'subject_class_relation.class_id', 'classes.valid_flg','=','0')
                ->where('subject_class_relation.valid_flg', 0)
                ->groupBy('subject_class_relation.class_id')
                ->get();

        return $query;
    }
}