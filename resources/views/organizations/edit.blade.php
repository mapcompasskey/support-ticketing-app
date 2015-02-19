@extends('master')

@section('content')
    <h1>
        <a href="{{ action('OrganizationsController@index') }}">
            Organization
        </a>
    </h1>
    <hr />

    {!! Form::model($organization, ['action' => ['OrganizationsController@update', $organization->id]]) !!}
        @include ('organizations._form', ['submitButtonText' => 'Update Organization', 'submitButtonClass' => 'btn-blue'])
    {!! Form::close() !!}
@stop