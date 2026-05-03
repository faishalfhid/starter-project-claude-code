<?php

/**
 * Feature tests untuk Blade component `ui.product-card-v2`.
 *
 * Strategi: gunakan $this->blade() yang tersedia di Laravel 13 / Pest
 * untuk me-render komponen secara in-process dan assert HTML output-nya.
 *
 * Tidak membutuhkan database — RefreshDatabase tidak diperlukan.
 */

describe('ProductCardV2 Component', function () {

    // -------------------------------------------------------------------------
    // 1. Render dengan props minimal (hanya name & price) — tidak error
    // -------------------------------------------------------------------------
    it('renders without error when only name and price are provided', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2 name="Sepatu Lari" :price="150000" />',
        );

        $html->assertSee('Sepatu Lari')
             ->assertSee('150.000'); // number_format dengan separator titik
    });

    // -------------------------------------------------------------------------
    // 2. Badge sale MUNCUL saat isSale=true dan originalPrice diberikan
    // -------------------------------------------------------------------------
    it('shows sale badge when isSale is true and originalPrice is provided', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Tas Kulit"
                :price="80000"
                :originalPrice="100000"
                :isSale="true"
            />',
        );

        // Badge berisi persentase diskon dalam bentuk "-xx%"
        $html->assertSee('bg-red-600', false)
             ->assertSee('%');
    });

    // -------------------------------------------------------------------------
    // 3. Badge sale TIDAK MUNCUL saat isSale=false
    // -------------------------------------------------------------------------
    it('does not show sale badge when isSale is false', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Tas Kulit"
                :price="80000"
                :originalPrice="100000"
                :isSale="false"
            />',
        );

        $html->assertDontSee('bg-red-600', false);
    });

    // -------------------------------------------------------------------------
    // 4. Persentase diskon dihitung dengan benar dan tampil
    //    price=80000, originalPrice=100000 → diskon = round((1-80000/100000)*100) = 20%
    // -------------------------------------------------------------------------
    it('calculates and displays discount percentage correctly', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Kemeja Formal"
                :price="75000"
                :originalPrice="100000"
                :isSale="true"
            />',
        );

        // diskon = round((1 - 75000/100000) * 100) = round(25) = 25
        $html->assertSee('-25%');
    });

    // -------------------------------------------------------------------------
    // 5. Rating penuh (5 bintang) — semua bintang kuning, nol abu-abu
    // -------------------------------------------------------------------------
    it('renders all yellow stars when rating is 5', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Produk Top"
                :price="50000"
                :rating="5"
                :reviewCount="10"
            />',
        );

        $rendered = (string) $html;

        // 5 bintang kuning = 5 kemunculan text-yellow-400
        expect(substr_count($rendered, 'text-yellow-400'))->toBe(5);

        // Tidak boleh ada bintang abu-abu
        expect($rendered)->not->toContain('text-gray-300');
    });

    // -------------------------------------------------------------------------
    // 6. Harga original dicoret saat sale
    // -------------------------------------------------------------------------
    it('shows original price with line-through when on sale', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Jaket Kulit"
                :price="200000"
                :originalPrice="300000"
                :isSale="true"
            />',
        );

        // Harga asli (300.000) harus muncul dengan class line-through
        $rendered = (string) $html;

        expect($rendered)->toContain('line-through');
        expect($rendered)->toContain('300.000');
    });

    // -------------------------------------------------------------------------
    // 7a. Kategori TAMPIL jika diberikan
    // -------------------------------------------------------------------------
    it('displays category when provided', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Produk A"
                :price="50000"
                category="Elektronik"
            />',
        );

        $html->assertSee('Elektronik');
    });

    // -------------------------------------------------------------------------
    // 7b. Kategori TIDAK TAMPIL jika null
    // -------------------------------------------------------------------------
    it('does not display category when it is null', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Produk B"
                :price="50000"
                :category="null"
            />',
        );

        // Pastikan class yang hanya muncul di blok kategori tidak ada
        $html->assertDontSee('text-blue-600 uppercase', false);
    });

    // -------------------------------------------------------------------------
    // 8. Review count tampil dalam format ribuan jika > 999
    //    PHP number_format(1200) → "1,200"  (koma sebagai separator default)
    // -------------------------------------------------------------------------
    it('displays review count formatted with thousands separator when over 999', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Produk Viral"
                :price="99000"
                :rating="4.5"
                :reviewCount="1200"
            />',
        );

        // number_format(1200) → "1,200"
        $html->assertSee('(1,200)');
    });

    // -------------------------------------------------------------------------
    // 9a. Size `sm` menghasilkan class CSS `max-w-xs text-sm`
    // -------------------------------------------------------------------------
    it('applies sm size classes when size is sm', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Mini Card"
                :price="30000"
                size="sm"
            />',
        );

        $rendered = (string) $html;

        expect($rendered)->toContain('max-w-xs');
        expect($rendered)->toContain('text-sm');
        expect($rendered)->not->toContain('max-w-sm');
        expect($rendered)->not->toContain('max-w-md');
    });

    // -------------------------------------------------------------------------
    // 9b. Size `md` menghasilkan class CSS `max-w-sm text-base`
    // -------------------------------------------------------------------------
    it('applies md size classes when size is md', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Medium Card"
                :price="30000"
                size="md"
            />',
        );

        $rendered = (string) $html;

        expect($rendered)->toContain('max-w-sm');
        expect($rendered)->toContain('text-base');
        expect($rendered)->not->toContain('max-w-xs');
        expect($rendered)->not->toContain('max-w-md');
    });

    // -------------------------------------------------------------------------
    // 9c. Size `lg` menghasilkan class CSS `max-w-md text-lg`
    // -------------------------------------------------------------------------
    it('applies lg size classes when size is lg', function () {
        $html = $this->blade(
            '<x-ui.product-card-v2
                name="Large Card"
                :price="30000"
                size="lg"
            />',
        );

        $rendered = (string) $html;

        expect($rendered)->toContain('max-w-md');
        expect($rendered)->toContain('text-lg');
        expect($rendered)->not->toContain('max-w-xs');
        expect($rendered)->not->toContain('max-w-sm');
    });

});
