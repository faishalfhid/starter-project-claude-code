# Review: product-card-v2.blade.php
Date: 2026-05-03
Score: 7.5/10
Method: Static code analysis (browser_take_screenshot and browser_resize permissions denied)

## Critical Bugs
1. SVG half-star gradient uses `stop-color="currentColor"` inside `<defs>` — does not reliably inherit CSS color in all browsers. Fix: use `#facc15` (yellow-400) hardcoded.
2. Gradient ID uses raw `$name` — breaks on spaces/special chars. Fix: use `md5($name)` or `Str::slug($name)`.

## Accessibility Issues
- No `aria-label` on the card link (`<a>` tag)
- No `aria-label` on the star rating wrapper div
- No `focus:ring` on the card link — Tailwind resets browser outline

## Minor Issues
- `text-gray-400` (strikethrough price) fails WCAG AA — upgrade to `text-gray-500`
- `text-gray-500` (review count) borderline — upgrade to `text-gray-600`
- Price font size does not scale with `size` prop (sm/md/lg all get same size)
- SVG placeholder icon (`w-16 h-16`) too small for `h-48`/`h-60` image area

## What's Good
- Clean prop definitions and PHP logic in `@php` block
- Size variants via lookup arrays (clean pattern)
- Discount calculation in PHP, not template
- Hover: scale on image, color on title, shadow on card — all present
- Fallback placeholder for missing image
- Convention compliance: correct file location, kebab-case name, Tailwind only, blue-600/700
- Navbar link already added correctly
