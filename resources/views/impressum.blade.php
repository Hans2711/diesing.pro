@extends('layouts.app', [
    'title' => __('titles.imprint'),
    'description' => __('descriptions.imprint'),
    'keywords' => __('keywords.imprint'),
    'type' => 'article',
])

@section('content')
<article>
    <h1>{{ __('titles.imprint') }}</h1>
    {!! __('text.imprint-page') !!}
</article>
@endsection
