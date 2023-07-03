<!-- Salon Id Field -->
<div class="col-sm-12">
    {!! Form::label('salon_id', 'Salon Id:') !!}
    <p>{{ $salonPicture->salon_id }}</p>
</div>

<!-- Path Field -->
<div class="col-sm-12">
    {!! Form::label('path', 'Path:') !!}
    <p>{{ $salonPicture->path }}</p>
</div>

<!-- Original Name Field -->
<div class="col-sm-12">
    {!! Form::label('original_name', 'Original Name:') !!}
    <p>{{ $salonPicture->original_name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $salonPicture->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $salonPicture->updated_at }}</p>
</div>

