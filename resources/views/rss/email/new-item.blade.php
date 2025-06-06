@extends('layouts.email')

@section('content')
<p>New item in feed {{ $url }}</p>
<p><a href="{{ $link }}">{{ $title }}</a></p>
@if(!empty($description))
<p>{!! $description !!}</p>
@endif
@if(!empty($pubDate))
<p><small>{{ $pubDate }}</small></p>
@endif
@endsection
