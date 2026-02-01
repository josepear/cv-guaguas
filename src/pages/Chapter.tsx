import { useParams, Navigate } from "react-router-dom";
import { useState, useMemo, useEffect } from "react";
import SidebarIndex, { ChapterItem } from "@/components/SidebarIndex";
import Header from "@/components/Header";
import ChapterSection from "@/components/ChapterSection";
import ChapterNavigation from "@/components/ChapterNavigation";
import ReadingProgressBar from "@/components/ReadingProgressBar";
import EditorialQuote from "@/components/EditorialQuote";
import ContentImage from "@/components/ContentImage";
import ChapterHero, { ChapterHeroProps, TitleLine } from "@/components/ChapterHero";
import InstitutionalFooter from "@/components/InstitutionalFooter";
import heroImage from "@/assets/hero-stadium.jpg";

// Extended ChapterItem with hero config
interface ChapterItemWithHero extends ChapterItem {
  hero?: Omit<ChapterHeroProps, 'titleLines'> & {
    titleLines: TitleLine[];
  };
}

// Chapter data with slugs for routing - CV Guaguas book structure
const chaptersData: ChapterItemWithHero[] = [
  { 
    id: "capitulo-01", 
    slug: "capitulo-01",
    title: "Prólogos", 
    number: "01",
    children: [
      { id: "prologo-01", slug: "prologo-fernando-clavijo", title: "Fernando Clavijo" },
      { id: "prologo-02", slug: "prologo-antonio-morales", title: "Antonio Morales" },
      { id: "prologo-03", slug: "prologo-carolina-darias", title: "Carolina Darias" },
      { id: "prologo-04", slug: "prologo-poli-suarez", title: "Poli Suárez" },
      { id: "prologo-05", slug: "prologo-carla-campoamor", title: "Carla Campoamor" },
      { id: "prologo-06", slug: "prologo-felipe-pascual", title: "Felipe Pascual" },
      { id: "prologo-07", slug: "prologo-roberto-melian", title: "Roberto Melián" },
      { id: "prologo-08", slug: "prologo-eduardo-ramirez", title: "Eduardo Ramírez" },
      { id: "prologo-09", slug: "prologo-09", title: "Nombre, cargo" },
      { id: "prologo-10", slug: "prologo-10", title: "Nombre, cargo" },
    ]
  },
  { 
    id: "capitulo-02", 
    slug: "capitulo-02", 
    title: "Del patio del colegio a la División de Honor", 
    number: "02",
    // Example hero config - can be set per chapter
    hero: {
      backgroundImage: heroImage,
      backgroundOverlay: "rgba(212, 175, 55, 0.85)",
      icon: "star",
      iconColor: "#1a237e",
      alignment: "right",
      verticalPosition: "center",
      titleLines: [
        { text: "DEL PATIO", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "DEL COLEGIO", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "A LA DIVISIÓN", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "DE HONOR", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    }
  },
  { id: "capitulo-03", slug: "capitulo-03", title: "Así se forjó una leyenda", number: "03" },
  { id: "capitulo-04", slug: "capitulo-04", title: "Una transición dolorosa", number: "04" },
  { id: "capitulo-05", slug: "capitulo-05", title: "Vuelve el gran Guaguas", number: "05" },
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
  "capitulo-01": (
    <>
      <p>
        Este capítulo reúne las palabras de las personalidades más destacadas del ámbito deportivo, político e institucional que han acompañado al CV Guaguas en su extraordinaria trayectoria. Sus testimonios reflejan el impacto del club en la sociedad canaria y en el voleibol español.
      </p>
      <EditorialQuote author="Club Voleibol Guaguas">
        "Más que un club, una familia. Más que voleibol, pasión por nuestra tierra."
      </EditorialQuote>
    </>
  ),
  "prologo-fernando-clavijo": (
    <>
      <p>
        <strong>Fernando Clavijo</strong>, presidente del Gobierno de Canarias.
      </p>
      <p>
        El CV Guaguas representa el espíritu de superación y excelencia que caracteriza a nuestra tierra. Desde el Gobierno de Canarias celebramos cada uno de sus éxitos como propios, conscientes de que este club ha puesto a nuestras islas en lo más alto del voleibol nacional e internacional.
      </p>
    </>
  ),
  "prologo-antonio-morales": (
    <>
      <p>
        <strong>Antonio Morales</strong>, presidente del Cabildo de Gran Canaria.
      </p>
      <p>
        Para el Cabildo de Gran Canaria es un orgullo contar con un club que ha sabido conjugar la pasión por el deporte con los valores de trabajo en equipo, dedicación y humildad. El CV Guaguas es un embajador excepcional de nuestra isla.
      </p>
    </>
  ),
  "prologo-carolina-darias": (
    <>
      <p>
        <strong>Carolina Darias</strong>, alcaldesa de Las Palmas de Gran Canaria.
      </p>
      <p>
        Las Palmas de Gran Canaria tiene en el CV Guaguas a uno de sus más ilustres representantes deportivos. Este club ha llenado de alegría a generaciones de grancanarios y continúa siendo un referente de excelencia en el deporte de nuestra ciudad.
      </p>
    </>
  ),
  "prologo-poli-suarez": (
    <>
      <p>
        <strong>Poli Suárez</strong>, consejero de Deportes del Gobierno de Canarias.
      </p>
      <p>
        El éxito del CV Guaguas no es casualidad. Es el resultado de años de trabajo, planificación y amor por este deporte. Desde la Consejería de Deportes aplaudimos la labor de este club que ha convertido el voleibol en una seña de identidad de Canarias.
      </p>
    </>
  ),
  "prologo-carla-campoamor": (
    <>
      <p>
        <strong>Carla Campoamor</strong>, concejala de Deportes del Ayuntamiento de Las Palmas de Gran Canaria.
      </p>
      <p>
        El CV Guaguas ha demostrado que con esfuerzo y dedicación se pueden alcanzar las más altas metas. Es un orgullo para nuestra ciudad contar con un club que representa los valores del deporte en su máxima expresión.
      </p>
    </>
  ),
  "prologo-felipe-pascual": (
    <>
      <p>
        <strong>Felipe Pascual</strong>, presidente de la Real Federación Española de Voleibol.
      </p>
      <p>
        El CV Guaguas se ha consolidado como uno de los clubes más importantes del voleibol español. Su trayectoria, sus títulos y su compromiso con la formación de jóvenes talentos lo convierten en un modelo a seguir para el resto de clubes de nuestro país.
      </p>
    </>
  ),
  "prologo-roberto-melian": (
    <>
      <p>
        <strong>Roberto Melián</strong>, presidente de la Federación Canaria de Voleibol.
      </p>
      <p>
        Como máximo representante del voleibol en Canarias, puedo afirmar que el CV Guaguas ha sido el motor que ha impulsado este deporte en nuestras islas. Gracias a su ejemplo, el voleibol canario goza hoy de una salud envidiable.
      </p>
    </>
  ),
  "prologo-eduardo-ramirez": (
    <>
      <p>
        <strong>Eduardo Ramírez</strong>, presidente del Consejo de Administración de Guaguas Municipales.
      </p>
      <p>
        Guaguas Municipales se siente orgulloso de dar nombre a este club que tantas alegrías ha proporcionado a los ciudadanos de Las Palmas de Gran Canaria. La asociación entre nuestra empresa y el club refleja el compromiso de ambas instituciones con la ciudad y sus habitantes.
      </p>
    </>
  ),
  "prologo-09": (
    <>
      <p>
        <strong>Nombre</strong>, cargo.
      </p>
      <p>
        Texto del prólogo pendiente de redacción.
      </p>
    </>
  ),
  "prologo-10": (
    <>
      <p>
        <strong>Nombre</strong>, cargo.
      </p>
      <p>
        Texto del prólogo pendiente de redacción.
      </p>
    </>
  ),
  "capitulo-02": (
    <>
      <p>
        Los inicios del voleibol en Gran Canaria se remontan a las canchas improvisadas de los patios escolares, donde jóvenes apasionados descubrieron un deporte que pronto se convertiría en su forma de vida. Desde aquellos primeros partidos entre amigos hasta la llegada a la División de Honor, el camino estuvo lleno de sacrificios y sueños.
      </p>
      <ContentImage 
        src={heroImage} 
        alt="Los inicios del voleibol en Gran Canaria"
        caption="Los primeros pasos del voleibol grancanario en las canchas escolares."
        fullWidth
      />
      <p>
        El crecimiento fue constante, impulsado por la pasión de jugadores, entrenadores y aficionados que veían en cada partido la oportunidad de escribir una nueva página en la historia del deporte canario.
      </p>
      <EditorialQuote>
        "En aquellos patios de colegio nacieron los campeones del mañana. Cada remate, cada bloqueo, forjaba el carácter de quienes harían grande al Guaguas."
      </EditorialQuote>
    </>
  ),
  "capitulo-03": (
    <>
      <p>
        El ascenso del CV Guaguas a las más altas cotas del voleibol español no fue casualidad. Fue el resultado de una planificación meticulosa, de la incorporación de talentos nacionales e internacionales, y de una estructura organizativa que sentó las bases para el éxito sostenido.
      </p>
      <p>
        Los primeros títulos llegaron como recompensa a años de trabajo incansable. Cada trofeo levantado representaba no solo la victoria en una competición, sino la consolidación de un proyecto deportivo sin precedentes en las islas.
      </p>
      <EditorialQuote author="Historia del club">
        "Las leyendas no nacen, se forjan. Y el CV Guaguas forjó la suya punto a punto, set a set, título a título."
      </EditorialQuote>
    </>
  ),
  "capitulo-04": (
    <>
      <p>
        Todo proyecto deportivo atraviesa momentos de incertidumbre. Para el CV Guaguas, la transición entre diferentes etapas supuso enfrentarse a retos que pusieron a prueba la solidez del club y el compromiso de quienes lo conforman.
      </p>
      <p>
        Los cambios en la dirección deportiva, las dificultades económicas y la renovación generacional fueron obstáculos que, lejos de debilitar al club, lo fortalecieron. De esa transición dolorosa emergió un Guaguas más maduro y preparado para afrontar nuevos desafíos.
      </p>
      <EditorialQuote>
        "En los momentos más difíciles se demuestra la verdadera fortaleza de un club. El Guaguas no solo sobrevivió, renació con más fuerza."
      </EditorialQuote>
    </>
  ),
  "capitulo-05": (
    <>
      <p>
        El regreso del gran Guaguas marcó el inicio de una nueva era dorada. Con una plantilla renovada, una afición entregada y una estructura consolidada, el club volvió a conquistar los títulos más importantes del voleibol español.
      </p>
      <ContentImage 
        src={heroImage} 
        alt="El CV Guaguas celebrando un título"
        caption="La afición del Gran Canaria Arena celebra un nuevo título del CV Guaguas."
        fullWidth
      />
      <p>
        La Copa del Rey, la Superliga y la Supercopa volvieron a lucir en las vitrinas del club, recordando a todos que el Guaguas había vuelto para quedarse en lo más alto del voleibol nacional.
      </p>
      <EditorialQuote author="Afición del CV Guaguas">
        "¡Vuelve el gran Guaguas! Con la fuerza de siempre, con la pasión de una isla entera."
      </EditorialQuote>
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
      <InstitutionalFooter />
    </div>
  );
};

export default Chapter;
