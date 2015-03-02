{!! Form::open(['action' => 'PublicMessagesController@store', 'id' => 'public-message']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $userName, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', $userEmail, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('message', 'Message:') !!}
        @if (isset($action) && $action == 'list')
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        @elseif (isset($action) && $action == 'notify')
            {!! Form::textarea('message', "http://support.public.localhost/support/{$ticket->id}/{$ticket->slug}&#13;&#10;Thanks for submitting a request. You can track its progress and interact with us using the url provided.&#13;&#10;&#13;&#10;Jordan Wilson&#13;&#10;jordan@smallbox.com", ['class' => 'form-control']) !!}
        @endif
    </div>

    <div class="form-group">
        {!! Form::checkbox('notify', 1, (isset($action) && $action == 'notify' ? true : null), ['id' => 'notify']) !!}
        {!! Form::label('notify', 'Notify me when new messages are posted') !!}
    </div>

    @if (isset($action) && $action == 'list')

        <div class="form-group">
            {!! Form::submit('Add New Public Message', ['class' => 'btn btn-blue']) !!}
        </div>

    @elseif (isset($action) && $action == 'notify')

        <div class="form-group">
            {!! Form::submit('Send Notification', ['class' => 'btn btn-blue']) !!}
        </div>

    @endif

    {!! Form::hidden('ticket_id', $ticket->id) !!}

{!! Form::close() !!}

@include ('errors.form', ['errorBagName' => 'publicMessage'])