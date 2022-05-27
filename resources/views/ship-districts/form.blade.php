<div class="form-group{{ $errors->has('ship_id') ? 'has-error' : ''}}">
    {!! Form::label('ship_id', 'Ship Id', ['class' => 'control-label']) !!}
    {!! Form::text('ship_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('ship_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('district_id') ? 'has-error' : ''}}">
    {!! Form::label('district_id', 'District Id', ['class' => 'control-label']) !!}
    {!! Form::text('district_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('district_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('cost') ? 'has-error' : ''}}">
    {!! Form::label('cost', 'Cost', ['class' => 'control-label']) !!}
    {!! Form::text('cost', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('cost', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
