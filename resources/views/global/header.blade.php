<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#F4EFE6] md:px-10 md:py-3 px-6 py-4">
    <div class="flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-3 md:gap-5 flex-wrap">
            <a class="@if ($active == 'portfolio') active @endif header-button" href="{{ url('/portfolio') }}">Portfolio</a>
            <a class="@if ($active == 'contact') active @endif header-button" href="{{ url('/kontakt') }}">Kontakt</a>
            <!-- <a class="header-button" href="#">Fotogallerie</a> -->
            <a class="@if ($active == 'private') active @endif header-button" href="{{ url('/privater-bereich') }}">Privater Bereich</a>
        </div>
        <a href="/">
            <div
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
                style='background-image: url("{{ Vite::asset('resources/logo/person_logo.jpeg') }}");'
            ></div>
        </a>
    </div>
</header>
