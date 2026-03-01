

## Problem

The hero section always has a dark overlay (even in light mode), but in light mode the `--gold` CSS variables were darkened to `hsl(40 100% 35%)` for better contrast on light backgrounds. This makes the gold text and buttons appear too dark against the hero's dark overlay.

## Solution

Override the gold CSS variables back to their bright values specifically inside the hero section when in light mode. This way:
- Links/buttons on light backgrounds keep the darker, high-contrast gold
- The hero always uses the bright, vibrant gold since its background is always dark

### Changes

**`src/index.css`** -- Add a scoped override:
```css
.light #hero {
  --gold: 45 100% 50%;
  --gold-light: 45 100% 60%;
  --gold-dark: 45 100% 40%;
  --gold-muted: 45 60% 45%;
}
```

This restores the original bright gold palette only within `#hero` in light mode, without affecting the rest of the page.

**`wordpress-theme/header.php`** -- Add the same CSS rule in the WordPress theme's internal styles for parity.

