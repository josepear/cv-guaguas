

## Plan: Maquetación de los prólogos al estilo del libro

### Objetivo
Crear un layout específico para los prólogos que replique fielmente el formato del libro: foto circular centrada del autor, nombre resaltado, cargo debajo, y texto del prólogo. Se aplicará tanto en React como en WordPress.

### Referencia visual (del libro)
```text
┌─────────────────────────────┐
│                             │
│        ┌─────────┐          │
│        │  FOTO   │          │
│        │ (round) │          │
│        └─────────┘          │
│                             │
│    ██ FERNANDO CLAVIJO ██   │  ← nombre con fondo resaltado
│  PRESIDENTE DEL GOBIERNO    │  ← cargo en mayúsculas, sin fondo
│       DE CANARIAS           │
│                             │
│   Texto del prólogo...      │
│   párrafo tras párrafo...   │
│                             │
└─────────────────────────────┘
```

### Cambios técnicos

**1. Nuevo componente `PrologueLayout.tsx`**
- Foto centrada con recorte circular/redondeado y borde sutil
- Nombre del autor centrado con fondo resaltado (amarillo gold del design system)
- Cargo centrado debajo en mayúsculas, tipografía sans-serif reducida
- Contenido del prólogo debajo con el estilo de lectura habitual
- Animación de entrada con scroll reveal

**2. Actualizar `chapterContent.tsx`**
- Cada prólogo usará `PrologueLayout` envolviendo su contenido
- Se importarán las fotos que el usuario proporcione desde `src/assets/`
- Contenido placeholder listo para rellenar con el texto real que vaya proporcionando

**3. Ajustar `ChapterSection` / `Chapter.tsx`**
- Los prólogos ya no muestran título propio del `ChapterSection` (viene integrado en el `PrologueLayout`)
- Añadir flag en la estructura de capítulos para indicar que es un prólogo y ocultar título duplicado

**4. Paridad WordPress (`sample-content.php`)**
- Nuevo shortcode `[prologo_layout]` con atributos `nombre`, `cargo`, `foto`
- Replicar el CSS del componente React en las utilidades manuales del tema

### Flujo de trabajo
El usuario irá pasando foto + texto de cada prólogo. Se irán incorporando uno a uno. Las fotos se recortarán/encuadrarán en la cara del protagonista usando `object-position` en CSS.

