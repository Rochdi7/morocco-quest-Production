{{-- resources/views/layouts/partials/structured-data-global.blade.php --}}
@php
    $company = config('company');
    $phone = $company['phone']['customer_service_1']['display'] ?? null;
    $email = $company['email']['info'] ?? null;
    $address = $company['address'] ?? 'Marrakech, Morocco';
    $siteUrl = config('app.url') ?? url('/');
    $logoUrl = asset('assets/img/logo-bg-wide.webp');
    $imageUrl = asset('assets/img/ait-benhaddou-morocco-travel-hero-banner.webp');
    $latitude = 31.63474;
    $longitude = -8.00639;
    $sameAs = array_values(
        array_filter([
            'https://www.facebook.com/profile.php?id=61578772746041',
            'https://x.com/mounirakajia',
            'https://www.instagram.com/moroccoquestdmc/',
            'https://www.youtube.com/@coloredmoroccotourstravel6209',
            'https://www.tripadvisor.com/Attraction_Review-g293734-d33367694-Reviews-Morocco_Quest_Dmc-Marrakech_Marrakech_Safi.html',
            // 'https://www.threads.net/@moroccoquestdmc' // add if correct
        ]),
    );
@endphp

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "@id": "{{ $siteUrl }}#website",
      "url": "{{ $siteUrl }}",
      "name": "Morocco Quest",
      "inLanguage": "en",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "{{ $siteUrl }}/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    },
    {
      "@type": "TravelAgency",
      "@id": "{{ $siteUrl }}#organization",
      "name": "Morocco Quest",
      "alternateName": "MoroccoQuest",
      "url": "{{ $siteUrl }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ $logoUrl }}"
      },
      "image": "{{ $imageUrl }}",
      "description": "Morocco Quest offers desert tours, Marrakech day trips, and Atlas Mountains trekking with expert local guides.",
      "email": "mailto:{{ $email }}",
      "telephone": "{{ $phone }}",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $address }}",
        "addressLocality": "Marrakech",
        "addressRegion": "Marrakech-Safi",
        "postalCode": "40000",
        "addressCountry": "MA"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": {{ $latitude }},
        "longitude": {{ $longitude }}
      },
      "areaServed": ["MA","ES","FR","GB","US"],
      "availableLanguage": ["English","French","Spanish"],
      "sameAs": {!! json_encode($sameAs, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    }
  ]
}
</script>
