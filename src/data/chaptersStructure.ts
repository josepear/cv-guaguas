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
      { id: "cap04-proyecto-juan-ruiz", slug: "cap04-proyecto-juan-ruiz", title: "El proyecto visionario de Juan Ruiz" },
    ]
  },
  { 
    id: "capitulo-05", 
    slug: "capitulo-05", 
    title: "Iconos y estrellas del Guaguas", 
    number: "05",
    children: [
      { id: "cap05-camarero", slug: "cap05-camarero", title: "Sergio Miguel Camarero" },
      { id: "cap05-sanchez-jover", slug: "cap05-sanchez-jover", title: "Paco Sánchez Jover" },
      { id: "cap05-golec", slug: "cap05-golec", title: "Waclaw Golec" },
      { id: "cap05-klos", slug: "cap05-klos", title: "Ireneusz Klos" },
    ]
  },
  { 
    id: "capitulo-06", 
    slug: "capitulo-06", 
    title: "Ignacio Brito y Tributo a los Salesianos", 
    number: "06" 
  },
  { 
    id: "capitulo-07", 
    slug: "capitulo-07", 
    title: "Marek", 
    number: "07" 
  },
  { 
    id: "capitulo-08", 
    slug: "capitulo-08", 
    title: "Embajadores por Europa", 
    number: "08",
    children: [
      { id: "cap08-manuel-palacios", slug: "cap08-manuel-palacios", title: "Manuel Palacios" },
      { id: "cap08-antonio-benitez", slug: "cap08-antonio-benitez", title: "Antonio Benítez" },
      { id: "cap08-jorge-ramon", slug: "cap08-jorge-ramon", title: "Jorge Ramón" },
      { id: "cap08-juanma-martin", slug: "cap08-juanma-martin", title: "Juanma Martín" },
      { id: "cap08-oscar-campos", slug: "cap08-oscar-campos", title: "Óscar Campos" },
      { id: "cap08-venancio-acosta", slug: "cap08-venancio-acosta", title: "Venancio Acosta" },
      { id: "cap08-antonio-miralles", slug: "cap08-antonio-miralles", title: "Antonio Miralles" },
      { id: "cap08-chava-gonzalez", slug: "cap08-chava-gonzalez", title: "Chava González" },
      { id: "cap08-sandeep-sharma", slug: "cap08-sandeep-sharma", title: "Sandeep Sharma" },
      { id: "cap08-juan-jose-cardona", slug: "cap08-juan-jose-cardona", title: "Juan José Cardona" },
    ]
  },
  { 
    id: "capitulo-09", 
    slug: "capitulo-09", 
    title: "Relevo generacional", 
    number: "09",
    children: [
      { id: "cap09-alexis-valido", slug: "cap09-alexis-valido", title: "Alexis Valido" },
      { id: "cap09-antonio-sanchez", slug: "cap09-antonio-sanchez", title: "Antonio Sánchez" },
      { id: "cap09-daniel-castaneda", slug: "cap09-daniel-castaneda", title: "Daniel Castañeda" },
      { id: "cap09-juan-carlos-vega", slug: "cap09-juan-carlos-vega", title: "Juan Carlos Vega" },
      { id: "cap09-hermanos-cabrera", slug: "cap09-hermanos-cabrera", title: "Hermanos Cabrera" },
      { id: "cap09-nichel-gomez", slug: "cap09-nichel-gomez", title: "Níchel Gómez" },
      { id: "cap09-raul-davila", slug: "cap09-raul-davila", title: "Raúl Dávila" },
    ]
  },
  { 
    id: "capitulo-10", 
    slug: "capitulo-10", 
    title: "Una transición dolorosa", 
    number: "10",
    children: [
      { id: "cap10-traspaso-poderes", slug: "cap10-traspaso-poderes", title: "Juan Ruiz traspasa sus poderes" },
      { id: "cap10-estabilidad-imposible", slug: "cap10-estabilidad-imposible", title: "La estabilidad imposible" },
      { id: "cap10-camino-2009", slug: "cap10-camino-2009", title: "Camino del fatídico 2009" },
      { id: "cap10-peor-desenlace", slug: "cap10-peor-desenlace", title: "El peor desenlace posible" },
      { id: "cap10-cronologia", slug: "cap10-cronologia", title: "La cronología" },
      { id: "cap10-david-rodriguez", slug: "cap10-david-rodriguez", title: "David Rodríguez" },
      { id: "cap10-joel-sotelo", slug: "cap10-joel-sotelo", title: "Joel Sotelo" },
      { id: "cap10-pedro-cuarental", slug: "cap10-pedro-cuarental", title: "Pedro Cuarental" },
      { id: "cap10-marcos-dreyer", slug: "cap10-marcos-dreyer", title: "Marcos Dreyer" },
    ]
  },
  { 
    id: "capitulo-11", 
    slug: "capitulo-11", 
    title: "Todos los títulos", 
    number: "11",
    children: [
      { id: "cap11-joselu-sanchez", slug: "cap11-joselu-sanchez", title: "Joselu Sánchez" },
    ]
  },
  { 
    id: "capitulo-12", 
    slug: "capitulo-12", 
    title: "Vuelve el gran Guaguas", 
    number: "12",
    children: [
      { id: "cap12-aclamacion", slug: "cap12-aclamacion", title: "Un paso por aclamación" },
      { id: "cap12-presidentes", slug: "cap12-presidentes", title: "Presidentes" },
      { id: "cap12-entrenadores", slug: "cap12-entrenadores", title: "Entrenadores" },
    ]
  },
  { 
    id: "capitulo-13", 
    slug: "capitulo-13", 
    title: "Del CID al Arenas", 
    number: "13" 
  },
  { 
    id: "capitulo-14", 
    slug: "capitulo-14", 
    title: "Los nuevos ídolos", 
    number: "14",
    children: [
      { id: "cap14-kukartsev", slug: "cap14-kukartsev", title: "Pablo Kukartsev" },
      { id: "cap14-moises-cezar", slug: "cap14-moises-cezar", title: "Moisés Cézar" },
    ]
  },
  { id: "capitulo-15", slug: "capitulo-15", title: "El impacto del escudo", number: "15" },
  { id: "capitulo-16", slug: "capitulo-16", title: "La directiva", number: "16" },
  { id: "capitulo-17", slug: "capitulo-17", title: "El Guaguas que viene", number: "17" },
  { id: "capitulo-18", slug: "capitulo-18", title: "Empleados y técnicos", number: "18" },
  { id: "capitulo-19", slug: "capitulo-19", title: "La plantilla del cincuentenario", number: "19" },
  { id: "capitulo-20", slug: "capitulo-20", title: "Miguel Ángel Ramírez", number: "20" },
  { id: "capitulo-21", slug: "capitulo-21", title: "Comunicación digital", number: "21" },
  { id: "capitulo-22", slug: "capitulo-22", title: "Socios y abonados", number: "22" },
  { id: "capitulo-23", slug: "capitulo-23", title: "Empresarios de la tierra", number: "23" },
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
