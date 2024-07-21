<!-- Address Name Field -->
<div class="col-sm-12">
    {!! Form::label('address_name', 'Address Name:') !!}
    <p>{{ $artistAddress->address_name }}</p>
</div>

<!-- Lat Field -->
<div class="col-sm-12">
    {!! Form::label('lat', 'Lat:') !!}
    <p>{{ $artistAddress->lat }}</p>
</div>

<!-- Lon Field -->
<div class="col-sm-12">
    {!! Form::label('lon', 'Lon:') !!}
    <p>{{ $artistAddress->lon }}</p>
</div>

<!-- Artist Id Field -->
<div class="col-sm-12">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    <p>{{ $artistAddress->artist_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $artistAddress->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $artistAddress->updated_at }}</p>
</div>

