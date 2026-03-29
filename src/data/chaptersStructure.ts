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
import imgJoseMillanHero from "@/assets/1cap_pati_photo_24.jpg";
import imgPericlesHero from "@/assets/cap1_pericles_hero.jpg";

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
      { id: "cap01-los-origenes", slug: "cap01-los-origenes", title: "Los orígenes" },
      { id: "cap02-felipe-nuez", slug: "cap02-felipe-nuez", title: "Felipe Nuez" },
      { id: "cap02-jose-miguel-santana", slug: "cap02-jose-miguel-santana", title: "José Miguel Santana" },
      { id: "cap02-florencio-tejera", slug: "cap02-florencio-tejera", title: "Florencio Tejera" },
      { id: "cap02-tony-vazquez", slug: "cap02-tony-vazquez", title: "Tony Vázquez" },
      { id: "cap02-isidro-quintana", slug: "cap02-isidro-quintana", title: "Isidro Quintana" },
      { id: "cap02-pericles", slug: "cap02-pericles", title: "Pericles",
        hero: {
          backgroundImage: imgPericlesHero,
          backgroundOverlay: "rgba(0, 0, 0, 0.4)",
          icon: "none",
          alignment: "center",
          verticalPosition: "bottom",
          height: "500px",
          titleFontWeight: "black",
          titleLines: [
            { text: "PERICLES", color: "hsl(220 50% 12%)", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
          ],
        },
      },
      { id: "cap02-jose-millan", slug: "cap02-jose-millan", title: "José Millán",
        hero: {
          backgroundImage: imgJoseMillanHero,
          backgroundOverlay: "rgba(0, 0, 0, 0.4)",
          icon: "none",
          alignment: "center",
          verticalPosition: "bottom",
          height: "500px",
          titleFontWeight: "black",
          titleLines: [
            { text: "JOSÉ", color: "hsl(220 50% 12%)", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
            { text: "MILLÁN", color: "hsl(220 50% 12%)", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
          ],
        },
      },
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
        { text: "ESTATUTOS", color: "hsl(220 50% 12%)", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
        { text: "FUNDACIONALES", color: "hsl(220 50% 12%)", highlightColor: "hsl(45 100% 50%)", fontWeight: "black" },
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
      { id: "cap04-cronologia", slug: "cap04-cronologia", title: "La cronología" },
    ]
  },
  { 
    id: "capitulo-04", 
    slug: "capitulo-04", 
    title: "El proyecto visionario de Juan Ruiz", 
    number: "04",
    hero: {
      backgroundImage: heroMatch,
      backgroundOverlay: "rgba(26, 35, 126, 0.85)",
      customIconSrc: starGold,
      iconWidth: 60,
      iconHeight: 60,
      alignment: "center",
      verticalPosition: "center",
      height: "450px",
      titleFontWeight: "black",
      titleLines: [
        { text: "EL PROYECTO", color: "#D4AF37", highlightColor: "transparent", fontWeight: "black" },
        { text: "VISIONARIO", color: "#FFFFFF", highlightColor: "transparent" },
        { text: "DE JUAN RUIZ", color: "#D4AF37", highlightColor: "transparent" },
      ],
    },
  },
  { 
    id: "capitulo-05", 
    slug: "capitulo-05", 
    title: "Iconos y estrellas del Guaguas", 
    number: "05",
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
      { id: "cap06-camarero", slug: "cap06-camarero", title: "Sergio Miguel Camarero" },
      { id: "cap06-sanchez-jover", slug: "cap06-sanchez-jover", title: "Paco Sánchez Jover" },
      { id: "cap06-golec", slug: "cap06-golec", title: "Waclaw Golec" },
      { id: "cap06-klos", slug: "cap06-klos", title: "Ireneusz Klos" },
    ]
  },
  { 
    id: "capitulo-06", 
    slug: "capitulo-06", 
    title: "Ignacio Brito y Tributo a los Salesianos", 
    number: "06",
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
    id: "capitulo-07", 
    slug: "capitulo-07", 
    title: "Marek", 
    number: "07",
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
    id: "capitulo-08", 
    slug: "capitulo-08", 
    title: "Embajadores por Europa", 
    number: "08",
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
      { id: "cap09-manuel-palacios", slug: "cap09-manuel-palacios", title: "Manuel Palacios" },
      { id: "cap09-antonio-benitez", slug: "cap09-antonio-benitez", title: "Antonio Benítez" },
      { id: "cap09-jorge-ramon", slug: "cap09-jorge-ramon", title: "Jorge Ramón" },
      { id: "cap09-juanma-martin", slug: "cap09-juanma-martin", title: "Juanma Martín" },
      { id: "cap09-oscar-campos", slug: "cap09-oscar-campos", title: "Óscar Campos" },
      { id: "cap09-venancio-acosta", slug: "cap09-venancio-acosta", title: "Venancio Acosta" },
      { id: "cap09-antonio-miralles", slug: "cap09-antonio-miralles", title: "Antonio Miralles" },
      { id: "cap09-chava-gonzalez", slug: "cap09-chava-gonzalez", title: "Chava González" },
      { id: "cap09-sandeep-sharma", slug: "cap09-sandeep-sharma", title: "Sandeep Sharma" },
      { id: "cap09-juan-jose-cardona", slug: "cap09-juan-jose-cardona", title: "Juan José Cardona" },
    ]
  },
  { 
    id: "capitulo-09", 
    slug: "capitulo-09", 
    title: "Relevo generacional", 
    number: "09",
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
      { id: "cap10-alexis-valido", slug: "cap10-alexis-valido", title: "Alexis Valido" },
      { id: "cap10-antonio-sanchez", slug: "cap10-antonio-sanchez", title: "Antonio Sánchez" },
      { id: "cap10-daniel-castaneda", slug: "cap10-daniel-castaneda", title: "Daniel Castañeda" },
      { id: "cap10-juan-carlos-vega", slug: "cap10-juan-carlos-vega", title: "Juan Carlos Vega" },
      { id: "cap10-hermanos-cabrera", slug: "cap10-hermanos-cabrera", title: "Hermanos Cabrera" },
      { id: "cap10-nichel-gomez", slug: "cap10-nichel-gomez", title: "Níchel Gómez" },
      { id: "cap10-raul-davila", slug: "cap10-raul-davila", title: "Raúl Dávila" },
    ]
  },
  { 
    id: "capitulo-10", 
    slug: "capitulo-10", 
    title: "Una transición dolorosa", 
    number: "10",
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
      { id: "cap11-traspaso-poderes", slug: "cap11-traspaso-poderes", title: "Juan Ruiz traspasa sus poderes" },
      { id: "cap11-estabilidad-imposible", slug: "cap11-estabilidad-imposible", title: "La estabilidad imposible" },
      { id: "cap11-camino-2009", slug: "cap11-camino-2009", title: "Camino del fatídico 2009" },
      { id: "cap11-peor-desenlace", slug: "cap11-peor-desenlace", title: "El peor desenlace posible" },
      { id: "cap11-cronologia", slug: "cap11-cronologia", title: "La cronología" },
      { id: "cap11-david-rodriguez", slug: "cap11-david-rodriguez", title: "David Rodríguez" },
      { id: "cap11-joel-sotelo", slug: "cap11-joel-sotelo", title: "Joel Sotelo" },
      { id: "cap11-pedro-cuarental", slug: "cap11-pedro-cuarental", title: "Pedro Cuarental" },
      { id: "cap11-marcos-dreyer", slug: "cap11-marcos-dreyer", title: "Marcos Dreyer" },
    ]
  },
  { 
    id: "capitulo-11", 
    slug: "capitulo-11", 
    title: "Todos los títulos", 
    number: "11",
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
      { id: "cap12-joselu-sanchez", slug: "cap12-joselu-sanchez", title: "Joselu Sánchez" },
    ]
  },
  { 
    id: "capitulo-12", 
    slug: "capitulo-12", 
    title: "Vuelve el gran Guaguas", 
    number: "12",
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
      { id: "cap13-aclamacion", slug: "cap13-aclamacion", title: "Un paso por aclamación" },
      { id: "cap13-presidentes", slug: "cap13-presidentes", title: "Presidentes" },
      { id: "cap13-entrenadores", slug: "cap13-entrenadores", title: "Entrenadores" },
    ]
  },
  { 
    id: "capitulo-13", 
    slug: "capitulo-13", 
    title: "Del CID al Arenas", 
    number: "13",
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
    id: "capitulo-14", 
    slug: "capitulo-14", 
    title: "Los nuevos ídolos", 
    number: "14",
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
      { id: "cap15-kukartsev", slug: "cap15-kukartsev", title: "Pablo Kukartsev" },
      { id: "cap15-moises-cezar", slug: "cap15-moises-cezar", title: "Moisés Cézar" },
    ]
  },
  { 
    id: "capitulo-15", 
    slug: "capitulo-15", 
    title: "El impacto del escudo", 
    number: "15",
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
    id: "capitulo-16", 
    slug: "capitulo-16", 
    title: "La directiva", 
    number: "16",
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
    id: "capitulo-17", 
    slug: "capitulo-17", 
    title: "El Guaguas que viene", 
    number: "17",
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
    id: "capitulo-18", 
    slug: "capitulo-18", 
    title: "Empleados y técnicos", 
    number: "18",
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
    id: "capitulo-19", 
    slug: "capitulo-19", 
    title: "La plantilla del cincuentenario", 
    number: "19",
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
    id: "capitulo-20", 
    slug: "capitulo-20", 
    title: "Miguel Ángel Ramírez", 
    number: "20",
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
    id: "capitulo-21", 
    slug: "capitulo-21", 
    title: "Comunicación digital", 
    number: "21",
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
    id: "capitulo-22", 
    slug: "capitulo-22", 
    title: "Socios y abonados", 
    number: "22",
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
    id: "capitulo-23", 
    slug: "capitulo-23", 
    title: "Empresarios de la tierra", 
    number: "23",
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
