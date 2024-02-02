<!-- Annonce Id Field -->
<div class="col-sm-12">
    {!! Form::label('annonce_id', 'Annonce Id:') !!}
    <p>{{ $annonceImages->annonce_id }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $annonceImages->image }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $annonceImages->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $annonceImages->updated_at }}</p>
</div>

