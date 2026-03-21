

## Plan: Añadir contenido completo a "Los orígenes" (cap01-los-origenes)

### Contexto
El subcapítulo `cap01-los-origenes` tiene un placeholder. El contenido proporcionado es el texto completo del Capítulo 01, que actualmente existe en versión resumida bajo la key `"capitulo-01"`. Dado que `capitulo-01` ahora redirige a `cap01-los-origenes`, el contenido completo debe ir en la nueva entrada.

### Cambios

**`src/data/chapterContent.tsx`** — Reemplazar el placeholder de `"cap01-los-origenes"` con el contenido completo proporcionado:

- **6 secciones** con `<SectionHeader>`:
  - Las horas extraescolares con Francisco Rodríguez
  - Silvestre Cabrera y el salto cualitativo
  - La selección cadete con Felipe Nuez como germen
  - Estatutos fundacionales y despegue
  - El ascenso a Segunda División de 1979
  - El acceso a la élite y su conflicto burocrático

- **Primera sección** usa `<DropCap>` para el primer párrafo (patrón existente)
- **Citas de prensa** con `<NewspaperQuote>` para las declaraciones de Silvestre Cabrera y los artículos de La Provincia
- **Cronología final** con `<Timeline>` y `<TimelineEvent>` (18 eventos, del 1967 al 1985)
- **Título "La cronología"** como `<SectionHeader>` antes del timeline

- Opcionalmente, simplificar o eliminar el contenido resumido de `"capitulo-01"` ya que esa key nunca se renderiza (el padre redirige al primer hijo).

### Componentes reutilizados
`SectionHeader`, `DropCap`, `NewspaperQuote`, `Timeline`, `TimelineEvent` — todos ya importados en el archivo.

