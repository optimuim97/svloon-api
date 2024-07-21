<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Label:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
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