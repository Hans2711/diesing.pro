@extends('layouts.account', ['title' => __('text.account'), 'active' => 'account', 'activeTool' => 'account'])

@section('tool-content')
<div class="mt-3">
    <livewire:account-auth returnUrl="{{ $return_url }}" />
</div>
@endsection
