

# Plan por Fases: Sincronización de contenido React con WordPress

## Estado actual
- **Estructura (chaptersStructure.ts)**: Ya sincronizada - 26 capítulos (0-25), todos los subcapítulos presentes
- **Contenido (chapterContent.tsx)**: 91 entradas, pero **32 slugs sin contenido** y **24 con placeholders** = ~56 entradas que necesitan contenido real desde WordPress
- **WordPress tiene contenido narrativo completo** para la mayoría de subcapítulos (~60K+ caracteres)

## 32 slugs sin entrada de contenido + 24 placeholders

Los slugs sin contenido se agrupan en:
- **Cap 08 jugadores** (10): manuel-palacio, antonio-benitez, jorge-ramon, juanma-martin, oscar-campos, venancio-acosta, antonio-miralles, chava-gonzalez, sandeep-sharma, juan-jose-cardona
- **Cap 09 jugadores** (7): alexis-valido, antonio-sanchez, daniel-castaneda, juan-carlos-vega, hermanos-cabrera, nichel-gomez, raul-davila
- **Cap 10 narrativa + jugadores** (9): traspaso-poderes, estabilidad-imposible, camino-2009, peor-desenlace, cronologia, david-rodriguez, joel-sotelo, pedro-cuarental, marcos-dreyer
- **Cap 11 títulos deportivos** (1 missing: joselu-sanchez) + 24 placeholders (copa/liga entries)
- **Cap 13** (2): aclamacion, presidentes/entrenadores
- **Cap 15** (2): kukartsev, moises-cezar
- **Cap 09 "La cantera toma el relevo"**: Ya tiene slug en estructura pero NO tiene entrada en content

---

## Fase 1: Cap 09 - El relevo generacional (8 subcapítulos)
**Archivos**: `src/data/chapterContent.tsx`

Añadir contenido de WordPress para:
1. `cap10-cantera` - "La cantera toma el relevo" (~3,400 chars, narrativa con DropCap + EditorialQuote)
2. `cap10-alexis-valido` - Alexis Valido (~2,500 chars)
3. `cap10-antonio-sanchez` - Antonio Sánchez (~5,400 chars)
4. `cap10-daniel-castaneda` - Daniel Castañeda (~2,900 chars)
5. `cap10-juan-carlos-vega` - Juan Carlos Vega (~2,700 chars)
6. `cap10-hermanos-cabrera` - Hermanos Cabrera (~6,100 chars)
7. `cap10-nichel-gomez` - Níchel Gómez (~2,900 chars)
8. `cap10-raul-davila` - Raúl Dávila (~3,800 chars)

Conversión de shortcodes WP a componentes React: `[capitular]` → `<DropCap>`, `[cita_editorial]` → `<EditorialQuote>`, `[cita_periodistica]` → `<NewspaperQuote>`, `[subtitulo]` → `<SectionHeader>`

---

## Fase 2: Cap 10 - La travesía del desierto (9 subcapítulos)
**Archivos**: `src/data/chapterContent.tsx`

Añadir contenido para:
1. `cap11-traspaso-poderes` - (~4,000 chars)
2. `cap11-estabilidad-imposible` - (~3,700 chars)
3. `cap11-camino-2009` - (~3,900 chars)
4. `cap11-peor-desenlace` - (~5,000 chars)
5. `cap11-cronologia` - Timeline con TimelineEvent (~3,000 chars)
6. `cap11-david-rodriguez` - (~9,500 chars)
7. `cap11-joel-sotelo` - (~5,200 chars)
8. `cap11-pedro-cuarental` - (~4,700 chars)
9. `cap11-marcos-dreyer` - (~4,900 chars)

---

## Fase 3: Cap 08 - Marek (10 subcapítulos de jugadores)
**Archivos**: `src/data/chapterContent.tsx`

Añadir contenido para los 10 jugadores del cap08:
`cap09-manuel-palacio`, `cap09-antonio-benitez`, `cap09-jorge-ramon`, `cap09-juanma-martin`, `cap09-oscar-campos`, `cap09-venancio-acosta`, `cap09-antonio-miralles`, `cap09-chava-gonzalez`, `cap09-sandeep-sharma`, `cap09-juan-jose-cardona`

---

## Fase 4: Cap 11 - Títulos deportivos (24 subcapítulos)
**Archivos**: `src/data/chapterContent.tsx`, posible nuevo componente `TituloDeportivo.tsx`

Reemplazar los 24 placeholders de copa/liga/supercopa con contenido real de fichas técnicas y narrativas desde WordPress. Crear un componente `TituloDeportivo` para el formato de fichas de partidos si WordPress tiene ese formato estructurado.

---

## Fase 5: Subcapítulos restantes
**Archivos**: `src/data/chapterContent.tsx`

- `cap12-joselu-sanchez` - Joselu Sánchez (cap11 en WP)
- `cap13-aclamacion`, `cap13-presidentes`, `cap13-entrenadores`
- `cap15-kukartsev`, `cap15-moises-cezar`
- Capítulos principales que aún son placeholder (01, 06, 07, 08, 09, 10, 11, 12, 13, 14, 15, 16, 17, 19, 20, 22, 23, 24, 25)

---

## Resumen por fase

| Fase | Capítulo | Subcapítulos | Chars aprox |
|------|----------|-------------|-------------|
| 1 | Cap 09 (El relevo generacional) | 8 | ~30K |
| 2 | Cap 10 (La travesía del desierto) | 9 | ~44K |
| 3 | Cap 08 (Marek) jugadores | 10 | ~30K |
| 4 | Cap 11 (Títulos) | 24 | ~50K+ |
| 5 | Restantes | ~25 | Variable |

Cada fase se implementa y verifica por separado antes de avanzar a la siguiente.

