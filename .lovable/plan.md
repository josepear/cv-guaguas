

## Plan: Parent chapters toggle dropdown instead of navigating

### Problem
Currently, clicking a parent chapter title (e.g., "Prólogos") navigates to its page. Parent chapters with subchapters should not be pages — clicking them should only expand/collapse the subchapter list.

### Changes

**1. `src/components/SidebarIndex.tsx`**
- For chapters with `children`: replace the `<Link>` with a `<button>` that calls `toggleGroup(chapter.id)` (same as the chevron)
- Keep `<Link>` only for chapters without children (leaf chapters)

**2. `src/pages/Chapter.tsx`**
- When navigating to a parent chapter slug (one that has children), redirect to its first child instead
- This handles direct URL access and ensures no empty page is shown

**3. `wordpress-theme/sidebar-indice.php`**
- Mirror the same behavior: parent chapter links become toggle buttons instead of `<a>` tags

