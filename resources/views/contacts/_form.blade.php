{{--
    $organization_id is set from /app/Providers/AppServiceProvider.php
--}}

<div class="form-group">
    {!! Form::label('organization_id', 'Organization:') !!}
    {!! Form::select('organization_id', $organizations, $organization_id, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn ' . $submitButtonClass]) !!}
</div>

@include ('errors.form')
