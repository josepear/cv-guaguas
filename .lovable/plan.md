

# Capítulo 03: Contenido + Reestructuración con renumeración completa de slugs

## Resumen
Añadir contenido de los 3 subcapítulos del cap. 03 + nuevo subcapítulo "La cronología". Promover "El proyecto visionario de Juan Ruiz" a capítulo independiente (nuevo cap. 04). Renumerar **todos** los slugs, IDs y claves de contenido de los capítulos afectados (04→05 hasta 22→23).

## Tabla de renumeración completa

| Título | Antes (slug / number) | Después (slug / number) |
|--------|----------------------|------------------------|
| Así se forjó una leyenda | `capitulo-03` / 03 | Sin cambio |
| → Llegar a la élite... | `cap04-elite` | `cap04-elite` (sin cambio) |
| → Fichajes de impacto... | `cap04-fichajes` | `cap04-fichajes` (sin cambio) |
| → La salida de Juan Ruiz... | `cap04-salida-ruiz` | `cap04-salida-ruiz` (sin cambio) |
| → **La cronología** (NUEVO) | — | `cap04-cronologia` |
| ~~→ El proyecto visionario~~ | `cap04-proyecto-juan-ruiz` | `capitulo-04` / **04** (promovido) |
| Iconos y estrellas | `capitulo-04` / 04 | `capitulo-05` / **05** |
| → Camarero, Jover, Golec, Klos | `cap05-*` | `cap06-*` |
| Ignacio Brito | `capitulo-05` / 05 | `capitulo-06` / **06** |
| Marek | `capitulo-06` / 06 | `capitulo-07` / **07** |
| Embajadores por Europa | `capitulo-07` / 07 | `capitulo-08` / **08** |
| → Palacios, Benítez, etc. | `cap08-*` | `cap09-*` |
| Relevo generacional | `capitulo-08` / 08 | `capitulo-09` / **09** |
| → Valido, Sánchez, etc. | `cap09-*` | `cap10-*` |
| Una transición dolorosa | `capitulo-09` / 09 | `capitulo-10` / **10** |
| → Traspaso, estabilidad, etc. | `cap10-*` | `cap11-*` |
| Todos los títulos | `capitulo-10` / 10 | `capitulo-11` / **11** |
| → Joselu Sánchez | `cap11-*` | `cap12-*` |
| Vuelve el gran Guaguas | `capitulo-11` / 11 | `capitulo-12` / **12** |
| → Aclamación, presidentes... | `cap12-*` | `cap13-*` |
| Del CID al Arenas | `capitulo-12` / 12 | `capitulo-13` / **13** |
| Los nuevos ídolos | `capitulo-13` / 13 | `capitulo-14` / **14** |
| → Kukartsev, Cézar | `cap14-*` | `cap15-*` |
| El impacto del escudo | `capitulo-14` / 14 | `capitulo-15` / **15** |
| La directiva | `capitulo-15` / 15 | `capitulo-16` / **16** |
| El Guaguas que viene | `capitulo-16` / 16 | `capitulo-17` / **17** |
| Empleados y técnicos | `capitulo-17` / 17 | `capitulo-18` / **18** |
| La plantilla del cincuentenario | `capitulo-18` / 18 | `capitulo-19` / **19** |
| Miguel Ángel Ramírez | `capitulo-19` / 19 | `capitulo-20` / **20** |
| Comunicación digital | `capitulo-20` / 20 | `capitulo-21` / **21** |
| Socios y abonados | `capitulo-21` / 21 | `capitulo-22` / **22** |
| Empresarios de la tierra | `capitulo-22` / 22 | `capitulo-23` / **23** |

## Cambios por archivo

### 1. `src/data/chaptersStructure.ts`
- Eliminar `cap04-proyecto-juan-ruiz` de children de cap. 03
- Añadir `cap04-cronologia` como nuevo hijo de cap. 03
- Insertar nuevo capítulo standalone `capitulo-04` ("El proyecto visionario de Juan Ruiz", number "04") con hero propio
- Renumerar todos los `id`, `slug` y `number` de capitulo-04→23 y sus children según la tabla
- Total: 23 capítulos (0-23 en vez de 0-22)

### 2. `src/data/chapterContent.tsx`
- Añadir contenido de `cap04-elite`, `cap04-fichajes`, `cap04-salida-ruiz` (texto proporcionado, con DropCap)
- Añadir `cap04-cronologia` usando componentes Timeline/TimelineEvent (15 eventos, 1985-1999)
- Renumerar todas las claves de contenido existentes que usen los slugs antiguos (ej: `"capitulo-04"` → `"capitulo-05"`, `"cap05-camarero"` → `"cap06-camarero"`, etc.)

### 3. Router / otros archivos
No requieren cambios: la ruta es dinámica (`/capitulo/:slug`), así que los nuevos slugs funcionan automáticamente.

## Contenido del subcapítulo "La cronología"
15 eventos de 1985 a 1999 usando `<TimelineEvent year="XXXX">` dentro de un `<Timeline>`, idéntico al patrón de `cap10-cronologia`.

