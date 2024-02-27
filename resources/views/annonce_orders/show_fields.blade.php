<!-- Annonce Id Field -->
<div class="col-sm-12">
    {!! Form::label('annonce_id', 'Annonce Id:') !!}
    <p>{{ $annonceOrder->annonce_id }}</p>
</div>

<!-- Order Status Id Field -->
<div class="col-sm-12">
    {!! Form::label('order_status_id', 'Order Status Id:') !!}
    <p>{{ $annonceOrder->order_status_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $annonceOrder->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $annonceOrder->updated_at }}</p>
</div>

