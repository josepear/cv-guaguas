# CV Guaguas - 50 Aniversario

Tema WordPress conmemorativo del 50 aniversario del CV Guaguas (1976-2026). Diseño editorial moderno con índice lateral navegable y paleta de colores institucional (amarillo/dorado y azul marino).

## 🎨 Características

- **Hero full-screen** con imagen del equipo y overlay dorado/azul marino
- **Marcador "50 Aniversario · 1976 - 2026"** en el hero y sidebar
- **Sidebar sticky** con índice de capítulos tipo acordeón
- **Scroll suave** con indicador de sección activa
- **Tipografía editorial** (Montserrat + Inter)
- **Botones de descarga** PDF/EPUB
- **Footer institucional** con logos
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
│   └── sample-content.php       # 15 capítulos de ejemplo
└── assets/
    ├── css/
    │   └── main.css             # Estilos completos (Tailwind-like)
    ├── js/
    │   └── main.js              # JavaScript (acordeón, scroll spy, mobile)
    └── images/
        ├── logo-guaguas.png     # Logo del club
        └── hero-stadium.jpg     # Imagen de fondo del hero
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

#### 4. Añadir logos al footer (opcional)

1. Ve a `Apariencia → Widgets`
2. Busca el área "Área de Logos Footer"
3. Añade widgets de imagen con los logos institucionales

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
   - Imagen de fondo
   - Color de overlay (transparencia)
   - Icono (estrella, sin icono)
   - Color del icono
   - Alineación horizontal y vertical
   - Borde decorativo (opcional)
   - Líneas de título con colores y resaltados personalizados

#### Opción 2: Usando shortcodes

```
[hero_capitulo 
    background="https://ejemplo.com/fondo.jpg" 
    overlay="rgba(26,35,126,0.7)" 
    icon="star" 
    icon_color="#D4AF37" 
    alignment="right" 
    vertical="center"
    border_color="#D4AF37"
]
    [hero_linea color="#FFFFFF"]DEL PATIO[/hero_linea]
    [hero_linea color="#1a237e" highlight="#D4AF37"]DEL COLEGIO[/hero_linea]
    [hero_linea color="#1a237e" highlight="#D4AF37"]A LA DIVISIÓN[/hero_linea]
    [hero_linea color="#1a237e" highlight="#D4AF37"]DE HONOR[/hero_linea]
[/hero_capitulo]
```

**Parámetros de `[hero_capitulo]`:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `background` | Sí | URL de la imagen de fondo |
| `overlay` | No | Color del overlay con transparencia (ej: `rgba(0,0,0,0.5)`) |
| `icon` | No | `star` (rellena), `star-outline` (vacía), `none` (sin icono) |
| `icon_color` | No | Color del icono en hex (por defecto: `#D4AF37`) |
| `alignment` | No | `left`, `center`, `right` (por defecto: `center`) |
| `vertical` | No | `top`, `center`, `bottom` (por defecto: `center`) |
| `border_color` | No | Color del borde decorativo interno |
| `min_height` | No | Altura mínima (por defecto: `400px`) |
| `aspect_ratio` | No | Ratio de aspecto (ej: `16/9`, `4/3`) |

**Parámetros de `[hero_linea]`:**
| Parámetro | Requerido | Descripción |
|-----------|-----------|-------------|
| `color` | No | Color del texto (por defecto: `#FFFFFF`) |
| `highlight` | No | Color de fondo/resaltado (si se especifica, el texto tendrá fondo de este color) |

**Ejemplos de estilos:**

1. **Estilo documentos antiguos (azul oscuro con estrella dorada):**
```
[hero_capitulo background="estatutos.jpg" overlay="rgba(26,35,126,0.85)" border_color="#D4AF37"]
    [hero_linea color="#D4AF37" highlight="#1a237e"]ESTATUTOS[/hero_linea]
    [hero_linea color="#D4AF37" highlight="#1a237e"]FUNDACIONALES[/hero_linea]
[/hero_capitulo]
```

2. **Estilo duotono dorado (fondo amarillo):**
```
[hero_capitulo background="jugador.jpg" overlay="rgba(212,175,55,0.8)" icon_color="#1a237e"]
    [hero_linea color="#FFFFFF"]PACO SÁNCHEZ[/hero_linea]
    [hero_linea color="#FFFFFF" highlight="#1a237e"]JOVER[/hero_linea]
[/hero_capitulo]
```

3. **Estilo minimalista (título a la derecha):**
```
[hero_capitulo background="colegio.jpg" overlay="rgba(212,175,55,0.9)" icon="star" icon_color="#1a237e" alignment="right"]
    [hero_linea color="#1a237e" highlight="#FFFFFF"]DEL PATIO[/hero_linea]
    [hero_linea color="#1a237e" highlight="#FFFFFF"]DEL COLEGIO[/hero_linea]
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

- **15 capítulos** con estructura jerárquica
- **Contenido real** sobre la historia del CV Guaguas
- **Citas destacadas** de figuras importantes
- **Imágenes**: hero-stadium.jpg, logo-guaguas.png

## 📜 Licencia

GPL v2 o posterior

---

🏐 Desarrollado para celebrar los **50 años del CV Guaguas (1976-2026)**
