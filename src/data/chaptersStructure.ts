import { ChapterItem } from "@/components/SidebarIndex";
import { ChapterHeroProps, TitleLine } from "@/components/ChapterHero";
import heroStadium from "@/assets/hero-stadium.jpg";
import starGold from "@/assets/star-gold.png";
import estrellaIcon from "@/assets/estrella-icon.svg";
import heroPatio from "@/assets/hero-patio-colegio.jpg";
import heroEstatutos from "@/assets/hero-estatutos.jpg";
import heroMatch from "@/assets/hero-volleyball-match.jpg";
import heroTrophies from "@/assets/hero-trophies.jpg";
import heroEuropa from "@/assets/hero-europa.jpg";
import heroCantera from "@/assets/hero-cantera.jpg";
import heroTransicion from "@/assets/hero-transicion.jpg";
import heroCelebracion from "@/assets/hero-celebracion.jpg";

// Prologue photos
import imgClavijo from "@/assets/prologues/fernando-clavijo.jpg";
import imgMorales from "@/assets/prologues/antonio-morales.jpg";
import imgRuiz from "@/assets/prologues/juan-ruiz.jpg";
import imgSuarez from "@/assets/prologues/poli-suarez.jpg";
import imgRomero from "@/assets/prologues/aridany-romero.jpg";
import imgDarias from "@/assets/prologues/carolina-darias.jpg";
import imgMelian from "@/assets/prologues/roberto-melian.jpg";
import imgAlmansa from "@/assets/prologues/jorge-almansa.jpg";

export interface ChapterItemWithHero extends Omit<ChapterItem, 'children'> {
  hero?: Omit<ChapterHeroProps, 'titleLines'> & {
    titleLines: TitleLine[];
    customIconColor?: string;
  };
  isPrologue?: boolean;
  prologueImage?: string;
  prologueImagePosition?: string;
  prologueImageScale?: number;
  children?: ChapterItemWithHero[];
}

export const chaptersData: ChapterItemWithHero[] = [
  { 
    id: "capitulo-00", 
    slug: "capitulo-00",
    title: "Prólogos", 
    number: "0",
    hero: {
      backgroundImage: heroStadium,
      backgroundOverlay: "rgba(26, 35, 126, 0.88)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "center",
      verticalPosition: "center",
      height: "400px",
      titleFontWeight: "bold",
      titleLines: [
        { text: "PRÓLOGOS", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
      ],
    },
    children: [
      { id: "prologo-01", slug: "prologo-fernando-clavijo", title: "Fernando Clavijo", subtitle: "Presidente del Gobierno de Canarias", isPrologue: true, prologueImage: imgClavijo, prologueImagePosition: "center 15%" },
      { id: "prologo-02", slug: "prologo-antonio-morales", title: "Antonio Morales", subtitle: "Presidente del Cabildo de Gran Canaria", isPrologue: true, prologueImage: imgMorales, prologueImagePosition: "center 20%" },
      { id: "prologo-03", slug: "prologo-juan-ruiz", title: "Juan Ruiz", subtitle: "Presidente del CV Guaguas", isPrologue: true, prologueImage: imgRuiz, prologueImagePosition: "70% 25px", prologueImageScale: 2 },
      { id: "prologo-04", slug: "prologo-poli-suarez", title: "Poli Suárez", subtitle: "Consejero de Deportes del Gobierno de Canarias", isPrologue: true, prologueImage: imgSuarez, prologueImagePosition: "center 15%" },
      { id: "prologo-05", slug: "prologo-aridany-romero", title: "Aridany Romero", subtitle: "Consejero de Deportes del Cabildo de Gran Canaria", isPrologue: true, prologueImage: imgRomero, prologueImagePosition: "center 20%" },
      { id: "prologo-06", slug: "prologo-carolina-darias", title: "Carolina Darias", subtitle: "Alcaldesa de Las Palmas de Gran Canaria", isPrologue: true, prologueImage: imgDarias, prologueImagePosition: "center 20%" },
      { id: "prologo-07", slug: "prologo-roberto-melian", title: "Roberto Melián", subtitle: "Presidente de la Federación Canaria de Voleibol", isPrologue: true, prologueImage: imgMelian, prologueImagePosition: "-15px -15%", prologueImageScale: 2 },
      { id: "prologo-08", slug: "prologo-jorge-almansa", title: "Jorge Almansa", subtitle: "Capitán del CV Guaguas", isPrologue: true, prologueImage: imgAlmansa, prologueImagePosition: "3px -150%", prologueImageScale: 2 },
    ]
  },
  { 
    id: "capitulo-01", 
    slug: "capitulo-01", 
    title: "Del patio del colegio a División de Honor", 
    number: "01",
    hero: {
      backgroundImage: heroPatio,
      backgroundOverlay: "rgba(212, 175, 55, 0.82)",
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
    id: "capitulo-02", 
    slug: "capitulo-02", 
    title: "Los Estatutos Fundacionales", 
    number: "02",
    hero: {
      backgroundImage: heroEstatutos,
      backgroundOverlay: "rgba(0, 0, 0, 0.15)",
      customIconSrc: estrellaIcon,
      customIconColor: "hsl(45 100% 50%)",
      iconWidth: 40,
      iconHeight: 40,
      alignment: "center",
      verticalPosition: "center",
      height: "500px",
      borderColor: "hsl(45 100% 50%)",
      titleFontWeight: "black",
      titleLines: [
        { text: "ESTATUTOS", color: "#1a1a1a", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
        { text: "FUNDACIONALES", color: "#1a1a1a", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
      ],
    },
  },
  { 
    id: "capitulo-03", 
    slug: "capitulo-03", 
    title: "Así se forjó una leyenda", 
    number: "03",
    hero: {
      backgroundImage: heroMatch,
      backgroundOverlay: "rgba(26, 35, 126, 0.80)",
      customIconSrc: starGold,
      iconWidth: 70,
      iconHeight: 70,
      alignment: "right",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "ASÍ SE FORJÓ", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "UNA LEYENDA", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
    children: [
      { id: "cap04-elite", slug: "cap04-elite", title: "Llegar a la élite para quedarse" },
      { id: "cap04-fichajes", slug: "cap04-fichajes", title: "Fichajes de impacto y hegemonía" },
      { id: "cap04-salida-ruiz", slug: "cap04-salida-ruiz", title: "La salida de Juan Ruiz, principio del fin" },
      { id: "cap04-proyecto-juan-ruiz", slug: "cap04-proyecto-juan-ruiz", title: "El proyecto visionario de Juan Ruiz" },
    ]
  },
  { 
    id: "capitulo-04", 
    slug: "capitulo-04", 
    title: "Iconos y estrellas del Guaguas", 
    number: "04",
    hero: {
      backgroundImage: heroMatch,
      backgroundOverlay: "rgba(212, 175, 55, 0.85)",
      customIconSrc: starGold,
      iconWidth: 80,
      iconHeight: 80,
      alignment: "center",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "ICONOS Y", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "ESTRELLAS", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "DEL GUAGUAS", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
    children: [
      { id: "cap05-camarero", slug: "cap05-camarero", title: "Sergio Miguel Camarero" },
      { id: "cap05-sanchez-jover", slug: "cap05-sanchez-jover", title: "Paco Sánchez Jover" },
      { id: "cap05-golec", slug: "cap05-golec", title: "Waclaw Golec" },
      { id: "cap05-klos", slug: "cap05-klos", title: "Ireneusz Klos" },
    ]
  },
  { 
    id: "capitulo-05", 
    slug: "capitulo-05", 
    title: "Ignacio Brito y Tributo a los Salesianos", 
    number: "05",
    hero: {
      backgroundImage: heroPatio,
      backgroundOverlay: "rgba(26, 35, 126, 0.85)",
      customIconSrc: starGold,
      iconWidth: 50,
      iconHeight: 50,
      alignment: "left",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "IGNACIO BRITO", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "Y TRIBUTO A", color: "#FFFFFF", highlightColor: "transparent" },
        { text: "LOS SALESIANOS", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-06", 
    slug: "capitulo-06", 
    title: "Marek", 
    number: "06",
    hero: {
      backgroundImage: heroEuropa,
      backgroundOverlay: "rgba(180, 30, 30, 0.80)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "right",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "MAREK", color: "#FFFFFF", highlightColor: "transparent", fontWeight: "black" },
      ],
    },
  },
  { 
    id: "capitulo-07", 
    slug: "capitulo-07", 
    title: "Embajadores por Europa", 
    number: "07",
    hero: {
      backgroundImage: heroEuropa,
      backgroundOverlay: "rgba(26, 35, 126, 0.78)",
      customIconSrc: starGold,
      iconWidth: 70,
      iconHeight: 70,
      alignment: "center",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "EMBAJADORES", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "POR EUROPA", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
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
    id: "capitulo-08", 
    slug: "capitulo-08", 
    title: "Relevo generacional", 
    number: "08",
    hero: {
      backgroundImage: heroCantera,
      backgroundOverlay: "rgba(212, 175, 55, 0.80)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "left",
      verticalPosition: "center",
      height: "480px",
      titleFontWeight: "black",
      titleLines: [
        { text: "RELEVO", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "GENERACIONAL", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
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
    id: "capitulo-09", 
    slug: "capitulo-09", 
    title: "Una transición dolorosa", 
    number: "09",
    hero: {
      backgroundImage: heroTransicion,
      backgroundOverlay: "rgba(0, 0, 0, 0.40)",
      customIconSrc: starGold,
      iconWidth: 50,
      iconHeight: 50,
      alignment: "center",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "UNA TRANSICIÓN", color: "#8faabe", highlightColor: "transparent", fontWeight: "black" },
        { text: "DOLOROSA", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
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
    id: "capitulo-10", 
    slug: "capitulo-10", 
    title: "Todos los títulos", 
    number: "10",
    hero: {
      backgroundImage: heroTrophies,
      backgroundOverlay: "rgba(212, 175, 55, 0.75)",
      customIconSrc: starGold,
      iconWidth: 80,
      iconHeight: 80,
      alignment: "center",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "TODOS", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "LOS TÍTULOS", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
    children: [
      { id: "cap11-joselu-sanchez", slug: "cap11-joselu-sanchez", title: "Joselu Sánchez" },
    ]
  },
  { 
    id: "capitulo-11", 
    slug: "capitulo-11", 
    title: "Vuelve el gran Guaguas", 
    number: "11",
    hero: {
      backgroundImage: heroCelebracion,
      backgroundOverlay: "rgba(26, 35, 126, 0.75)",
      customIconSrc: starGold,
      iconWidth: 70,
      iconHeight: 70,
      alignment: "right",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "VUELVE", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "EL GRAN", color: "#FFFFFF", highlightColor: "transparent" },
        { text: "GUAGUAS", color: "#D4AF37", highlightColor: "transparent" },
      ],
    },
    children: [
      { id: "cap12-aclamacion", slug: "cap12-aclamacion", title: "Un paso por aclamación" },
      { id: "cap12-presidentes", slug: "cap12-presidentes", title: "Presidentes" },
      { id: "cap12-entrenadores", slug: "cap12-entrenadores", title: "Entrenadores" },
    ]
  },
  { 
    id: "capitulo-12", 
    slug: "capitulo-12", 
    title: "Del CID al Arenas", 
    number: "12",
    hero: {
      backgroundImage: heroStadium,
      backgroundOverlay: "rgba(26, 35, 126, 0.82)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "left",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "DEL CID", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "AL ARENAS", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-13", 
    slug: "capitulo-13", 
    title: "Los nuevos ídolos", 
    number: "13",
    hero: {
      backgroundImage: heroMatch,
      backgroundOverlay: "rgba(212, 175, 55, 0.82)",
      customIconSrc: starGold,
      iconWidth: 70,
      iconHeight: 70,
      alignment: "right",
      verticalPosition: "center",
      height: "480px",
      titleFontWeight: "black",
      titleLines: [
        { text: "LOS NUEVOS", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "ÍDOLOS", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
    children: [
      { id: "cap14-kukartsev", slug: "cap14-kukartsev", title: "Pablo Kukartsev" },
      { id: "cap14-moises-cezar", slug: "cap14-moises-cezar", title: "Moisés Cézar" },
    ]
  },
  { 
    id: "capitulo-14", 
    slug: "capitulo-14", 
    title: "El impacto del escudo", 
    number: "14",
    hero: {
      backgroundImage: heroStadium,
      backgroundOverlay: "rgba(212, 175, 55, 0.88)",
      customIconSrc: starGold,
      iconWidth: 90,
      iconHeight: 90,
      alignment: "center",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "EL IMPACTO", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "DEL ESCUDO", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
  },
  { 
    id: "capitulo-15", 
    slug: "capitulo-15", 
    title: "La directiva", 
    number: "15",
    hero: {
      backgroundImage: heroEstatutos,
      backgroundOverlay: "rgba(26, 35, 126, 0.85)",
      customIconSrc: starGold,
      iconWidth: 50,
      iconHeight: 50,
      alignment: "right",
      verticalPosition: "center",
      height: "420px",
      titleFontWeight: "black",
      titleLines: [
        { text: "LA", color: "#FFFFFF", highlightColor: "transparent" },
        { text: "DIRECTIVA", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
      ],
    },
  },
  { 
    id: "capitulo-16", 
    slug: "capitulo-16", 
    title: "El Guaguas que viene", 
    number: "16",
    hero: {
      backgroundImage: heroCantera,
      backgroundOverlay: "rgba(26, 35, 126, 0.80)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "left",
      verticalPosition: "center",
      height: "480px",
      titleFontWeight: "black",
      titleLines: [
        { text: "EL GUAGUAS", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "QUE VIENE", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-17", 
    slug: "capitulo-17", 
    title: "Empleados y técnicos", 
    number: "17",
    hero: {
      backgroundImage: heroStadium,
      backgroundOverlay: "rgba(62, 39, 15, 0.82)",
      customIconSrc: starGold,
      iconWidth: 50,
      iconHeight: 50,
      alignment: "center",
      verticalPosition: "center",
      height: "420px",
      titleFontWeight: "black",
      titleLines: [
        { text: "EMPLEADOS", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "Y TÉCNICOS", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-18", 
    slug: "capitulo-18", 
    title: "La plantilla del cincuentenario", 
    number: "18",
    hero: {
      backgroundImage: heroCelebracion,
      backgroundOverlay: "rgba(212, 175, 55, 0.82)",
      customIconSrc: starGold,
      iconWidth: 70,
      iconHeight: 70,
      alignment: "right",
      verticalPosition: "center",
      height: "500px",
      titleFontWeight: "black",
      titleLines: [
        { text: "LA PLANTILLA", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "DEL", color: "#1a237e", highlightColor: "#FFFFFF" },
        { text: "CINCUENTENARIO", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
  },
  { 
    id: "capitulo-19", 
    slug: "capitulo-19", 
    title: "Miguel Ángel Ramírez", 
    number: "19",
    hero: {
      backgroundImage: heroStadium,
      backgroundOverlay: "rgba(26, 35, 126, 0.85)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "left",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "MIGUEL ÁNGEL", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "RAMÍREZ", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-20", 
    slug: "capitulo-20", 
    title: "Comunicación digital", 
    number: "20",
    hero: {
      backgroundImage: heroMatch,
      backgroundOverlay: "rgba(30, 30, 60, 0.85)",
      customIconSrc: starGold,
      iconWidth: 50,
      iconHeight: 50,
      alignment: "right",
      verticalPosition: "center",
      height: "420px",
      titleFontWeight: "black",
      titleLines: [
        { text: "COMUNICACIÓN", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "DIGITAL", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-21", 
    slug: "capitulo-21", 
    title: "Socios y abonados", 
    number: "21",
    hero: {
      backgroundImage: heroCelebracion,
      backgroundOverlay: "rgba(26, 35, 126, 0.80)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "center",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "SOCIOS Y", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "ABONADOS", color: "#FFFFFF", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-22", 
    slug: "capitulo-22", 
    title: "Empresarios de la tierra", 
    number: "22",
    hero: {
      backgroundImage: heroEstatutos,
      backgroundOverlay: "rgba(212, 175, 55, 0.80)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "left",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "EMPRESARIOS", color: "#1a237e", highlightColor: "#FFFFFF", fontWeight: "black" },
        { text: "DE LA TIERRA", color: "#1a237e", highlightColor: "#FFFFFF" },
      ],
    },
  },
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
