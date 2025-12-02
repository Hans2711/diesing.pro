{{-- Font preloading for critical performance --}}
{{-- Preload only the Regular weight font for immediate text rendering --}}
{{-- This eliminates the font download waterfall by starting the download early --}}
<link rel="preload" href="{{ Vite::asset('resources/font/static/FiraCode-Regular.ttf') }}" as="font" type="font/ttf" crossorigin="anonymous">

{{-- 
Note: Other font weights (Medium, SemiBold, Bold) are intentionally NOT preloaded
to avoid blocking critical rendering. They will load on-demand when needed.
--}}