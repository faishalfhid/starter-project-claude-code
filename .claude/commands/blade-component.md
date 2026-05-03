---
description: Buat Blade UI Component reusable di TokoKita
argument-hint: [nama-komponen] | [deskripsi singkat]
---

## Context

Parse $ARGUMENTS untuk mendapatkan:
- [nama]: Nama komponen dari $ARGUMENTS, format kebab-case
- [deskripsi]: Deskripsi komponen dari $ARGUMENTS

## Task

Buat Blade UI Component dengan ketentuan berikut:

- Lokasi file: `resources/views/components/ui/[nama].blade.php`
- Class component (jika perlu props kompleks): `app/View/Components/Ui/[NamaPascalCase].php`
- Gunakan Tailwind CSS untuk styling (utility classes only)
- Support common props: `variant` (primary, secondary, success, danger, warning), `size` (sm, md, lg) bila relevan
- Wajib ada `@props([...])` di awal komponen
- Tambahkan komentar singkat di atas file menjelaskan kegunaan komponen

## Variants Warna (dari Tailwind)

1. primary: bg-blue-600 hover:bg-blue-700 text-white
2. secondary: bg-gray-200 hover:bg-gray-300 text-gray-800
3. success: bg-green-600 hover:bg-green-700 text-white
4. danger: bg-red-600 hover:bg-red-700 text-white
5. warning: bg-yellow-500 hover:bg-yellow-600 text-white

## Preview & Test

- Tambahkan contoh penggunaan komponen di `resources/views/components/ui/_preview.blade.php` (buat kalau belum ada)
- Pastikan komponen bisa dipanggil dengan `<x-ui.[nama] />` di Blade

## Hindari

- Jangan modifikasi komponen lain yang sudah ada
- Jangan tambahkan dependency npm baru

## Review the Work

- **Invoke the ui-ux-reviewer subagent** untuk review visual hasil komponen
- **Invoke the laravel-test-writer subagent** untuk bikin test untuk komponen
- Iterate berdasarkan feedback sampai komponen siap production