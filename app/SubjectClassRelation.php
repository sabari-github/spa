<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubjectClassRelation extends Model {

    protected $table = 'subject_class_relation';

    protected $fillable = [
        // 'id',
        'class_id',
        'subject_id',
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
    * 科目リスト情報を取得する.
    */
    public static function getSubjectClassDetails() {

        $query = DB::table('subject_class_relation')
                ->select('subjects.subject_name','subject_class_relation.id', 'subject_class_relation.valid_flg', 
                    DB::raw('concat (classes.class_name," - ",classes.section) as class_section'))
                ->leftJoin('classes', 'classes.id', '=', 'subject_class_relation.class_id')
                ->leftJoin('subjects', 'subjects.id', '=', 'subject_class_relation.subject_id')
                ->paginate(10);
        return $query;
    }

    /**
    * 授業に関連する科目情報を取得する
    * @return Data Array
    */
    public static function getClassSubjectDetails($class_id) {

        $query = DB::table('subject_class_relation')
                ->select('subjects.subject_name', 'subjects.id')
                ->leftJoin('subjects', 'subjects.id', '=', 'subject_class_relation.subject_id')
                ->where('class_id', $class_id)
                ->where('subject_class_relation.valid_flg', 0)
                ->get();
        return $query;
    }
}