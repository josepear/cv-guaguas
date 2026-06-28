# 🏐 Guía de Instalación — CV Guaguas 50 Aniversario

## Tema WordPress del Libro Conmemorativo

Este documento detalla paso a paso cómo instalar, configurar y mantener el tema WordPress del 50 Aniversario del CV Guaguas (1976–2026) en un servidor de producción.

---

## 📋 Índice

1. [Requisitos del servidor](#1-requisitos-del-servidor)
2. [Preparar el archivo del tema](#2-preparar-el-archivo-del-tema)
3. [Instalar el tema en WordPress](#3-instalar-el-tema-en-wordpress)
4. [Configuración inicial](#4-configuración-inicial)
5. [Importar contenido de ejemplo](#5-importar-contenido-de-ejemplo)
6. [Crear la página de inicio](#6-crear-la-página-de-inicio)
7. [Configurar opciones del libro](#7-configurar-opciones-del-libro)
8. [Gestionar capítulos](#8-gestionar-capítulos)
9. [Shortcodes disponibles](#9-shortcodes-disponibles)
10. [Personalización visual](#10-personalización-visual)
11. [Solución de problemas](#11-solución-de-problemas)
12. [Actualización del tema](#12-actualización-del-tema)
13. [Seguridad y rendimiento](#13-seguridad-y-rendimiento)

---

## 1. Requisitos del servidor

### Mínimos

| Componente | Versión mínima |
|------------|----------------|
| WordPress | 5.0 |
| PHP | 7.4 |
| MySQL / MariaDB | 5.7 / 10.3 |
| Memoria PHP | 128 MB |

### Recomendados

| Componente | Versión recomendada |
|------------|---------------------|
| WordPress | 6.4+ |
| PHP | 8.1+ |
| MySQL / MariaDB | 8.0 / 10.6+ |
| Memoria PHP | 256 MB |
| HTTPS | Certificado SSL activo |

### Sin dependencias externas

- ❌ **No requiere plugins** adicionales para funcionar
- ❌ **No requiere ACF** (Advanced Custom Fields) — usa meta-boxes nativos
- ❌ **No requiere Composer** ni Node.js en el servidor
- ✅ Tailwind CSS se carga vía CDN (no necesita compilación)
- ✅ Google Fonts (Antonio, Archivo, Poppins) se cargan vía CDN

---

## 2. Preparar el archivo del tema

### Opción A: Desde el repositorio Git

```bash
# 1. Clonar el repositorio
git clone https://github.com/TU-USUARIO/TU-REPO.git
cd TU-REPO

# 2. Copiar la carpeta del tema con el nombre correcto
cp -r wordpress-theme cv-guaguas-50aniversario

# 3. Crear el archivo ZIP
zip -r cv-guaguas-50aniversario.zip cv-guaguas-50aniversario/ --exclude "*.py" --exclude "*.DS_Store"
```

### Opción B: Descarga directa

1. Descarga el repositorio como ZIP desde GitHub
2. Descomprime el archivo
3. Localiza la carpeta `wordpress-theme/`
4. Renómbrala a `cv-guaguas-50aniversario`
5. Comprime esa carpeta en un nuevo archivo `.zip`

> ⚠️ **Importante**: La carpeta dentro del ZIP debe llamarse `cv-guaguas-50aniversario`, no `wordpress-theme`.

---

## 3. Instalar el tema en WordPress

### Método 1: Reemplazar carpeta directamente (recomendado)

Este es el método más fiable, especialmente al actualizar:

1. Descomprime el ZIP del tema
2. Abre el Finder (Mac) o Explorer (Windows) y navega a tu instalación local o servidor:
   `wp-content/themes/`
3. **Reemplaza completamente** la carpeta `cv-guaguas-50aniversario` con la nueva versión
4. Ve a **Apariencia → Temas** en el panel de WordPress y activa el tema si no lo estaba

> ✅ Este método garantiza que todos los archivos (PHP, CSS, imágenes) se actualizan correctamente.

### Método 2: Panel de administración

1. Inicia sesión en tu WordPress: `https://tu-dominio.com/wp-admin`
2. Ve a **Apariencia → Temas → Añadir nuevo**
3. Haz clic en **"Subir tema"**
4. Selecciona el archivo `cv-guaguas-50aniversario.zip`
5. Haz clic en **"Instalar ahora"**
6. Una vez instalado, haz clic en **"Activar"**

### Método 3: WP-CLI (línea de comandos)

```bash
# Si tienes el ZIP
wp theme install cv-guaguas-50aniversario.zip --activate

# Si ya subiste la carpeta manualmente
wp theme activate cv-guaguas-50aniversario
```

### Verificación post-instalación

Tras activar el tema, deberías ver:

- ✅ En el menú lateral aparece **"Libro"** (Custom Post Type de capítulos)
- ✅ En **Apariencia** aparece **"Opciones Libro"**
- ✅ La web muestra el diseño azul marino con acentos dorados

---

## 4. Configuración inicial

### 4.1 Enlaces permanentes (automático)

El tema regenera las reglas de reescritura automáticamente al activarse, así que las URLs del tipo `/capitulo/nombre-del-capitulo/` deberían funcionar sin pasos adicionales.

Si en tu servidor las páginas de capítulo dan error 404 (puede ocurrir en algunos hostings que cachean las reglas de reescritura), repite manualmente este paso como solución:

1. Ve a **Ajustes → Enlaces permanentes**
2. Selecciona **"Nombre de la entrada"** (o cualquier formato que no sea "Simple")
3. Haz clic en **"Guardar cambios"** (incluso sin cambiar nada)

### 4.2 Verificar que .htaccess es escribible

Si usas Apache, WordPress necesita poder escribir en `.htaccess`. Verifica:

```bash
# Permisos correctos
chmod 644 .htaccess
chown www-data:www-data .htaccess  # Ajusta según tu servidor
```

Si usas **Nginx**, añade esta regla en tu configuración del sitio:

```nginx
location / {
    try_files $uri $uri/ /index.php?$args;
}
```

---

## 5. Importar contenido de ejemplo

El tema incluye **25 capítulos** con contenido real del libro del 50 aniversario, con estructura jerárquica de hasta dos niveles (padre/hijo). La importación es automática.

### Paso a paso

1. Ve a **Libro → Todos los capítulos** en el menú lateral
2. En la parte superior verás un aviso azul: _"¿Primera vez? Importa el contenido de ejemplo..."_
3. Haz clic en **"Importar contenido de ejemplo"**
4. Espera a que se complete (puede tardar 10-30 segundos)
5. Verás un mensaje de confirmación con el número de capítulos creados

### ¿Qué se importa?

- 📖 25 capítulos con estructura jerárquica (padres e hijos)
- 📝 Contenido maquetado con shortcodes
- 🔢 Números de capítulo configurados
- 📊 Orden correcto de los capítulos
- 🖼️ Referencias a imágenes incluidas en el tema (JPEG/WebP en `assets/images/`)
- 🏛️ Logos de patrocinadores en el footer (carga automática)

### Reimportar contenido

Si necesitas volver a importar (resetear todo el contenido):

1. Ve a **Libro → Todos los capítulos**
2. Haz clic en **"Reimportar contenido (resetear)"**
3. Confirma la acción

> ⚠️ Esto **elimina todos los capítulos existentes** y los recrea desde cero.

---

## 6. Página de inicio (automática)

Al activar el tema se crea automáticamente una página llamada **"Inicio"** con la plantilla **"Página 50 Aniversario CV Guaguas"** ya asignada, y se establece como página de portada (Ajustes → Lectura). No es necesario hacerlo manualmente.

### 6.1 Verificar

Visita `https://tu-dominio.com` — deberías ver:

- El hero a pantalla completa con la imagen duotono del equipo
- El título "GUAGUAS: UNA HISTORIA DE LEYENDA · 1976 ★ 2026"
- Los botones de descarga PDF/EPUB y el link "Comenzar a leer"
- El sidebar con el índice de capítulos

---

## 7. Configurar opciones del libro

1. Ve a **Apariencia → Opciones Libro**
2. Configura los siguientes campos:

| Campo | Descripción | Ejemplo |
|-------|-------------|---------|
| URL del PDF | Enlace de descarga del PDF | `https://tu-dominio.com/wp-content/uploads/libro.pdf` |
| URL del EPUB | Enlace de descarga del EPUB | `https://tu-dominio.com/wp-content/uploads/libro.epub` |

3. Haz clic en **"Guardar cambios"**

### Imagen del hero de la home

La imagen se gestiona directamente desde el archivo:
`assets/images/hero-home.jpg`

Reemplaza este archivo (1920×1080px recomendado, JPEG calidad 82-90) para cambiar el fondo de la portada.

---

## 8. Gestionar capítulos

### Crear un nuevo capítulo

1. Ve a **Libro → Añadir capítulo**
2. Escribe el título
3. Añade el contenido en el editor (puedes usar los shortcodes del tema)
4. Configura los **campos personalizados** en la sección "Datos del Capítulo":

| Campo | Descripción |
|-------|-------------|
| Número de capítulo | Ej: `01`, `02`, `03` |
| Hero: imagen | URL de la imagen de fondo del hero |
| Hero: overlay | Color RGBA del overlay (ej: `rgba(0,0,0,0.35)`) |
| Hero: altura | Altura del hero (ej: `500px`) |
| Hero: posición fondo | Posición CSS (ej: `center center`, `center bottom`) |
| Ocultar número | Checkbox para ocultar el badge numérico |
| Ocultar título | Checkbox para ocultar el título automático |

5. Haz clic en **"Publicar"**

### Ordenar capítulos

El campo **"Orden"** en "Atributos de página" controla la posición. Los capítulos del libro siguen esta convención:

| Nivel | Rango de orden | Ejemplo |
|-------|---------------|---------|
| Capítulos principales | 10, 20, 30... | Cap 1 → 10 |
| Hijo primero del cap | 11, 21, 31... | Cap 1, hijo 1 → 11 |
| Hijos sucesivos | +1 por hijo | Cap 1, hijo 2 → 12 |

---

## 9. Shortcodes disponibles

### Texto y estructura

```
[capitular]Primer párrafo con letra capital...[/capitular]

[cita_editorial author="Juan Ruiz"]
Texto de la cita destacada.
[/cita_editorial]

[seccion_header]Título de sección con fondo amarillo[/seccion_header]
[seccion_header highlighted="false"]Sin fondo[/seccion_header]
[seccion_header color="hsl(2 82% 30%)"]Con color personalizado[/seccion_header]
[seccion_header star="true"]Con estrella decorativa[/seccion_header]

[bloque_color fondo="hsl(46, 92%, 62%)" texto="#1a1a0a"]
Contenido sobre fondo coloreado
[/bloque_color]

[resaltado]Texto con fondo amarillo inline[/resaltado]
```

### Imágenes

```
[imagen_contenido file="nombre-archivo.jpg" caption="Pie de foto"]
[imagen_contenido file="nombre-archivo.jpg" caption="Pie de foto" fullwidth="true"]
```

### Infografía fullwidth de competiciones europeas

```
[competiciones_europa bg="imagen-fondo.jpg" titulo="Todas las competiciones europeas"]
  [temp anio="1987-88" comp="Copa Confederación"]
    [rival]Knack Roselaire (Bélgica)[/rival]
  [/temp]
  [temp anio="2020-21" comp="CEV Cup"]
    [rival]Fino Kaposvar (Hungría)[/rival]
    [nota_rival]* No se disputó por Covid.[/nota_rival]
    [rival]Glatasaray (Turquía)[/rival]
  [/temp]
[/competiciones_europa]
```

> ⚠️ Este shortcode genera un bloque fullwidth que rompe el contenedor padre. Funciona únicamente dentro de `single-capitulo.php` con la lógica de marcadores `<!--EURO_INFOGRAFIA_START-->`.

### Perfil de jugador

```
[perfil_jugador nombre="Nombre Apellido" posicion="Central" temporadas="1989-1995"]
Texto biográfico del jugador.
[/perfil_jugador]
```

### Artículo numerado (estatutos)

```
[articulo numero="1º"]Texto del artículo...[/articulo]
```

### Cronología

```html
<div class="timeline-container">
  <div class="timeline-event">
    <span class="timeline-year">1976</span>
    <div class="timeline-content">Descripción del evento.</div>
  </div>
</div>
```

### Dos columnas

```
[dos_columnas]
Columna izquierda
|||
Columna derecha
[/dos_columnas]
```

---

## 10. Personalización visual

### Colores del tema

Los colores se definen en `assets/css/main.css`:

```css
:root {
    --gold: 45 100% 50%;        /* Amarillo/Dorado Guaguas — #FFC400 */
    --gold-light: 45 100% 60%;
    --gold-dark: 45 100% 40%;
    --background: 220 50% 10%;  /* Azul marino de fondo */
    --sidebar: 220 55% 8%;      /* Sidebar más oscuro */
    --foreground: 0 0% 98%;     /* Texto principal */
}
```

Light mode: añade `class="light"` al `<body>` o actívalo desde el selector del sidebar.

### Tipografía

El tema usa **Google Fonts** cargadas vía CDN:

- **Antonio** (`--font-display`) — Años, títulos de hero, badges y elementos de display
- **Archivo** (`--font-sans`, `--font-serif`) — Texto de cuerpo y lectura
- **Poppins** — Exclusivamente en la página de inicio (hero de portada)

### Cambiar la imagen del hero principal

Reemplaza el archivo `assets/images/hero-home.jpg` (1920×1080px, JPEG q82).

### Modos claro/oscuro

El tema soporta ambos modos. El selector está en el sidebar. Para forzar uno en código:

```php
// En header.php, añadir clase al body:
<body class="light">  // modo claro
<body>                // modo oscuro (por defecto)
```

---

## 11. Solución de problemas

### ❌ Los capítulos dan error 404

**Causa**: Las reglas de reescritura no se han regenerado.

**Solución**:
1. Ve a **Ajustes → Enlaces permanentes**
2. Haz clic en **"Guardar cambios"** (sin cambiar nada)
3. Visita un capítulo de nuevo

### ❌ El sidebar no aparece en escritorio

**Solución**:
1. Abre la consola del navegador (F12 → Console)
2. Busca errores relacionados con `main.js`
3. Verifica que el archivo existe en `assets/js/main.js`

### ❌ Los estilos no se aplican tras actualizar

**Solución**:
1. Limpia la caché del navegador: `Ctrl + Shift + R`
2. Verifica que has reemplazado **toda la carpeta** del tema, no solo algunos archivos
3. Comprueba que `assets/css/main.css` tiene la fecha de modificación correcta

### ❌ La infografía de competiciones europeas no es fullwidth

**Causa**: El shortcode `[competiciones_europa]` depende de la lógica de marcadores en `single-capitulo.php`.

**Solución**: Asegúrate de que `single-capitulo.php` contiene el bloque de detección `<!--EURO_INFOGRAFIA_START-->`. Si reimportaste contenido, el shortcode debe estar dentro del contenido del hijo "Embajadores por Europa" del cap. 8.

### ❌ Error de sintaxis PHP tras editar sample-content.php

**Causa**: Comillas simples sin escapar dentro de strings PHP.

**Solución**: Usar siempre comillas tipográficas Unicode (`'` `'`) en lugar de comillas rectas (`'`) dentro de atributos de shortcodes en PHP. Ejecutar el validador incluido:

```bash
python3 validate_php_strings.py
```

### ❌ Las imágenes del contenido no cargan

**Solución**:
1. Verifica que la carpeta `assets/images/` existe y tiene los archivos
2. Comprueba permisos: `chmod -R 644 assets/images/`
3. Las imágenes deben estar en `assets/images/` con el nombre exacto referenciado en el shortcode

### ❌ Error al importar contenido de ejemplo

**Causa posible**: Límite de memoria PHP.

**Solución**: Aumenta el límite en `wp-config.php`:

```php
define('WP_MEMORY_LIMIT', '256M');
```

---

## 12. Actualización del tema

### Actualizar sin perder contenido

Los capítulos y su contenido se guardan en la base de datos. Para actualizar:

1. Descarga la nueva versión del tema
2. **Reemplaza completamente** la carpeta `cv-guaguas-50aniversario` en `wp-content/themes/`
3. Ve a **Apariencia → Temas** y verifica que sigue activo

> ✅ El contenido de los capítulos se mantiene intacto (está en la BD).
> ⚠️ Los cambios en el contenido de `inc/sample-content.php` solo se aplican si realizas una **reimportación**.

### Cuándo reimportar

Reimporta si:
- Se han añadido nuevos capítulos al `sample-content.php`
- Se han corregido textos o fotos en el contenido base
- Se ha cambiado la estructura de capítulos (padres/hijos, orden)

> ⚠️ La reimportación **elimina todo el contenido existente** y lo recrea desde cero.

---

## 13. Seguridad y rendimiento

### Plugins recomendados

| Plugin | Función |
|--------|---------|
| **Yoast SEO** | Optimización SEO |
| **WP Rocket** o **LiteSpeed Cache** | Caché y rendimiento |
| **Smush** o **ShortPixel** | Compresión de imágenes adicional |
| **UpdraftPlus** | Copias de seguridad |
| **Wordfence** | Seguridad y firewall |

### Optimización de rendimiento

1. **Activa la caché** del servidor o usa un plugin de caché
2. Las imágenes del tema ya están optimizadas (JPEG q82, máx 1400px) pero puedes comprimirlas más con ShortPixel
3. **Habilita GZIP/Brotli** en tu servidor web
4. **Usa un CDN** (Cloudflare, etc.) para servir estáticos más rápido

### Copias de seguridad

Antes de cualquier cambio importante:

```bash
# Backup de la base de datos
wp db export backup-$(date +%Y%m%d).sql

# Backup de archivos del tema
tar -czf tema-backup-$(date +%Y%m%d).tar.gz wp-content/themes/cv-guaguas-50aniversario/
```

---

## 📞 Resumen rápido

| Paso | Acción | Tiempo estimado |
|------|--------|-----------------|
| 1 | Descomprimir y reemplazar carpeta del tema | 1 min |
| 2 | Activar el tema en Apariencia → Temas | 1 min |
| 3 | Configurar URLs de PDF/EPUB (opcional) | 1 min |
| **Total** | | **~3 min** |

> Al activar el tema, todo lo demás ocurre automáticamente: se importan los capítulos, se crean las páginas legales, se crea la página de inicio con su plantilla y se establece como portada, y se regeneran los enlaces permanentes. No se requieren pasos manuales adicionales.

---

🏐 **CV Guaguas — 50 Años de Historia (1976–2026)**
