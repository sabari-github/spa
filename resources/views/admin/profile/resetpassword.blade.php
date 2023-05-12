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
                    {{ Form::model($data, array('name'=>'resetpassword','id'=>'resetpassword','files'=>true, 'method' => 'POST','class'=>'form-horizontal','url' => 'admin/doResetPassword' ) ) }}
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-4 text-md-right">{{ trans('messages.lbl_email') }}</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            {{$data->email}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        <span class="text-danger">*</span>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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