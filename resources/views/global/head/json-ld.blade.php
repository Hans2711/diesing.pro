@php
    $siteName = config('app.name', 'Diesing');
    $baseUrl = rtrim(config('app.url', url('/')), '/');
    $currentUrl = url()->current();
    $logoUrl = Vite::asset('resources/logo/HPLogo.png');
    $locale = str_replace('_', '-', app()->getLocale());
    $descKey = isset($from) ? 'descriptions.' . $from : null;
    $hasDescKey = $descKey && \Illuminate\Support\Facades\Lang::has($descKey);
    $descriptionValue = $description ?? ($hasDescKey ? __($descKey) : null) ?? __('descriptions.home');

    $contactEmail = 'hp@diesing.pro';
    $contactPhone = '+49 1731758175';
    $socialProfiles = [
        'https://github.com/Hans2711',
        'https://www.instagram.com/hans.dsg',
        'https://www.linkedin.com/in/hans-peter-hp-diesing-3136b81a6',
        'https://www.discordapp.com/users/640313822145675287',
    ];

    $organization = [
        '@type' => 'Organization',
        '@id' => $baseUrl . '#organization',
        'name' => $siteName,
        'url' => $baseUrl,
        'logo' => $logoUrl,
        'contactPoint' => [
            [
                '@type' => 'ContactPoint',
                'email' => $contactEmail,
                'telephone' => $contactPhone,
                'contactType' => 'customer support',
                'availableLanguage' => ['en', 'de'],
                'areaServed' => ['DE', 'AT', 'CH'],
            ],
        ],
        'sameAs' => $socialProfiles,
    ];

    $person = [
        '@type' => 'Person',
        '@id' => $baseUrl . '#person',
        'name' => 'Hans Peter Diesing',
        'url' => $baseUrl,
        'jobTitle' => 'Software Developer',
        'email' => $contactEmail,
        'telephone' => $contactPhone,
        'worksFor' => ['@id' => $organization['@id']],
        'sameAs' => $socialProfiles,
    ];

    $website = [
        '@type' => 'WebSite',
        '@id' => $baseUrl . '#website',
        'name' => $siteName,
        'url' => $baseUrl,
        'inLanguage' => $locale,
        'publisher' => ['@id' => $organization['@id']],
    ];

    $webpage = [
        '@type' => 'WebPage',
        '@id' => $currentUrl . '#webpage',
        'url' => $currentUrl,
        'name' => $title ?? $siteName,
        'description' => $descriptionValue,
        'inLanguage' => $locale,
        'isPartOf' => ['@id' => $website['@id']],
        'about' => ['@id' => $person['@id']],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        $organization,
        $person,
        $website,
        $webpage,
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
