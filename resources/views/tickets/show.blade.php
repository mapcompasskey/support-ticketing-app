@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-blue" href="{{ action('TicketsController@edit', $ticket->id) }}">
            Edit Ticket
        </a>
        <a class="btn btn-red" href="{{ action('TicketsController@destroy', $ticket->id) }}">
            Delete
        </a>
    </div>

    <h3>Tickets</h3>
    <hr />

    @if ($ticket)
        <h2>{{ $ticket->name }}</h2>
        <h5>ID: {{ $ticket->id }}</h5>
        <h5>Slug: {{ $ticket->slug }}</h5>
        <p>{{ $ticket->description }}</p>

        @if ($ticket->organization)
            <p>&nbsp</p>
            <p>&nbsp</p>
            <hr />

            <h3>Organization:</h3>
            <hr />

            <h5>
                <a href="{{ action('OrganizationsController@show', $ticket->organization->id) }}">
                    {{ $ticket->organization->name }}
                </a>
            </h5>
            <p>{{ $ticket->organization->description }}</p>
        @endif

        @include('messages.private._list')

    @else
        <p>No ticket was found.</p>
    @endif
@stop