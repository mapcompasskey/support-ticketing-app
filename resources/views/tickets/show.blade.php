@extends('master')

@section('content')
    <h1>
        <a href="{{ action('TicketsController@index') }}">
            Tickets
        </a>
    </h1>
    <hr />

    <p>
        <a class="btn btn-primary" href="{{--{{ action('TicketsController@edit', $organization->id) }}--}}">
            Edit Ticket
        </a>
        <a class="btn btn-danger" href="{{--{{ action('TicketsController@destroy', $organization->id) }}--}}">
            Delete
        </a>
    </p>
    <hr />

    @if ($ticket)
        <div>
            <h2>{{ $ticket->name }}</h2>
            <p>{{ $ticket->description }}</p>
        </div>
    @else
        <p>No ticket was found.</p>
    @endif
@stop