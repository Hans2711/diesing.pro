@php
    $currentLocale = app()->getLocale();
    $currentUrl = url()->current();
    
    // Get the other language URL using existing utility
    $otherLocale = $currentLocale == 'de' ? 'en' : 'de';
    $otherUrl = App\Utilities\LanguageUtility::getOtherLangUrl();
    $otherFullUrl = url($otherUrl);
    
    // Determine x-default (always English)
    $defaultUrl = $currentLocale == 'en' ? $currentUrl : $otherFullUrl;
@endphp

<!-- Hreflang links for multilingual SEO -->
<link rel="alternate" hreflang="{{ $currentLocale }}" href="{{ $currentUrl }}" />
<link rel="alternate" hreflang="{{ $otherLocale }}" href="{{ $otherFullUrl }}" />
<link rel="alternate" hreflang="x-default" href="{{ $defaultUrl }}" />
