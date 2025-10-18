@extends('layouts.app', [
    'title' => $user->name . "'s " . __('text.cv'),
    'description' => __('descriptions.cv'),
    'keywords' => __('keywords.cv'),
    'active' => 'cv',
    'dark' => false,
    'type' => 'article',
    'published_time' => $cv->created_at ?? null,
    'modified_time' => $cv->updated_at ?? null,
])

@section('content')
    @include('cv.content', ['cv' => $cv, 'user' => $user])

    <div class="">
        <a alt="{{ __('text.print') }}" title="{{ __('text.print') }}" class="btn md:w-fit" href="{{ url()->current() . '/print' }}" target="_blank">{{ __('text.print') }}</a>
    </div>
@endsection
