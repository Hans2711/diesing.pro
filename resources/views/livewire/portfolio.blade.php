<div>

    <div class="md:flex">
        <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0">
            @foreach ($users as $user)
            @if ($user->portfolios->count() > 0)
            <li>
                @if (($selectedUser ? $selectedUser->id : null) == $user->id)
                <a alt="{{ $user->name }}" href="#" class="px-4 py-3 rounded-lg w-full ibtn active" aria-current="page">
                    {{ $user->name }}
                </a>
                @else
                <a alt="{{ $user->name }}" href="#" class="px-4 py-3 rounded-lg w-full ibtn" wire:click="selectUser($event.target.id)" id="{{ $user->id }}" >
                    {{ $user->name }}
                </a>
                @endif
            </li>
            @endif
            @endforeach
        </ul>
        <div class="md:px-6 md:pt-0 text-medium rounded-lg w-full">
            <div class="space-y-6 mb-8 md:columns-2" id="portfolio">
                @if ($portfolios)
                @foreach ($portfolios as $portfolio)
                @foreach ($portfolio as $item)
                <div class="max-w-lg w-full rounded overflow-hidden shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                    <a alt="{{ $item->name }}" href="{{ $item->url }}" target="_blank">
                        @if ($item->media && count($item->media) > 0)
                        <div class="relative h-0 pb-56 overflow-hidden">
                            <img class="absolute inset-0 w-full h-full object-cover" loading="lazy" src="{{ Storage::url($item->media[0]->path) }}" alt="{{ $item->name }}">
                        </div>
                        @endif
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $item->name }}</div>
                            <div class="text-gray-700 text-base break-words">{!! $item->description !!}</div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endforeach
                @endif
            </div>

            <div class="mb-5">
                @if ($selectedUser)
                <a alt="{{ __('text.contact') }}" wire:navigate.hover class="btn w-fit" href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/{{ $selectedUser->email }}" >{{ __('text.contact') }}</a>
                @endif
            </div>
        </div>
    </div>


</div>
