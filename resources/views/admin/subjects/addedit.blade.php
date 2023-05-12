@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('subjects.list') }}">{{ trans('messages.lbl_subjects') }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                @if(isset($data))
                    {{ Form::model($data, array('name'=>'formsubjects','id'=>'formsubjects','files'=>true, 'method' => 'POST','class'=>'form-horizontal','url' => 'admin/subjects/doEdit' ) ) }}
                    @php $disable = "disabled" @endphp
                    {{ Form::hidden('id', old('id',  isset($dataedit->id) ? $dataedit->id : null) , array('id' => 'id')) }}
                @else
                    {{ Form::open(array('name'=>'formsubjects', 'id'=>'formsubjects', 
                                    'class' => 'form-horizontal',
                                    'files'=>true,
                                    'url' => 'admin/subjects/doAdd', 
                                    'method' => 'POST')) }}
                    @php $disable = "" @endphp
                @endif
                @csrf
                <div class="form-group row">
                    {!! Form::label('title', trans('messages.lbl_subject_name'), array('for'=>'subject_name', 'class' => 'col-md-4 col-form-label text-md-right') ) !!}
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <input id="subject_name" type="text" class="form-control col-md-8 @error('subject_name') is-invalid @enderror" name="subject_name" value="{{ old('subject_name',  isset($data->subject_name) ? $data->subject_name : null) }}"  autocomplete="subject_name" autofocus>
                        @error('subject_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('title', trans('messages.lbl_subject_code'), array('for'=>'subject_code', 'class' => 'col-md-4 col-form-label text-md-right') ) !!}
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <input id="subject_code" type="text" class="form-control col-md-8 @error('subject_code') is-invalid @enderror" name="subject_code" value="{{ old('subject_code',  isset($data->subject_code) ? $data->subject_code : null) }}"  autocomplete="subject_code" autofocus>

                        @error('subject_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- 編集の場合 -->
                @if(isset($data))
                <div class="form-group row">
                    {!! Form::label('title', trans('messages.lbl_status'), array('for'=>'status', 'class' => 'col-md-4 col-form-label text-md-right') ) !!}
                    <span class="text-danger">&nbsp</span>
                    <div class="col-md-6 mt-2">
                        <label class="clr_black">{{ Form::radio('valid_flg', '0', old('valid_flg',  isset($dataedit->valid_flg) ? $dataedit->valid_flg : null) , array('id' =>'valid_flg','name' => 'valid_flg')) }}
                        &nbsp{{ trans('messages.lbl_use') }}</label>&nbsp
                        <label class="clr_black">{{ Form::radio('valid_flg', '1', old('valid_flg',  isset($dataedit->valid_flg) ? $dataedit->valid_flg : null) , array('id' =>'valid_flg','name' => 'valid_flg')) }}
                        &nbsp{{ trans('messages.lbl_not_use') }}</label>
                    </div>
                </div>
                @endif
                <hr>
                <div class="form-group row">
                    <div class="col-md-12">
                        <center>
                            <button type="button" name="button" class="btn btn-outline-success" onclick="formSubmit('{{ $display['button_act']}}');">{{ $display['button'] }}</button>
                            <button type="button" class="btn btn-outline-dark page-return" data-href="{{ route('subjects.list') }}" data-act="Cancel">{{ trans('messages.lbl_cancel') }}</button>
                        </center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection