@extends('layouts.minimal', [
    'title' => 'Share',
    'active' => 'share',
    'type' => 'article',
    'published_time' => $note->created_at ?? null,
    'modified_time' => $note->updated_at ?? null,
])

@section('content')
<article>
    <h1>Share</h1>
    <pre>
        {!! $note->content !!}
    </pre>
</article>
@endsection
