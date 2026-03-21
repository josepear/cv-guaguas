

# Fix: WordPress light/dark mode parity issues

## Problem Found
**Critical CSS load order bug**: `main.css` is loaded via `wp_enqueue_style()` inside `wp_head()`, which runs AFTER the inline `<style>` in `header.php`. This means `main.css` rules override the light mode fixes in header.php.

Specifically, `main.css` line 581-583:
```css
.light .btn-download-outline {
    border-color: hsl(var(--muted-foreground) / 0.5); /* uses dark-mode variable = too light */
    color: hsl(var(--foreground));  /* = hsl(0 0% 98%) = WHITE text on light bg! */
}
```
This overrides the correct fix in header.php, making buttons invisible in light mode.

Additionally, `main.css` defines utility classes (`.text-foreground`, `.bg-background`, etc.) using dark-mode CSS variables with no light mode variants, potentially conflicting with Tailwind CDN's light mode behavior.

## Fix (2 files)

### 1. `wordpress-theme/assets/css/main.css` — Update light mode button rule (line 581-584)
```css
.light .btn-download-outline {
    border-color: hsl(220 15% 45% / 0.5);
    color: hsl(220 50% 12%);
}
```
Use hardcoded light-mode values instead of CSS variables that resolve to dark-mode colors.

### 2. `wordpress-theme/header.php` — Move inline `<style>` AFTER `wp_head()` (structural fix)
Move the entire inline `<style>` block (lines 98-360) to after `<?php wp_head(); ?>` (currently line 362). This ensures the light mode overrides in header.php always win over main.css, preventing future conflicts.

This is a one-time structural fix that eliminates the class of bugs where main.css overrides inline light-mode fixes.

## Verification Checklist
After fix:
- **Prologue name**: Gold bg + dark text (dark), Navy bg + white text (light) ✓ (already correct in both files)
- **Hero overlays**: Dark gradient (dark), lighter gradient (light) ✓ (header.php rules now win)
- **Sidebar**: Dark navy (dark), warm cream (light) ✓
- **Download buttons**: Visible borders + correct text color in both modes ✓
- **All text/bg utilities**: Tailwind CDN handles most; header.php overrides handle the rest ✓

