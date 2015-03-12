@if ($ticket)
    <p>&nbsp</p>
    <p>&nbsp</p>
    <hr />

    <h3>Public Messages</h3>
    <hr />

    @forelse ($ticket->publicMessages as $message)
        <div class="public-message{{ $message->is_new ? ' new-message' : '' }}">
            <a id="msg{{ $message->id }}" class="anchor-offset"></a>
            <p>
                <em>{{ $message->updated_at->diffForHumans() }}</em>
            </p>
            <p>
                {{ $message->name }}
                @if ($message->title)- <em>{{ $message->title }}</em>@endif
                - {{ $message->email }}
            </p>
            <p class="message">{!! nl2br(e($message->message)) !!}</p>
            @foreach ($message->files as $file)
                <p>
                    <a href="{{ action('PublicMessageFilesController@show', $file->filename) }}" target="_blank">
                        {{ $file->name }}
                    </a>
                </p>
            @endforeach
        </div>
        <hr />
    @empty
        <p>There are no messages.</p>
        <p>&nbsp</p>
        <hr />
    @endforelse

    {!! Form::open(['action' => 'Frontend\PublicMessagesController@store', 'files' => true]) !!}

        @unless ($errors->publicMessage->isEmpty())
            <div class="alert-danger">
                <a id="errors" class="anchor-offset"></a>
                <ul>
                    @foreach ($errors->publicMessage->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endunless

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
            {!! Form::label('file', 'Attach a file:') !!}
            {!! Form::file('file', null, ['class' => 'form-control']) !!}
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

@endif