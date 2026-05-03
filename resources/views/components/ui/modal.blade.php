{{-- Modal dialog dengan backdrop semi-transparan, support close on overlay click --}}
@props([
    'id' => 'modal',
    'title' => '',
    'size' => 'md',
    'closeOnOverlay' => true,
])

@php
    $sizeClasses = match($size) {
        'sm' => 'max-w-sm',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
        default => 'max-w-lg',
    };
@endphp

<div
    id="{{ $id }}"
    class="fixed inset-0 z-50 flex items-center justify-center hidden"
    role="dialog"
    aria-modal="true"
    aria-labelledby="{{ $id }}-title"
>
    {{-- Backdrop --}}
    <div
        class="absolute inset-0 bg-black/50 transition-opacity duration-200"
        @if($closeOnOverlay) onclick="closeModal('{{ $id }}')" @endif
    ></div>

    {{-- Dialog panel --}}
    <div class="relative z-10 w-full {{ $sizeClasses }} mx-4 bg-white rounded-xl shadow-xl transform transition-all duration-200">
        {{-- Header --}}
        @if($title)
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h2 id="{{ $id }}-title" class="text-lg font-semibold text-gray-900">
                    {{ $title }}
                </h2>
                <button
                    type="button"
                    onclick="closeModal('{{ $id }}')"
                    class="text-gray-400 hover:text-gray-600 transition-colors"
                    aria-label="Tutup"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Body --}}
        <div class="px-6 py-4">
            {{ $slot }}
        </div>

        {{-- Footer (optional slot) --}}
        @isset($footer)
            <div class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[role="dialog"]:not(.hidden)').forEach(function (modal) {
                closeModal(modal.id);
            });
        }
    });
</script>
