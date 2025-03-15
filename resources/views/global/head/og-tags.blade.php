<meta name="og:title" content="{{ $title }}" />
<meta name="og:url" content="{{ url()->current() }}" />
<meta name="og:image" content="{{ Vite::asset('resources/logo/DLogo.png') }}" />
<meta name=”name” content=”content”>
<meta name="robots" content="index, follow"/>
@if (isset($description))
    <meta name="description" content="{{ $description }}"/>
@endif
