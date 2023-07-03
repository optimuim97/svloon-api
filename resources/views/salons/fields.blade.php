<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Imageurl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imageUrl', 'Imageurl:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('imageUrl', ['class' => 'custom-file-input']) !!}
            {!! Form::label('imageUrl', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- Aboutus Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('aboutUs', 'Aboutus:') !!}
    {!! Form::textarea('aboutUs', null, ['class' => 'form-control']) !!}
</div>

<!-- Schedule Field -->
<div class="form-group col-sm-6">
    {!! Form::label('schedule', 'Schedule:') !!}
    {!! Form::text('schedule', null, ['class' => 'form-control']) !!}
</div>

<!-- Schedule Field -->
<div class="form-group col-sm-6">
    {!! Form::label('schedule', 'Schedule:') !!}
    {!! Form::text('schedule', null, ['class' => 'form-control','id'=>'schedule']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#schedule').datepicker()
    </script>
@endpush

<!-- Schedule Field -->
<div class="form-group col-sm-6">
    {!! Form::label('schedule', 'Schedule:') !!}
    {!! Form::text('schedule', null, ['class' => 'form-control','id'=>'schedule']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#schedule').datepicker()
    </script>
@endpush

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::select('user_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>