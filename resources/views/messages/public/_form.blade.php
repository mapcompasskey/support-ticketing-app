{{--
    $userName, $userEmail, and $isNotify are set from /app/Providers/AppServiceProvider.php
--}}

{!! Form::open(['action' => 'PublicMessagesController@store', 'id' => 'public-message', 'files' => true]) !!}

    @unless ($errors->publicMessage->isEmpty())
        <div class="alert-danger">
            <a id="public-message-errors" class="anchor-offset"></a>
            <ul>
                @foreach ($errors->publicMessage->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endunless

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
        {!! Form::label('file', 'Attach a file:') !!}
        {!! Form::file('file', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::checkbox('public_notify', 1, $isPublicNotify, ['id' => 'public_notify']) !!}
        {!! Form::label('public_notify', 'Notify me when new messages are posted') !!}
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