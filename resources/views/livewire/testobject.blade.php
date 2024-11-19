<div>
    <a href="{{url("/tester/")}}" class="flex gap-2 mb-3 align-center">
        <svg class="w-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
        <span class="leading-none">Back</span>
    </a>

    <button class="btn mb-3" wire:click="createRun">New Testrun</button>

    @foreach ($testobject->testruns as $testrun)
        <div class="border border-gray-200 px-3 mb-4 pb-3 rounded">
            <p><strong>Name:</strong> {{ $testrun->created_at}}</p>

            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
                <button class="btn" wire:click="deleteRun({{$testrun->id}})">Delete</button>
                <a class="btn" href="{{url("/tester/testrun/{$testrun->id}")}}" >Details</a>
            </div>
        </div>
    @endforeach

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
