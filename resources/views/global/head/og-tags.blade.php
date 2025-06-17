<meta property="og:title" content="{{ $title }}" />
<meta property="og:image" content="{{ Vite::asset('resources/logo/HPLogo.png') }}" />
@if (isset($description) && empty($from))
    <meta property="og:description" content="{{ $description }}" />
    <meta name="description" content="{{ $description }}" />
@endif
@if (isset($keywords) && empty($from))
    <meta name="keywords" content="{{ $keywords }}" />
@endif
@if (isset($from))
@php
$descKey = isset($from) ? 'descriptions.' . $from : 'descriptions.default';
$keywordsKey = isset($from) ? 'keywords.' . $from : 'keywords.default';
@endphp
    <meta property="og:description" content="{{ __($descKey) }}" />
    <meta name="description" content="{{ __($descKey) }}" />
    <meta name="keywords" content="{{ __($keywordsKey) }}" />
@endif
<meta name="robots" content="index, follow"/>

@php
    $canonicalUrl = url()->current();
    if (!empty($from)) {
        $canonicalUrl = url(app()->getLocale() . '/' . __('url.' . $from));
    }
@endphp
<link rel="canonical" href="{{ $canonicalUrl }}" />
<meta property="og:url" content="{{ $canonicalUrl }}" />
