<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $rulesAndSafety->label }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $rulesAndSafety->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $rulesAndSafety->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $rulesAndSafety->updated_at }}</p>
</div>

