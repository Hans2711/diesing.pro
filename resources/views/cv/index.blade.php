@extends('layouts.app', ['title' => __('titles.cv'), 'description' => __('descriptions.cv'), 'active' => 'cv'])

@section('content')
<h1 class="md:text-center md:origin-bottom">Hans Peter (HP) Diesing - Software-Entwickler</h1>
<div class="md:text-center">
    <p class="mb-5 md:w-2/3 md:mx-auto md:text-center">
        Erfahrener Software-Entwickler bei Netigo GmbH in Düsseldorf mit Schwerpunkt auf Back-End-Webentwicklung, PHP und JavaScript.
    </p>
</div>

<div class="md:text-center">
    <a wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="btn btn-primary w-fit md:mx-auto">Kontakt aufnehmen</a>
</div>

<h2 class="mt-10 mb-5 text-center origin-bottom">Berufserfahrung</h2>

<div class="md:container">
    <div class="flex flex-col md:grid grid-cols-9 mx-auto p-2 text-blue-50">

        <!-- Position: Backend Developer -->
        <div class="flex flex-row-reverse md:contents">
            <div class="primary-gradient left timeline-card group col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-xl">
                        <a class="underline" href="https://www.netigo.de" target="_blank" rel="noopener noreferrer">Netigo GmbH</a>, Düsseldorf
                    </h3>
                    <img src="{{ Vite::asset('resources/images/netigo.svg') }}" class="w-16 h-auto ml-4 invert dark:invert-0" />
                </div>
                <p class="text-sm mb-2">Februar 2024 – heute</p>
                <hr class="mb-2" />
                <p class="">
                    <strong>Technologien:</strong><br class="md:hidden" />
                    TYPO3, WordPress und PHP (Symfony)
                </p>
                <p class="">
                    <strong>Schwerpunkt:</strong><br class="md:hidden" />
                    Backend-Entwicklung
                </p>
                <p class="">
                    <strong>Projekte:</strong><br class="md:hidden" />
                    Komplette Systeme, Versions-Upgrades, Relaunch-Projekte und individuelle Lösungen
                </p>
            </div>
            <div class="col-start-5 col-end-6 md:mx-auto relative mr-5">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
            </div>
        </div>

        <!-- Position: Ausbildung -->
        <div class="flex md:contents">
            <div class="col-start-5 col-end-6 mr-5 md:mx-auto relative">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
            </div>
            <div class="primary-gradient timeline-card col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-xl">
                        <a class="underline" href="https://www.netigo.de" target="_blank" rel="noopener noreferrer">Netigo GmbH</a>, Düsseldorf
                    </h3>
                    <img src="{{ Vite::asset('resources/images/netigo.svg') }}" class="w-16 h-auto ml-4 invert dark:invert-0" />
                </div>
                <p class="text-sm mb-2">August 2021 - Februar 2024</p>
                <hr class="mb-2" />
                <p class="leading-tight text-sm">
                    <strong>Ausbildung:</strong><br class="md:hidden" />
                    Fachinformatiker für Anwendungsentwicklung mit Schwerpunkt auf Backend-Entwicklung.
                </p>
            </div>
        </div>
    </div>
</div>
<h2 class="mt-10 mb-5 text-center origin-bottom">Schulausbildung</h2>
<div class="md:container">
    <div class="flex flex-col md:grid grid-cols-9 mx-auto p-2 text-blue-50">

        <!-- Berufskolleg Hilden -->
        <div class="flex flex-row-reverse md:contents">
            <div class="primary-gradient left timeline-card col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-xl">
                        <a class="underline" href="https://berufskolleg.de/" target="_blank" rel="noopener noreferrer">Berufskolleg Hilden</a>
                    </h3>
                    <img src="{{ Vite::asset('resources/images/bkh.png') }}" class="w-10 h-auto ml-4 " />
                </div>
                <p class="text-sm mb-2">August 2021 – Februar 2024</p>
                <hr class=" mb-2" />
                <p class="leading-tight text-sm">
                    <strong>Fachbereich:</strong><br class="md:hidden" />
                    Fachinformatik (Anwendungsentwicklung)
                </p>
            </div>
            <div class="col-start-5 col-end-6 md:mx-auto relative mr-5">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
            </div>
        </div>

        <!-- Lessing Berufskolleg -->
        <div class="flex md:contents">
            <div class="col-start-5 col-end-6 mr-5 md:mx-auto relative">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
            </div>
            <div class="primary-gradient timeline-card col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-xl">
                        <a class="underline" href="https://www.lgbk.de/" target="_blank" rel="noopener noreferrer">Lessing Berufskolleg</a>, Düsseldorf
                    </h3>
                    <img src="{{ Vite::asset('resources/images/lessing.png') }}" class="w-16 h-auto ml-4" />
                </div>
                <p class="text-sm mb-2">August 2018 – Mai 2021</p>
                <hr class=" mb-2" />
                <p class="leading-tight text-sm">
                    <strong>Fachbereich:</strong><br class="md:hidden" />
                    Mathematik und Informatik
                </p>
                <p class="leading-tight text-sm">
                    <strong>Abschluss:</strong><br class="md:hidden" />
                    Allgemeine Hochschulreife (2021)
                </p>
                <p class="leading-tight text-sm">
                    <strong>Leistungskurse:</strong><br class="md:hidden" />
                    Informatik, Mathematik
                </p>
                <p class="leading-tight text-sm">
                    <strong>Grundkurse:</strong><br class="md:hidden" />
                    Deutsch, Gesellschaftslehre
                </p>
            </div>
        </div>

        <!-- Annette Gymnasium -->
        <div class="flex flex-row-reverse md:contents">
            <div class="primary-gradient left timeline-card col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-xl">
                        <a class="underline" href="https://www.annettegymnasium.de/" target="_blank" rel="noopener noreferrer">Annette-von-Droste-Hülshoff-Gymnasium</a>, Düsseldorf
                    </h3>
                </div>
                <p class="text-sm mb-2">August 2012 – Juli 2018</p>
                <hr class=" mb-2" />
                <p class="leading-tight text-sm">
                    <strong>Abschluss:</strong><br class="md:hidden" />
                    Mittlerer Schulabschluss (FOR) mit Qualifikation
                </p>
            </div>
            <div class="col-start-5 col-end-6 md:mx-auto relative mr-5">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
            </div>
        </div>

        <!-- Grundschule -->
        <div class="flex md:contents">
            <div class="col-start-5 col-end-6 mr-5 md:mx-auto relative">
                <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-primary-dark pointer-events-none"></div>
                </div>
                <div class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-primary-dark shadow"></div>
            </div>
            <div class="primary-gradient timeline-card col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-xl">
                        <a class="underline" href="https://kgs-marienschule-duesseldorf.de/" target="_blank" rel="noopener noreferrer">Katholische Grundschule Marien Schule</a>, Düsseldorf
                    </h3>
                </div>
                <p class="text-sm mb-2">August 2009 – Juli 2012</p>
                <hr class=" mb-2" />
                <p class="leading-tight text-sm">
                    <strong>Abschluss:</strong><br class="md:hidden" />
                    Grundschulabschluss
                </p>
            </div>
        </div>
    </div>
</div>

<h2 class="mt-10 mb-5 text-center origin-bottom">Fachkenntnisse</h2>
<div class="md:text-center">
    <p class="mb-5 md:w-2/3 md:mx-auto md:text-center">Die Fachkenntnisse sind entsprechend des jeweiligen Erfahrungsniveaus absteigend geordnet.</p>
</div>

<div class="md:container">
    <div class="flex flex-col md:grid grid-cols-2 mx-auto p-2 gap-5">
        <div class="primary-gradient timeline-card mobile-left mobile-left p-4 rounded-xl shadow-md">
            <h3>Programmiersprachen</h3>
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
            <h3>Frameworks / CMS</h3>
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
            <h3>Script & Markup Languages</h3>
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
        <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md">
            <h3>Webstyling</h3>
            <ul class="list-disc ml-5">
                <li>CSS / SCSS</li>
                <li>Tailwind CSS</li>
                <li>Bootstrap</li>
            </ul>
        </div>
        <div class="primary-gradient mobile-left timeline-card p-4 rounded-xl shadow-md">
            <h3>Betriebsysteme</h3>
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
            <h3>Enticklungswerkzeuge</h3>
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

<h2 class="mt-10 mb-5 text-center origin-bottom">Zertifikate</h2>
<div class="md:container">
    <div class="flex flex-col md:grid grid-cols-4 mx-auto p-2 gap-5">
        <div class="primary-gradient timeline-card mobile-left mobile-left p-4 rounded-xl shadow-md col-start-2 col-end-4">
            <h3 class="mb-2">TYPO3 CMS Certified Integrator (TCCI)</h3>
            <p class="text-sm mb-2">März 2025 - März 2027</p>
            <hr class="mb-2" />
            <p class="leading-tight text-sm">
                <a href="https://typo3.com/services/certifications/certified-integrator-listing" class="btn btn-secondary w-fit no-underline" target="_blank">Offizielle Liste</a>
            </p>
        </div>
    </div>
</div>
<h2 class="mt-10 mb-5 text-center origin-bottom">Sprachen</h2>
<div class="md:container">
    <div class="flex flex-col md:grid grid-cols-4 mx-auto p-2 gap-5">
        <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md col-start-2 col-end-4">
            <h3 class="mb-2">Deutsch</h3>
            <p class="text-sm mb-2">Muttersprache</p>
        </div>
        <div class="primary-gradient timeline-card mobile-left p-4 rounded-xl shadow-md col-start-2 col-end-4">
            <h3 class="mb-2">Englisch</h3>
            <p class="text-sm mb-2">Fließend in Wort und Schrift (C2)</p>
        </div>
        <div class="primary-gradient timeline-card p-4 rounded-xl shadow-md col-start-2 col-end-4">
            <h3 class="mb-2">Französisch</h3>
            <p class="text-sm mb-2">Grundkentnisse</p>
        </div>
    </div>
</div>

<h2 class="mt-10 mb-5 text-center origin-bottom">Kontakt</h2>
<div class="md:container">
    <div class="flex flex-col md:grid grid-cols-4 mx-auto p-2 gap-5">
        <div class="primary-gradient timeline-card mobile-left mobile-left p-4 rounded-xl shadow-md col-start-2 col-end-4">
            <p class="leading-tight text-sm mb-3 text-center">
                <a wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="btn btn-secondary w-fit no-underline" target="_blank">Hier zum Kontaktformular</a>
            </p>
            <hr class="mb-2" />
            <div class="grid grid-cols-2">
                <div>
                    <h3>Telefon</h3>
                    <p class="text-sm mb-2">
                        <a href="tel:01731758175">0173 / 1758175</a>
                    </p>
                </div>
                <div>
                    <h3>E-Mail</h3>
                    <p class="text-sm mb-2">
                        <a href="mailto:hp@diesing.pro">hp@diesing.pro</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mb-5"> </div>
@endsection

