@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-green" href="{{ action('ContactsController@create') }}">
            Create Contact
        </a>
    </div>

    <h3>Contacts</h3>
    <hr />

    @forelse ($contacts as $contact)
        <div>
            <h5>
                <a href="{{ action('OrganizationsController@show', [$contact->organization->id]) }}">
                    {{ $contact->organization->name }}
                </a>
            </h5>
            <h2>
                <a href="{{ action('ContactsController@show', [$contact->id]) }}">
                    {{ $contact->name }}
                </a>
            </h2>
            @if ($contact->title) <p>{{ $contact->title }}</p> @endif
            <p>{{ $contact->email }}</p>
            <p>Public Messages: {{ ($contact->publicMessagesCount ? $contact->publicMessagesCount->aggregate : 0) }}</p>
            <hr />
        </div>
    @empty
        <p>There are no contacts.</p>
    @endforelse
@stop