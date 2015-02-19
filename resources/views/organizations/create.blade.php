@extends('master')

@section('content')
    <h1>
        <a href="{{ action('OrganizationsController@index') }}">
            Organizations
        </a>
    </h1>
    <hr />

    {!! Form::open(['action' => 'OrganizationsController@store']) !!}
        @include ('organizations._form', ['submitButtonText' => 'Add Organization', 'submitButtonClass' => 'btn-green'])
    {!! Form::close() !!}
@stop