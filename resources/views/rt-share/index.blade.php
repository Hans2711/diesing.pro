@extends('layouts.app', ['title' => __('titles.rt-share'), 'description' => __('descriptions.rt-share'), 'active' => 'rt-share'])

@section('content')
<h1>{{ __('text.rt-share') }}</h1>
<p>{!! __('descriptions.rt-share') !!}</p>
<div class="w-full h-[75vh] md:h-[90vh]">
    <iframe
        src="https://rt-share.diesing.pro"
        class="w-full h-full rounded border-none"
        allowfullscreen
    ></iframe>
</div>
@endsection
