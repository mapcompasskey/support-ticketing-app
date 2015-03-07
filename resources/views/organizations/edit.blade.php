@extends('master')

@section('content')
    <h3>Organizations</h3>
    <hr />

    {!! Form::model($organization, ['action' => ['OrganizationsController@update', $organization->id]]) !!}
        @include ('organizations._form', ['action' => 'edit'])
    {!! Form::close() !!}
@stop