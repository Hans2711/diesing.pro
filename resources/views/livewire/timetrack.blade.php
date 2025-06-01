<div class="space-y-5">
    <h2 class="text-2xl font-semibold">{{ $timetrack->title }}</h2>

    <div class="flex flex-wrap items-end gap-4 bg-gray-100 dark:bg-gray-900 p-4 rounded">
        <div>
            <label for="start" class="block text-sm mb-1">Von</label>
            <input id="start" type="datetime-local" class="input dark:bg-secondary-light" wire:model.lazy="searchStart">
        </div>
        <div>
            <label for="end" class="block text-sm mb-1">Bis</label>
            <input id="end" type="datetime-local" class="input dark:bg-secondary-light" wire:model.lazy="searchEnd">
        </div>
    </div>

    <p class="text-lg">
        Gesamt aller Einträge: <span class="font-semibold">{{ $totalDisplay }}</span><br>
        Gefilterter Zeitraum: <span class="font-semibold">{{ $searchTotalDisplay }}</span>
    </p>

    @forelse ($displayTimes as $row)
        <div wire:transition.fade>
        <div class="grid grid-cols-3 gap-x-6 items-baseline border p-2 text-base rounded">
        <div class="truncate">
            @if (isset($row['link']) && $row['link'])
                <a alt="" href="{{ $row['link'] }}" target="_blank" class="text-blue-500 hover:underline">
            @endif
            {{ $row['title'] }}
            @if (isset($row['link']) && $row['link'])
                </a>
            @endif
        </div>
            <div class="">{{ $row['durationDisplay'] }}</div>
            <div>{{ \Carbon\Carbon::parse($row['time'])->format('d.m.Y H:i') }}</div>
        </div>
        </div>
    @empty
        <p class="italic">Keine Einträge im Zeitraum :-|</p>
    @endforelse
</div>
