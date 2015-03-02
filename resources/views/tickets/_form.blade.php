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
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('user_list', 'Whom to notify:') !!}
    {!! Form::select('user_list[]', $users, null, ['id' => 'user_list', 'class' => 'form-control', 'multiple']) !!}
</div>

@if (isset($action) && $action == 'create')

    <div class="form-group">
        {!! Form::checkbox('notify', 1, null, ['id' => 'notify']) !!}
        {!! Form::label('notify', 'Send Notification') !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Add Ticket', ['class' => 'btn btn-green']) !!}
    </div>

@elseif (isset($action) && $action == 'edit')

    <div class="form-group">
        {!! Form::submit('Update Ticket', ['class' => 'btn btn-blue']) !!}
        <a class="btn btn-white" href="{{ action('TicketsController@show', $ticket->id) }}">Nevermind</a>
    </div>

@endif

@include ('errors.form')
