@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('classes.list') }}">{{ trans('messages.lbl_classes') }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                @if(isset($data))
                    {{ Form::model($data, array('name'=>'formclasses','id'=>'formclasses','files'=>true, 'method' => 'POST','class'=>'form-horizontal','url' => 'admin/classes/doEdit' ) ) }}
                    @php $disable = "disabled" @endphp
                    {{ Form::hidden('id', $data->id , array('id' => 'student_id')) }}
                @else
                    {{ Form::open(array('name'=>'formclasses', 'id'=>'formclasses', 
                                    'class' => 'form-horizontal',
                                    'files'=>true,
                                    'url' => 'admin/classes/doAdd',
                                    'method' => 'POST')) }}
                    @php $disable = "" @endphp
                @endif
                @csrf
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_class_name') }}
                    </label><span class="text-danger">*</span>
                    <div class="col-md-6">
                        <input id="class_name" type="text" class="form-control col-md-8 @error('class_name') is-invalid @enderror" name="class_name" value="{{ old('class_name',  isset($data->class_name) ? $data->class_name : null) }}" required autocomplete="class_name" autofocus placeholder="Eg- Third, Fouth,Sixth etc" maxlength="80">

                        @error('class_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_class_in_numeric') }}</label><span class="text-danger">*</span>
                    <div class="col-md-6">
                        <input id="class_name_numeric" type="number" class="form-control col-md-3 @error('class_name_numeric') is-invalid @enderror" name="class_name_numeric" value="{{ old('class_name_numeric',  isset($data->class_name_numeric) ? $data->class_name_numeric : null) }}" required autocomplete="class_name_numeric" maxlength="2" autofocus placeholder="Eg- 1,2,3 etc">
                        @error('class_name_numeric')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_section') }}</label>
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <input id="section" type="text" class="form-control col-md-10 @error('section') is-invalid @enderror" name="section" value="{{ old('section',  isset($data->section) ? $data->section : null) }}" required autocomplete="section" autofocus placeholder="Eg- A,B,C etc" maxlength="5">
                        @error('section')
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
                            <button type="button" class="btn btn-outline-dark page-return" data-href="{{ route('classes.list') }}" data-act="Cancel">{{ trans('messages.lbl_cancel') }}</button>
                        </center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection