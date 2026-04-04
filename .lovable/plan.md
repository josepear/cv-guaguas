

# Sync React from WordPress (GitHub): Complete Chapter Structure Update

## Summary of Differences Found

The WordPress version from GitHub has **26 chapters (0–25)** while React has **24 chapters (0–23)**. There are title changes, new chapters, new subcapítulos, and new content.

## Detailed Mapping: WordPress → React

### Title changes (same position)
| # | React (current) | WordPress (target) |
|---|---|---|
| 02 | Los Estatutos Fundacionales | Estatutos Fundacionales |
| 05 | Iconos y estrellas del Guaguas | Iconos y estrellas del CV Guaguas |
| 06 | Ignacio Brito y Tributo a los Salesianos | Ignacio Brito / Tributo a los Salesianos |
| 07 | Marek | Marek, ayer, hoy y siempre |
| 09 | Relevo generacional | El relevo generacional |
| 11 | Todos los títulos | Títulos para una gran historia |

### Structural changes from cap 16 onward (WordPress inserts 2 new chapters)
| WordPress # | WordPress Title | React # | React Title |
|---|---|---|---|
| 16 | La directiva y el futuro que viene | 16 | La directiva |
| **17** | **Más honores** (NEW) | 17 | El Guaguas que viene |
| **18** | **El Guaguas como en los viejos tiempos** (NEW) | — | — |
| 19 | Empleados y técnicos | 18 | Empleados y técnicos |
| 20 | La plantilla del cincuentenario | 19 | La plantilla del cincuentenario |
| **21** | **Reconocimiento del colectivo arbitral** (NEW) | — | — |
| 22 | Miguel Ángel Ramírez | 20 | Miguel Ángel Ramírez |
| 23 | A la vanguardia de la tecnología | 21 | Comunicación digital |
| 24 | Socios y abonados | 22 | Socios y abonados |
| 25 | Empresarios de la tierra | 23 | Empresarios de la tierra |

### New subcapítulos added in WordPress
- **Cap 04** now has 2 children: "El hombre que lo cambió todo" (with full Juan Ruiz narrative content) + "La génesis de su proyecto en cronología" (timeline)
- **Cap 08** gains "La aventura europea" subcapítulo
- **Cap 11** expands from 1 child (Joselu Sánchez) to 22+ children (individual titles: Copa del Rey 1989, Liga 1989-90, etc.)
- **Cap 14** expands from 2 children to 14+ (Alejandro Fernández, Guilherme Hage, Jorge Almansa, Matt Knigge, Paulo Renan, Paolo Zonca, Martín Ramos, Io de Amo, Nico Bruno, Unai Larrañaga, Walla Souza, Jean Pascal, Osmany Juantorena)
- **Cap 16** hero title changes to "LA DIRECTIVA / Y EL FUTURO / QUE VIENE"

## Changes by File

### 1. `src/data/chaptersStructure.ts`
- Update titles for chapters 02, 05, 06, 07, 09, 11
- Add children to cap 04: `cap05-el-hombre` and `cap05-cronologia-genesis`
- Add "La aventura europea" child to cap 08
- Expand cap 11 children to individual title subcapítulos (22 titles)
- Expand cap 14 children with all new player subcapítulos
- Update cap 16 title and hero
- Insert 3 NEW chapters: 17 "Más honores", 18 "El Guaguas como en los viejos tiempos", 21 "Reconocimiento del colectivo arbitral"
- Rename cap 23 "A la vanguardia de la tecnología"
- Re-number all affected chapters, IDs, slugs, and children from 17 onward (total: 26 chapters, 0–25)

### 2. `src/data/chapterContent.tsx`
- Add full content for "El hombre que lo cambió todo" (Juan Ruiz narrative from WordPress)
- Add timeline content for "La génesis de su proyecto en cronología"
- Add placeholder content for all new subcapítulos (individual titles, new players)
- Add placeholder content for 3 new chapters (17, 18, 21)
- Rename content key for "Comunicación digital" → "A la vanguardia de la tecnología"
- Re-key all content entries from cap 17 onward to match new slugs

## Slug Convention for New Entries
Following the existing pattern where children use the parent's next number:
- Cap 04 children: `cap05-el-hombre`, `cap05-cronologia-genesis`
- Cap 08 new child: `cap09-aventura-europea`
- Cap 11 title children: `cap12-copa-1989`, `cap12-liga-1990`, etc.
- Cap 14 new players: `cap15-alejandro-fernandez`, `cap15-guilherme-hage`, etc.
- New chapters get sequential `capitulo-17` through `capitulo-25`

## Note
This is a large structural update. The implementation should proceed methodically: first update `chaptersStructure.ts` with all structural changes, then update `chapterContent.tsx` with content and key remapping.

