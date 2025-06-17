@extends('layouts.app', ['title' => __('titles.cv'), 'description' => __('descriptions.cv'), 'keywords' => __('keywords.cv'), 'active' => 'cv'])

@section('content')
<div class="overflow-x-hidden">
    <h1 class="md:text-center md:origin-bottom">{{ __('text.cv-headline') }}</h1>
    <div class="md:text-center">
        <p class="mb-5 lg:w-2/3 md:mx-auto md:text-center">
            {{ __('text.cv-intro') }}
        </p>
    </div>

    <h2 class="mt-10 mb-5 md:text-center origin-bottom">{{ __('text.cv-section-personal') }}</h2>
    <div class="">
        <ul class="mb-5 lg:w-2/4 w-full md:w-3/4 md:mx-auto list-none grid grid-cols-2 mx-auto">
            <li class=" mb-1"><strong>{{ __('text.cv-fullname-label') }}</strong></li>
            <li class=" mb-1">{{ __('text.cv-fullname') }}</li>
            <li class=" mb-1"><strong>{{ __('text.cv-nickname-label') }}</strong></li>
            <li class=" mb-1">{{ __('text.cv-nickname') }}</li>
            <li class=" mb-1"><strong>{{ __('text.cv-birthday-label') }}</strong></li>
            <li class=" mb-1">{{ __('text.cv-birthday') }}</li>
            <li class=""><strong>{{ __('text.cv-nationality-label') }}</strong></li>
            <li class="">{{ __('text.cv-nationality') }}</li>
        </ul>
    </div>

    <div class="text-center mt-10">
        <a alt="{{ __('text.contact') }}" title="{{ __('text.contact') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="btn btn-secondary w-fit mx-auto gap-4">
            <img class="w-6 h-6 invert dark:invert-0" src="{{ Vite::asset('resources/icons/envelope.svg') }}" alt="Send" title="Send" />
            {{ __('text.cv-contact-button') }}
        </a>
    </div>

    <div class="hidden print-only text-center mt-10">
        <a alt="{{ __('text.contact') }}" title="{{ __('text.contact') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}" class="btn btn-secondary w-fit mx-auto gap-4">
            <img class="w-6 h-6 invert dark:invert-0" src="{{ Vite::asset('resources/icons/cv.svg') }}" alt="Send" title="Send" />
            {{ __('text.cv-website') }}
        </a>
    </div>

    <div class="break-page"></div>

    <h2 class="mt-10 mb-5 text-center origin-bottom">{{ __('text.cv-section-experience') }}</h2>

    <div class="lg:container">
        <div class="flex flex-col lg:grid grid-cols-9 mx-auto p-2 text-blue-50">

            <!-- Position: Backend Developer -->
            <div class="flex flex-row-reverse lg:contents">
                <div class="primary-gradient left timeline-card group col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl">
                            <a alt="Netigo GmbH" title="Netigo GmbH" class="underline" href="https://www.netigo.de" target="_blank" rel="noopener noreferrer">Netigo GmbH</a>, Düsseldorf
                        </h3>
                        <img src="{{ Vite::asset('resources/images/netigo.svg') }}" class="w-16 h-auto ml-4 invert dark:invert-0"  alt="{{ __('alt.netigo_logo') }}" title="{{ __('alt.netigo_logo') }}"/>
                    </div>
                    <p class="text-sm mb-2">{{ __('text.cv-backend-period') }}</p>
                    <hr class="mb-2" />
                    <p class="text-sm">
                        <strong>{{ __('text.cv-backend-technologies-label') }}</strong><br class="" />
                        {{ __('text.cv-backend-technologies') }}
                    </p>
                    <p class="text-sm">
                        <strong>{{ __('text.cv-backend-focus-label') }}</strong><br class="" />
                        {{ __('text.cv-backend-focus') }}
                    </p>
                    <p class="text-sm ">
                        <strong>{{ __('text.cv-backend-projects-label') }}</strong><br class="" />
                        {!! __('text.cv-backend-projects') !!}
                    </p>
                </div>
                <div class="col-start-5 col-end-6 lg:mx-auto relative mr-5">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
                </div>
            </div>

            <!-- Position: Apprenticeship -->
            <div class="flex lg:contents">
                <div class="col-start-5 col-end-6 mr-5 lg:mx-auto relative">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
                </div>
                <div class="primary-gradient timeline-card col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl">
                            <a alt="Netigo GmbH" title="Netigo GmbH" class="underline" href="https://www.netigo.de" target="_blank" rel="noopener noreferrer">Netigo GmbH</a>, Düsseldorf
                        </h3>
                        <img src="{{ Vite::asset('resources/images/netigo.svg') }}" class="w-16 h-auto ml-4 invert dark:invert-0"  alt="{{ __('alt.netigo_logo') }}" title="{{ __('alt.netigo_logo') }}"/>
                    </div>
                    <p class="text-sm mb-2">{{ __('text.cv-apprenticeship-period') }}</p>
                    <hr class="mb-2" />
                    <p class="text-sm">
                        <strong>{{ __('text.cv-apprenticeship-label') }}</strong><br class="" />
                        {{ __('text.cv-apprenticeship-description') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="break-page"></div>
    <h2 class="mt-10 mb-5 text-center origin-bottom">{{ __('text.cv-section-education') }}</h2>
    <div class="lg:container">
        <div class="flex flex-col lg:grid grid-cols-9 mx-auto p-2 text-blue-50">

            <!-- Berufskolleg Hilden -->
            <div class="flex flex-row-reverse lg:contents">
                <div class="primary-gradient left timeline-card col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl">
                            <a alt="Berufskolleg Hilden" title="Berufskolleg Hilden" class="underline" href="https://berufskolleg.de/" target="_blank" rel="noopener noreferrer">Berufskolleg Hilden</a>
                        </h3>
                        <img src="{{ Vite::asset('resources/images/bkh.webp') }}" class="w-10 h-auto ml-4 "  alt="{{ __('alt.bkh_logo') }}" title="{{ __('alt.bkh_logo') }}"/>
                    </div>
                    <p class="text-sm mb-2">{{ __('text.cv-school1-period') }}</p>
                    <hr class=" mb-2" />
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school1-field-label') }}</strong><br class="" />
                        {{ __('text.cv-school1-field') }}
                    </p>
                </div>
                <div class="col-start-5 col-end-6 lg:mx-auto relative mr-5">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
                </div>
            </div>

            <!-- Lessing Berufskolleg -->
            <div class="flex lg:contents">
                <div class="col-start-5 col-end-6 mr-5 lg:mx-auto relative">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
                </div>
                <div class="primary-gradient timeline-card col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl">
                            <a alt="Lessing Berufskolleg" title="Lessing Berufskolleg" class="underline" href="https://www.lgbk.de/" target="_blank" rel="noopener noreferrer">Lessing Berufskolleg</a>, Düsseldorf
                        </h3>
                        <img src="{{ Vite::asset('resources/images/lessing.webp') }}" class="w-16 h-auto ml-4"  alt="{{ __('alt.lessing_logo') }}" title="{{ __('alt.lessing_logo') }}"/>
                    </div>
                    <p class="text-sm mb-2">{{ __('text.cv-school2-period') }}</p>
                    <hr class=" mb-2" />
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school2-field-label') }}</strong><br class="" />
                        {{ __('text.cv-school2-field') }}
                    </p>
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school2-degree-label') }}</strong><br class="" />
                        {{ __('text.cv-school2-degree') }}
                    </p>
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school2-advanced-label') }}</strong><br class="" />
                        {{ __('text.cv-school2-advanced') }}
                    </p>
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school2-basic-label') }}</strong><br class="" />
                        {{ __('text.cv-school2-basic') }}
                    </p>
                </div>
            </div>

            <!-- Annette Gymnasium -->
            <div class="flex flex-row-reverse lg:contents">
                <div class="primary-gradient left timeline-card col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl">
                            <a alt="Annette Gymnasium" title="Annette Gymnasium">Annette-von-Droste-Hülshoff-Gymnasium</a>, Düsseldorf
                        </h3>
                    </div>
                    <p class="text-sm mb-2">{{ __('text.cv-school3-period') }}</p>
                    <hr class=" mb-2" />
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school3-degree-label') }}</strong><br class="" />
                        {{ __('text.cv-school3-degree') }}
                    </p>
                </div>
                <div class="col-start-5 col-end-6 lg:mx-auto relative mr-5">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
                </div>
            </div>

            <!-- Grundschule -->
            <div class="flex lg:contents">
                <div class="col-start-5 col-end-6 mr-5 lg:mx-auto relative">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                    </div>
                    <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
                </div>
                <div class="primary-gradient timeline-card col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-xl">
                            <a alt="{{ __('text.cv-school4-name') }}" title="{{ __('text.cv-school4-name') }}" class="underline" href="https://kgs-marienschule-duesseldorf.de/" target="_blank" rel="noopener noreferrer">{{ __('text.cv-school4-name') }}</a>, Düsseldorf
                        </h3>
                    </div>
                    <p class="text-sm mb-2">{{ __('text.cv-school4-period') }}</p>
                    <hr class=" mb-2" />
                    <p class="text-sm">
                        <strong>{{ __('text.cv-school4-degree-label') }}</strong><br class="" />
                        {{ __('text.cv-school4-degree') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-10 mb-5 text-center origin-bottom">{{ __('text.cv-section-skills') }}</h2>
    <div class="lg:text-center">
        <p class="mb-5 lg:w-2/3 md:mx-auto md:text-center">{{ __('text.cv-skills-intro') }}</p>
    </div>

    <div class="lg:container">
        <div class="flex flex-col lg:grid grid-cols-2 mx-auto p-2 gap-5">
            <div class="primary-gradient timeline-card mobile-left mobile-left p-4 rounded-xl shadow-md">
                <h3>{{ __('text.cv-skills-programming') }}</h3>
                <ul class="list-disc ml-5">
                    <li>
                        PHP
                    </li>
                    <li>
                        JavaScript
                    </li>
                    <li>
                        C#
                    </li>
                    <li>
                        C / C++
                    </li>
                    <li>
                        GoLang
                    </li>
                </ul>
            </div>
            <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md">
                <h3>{{ __('text.cv-skills-frameworks') }}</h3>
                <ul class="list-disc ml-5">
                    <li>
                        TYPO3
                    </li>
                    <li>
                        WordPress
                    </li>
                    <li>
                        Laravel (Livewire)
                    </li>
                    <li>
                        Symfony
                    </li>
                    <li>
                        React
                    </li>
                    <li>
                        Electron
                    </li>
                    <li>
                        jQuery
                    </li>
                </ul>
            </div>
            <div class="primary-gradient mobile-left timeline-card p-4 rounded-xl shadow-md">
                <h3>{{ __('text.cv-skills-script-languages') }}</h3>
                <ul class="list-disc ml-5">
                    <li>SQL (Mysql / MariaDB / PostgreSQL)</li>
                    <li>TypoScript (TYPO3)</li>
                    <li>HTML</li>
                    <li>JSON</li>
                    <li>YAML</li>
                    <li>MD</li>
                    <li>XML</li>
                </ul>
            </div>
            <div class="break-page hidden"></div>
            <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md page-break">
                <h3>{{ __('text.cv-skills-web-styling') }}</h3>
                <ul class="list-disc ml-5">
                    <li>CSS / SCSS</li>
                    <li>Tailwind CSS</li>
                    <li>Bootstrap</li>
                </ul>
            </div>
            <div class="primary-gradient mobile-left timeline-card p-4 rounded-xl shadow-md">
                <h3>{{ __('text.cv-skills-operating-systems') }}</h3>
                <ul class="list-disc ml-5">
                    <li>
                        Linux (Debian / Ubuntu)
                    </li>
                    <li>
                        Windows (10 / 11)
                    </li>
                    <li>
                        MacOS (Intel / Apple Silicon)
                    </li>
                </ul>
            </div>
            <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md">
                <h3>{{ __('text.cv-skills-development-tools') }}</h3>
                <ul class="list-disc ml-5">
                    <li>Git</li>
                    <li>Docker</li>
                    <li>Neovim (nvim)</li>
                    <li>Tmux</li>
                    <li>Postman</li>
                </ul>
            </div>
        </div>
    </div>

    <h2 class="mt-10 mb-5 text-center origin-bottom">{{ __('text.cv-section-certificates') }}</h2>
    <div class="lg:container">
        <div class="flex flex-col lg:grid grid-cols-4 mx-auto p-2 gap-5">
            <div class="primary-gradient timeline-card mobile-left mobile-left p-4 rounded-xl shadow-md col-start-2 col-end-4">
                <h3 class="mb-2">{{ __('text.cv-certificate1-title') }}</h3>
                <p class="text-sm mb-2">{{ __('text.cv-certificate1-period') }}</p>
                <hr class="mb-2" />
                <p class="text-sm">
                    <a alt="{{ __('text.cv-certificate1-link') }}" title="{{ __('text.cv-certificate1-link') }}" href="https://typo3.com/services/certifications/certified-integrator-listing" class="btn btn-secondary w-fit no-underline" target="_blank">{{ __('text.cv-certificate1-link') }}</a>
                </p>
            </div>
        </div>
    </div>

    <div class="break-page"></div>
    <h2 class="mt-10 mb-5 text-center origin-bottom">{{ __('text.cv-section-languages') }}</h2>
    <div class="lg:container">
        <div class="flex flex-col lg:grid grid-cols-4 mx-auto p-2 gap-5">
            <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md col-start-2 col-end-4">
                <h3 class="mb-2">{{ __('text.cv-lang-german') }}</h3>
                <p class="text-sm mb-2">{{ __('text.cv-lang-german-desc') }}</p>
            </div>
            <div class="primary-gradient timeline-card mobile-left p-4 rounded-xl shadow-md col-start-2 col-end-4">
                <h3 class="mb-2">{{ __('text.cv-lang-english') }}</h3>
                <p class="text-sm mb-2">{{ __('text.cv-lang-english-desc') }}</p>
            </div>
            <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md col-start-2 col-end-4">
                <h3 class="mb-2">{{ __('text.cv-lang-french') }}</h3>
                <p class="text-sm mb-2">{{ __('text.cv-lang-french-desc') }}</p>
            </div>
        </div>
    </div>

    <h2 class="mt-10 mb-5 text-center origin-bottom">{{ __('text.cv-section-contact') }}</h2>
    <div class="lg:container">
        <div class="flex flex-col lg:grid grid-cols-4 mx-auto p-2 gap-5">
            <div class="primary-gradient timeline-card mobile-left mobile-left p-4 rounded-xl shadow-md col-start-2 col-end-4">
                <p class="text-sm mb-3 text-center">
                    <a alt="{{ __('text.cv-contact-link') }}" title="{{ __('text.cv-contact-link') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="btn btn-secondary w-fit no-underline" target="_blank">{{ __('text.cv-contact-link') }}</a>
                </p>
                <hr class="mb-2" />
                <div class="grid grid-cols-2">
                    <div>
                        <h3>{{ __('text.cv-contact-phone-label') }}</h3>
                        <p class="text-sm mb-2">
                            <a alt="0173 1758175" title="0173 1758175" href="tel:01731758175">0173 / 1758175</a>
                        </p>
                    </div>
                    <div>
                        <h3>{{ __('text.cv-contact-email-label') }}</h3>
                        <p class="text-sm mb-2">
                            <a alt="hp@diesing.pro" title="hp@diesing.pro" href="mailto:hp@diesing.pro">hp@diesing.pro</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5"> </div>
</div>
@endsection

