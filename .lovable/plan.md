

# Añadir `backgroundPosition` configurable al Hero

## Cambios

### 1. `src/components/ChapterHero.tsx`
- Añadir prop `backgroundPosition?: string` (default: `"center top"`).
- En el `<motion.div>` del background (línea 227), reemplazar la clase `bg-center` y añadir `backgroundPosition` al style inline.

### 2. `src/data/chaptersStructure.ts`
- Añadir `backgroundPosition` como campo opcional en la interfaz del hero.
- Pasar el valor en las entradas que lo necesiten (por defecto `"center top"`).
- Actualizar `Chapter.tsx` para pasar la prop.

### 3. `src/pages/Chapter.tsx`
- Pasar `backgroundPosition` del hero config al componente `ChapterHero`.

### 4. `wordpress-theme/single-capitulo.php`
- Leer un nuevo meta field `_hero_background_position` (default: `center top`).
- Aplicarlo como `background-position` inline en el div del hero.

### 5. `wordpress-theme/inc/meta-boxes.php`
- Añadir campo de texto `_hero_background_position` al meta-box del capítulo con placeholder "center top".

### 6. `wordpress-theme/functions.php`
- Actualizar el shortcode `[chapter_hero]` para soportar atributo `bg_position`.

