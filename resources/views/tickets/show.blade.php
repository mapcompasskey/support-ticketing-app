@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-blue" href="{{ action('TicketsController@edit', $ticket->id) }}">
            Edit Ticket
        </a>
        <a class="btn btn-red" href="{{ action('TicketsController@destroy', $ticket->id) }}">
            Delete
        </a>
    </div>

    <h3>Tickets</h3>
    <hr />

    @if ($ticket)
        @include('tickets._blurb', ['view' => 'show'])

        <h4>Private Contacts</h4>
        @unless ($ticket->users->isEmpty())
            <ul>
            @foreach ($ticket->users as $user)
                <li>{{ $user->email }}</li>
            @endforeach
            </ul>
        @else
            <p>No private contacts were found.</p>
        @endunless

        <h4>Public Contacts</h4>
        @unless ($ticket->publicContacts->isEmpty())
            <ul>
            <li>Click to unsubscribe:</li>
            @foreach ($ticket->publicContacts as $contact)
                <li>
                    <a href="{{ action('Frontend\PublicContactsController@destroy', [$contact->id, $contact->unsubscribe_slug]) }}" target="_blank">
                        {{ $contact->email }}
                    </a>
                </li>
            @endforeach
            </ul>
        @else
            <p>No public contacts in thread.</p>
        @endunless

        <h4>Distinct Emails in Public Thread</h4>
        @unless ($ticket->publicMessagesContacts->isEmpty())
            <ul>
            @foreach ($ticket->publicMessagesContacts as $contact)
                <li>{{ $contact->email }}</li>
            @endforeach
            </ul>
        @else
            <p>No distinct emails in thread.</p>
        @endunless

        <p>&nbsp;</p>
        <hr />
        <div class="pull-right">
            <a class="btn btn-white" href="{{ action('TicketsController@close', $ticket->id) }}">
                {{ (is_null($ticket->closed_at) ? 'Close' : 'Reopen') }} Ticket
            </a>
        </div>

        @if ($ticket->organization)
            @include('organizations._blurb', ['organization' => $ticket->organization])
        @endif

        @include('messages.private._list')
        @include('messages.public._list')
    @else
        <p>No ticket was found.</p>
    @endif
@stop