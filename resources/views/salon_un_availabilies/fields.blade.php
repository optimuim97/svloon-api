<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datepicker()
    </script>
@endpush

<!-- Hour Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hour_start', 'Hour Start:') !!}
    {!! Form::text('hour_start', null, ['class' => 'form-control']) !!}
</div>

<!-- Hour End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hour_end', 'Hour End:') !!}
    {!! Form::text('hour_end', null, ['class' => 'form-control']) !!}
</div>

<!-- Raison Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('raison', 'Raison:') !!}
    {!! Form::textarea('raison', null, ['class' => 'form-control']) !!}
</div>