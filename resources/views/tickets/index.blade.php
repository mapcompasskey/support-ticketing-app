@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-green" href="{{ action('TicketsController@create') }}">
            Create Ticket
        </a>
    </div>

    <h3>Tickets</h3>
    <hr />

    @forelse ($tickets as $ticket)
        <div>
            @include('tickets._blurb', ['view' => 'index'])
            <hr />
        </div>
    @empty
        <p>There are no tickets.</p>
    @endforelse
@stop