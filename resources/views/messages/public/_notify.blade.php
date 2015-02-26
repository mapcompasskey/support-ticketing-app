@if ($ticket)

    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Public Messages: Send Notification</h3>
    <hr />

    <p>This message will appear as the first public message. Its the easiest way to include a contact into the public thread.</p>
    <hr />

    {!! Form::open(['action' => 'PublicMessagesController@store', 'id' => 'public-message']) !!}

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
            {!! Form::label('message', 'Message:') !!}
            {!! Form::textarea('message', "http://support.public.localhost/support/{$ticket->id}/{$ticket->slug}&#13;&#10;Thanks for submitting a request. You can track its progress and interact with us using the url provided.&#13;&#10;&#13;&#10;Jordan Wilson&#13;&#10;jordan@smallbox.com", ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Send Notification', ['class' => 'btn btn-blue']) !!}
        </div>

        {!! Form::hidden('ticket_id', $ticket->id) !!}

    {!! Form::close() !!}

    @include ('errors.form', ['errorBagName' => 'publicMessage'])

@endif