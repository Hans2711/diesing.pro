@extends('layouts.minimal', ['title' => 'Share', 'active' => 'share'])

@section('content')
<pre>
{!! $note->content !!}
</pre>
@endsection
