<title>
    @if (isset($title))
        {{ $title }} - Diesing
    @else
        {{ config('app.name', 'Diesing') }}</title>
    @endif
</title>
