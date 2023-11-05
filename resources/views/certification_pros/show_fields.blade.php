<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $certificationPro->user_id }}</p>
</div>

<!-- File Field -->
<div class="col-sm-12">
    {!! Form::label('file', 'File:') !!}
    <p>{{ $certificationPro->file }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $certificationPro->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $certificationPro->updated_at }}</p>
</div>

