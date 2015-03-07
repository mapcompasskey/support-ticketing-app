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
        <div class="private-message{{ $message->is_new ? ' new-message' : '' }}">
            <a id="private-message{{ $message->id }}" class="anchor-offset"></a>
            <p><em>{{ $message->updated_at->diffForHumans() }}</em></p>
            <p>{{ $message->user->name }}</p>
            <p class="message">{!! nl2br(e($message->message)) !!}</p>
        </div>
        <hr />
    @empty
        <p>There are no private messages.</p>
        <hr />
    @endforelse

    {!! Form::open(['action' => 'PrivateMessagesController@store', 'id' => 'private-message', ]) !!}

        @unless ($errors->privateMessage->isEmpty())
            <div class="alert-danger">
                <a id="private-message-errors" class="anchor-offset"></a>
                <ul>
                    @foreach ($errors->privateMessage->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endunless

        <div class="form-group">
            {!! Form::label('message', 'Message:') !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::checkbox('private_notify', 1, $isPrivateNotify, ['id' => 'private_notify']) !!}
            {!! Form::label('private_notify', 'Notify me when new messages are posted') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Add New Private Message', ['class' => 'btn btn-blue']) !!}
        </div>

        {!! Form::hidden('ticket_id', $ticket->id) !!}

    {!! Form::close() !!}

@endif