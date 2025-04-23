@extends('layouts.app', ['title' => __('titles.cv'), 'description' => __('descriptions.cv'), 'active' => 'cv'])

@section('content')
    <h1 class="">{{ __('text.cv') }}</h1>

    <a wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}/hp@diesing.pro" class="btn w-fit">Hans Peter (HP) Diesing {{ __('text.cv')}}</a>
@endsection

