# CV Guaguas — 50 Aniversario
## Tema WordPress · Libro institucional 1976–2026

Tema WordPress conmemorativo del 50 aniversario del CV Guaguas. Diseño editorial de libro digital con índice lateral navegable, paleta institucional azul marino / amarillo dorado y soporte completo dark/light mode.

---

## 📋 Índice

1. [Requisitos e instalación](#instalación)
2. [Configuración inicial](#configuración-post-instalación)
3. [Gestión de capítulos](#gestión-de-capítulos)
4. [Shortcodes — referencia completa](#shortcodes)
5. [Sistema de imágenes hero](#sistema-de-imágenes-hero)
6. [Personalización CSS](#personalización)
7. [Troubleshooting](#troubleshooting)

---

## Instalación

### Requisitos
- WordPress 6.0 o superior
- PHP 7.4 o superior
- No requiere plugins adicionales

### Método ZIP (recomendado)
1. Ve a `Apariencia → Temas → Añadir nuevo → Subir tema`
2. Selecciona `cv-guaguas-50aniversario-theme.zip`
3. Instala y activa

### FTP/SFTP
1. Sube la carpeta `cv-guaguas-50aniversario` a `/wp-content/themes/`
2. Ve a `Apariencia → Temas` y activa el tema

### Al activar se ejecuta automáticamente
- Registro del Custom Post Type `capitulo`
- Importación de todos los capítulos con contenido
- Registro de campos personalizados (meta boxes)
- Regeneración de permalinks

---

## Configuración post-instalación

### 1. Página de inicio
1. Ve a `Páginas → Añadir nueva`, título "Inicio"
2. Asigna la plantilla **"Página 50 Aniversario CV Guaguas"**
3. Publica y ve a `Ajustes → Lectura` → establécela como página de inicio

### 2. Reimportar contenido
Si necesitas volver al contenido original:
`Libro → Capítulos → Reimportar contenido de ejemplo`

### 3. Permalinks
Si los capítulos dan 404: `Ajustes → Enlaces permanentes → Guardar cambios`

---

## Gestión de capítulos

### Campos del editor

| Campo | Descripción |
|-------|-------------|
| **Número** | Mostrado en sidebar. Ej: `01`, `02`. Vacío = sin badge |
| **Mostrar marcador** | Activa la estrella "50 Aniversario" en el hero |
| **Orden** | Controla posición en sidebar (menor = primero) |
| **Capítulo padre** | Si se asigna, este capítulo es hijo de ese padre |
| **Hero** | Ver sección de imágenes hero más abajo |
| **Imagen editorial** | Imagen opcional que aparece al inicio del contenido |

### Jerarquía padre/hijo
Los capítulos padre que tienen hijos **redirigen automáticamente** al primer hijo (301). Su contenido y hero no son visibles directamente.

### Orden recomendado
```
Prólogos (order=1) → hijos order 2–9
Cap 01 (order=12) → hijos order 13–21
Cap 02 (order=25)
Cap 03 (order=30) ...
```

---

## Shortcodes

Todos los shortcodes se usan en el editor de contenido de los capítulos. Las imágenes se referencian por nombre de archivo (ubicadas en `assets/images/`).

---

### `[capitular]`

Letra capitular — la primera letra del contenido se agranda con estilo drop cap editorial.

```
[capitular]El CV Guaguas nació en 1976 de la mano de Felipe Nuez...[/capitular]
```

> No acepta parámetros.

---

### `[seccion_header]`

Cabecera de sección con estilo destacado. Alias: `[encabezado_seccion]`.

```
[seccion_header]Felipe Nuez[/seccion_header]

[seccion_header color="navy"]La etapa dorada[/seccion_header]

[seccion_header highlighted="false" tag="h2"]Título sin fondo[/seccion_header]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `highlighted` | `true` | `true` aplica fondo negro/dorado al texto |
| `color` | `""` | `navy` = estilo azul marino con texto blanco |
| `star` | `false` | `true` añade estrella decorativa antes del texto |
| `tag` | `h3` | Elemento HTML: `h2`, `h3`, `h4` |
| `texto` | `""` | Alternativa a poner el texto como contenido del shortcode |

---

### `[cita_editorial]`

Cita destacada con borde dorado lateral y comillas decorativas.

```
[cita_editorial author="Juan Ruiz"]El Guaguas es mucho más que un club de voleibol.[/cita_editorial]

[cita_editorial author="Paco Sánchez Jover" source="Entrevista 2025"]
    Ganar aquí era como ganar dos veces.
[/cita_editorial]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `author` | `""` | Nombre del autor |
| `source` | `""` | Fuente o contexto (cursiva tras el autor) |

---

### `[cita_prensa]`

Cita textual de prensa o fuente documental.

```
[cita_prensa source="La Provincia, 1 de septiembre de 1976"]
    Junto al preparador técnico, Felipe Nuez, ha venido a incrementar el plantel de entrenadores.
[/cita_prensa]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `source` | `""` | Medio y fecha |

---

### `[imagen_contenido]`

Imagen dentro del contenido con caption opcional, efecto hover y layout responsivo.

```
[imagen_contenido file="foto.jpg"]

[imagen_contenido file="foto.jpg" caption="Pie de foto descriptivo."]

[imagen_contenido file="foto.jpg" fullwidth="true" caption="Foto a sangre completa."]

[imagen_contenido file="foto.jpg" max_width="50%" caption="Imagen centrada al 50%."]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `file` | `""` | Nombre del archivo en `assets/images/` |
| `src` | `""` | URL absoluta (alternativa a `file`) |
| `alt` | `""` | Texto alternativo de accesibilidad |
| `caption` | `""` | Pie de foto |
| `fullwidth` | `false` | `true` = imagen al 100% del contenedor (bleed) |
| `max_width` | `""` | Anchura máxima, ej: `50%`, `400px` (centra la imagen) |

---

### `[imagen]`

Inserta una imagen por su ID de la media library de WordPress.

```
[imagen id="123" caption="Pie de foto."]

[imagen id="456" size="medium" fullwidth="true"]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `id` | `""` | ID del adjunto en media library |
| `size` | `large` | `thumbnail`, `medium`, `large`, `full` |
| `caption` | `""` | Pie de foto |
| `fullwidth` | `false` | Bleed full-width |

---

### `[resaltado]`

Texto con fondo de color (amarillo dorado por defecto).

```
[resaltado]texto resaltado en dorado[/resaltado]

[resaltado color_fondo="hsl(220, 50%, 12%)" color_texto="hsl(0, 0%, 100%)"]texto en navy[/resaltado]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `color_fondo` | `hsl(45, 100%, 50%)` | Color de fondo |
| `color_texto` | `#1a237e` | Color del texto |

---

### `[bloque_color]`

Bloque contenedor con fondo de color personalizable.

```
[bloque_color]Contenido con fondo amarillo dorado.[/bloque_color]

[bloque_color fondo="hsl(220, 50%, 12%)" texto="hsl(0,0%,100%)" radio="1rem"]
    Bloque azul marino con esquinas redondeadas.
[/bloque_color]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `fondo` | `hsl(46, 92%, 62%)` | Color de fondo |
| `texto` | `#1a1a0a` | Color del texto |
| `radio` | `0.5rem` | Border-radius |

---

### `[prologo]`

Layout de prólogo con foto hero del prologuista y texto debajo.

```
[prologo nombre="Fernando Clavijo" cargo="Presidente del Gobierno de Canarias" foto="prol_clavijo.jpg"]
    Texto completo del prólogo...
[/prologo]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `nombre` | `""` | Nombre completo del prologuista |
| `cargo` | `""` | Cargo o título |
| `foto` | `""` | Nombre del archivo en `assets/images/` |
| `posicion` | `center 20%` | `background-position` de la foto hero |

---

### `[perfil_jugador]`

Layout biográfico con foto y texto en columnas. Usado en caps 8 y 9.

```
[perfil_jugador 
    nombre="Paco Sánchez Jover" 
    subtitulo="El arquitecto de una época dorada"
    imagen="5cap_jove_foto1.jpg"
    imagen_alt="Paco Sánchez Jover"
    imagen_caption="En el banquillo del CID."
    posicion_imagen="left"
]
    Texto biográfico...
[/perfil_jugador]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `nombre` | `""` | Nombre del jugador |
| `subtitulo` | `""` | Subtítulo descriptivo |
| `imagen` | `""` | Nombre del archivo en `assets/images/` |
| `imagen_alt` | `""` | Texto alternativo |
| `imagen_caption` | `""` | Pie de foto |
| `posicion_imagen` | `left` | `left` o `right` |

---

### `[titulo_deportivo]`

Bloque de ficha de título deportivo. Layout 60/40 con número grande, nombre y año. Contiene shortcodes hijos.

```
[titulo_deportivo numero="9" nombre="Copa del Rey 2024" anio="2024" foto="copa-default.jpg"]

    [ficha_tecnica]
    **Fecha:** 18 de febrero de 2024
    **Sede:** Pabellón Europa, Leganés
    **Resultado:** CV Guaguas 3 - 0 Unicaja Almería
    [/ficha_tecnica]

    [narrativa]
    Texto narrativo de la final...
    [/narrativa]

    [equipo numero="1" nombre="GRAN CANARIA"]
    Jorge Almansa, Osmany Juantorena, Io de Amo...
    [/equipo]

    [equipo numero="2" nombre="UNICAJA ALMERÍA"]
    Jugadores rivales...
    [/equipo]

[/titulo_deportivo]
```

**Parámetros de `[titulo_deportivo]`:**

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `numero` | `""` | Número del título (256px desktop / 128px mobile) |
| `nombre` | `""` | Nombre del título |
| `anio` | `""` | Año de la conquista |
| `foto` | `copa-default.jpg` | Imagen del trofeo en `assets/images/` |

**Shortcodes hijos de `[titulo_deportivo]`:**

| Shortcode | Descripción |
|-----------|-------------|
| `[ficha_tecnica]...[/ficha_tecnica]` | Datos técnicos: fecha, sede, resultado, árbitros |
| `[narrativa]...[/narrativa]` | Crónica de la final |
| `[equipo numero="" nombre=""]...[/equipo]` | Alineación. `numero`: 1=local, 2=visitante, 3=campeón |

---

### `[ficha_debut]`

Ficha biográfica de debut de jugador.

```
[ficha_debut titulo="LA FICHA DEL DEBUT"]
    **Nombre:** Jorge Almansa
    **Fecha de nacimiento:** 15 de marzo de 1995
    **Debut en Guaguas:** 2018
[/ficha_debut]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `titulo` | `LA FICHA DEL DEBUT` | Título del recuadro |

---

### `[dos_columnas]`

Divide el contenido en dos columnas. El separador entre columnas es `|||`.

```
[dos_columnas]
Contenido izquierda.

Puede tener párrafos y shortcodes.
|||
Contenido derecha.

También admite shortcodes.
[/dos_columnas]
```

> En móvil las columnas se apilan verticalmente.

---

### `[articulo]`

Artículo numerado de estatuto o documento legal.

```
[articulo numero="1º"]
    Los estatutos del club quedan sujetos a la jurisdicción de la Delegación Nacional de Deportes.
[/articulo]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `numero` | `""` | Número del artículo: `1º`, `Art. 3`, `2`, etc. |

---

### `[bloque_lista_foto]`

Foto a la izquierda con lista de nombres/items a la derecha. Usado para listas de jugadores o directivos con imagen numerada.

```
[bloque_lista_foto file="16cap_dire_foto3_num.jpg" alt="Directiva numerada"]
    [resaltado]1 — Lucía Ramón[/resaltado]
    [resaltado]2 — Joselu Sánchez[/resaltado]
    [resaltado]3 — Laura Sánchez[/resaltado]
[/bloque_lista_foto]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `file` | `""` | Nombre del archivo en `assets/images/` |
| `alt` | `""` | Texto alternativo de la imagen |

> Usar `[resaltado]` para cada elemento de la lista interior.

---

### `[foto_pendiente]`

Marcador temporal para fotos aún no disponibles. Muestra un placeholder con descripción.

```
[foto_pendiente descripcion="Retrato de Antonio Benítez, gerente del club desde 1990."]
```

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `descripcion` | `Imagen pendiente` | Descripción de la foto que sustituirá este placeholder |

> Cuando llegue la foto real, sustituir este shortcode por `[imagen_contenido file="..."]`.

---

### `[hero_capitulo]` / `[hero_linea]`

Hero programático desde el contenido (alternativa a los meta boxes). Uso avanzado — normalmente el hero se configura desde el editor.

```
[hero_capitulo background="foto.jpg" height="500px" overlay="rgba(0,0,0,0.25)" 
    icon="custom" custom_icon="estrella-icon.svg" custom_icon_color="hsl(240,52%,19%)" 
    icon_width="40" icon_height="40" alignment="center"]
    [hero_linea color="hsl(0,0%,100%)" highlight="hsl(240,52%,19%)"]PRIMERA LÍNEA[/hero_linea]
    [hero_linea color="hsl(0,0%,100%)" highlight="hsl(240,52%,19%)"]SEGUNDA LÍNEA[/hero_linea]
[/hero_capitulo]
```

**Parámetros `[hero_capitulo]`:**

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `background` | `""` | Nombre de archivo o URL de la imagen de fondo |
| `height` | `""` | Altura fija: `500px`, `60vh` |
| `overlay` | `""` | Color RGBA sobre la imagen |
| `icon` | `""` | `star`, `star-outline`, `custom`, `none` |
| `custom_icon` | `""` | Archivo SVG/PNG del icono |
| `custom_icon_color` | `""` | Color a aplicar al SVG |
| `icon_width` / `icon_height` | `80` | Dimensiones del icono en px |
| `alignment` | `center` | `left`, `center`, `right` |
| `vertical` | `center` | `top`, `center`, `bottom` |
| `border_color` | `""` | Color del borde decorativo interno |
| `background_color` | `""` | Color de fondo (visible con PNG transparente) |

**Parámetros `[hero_linea]`:**

| Parámetro | Por defecto | Descripción |
|-----------|-------------|-------------|
| `color` | `#FFFFFF` | Color del texto |
| `highlight` | `""` | Color de fondo del badge/resaltado |
| `font_weight` | `black` | `normal`, `medium`, `semibold`, `bold`, `extrabold`, `black` |

---

## Sistema de imágenes hero

El hero de cada capítulo se configura desde `Libro → Capítulos → [capítulo] → Cabecera del capítulo`.

### Estilos predefinidos del tema

**Estilo navy** — caps 13 a 24, hijos de caps 1, 4, 5:
```
overlay: rgba(0,0,0,0.25)
background_color: hsl(220, 50%, 12%)
custom_icon_color: hsl(240, 52%, 19%)
Título: texto blanco / badge hsl(240, 52%, 19%) / shadow none
```

**Estilo dorado** — caps 3, 6 y primera era:
```
overlay: rgba(0,0,0,0.25)
border_color: hsl(45, 100%, 50%)
custom_icon_color: hsl(45, 100%, 50%)
Título: texto hsl(220,50%,12%) / badge hsl(45,100%,50%)
```

**Estilo fondo claro** — cap 21 (árbitros), cap 23 (tecnología):
```
background_color: hsl(17, 14%, 95%)  /* crema */
overlay: rgba(0,0,0,0)
```

**Estilo amarillo** — cap 25 y hijos de patrocinadores:
```
background_color: hsl(46, 92%, 62%)
overlay: rgba(0,0,0,0)
custom_icon_color: hsl(0, 0%, 0%)
Título: texto hsl(46,92%,62%) / badge hsl(0,0%,0%)
```

### Imagen editorial

Además del hero, cada capítulo tiene un campo de **imagen editorial** independiente que aparece automáticamente al inicio del contenido (antes de `the_content()`). Tiene su propio caption.

---

## Personalización

### Variables CSS principales

```css
/* Dark mode (defecto) */
:root {
    --gold: 45 100% 50%;           /* Dorado principal — usar como hsl(var(--gold)) */
    --background: 220 50% 10%;     /* Fondo general navy */
    --foreground: 0 0% 95%;        /* Texto general */
    --sidebar: 220 55% 8%;         /* Fondo sidebar */
    --sidebar-width: 320px;        /* Anchura del sidebar */
}

/* Light mode */
body.light {
    --background: 32 17% 96%;      /* Fondo beige cálido */
    --foreground: 220 50% 12%;     /* Texto navy */
    --lm-gold: hsl(45, 100%, 42%); /* Dorado light mode — valor HSL completo */
}
```

> `--lm-gold` es la única variable que almacena el valor `hsl()` completo. El resto almacenan solo los canales HSL: `hsl(var(--gold))`.

### Breakpoints

| Breakpoint | Píxeles | Comportamiento |
|------------|---------|----------------|
| Base | < 1024px | Sidebar oculto, menú toggle |
| `lg` | ≥ 1024px | Sidebar fijo, contenido con `margin-left: 320px` |

---

## Estructura de archivos

```
cv-guaguas-50aniversario/
├── style.css                    # Header del tema
├── functions.php                # CPT, shortcodes, meta boxes, helpers
├── header.php                   # Header fijo con toggle de menú y tema
├── footer.php                   # Footer con logos institucionales
├── index.php                    # Template por defecto (home)
├── 404.php                      # Página de error (sin sidebar, centrada)
├── sidebar-indice.php           # Sidebar con índice jerárquico
├── template-home.php            # Portada 50 Aniversario
├── single-capitulo.php          # Página individual de capítulo
├── README.md                    # Esta documentación
├── inc/
│   ├── meta-boxes.php           # Campos hero e imagen editorial
│   └── sample-content.php       # 25 capítulos con contenido completo
└── assets/
    ├── css/main.css             # Estilos completos
    ├── js/main.js               # Sidebar, scroll spy, dark/light toggle
    └── images/                  # Todas las imágenes del tema
        ├── logo-guaguas.png/svg
        ├── estrella-icon.svg    # Icono estrella (heroes navy)
        ├── copa-default.jpg     # Trofeo por defecto (cap 11)
        ├── hero-*.jpg           # Placeholders de hero
        ├── [N]cap_[xxx]_foto[N].[ext]  # Fotos reales por capítulo
        └── [sponsor].svg        # Logos patrocinadores (se colorean con CSS)
```

### Nomenclatura de imágenes

```
[nº_cap]cap_[abreviatura]_foto[nº].[ext]

Ejemplos:
  7cap_mare_foto1.jpg      → Cap 7, Marek, foto 1
  16cap_dire_foto3.png     → Cap 16, directiva, foto 3 (PNG con alfa)
  21cap_reco_foto3.png     → Cap 21, árbitros, foto 3
  23cap_vang_montaje.png   → Cap 23, vanguardia, montaje generado
```

---

## Troubleshooting

| Problema | Solución |
|----------|----------|
| Capítulos dan 404 | `Ajustes → Enlaces permanentes → Guardar cambios` |
| Imágenes no cargan | Verificar que el archivo existe en `assets/images/` con permisos 644 |
| Sidebar no aparece en desktop | Verificar que `main.js` carga sin errores en la consola |
| Estilos incorrectos | Limpiar caché del navegador (`Ctrl+Shift+R`) |
| Contenido importado no aparece tras reinstalar | `wp-admin/edit.php?post_type=capitulo&libro_reimport=1` |

---

## Plugins recomendados (opcionales)

| Plugin | Uso |
|--------|-----|
| Yoast SEO | Metadatos SEO por capítulo |
| WP Rocket / LiteSpeed Cache | Rendimiento y caché |
| Smush / ShortPixel | Optimización de imágenes |
| UpdraftPlus | Copias de seguridad |

---

*Desarrollado para celebrar los **50 años del CV Guaguas (1976–2026)***
