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
        @include('contacts._blurb', ['view' => 'show'])

        @if ($contact->organization)
            @include('organizations._blurb', ['organization' => $contact->organization])
        @endif
    @else
        <p>No contact was found.</p>
    @endif
@stop