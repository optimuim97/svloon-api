<!-- Start Day Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_day', 'Start Day:') !!}
    {!! Form::date('start_day', null, ['class' => 'form-control']) !!}
</div>

<!-- End Dat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_dat', 'End Dat:') !!}
    {!! Form::date('end_dat', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Hour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_hour', 'Start Hour:') !!}
    {!! Form::time('start_hour', null, ['class' => 'form-control']) !!}
</div>

<!-- End Hour Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_hour', 'End Hour:') !!}
    {!! Form::time('end_hour', null, ['class' => 'form-control']) !!}
</div>

<!-- Pause Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pause_start', 'Pause Start:') !!}
    {!! Form::time('pause_start', null, ['class' => 'form-control']) !!}
</div>

<!-- Pause End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pause_end', 'Pause End:') !!}
    {!! Form::time('pause_end', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_active', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_active', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_active', 'Is Active', ['class' => 'form-check-label']) !!}
    </div>
</div>