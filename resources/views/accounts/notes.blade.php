@extends('layouts.account', ['title' => __('titles.notes'), 'active' => 'account', 'activeTool' => 'notes'])
@disableMinifier

@section('tool-content')
<livewire:notes />
@endsection
