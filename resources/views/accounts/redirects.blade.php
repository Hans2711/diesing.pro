@extends('layouts.account', ['title' => __('titles.redirects'), 'active' => 'account', 'activeTool' => 'redirects'])

@section('tool-content')
<livewire:redirects />
@endsection
