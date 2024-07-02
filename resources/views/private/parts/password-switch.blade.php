<div class="mt-3 text-center sm:text-left flex flex-col gap-y-3 sm:flex-row sm:gap-x-3">
    <div class="flex items-center ml-0 gap-x-3 border-solid border p-2 rounded mt-1 sm:mt-0 w-fit" style="border-color: #6b7280;">
        <label>Passwort?</label>
        <label class="relative inline-flex cursor-pointer items-center">
            <input id="enable-password" type="checkbox" class="peer sr-only" value="1" />
            <label for="enable-password" class="hidden"></label>
            <div class="peer h-4 w-11 rounded-full border bg-slate-200 after:absolute after:-top-1 after:left-0 after:h-6 after:w-6 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-300 peer-checked:after:translate-x-full peer-focus:ring-green-300"></div>
        </label>
    </div>
    @include('private.modals.parts.floating-label-input', ['id' => 'password', 'name' => 'password', 'label' => 'Passwort', 'wrapperClass' => 'hidden'])
</div>
