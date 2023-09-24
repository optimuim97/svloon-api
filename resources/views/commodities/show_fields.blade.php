<!-- Label Field -->
<div class="col-sm-12">
    {!! Form::label('label', 'Label:') !!}
    <p>{{ $commodities->label }}</p>
</div>

<!-- Slug Field -->
<div class="col-sm-12">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $commodities->slug }}</p>
</div>

<!-- Imageurl Field -->
<div class="col-sm-12">
    {!! Form::label('imageUrl', 'Imageurl:') !!}
    <p>{{ $commodities->imageUrl }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $commodities->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $commodities->updated_at }}</p>
</div>

