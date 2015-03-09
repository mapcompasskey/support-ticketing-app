@extends('frontend.master')

@section('content')
    <h3>Unsubscribed</h3>
    <p>The following email address will no longer receive notifications when new messages are posted.</p>
    <p><em>{{ $email or 'Problem finding email address' }}</em></p>
@stop