<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<p>New item in feed {{ $url }}</p>
<p><a href="{{ $link }}">{{ $title }}</a></p>
@if(!empty($description))
<p>{{ $description }}</p>
@endif
@if(!empty($pubDate))
<p><small>{{ $pubDate }}</small></p>
@endif
</body>
</html>
