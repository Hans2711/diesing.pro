@extends('layouts.app', ['title' => $user->name . "'s " . __('text.cv'), 'description' => __('descriptions.cv'), 'active' => 'cv', 'dark' => false])

@section('content')
    @include('cv.content', ['cv' => $cv, 'user' => $user])

    <div class="">
        <a class="btn md:w-fit" href="{{ url()->current() . '/print' }}" target="_blank">{{ __('text.print') }}</a>
    </div>
@endsection
