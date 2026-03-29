

# Fix: Paridad Home entre React y WordPress

## Diferencias encontradas

| Elemento | React | WordPress | Fix |
|----------|-------|-----------|-----|
| **Imagen de fondo** | `hero-home.jpg` | `hero-stadium.jpg` | Cambiar a `hero-home.jpg` |
| **Título por defecto** | `"Historia del CV Guaguas"` (desde Index.tsx) | `"50 Años de Historia"` | Cambiar default a `"Historia del CV Guaguas"` |
| **Subtítulo por defecto** | `"Un recorrido por la trayectoria..."` | `"Cinco décadas de pasión..."` | Cambiar default |
| **Color h1** | `text-white` | `text-foreground` | Cambiar a `text-white` |
| **Color subtítulo** | `text-white/80` | `text-foreground/80` | Cambiar a `text-white/80` |
| **Background como `<img>`** | Usa `<img>` tag con `object-cover` | Usa `<div>` con `background-image` | Cambiar a `<img>` tag (mejor rendimiento con `fetchPriority`) |
| **Botón PDF style** | `!bg-gold !text-[hsl(220,50%,10%)] !border-gold` | Clase `btn-download-primary` | Verificar que la clase coincide |
| **Botón EPUB style** | `!bg-transparent !text-white !border-white/30` | Clase `btn-download-outline` | Verificar que la clase coincide |
| **og:image** | N/A | `hero-stadium.jpg` | Cambiar a `hero-home.jpg` |

## Cambios

### 1. `wordpress-theme/template-home.php`
- Cambiar imagen de `hero-stadium.jpg` a `hero-home.jpg`
- Cambiar defaults del título y subtítulo para coincidir con React Index.tsx
- Cambiar `<div>` background-image por `<img>` con `object-cover` (como React)
- Cambiar `text-foreground` a `text-white` en h1 y `text-foreground/80` a `text-white/80` en subtítulo
- Actualizar clases de botones para usar los mismos estilos inline que React

### 2. `wordpress-theme/header.php`
- Cambiar `og:image` de `hero-stadium.jpg` a `hero-home.jpg`

