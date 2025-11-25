<div class="flex flex-col text-left md:hidden">
    <h2 class="text-xl font-bold">{{ __('text.tools') }}</h2>
    <a alt="{{ __('text.account') }}" title="{{ __('text.account') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/')}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 dark:bg-secondary-light hover:bg-gray-300 @if ($active === 'account') tools-sidebar-active @endif">{{ __('text.account') }}</a>
    <a alt="{{ __('text.notes') }}" title="{{ __('text.notes') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.notes'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 dark:bg-secondary-light hover:bg-gray-300 @if ($active === 'notes') tools-sidebar-active @endif">{{ __('text.notes') }}</a>
    <a alt="{{ __('text.redirects') }}" title="{{ __('text.redirects') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.redirects'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 dark:bg-secondary-light hover:bg-gray-300 @if ($active === 'redirects') tools-sidebar-active @endif">{{ __('text.redirects') }}</a>
</div>
