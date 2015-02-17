@extends('master')

@section('content')
    <h1>SmallBox Support Ticketing System</h1>
    <hr />

    {{--<p>--}}
        {{--<a class="btn btn-default" href="{{ action('OrganizationController@create') }}">--}}
            {{--Create Organization--}}
        {{--</a>--}}
    {{--</p>--}}
    {{--<hr />--}}

    {{--@forelse ($organizations as $organizations)--}}
        {{--<div>--}}
            {{--<h2>--}}
                {{--<a href="{{ action('OrganizationController@show', [$organizations->id]) }}">--}}
                    {{--{{ $organizations->name }}--}}
                {{--</a>--}}
            {{--</h2>--}}
            {{--<p>{{ $organizations->description }}</p>--}}
        {{--</div>--}}
    {{--@empty--}}
        {{--<p>There are no organizations.</p>--}}
    {{--@endforelse--}}
@stop