

## Plan: Add subtitle/role to sidebar menu items

### Changes

**1. `src/components/SidebarIndex.tsx`**
- Add optional `subtitle` field to `ChapterItem` interface
- Render subtitle below the title in a second line with smaller, uppercase text styling

**2. `src/data/chaptersStructure.ts`**
- Add `subtitle` to each prologue child:
  - Fernando Clavijo → "Presidente del Gobierno de Canarias"
  - Antonio Morales → "Presidente del Cabildo de Gran Canaria"
  - Juan Ruiz → "Presidente del CV Guaguas"
  - Poli Suárez → "Consejero de Deportes del Gobierno de Canarias"
  - Aridany Romero → "Consejero de Deportes del Cabildo de Gran Canaria"
  - Carolina Darias → "Alcaldesa del Ayuntamiento de Las Palmas de Gran Canaria"
  - Roberto Melián → "Presidente de la Federación Canaria de Voleibol"
  - Jorge Almansa → "Capitán del CV Guaguas"

