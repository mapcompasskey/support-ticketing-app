@extends('master')

@section('content')
    <div class="pull-right">
        <a class="btn btn-green" href="{{ action('OrganizationsController@create') }}">
            Create Organization
        </a>
    </div>

    <h3>Organizations</h3>
    <hr />

    @forelse ($organizations as $organization)
        <div>
            @include('organizations._blurb', ['view' => 'index'])
            <hr />
        </div>
    @empty
        <p>There are no organizations.</p>
    @endforelse
@stop