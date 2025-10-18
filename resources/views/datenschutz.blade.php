@extends('layouts.app', [
    'title' => __('titles.data-protection'),
    'description' => __('descriptions.data-protection'),
    'keywords' => __('keywords.data-protection'),
    'type' => 'article',
])

@section('content')
<article class="break-words break-all whitespace-normal">
    <h1>{{ __('titles.data-protection') }}</h1>
    {!! __('text.data-protection-page') !!}
    </article>
@endsection
