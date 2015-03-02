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

    @include ('messages.public._form', ['action' => 'list'])

@endif