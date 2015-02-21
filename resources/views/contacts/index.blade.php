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
            @include('contacts._blurb', ['view' => 'index'])
            <hr />
        </div>
    @empty
        <p>There are no contacts.</p>
    @endforelse
@stop