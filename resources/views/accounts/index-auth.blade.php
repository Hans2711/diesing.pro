@extends('layouts.account', ['title' => __('titles.account'), 'description' => __('descriptions.account'), 'active' => 'account', 'activeTool' => 'account', 'activeTool' => 'overview'])

@section('tool-content')
<div class="mt-3">
    <livewire:account-auth returnUrl="{{ $return_url }}" />
</div>
@endsection
