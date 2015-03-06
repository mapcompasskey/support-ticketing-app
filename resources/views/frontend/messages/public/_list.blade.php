@if ($ticket)
    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Public Messages</h3>
    <hr />

    @forelse ($ticket->publicMessages as $message)
        <div class="public-message">
            <p>
                <em>{{ $message->updated_at->diffForHumans() }}</em>
            </p>
            <p>
                {{ $message->name }}
                @if ($message->title)- <em>{{ $message->title }}</em>@endif
                - {{ $message->email }}
            </p>
            <p class="message">{!! nl2br(e($message->message)) !!}</p>
        </div>
        <hr />
    @empty
        <p>There are no public messages.</p>
    @endforelse

    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    {!! Form::open(['action' => 'FrontendTicketsController@store']) !!}

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
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::checkbox('notify', 1, null, ['id' => 'notify']) !!}
            {!! Form::label('notify', 'Notify me when new messages are posted') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Post Message', ['class' => 'btn btn-blue']) !!}
        </div>

        {!! Form::hidden('ticket_id', $ticket->id) !!}
        {!! Form::hidden('ticket_slug', $ticket->slug) !!}

    {!! Form::close() !!}

    @include ('errors.form', ['errorBagName' => 'publicMessage'])

@endif