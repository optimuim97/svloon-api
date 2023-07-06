<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', 'Service Id:') !!}
    {!! Form::select('service_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

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

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', 'Duration:') !!}
    {!! Form::text('duration', null, ['class' => 'form-control']) !!}
</div>

<!-- Isconfirmed Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('isConfirmed', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('isConfirmed', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('isConfirmed', 'Isconfirmed', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Hasalreadysendremeber Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('hasAlreadySendRemeber', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('hasAlreadySendRemeber', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('hasAlreadySendRemeber', 'Hasalreadysendremeber', ['class' => 'form-check-label']) !!}
    </div>
</div>