

## Plan: Crear página propia para el Capítulo 01 "Los orígenes"

### Contexto
Actualmente, el Capítulo 01 tiene hijos (subcapítulos) y la lógica en `Chapter.tsx` redirige automáticamente al primer hijo. Se necesita que el capítulo padre tenga su propia página con contenido, accesible como "Los orígenes".

### Cambios

1. **`src/data/chaptersStructure.ts`** — Añadir un nuevo subcapítulo al inicio de los `children` de `capitulo-01`:
   - `id: "cap01-los-origenes"`, `slug: "cap01-los-origenes"`, `title: "Los orígenes"`
   - Será el primer hijo, de modo que la redirección automática lleve a esta página

2. **`src/data/chapterContent.tsx`** — Añadir entrada placeholder para `"cap01-los-origenes"` (contenido pendiente de recibir del usuario)

3. **`src/pages/Chapter.tsx`** — No requiere cambios; la lógica existente de redirección al primer hijo funcionará automáticamente

### Resultado
- Al navegar al Capítulo 01, se redirigirá a "Los orígenes"
- En el sidebar aparecerá "Los orígenes" como primer subcapítulo
- El contenido quedará como placeholder hasta que se proporcione el texto

