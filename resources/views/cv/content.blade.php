<article>
<h1 class="">{{$user->name}}'s {{ __('text.cv') }}</h1>

@php
    $fields = json_decode($cv->fields, true);
    $lists = $cv->lists()->orderBy('sort_order')->get()->toArray();
@endphp

@foreach($fields as $field)
    <div class="flex flex-col md:flex-row md:gap-6 px-4 py-3 border rounded-xl shadow-sm bg-white dark:bg-secondary-light dark:text-white mb-4 items-start md:items-center">
        <p class="text-base md:text-lg font-semibold text-gray-800 dark:text-white w-full md:w-1/3">{{ $field['title'] }}</p>
        <p class="text-sm md:text-base text-gray-600 w-full md:w-2/3 dark:text-gray-100">{!! $field['content'] !!}</p>
    </div>
@endforeach

@foreach ($lists as $list)
    @php
        $items = json_decode($list['content'], true);
        $columns = match($list['column']) {
            1 => 'grid-cols-1',
            2 => 'grid-cols-2',
            3 => 'grid-cols-3',
            default => 'grid-cols-1',
        };
    @endphp

    <div class="border rounded-xl shadow-sm bg-white dark:bg-secondary-light px-4 py-4 mb-5">
        <p class="text-xl font-semibold text-gray-800 border-b-2 border-gray-900 dark:border-white pb-2 mb-4 dark:text-white">{{ $list['title'] }}</p>

        <div class="grid {{ $columns }} md:gap-3">
            @foreach ($items as $index => $item)
                <div class="flex flex-col @if ($list['column'] == 1) md:flex-row md:gap-6 md:items-center @elseif ($list['column'] > 1) flex-row md:gap-3  @endif ">
                    <p class="text-base md:text-lg font-semibold text-gray-800 dark:text-white @if ($list['column'] == 1) w-full md:w-1/3 @endif">{{ $item['title'] }}</p>
                    <div class="text-sm md:text-base text-gray-600 dark:text-gray-100 @if ($list['column'] == 1) w-full md:w-2/3 @endif">{!! $item['content'] !!}</div>
                </div>

                @if ((($index + 1) % $list['column'] == 0 && $index < count($items) - 1) || isset($print) && $index < count($items) - 1)
                    <div class="col-span-full">
                        <hr class="my-3 border-t-2 border-gray-300" />
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @if ($list['pagebreak'] > 0)
        <div class="page-break"></div>
    @endif
@endforeach

</article>
