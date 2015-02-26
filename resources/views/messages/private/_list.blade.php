{{--
    $message->is_new is determined by /app/Providers/AppServiceProvider.php
--}}

@if ($ticket)
    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Private Messages</h3>
    <hr />

    @forelse ($ticket->privateMessages as $message)
        <div{{ $message->is_new ? ' id=new-message' : '' }} class="private-message{{ $message->is_new ? ' new-message' : '' }}">
            <p>
                <em>{{ $message->updated_at->diffForHumans() }}</em>
            </p>
            <p>{{ $message->user->name }}</p>
            <p class="message">{!! nl2br(e($message->message)) !!}</p>
        </div>
        <hr />
    @empty
        <p>There are no private messages.</p>
    @endforelse

    {!! Form::open(['action' => 'PrivateMessagesController@store', 'id' => 'private-message', ]) !!}

        <div class="form-group">
            {!! Form::label('message', 'Message:') !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add New Private Message', ['class' => 'btn btn-blue']) !!}
        </div>

        {!! Form::hidden('ticket_id', $ticket->id) !!}

    {!! Form::close() !!}

    @include ('errors.form', ['errorBagName' => 'privateMessage'])

@endif