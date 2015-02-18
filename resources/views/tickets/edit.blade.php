@extends('master')

@section('content')
    <h1>
        <a href="{{ action('TicketsController@index') }}">
            Ticket
        </a>
    </h1>
    <hr />

    {!! Form::model($ticket, ['action' => ['TicketsController@update', $ticket->id]]) !!}
        @include ('tickets._form', ['submitButtonText' => 'Update Ticket'])
    {!! Form::close() !!}

    @include ('errors.list')
@stop