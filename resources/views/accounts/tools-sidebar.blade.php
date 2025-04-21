<div class="flex flex-col text-left md:hidden">
    <h2 class="text-xl font-bold">{{ __('text.tools') }}</h2>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/')}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'account') tools-sidebar-active @endif">{{ __('text.account') }}</a>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.tester') . '/')}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'tester') tools-sidebar-active @endif">{{ __('text.tester') }}</a>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.notes'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'notes') tools-sidebar-active @endif">{{ __('text.notes') }}</a>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.redirects'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'redirects') tools-sidebar-active @endif">{{ __('text.redirects') }}</a>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.portfolio'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'portfolio') tools-sidebar-active @endif">{{ __('text.portfolio') }}</a>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.cv'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'cv') tools-sidebar-active @endif">{{ __('text.cv') }}</a>
</div>
