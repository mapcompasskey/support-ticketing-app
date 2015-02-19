@extends('master')

@section('content')
    <h1>
        <a href="{{ action('TicketsController@index') }}">
            Tickets
        </a>
    </h1>
    <hr />

    <p>
        <a class="btn btn-blue" href="{{ action('TicketsController@edit', $ticket->id) }}">
            Edit Ticket
        </a>
        <a class="btn btn-red" href="{{ action('TicketsController@destroy', $ticket->id) }}">
            Delete
        </a>
    </p>
    <hr />

    @if ($ticket)
        <h2>{{ $ticket->name }}</h2>
        <h5>ID: {{ $ticket->id }}</h5>
        <h5>Slug: {{ $ticket->slug }}</h5>
        <p>{{ $ticket->description }}</p>

        @if ($ticket->organization)
            <hr />
            <h3>Organization:</h3>

            <h5>
                <a href="{{ action('OrganizationsController@show', $ticket->organization->id) }}">
                    {{ $ticket->organization->name }}
                </a>
            </h5>
            <p>{{ $ticket->organization->description }}</p>
        @endif

    @else
        <p>No ticket was found.</p>
    @endif
@stop