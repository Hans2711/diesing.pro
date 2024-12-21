<div>
    <h2>{{ __('text.players') }}</h2>
    <a wire:click="newPlayer" class="btn md:w-1/3">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" />
    </a>

    @foreach ($players as $key => $player)
        <div class="player mt-3">
            <div class="flex justify-between gap-4">
                <input type="text" wire:change="updatePlayerName($event.target.value, $event.target.id)" id="{{ $key }}" class="w-full rounded" value="{{ $player }}" placeholder="{{ empty($player) ? __('text.player-name') : ''}}" />
                <button class="btn btn-delete" id="{{ $key }}" wire:click="deletePlayer($event.target.id)" wire:confirm="{{ __('text.are-your-sure') }}">
                    <img class="w-6 h-6 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" />
                </button>
            </div>
        </div>
    @endforeach

    <p class="mt-3 text-lg">{{ __('text.number-of-teams') }}</p>
    <input type="number" class="rounded" value="{{ $numberOfTeams }}" wire:change="updateNumberOfTeams($event.target.value)"/>
    <a wire:click="generateTeams" class="btn mt-3 md:w-1/3">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/shuffle.svg') }}" />
    </a>

    @if (count($teams) > 0)
        <h2 class="mt-3">Teams</h2>
        <ul>
            @foreach ($teams as $team)
                <li class="rounded border-2 mb-3">
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
