import { ChapterItem } from "@/components/SidebarIndex";
import { ChapterHeroProps, TitleLine } from "@/components/ChapterHero";
import heroImage from "@/assets/hero-stadium.jpg";
import starGold from "@/assets/star-gold.png";

export interface ChapterItemWithHero extends ChapterItem {
  hero?: Omit<ChapterHeroProps, 'titleLines'> & {
    titleLines: TitleLine[];
    customIconColor?: string;
  };
}

export const chaptersData: ChapterItemWithHero[] = [
  { 
    id: "capitulo-01", 
    slug: "capitulo-01",
    title: "Prólogos", 
    number: "01",
    children: [
      { id: "prologo-01", slug: "prologo-fernando-clavijo", title: "Fernando Clavijo" },
      { id: "prologo-02", slug: "prologo-antonio-morales", title: "Antonio Morales" },
      { id: "prologo-03", slug: "prologo-carolina-darias", title: "Carolina Darias" },
      { id: "prologo-04", slug: "prologo-roberto-melian", title: "Roberto Melián" },
      { id: "prologo-05", slug: "prologo-jorge-almansa", title: "Jorge Almansa" },
      { id: "prologo-06", slug: "prologo-juan-ruiz", title: "Juan Ruiz" },
    ]
  },
  { 
    id: "capitulo-02", 
    slug: "capitulo-02", 
    title: "Del patio del colegio a División de Honor", 
    number: "02",
    hero: {
      backgroundImage: heroImage,
      backgroundOverlay: "rgba(212, 175, 55, 0.85)",
      customIconSrc: starGold,
      iconWidth: 80,
      iconHeight: 80,
      alignment: "right",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "DEL PATIO", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "DEL COLEGIO", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "A LA DIVISIÓN", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "DE HONOR", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
    children: [
      { id: "cap02-francisco-rodriguez", slug: "cap02-francisco-rodriguez", title: "Las horas extraescolares con Francisco Rodríguez" },
      { id: "cap02-silvestre-cabrera", slug: "cap02-silvestre-cabrera", title: "Silvestre Cabrera y el salto cualitativo" },
      { id: "cap02-seleccion-cadete", slug: "cap02-seleccion-cadete", title: "La selección cadete con Felipe Nuez" },
      { id: "cap02-estatutos-despegue", slug: "cap02-estatutos-despegue", title: "Estatutos fundacionales y despegue" },
      { id: "cap02-ascenso-1979", slug: "cap02-ascenso-1979", title: "El ascenso a Segunda División de 1979" },
      { id: "cap02-acceso-elite", slug: "cap02-acceso-elite", title: "El acceso a la élite" },
      { id: "cap02-cronologia", slug: "cap02-cronologia", title: "La cronología" },
      { id: "cap02-felipe-nuez", slug: "cap02-felipe-nuez", title: "Felipe Nuez" },
      { id: "cap02-jose-miguel-santana", slug: "cap02-jose-miguel-santana", title: "José Miguel Santana" },
      { id: "cap02-florencio-tejera", slug: "cap02-florencio-tejera", title: "Florencio Tejera" },
      { id: "cap02-tony-vazquez", slug: "cap02-tony-vazquez", title: "Tony Vázquez" },
      { id: "cap02-isidro-quintana", slug: "cap02-isidro-quintana", title: "Isidro Quintana" },
      { id: "cap02-pericles", slug: "cap02-pericles", title: "Pericles" },
      { id: "cap02-jose-millan", slug: "cap02-jose-millan", title: "José Millán" },
      { id: "cap02-miriam-quiroga", slug: "cap02-miriam-quiroga", title: "Miriam Quiroga" },
    ]
  },
  { 
    id: "capitulo-03", 
    slug: "capitulo-03", 
    title: "Estatutos Fundacionales", 
    number: "03" 
  },
  { 
    id: "capitulo-04", 
    slug: "capitulo-04", 
    title: "Así se forjó una leyenda", 
    number: "04",
    children: [
      { id: "cap04-elite", slug: "cap04-elite", title: "Llegar a la élite para quedarse" },
      { id: "cap04-fichajes", slug: "cap04-fichajes", title: "Fichajes de impacto y hegemonía" },
      { id: "cap04-salida-ruiz", slug: "cap04-salida-ruiz", title: "La salida de Juan Ruiz, principio del fin" },
    ]
  },
  { 
    id: "capitulo-05", 
    slug: "capitulo-05", 
    title: "El proyecto visionario de Juan Ruiz", 
    number: "05" 
  },
  { 
    id: "capitulo-06", 
    slug: "capitulo-06", 
    title: "Iconos y estrellas del Guaguas", 
    number: "06",
    children: [
      { id: "cap06-camarero", slug: "cap06-camarero", title: "Sergio Miguel Camarero" },
      { id: "cap06-sanchez-jover", slug: "cap06-sanchez-jover", title: "Paco Sánchez Jover" },
      { id: "cap06-golec", slug: "cap06-golec", title: "Waclaw Golec" },
      { id: "cap06-klos", slug: "cap06-klos", title: "Ireneusz Klos" },
    ]
  },
  { id: "capitulo-07", slug: "capitulo-07", title: "Ignacio Brito y Tributo a los Salesianos", number: "07" },
  { id: "capitulo-08", slug: "capitulo-08", title: "Marek", number: "08" },
  { id: "capitulo-09", slug: "capitulo-09", title: "Embajadores por Europa", number: "09" },
  { id: "capitulo-10", slug: "capitulo-10", title: "Relevo generacional", number: "10" },
  { id: "capitulo-11", slug: "capitulo-11", title: "Una transición dolorosa", number: "11" },
  { id: "capitulo-12", slug: "capitulo-12", title: "Todos los títulos", number: "12" },
  { id: "capitulo-13", slug: "capitulo-13", title: "Vuelve el gran Guaguas", number: "13" },
  { id: "capitulo-14", slug: "capitulo-14", title: "Del CID al Arenas", number: "14" },
  { id: "capitulo-15", slug: "capitulo-15", title: "Los nuevos ídolos", number: "15" },
  { id: "capitulo-16", slug: "capitulo-16", title: "El impacto del escudo", number: "16" },
  { id: "capitulo-17", slug: "capitulo-17", title: "La directiva", number: "17" },
  { id: "capitulo-18", slug: "capitulo-18", title: "El Guaguas que viene", number: "18" },
  { id: "capitulo-19", slug: "capitulo-19", title: "Empleados y técnicos", number: "19" },
  { id: "capitulo-20", slug: "capitulo-20", title: "La plantilla del cincuentenario", number: "20" },
  { id: "capitulo-21", slug: "capitulo-21", title: "Miguel Ángel Ramírez", number: "21" },
  { id: "capitulo-22", slug: "capitulo-22", title: "Comunicación digital", number: "22" },
  { id: "capitulo-23", slug: "capitulo-23", title: "Socios y abonados", number: "23" },
  { id: "capitulo-24", slug: "capitulo-24", title: "Empresarios de la tierra", number: "24" },
];

// Helper to find chapter by slug
export const getAllChapters = (): ChapterItemWithHero[] => {
  const all: ChapterItemWithHero[] = [];
  chaptersData.forEach(ch => {
    all.push(ch);
    if (ch.children) {
      ch.children.forEach(child => all.push(child as ChapterItemWithHero));
    }
  });
  return all;
};

export const getChapterBySlug = (slug: string): ChapterItemWithHero | undefined => 
  getAllChapters().find(ch => ch.slug === slug);
