<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Titre :') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('price', 'Prix:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('service_type_id', 'Type de Service :') !!}
    {!! Form::select('service_type_id', $serviceType, null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Imageurl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imageUrl', 'Image (url):') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('imageUrl', ['class' => 'custom-file-input']) !!}
            {!! Form::label('imageUrl', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- Ispromo Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('isPromo', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('isPromo', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('isPromo', 'Ispromo', ['class' => 'form-check-label']) !!}
    </div>
</div>
