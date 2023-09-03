<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Prix Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prix', 'Prix:') !!}
    {!! Form::text('prix', null, ['class' => 'form-control']) !!}
</div>

<!-- Ext Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ext_time', 'Ext Time:') !!}
    {!! Form::text('ext_time', null, ['class' => 'form-control']) !!}
</div>