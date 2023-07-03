<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Owner Fullname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner_fullname', 'Owner Fullname:') !!}
    {!! Form::text('owner_fullname', null, ['class' => 'form-control']) !!}
</div>

<!-- Dialcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dialCode', 'Dialcode:') !!}
    {!! Form::text('dialCode', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>

<!-- Schedulestart Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scheduleStart', 'Schedulestart:') !!}
    {!! Form::text('scheduleStart', null, ['class' => 'form-control','id'=>'scheduleStart']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#scheduleStart').datepicker()
    </script>
@endpush

<!-- Scheduleend Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scheduleEnd', 'Scheduleend:') !!}
    {!! Form::text('scheduleEnd', null, ['class' => 'form-control','id'=>'scheduleEnd']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#scheduleEnd').datepicker()
    </script>
@endpush

<!-- Schedulestr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('scheduleStr', 'Schedulestr:') !!}
    {!! Form::text('scheduleStr', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Phonenumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phoneNumber', 'Phonenumber:') !!}
    {!! Form::text('phoneNumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Postalcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postalCode', 'Postalcode:') !!}
    {!! Form::text('postalCode', null, ['class' => 'form-control']) !!}
</div>

<!-- Localnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('localNumber', 'Localnumber:') !!}
    {!! Form::text('localNumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Baildocument Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bailDocument', 'Baildocument:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('bailDocument', ['class' => 'custom-file-input']) !!}
            {!! Form::label('bailDocument', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- Salon Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('salon_type_id', 'Salon Type Id:') !!}
    {!! Form::select('salon_type_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>