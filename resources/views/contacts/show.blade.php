@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-blue" href="{{ action('ContactsController@edit', $contact->id) }}">
            Edit Contact
        </a>
        <a class="btn btn-red" href="{{ action('ContactsController@destroy', $contact->id) }}">
            Delete
        </a>
    </div>

    <h3>Contacts</h3>
    <hr />

    @if ($contact)
        <h2>{{ $contact->name }}</h2>
        @if ($contact->title) <p>{{ $contact->title }}</p> @endif
        <p>{{ $contact->email }}</p>
        <p>Public Messages: {{ ($contact->publicMessagesCount ? $contact->publicMessagesCount->aggregate : 0) }}</p>

        @if ($contact->organization)
            <p>&nbsp</p>
            <p>&nbsp</p>
            <hr />

            <h3>Organization:</h3>
            <hr />

            <h5>
                <a href="{{ action('OrganizationsController@show', $contact->organization->id) }}">
                    {{ $contact->organization->name }}
                </a>
            </h5>
            <p>{{ $contact->organization->description }}</p>
        @endif
    @else
        <p>No contact was found.</p>
    @endif
@stop