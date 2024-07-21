<!-- Salon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    {!! Form::select('salon_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', 'Service Id:') !!}
    {!! Form::select('service_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Isactive Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('isActive', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('isActive', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('isActive', 'Isactive', ['class' => 'form-check-label']) !!}
    </div>
</div>