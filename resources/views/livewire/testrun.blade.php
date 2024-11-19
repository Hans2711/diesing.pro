<div>
    @vite(['resources/css/diff-table.css'])

    <a href="{{url("/tester/testobject/{$testrun->testobject->id}")}}" class="flex gap-2 mb-3 align-center">
        <svg class="w-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>
        <span class="leading-none">Back</span>
    </a>


    @if (!empty($diffInstanceOne) || !empty($diffInstanceOne))
        <div class="border border-gray-200 px-3 pb-3">
            @if (!empty($diffInstanceOne))
                <p><strong>Instance One:</strong> {{ $diffInstanceOne->created_at}}</p>
            @endif
            @if (!empty($diffInstanceTwo))
                <p><strong>Instance Two:</strong> {{ $diffInstanceTwo->created_at}}</p>

                <form wire:submit="diff">
                    <div class="flex gap-4 mb-3">
                        <div class="flex-1">
                            <label for="renderName" class="block text-sm font-medium text-gray-700">Render Name</label>
                            <select wire:model.change="renderName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Inline">Inline</option>
                                <option value="Combined">Combined</option>
                                <option value="JsonHtml">JsonHtml</option>
                                <option value="SideBySide">SideBySide</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="detailLevel" class="block text-sm font-medium text-gray-700">Detail Level</label>
                            <select wire:model.change="detailLevel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="line">Line</option>
                                <option value="word">Word</option>
                                <option value="char">Char</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="btn" value="Diff" />
                </form>
            @endif
        </div>

        {!! isset($diffContent) ? $diffContent : '' !!}
        <br />
        @if (session()->has('diff'))
            <div class="alert alert-success mb-5">{{ session('diff') }}</div>
        @endif
    @endif

    <button class="btn mb-3" wire:click="createInstance">New Instance</button>

    @foreach ($testrun->testinstances as $testinstance)
        <div class="border border-gray-200 px-3 mb-4 pb-3 rounded">
            <p><strong>Name:</strong> {{ $testinstance->created_at}}</p>
            <p><strong>Status:</strong> {{ empty($testinstance->html) ? 'empty' : 'filled'}}</p>

            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
                <button class="btn" wire:click="deleteInstance({{$testinstance->id}})">Delete</button>
                <a class="btn" href="{{url("/tester/testinstance/{$testinstance->id}/fetch")}}" >Fetch</a>
                <a class="btn" href="{{url("/tester/testinstance/{$testinstance->id}")}}" >Details</a>
                <button class="btn" wire:click="addToDiff({{$testinstance->id}})">Add to Diff</button>
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
