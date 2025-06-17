@extends('layouts.app', ['title' => ($title ? $title : ''), 'description' => $description ?? null, 'keywords' => $keywords ?? null, 'active' => $active, 'activeTool' => $activeTool])

@section('content')
<h1>{{ $title }}</h1>
@csrf
<div class="flex flex-col md:flex-row md:justify-between w-full">
    <div class="order-2 md:order-1 mt-4 md:mt-0 md:mr-4 md:w-full">
        @yield('tool-content')
    </div>
    <div class="order-1 md:order-2 w-full md:w-1/5 md:hidden">
        @include('accounts.tools-sidebar', ['active' => $activeTool])
    </div>
</div>
@endsection
