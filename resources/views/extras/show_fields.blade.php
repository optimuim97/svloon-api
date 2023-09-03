<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $extra->name }}</p>
</div>

<!-- Prix Field -->
<div class="col-sm-12">
    {!! Form::label('prix', 'Prix:') !!}
    <p>{{ $extra->prix }}</p>
</div>

<!-- Ext Time Field -->
<div class="col-sm-12">
    {!! Form::label('ext_time', 'Ext Time:') !!}
    <p>{{ $extra->ext_time }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $extra->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $extra->updated_at }}</p>
</div>

