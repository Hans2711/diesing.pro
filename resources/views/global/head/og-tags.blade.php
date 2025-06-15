<meta property="og:title" content="{{ $title }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image" content="{{ Vite::asset('resources/logo/HPLogo.png') }}" />
@if (isset($description) && empty($from))
    <meta property="og:description" content="{{ $description }}" />
    <meta name="description" content="{{ $description }}" />
@endif
@if (isset($from))
@php
$descKey = isset($from) ? 'descriptions.' . $from : 'descriptions.default';
@endphp
    <meta property="og:description" content="{{ __($descKey) }}" />
    <meta name="description" content="{{ __($descKey) }}" />
@endif
<meta name="robots" content="index, follow"/>
<link rel="canonical" href="{{ url()->current() }}" />
