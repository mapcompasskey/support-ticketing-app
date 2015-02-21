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
        @include('tickets._blurb', ['view' => 'show'])
        
        @if ($ticket->organization)
            @include('organizations._blurb', ['organization' => $ticket->organization])
        @endif

        @include('messages.private._list')
        @include('messages.public._list')
    @else
        <p>No ticket was found.</p>
    @endif
@stop