<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $userType->label }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $userType->description }}</p>
</div>

<!-- Avantages Field -->
<div class="col-sm-12">
    {!! Form::label('avantages', 'Avantages:') !!}
    <p>{{ $userType->avantages }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userType->updated_at }}</p>
</div>

