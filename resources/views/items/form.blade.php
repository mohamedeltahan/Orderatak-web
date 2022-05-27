<div class="form-group{{ $errors->has('name_id') ? 'has-error' : ''}}">
    {!! Form::label('name_id', 'Name Id', ['class' => 'control-label']) !!}
    {!! Form::number('name_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('quantity') ? 'has-error' : ''}}">
    {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
    {!! Form::number('quantity', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('size') ? 'has-error' : ''}}">
    {!! Form::label('size', 'Size', ['class' => 'control-label']) !!}
    {!! Form::text('size', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('size', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('buying_price') ? 'has-error' : ''}}">
    {!! Form::label('buying_price', 'Buying Price', ['class' => 'control-label']) !!}
    {!! Form::number('buying_price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('buying_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('selling_price') ? 'has-error' : ''}}">
    {!! Form::label('selling_price', 'Selling Price', ['class' => 'control-label']) !!}
    {!! Form::number('selling_price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('selling_price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('store_id') ? 'has-error' : ''}}">
    {!! Form::label('store_id', 'Store Id', ['class' => 'control-label']) !!}
    {!! Form::number('store_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('store_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('alert_id') ? 'has-error' : ''}}">
    {!! Form::label('alert_id', 'Alert Id', ['class' => 'control-label']) !!}
    {!! Form::text('alert_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('alert_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('discount') ? 'has-error' : ''}}">
    {!! Form::label('discount', 'Discount', ['class' => 'control-label']) !!}
    {!! Form::number('discount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
