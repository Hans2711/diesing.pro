<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    @viteReactRefresh
    @vite(['resources/js/app.jsx', 'resources/css/app.css'])
    @inertiaHead
</head>
<body class="bg-tertiary dark:bg-secondary-dark text-black dark:text-white">
    @inertia
</body>
</html>
