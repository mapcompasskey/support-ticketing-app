@extends('master')

@section('content')
    <h1>SmallBox Support Ticketing System</h1>
    <hr />
    
    <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Sed consequat odio ac mi egestas
     quis aliquet ipsum vehicula. Integer non magna malesuada molestie nisl eget bibendum nulla.
     Nam nec scelerisque enim. Sed ut mauris ac nibh volutpat hendrerit. Sed malesuada quam sit
     amet faucibus maximus mauris dolor laoreet nunc rhoncus pharetra massa dui quis turpis. Ut
     nisi velit interdum vel cursus quis rutrum ut libero. Aenean mauris eros convallis in ligula
     ut interdum pharetra risus. In nulla tellus tincidunt ut imperdiet ut malesuada ac ante.
     Mauris ac eros dignissim massa feugiat interdum. Sed metus diam efficitur quis sem faucibus
     eleifend tincidunt nibh.</p>
    <p>Duis porttitor rhoncus ipsum at dictum. Mauris a nisl ac dolor convallis sodales id tristique
    tellus. Integer eget consequat neque vitae venenatis nibh. Mauris vel lacus consequat ullamcorper
    risus in luctus mi. Nullam a lectus eu nunc aliquet rutrum sit amet et magna. Phasellus facilisis
    neque vel quam eleifend pellentesque finibus eros dapibus. Donec pharetra ornare porta. Donec
    metus sapien iaculis at iaculis sit amet ultrices ut justo. Ut iaculis velit in mi ullamcorper
    sit amet semper dolor porttitor. Suspendisse potenti. Curabitur a viverra nibh. Integer sed
    consectetur ex. Maecenas feugiat felis vitae placerat sodales urna mi accumsan purus et porta
    justo est rhoncus nisi. Aenean bibendum nisl magna vitae consectetur ipsum facilisis ac. Vivamus
    ut nibh felis. Lorem ipsum dolor sit amet consectetur adipiscing elit.</p>

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