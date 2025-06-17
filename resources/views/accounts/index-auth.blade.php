@extends('layouts.account', ['title' => __('titles.account'), 'description' => __('descriptions.account'), 'keywords' => __('keywords.account'), 'active' => 'account', 'activeTool' => 'account', 'activeTool' => 'overview'])

@section('tool-content')
<div class="mt-3">
    <div class="mb-5">
        {!! __('text.account_text') !!}
    </div>
    @if (!empty($from))
    <div class="mb-5">
        {!! __('text.account-auth.' . $from) !!}
    </div>
    @endif
    <livewire:account-auth returnUrl="{{ $return_url }}" />
</div>
@endsection
