<div class="flex flex-col text-left">
    <h2 class="text-xl font-bold">Tools</h2>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.private-area') . '/' . __('url.notes'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'notes') tools-sidebar-active @endif">{{ __('text.notes') }}</a>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.private-area') . '/' . __('url.redirects'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'redirector') tools-sidebar-active @endif">Weiterleitungen</a>
    <a href="{{url(Config::get('app.locale') . '/' . __('url.private-area') . '/' . __('url.files'))}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'files') tools-sidebar-active @endif">Dateien</a>
    <a href="#" class="no-underline p-2 rounded bg-gray-200 px-3 mb-3 hover:bg-gray-300 @if ($active === 'placeholder') tools-sidebar-active @endif">Placeholder</a>
</div>
