import { useParams, Navigate } from "react-router-dom";
import { useState, useMemo, useEffect } from "react";
import SidebarIndex, { ChapterItem } from "@/components/SidebarIndex";
import Header from "@/components/Header";
import ChapterSection from "@/components/ChapterSection";
import ChapterNavigation from "@/components/ChapterNavigation";
import ReadingProgressBar from "@/components/ReadingProgressBar";
import EditorialQuote from "@/components/EditorialQuote";
import ContentImage from "@/components/ContentImage";
import InstitutionalFooter from "@/components/InstitutionalFooter";
import heroImage from "@/assets/hero-stadium.jpg";
// Chapter data with slugs for routing
const chaptersData: ChapterItem[] = [
  { id: "prologo", slug: "prologo", title: "Prólogo", number: "" },
  { id: "introduccion", slug: "introduccion", title: "Introducción", number: "" },
  { 
    id: "capitulo-01", 
    slug: "capitulo-01",
    title: "Los Orígenes", 
    number: "01",
    children: [
      { id: "cap01-seccion01", slug: "capitulo-01-primeros-pasos", title: "Los primeros pasos" },
      { id: "cap01-seccion02", slug: "capitulo-01-vision-fundacional", title: "Visión fundacional" },
    ]
  },
  { 
    id: "capitulo-02", 
    slug: "capitulo-02",
    title: "Construcción del Recinto", 
    number: "02",
    children: [
      { id: "cap02-seccion01", slug: "capitulo-02-diseno", title: "Diseño arquitectónico" },
      { id: "cap02-seccion02", slug: "capitulo-02-materiales", title: "Materiales y técnicas" },
    ]
  },
  { id: "capitulo-03", slug: "capitulo-03", title: "La Inauguración", number: "03" },
  { 
    id: "capitulo-04", 
    slug: "capitulo-04",
    title: "Primeros Eventos", 
    number: "04",
    children: [
      { id: "cap04-seccion01", slug: "capitulo-04-deportivos", title: "Encuentros deportivos" },
      { id: "cap04-seccion02", slug: "capitulo-04-culturales", title: "Eventos culturales" },
    ]
  },
  { id: "capitulo-05", slug: "capitulo-05", title: "Década de Consolidación", number: "05" },
  { id: "capitulo-06", slug: "capitulo-06", title: "Expansiones y Mejoras", number: "06" },
  { 
    id: "capitulo-07", 
    slug: "capitulo-07",
    title: "Momentos Históricos", 
    number: "07",
    children: [
      { id: "cap07-seccion01", slug: "capitulo-07-internacionales", title: "Competiciones internacionales" },
      { id: "cap07-seccion02", slug: "capitulo-07-records", title: "Récords y hazañas" },
    ]
  },
  { id: "capitulo-08", slug: "capitulo-08", title: "El Estadio y la Ciudad", number: "08" },
  { id: "capitulo-09", slug: "capitulo-09", title: "Modernización", number: "09" },
  { id: "capitulo-10", slug: "capitulo-10", title: "Sostenibilidad", number: "10" },
  { id: "capitulo-11", slug: "capitulo-11", title: "Eventos Memorables", number: "11" },
  { id: "capitulo-12", slug: "capitulo-12", title: "Figuras Destacadas", number: "12" },
  { id: "capitulo-13", slug: "capitulo-13", title: "El Futuro", number: "13" },
  { id: "epilogo", slug: "epilogo", title: "Epílogo", number: "" },
  { id: "agradecimientos", slug: "agradecimientos", title: "Agradecimientos", number: "" },
  { id: "bibliografia", slug: "bibliografia", title: "Bibliografía", number: "" },
  { id: "creditos", slug: "creditos", title: "Créditos", number: "" },
];

// Helper to find chapter by slug
const getAllChapters = (): ChapterItem[] => {
  const all: ChapterItem[] = [];
  chaptersData.forEach(ch => {
    all.push(ch);
    if (ch.children) {
      ch.children.forEach(child => all.push(child));
    }
  });
  return all;
};

const getChapterBySlug = (slug: string) => getAllChapters().find(ch => ch.slug === slug);

// Content for each chapter
const chapterContent: Record<string, React.ReactNode> = {
  "prologo": (
    <>
      <p>
        Este libro nace del deseo de preservar y compartir la rica historia de un espacio que ha sido testigo de innumerables momentos de gloria, emoción y unión ciudadana. A lo largo de estas páginas, recorreremos juntos el camino que ha convertido a este estadio en un símbolo de nuestra identidad colectiva.
      </p>
      <EditorialQuote author="Juan García Pérez" source="Presidente de la Fundación">
        "Cada piedra de este estadio cuenta una historia, cada grada ha sido testigo de sueños cumplidos y de la pasión que nos une como comunidad."
      </EditorialQuote>
      <p>
        La idea de documentar esta historia surgió hace varios años, cuando un grupo de historiadores, deportistas y ciudadanos comprometidos decidieron que era momento de compilar en un solo volumen la memoria colectiva de este lugar emblemático.
      </p>
    </>
  ),
  "introduccion": (
    <>
      <p>
        El estadio representa mucho más que una infraestructura deportiva. Es el corazón palpitante de una ciudad que ha crecido a su alrededor, un espacio donde se han forjado amistades, donde familias enteras han compartido tardes de domingo, y donde generaciones han encontrado inspiración en las hazañas de sus héroes.
      </p>
      <ContentImage 
        src={heroImage} 
        alt="Vista panorámica del estadio al atardecer"
        caption="Vista aérea del estadio durante la hora dorada, mostrando su integración con el paisaje urbano."
        fullWidth
      />
      <p>
        En las siguientes páginas, exploraremos desde los primeros bocetos arquitectónicos hasta las más recientes renovaciones tecnológicas, pasando por los eventos que han marcado hitos en la historia deportiva y cultural de nuestra región.
      </p>
    </>
  ),
  "capitulo-01": (
    <>
      <p>
        La historia de nuestro estadio comienza mucho antes de que se colocara la primera piedra. En los archivos históricos encontramos referencias a la necesidad de contar con un recinto deportivo digno desde principios del siglo XX.
      </p>
      <p>
        Fue en 1947 cuando un grupo de visionarios presentó la primera propuesta formal ante las autoridades locales. El proyecto inicial contemplaba un aforo modesto, pero con la infraestructura necesaria para albergar competiciones de nivel nacional.
      </p>
      <EditorialQuote>
        "Un estadio no es solo hormigón y acero. Es el lienzo donde una comunidad pinta sus sueños más grandes."
      </EditorialQuote>
    </>
  ),
  "capitulo-01-primeros-pasos": (
    <>
      <p>
        Fue en 1947 cuando un grupo de visionarios presentó la primera propuesta formal ante las autoridades locales. El proyecto inicial contemplaba un aforo modesto, pero con la infraestructura necesaria para albergar competiciones de nivel nacional.
      </p>
      <p>
        Las reuniones se sucedieron durante meses, enfrentando obstáculos burocráticos y limitaciones presupuestarias que parecían insalvables. Sin embargo, la determinación de aquellos pioneros nunca flaqueó.
      </p>
    </>
  ),
  "capitulo-01-vision-fundacional": (
    <>
      <p>
        El arquitecto principal del proyecto, don Manuel Fernández de la Torre, tenía una visión clara: crear un espacio que no solo sirviera para la práctica deportiva, sino que se convirtiera en un punto de encuentro para toda la ciudadanía.
      </p>
      <EditorialQuote>
        "Un estadio no es solo hormigón y acero. Es el lienzo donde una comunidad pinta sus sueños más grandes."
      </EditorialQuote>
    </>
  ),
  "capitulo-02": (
    <>
      <p>
        La construcción del estadio supuso uno de los mayores desafíos de ingeniería de su época. Las condiciones del terreno, la escasez de materiales de la posguerra y las limitaciones técnicas hicieron de cada avance una pequeña victoria.
      </p>
      <p>
        El diseño final incorporaba elementos vanguardistas para la época, incluyendo una cubierta parcial que protegería a miles de espectadores de las inclemencias del tiempo.
      </p>
    </>
  ),
  "capitulo-02-diseno": (
    <>
      <p>
        El diseño final incorporaba elementos vanguardistas para la época, incluyendo una cubierta parcial que protegería a miles de espectadores de las inclemencias del tiempo. La orientación del campo fue cuidadosamente calculada para minimizar el impacto del sol en los deportistas.
      </p>
      <p>
        Los planos originales, que hoy se conservan en el archivo municipal, muestran la meticulosidad con la que cada detalle fue planificado.
      </p>
    </>
  ),
  "capitulo-02-materiales": (
    <>
      <p>
        Gran parte de los materiales utilizados provenían de canteras locales, lo que no solo redujo costes sino que dotó al edificio de una conexión intrínseca con la tierra que lo sustenta.
      </p>
      <p>
        El hormigón armado, todavía una novedad técnica, permitió crear las impresionantes voladizos que caracterizan las tribunas principales.
      </p>
    </>
  ),
  "capitulo-03": (
    <>
      <p>
        El día de la inauguración quedó grabado en la memoria colectiva de la ciudad. Miles de ciudadanos se congregaron para presenciar el nacimiento de lo que sería, durante décadas, el orgullo de toda una región.
      </p>
      <EditorialQuote author="Crónica del periódico local" source="15 de mayo de 1956">
        "Hoy nace algo más que un estadio. Nace un símbolo de lo que somos capaces de lograr cuando trabajamos unidos por un sueño común."
      </EditorialQuote>
      <p>
        Las autoridades locales, nacionales e internacionales se dieron cita en un acto que combinó solemnidad institucional con genuina alegría popular.
      </p>
    </>
  ),
  "capitulo-04": (
    <>
      <p>
        El primer partido oficial disputado en el nuevo estadio enfrentó a los dos equipos más emblemáticos de la ciudad. La expectación era máxima, y el resultado, un empate a dos goles, pareció el destino más justo para una jornada que debía celebrar la unión antes que la rivalidad.
      </p>
      <p>
        Muy pronto quedó claro que el estadio trascendería su función deportiva original. Conciertos, mítines políticos durante la transición, celebraciones religiosas y eventos benéficos encontraron en sus gradas un espacio de acogida sin precedentes.
      </p>
    </>
  ),
  "capitulo-04-deportivos": (
    <>
      <p>
        El primer partido oficial disputado en el nuevo estadio enfrentó a los dos equipos más emblemáticos de la ciudad. La expectación era máxima, y el resultado, un empate a dos goles, pareció el destino más justo.
      </p>
    </>
  ),
  "capitulo-04-culturales": (
    <>
      <p>
        Muy pronto quedó claro que el estadio trascendería su función deportiva original. Conciertos, mítines políticos durante la transición, celebraciones religiosas y eventos benéficos encontraron en sus gradas un espacio de acogida sin precedentes.
      </p>
    </>
  ),
  "capitulo-05": (
    <>
      <p>
        Los años sesenta supusieron la consolidación definitiva del estadio como epicentro de la vida deportiva regional. Los éxitos del equipo local, que alcanzó las máximas categorías nacionales, llenaron sus gradas semana tras semana.
      </p>
      <p>
        La asistencia media superaba las expectativas más optimistas, y pronto surgieron las primeras propuestas de ampliación.
      </p>
    </>
  ),
  "capitulo-06": (
    <>
      <p>
        A lo largo de su historia, el estadio ha experimentado numerosas transformaciones. Cada ampliación ha respetado la esencia original mientras incorporaba las innovaciones necesarias para mantenerse a la vanguardia.
      </p>
      <p>
        La primera gran expansión, completada en 1972, duplicó prácticamente el aforo. Nuevas tribunas, vestuarios ampliados y un sistema de iluminación artificial de última generación prepararon al recinto para competiciones nocturnas.
      </p>
    </>
  ),
  "capitulo-07": (
    <>
      <p>
        El estadio ha tenido el honor de albergar encuentros internacionales de máximo nivel. Selecciones de todo el mundo han pisado su césped, dejando recuerdos imborrables en quienes tuvieron la fortuna de presenciarlos.
      </p>
      <p>
        Numerosos récords nacionales e internacionales se han establecido en esta instalación. Atletas que posteriormente alcanzaron fama mundial dieron aquí sus primeros pasos hacia la gloria.
      </p>
    </>
  ),
  "capitulo-07-internacionales": (
    <>
      <p>
        El estadio ha tenido el honor de albergar encuentros internacionales de máximo nivel. Selecciones de todo el mundo han pisado su césped, dejando recuerdos imborrables.
      </p>
    </>
  ),
  "capitulo-07-records": (
    <>
      <p>
        Numerosos récords nacionales e internacionales se han establecido en esta instalación. Atletas que posteriormente alcanzaron fama mundial dieron aquí sus primeros pasos hacia la gloria.
      </p>
    </>
  ),
  "capitulo-08": (
    <>
      <p>
        La relación entre el estadio y su entorno urbano ha sido de mutuo enriquecimiento. El barrio que lo rodea debe gran parte de su desarrollo a la presencia de esta infraestructura.
      </p>
      <p>
        Comercios, restaurantes y servicios han florecido en sus inmediaciones, creando un ecosistema que vive y respira al ritmo de los eventos que aquí se celebran.
      </p>
    </>
  ),
  "capitulo-09": (
    <>
      <p>
        El nuevo milenio trajo consigo profundas transformaciones. La digitalización de los sistemas de acceso, las pantallas gigantes de última generación y la conectividad wifi en todas las zonas convirtieron al estadio en una instalación del siglo XXI.
      </p>
      <p>
        Sin embargo, estas mejoras se implementaron con sumo cuidado para no alterar el carácter histórico del recinto.
      </p>
    </>
  ),
  "capitulo-10": (
    <>
      <p>
        El compromiso con el medio ambiente ha guiado las últimas actuaciones en el estadio. Paneles solares en la cubierta, sistemas de recogida de aguas pluviales y gestión inteligente de residuos son solo algunas de las iniciativas implementadas.
      </p>
      <p>
        El objetivo declarado es alcanzar la neutralidad de carbono antes de 2030.
      </p>
    </>
  ),
  "capitulo-11": (
    <>
      <p>
        A lo largo de las décadas, el estadio ha acogido eventos que han trascendido lo puramente deportivo. Conciertos de artistas internacionales, ceremonias de apertura de juegos regionales y celebraciones ciudadanas han encontrado aquí su escenario ideal.
      </p>
    </>
  ),
  "capitulo-12": (
    <>
      <p>
        Dedicamos este capítulo a quienes, con su trabajo y dedicación, han hecho posible que el estadio llegue hasta nuestros días en las mejores condiciones.
      </p>
      <p>
        Sus historias personales se entrelazan con la del propio estadio, formando un tapiz humano de incalculable valor.
      </p>
    </>
  ),
  "capitulo-13": (
    <>
      <p>
        Miramos hacia adelante con optimismo. Los proyectos en cartera contemplan nuevas mejoras que mantendrán al estadio a la vanguardia mundial, sin olvidar jamás su historia y su conexión con la comunidad.
      </p>
      <p>
        Las nuevas generaciones heredarán un legado del que sentirse orgullosas.
      </p>
    </>
  ),
  "epilogo": (
    <>
      <p>
        Cerrar este libro significa, en cierto modo, dejar una puerta abierta. La historia del estadio continúa escribiéndose cada día, con cada partido, cada evento, cada momento compartido.
      </p>
      <EditorialQuote>
        "Lo que hace grande a un lugar no son sus dimensiones físicas, sino la grandeza de los momentos vividos en él."
      </EditorialQuote>
    </>
  ),
  "agradecimientos": (
    <>
      <p>
        Este libro no habría sido posible sin la colaboración de numerosas personas e instituciones. Queremos expresar nuestro más sincero agradecimiento a todos aquellos que han contribuido con sus testimonios, fotografías, documentos y, sobre todo, con su tiempo y su pasión.
      </p>
    </>
  ),
  "bibliografia": (
    <>
      <p>
        Las fuentes consultadas para la elaboración de este libro incluyen archivos municipales, hemerotecas nacionales, fondos documentales de federaciones deportivas y colecciones privadas.
      </p>
      <p>
        Una relación completa de las fuentes bibliográficas y documentales está disponible en la versión digital ampliada.
      </p>
    </>
  ),
  "creditos": (
    <>
      <p>
        <strong>Dirección editorial:</strong> Fundación Estadio Histórico<br />
        <strong>Coordinación:</strong> María García López<br />
        <strong>Investigación histórica:</strong> Dr. Antonio Martínez Ruiz<br />
        <strong>Fotografía:</strong> Archivo Municipal, Colección Fernández<br />
        <strong>Diseño y maquetación:</strong> Estudio Gráfico Insular<br />
        <strong>Impresión:</strong> Gráficas del Atlántico
      </p>
      <p className="mt-8 text-muted-foreground text-sm">
        Primera edición: 2024<br />
        ISBN: 978-84-XXXXX-XX-X<br />
        Depósito legal: GC XXX-2024
      </p>
    </>
  ),
};

const Chapter = () => {
  const { slug } = useParams<{ slug: string }>();
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  
  // Get all chapters in flat order for navigation
  const allChapters = useMemo(() => getAllChapters(), []);
  
  // Scroll to top when chapter changes
  useEffect(() => {
    window.scrollTo(0, 0);
  }, [slug]);
  
  if (!slug) {
    return <Navigate to="/" replace />;
  }

  const chapter = getChapterBySlug(slug);
  
  if (!chapter) {
    return <Navigate to="/" replace />;
  }

  const content = chapterContent[slug];
  
  // Find previous and next chapters
  const currentIndex = allChapters.findIndex(ch => ch.slug === slug);
  const previousChapter = currentIndex > 0 ? allChapters[currentIndex - 1] : null;
  const nextChapter = currentIndex < allChapters.length - 1 ? allChapters[currentIndex + 1] : null;

  return (
    <div className="min-h-screen bg-background">
      <Header 
        onMenuToggle={() => setIsMenuOpen(!isMenuOpen)} 
        isMenuOpen={isMenuOpen} 
      />

      <ReadingProgressBar />

      <SidebarIndex 
        chapters={chaptersData} 
        activeChapterSlug={slug}
        isOpen={isMenuOpen}
        onClose={() => setIsMenuOpen(false)}
      />

      {/* Main Content */}
      <main className="pt-[56px] min-h-screen">
        <div className="max-w-4xl mx-auto px-6 md:px-12 lg:px-16 py-16">
          <ChapterSection 
            id={chapter.id} 
            number={chapter.number} 
            title={chapter.title}
            showChapterMarker={!!chapter.number}
          >
            {content || <p>Contenido del capítulo próximamente.</p>}
          </ChapterSection>

          {/* Chapter Navigation */}
          <ChapterNavigation 
            previousChapter={previousChapter}
            nextChapter={nextChapter}
          />
        </div>
      </main>

      {/* Footer */}
      <InstitutionalFooter 
        copyrightText="© 2024 Fundación Estadio Histórico. Todos los derechos reservados."
      />
    </div>
  );
};

export default Chapter;
