
@include ('errors.form')

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

@if (isset($action) && $action == 'create')

    <div class="form-group">
        {!! Form::submit('Add Organization', ['class' => 'btn btn-green']) !!}
        <a class="btn btn-white" href="{{ action('OrganizationsController@index') }}">Nevermind</a>
    </div>

@elseif (isset($action) && $action == 'edit')

    <div class="form-group">
        {!! Form::submit('Update Organization', ['class' => 'btn btn-blue']) !!}
        <a class="btn btn-white" href="{{ action('OrganizationsController@show', $organization->id) }}">Nevermind</a>
    </div>

@endif