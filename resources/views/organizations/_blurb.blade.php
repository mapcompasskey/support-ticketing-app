@if (isset($organization))

    @if (isset($view) && $view == 'index')

        <h2>
            <a href="{{ action('OrganizationsController@show', [$organization->id]) }}">
                {{ $organization->name }}
            </a>
        </h2>
        <p>{{ $organization->description }}</p>
        <p>Tickets: {{ ($organization->ticketsCount ? $organization->ticketsCount->aggregate : 0) }}</p>
        <p>Contacts: {{ ($organization->contactsCount ? $organization->contactsCount->aggregate : 0) }}</p>

    @elseif (isset($view) && $view == 'show')

        <h2>{{ $organization->name }}</h2>
        <p>{{ $organization->description }}</p>

    @else

        <p>&nbsp</p>
        <p>&nbsp</p>
        <hr />

        <h3>Organization:</h3>
        <hr />

        <h5>
            <a href="{{ action('OrganizationsController@show', $organization->id) }}">
                {{ $organization->name }}
            </a>
        </h5>
        <p>{{ $organization->description }}</p>

    @endif

@endif