@extends('layouts.app')

@section('title', 'Produk')

@section('content')
    @if(session('success'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-bold mb-6">Semua Produk</h1>

    @if($products->isEmpty())
        <p class="text-gray-500">Belum ada produk tersedia.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-md overflow-hidden flex flex-col">
                    {{-- Image area dengan background gradient --}}
                    <div class="relative h-52 overflow-hidden">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-indigo-300 to-indigo-500 flex items-center justify-center text-indigo-200 text-sm">
                                Tidak ada gambar
                            </div>
                        @endif

                        {{-- Tombol wishlist --}}
                        <button class="absolute top-3 right-3 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white rounded-full w-9 h-9 flex items-center justify-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z" />
                            </svg>
                        </button>
                    </div>

                    {{-- Info area --}}
                    <div class="flex flex-col flex-1 p-5 gap-3">
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">{{ $product->name }}</h2>

                            {{-- Badge kategori & stok --}}
                            <div class="flex flex-wrap gap-2 mt-2">
                                @if($product->category)
                                    <span class="text-xs border border-gray-300 text-gray-600 rounded px-2 py-0.5 uppercase tracking-wide">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                                <span class="text-xs border border-gray-300 text-gray-600 rounded px-2 py-0.5 uppercase tracking-wide">
                                    Stok {{ $product->stock }}
                                </span>
                            </div>
                        </div>

                        <p class="text-sm text-gray-500 line-clamp-3 flex-1">{{ $product->description }}</p>

                        {{-- Harga + tombol --}}
                        <div class="flex items-end justify-between mt-1">
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Harga</p>
                                <p class="text-xl font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit"
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
