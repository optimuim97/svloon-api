<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Label:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Icone Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('icone', 'Icone:') !!}
    {!! Form::file('icone', null, ['class' => 'form-control']) !!}
</div>
