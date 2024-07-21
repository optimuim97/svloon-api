<!-- Lat Field -->
<div class="col-sm-12">
    {!! Form::label('lat', 'Lat:') !!}
    <p>{{ $userAddress->lat }}</p>
</div>

<!-- Lon Field -->
<div class="col-sm-12">
    {!! Form::label('lon', 'Lon:') !!}
    <p>{{ $userAddress->lon }}</p>
</div>

<!-- Address Name Field -->
<div class="col-sm-12">
    {!! Form::label('address_name', 'Address Name:') !!}
    <p>{{ $userAddress->address_name }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userAddress->user_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userAddress->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userAddress->updated_at }}</p>
</div>

