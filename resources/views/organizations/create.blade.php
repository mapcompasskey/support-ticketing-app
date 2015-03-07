@extends('master')

@section('content')
    <h3>Organizations</h3>
    <hr />

    {!! Form::open(['action' => 'OrganizationsController@store']) !!}
        @include ('organizations._form', ['action' => 'create'])
    {!! Form::close() !!}
@stop