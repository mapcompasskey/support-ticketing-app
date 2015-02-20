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
            <h2>
                <a href="{{ action('OrganizationsController@show', [$organization->id]) }}">
                    {{ $organization->name }}
                </a>
            </h2>
            <p>{{ $organization->description }}</p>
            <p>Tickets: {{ ($organization->ticketsCount ? $organization->ticketsCount->aggregate : 0) }}</p>
            <hr />
        </div>
    @empty
        <p>There are no organizations.</p>
    @endforelse
@stop