<!-- Start Day Field -->
<div class="col-sm-12">
    {!! Form::label('start_day', 'Start Day:') !!}
    <p>{{ $salonSchedule->start_day }}</p>
</div>

<!-- End Dat Field -->
<div class="col-sm-12">
    {!! Form::label('end_dat', 'End Dat:') !!}
    <p>{{ $salonSchedule->end_dat }}</p>
</div>

<!-- Start Hour Field -->
<div class="col-sm-12">
    {!! Form::label('start_hour', 'Start Hour:') !!}
    <p>{{ $salonSchedule->start_hour }}</p>
</div>

<!-- End Hour Field -->
<div class="col-sm-12">
    {!! Form::label('end_hour', 'End Hour:') !!}
    <p>{{ $salonSchedule->end_hour }}</p>
</div>

<!-- Pause Start Field -->
<div class="col-sm-12">
    {!! Form::label('pause_start', 'Pause Start:') !!}
    <p>{{ $salonSchedule->pause_start }}</p>
</div>

<!-- Pause End Field -->
<div class="col-sm-12">
    {!! Form::label('pause_end', 'Pause End:') !!}
    <p>{{ $salonSchedule->pause_end }}</p>
</div>

<!-- Is Active Field -->
<div class="col-sm-12">
    {!! Form::label('is_active', 'Is Active:') !!}
    <p>{{ $salonSchedule->is_active }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $salonSchedule->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $salonSchedule->updated_at }}</p>
</div>

