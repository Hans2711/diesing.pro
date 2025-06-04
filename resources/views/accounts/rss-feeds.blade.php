@extends('layouts.account', ['title' => __('titles.rss-feeds'), 'active' => 'account', 'activeTool' => 'rss-feeds'])

@section('tool-content')
<livewire:rss-feeds />
@endsection
