

# Fix: PDF/EPUB buttons invisible in WordPress light mode sidebar

## Problem
In light mode, the `.btn-download-outline` buttons in the sidebar use `border-color: var(--lm-border)` which is `hsl(220 15% 85%)` -- nearly identical to the sidebar background `hsl(40 25% 95%)`. The buttons become invisible.

In React, the light mode uses `border-muted-foreground/50` which is `hsl(220 15% 45% / 0.5)` -- much darker and visible.

## Fix

### 1. `wordpress-theme/header.php` (line ~164)
Update the `.light .btn-download-outline` rule to use `--lm-muted-fg` with opacity instead of `--lm-border`:

```css
.light .btn-download-outline { 
    color: var(--lm-fg); 
    border-color: hsl(220 15% 45% / 0.5);  /* was: var(--lm-border) */
}
```

### 2. `wordpress-theme/assets/css/main.css` (line ~581-584)
Update the same rule in main.css for consistency:

```css
.light .btn-download-outline {
    border-color: hsl(220 15% 45% / 0.5);  /* matches React muted-foreground/50 */
    color: hsl(220 50% 12%);
}
```

Both changes align with the React implementation where `.light .btn-download-outline` uses `@apply border-muted-foreground/50 text-foreground`.

