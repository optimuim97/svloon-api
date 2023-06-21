<!-- Label Field -->
<div class="form-group col-sm-6">
    {!! Form::label('label', 'Label:') !!}
    {!! Form::text('label', null, ['class' => 'form-control']) !!}
</div>

<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', 'Icon:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('icon', ['class' => 'custom-file-input']) !!}
            {!! Form::label('icon', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>