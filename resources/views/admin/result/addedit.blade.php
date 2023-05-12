@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ asset('resources/assets/js/result.js') }}"></script>
<h1>{{ $display['heading'] }}</h1>
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('result.list') }}">{{ 'Result' }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ul>
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                @if(isset($data))
                    {{ Form::model($data, array('name'=>'formstudent','id'=>'formstudent','files'=>true, 'method' => 'POST','class'=>'form-horizontal','url' => 'admin/result/doEdit' ) ) }}
                    @php $disableInput = "disable-input" @endphp
                    {{ Form::hidden('student_id', $data->student_id) }}
                @else
                    {{ Form::open(array('name'=>'formstudent', 'id'=>'formstudent', 
                                    'class' => 'form-horizontal',
                                    'files'=>true,
                                    'url' => 'admin/result/doAdd', 
                                    'method' => 'POST')) }}
                    @php $disableInput = "" @endphp
                @endif
                @csrf

                @if(isset($data))
                <!-- 更新の場合は -->
                <div class="form-group row">
                    <label class="col-md-4  text-md-right">{{ trans('messages.lbl_class') }}</label>
                    <div class="col-md-6">
                        {{$data->class_name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4  text-md-right">{{ __('Student Name') }}</label>
                    <div class="col-md-6">
                        {{$data->student_name}}
                    </div>
                </div>
                @else
                <!-- 登録の場合は -->
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">{{ trans('messages.lbl_class') }}</label>
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <select name="class_id" id="class_id" class="{{$disableInput}} input-sm col-md-6 form-control @error('class_id') is-invalid @enderror onchange-class">
                            @foreach($classlist as $key => $subject_name)
                            @php $class_id = old('class_id',  isset($data->class_id) ? $data->class_id : null);@endphp
                            <option value="{{$key}}" @php if($class_id == $key){@endphp selected="selected" @php } @endphp>
                                {{$subject_name}}
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
                    <label class="col-md-4 col-form-label text-md-right">{{ __('Student Name') }}</label>
                    <span class="text-danger">*</span>
                    <div class="col-md-6">
                        <select name="student_id" id="student_id" class="{{$disableInput}} input-sm col-md-6 form-control @error('student_id') is-invalid @enderror onchange-class">
                            <option></option>
                        </select>
                        @error('student_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div id="placeSubject"></div>
                @endif
                <!-- 更新の場合 -->
                @if(isset($subList))
                    @foreach($subList as $key => $list)
                        <div class="form-group row">
                            {!! Form::label('title', $list->subject_name, array('class' => 'col-md-4 col-form-label text-md-right') ) !!}
                            <div class="col-md-6">
                                <input name="marks[{{$list->id}}]" type="number" class="form-control col-md-8 @error('marks') is-invalid @enderror" value="{{ old('marks',  isset($list->marks) ? $list->marks : null) }}"  autocomplete="marks" placeholder="Enter The Marks out of 100" autofocus onkeydown="return event.keyCode !== 69"  min="0.01" step="0.01" pattern="\d+">
                                @error('marks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                @endif
                <hr>
                <div class="form-group row">
                    <div class="col-md-12">
                        <center>
                            <button type="button" name="button" class="btn btn-outline-success" onclick="formSubmit('{{ $display['button_act']}}');">{{ $display['button'] }}</button>
                            <button type="button" class="btn btn-outline-dark page-return" data-href="{{ route('result.list') }}" data-act="Cancel">{{ trans('messages.lbl_cancel') }}</button>
                        </center>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</div>
@endsection