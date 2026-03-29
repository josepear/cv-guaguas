

# Fix: Hero button hover + light mode title gradient in WordPress

## Problems

### 1. EPUB button has no hover effect
The EPUB button in `template-home.php` (line 74) uses inline `style` for colors but has no class that provides hover states. React uses `hover:!border-gold hover:!text-gold` via Tailwind. Since inline styles override CSS `:hover` rules, the `btn-download-outline:hover` in `main.css` is blocked.

**Fix**: Remove the inline `style` attribute and use Tailwind classes directly on the EPUB button, matching React exactly:
```html
class="btn-download !bg-transparent !text-white !border-white/30 hover:!border-gold hover:!text-gold"
```
Same for PDF button — use Tailwind classes instead of inline styles:
```html
class="btn-download btn-download-primary !bg-gold !text-[hsl(220,50%,10%)] !border-gold hover:!bg-transparent hover:!text-gold"
```
Since WordPress uses Tailwind CDN, these exact classes will work.

### 2. Light mode title gradient too dark
WordPress `header.php` defines a different, darker gradient for `.light .text-gold-gradient`:
- **WordPress light**: `50%` → `42%` → `32%` (ends very dark)
- **React (both modes)**: `60%` → `50%` → `40%` (brighter)

React uses the same CSS variables for both modes — no light-mode override. So the WordPress `.light .text-gold-gradient` rule should be **removed** from `header.php`, letting the dark-mode default (which matches React) apply in both modes.

## Changes

### 1. `wordpress-theme/template-home.php` — Lines 67-79
Replace inline-styled buttons with Tailwind classes identical to React:

```html
<a href="..." class="btn-download btn-download-primary !bg-gold !text-[hsl(220,50%,10%)] !border-gold hover:!bg-transparent hover:!text-gold">
    ...Descargar PDF
</a>
<a href="..." class="btn-download !bg-transparent !text-white !border-white/30 hover:!border-gold hover:!text-gold">
    ...Descargar EPUB
</a>
```

### 2. `wordpress-theme/header.php` — Remove light mode gradient override
Delete the `.light .text-gold-gradient` rule (lines 147-149) so both modes use the same bright gradient as React.

