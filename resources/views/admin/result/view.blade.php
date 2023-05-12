@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('result.list') }}">{{ 'Result List' }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ol>
<div class="row mb-2">
    <div class="col-sm-12 float-left">
        <a href="{{ route('result.list') }}" class="btn btn-outline-dark"><i class="fas fas fa-arrow-left mr-1"></i>{{ trans('messages.lbl_back') }}</a>
        <a href="{{ route('result.edit',$data->student_id) }}" class="btn btn-outline-success"><i class="fas fas fa-edit mr-1"></i>{{ trans('messages.lbl_edit') }}</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label for="student_name" class="col-md-4 text-md-right">{{ trans('messages.lbl_name') }}</label>
            <div class="col-md-6">
                {{ isset($data->student_name) ? $data->student_name : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_roll_no') }}</label>
            <div class="col-md-6">
                {{ isset($data->roll_no) ? $data->roll_no : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_class') }}</label>
            <div class="col-md-6">
                {{ isset($data->class_id) ? $data->class_name." (".$data->section.")" : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_dob') }}</label>
            <div class="col-md-6">
                {{ isset($data->dob) ? $data->dob : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_gender') }}</label>
            <div class="col-md-6">
                @if(isset($data->gender) && $data->gender == '0')
                    {{ "Male" }}
                @elseif(isset($data->gender) && $data->gender == '1')
                    {{ "Female" }}
                @else
                    {{ "Others" }}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_email') }}</label>
            <div class="col-md-6">
                {{ isset($data->student_email) ? $data->student_email : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_status') }}</label>
            <div class="col-md-6">
                @if(isset($data->valid_flg) && $data->valid_flg == '0')
                    {{ "Active" }}
                @elseif(isset($data->valid_flg) && $data->valid_flg == '1')
                    {{ "Deactive" }}
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_creation_date') }}</label>
            <div class="col-md-6">
                {{$data->created_at}}
            </div>
        </div>
    </div>
</div>
@endsection