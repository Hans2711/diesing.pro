<title>
    @if (isset($title))
        {{ $title }}
    @else
        {{ config('app.name', 'Diesing') }}
    @endif
</title>
