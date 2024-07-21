<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Label:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Avantages Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('avantages', 'Avantages:') !!}
    {!! Form::textarea('avantages', null, ['class' => 'form-control']) !!}
</div>