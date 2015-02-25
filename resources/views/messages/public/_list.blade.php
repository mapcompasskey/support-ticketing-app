{{--
    $message->is_new is determined by /app/Providers/AppServiceProvider.php
--}}

@if ($ticket)
    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Public Messages</h3>
    <hr />

    @forelse ($ticket->publicMessages as $message)
        <div{{ $message->is_new ? ' id=new-message' : '' }} class="public-message{{ $message->is_new ? ' new-message' : '' }}">
            <p>
                <em>{{ $message->updated_at->diffForHumans() }}</em>
            </p>
            @if ($message->user)
                <p>{{ $message->user->name }}</p>
            @elseif ($message->contact)
                <p>{{ $message->contact->name }}</p>
            @endif
            <p>{{ $message->message }}</p>
        </div>
        <hr />
    @empty
        <p>There are no public messages.</p>
    @endforelse

    {!! Form::open(['action' => 'PublicMessagesController@store', 'id' => 'public-message']) !!}

        <div class="form-group">
            {!! Form::label('message', 'Message:') !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add New Public Message', ['class' => 'btn btn-blue']) !!}
        </div>

        {!! Form::hidden('ticket_id', $ticket->id) !!}

    {!! Form::close() !!}

    @include ('errors.form', ['errorBagName' => 'publicMessage'])

@endif