<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $bankInfo->user_id }}</p>
</div>

<!-- Number Surccusale Field -->
<div class="col-sm-12">
    {!! Form::label('number_surccusale', 'Number Surccusale:') !!}
    <p>{{ $bankInfo->number_surccusale }}</p>
</div>

<!-- Numero Company Field -->
<div class="col-sm-12">
    {!! Form::label('numero_company', 'Numero Company:') !!}
    <p>{{ $bankInfo->numero_company }}</p>
</div>

<!-- Numero Compte Field -->
<div class="col-sm-12">
    {!! Form::label('numero_compte', 'Numero Compte:') !!}
    <p>{{ $bankInfo->numero_compte }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $bankInfo->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $bankInfo->updated_at }}</p>
</div>

