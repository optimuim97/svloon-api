<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $accessoire->label }}</p>
</div>

<!-- Icone Field -->
<div class="col-sm-12">
    {!! Form::label('icone', 'Icone:') !!}
    <p>{{ $accessoire->icone }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $accessoire->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $accessoire->updated_at }}</p>
</div>

