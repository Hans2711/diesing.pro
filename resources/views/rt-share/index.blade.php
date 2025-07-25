@extends('layouts.app', ['title' => __('titles.rt-share'), 'description' => __('descriptions.rt-share'), 'keywords' => __('keywords.rt-share'), 'active' => 'rt-share'])

@section('content')
<h1>{{ __('text.rt-share') }}</h1>
<p>{!! __('descriptions.rt-share') !!}</p>
<a alt="{{ __('alt.github') }}" title="{{ __('alt.github') }}" class="btn btn-primary w-fit mb-3 flex items-center gap-2" href="https://github.com/Hans2711/rt-share" target="_blank">
    <img class="w-6 h-6 invert" src="{{ Vite::asset('resources/icons/github.svg') }}" alt="GitHub" title="GitHub" />
    Github
</a>
<div class="w-full h-[75vh] md:h-[90vh]">
    <iframe
        src="https://rt-share.diesing.pro"
        class="w-full h-full rounded border-none"
        allowfullscreen
    ></iframe>
</div>
@endsection
