@if (isset($ticket))

    @if (isset($view) && $view == 'index')
        <h5>
            <a href="{{ action('OrganizationsController@show', [$ticket->organization->id]) }}">
                {{ $ticket->organization->name }}
            </a>
        </h5>
        <h2>
            <a href="{{ action('TicketsController@show', [$ticket->id]) }}">
                {{ $ticket->name }}
            </a>
        </h2>
        <p>{{ $ticket->description }}</p>
        <p>Private Message: {{ ($ticket->privateMessagesCount ? $ticket->privateMessagesCount->aggregate : 0) }}</p>
        <p>Public Message: {{ ($ticket->publicMessagesCount ? $ticket->publicMessagesCount->aggregate : 0) }}</p>

    @elseif (isset($view) && $view == 'show')

        <h2>{{ $ticket->name }}</h2>
        <h5>ID: {{ $ticket->id }}</h5>
        <h5>Slug: {{ $ticket->slug }}</h5>
        <p>
            <a href="{{ action('FrontendTicketsController@show', [$ticket->id, $ticket->slug]) }}" target="_blank">
                Visit Frontend Thread
            </a>
        </p>
        <p>{{ $ticket->description }}</p>

    @endif

@endif