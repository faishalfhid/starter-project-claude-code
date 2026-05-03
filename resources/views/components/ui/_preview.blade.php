{{-- Preview & contoh penggunaan semua UI components --}}
@extends('layouts.app')

@section('title', 'UI Component Preview')

@section('content')

    {{-- ===================== MODAL ===================== --}}
    <section>
        <h2 class="text-xl font-bold text-gray-800 mb-4">Modal</h2>

        <div class="flex flex-wrap gap-3">
            {{-- Trigger: modal default (md) --}}
            <button
                onclick="openModal('modal-demo-default')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium"
            >
                Buka Modal Default (md)
            </button>

            {{-- Trigger: modal kecil --}}
            <button
                onclick="openModal('modal-demo-sm')"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium"
            >
                Buka Modal Kecil (sm)
            </button>

            {{-- Trigger: modal besar --}}
            <button
                onclick="openModal('modal-demo-lg')"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium"
            >
                Buka Modal Besar (lg)
            </button>

            {{-- Trigger: modal tanpa close on overlay --}}
            <button
                onclick="openModal('modal-demo-no-overlay')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium"
            >
                Buka Modal (no overlay close)
            </button>
        </div>

        {{-- Modal default --}}
        <x-ui.modal id="modal-demo-default" title="Konfirmasi Hapus">
            <p class="text-gray-600">Apakah kamu yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.</p>

            <x-slot:footer>
                <button onclick="closeModal('modal-demo-default')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                    Batal
                </button>
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Ya, Hapus
                </button>
            </x-slot:footer>
        </x-ui.modal>

        {{-- Modal sm --}}
        <x-ui.modal id="modal-demo-sm" title="Info" size="sm">
            <p class="text-gray-600 text-sm">Operasi berhasil dilakukan.</p>

            <x-slot:footer>
                <button onclick="closeModal('modal-demo-sm')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    OK
                </button>
            </x-slot:footer>
        </x-ui.modal>

        {{-- Modal lg --}}
        <x-ui.modal id="modal-demo-lg" title="Detail Produk" size="lg">
            <div class="space-y-3">
                <p class="text-gray-600">Ini adalah modal berukuran besar untuk menampilkan konten yang lebih panjang, seperti detail produk, form lengkap, atau tabel data.</p>
                <p class="text-gray-500 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>

            <x-slot:footer>
                <button onclick="closeModal('modal-demo-lg')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg text-sm font-medium">
                    Tutup
                </button>
            </x-slot:footer>
        </x-ui.modal>

        {{-- Modal tanpa close on overlay --}}
        <x-ui.modal id="modal-demo-no-overlay" title="Pilih Opsi" :closeOnOverlay="false">
            <p class="text-gray-600">Modal ini tidak bisa ditutup dengan klik backdrop. Gunakan tombol di bawah.</p>

            <x-slot:footer>
                <button onclick="closeModal('modal-demo-no-overlay')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                    Tutup
                </button>
            </x-slot:footer>
        </x-ui.modal>
    </section>


    {{-- ===================== PRODUCT CARD V2 ===================== --}}
    <section class="mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Product Card V2</h2>

        <div class="flex flex-wrap gap-6">

            {{-- Card normal (no sale) --}}
            <x-ui.product-card-v2
                name="Sepatu Lari Nike Air Max"
                :price="450000"
                category="Sepatu"
                :rating="4"
                :reviewCount="128"
                href="#"
            />

            {{-- Card dengan sale badge --}}
            <x-ui.product-card-v2
                name="Tas Ransel Premium Waterproof Edition Terbaru 2025"
                :price="299000"
                :originalPrice="450000"
                :isSale="true"
                category="Tas"
                :rating="4.5"
                :reviewCount="87"
                href="#"
            />

            {{-- Card size sm --}}
            <x-ui.product-card-v2
                name="Kacamata Hitam UV400"
                :price="125000"
                :originalPrice="199000"
                :isSale="true"
                category="Aksesoris"
                :rating="3.5"
                :reviewCount="34"
                size="sm"
                href="#"
            />

            {{-- Card size lg --}}
            <x-ui.product-card-v2
                name="Jaket Fleece Anti Angin Outdoor"
                :price="550000"
                category="Pakaian"
                :rating="5"
                :reviewCount="210"
                size="lg"
                href="#"
            />

        </div>
    </section>

@endsection
