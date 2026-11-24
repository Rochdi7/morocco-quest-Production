{{-- Price label for a tour / activity card or detail box.
     Usage: @include('partials.price', ['item' => $tour, 'prefix' => 'From', 'suffix' => '/Adult'])
     Shows "From $500" (old price struck through when higher), or
     "Price On Request" when the item has no price set in the admin. --}}
@php
    $__price = (float) ($item->price_adult ?? 0);
    $__old = (float) ($item->old_price_adult ?? 0);
    $__fmt = fn ($v) => '$' . number_format($v, floor($v) == $v ? 0 : 2);
@endphp
@if ($__price > 0)
    @if (!empty($prefix))<span class="price-from" style="font-size:.75em;font-weight:400;opacity:.8;margin-right:.25em;">{{ $prefix }}</span>@endif
    @if ($__old > $__price)<del class="price-old" style="font-size:.75em;font-weight:400;opacity:.6;margin-right:.3em;">{{ $__fmt($__old) }}</del>@endif
    {{ $__fmt($__price) }}@if (!empty($suffix))<span class="price-suffix" style="font-size:.7em;font-weight:400;opacity:.8;margin-left:.15em;">{{ $suffix }}</span>@endif
@else
    Price On Request
@endif
