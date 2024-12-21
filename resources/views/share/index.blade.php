@extends('layouts.app', ['title' => 'Share', 'active' => 'share'])

@section('content')
<h1>Share</h1>
<meta name="random-id" content="{{ session('random_id') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

