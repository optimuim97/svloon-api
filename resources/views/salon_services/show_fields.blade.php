<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $salonService->name }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $salonService->price }}</p>
</div>

<!-- Time Field -->
<div class="col-sm-12">
    {!! Form::label('time', 'Time:') !!}
    <p>{{ $salonService->time }}</p>
</div>

<!-- Salon Id Field -->
<div class="col-sm-12">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    <p>{{ $salonService->salon_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $salonService->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $salonService->updated_at }}</p>
</div>

