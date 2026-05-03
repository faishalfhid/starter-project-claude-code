{{-- Product Card V2: card produk dengan badge sale dan rating bintang --}}

@props([
    'name'          => 'Nama Produk',
    'price'         => 0,
    'originalPrice' => null,
    'image'         => null,
    'category'      => null,
    'rating'        => 0,
    'reviewCount'   => 0,
    'isSale'        => false,
    'href'          => '#',
    'size'          => 'md', {{-- sm | md | lg --}}
])

@php
    $sizeClasses = [
        'sm' => 'max-w-xs text-sm',
        'md' => 'max-w-sm text-base',
        'lg' => 'max-w-md text-lg',
    ];

    $imageSizeClasses = [
        'sm' => 'h-36',
        'md' => 'h-48',
        'lg' => 'h-60',
    ];

    $cardSize  = $sizeClasses[$size]  ?? $sizeClasses['md'];
    $imageSize = $imageSizeClasses[$size] ?? $imageSizeClasses['md'];

    $discount = ($isSale && $originalPrice && $originalPrice > $price)
        ? round((1 - $price / $originalPrice) * 100)
        : null;

    $fullStars  = floor($rating);
    $halfStar   = ($rating - $fullStars) >= 0.5;
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
@endphp

<a
    href="{{ $href }}"
    aria-label="Lihat produk: {{ $name }}"
    class="group block {{ $cardSize }} w-full rounded-2xl overflow-hidden bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
>

    {{-- Gambar produk --}}
    <div class="relative {{ $imageSize }} bg-gray-100 overflow-hidden">
        @if($image)
            <img
                src="{{ $image }}"
                alt="{{ $name }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
            />
        @else
            <div class="w-full h-full flex items-center justify-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        {{-- Badge SALE --}}
        @if($isSale && $discount)
            <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                -{{ $discount }}%
            </span>
        @endif
    </div>

    {{-- Konten card --}}
    <div class="p-4 space-y-2">

        {{-- Kategori --}}
        @if($category)
            <span class="text-xs font-medium text-blue-600 uppercase tracking-wide">{{ $category }}</span>
        @endif

        {{-- Nama produk --}}
        <h3 class="font-semibold text-gray-900 leading-snug line-clamp-2 group-hover:text-blue-600 transition-colors">
            {{ $name }}
        </h3>

        {{-- Rating bintang --}}
        <div class="flex items-center gap-1.5">
            <div class="flex items-center gap-0.5" aria-label="Rating {{ $rating }} dari 5">
                {{-- Full stars --}}
                @for($i = 0; $i < $fullStars; $i++)
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.063 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z"/>
                    </svg>
                @endfor

                {{-- Half star --}}
                @if($halfStar)
                    <svg class="w-4 h-4 text-yellow-400" viewBox="0 0 20 20">
                        @php $gradId = 'half-grad-' . md5($name) @endphp
                    <defs>
                            <linearGradient id="{{ $gradId }}">
                                <stop offset="50%" stop-color="#facc15"/>
                                <stop offset="50%" stop-color="#d1d5db"/>
                            </linearGradient>
                        </defs>
                        <path fill="url(#{{ $gradId }})" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.063 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z"/>
                    </svg>
                @endif

                {{-- Empty stars --}}
                @for($i = 0; $i < $emptyStars; $i++)
                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.063 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69L9.049 2.927z"/>
                    </svg>
                @endfor
            </div>

            @if($reviewCount > 0)
                <span class="text-xs text-gray-600">({{ number_format($reviewCount) }})</span>
            @endif
        </div>

        {{-- Harga --}}
        <div class="flex items-baseline gap-2 pt-1">
            <span class="font-bold text-gray-900">
                Rp {{ number_format($price, 0, ',', '.') }}
            </span>
            @if($isSale && $originalPrice && $originalPrice > $price)
                <span class="text-sm text-gray-500 line-through">
                    Rp {{ number_format($originalPrice, 0, ',', '.') }}
                </span>
            @endif
        </div>

    </div>
</a>
