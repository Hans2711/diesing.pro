<!doctype html>
<html lang="{{ str_replace('_', '-', $locale ?? app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif;">
        <header style="text-align: center; margin-bottom: 20px;">
            <div style="display: inline-block; width: 120px;"> <!-- Adjust width as needed -->
                @include('global.logo')
            </div>
        </header>

    <main>
        @yield('content')
    </main>

    <footer style="text-align: center; margin-top: 20px; font-size: 12px;">
        <a href="{{ url(($locale ?? app()->getLocale()) . '/' . __('url.imprint')) }}" style="margin-right: 10px;">
            {{ __('text.imprint') }}
        </a>
        <a href="{{ url(($locale ?? app()->getLocale()) . '/' . __('url.data-protection')) }}">
            {{ __('text.data-protection') }}
        </a>
    </footer>
</body>
</html>
