<div class="form-group{{ $errors->has('activity') ? 'has-error' : ''}}">
    {!! Form::label('activity', 'Activity', ['class' => 'control-label']) !!}
    {!! Form::text('activity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('activity', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('facebook') ? 'has-error' : ''}}">
    {!! Form::label('facebook', 'Facebook', ['class' => 'control-label']) !!}
    {!! Form::text('facebook', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('instagram') ? 'has-error' : ''}}">
    {!! Form::label('instagram', 'Instagram', ['class' => 'control-label']) !!}
    {!! Form::text('instagram', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('instagram', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('souq') ? 'has-error' : ''}}">
    {!! Form::label('souq', 'Souq', ['class' => 'control-label']) !!}
    {!! Form::text('souq', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('souq', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('twitter') ? 'has-error' : ''}}">
    {!! Form::label('twitter', 'Twitter', ['class' => 'control-label']) !!}
    {!! Form::text('twitter', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('country') ? 'has-error' : ''}}">
    {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
    {!! Form::text('country', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('range') ? 'has-error' : ''}}">
    {!! Form::label('range', 'Range', ['class' => 'control-label']) !!}
    {!! Form::text('range', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('range', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('company') ? 'has-error' : ''}}">
    {!! Form::label('company', 'Company', ['class' => 'control-label']) !!}
    {!! Form::text('company', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Phone', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
