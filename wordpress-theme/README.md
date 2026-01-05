# CV Guaguas - Tema WordPress del Libro Institucional

Tema WordPress para mostrar el libro institucional del CV Guaguas con diseño editorial moderno.

## 🎨 Características

- **Hero full-screen** con imagen del equipo y overlay dorado/azul marino
- **Sidebar sticky** con índice de capítulos
- **Scroll suave** con indicador de sección activa
- **Tipografía editorial** (Montserrat + Inter)
- **Botones de descarga** PDF/EPUB
- **Footer institucional** con logos
- **100% responsive** (mobile-first)
- **Colores del CV Guaguas** (azul marino + amarillo/dorado)

## 📁 Estructura de archivos

```
cv-guaguas-libro/
├── style.css              # Header del tema + import de estilos
├── functions.php          # Funciones del tema, CPT, shortcodes
├── header.php             # Cabecera HTML + toggle móvil
├── footer.php             # Pie de página con logos
├── sidebar-indice.php     # Barra lateral con índice
├── template-home.php      # Plantilla principal del libro
├── screenshot.png         # Vista previa del tema
├── README.md              # Este archivo
└── assets/
    ├── css/
    │   └── main.css       # Estilos principales
    ├── js/
    │   └── main.js        # JavaScript (sidebar, scroll spy)
    └── images/
        ├── logo-guaguas.png
        └── hero-stadium.jpg
```

## 🚀 Instalación

1. **Subir el tema**
   - Comprime la carpeta `cv-guaguas-libro` en un archivo ZIP
   - Ve a `Apariencia > Temas > Añadir nuevo > Subir tema`
   - Sube el ZIP y activa el tema

2. **Crear los capítulos**
   - Ve a `Libro > Añadir capítulo`
   - Añade el contenido de cada capítulo
   - Ordena los capítulos usando el campo "Orden" (Atributos de página)

3. **Configurar la página principal**
   - Crea una nueva página
   - Selecciona la plantilla "Página Libro CV Guaguas"
   - Ve a `Ajustes > Lectura` y selecciona esta página como "Página estática de inicio"

4. **Configurar opciones del tema**
   - Ve a `Apariencia > Opciones Libro`
   - Configura el título, subtítulo y URLs de descarga

## ⚙️ Configuración

### Opciones del tema (Apariencia > Opciones Libro)
- Título del Hero
- Subtítulo del Hero
- URL del archivo PDF
- URL del archivo EPUB

### Campos personalizados (requiere ACF)
Si tienes instalado Advanced Custom Fields, cada capítulo tendrá:
- Número de capítulo (ej: 01, 02)
- Mostrar marcador de capítulo
- Cita destacada
- Autor de la cita

## 🎨 Personalización de colores

Los colores del tema están definidos como variables CSS en `assets/css/main.css`:

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

## 📱 Responsive

El tema usa un enfoque mobile-first con los siguientes breakpoints:
- **Base**: Móvil
- **md (768px)**: Tablet
- **lg (1024px)**: Desktop (sidebar fijo visible)

## 🔌 Plugins recomendados

- **Advanced Custom Fields (ACF)**: Para campos personalizados en capítulos
- **Yoast SEO**: Para optimización SEO
- **WP Rocket**: Para caché y rendimiento

## 📄 Licencia

GPL v2 o posterior

---

Desarrollado para el CV Guaguas 🏐
