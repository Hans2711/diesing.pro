<header class="bg-gradient-to-br from-red-100 via-gray-50 to-gray-100">
    <nav class="navbar p-6">
        <div class="flex justify-center p-4 pt-5 rounded-lg md:flex-row flex-wrap gap-y-2 gap-x-3"  style="background: linear-gradient(to right, #d24624, #fba665);">
            <div class="flex flex-shrink-0 items-center w-full md:w-auto justify-center">
                <a href="{{(url('/'))}}">
                    <img class="h-28 md:h-16 w-auto" src="{{ Vite::asset('resources/logo/logo.png') }}" alt="Diesing">
                </a>
            </div>

            <a href="{{(url('/portfolio'))}}" class="header-btn @if ($active == 'portfolio') header-btn-active @endif">
                Portfolio
            </a>
            <a href="{{url('/kontakt')}}" class="header-btn @if ($active == 'contact') header-btn-active @endif">
                Kontakt
            </a>
            <a href="#" class="header-btn">
                Fotogallerie
            </a>
            <a href="{{url('/privater-bereich')}}" class="header-btn">
                Privater Bereich
            </a>
        </div>
    </nav>
</header>
