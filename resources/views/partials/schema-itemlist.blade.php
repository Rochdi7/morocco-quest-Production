{{-- ItemList JSON-LD for a listing page. Built from the same collection the
     page renders, so the markup always matches the visible cards.
     Params: $listName (string), $listItems (iterable of ['name' => …, 'url' => …]),
             $listOffset (int, position offset for paginated pages; default 0). --}}
@php
    $schemaItems = collect($listItems ?? [])
        ->filter(fn ($i) => !empty($i['url']) && !empty($i['name']))
        ->values()
        ->map(fn ($i, $k) => [
            '@type' => 'ListItem',
            'position' => ($listOffset ?? 0) + $k + 1,
            'name' => trim(html_entity_decode(strip_tags((string) $i['name']), ENT_QUOTES | ENT_HTML5, 'UTF-8')),
            'url' => $i['url'],
        ])
        ->all();
@endphp
@if (count($schemaItems))
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => $listName,
    'numberOfItems' => count($schemaItems),
    'itemListElement' => $schemaItems,
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
