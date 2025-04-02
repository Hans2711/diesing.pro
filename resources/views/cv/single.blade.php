@extends('layouts.app', ['title' => __('titles.cv'), 'description' => __('descriptions.cv'), 'active' => 'cv'])

@section('content')
    <h1>{{ __('text.cv') }}</h1>

    @php
        $fields = json_decode($cv->fields, true);
        $lists = $cv->lists()->get()->toArray();

        //dd($lists);

    @endphp

    @foreach($fields as $field)
        <div class="flex flex-col md:flex-row gap-2 md:gap-4 px-4 py-2 md:p-4 border rounded-lg shadow bg-white mb-3 items-start md:items-center">
            <p class="text-lg font-semibold text-gray-800 w-full md:w-1/3">{{ $field['title'] }}</p>
            <p class="text-gray-600 w-full md:w-2/3">{{ $field['content'] }}</p>
        </div>
    @endforeach

@foreach ($lists as $list)
    <div class="border rounded-lg shadow bg-white px-4 py-2 md:p-4 mb-3">
        <p class="text-lg font-semibold text-gray-800 w-full border-b-2 border-gray-800 pb-1">{{ $list['title'] }}</p>

        @php
            $items = json_decode($list['content'], true);
        @endphp

        @foreach ($items as $item)
            <div class="flex flex-col md:flex-row gap-2 md:gap-4 mx-2">
                <p class="text-lg font-semibold text-gray-800 w-full md:w-1/3 pl-4 md:pl-0">{{ $item['title'] }}</p>
                <div class="text-gray-600 w-full md:w-2/3">{!! $item['content'] !!}</div>
            </div>
        @endforeach
    </div>
@endforeach



@endsection
