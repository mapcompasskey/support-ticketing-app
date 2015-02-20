@if ($ticket)
    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Private Messages</h3>
    <hr />

    @forelse ($ticket->privateMessages as $key => $message)
        <div class="private-message{{ (($key + 1) == count($ticket->privateMessages) ? ' new-message' : '') }}">
            <p>
                <em>{{ $message->updated_at->diffForHumans() }}</em>
            </p>
            <p>{{ $message->message }}</p>
        </div>
        <hr />
    @empty
        <p>There are no private messages.</p>
    @endforelse

    {!! Form::open(['action' => 'PrivateMessagesController@store']) !!}

        <div class="form-group">
            {!! Form::label('message', 'Message:') !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add New Private Message', ['class' => 'btn btn-blue']) !!}
        </div>

        {!! Form::hidden('ticket_id', $ticket->id) !!}

    {!! Form::close() !!}

    @include ('errors.form')

@endif