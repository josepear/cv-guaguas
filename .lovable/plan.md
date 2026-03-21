

# Implementar Hero con foto para José Millán

## Enfoque

Usar el mismo sistema de `ChapterHero` que ya existe en los Estatutos Fundacionales, pero con la foto de José Millán como imagen de fondo y su nombre como título superpuesto.

## Cambios

### 1. `src/data/chaptersStructure.ts`

Modificar la entrada de `cap02-jose-millan` para añadir configuración `hero`:

- `backgroundImage`: la foto ya importada (`1cap_pati_photo_24.jpg`)
- `backgroundOverlay`: overlay oscuro semitransparente para legibilidad del texto (similar al de Estatutos pero más oscuro, ~0.4, dado que la foto es un retrato)
- `titleLines`: "JOSÉ MILLÁN" con highlight dorado (como Estatutos)
- `icon`: "none" (sin icono para este subcapítulo)
- `alignment`: "left" o "center" según preferencia
- `height`: similar a los otros heroes

### 2. `src/data/chapterContent.tsx`

Eliminar el `<ContentImage>` que se añadió previamente al inicio del contenido de José Millán, ya que la foto ahora estará en el Hero.

### 3. `wordpress-theme/inc/sample-content.php`

Actualizar la entrada de José Millán para reflejar que la imagen se usa como hero en lugar de como imagen de contenido inline.

