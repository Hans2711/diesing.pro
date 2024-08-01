<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#F4EFE6] px-10 py-3">
    <div class="flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-5 md:gap-9 flex-wrap">
            <a class="text-[#1C160C] text-md font-medium leading-normal @if ($active == 'portfolio') active @endif" href="{{(url('/portfolio'))}}">Portfolio</a>
            <a class="text-[#1C160C] text-md font-medium leading-normal @if ($active == 'contact') active @endif" href="{{url('/kontakt')}}">Kontakt</a>
            <a class="text-[#1C160C] text-md font-medium leading-normal" href="#">Fotogallerie</a>
            <a class="text-[#1C160C] text-md font-medium leading-normal @if ($active == 'private') active @endif" href="{{url('/privater-bereich')}}">Privater Bereich</a>
        </div>
        <a href="/">
            <div
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-12"
                style='background-image: url("{{ Vite::asset('resources/logo/logo.png') }}");'
            ></div>
        </a>
    </div>
</header>
