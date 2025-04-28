<div class="relative {{ isset($wrapperClass) ? $wrapperClass : '' }} ">
    <input {{ isset($required) ? 'required' : '' }} type="{{ isset($type) && in_array($type, ['text', 'password', 'number']) ? $type : 'text' }}" id="{{ $id }}" name="{{ $name }}" class="block p-2 py-2.5 w-full text-sm text-gray-900 bg-white rounded border border-blue-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer {{ isset($inputClass) ? $inputClass : '' }} dark:text-white dark:bg-secondary-light" placeholder=" "
    @if (isset($livewire) && $livewire)
        wire:model="{{ $name }}"
    @endif
    @if (isset($tabindex))
        tabindex="{{ $tabindex }}"
    @endif
    {{ isset($value) ? 'value=' . $value : '' }}
    {!! isset($additional) ? $additional : '' !!}
    />
    <label for="{{ $id }}" class="ml-1.5 text-black absolute p-0 text-sm duration-300 transform -translate-y-4 scale-75 left-1 top-2 z-10 origin-[0] px-1 bg-white peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 dark:bg-secondary-light dark:text-gray-400 rounded dark:peer-focus:text-white">{{ $label }}{{ isset($required) ? ' *' : ''}}</label>
</div>
