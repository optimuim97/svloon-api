<!-- Annonce Id Field -->
<div class="col-sm-12">
    {!! Form::label('annonce_id', 'Annonce Id:') !!}
    <p>{{ $accessoireAnnonce->annonce_id }}</p>
</div>

<!-- Accessoire Id Field -->
<div class="col-sm-12">
    {!! Form::label('accessoire_id', 'Accessoire Id:') !!}
    <p>{{ $accessoireAnnonce->accessoire_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $accessoireAnnonce->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $accessoireAnnonce->updated_at }}</p>
</div>

