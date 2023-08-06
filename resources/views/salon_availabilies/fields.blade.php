<!-- Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datepicker()
    </script>
@endpush

<!-- Hour Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hour_start', 'Hour Start:') !!}
    {!! Form::time('hour_start', null, ['class' => 'form-control']) !!}
</div>

<!-- Hour End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hour_end', 'Hour End:') !!}
    {!! Form::time('hour_end', null, ['class' => 'form-control']) !!}
</div>

<!-- Break Start Field -->
<div class="form-group col-sm-6">
    {!! Form::label('break_start', 'Break Start:') !!}
    {!! Form::time('break_start', null, ['class' => 'form-control']) !!}
</div>

<!-- Break End Field -->
<div class="form-group col-sm-6">
    {!! Form::label('break_end', 'Break End:') !!}
    {!! Form::time('break_end', null, ['class' => 'form-control']) !!}
</div>