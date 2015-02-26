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
            @include('organizations._blurb', ['view' => 'show'])
        </div>

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

        @forelse ($organization->tickets as $ticket)
            <h5>
                <a href="{{ action('TicketsController@show', $ticket->id) }}">
                    {{ $ticket->name }}
                </a>
            </h5>
            <p>{{ $ticket->description }}</p>
            <hr />
        @empty
            <p>This organization currently has no tickets.</p>
        @endforelse

    @else
        <p>No organization was found.</p>
    @endif
@stop