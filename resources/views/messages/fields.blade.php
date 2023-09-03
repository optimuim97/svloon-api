<!-- Conversation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('conversation_id', 'Conversation Id:') !!}
    {!! Form::number('conversation_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Read Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_read', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_read', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_read', 'Is Read', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Has Edited Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('has_edited', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('has_edited', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('has_edited', 'Has Edited', ['class' => 'form-check-label']) !!}
    </div>
</div>