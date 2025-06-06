<!doctype html>
<html lang="{{ str_replace('_', '-', $locale ?? app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
</head>
    <body style="font-family: Arial, sans-serif; margin: 20px 0; padding: 0;">
        <div style="max-width: 600px; width: 100%; margin: 0 auto; padding: 0 20px;">

        <header style="text-align: center; margin-bottom: 20px;">
            <div style="display: inline-block; width: 120px;">
                <img src="{{ Vite::asset('resources/logo/HPLogo.png') }}" alt="Hans Peter Diesing" width="120" style="display: block; max-width: 100%;">
            </div>
        </header>

        <main>
            @yield('content')
        </main>

        <footer style="text-align: center; margin-top: 20px; font-size: 12px;">
            <a href="{{ url(($locale ?? app()->getLocale()) . '/' . __('url.imprint')) }}" style="margin-right: 10px;">{{ __('text.imprint') }}</a>
            <a href="{{ url(($locale ?? app()->getLocale()) . '/' . __('url.data-protection')) }}">{{ __('text.data-protection') }}</a>
        </footer>
        </div>
    </body>
</html>
