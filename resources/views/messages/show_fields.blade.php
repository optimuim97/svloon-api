<!-- Conversation Id Field -->
<div class="col-sm-12">
    {!! Form::label('conversation_id', 'Conversation Id:') !!}
    <p>{{ $message->conversation_id }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $message->content }}</p>
</div>

<!-- Is Read Field -->
<div class="col-sm-12">
    {!! Form::label('is_read', 'Is Read:') !!}
    <p>{{ $message->is_read }}</p>
</div>

<!-- Has Edited Field -->
<div class="col-sm-12">
    {!! Form::label('has_edited', 'Has Edited:') !!}
    <p>{{ $message->has_edited }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $message->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $message->updated_at }}</p>
</div>

