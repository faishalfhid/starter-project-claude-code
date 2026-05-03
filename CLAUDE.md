# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

**Setup (first time):**
```bash
composer setup
```

**Run dev server (all services):**
```bash
composer dev
```
This starts the Laravel server, queue worker, Pail log viewer, and Vite simultaneously.

**Run tests:**
```bash
composer test
# or directly with Pest
php artisan test
./vendor/bin/pest
```

**Run a single test file:**
```bash
./vendor/bin/pest tests/Feature/ExampleTest.php
```

**Run a single test by name:**
```bash
./vendor/bin/pest --filter "test name"
```

**Code style (Laravel Pint):**
```bash
./vendor/bin/pint
```

## Architecture

This is a fresh **Laravel 13** application (PHP 8.3+) using **Pest** as the test framework.

- `app/` — Application code (Models, Controllers, Providers)
- `routes/web.php` — Web routes
- `routes/console.php` — Artisan console commands
- `tests/Feature/` — Feature tests (bound to `Tests\TestCase` with Laravel app context)
- `tests/Unit/` — Unit tests (plain PHPUnit, no app bootstrapping)
- `tests/Pest.php` — Pest configuration: global helpers, custom expectations, base test case bindings

Feature tests extend `Tests\TestCase` (configured in `tests/Pest.php`). `RefreshDatabase` is available but commented out by default — uncomment the `->use(RefreshDatabase::class)` line in `tests/Pest.php` when database interaction is needed in tests.

The app uses SQLite by default (see `database/database.sqlite`).

## Konvensi Project TokoKita

### Struktur Folder Tambahan
- Semua **Blade UI Component reusable** disimpan di `resources/views/components/ui/`
- Semua **Service class** (business logic) disimpan di `app/Services/`
- Semua **Form Request validation** disimpan di `app/Http/Requests/`

### Naming Convention
- Blade component: `kebab-case.blade.php` (contoh: `product-card.blade.php`)
- Model: `PascalCase` singular (contoh: `Product`, `Category`)
- Controller: `PascalCase` + suffix `Controller` (contoh: `ProductController`)

### Tailwind
- Selalu gunakan utility classes Tailwind, hindari custom CSS kecuali sangat perlu.
- Untuk warna primary, gunakan palette `blue-600` (default) dan `blue-700` (hover).

### Membuat Halaman Baru
Setiap kali diminta membuat halaman baru (dengan kata kunci "buat halaman baru"), **otomatis tambahkan link navigasi** ke navbar di `resources/views/layouts/app.blade.php` — di dalam `<div class="flex gap-4">` — tanpa perlu diminta secara terpisah.

### JANGAN
- Jangan membuat hooks/components di sembarang tempat. Tunggu instruksi spesifik.
- Jangan modifikasi file `.env` atau `database/database.sqlite` tanpa konfirmasi.
- Jangan run `php artisan migrate:fresh` (akan menghapus data).
