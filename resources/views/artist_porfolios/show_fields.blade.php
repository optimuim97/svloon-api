<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $artistPorfolio->label }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $artistPorfolio->description }}</p>
</div>

<!-- Imageurl Field -->
<div class="col-sm-12">
    {!! Form::label('imageUrl', 'Imageurl:') !!}
    <p>{{ $artistPorfolio->imageUrl }}</p>
</div>

<!-- Creator Name Field -->
<div class="col-sm-12">
    {!! Form::label('creator_name', 'Creator Name:') !!}
    <p>{{ $artistPorfolio->creator_name }}</p>
</div>

<!-- Artist Id Field -->
<div class="col-sm-12">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    <p>{{ $artistPorfolio->artist_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $artistPorfolio->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $artistPorfolio->updated_at }}</p>
</div>

