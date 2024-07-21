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

<!-- Photo Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('photo_url', 'Photo Url:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('photo_url', ['class' => 'custom-file-input']) !!}
            {!! Form::label('photo_url', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>