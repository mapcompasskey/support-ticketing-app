@extends('master')

@section('content')
    <h1>Tickets</h1>
    <hr />

    <p>
        <a class="btn btn-success" href="{{--{{ action('TicketsController@create') }}--}}">
            Create Ticket
        </a>
    </p>
    <hr />

    @forelse ($tickets as $ticket)
        <div>
            <h2>
                <a href="{{ action('TicketsController@show', [$ticket->id]) }}">
                    {{ $ticket->name }}
                </a>
            </h2>
            <p>{{ $ticket->description }}</p>
            <hr />
        </div>
    @empty
        <p>There are no tickets.</p>
    @endforelse
@stop