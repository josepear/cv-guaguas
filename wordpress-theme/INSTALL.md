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
zip -r cv-guaguas-50aniversario.zip cv-guaguas-50aniversario/
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

### Método 1: Panel de administración (recomendado)

1. Inicia sesión en tu WordPress: `https://tu-dominio.com/wp-admin`
2. Ve a **Apariencia → Temas → Añadir nuevo**
3. Haz clic en **"Subir tema"**
4. Selecciona el archivo `cv-guaguas-50aniversario.zip`
5. Haz clic en **"Instalar ahora"**
6. Una vez instalado, haz clic en **"Activar"**

### Método 2: FTP / SFTP

1. Conéctate al servidor con un cliente FTP (FileZilla, Cyberduck, etc.)
2. Navega a `/wp-content/themes/`
3. Sube la carpeta `cv-guaguas-50aniversario` completa
4. Ve a **Apariencia → Temas** en el panel de WordPress
5. Localiza "CV Guaguas - 50 Aniversario" y haz clic en **"Activar"**

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

### 4.1 Regenerar enlaces permanentes

Este paso es **obligatorio** para que los capítulos funcionen correctamente:

1. Ve a **Ajustes → Enlaces permanentes**
2. Selecciona **"Nombre de la entrada"** (o cualquier formato que no sea "Simple")
3. Haz clic en **"Guardar cambios"** (incluso sin cambiar nada)

> 💡 Esto regenera las reglas de reescritura y activa las URLs del tipo `/capitulo/nombre-del-capitulo/`.

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

El tema incluye **23 capítulos** con contenido real del libro del 50 aniversario. La importación es automática y sencilla.

### Paso a paso

1. Ve a **Libro → Todos los capítulos** en el menú lateral
2. En la parte superior verás un aviso azul: _"¿Primera vez? Importa el contenido de ejemplo..."_
3. Haz clic en **"Importar contenido de ejemplo"**
4. Espera a que se complete (puede tardar 10-30 segundos)
5. Verás un mensaje de confirmación con el número de capítulos creados

### ¿Qué se importa?

- 📖 23 capítulos con estructura jerárquica (padres e hijos)
- 📝 Contenido maquetado con shortcodes (`[cita_editorial]`, `[imagen_contenido]`, `[hero_capitulo]`)
- 🔢 Números de capítulo y subcapítulo configurados
- 📊 Orden correcto de los capítulos
- 🖼️ Referencias a imágenes incluidas en el tema

### Reimportar contenido

Si necesitas volver a importar (resetear todo el contenido):

1. Ve a **Libro → Todos los capítulos**
2. Haz clic en **"Reimportar contenido (resetear)"**
3. Confirma la acción

> ⚠️ Esto **elimina todos los capítulos existentes** y los recrea desde cero.

---

## 6. Crear la página de inicio

### 6.1 Crear la página

1. Ve a **Páginas → Añadir nueva**
2. Escribe el título: **"50 Aniversario"** (o el que prefieras)
3. En el panel derecho, busca **"Atributos de página"**
   - Si no lo ves, haz clic en el icono ⚙️ (engranaje) arriba a la derecha
4. En **"Plantilla"**, selecciona: **"Página 50 Aniversario CV Guaguas"**
5. Haz clic en **"Publicar"**

### 6.2 Establecer como página de inicio

1. Ve a **Ajustes → Lectura**
2. Selecciona **"Una página estática"**
3. En **"Página de inicio"**, elige la página que acabas de crear ("50 Aniversario")
4. Haz clic en **"Guardar cambios"**

### 6.3 Verificar

Visita `https://tu-dominio.com` — deberías ver:

- El hero a pantalla completa con la imagen del estadio
- El marcador "50 Aniversario · 1976 - 2026"
- El sidebar con el índice de capítulos
- Los botones de descarga PDF/EPUB

---

## 7. Configurar opciones del libro

1. Ve a **Apariencia → Opciones Libro**
2. Configura los siguientes campos:

| Campo | Descripción | Ejemplo |
|-------|-------------|---------|
| Título del Hero | Texto principal del hero | `50 Años de Historia` |
| Subtítulo del Hero | Texto secundario | `Cinco décadas de pasión...` |
| URL del PDF | Enlace de descarga del PDF | `https://tu-dominio.com/wp-content/uploads/libro.pdf` |
| URL del EPUB | Enlace de descarga del EPUB | `https://tu-dominio.com/wp-content/uploads/libro.epub` |

3. Haz clic en **"Guardar cambios"**

### Subir archivos PDF/EPUB

1. Ve a **Medios → Añadir nuevo**
2. Sube los archivos del libro (PDF, EPUB)
3. Copia la URL del archivo subido
4. Pégala en las opciones del libro

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
| Subtítulo | Descripción breve del capítulo |
| Cita destacada | Frase importante |
| Autor de la cita | Quien dijo la frase |
| Ocultar número | Checkbox para ocultar el badge numérico |

5. Haz clic en **"Publicar"**

### Crear subcapítulos

1. Crea un nuevo capítulo normalmente
2. En **"Atributos de página"** (panel derecho), selecciona el **capítulo padre**
3. Ajusta el **"Orden"** para controlar la posición dentro del padre

### Ordenar capítulos

El campo **"Orden"** en "Atributos de página" controla la posición:

| Capítulo | Orden sugerido |
|----------|---------------|
| Prólogo | 0 |
| Capítulo 1 | 10 |
| Capítulo 2 | 20 |
| Capítulo 3 | 30 |

> 💡 Usa incrementos de 10 para dejar espacio entre capítulos por si necesitas insertar uno intermedio en el futuro.

### Sistema de numeración

- **Capítulos principales**: Badge dorado con texto azul (ej: `01`, `02`)
- **Subcapítulos**: Badge blanco con texto azul (ej: `1.1`, `1.2`)
- **Auto-numeración**: Si un subcapítulo no tiene número pero su padre sí, se genera automáticamente (padre `01` → hijos `01.1`, `01.2`...)

---

## 9. Shortcodes disponibles

### Cita editorial

```
[cita_editorial author="Manolo Berenguer" source="Fundador, 1976"]
El voleibol no es solo un deporte, es una forma de vida.
[/cita_editorial]
```

### Imagen con pie de foto

```
[imagen_contenido src="URL_IMAGEN" alt="Descripción" caption="Pie de foto" fullwidth="true"]
```

O usando la biblioteca de medios:

```
[imagen id="123" caption="Pie de foto" fullwidth="false"]
```

### Cabecera de capítulo (Hero)

```
[hero_capitulo background="URL_FONDO" height="500px" overlay="rgba(26,35,126,0.7)" icon="star"]
    [hero_linea color="#FFFFFF" font_weight="black"]TÍTULO[/hero_linea]
    [hero_linea color="#D4AF37" highlight="#1a237e" font_weight="bold"]SUBTÍTULO[/hero_linea]
[/hero_capitulo]
```

> 📖 Para documentación completa de shortcodes, consulta el [README principal](README.md#-shortcodes-disponibles).

---

## 10. Personalización visual

### Colores del tema

Los colores se definen en `assets/css/main.css`:

```css
:root {
    --gold: 45 100% 50%;        /* Amarillo/Dorado Guaguas */
    --gold-light: 45 100% 60%;
    --gold-dark: 45 100% 40%;
    --background: 220 50% 10%;  /* Azul marino de fondo */
    --sidebar: 220 55% 8%;     /* Sidebar más oscuro */
}
```

### Cambiar la imagen del hero principal

1. Sube tu imagen a **Medios → Añadir nuevo**
2. O reemplaza `assets/images/hero-stadium.jpg` vía FTP

### Tipografía

El tema usa **Google Fonts** cargadas vía CDN:

- **Montserrat** — Títulos y encabezados
- **Inter** — Texto de cuerpo

---

## 11. Solución de problemas

### ❌ Los capítulos dan error 404

**Causa**: Las reglas de reescritura no se han regenerado.

**Solución**:
1. Ve a **Ajustes → Enlaces permanentes**
2. Haz clic en **"Guardar cambios"** (sin cambiar nada)
3. Visita un capítulo de nuevo

### ❌ El sidebar no aparece en escritorio

**Causa**: No se cargó el JavaScript del tema.

**Solución**:
1. Abre la consola del navegador (F12 → Console)
2. Busca errores relacionados con `main.js`
3. Verifica que el archivo existe en `wp-content/themes/cv-guaguas-50aniversario/assets/js/main.js`

### ❌ Los estilos no se aplican

**Solución**:
1. Limpia la caché del navegador: `Ctrl + Shift + R`
2. Si usas un plugin de caché (WP Rocket, LiteSpeed, etc.), vacía la caché
3. Verifica que Tailwind CDN carga correctamente (revisa la pestaña Network del navegador)

### ❌ Las imágenes del contenido no cargan

**Causa**: Las imágenes del tema están en `assets/images/content/`.

**Solución**:
1. Verifica que la carpeta `assets/images/content/` existe y tiene archivos
2. Comprueba permisos: `chmod -R 644 assets/images/`
3. Si reimportaste contenido, las imágenes deben estar en la ruta del tema

### ❌ El menú móvil no se abre

**Solución**:
1. Comprueba que no hay conflictos de JavaScript con otros plugins
2. Desactiva temporalmente todos los plugins para verificar
3. Revisa la consola del navegador en búsqueda de errores

### ❌ Error al importar contenido de ejemplo

**Causa posible**: Límite de memoria PHP.

**Solución**: Aumenta el límite de memoria en `wp-config.php`:

```php
define('WP_MEMORY_LIMIT', '256M');
```

---

## 12. Actualización del tema

### Actualizar sin perder contenido

Los capítulos y su contenido se guardan en la base de datos, no en archivos del tema. Para actualizar:

1. Descarga la nueva versión del tema
2. Ve a **Apariencia → Temas**
3. Desactiva el tema actual
4. Elimínalo
5. Sube e instala la nueva versión
6. Actívala

> ✅ Todo el contenido de los capítulos se mantiene intacto.
> ⚠️ Si personalizaste archivos CSS o PHP directamente, esos cambios se perderán. Usa un **tema hijo** para personalizaciones permanentes.

### Crear un tema hijo (recomendado para personalizaciones)

```bash
# Crear carpeta del tema hijo
mkdir wp-content/themes/cv-guaguas-50aniversario-child
```

Crear `style.css`:

```css
/*
Theme Name: CV Guaguas 50 Aniversario - Child
Template: cv-guaguas-50aniversario
*/

/* Tus estilos personalizados aquí */
```

Crear `functions.php`:

```php
<?php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});
```

---

## 13. Seguridad y rendimiento

### Plugins recomendados

| Plugin | Función |
|--------|---------|
| **Yoast SEO** | Optimización SEO |
| **WP Rocket** o **LiteSpeed Cache** | Caché y rendimiento |
| **Smush** o **ShortPixel** | Compresión de imágenes |
| **UpdraftPlus** | Copias de seguridad |
| **Wordfence** | Seguridad y firewall |

### Optimización de rendimiento

1. **Activa la caché** del servidor o usa un plugin de caché
2. **Comprime imágenes** antes de subirlas (las del tema ya están optimizadas)
3. **Habilita GZIP/Brotli** en tu servidor web
4. **Usa un CDN** (Cloudflare, etc.) para servir estáticos más rápido

### Copias de seguridad

Antes de cualquier cambio importante:

```bash
# Backup de la base de datos
wp db export backup-$(date +%Y%m%d).sql

# Backup de archivos
tar -czf wp-content-backup.tar.gz wp-content/
```

---

## 📞 Resumen rápido

| Paso | Acción | Tiempo estimado |
|------|--------|-----------------|
| 1 | Preparar ZIP del tema | 2 min |
| 2 | Subir y activar en WordPress | 2 min |
| 3 | Regenerar enlaces permanentes | 1 min |
| 4 | Importar contenido de ejemplo | 1 min |
| 5 | Crear página de inicio con plantilla | 2 min |
| 6 | Configurar como página estática | 1 min |
| 7 | Ajustar opciones del libro | 2 min |
| **Total** | | **~11 min** |

---

🏐 **CV Guaguas — 50 Años de Historia (1976–2026)**
