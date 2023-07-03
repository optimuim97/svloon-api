<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control','id'=>'time']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#time').datepicker()
    </script>
@endpush

<!-- Salon Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    {!! Form::select('salon_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>