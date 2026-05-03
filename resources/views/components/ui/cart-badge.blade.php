@php
    $totalItems = app(\App\Services\CartService::class)->getTotalItems();
@endphp

<a href="{{ route('cart.index') }}" class="hover:text-blue-600 flex items-center gap-1">
    Keranjang
    @if($totalItems > 0)
        <span class="bg-blue-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
            {{ $totalItems > 99 ? '99+' : $totalItems }}
        </span>
    @endif
</a>
