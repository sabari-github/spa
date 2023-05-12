<hr>
<div class="form-group row">
    <div class="col-md-12">
        <center>
            <button type="button" name="button" class="btn btn-success" onclick="formSubmit('{{ $display['button']}}');">{{ $display['button'] }}</button>
            <button type="button" class="btn btn-default page-return" data-href="{{ route('subjects.list') }}" data-act="Cancel">{{ trans('messages.lbl_cancel') }}</button>
        </center>
    </div>
</div>