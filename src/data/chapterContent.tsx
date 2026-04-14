import React from "react";
import DropCap from "@/components/DropCap";
import SectionHeader from "@/components/SectionHeader";
import PlayerProfile from "@/components/PlayerProfile";
import EditorialQuote from "@/components/EditorialQuote";
import NewspaperQuote from "@/components/NewspaperQuote";
import ArticleBlock from "@/components/ArticleBlock";
import HighlightText from "@/components/HighlightText";
import TwoColumns from "@/components/TwoColumns";
import FichaDebut from "@/components/FichaDebut";
import { Timeline, TimelineEvent } from "@/components/TimelineEvent";
import { TituloDeportivo, FichaTecnica, Equipo, Narrativa } from "@/components/TituloDeportivo";
import ContentImage from "@/components/ContentImage";

// Content images
import imgEquipoChampions from "@/assets/content/equipo-champions.jpg";
import imgPartidoGuaguas from "@/assets/content/partido-guaguas.jpg";
import imgCopaDelRey from "@/assets/content/copa-del-rey.jpg";
import imgVictoriaGuaguas from "@/assets/content/victoria-guaguas.png";

import imgJugadorAccion from "@/assets/content/jugador-accion.png";
import imgJorgeAlmansa from "@/assets/content/jorge-almansa.png";
import imgOsmanyJuantorena from "@/assets/content/osmany-juantorena.png";
import imgDobromirSaque from "@/assets/content/dobromir-saque.jpg";
import imgEquipoLiga from "@/assets/content/equipo-liga.jpeg";
import imgAugustoColito from "@/assets/content/augusto-colito.jpg";
import imgRemateGuaguas from "@/assets/content/remate-guaguas.png";
import imgBannerEntradas from "@/assets/content/banner-entradas.png";
import imgAugustoPerfil from "@/assets/content/augusto-colito-perfil.png";
import imgWallaSouza from "@/assets/content/walla-souza.png";
import imgIoDeAmo from "@/assets/content/io-de-amo.png";
import imgHelderSpencer from "@/assets/content/helder-spencer.png";
import imgNicoBruno from "@/assets/content/nico-bruno.png";

// Chapter content mapped by slug
export const chapterContent: Record<string, React.ReactNode> = {
  "capitulo-00": (
    <>
      <p>
        Este capítulo reúne las palabras de las personalidades más destacadas del ámbito deportivo, político e institucional que han acompañado al CV Guaguas en su extraordinaria trayectoria. Sus testimonios reflejan el impacto del club en la sociedad canaria y en el voleibol español.
      </p>
      <ContentImage 
        src={imgEquipoChampions} 
        alt="El CV Guaguas en competición europea" 
        caption="El CV Guaguas, embajador del voleibol canario en las competiciones europeas." 
        fullWidth 
      />
      <EditorialQuote author="Club Voleibol Guaguas">
        "Más que un club, una familia. Más que voleibol, pasión por nuestra tierra."
      </EditorialQuote>
    </>
  ),

  "prologo-fernando-clavijo": (
    <>
      <p>Conmemorar el 50 aniversario del Club Voleibol Guaguas es reconocer la trayectoria de una entidad que forma parte de la historia del deporte en Canarias. Desde su fundación en 1976 este club ha construido un proyecto basado en el talento, el esfuerzo y la ambición de competir al más alto nivel.</p>
      <p>Hoy el Club Voleibol Guaguas se ha ganado ser uno de los clubes más reconocidos avalados por una hoja deportiva brillante. Un recorrido que ha situado a Gran Canaria y a todo el archipiélago en el mapa del voleibol estatal e internacional. Precisamente a lo largo de su historia, el Guaguas ha llevado también el nombre de Canarias a las competiciones europeas proyectando el talento y la capacidad del deporte de nuestras islas más allá de nuestras fronteras.</p>
      <p>Pero más allá de los títulos y los logros deportivos, la verdadera dimensión del Club Voleibol Guaguas está en las personas que han formado parte de su historia: jugadores, entrenadores, directivos, patrocinadores y una afición que ha acompañado al equipo durante décadas y que ha hecho del voleibol una de las grandes señas de identidad del deporte en Gran Canaria.</p>
      <p>El club representa valores que definen al deporte y que forman parte también de nuestra forma de entender Canarias: el trabajo constante, el espíritu de superación, el compromiso con un proyecto común y la capacidad de mirar siempre hacia nuevos retos.</p>
      <p>En nombre del Gobierno de Canarias, quiero felicitar al Club Voleibol Guaguas por estos cincuenta años de historia y agradecer su contribución al desarrollo del deporte en nuestras islas. Su trayectoria es motivo de orgullo para toda Canarias y un ejemplo para las nuevas generaciones que ven en el deporte una oportunidad para crecer y soñar.</p>
      <p>Felicidades por este aniversario y por seguir escribiendo una historia que forma ya parte del patrimonio deportivo de Canarias.</p>
    </>
  ),
  "prologo-antonio-morales": (
    <>
      <p>El deporte es emoción o no es nada, apenas un esférico, un movimiento indescifrable. La diferencia radica en la pasión que es capaz de desencadenar a su alrededor. En el caso de Gran Canaria, el voleibol ha sido mucho más que un balón pasando de un lado al otro de la red. Es un vuelo extraordinario y magnético que sigue su curso.</p>
      <p>Y gran parte de este fenómeno se explica a través de la trayectoria del actual CV Guaguas. Su nombre, no en vano, está escrito con letras mayúsculas y doradas en el libro que incluye las páginas más gloriosas del deporte canario. Y la historia, por fortuna, continúa escribiéndose.</p>
      <p>Las gestas del conjunto grancanario convirtieron al viejo Centro Insular de Deportes, ahora inmerso en una profunda remodelación, en una gran caja de resonancia donde latía con toda su fuerza la energía conjunta del equipo y la afición. Pocas veces se ha repetido esta magia en un recinto deportivo en el archipiélago. Los años ochenta y, sobre todo, la década de los noventa del siglo pasado, fueron testigo de veladas que forman parte de la memoria colectiva, absolutamente imborrables de hecho para quienes tuvieron la fortuna de vivirlas vibrando en la grada.</p>
      <p>De ese modo, y prácticamente por contagio, el equipo se transformó en algo más que en un club deportivo que jugaba al voleibol. Se volvió orgullo, identidad, proyección de una isla, en este caso de Gran Canaria, en cantera y en plataforma para promover valores deportivos y sociales. Este fue su set definitivo y su mayor logro.</p>
      <p>El partido continuó tras afrontar un tiempo muerto más largo de lo deseable. Sin embargo, la isla seguía escuchando a lo lejos, en algún lugar, el eco del balón botando sobre las tablas. Esperaba su momento, como un magma que, tarde o temprano, debía volver a aflorar y ocupar su lugar en el paisaje deportivo y social de Gran Canaria.</p>
      <p>El Cabildo de Gran Canaria respaldó el regreso a la élite del actual CV Guaguas aferrado a la importancia de contar con referentes deportivos que hagan de arrastre social para la práctica deportiva y sean embajadores de la manera canaria y grancanaria de afrontar el deporte y la vida desde nuestra doble condición de isla y territorio cosmopolita abierta al mundo en el Atlántico. Y por esos mismos motivos lideramos el apoyo anual a la entidad.</p>
      <p>Podríamos insistir en que se trata del club más laureado de Canarias. Pero sabemos que su mayor triunfo es el vínculo que se ha establecido entre el equipo y la sociedad, de la que surge y a la que representa temporada tras temporada. Estoy seguro de que llegarán nuevos triunfos y tardes de gloria. Pero hay victorias, como el respeto, la admiración y el cariño de tu gente, que brillan mucho más que los trofeos y se prolongan cuando cesa el aplauso y se apagan los focos del pabellón.</p>
    </>
  ),
  "prologo-juan-ruiz": (
    <p>Texto del prólogo pendiente de redacción.</p>
  ),
  "prologo-poli-suarez": (
    <>
      <p>Hoy celebramos el 50.º aniversario del Club Voleibol Guaguas Las Palmas, una entidad que forma parte indiscutible de la historia deportiva de nuestro archipiélago. Medio siglo después de su fundación en el popular barrio de Las Rehoyas, en Las Palmas de Gran Canaria, el Guaguas se ha consolidado por derecho propio como uno de los clubes más laureados de Canarias y como un referente de éxito y ambición en el deporte de nuestra tierra.</p>
      <p>A lo largo de estas cinco décadas, originalmente como Club de Voleibol Calvo Sotelo, denominación con la que nació en 1976, hasta su estructura actual, la institución ha ido cimentando, a base de trabajo y esfuerzo, un envidiable palmarés al alcance de muy pocos. Su colección de títulos crece cada temporada.</p>
      <p>Pero, más allá de los números, que hablan por sí solos, esta efeméride pone en valor además la solidez de un proyecto bien dirigido y capaz de mantenerse en la élite a lo largo de todo este tiempo.</p>
      <p>Además de los innumerables reconocimientos que ha recibido la entidad a lo largo de estos años, desde el Gobierno de Canarias constatamos esta excelencia cuando en 2024 el CV Guaguas Las Palmas fue galardonado como mejor equipo en la primera edición de los Premios al Deporte Canario. Un reconocimiento que, si bien distinguió el éxito de su actualidad en ese momento, supuso también de alguna manera honrar su vasta historia de triunfos y conquistas. Dicho de otra forma, un galardón que simbolizó lo que significa este club en la historia del deporte de nuestra tierra: una referencia y un ejemplo de competitividad.</p>
      <p>A nadie se le esconde que el voleibol en las islas, de gran tradición histórica, vive hoy uno de sus mejores momentos y es referencia a nivel nacional. Y, dentro de ese contexto, el Guaguas es, sin lugar a dudas, su principal referente. Su aportación ha sido determinante para consolidar el prestigio de este deporte en nuestras islas y para situar a Canarias en una posición destacada dentro del panorama del voleibol español e internacional.</p>
      <p>Celebremos, pues, con este libro, su pasado brillante, plagado de grandes momentos y gestas que quedarán en el imaginario colectivo de nuestra gente. Pero, al mismo tiempo, reconozcamos su presente sólido y ambicioso, mirando con confianza a un prometedor porvenir, con la convicción de que el futuro del Guaguas Las Palmas seguirá estando marcado por el éxito. Un cincuentenario que refleja memoria pero, al mismo tiempo, continuidad y esperanza. A por otros cincuenta. ¡Felicidades, Guaguas!</p>
    </>
  ),
  "prologo-aridany-romero": (
    <>
      <p>Hace medio siglo, entre los caminos del parque Parque Calvo Sotelo, en el barrio de Las Rehoyas, un grupo de jóvenes decidió reunirse alrededor de una red, un balón y una ilusión compartida: el voleibol. Aquel impulso espontáneo, casi artesanal, germinó en 1976 en lo que hoy conocemos con orgullo como el Club Voleibol Guaguas.</p>
      <p>Desde entonces, la suma de empresas locales, personas comprometidas y una afición fiel ha consolidado algo más grande que un club: una pasión profundamente arraigada en la identidad de Gran Canaria. El Guaguas no solo es historia viva del deporte insular, sino también un referente indiscutible a nivel nacional y europeo.</p>
      <p>Con el paso de los años, el club se ha consolidado como uno de los grandes referentes del voleibol grancanario, proyectando su influencia posteriormente al ámbito canario y nacional. Esa evolución constante se ha traducido en una trayectoria repleta de títulos, prestigio y reconocimiento dentro y fuera de nuestras fronteras. Como reflejo de décadas de excelencia deportiva y compromiso con la sociedad, el Guaguas fue distinguido con el Premio Roque Nublo al Deporte 2023, uno de los mayores reconocimientos del deporte en Gran Canaria.</p>
      <p>Ilustres nombres como Paco Sánchez Jover, Antonio Miralles, Willock, Juanma Martín, Venancio Costa o Sergio Miguel Camarero defendieron la camiseta amarilla con honor, dejando huella dentro y fuera de la cancha y fortaleciendo el vínculo entre el club y su gente. A esos éxitos les siguieron muchos más, para el disfrute de una ciudad que, en numerosas ocasiones, abarrotó las gradas del Centro Insular de Deportes. Inolvidable permanece la noche del 20 de enero de 1994, cuando el Guaguas se jugó ante el Paris Saint-Germain el pase a la Final Four de la Copa de Europa.</p>
      <p>Mi reconocimiento y felicitación a una entidad que continúa ampliando su palmarés con nuevos títulos y entorchados, aunque el mayor mérito del Guaguas no se mide solo en copas. Su verdadero valor reside en décadas de trabajo constante para promover y visibilizar el deporte, uniendo generaciones, familias y sueños alrededor de una misma pasión.</p>
      <p>Muy pronto, el futuro seguirá escribiéndose en una nueva instalación moderna y adaptada, heredera del espíritu del CID, donde cada punto, cada bloqueo y cada victoria continuarán alimentando esta historia de éxito.</p>
      <p>Cincuenta años después, el Guaguas sigue siendo presente, memoria y futuro. A por otros 50.</p>
    </>
  ),
  "prologo-carolina-darias": (
    <p>Texto del prólogo pendiente de redacción.</p>
  ),
  "prologo-roberto-melian": (
    <>
      <p>Cumplir cincuenta años no es simplemente alcanzar una cifra redonda. Es, sobre todo, demostrar que un proyecto deportivo ha sabido convertirse en parte de la vida de mucha gente: de quienes lo fundaron, de quienes lo sostuvieron en silencio durante décadas, de quienes lo defendieron en la pista, y de quienes lo han sentido como propio desde la grada o desde su casa.</p>
      <p>Como presidente de la Federación Canaria de Voleibol y como representante institucional de nuestro deporte en Canarias, es para mí un orgullo poder escribir estas líneas en un momento tan significativo. Este libro conmemora el 50 aniversario de un club que ha sido referente, escuela y motor del voleibol canario, y que ha contribuido a que nuestro archipiélago siga siendo una tierra reconocida por su pasión, su talento y su manera única de vivir el voleibol.</p>
      <p>Hablar de cincuenta años es hablar de memoria. De aquellas primeras generaciones que entendieron que el deporte podía ser una herramienta de educación, de convivencia y de crecimiento personal. De los entrenamientos en instalaciones que muchas veces no eran las ideales, pero sí estaban llenas de ilusión. De los viajes, de los sacrificios, de la organización diaria, del compromiso de familias enteras y del trabajo de personas que, sin buscar protagonismo, han hecho posible que el club sea hoy lo que es.</p>
      <p>Pero hablar de cincuenta años también es hablar de identidad. De una forma de hacer las cosas basada en valores que no pasan de moda: el esfuerzo, la disciplina, el compañerismo, el respeto, la humildad cuando llegan los éxitos y la fortaleza cuando aparecen las dificultades. Porque los clubes con historia no se explican solo por los resultados; se explican por lo que transmiten y por lo que dejan en quienes pasan por ellos.</p>
      <p>Por supuesto, el voleibol también vive de sus grandes noches: partidos inolvidables, etapas brillantes, finales, ascensos, títulos, participación en competiciones de máximo nivel, y momentos que quedan grabados en la memoria colectiva. Esas páginas son importantes y son motivo de orgullo. Pero tan importante como levantar un trofeo es haber sido capaces de sostener un proyecto, temporada tras temporada, con seriedad, con planificación y con una ambición sana: la de crecer sin perder el sentido de comunidad.</p>
      <p>Este 50 aniversario debe ser también una oportunidad para mirar hacia adelante. El voleibol canario atraviesa una etapa de impulso y visibilidad, y eso no ocurre por casualidad: sucede porque existen clubes que trabajan, que innovan, que cuidan a su gente y que apuestan por estructuras sólidas. En esa construcción, el papel de los clubes es insustituible, y la Federación estará siempre al lado de quienes entienden el deporte no solo como competición, sino como servicio social y formativo.</p>
      <p>Quiero aprovechar estas líneas para expresar mi reconocimiento a todas las personas que han construido esta historia: a quienes estuvieron al principio, a quienes tomaron el relevo, a quienes hoy sostienen el día a día, y a quienes seguirán haciéndolo. Reconocimiento a los cuerpos técnicos, a los y las deportistas de todas las categorías, al equipo directivo, a los voluntarios, a los patrocinadores y colaboradores, y a una afición que, con su apoyo, hace que todo tenga sentido.</p>
      <p>Un aniversario así no pertenece solo al club. Pertenece a su barrio, a su ciudad, a su isla y, en definitiva, al voleibol canario. Porque cuando un club cumple cincuenta años, quien gana es el deporte: gana en raíces, en futuro y en credibilidad.</p>
      <p>Felicidades por este hito. Que este libro sea un homenaje justo a lo vivido y, al mismo tiempo, un impulso para lo que está por venir. Ojalá los próximos años traigan nuevos retos, nuevas alegrías y la misma convicción que ha hecho posible llegar hasta aquí: la de creer en el voleibol como una ilusión compartida.</p>
    </>
  ),
  "prologo-jorge-almansa": (
    <p>Texto del prólogo pendiente de redacción.</p>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 15: El impacto del escudo
  // ═══════════════════════════════════════════════
  "capitulo-15": (
    <>
      <DropCap>La relevancia social del CV Guaguas, proyecto deportivo en su génesis y actor ineludible de la vida global de Gran Canaria, no ha parado de crecer, consolidarse y enraizar. Es un logro añadido más, congraciando tradición, presente y alcance multidisciplinar.</DropCap>

<p>Y es que el club ha sido puesto como ejemplo en diversos ámbitos, no todos relacionados de manera directa con el deporte, por lo que inspira en cuanto a su genética ganadora, ejemplo de continuidad en la cima y carácter representativo, con una gestión eficaz y autosuficiente y un compromiso rotundo con la tierra que representa.</p>

<EditorialQuote author="Juan Ruiz">En los años en los que el Guaguas no compitió, tras su desaparición, y hasta que en 2020 retomamos el proyecto, la gente no paraba de preguntar y de desear que volviéramos. Eso habla del lugar que nos habíamos ganado y que no se resintió pese a una larga ausencia. Le faltaba algo al deporte canario y era el Guaguas.</EditorialQuote>

<p>La presencia y eco del Guaguas, privilegio ganado a pulso por títulos, competitividad y arraigo, le han granjeado apoyos empresariales y de orden público, a través de las correspondientes subvenciones, para su sostenibilidad, si bien dos de estos pilares se destacan por su enjundia y valor histórico: la empresa municipal de transporte público de la ciudad de Las Palmas de Gran Canaria, Guaguas Municipales, cuyo vínculo con el club se remonta a la década de los ochenta y al que se debe la nomenclatura actual y más reconocible del equipo, y el Gobierno de Canarias, la máxima autoridad política en la región y que ha brindado, de igual manera, un apoyo valioso y decidido al proyecto.</p>

<EditorialQuote author="Juan Ruiz">No tenemos ninguna queja de los organismos que nos dirigen. Todo lo contrario. Nos han brindado su colaboración, su reconocimiento y atención. Gobierno de Canarias, Cabildo de Gran Canaria y Ayuntamiento de Las Palmas de Gran Canaria. No me olvido de las federaciones, tanto de Canarias como la Nacional. Por nuestra parte, todo son agradecimientos por la sensibilidad que recibimos, pero en los casos de Guaguas Municipales y del Gobierno de Canarias consideramos que, por rango y antigüedad, un capítulo especial.</EditorialQuote>

<SectionHeader>José Eduardo Ramírez — Presidente de Guaguas Municipales</SectionHeader>

<p>José Eduardo Ramírez, concejal de Movilidad, Empleo y Distrito Centro en el Ayuntamiento de Las Palmas de Gran Canaria y, a su vez, presidente de Guaguas Municipales, ofrece las siguientes reflexiones al respecto.</p>

<p><strong>¿A qué atribuye esta simbiosis perfecta entre Guaguas Municipales y el CV Guaguas?</strong></p>

<p>La unión entre Guaguas Municipales y el Club Voleibol Guaguas es mucho más que un acuerdo de patrocinio: es una relación de identidad compartida. Desde el principio hemos sentido que remamos en la misma dirección. Tanto la empresa pública de transportes como el club representamos valores muy similares: el servicio a la ciudadanía, la búsqueda de la excelencia, el trabajo en equipo y el orgullo de llevar el nombre de Las Palmas de Gran Canaria por todo el estado español e incluso fuera de nuestras fronteras. Gran parte del mérito de que esta simbiosis se haya consolidado con tanta fuerza hay que atribuírselo a Juan Ruiz, presidente del CV Guaguas. Él fue quien nos trasladó su visión de un proyecto sólido, con raíces en la historia dorada del voleibol grancanario, pero también con la mirada puesta en el futuro. Su pasión, su capacidad de gestión y su fe en que Guaguas Municipales debía ser parte de esta aventura fueron determinantes para que hoy podamos hablar de una alianza modélica. A lo largo de los años, esta relación se ha fortalecido porque ambas instituciones hemos sabido evolucionar sin perder nuestra esencia. El club ha crecido deportivamente, y nosotros hemos acompañado ese crecimiento convencidos de que el deporte es una herramienta poderosa para unir, inspirar y generar orgullo colectivo.</p>

<p><strong>¿Qué signo distintivo resalta del Guaguas como club deportivo?</strong></p>

<p>Hoy en día, en el deporte de élite, es relativamente sencillo tener un pico de éxitos con una gran inversión, pero es tremendamente difícil mantenerse en la cima y ser una referencia constante, compitiendo en Europa y dominando en España. Esa regularidad es la que convierte al club en una institución deportiva fiable y de prestigio. Nos da la seguridad de que estamos asociando nuestra marca a un proyecto serio, que invierte bien sus recursos y que tiene un compromiso no solo con el primer equipo, sino con la formación de base, algo esencial para el futuro de nuestro deporte en la ciudad. Si tuviera que destacar un rasgo del CV Guaguas, sería su capacidad para mantenerse fiel a su espíritu competitivo y a su profesionalidad. Es un club que no se conforma, que siempre busca superarse, que trabaja cada temporada con la misma ilusión del primer día. Esa mentalidad ganadora es, sin duda, el sello que lo distingue. El Guaguas no solo brilla por sus títulos, que son muchos y de enorme prestigio, sino por su estructura, su planificación y su seriedad. Detrás de cada éxito hay un modelo de gestión muy bien trabajado, impulsado por el propio Juan Ruiz y su equipo, que entienden el deporte como una escuela de valores. Desde Guaguas Municipales nos sentimos muy identificados con esa filosofía. En el transporte público, como en el deporte, la constancia, la disciplina y la calidad en el servicio son las claves para ganarse la confianza de la gente día a día. Por eso, cuando el Guaguas triunfa, sentimos que una parte de nosotros también lo hace.</p>

<p><strong>Los mensajes de agradecimiento del club hacia Guaguas Municipales son frecuentes. ¿Cómo acogen esta correspondencia?</strong></p>

<p>Con emoción y con mucho orgullo. El reconocimiento del club hacia Guaguas Municipales no es solo una muestra de cortesía, sino el reflejo de una relación auténtica y de respeto mutuo. Cuando los jugadores, el cuerpo técnico liderado por Sergio Miguel Camarero o el propio Juan Ruiz expresan su gratitud, sentimos que el esfuerzo realizado desde nuestra empresa pública tiene un impacto real y positivo. Nos emociona ver cómo el equipo defiende nuestros colores con tanto compromiso, llevando el nombre de Guaguas por toda España y Europa con dignidad, talento y espíritu competitivo. Esa visibilidad refuerza la imagen de nuestra compañía, pero, más importante aún, refuerza el vínculo con la ciudadanía. Para nosotros, el agradecimiento más grande es ver las gradas cada vez más llenas, sentir el entusiasmo de la afición y saber que el nombre de Guaguas Municipales se asocia a valores tan positivos como el esfuerzo, la unidad y el orgullo local. Al apoyar al CV Guaguas, estamos apoyando el deporte, la vida saludable, el sentimiento de pertenencia y la proyección de nuestra capital. Los mensajes de agradecimiento del club nos reafirman que nuestra inversión es catalizadora, que ayuda a crear estructuras de éxito y a que los jóvenes tengan referentes. No buscamos el aplauso, sino la legitimación de nuestra función social. Saber que somos un pilar para que un club con la trayectoria y ambición del Guaguas siga soñando, es la mejor recompensa.</p>

<p><strong>Guaguas Municipales y CV Guaguas son dos sellos característicos de la capital grancanaria. ¿Cómo se mide el beneficio mutuo de esa publicidad bidireccional?</strong></p>

<p>El beneficio es tangible y, al mismo tiempo, intangible. Por un lado, está la proyección de marca: el club da visibilidad a Guaguas Municipales en competiciones nacionales e internacionales, en retransmisiones televisivas, redes sociales y medios de comunicación. Eso nos posiciona como una empresa moderna, cercana y comprometida con el tejido social y deportivo de la isla. Por otro lado, el club también recibe el respaldo y la estabilidad de una entidad pública que cree firmemente en el proyecto. No es una relación unidireccional; es un intercambio de prestigio, de valores y de identidad compartida. Ambas marcas —Guaguas Municipales y CV Guaguas— son sinónimo de Las Palmas de Gran Canaria. Juntas, proyectamos una imagen cohesionada de ciudad: dinámica, competitiva, orgullosa de sus raíces y con la mirada puesta en el futuro. Y eso, en términos de comunicación y sentimiento ciudadano, es un beneficio incalculable.</p>

<p><strong>¿Cuál es el mensaje desde Guaguas Municipales al club en su cincuentenario?</strong></p>

<p>Nuestro mensaje es de felicitación sincera y de profundo reconocimiento. Cincuenta años de historia no se cumplen todos los días, y hacerlo al máximo nivel, con la fuerza y la ilusión con la que lo hace el CV Guaguas, es un motivo de orgullo para toda Gran Canaria. Desde Guaguas Municipales queremos agradecer al club y, especialmente, a Juan Ruiz y a su equipo, por haber sido los guardianes de una tradición deportiva que forma parte de la memoria colectiva de esta ciudad. Han sabido recuperar la esencia de aquel Guaguas legendario que hizo vibrar a toda una generación, y al mismo tiempo proyectar una nueva etapa de modernidad y éxito. Les deseamos que los próximos cincuenta años sean igual de fructíferos, llenos de títulos, de cantera, de ilusión y de compromiso con la sociedad grancanaria. Y pueden tener la certeza de que, mientras ellos sigan defendiendo con orgullo el nombre de Guaguas, nosotros seguiremos acompañándolos, apoyándolos y celebrando juntos cada punto, cada victoria y cada sueño cumplido.</p>

<SectionHeader>Ángel Sabroso — Viceconsejero de Deportes del Gobierno de Canarias</SectionHeader>

<p>Por su parte, Ángel Sabroso, viceconsejero de Deportes del Gobierno de Canarias luego de una brillantísima carrera como árbitro internacional de balonmano, con presencia en Olimpiadas, Mundiales y Europeos, así valora esta alianza.</p>

<p><strong>¿Qué calado tiene para el deporte y la sociedad canaria la catarata de éxitos deportivos del Guaguas según su óptica como viceconsejero de Deportes del Gobierno de Canarias?</strong></p>

<p>El Guaguas es mucho más que un equipo que gana; es una declaración de intenciones del deporte canario. Sus triunfos nos recuerdan que, desde unas islas en medio del Atlántico, también se puede tocar el cielo si se trabaja con método, pasión y orgullo de pertenencia. Cada título del Guaguas es una bandera que ondea por todos los canarios, una prueba de que el talento, la organización y sobre todo la pasión, pueden vencer a cualquier frontera, incluida la geográfica. Lo que este club ha conseguido en los últimos años no solo dignifica a la Superliga o a Canarias, sino que inspira a cientos de jóvenes que encuentran en el deporte una escuela de vida y en su equipo un espejo donde mirarse.</p>

<p><strong>Siempre fue un hombre de deporte. ¿Normalizar esta racha triunfal no es desmerecerla por la complejidad que tiene ganar títulos cada temporada?</strong></p>

<p>Sin duda. Ganar una vez puede ser fruto de la inspiración; ganar siempre solo lo consigue quien convierte la excelencia en hábito. El Guaguas ha logrado algo que en el deporte es rarísimo: que el éxito parezca natural sin dejar de ser heroico. Porque detrás de cada copa hay horas de entrenamiento, planificación, humildad y un vestuario que funciona como familia. Normalizar sus victorias sería tan injusto como olvidar lo difícil que es mantenerse en la cima sin perder el alma. Y eso, precisamente, es lo que el Guaguas está consiguiendo; competir con grandeza y con valores.</p>

<p><strong>El Guaguas es el club más laureado de Canarias y ejerce de embajador histórico por Europa. Ahora que se analizan los modelos de gestión, ¿hay aquí uno de referencia por la regularidad y solvencia del mismo?</strong></p>

<p>Así lo creo, porque el Guaguas representa un modelo de gestión que combina raíces y modernidad. Una institución que aprendió a profesionalizarse sin perder su identidad canaria, que se financia con responsabilidad, que cuida a su masa social y que entiende que la comunicación y la marca también son parte del juego. Es, en definitiva, un ejemplo de que la gestión deportiva, cuando se hace bien, también es una forma de amor al territorio.</p>

<p><strong>Juan Ruiz como sempiterno presidente. ¿Qué reflexión le merece su legado y labor al frente del club en el cincuentenario de su fundación que se cumple en 2026?</strong></p>

<p>Juan Ruiz es, sencillamente, el alma del Guaguas. Un hombre que ha entregado su vida entera a un proyecto que ama como se ama a un hijo, con esa mezcla de orgullo y desvelo que solo entienden quienes sienten el deporte como vocación y no como cargo. Durante cinco décadas ha sabido mantener encendida la llama, incluso cuando el viento soplaba en contra. Ha visto caer y renacer al club, ha soñado con él cada noche y lo ha levantado cada mañana. Su legado no se mide solo en títulos, sino en la huella que deja en las personas: jugadores, técnicos, aficionados, generaciones enteras que crecieron bajo su ejemplo. El Guaguas es hoy lo que es porque tuvo a su lado a alguien que nunca se rindió, que creyó en la fuerza del trabajo y en el valor de la palabra dada. Alguien que se entrega de esta manera encarna una forma de entender la vida, la constancia y la pasión por Canarias a través del deporte, que es para agradecerle siempre como tiene que ser de justicia.</p>

<p><strong>¿En qué grado se siente partícipe el Gobierno de Canarias de esta bandera, la del Guaguas, que ondea a nivel nacional y europeo con tanta fama y prestigio?</strong></p>

<p>Intentamos estar cerca de todos, marca de la casa que el Consejero Poli Suárez ejerce en primera persona y, de ahí para abajo, todo su equipo. Eso nos hace sentirnos profundamente partícipes y orgullosos de los éxitos del deporte canario. El Guaguas representa lo que este Gobierno defiende: la seriedad en la gestión, la igualdad de oportunidades, la conexión entre deporte y sociedad. Cada vez que el Guaguas pisa una cancha europea, está representando al conjunto del archipiélago y ahí también está la mano de una administración que cree en su gente, que apuesta por el alto rendimiento y que entiende el deporte como política pública. El Guaguas no compite solo, lo hace en nombre de todos los canarios que creen en el esfuerzo, en la superación y en la capacidad de nuestra tierra para ganar. Y estar cerca de ellos, acompañarlos, no es protocolo: es una forma de agradecer lo que hacen por el nombre de Canarias.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 17: Más honores
  // ═══════════════════════════════════════════════
  "capitulo-17": (
    <>
      <DropCap>El prestigio de la entidad ha trascendido al ámbito del voleibol y le ha permitido alzarse con galardones de máxima relevancia provincial y regional, en reconocimiento a sus méritos deportivos y, también, representativos a niveles globales.</DropCap>

<p>Porque la nominación a condecoraciones como las acumuladas en los últimos tiempos y casi de manera consecutiva, Premio Roque Nublo Deportivo por parte del Cabildo de Gran Canaria (2023), Medalla de Oro de la Ciudad de Las Palmas de Gran Canaria (2023) y Premio al Deporte Canario del Gobierno de Canarias (2024), responde, precisamente, a su indudable calado, de manera unánime valorado por las autoridades correspondientes en su baremación objetiva a la hora de las correspondientes designaciones. Para un club como el Guaguas, abanderado de su tierra por toda Europa, y con una historia de éxitos y superaciones, el significado de estos laureles supone el espaldarazo perfecto y preciso a esa constancia en la cima competitiva, a esa aureola de éxito sostenido, de vitrinas sin comparación. También a la consagración en la que se ha instalado bajo el liderazgo de Juan Ruiz en el palco y Sergio Miguel Camarero a pie de pista, representantes de la vieja guardia, la inolvidable de una hegemonía que todavía perdura, y líderes de la nueva era también jalonada de conquistas.</p>

<p>Tener el elogio y tributo de las instituciones más representativas de Canarias, desde el Gobierno al Cabildo de Gran Canaria, pasando por el Ayuntamiento capitalino, siempre ha tenido un valor superlativo para el club, por tanto en cuanto su naturaleza deportiva, al que le sustancia, siempre ha contemplado un sustrato social ineludible.</p>

<EditorialQuote author="Juan Ruiz">Son muchos años llevando la canariedad por toda España e infinidad de países, el orgullo de pertenencia, el talento que nos pertenece, esa singularidad que nos caracteriza y nos hace únicos. He vivido los recibimientos que nos han brindado, la admiración que hemos despertado, la expectación generada... Y sentir que en tu lugar de origen así lo consideran y te lo admiten de la mejor manera posible, con un tributo público que queda para siempre, sin duda que es motivo de una satisfacción muy especial.</EditorialQuote>

<p>Entre los trofeos y recuerdos que forman parte del patrimonio vital del Guaguas, las menciones detalladas ocupan, por su dimensión tan preciada, un lugar privilegiado.</p>

<SectionHeader>Premio Roque Nublo Deportivo del Cabildo de Gran Canaria (2023)</SectionHeader>

<p>El 17 de marzo de 2023 recogió Juan Ruiz, visiblemente emocionado, y ante una ovación clamorosa, la placa y diploma acreditativos &ldquo;por su contribución de manera decisiva al crecimiento y la práctica del voleibol entre los jóvenes grancanarios, situando de nuevo a Gran Canaria como referente del voleibol nacional y potenciando, además, los valores y promoción turística de la isla en el exterior, siendo el club deportivo más laureado de Canarias&rdquo;. Antonio Morales encabezó en su condición de máximo dirigente cabildicio este evento.</p>

<EditorialQuote author="Juan Ruiz">Es la culminación de muchísimos años de trabajo, de todos los que apostaron por este club en 1976. Es un premio para todos los jugadores, entrenadores, dirigentes y técnicos, que han colaborado en estos 45 años de historia que tiene el club. Este reconocimiento de prestigio también es de los aficionados, patrocinadores y todos los que siguen haciendo grande esta entidad.</EditorialQuote>

<EditorialQuote author="Juan Ruiz">Es un premio de toda la familia del Guaguas. Siendo el club más laureado de Canarias tras la desaparición del Marichal, mucha gente me decía que no comprendía que el Guaguas no tuviese un premio del Gobierno de Canarias, del Cabildo de Gran Canaria o del Ayuntamiento de Las Palmas de Gran Canaria. Hablamos de un premio honorífico, de prestigio, sin connotaciones económicas. Ya se ha hecho justicia.</EditorialQuote>

<SectionHeader>Medalla de Oro de la Ciudad de Las Palmas de Gran Canaria (2023)</SectionHeader>

<p>El 23 de junio de 2023, en una gala celebrada en el teatro Pérez Galdós, la ciudad de Las Palmas de Gran Canaria destacó la labor de 25 personalidades e instituciones en el acto de honores y distinciones relacionadas con la ciudad y fueron reconocidos con los correspondientes títulos de Hijos e Hijas Predilectos, Hijos e Hijas Adoptivos y Medallas de Oro de la ciudad. El acto institucional de entrega de reconocimientos se celebró en el marco de las Fiestas Fundacionales y el Guaguas, representado por su presidente, obtuvo este galardón por haberse hecho sitio, con todos los honores, en la historia deportiva capitalina.</p>

<EditorialQuote author="Juan Ruiz">Valoraron nuestros títulos, nuestro apoyo a la base, nuestra predisposición siempre a ayudar, promocionar e impulsar las virtudes de nuestra ciudad. Fue otro acto para el recuerdo, muy emotivo, muy brillante y que engrandeció más aún nuestro camino y escudo.</EditorialQuote>

<SectionHeader>Premio al Deporte Canario del Gobierno de Canarias (2024)</SectionHeader>

<p>El 15 de noviembre de 2024, y en reconocimiento a su brillante temporada 2023-2024, en la que conquistó cuatro títulos (Superliga, Copa de SM El Rey, Supercopa y Copa Ibérica), además de una sobresaliente participación en la Champions League, principal competición de clubes de Europa, donde alcanzó los cuartos de final, codeándose con los equipos más potentes del Viejo Continente, el club recibió este premio en el transcurso de la feria ExpoDeca, celebrada en Infecar.</p>

<p>La consejería de Educación, Formación Profesional, Actividad Física y Deportes del Gobierno de Canarias quiso, con ello, reconocer la excelencia deportiva y el talento de deportistas, clubes y organizaciones canarias destacados durante la temporada, elevando el nombre del CV Guaguas.</p>

<EditorialQuote author="Juan Ruiz">Nos han votado los 27 periodistas de las Islas Canarias y me alegra mucho como nuestra familia ve recompensado este trabajo en equipo que iniciamos en una época tan dura como fue la pandemia del Covid-19. Y supimos resistir, aguantar y superarlo. Tanto en los primeros años del club como en esta etapa reciente, muchas personas tienen que sentirse partícipes de los éxitos deportivos y también de los buenos momentos que estamos viviendo ahora, con aficionados veteranos y muchos jóvenes que acuden al Gran Canaria Arena.</EditorialQuote>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 19: Empleados y técnicos
  // ═══════════════════════════════════════════════
  "capitulo-19": (
    <>
      <DropCap>El proceso de profesionalización de las estructuras del club ha sido una tarea ineludible en el Guaguas contemporáneo y en consonancia con los nuevos tiempos que se imponen en el ámbito deportivo.</DropCap>

<p>Aunque el modelo de gobierno presidencialista se mantiene, con la omnipresencia de Juan Ruiz en gestiones de todo tipo, desde la directiva se ha entendido la conveniencia de disponer de un andamiaje de orden administrativo para atender frentes diarios y de obligado cumplimiento tanto en relación directa con el equipo como en otros frentes. Ir reduciendo la dependencia directa del presidente se entiende como un símbolo de modernidad y funcionalidad sin menoscabo alguno de la jerarquía establecida en el organigrama.</p>

<EditorialQuote author="Juan Ruiz">El personal no deportivo tiene una importancia fundamental en nuestro funcionamiento por la valiosa labor que desempeña, así como su dedicación, esmero y compromiso en cada uno de sus cometidos. No salen en la foto como los jugadores, pero sí marcan, para bien, el rendimiento, porque facilitan todo y posibilitan que la vida diaria del club se desarrolle con normalidad y sin incidencias.</EditorialQuote>

<p>Ruiz no solo ha rearmado su junta directiva, también ha puesto cuidado y énfasis en dotar de equipo humano especializado al ámbito comercial y administrativo, empleados a tiempo completo que, antes en las dependencias de la entidad en el Centro Insular y ahora en la sede habilitada en el Gran Canaria Arena, se aplican en superar adversidades y los contratiempos propios de una entidad deportiva de alto nivel.</p>

<p>Así, para la parcela comercial, en la búsqueda de anunciantes, cobro de facturas, atención a proveedores y renovación de contratos, así como de actividades promocionales de tipo con colectivos de aficionados, ejerce como directora comercial Eva Ruiz. Este cargo no se le exime de asumir funciones sobrevenidas si así lo marca la agenda institucional y se requiere su presencia.</p>

<p>De igual manera, Adolfo Rodríguez, responsable de administración, tiene bajo su potestad &ldquo;todo el papeleo derivado de la actividad del club&rdquo;, según sus impresiones, y auxilia a Eva Ruiz en lo que se presente. Cuenta siempre con la voz sabia de Marek Szczesnowicz, el emblemático Team Mánager, en relación a la organización de viajes y trámites que tengan que ver con las licencias, nacionales e internacionales de los jugadores.</p>

<p>Eva Ruiz y Adolfo Rodríguez reportan al presidente de todos los efectos que tienen sus acciones, también a los miembros de la junta directiva que así lo solicitan, y, aunque en comparación con los medios de otros clubes ambos son una minoría, el sentimiento que desprenden por los colores, así como la tradición heredada en sus propias casas, son el mejor motor para que se multipliquen y abarquen más si cabe.</p>

<p>En lo que se refiere al mapa de técnicos, con Sergio Camarero como el cabeza visible de todos por sus atribuciones en el equipo profesional, Facundo Leal, Rubén Carreño, Rafa Sosa y Giovanni de Vincentis completan su cuerpo técnico, mientras que Manuel Santana, Tobías Cabrera y Margarita Georgieva ejercen en filiales.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 21: Reconocimiento del colectivo arbitral
  // ═══════════════════════════════════════════════
  "capitulo-21": (
    <>
      <DropCap>José Antonio Santana Andueza, Alexis Fuentes y Mariola Rodríguez integran la santísima trinidad del arbitraje canario de élite, con décadas de experiencia y sabiduría en el gremio y distinguidos por un prestigio sin igual. Voces ineludibles, sus testimonios, a propósito del medio siglo de vida del club proceden y con todos los honores.</DropCap>

<SectionHeader>José Antonio Santana Andueza</SectionHeader>

<p>Santana Andueza (Las Palmas de Gran Canaria, 1959), de 1990 a 2014 ininterrumpidamente como colegiado en la máxima categoría, considera que el club &ldquo;ha tenido un papel fundamental en la historia deportiva de la edad contemporánea de Canarias&rdquo;, además de una faceta educativa indudable: &ldquo;Ejercí de profesor de Educación Física y viví en primera persona el furor que se estableció en la juventud por este deporte, superando al fútbol, por las acciones promocionales del club, regalando entradas y fomentando el voleibol de manera continuada&rdquo;.</p>

<p>&ldquo;Aquel CID lleno a reventar y aquellos jugadores que fueron ídolos de toda Gran Canaria están para siempre en la memoria, igual que la nueva etapa con la refundación y nuevos éxitos de la mano de Juan Ruiz. Por eso resulta indudable su trascendencia y huella, con una contribución única y respetada en toda España. De hecho, el Guaguas desbancó a los grandes clubes del país para situarse en lo más alto y ser la referencia indiscutible&rdquo;, razona.</p>

<p>Antes de que la reglamentación estableciera el sistema de parejas cerradas para dirigir partidos, Andueza pudo, como asistente, ejercer en encuentros oficiales del Guaguas (&ldquo;recuerdo un partido ante el Unicaja en el que estaba Rafa Pascual&rdquo;) y sentir, a pie de pista, &ldquo;ambientes irrepetibles&rdquo;.</p>

<p>El homenaje que le brindó el club el pasado 25 de octubre de 2025 en reconocimiento a su trayectoria le llegó &ldquo;al fondo del corazón&rdquo; por lo que supone disfrutar de un tributo &ldquo;en casa&rdquo;.</p>

<SectionHeader>Alexis Fuentes</SectionHeader>

<p>Alexis Fuentes (Las Palmas de Gran Canaria, 1974), con más de dos décadas en la Superliga e internacional desde 2006, valora la capacidad que ha tenido Juan Ruiz, &ldquo;al igual que el desaparecido Quico Cabrera&rdquo;, de poder &ldquo;traer a unas islas del Atlántico una cantidad de títulos que causa impresión y admiración&rdquo;.</p>

<p>&ldquo;Debe suponer un lujo para todos los canarios, amantes o no del voleibol, disponer de esta representación absolutamente increíble. Hay un mérito y un trabajo sensacional detrás de tantos años de conquistas, de competitividad, de vivir en lo más alto. Tiene que ser valorado en su justa medida y creo que es así&rdquo;, argumenta.</p>

<p>Todavía en activo y pudiendo impartir justicia, además, en los derbis isleños con el equipo de Camarero en acción, se considera &ldquo;un privilegiado&rdquo; por haber sido testigo directo del progreso y consolidación de este proyecto deportivo: &ldquo;Maestro Gumersindo, recordado empleado de la UD que vivía en el Estadio Insular, era uno de mis abuelos y, aunque me transmitió la pasión por el fútbol y por la UD, no pudo con mi vocación de ser colegiado de voleibol, en gran parte por el impacto que tuvo en mí todo lo que hizo el Guaguas. Recuerdo con cariño como él y Merino González trataban de convencerme para que me decantara por el fútbol y yo, nada, convencido de lo que hoy soy&rdquo;.</p>

<EditorialQuote author="Alexis Fuentes">La felicitación al Guaguas por su cincuentenario es, conociendo a Juan Ruiz, el principio de otro medio siglo que, con personas diferentes por ley de vida, deben mantener al Guaguas en el sitio que heredan, que es el mejor.</EditorialQuote>

<SectionHeader>Mariola Rodríguez</SectionHeader>

<p>Mariola Rodríguez (Santa Cruz de Tenerife, 1974), otra leyenda del arbitraje, internacional desde 2011 y de Superliga desde 2004, tampoco escatima elogios a la institución: &ldquo;El CV Guaguas es historia viva del voleibol español. Cuando empecé a arbitrar, en los años noventa, pude disfrutar de ese Guaguas irrepetible, con Juan Ruiz, junto al CV Tenerife, con Quico Cabrera al frente, que dominaban la división de honor. Dos grandes y que durante muchos años se llevaban todos los títulos&rdquo;.</p>

<p>&ldquo;Siempre recordaré mi primer partido de la Superliga, que coincidió con los últimos años de Juan Ruiz en su primera etapa. Ir a pitar al CID un Guaguas-Sonamar Palma era como ir a pitar un Real Madrid-Barcelona en fútbol. Imaginen la dimensión. Y ese Guaguas que dominó ha vuelto, con la mente privilegiada de Juan Ruiz detrás&rdquo;, enfatiza.</p>

<p>La árbitra tinerfeña siempre ha tenido un lema sagrado (&ldquo;en España, el vóley donde se juega es en Canarias&rdquo;) por la tradición de, entre otros, el Guaguas, y presume de que, cuando viaja a otros países por compromisos de Champions, &ldquo;la gente siempre tiene presente al Guaguas&rdquo; porque, insiste, su presencia dentro y fuera de España &ldquo;es continua&rdquo;.</p>

<EditorialQuote author="Mariola Rodríguez">Nunca debió desaparecer el club como ocurrió por desgracia y por todo lo que representa. Pero lo importante es que volvió, sigue y va a continuar. Es lo que deseo como canaria y amante del deporte y del voleibol.</EditorialQuote>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 22: Miguel Ángel Ramírez
  // ═══════════════════════════════════════════════
  "capitulo-22": (
    <>
      <DropCap>La historia y representatividad de la UD Las Palmas, bandera de Gran Canaria desde 1949, trasciende al deporte en la sociedad isleña y es símbolo unificador y sinónimo de prestigio. Desde la entidad amarilla, en voz de Miguel Ángel Ramírez, su presidente, hay un reconocimiento sincero y elogioso de lo que significa el CV Guaguas con su medio siglo de existencia y un palmarés que le diferencia.</DropCap>

<EditorialQuote author="Miguel Ángel Ramírez">Todos conocemos la trayectoria de superaciones y éxitos del Guaguas, que ha permitido a nuestra tierra tener un papel hegemónico en el voleibol español, con gestas y triunfos de enorme mérito y brillo. Aquellos tiempos en el CID lleno con los Camarero, Klos, Golec, Sánchez Jover... Y ahora, también, después de su refundación. En el deporte no es fácil ganar y, frecuentemente, son más habituales las derrotas. Con el Guaguas no ha sido así. Hay que valorar todo lo que ha ido logrando con el paso de los años, siempre con una exigencia máxima y compitiendo con clubes que manejaban mayores presupuestos. Repasar su colección de títulos es motivo de orgullo y satisfacción para todos los grancanarios y ahora que cumple 50 años desde la UD Las Palmas le trasladamos nuestro aprecio, admiración y felicitación.</EditorialQuote>

<p>El dirigente no obvia una mención especial a la figura de Juan Ruiz, &ldquo;el auténtico artífice de que el Guaguas sea lo que es&rdquo;.</p>

<p>&ldquo;Juan Ruiz se ha destacado por ser una persona muy importante para nuestro deporte, pues además de su labor titánica al frente del Guaguas, también brindó sus servicios a la UD en una etapa en la que fue consejero y de la que me consta su sensibilidad, compromiso y diligencia en todo lo que hace. Le conozco desde hace muchos años y, sin duda, es un referente por la entrega altruista y ejemplar que ha puesto al servicio de su club. Sigue construyendo día a día una obra que va a dejar un legado impresionante y es de justicia ponerlo en el lugar que se merece&rdquo;, argumenta.</p>

<p>Ramírez recuerda que la UD Las Palmas &ldquo;siempre estará al lado de todos los clubes, de la modalidad que sea, que dan visibilidad y reputación a Gran Canaria&rdquo; y, en este sentido, sitúa al Guaguas &ldquo;en una posición de privilegio porque así se lo ha ganado&rdquo;.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 23: A la vanguardia de la tecnología
  // ═══════════════════════════════════════════════
  "capitulo-23": (
    <>
      <DropCap>El CV Guaguas cabalga a buen ritmo en los nuevos tiempos y con las vías de comunicación que se imponen a la hora de interactuar con aficionados, medios de comunicación y público en general. Las redes sociales y la fidelización de la comunidad propia de seguidores juegan un papel esencial en este ámbito.</DropCap>

<p>Y el club, sensible a esta tendencia, cuida de manera especial sus cuentas oficiales, consciente del alcance que tienen, además de aportar una ayuda incalculable en la internacionalización de la marca, otro de los grandes retos en los que se trabaja de una manera específica.</p>

<EditorialQuote author="Juan Ruiz">A estas alturas del siglo XXI se demanda otra manera de captar información. Todo ha de ser instantáneo, en la medida de lo posible personalizado y cuidado, que tenga impacto en el destinatario y que, además, genere un vínculo que le haga volver a ese canal. En el Guaguas no solo queremos prestar atención al seguidor de la tierra que puede venir al pabellón a animarnos. También al que vive aquí y, por lo que sea, no puede estar en directo con el equipo y, por supuesto, los que no residen en Gran Canaria. Y qué mejor manera que mantenerlos al día de la actualidad competitiva y con contenidos propios en torno a la plantilla y el club.</EditorialQuote>

<p>Las actualizaciones diarias, así como la elaboración de reportajes, stories y vídeos monográficos mantienen con vida y vigencia las cuentas de la entidad, con espacios exclusivos y que combinan información con entretenimiento, la fórmula que ahora se impone. &ldquo;Para llegar a un público joven, que ha institucionalizado esta vía para interaccionar, es básico ofrecer un servicio ágil, dinámico y atractivo. Sin descuidar promociones y ventajas&rdquo;, añaden desde el departamento de prensa, orientado, además, a dar a los medios de comunicación convencionales todos los datos y novedades para facilitar su difusión.</p>

<p>Aunque la masa social sostenida en las redes es fluctuante, hay una base de unos 5.000 fieles que integran la gran familia del Guaguas en el espacio digital y que es, como no podía ser menos, reclamo para anunciantes y patrocinadores ligados al escudo. En base a los impactos, algunas de las tarifas pueden tener más valor. Es la ley ahora imperante en el mundo empresarial y que tiene su extensión en el deporte, ya entendido como una industria de entretenimiento que ha de manejar audiencias e incentivarlas.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 20: La plantilla del cincuentenario
  // ═══════════════════════════════════════════════
  "capitulo-20": (
    <>
      <div className="space-y-1">
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">1</span>
          <div>
            <p className="font-bold text-foreground">Osmany Juantorena</p>
            <p className="text-sm text-muted-foreground">Receptor</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">2</span>
          <div>
            <p className="font-bold text-foreground">Jorge Almansa</p>
            <p className="text-sm text-muted-foreground">Receptor</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">3</span>
          <div>
            <p className="font-bold text-foreground">Jean Pascal Diedhiou</p>
            <p className="text-sm text-muted-foreground">Central</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">4</span>
          <div>
            <p className="font-bold text-foreground">Hélder Spencer</p>
            <p className="text-sm text-muted-foreground">Central</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">5</span>
          <div>
            <p className="font-bold text-foreground">Martín Ramos</p>
            <p className="text-sm text-muted-foreground">Central</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">6</span>
          <div>
            <p className="font-bold text-foreground">Augusto Colito</p>
            <p className="text-sm text-muted-foreground">Opuesto</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">7</span>
          <div>
            <p className="font-bold text-foreground">Dobromir Dimitrov</p>
            <p className="text-sm text-muted-foreground">Colocador</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">8</span>
          <div>
            <p className="font-bold text-foreground">Unai Larrañaga</p>
            <p className="text-sm text-muted-foreground">Líbero</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">9</span>
          <div>
            <p className="font-bold text-foreground">Tomas Rousseaux</p>
            <p className="text-sm text-muted-foreground">Receptor-Atacante</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">10</span>
          <div>
            <p className="font-bold text-foreground">Io de Amo</p>
            <p className="text-sm text-muted-foreground">Colocador</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">12</span>
          <div>
            <p className="font-bold text-foreground">Nico Bruno</p>
            <p className="text-sm text-muted-foreground">Receptor</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">13</span>
          <div>
            <p className="font-bold text-foreground">Elio Montesdeoca</p>
            <p className="text-sm text-muted-foreground">Central</p>
          </div>
        </div>
        <div className="flex items-center gap-4 py-3 border-b border-border/50 last:border-0">
          <span className="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary/10 text-primary font-bold text-lg flex-shrink-0">14</span>
          <div>
            <p className="font-bold text-foreground">Ezequiel Figueroa</p>
            <p className="text-sm text-muted-foreground">Líbero</p>
          </div>
        </div>
      </div>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 24: Socios y abonados
  // ═══════════════════════════════════════════════
  "capitulo-24": (
    <>
      <DropCap>La afición del Guaguas es el motor del club. Desde aquellos primeros espectadores en el patio del colegio hasta los miles de abonados que llenan el Gran Canaria Arena, los socios han sido el alma del proyecto deportivo más exitoso del voleibol español.</DropCap>
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 25: EMPRESARIOS DE LA TIERRA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Empresarios de la tierra',
        'numero' => '25',
        'order' => 215,
        'show_marker' => true,
        'ref_id' => 'cap25',
        'hero' => array(
            'image'             => libro_img('hero-estatutos.jpg'),
            'overlay'           => 'rgba(212, 175, 55, 0.80)',
            'icon'              => 'custom',
            'custom_icon'       => $star,
            'icon_width'        => 60,
            'icon_height'       => 60,
            'alignment'         => 'left',
            'vertical'          => 'center',
            'height'            => '450px',
            'title_lines'       => array(libro_hero_line('EMPRESARIOS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DE LA TIERRA', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '',
    ),

    array('title' => 'El tejido empresarial canario', 'numero' => '', 'order' => 2151, 'show_marker' => false, 'parent_ref' => 'cap25',
        'hero' => array(
            'image'             => libro_img('hero-estatutos.jpg'),
            'overlay'           => 'rgba(0,0,0,0.15)',
            'icon'              => 'custom',
            'custom_icon'       => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width'        => 40,
            'icon_height'       => 40,
            'alignment'         => 'center',
            'vertical'          => 'center',
            'height'            => '500px',
            'border_color'      => 'hsl(45 100% 50%)',
            'title_lines'       => array(
                libro_hero_line('EL TEJIDO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('EMPRESARIAL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('CANARIO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
<DropCap>Además de las subvenciones públicas del Cabildo de Gran Canaria, del Ayuntamiento de Las Palmas de Gran Canaria y del Gobierno de Canarias, ayudas a las que tiene derecho el Guaguas por su condición de club de élite y representativo, con el añadido de ganar títulos y disfrutar de un prestigio histórico fuera de debates, Juan Ruiz y toda su junta directiva han dado un paso más en la viabilidad y sostenibilidad del proyecto esmerándose en la captación de apoyos por parte del empresariado de la tierra.</DropCap>

<p>Y se lleva con mucho orgullo la consecución de una amplia cobertura en este apartado, sin tener nada que envidiar a otras instituciones porque, como admite el presidente, &ldquo;el apoyo es masivo, decidido y con reciprocidad&rdquo;. Como advierte el mandatario, las marcas que se asocian a las siglas corporativas ven un retorno en términos relacionados con el espíritu ganador, la representatividad y la fama que van implícitas al escudo.</p>

<EditorialQuote author="Juan Ruiz">El Guaguas lleva en su esencia expandir Canarias, ser embajador de su tierra, llevar más allá de nuestras islas los símbolos y siglas que ayudan al desarrollo de nuestra región. Y captar la confianza y patrocinio de empresas que aportan empleo, riqueza y ejemplaridad a Gran Canaria es una manera perfecta de hacerlo.</EditorialQuote>

<p>El Guaguas se ha ganado un nicho de mercado &ldquo;indiscutible y apreciado&rdquo; en el empresariado local por su política competente de tarifas brindando la aureola única que posee atendiendo a su palmarés. Y gestos como el de dedicar cada trofeo a sus patrocinadores, cuidando al máximo los detalles, colaboran en una sinergia establecida que permite, temporada tras temporada, asegurar una vía de ingresos fundamental para vertebrar cada proyecto.</p>

<EditorialQuote author="Juan Ruiz">Nunca nos hemos abandonado al dinero público. Y nuestro método de trabajo contempla explorar continuamente financiación extra. Nos hemos acostumbrado a ser competitivos como el que más tanto en España como en Europa con presupuestos ajustados pero en los que el cumplimiento de todas las obligaciones es sagrado y además por parte de unos directivos que no cobran un céntimo por los servicios que prestan.</EditorialQuote>

<p>El presidente ya fue pionero, a mitad de los años ochenta, y como tarjeta de presentación en su recién estrenado mandato, en privilegiar la independencia económica del club. Por aquel entonces causó elogio generalizado su contrato con Guaguas Municipales, que terminaría dando la denominación al equipo. Y, ya desde esa época, y bajo su dirección, jamás faltaron los ingresos derivados de la pequeña y mediana empresa para apuntalar a la gran marca predominante.</p>

<p>Décadas después, hoy se mantiene ese modelo que combina diferentes escalones en cuanto a participaciones económicas &ldquo;pero todas necesarias, fundamentales y valoradas&rdquo;.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 25: Empresarios de la tierra
  // ═══════════════════════════════════════════════
  "capitulo-25": (
    <>
      <DropCap>El CV Guaguas ha contado siempre con el apoyo de empresarios canarios que creyeron en el proyecto. Desde Guaguas Municipales, el primer gran patrocinador, hasta las empresas que hoy respaldan al club, el tejido empresarial de la tierra ha sido pilar fundamental de la entidad.</DropCap>

      <ContentImage 
        src={imgRemateGuaguas} 
        alt="El CV Guaguas en acción con sus patrocinadores" 
        caption="Los patrocinadores locales han sido parte esencial de la historia del club, acompañándolo en cada etapa." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),



  // ═══════════════════════════════════════════════
  // NEW: El hombre que lo cambió todo (Cap 04 child)
  // ═══════════════════════════════════════════════
  "cap05-el-hombre": (
    <>
      <DropCap>Nacido en La Aldea de San Nicolás en 1953, emigrante con su familia a Tenerife durante gran parte su adolescencia (1960-1969), en la que hizo sus pinitos en la lucha canaria o el fútbol ("con 16 años llegué a jugar en Tercera División en las filas del Adeje"), Juan Ruiz estaba llamado, sin saberlo, a escribir una historia sin parangón en el deporte canario y al frente del Calvo Sotelo. No hay dirigente isleño con tal nómina de títulos en su poder, todos los conquistados por la entidad, y con el mérito añadido de haber armado un equipo campeón desde las cenizas. Tanto en 1987 como en 2020 acudió al rescate recogiendo una tesorería en ruinas y un porvenir tan comprometido que apuntaba a la desaparición.</DropCap>

      <EditorialQuote author="Juan Ruiz">
        "El secreto es trabajo y pasión. Constancia y ambición. No rendirse jamás. Si para conseguir un patrocinador tengo que visitar veinte empresas, acabo entrando en cuarenta. Si para ser campeón me tengo que traer a una estrella, trato de que sean dos."
      </EditorialQuote>

      <p>El punto de partida de este fértil y exitoso ciclo en el palco, en un hombre "sin tradición alguna en el voleibol", arranca de manera "casi casual y del todo inesperada". Año 1986. Desde su estabilidad laboral como apoderado de la empresa Napesca, Juan Ruiz sigue a la distancia, "como un aficionado más", las evoluciones de los distintos clubes de Gran Canaria. "Siempre me ha gustado el deporte y estaba al día de todo", reconoce. Fiel a su costumbre de desayunar en la cafetería del periódico La Provincia en el polígono industrial de El Sebadal, allí coincidía cada mañana con informadores del medio. "Era habitual oyente de Paco García Caridad, que estaba en Antena 3 Radio. Nos saludábamos, hablábamos a menudo de manera desenfadada... Hasta que un día me comentó que un histórico, el Calvo Sotelo, estaba a punto de desaparecer. Que necesitaba alguien que echara una mano... O dos. Porque la situación era de extrema gravedad".</p>

      <EditorialQuote author="Juan Ruiz">
        "Por lo que fuera, me sentí en la obligación de hacer algo. Me movió una motivación de responsabilidad. Le pregunté abiertamente a Nuez por el mejor jugador de España. Me dijo que era Paco Sánchez Jover. Le contesté que entonces habría que traerlo. Y me miró como si hubiese dicho un disparate."
      </EditorialQuote>

      <p>"Me reuní con Felipe Nuez, estaba también Ivo Martinovic. Me explicaron la situación. Lo primero que hice fue hablar con el director de Cajacanarias de Tenerife. Buscaban ampliar su mercado e implantarse en Gran Canaria. Les dije que nada mejor para adquirir publicidad que invertir en un club de tradición y que le daría impacto. Aceptó y dieron 500.000 pesetas, un alivio para cómo estaba todo".</p>

      <p>"Mantuve varias conversaciones luego con Gustavo Rodríguez, entonces presidente de la junta gestora, con Ismael Chinea, con Nuez. Le dije que yo podía entrar en la directiva. No pensaba ser presidente. No quería ni necesitaba notoriedad porque mi vida la tenía cubierta con mi trabajo. Pero resulta que ninguno podía asumir las funciones ejecutivas que se requerían para buscar fondos y anunciantes que le dieran músculo financiero al club. Total, vine para ayudar y me pusieron al frente de todo", sintetiza.</p>

      <p>Pronto, recién aterrizado en la junta gestora, se apunta otro logro de capital importancia estratégica: la firma del patrocinio de Guaguas Municipales y que venía a solucionar una problemática que acuciaba la vida institucional con la falta de un sponsor.</p>

      <SectionHeader>El fichaje de Sánchez Jover y la construcción del equipo campeón</SectionHeader>

      <p>Tenía 33 años y, "desde el primer momento", tuvo claro el mandamiento que siempre regiría sus movimientos y gestiones: "Ganar, ganar y ganar". Ruiz orienta cada maniobra a buscar "el máximo" y no duda en explorar posibilidades que parecían prohibidas.</p>

      <p>"Me planté en Palma, hablé con él. Y en el Puerto de Santa María, donde jugaba con la selección española un Preeuropeo, pude cerrar todo. Le convencí de que viniera con nosotros sin poder alcanzar o igualar el contrato que tenía en el Palma. Pero le hablé de liderar un proyecto que iba a ser el mejor del país, que sería nuestro líder, que iba a vivir en un sitio maravilloso, que la afición le haría sentirse único... Paco siempre ha sido una persona muy inteligente y entendió lo que yo quería decirle de manera instantánea. Nadie creía que el Calvo Sotelo podía fichar a la gran estrella de España. Pues nos los trajimos junto a Venancio Costa y Antonio Miralles, otros dos fenómenos".</p>

      <p>El impacto mediático que tuvo esta operación rápidamente se tradujo en un mensaje al resto: "Habíamos llegado para ser los mejores". Y lo que parecía una jugada maestra aislada alcanzaría el grado superlativo cuando, también de una tacada, ya en 1989, son los polacos Ireneusz Klos y Waclaw Golec, también figuras mundiales, quienes aterrizan en Gran Canaria.</p>

      <SectionHeader>Un modelo de gestión basado en la intuición y la constancia</SectionHeader>

      <p>Su modelo presidencialista de entonces, como el de ahora, se basaba en "la intuición, la capacidad de anticipación y delegar, aunque la decisión de calidad corresponda siempre al que más manda".</p>

      <p>"En la primera temporada completa en la que estuve de principio a fin, la 1987-88, quedamos subcampeones de Liga y de Copa. Y fue un hito. Jamás se había llegado a pelear por títulos de esa manera. La destitución de una figura de la relevancia de Felipe Nuez fue, de largo, el momento más crítico de esa campaña. No resultó fácil prescindir de él. Pero ese primer balance, salvando lo de Felipe, no pudo ser mejor. El club pasó de estar al borde de la desaparición a discutir títulos, regenerar una afición perdida, que acabó trasladándose con nosotros del San Román al Centro Insular, cuando abrió sus puertas en 1988, y tener en sus filas una mezcla de juventud, cantera y estrellas que terminaría, como no podía ser de otra manera, dando sus frutos. Y, lo que también me producía un orgullo especial: jugar y competir contra los mejores de Europa", reseña.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // NEW: La génesis de su proyecto en cronología (Cap 04 child)
  // ═══════════════════════════════════════════════
  "cap05-cronologia-genesis": (
    <>
      <Timeline title="La génesis de su proyecto en cronología">
        <TimelineEvent year="1987">"Estamos en una nube con muchos cimientos. Aquí hay un club con cantera, con una estructura deportiva muy sólida basada en excelentes técnicos, y hay también unas buenas razones económicas que se gestan con una administración del club que considero muy responsables. Felipe Nuez me facilitó a principios de temporada una lista de jugadores para hacer al equipo campeón de Liga. Hemos traído quizá a los mejores". <em>(La Provincia, 17 de julio de 1987)</em>.</TimelineEvent>
        <TimelineEvent year="1989">"Este es el triunfo del trabajo y del esfuerzo de muchos años, comenzado por otros, como José Luzardo, Antonio Trejo o Felipe Nuez, y rematado por nosotros y por nuestra afición. Es el triunfo de todos y un gran día para el voleibol canario". <em>(Diario de Las Palmas, 10 de abril de 1989)</em>.</TimelineEvent>
        <TimelineEvent year="1989">"Me gusta mucho el número 11 de la selección polaca, Golec, un gran rematador de potente salto, especialista en remates de zona cuatro y zagueros, con gran recepción. El objetivo que nos planteamos es la obtención de un título nacional como mínimo". <em>(Canarias7, 23 de agosto de 1989)</em>.</TimelineEvent>
        <TimelineEvent year="1990">"Lo de la campaña pasada fue logrado con gran merecimiento. Después de cuatro años de gran trabajo, el título de Liga tenía que llegar. También entiendo que para nuestro equipo ha sido un triunfo ser la única entidad deportiva del país que ha abierto una brecha contra la droga". <em>(La Provincia, 6 de julio de 1990)</em>.</TimelineEvent>
        <TimelineEvent year="1990">"No gana el que más presupuesto tiene sino el que más trabajo derroche. Es un gran reto, asimismo, representar a Canarias por vez primera en la Copa de Europa, un prestigio y orgullo que deseamos para el resto de los equipos de élite grancanarios". <em>(Canarias7, 13 de septiembre de 1990)</em>.</TimelineEvent>
        <TimelineEvent year="1992">"El público ha estado maravilloso. Solo le faltó rematar los balones en la cancha. El Gran Canaria merece que se le apoye porque tenemos a la juventud con nosotros. Este club no va a quedar a la deriva". <em>(Canarias7, 5 de abril de 1992)</em>.</TimelineEvent>
        <TimelineEvent year="1994">"Nuestra intención con la gratuidad de la entrada era la de ofrecer un homenaje a la afición y no creímos que fueran a venir más de 6.000 personas". <em>(Canarias7, 21 de enero de 1994)</em>.</TimelineEvent>
        <TimelineEvent year="1996">"En dos ocasiones estuve tentado de abandonarlo todo. Pero si cuando pierdes te marchas es de cobardes, por eso continué, porque el día que me marche lo debo hacer con el equipo campeón". <em>(Canarias7, 7 de octubre de 1996)</em>.</TimelineEvent>
        <TimelineEvent year="1998">"Ha sido un partido donde casi siempre hemos estado por debajo. El público, fundamental, me recordó al del día del Paris Saint Germain. La Final Four ya está conseguida, y ahora todo lo que venga será un premio añadido". <em>(Diario de Las Palmas, 26 de febrero de 1998)</em>.</TimelineEvent>
        <TimelineEvent year="1998">"He visto a mucha gente llorar de emoción y tristeza en el Centro Insular de Deportes, y eso es imborrable. Ahora estamos en el momento de volver a empezar, pero que se recuerde que venimos de jugar una Final Four hace unos meses". <em>(Canarias7, 4 de diciembre de 1998)</em>.</TimelineEvent>
        <TimelineEvent year="2020">"Vamos con la intención de ir a por todas y para ello tenemos todos que trabajar más que los demás y entrenar más que los demás". <em>(Canarias7, 18 de junio de 2020)</em>.</TimelineEvent>
        <TimelineEvent year="2021">"No esperaba que fuese así. Ni en el mejor de los sueños esperaba que todo saliera tan redondo. Lo hemos cumplido. Nadie se puede sentir defraudado. El Guaguas tiene un gen ganador". <em>(Canarias7, 9 de febrero de 2021)</em>.</TimelineEvent>
        <TimelineEvent year="2023">"Sergio Camarero es una persona muy especial para mí. Lo tengo conmigo desde los 17 años. Es una de las personas que más quiere al club, incluso más que yo". <em>(La Provincia, 7 de mayo de 2023)</em>.</TimelineEvent>
        <TimelineEvent year="2024">"El Guaguas merece más ayuda por parte de los organismos oficiales. Un suplemento de un millón de euros serviría para progresar a nivel europeo". <em>(Canarias7, 25 de diciembre de 2024)</em>.</TimelineEvent>
        <TimelineEvent year="2025">"Supone un orgullo ser el presidente de este grupo de deportistas y creo que mi satisfacción se extiende a la afición y a todos los que quieren y valoran el voleibol". <em>(Canarias7, 20 de noviembre de 2025)</em>.</TimelineEvent>
        <TimelineEvent year="2026">"El éxito no es mío, sino de todos los que colaboran. La directiva y el presidente del Guaguas nunca ha cobrado en los doce años de la primera etapa ni en los seis años de esta segunda. El Guaguas es una gran familia". <em>(Sport, 12 de febrero de 2026)</em>.</TimelineEvent>
      </Timeline>
    </>
  ),

  // ═══════════════════════════════════════════════
  // NEW: La aventura europea (Cap 08 child)
  // ═══════════════════════════════════════════════
  "cap09-aventura-europea": (
    <>
      <DropCap>Si brillantísima ha sido la trayectoria nacional del Guaguas, con dominio de las dos competiciones domésticas, reinado que ha logrado revalidar tras su refundación en 2020, su amplia presencia en competiciones europeas, con punto de inicio de 1987 ante el Knack de Bélgica en la emblemática pista del San Román, también es digna de valoración. Con un balance de más de cincuenta partidos oficiales frente a escudos de otros países, el Guaguas se ha convertido, por méritos propios, en uno de los mejores embajadores de Canarias por todo el mundo.</DropCap>

      <p>Esa vocación sin fronteras a la hora de exportar los valores y potencialidades del club también ha llevado aparejada la bandera tricolor para mayor orgullo de aficionados e instituciones públicas, de alta sensibilidad siempre con la representatividad fuera de España.</p>

      <EditorialQuote author="Juan Ruiz">
        "Queremos ser alguien en Europa."
      </EditorialQuote>

      <p>Decía Juan Ruiz nada más llegar a la presidencia, a finales de los ochenta, evidenciando que el crecimiento de la entidad pasaba por hacerse un hueco entre los mejores del continente.</p>

      <p>Un repaso a su camino rivalizando con equipos extranjeros deja momentos culminantes, como el histórico triunfo ante el PSG francés o la victoria ante el Lennick belga que, en 1998, abrió las puertas a la Final Four de la Recopa que se celebró en Cuneo (Italia), entre otras citas que ya tienen su relevancia en la historia. Y tal ha sido su calado, pasado y reciente, que en el ránking mundial de clubes de voleibol realizado en los últimos meses, el equipo grancanario ocupa uno de los lugares de privilegio.</p>

      <p>Como precisa Antonio Benítez, sempiterno mánager y que ha encabezado casi todas las delegaciones del Guaguas en sus comparecencias por las capitales de varios países, esta presencia sostenida procuró una red de relaciones de alto prestigio, además de convertir al equipo en un atractivo para jugar torneos amistosos de primer nivel cada verano.</p>

      <p>Así, el binomio Guaguas-Europa ya es un clásico en el calendario, con una relación ininterrumpida de trece años (1987-2000), y que ofrece el recorrido con los oponentes que a continuación se detalla.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // NEW: Títulos individuales (Cap 11 children)
  // ═══════════════════════════════════════════════
  // ═══════════════════════════════════════════════
  // Títulos individuales (Cap 11 children) + Joselu Sánchez
  // ═══════════════════════════════════════════════
  "cap12-copa-1989": (
    <>
      <TituloDeportivo numero={1} nombre="COPA DEL REY" anio="1989">
        <FichaTecnica
          parciales="15-10, 11-15, 15-5 y 15-8"
          arbitros="Jiménez Callejón (Almería) y Antonio Morales (Gijón). Amonestaron a Camarero por los locales y a Martín y Saxton por los visitantes."
          incidencias="Más de 5.000 espectadores en el Centro Insular de Deportes con pleno de autoridades políticas y deportivas en el palco y encabezadas por el presidente del Gobierno de Canarias, Lorenzo Olarte, que fue el encargado de entregar el trofeo de campeón a Paco Sánchez Jover como capitán del Guaguas. Carmelo Artiles, presidente del Cabildo de Gran Canaria, José Vicente de León, alcalde de Las Palmas de Gran Canaria, y Miguel Ángel Quintana, presidente de la Federación Española de Voleibol, fueron otras personalidades ilustres presentes."
        >
          <Equipo nombre="GUAGUAS LAS PALMAS" sets={3}>Chava, Willock, Paco Sánchez Jover, Miralles, Venancio Costa y Camarero. También jugó Juanma Martín. <strong>Entrenador:</strong> Sergio Hernández.</Equipo>
          <Equipo nombre="C. V. PALMA" sets={1}>Fernández, Saxton, Jiménez, Vicedo, Martín Lobo y Ernesto. También jugaron Ortiz, Luiso y Calvo. <strong>Entrenador:</strong> Jaime Fernández Barros.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>La Copa del Rey conquistada el 9 de abril de 1989 inauguró el palmarés del Guaguas y, por extensión, el del voleibol canario. Una importancia histórica redoblada y de la que fueron testigos directos los más de 5.000 espectadores que abarrotaron hasta la bandera el Centro Insular de Deportes inaugurado meses antes, además de todos los que lo siguieron en directo por la segunda cadena de Televisión Española. El rival, el Palma, no traía buenos recuerdos porque, apenas una semana antes, le había arrebatado la Liga a los jugadores entonces dirigidos por Sergio Hernández.</p>
          <p>El deseo de revancha no escondía, sin embargo, el favoritismo que colgaba sobre el conjunto balear pese a su condición de visitante. El partido respondió a las expectativas ya que aunó emoción y un altísimo nivel por parte de los contendientes. En las crónicas se destaca el papel coral de todo el Guaguas, motivadísimo para no fallar ante su afición, aunque dos fueron los nombres propios que emergieron sobre el resto, los integrantes de la pareja extranjera, el mexicano Chava González, que dio el punto del triunfo final con un saque desde el fondo, y el canadiense Brad Willock, magistral en la dirección que ejerció sobre el resto.</p>
          <p>La invasión espontánea de la pista y la felicidad desatada, que obligó a los jugadores a salir de los vestuarios a saludar ante la insistencia de los incondicionales, condimentaron un día grande, el primero de todos los que quedaban por venir al abrir el ciclo exitoso.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-1990": (
    <>
      <TituloDeportivo numero={2} nombre="LIGA" anio="1989-90">
        <FichaTecnica
          parciales="15-4, 15-5 y 15-9"
          arbitros="Víctor Viña y Javier Aller, del comité asturiano. Sin amonestaciones."
          incidencias="Más de 6.000 espectadores en el Centro Insular de Deportes, lo que constituyó un récord histórico de asistencia. Lorenzo Olarte, presidente del Gobierno de Canarias, entregó la copa de campeones a Paco Sánchez Jover."
        >
          <Equipo nombre="CONSTRUCTORA ATLÁNTICA CANARIA" sets={3}>Paco Sánchez Jover, Venancio Costa, Antonio Miralles, Ireneusz Klos, Sergio Camarero y Chava González. También jugaron Juanma Martín, Jesús Sánchez Jover, David Rodríguez, Jorge Ramón y Óscar Campos. <strong>Entrenador:</strong> Paco Sánchez Jover.</Equipo>
          <Equipo nombre="BOMBEROS ONCE DE BARCELONA" sets={0}>Javier Rodríguez, Germán López, Antonio Alemany, Cosme Prenafeta, Rafa Pascual y Sergio Arregui. También jugó Javier Bosma. <strong>Entrenador:</strong> Vladimir Bogdevski.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Vino a lo grande el segundo trofeo que ingresó en las vitrinas del Guaguas, en 1990 denominada Constructora Atlántica Canaria. Nada más y nada menos que la Liga, un escenario que parecía inalcanzable poco antes y por las diferencias de presupuesto y potencial que se daban con los adversarios por el cetro nacional. Fue en el cuarto partido del play-off, con una exhibición de suficiencia demoledora frente al Bomberos de Barcelona, y que encumbró a un equipo con la omnipresente figura de Paco Sánchez Jover, que a mitad de campaña se hizo con la dirección técnica del equipo y lo condujo a la gloria cumpliendo, además, con su rol de vital importancia dentro del funcionamiento colectivo.</p>
          <p>El encuentro fue un monólogo amarillo y ratificó los buenos augurios de una plantilla conjurada y que nunca dudó en que culminaría con alegría una campaña en la que las exigencias ya eran totales y en virtud de un bloque reforzado con figuras de talla mundial como los polacos Golec o Klos. Una hora exacta duró la confrontación decisiva en la que Sánchez Jover tuvo un gesto inolvidable con la grada cuando quiso hacer coincidir en la cancha a cuatro grancanarios (David Rodríguez, Óscar Campos, Juanma Martín y Jorge Ramón) en el tramo final del choque y estando la fiesta ya montada a la luz de un marcador inapelable.</p>
          <p>El Centro Insular entró en éxtasis en el momento en el que se le brindó la copa soñada.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-1991": (
    <>
      <TituloDeportivo numero={3} nombre="LIGA" anio="1990-91">
        <FichaTecnica
          parciales="15-8, 15-3 y 15-3"
          arbitros="Alfonso González y Alfonso Zuazua (comité asturiano). Amonestados los entrenadores de ambos equipos."
          incidencias="Lleno total en el Centro Insular de Deportes, con casi 6.000 espectadores. Entre las autoridades destacó la asistencia del presidente y consejero de Deportes del Cabildo, Carmelo Artiles, que entregó la copa, y José Antonio Ruiz Caballero, el alcalde y concejal de Deportes del ayuntamiento capitalino, Emilio Mayoral y Sebastián Franquis, y el delegado del Gobierno en Canarias, Anastasio Travieso."
        >
          <Equipo nombre="CLUB VOLEIBOL GRAN CANARIA" sets={3}>Waclaw Golec, Sergio Camarero, Wlodzimierz Nalazek, Paco Sánchez Jover, Ireneusz Klos y Venancio Costa. También jugaron Juanma Martín y Antonio Miralles. <strong>Entrenador:</strong> Enrique Edelstein.</Equipo>
          <Equipo nombre="ORISBA PALMA" sets={0}>Benjamín Vicedo, Pompiliu Dascalu, Ramón Martín Lobo, Ernesto Rodríguez, Rafa Pascual y Bradley Willock. También jugaron Sixto Jiménez, Vladimir Shkurikin y Guillermo Calvo. <strong>Entrenador:</strong> Corneliu Oros.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Revalidar el reinado nacional con un partido para el recuerdo, sacando literalmente de la pista al Palma, que se presentaba como el claro candidato, luego de haberle ganado en los tres precedentes inmediatos y disponer de un presupuesto que doblaba al de la entidad de Juan Ruiz, fue una gesta que, directamente, elevó a la excelencia al Gran Canaria, en opinión unánime protagonista de una exhibición acaso irrepetible. Los jugadores dirigidos por Edelstein sentenciaron la final en el tercer encuentro y haciendo valer el factor cancha, un Centro Insular de nuevo convertido en una caldera de emociones y que catapultó a sus ídolos.</p>
          <p>El partido no tuvo más historia que la que quiso el campeón, que no dio opción alguna al adversario y, por momentos, tal y como reflejan los parciales, bailó a un Palma desbordado y sin recursos ante el recital del anfitrión. Imposible destacar algún nombre porque el recital colectivo rozó la perfección, aunque la conexión que orquestó Camarero con las gradas, todo nervio y corazón el del emblema de la casa, fue uno de los factores determinantes en la espectacular versión de cada uno de sus compañeros, quienes demostraron de principio a fin que la hegemonía isleña no había hecho más que comenzar a lomos de un equipo de leyenda y que estaba tirando la puerta abajo para delirio de una isla entera.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-1991": (
    <>
      <TituloDeportivo numero={4} nombre="COPA DEL REY" anio="1991">
        <FichaTecnica
          parciales="15-8, 15-8 y 15-10"
          arbitros="Antonio Morales (Gijón) y González Alonso (Vigo). Amonestaron a los locales Paco Sánchez Jover y Venancio Costa y al visitante Pero Stanic."
          incidencias="4.500 espectadores en el Centro Insular."
        >
          <Equipo nombre="CLUB VOLEIBOL GRAN CANARIA" sets={3}>Waclaw Golec, Sergio Camarero, Wlodzimierz Nalazek, Paco Sánchez Jover, Ireneusz Klos y Venancio Costa. También jugaron Juanma Martín y Antonio Miralles. <strong>Entrenador:</strong> Enrique Edelstein.</Equipo>
          <Equipo nombre="CONSTRUCCIONES ALCALÁ DE TENERIFE" sets={0}>Héctor López, Paco Hervás, Sead Omeragic, Sandeep Sharma, Pero Stanic y Juan Carlos Robles. También jugaron Toño Jiménez y Pedro Bonache. <strong>Entrenador:</strong> Paco Hervás.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>La fiesta no paró en el Gran Canaria, que poco después de haberse hecho con el título de Liga añadía un nivel más en su crecimiento imparable con la consecución de una Copa que suponía su primer doblete de la historia. En realidad nadie dudaba de que, lanzado e imparable por su exhibición en el torneo de la regularidad, los Klos, Sánchez Jover y compañía iban a seguir acaparando todos los honores, como así fue. El aliciente venía por tratarse de un derbi frente al Construcciones Alcalá Cisneros de Tenerife y en cuyas filas militaba el hindú Sandeep Sharma, un jugador muy querido en el club y que con el tiempo regresaría a la disciplina grancanaria.</p>
          <p>De nuevo con un Centro Insular engalanado para la ocasión y ya convertido en talismán, la hegemonía de Canarias se ratificó por la vía rápida, sin capacidad de respuesta del adversario y con Klos llevando el delirio a los aficionados con un saque chino que supuso el punto de partido. Antes, el internacional polaco, junto a sus compatriotas Nalazek y Golec, desarboló por completo a un Cisneros siempre por debajo del flamante ya bicampeón de Liga y de Copa, insaciable a la hora de ampliar sus vitrinas y cuyo idilio con la grada se fortificaba a base de gestas y partidos que entrarían en la hemeroteca por su resonancia única y valor especial.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-1992": (
    <>
      <TituloDeportivo numero={5} nombre="LIGA" anio="1991-92">
        <FichaTecnica
          parciales="14-16, 15-11, 15-8 y 15-7"
          arbitros="Francisco Manuel Fraile y José Fernández (comité andaluz). Amonestaron a los técnicos de ambos equipos, al local Juanma Martín y al visitante Genido da Silva."
          incidencias="El Centro Insular de Deportes registró la mayor entrada de la temporada, unos 5.000 espectadores, en el último partido del play-off final al título de la Liga de la División de Honor masculina de voleibol. El presidente del Cabildo Insular de Gran Canaria, Pedro Lezcano, entregó al capitán Juanma Martín la copa de campeón de Liga ACEVOL."
        >
          <Equipo nombre="CALVO SOTELO GRAN CANARIA" sets={3}>Sergio Camarero, Paco Sánchez Jover, Waclaw Golec, Antonio Miralles, Lars Nilsson y Juanma Martín. También jugaron Jorge Ramón, Javi Dios, Sandeep Sharma y Emilio Agustí. <strong>Entrenador:</strong> Enrique Edelstein.</Equipo>
          <Equipo nombre="ANDORRA" sets={1}>Adrián Garrido, Genido da Silva, Pascual Saurín, Angel Ortiz, Antonio Alemany y Leonardo Wiernes. También jugaron Javier Bosma, Cosme Prenafeta y Sergio Arregui. <strong>Entrenador:</strong> Luis Hillaire.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Tercer título consecutivo de Liga, que se dice pronto y que venía a ampliar la marcha triunfal de un Calvo Sotelo ya en la cima y convertido en el enemigo a batir por todos. Esta vez le tocó al Andorra doblar la rodilla en el que era el último partido del play-off y que requirió la capacidad de reacción de los jugadores de Edelstein, por debajo tras ceder el primer set y artífices de una remontada que tuvo justa recompensa. En paralelismo con los anteriores, este campeonato se fraguó en la interacción mágica con un Centro Insular de nuevo escenario de una tarde llena de emociones y con el desenlace esperado.</p>
          <p>Todos y cada uno de los protagonistas pusieron en valor el papel protagonista de la gente, animosa a más no poder en los primeros compases críticos, cuando el Gran Canaria desaprovechó hasta tres balones de set y perdió el primer juego, y cimentando la posterior exhibición de fuerza sincronizada y técnica para volver a llenar de orgullo y alegría a los presentes. Un &lsquo;penalti&rsquo; de Golec fue el punto que cerró una final ganada a pulso y que situaba a la entidad en otra dimensión por la complejidad, hecha realidad, de establecer una hegemonía clara e indiscutible.</p>
          <p>En apenas siete años entre los grandes, ya sumaba casi la mitad de entorchados y al calor de un pabellón inexpugnable.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-1992": (
    <>
      <TituloDeportivo numero={6} nombre="COPA DEL REY" anio="1992">
        <FichaTecnica
          parciales="15-6, 15-12 y 15-9"
          arbitros="Inocencio Cean (Gijón) y Alfonso Alonso (Vigo). Expulsaron al técnico visitante en el segundo set y amonestaron al jugador del Andorra da Silva."
          incidencias="El Centro Insular de Deportes registró una asistencia de aproximadamente 4.000 espectadores para presenciar la final de la XVII Copa del Rey. El presidente del Gobierno de Canarias, Jerónimo Saavedra, entregó el trofeo de campeón a Juanma Martín."
        >
          <Equipo nombre="CLUB VOLEIBOL GRAN CANARIA" sets={3}>Paco Sánchez Jover, Antonio Miralles, Waclaw Golec, Juanma Martín, Lars Nilsson y Sandeep Sharma. También jugaron Javi Dios, Jorge Ramón y Emilio Agustí. <strong>Entrenador:</strong> Marcelo Giovanacci.</Equipo>
          <Equipo nombre="ANDORRA" sets={0}>Da Silva, Wiernes, Ortiz, Garrido, Alemany y Saurín. También jugaron Bosma y Prenafeta. <strong>Entrenador:</strong> Luis Hillaire.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>El título con el que se cerró la campaña 1991-92 tenía el premio añadido, como ocurrió una campaña antes, de revalidar el doblete nacional, una proeza al alcance de elegidos, los componentes del Club Voleibol Gran Canaria que, aquella tarde del 25 de abril de 1992, estaban dirigidos por el banquillo por Marcelo Giovanacci, dado que Enrique Edelstein, con el que se había ganado la Liga poco antes, había sido destituido por unas manifestaciones públicas que no iban en concordancia con los intereses de la entidad.</p>
          <p>Pese a esta fulminante decisión, y que podría haber sido causa de desestabilización, el bloque mantuvo su inercia y despachó al Andorra con solvencia y empaque, ese aroma que tienen los campeones cuando llegaba el momento de pujar por este trofeo. Se mantenía, además, la tradición en casa, jugando y ganando ante la afición propia, que ya tenía somatizados todos los rituales del momento estelar de festejar alegrías de este calibre. Salvando el segundo set, en el que el oponente quiso rebelarse, el 3-0 final acreditó que solo hubo un dueño de las distintas situaciones del juego.</p>
          <p>Juanma Martín, Nilsson, Paco Sánchez Jover y Golec eran entronizados por su papel decisivo, alternando sus recursos técnicos con el oficio y jerarquía que pusieron al servicio del resto de sus compañeros para provocar la invasión final del parqué.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-1993": (
    <>
      <TituloDeportivo numero={7} nombre="LIGA" anio="1992-93">
        <FichaTecnica
          parciales="15-7, 11-15, 9-15, 15-8 y 11-15"
          arbitros="León y Carreño."
          incidencias="Partido disputado en el pabellón de La Juventud de Soria."
        >
          <Equipo nombre="GRUPO DUERO" sets={2}>Eduardo Macías, Roman Macek, Stand Pochop, Benjamín Vicedo, Ernesto Rodríguez y Antonio Alemany. También jugaron Juan Ignacio Osuna, Jordi Palencia, Raúl Palacios y David Díaz. <strong>Entrenador:</strong> Humberto Rodríguez.</Equipo>
          <Equipo nombre="GRAN CANARIA" sets={3}>Paco Sánchez Jover, Waclaw Golec, Chiqui Wiernes, Venancio Costa, Sergio Miguel Camarero y Jorge Ramón. También jugaron Sandeep Sharma, Falasca y Juanma Martín. <strong>Entrenador:</strong> Juanma Martín.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>A las órdenes de Juanma Martín, en cancha contraria, con Soria como testigo, y en un partido disputadísimo, resuelto en el tie break del último set y a la heroica. Así llegó la cuarta Liga, consecutiva y revestida del mérito que comportó la prueba de resistencia en tierras castellanas. Porque, a estas alturas, derrocar al equipo isleño se había convertido en una cuestión compartida por el resto de integrantes de la División de Honor, lo que redoblaba la dificultad de mantener la posición de privilegio.</p>
          <p>Fue esta Liga muy sudada y trabajada a cuenta de la resistencia que exhibió el Grupo Duero, que llevó al límite al vigente campeón pero que, a la hora de la verdad, no le alcanzó para que sus esfuerzos se tradujeran en lo que buscaba. La buena aportación del banquillo resultó clave para que las rotaciones dieran descanso a los jugadores más castigados físicamente al tiempo que se mantenía el nivel de los que estaban en la cancha. Esa profundidad de recursos marcó el diferencial, además de la perfecta compenetración que daba el disponer de jugadores que llevaban varias temporadas juntos y que, en momentos de máxima tensión, disponían de la capacidad de respuesta y eficiencia máxima.</p>
          <p>Lo que se suele denominar en todas las disciplinas como &lsquo;la suerte del campeón&rsquo; y que radica en ese instinto de supervivencia.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-1993": (
    <>
      <TituloDeportivo numero={8} nombre="COPA DEL REY" anio="1993">
        <FichaTecnica
          parciales="15-2, 11-15, 15-12, 5-15 y 18-20"
          arbitros="José Antonio González (Vigo) y Víctor Viña (Gijón). Amonestaron a Rafa Pascual, Wiernes y Paco Sánchez Jover."
          incidencias="Un millar de espectadores en el Polideportivo Municipal Príncipe de Asturias de Murcia."
        >
          <Equipo nombre="UNICAJA ALMERÍA" sets={2}>Yu Yiqing, Milanov, Rafa Pascual, Cosme Prenafeta, Joaquín Parrado y Jesús Sánchez Jover. También jugaron Fabio Díez, Carlos Carreño y Javi Dios. <strong>Entrenador:</strong> Axel Mondi.</Equipo>
          <Equipo nombre="GRAN CANARIA" sets={3}>Paco Sánchez Jover, Waclaw Golec, Venancio Costa, Sergio Miguel Camarero, Chiqui Wiernes y Jorge Ramón. También jugaron Sandeep Sharma y Miguel Ángel Falasca. <strong>Entrenador:</strong> Juanma Martín.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>El suma y sigue en el reinado nacional del Gran Canaria, materializando su tercer doblete consecutivo con la Copa del Rey alzada en Murcia y con una sobresaliente actuación en la final frente a un Almería poderoso y que, por momentos, soñó con salir por la puerta grande. De hecho, inició el choque con un imponente 10-0 a favor, lo que le puso en bandeja un primer set que prácticamente tenía desde la salida de los vestuarios. Pero un entonado Falasca, señalado como el líder en la reacción posterior, así como la eficiente labor defensiva de Paco Sánchez Jover ante las acometidas de Rafa Pascual, canalizaron el camino para no bajarse del trono.</p>
          <p>La afición grancanaria, que animó en minoría aunque haciéndose notar, pudo disfrutar de una actuación completísima, y de menos a más, de sus jugadores, también con la fortuna de cara ya que el Unicaja dispuso de hasta tres balones de partido que no aprovechó, a diferencia de los hombres de Juanma Martín, que no perdonaron cuando llegó el momento decisivo demostrando una casta y personalidad a prueba de circunstancias. En el club valoraron de la mejor manera esta Copa porque, además de prolongar una línea perfecta en las competencias domésticas, suponía una prueba más de la vena competitiva y ambiciosa de un grupo que no se cansaba de ganar y asumía cada desafío con la ilusión del principiante, que no era el caso precisamente por la trayectoria jalonada de éxitos y reconocimientos que ya se acumulaba y que diferenciaba al Gran Canaria del resto.</p>
          <p>Encima, en la Copa de Europa se había materializado un quinto puesto que ayudaba a cerrar, con inmejorable balance, otra temporada de objetivos cumplidos y satisfacciones plenas.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-1994": (
    <>
      <TituloDeportivo numero={9} nombre="LIGA" anio="1993-94">
        <FichaTecnica
          parciales="12-15, 15-5, 12-15 y 8-15"
          arbitros="Andrés (Madrid) y Aller (Gijón)."
          incidencias="Más de 1.500 espectadores en el pabellón de La Joventud de Soria."
        >
          <Equipo nombre="GRUPO DUERO" sets={1}>Macek, Macías, Vicedo, Pochop, Garrido y Rodríguez. También jugaron Palacios, Díaz, Palencia y Sharma. <strong>Entrenador:</strong> Paulo Sevciuc.</Equipo>
          <Equipo nombre="GRAN CANARIA" sets={3}>Venancio Costa, Paco Sánchez Jover, Waclaw Golec, Milanov, Falasca y Sergio Miguel Camarero. También jugaron Colom, Sánchez y Jorge Ramón. <strong>Entrenador:</strong> Juanma Martín.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Quinta Liga consecutiva, récord en el voleibol nacional que pertenecía a la extinta sección del Real Madrid, que lo logró entre 1976 y 1980, y que el Gran Canaria igualó con su sensacional actuación en Soria y en el cuarto partido de los play-offs de la temporada 1993-94. Imposible pedirle más al conjunto dirigido con maestría por Juanma Martín desde la banda y en el que, una vez más, emergió un Golec intratable que condujo a sus compañeros a este hito. Pese a los esfuerzos de Sharma, viejo conocido que ejerció de rival en el Grupo Duero, y a la presión ejercida por las 1.500 personas que empujaron a favor de los anfitriones, la enésima demostración de superioridad trajo el premio mayor de añadir un diamante más a la corona.</p>
          <p>Especialmente emotivo fue el multitudinario recibimiento en el aeropuerto a los miembros de la expedición al grito de &lsquo;campeones&rsquo; y tal fue la emoción que Paco Sánchez Jover, ya convertido en una institución, optó, al calor de esta alegría, aplazar su retirada como jugador profesional. Seguía, pues, bien vigente y abrillantado el ciclo de un Gran Canaria convertido en rey nacional y ejemplificando un perfecto binomio ambición-compañerismo, señalado como la clave de esta cadena de gloria y triunfos trascendentes.</p>
          <p>Esa nueva Liga venía a sublimar un proyecto sostenido en el tiempo y perfeccionado siempre.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-1996": (
    <>
      <TituloDeportivo numero={10} nombre="COPA DEL REY" anio="1996">
        <FichaTecnica
          parciales="15-3, 15-13, 14-16, 13-15 y 15-11"
          arbitros="Vicente Crespo (Valencia) y Andrés Tomás (Madrid)."
          incidencias="Más de 3.000 espectadores asistieron a este encuentro disputado en el Centro Insular de Deportes."
        >
          <Equipo nombre="GRAN CANARIA" sets={3}>Sharma, Klos, Golec, Joel Sotelo, Rueda y Miralles. También jugaron Alexis Valido, Martín, Antonio Sánchez y Camarero. <strong>Entrenador:</strong> Paco Sánchez Jover.</Equipo>
          <Equipo nombre="CAJA SALAMANCA Y SORIA" sets={2}>Pochop, Gallis, Hernández, Garrido, David Sánchez y Eduardo Sánchez. También jugaron Osuna, Saura y Díaz. <strong>Entrenador:</strong> Benjamín Vicedo.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Dos años de sequía sin títulos, demasiado tiempo para un equipo cimentado a base de campeonatos y festejos, hicieron que la celebración de la Copa del Rey conquistada en 1996 se amplificara al máximo y en reconocimiento a unos jugadores que, como así se demostró, mantenían el orgullo intacto y el carácter ganador. Así se explica que volvieran a provocar un terremoto de felicidad en el Centro Insular con la final ganada al Soria, emotiva, también, por despedidas ilustres como la de los polacos Golec y Klos, emblemas en la cronología moderna de la entidad y que, entre lágrimas y emoción, pudieron poner el epílogo de oro a su maravillosa historia en el club.</p>
          <p>Tampoco volvería a verse de corto a Camarero, desde los tiempos remotos del Lucky Calvo Sotelo en nómina y que también cerraba una etapa insuperable. Inevitable que tanto condicionante afectivo no marcara un partido en el que hubo que superar adversidades como la temprana lesión de Sandeep Sharma, lo que obligó a Sánchez Jover a retocar su plan inicial en un encuentro que se fue hasta los 155 minutos por la igualdad imperante. Eso sí, la justicia final brilló en lo más alto del electrónico porque las mejores acciones y la mayor intensidad correspondieron a un Gran Canaria mejor posicionado y en el que el mexicano Joel Sotelo fue un elemento destacado por sus acciones ganadoras.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-supercopa-1994": (
    <>
      <TituloDeportivo numero={11} nombre="SUPERCOPA DE ESPAÑA" anio="1993-94">
        <FichaTecnica
          parciales="10-15, 15-10, 15-4 y 15-12"
          arbitros="Andrés Tomás (Madrid) y Miguel Ángel Santiago (Tenerife). Amonestaron al local Falasca y al técnico Paco Sánchez Jover por parte local y a Garrido del Soria."
          incidencias="Unos 1.000 espectadores en el Centro Insular de Deportes. En la entrega de trofeos estuvieron presentes el director general de Deportes del Gobierno de Canarias, Díaz Almeida, y el vicepresidente del Ejecutivo autónomo, Lorenzo Olarte, así como el presidente de la Federación Canaria de Voleibol, José Millán, y el presidente del club grancanario Juan Ruiz."
        >
          <Equipo nombre="GRAN CANARIA AREHUCAS" sets={3}>Venancio Costa, Carlos Carreño, Antonio Sánchez, Miguel Ángel Falasca, Danny Pointe y Joel Sotelo. También jugaron Juan Carlos Robles, Antonio Miralles y Dani Castañeda. <strong>Entrenador:</strong> Paco Sánchez Jover.</Equipo>
          <Equipo nombre="CAJA SALAMANCA Y SORIA" sets={1}>Ángel Alonso, Garrido, José Luis Moltó, Peter Gallis, Pochop y Saura. También jugaron Martínez, Sánchez y Parejo. <strong>Entrenador:</strong> Benjamín Vicedo.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Era un título que faltaba en las vitrinas y que, tras dos intentonas anteriores y con su rango oficial, tenía un valor indudable en los intereses del Gran Canaria Arehucas, que abrió la temporada 1996-97 de la mejor manera. Derrotar al vigente campeón de Liga, por mucho que a mitad de septiembre el nivel de juego y rendimiento estuviese pendiente de mayor rodaje y perfeccionamiento, fue un empujón de optimismo y energía, como así se admitió de manera unánime por parte de los protagonistas. El papel jugado por Danny Pointe, una de las incorporaciones del nuevo proyecto, resultó de importancia fundamental para tumbar al equipo castellano, que obligó a remontar un 0-1 en contra, por los fallos cometidos en la recepción, pero que no pudo contener la oleada posterior de los amarillos, en la que la veteranía de Venancio Costa ejerció de correa transmisora para que el resto se aplicara con la suficiente contundencia y precisión para apuntarse las tres mangas posteriores.</p>
          <p>Sánchez Jover, ya en plena gestión del relevo generacional y con una plantilla muy renovada, resaltaba que, en las aspiraciones futuras, contar con el respaldo de esta conquista iba a ser de enorme ayuda, más en el contexto de los cambios que estaban en camino en la entidad tras un inicio de década para enmarcar y que situó listones ya inalcanzables.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-1997": (
    <>
      <TituloDeportivo numero={12} nombre="COPA DEL REY" anio="1997">
        <FichaTecnica
          parciales="3-15, 6-15, 15-8, 15-2 y 15-12"
          arbitros="Diego León (Barcelona) y Andrés Tomás (Madrid). Tarjeta roja a Robles y Elgueta."
          incidencias="El Centro Insular de Deportes reunió a más de 4.000 espectadores en la final de la XXII Copa de voleibol. Destacó la presencia del consejero de Cultura y Deportes y el director general de Deportes del Gobierno de Canarias, José Mendoza y Juan Antonio Díaz, respectivamente, y de los concejales del ayuntamiento de Las Palmas de Gran Canaria Juan José Cardona y Pascual Mota."
        >
          <Equipo nombre="GRAN CANARIA AREHUCAS" sets={3}>Joel Sotelo, Miguel Ángel Falasca, Venancio Costa, Robles, Vega y Carreño. También jugaron Miralles, Pointe, Castañeda, Antonio Sánchez y Andersson. <strong>Entrenador:</strong> Paco Sánchez Jover.</Equipo>
          <Equipo nombre="UNICAJA ALMERÍA" sets={2}>Prenafeta, Elgueta, Rodríguez, Sánchez, Matheus y Parrado. También jugaron Prieto y Berenguel. <strong>Entrenador:</strong> Axel Mondi.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>En poco más de cuarenta minutos, la final parecía sentenciada con un 0-2 para el Almería y con parciales más que ilustrativos. El Centro Insular se resignaba al desmoronamiento de los suyos cuando Sánchez Jover movió fichas de manera providencial y, con un sexteto revolucionario, con especial influencia de Castañeda, Antonio Sánchez y un Miralles que, tras haber contado poco durante la campaña, revivió su mejor versión, el Gran Canaria obró una remontada soberbia y, en una hora justa de juego, justificó su fama de rey de Copas (era la décima final consecutiva de este torneo que disputaba).</p>
          <p>Fue una exhibición como en los viejos tiempos, mezclando raza, talento, casta y ambición. Volvieron los abrazos y las caras iluminadas por la felicidad cuando se consumó un triunfo que, en palabras del técnico, “dejaba las cosas en su sitio”. Porque ni con todo en contra hubo amago alguno de rendición. Los más de 4.000 espectadores presentes hicieron el resto empujando a los suyos a medida que tomaba forma una rebelión que terminó de la mejor manera. Esta final se equiparó a la primera saldada con éxito, allá por 1989, por su nivel de dificultad y las complejidades que presentó en su arranque y así se saboreó, de una manera única y poniendo en justa medida el esfuerzo y tesón que implicó levantarse de la lona cuando el adversario tocaba con los dedos el trofeo.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-2021": (
    <>
      <TituloDeportivo numero={13} nombre="COPA DEL REY" anio="2021">
        <FichaTecnica
          parciales="25-20, 25-15 y 25-14"
          arbitros="Erce Álvarez y Correa Álvarez."
          incidencias="Encuentro disputado en el Centro Insular."
        >
          <Equipo nombre="CLUB VOLEIBOL GUAGUAS" sets={3}>Paulo Bertassoni, Jorge Almansa, Matt Knigge, Pablo Kukartsev, Guilherme Hage, Moisés Cézar y Alejandro Fernández. También jugaron Javier Sánchez y Stéfano Nassini. <strong>Entrenador:</strong> Sergio Camarero.</Equipo>
          <Equipo nombre="URBIA U ENERGIA PALMA" sets={0}>Ricardo Perini, Gabriel del Carmen, Elvis de Oliveira, Roberto de Melo, Juan Manuel González, Walter da Cruz y Daniel Ruiz. También jugaron Abel Bernal, De la Rosa, Pont, Renzo Cairus y Juan Lladó. <strong>Entrenador:</strong> Marcos Dreyer.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>En el proyecto de reconstrucción materializado en 2020 para que el Guaguas volviera a ser lo que fue, la conquista de títulos era una misión de obligado cumplimiento. La naturaleza ganadora jamás se había negociado en la historia de la entidad y por muy buenos propósitos que se pusieran, la vitrina esperaba. Y el 7 de febrero de 2021, en un Centro Insular vacío por imperativos sanitarios derivados de la pandemia de covid-19, el equipo dirigido por Sergio Miguel Camarero comenzaba a responder con hechos.</p>
          <p>La Copa del Rey era el primer desafío, con el Palma como rival en el partido decisivo, y la respuesta de los jugadores fue impecable. Un claro 3-0, con protagonismo especial de un Pablo Kukartsev letal, designado como MVP del torneo tras anotar 20 puntos en la final, evidenció que, efectivamente, las líneas maestras trazadas para el retorno del escudo habían sido precisas. Apenas unos meses después de la puesta en funcionamiento del club, volver a levantar un trofeo oficial era la mejor manera de ratificar aspiraciones y premiar esfuerzos.</p>
          <p>De ahí que la satisfacción en todos los jugadores, técnicos y dirigentes fuese palpable a la vista de una celebración merecida y oportuna que, sin que todavía no se supiera, abría un año en el que seguirían sucediéndose los éxitos para mayor gloria propia.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-2021": (
    <>
      <TituloDeportivo numero={14} nombre="LIGA" anio="2020-21">
        <FichaTecnica
          parciales="26-24, 19-25, 19-25 y 20-25"
          arbitros="Susana Rodríguez (Albacete) y Fernando Cerrato (Murcia). Amonestaron al local Iribarne y al jugador del Guaguas Hage."
          incidencias="Partido disputado en el pabellón Moisés Ruiz de Almería a puerta cerrada."
        >
          <Equipo nombre="UNICAJA COSTA DE ALMERÍA" sets={1}>Javier Jiménez, Alejandro Vigil, Ignacio Sánchez, Fran Iribarne, Miki Fornés y Augusto Colito. También jugaron Mario Ferrera, Curro Sáez, Esteban Villarreal, Jean Pascal Diedhiou y Marlon Palharini. <strong>Entrenador:</strong> Manuel Berenguel.</Equipo>
          <Equipo nombre="CLUB VOLEIBOL GUAGUAS" sets={3}>Paulo Renan, Jorge Almansa, Matthew Knigge, Pablo Kukartsev, Guilherme Hage y Moisés Cézar. También jugaron Álex Fernández, Nassini y Javier Sánchez. <strong>Entrenador:</strong> Sergio Camarero.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>No conseguía un doblete de Liga y Copa el Guaguas desde hacía casi 30 años. Y el sueño de coronarse de nuevo como dominador del panorama nacional acaparando los dos trofeos oficiales más importantes volvió a ser una realidad en 2021. Semanas después de apuntarse el torneo copero, el equipo afrontó el desafío de no fallar en la conquista que todos aguardaban con mayor expectación y cuyo último entorchado se remontaba a 1994, nada más y nada menos. La Liga era la razón de ser de todos los esfuerzos y Camarero mentalizó a sus hombres a conciencia y el resultado fue el esperado, alzando los brazos al cielo en el encuentro definitorio ante el Unicaja Almería, para el 3-0 final de la serie, pese a que tocó remontar un set en contra.</p>
          <p>El excelente papel protagonizado por Kukartsev, autor de 25 puntos y guía del resto en su condición de jugador más valioso de la gran final, aupó al Guaguas a la cima que suponía su sexta Liga y que se recibía por todo lo alto, como era menester. Toda la expedición desplazada a tierras andaluzas, con el presidente Juan Ruiz al frente, explotó de alegría cuando el capitán, Moisés Cézar, recibió el trofeo acreditativo y que ratificaba un reinado indiscutible, guiño por los viejos tiempos y sustento del futuro que se sigue escribiendo en estos momentos.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-supercopa-2021": (
    <>
      <TituloDeportivo numero={15} nombre="SUPERCOPA DE ESPAÑA" anio="2021">
        <FichaTecnica
          parciales="25-22, 25-15 y 25-20"
          arbitros="Rodríguez Machín y R. Sánchez."
          incidencias="Partido disputado en el Centro Insular de Deportes con media entrada."
        >
          <Equipo nombre="CLUB VOLEIBOL GUAGUAS" sets={3}>Borja Ruiz, Paulo Renan, Jorge Almansa, Matt Knigge, Yosvany Hernández, Guilherme Hage y Alejandro Fernández. También jugaron Adrián Escobar, Moisés Cézar y César Martín. <strong>Entrenador:</strong> Sergio Camarero.</Equipo>
          <Equipo nombre="URBIA U ENERGIA PALMA" sets={0}>Ignacio Sánchez, Chema Giménez, Sunny Wu, Rodrigo Pernambuco, Renzo Cairus, Manu Carvalho y Daniel Ruiz. También jugaron Guillem Pont y Juan Lladó. <strong>Entrenador:</strong> Abel Bernal.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>No podía darse mejor inicio de temporada 2021-22 que en el Centro Insular, ya con asistencia permitida de público, y un título oficial en juego, en este caso, la Supercopa de España, en la que comparecía como finalista invitado el Palma, luego del doblete nacional logrado en el curso 2020-21. Era el estreno, además, de un nuevo Guaguas, reforzado con fichajes de postín, como los cubanos Hernández y Escobar, y con un proyecto ya consolidado, tras un año de rodaje triunfal, y en búsqueda de más desafíos.</p>
          <p>Y como lo inmediato siempre manda, Camarero, insaciable, le pidió a sus hombres que no dejaran de hacer lo que mejor sabían: ganar y ganar. Y así cayó la segunda Supercopa de la historia, en una final con un desarrollo lineal: dominio de principio a fin y con protagonismo estelar para Yosvany Hernández, MVP de la jornada merced a sus 24 puntos y una demostración magnífica de poderío y recursos. No tuvo opciones un adversario superado y que comprobó la potencia de un equipo cohesionado, con los automatismos del juego bien definidos, y que no dejó pasar la oportunidad de seguir dando brillo a su sala de trofeos.</p>
          <p>Una segunda Supercopa en el historial que fue bien valorada y considerada por todos en un momento de especial emotividad en Canarias por la explosión volcánica en La Palma, acaecida una semana antes, y que motivó una sincera dedicatoria de este nuevo éxito.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-2023": (
    <>
      <TituloDeportivo numero={16} nombre="LIGA" anio="2023">
        <FichaTecnica
          parciales="25-22, 25-15, 22-25 y 25-21"
          arbitros="Juan Antonio Erce – Rafael González."
          incidencias="Tercer encuentro de la final de la Superliga Masculina disputado en el Centro Insular de Deportes de Las Palmas de Gran Canaria ante 3.800 espectadores. El presidente de la RFEVB Agustín Martín Santos entregó a Alejandro Fernández, capitán de CV Guaguas, el trofeo de campeón. El receptor de CV Guaguas Paolo Zonca fue designado MVP de la final por su aportación a lo largo de la eliminatoria."
        >
          <Equipo nombre="CV GUAGUAS" sets={3}>Escobar, De Amo, Almansa, Zonca, Knigge, Ramos, Ruiz. También jugaron: Fernández, Olalla, Bertassoni, Rattray, Fernández, Ruiz, Conde. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
          <Equipo nombre="RÍO DUERO SORIA" sets={1}>Lorente, Villalba, Moreno, Vargas, Dos Santos, Domenech, San Martín. También jugaron: Pérez, Salvador, Pyvovarenko, Jiménez, Tenorio. <strong>Entrenador:</strong> Alberto Toribio.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Venía el Guaguas de un año 2022 seco de alegrías y con la necesidad imperiosa de sacudirse el vértigo heredado. Y la mejor medicina vino con la restitución de la hegemonía doméstica en el campeonato regular. Lo hizo de una manera abrumadora, ganando todos y cada uno de los partidos con una lección de eficacia y superioridad imbatible y ante la que los rivales no tuvieron capacidad alguna de contestación. El Río Duero Soria, en último término, y en la eliminatoria decisiva, no pudo más que someterse a la neta superioridad amarilla, rubricada con pleno de triunfos en el emparejamiento y fin de fiesta perfecto en el CID.</p>
          <p>Pese los intentos de resistencia visitante, el festival de Zonca, a la sazón MVP, así como la maestría en la distribución de Miguel Ángel De Amo resultaron determinantes en el desenlace por todos esperado y que registraba en la historia una nueva conquista. Camarero pudo darse el lujo de otorgar minutos a todos sus jugadores a modo de homenaje y con el acompañamiento inigualable de un Centro Insular que registró un magnífico ambiente para la ocasión. La recogida del trofeo provocó una oleada de felicidad y alegría por parte del auditorio, entregado a un equipo que volvía por sus fueros ampliando su cosecha de entorchados.</p>
          <p>Otra vez el Guaguas era motivo de orgullo y admiración por su genética ganadora y espíritu de superación.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-iberica-2023": (
    <>
      <TituloDeportivo numero={17} nombre="COPA IBÉRICA" anio="2023">
        <FichaTecnica
          parciales="25-23, 25-22, 19-25 y 25-18"
          arbitros="Juan Antonio Erce y Ricardo Ferreira."
          incidencias="Partido disputado en el CID, que presentó media entrada."
        >
          <Equipo nombre="CV GUAGUAS" sets={3}>Nico Bruno, Vigrass, Furtado, Walla Souza, Io de Amo, Jorge Almansa, Juan Moreno, Jean Pascal, Maxi Cavanna, Unai Larrañaga, Hugo López y Ezequiel Pérez. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
          <Equipo nombre="BENFICA" sets={1}>Thiago de Oliveira, Wohlfahrtsatatter, Seabra, Lucas Gaspar, Pablo Ventura, Felipe Airton, Lucas dos Santos, Eduardo da Cruz, Tiago da Silva, André Ryuma, Nuno Marques, Diodo Fernandes, Pontes Cabral e Ivo Correia. <strong>Entrenador:</strong> Marcel Eickhoff.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>El honor de adjudicarse la primera edición de este trofeo oficial correspondió al Guaguas que, además, lo hizo en su condición de anfitrión. El formato de la Copa Ibérica contemplaba una eliminatoria previa, saldada con triunfo ante el Sporting de Lisboa, y la correspondiente final, en la que tocó en suerte otro destacado representante luso, en este caso el Benfica, que había superado en su cruce al Soria. El encuentro pillaba al bloque en el inicio de un nuevo proyecto, con rodaje justo pero ambición siempre innegociable.</p>
          <p>Con un título en juego, Camarero jamás negocia. Y bien que se aplicaron sus pupilos en dejar la copa en casa, con un inicio fulminante (2-0) que encarriló, definitivamente, la contienda. El argentino Cavanna, una de las grandes apuestas de entonces, se erigió en figura y referente, liderando al resto para desembocar en la foto triunfal. El mérito añadido vino con el arreón de orgullo de un Benfica que requirió un cuarto set en el que sí se dio la sentencia para reproducir la habitual foto final del Guaguas en lo alto del podio y presumiendo de una nueva adquisición para sus vitrinas.</p>
          <p>En la entidad hizo especial ilusión ganar la Copa Ibérica inaugural por el componente histórico que implicaba, sin descuidar el impulso anímico que también implicó batirse, con excelente nota, a lo mejor del voleibol portugués.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-supercopa-2023": (
    <>
      <TituloDeportivo numero={18} nombre="SUPERCOPA DE ESPAÑA" anio="2023">
        <FichaTecnica
          parciales="23-25, 25-20, 25-19, 22-25 y 15-8"
          arbitros="Hugo Suárez – Rafael González."
          incidencias="Partido correspondiente a la Supercopa Masculina que abrió la temporada 2023-24 en la máxima categoría disputado en el Centro Insular de Deportes."
        >
          <Equipo nombre="CV GUAGUAS" sets={3}>Nicolás Bruno, Manu Furtado, Wallyson Bezerra Souza, Jean Pascal Diedhiou, Paolo Zonca, Maxi Cavanna, Unai Larrañaga. También jugaron: Graham Vigrass, de Amo, Jorge Almansa, Juan Pablo Moreno. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
          <Equipo nombre="GRUPO HERCE SORIA" sets={2}>Lucas Lorente, Fabián Flores, Adrián Olalla, José Villalba, Bruno Cunha, Joan Domenech, Alejandro San Martín. También jugaron: Luke Belda, Santiago Aulisi. <strong>Entrenador:</strong> Luis Alberto Toribio.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Con los ecos recientes de la Copa Ibérica, ganada pocos días antes, la sed de gloria del Guaguas escribió un capítulo más con motivo de la tradicional apertura de curso con la primera corona nacional en juego. Enfrente, un rival de sobra conocido y con numerosos antecedentes en duelos fratricidas, el Grupo Herce Soria, lo que garantizaba emociones fuertes sobre la pista del Centro Insular. Y todos los pronósticos se cumplieron porque el pleito tuvo que irse hasta el tie break (2-2). Había empezado todo con rebelión visitante para ponerse 0-1 y costó un esfuerzo titánico (y un Paolo Zonca sublime, autor de 23 puntos y apariciones oportunísimas).</p>
          <p>Y en la manga decisiva, temple y madurez: el Guaguas abrió con seis puntos de ventaja el quinto y último set (9-3), alejándose lo suficiente del marcador para asegurar la tercera Supercopa de España en su palmarés hasta ese momento y alargaba una inercia triunfal de indudable impacto positivo para arrancar una campaña que depararía muchas más alegrías. El impulso que había dado la Copa Ibérica tuvo continuación en este frente abierto y terminó por propulsar a un equipo con automatismos marcados y capaz de lograr todo lo que se propusiera, ya fuera un pleno nacional, como así volvería a suceder.</p>
          <p>Más leyenda con nombres propios.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-2024": (
    <>
      <TituloDeportivo numero={19} nombre="COPA DEL REY" anio="2024">
        <FichaTecnica
          parciales="25-27, 17-25 y 20-25"
          arbitros="Carlos Robles – David Fernández."
          incidencias="Final de la XLIX Copa de SM El Rey celebrada en el Pabellón Europa de Leganés ante 4.000 espectadores (Lleno). El Presidente del Comité Olímpico Español Alejandro Blanco hizo entrega a Miguel Ángel de Amo el trofeo acreditativo como MVP de la XLIX Copa de SM el Rey. El alcalde de Leganés, Miguel Ángel Recuenco, y Agustín Martín Santos, presidente de la RFEVB, entregaron a Jorge Almansa, capitán de CV Guaguas, el trofeo de campeón de la XLIX Copa de SM El Rey."
        >
          <Equipo nombre="UNICAJA COSTA DE ALMERÍA" sets={0}>Rodríguez, Bertassoni, Fernández, Neaves, Ruiz, Ruiz, Fernández. También jugaron: Viera, Fernández, Vizcaino. <strong>Entrenador:</strong> Manuel Berenguel.</Equipo>
          <Equipo nombre="CV GUAGUAS" sets={3}>Bruno, Saxton, Bezerra, De Amo, Diedhiou, Zonca, Larrañaga. También jugaron: Furtado, Almansa, Ramos. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Un pabellón Europa de Leganés abarrotado, rozando el techo de los 5.000 espectadores, contempló una nueva exhibición que valió otro título más y con absoluta justicia, dado un marcador inapelable que evidenció la superioridad manifiesta del campeón. La distribución de Miguel Ángel de Amo, elegido MVP del torneo, y las aportaciones mayúsculas de Walla Bezerra, Paolo Zonca y Nicolás Bruno anularon completamente al equipo andaluz, en el que los puntos de Neaves resultaron insuficientes en sus deseos de mantenerse en el partido.</p>
          <p>Tras un primer set igualado, y que se decidió por pequeños detalles y con un punto de oro de Bruno, todo lo que vino después fue más concluyente para los intereses del Guaguas, favorecido, además, por los errores en el saque del oponente. Y sin perder la tensión, pese a que el marcador acompañó siempre, se fue cincelando la consecución de una Copa del Rey que engordaba todavía más un curso que había arrancado con el doblete Copa Ibérica-Supercopa de España. Jean Pascal Diedhiou, de menos a más a nivel individual en la gran final, fue el encargado de coronar la faena en Madrid con el remate ganador y que inició los festejos en un ambiente inmejorable y que aumentó, más si cabe, el impacto de un nuevo laurel añadido a la corona insuperable de la entidad.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-2024": (
    <>
      <TituloDeportivo numero={20} nombre="LIGA" anio="2024">
        <FichaTecnica
          parciales="24-26, 22-25, 25-17 y 17-25"
          incidencias="Partido disputado en el Pabellón Municipal Los Pajaritos de Soria con gran afluencia de público y seguidores del Guaguas en las gradas."
        >
          <Equipo nombre="GRUPO HERCE SORIA" sets={1}>Llorente, Pequeño, Olalla, San Martín, Flores, Tenorio, Santos, Aluisi, Villalba, Salvador, Zazo, Belda, Sanchís, Giménez y Doménech. <strong>Entrenador:</strong> Alberto Toribio.</Equipo>
          <Equipo nombre="CV GUAGUAS" sets={3}>Pascal, Bruno, Walla, Zonca, Ramos, De Amo, Larrañaga, Moreno, Finoli, Vigrass, Pérez, Furtado, Almansa y López. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>La octava Liga del Guaguas vino a poner el corolario de lujo a un curso en el que antes se habían levantado otros tres trofeos (Copa Ibérica, Supercopa de España y Copa del Rey). El festejo en Soria consagró a una plantilla que cumplió con nota sobresaliente con todos los objetivos propuestos y, por encima de todo, protegió esa hegemonía nacional que ha sido sello distintivo y una cuestión de orgullo. La conclusión favorable de la serie no estuvo exenta de algunas dificultades, como el hecho de que el Grupo Herce Soria rompiera el factor cacha ganando uno de los dos primeros encuentros celebrados en el CID.</p>
          <p>Todo un órdago para los jugadores de Camarero, ya obligados a lidiar con ambiente adverso en lo que quedaba de la serie si no se llegaba al quinto encuentro. Y fue así, no se llegó al límite porque la respuesta en cancha castellana fue perfecta. Y en la primera ocasión que se pudo sentenciar la eliminatoria, a nadie le temblaron las piernas. Walla y Zonca fueron los actores más destacados en un esfuerzo coral y constante que neutralizó cualquier intento de los locales. Una nueva lección, y ya son incontables, del gen único de un equipo habituado a lo que en otros sitios resulta imposible e inalcanzable: encadenar victorias y campeonatos como rutina existencial.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-supercopa-2024": (
    <>
      <TituloDeportivo numero={21} nombre="SUPERCOPA DE ESPAÑA" anio="2024">
        <FichaTecnica
          parciales="25-18, 25-18 y 25-10"
          arbitros="Fernández Fuentes y Sabroso Moratilla."
          incidencias="Partido correspondiente a la XXVII Supercopa de España en la temporada 2024-25 disputado en el Gran Canaria Arena ante 2.700 espectadores."
        >
          <Equipo nombre="CV GUAGUAS" sets={3}>Pascal, Walla, Bruno, Ramos, De Amo, Rousseaux y Larrañaga. También jugaron: Trinidad, Moreno, Almansa, Nalobin y Pereira. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
          <Equipo nombre="UNICAJA COSTA DE ALMERÍA" sets={0}>González, Ruiz, Bertassoni, J. Fernández, Tarrazo, Todd y F.J. Fernández. También jugaron: Filip. <strong>Entrenador:</strong> Pablo Ruiz.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Todos los títulos son especiales “porque cuesta muchísimo ganarlos”, recuerda siempre que puede el presidente Juan Ruiz. Y debe ser verdad porque lleva unos cuantos bajo su mandato y nunca deja de enfatizar la importancia de valorarlos y saborearlos. La Supercopa del año 2024 tuvo la connotación distinguida de producirse en el estreno del equipo en el Gran Canaria Arena. El CID había sido el escenario de todos los sueños cumplidos y, por los trabajos de rehabilitación y modernización del emblemático recinto de la Avenida Marítima, ahora tocaba continuar la vida en Siete Palmas, sin rebajar lo más mínimo ambiciones y desafíos.</p>
          <p>Y el debut en la nueva casa era ni más ni menos que una final y con el premio de seguir ampliando la leyenda. Un cartel imbatible que activó, como de costumbre, a los jugadores, hasta el punto de arrasar al Almería. Camarero no buscó excusas en que se estaba al inicio de una nueva temporada y que el nivel físico o la cohesión del grupo caminaban todavía por una estación experimental. Pidió que se ganara y pasó lo que tenía que pasar con Walla de nuevo en plan estelar y aportaciones también destacadas de Bruno, Ramos o Rousseaux, entre otros.</p>
          <p>Inmejorable bautizo con delirio de la afición por seguir reconociendo a su Guaguas campeón pese a la inevitable mudanza.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-copa-2025": (
    <>
      <TituloDeportivo numero={22} nombre="COPA DEL REY" anio="2025">
        <FichaTecnica
          parciales="15-25, 18-25, 25-23 y 23-25"
          arbitros="Rubén Sánchez y Carlos A. Robles."
          incidencias="Final de la Copa de SM el Rey celebrada en el CDM Siglo XXI de Zaragoza ante 1.360 espectadores. Cristina García, directora general de Deportes del Gobierno de Aragón, hizo entrega del trofeo de MVP de la Copa al opuesto de CV Guaguas Wallyson Bezerra. Jorge Almansa, capitán de CV Guaguas, recogió el trofeo de campeón."
        >
          <Equipo nombre="CONECTABALEAR CV MANACOR" sets={1}>Ribas, Romaní, Lorente, Godbold, Calvo, Cairus, Marzo. También jugaron: Alomar, Vanco, Flequer. <strong>Entrenador:</strong> Alexis González.</Equipo>
          <Equipo nombre="CV GUAGUAS" sets={3}>Bruno, Bezerra, De Amo, Diedhiou, Rousseaux, Ramos, Larrañaga. También jugaron: Pérez, Almansa, Trinidad. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Hacía más de diez años que un equipo no lograba encadenar dos títulos coperos seguidos y tuvo que ser el Guaguas, que en Zaragoza defendía trono, el que rompió esa mala tradición para el campeón. Frente a un debutante en la élite que jamás se rindió y trató de darle emoción al partido, el brazo ejecutor de Walla (¡28 puntos!) se elevó por encima de todos y terminó agarrando el trofeo con determinación, para bien de su equipo. El ambientazo en Zaragoza y el entusiasmo del oponente, muy por debajo del Guaguas pero que plantó batalla, condimentaron una actuación característica del Guaguas en cada final que ha jugado: intensidad, concentración y madurez.</p>
          <p>Esa cualidad competitiva se valió para abrir brecha con dos sets a favor, disputar la tercera manga que se le fue por poco y, ya en el juego decisivo, exhibir artillería para aplacar al Manacor. Walla, apariciones puntuales pero valiosísimas de Martín Ramos, encargado de sellar el triunfo, o Diedhiou se encargaron de que Jorge Almansa, el gran capitán, alzara al cielo una Copa del Rey con sabor especial porque ratificaba aún más un reinado firme y brillante y que anticipaba más alegrías en camino.</p>
          <p>De hecho, semanas después, volvería a darse una celebración con un nuevo campeonato liguero que conformó el siempre ansiado y tan complicado doblete.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-liga-2025": (
    <>
      <TituloDeportivo numero={23} nombre="LIGA" anio="2025">
        <FichaTecnica
          parciales="23-25, 21-25 y 20-25"
          arbitros="María Gloria Souto – Juan Antonio Erce."
          incidencias="Tercer partido correspondiente a la serie final de la Superliga Masculina de Voleibol 2024-25 disputado en el Pabellón de Los Pajaritos ante 2.600 espectadores."
        >
          <Equipo nombre="GRUPO HERCE SORIA" sets={0}>Arjones, Flores, Olalla, J. Villalba, Cunha, Domenech y Osado. También jugaron: Aulisi, A. Villalba. <strong>Entrenador:</strong> Alberto Toribio.</Equipo>
          <Equipo nombre="CV GUAGUAS" sets={3}>Bruno, Walla Souza, Pascal, Rousseaux, Ramos, Trinidad y Larrañaga. También jugaron: De Amo. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>Después de ganar los dos primeros partidos de la final, e inclinar de manera muy favorable el título del campeonato regular, el Guaguas no quiso esperar más y certificó en Soria, con un nuevo triunfo para el 3-0 de rigor. Pese a un 9-4 de entrada en contra, que encendió los ánimos de un rival que aspiraba a forzar un cuarto envite, Walla Souza, máximo anotador del encuentro junto al local Cunha con 14 puntos, tomó las riendas de la situación, secundado siempre por sus compañeros, y fue poniendo las cosas en su sitio.</p>
          <p>La presión de ser el favorito ejerció el efecto pretendido de rendir a conciencia y, en las situaciones en las que el marcador ofrecía cierta emoción, instaurar de inmediato respeto y jerarquía. El saber estar del equipo, constante en su crecimiento hasta la victoria, y tirando de galones y madurez, cimentó un resultado más que merecido y que añadía a la cosecha otra copa más. Tomas Rousseaux finiquitaba el partido con una diagonal cerrada, ya cuando todo estaba visto para sentencia, y alargaba la dinastía ganadora del club.</p>
          <p>El clásico de todos abrazados, gritando el nombre del Guaguas y como envidia del voleibol nacional, volvió a darse en Soria, ratificando que el rey de España en este deporte viste de amarillo y mantiene firmes sus pasos.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-supercopa-2025": (
    <>
      <TituloDeportivo numero={24} nombre="SUPERCOPA DE ESPAÑA" anio="2025">
        <FichaTecnica
          parciales="25-23, 25-23 y 25-23"
          arbitros="Francisco Javier Pedrosa y Joaquín Ventura."
          incidencias="Encuentro correspondiente a la final de la Supercopa de España, disputada en el Polideportivo Pisuerga de Valladolid."
        >
          <Equipo nombre="CV GUAGUAS" sets={3}>Nico Bruno, Ezequiel Pérez, Hélder Spencer, Osmany Juantorena, Walla Souza, Miguel Ángel de Amo, Unai Larrañaga, Jorge Almansa, Augusto Colito, Jean Pascal Diedhiou, Tomas Rousseaux, Martín Ramos y Dobromir Dimitrov. <strong>Entrenador:</strong> Sergio Miguel Camarero.</Equipo>
          <Equipo nombre="GRUPO HERCE SORIA" sets={0}>Óscar Arnaiz, Carlos Montero, Lucas Lorente, Omar Hoyos, Diego Miguel, Moisés Rodrigo, Juan Pablo Moreno, Rodrigo Jiménez (líbero), Alejandro Villalba, Mikel Kalstad, Bernat Castella, Viktor Lindberg, Joan Domenech, Azddin Mimoun y Arnau Masià. <strong>Entrenador:</strong> Luis Alberto Toribio.</Equipo>
        </FichaTecnica>
        <Narrativa>
          <p>El año 2025, con la Superliga y la Copa del Rey como bagaje anterior, merecía el corolario que trajo la conquista de la Supercopa de España, movida de fecha, del habitual inicio de calendario a uno de los últimos días del año y en sede neutral, en este caso, Valladolid. Y, como es habitual, al Guaguas, ante una final, con la posibilidad de seguir añadiendo títulos, se le abrió el hambre. Poco importó que el adversario, el Grupo Herce Soria, le hubiera ganado en los días previos a la cita en lo que se podía interpretar como un mal presagio.</p>
          <p>En un partido de poder a poder, con tres sets disputadísimos, todos resueltos por el mismo 25-23, lo que evidencia la intensidad y emoción que hubo, el comportamiento maduro y constante del equipo tuvo su justa recompensa. A la habitual cohesión colectiva se sumaron las apariciones oportunas y decisivas de Walla, Bruno o Juantorena, contundentes en la red para que el 24.º título oficial de la historia cobrara cuerpo y se convirtiera en realidad. Pese a los intentos del contrario de revertir el orden, nada pudo frente a la contundencia amarilla, de principio a fin y sin dar opción a la rebelión soriana.</p>
          <p>La versión más reconocible del campeón hegemónico permitió que la Supercopa volviera con el equipaje para Gran Canaria.</p>
        </Narrativa>
      </TituloDeportivo>
    </>
  ),
  "cap12-joselu-sanchez": (
    <>
      <DropCap>Fue uno de los jugadores que estuvieron presentes en la pista del García San Román en el histórico partido disputado ante el Knack de Bélgica, correspondiente a la Recopa de Europa, el 7 de noviembre de 1987, bautizo continental de un Guaguas que luego se haría asiduo y respetado en competiciones internacionales.</DropCap>

      <p>Y aunque su paso por la plantilla fue fugaz (“estuve entrenando, sin fichar, durante la campaña 1986-87 y luego, al tener el servicio militar, tuve que marcharme en enero de 1988, con lo que apenas fueron tres meses como miembro de la plantilla”), Joselu Sánchez (Ferrol, 1962) dejó tanta huella que, décadas después, cuando Juan Ruiz ideó la refundación, tuvo muy presente su nombre para integrarlo en el organigrama ejecutivo con las funciones de secretario.</p>

      <EditorialQuote>Nací en Galicia por circunstancias laborales de mi padre. Pero llegué a Gran Canaria con apenas unos meses y mi condición de canario es algo que llevo con honra y orgullo. Estoy enamorado de mi isla. Por eso, recuperar una entidad que ha sido tan representativa para nuestra sociedad era para mí algo de obligado cumplimiento. Mi relación laboral con Juan Ruiz ha sido de toda la vida. Nos conocemos muy bien. Y recibí su ofrecimiento con muchísimo entusiasmo. Va más allá de lo deportivo. Para mí el Guaguas es un sentimiento.</EditorialQuote>

      <p>En este sentido, destaca que “el trabajo ha sido considerable” desde que comenzaron las gestiones para que el club volviera al ámbito competitivo: “Captar patrocinios y apoyos en época de pandemia y crisis económica es algo que muy pocas personas pueden conseguir. Juan Ruiz lo ha vuelto a lograr. Ya hizo un proyecto sensacional a finales de los ochenta y ahora, de la nada, el Guaguas vuelve a ser campeón. Para todos los que sentimos muy adentro estos colores supone una emoción enorme”.</p>

      <p>“Estoy convencido de que se están sentando las bases para que la entidad se vuelva a consolidar. En eso estamos todos los que formamos parte de esta familia. Sin duda, los éxitos deportivos que se han cosechado son un respaldo importante, pero queda mucho por hacer y seguimos con todo tipo de esfuerzos e ideas para permitir el crecimiento de nuestro escudo”, apostilla. Joselu, que guarda parentesco familiar con Jorge Ramón, insiste en que el Guaguas “es una seña de identidad” y que forma parte “del patrimonio deportivo y sentimental” de Gran Canaria.</p>

      <EditorialQuote>Recuerdo mis comienzos en los Salesianos, Universidad Laboral, Gran Canaria y Juventud, a entrenar con el Guaguas en la temporada 1986-87 y mi ficha por ese equipo en la siguiente por invitación de Felipe Nuez. Mi posterior etapa en el Santa Catalina de Isidro Quintana en Tercera División, equipo con el que alcanzamos la Segunda y la División de Honor. Incluso cuando formé parte del Canteras de balonmano quedando campeón de Primera y alcanzando la División de Honor. El deporte siempre ha formado parte de mi vida y en estos últimos años incluso saqué un título de entrenador de voleibol para estar más cerca de mi hija Laura. Una de mis ilusiones es ayudar al Guaguas porque será bueno para nuestra tierra.</EditorialQuote>
    </>
  ),


  // ═══════════════════════════════════════════════
  // CAPÍTULO 12: Vuelve el gran Guaguas — Un paso por aclamación
  // ═══════════════════════════════════════════════
  "cap13-aclamacion": (
    <>
      <DropCap>No fue una opinión aislada, tampoco la petición de algún nostálgico suelto, ni siquiera una suma de sugerencias. A Juan Ruiz llevaban parándole por la calle &ldquo;años y años&rdquo;, como significa, multitud de aficionados que, directamente, no terminaban de digerir que un emblema del deporte y de la sociedad grancanaria contemporánea hubiese desaparecido.</DropCap>

      <p>Y el histórico presidente, siempre receptivo a la voz de la gente, fue aparcando el escepticismo inicial para ir modelando un regreso que, sabía, iba a implicar serias complejidades. La refundación de una entidad deportiva, y diez años después de su liquidación como era el caso del Guaguas, obligaba a un proyecto de cimientos estables, de garantías plenas. &ldquo;Estaba prohibido dar un paso en falso&rdquo;, resume Ruiz, quien durante muchos meses fue gestando de qué manera y con qué apoyos iba a rescatar del olvido un escudo que, por historia, apego popular y prestigio jamás mereció caer en el olvido. Ya jubilado y liberado de servidumbres horarias, con una familia &ldquo;que estaba encaminada y siempre se mostró comprensiva&rdquo; con su motivación sentimental de rescatar a la entidad de su vida, inició las maniobras desde la discreción necesaria. Cualquier tipo de publicidad antes de consolidar las estructuras y el andamiaje de patrocinadores podría resultar contraproducente, lo que motivó que esas rondas de contactos y consultas no pasaran del ámbito privado.</p>

      <p>Paco Sánchez Jover y Sergio Miguel Camarero, los símbolos de la época de esplendor, fueron de los primeros en conocer sus intenciones. Había que acudir a las raíces y en la estructura y tradición del Calvo Sotelo esos dos nombres eran irrenunciables. Como también el de Felipe Nuez, el entrenador fundacional y referente obligado en esa reconstrucción en ciernes. En todos encontró receptividad y predisposición. Pese al paso del tiempo y a las incertidumbres inevitables, Juan Ruiz supo que la vieja guardia estaba con él. Y ejecutivos que le acompañaron antes de su marcha en 1998, tales como Antonio Benítez o Miguel Ángel Hernández, también le tendieron la mano, prestos a colaborar en lo necesario sin más interés que el de revivir un emblema como el que, en tiempos, llenó hasta la bandera el Centro Insular y campeonó por España.</p>

      <p>La decisión ya era firme. El consenso deseado para emprender el nuevo Guaguas, el paso necesario que tantas meditaciones había alimentado en la mente de Juan Ruiz... Todo encajaba y ya a finales de 2019, pese a los rigores de la pandemia, el sueño de restituir una entidad con cinco Ligas, seis Copas del Rey, una Supercopa de España, ídolos inolvidables en su camino y más de cincuenta partidos oficiales en competiciones europeas, comenzaba a cristalizar. Un legado inigualable.</p>

      <p>El 11 de mayo de 2020 quedó constancia en el Registro de Entidades Deportivas de Canarias de la entrada de toda la documentación pertinente del nuevo Guaguas con la intención de entrar en el ámbito competitivo y, menos de dos meses después, el 2 de julio, tenía lugar en el Cabildo de Gran Canaria la presentación institucional de un proyecto incubado con mimo, paciencia y entusiasmo.</p>

      <p>Juan Ruiz volvía para ganar. No se conformaba con un Guaguas de transición y así lo demostró con arduas y hábiles gestiones para poner a disposición de Sergio Miguel Camarero una plantilla de calidad y experiencia. Entre las novedades más destacadas, Sánchez Jover se trajo del Vecindario al central brasileño Moisés Cézar, toda una garantía por su amplio recorrido profesional, y también sobresalió la llegada del opuesto argentino Pablo Kukartsev quien, a la postre, sería la pieza más decisiva para la consecución de los títulos que venían en camino.</p>

      <p>Alejandro Fernández Rojas, Guilherme Magnani Hage, Carlos Manuel de Carvalho Furtado, Moisés Dos Santos Cézar, Javier Sánchez Carreres, Paulo Renán Bertassoni, Jorge Almansa Martínez, Luca Biliato, Ruiman David Artiles Sosa, Matthew Lambert Knigge, Stefano Nassini Hidalgo, Pablo Sergio Kukartsev y Gustavo Delgado Escribano fueron los integrantes de la plantilla de la campaña 2020-21 y cuyo primer partido oficial fue como visitante, contra el Rotogal Boiro en el pabellón A Cachada de Galicia, el 3 de octubre de 2020, ganando 0-3. Punto de partida de la nueva era en la que el Guaguas vuelve a ser protagonista por su presente de éxito y horizonte de ilusiones.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 12: Vuelve el gran Guaguas — Presidentes
  // ═══════════════════════════════════════════════
  "cap13-presidentes": (
    <>
      <DropCap>Juan Ruiz ocupa un lugar preeminente e indiscutible en este capítulo de dirigentes por la vigencia, bagaje y trascendencia de su mandato, dividido en dos partes, la inicial entre 1986 y 1998, y la actual, nacida en plena pandemia, año 2020 y todavía en curso.</DropCap>

      <p>Es el presidente por antonomasia del Guaguas. Todos los títulos del palmarés han llegado bajo sus directrices, también las contrataciones más exitosas y recordadas, así como los ciclos de mayor calado social y repercusión, tanto a nivel regional como nacional y más allá de las fronteras. El escudo va asociado a su figura y no se entiende la trayectoria sin igual del club sin su referencia. A ese servicio continuado, estelar y que ha entrado por derecho propio en la historia del deporte canario por ser un modelo de eficiencia integral, con solvencia económica, sostenibilidad institucional y voracidad en la cancha.</p>

      <p>En su haber también figura, como dato inmaculado, no haber percibido remuneración alguna por su dedicación, tiempo y gestiones en aras de procurar al Guaguas un presente y un futuro. El perfil de ejecutivo remunerado se ha normalizado en los últimos tiempos e incluso hay una legitimización de esa contraprestación económica. Pero Juan Ruiz, que no ha escatimado en sacrificios, renuncias personales y todo tipo de iniciativas desde el altruismo, entiende que su representatividad ya tiene suficiente retorno como para cuantificarla o monetizarla. Ahí también se diferencia de la mayoría de sus homólogos. Esa concepción romántica de dar sin pedir a cambio, la que le llevó a adentrarse en aquel Guaguas de los ochenta que estaba a punto desaparecer guiado por su vocación de ayudar, la mantiene blindada al tiempo como ejemplo y emblema.</p>

      <p>Si sobre Guillermo Gil recae el honor de haber sido el presidente fundacional, allá por 1976, en Juan Ruiz reposan los laureles del club con mayor número de títulos de Canarias y el despegue hacia el infinito de un Guaguas instalado en la excelencia.</p>

      <HighlightText>Guillermo Gil</HighlightText>
      <HighlightText>José Luzardo</HighlightText>
      <HighlightText>Arturo Sureda</HighlightText>
      <HighlightText>Florencio Tejera</HighlightText>
      <HighlightText>José María Rodríguez</HighlightText>
      <HighlightText>Gustavo Rodríguez</HighlightText>
      <HighlightText>Juan Ruiz</HighlightText>
      <HighlightText>Mario Hugendubel</HighlightText>
      <HighlightText>José Luis Cano</HighlightText>
      <HighlightText>Pedro Cuarental</HighlightText>
      <HighlightText>Samuel Díaz</HighlightText>
      <HighlightText>David Rodríguez</HighlightText>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 12: Vuelve el gran Guaguas — Entrenadores
  // ═══════════════════════════════════════════════
  "cap13-entrenadores": (
    <>
      <DropCap>De Felipe Nuez, el precursor y con el que empezó todo, pasando por Sánchez Jover, la escuela argentina en los noventa con Quique Edelstein o Marcelo Giovanacci, el sello de la casa como Juanma Martín, siempre con nuevos logros para las vitrinas, hasta el desembarco absolutamente insuperable de Sergio Miguel Camarero, en tiempos estrella en la cancha y reciclado, de igual manera, a entrenador de aureola.</DropCap>

      <p>Con él en el banquillo, ya desde la refundación en 2020, la lluvia de títulos ha sido incesante. Representante en su máxima expresión de los valores del Guaguas, implicación, compromiso, ambición y sacrificio como señas de identidad, a lo que Camarero añade de su cosecha el orgullo de pertenencia, algo que ya le caracterizó cuando incendiaba de pasión el Centro Insular con su conexión única con la grada.</p>

      <p>Lo cierto es que la galería de preparadores en el medio siglo de vida del club luce ilustres que son inolvidables y de una contribución diferencial para que el equipo se haya convertido en un icono del voleibol español. Esta catarata de conquistas consagra unas líneas maestras en las que un denominador común salta a la vista: el perfil de hombre de la casa siempre se ha elevado y distinguido. Los mencionados ejemplos de Nuez, Sánchez Jover y Camarero constituyen un trío ineludible y que perdurará sin caducidad. Lo que significaron (y en el caso de Camarero todavía se conjuga en presente) ha marcado un camino de exigencia, profesionalidad y maestría sin igual, a la altura de la genética ganadora de la entidad. Si resultó irrepetible aquel tránsito de los ochenta a los noventa jalonada de épica y proezas, ya adentrados en el siglo XXI es Camarero, representante de la vieja guardia, el encargado de mantener la esencia y contagiarla a las nuevas generaciones. Y promete seguir, inasequible al desaliento y con la ambición por bandera.</p>

      <HighlightText>Felipe Nuez</HighlightText>
      <HighlightText>Fidel Morales</HighlightText>
      <HighlightText>Sergio Hernández</HighlightText>
      <HighlightText>Paco Sánchez Jover</HighlightText>
      <HighlightText>Chava González (interino en el verano de 1989)</HighlightText>
      <HighlightText>Robert Croteau</HighlightText>
      <HighlightText>Quique Edelstein</HighlightText>
      <HighlightText>Marcelo Giovanacci</HighlightText>
      <HighlightText>Juanma Martín</HighlightText>
      <HighlightText>Benjamín Vicedo</HighlightText>
      <HighlightText>David Rodríguez</HighlightText>
      <HighlightText>Ángel Alonso</HighlightText>
      <HighlightText>Álvaro Bourousouzian</HighlightText>
      <HighlightText>Chema Sánchez</HighlightText>
      <HighlightText>Samuel Díaz</HighlightText>
      <HighlightText>Sergio Miguel Camarero</HighlightText>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 14: Los nuevos ídolos — Pablo Kukartsev
  // ═══════════════════════════════════════════════
  "cap15-kukartsev": (
    <>
      <DropCap>En el doblete de 2021, con Liga y Copa del Rey que no se daba desde 1994, el opuesto Pablo Kukartsev (Buenos Aires, 1993) fue una de las figuras más indiscutibles como prueba su designación como jugador más valioso de la temporada.</DropCap>

      <p>&ldquo;Uno no busca distinciones individuales porque esto es un juego de equipo. Todo lo que conseguí en ese año se lo debo a mis compañeros, al trabajo que realizamos conjuntamente entre todos porque, aunque pudiera parecerlo, no fue nada fácil hacer lo que hicimos&rdquo;, apunta desde las filas del Almería, su destino profesional actual y del que, precisamente, llegó en el verano de 2020.</p>

      <p>&ldquo;Me ofrecieron la oportunidad de jugar competiciones europeas, algo que no todos los clubes en España pueden hacer, además de formar parte de un proyecto muy ilusionante. Es cierto que sobrevolaba la incertidumbre de qué respuesta podría darse al ser un club que regresaba tras una larga ausencia. Encima la pandemia tampoco ayudaba al optimismo. De hecho, fui el primero de la plantilla en contraer el virus, con la incertidumbre que eso conllevaba. Pero pusieron mucho interés en mí, me convencieron con unas ideas ambiciosas. Desde mi entorno me apoyaron cuando me decidí a aceptar la oferta y, la verdad, desde el primer momento todo fue rodado&rdquo;, consigna.</p>

      <p>Kukartsev opina que el grupo &ldquo;fue de diez a nivel profesional y humano&rdquo;, lo que terminó derivando en la cosecha de éxitos que se dio: &ldquo;No jugamos la Supercopa de España y en Europa caímos mucho antes de lo que merecíamos. Disputamos encuentros de máximo nivel, de los que a todo jugador le gusta tomar parte, llegamos a finales, las ganamos... No se puede pedir mucho más, la verdad. Disfruté, crecí, pude desarrollarme todo lo que esperaba. Merecimos lo logrado porque lo peleamos desde el primer entrenamiento y con toda la intensidad posible&rdquo;.</p>

      <p>Y bien presente, pese al paso del tiempo, dos momentos elegidos: &ldquo;Cuando Javi me la colocó para hacer el punto ganador ante el Almería en la Liga y la definición de Hage en la Copa, que también valió el trofeo que nos llevamos. Es imposible olvidar esa alegría, la satisfacción de ver premiado tanto trabajo&rdquo;.</p>

      <p>Además, se muestra como una persona agradecida al hacer balance de su única campaña, la 2020-21, defendiendo el escudo al que ayudó a volver a la cima: &ldquo;Al Guaguas siempre le voy a guardar cariño, respeto y admiración. Me trataron de maravilla y, a nivel personal, fue un tiempo de evolución constante. Mi balance es totalmente espectacular&rdquo;.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 14: Los nuevos ídolos — Moisés Cézar
  // ═══════════════════════════════════════════════
  "cap15-moises-cezar": (
    <>
      <DropCap>En su primer año como jugador del Guaguas, brazalete de capitán y levantando hasta tres títulos: Copa, Liga y Supercopa. Todo, con diferencia de unos meses. &ldquo;Cada vez que me tocó ir a recoger un trofeo, las emociones fueron increíbles, únicas&rdquo;.</DropCap>

      <p>El receptor brasileño Moisés Cézar (Belo Horizonte, 1983) ya había tenido una experiencia similar en el Almería, años atrás, acaparando todos los laureles nacionales. Pero hacerlo aquí, con la jerarquía que se le otorgó en virtud de su experiencia previa, tuvo &ldquo;un sabor especial&rdquo;, tal y como admite.</p>

      <p>Después de tres temporadas en el Vecindario, la consigna que le dio Paco Sánchez Jover, su técnico en el conjunto sureño, le marcó a fuego: &ldquo;Me habló del proyecto de recuperar el Guaguas y me dijo que yo tenía que estar, que me quería con él. A Paco es imposible decirle que no. Y tampoco me lo pensé. Seguía en Gran Canaria, que es una tierra a la que me adapté muy bien y, encima, ya en el final de mi carrera, iba a poder formar parte de un equipo histórico, con aspiraciones. Todo me motivó mucho&rdquo;.</p>

      <p>Cézar ya tenía referencias de lo que había significado el Guaguas décadas atrás, por lo que asumió con &ldquo;orgullo y responsabilidad&rdquo; la misión de liderar el grupo a las órdenes de Camarero, sabiendo que &ldquo;había que ir a por todas desde el primer momento&rdquo; para respetar, precisamente, la naturaleza de un proyecto diseñado para ganar.</p>

      <p>&ldquo;Vine con una edad ya importante y me produjo una gran satisfacción jugar todos los partidos y poder darle mi mejor nivel al servicio de los compañeros. Creo que no dejé ninguna duda sobre la pista y, encima, tuve el privilegio de jugar con grandes personas, de enorme calidad humana y profesional. Eso fue clave. Y también el míster, que es otro ganador y ha hecho grupo en los momentos más complicados. Fuimos un equipo con todas las letras y eso explica tanto éxito&rdquo;, opina.</p>

      <p>A nivel individual, no oculta que vestir el dorsal 5 también supone un guiño a la nostalgia: &ldquo;Fue el que llevó Paco y es un honor llevarlo en el Guaguas como hizo él. Me da un plus de fuerza, de energía. Otro motivo más para dar lo que llevo dentro en cada encuentro, en cada entrenamiento&rdquo;.</p>

      <p>Centrado en &ldquo;continuar dando alegrías&rdquo;, pondera que la presencia gradual de público &ldquo;lo ha hecho todo más fácil&rdquo; tras muchos meses de compromisos a puerta cerrada por la pandemia: &ldquo;Jugar y ganar finales sin gente fue duro, aunque no quedaba otra opción. Nos acordamos de todos y brindamos cada copa por ellos. Ahora es una alegría poder competir con la fuerza que nos dan desde la grada y ojalá que todo siga yendo tan bien como hasta el momento. Y con la ilusión de mejorar en Europa y poder realizar una buena campaña en general. Es la exigencia que asumimos con la máxima profesionalidad&rdquo;.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // NEW: Nuevos ídolos adicionales (Cap 14 children)
  // ═══════════════════════════════════════════════
  "cap15-alejandro-fernandez": (
    <>
      <DropCap>Diez años fuera de Canarias y la oferta de regresar a una isla, Gran Canaria, que considera su casa, hicieron que Alejandro Fernández (La Laguna, 1987) sintiera un pellizco en el corazón al recibir la propuesta del Guaguas.</DropCap>

      <p>&ldquo;Estaba en el Almería, con Hage o Almansa, y no nos faltaban alicientes deportivos. Pero el Guaguas es el Guaguas. La única manera de mejorar lo que tenía era estar aquí. Y más al saber los fichajes que se iban a realizar para que el proyecto tuviese la importancia que se quería. Ni me lo pensé&rdquo;, aclara.</p>

      <p>El líbero tinerfeño, que se ha asentado como si llevara &ldquo;toda la vida&rdquo; a las órdenes de Camarero, opina que el actual Guaguas &ldquo;es la versión 2.0&rdquo; del legendario que se hizo un sitio en la leyenda con sus primeros títulos: &ldquo;Defendemos un escudo de un gran peso e importancia en el voleibol español y somos conscientes de esa gran responsabilidad. Particularmente, supone un privilegio estar aquí y dar continuidad a un legado tan importante. Cambian los tiempos, pero pervive el espíritu que hizo y hace a este club tan grande&rdquo;.</p>

      <p>&ldquo;Cada día aumentan las ganas de seguir creciendo y dando alegrías al club y a la afición. Lo noto en todos los que formamos esta gran familia, dándonos siempre toda la fuerza que podemos. A lo largo de una temporada hay momentos buenos y menos buenos, pero disponemos de un vestuario comprometido y de una enorme calidad humana y profesional&rdquo;, añade.</p>

      <p>Su condición de canario le añade &ldquo;un plus&rdquo;, tal y como confiesa, porque llevar a un equipo de la tierra a lo más alto, como ha podido experimentar, &ldquo;es algo inolvidable&rdquo;.</p>

      <p>&ldquo;Cuando acepté afrontar este reto sabía que había que dar el máximo y, en lo posible, ganarlo todo&rdquo;, una misión que se ha ido cumpliendo, salvo alguna excepción, pero que en su balance individual le llena &ldquo;de satisfacción&rdquo;.</p>

      <p>Para Alejandro, &ldquo;lo mejor está por venir&rdquo; porque, tras el triplete de 2021, &ldquo;se han sentado unas bases muy importantes con vistas a un futuro de igual competitividad, ambición y nivel&rdquo;.</p>

      <p>De ahí que piense que la afición &ldquo;seguirá teniendo motivos para la ilusión&rdquo;, ya que el proyecto deportivo &ldquo;no parará de asentarse&rdquo; para poder mantener el escalafón adquirido y que, dice, &ldquo;es el propio del Guaguas, siempre en lo más alto&rdquo;.</p>
    </>
  ),

  "cap15-guilherme-hage": (
    <>
      <DropCap>Cuando el Guaguas llamó a Guilherme Hage para incorporarlo a filas, en plena pandemia y tratándose de un jugador contrastado, sin necesidad de aventuras (&ldquo;en el Almería lo tenía todo&rdquo;), pocos creyeron en que tal gestión prosperaría.</DropCap>

      <p>Pero tal fue la insistencia, que el jugador nacido en Araquara (Sao Paulo, Brasil) en 1988 se vio en la isla &ldquo;mucho antes de esperarlo&rdquo;, como reconoce. Y fue un flechazo, ni más ni menos. &ldquo;Me enamoré de esta tierra y del club nada más llegar. La sensación que tuve desde el primer momento era de que estaba justo donde quería, en el lugar exacto para mí y mi familia. Y eso me ayudó, indudablemente, a rendir, a responder a la confianza que puso Juan Ruiz en traerme. Un deportista necesita estabilidad dentro y fuera de la cancha y en el Guaguas encontré un equilibrio perfecto&rdquo;, explica. Y, por si fuera poco, títulos y honor a las primeras de cambio, lo que ya supuso el corolario perfecto.</p>

      <p>&ldquo;Venía de un club ganador y, sinceramente, no esperaba que fuésemos a salir campeones de Liga y Copa en la primera campaña. Por supuesto que todos, y yo más que nadie, jugamos para ganar, para ser inconformistas y superarnos. Pero también hay que ser realistas. El Guaguas venía de muchos años sin competir al contrario que otros equipos que ya tenían una estructura mucho más consolidada y eso siempre da una ventaja. Ni eso nos pasó factura. Se juntó un grupo espectacular, los resultados acompañaron y fue muy especial culminar todo el trabajo y esfuerzo de esa manera, levantando trofeos... Demasiado especial diría yo&rdquo;, esgrime.</p>

      <p>Hage admite que su personalidad y manera de ver la competición, &ldquo;que es la que tiene Sergio Camarero&rdquo;, le permitió encajar en un proyecto también de naturaleza ambiciosa como es el actual y en el que no entra en previsiones perder. &ldquo;Más gano y más quiero ganar. He tenido la suerte en mi carrera de llevarme muchas alegrías, pero soy de los jugadores que se acuerdan de todo al detalle. En el caso del Guaguas, de mi equipo, me preguntan por la Liga, la Copa o la Supercopa de España, los tres títulos que nos llevamos en el año 2021, y soy capaz hasta de recordar los puntos, de qué manera transcurrieron las finales... Porque eso es lo que queda luego, con el paso del tiempo. Las vivencias felices&rdquo;.</p>

      <p>Y, aunque ha sido hasta la fecha año y medio de militancia, ni duda en expresar su &ldquo;enorme orgullo&rdquo; por haber dejado su nombre escrito en la historia del club. &ldquo;Me siento tan identificado con la institución, con los compañeros y con Gran Canaria que vivir este renacimiento del Guaguas y de esta manera tan bonita es algo que me completa a todos los niveles. Y quiero seguir escribiendo esta historia todo lo que pueda&rdquo;, finaliza.</p>
    </>
  ),

  "cap15-gustavo-delgado": (
    <>
      <DropCap>La historia del Guaguas, esa tradición de lustre y prestigio que estaba de vuelta en 2020, fue el imán que atrajo al madrileño Gustavo Delgado (Móstoles, 1986) a alistarse al proyecto de reconstrucción desde las filas del Rennes francés.</DropCap>

      <p>Una experiencia en sus inicios le ayudó a eliminar cualquier atisbo de dudas: &ldquo;Tendría 19 años cuando me enfrenté al Guaguas. Entonces el equipo no era el de los títulos de los noventa y estaba en un momento delicado, pero recuerdo que ya daba respeto tener enfrente a un club de tanto recorrido y éxitos. Y al llamarme Juan Ruiz para estar aquí, ese momento me vino a la cabeza. No podía dejar pasar la oportunidad de vestir esta camiseta&rdquo;.</p>

      <p>Pese a que las lesiones le impidieron coger vuelo en su primera temporada, Gustavo se hizo un hueco en el corazón del Guaguas por su manera de implicarse desde fuera, ganándose la consideración de todos con un ejemplo de constancia, compañerismo y optimismo que caló en el vestuario. Ese empeño le ha permitido regresar a las pistas reciclado como líbero y con &ldquo;todas las ganas del mundo&rdquo; de ayudar como más le gusta, participando y sintiéndose actor de pleno derecho. &ldquo;Verlo todo desde fuera no es fácil, pero a mí me tocó aportar cuando no estuve apto y, tanto cuando ganamos la Copa como la Liga, tengo que agradecer a compañeros, técnicos y dirigentes que me permitieran vivir esos triunfos con toda la intensidad posible. Fue muy especial&rdquo;, valora.</p>

      <p>Considera que el año y medio transcurrido tras la refundación &ldquo;ha sido espectacular&rdquo; desde el punto de vista competitivo porque, pondera, &ldquo;no es nada fácil ganar tres títulos en un año, como se hizo en 2021&rdquo;, logro que, según su opinión, &ldquo;terminará valorándose como se debe con el paso del tiempo&rdquo;.</p>

      <p>&ldquo;Creo que todo ha ido más rápido de lo que podíamos esperar. Nos queda llegar lejos en Europa, que son palabras mayores porque hablamos de un escenario en el que hay clubes de un potencial bestial y, de momento, diría que inalcanzable para nosotros. Pero esto es el Guaguas y aquí vivimos de desafíos y tratar de superarnos en todo. Si ganamos, hay que seguir igual. Y si perdemos, porque no siempre todo son triunfos, estamos obligados a levantarnos de inmediato&rdquo;, matiza.</p>

      <p>Delgado no duda en asegurar que para él supone &ldquo;un orgullo&rdquo; poder decir, en un futuro, que durante su etapa profesional perteneció a esta entidad que califica como &ldquo;única en todos los sentidos&rdquo;.</p>
    </>
  ),

  "cap15-jorge-almansa": (
    <>
      <DropCap>Jorge Almansa (Cartagena, 1991) llevaba diez años en el Almería, era el capitán y emblema, tenía todas las consideraciones posibles como uno de los receptores de máximo nivel a escala nacional. Por si fuera poco, factores de índole personal, ya a punto de estrenar paternidad, le invitaban &ldquo;muy poco&rdquo; a cambiar de aires.</DropCap>

      <p>Le rompieron los esquemas &ldquo;para bien&rdquo; cuando, desde el Guaguas, le lanzaron el reto de unirse a Sergio Camarero y sus muchachos. &ldquo;Me supieron ilusionar, me hablaron de una manera que me conmovió y me llegó al fondo. Tanto es así que pasé de pensármelo a hacer las maletas en muy poco tiempo. Encima tuve la promesa, que se cumplió totalmente, de que tendría el apoyo que necesitaba para que mi familia pudiese estar bien en Gran Canaria. Y ahora, con el paso del tiempo, puedo decir que tomé la mejor decisión posible&rdquo;, argumenta.</p>

      <p>Su pasado laureado con otros colores lo ha actualizado ahora de amarillo y acumulando más títulos pese a que, advierte, &ldquo;si salir campeón una vez ya es complicado, hacerlo tres veces en el mismo año entra directamente en un nivel de dificultad tremendo&rdquo;.</p>

      <p>&ldquo;Fue duro, muy duro, no poder disfrutar de la afición cuando, por la pandemia, los partidos no admitían público. Uno no se acostumbra a pabellones vacíos ni te tiene que parecer normal algo tan triste y complicado, por más que las circunstancias obligaran a ese mal menor. Y que las cosas hayan ido normalizándose hasta el punto de que ahora jugamos con llenos en el Arena ha sido un soplo de aire fresco, la inyección más grande de motivación. Ver y sentir la energía de nuestra gente siempre será el mejor apoyo. Eso que aquí se vive, la conexión tan especial entre equipo y grada, que dicen que es histórica, es algo extraordinario y que necesitamos para ser los que somos&rdquo;.</p>

      <EditorialQuote>Recibí una llamada del Guaguas... Un club enorme que no tenía ninguna duda que iba a volver a estar arriba porque tengo referencias de todo lo que consiguió en los noventa y sabía que era un club que no iba a rendirse en su idea de volver a ganar. Pasé de un equipo grande, el Almería, a otro equipo grande, el Guaguas, y fue la mejor decisión porque me siento extremadamente feliz por todo lo que estoy viviendo aquí.</EditorialQuote>
    </>
  ),

  "cap15-matt-knigge": (
    <>
      <DropCap>&ldquo;Cuando pruebas el sabor de ganar, el sabor de ser campeón, no quieres otro. Y trabajas y haces todo lo posible para que no se acabe. En el Guaguas se sigue la misma filosofía y es la que se adapta a mi manera de vivir el deporte y el voleibol&rdquo;.</DropCap>

      <p>El central norteamericano Matt Knigge (Nueva Jersey, 1996) cambió el reconocimiento que tenía en Lugo, su anterior club en el campeonato español, por el órdago que se le abría en un equipo &ldquo;en el que no vale ser segundo&rdquo;. Y en el momento de repasar todo lo vivido aquí (&ldquo;la isla es increíble, me encanta la gente, me siento muy integrado y feliz en el equipo y se han conquistado, hasta la fecha, tres títulos de cinco posibles&rdquo;), el balance le hace esbozar una sonrisa. &ldquo;No puedo pedir más&rdquo;, sintetiza.</p>

      <p>Knigge pronto percibió que el Guaguas era &ldquo;el sitio perfecto&rdquo; para que pudiera alcanzar la plenitud con su fortaleza física y disfrutar, como no ha parado de hacer, en compañía del resto. &ldquo;Encontré un equipo increíble y no puedo dejar de tener ganas siempre de venir al pabellón a entrenar y a jugar. Es un privilegio tener la oportunidad de estar con este grupo porque sientes que hay una calidad superior&rdquo;, matiza.</p>

      <p>Guarda un recuerdo &ldquo;impresionante&rdquo; de cada uno de los títulos que ganó con la camiseta amarilla, si bien la Copa de 2021, la que inició el ciclo actual, tiene un lugar especial en su memoria. &ldquo;El formato de la Copa, con todo concentrado en tres días, mucha adrenalina y sabiendo que si pierdes quedas eliminado, le da un valor tremendo a la Copa. La que ganamos al Palma fue un partidazo y nos dio un subidón tremendo que, luego, también ayudó a que nos lleváramos la Liga. Fue el principio de todo y hay que reconocerlo así&rdquo;, valora.</p>

      <p>Para lo que viene, lo tiene claro: mantener la filosofía que persigue la excelencia. &ldquo;Levantas un trofeo y ya piensas en el próximo. Vienes a un entrenamiento y sabes que o das todo o no juegas. Ganas un partido y sabes que tienes la obligación de volver a ganar el próximo. Pero eso es lo que queremos todos los que estamos aquí, no nos quedamos sentados a mirar lo que hemos hecho. Si no fuera así, no seríamos el Guaguas. Siempre nos pedimos más y más. Y pensamos continuar de la misma manera&rdquo;. Y todo porque, como Matt recalca, &ldquo;es muy fácil sentirse comprometido con estos colores&rdquo;. En su caso, además, &ldquo;en cada día y en cada partido&rdquo;.</p>
    </>
  ),

  "cap15-paulo-renan": (
    <>
      <DropCap>Portugal, Grecia, Italia y, claro está, su Brasil natal. Nunca había podido jugar en un club español Paulo Renan (Curitiba, 1985) hasta que desde Gran Canaria le echaron el lazo.</DropCap>

      <p>&ldquo;Siempre tuve ganas de competir aquí y no me lo pensé mucho. Estaba en mi país y me gustó el reto de volver a salir al extranjero y demostrar mis condiciones como colocador. El Guaguas me pareció un desafío perfecto y, después de todo lo que se ha hecho desde 2020, desde luego que me reafirmo en aquel pensamiento que tuve&rdquo;, reconoce.</p>

      <p>Fue llegar y darse cuenta de que aquí se daba la actitud con la que siempre se sintió identificado. Vio que, con la mano magistral de Sergio Camarero, &ldquo;hay un espíritu de lucha tremendo&rdquo;, lo que casa con la electricidad que siempre le ha sido característica.</p>

      <p>&ldquo;Vivo este deporte con muchísima pasión, con intensidad siempre, esté jugando o fuera esperando una oportunidad. Y me encanta sentir que esa manera de desarrollar mi profesión es la misma que quiere nuestro entrenador. No valgo para salir a ver qué pasa. Salgo a ganar, a dejarme todo lo que llevo dentro. Creo, además, que esa ha sido la clave de que hayamos ganado tantos títulos en este tiempo. Y, sin duda, será igualmente fundamental para que sigan llegando&rdquo;, opina.</p>

      <p>Renan se considera &ldquo;un jugador de equipo y para el equipo&rdquo; y que no tiene otro propósito que el de ser &ldquo;útil a los compañeros&rdquo;, al entender que en el voleibol &ldquo;debe primar el interés colectivo&rdquo;, y asegura &ldquo;ser feliz&rdquo; cuando un esfuerzo suyo &ldquo;se convierte en punto para todos&rdquo;.</p>

      <p>&ldquo;Quiero que se me relacione con ese tipo de jugador que está para servir y ayudar. Además, por mi función específica siempre tengo la prioridad de dejar al compañero la mejor disposición posible para su remate&rdquo;, añade.</p>

      <p>Que tenga varios compatriotas en la plantilla como Hage o Cézar lo celebra porque &ldquo;siempre es positivo&rdquo; a la hora de agilizar una integración que ha sido perfecta, ya que tanto su mujer e hija &ldquo;se han adaptado a las mil maravillas en el idioma, las costumbres y la vida en Gran Canaria, donde todo es muy sencillo para vivir bien&rdquo;.</p>

      <p>La Liga ganada en 2021 fue la primera de su palmarés (&ldquo;conquisté otros títulos, pero nunca un campeonato regular hasta llegar al Guaguas&rdquo;), por lo que elige esa final ganada al Almería como un momento &ldquo;de gran felicidad&rdquo; en su historia con el equipo grancanario. Aunque no se conforma con lo vivido. &ldquo;En el deporte siempre importa lo que viene. Y espero que sean más éxitos aquí&rdquo;, pide.</p>
    </>
  ),

  "cap15-paolo-zonca": (
    <>
      <DropCap>El receptor italiano Paolo Zonca (Gorizia, 1997) pasó como un trueno por el Guaguas. Decisivo en sus dos temporadas (2022-2024) en la consecución de cinco títulos, con dos Superligas, una Copa del Rey, una Supercopa de España y una Copa Ibérica como legado visible, su impacto resultó incuestionable en el ciclo reciente plagado de laureles.</DropCap>

      <p>Figura dentro de la cancha, con jerarquía, ambición y compromiso, su adaptación al club y a la vida en Gran Canaria resultó excepcional, lo que engrandeció más su figura si cabe. Le encantaba la vida en la isla, de hecho no dudaba en pasar sus vacaciones sin moverse de aquí, y presumía de ser el mejor embajador posible de cara al exterior al presumir de una tierra &ldquo;especial, preciosa y única&rdquo;, como repetía a modo de identificación plena.</p>

      <EditorialQuote>Siempre he estado muy a gusto en la cancha, la gente lo ve y yo intento demostrar mis emociones con la afición en cada partido, y eso me permite subir el nivel. Noto como la gente me quiere, como celebra cada uno de mis puntos, eso me ayuda para estar focalizado en mi juego, con el fin de hacer más puntos y poder dedicarles la victoria en cada partido. No soy grancanario, ni español, pero lo que quiere lograr el Guaguas tanto en España como en Europa encaja a la perfección con mi pensamiento y con la forma que tengo de vivir el voleibol cada día.</EditorialQuote>

      <p>Cuando Juan Ruiz lo fichó desde el campeonato francés sabía que era una apuesta sobre seguro y que, como así pasó, resultaría muy complicado poder retenerle ante su magnitud y carisma, pero el tiempo de militancia en el Guaguas le hizo ganarse, por derecho propio, un lugar entre los grandes que han defendido su camiseta. Zonca consideró &ldquo;un honor&rdquo; su paso por el club por todo lo que significó en su vida deportiva y personal y, de igual manera, dejó un recuerdo imborrable por su contribución a la historia de la entidad y a enriquecer al vestuario a base de profesionalidad y valores de todo tipo.</p>
    </>
  ),

  "cap15-martin-ramos": (
    <>
      <DropCap>Pese a que tenía un palmarés envidiable, con una medalla olímpica en Río de Janeiro 2016 como guinda, Martín Ramos (Buenos Aires, 1991) sintió el deseo de unir su historia exitosa a la del Guaguas, otro paradigma de triunfos, y no dudó en aceptar el reto que le pusieron encima de la mesa en el verano de 2022.</DropCap>

      <p>Y la intuición que tuvo de que ese era el inicio de un ciclo de conquistas no ha parado de cumplirse desde entonces porque la cosecha de títulos y de alegrías se ha sucedido sin fin, consecuencia lógica de un binomio imparable, el que forma con el club y, también, de que haya podido encontrar un sitio ideal para, en la madurez de su carrera, sacar a relucir toda su potencia y poder en la pista.</p>

      <p>El central argentino, desde el comienzo adaptado al Guaguas &ldquo;como si llevara toda una vida&rdquo; en la disciplina isleña, ha sido parte activa de las campañas plagadas de logros que ha vivido en carne propia y con su compatriota Nico Bruno como uno de sus aliados infalibles. &ldquo;A los centrales nos pide que seamos muy protagonistas en el ataque, y estoy adaptándome a eso. Yo me siento un central atacante, por lo que me gusta que el entrenador piense así y que me pida eso&rdquo;. Así define su estilo y que encaja plenamente con lo que busca Camarero en sus jugadores: arrojo, valentía, sacrificio y orgullo además de la calidad que no se discute.</p>

      <EditorialQuote>Me gusta formar parte del equipo al que todos quieren ganar. Voy a seguir en el club, he renovado por dos años más con la entidad. Me encuentro muy feliz en Gran Canaria, con su gente y con la política del equipo. Es un orgullo formar parte de esta familia, los compañeros de vestuario ya son parte de mi vida diaria.</EditorialQuote>

      <p>Feliz tras rubricar su contrato hasta 2027 y como muestra inequívoca de que, océano Atlántico de por medio del lugar que le vio nacer, aquí está su sitio. Y como estandarte del Guaguas, puntual a su cita en los momentos culminantes de las finales y partidos más importantes, va a continuar aportando su sello distinguido para que las victorias y los elogios marquen el paso y jalonen una senda en la que ha sido partícipe como el que más.</p>
    </>
  ),

  "cap15-io-de-amo": (
    <>
      <DropCap>&ldquo;Mi padre fue jugador del Atlético de Madrid de voleibol y coincidió con este club en sus inicios. Soy consciente de todo lo que ha significado el Guaguas en el voleibol español y ese fue uno de los motivos que me hicieron regresar desde el extranjero&rdquo;.</DropCap>

      <p>Miguel Ángel de Amo, Io, (Madrid, 1985) sabía bien el destino que elegía para volver a España después de consagrarse en Eslovaquia y Chequia con experiencias que le apuntalaron más si cabe una hoja de servicios privilegiada, con infinidad de títulos y medallas tanto en la pista como sobre la arena en sus incursiones en el vóley-playa. Juan Ruiz llevaba tras su pista largo tiempo y fue en 2022 cuando, al fin, pudo captarlo para importar su sapiencia, destreza y maestría como colocador.</p>

      <p>&ldquo;Vine para unirme a un proyecto ganador y, también, para poner al servicio del vestuario mis vivencias, mis años de jugador en muchos clubes. Ayudar a unir a los compañeros, a generar el clima interno que siempre es fundamental, es una labor que asumí con naturalidad y en la que he tratado de aportar todo lo que sé&rdquo;, reconocía en sus inicios, asimilando con profesionalidad su rol de veterano.</p>

      <p>Pero esa tarea de ser el pegamento interno ha evolucionado hasta convertirle en un referente, a la altura de un grande como Jorge Almansa y recordando, por su influencia, carácter y prestaciones a otros capitanes históricos como Camarero o Sánchez Jover.</p>

      <p>Ganador nato y guía para sus compañeros, en el club lo tienen como una pieza esencial, consideración que comparte el cuerpo técnico por la ejemplaridad que ofrece en todo, ya sean entrenamientos, partidos o actos promocionales. Y todo, sin perder competitividad y manteniendo un listón de intensidad y exigencia que le hacen único, ya sobrepasados los 40 años pero con una manera de entender la profesión que explica la impresionante trayectoria que tiene a sus espaldas. Y siempre con la premisa de que continuará, porque cada título que logra con el Guaguas activa, para él, la cuenta atrás para el siguiente. Insaciable, Io de Amo representa como pocos los valores históricos de una camiseta que ha ayudado a seguir engrandeciendo.</p>
    </>
  ),

  "cap15-nico-bruno": (
    <>
      <DropCap>Otro exponente más de la raza argentina y de la pasión con la que entienden allí el deporte, convertido casi siempre en una cuestión de vida o muerte. Así se desempeña y juega Nico Bruno (Buenos Aires, 1989), receptor que recaló en el club en 2023.</DropCap>

      <p>Brasil, Italia, Bélgica y Turquía, además de su país natal, habían sido escenarios de su imparable ascensión y, tras ser proclamado cuatro veces mejor jugador del campeonato otomano, con lo que eso conlleva, su siguiente paso exigía más excelencia. &ldquo;El Guaguas es el mejor equipo de la liga española, el presidente me trasladó la idea de seguir cosechando títulos y dar un salto de calidad en Europa. Era una propuesta ambiciosa y me interesó sumarme al proyecto&rdquo;, explicaba al argumentar su dirección a Gran Canaria pese a disponer de propuestas que, en términos económicos, mejoraban la realizada por Juan Ruiz.</p>

      <p>No le importó ceder ahí al anteponer la exclusividad profesional que otorgaba unirse a un representativo único, anclado en la cima y que, temporada a temporada, va a por todas sin discriminar competición o adversarios. Competir y ganar como modus vivendi.</p>

      <EditorialQuote>Tenemos una seña de identidad muy marcada, es la de siempre querer ganar. En lo personal, he tenido partidos en los que me he llevado más puntos y otros en los que he podido contribuir en defensa o en recepción. Lo principal es ganar como equipo, las actuaciones individuales quedan en segundo plano.</EditorialQuote>

      <p>Bruno es, además, un vínculo de unión reconocible con la grada por el desempeño que juega en conectar al equipo con el aficionado y, en efecto camaleónico, se crece en ambientes adversos. La cualidad de rendir con presión no abunda y en el caso de Nico Bruno constituye una de sus grandes divisas, lo que le hace indispensable a ojos de Camarero y ejerce de recurso infalible para sus compañeros. Vino para seguir haciendo historia y siempre pensando en lo que viene.</p>
    </>
  ),

  "cap15-unai-larranaga": (
    <>
      <DropCap>Eficiencia silenciosa, no siempre espectacular pero, invariablemente, valiosísima para el rendimiento y los resultados del equipo. Es el perfil de Unai Larrañaga (Dumbría, La Coruña, 2000), desde 2023 componente esencial del mecanismo de funcionamiento pluscuamperfecto del Guaguas desde su posición estratégica e infalible.</DropCap>

      <p>Curtido en el voleibol nacional, con paso por Arenal Emeve, Santanderina y Melilla, y con la condición de fijo en la selección española, en el club hubo unanimidad a la hora de valorar su incorporación, con el añadido de aumentar la cuota española del plantel, aspecto siempre bienvenido y que no se descuida. Larrañaga encajó desde el primer momento con la naturalidad que tienen los grandes.</p>

      <EditorialQuote>Soy un jugador muy tranquilo pero, a la vez, apasionado. En la pista lo doy todo y, en mi faceta defensiva, trato de poner al servicio de los compañeros lo mejor de mí. Me gusta competir, ganar, afrontar cada partido al máximo.</EditorialQuote>

      <p>Desde esa serenidad para leer todas las situaciones y aportar su riqueza táctica se hace omnipresente su figura para que todo funcione de manera armónica y precisa. &ldquo;Fue algo muy especial sentir el interés del Guaguas. Cuando te llama el Guaguas sabes que es un desafío que tienes que aceptar como sea. Reconozco que no esperaba que me llegara tan pronto esta oportunidad. Es verdad que llevo rindiendo a buen nivel varios años y que estar en la selección española siempre te da un valor especial. Pero me veía en el Guaguas en una o dos temporadas más&rdquo;, reconoce a propósito de esa llamada que le cambió la vida y le ha permitido levantar títulos, hacerse más visible a todas las escalas.</p>

      <p>Querido y respetado por su carácter cercano, poco a poco se ha labrado la relevancia que ahora nadie cuestiona dentro del grupo. Sergio Miguel Camarero ve en él, como en Io de Amo, una mente precisa para canalizar talento y fuerza, cualidades que abundan en la plantilla. &ldquo;Sé que pertenezco a un club en el que no hay excusas. Eso me gusta y me motiva&rdquo;, se congratula el líbero gallego que llegó para quedarse y construir, con el resto, un Guaguas más y más grande.</p>
    </>
  ),

  "cap15-walla-souza": (
    <>
      <DropCap>Fue en julio de 2023. Llegaba con 33 años y con la competencia abierta en la demarcación de opuesto con el colombiano Juan Pablo Moreno. Pocos preveían lo que venía en camino con el fichaje del brasileño Francisco Wallysson Souza, Walla (Jaguaribe, 1990).</DropCap>

      <p>&ldquo;Creo firmemente que estaremos enfocados en nuestro principal objetivo, que es conquistar títulos. No solo yo, sino todo el equipo estará entregado al 100% para brindar a nuestros aficionados una temporada memorable, culminando con más de un título para nuestro club&rdquo;, declaraba en sus primeras palabras como componente del equipo.</p>

      <p>Recuerdan en el club que desde sus primeros entrenamientos no solo confirmó las mejores referencias. También impresionó por su potencia y precisión en la ejecución de remates. Un espectáculo verlo reventar, literalmente, la pelota, práctica que le ha hecho célebre ya en la competición oficial convirtiéndole en una auténtica máquina de hacer puntos, promediando en algunos tramos del calendario más de veinte y llegando a picos de hasta 28 (sumó la friolera de 171 en los últimos ocho encuentros de la temporada 2024-2025 como ejemplo ilustrativo de su voracidad). Saques directos, diagonales, en bloqueos... Un repertorio infinito el suyo para convertirse en elemento indefendible para los contrarios y diferenciador y decisivo en los intereses propios.</p>

      <EditorialQuote>Me gusta que se espere todo de mí. Sabes que en el Guaguas hay que ganarlo todo y eso hace que te exijas cada día para dar el máximo. A mí me gusta la presión, jugar para ganar, para conseguir cosas importantes. Todo jugador quiere estar siempre con metas importantes por cumplir y eso es lo que busco, por eso estoy tan contento y adaptado al Guaguas. La mentalidad de este club es la mentalidad que siempre he tenido yo. No hay día en el que no quiera ganar y dar lo mejor de mí en todos los partidos. Siempre trato de mantenerme enfocado en los entrenamientos y luego ponerlos en práctica de la mejor manera posible. El golpeo de balón que tengo es muy fuerte. Los potentes remates a campo rival podrían ser una de mis virtudes técnicas.</EditorialQuote>
    </>
  ),

  "cap15-tomas-rousseaux": (
    <>
      <DropCap>Un internacional belga procedente de Arabia Saudí, en la mejor etapa de su carrera y con disposición de dar lo mejor de su experiencia y valía en favor de la causa. Eso fue lo que se aseguró el Guaguas cuando en 2024, y tras la repentina marcha del italiano Paolo Zonca, analizó el mercado y se decantó por Tomas Rousseaux.</DropCap>

      <EditorialQuote>El compromiso del club con la excelencia y su entorno de apoyo a los jugadores fueron factores clave. Además, la oportunidad de trabajar con su experimentado cuerpo técnico y unirme a un equipo con una cultura ganadora hizo que la decisión fuera fácil para mí.</EditorialQuote>

      <p>El receptor, ya con paso triunfal por campeonatos tan reputados como los de Italia, Alemania, Polonia o Grecia, no pudo tener una adaptación más satisfactoria porque en el primer año de militancia fue actor destacado del triplete de títulos nacionales (Superliga, Copa del Rey y Supercopa de España), dándole forma a su más que merecida renovación.</p>

      <EditorialQuote>En cada partido intento dejar el ego de lado y evaluar lo que el juego me está ofreciendo, porque cada partido es diferente. Hago lo que sea necesario para ganar en grupo. También intento aportar mucha energía positiva y apoyo a mis compañeros, porque para mí es algo natural sonreír y disfrutar. Cada partido es estresante, pero no querríamos que fuera de otra manera porque ganar tiene su sacrificio.</EditorialQuote>

      <p>El saber estar que siempre luce, tenga mayor o menor protagonismo, y una concentración extrema que le hace aprovechar al máximo sus oportunidades siendo diferencial y dejando sello. Es lo que valora de manera especial Sergio Miguel Camarero a la hora de poder tirar de un jugador cerebral, con capacidad para decidir y que, acostumbrado a la presión, maneja como nadie los tiempos.</p>

      <p>Por eso y por mucho más se ha ganado Rousseaux un lugar en la galería de los mejores del Guaguas, siempre con una sonrisa contagiosa para hacer grupo, hombre de vestuario como es, pero sin renunciar nunca a esa ambición competitiva que le trajo a Gran Canaria desde el lejano Oriente y para seguir aumentando su figura e influencia.</p>
    </>
  ),

  "cap15-osmany-juantorena": (
    <>
      <DropCap>La noticia del fichaje de Osmany Juantorena (Santiago de Cuba, 1985) por el Guaguas en el verano de 2025 fue una bomba informativa en toda regla por lo que suponía unir a una plantilla que lo había ganado todo el curso anterior un campeón de primer calibre.</DropCap>

      <p>El receptor cubano, con un palmarés plagado de títulos y condecoraciones, incluyendo medallas en Olimpiadas, Europeos y Mundiales a nivel de selecciones, venía a apuntalar un proyecto estelar con su incuestionable liderazgo, calidad y experiencia. &ldquo;Es un milagro que hayamos podido traerlo&rdquo;, significaba el presidente Juan Ruiz tras certificar su incorporación y dar cuenta de la dimensión que implicaba.</p>

      <EditorialQuote>Tuve varias ofertas y elegí al Guaguas con la idea de ganar nuevamente y seguir contribuyendo al éxito del equipo. No conozco la Superliga más allá de conocer al CV Guaguas por su participación en Europa, pero tengo curiosidad de saber el nivel que existe y competir al máximo.</EditorialQuote>

      <p>Muy pronto se encargó Osmany de justificar todos los esfuerzos realizados por él porque, a su inmediata adaptación al vestuario y a la vida en Gran Canaria, añadió en la cancha esa cuota diferencial que es exclusiva de su figura. Venía de un tiempo marcado por las lesiones y espantó a las primeras de cambio cualquier incógnita al respecto con una implicación ejemplar.</p>

      <p>Compañeros y cuerpo técnico se vieron enriquecidos por un aporte que iba más allá del rendimiento, pues carisma, personalidad y sentido de pertenencia ampliaban el catálogo de prestaciones. En la marcha triunfal del Guaguas 2025-26 ha tenido un papel indiscutible, con actuaciones sobresalientes en partidos señalados, léase la final de la Supercopa de España ganada en Valladolid a final de año o en citas de la Champions, con especial hincapié en la celebrada victoria frente al Berlín en el Arena, que puso los cimientos para la clasificación posterior a los octavos de final. Y, por si fuera poco, una conexión especial con la grada, sensible como es al factor ambiental. Sin duda, un acierto mayúsculo el de su ciclo de amarillo.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 18: El Guaguas como en los viejos tiempos
  // ═══════════════════════════════════════════════
  "capitulo-18": (
    <>
      <DropCap>El regreso del Guaguas a la máxima competición en 2020 fue más que un simple retorno deportivo. Fue la recuperación de un sentimiento, de una identidad que Gran Canaria nunca dejó de sentir como propia. Como en los viejos tiempos, el voleibol volvía a ser protagonista.</DropCap>
      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 21: Reconocimiento del colectivo arbitral
  // ═══════════════════════════════════════════════
  "capitulo-21": (
    <>
      <DropCap>El voleibol no se entiende sin la labor de los colegiados. El colectivo arbitral ha sido una pieza fundamental en el desarrollo y profesionalización de este deporte en Canarias, y su reconocimiento forma parte de la historia del CV Guaguas.</DropCap>
      <p>Contenido del capítulo próximamente.</p>
    </>
  ),

};
