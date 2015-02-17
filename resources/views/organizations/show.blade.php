@extends('master')

@section('content')
    <h1>
        <a href="{{ action('OrganizationsController@index') }}">
            Organizations
        </a>
    </h1>
    <hr />

    <p>
        <a class="btn btn-primary" href="{{ action('OrganizationsController@edit', $organization->id) }}">
            Edit Organization
        </a>
        <a class="btn btn-danger" href="{{ action('OrganizationsController@destroy', $organization->id) }}">
            Delete
        </a>
    </p>
    <hr />

    @if ($organization)
        <div>
            <h2>{{ $organization->name }}</h2>
            <p>{{ $organization->description }}</p>
        </div>

        @unless ($organization->tickets->isEmpty())
            <hr />
            <h3>Tickets:</h3>
            <hr />

            @foreach ($organization->tickets as $ticket)
                <h5>{{ $ticket->name }}</h5>
                <p>{{ $ticket->description }}</p>
                <hr />
            @endforeach
        @endunless

    @else
        <p>No organization was found.</p>
    @endif
@stop