# Tema WordPress — CV Guaguas 50 Aniversario

Tema WordPress personalizado para el libro conmemorativo del 50 aniversario del Club Voleibol Guaguas. Al activar el tema, `inc/sample-content.php` genera automáticamente todos los capítulos como Custom Post Types.

---

## Instalación

1. Copiar la carpeta del tema en `wp-content/themes/cv-guaguas-50aniversario/`
2. Activar el tema desde **Apariencia → Temas**
3. El contenido se genera automáticamente al activar
4. Para regenerar en cualquier momento: **Libro CV Guaguas → Opciones → Regenerar todo el contenido**

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
│   ├── css/
│   │   └── main.css            ← CSS principal
│   ├── js/
│   │   └── main.js
│   └── images/
│       ├── estrella-icon.svg   ← Icono estrella para heroes estándar
│       ├── estrella-iconos.svg ← Icono circular para Cap 5
│       └── copa-default.jpg    ← Copa por defecto en [titulo_deportivo]
└── inc/
    └── sample-content.php      ← Contenido completo de todos los capítulos
```

---

## Shortcodes

### `[capitular]`
Primera letra capital dorada + párrafo introductorio.
```
[capitular]Antes que el club fue el colegio...[/capitular]
```

### `[cita_editorial]`
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
[seccion_header]Las horas extraescolares con Francisco Rodríguez[/seccion_header]
```

### `[resaltado]`
Elemento destacado. Se usa principalmente para listas de presidentes y entrenadores.
```
[resaltado]Juan Ruiz[/resaltado]
```

### `[articulo numero=""]`
Artículo numerado para los Estatutos Fundacionales.
```
[articulo numero="1º"]El nombre de la nueva entidad será...[/articulo]
```

### `[perfil_jugador nombre="" subtitulo="" imagen="" posicion_imagen="left"]`
Perfil biográfico con foto opcional.
```
[perfil_jugador nombre="Sergio Miguel Camarero" subtitulo="Leyenda del Guaguas" imagen="url"]
Contenido...
[/perfil_jugador]
```

### `[timeline]` / `[timeline_event year="" ]`
Línea de tiempo. En la práctica se usa HTML directo con las clases `.timeline-container` y `.timeline-event`.

---

### `[titulo_deportivo numero="" nombre="" anio="" foto=""]`

Layout de dos bloques para cada título del palmarés. La foto es opcional (por defecto usa `copa-default.jpg`).

**Estructura:**
```
[titulo_deportivo numero="1" nombre="COPA DEL REY" anio="1989"]
[ficha_tecnica]
[equipo numero="3" nombre="GUAGUAS LAS PALMAS"]jugadores... <strong>Entrenador:</strong> Nombre.[/equipo]
[equipo numero="0" nombre="RIVAL"]jugadores...[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-10, 11-15, 15-5 y 15-8</p>
<p><strong>Árbitros:</strong> ...</p>
<p><strong>Incidencias:</strong> ...</p>
[/ficha_tecnica]
[narrativa]Texto narrativo del título...[/narrativa]
[/titulo_deportivo]
```

**Layout visual:**
- **Bloque superior** — foto copa izq / número grande der (grid 1fr/1fr)
- **Bloque inferior** — encabezado + narrativa 60% izq / ficha técnica 40% der
- Número: `256px`, `font-weight: 600`, centrado. Mobile: `128px`
- Fuente ficha técnica: `0.8125rem`
- Mobile: ambos bloques colapsan a 1 columna

---

### `[ficha_debut titulo=""]`

Ficha técnica standalone con estrella y título centrados. Para usar fuera del shortcode `[titulo_deportivo]`.

```
[ficha_debut titulo="LA FICHA DEL DEBUT"]
[equipo numero="3" nombre="CV GUAGUAS"]jugadores...[/equipo]
[equipo numero="0" nombre="RIVAL"]jugadores...[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> ...</p>
[/ficha_debut]
```

---

### `[dos_columnas]`

Layout de dos columnas con separador `|||`. **No soporta shortcodes hijos anidados** — todo el contenido va plano.

```
[dos_columnas]
Contenido columna izquierda...
[cita_editorial]...[/cita_editorial]
|||
Contenido columna derecha...
[/dos_columnas]
```

- Relación: **40% izquierda / 60% derecha**
- Divider vertical entre columnas: `1px solid hsl(var(--border))`
- Mobile: colapsa a 1 columna con divider horizontal
- Se puede cerrar `[/dos_columnas]` en mitad de la página y continuar con contenido a ancho completo debajo

---

## Estructura de capítulos

26 capítulos numerados 0–25, ~121 entradas totales. Los capítulos padre con hijos redirigen automáticamente (301) al primer hijo.

| Cap | Título | Hijos | Estado |
|---|---|---|---|
| 0 | Prólogos | 9 | ✅ Completo |
| 1 | Del patio del colegio a División de Honor | 8 | ✅ Completo |
| 2 | Estatutos Fundacionales | — | ✅ Completo (standalone) |
| 3 | Así se forjó una leyenda | 4 | ✅ Completo |
| 4 | El proyecto visionario de Juan Ruiz | 2 | ✅ Completo |
| 5 | Iconos y estrellas del CV Guaguas | 4 | ✅ Completo |
| 6 | Ignacio Brito / Tributo a los Salesianos | — | ✅ Completo (standalone) |
| 7 | Marek, ayer, hoy y siempre | — | ✅ Completo (standalone) |
| 8 | Embajadores por Europa | 11 | ✅ Completo |
| 9 | El relevo generacional | 8 | ✅ Completo |
| 10 | Una transición dolorosa | 9 | ✅ Completo |
| 11 | Títulos para una gran historia | 25 | ✅ Completo (títulos 1–24 + Joselu Sánchez) |
| 12 | Vuelve el gran Guaguas | 3 | ✅ Completo (Un paso por aclamación, Presidentes, Entrenadores) |
| 13 | Del CID al Arenas | — | ✅ Completo (standalone, layout dos columnas + ficha debut) |
| 14 | Los nuevos ídolos | 15 | ⏳ Pendiente de contenido |
| 15 | El impacto del escudo | — | ⏳ Pendiente |
| 16 | La directiva y el futuro que viene | — | ⏳ Pendiente |
| 17 | Más honores | — | ⏳ Pendiente |
| 18 | El Guaguas como en los viejos tiempos | — | ⏳ Pendiente |
| 19 | Empleados y técnicos | — | ⏳ Pendiente |
| 20 | La plantilla del cincuentenario | — | ⏳ Pendiente |
| 21 | Reconocimiento del colectivo arbitral | — | ⏳ Pendiente |
| 22 | Miguel Ángel Ramírez | — | ⏳ Pendiente |
| 23 | A la vanguardia de la tecnología | — | ⏳ Pendiente |
| 24 | Socios y abonados | — | ⏳ Pendiente |
| 25 | Empresarios de la tierra | — | ⏳ Pendiente |

---

## Convenciones de hero

| Tipo de página | Icono | Color icono | Border | Overlay |
|---|---|---|---|---|
| Standalone y hijos introductorios | `estrella-icon.svg` 40×40px | `hsl(45 100% 50%)` | `hsl(45 100% 50%)` | `rgba(0,0,0,0.15)` |
| Cap 5 hijos (Iconos y Estrellas) | `estrella-iconos.svg` 80×80px | — | `hsl(45 100% 50%)` | `rgba(0,0,0,0.15)` |
| Cap 8 y Cap 9 hijos | Sin hero | — | — | — |
| Capítulos padre con hijos | Sin hero (redirigen al primer hijo) | — | — | — |

**Colores de línea de título (estilo estándar):**
```php
libro_hero_line('TEXTO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')
// args: texto, color_texto, color_highlight, font_weight
```

---

## Navegación prev/next

- Los capítulos **padre con hijos** redirigen automáticamente (301) al primer hijo
- La navegación prev/next **excluye padres** — navega solo entre páginas con contenido real
- Lógica en `single-capitulo.php` líneas ~45–75

---

## CSS — Decisiones clave

```css
/* Fuente única: Inter para toda la web */
--font-display: 'Inter', sans-serif;
--font-sans:    'Inter', sans-serif;
--font-serif:   'Inter', sans-serif;

/* Variables de color: siempre con wrapper hsl() */
color: hsl(var(--foreground));   /* ✅ correcto */
color: var(--foreground);        /* ❌ incorrecto */

/* Selectores de modo */
body.dark .clase { ... }   /* ✅ correcto */
.dark .clase { ... }       /* ❌ incorrecto */
body.light .clase { ... }  /* ✅ correcto */
```

**Light mode** — `body.light` tiene bloque completo de variables con `--foreground: 220 50% 12%` (azul marino sobre fondo crema).

---

## Admin — Regenerar contenido

El botón **Regenerar todo el contenido** en **Libro CV Guaguas → Opciones** borra todos los capítulos existentes y los regenera desde `sample-content.php`. Útil tras cualquier cambio en el archivo de contenido.

---

## Variables CSS principales

```css
:root {
    --gold:           45 100% 50%;
    --background:     220 50% 10%;
    --foreground:     0 0% 98%;
    --font-display:   'Inter', sans-serif;
    --font-sans:      'Inter', sans-serif;
}

body.light {
    --background:     40 30% 96%;
    --foreground:     220 50% 12%;
}
```

---

## Responsive breakpoints

```css
@media (max-width: 768px) { /* Mobile: columnas colapsan, número 128px */ }
```
