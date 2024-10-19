@foreach ($redirects ?? [] as $redirect)
    <div class="flex p-3 mt-2 rounded border-solid border gap-2 justify-between" style="border-color: #6b7280; overflow: overlay;">
        <p class="hidden">{{ $redirect->id }}</p>
        <p class="">{{ $redirect->name }}</p>
        <p class="">{{ $redirect->target}}</p>
        <p class="">{{ $redirect->code}}</p>
        <button class="ml-2 p-2 py-2.5 px-4 bg-red-500 text-white rounded hover:bg-red-700 flex items-center delete-redirect" id="delete-redirect" data-id="{{ $redirect->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <button class="ml-2 p-2 py-2.5 px-4 bg-green-500 text-white rounded hover:bg-green-700 flex items-center edit-redirect" id="edit-redirect" data-id="{{ $redirect->id }}" data-name="{{ $redirect->name }}" data-target="{{ $redirect->target }}" code="{{ $redirect->code }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
            </svg>
        </button>
    </div>
@endforeach
