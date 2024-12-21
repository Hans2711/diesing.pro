<nav class="p-5 bg-white fixed z-30 w-full shadow md:flex md:items-center md:justify-between">
    <div class="flex justify-between items-center ">
      <span class="text-2xl font-[Poppins] cursor-pointer">
          <a wire:navigate.hover href="/">
        <img class="h-10 inline"
          src="{{ Vite::asset('resources/logo/DLogo.png') }}">
          </a>
      </span>

      <span class="text-3xl cursor-pointer mx-2 md:hidden block">
        <ion-icon name="menu" onclick="Menu(this)"></ion-icon>
      </span>
    </div>

    <ul class="md:flex md:items-center z-40 md:z-auto md:static absolute bg-white w-full left-0 md:w-auto md:py-0 md:pl-0 pl-3 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
      <li class="mx-2 my-6 md:my-0">
        <a wire:navigate.hover class="@if ($active == 'portfolio') active @endif header-button" href="{{ url('/portfolio') }}">Portfolio</a>
      </li>
      <li class="mx-2 my-6 md:my-0">
        <a wire:navigate.hover class="@if ($active == 'contact') active @endif header-button" href="{{ url('/kontakt') }}">Kontakt</a>
      </li>
      <li class="mx-2 my-6 md:my-0">
        <a wire:navigate.hover class="@if ($active == 'tester') active @endif header-button" href="{{ url('/tester') }}">A-B Tester</a>
      </li>
      <li class="mx-2 my-6 md:my-0">
        <a wire:navigate.hover class="@if ($active == 'private') active @endif header-button" href="{{ url('/privater-bereich') }}">Privater Bereich</a>
      </li>
    </ul>
</nav>

{{--
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#F4EFE6] md:px-10 md:py-3 px-6 py-4">
    <div class="flex flex-1 justify-end gap-8">
        <div class="flex items-center gap-3 md:gap-5 flex-wrap">
            <a wire:navigate.hover class="@if ($active == 'portfolio') active @endif header-button" href="{{ url('/portfolio') }}">Portfolio</a>
            <a wire:navigate.hover class="@if ($active == 'contact') active @endif header-button" href="{{ url('/kontakt') }}">Kontakt</a>
            <a wire:navigate.hover class="@if ($active == 'tester') active @endif header-button" href="{{ url('/tester') }}">A-B Tester</a>
            <a wire:navigate.hover class="@if ($active == 'share') active @endif header-button" href="{{ url('/share') }}">Share</a>
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
--}}
