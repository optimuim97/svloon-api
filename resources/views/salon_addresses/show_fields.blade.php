<!-- Lat Field -->
<div class="col-sm-12">
    {!! Form::label('lat', 'Lat:') !!}
    <p>{{ $salonAddress->lat }}</p>
</div>

<!-- Lon Field -->
<div class="col-sm-12">
    {!! Form::label('lon', 'Lon:') !!}
    <p>{{ $salonAddress->lon }}</p>
</div>

<!-- Address Name Field -->
<div class="col-sm-12">
    {!! Form::label('address_name', 'Address Name:') !!}
    <p>{{ $salonAddress->address_name }}</p>
</div>

<!-- Salon Id Field -->
<div class="col-sm-12">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    <p>{{ $salonAddress->salon_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $salonAddress->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $salonAddress->updated_at }}</p>
</div>

