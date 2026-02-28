

## Plan: Añadir breadcrumbs a los capítulos

### Componente React

Crear `src/components/ChapterBreadcrumb.tsx`:
- Usa los componentes existentes de `@/components/ui/breadcrumb`
- Props: `chapter` (con su `parentId`, `title`, `number`)
- Lógica:
  - Siempre muestra "Inicio" (link a `/`)
  - Si el capítulo tiene padre → muestra el padre (link a `/capitulo/{parentSlug}`)
  - Muestra el capítulo actual como `BreadcrumbPage` (sin link)
- Estilo: texto `text-xs`, colores `text-muted-foreground`, separador chevron, gold en hover

### Integración en `Chapter.tsx`

- Importar `ChapterBreadcrumb`
- Renderizarlo dentro del `div.max-w-4xl` justo antes del `ChapterSection`, con `mb-6`
- Pasarle los datos del capítulo actual y su padre (obtenido de `chaptersData`)

### WordPress (`single-capitulo.php`)

- Añadir el mismo HTML del breadcrumb justo antes del contenido del capítulo
- Usar `wp_get_post_parent_id()` para detectar si hay padre
- Mismo estilo con clases Tailwind

### Archivos a modificar
1. **Crear** `src/components/ChapterBreadcrumb.tsx`
2. **Editar** `src/pages/Chapter.tsx` — insertar breadcrumb
3. **Editar** `wordpress-theme/single-capitulo.php` — insertar breadcrumb HTML

