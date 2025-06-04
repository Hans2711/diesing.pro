@extends('layouts.email')

@section('content')
<p>Message from: {{ $name }} ({{ $email }})</p>
<p>Company: {{ $firma }}</p>
<p>Tel: {{ $tel }}</p>
<p>E-Mail: {{ $email }}</p>

<p>{{ $user_msg }}</p>
@endsection
