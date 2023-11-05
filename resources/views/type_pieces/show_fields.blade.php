<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $typePiece->label }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $typePiece->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $typePiece->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $typePiece->updated_at }}</p>
</div>

