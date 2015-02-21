@extends('master')

@section('content')
    <h3>Contacts</h3>
    <hr />

    {!! Form::open(['action' => 'ContactsController@store']) !!}
        @include ('contacts._form', ['submitButtonText' => 'Add Contact', 'submitButtonClass' => 'btn-green'])
    {!! Form::close() !!}
@stop