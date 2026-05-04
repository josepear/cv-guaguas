# CV Guaguas - 50 Aniversario

Tema WordPress conmemorativo del 50 aniversario del CV Guaguas (1976-2026). Diseño editorial moderno con índice lateral navegable y paleta de colores institucional (amarillo/dorado y azul marino).

## 🎨 Características

- **Hero full-screen** con imagen del equipo y overlay dorado/azul marino
- **Marcador "50 Aniversario · 1976 - 2026"** en el hero y sidebar
- **Sidebar sticky** con índice de capítulos tipo acordeón
- **Scroll suave** con indicador de sección activa
- **Tipografía editorial** (Montserrat + Inter)
- **Botones de descarga** PDF/EPUB
- **Footer institucional** con 8 logos reales de patrocinadores (modo claro/oscuro)
- **Soporte completo dark/light mode** con toggle manual y detección del sistema
- **Resaltados en amarillo dorado** `hsl(45 100% 50%)` consistentes en ambos modos
- **100% responsive** (mobile-first)
- **Colores del CV Guaguas** (azul marino + amarillo/dorado)

## 📁 Estructura de archivos

```
cv-guaguas-50aniversario/
├── style.css                    # Header del tema + import estilos
├── functions.php                # Funciones, CPT, shortcodes
├── header.php                   # Header fijo con menú toggle
├── footer.php                   # Footer institucional
├── index.php                    # Template por defecto
├── 404.php                      # Página de error
├── sidebar-indice.php           # Sidebar con acordeón jerárquico
├── template-home.php            # Plantilla principal del 50 aniversario
├── single-capitulo.php          # Página individual de capítulo
├── screenshot.png               # Vista previa del tema
├── README.md                    # Esta documentación
├── inc/
│   ├── meta-boxes.php           # Campos personalizados nativos
│   └── sample-content.php       # 23 capítulos de ejemplo
└── assets/
    ├── css/
    │   └── main.css             # Estilos completos (Tailwind-like)
    ├── js/
    │   └── main.js              # JavaScript (acordeón, scroll spy, mobile, theme toggle)
    └── images/
        ├── logo-guaguas.png     # Logo del club
        ├── logo-guaguas.svg     # Logo del club (vector)
        ├── star-gold.png        # Icono estrella dorada
        ├── hero-*.jpg           # Imágenes hero de capítulos (9 imágenes)
        ├── content/             # Imágenes de contenido (16 imágenes)
        └── sponsors/            # 8 logos de patrocinadores
            ├── cabildo-gran-canaria.png
            ├── instituto-insular-deportes.png
            ├── gobierno-canarias.png
            ├── islas-canarias.png
            ├── ayuntamiento-las-palmas.png
            ├── instituto-municipal-deportes.png
            ├── turismo-gran-canaria.png
            └── rfevb.png
```

## ⚙️ Requisitos previos

- WordPress 5.0 o superior
- PHP 7.4 o superior
- No requiere plugins adicionales (ACF es opcional)

## 🚀 Instalación

### Método 1: Subir archivo ZIP (recomendado)

1. **Preparar el tema**
   - Renombra la carpeta `wordpress-theme` a `cv-guaguas-50aniversario`
   - Comprime la carpeta en un archivo ZIP

2. **Subir a WordPress**
   - Ve a `Apariencia → Temas → Añadir nuevo → Subir tema`
   - Selecciona el archivo ZIP
   - Haz clic en "Instalar ahora"

3. **Activar el tema**
   - Una vez instalado, haz clic en "Activar"

### Método 2: FTP/SFTP

1. Renombra la carpeta `wordpress-theme` a `cv-guaguas-50aniversario`
2. Sube la carpeta a `/wp-content/themes/` de tu instalación WordPress
3. Ve a `Apariencia → Temas` y activa "CV Guaguas - 50 Aniversario"

## 📋 Configuración post-instalación

### Automático al activar el tema

Al activar el tema, automáticamente:
- ✅ Se registra el Custom Post Type "Capítulo"
- ✅ Se importan 15 capítulos de ejemplo con contenido completo
- ✅ Se registran los campos personalizados nativos
- ✅ Se actualizan los permalinks

### Configuración manual requerida

#### 1. Crear página principal

1. Ve a `Páginas → Añadir nueva`
2. Título: "50 Aniversario" (o el que prefieras)
3. En el panel derecho, busca "Atributos de página"
4. Selecciona la plantilla **"Página 50 Aniversario CV Guaguas"**
5. Publica la página

#### 2. Establecer como página de inicio

1. Ve a `Ajustes → Lectura`
2. Selecciona "Una página estática"
3. En "Página de inicio", elige la página que acabas de crear
4. Guarda los cambios

#### 3. Configurar opciones del tema

1. Ve a `Apariencia → Opciones Libro`
2. Configura:
   - **Título del Hero**: Por defecto "50 Años de Historia"
   - **Subtítulo del Hero**: Por defecto "Cinco décadas de pasión..."
   - **URL del PDF**: Enlace al archivo PDF del libro
   - **URL del EPUB**: Enlace al archivo EPUB
3. Guarda los cambios

#### 4. Logos del footer (automáticos)

Los 8 logos de patrocinadores institucionales se cargan automáticamente desde `assets/images/sponsors/`. No requiere configuración adicional. Los logos incluidos son:

1. Cabildo de Gran Canaria
2. Instituto Insular de Deportes
3. Gobierno de Canarias
4. Islas Canarias
5. Ayuntamiento de Las Palmas de Gran Canaria
6. Instituto Municipal de Deportes
7. Turismo de Gran Canaria
8. Real Federación Española de Voleibol

Para personalizar los logos, edita el array en `footer.php` o configúralos desde `Apariencia → Opciones Libro`.

## 📖 Gestión de capítulos

### Crear nuevo capítulo

1. Ve a `Libro → Añadir capítulo`
2. Escribe el título del capítulo
3. Añade el contenido en el editor
4. Configura los campos personalizados:
   - **Número de capítulo**: Ej: 01, 02, 03...
   - **Subtítulo**: Descripción breve
   - **Cita destacada**: Frase importante del capítulo
   - **Autor de la cita**: Quien dijo la cita
5. Publica el capítulo

### Numeración de capítulos y subcapítulos

El sidebar muestra números con estilo visual distintivo:

- **Capítulos principales**: Badge dorado con texto azul oscuro (ej: `01`, `02`)
- **Subcapítulos**: Badge blanco con texto azul oscuro (ej: `1.1`, `1.2`)

#### Sistema de numeración automática

| Situación | Resultado |
|-----------|-----------|
| Capítulo con número definido | Se muestra el número configurado |
| Subcapítulo con número definido | Se muestra el número configurado |
| Subcapítulo sin número + padre con número | Se auto-genera (ej: padre "01" → hijos "01.1", "01.2"...) |
| Sin número definido | No se muestra badge de número |

#### Ocultar número específico

Puedes ocultar completamente el número de cualquier capítulo o subcapítulo:

1. Edita el capítulo
2. En "Datos del Capítulo", marca **"Ocultar número en el menú lateral"**
3. La vista previa mostrará el badge atenuado con "(oculto)"
4. Guarda los cambios

Esto es útil para:
- Prólogos o introducciones sin numeración
- Secciones especiales (anexos, agradecimientos, etc.)
- Subcapítulos que no deben mostrar número aunque el padre lo tenga

#### Vista previa en el editor

El campo de número incluye una **vista previa en tiempo real** que muestra:
- Cómo se verá el badge (estilo dorado o blanco según sea capítulo/subcapítulo)
- Indicador "(auto-generado)" cuando el número se calcula del padre
- Indicador "(oculto)" cuando está marcada la opción de ocultar

### Crear subcapítulos

1. Crea un nuevo capítulo normalmente
2. En "Atributos de página" (panel derecho), selecciona el capítulo padre
3. Ajusta el "Orden" para controlar la posición

### Ordenar capítulos

- El campo "Orden" en "Atributos de página" controla la posición
- Números más bajos aparecen primero
- Ejemplo: Prólogo = 0, Capítulo 1 = 10, Capítulo 2 = 20...

## 📝 Shortcodes disponibles

El tema incluye shortcodes para enriquecer el contenido de los capítulos con elementos editoriales idénticos a los componentes React.

### Cita Editorial

Muestra una cita destacada con estilo editorial, borde dorado y comillas decorativas.

```
[cita_editorial author="Nombre del autor" source="Fuente opcional"]
Texto de la cita aquí. Puede ser una frase memorable o reflexión importante.
[/cita_editorial]
```

**Parámetros:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `author` | No | Nombre del autor de la cita |
| `source` | No | Fuente, cargo o contexto de la cita |

**Ejemplo de uso:**
```
[cita_editorial author="Manolo Berenguer" source="Fundador del CV Guaguas, 1976"]
El voleibol no es solo un deporte, es una forma de vida que nos une como familia.
[/cita_editorial]
```

---

### Imagen con pie de foto

Inserta una imagen con pie de foto opcional y efecto hover elegante.

#### Opción 1: URL externa

```
[imagen_contenido src="URL_DE_LA_IMAGEN" alt="Descripción" caption="Pie de foto" fullwidth="false"]
```

**Parámetros:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `src` | Sí | URL completa de la imagen |
| `alt` | No | Texto alternativo para accesibilidad |
| `caption` | No | Pie de foto que aparece debajo |
| `fullwidth` | No | `true` para ancho completo, `false` para ancho contenido (por defecto) |

**Ejemplo:**
```
[imagen_contenido src="https://ejemplo.com/imagen.jpg" alt="Equipo campeón 1985" caption="El CV Guaguas celebrando su primer título de liga" fullwidth="true"]
```

---

#### Opción 2: Imagen de la biblioteca de medios

```
[imagen id="ID_DE_IMAGEN" caption="Pie de foto" fullwidth="false"]
```

**Parámetros:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `id` | Sí | ID numérico de la imagen en la biblioteca de medios |
| `caption` | No | Pie de foto personalizado (si no se especifica, usa el caption de la imagen) |
| `fullwidth` | No | `true` para ancho completo |

**Ejemplo:**
```
[imagen id="123" caption="Pabellón Insular durante la final de 1992"]
```

**Cómo obtener el ID de una imagen:**
1. Ve a `Medios → Biblioteca`
2. Haz clic en la imagen
3. El ID aparece en la URL: `post=123` → el ID es 123

---

### Ejemplos combinados

```html
<!-- Capítulo con cita y imagen -->
<p>El CV Guaguas nació en 1976 como un sueño de un grupo de amigos apasionados por el voleibol.</p>

[cita_editorial author="Manolo Berenguer" source="Presidente fundador"]
Empezamos con nada más que una pelota y muchas ganas. Hoy somos historia.
[/cita_editorial]

<p>La primera temporada fue dura pero gratificante...</p>

[imagen id="45" caption="El equipo fundador del CV Guaguas en 1976" fullwidth="true"]

<p>Aquella imagen representa el espíritu que nos ha acompañado durante 50 años.</p>
```

---

### Notas importantes

- Los shortcodes generan HTML idéntico a los componentes React (`EditorialQuote` y `ContentImage`)
- Los estilos están incluidos en `header.php` y son consistentes con el diseño del tema
- Las imágenes tienen efecto hover con zoom suave (`transform: scale(1.02)`)
- Las citas incluyen comillas decorativas doradas y borde lateral

---

### Cabecera de Capítulo (Hero)

Crea cabeceras visuales personalizadas con imagen de fondo, iconos decorativos y títulos estilizados.

#### Opción 1: Desde el editor de WordPress

1. Edita un capítulo
2. Activa la sección **"Cabecera del Capítulo (Hero)"**
3. Configura:
   - **Imagen de fondo**: Selecciona desde la biblioteca de medios
   - **Altura del hero**: Define en `px` (ej: `500px`) o `vh` (ej: `60vh`). Deja vacío para altura automática
   - **Color de overlay**: Usa `rgba()` para transparencia (ej: `rgba(26,35,126,0.7)`)
   - **Borde decorativo**: Color del borde interno opcional
   - **Tipo de icono**:
     - `★ Estrella rellena`: Icono de estrella sólida con color personalizable
     - `☆ Estrella vacía`: Icono de estrella con solo borde
     - `📷 Imagen personalizada`: Sube tu propio icono (SVG, PNG, JPG, etc.)
     - `Sin icono`: No mostrar icono
   - **Color del icono SVG** (nuevo): Si subes un archivo SVG, puedes cambiar su color marcando "Aplicar color" y seleccionando el color deseado. Los archivos PNG/JPG mantienen su color original.
   - **Dimensiones del icono**: Ancho y alto en píxeles (20-300px)
   - **Alineación**: Horizontal (izquierda, centro, derecha) y vertical (arriba, centro, abajo)
   - **Líneas de título**: Cada línea con:
     - Texto
     - Color del texto
     - Resaltado (color de fondo opcional)
     - **Peso de fuente**: Normal, Medium, Semibold, Bold, Extrabold, Black

#### Opción 2: Usando shortcodes

```
[hero_capitulo 
    background="https://ejemplo.com/fondo.jpg" 
    height="500px"
    overlay="rgba(26,35,126,0.7)" 
    icon="star" 
    icon_color="#D4AF37"
    custom_icon="https://ejemplo.com/mi-icono.svg"
    icon_width="100"
    icon_height="100"
    alignment="right" 
    vertical="center"
    border_color="#D4AF37"
]
    [hero_linea color="#FFFFFF" font_weight="black"]DEL PATIO[/hero_linea]
    [hero_linea color="#1a237e" highlight="#D4AF37" font_weight="extrabold"]DEL COLEGIO[/hero_linea]
    [hero_linea color="#1a237e" highlight="#D4AF37" font_weight="bold"]A LA DIVISIÓN[/hero_linea]
    [hero_linea color="#1a237e" highlight="#D4AF37" font_weight="bold"]DE HONOR[/hero_linea]
[/hero_capitulo]
```

**Parámetros de `[hero_capitulo]`:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `background` | Sí | URL de la imagen de fondo |
| `height` | No | Altura fija del hero (ej: `500px`, `60vh`). Si no se especifica, usa altura automática |
| `overlay` | No | Color del overlay con transparencia (ej: `rgba(0,0,0,0.5)`) |
| `icon` | No | `star` (rellena), `star-outline` (vacía), `custom` (imagen), `none` (sin icono) |
| `icon_color` | No | Color del icono en hex (por defecto: `#D4AF37`). Solo aplica a estrellas |
| `custom_icon` | No | URL de imagen personalizada para el icono (SVG, PNG, etc.). Requiere `icon="custom"` |
| `custom_icon_color` | No | Color a aplicar al icono SVG (solo funciona con archivos .svg) |
| `icon_width` | No | Ancho del icono en píxeles (por defecto: `80`) |
| `icon_height` | No | Alto del icono en píxeles (por defecto: `80`) |
| `alignment` | No | `left`, `center`, `right` (por defecto: `center`) |
| `vertical` | No | `top`, `center`, `bottom` (por defecto: `center`) |
| `border_color` | No | Color del borde decorativo interno |
| `min_height` | No | Altura mínima (por defecto: `400px`). Alternativa a `height` |
| `aspect_ratio` | No | Ratio de aspecto (ej: `16/9`, `4/3`) |

**Parámetros de `[hero_linea]`:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `color` | No | Color del texto (por defecto: `#FFFFFF`) |
| `highlight` | No | Color de fondo/resaltado (si se especifica, el texto tendrá fondo de este color) |
| `font_weight` | No | Peso de la fuente: `normal`, `medium`, `semibold`, `bold`, `extrabold`, `black` (por defecto: `black`) |

**Ejemplos de estilos:**

1. **Estilo con icono SVG y color personalizado:**
```
[hero_capitulo background="estadio.jpg" height="500px" icon="custom" custom_icon="https://mi-sitio.com/icono.svg" custom_icon_color="#D4AF37" icon_width="120" icon_height="120"]
    [hero_linea color="#FFFFFF" font_weight="black"]LOS ORÍGENES[/hero_linea]
    [hero_linea color="#D4AF37" font_weight="extrabold"]DEL CLUB[/hero_linea]
[/hero_capitulo]
```

2. **Estilo con icono PNG (sin cambio de color):**
```
[hero_capitulo background="estadio.jpg" height="500px" icon="custom" custom_icon="https://mi-sitio.com/star-gold.png" icon_width="120" icon_height="120"]
    [hero_linea color="#FFFFFF" font_weight="black"]LOS ORÍGENES[/hero_linea]
    [hero_linea color="#D4AF37" font_weight="extrabold"]DEL CLUB[/hero_linea]
[/hero_capitulo]
```

2. **Estilo documentos antiguos (azul oscuro con estrella dorada):**
```
[hero_capitulo background="estatutos.jpg" height="60vh" overlay="rgba(26,35,126,0.85)" border_color="#D4AF37"]
    [hero_linea color="#D4AF37" highlight="#1a237e" font_weight="black"]ESTATUTOS[/hero_linea]
    [hero_linea color="#D4AF37" highlight="#1a237e" font_weight="bold"]FUNDACIONALES[/hero_linea]
[/hero_capitulo]
```

3. **Estilo duotono dorado (fondo amarillo):**
```
[hero_capitulo background="jugador.jpg" overlay="rgba(212,175,55,0.8)" icon_color="#1a237e"]
    [hero_linea color="#FFFFFF" font_weight="extrabold"]PACO SÁNCHEZ[/hero_linea]
    [hero_linea color="#FFFFFF" highlight="#1a237e" font_weight="black"]JOVER[/hero_linea]
[/hero_capitulo]
```

4. **Estilo minimalista (título a la derecha con pesos variados):**
```
[hero_capitulo background="colegio.jpg" overlay="rgba(212,175,55,0.9)" icon="star" icon_color="#1a237e" alignment="right"]
    [hero_linea color="#1a237e" highlight="#FFFFFF" font_weight="medium"]DEL PATIO[/hero_linea]
    [hero_linea color="#1a237e" highlight="#FFFFFF" font_weight="black"]DEL COLEGIO[/hero_linea]
[/hero_capitulo]
```

## 🎨 Personalización

### Variables CSS

Los colores del tema están en `assets/css/main.css`:

```css
:root {
    /* Colores principales - Amarillo/Dorado Guaguas */
    --gold: 45 100% 50%;
    --gold-light: 45 100% 60%;
    --gold-dark: 45 100% 40%;
    
    /* Fondo - Azul Marino */
    --background: 220 50% 10%;
    
    /* Sidebar - Azul más oscuro */
    --sidebar: 220 55% 8%;
}
```

### Breakpoints responsive

- **Base**: Móvil (< 768px)
- **md (768px)**: Tablet
- **lg (1024px)**: Desktop (sidebar fijo visible)

### Cambiar imagen del hero

Reemplaza el archivo `assets/images/hero-stadium.jpg` manteniendo el mismo nombre.

## 🔧 Troubleshooting

### Los capítulos no aparecen o dan error 404

1. Ve a `Ajustes → Enlaces permanentes`
2. Sin cambiar nada, haz clic en "Guardar cambios"
3. Esto regenera los permalinks

### Las imágenes no cargan

1. Verifica que existan en `assets/images/`
2. Comprueba los permisos de los archivos (644)

### Los estilos no se aplican correctamente

1. Limpia la caché del navegador (Ctrl+Shift+R)
2. Si usas plugin de caché, vacíalo
3. Verifica que `main.css` existe y tiene contenido

### El sidebar no funciona en móvil

1. Verifica que `main.js` está cargando (Consola del navegador)
2. Comprueba que no hay errores JavaScript

## 🔌 Plugins recomendados (opcionales)

- **Yoast SEO**: Para optimización SEO
- **WP Rocket** o **LiteSpeed Cache**: Para caché y rendimiento
- **Smush** o **ShortPixel**: Para optimización de imágenes
- **UpdraftPlus**: Para copias de seguridad

## 📄 Archivos de ejemplo incluidos

El tema incluye contenido de ejemplo que se importa automáticamente:

- **23 capítulos** con estructura jerárquica
- **Contenido real** sobre la historia del CV Guaguas
- **Citas destacadas** de figuras importantes
- **8 logos de patrocinadores** en el footer
- **9 imágenes hero** para cabeceras de capítulo
- **16 imágenes de contenido** (equipo, partidos, jugadores)
- **Imágenes base**: logo-guaguas.png, logo-guaguas.svg, star-gold.png

## 📜 Licencia

GPL v2 o posterior

---

🏐 Desarrollado para celebrar los **50 años del CV Guaguas (1976-2026)**
