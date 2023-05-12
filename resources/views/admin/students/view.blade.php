@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('students.list') }}">{{ trans('messages.lbl_students') }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ol>
<div class="row mb-2">
    <div class="col-md-12 float-left">
        <a href="{{ route('students.list') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left mr-1"></i>{{ trans('messages.lbl_back') }}</a>
        <a href="{{ route('students.edit',$dataedit->student_id) }}" class="btn btn-outline-success"><i class="fas fas fa-edit mr-1"></i>{{ trans('messages.lbl_edit') }}</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label for="student_name" class="col-md-4 text-md-right">{{ trans('messages.lbl_name') }}</label>
            <div class="col-md-6">
                {{ isset($dataedit->student_name) ? $dataedit->student_name : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_roll_no') }}</label>
            <div class="col-md-6">
                {{ isset($dataedit->roll_no) ? $dataedit->roll_no : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_class') }}</label>
            <div class="col-md-6">
                {{ isset($dataedit->class_id) ? $classlist[$dataedit->class_id] : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_dob') }}</label>
            <div class="col-md-6">
                {{ isset($dataedit->dob) ? $dataedit->dob : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_gender') }}</label>
            <div class="col-md-6">
                @if(isset($dataedit->gender) && $dataedit->gender == '0')
                    {{ "Male" }}
                @elseif(isset($dataedit->gender) && $dataedit->gender == '1')
                    {{ "Female" }}
                @else
                    {{ "Others" }}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_email') }}</label>
            <div class="col-md-6">
                {{ isset($dataedit->student_email) ? $dataedit->student_email : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_status') }}</label>
            <div class="col-md-6">
                @if(isset($dataedit->valid_flg) && $dataedit->valid_flg == '0')
                    {{ "Active" }}
                @elseif(isset($dataedit->valid_flg) && $dataedit->valid_flg == '1')
                    {{ "Deactive" }}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_creation_date') }}</label>
            <div class="col-md-6">
                {{$dataedit->created_at}}
            </div>
        </div>
    </div>
</div>
@endsection