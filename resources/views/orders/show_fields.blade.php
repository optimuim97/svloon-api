<!-- Salon Id Field -->
<div class="col-sm-12">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    <p>{{ $order->salon_id }}</p>
</div>

<!-- Artist Id Field -->
<div class="col-sm-12">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    <p>{{ $order->artist_id }}</p>
</div>

<!-- Details Field -->
<div class="col-sm-12">
    {!! Form::label('details', 'Details:') !!}
    <p>{{ $order->details }}</p>
</div>

<!-- Instructions Field -->
<div class="col-sm-12">
    {!! Form::label('instructions', 'Instructions:') !!}
    <p>{{ $order->instructions }}</p>
</div>

<!-- Total Price Field -->
<div class="col-sm-12">
    {!! Form::label('total_price', 'Total Price:') !!}
    <p>{{ $order->total_price }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $order->date }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $order->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $order->updated_at }}</p>
</div>

