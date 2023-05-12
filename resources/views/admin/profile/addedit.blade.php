@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ul>
<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                    {{ Form::model($data, array('name'=>'formstudent','id'=>'formstudent','files'=>true, 'method' => 'POST','class'=>'form-horizontal','url' => 'admin/profile/doEdit' ) ) }}
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_name') }}</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input id="name" type="text" class="col-md-7 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',  isset($data->name) ? $data->name : null) }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_email') }}</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control col-md-10 @error('email') is-invalid @enderror" name="email" value="{{ old('email',  isset($data->email) ? $data->email : null) }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="default" class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_gender') }}</label><span class="text-danger">&nbsp</span>
                        <div class="col-md-6 mt-2">
                            {{ Form::radio('gender', '0', old('gender',  isset($data->gender) ? $data->gender : null) , array('id' =>'gender','name' => 'gender')) }}
                            &nbsp{{ trans('Male') }}&nbsp
                            {{ Form::radio('gender', '1', old('gender',  isset($data->gender) ? $data->gender : null) , array('id' =>'gender','name' => 'gender')) }}
                            &nbsp{{ trans('Female') }}&nbsp
                            {{ Form::radio('gender', '9', old('gender',  isset($data->gender) ? $data->gender : null) , array('id' =>'gender','name' => 'gender')) }}
                            &nbsp{{ trans('Other') }}&nbsp
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('title', 'DOB', array('for'=>'dob', 'class' => 'col-md-4 col-form-label text-md-right') ) !!}
                        <span class="text-danger">&nbsp</span>
                        <div class="col-md-6">
                            {{ Form::date('dob', old('dob',  isset($data->dob) ? $data->dob : null), array('id' => 'dob','class' => 'form-control col-md-6')) }}
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <center>
                                <button type="button" name="button" class="btn btn-outline-success" onclick="formSubmit('{{ $display['button_act']}}');">{{ $display['button'] }}</button>
                                <button type="button" class="btn btn-outline-dark page-return" data-href="{{ route('home') }}" data-act="Cancel">{{ trans('messages.lbl_cancel') }}</button>
                            </center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection