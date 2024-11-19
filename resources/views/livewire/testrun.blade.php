<div>
    <button class="btn mb-3" wire:click="createInstance">New Instance</button>

    @foreach ($testrun->testinstances as $testinstance)
        <div class="border border-gray-200 px-3 mb-4">
            <p><strong>Name:</strong> {{ $testinstance->created_at}}</p>
            <p><strong>Status:</strong> {{ empty($testinstance->html) ? 'empty' : 'filled'}}</p>

            <button class="btn" wire:click="deleteInstance({{$testinstance->id}})">Delete</button>
            <a class="btn" href="{{url("/tester/testinstance/{$testinstance->id}/fetch")}}" >Fetch</a>
            <a class="btn" href="{{url("/tester/testinstance/{$testinstance->id}")}}" >Details</a>
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
