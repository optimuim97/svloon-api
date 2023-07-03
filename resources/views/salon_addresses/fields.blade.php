<!-- Lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', 'Lat:') !!}
    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
</div>

<!-- Lon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lon', 'Lon:') !!}
    {!! Form::text('lon', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address_name', 'Address Name:') !!}
    {!! Form::text('address_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Salon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    {!! Form::select('salon_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>