# TokoKita UI Reviewer — Agent Memory

## Project Basics
- Dev URL: `http://starter-claude-code.test` (Herd), NOT localhost or localhost:8000
- UI Preview route: `/ui-preview` -> `resources/views/components/ui/_preview.blade.php`
- Playwright tool permissions: `browser_resize` and `browser_take_screenshot` are currently DENIED. Use `browser_navigate`, `browser_snapshot`, and `browser_hover` only. Fall back to static code analysis when visual tools are unavailable.

## Reviewed Components
- `product-card-v2.blade.php` — Score: 7.5/10. See `reviews/product-card-v2.md` for full findings.

## Recurring Patterns & Issues

### SVG Gradient Half-Star Bug (confirmed in product-card-v2)
Using `stop-color="currentColor"` inside `<linearGradient>` in `<defs>` does NOT reliably inherit CSS color. Always use hardcoded hex values:
- yellow-400 = `#facc15`
- gray-300 = `#d1d5db`

### SVG Gradient ID Safety
Never use raw `$name` in SVG `id` attributes — spaces and special chars break SVG IDs. Use `md5($name)` or `Str::slug($name)`.

### Accessibility Gaps (seen repeatedly)
- Card-as-link (`<a>` wrapping entire card) needs `aria-label="Lihat produk: {{ $name }}"`.
- Star rating wrappers need `aria-label="Rating X dari 5"`.
- Tailwind resets browser focus outlines — always add `focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2` to interactive elements.

### Contrast Issues
- `text-gray-400` on white = ~2.85:1 — fails WCAG AA. Use `text-gray-500` minimum for decorative text, `text-gray-600` for meaningful secondary text.
- `text-gray-500` on white = ~3.95:1 — borderline, prefer `text-gray-600` for review counts or secondary labels.

## Confirmed Conventions (from CLAUDE.md + observation)
- Components: `resources/views/components/ui/kebab-case.blade.php`
- Primary: `blue-600` default, `blue-700` hover
- Layout wrapper: `max-w-6xl mx-auto px-6 py-8` in `layouts/app.blade.php`
- Navbar links go inside `<div class="flex gap-4">` in `app.blade.php`
