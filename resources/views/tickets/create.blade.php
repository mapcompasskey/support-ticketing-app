@extends('master')

@section('content')
    <h3>Tickets</h3>
    <hr />

    {!! Form::open(['action' => 'TicketsController@store']) !!}
        @include ('tickets._form', ['action' => 'create'])
    {!! Form::close() !!}
@stop