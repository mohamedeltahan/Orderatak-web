<div class="form-group{{ $errors->has('receipt_id') ? 'has-error' : ''}}">
    {!! Form::label('receipt_id', 'Receipt Id', ['class' => 'control-label']) !!}
    {!! Form::number('receipt_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('receipt_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('paid') ? 'has-error' : ''}}">
    {!! Form::label('paid', 'Paid', ['class' => 'control-label']) !!}
    {!! Form::number('paid', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('paid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('paid_at') ? 'has-error' : ''}}">
    {!! Form::label('paid_at', 'Paid At', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'paid_at', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('paid_at', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('details') ? 'has-error' : ''}}">
    {!! Form::label('details', 'Details', ['class' => 'control-label']) !!}
    {!! Form::text('details', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('export_id') ? 'has-error' : ''}}">
    {!! Form::label('export_id', 'Export Id', ['class' => 'control-label']) !!}
    {!! Form::number('export_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('export_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'control-label']) !!}
    {!! Form::number('user_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('method') ? 'has-error' : ''}}">
    {!! Form::label('method', 'Method', ['class' => 'control-label']) !!}
    {!! Form::text('method', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('method', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
