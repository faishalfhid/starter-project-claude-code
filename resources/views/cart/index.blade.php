@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

    @if(empty($items))
        <div class="text-center py-20">
            <p class="text-gray-400 text-lg mb-4">Keranjang kamu masih kosong.</p>
            <a href="{{ route('products.index') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="flex flex-col gap-4">
            @foreach($items as $item)
                <div class="bg-white rounded-2xl shadow-sm p-4 flex gap-4 items-center">
                    {{-- Gambar --}}
                    <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                        @if($item['image_url'])
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">
                                No img
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-gray-900 truncate">{{ $item['name'] }}</p>
                        <p class="text-sm text-gray-500">
                            Rp {{ number_format($item['price'], 0, ',', '.') }} / pcs
                        </p>
                    </div>

                    {{-- Update qty --}}
                    <form method="POST"
                          action="{{ route('cart.update', $item['product_id']) }}"
                          class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number"
                               name="quantity"
                               value="{{ $item['quantity'] }}"
                               min="0"
                               class="w-16 border border-gray-300 rounded-lg px-2 py-1 text-center text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                                class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            Update
                        </button>
                    </form>

                    {{-- Subtotal --}}
                    <p class="w-32 text-right font-bold text-gray-900">
                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                    </p>

                    {{-- Hapus --}}
                    <form method="POST"
                          action="{{ route('cart.destroy', $item['product_id']) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-gray-400 hover:text-red-500 transition"
                                title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- Grand Total --}}
        <div class="mt-6 flex justify-end items-center gap-6">
            <div class="text-right">
                <p class="text-sm text-gray-500 uppercase tracking-widest font-semibold">Total</p>
                <p class="text-2xl font-bold text-gray-900">
                    Rp {{ number_format($grandTotal, 0, ',', '.') }}
                </p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl transition">
                Checkout
            </button>
        </div>

        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:text-blue-700">
                ← Lanjutkan Belanja
            </a>
        </div>
    @endif
@endsection
