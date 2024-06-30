<div class="flex flex-col text-left">
    <h2 class="text-xl font-bold">Tools</h2>
    <a href="{{url('/privater-bereich/notizen')}}" class="p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active ?? '' == 'notes') tools-sidebar-active @endif">Notizen</a>
    <a href="#" class="p-2 rounded bg-gray-200 px-3 mb-3 hover:bg-gray-300 @if ($active ?? '' == 'placeholder') tools-sidebar-active @endif">Placeholder</a>
</div>

