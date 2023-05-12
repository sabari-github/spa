@extends('layouts.app')

@section('content')
<h1 class="">{{ $display['heading'] }}</h1>
<ol class="breadcrumb mb-2">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i>{{ trans('messages.lbl_home') }}</a></li>
    <li class="breadcrumb-item active">{{ $display['heading'] }}</li>
</ol>
<div class="row mb-2">
    <div class="col-sm-12">
        <a href="{{ route('result.add') }}" class="btn btn-outline-success">{{ trans('messages.lbl_register') }}</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-sm table-striped" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Student Name</th>
                <th>Roll No</th>
                <th>Class</th>
                <th>Created at</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $list)
                <tr>
                    <td>{{ $data->firstItem()+$key }}</td>
                    <td class="text-left">
                        <a href="{{ route('result.view', $list->student_id) }}">
                            {{ $list->student_name }}
                        </a>
                    </td>
                    <td>{{ $list->roll_no }}</td>
                    <td>{{ $list->class_name }}</td>
                    <td>{{ $list->created_at }}</td>
                    <td>
                        @if($list->valid_flg == "0")
                            {{ "Active" }}
                        @elseif($list->valid_flg == "1")
                            {{ "Not Active" }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('result.edit', $list->student_id) }}"><i class="fas fas fa-edit mr-1"></i></a>
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