

## Plan: Añadir contenido completo a "José Miguel Santana" (cap02-jose-miguel-santana)

### Cambios

**`src/data/chapterContent.tsx`** — Reemplazar el placeholder actual (líneas 663-670) con el contenido completo proporcionado:

- **Sin `<PlayerProfile>`**: El texto es narrativo, no un perfil de ficha. Se usa el mismo formato que "Los orígenes" y "Felipe Nuez".
- **`<DropCap>`** para el primer párrafo (el largo que empieza con "Descubridor de Sergio Miguel Camarero...").
- **Sin `<SectionHeader>`**: El texto no tiene secciones tituladas en mayúsculas, es una narrativa continua.
- **Sin `<NewspaperQuote>`**: Las citas están integradas en el texto como discurso directo, no son extractos de prensa con fuente.
- **6-7 párrafos** con `<p>` para el resto del contenido, respetando los saltos naturales del texto original.
- **Sin Timeline**: No hay cronología en este subcapítulo.

### Componentes reutilizados
`DropCap` — único componente especial necesario.

