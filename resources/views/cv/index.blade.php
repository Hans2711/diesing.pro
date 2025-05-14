@extends('layouts.app', ['title' => __('titles.cv'), 'description' => __('descriptions.cv'), 'active' => 'cv'])

@section('content')
<h1 class="">Hans Peter (HP) Diesing - Software-Entwickler</h1>
<p class="mb-5">Erfahrener Software-Entwickler bei Netigo GmbH in Düsseldorf mit Schwerpunkt auf Back-End-Webentwicklung, PHP und JavaScript.</p>

<a wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="btn btn-primary w-fit">Kontakt aufnehmen</a>

<h2 class="mt-10 mb-5">Berufserfahrung</h2>
<div class="py-3 container mx-auto px-5">
    <div class="relative">
        <div class="border-r-4 border-primary-dark absolute h-full top-0"></div>
        <ul class="list-none m-0 p-0">
            <li class="mb-5  ">
                <div class="flex group items-center ">
                    <div class="bg-primary-dark group-hover:bg-primary-light z-10 rounded-full border-4 border-primary-dark h-5 w-5">
                        <div class="bg-primary-dark h-1 w-6 items-center  ml-4 mt-1"></div>
                    </div>
                    <div class="flex-1 ml-4 z-10 font-medium hover:scale-105 origin-left transform transition duration-300">
                        <div class="order-1 space-y-2 text-white bg-primary-dark rounded-lg shadow-only transition-ease lg:w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-2xl">
                                <a class="underline" href="https://www.netigo.de" target="_blank" rel="noopener noreferrer">Netigo GmbH</a>, Düsseldorf
                            </h3>
                            <p class="pb-4 text-sm text-gray-200">Februar 2024 – heute</p>
                            <hr class="border-gray-200" />
                            <p class="text-sm font-medium text-gray-200 leading-snug tracking-wide text-opacity-100">Backend-Entwicklung mit TYPO3, WordPress und PHP (Symfony); Umsetzung kompletter Systeme, Versions-Upgrades, Relaunch-Projekte und weiterer individueller Lösungen.</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="mb-5  ">
                <div class="flex group items-center ">
                    <div class="bg-primary-dark group-hover:bg-primary-light z-10 rounded-full border-4 border-primary-dark h-5 w-5">
                        <div class="bg-primary-dark h-1 w-6 items-center  ml-4 mt-1"></div>
                    </div>
                    <div class="flex-1 ml-4 z-10 font-medium hover:scale-105 origin-left transform transition duration-300">
                        <div class="order-1 space-y-2 text-white bg-primary-dark rounded-lg shadow-only transition-ease lg:w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-2xl">
                                <a class="underline" href="https://www.netigo.de" target="_blank" rel="noopener noreferrer">Netigo GmbH</a>, Düsseldorf
                            </h3>
                            <p class="pb-4 text-sm text-gray-200">August 2021 - Februar 2024</p>
                            <hr class="border-gray-200" />
                            <p class="text-sm font-medium text-gray-200 leading-snug tracking-wide text-opacity-100">Ausbildung zum Fachinformatiker für Anwendungsentwicklung mit Schwerpunkt auf Backend-Entwicklung.</p>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>

<h2 class=" mb-5">Schulausbildung</h2>
<div class="py-3 container mx-auto px-5">
    <div class="relative">
        <div class="border-r-4 border-primary-dark absolute h-full top-0"></div>
        <ul class="list-none m-0 p-0">

            <li class="mb-5">
                <div class="flex group items-center">
                    <div class="bg-primary-dark group-hover:bg-primary-light z-10 rounded-full border-4 border-primary-dark h-5 w-5">
                        <div class="bg-primary-dark h-1 w-6 ml-4 mt-1"></div>
                    </div>
                    <div class="flex-1 ml-4 z-10 font-medium hover:scale-105 origin-left transform transition duration-300">
                        <div class="order-1 space-y-2 text-white bg-primary-dark rounded-lg shadow-only transition-ease lg:w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-2xl">
                                <a class="underline" href="https://berufskolleg.de/" target="_blank" rel="noopener noreferrer">Berufskolleg Hilden</a>
                            </h3>
                            <p class="pb-4 text-sm text-gray-200">August 2021 – Februar 2024</p>
                            <hr class="border-gray-200" />
                            <p class="text-sm font-medium text-gray-200 leading-snug tracking-wide text-opacity-100">
                                Fachbereich: Fachinformatik (Anwendungsentwicklung)
                            </p>
                        </div>
                    </div>
                </div>
            </li>

            <li class="mb-5">
                <div class="flex group items-center">
                    <div class="bg-primary-dark group-hover:bg-primary-light z-10 rounded-full border-4 border-primary-dark h-5 w-5">
                        <div class="bg-primary-dark h-1 w-6 ml-4 mt-1"></div>
                    </div>
                    <div class="flex-1 ml-4 z-10 font-medium hover:scale-105 origin-left transform transition duration-300">
                        <div class="order-1 space-y-2 text-white bg-primary-dark rounded-lg shadow-only transition-ease lg:w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-2xl">
                                <a class="underline" href="https://www.lgbk.de/" target="_blank" rel="noopener noreferrer">Lessing Berufskolleg</a>, Düsseldorf
                            </h3>
                            <p class="pb-4 text-sm text-gray-200">August 2018 – Mai 2021</p>
                            <hr class="border-gray-200" />
                            <p class="text-sm font-medium text-gray-200 leading-snug tracking-wide text-opacity-100">
                                Fachbereich: Mathematik und Informatik<br>
                                Abschluss: Allgemeine Hochschulreife (2021)<br>
                                Leistungskurse: Informatik, Mathematik<br>
                                Grundkurse: Deutsch, Gesellschaftslehre
                            </p>
                        </div>
                    </div>
                </div>
            </li>

            <li class="mb-5">
                <div class="flex group items-center">
                    <div class="bg-primary-dark group-hover:bg-primary-light z-10 rounded-full border-4 border-primary-dark h-5 w-5">
                        <div class="bg-primary-dark h-1 w-6 ml-4 mt-1"></div>
                    </div>
                    <div class="flex-1 ml-4 z-10 font-medium hover:scale-105 origin-left transform transition duration-300">
                        <div class="order-1 space-y-2 text-white bg-primary-dark rounded-lg shadow-only transition-ease lg:w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-2xl">
                                <a class="underline" href="https://www.annettegymnasium.de/" target="_blank" rel="noopener noreferrer">Annette-von-Droste-Hülshoff-Gymnasium</a>, Düsseldorf
                            </h3>
                            <p class="pb-4 text-sm text-gray-200">August 2012 – Juli 2018</p>
                            <hr class="border-gray-200" />
                            <p class="text-sm font-medium text-gray-200 leading-snug tracking-wide text-opacity-100">
                                Abschluss: Mittlerer Schulabschluss (FOR) mit Qualifikation
                            </p>
                        </div>
                    </div>
                </div>
            </li>

            <li>
                <div class="flex group items-center">
                    <div class="bg-primary-dark group-hover:bg-primary-light z-10 rounded-full border-4 border-primary-dark h-5 w-5">
                        <div class="bg-primary-dark h-1 w-6 ml-4 mt-1"></div>
                    </div>
                    <div class="flex-1 ml-4 z-10 font-medium hover:scale-105 origin-left transform transition duration-300">
                        <div class="order-1 space-y-2 text-white bg-primary-dark rounded-lg shadow-only transition-ease lg:w-5/12 px-6 py-4">
                            <h3 class="mb-3 font-bold text-2xl">
                                <a class="underline" href="https://kgs-marienschule-duesseldorf.de/" target="_blank" rel="noopener noreferrer">Katholische Grundschule Marien Schule</a>, Düsseldorf
                            </h3>
                            <p class="pb-4 text-sm text-gray-200">August 2009 – Juli 2012</p>
                            <hr class="border-gray-200" />
                            <p class="text-sm font-medium text-gray-200 leading-snug tracking-wide text-opacity-100">
                                Grundschulabschluss
                            </p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection

