@extends('layouts.account', ['title' => __('titles.account'), 'description' => __('descriptions.account'), 'keywords' => __('keywords.account'), 'active' => 'account', 'activeTool' => 'overview'])

@section('tool-content')
<livewire:account />
@endsection
