<div>
    <div class="flex flex-wrap gap-3 mb-5">
        @foreach ($users as $user)
            @if ($user->portfolios->count() > 0)
                <button class="header-button @if (($selectedUser ? $selectedUser->id : null) == $user->id) active @endif" id="{{ $user->id }}" wire:click="selectUser($event.target.id)">{{ $user->name }}</button>
            @endif
        @endforeach
    </div>

    <div class="mb-5">
        @if ($selectedUser)
            <a wire:navigate.hover class="btn w-fit" href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/{{ $selectedUser->email }}" >{{ __('text.contact') }}</a>
        @endif
    </div>

    <div class="md:columns-2 columns-1 mb-8" id="portfolio">
        @if ($portfolios)
            @foreach ($portfolios as $portfolio)
                @foreach ($portfolio as $item)
                    <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
                        <a href="{{$item->url}}" target="_blank">
                            @if ($item->media)
                                <div class="relative h-0 pb-56">
                                    <img class="absolute top-0 left-0 w-full h-full object-cover" src="{{ Storage::url($item->media[0]->path) }}">
                                </div>
                            @endif
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{$item->name}}</div>
                                <div class="text-gray-700 text-base break-all">{!! $item->description !!}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
</div>
