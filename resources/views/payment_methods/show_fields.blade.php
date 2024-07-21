<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $paymentMethod->label }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $paymentMethod->description }}</p>
</div>

<!-- Logo Field -->
<div class="col-sm-12">
    {!! Form::label('logo', 'Logo:') !!}
    <p>{{ $paymentMethod->logo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $paymentMethod->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $paymentMethod->updated_at }}</p>
</div>

