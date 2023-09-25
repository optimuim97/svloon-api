<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Label:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Imageurl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('imageUrl', 'Imageurl:') !!}
    {!! Form::text('imageUrl', null, ['class' => 'form-control']) !!}
</div>

<!-- Creator Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('creator_name', 'Creator Name:') !!}
    {!! Form::text('creator_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Artist Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    {!! Form::number('artist_id', null, ['class' => 'form-control']) !!}
</div>