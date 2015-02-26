@extends('master')

@section('content')
    <h3>Tickets</h3>
    <hr />

    @if ($ticket)
        @include('tickets._blurb', ['view' => 'show'])

        @include('messages.public._notify')
    @else
        <p>No ticket was found.</p>
    @endif
@stop