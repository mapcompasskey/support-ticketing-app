@extends('master')

@section('content')
    <h1>
        <a href="{{ action('TicketsController@index') }}">
            Tickets
        </a>
    </h1>
    <hr />

    {!! Form::open(['action' => 'TicketsController@store']) !!}
        @include ('tickets._form', ['submitButtonText' => 'Add Ticket', 'submitButtonClass' => 'btn-green'])
    {!! Form::close() !!}
@stop