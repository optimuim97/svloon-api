<!-- Salon Id Field -->
<div class="col-sm-12">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    <p>{{ $servicesSalon->salon_id }}</p>
</div>

<!-- Service Id Field -->
<div class="col-sm-12">
    {!! Form::label('service_id', 'Service Id:') !!}
    <p>{{ $servicesSalon->service_id }}</p>
</div>

<!-- Isactive Field -->
<div class="col-sm-12">
    {!! Form::label('isActive', 'Isactive:') !!}
    <p>{{ $servicesSalon->isActive }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $servicesSalon->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $servicesSalon->updated_at }}</p>
</div>

