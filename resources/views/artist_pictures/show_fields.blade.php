<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $artistPicture->name }}</p>
</div>

<!-- Path Field -->
<div class="col-sm-12">
    {!! Form::label('path', 'Path:') !!}
    <p>{{ $artistPicture->path }}</p>
</div>

<!-- Original Name Field -->
<div class="col-sm-12">
    {!! Form::label('original_name', 'Original Name:') !!}
    <p>{{ $artistPicture->original_name }}</p>
</div>

<!-- Artist Id Field -->
<div class="col-sm-12">
    {!! Form::label('artist_id', 'Artist Id:') !!}
    <p>{{ $artistPicture->artist_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $artistPicture->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $artistPicture->updated_at }}</p>
</div>

