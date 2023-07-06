<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', 'Service Id:') !!}
    <p>{{ $quickService->service_id }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $quickService->address }}</p>
</div>

<!-- Lat Field -->
<div class="col-sm-12">
    {!! Form::label('lat', 'Lat:') !!}
    <p>{{ $quickService->lat }}</p>
</div>

<!-- Lon Field -->
<div class="col-sm-12">
    {!! Form::label('lon', 'Lon:') !!}
    <p>{{ $quickService->lon }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $quickService->user_id }}</p>
</div>

<!-- Duration Field -->
<div class="col-sm-12">
    {!! Form::label('duration', 'Duration:') !!}
    <p>{{ $quickService->duration }}</p>
</div>

<!-- Isconfirmed Field -->
<div class="col-sm-12">
    {!! Form::label('isConfirmed', 'Isconfirmed:') !!}
    <p>{{ $quickService->isConfirmed }}</p>
</div>

<!-- Hasalreadysendremeber Field -->
<div class="col-sm-12">
    {!! Form::label('hasAlreadySendRemeber', 'Hasalreadysendremeber:') !!}
    <p>{{ $quickService->hasAlreadySendRemeber }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $quickService->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $quickService->updated_at }}</p>
</div>

