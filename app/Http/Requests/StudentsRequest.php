<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StudentsRequest extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
    public function authorize()
    {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules(Request $request)
    {
        return [
            'student_name' => 'required',
            'roll_no' => 'required|numeric|unique:students',
            'class_id' => 'required|numeric'
        ];
    }
}