<div>
    <button class="btn mb-3" wire:click="createRun">New Run</button>

    @foreach ($testobject->testruns as $testrun)
        <div class="border border-gray-200 px-3 mb-4">
            <p><strong>Name:</strong> {{ $testrun->created_at}}</p>

            <button class="btn" wire:click="deleteRun({{$testrun->id}})">Delete</button>
            <a class="btn" href="{{url("/tester/testrun/{$testrun->id}")}}" >Details</a>
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
