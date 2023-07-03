<!-- Salon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    {!! Form::select('salon_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Path Field -->
<div class="form-group col-sm-6">
    {!! Form::label('path', 'Path:') !!}
    {!! Form::text('path', null, ['class' => 'form-control']) !!}
</div>

<!-- Original Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('original_name', 'Original Name:') !!}
    {!! Form::text('original_name', null, ['class' => 'form-control']) !!}
</div>