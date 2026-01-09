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
