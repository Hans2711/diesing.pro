@extends('layouts.email')

@section('content')
<p>User: {{ $user->name }}</p>
<p>Username: {{ $user->username }}</p>
<p>Email: {{ $user->email }}</p>
<p>Permission: {{ $permission }}</p>
<p><a alt="{{ __('alt.grant_access') }}" title="{{ __('alt.grant_access') }}" href="{{ url('/grant/' . $user->username . '/' . $permission . '/' . $user->permissions_token) }}">Grant Access</a></p>
<p><a alt="{{ __('alt.remove_access') }}" title="{{ __('alt.remove_access') }}" href="{{ url('/ungrant/' . $user->username . '/' . $permission . '/' . $user->permissions_token) }}">Remove Access</a></p>
@endsection
