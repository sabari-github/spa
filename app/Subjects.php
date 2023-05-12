<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subjects extends Model {

    protected $table = 'subjects';

    protected $fillable = [
        // 'id',
        'subject_name',
        'subject_code',
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
    *
    * @return Array
    */
    public static function getSubjectsList() {

        $query = DB::table('subjects')
                ->select(DB::raw('concat (subject_name," ( ",subject_code, " )") as subject_name, id'))
                ->where('valid_flg',0)
                ->orderBy('subject_name','ASC')
                ->pluck('subject_name', 'id');
        
        return $query;
    }
}