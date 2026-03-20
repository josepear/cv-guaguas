

## Plan: Update Chapter 0 — Prólogos

The current `capitulo-01` "Prólogos" needs to become chapter **0** with 8 subchapters matching the book's structure.

### Changes needed

**1. Update `src/data/chaptersStructure.ts`**

- Change `number: "01"` → `number: "0"` (or remove number since the book shows `CAP_0`)
- Reorder and update the 8 children to match the book exactly:
  1. Fernando Clavijo — Presidente del Gobierno de Canarias
  2. Antonio Morales — Presidente del Cabildo de Gran Canaria
  3. Juan Ruiz — Presidente del CV Guaguas
  4. Poli Suárez — Consejero de Deportes del Gobierno de Canarias *(new)*
  5. Aridany Romero — Consejero de Deportes del Cabildo de Gran Canaria *(new)*
  6. Carolina Darias — Alcaldesa del Ayuntamiento de Las Palmas de Gran Canaria
  7. Roberto Melián — Presidente de la Federación Canaria de Voleibol
  8. Jorge Almansa — Capitán del CV Guaguas

**2. Update `src/data/chapterContent.tsx`**

- Add placeholder content entries for the two new subchapter slugs (`prologo-poli-suarez`, `prologo-aridany-romero`)
- Update any existing slug references if slugs change

**3. No visual/UX changes** — hero, sidebar, and navigation remain identical.

### Notes
- The numbering shifts: current chapters 02–onwards will need renumbering in subsequent updates. We handle that when we get to those chapters.
- Content for the prologues will be added when you provide the actual text.

