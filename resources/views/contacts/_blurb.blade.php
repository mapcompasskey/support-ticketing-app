@if (isset($contact))

    @if (isset($view) && $view == 'index')

        <h5>
            <a href="{{ action('OrganizationsController@show', [$contact->organization->id]) }}">
                {{ $contact->organization->name }}
            </a>
        </h5>
        <h2>
            <a href="{{ action('ContactsController@show', [$contact->id]) }}">
                {{ $contact->name }}
            </a>
        </h2>
        @if ($contact->title)
            <p>{{ $contact->title }}</p>
        @endif
        <p>{{ $contact->email }}</p>
        <p>Public Messages: {{ ($contact->publicMessagesCount ? $contact->publicMessagesCount->aggregate : 0) }}</p>

    @elseif (isset($view) && $view == 'show')

        <h2>{{ $contact->name }}</h2>
        @if ($contact->title)
            <p>{{ $contact->title }}</p>
        @endif
        <p>{{ $contact->email }}</p>
        <p>Public Messages: {{ ($contact->publicMessagesCount ? $contact->publicMessagesCount->aggregate : 0) }}</p>

    @endif

@endif