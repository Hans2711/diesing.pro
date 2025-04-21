@extends('layouts.account', ['title' => __('text.account'), 'description' => __('descriptions.account'), 'active' => 'account', 'activeTool' => 'overview'])

@section('tool-content')
<livewire:account />
@endsection
