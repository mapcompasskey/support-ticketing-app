@extends('frontend.master')

@section('content')
    <h3>Tickets</h3>
    <hr />

    @if ($ticket)

        <h2>{{ $ticket->name }}</h2>
        <p>{{ $ticket->description }}</p>

        @include('frontend.messages.public._list')
    @else
        <p>No ticket was found.</p>
    @endif
@stop