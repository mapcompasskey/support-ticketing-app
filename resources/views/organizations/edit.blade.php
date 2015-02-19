@extends('master')

@section('content')
    <h3>Organization</h3>
    <hr />

    {!! Form::model($organization, ['action' => ['OrganizationsController@update', $organization->id]]) !!}
        @include ('organizations._form', ['submitButtonText' => 'Update Organization', 'submitButtonClass' => 'btn-blue'])
    {!! Form::close() !!}
@stop