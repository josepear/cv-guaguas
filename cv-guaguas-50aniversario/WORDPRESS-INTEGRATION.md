# Tema WordPress — CV Guaguas 50 Aniversario

Tema WordPress personalizado para el libro conmemorativo del 50 aniversario del Club Voleibol Guaguas. Al activar el tema, `inc/sample-content.php` genera automáticamente todos los capítulos como Custom Post Types.

---

## Instalación

1. Copiar la carpeta en `wp-content/themes/cv-guaguas-50aniversario/`
2. Activar el tema desde **Apariencia → Temas**
3. El contenido se genera automáticamente al activar
4. Para regenerar: **Libro CV Guaguas → Capítulos → Regenerar contenido de ejemplo**

---

## Estructura de archivos

```
cv-guaguas-50aniversario/
├── style.css
├── functions.php               ← Shortcodes, CPT, meta boxes, admin
├── header.php
├── footer.php
├── single-capitulo.php         ← Template de capítulo + redirect padres→primer hijo
├── template-home.php
├── assets/
│   ├── css/main.css            ← CSS principal
│   ├── js/main.js
│   └── images/
│       ├── estrella-icon.svg       ← Icono estrella heroes estándar
│       ├── estrella-iconos.svg     ← Icono circular Cap 5
│       ├── copa-default.jpg        ← Copa por defecto en [titulo_deportivo]
│       ├── logo-guaguas.svg
│       ├── acerbis.svg             ┐
│       ├── afs.svg                 │
│       ├── elextinguidor.svg       │
│       ├── firgas.svg              ├── Logos patrocinadores (SVG vectorial)
│       ├── hiperdino.svg           │
│       ├── icare.svg               │
│       ├── r2hotels.svg            │
│       ├── toyota.svg              │
│       ├── universidad.svg         │
│       └── vistaflor.svg           ┘
└── inc/
    └── sample-content.php      ← Contenido completo de todos los capítulos
```

---

## Estado del contenido

| Cap | Título | Hijos | Estado |
|---|---|---|---|
| 0 | Prólogos | 9 | ✅ |
| 1 | Del patio del colegio a División de Honor | 8 | ✅ |
| 2 | Estatutos Fundacionales | — | ✅ standalone |
| 3 | Así se forjó una leyenda | 4 | ✅ |
| 4 | El proyecto visionario de Juan Ruiz | 2 | ✅ |
| 5 | Iconos y estrellas del CV Guaguas | 4 | ✅ |
| 6 | Ignacio Brito / Tributo a los Salesianos | — | ✅ standalone |
| 7 | Marek, ayer, hoy y siempre | — | ✅ standalone |
| 8 | Embajadores por Europa | 11 | ✅ |
| 9 | El relevo generacional | 8 | ✅ |
| 10 | Una transición dolorosa | 9 | ✅ |
| 11 | Títulos para una gran historia | 25 | ✅ |
| 12 | Vuelve el gran Guaguas | 3 | ✅ |
| 13 | Del CID al Arenas | — | ✅ standalone |
| 14 | Los nuevos ídolos | 16 | ✅ |
| 15 | El impacto del escudo | — | ✅ standalone |
| 16 | La directiva y el futuro que viene | 6 | ✅ |
| 17 | Más honores | — | ✅ standalone |
| 18 | El Guaguas como en los viejos tiempos | — | ⏳ sin contenido |
| 19 | Empleados y técnicos | — | ✅ standalone |
| 20 | La plantilla del cincuentenario | — | ✅ (pendiente actualizar plantilla final) |
| 21 | Reconocimiento del colectivo arbitral | — | ✅ standalone |
| 22 | Miguel Ángel Ramírez | — | ✅ standalone |
| 23 | A la vanguardia de la tecnología | — | ✅ standalone |
| 24 | Socios y abonados | — | ⏳ sin contenido |
| 25 | Empresarios de la tierra | 11 | ✅ (fondo dorado + logos SVG) |

---

## Shortcodes

### `[capitular]`
Primera letra capital dorada.
```
[capitular]Texto del párrafo introductorio...[/capitular]
```

### `[cita_editorial author=""]`
Cita destacada con autor opcional.
```
[cita_editorial author="Juan Ruiz"]El secreto es trabajo y pasión.[/cita_editorial]
```

### `[cita_prensa source=""]`
Cita de hemeroteca con fuente.
```
[cita_prensa source="La Provincia, 17 de julio de 1987"]Texto...[/cita_prensa]
```

### `[seccion_header]`
Encabezado de sección interior con fondo dorado ajustado al texto.
```
[seccion_header]José Eduardo Ramírez — Presidente de Guaguas Municipales[/seccion_header]
```

### `[resaltado]`
Elemento destacado. Se usa para listas de presidentes y entrenadores.
```
[resaltado]Juan Ruiz[/resaltado]
```

### `[articulo numero=""]`
Artículo numerado (Estatutos Fundacionales).
```
[articulo numero="1º"]El nombre de la nueva entidad será...[/articulo]
```

### `[perfil_jugador nombre="" subtitulo="" imagen="" posicion_imagen="left"]`
Perfil biográfico con foto opcional.
```
[perfil_jugador nombre="Sergio Miguel Camarero" subtitulo="Leyenda" imagen="url"]
Texto del perfil...
[/perfil_jugador]
```

### `[titulo_deportivo numero="" nombre="" anio="" foto=""]`
Layout del palmarés. La foto es opcional (usa `copa-default.jpg` por defecto).

```
[titulo_deportivo numero="1" nombre="COPA DEL REY" anio="1989"]
[ficha_tecnica]
[equipo numero="3" nombre="GUAGUAS LAS PALMAS"]Jugadores... <strong>Entrenador:</strong> Nombre.[/equipo]
[equipo numero="0" nombre="RIVAL"]Jugadores...[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-10, 11-15, 15-5 y 15-8</p>
[/ficha_tecnica]
[narrativa]Texto narrativo del título...[/narrativa]
[/titulo_deportivo]
```

**Layout:**
- Bloque superior: foto copa (izq, 1fr) / número grande (der, 1fr)
- Bloque inferior: narrativa 60% / ficha técnica 40%
- Número: `256px` desktop / `128px` mobile, `font-weight: 600`
- Fuente ficha técnica: `0.8125rem`

### `[ficha_debut titulo=""]`
Ficha técnica standalone con estrella y título centrados.
```
[ficha_debut titulo="LA FICHA DEL DEBUT"]
[equipo numero="3" nombre="CV GUAGUAS"]Jugadores...[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> ...</p>
[/ficha_debut]
```

### `[dos_columnas]`
Layout de dos columnas con separador `|||`. **No admite shortcodes hijos anidados** — todo el contenido va plano.

```
[dos_columnas]
Contenido columna izquierda (40%)...
[cita_editorial]...[/cita_editorial]
|||
Contenido columna derecha (60%)...
[/dos_columnas]

Contenido a ancho completo debajo...
```

---

## Convenciones de hero

| Tipo | Icono | Color | Border | Overlay |
|---|---|---|---|---|
| Standalone / hijos intro | `estrella-icon.svg` 40×40px | `hsl(45 100% 50%)` | `hsl(45 100% 50%)` | `rgba(0,0,0,0.15)` |
| Cap 5 hijos | `estrella-iconos.svg` 80×80px | — | `hsl(45 100% 50%)` | `rgba(0,0,0,0.15)` |
| Cap 8 / Cap 9 hijos | Sin hero | — | — | — |
| Capítulos padre (con hijos) | Sin hero (redirigen al primer hijo) | — | — | — |

**Línea de título estándar:**
```php
libro_hero_line('TEXTO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')
// args: texto, color_fondo_highlight, color_texto, sombra
```

---

## Páginas de patrocinadores (Cap 25)

Los hijos del Cap 25 usan layout de fondo dorado. El `<h1>` se suprime automáticamente cuando el padre es el capítulo 25 (el logo actúa de cabecera).

```html
<div class="patrocinador-page">
  <div class="patrocinador-logo">
    <img src="<?php echo libro_img('nombre.svg'); ?>" alt="Empresa">
  </div>
  <div class="patrocinador-texto">
    <p>Texto de la empresa...</p>
  </div>
  <div class="patrocinador-ficha">
    <p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
    <p>...</p>
  </div>
  <div class="patrocinador-redes">
    <p class="patrocinador-redes-titulo">Web y redes sociales</p>
    <p><a href="..." target="_blank" rel="noopener">...</a></p>
  </div>
</div>
```

**CSS clave:**
- `.patrocinador-page` — `background: hsl(var(--gold))`, `border-radius: 1rem`
- `.patrocinador-logo` — `min-height: 300px` desktop / `min-height: 160px` mobile
- Logos — `filter: brightness(0)` (negro sobre dorado)
- El fondo dorado es invariante en light/dark mode (decisión editorial)

---

## Navegación

- Padres con hijos → redirigen 301 al primer hijo
- Nav prev/next excluye padres — navega solo entre páginas con contenido real
- **Teclado (desktop):** `←` / `→` navegan entre capítulos
  - Los botones `#nav-prev` y `#nav-next` tienen IDs para el JS
  - Desactivado en dispositivos táctiles (`hover: none`)
  - Ignorado si el foco está en un input/textarea o se usan teclas modificadoras
  - Highlight visual 160ms antes de navegar
  - Hint "← → Navega con las teclas" en la primera visita de sesión (sessionStorage)

---

## CSS — Reglas fundamentales

```css
/* Fuente única: Inter en toda la web */
--font-display: 'Inter', sans-serif;
--font-sans:    'Inter', sans-serif;
--font-serif:   'Inter', sans-serif;

/* Variables de color: SIEMPRE con wrapper hsl() para variables de canal */
color: hsl(var(--foreground));   /* ✅ — variable almacena canales: 220 50% 12% */
color: var(--foreground);        /* ❌ */

/* EXCEPCIÓN: --lm-gold almacena el color completo, usar con var() directamente */
color: var(--lm-gold);           /* ✅ — variable almacena hsl(45, 100%, 42%) */
color: hsl(var(--lm-gold));      /* ❌ — doble wrapper, no funciona */

/* Selectores de modo: SIEMPRE body.dark / body.light */
body.dark .clase  { ... }   /* ✅ */
body.light .clase { ... }   /* ✅ */
.dark .clase      { ... }   /* ❌ */
```

**Light mode** — `body.light` define `--foreground: 220 50% 12%` (azul marino).
**Sidebar** — siempre oscura en ambos modos.

---

## Variables CSS principales

```css
:root {
    --gold:              45 100% 50%;
    --background:        220 50% 10%;
    --foreground:        0 0% 98%;
    --muted:             220 30% 16%;
    --muted-foreground:  220 15% 65%;
    --border:            220 25% 22%;
    --font-display:      'Inter', sans-serif;
    --font-sans:         'Inter', sans-serif;
}

body.light {
    --background:        40 30% 96%;
    --foreground:        220 50% 12%;
    --muted:             220 15% 92%;
    --border:            220 20% 82%;
    --lm-gold:           hsl(45, 100%, 42%); /* Gold oscuro legible sobre fondo claro */
}
```

---

## Notas de implementación

**WordPress nested shortcode parsing** — Los shortcodes hijos anidados (p.ej. `[col]` dentro de `[dos_columnas]`) fallan porque WordPress los procesa en orden incorrecto. Solución establecida: usar el delimitador `|||` como texto plano dentro de `[dos_columnas]`.

**Regenerar contenido** — Al regenerar se borran y recrean todos los posts de tipo `capitulo`. Los metadatos adicionales (imágenes destacadas, etc.) deben resubirse manualmente si procede.

**Capítulos pendientes** — Cap 18 y Cap 24 no tienen contenido aún. Se muestran en el menú lateral pero al acceder muestran página vacía. Actualizar `sample-content.php` cuando estén disponibles y regenerar.
