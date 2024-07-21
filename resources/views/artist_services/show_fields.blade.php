<!-- Artist Id Field -->
<div class="col-sm-12">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    <p>{{ $artistService->artist_id }}</p>
</div>

<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', 'Service Id:') !!}
    <p>{{ $artistService->service_id }}</p>
</div>

<!-- Is Active Field -->
<div class="col-sm-12">
    {!! Form::label('is_active', 'Is Active:') !!}
    <p>{{ $artistService->is_active }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $artistService->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $artistService->updated_at }}</p>
</div>

