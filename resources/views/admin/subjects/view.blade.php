@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('subjects.list') }}">{{ trans('messages.lbl_subjects') }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ol>
<div class="row mb-2">
    <div class="col-md-12 float-left">
        <a href="{{ route('subjects.list') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left mr-1"></i>{{ trans('messages.lbl_back') }}</a>
        <a href="{{ route('subjects.edit',$data->id) }}" class="btn btn-outline-success"><i class="fas fas fa-edit mr-1"></i>{{ trans('messages.lbl_edit') }}</a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_subject_name') }}</label>
            <div class="col-md-6">
                {{ isset($data->subject_name) ? $data->subject_name : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_subject_code') }}</label>
            <div class="col-md-6">
                {{ isset($data->subject_code) ? $data->subject_code : null }}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_creation_date') }}</label>
            <div class="col-md-6">
                {{$data->created_at}}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">{{ trans('messages.lbl_updated_date') }}</label>
            <div class="col-md-6">
                {{$data->updated_at}}
            </div>
        </div>
    </div>
</div>
@endsection