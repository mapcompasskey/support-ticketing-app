@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-blue" href="{{ action('OrganizationsController@edit', $organization->id) }}">
            Edit Organization
        </a>
        <a class="btn btn-red" href="{{ action('OrganizationsController@destroy', $organization->id) }}">
            Delete
        </a>
    </div>

    <h3>Organizations</h3>
    <hr />

    @if ($organization)
        <div>
            <h2>{{ $organization->name }}</h2>
            <p>{{ $organization->description }}</p>
        </div>

        @unless ($organization->tickets->isEmpty())
            <p>&nbsp</p>
            <p>&nbsp</p>
            <hr />

            <div class="pull-right">
                <a class="btn btn-green" href="{{ action('TicketsController@create') }}">
                    Create Ticket
                </a>
            </div>

            <h3>Tickets</h3>
            <hr />

            @foreach ($organization->tickets as $ticket)
                <h5>
                    <a href="{{ action('TicketsController@show', $ticket->id) }}">
                        {{ $ticket->name }}
                    </a>
                </h5>
                <p>{{ $ticket->description }}</p>
                <hr />
            @endforeach
        @endunless

    @else
        <p>No organization was found.</p>
    @endif
@stop