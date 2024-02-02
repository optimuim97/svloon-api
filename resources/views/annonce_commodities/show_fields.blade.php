<!-- Annonce Id Field -->
<div class="col-sm-12">
    {!! Form::label('annonce_id', 'Annonce Id:') !!}
    <p>{{ $annonceCommodities->annonce_id }}</p>
</div>

<!-- Commodity Id Field -->
<div class="col-sm-12">
    {!! Form::label('commodity_id', 'Commodity Id:') !!}
    <p>{{ $annonceCommodities->commodity_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $annonceCommodities->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $annonceCommodities->updated_at }}</p>
</div>

