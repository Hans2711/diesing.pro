@extends('layouts.private', ['title' => 'Weiterleitungen', 'active' => 'private', 'activeTool' => 'redirector', 'hideToolbar' => false])

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
    <livewire:redirects />
@endsection
