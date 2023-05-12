@extends('layouts.app')

@section('content')
<h1>{{ $display['heading'] }}</h1>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item">{{ trans('messages.lbl_subjects') }}</li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ol>
<div class="row mb-2">
    <div class="col-sm-12">
        <a href="{{ route('subjects.subjectrelationAdd') }}" class="btn btn-outline-success">{{ trans('messages.lbl_register') }}</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-sm table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>{{ trans('messages.lbl_sno') }}</th>
                <th>{{ trans('messages.lbl_subject') }}</th>
                <th>{{ trans('messages.lbl_class') }}</th>
                <th>{{ trans('messages.lbl_status') }}</th>
                <th>{{ trans('messages.lbl_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $list)
                <tr>
                    <td>{{ $data->firstItem()+$key }}</td>
                    <td class="text-left">{{ $list->subject_name }}</td>
                    <td>{{ $list->class_section }}</td>
                    <td>
                        @if($list->valid_flg == "0")
                            <span class="text-success">{{ "Active" }}</span>
                        @elseif($list->valid_flg == "1")
                            <span class="text-danger">{{ "Not Active" }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('subjects.subjectClassRelEdit', $list->id) }}">
                            <i class="fas fas fa-edit mr-1"></i></a>&nbsp|&nbsp
                            @if($list->valid_flg == '0')
                                <a href="{{ route('subjects.subjectClassRelDoDel', [$list->id, 1]) }}">{{ "Not Use" }}</a>
                            @elseif($list->valid_flg == '1')
                                <a href="{{ route('subjects.subjectClassRelDoDel', [$list->id, 0]) }}">{{ "Use" }}</a>
                            @endif
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row col-sm-12">
    <div class="col-form-label">
        @if(!empty($data->total()))
            {{ $data->firstItem() }} ~ {{ $data->lastItem() }} / {{ $data->total() }}
        @endif
    </div>
    <div class="ml-2">
        {{ $data->links() }}
    </div>
</div>
@endsection