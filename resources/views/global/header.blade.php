<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#F4EFE6] md:px-10 md:py-3 px-6 py-4">
    <div class="flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-3 md:gap-5 flex-wrap">
            <a wire:navigate.hover class="@if ($active == 'portfolio') active @endif header-button" href="{{ url('/portfolio') }}">Portfolio</a>
            <a wire:navigate.hover class="@if ($active == 'contact') active @endif header-button" href="{{ url('/kontakt') }}">Kontakt</a>
            <a wire:navigate.hover class="@if ($active == 'tester') active @endif header-button" href="{{ url('/tester') }}">A-B Tester</a>
            <!-- <a class="header-button" href="#">Fotogallerie</a> -->
            <a wire:navigate.hover class="@if ($active == 'private') active @endif header-button" href="{{ url('/privater-bereich') }}">Privater Bereich</a>
        </div>
        <a wire:navigate.hover href="/">
            <div
                class="bg-center bg-no-repeat bg-cover size-12"
                style='background-image: url("{{ Vite::asset('resources/logo/DLogo.png') }}");'
            ></div>
        </a>
    </div>
</header>
