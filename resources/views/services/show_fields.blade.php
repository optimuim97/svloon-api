<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $service->label }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $service->description }}</p>
</div>

<!-- Imageurl Field -->
<div class="col-sm-12">
    {!! Form::label('imageUrl', 'Imageurl:') !!}
    <p>{{ $service->imageUrl }}</p>
</div>

<!-- Ispromo Field -->
<div class="col-sm-12">
    {!! Form::label('isPromo', 'Ispromo:') !!}
    <p>{{ $service->isPromo }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $service->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $service->updated_at }}</p>
</div>

