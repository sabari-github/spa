@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item">{{ trans('messages.lbl_subject') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('subjects.subjectrelationlist') }}">{{ 'Subject Class Relation List' }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                @if(isset($data))
                    {{ Form::model($data, array('name'=>'formsubjects','id'=>'formsubjects','files'=>true, 'method' => 'POST','class'=>'form-horizontal','url' => 'admin/subjects/subjectrelationDoEdit' ) ) }}
                    {{ Form::hidden('id', old('id',  isset($data->id) ? $data->id : null) , array('id' => 'id')) }}
                @else
                    {{ Form::open(array('name'=>'formsubjects', 'id'=>'formsubjects', 
                                    'class' => 'form-horizontal',
                                    'files'=>true,
                                    'url' => 'admin/subjects/subjectrelationDoAdd', 
                                    'method' => 'POST')) }}
                @endif
                    @csrf
                <div class="form-group row">
                    <label for="class_id" class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_class') }}</label>
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <select name="class_id" id="class_id" class="input-sm col-md-6 form-control @error('class_id') is-invalid @enderror">
                            @foreach($classlist as $key => $class_name)
                            @php $class_id = old('class_id',  isset($data->class_id) ? $data->class_id : null);@endphp
                            <option value="{{$key}}" @php if($class_id == $key){@endphp selected="selected" @php } @endphp>
                                {{$class_name}}
                            </option>
                            @endforeach
                        </select>
                        @error('class_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_subject') }}</label>
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <select name="subject_id" id="subject_id" class="input-sm col-md-6 form-control @error('subject_id') is-invalid @enderror">
                            @foreach($subjectlist as $key => $subject_name)
                            @php $subject_id = old('subject_id',  isset($data->subject_id) ? $data->subject_id : null);@endphp
                            <option value="{{$key}}" @php if($subject_id == $key){@endphp selected="selected" @php } @endphp>
                                {{$subject_name}}
                            </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- 編集の場合 -->
                @if(isset($data))
                <div class="form-group row">
                    {!! Form::label('title', 'Status', array('for'=>'status', 'class' => 'col-md-4 col-form-label text-md-right') ) !!}
                    <span class="text-danger">&nbsp</span>
                    <div class="col-md-6 mt-2">
                        {{ Form::radio('valid_flg', '0', old('valid_flg',  isset($data->valid_flg) ? $data->valid_flg : null) , array('id' =>'valid_flg','name' => 'valid_flg')) }}
                        &nbsp{{ trans('Use') }}&nbsp
                        {{ Form::radio('valid_flg', '1', old('valid_flg',  isset($data->valid_flg) ? $data->valid_flg : null) , array('id' =>'valid_flg','name' => 'valid_flg')) }}
                        &nbsp{{ trans('Not Use') }}&nbsp

                    </div>
                </div>
                @endif
                <hr>
                <div class="form-group row">
                    <div class="col-md-12">
                        <center>
                            <button type="button" name="button" class="btn btn-outline-success" onclick="formSubmit('{{ $display['button_act']}}');">{{ $display['button'] }}</button>
                            <button type="button" class="btn btn-outline-dark page-return" data-href="{{ route('subjects.subjectrelationlist') }}" data-act="Cancel">{{ trans('messages.lbl_cancel') }}</button>
                        </center>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection