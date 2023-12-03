<!-- Salon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    {!! Form::number('salon_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Artist Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    {!! Form::number('artist_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
</div>

<!-- Instructions Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('instructions', 'Instructions:') !!}
    {!! Form::textarea('instructions', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_price', 'Total Price:') !!}
    {!! Form::text('total_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control']) !!}
</div>