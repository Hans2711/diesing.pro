@extends('layouts.app', ['title' => __('titles.rt-share'), 'description' => __('descriptions.rt-share'), 'active' => 'rt-share'])

@section('content')
<h1>{{ __('text.rt-share') }}</h1>
<p>{!! __('descriptions.rt-share') !!}</p>
<iframe src="https://rt-share.diesing.pro" class="w-full h-full" ></iframe>
@endsection
