<footer class="bg-white border-t border-gray-200 py-8 dark:border-gray-700 dark:text-white dark:bg-gray-900">
    <div class="container mx-auto text-center">
        <div class="flex justify-center space-x-8 mb-4">
            <a alt="{{ __('text.imprint') }}" title="{{ __('text.imprint') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.imprint'))}}" class="text-gray-600 dark:text-white dark:hover:text-gray-100 hover:text-gray-900">{{ __('text.imprint') }}</a>
            <a alt="{{ __('text.data-protection') }}" title="{{ __('text.data-protection') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.data-protection'))}}" class="text-gray-600 dark:text-white dark:hover:text-gray-100 hover:text-gray-900">{{ __('text.data-protection') }}</a>
        </div>
        <div class="flex justify-center space-x-8 mb-4">
            <a alt="{{ __('alt.instagram') }}" title="{{ __('alt.instagram') }}" href="https://www.instagram.com/hans.dsg" target="_blank" class="">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 dark:fill-white"  viewBox="0 0 24 24" width="48px" height="48px">    <path d="M 8 3 C 5.239 3 3 5.239 3 8 L 3 16 C 3 18.761 5.239 21 8 21 L 16 21 C 18.761 21 21 18.761 21 16 L 21 8 C 21 5.239 18.761 3 16 3 L 8 3 z M 18 5 C 18.552 5 19 5.448 19 6 C 19 6.552 18.552 7 18 7 C 17.448 7 17 6.552 17 6 C 17 5.448 17.448 5 18 5 z M 12 7 C 14.761 7 17 9.239 17 12 C 17 14.761 14.761 17 12 17 C 9.239 17 7 14.761 7 12 C 7 9.239 9.239 7 12 7 z M 12 9 A 3 3 0 0 0 9 12 A 3 3 0 0 0 12 15 A 3 3 0 0 0 15 12 A 3 3 0 0 0 12 9 z"/></svg>

            </a>
            <a alt="{{ __('alt.linkedin') }}" title="{{ __('alt.linkedin') }}" href="https://www.linkedin.com/in/hans-peter-hp-diesing-3136b81a6" target="_blank" class="">
                <svg class="h-8 w-8 dark:fill-white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="48px" height="48px">    <path d="M19,3H5C3.895,3,3,3.895,3,5v14c0,1.105,0.895,2,2,2h14c1.105,0,2-0.895,2-2V5C21,3.895,20.105,3,19,3z M9,17H6.477v-7H9 V17z M7.694,8.717c-0.771,0-1.286-0.514-1.286-1.2s0.514-1.2,1.371-1.2c0.771,0,1.286,0.514,1.286,1.2S8.551,8.717,7.694,8.717z M18,17h-2.442v-3.826c0-1.058-0.651-1.302-0.895-1.302s-1.058,0.163-1.058,1.302c0,0.163,0,3.826,0,3.826h-2.523v-7h2.523v0.977 C13.93,10.407,14.581,10,15.802,10C17.023,10,18,10.977,18,13.174V17z"/></svg>
            </a>
            <a alt="{{ __('alt.discord') }}" title="{{ __('alt.discord') }}" href="https://www.discordapp.com/users/640313822145675287" target="_blank" class="">
                <svg class="h-8 w-8 dark:fill-white" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="48px" height="48px">    <path d="M19.952,5.672c-1.904-1.531-4.916-1.79-5.044-1.801c-0.201-0.017-0.392,0.097-0.474,0.281 c-0.006,0.012-0.072,0.163-0.145,0.398c1.259,0.212,2.806,0.64,4.206,1.509c0.224,0.139,0.293,0.434,0.154,0.659 c-0.09,0.146-0.247,0.226-0.407,0.226c-0.086,0-0.173-0.023-0.252-0.072C15.584,5.38,12.578,5.305,12,5.305S8.415,5.38,6.011,6.872 c-0.225,0.14-0.519,0.07-0.659-0.154c-0.14-0.225-0.07-0.519,0.154-0.659c1.4-0.868,2.946-1.297,4.206-1.509 c-0.074-0.236-0.14-0.386-0.145-0.398C9.484,3.968,9.294,3.852,9.092,3.872c-0.127,0.01-3.139,0.269-5.069,1.822 C3.015,6.625,1,12.073,1,16.783c0,0.083,0.022,0.165,0.063,0.237c1.391,2.443,5.185,3.083,6.05,3.111c0.005,0,0.01,0,0.015,0 c0.153,0,0.297-0.073,0.387-0.197l0.875-1.202c-2.359-0.61-3.564-1.645-3.634-1.706c-0.198-0.175-0.217-0.477-0.042-0.675 c0.175-0.198,0.476-0.217,0.674-0.043c0.029,0.026,2.248,1.909,6.612,1.909c4.372,0,6.591-1.891,6.613-1.91 c0.198-0.172,0.5-0.154,0.674,0.045c0.174,0.198,0.155,0.499-0.042,0.673c-0.07,0.062-1.275,1.096-3.634,1.706l0.875,1.202 c0.09,0.124,0.234,0.197,0.387,0.197c0.005,0,0.01,0,0.015,0c0.865-0.027,4.659-0.667,6.05-3.111 C22.978,16.947,23,16.866,23,16.783C23,12.073,20.985,6.625,19.952,5.672z M8.891,14.87c-0.924,0-1.674-0.857-1.674-1.913 s0.749-1.913,1.674-1.913s1.674,0.857,1.674,1.913S9.816,14.87,8.891,14.87z M15.109,14.87c-0.924,0-1.674-0.857-1.674-1.913 s0.749-1.913,1.674-1.913c0.924,0,1.674,0.857,1.674,1.913S16.033,14.87,15.109,14.87z"/></svg>
            </a>
        </div>
        <div class="zen-wrapper mb-4"></div>
        <div class="text-gray-500 dark:text-white dark:hover:text-gray-100">
            &copy; {{ date('Y') }} Diesing, {{ __('text.all-rights-reserved') }}
        </div>
    </div>
    @livewireStyles
    @livewireScriptConfig
</footer>
