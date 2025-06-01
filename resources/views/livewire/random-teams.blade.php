<div>
    <h2>{{ __('text.players') }}</h2>
    <a alt="{{ __('alt.add') }}" wire:click="newPlayer" wire:loading.class="opacity-50" class="btn md:w-1/3">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}"  alt="{{ __('alt.add') }}"/>
    </a>

    @foreach ($players as $key => $player)
        <div class="player mt-3">
            <div class="flex justify-between gap-4">
                <input type="text" wire:change="updatePlayerName($event.target.value, $event.target.id)" id="{{ $key }}" class="w-full rounded dark:bg-secondary-light" value="{{ $player }}" placeholder="{{ empty($player) ? __('text.player-name') : ''}}" />
                <button class="btn btn-delete" id="{{ $key }}" wire:click="deletePlayer($event.target.id)" wire:confirm="{{ __('text.are-you-sure') }}">
                    <img class="w-6 h-6 invert" src="{{ Vite::asset('resources/icons/close.svg') }}"  alt="{{ __('alt.close') }}"/>
                </button>
            </div>
        </div>
    @endforeach

    <p class="mt-3 text-lg">{{ __('text.number-of-teams') }}</p>
    <input type="number" class="rounded dark:bg-secondary-light" value="{{ $numberOfTeams }}" wire:change="updateNumberOfTeams($event.target.value)"/>
    <a alt="{{ __('alt.shuffle') }}" wire:click="generateTeams" wire:loading.class="opacity-50" class="btn btn-secondary mt-3 md:w-1/3">
        <img class="w-6 h-5 invert dark:invert-0" src="{{ Vite::asset('resources/icons/shuffle.svg') }}"  alt="{{ __('alt.shuffle') }}"/>
    </a>

    @if (count($teams) > 0)
            <h2 class="mt-3">Teams</h2>
            <ul>
                @foreach ($teams as $team)
                    <li class="rounded border-2 mb-3 border-primary-dark dark:border-primary-light">
                        <ul class="p-4">
                            @foreach ($team as $player)
                                <li>{{ $player }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
    @endif
</div>
