<div>
    <h2>{{ __('text.players') }}</h2>
    @if(!$teamsLocked)
        <a alt="{{ __('alt.add') }}" title="{{ __('alt.add') }}" wire:click="newPlayer" wire:loading.class="opacity-50" class="btn md:w-1/3">
            <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}"  alt="{{ __('alt.add') }}" title="{{ __('alt.add') }}"/>
        </a>

        @foreach ($players as $key => $player)
            <div class="player mt-3">
                <div class="flex justify-between gap-4">
                    <input type="text" wire:change="updatePlayerName($event.target.value, $event.target.id)" id="{{ $key }}" class="w-full rounded dark:bg-secondary-light" value="{{ $player }}" placeholder="{{ empty($player) ? __('text.player-name') : ''}}" />
                    <button class="btn btn-delete" id="{{ $key }}" wire:click="deletePlayer($event.target.id)" wire:confirm="{{ __('text.are-you-sure') }}">
                        <img class="w-6 h-6 invert" src="{{ Vite::asset('resources/icons/close.svg') }}"  alt="{{ __('alt.close') }}" title="{{ __('alt.close') }}"/>
                    </button>
                </div>
            </div>
        @endforeach

        <p class="mt-3 text-lg">{{ __('text.number-of-teams') }}</p>
        <input type="number" class="rounded dark:bg-secondary-light" value="{{ $numberOfTeams }}" wire:change="updateNumberOfTeams($event.target.value)"/>
        <a alt="{{ __('alt.shuffle') }}" title="{{ __('alt.shuffle') }}" wire:click="generateTeams" wire:loading.class="opacity-50" class="btn btn-secondary mt-3 md:w-1/3">
            <img class="w-6 h-5 invert dark:invert-0" src="{{ Vite::asset('resources/icons/shuffle.svg') }}"  alt="{{ __('alt.shuffle') }}" title="{{ __('alt.shuffle') }}"/>
        </a>
        <a alt="{{ __('alt.lock') }}" title="{{ __('alt.lock') }}" wire:click="lockTeams" wire:loading.class="opacity-50" class="btn btn-secondary mt-3 md:w-1/3">
            <img class="w-6 h-5 invert dark:invert-0" src="{{ Vite::asset('resources/icons/save-outline.svg') }}"  alt="{{ __('alt.lock') }}" title="{{ __('alt.lock') }}"/>
        </a>
    @else
        <a alt="{{ __('alt.unlock') }}" title="{{ __('alt.unlock') }}" wire:click="unlockTeams" wire:loading.class="opacity-50" class="btn btn-secondary mt-3 md:w-1/3">
            <img class="w-6 h-5 invert dark:invert-0" src="{{ Vite::asset('resources/icons/lock-open.svg') }}"  alt="{{ __('alt.unlock') }}" title="{{ __('alt.unlock') }}"/>
        </a>
    @endif

    @if (count($teams) > 0)
        <h2 class="mt-3">Teams</h2>
        <ul>
            @foreach ($teams as $tKey => $team)
                <li class="rounded border-2 mb-3 border-primary-dark dark:border-primary-light p-4">
                    @if(!$teamsLocked)
                        <input type="text" wire:change="updateTeamName($event.target.value, {{ $tKey }})" value="{{ $team['name'] }}" class="mb-2 w-full rounded dark:bg-secondary-light" />
                    @else
                        <div class="flex items-center gap-2 mb-2">
                            <strong>{{ $team['name'] }}</strong>
                            <button class="btn btn-secondary" wire:click="updateWins({{ $tKey }}, 1)">
                                <img class="w-4 h-4 invert dark:invert-0" src="{{ Vite::asset('resources/icons/add.svg') }}" alt="{{ __('alt.plus') }}" title="{{ __('alt.plus') }}" />
                            </button>
                            <span>{{ $games[count($games)-1]['teams'][$tKey]['wins'] ?? 0 }}</span>
                            <button class="btn btn-secondary" wire:click="updateWins({{ $tKey }}, -1)">
                                <img class="w-4 h-4 invert dark:invert-0" src="{{ Vite::asset('resources/icons/minus.svg') }}" alt="{{ __('alt.minus') }}" title="{{ __('alt.minus') }}" />
                            </button>
                        </div>
                    @endif
                    <ul>
                        @foreach ($team['players'] as $player)
                            <li>{{ $player }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif

    @if(count($games) > 0)
        <h2 class="mt-3">{{ __('text.game-history') }}</h2>
        <ul>
            @foreach ($games as $gKey => $game)
                <li class="rounded border mb-3 p-3">
                    <strong>Game {{ $gKey + 1 }}</strong>
                    <ul>
                        @foreach ($game['teams'] as $team)
                            <li>{{ $team['name'] }} - {{ __('text.wins') }}: {{ $team['wins'] }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @endif
</div>
