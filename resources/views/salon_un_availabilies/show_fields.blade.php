<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $salonUnAvailabily->date }}</p>
</div>

<!-- Hour Start Field -->
<div class="col-sm-12">
    {!! Form::label('hour_start', 'Hour Start:') !!}
    <p>{{ $salonUnAvailabily->hour_start }}</p>
</div>

<!-- Hour End Field -->
<div class="col-sm-12">
    {!! Form::label('hour_end', 'Hour End:') !!}
    <p>{{ $salonUnAvailabily->hour_end }}</p>
</div>

<!-- Raison Field -->
<div class="col-sm-12">
    {!! Form::label('raison', 'Raison:') !!}
    <p>{{ $salonUnAvailabily->raison }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $salonUnAvailabily->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $salonUnAvailabily->updated_at }}</p>
</div>

