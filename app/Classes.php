<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model {

    protected $table = 'classes';

    protected $fillable = [
        // 'id',
        'class_name',
        'class_name_numeric',
        'section',
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
    * 授業リスト情報を取得する.
    */
    public static function getClassList() {

        $query = DB::table('classes')
                ->select(DB::raw('concat (class_name," - ",section, " Section") as class_name, id'))
                ->where('valid_flg', 0)
                ->orderBy('class_name','ASC')
                ->pluck('class_name', 'id');

        return $query;
    }
}