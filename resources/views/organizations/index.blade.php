@extends('master')

@section('content')
    <h1>Organizations</h1>
    <hr />

    <p>
        <a class="btn btn-success" href="{{ action('OrganizationsController@create') }}">
            Create Organization
        </a>
    </p>
    <hr />

    @forelse ($organizations as $organization)
        <div>
            <h2>
                <a href="{{ action('OrganizationsController@show', [$organization->id]) }}">
                    {{ $organization->name }}
                </a>
            </h2>
            <p>{{ $organization->description }}</p>
            <hr />
        </div>
    @empty
        <p>There are no organizations.</p>
    @endforelse
@stop