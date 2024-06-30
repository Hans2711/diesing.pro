@extends('layouts.app', ['title' => 'Portfolio', 'active' => 'portfolio'])

@section('content')
    <h1>Portfolio</h1>

    <div class="md:columns-2 columns-1 mb-8" id="portfolio">
        @foreach ($projects as $project)
            <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
                <a href="{{$project['link']}}" target="_blank">
                    <div class="relative h-0 pb-56">
                        <img class="absolute top-0 left-0 w-full h-full object-cover" src="{{Vite::asset($project['image'])}}">
                    </div>
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{$project['title']}}</div>
                        <p class="text-gray-700 text-base">{{$project['description']}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
