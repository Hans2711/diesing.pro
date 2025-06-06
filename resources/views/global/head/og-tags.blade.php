<meta property="og:title" content="{{ $title }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:image" content="{{ Vite::asset('resources/logo/HPLogo.png') }}" />
@if (isset($description))
    <meta property="og:description" content="{{ $description }}" />
    <meta name="description" content="{{ $description }}" />
@endif
<meta name="robots" content="index, follow"/>
<link rel="canonical" href="{{ url()->current() }}" />
