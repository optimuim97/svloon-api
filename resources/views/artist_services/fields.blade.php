<!-- Artist Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    {!! Form::number('artist_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', 'Service Id:') !!}
    {!! Form::number('service_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_active', 'Is Active:') !!}
    {!! Form::number('is_active', null, ['class' => 'form-control']) !!}
</div>