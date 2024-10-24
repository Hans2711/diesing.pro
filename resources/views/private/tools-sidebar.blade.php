<div class="flex flex-col text-left">
    <h2 class="text-xl font-bold">Tools</h2>
    <a href="{{url('/privater-bereich/notizen')}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'notes') tools-sidebar-active @endif">Notizen</a>
    <a href="{{url('/privater-bereich/weiterleitungen')}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'redirector') tools-sidebar-active @endif">Weiterleitungen</a>
    <a href="{{url('/privater-bereich/dateien')}}" class="no-underline p-2 px-3 mb-3 rounded bg-gray-200 hover:bg-gray-300 @if ($active === 'files') tools-sidebar-active @endif">Dateien</a>
    <a href="#" class="no-underline p-2 rounded bg-gray-200 px-3 mb-3 hover:bg-gray-300 @if ($active === 'placeholder') tools-sidebar-active @endif">Placeholder</a>
</div>
