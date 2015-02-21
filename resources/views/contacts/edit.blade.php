@extends('master')

@section('content')
    <h3>Contacts</h3>
    <hr />

    {!! Form::model($contact, ['action' => ['ContactsController@update', $contact->id]]) !!}
        @include ('contacts._form', ['submitButtonText' => 'Update Contact', 'submitButtonClass' => 'btn-blue'])
    {!! Form::close() !!}
@stop