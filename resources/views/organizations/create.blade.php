@extends('master')

@section('content')
    <h3>Organizations</h3>
    <hr />

    {!! Form::open(['action' => 'OrganizationsController@store']) !!}
        @include ('organizations._form', ['submitButtonText' => 'Add Organization', 'submitButtonClass' => 'btn-green'])
    {!! Form::close() !!}
@stop