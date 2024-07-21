<!-- Designation Field -->
<div class="col-sm-12">
    {!! Form::label('designation', 'Designation:') !!}
    <p>{{ $carte->designation }}</p>
</div>

<!-- Carte Number Field -->
<div class="col-sm-12">
    {!! Form::label('carte_number', 'Carte Number:') !!}
    <p>{{ $carte->carte_number }}</p>
</div>

<!-- Date Exp Field -->
<div class="col-sm-12">
    {!! Form::label('date_exp', 'Date Exp:') !!}
    <p>{{ $carte->date_exp }}</p>
</div>

<!-- Cvv Field -->
<div class="col-sm-12">
    {!! Form::label('cvv', 'Cvv:') !!}
    <p>{{ $carte->cvv }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $carte->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $carte->updated_at }}</p>
</div>

