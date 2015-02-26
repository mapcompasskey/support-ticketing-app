@extends('master')

@section('content')
    <h3>Tickets</h3>
    <hr />

    {!! Form::model($ticket, ['action' => ['TicketsController@update', $ticket->id]]) !!}
        @include ('tickets._form', ['action' => 'edit'])
    {!! Form::close() !!}
@stop