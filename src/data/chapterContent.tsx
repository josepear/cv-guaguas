import React from "react";
import DropCap from "@/components/DropCap";
import SectionHeader from "@/components/SectionHeader";
import PlayerProfile from "@/components/PlayerProfile";
import EditorialQuote from "@/components/EditorialQuote";
import NewspaperQuote from "@/components/NewspaperQuote";
import ArticleBlock from "@/components/ArticleBlock";
import { Timeline, TimelineEvent } from "@/components/TimelineEvent";
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
  // CAPÍTULO 1: Del patio del colegio a División de Honor
  // ═══════════════════════════════════════════════
  "capitulo-01": (
    <>
      <SectionHeader>Las horas extraescolares con Francisco Rodríguez</SectionHeader>

      <DropCap>Antes que el club fue el colegio. Porque el Calvo Sotelo nació del centro educativo del mismo nombre que se inauguró para el curso escolar 1967-68 en el barrio de Las Rehoyas, en la época punto de convergencia de la zona alta de Las Palmas de Gran Canaria y con familias de extracción social y economías precarias. "Gentes muy humildes, pero no necesariamente problemáticas. Se veían situaciones complicadas por la calle, no se puede negar. Pero de mi experiencia como maestro en el trato con padres y alumnos guardo un gran recuerdo por los esfuerzos y sacrificios que hacían para que los niños completaran su educación. No había medios materiales, pero sobraba el orgullo y la capacidad de superación", rememora Felipe Nuez, quien desembarcó en esta escuela para desarrollar sus prácticas de magisterio sin saber que allí enraizaría y forjaría una leyenda deportiva que nadie podía esperar.</DropCap>

      <p>
        Con todo, y según ha dejado documentado Miriam Quiroga en su libro 'Génesis y evolución del voleibol en Gran Canaria 1934/78', las primeras influencias para introducir el juego del voleibol en el Calvo Sotelo corresponden a Francisco Rodríguez, profesor que, de manera experimental, fomenta su práctica en las horas extraescolares. La aceptación de su propuesta lúdica es inmediata, lo que permite crear, de modo informal, los primeros equipos para competir de manera interna y, con el tiempo, concurrir a competencias de ámbito local.
      </p>

      <p>
        A la espera de que cale en categoría masculina, donde su introducción es más paulatina, las niñas toman la bandera y es la sección femenina la que inicia los pasos del Calvo Sotelo en los primeros torneos rivalizando con otros equipos. Y con resultados de impresión. Así, en los III Juegos Escolares Femeninos de la Enseñanza General Básica (EGB), correspondientes al curso 1971-72, el equipo infantil del Colegio Nacional Calvo Sotelo se impone a nivel provincial y regional, desplazándose en junio de 1972 hasta Málaga para disputar la fase final en la que se proclama campeón de España.
      </p>
      <ContentImage 
        src={imgCopaDelRey} 
        alt="Jugadores del Calvo Sotelo en sus primeros años de competición" 
        caption="Los primeros años del Calvo Sotelo en competición federada marcaron el inicio de una leyenda." 
      />

      <SectionHeader>Silvestre Cabrera y el salto cualitativo</SectionHeader>

      <p>
        Un acontecimiento externo va a suponer el definitivo impulso para el desarrollo y crecimiento de la disciplina, tanto en el propio Calvo Sotelo como en los otros caladeros de la cantera grancanaria de mitad de los setenta: la llegada a la presidencia de la Federación de Las Palmas de Voleibol de Silvestre Cabrera, a instancias de Manuel Hernández, director técnico de la Federación Española y que permite recuperar el voleibol federado en la provincia de Las Palmas. Cabrera, que era instructor de Educación Física y profesor del Instituto de Enseñanza Media de Escaleritas, toma posesión de su cargo el 19 de septiembre de 1973.
      </p>

      <NewspaperQuote source="Diario de Las Palmas, 26 de septiembre de 1973">
        "El voleibol ya dejó de ser un deporte minoritario para convertirse en algo tremendamente atractivo. No es un deporte de patios o de recreos, aunque la labor escolar, que en este aspecto lleva la Delegación de la Juventud, es muy importante. Sus campañas están dando al voleibol el lugar que le corresponde."
      </NewspaperQuote>

      <SectionHeader>La selección cadete con Felipe Nuez como germen</SectionHeader>

      <p>
        La temporada 1974-75, ya con los primeros resultados de la gestión de Cabrera al frente del voleibol provincial, resulta crucial en el desarrollo del Calvo Sotelo, pues se materializa la creación de la selección cadete de Las Palmas, que estará a cargo de Felipe Nuez. "Nuestra intención es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional", añadía, a modo de premonición, el técnico. De esta selección cadete saldría la base del primer Calvo Sotelo masculino, que, en esa misma campaña, debutaría en competición federada: el Campeonato Provincial de Segunda División Masculino.
      </p>
      <ContentImage 
        src={imgPartidoGuaguas} 
        alt="Partido de voleibol en el Centro Insular de Deportes" 
        caption="El Centro Insular de Deportes se convirtió en la casa del voleibol grancanario." 
        fullWidth 
      />

      <SectionHeader>Estatutos fundacionales y despegue</SectionHeader>

      <p>
        En noviembre de 1976, concretamente el día 6, se redactan los estatutos de fundación del Club Voleibol Calvo Sotelo, lo que ya supone, formalmente, el avance que se demandaba para que el proyecto deportivo se oficializara a todos los niveles y adquiriera una consistencia definitiva, como así se demostraría con el transcurso de los años posteriores. Fue el punto de partida que permitía ir del deporte escolar propiamente dicho, y que había sustentado la naturaleza del Calvo Sotelo, al integrado en la competición federada.
      </p>

      <SectionHeader>El ascenso a Segunda División de 1979</SectionHeader>

      <p>
        Lo que había quedado pendiente del año anterior, el ascenso a Segunda División, sí se materializó en 1979, en la fase decisiva que se libró en Málaga los días 9, 10 y 11 de marzo. En su primer partido, ganó con autoridad al Málaga por 3-0 (17-15, 15-10 y 15-4), luego se impuso por 3-1 al Dos Hermanas de Sevilla y completó la fase previa con otro triunfo, esta vez ante el Jaén y por 3-0. Y en la gran final disputada en el turno vespertino del domingo 11 de marzo, y de nuevo frente al Dos Hermanas, se consumó el gran éxito con un 3-0 (15-12, 15-11 y 15-2) para la historia.
      </p>

      <SectionHeader>El acceso a la élite y su conflicto burocrático</SectionHeader>

      <p>
        Es en la temporada 1983-84 cuando se va a producir un conflicto burocrático ("una cacicada federativa", según Felipe Nuez) que impidió el sueño de estar entre los mejores del país. En marzo de 1984 tomó parte de la fase de ascenso a la División de Honor que se celebró en Valladolid. La tercera plaza obtenida, que en principio tenía un valor testimonial, terminó adquiriendo una importancia capital al renunciar el Son Amar balear a su plaza en la máxima categoría.
      </p>

      <p>
        Sin embargo, los clubes de la División de Honor se opusieron a una ampliación de la misma aludiendo a factores económicos. El asunto llegó a la Audiencia Nacional en octubre de 1984. Finalmente, todos los esfuerzos quedarían desestimados.
      </p>

      <p>
        Así, la temporada 1984-85 arranca condicionada por este frente. Vuelta a empezar con un equipo de nuevo llamado a aspirar a la élite y cuya principal novedad estuvo en Sergio Miguel Camarero, un prometedor juvenil de 17 años llamado, con el tiempo, a ser parte del escudo. El Lucky Calvo Sotelo competiría finalmente en la División de Honor tras una posterior ampliación a doce equipos aprobada por la Federación Española el 17 de mayo de 1985.
      </p>

      <SectionHeader>La cronología</SectionHeader>

      <Timeline>
        <TimelineEvent year="1967">Se inaugura el colegio Calvo Sotelo en el barrio de Las Rehoyas.</TimelineEvent>
        <TimelineEvent year="1968">El profesor Francisco Rodríguez introduce el voleibol como actividad deportiva extraescolar.</TimelineEvent>
        <TimelineEvent year="1972">El equipo infantil femenino del Calvo Sotelo se proclama campeón de España en los II Juegos Escolares.</TimelineEvent>
        <TimelineEvent year="1973">El equipo femenino juvenil se proclama campeón Provincial Escolar. Ese mismo año el centro crea un torneo con su propio nombre.</TimelineEvent>
        <TimelineEvent year="1974">Creación de la selección cadete de Las Palmas, a cargo de Felipe Nuez. Debut en competiciones federadas.</TimelineEvent>
        <TimelineEvent year="1976">Redacción de los Estatutos Fundacionales del Club Voleibol Calvo Sotelo.</TimelineEvent>
        <TimelineEvent year="1977">Primer intento del Calvo Sotelo por ascender a la Segunda División en Cáceres.</TimelineEvent>
        <TimelineEvent year="1979">Se consuma el ascenso a la Segunda División tras saldar con éxito sus partidos en Málaga.</TimelineEvent>
        <TimelineEvent year="1984">La Federación Española le niega al Reales el ascenso a la División de Honor a instancias de los clubes peninsulares.</TimelineEvent>
        <TimelineEvent year="1985">Ascenso a la División de Honor tras ampliación de la categoría a doce equipos.</TimelineEvent>
      </Timeline>
    </>
  ),

  // ═══════════════════════════════════════════════
  // Los orígenes - Chapter 01 intro
  // ═══════════════════════════════════════════════
  "cap01-los-origenes": (
    <>
      <SectionHeader>Las horas extraescolares con Francisco Rodríguez</SectionHeader>

      <DropCap>Antes que el club fue el colegio. Porque el Calvo Sotelo nació del centro educativo del mismo nombre que se inauguró para el curso escolar 1967-68 en el barrio de Las Rehoyas, en la época punto de convergencia de la zona alta de Las Palmas de Gran Canaria y con familias de extracción social y economías precarias. "Gentes muy humildes, pero no necesariamente problemáticas. Se veían situaciones complicadas por la calle, no se puede negar. Pero de mi experiencia como maestro en el trato con padres y alumnos guardo un gran recuerdo por los esfuerzos y sacrificios que hacían para que los niños completaran su educación. No había medios materiales, pero sobraba el orgullo y la capacidad de superación", rememora Felipe Nuez, quien desembarcó en esta escuela para desarrollar sus prácticas de magisterio sin saber que allí enraizaría y forjaría una leyenda deportiva que nadie podía esperar.</DropCap>

      <p>Con todo, y según ha dejado documentado Miriam Quiroga en su libro <em>'Génesis y evolución del voleibol en Gran Canaria 1934/78'</em>, las primeras influencias para introducir el juego del voleibol en el Calvo Sotelo corresponden a Francisco Rodríguez, profesor que, de manera experimental, fomenta su práctica en las horas extraescolares. La aceptación de su propuesta lúdica es inmediata, lo que permite crear, de modo informal, los primeros equipos para competir de manera interna y, con el tiempo, concurrir a competencias de ámbito local. A la espera de que cale en categoría masculina, donde su introducción es más paulatina, las niñas toman la bandera y es la sección femenina la que inicia los pasos del Calvo Sotelo en los primeros torneos rivalizando con otros equipos. Y con resultados de impresión. Así, en los III Juegos Escolares Femeninos de la Enseñanza General Básica (EGB), correspondientes al curso 1971-72, el equipo infantil del Colegio Nacional Calvo Sotelo se impone a nivel provincial y regional, desplazándose en junio de 1972 hasta Málaga para disputar la fase final en la que se proclama campeón de España. Y, desde la temporada 1972-73, participa en categoría infantil masculina en los Campeonatos Escolares Provinciales por iniciativa y empeño de la Asociación de Padres de Alumnos, presidida por José Celestino Luzardo, y también representada por Antonio Trejo, encargado de la imprenta del colegio, Guillermo Gil, director del centro, y los profesores Pardo y Miguel Nieves. El crecimiento es sostenido, como queda documentado con otro logro: el 18 de febrero de 1973, el equipo femenino de 2ª categoría juvenil, entrenado por Francisco Rodríguez, se proclama campeón provincial escolar tras ganar, en la cancha Eliseo Ojeda, al Instituto Isabel de España. Un guiño del destino: el partido fue arbitrado por Felipe Nuez, quien ya ha orientado sus pasos al voleibol como actividad complementaria a la que ejercía de profesor. Apenas un año después sería pionero al frente de la selección cadete de Las Palmas, germen del equipo sénior que iniciaría la andadura del Calvo Sotelo ya a nivel federado.</p>

      <p>La creación, también en 1973, de un trofeo organizado por la propia escuela certifica la consolidación y crecimiento del voleibol en la rústica pista donde los alumnos ya se entregaban con entusiasmo y empeño en perfeccionar sus maneras y habilidades.</p>

      <SectionHeader>Silvestre Cabrera y el salto cualitativo</SectionHeader>

      <p>Un acontecimiento externo va a suponer el definitivo impulso para el desarrollo y crecimiento de la disciplina, tanto en el propio Calvo Sotelo como en los otros caladeros de la cantera grancanaria de mitad de los setenta: la llegada a la presidencia de la Federación de Las Palmas de Voleibol de Silvestre Cabrera, a instancias de Manuel Hernández, director técnico de la Federación Española y que permite recuperar el voleibol federado en la provincia de Las Palmas. Cabrera, que era instructor de Educación Física y profesor del Instituto de Enseñanza Media de Escaleritas, toma posesión de su cargo el 19 de septiembre de 1973. Su equipo de gobierno lo conforman Ramón Limiñana, vicepresidente primero, Alberto Armas, vicepresidente segundo, Felipe Nuez, secretario, José Antonio Giráldez, director de la escuela de preparadores, y Leoncio Castellano, presidente del colegio de árbitros.</p>

      <NewspaperQuote source="Diario de Las Palmas, 26 de septiembre de 1973">"La pasada temporada contamos con doscientos ochenta jugadores juveniles. Solo en esa categoría, porque no se trabajó con los séniors. Este año esperamos contar con muchos más, pues aparte de los dichos, se pondrá en marcha el campeonato femenino y el de los mayores. Habrá 10 equipos en la Segunda División Nacional, cuatro femeninos y todos los juveniles que hay actualmente".</NewspaperQuote>

      <p>Sus esfuerzos se traducirían rápidamente en hechos, pues en 1974 ya detallaba que Canarias era "la quinta comunidad de España en cuanto a licencias de voleibol con un total de 1.057 fichas".</p>

      <NewspaperQuote>"El voleibol ya dejó de ser un deporte minoritario para convertirse en algo tremendamente atractivo. No es un deporte de patios o de recreos, aunque la labor escolar, que en este aspecto lleva la Delegación de la Juventud, es muy importante. Sus campañas están dando al voleibol el lugar que le corresponde. Para hacernos una idea de todo ello podemos tomar como base un campamento de Tamadaba, donde más del 40 por ciento de los asistentes estuvieron haciendo voleibol, a pesar de que existían otras modalidades. La participación de los centros de enseñanza aumenta de año en año y es, quizás, la principal inyección de moral que la promoción de nuestro deporte está recibiendo".</NewspaperQuote>

      <p>Y añadía el dirigente: "Dentro de la labor que desarrolla la Delegación Provincial de la Juventud es de destacar las competiciones de cadetes, infantiles y alevines, gestión tremendamente meritoria. Además, la Delegación Provincial de Educación Física y Deportes ha patrocinado este año cuatro escuelas, funcionando en centros de Educación General Básica, con más de doscientos participantes masculinos. La sección femenina, por su parte, también ha sobrepasado el número en este sentido".</p>

      <NewspaperQuote source="La Provincia, entrevista de Santiago Betancor">"Es otro de nuestros grandes problemas, la falta de una cancha cubierta que nos permita consolidar nuestra preparación para acceder a las fases de sector con ciertas garantías. Nuestros equipos fallan por circunstancias como estas, aunque, según tengo entendido, pronto contaremos con dos, que nos darán la oportunidad de preparar mejor a nuestros muchachos".</NewspaperQuote>

      <p>Y sobre el otro reto, apuntaba: "Es fundamental que se acabe de una vez esa falta de contacto del voleibol canario con el nacional. El baloncesto y otros deportes han consolidado su afición por la competencia con los equipos nacionales, cosa que ahora le viene ocurriendo al balonmano. Esperamos que pronto le corresponda al voleibol. Si no visitamos y nos visitan equipos nacionales, que nos estimulen, no saldremos nunca del estancamiento".</p>

      <SectionHeader>La selección cadete con Felipe Nuez como germen</SectionHeader>

      <p>La temporada 1974-75, ya con los primeros resultados de la gestión de Cabrera al frente del voleibol provincial, resulta crucial en el desarrollo del Calvo Sotelo, pues se materializa la creación de la selección cadete de Las Palmas, que estará a cargo de Felipe Nuez ("con exactamente 15 jugadores y cuyos nombres son Mendaño, Araña, Padrón, Montelongo, Vázquez, José Luis, José Antonio, Juan, Navarro, L. Acosta, Willy, Ramón, Eugenio, T. Acosta y Juan Carlos", detallaba Nuez). "Nuestra intención es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional", añadía, a modo de premonición, el técnico. De esta selección cadete saldría la base del primer Calvo Sotelo masculino, que, en esa misma campaña, debutaría en competición federada: el Campeonato Provincial de Segunda División Masculino. El equipo está dirigido por los entrenadores Félix Rodríguez y Felipe Nuez, ambos procedentes del Club Canteras UD. En 1975 ya inicia su carrera como entrenador titular Felipe Nuez, cuya estancia se prolongará hasta 1988. En este campeonato, el Calvo Sotelo queda subcampeón, por detrás del Salesianos, y completando el cuadro de participación los equipos Juventud de Gáldar, Juventud de Guía, Juventud de Telde, Juventud de Arucas, Bandera de Paracaidistas y Colegio Universitario de Medicina. El equipo del Calvo Sotelo lo configuraron los jugadores José Tirado, Falero, Ceferino, Fidel, José de la Cruz, Macías y Juan Ramón Dávila. En 1975 el equipo juvenil femenino se proclama campeón provincial escolar bajo la dirección técnica de Francisco Rodríguez.</p>

      <p>Y otro hecho relevante acaece como clausura de la temporada 1974-75: en agosto se organizan, en las canchas del Calvo Sotelo y las instalaciones municipales García San Román, las 12 horas de Voleibol, de 9.00 a 21.00 horas. Más de 200 participantes entre las categorías alevín masculina, juvenil masculina, absoluta femenina y Segunda División masculina.</p>

      <p>A propuesta de Silvestre Cabrera, se funda un equipo denominado "Calsa", fusión del Calvo Sotelo y del Salesianos, con vistas a formar un grupo de primer nivel para el futuro, algo que no tendría continuidad y acabaría derivando en el Juventud Las Palmas. El Calvo Sotelo aporta un equipo juvenil y dos femeninos (A y B). En la Segunda División masculina disputa la final ante el Calsa, cayendo por 3-1.</p>

      <p>Entre el 9 de septiembre y el 5 de octubre de 1975 tiene lugar la Copa Federación, o Torneo Apertura, que abre la temporada 1975-76. El Calvo Sotelo participa en las tres categorías, Segunda División masculina, Absoluta femenina y Juvenil masculina. Ya hay una estructura sólida, a juzgar por el número de conjuntos que gestiona y como fruto de una continuada labor siempre en auge y cada vez con mayor calado en resultados e impacto.</p>

      <p>Otro acontecimiento del momento digno de mención se desarrolló del 31 de octubre de 1975 al 29 de febrero de 1976 con el Campeonato Provincial de Segunda División Masculina en el que el Calvo Sotelo queda en segunda posición de una nómina de nueve equipos, con el Juventud como campeón y Arucas, Guía, Gáldar, Drago, Zona Aérea de Canarias, Paracaidistas y Filial Perojo como equipos restantes. El entrenador es Felipe Nuez y sus jugadores, Miguel Mendaño, Alfredo Padrón, Juan Carlos Ortega Araña, José Montelongo, Juan Carlos Rodríguez, Ramón Rodríguez, José Luis Alemán, William Caballero y Navarro. En el Campeonato Juvenil Provincial Federado de esa temporada también quedaría subcampeón el Calvo Sotelo.</p>

      <SectionHeader>Estatutos fundacionales y despegue</SectionHeader>

      <p>En noviembre de 1976, concretamente el día 6, se redactan los estatutos de fundación del Club Voleibol Calvo Sotelo, lo que ya supone, formalmente, el avance que se demandaba para que el proyecto deportivo se oficializara a todos los niveles y adquiriera una consistencia definitiva, como así se demostraría con el transcurso de los años posteriores. Fue el punto de partida que permitía ir del deporte escolar propiamente dicho, y que había sustentado la naturaleza del Calvo Sotelo, al integrado en la competición federada.</p>

      <NewspaperQuote source="La Provincia, 1 de septiembre de 1976">"Junto al preparador técnico, Felipe Nuez, ha venido a incrementar el plantel de entrenadores Emilio Bonilla, conocido por todos dentro del ámbito del fútbol regional. De estos dos entrenadores, hay que decir que formarán un tándem que dará muchos frutos al equipo colegial y al voleibol canario en general. Aparte de la incorporación del nuevo míster, diremos que algunos jugadores han entrado a formar parte en las filas del equipo, como son los procedentes del infantil Manolo, Casiano, José Luis, Simón, Ramón, Octavio y Gavira. En el equipo absoluto, también hay incorporaciones, como son Falero y Déniz, que vuelven al equipo después de una temporada jugando fuera de sus filas. Aparte de estos, están pendientes las incorporaciones de otros como Arturo, procedente del Universidad de Tenerife, un veterano, que a buen seguro dará muchos resultados con la juventud del Calvo Sotelo en todos los aspectos. Con el equipo de voleibol, las aspiraciones llegan aún más lejos. Se tiene una base, que es el equipo juvenil, en él se han puesto todas las ilusiones con vistas a un futuro. Es loable el comprobar que no hay prisa, el club no desea la pérdida de categoría de sus jugadores juveniles y prefieren esperar dos temporadas más en Tercera División. Para ello, la plantilla que lo va a intentar entre absolutos y juveniles son los siguientes: Juan Cruz, Miguel Padrón, Florencio, Déniz, Navarro, Paco, Araña, Mendaño, Alfredo, Ramón, Juan Carlos, Acosta, Alonso, Marrero, Leandro, Nico, José Luis, Vázquez y Nieves. El plantel de entrenadores tendrá la baja del actual, que, por motivos personales, tendrá que ausentarse, Felipe Nuez, pero se reincorporarán Vázquez, a las tareas féminas junto con Villandiego, en las categorías inferiores estarán Florencio y Juan Navarro, mientras que en el Juvenil y Absoluto estará Pedro Castellano auxiliado por Miguel Padrón. Como vemos, de aquel Calvo Sotelo, donde Felipe Nuez era el único entrenador, ha pasado a un club con seis entrenadores. Es increíble el comprobar la cantidad de muchachos que entrenan los lunes, miércoles y viernes, en las instalaciones del colegio, donde la APA desarrolla una gran labor de promoción. Se participa en todas las categorías escolares, y en algunas hasta con dos equipos; hay ocho equipos de mini-volley, jugando una competición organizada por la dirección del centro, calculándose alrededor de doscientos muchachos los que trabajan en busca de su futuro. Los dirigentes del equipo se conforman con que, por año, le salgan dos buenos jugadores de las categorías inferiores, que indudablemente reforzarán la base sentada por el equipo juvenil".</NewspaperQuote>

      <p>Dicho y hecho. El Calvo Sotelo logró clasificarse para la fase de ascenso a Segunda División que se disputó en Cáceres en febrero de 1977. El Santa Ana, que ejercía de anfitrión, el Chamartín de Madrid, Camilo de Segovia, el Cisneros de Tenerife, la Universidad Laboral de Toledo y el Galerías Florita de Salamanca completaron el cartel de aspirantes que, divididos en dos grupos, buscaban el salto de categoría. No pudo ser en esta ocasión para el Calvo Sotelo, en el mapa nacional en todo caso y con los honores preceptivos por estar entre los mejores.</p>

      <NewspaperQuote>El amplio eco de la eclosión del proyecto se ensalza en la prensa por su labor cuidada de la base, verdadero orgullo de los integrantes del club. Así se hablaba de las excelencias del Calvo Sotelo, resaltando que tenía "el futuro asegurado al disponer de 16 equipos repartidos en todas las categorías".</NewspaperQuote>

      <NewspaperQuote source="La Provincia, 16 de junio de 1977">"Todos los componentes de esta gran familia pasando desde el conserje del colegio, encargado de servicios, director, padres de jugadores, junta directiva y, cómo no, la totalidad de los jugadores han hecho posible todo esto. Son estos últimos los que merecen especial atención, sacrificando alrededor de catorce horas semanales de los ratos en que no estudian o trabajan, en los entrenamientos, no desperdiciando ningún sábado o domingo, ni días de fiestas, para entrenar. El que quiera comprobarlo puede darse una vueltecita por las instalaciones del colegio un domingo por la mañana y los verá entrenar con una seriedad inmensa en su trabajo. Lo más importante, es el comprobar que no hay prisa, el club no desea la pérdida de categoría de sus jugadores juveniles y prefieren esperar dos temporadas más en Tercera División. Para ello, la plantilla que lo va a intentar entre absolutos y juveniles son los siguientes: Juan Cruz, Miguel Padrón, Florencio, Déniz, Navarro, Paco, Araña, Mendaño, Alfredo, Ramón, Juan Carlos, Acosta, Alonso, Marrero, Leandro, Nico, José Luis, Vázquez y Nieves. El plantel de entrenadores tendrá la baja del actual, que, por motivos personales, tendrá que ausentarse, Felipe Nuez, pero se reincorporarán Vázquez, a las tareas féminas junto con Villandiego, en las categorías inferiores estarán Florencio y Juan Navarro, mientras que en el Juvenil y Absoluto estará Pedro Castellano auxiliado por Miguel Padrón. Como vemos, de aquel Calvo Sotelo, donde Felipe Nuez era el único entrenador, ha pasado a un club con seis entrenadores. Es increíble el comprobar la cantidad de muchachos que entrenan los lunes, miércoles y viernes, en las instalaciones del colegio, donde la APA desarrolla una gran labor de promoción. Se participa en todas las categorías escolares, y en algunas hasta con dos equipos; hay ocho equipos de mini-volley, jugando una competición organizada por la dirección del centro, calculándose alrededor de doscientos muchachos los que trabajan en busca de su futuro. Los dirigentes del equipo se conforman con que, por año, le salgan dos buenos jugadores de las categorías inferiores, que indudablemente reforzarán la base sentada por el equipo juvenil".</NewspaperQuote>

      <SectionHeader>El ascenso a Segunda División de 1979</SectionHeader>

      <p>Lo que había quedado pendiente del año anterior, el ascenso a Segunda División, sí se materializó en 1979, en la fase decisiva que se libró en Málaga los días 9, 10 y 11 de marzo. En su primer partido, ganó con autoridad al Málaga por 3-0 (17-15, 15-10 y 15-4), luego se impuso por 3-1 al Dos Hermanas de Sevilla (15-1, 3-15, 15-6 y 15-1) y completó la fase previa con otro triunfo, esta vez ante el Jaén y por 3-0 (15-4, 15-2 y 15-4). Y en la gran final disputada en el turno vespertino del domingo 11 de marzo, y de nuevo frente al Dos Hermanas, se consumó el gran éxito con un 3-0 (15-12, 15-11 y 15-2) para la historia.</p>

      <p>Con este ascenso al Grupo Sur de la Segunda División, el Calvo Sotelo se queda como representante en el voleibol nacional junto al Juventud Las Palmas de Isidro Quintana y Joselu Sánchez.</p>

      <p>En su estreno en Segunda, temporada 1979-80, el saldo no pudo ser mejor, toda vez que se logró un segundo puesto que dio derecho a disputar la fase de ascenso a Primera División gracias, fundamentalmente, a que se mantuvo invicto en su feudo. En Cáceres afrontó una fase decisiva en la que no pudo culminar la gesta de haber encadenado otro éxito. La coincidencia del ascenso del Juventud permitió que se viviera el derbi capitalino en Segunda durante la campaña 1981-82, algo que se calificó como otro hito del voleibol grancanario.</p>

      <p>La entrada en escena de patrocinios, como ya se imponía en la realidad del deporte de comienzo de los ochenta, también formó parte de la historia del Calvo Sotelo, que, en virtud de un acuerdo con Tabacanaria, adoptó, de manera sucesiva, las denominaciones Reales y Lucky, dos marcas de cigarros. Un impulso económico que demandaba su auge en el panorama deportivo español, ya con el listón de la División de Honor en mente.</p>

      <SectionHeader>El acceso a la élite y su conflicto burocrático</SectionHeader>

      <p>Juan Carlos, Pericles, Isidro, Vázquez, Felo, Juani, José Luis, Silva, José, Ignacio, Valentín y Manolo integraron la plantilla que inició el curso 1983-84, si bien luego se añadieron nombres como Francés, Quique o José Ramón.</p>

      <p>Es en esta temporada cuando se va a producir un conflicto burocrático ("una cacicada federativa", según Felipe Nuez) que impidió el sueño de estar entre los mejores del país. A saber: en marzo de 1984 tomó parte de la fase de ascenso a la División de Honor que se celebró en Valladolid y junto a los equipos del Vigo, Gijón, Hellín, Veracruz de Huelva y Salesianos Atocha de Madrid. La tercera plaza obtenida, que en principio tenía un valor testimonial sin mayor trascendencia, pues solo subían los dos primeros, terminó adquiriendo una importancia capital al renunciar el Son Amar balear a su plaza en la máxima categoría. José María Rodríguez, presidente del Calvo Sotelo, elevó ante la Federación Española la intención de ocupar esa vacante, con el apoyo de Manuel Navarro, director general de Deportes del Gobierno de Canarias, e, incluso, contando con el beneplácito del Consejo Superior de Deportes en la figura de Antonio Abad, uno de sus delegados.</p>

      <p>Sin embargo, los clubes de la División de Honor se opusieron a una ampliación de la misma aludiendo a factores económicos relacionados con los desplazamientos, el Comité Superior de Disciplina Deportiva se declaró "manifiestamente incompetente", agotándose la vía administrativa, por lo que, ya habiendo arrancado la temporada oficial, y con el Calvo Sotelo compitiendo en Primera pero con la vía abierta de pasar a la División de Honor, el asunto llegó a la Audiencia Nacional en octubre de 1984.</p>

      <NewspaperQuote source="Comité Superior de Disciplina Deportiva, 8 de octubre de 1984">"En el día de la fecha por este Comité Superior de Disciplina Deportiva, se notifica lo siguiente a la Federación Española de Voleibol: en Madrid, a 8 de octubre de 1984, reunido el Comité Superior de Disciplina Deportiva, para conocer y fallar el recurso presentado por José María Rodríguez Herrera, como presidente del Club de Voleibol Reales Calvo Sotelo, contra acuerdo de la junta directiva de la Federación Española de Voleibol, relativo a la no inscripción del citado club para participar en la División de Honor masculina, y no siendo ello competencia del Comité Superior de Disciplina Deportiva, conforme con lo previsto en el número dos del vigente reglamento de Disciplina Deportiva, aprobado por el Real Decreto 642 / 84, de 28 de marzo. Este Comité Superior de Disciplina Deportiva acuerda no admitir a trámite el recurso presentado por don José María Rodríguez Herrera por ser manifiestamente incompetente para conocer sobre el fondo del asunto".</NewspaperQuote>

      <p>Finalmente, todos los esfuerzos quedarían desestimados.</p>

      <p>Así, la temporada 1984-85 arranca condicionada por este frente ajeno a lo deportivo pero que supuso una enorme decepción en el plano institucional, pues se contaba con que prosperaran unas alegaciones fundamentadas. Vuelta a empezar con un equipo de nuevo llamado a aspirar a la élite y cuya principal novedad estuvo en Sergio Miguel Camarero, un prometedor juvenil de 17 años llamado, con el tiempo, a ser parte del escudo por su impronta y ascendente. El calendario regular se desarrolla con los resultados esperados hasta desembocar, con un meritorio subcampeonato del grupo C, en la fase de ascenso que acogió Mallorca a mitad de marzo de 1985. Ya sería, felizmente, el intento definitivo. Los rivales que le tocaron en suerte esta vez fueron, por este orden, el Renfe de Lérida, el Son Amar de Mallorca, el Jovellanos de Gijón, el José María Pereda de Santander y, ya en la quinta ronda, el Orient Puerto de Málaga.</p>

      <p>No le fueron bien las cosas a los muchachos de Nuez en tierras baleares, pues concluyeron la liguilla en una cuarta plaza que no daba derecho a subir, ya que solo ascendían los tres primeros... Pero dos meses después, en concreto el 17 de mayo, la Comisión Ejecutiva de la Federación Española presidida por Feliciano Mayoral, aprobaba la propuesta de la Asociación de Clubes de ampliar a doce los componentes de la máxima categoría. Curiosidades del destino, el mismo colectivo que vetó al Reales en 1984 le dio vía libre un año después. Tal y como se anunció, el Lucky Calvo Sotelo competiría en el grupo par junto al Sanitas, Recuerdo, Biodrink Hispano Francés, Vigo Foqué y Orient Puerto de Málaga.</p>

      <SectionHeader>La cronología</SectionHeader>

      <Timeline>
        <TimelineEvent year="1967">Se inaugura el colegio Calvo Sotelo en el barrio de Las Rehoyas.</TimelineEvent>
        <TimelineEvent year="1968">El profesor Francisco Rodríguez introduce el voleibol como actividad deportiva extraescolar.</TimelineEvent>
        <TimelineEvent year="1972">Después de proclamarse campeón provincial, el equipo infantil femenino del Calvo Sotelo se alza con el título a nivel nacional en los II Juegos Escolares de su categoría.</TimelineEvent>
        <TimelineEvent year="1973">El equipo femenino de 2ª categoría juvenil, entrenado por Francisco Rodríguez, se proclama campeón Provincial Escolar tras ganar, en la cancha Eliseo Ojeda, al Instituto Isabel de España. El partido fue arbitrado por Felipe Nuez. Ese mismo año el centro crea un torneo con su propio nombre.</TimelineEvent>
        <TimelineEvent year="1974">Creación de la selección cadete de Las Palmas, a cargo de Felipe Nuez, que sería la base del posterior equipo juvenil masculino del Calvo Sotelo. También se produce el debut en competiciones federadas del equipo masculino en el Campeonato Provincial de Segunda División.</TimelineEvent>
        <TimelineEvent year="1975">Entre el 9 de septiembre y el 5 de octubre tiene lugar la Copa Federación, o Torneo Apertura, que abre la temporada 1975-76. El Calvo Sotelo participa en las tres categorías, Segunda División masculina, Absoluta femenina y Juvenil masculina.</TimelineEvent>
        <TimelineEvent year="1976">Redacción de los Estatutos Fundacionales del Club Voleibol Calvo Sotelo.</TimelineEvent>
        <TimelineEvent year="1977">Primer intento del Calvo Sotelo por ascender a la Segunda División que no culmina en la fase decisiva celebrada en Cáceres.</TimelineEvent>
        <TimelineEvent year="1979">Se consuma el ascenso a la Segunda División, tras saldar con éxito sus partidos definitorios en Málaga ante el anfitrión, el Dos Hermanas y el Jaén, quedando como representativo a escala nacional del voleibol grancanario junto al Juventud.</TimelineEvent>
        <TimelineEvent year="1984">La Federación Española le niega al Reales, denominación comercial de entonces del equipo, el ascenso a la División de Honor a instancias de los clubes peninsulares, que no aceptan que la renuncia del Son Amar sea cubierta por el equipo grancanario que, en virtud de la tercera plaza obtenida en la fase de ascenso celebrada en Valladolid, estaba en el legítimo derecho de reclamar esa posición, llegando, incluso, a apelar a la Audiencia Nacional.</TimelineEvent>
        <TimelineEvent year="1985">Ascenso a la División de Honor con una secuencia similar a la del año pasado pero con final en dirección feliz. El Calvo Sotelo, en el que ya sobresale un Sergio Miguel Camarero en edad juvenil, no logra subir en la cancha, tras quedar cuarto en la liguilla disputada en Mallorca, pero una posterior ampliación de la División de Honor a doce equipos le hace sitio entre los mejores del país, tal y como ratificó la Federación Española.</TimelineEvent>
      </Timeline>
    </>
  ),

  // ═══════════════════════════════════════════════
  // Player profiles for Chapter 2
  // ═══════════════════════════════════════════════
  "cap02-felipe-nuez": (
    <>
      <DropCap>Felipe Nuez (Moya, 1956-Las Palmas de Gran Canaria, 2024) fue la figura fundamental y maestra en la vida del club. Presente desde el mismo inicio de la actividad escolar que se dedicó al voleibol con especial ahínco, llegó como profesor en prácticas al colegio Calvo Sotelo en 1973 sin saber que, junto a otros precursores, iniciaría una historia de superación y éxitos que todavía perdura y que fue, también, orgullo del deporte canario. Su pasión por la disciplina que le dio fama y prestigio vino por consejo de José Antonio Giráldez, quien fue uno de sus maestros más respetados. "Como todos los chicos de la época, empecé en el fútbol. Pero Giráldez me dijo que me veía condiciones mejores para el voleibol y le hice caso. Lo disfruté más en la faceta de entrenador, aunque hice alguna vez de árbitro y asumí otras responsabilidades. Como jugador no destacaba especialmente en nada y supe darme cuenta para volcarme en lo que siempre me gustó", indicó.</DropCap>

      <p>Un repaso a su cronología personal evidenciaba que, a edad temprana, ya era elemento referencial. En 1974 fue designado como el técnico de la recién creada selección cadete de Las Palmas, cargo que compatibilizaba, tras haber ejercido en el Canteras, con la formación de la base en el Calvo Sotelo, en aquella época el segundo colegio con mayor densidad de España, con alumnos procedentes del mismo barrio de Las Rehoyas pero también de otros parajes aledaños ("venían guaguas abarrotadas de alumnos cada mañana"). Y con el apoyo del director del centro, Guillermo Gil, y una Asociación de Padres de Alumnos (APA) "volcada con el deporte y la formación". Porque, como bien resaltaba, el programa de actividades extraescolares contemplaba otras modalidades como baloncesto o lucha canaria... "Pero el voleibol acabó llevándose toda la atención por el nivel de preparación, organización y crecimiento que fuimos teniendo desde los inicios, aunque ya con una importante base heredada por el trabajo de Francisco Rodríguez, quien acabaría siendo destinado a Arinaga pero que, a finales de los sesenta y comienzos de los setenta, sembró una semilla muy valiosa a la que se dio continuidad".</p>

      <NewspaperQuote>"Fui autodidacta. Obtuve el título de entrenador nacional con 20 años y, en 1984, el de técnico internacional. En esos años de los comienzos, la única manera de ampliar conocimientos en el voleibol era explorando métodos de trabajo en otros países, como Japón, que era una potencia inalcanzable por su nivel de desarrollo. Y cada vez que podía viajar, ya fuera con el equipo o en los cursos formativos, pasaba por la librería deportiva Esteban Sanz de Madrid y me compraba unos tomos fantásticos que solo podían encontrarse allí. Y de vez en cuando conseguía las cintas de vídeo super-8 para empaparme de lo que se hacía en otros países. Uno de mis ejercicios que llamó más la atención, el de agresividad, consistente en dar balonazos a un jugador que se cubre la cara y sus partes para que se acostumbre al impacto del balón, lo saqué de lo que se hacía en Japón. Siempre entendí el deporte de manera perfeccionista y ganadora. Entrenara a cadetes, juveniles o séniors. El trabajo, el compromiso y el sacrificio eran para mí innegociables. De lo contrario, prefería quedarme en mi casa"</NewspaperQuote>

      <p>Y así lo cumplió. Sus pupilos de entonces recordaban una metodología que rozaba la exigencia profesional. Sesiones físicas de hasta cinco horas diarias ("veía lo que hacían otros equipos y doblaba en tiempo e intensidad mi programa de trabajo para superarlos; que corrían dos horas, pues nosotros cuatro"), ejercicios en el gimnasio antes de que amaneciera, concentraciones en Navidad o Semana Santa, prohibición de ir a la playa durante el calendario... "Hicimos del deporte un modo de vida y eso aumentó el apoyo de los padres a nosotros. Ver que a sus hijos se les exigía disciplina y se les modelaba con hábitos sanos, incentivando también el compañerismo, era de su total agrado. También queríamos que estudiaran, que sacaran buenas notas. En un entorno geográfico un tanto problemático, con barrios en la periferia de rentas bajas y deficiencias estructurales, el Calvo Sotelo era una especie de excepción en la que no había límites a la hora de superarse. La gente se transformaba al entrar allí. Y el APA del Calvo Sotelo nos daba todo lo que necesitábamos en cuanto a material. Equipaciones, balones... Incluso no me quiero olvidar de la implicación de Pepito, el portero, que no dudaba en ir casa por casa cobrando la cuota del APA para ayudar al proyecto. Había una unión espectacular entre jugadores, técnicos, padres, dirigentes del colegio...".</p>

      <p>El crecimiento y los progresos continuados de los distintos equipos representativos del Calvo Sotelo, en todas sus categorías, así como el prestigio que se fue granjeando lo vivió Nuez "con naturalidad", pues siempre sostuvo "que el trabajo acaba teniendo resultado".</p>

      <p>Una anécdota resumía su exigencia: "En varios viajes coincidíamos con la expedición de la UD Las Palmas y los jugadores, cuando hablaban con los nuestros y veían lo que entrenábamos, nos pedían que ni se nos ocurriera decirle eso al cuerpo técnico que tenían. Se quedaban asustados".</p>

      <p>Recordaba la rivalidad con el Salesianos o el Juventud, en los primeros tiempos, "como un aliciente para ser más competitivos siempre" y, también, "como una aportación para que el voleibol se consolidara más en Canarias". Porque "los llenos a reventar" en las distintas canchas en las que se disputaban partidos, a veces hasta con independencia de los contendientes, aunque el Calvo Sotelo "arrastraba muchísimo", fueron una contribución "de enorme valor" y generaron un efecto llamada, ya que "hubo un auge enorme a final de los setenta y comienzos de los ochenta en las fichas e inscripciones de jugadores".</p>

      <NewspaperQuote>"¿Si esperaba que el Calvo Sotelo llegara tan alto? Realmente no tenía pretensiones. Vivía el día a día, disfrutaba, me entregaba en cuerpo y alma, quería estar al lado de los chicos, ayudarles a desarrollarse... Es verdad que fue muy confortante ver que pasaban los años y un proyecto escolar terminaba tomando forma, se convertía en club, ascendía de categorías, se codeaba con los mejores del país... Y ya ni qué decir cuando se logró entrar en la División de Honor, a mitad de los ochenta. Pero no tenía tiempo para pararme a pensar, para el elogio. Cada año era empezar de nuevo e ir a por más, con el apoyo, eso sí, de un grupo de jugadores que siempre fue sensacional. Con los cambios que se dieran, con las circunstancias que fueran. No distingo porque guardo un recuerdo especial de todo ese tiempo. Miro atrás y mi lectura es positiva al máximo"</NewspaperQuote>

      <p>El ascenso a la Segunda División en Málaga, en 1980, el posterior que se negó a la División de Honor por imperativo federativo, por la reducción de equipos en 1984 ("fue un escándalo de tal dimensión que hasta José María García nos llamó para su programa en la Cadena SER, número uno de audiencia a nivel nacional, para que denunciáramos una injusticia que, finalmente, se materializó"), las temporadas de transición hasta que en 1985 sí se alcanzó la máxima categoría ("un premio merecido y que honró el trabajo de base, de cantera, en las campañas precedentes, jugando siempre con cuatro juveniles de la casa como Camarero, Jorge Ramón, Campos y Juanma Martín"), el debut en competiciones europeas ante el Knack de Bélgica, allá por 1987, en el San Román ("una noche irrepetible, una experiencia increíble por lo que suponía a todos los niveles"), los subcampeonatos de Copa y de Liga que antecedieron a los hitos que luego vendrían... Todo lo vivió en carne propia alguien que llegó sin más motivación que realizar sus prácticas de magisterio en el Calvo Sotelo y acabó erigiéndose en entrenador de leyenda.</p>

      <p>Fueron numerosas las ofertas que recibió para cambiar de aires, aunque nunca terminaron de seducirle en fondo y forma. Celoso de su porvenir, el conservar la plaza de profesor siempre antepuso su estabilidad laboral. "Cobraba un complemento del APA por dirigir al equipo de voleibol y eso lo añadía a mi sueldo de maestro. Pero no hablo de dinero cuando lo hago de voleibol porque para mí el deporte ha estado siempre por encima de cualquier otro interés fuera de la cancha. Es mi vocación absoluta y he renunciado a muchísimas cosas por ello. Y no me arrepiento. Lo volvería a hacer".</p>

      <p>"La entrada de Juan Ruiz en el club, ya entonces con denominaciones de patrocinadores como Reales, Lucky, Guaguas, luego Constructora para de nuevo ser el Guaguas de toda la vida, supuso un paso a la modernidad. Desde el primer momento, no hubo imposibles para él. Fichó de una tacada a Sánchez Jover o Venancio Costa y dejó apalabrados, ya para el año siguiente, a Klos o Golec, figuras mundiales. Lo que se le metía en la cabeza lo conseguía. Ya no hablo de patrocinadores. Nos llegaron a multar por exceso de publicidad estática en el pabellón. Había un límite y se sobrepasó con la cantidad de anunciantes que consiguió... Era todo surrealista en el buen sentido de la palabra".</p>

      <SectionHeader>La cronología</SectionHeader>

      <Timeline>
        <TimelineEvent year="1975">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">La selección cadete</SectionHeader>
          <NewspaperQuote source="El Eco de Canarias, 16 de octubre de 1975">"Nuestra intención con la selección cadete de Las Palmas es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1976">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">Un primer diagnóstico</SectionHeader>
          <NewspaperQuote source="El Eco de Canarias, 12 de junio de 1976">"El futuro de nuestro voleibol lo veo, según las últimas competiciones que he visto de las categorías infantil, cadete y juvenil, muy negro, debido a que se le da poca importancia a la preparación de las categorías de base y, en cambio, se preocupan mucho por su equipo representativo en categoría absoluta".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">La estructura primigenia</SectionHeader>
          <NewspaperQuote source="La Provincia, 18 de noviembre de 1976">"Nuestras plantillas absolutas y juveniles entrenan los lunes, miércoles y viernes, con doble sesión el miércoles. La preparación física la realizamos en el Gimnasio Falla y la técnica en nuestra cancha Calvo Sotelo. Normalmente también entrenamos los sábados, aunque todo depende del calendario que tenemos. Actualmente, solo hay dos técnicos, que son insuficientes, si tenemos en cuenta el número de equipos. Aparte de mí, está Emilio Bonilla, quien se está encargando de la labor en el equipo femenino. Contamos con diez jugadores en el equipo absoluto y veintidós juveniles repartidos en nuestros filiales de la categoría absoluta. En el equipo femenino tenemos un plantel de treinta chicas repartidas en tres equipos. Por último, tenemos cuatro equipos en la categoría infantil, que forman la base de nuestro futuro. En el Tercera División, tenemos jugadores con la capacidad de ser campeones provinciales, y luego intentar el ascenso, pero mientras haya algunos jugadores que sigan ausentándose a los entrenamientos y partidos costará bastante proclamarnos campeones, ya que la Liga este año se caracteriza por la igualdad existente entre todos los equipos. El equipo juvenil, por su parte, aspira a unos puestos más altos dentro del próximo Campeonato de España, aunque como las lesiones nos sigan produciendo estragos, nos va a ser muy difícil conseguirlo. ¿El femenino? Debido a que el plantel de este año está renovado casi al completo, nuestras metas inmediatas con las chicas están a cuatro años vista, debido a que prácticamente estamos partiendo desde cero".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1978">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">El sueño emergente de la Primera</SectionHeader>
          <NewspaperQuote source="El Eco de Canarias, 18 de febrero de 1978">"A nivel nacional, estamos entre los dos primeros. Creo que estamos después de Madrid, si vemos los resultados generales, pero si me quejo del nivel provincial, ya comprobarán como está el nacional. Estamos viviendo de las rentas de dos o tres equipos y lo que es peor se trabaja muy poco el futuro y se vive demasiado el presente. En cuanto a jugadores, si no fuera por la lejanía, hay algunos que en la selección española no desentonarían lo más mínimo. El año pasado Alfredo estuvo seleccionado para la juvenil y se lesionó. Este año hay cuatro juveniles nuestros con posibilidades y que están en la lista, pero claro, sale más barato todo el Real Madrid en la selección que uno del Calvo Sotelo, y ya me entienden. Yo creo que tanto Alfredo como Ramón, por sus cualidades, pueden estar perfectamente vistiendo la camiseta nacional, en ella, he visto jugadores muy inferiores a ellos, y prefiero no seguir hablando del tema. A Montelongo es otro jugador que le veo muy bien y, además, con el aliciente de Jugar en Segunda División. ¿Un equipo canario en la Primera División? No hay que improvisar ni equipos ni jugadores. Hay que empezar desde la base, no vivir de las rentas de un equipo que nos ha dado satisfacciones. Actualmente, si hacemos una mezcolanza de jugadores canarios, podríamos tener un equipo en la Primera División. Pero el dilema sería el comprobar si ese equipo se mantendría. No creo en equipos por sus individualidades. El voleibol es eminentemente un juego de conjunto, y el conjunto se consigue a base de mucho trabajo. O sea, años, días y horas de entrenamiento, para mí lo ideal, a nivel provincial, es que cada club trabaje la base, intentando fomentar la competencia con los demás, para tener equipos que luchen por la victoria, cada uno por su lado. Esto daría un nivel muy alto de juego, y el mejor preparado que estuviera subiría a la máxima categoría sin lugar a dudas. Muchos técnicos me han dicho que el Calvo Sotelo si sigue su trayectoria subirá a Primera. Yo les he contestado (¿cómo?) si a nivel provincial no nos compiten en absoluto y en juveniles tampoco. Se me han llegado a aburrir jugadores y no querer jugar más, por no encontrar estímulos y alicientes en la competición. Menos mal que en cadetes e infantiles jugamos un partido al año que no es tan fácil para ninguno de los equipos. Yo me pregunto si merece la pena trabajar todo un año para jugar un solo partido, porque no olvidemos que la competición es buscar la victoria partido tras partido. No quiero hablar de otros clubs provinciales, solo me atañe el mío, respeto el criterio y trabajo de los demás, sus razones tendrán, pero...".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">Naturaleza del proyecto y una afición única</SectionHeader>
          <NewspaperQuote source="La Provincia, 18 de febrero de 1978">"Somos un club de voleibol que tiene otra sección de balonmano, y cuyo único fin es el intentar llegar a conseguir los objetivos máximos del deporte, así como la formación integral del deportista dentro de la faceta de aficionados. Dentro del barrio en que estamos situados, representa el lanzamiento de ciertos muchachos que quieren promocionarse y llegar lo más lejos que puedan en el voleibol y en el balonmano. A nivel provincial y regional representa, asimismo, el primer club que se ha puesto a trabajar de una forma planificada y seria el vóley, aunque la primera promoción se encuentra todavía en juvenil. Esto quiere decir que todavía somos un club joven, del que todos esperamos mucho a largo plazo. Siempre creo que hay que trabajar a largo plazo, con planificaciones de cuatro, ocho o diez años vista. Nosotros hemos tomado la de cuatro años, debido a las circunstancias de nuestro entorno de trabajo, con unas metas intermedias en cada año, que son las que llamamos a corto plazo. A corto plazo tenemos en la presente temporada la participación en la fase de ascenso a la Segunda División, así como el llegar al máximo en el Campeonato de España Juvenil. A largo plazo, pretendemos que con los jugadores que vienen de cantera con una planificación de ocho años, el llegar a la Primera División. Estamos totalmente convencidos de que el equipo juvenil no va a ser más que el primer eslabón de ese equipo futuro que pretendemos hacer. Hasta ahora, todas nuestras metas intermedias han sido cumplidas a la perfección. ¡Ojalá sigan así! No suelo predecir los resultados y clasificaciones. Solo conozco una cosa desde que soy entrenador. Trabajo, hace tres años, con el Calvo Sotelo. Me planteé el llegar al máximo que las circunstancias nos permitan, llámese Segunda o Primera División. Planificamos con el equipo juvenil actual, un trabajo de cuatro años, a fin de que cuando estos jugadores llegaran a la categoría absoluta, nos dieran la satisfacción de ir consiguiendo buenos jugadores de voleibol. Tenemos planificado el ascenso en la próxima temporada, no en la actual, ya que disponemos de diez o doce jugadores que podrían actuar a este nivel. Ante todo, quiero aclarar que si se nos presenta la ocasión en la actual, no la desaprovecharemos. Pero cuento con pocos absolutos, y solamente puede actuar en una cancha cuatro juveniles, lo que va a ser un hándicap enorme en una fase de ascenso, caso de que nos proclamemos campeones provinciales. Así, que aquellos que piensan que subiremos fácilmente, lo reconsideren y sean más objetivos, no se fijen en el equipo juvenil, y que si no ascendemos no lo considere un fracaso. En ningún otro lado de la geografía hispana he tenido ocasión de ver algo igual en cuanto a afición. La nuestra es muy numerosa, pero, además, entendida y sin fanatismos. Aunque anima a su equipo, sabe apreciar perfectamente al contrario y aplaudirle en sus buenas jugadas. En cualquier partido de Primera División va menos gente que a uno infantil en Las Palmas. Nuestro equipo ha tenido la fortuna de que es muy apoyado en Las Palmas, y que, cuando salimos, caemos bien al público y nos animan. Como ocurrió en Cáceres, La Orotava, Icod, etc. Contra el Empetrol no respondimos al público como se merecía; todo nos salía mal, y cuando lo intentamos hacer mejor ya era algo tarde. Yo pido a mis jugadores que se ganen el agrado del público, tanto en casa como fuera de nuestro feudo".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1979">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">Sin límites a la hora de progresar</SectionHeader>
          <NewspaperQuote source="Diario de Las Palmas, 30 de agosto de 1979">"Yo entiendo que la táctica es la disposición del equipo de acuerdo con sus jugadores y los contrarios, tanto en ataque como en defensa en cada partido. Por tanto la táctica será distinta en cada encuentro que juguemos. Lo que si te podré decir es que nuestro sistema de juego adquirirá más velocidad que en la temporada pasada, para lo cual estamos trabajando nuevas jugadas, que de momento, estamos comprobando en entrenamientos y partidos amistosos. La directiva me ha dicho que lleve al equipo hasta donde pueda rendir, y no me han puesto trabas de ninguna especie económica, aunque eso sí, soy consciente del problema actual económico del club, por lo que me adapto en lo posible a las exigencias y condicionantes que tenemos. Colocadores: Ramón, Miguel, Batista, Vélez y De la Cruz. Rematadores: Juan Carlos, Araña, Vázquez, José Luis, Alfredo, Isidro, Pericles, Cándido, Arturo y Ruano. El único fichaje procedente del exterior es el gaditano Vélez, que llega del Avante, que nos va a resolver una buena papeleta en la presente temporada".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1980">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">Seguridad en el éxito</SectionHeader>
          <NewspaperQuote source="Diario de Las Palmas, 7 de marzo de 1980">"El Calvo Sotelo tiene una excelente plantilla como para colocarse entre los dos primeros puestos de ambas series y ascender a la Primera División. Desplazamos a Cáceres a Isidro, Araña, Alfredo, Ramón, Vázquez, Mendaño y el juvenil Chago. En total, siete. En anteriores partidos nos faltó mentalización. Los jugadores se caían fácilmente. Creo que ese problema está superado. Si no ocurre una desgracia, conseguiremos el ascenso".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">Afán innegociable de superación</SectionHeader>
          <NewspaperQuote source="El Eco de Canarias, 17 de agosto de 1980">"Como colocadores tenemos a Mendaño, Batista (juvenil), Carmelo, Ramón y Juan Carlos. Rematadores por tres tenemos a Pericles, Alfredo, Ruano y Martin (juvenil). Rematadores por cuatro a Vázquez, Leandro Arturo (juvenil) y Córcoles (juvenil). Entrenamos en las siguientes canchas: San Román, Calvo Sotelo, Gimnasio Municipal y López Socas. Nuestra meta, por supuesto, es superar la campaña anterior, incluso mejorarla. Las dificultades son los pocos jugadores de la temporada anterior y los varios juveniles que quiero adaptar al primer equipo".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1983">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">Al rescate</SectionHeader>
          <NewspaperQuote source="Canarias7, 10 de marzo de 1983">"Mi vuelta al equipo de Segunda División, tras la dimisión de Fidel Morales, es provisional. Para estar a gusto me gustaría estar con infantiles futuribles y con todos los medios disponibles para hacer una buena labor".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1985">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">Cantera, cantera y cantera</SectionHeader>
          <NewspaperQuote source="Canarias7, 1 de marzo de 1985">"El tiempo ha sido el verdadero juez. Se nos tachaba de que nos nutríamos poco de la cantera propia. El 80% del primer equipo ha sido formado en nuestros filiales. El Segunda División se ha clasificado segundo y con presencia en la misma fecha para la fase de ascenso a Primera en Cádiz. El juvenil ha vuelto a reverdecer viejos laureles, el cadete, subcampeón provincial, y el infantil, campeón provincial. Hasta ahora se han conseguido grandes cotas, por lo que, insisto y caso de mejorarlas, no son producto de la casualidad, sino del trabajo continuado. Creo que todo ha salido como teníamos pensado hasta este instante. La segunda plaza, prefijada de antemano, ha colmado con creces nuestras intenciones de clasificarnos para la fase final. El jugar con equipos como Málaga, indudablemente superior, Santa Otilia y Licenciados, más a nuestro nivel, hizo que el grupo fuera con mucho más competitivo que el de la temporada anterior. Tiene el ejemplo claro de Veracruz, al pasar de segundo clasificado a último en la recién finalizada liga. Otro factor importante ha sido la buena pretemporada que se realizó, pensando en la División de Honor. Por último, creo que lo más positivo ha sido el gran poder de superación ante la cacicada federativa y volver a trabajar con la ilusión de siempre. Estoy plenamente convencido de que, de subir de categoría, y trayendo uno o dos jugadores, con el futuro de los nuestros, podemos llegar a metas antes insospechadas en nuestro voleibol".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">Un acto de justicia</SectionHeader>
          <NewspaperQuote source="Diario de Las Palmas, 13 de marzo de 1985">"Es la fase más difícil a la que hemos asistido. El nivel es alto y las diferencias las marcan Son Amar y Orient Puerto. Nosotros vamos a por la tercera plaza, puesto que con la reestructuración que se va a realizar, según dijo el presidente de la FEV, el grupo de División de Honor se ampliará. El año pasado no solamente fue culpa de la FEV. sino también del CSD y de los organismos autonómicos, que se desentendieron y nos dejaron solos. Ahora parece que todo ha cambiado e incluso la Federación nos comunica nuestras posibilidades. Tenemos un equipo diferente a la temporada anterior, donde se mezcla la juventud y la veteranía. Hemos aumentado la estatura (1,87 de media) y hemos dado un paso muy positivo. La preparación física no será un problema y mi preocupación en cuestión técnica reside a la hora del saque, que no hemos podido preparar en óptimas condiciones. Después está la cuestión psicológica, donde la inexperiencia de algunos jugadores en los momentos difíciles puede ser importante, pero espero que los veteranos tomen la batuta. Subir sería el «boom» del club y del voleibol grancanario y un lugar en División de Honor dejaría a este deporte y categoría en su justo sitio. Nosotros, por nuestro historial y trayectoria, estamos entre los primeros de España y creo que merecemos el ascenso, aunque hay que jugar primero".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">La profesionalización necesaria y la predicción sobre Camarero</SectionHeader>
          <NewspaperQuote source="La Provincia, 15 de junio de 1985">"Pasa que hay mucha gente que piensa que ha sido un regalo federativo nuestro ascenso y esto no es así. La remodelación de la División de Honor no es posterior a la celebración de la fase de ascenso; nosotros ya conocíamos antes de acudir al torneo que el cuarto clasificado ocuparía una de las plazas de ascenso porque ya había sido aprobado desde diciembre. Ocurrió simplemente que el Calvo Sotelo es cuarto y por lo tanto obtuvo el derecho a cambiar de categoría. Nos duele un poco que en esta movida de recibimientos, comidas, actos y demás que se han producido con los equipos de la ciudad que han ascendido, me duele, digo, que el Lucky se haya quedado al margen de todo ello porque hemos luchado muchísimo por lograr estar arriba. Incluso hay que tener en cuenta que nosotros nos debemos a un sponsor que también desea que se le reconozcan los méritos a su patrocinado. Con jugadores de esta casta se garantiza ante todo el espectáculo, que es lo que hace motivar a la afición, un tanto aburrida últimamente en Las Palmas. El Lucky no quiere dormirse en absoluto durante este verano y queremos preparar un buen equipo para la próxima temporada. Amén de Ortiz e Ivo, hemos incorporado a Felipe, el techo del voleibol canario con 1,97, y Óscar, que proceden del Juventud, y Juan Manuel y Reyes, del San Roque. Creo que el Calvo Sotelo ha conjuntado al mejor plantel de toda su historia. Sin embargo son jugadores jóvenes, edades que oscilan entre 17 y 21 años, muy altos, 1,88 de media. Con un equipo de cantera el Lucky está predestinado a sufrir en la División de Honor. Nos faltaba la experiencia que pueden aportar Martinovic y Ortiz. Hemos incorporado a un preparador físico de solera, como es el caso de José Antonio Serrano, olímpico en dos ocasiones en pentatlón moderno, y ya desde agosto nos pondremos en marcha con seis horas diarias de entreno. Es que el vóley de este país ha cambiado mucho de un tiempo para acá y ello exige un gran nivel y una gran preparación. Los equipos que no se profesionalicen o semiprofesionalicen prácticamente no tienen nada que hacer. Hace seis años había en Las Palmas un gran ambiente de vóley pero, tras el ascenso a Segunda, se perdió. Nosotros confiamos en que con la incorporación de Ortiz y Martinovic, más la aportación de jugadores de la cantera, como es el caso de Sergio Camarero, pese a sus 17 años sin duda el mejor del Archipiélago, el éxito está garantizado".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">Un adiós que no lo fue</SectionHeader>
          <NewspaperQuote source="Diario de Las Palmas, 15 de agosto de 1985">"A principios de junio dejé el club por no estar de acuerdo con las directrices que se estaban llevando a cabo, que unido a la desmoralización por falta de apoyo y reconocimiento por los organismos oficiales, no solo con nuestro club, sino con todo el vóley canario, después de los éxitos alcanzados la pasada temporada, llámese ascenso del Calvo Sotelo a División de Honor, tercer puesto del Tirma en el campeonato femenino, ascenso del San Roque La Irlandesa y el Calvo Sotelo a la Primera División nacional y el tener en nuestra provincia a un internacional que ha vestido la camiseta de la selección en doce ocasiones, y que no ha sido lo suficientemente reconocido, pese a salir de la cantera canaria. A partir de la segunda quincena de julio mantuve unas conversaciones con el presidente del club y le expuse mi esquema de trabajo deportivo, con unos presupuestos mínimos para la ejecución de un plan a ocho años, nuevo director técnico, el preparador físico y, como mínimo, dos jugadores de alta veteranía y calidad para reforzar al primer equipo, con las metas puestas en hacer un papel considerable en esta categoría. Hubo pleno acuerdo. Colocadores tenemos a Óscar Campos, Juan M. Martín, Ignacio Brito y Sergio Camarero. Rematadores por tres: Enrique Silva, José Luis Brito, el Chicha, y Alejandro Gil. Por la zona cuatro tenemos a: Martinovic, Francisco Reyes, Jorge Ramón, Antonio Vázquez y José Ramón. Varios de los jugadores tendrán licencias con el equipo de Primera División con el fin de mantener la actividad. Los posibles fichajes son Alfredo Padrón, procedente del Cisneros, y Venancio Costa, internacional júnior de Alicante".</NewspaperQuote>
        </TimelineEvent>

        <TimelineEvent year="1988">
          <SectionHeader highlighted={false} className="text-base md:text-lg mt-0 mb-2">El subcampeonato más dulce</SectionHeader>
          <NewspaperQuote source="Canarias7, 26 de enero de 1988">"Este subcampeonato de Copa del Rey sabe a mucho a pesar de que hay personas que piensan que pudimos dar la sorpresa en la final y ganarle al todopoderoso e invencible CV Palma, labor ardua pues se trataba de sorprenderle nada menos que en su propia casa, después del espectáculo que dio como equipazo en Las Palmas. Quiero felicitar a la junta directiva, jugadores, técnicos de la cantera, a José Antonio Serrano, preparador físico, socios, aficionados, a los doctores Apolinario y Ramos, auxiliares de instalación, patrocinadores, medios... A todos los que se han desvivido para que esto sea una realidad".</NewspaperQuote>

          <SectionHeader highlighted={false} className="text-base md:text-lg mt-4 mb-2">El mérito del colectivo</SectionHeader>
          <NewspaperQuote source="Canarias7, 8 de agosto de 1988">"La trayectoria ascendente del Guaguas Las Palmas no se logra con un entrenador que no conoce profundamente este deporte. Los resultados son los únicos elementos objetivos que valoran el trabajo realizado, y a ellos me remito. Desde hace dos años, se ha pasado de una posible retirada a la Recopa de Europa. Ciertamente, la labor general de jugadores, técnicos y gestora ha sido ardua para conseguirlo pero el éxito o fracaso nunca es individual en un colectivo. Sobre Sánchez Jover diré que es un gran líder, sin lugar a dudas, el mejor jugador de España".</NewspaperQuote>
        </TimelineEvent>
      </Timeline>
    </>
  ),

  "cap02-isidro-quintana": (
    <>
      <DropCap>A Isidro Quintana (Las Palmas de Gran Canaria, 1957) le metieron el voleibol en su vida "por obligación", como reconoce, porque, integrado en la sección de baloncesto de la UD Las Palmas durante su adolescencia ("llegué a jugar contra Domingo Díaz, que luego ha sido lo que ha sido"), iba para pívot con su imponente estatura en plena pubertad. "Pero se me cruzó en el camino Silvestre Cabrera, que me daba clases en los Salesianos, y me dijo, medio en serio, medio en broma, que o hacía voleibol o me suspendía. Me convenció prometiéndome que me llevaría directamente a la selección júnior. Empecé y ya no lo dejé. Fue tal mi interés que me saqué la titulación nacional de entrenador con 17 o 18 años para tener una formación más amplia y poder dirigir equipos, como luego haría con el Santa Teresa, y que, con Carlos Bermúdez como presidente, alcanzó enorme relevancia", añade.</DropCap>

      <p>El caso es que, compaginando su labor de jugador, con inicio en el Juventud, con el de técnico en el conocido como Rusell Hall en honor a su patrocinio, y el de periodista, ejerciendo como informador en distintos medios de comunicación, Isidro Quintana se fue convirtiendo en toda una personalidad del voleibol isleño y con una influencia en todos los ámbitos que no paró de expandirse desde finales de los setenta hasta su reciente jubilación.</p>

      <p>"Fue por una gestión mía, que hice a título personal y altruista, la llegada del primer sponsor de la historia del Calvo Sotelo, como ya antes había hecho con el Santa Teresa. Hablé con un contacto que tenía en Tabacalera y de ahí terminaron viniendo las denominaciones de Reales o Lucky Stricke. De hecho, en mi coche de entonces llevaba serigrafiados esos dos logotipos para dar mayor publicidad, Y Juan Ruiz, tanto antes de entrar por primera vez como presidente como cuando refundó la entidad, me llamó a título particular para avanzarme sus planes y pedirme consejos en virtud de mi experiencia. Un gesto que me llenó de orgullo. Por supuesto, siempre traté de ayudarle y brindarle el máximo apoyo que podía", razona.</p>

      <p>Reclutado para el Calvo Sotelo por Felipe Nuez ("me convenció hablándome de potenciar un proyecto que iba para arriba y con una metodología de trabajo que yo sabía que nadie tenía en Canarias"), su desembarco en el club, en la campaña 1983-84, coincidió con el de otros dos compañeros del Juventud ("Ignacio Brito y el Chicha") que, según su parecer, "desniveló la balanza en favor del Calvo Sotelo en la rivalidad capitalina que existía y que, hasta ahí, era favorable al otro equipo".</p>

      <p>"Felipe me puso de central, cuando siempre había sido receptor. Fue un acierto porque pude dar un rendimiento importante para ayudar a los compañeros. Y me terminó de demostrar su enorme inteligencia como entrenador cuando transformó a Mendaño de rematador a colocador después de que sufriera una lesión que le dejó secuelas y le impedían subir a la red como antes. Fue una maniobra genial de Felipe, quien fue una figura capital en los primeros tiempos del Calvo Sotelo con su constancia, perfeccionismo y dirección magistral. Él puso las bases de lo que vendría después", opina Quintana.</p>

      <p>Fueron tres temporadas de militancia en el equipo, con picos de relevancia, como el ascenso a la División de Honor en 1985 o "la multitud de momentos de enorme compañerismo y amistad" que le deparó esta gran experiencia.</p>

      <p>"Éramos un grupo sano, de amigos y que teníamos una gran relación dentro y fuera de la cancha. Ninguno podíamos pensar que aquello terminaría yéndose de las manos a todo el mundo y convirtiéndose en lo que fue, un equipo campeón, con dobletes nacionales, algo que tiene un mérito tremendo. La clave en esta transformación, en este salto al estrellato, se personifica en Juan Ruiz. Para mí es el rey, la persona clave. No se entiende el Guaguas sin Juan Ruiz y creo que no se entiende Juan Ruiz sin el Guaguas. Apostó por traer extranjeros, por ir a por los mejores jugadores que había en los rivales. Era la única manera de hacer un proyecto ganador. Asumió sus riesgos pero también hizo valer sus contactos, el don de gentes, su capacidad para aglutinar patrocinios y apoyos. Realizó un trabajo sensacional cuando llegó a la presidencia y, también ahora, cuando ha vuelto desafiando un periodo de crisis, y los títulos constituyen un justo premio a su impresionante gestión", afirma.</p>

      <p>En su rol de periodista, ya finalizada su etapa como jugador en el club, ha sido testigo puntual y al detalle de todas las gestas y progresos del Calvo Sotelo: "Su historia, desde el patio de un colegio, a la cima nacional, es de una grandeza enorme. Irrepetible. Tener a un superclase como Golec, o Klos, que no sabías si iba a rematar o a colocar, considerado uno de los cinco mejores colocadores del mundo, la conexión brutal de Camarero con una grada que hacía volar a los jugadores, ese CID lleno ante el PSG con casi 2.000 personas sin poder entrar, destronar al Palma, que parecía un imposible, regresar tras la desaparición con otro proyecto ganador y que vuelve a ilusionar a todos... Es una secuencia increíble de éxitos y superaciones".</p>

      <p>"Pienso que siempre se han valorado los éxitos del Guaguas. En seguimiento mediático, en sensibilidad de las instituciones, en reconocimiento. Y eso ha sido para bien del deporte y del voleibol en Canarias. En este sentido, ha trascendido el ámbito deportivo porque llegó a ser un fenómeno social. Así lo comprobé desde el ámbito informativo y la demanda de noticias que se daba en determinados momentos", apunta.</p>

      <p>Se congratula de que Juan Ruiz, "acompañado de otros históricos de talla inigualable como Sánchez Jover, Nuez o Camarero", haya podido rescatar un proyecto que parecía ya enterrado: "Fundé un club como el Cantur y terminó desapareciendo pese a los éxitos que logró. En el Vecindario sé que Sánchez Jover se dejó un dineral de su bolsillo y acabó quemado. De ahí que la jugada de coger esta plaza, con derecho a jugar en Europa como premio añadido, haya sido otro acierto más de Juan, capaz de reinventarse de nuevo en favor de un club que es patrimonio de nuestra tierra por trayectoria, historia e importancia".</p>
    </>
  ),

  "cap02-jose-millan": (
    <>

      <DropCap>Si la figura de Silvestre Cabrera fue de trascendencia capital para auspiciar el voleibol durante su mandato como presidente de la Federación de Las Palmas (1973-1985), no es menos relevante la influencia, también de enorme impacto, de José Millán, quien en diciembre de 1976 asumió el cargo de secretario del ente presidido por Cabrera, tomó su relevo a la conclusión de su ciclo como máximo mandatario y terminó encabezando la Federación Canaria de Voleibol hasta 2008. Más de tres décadas de contribución y entrega que le hicieron tener una atalaya privilegiada de los acontecimientos, al tiempo de otorgarle un lugar preferencial en la historia de esta disciplina.</DropCap>

      <p>Millán (Sevilla, 1933-Las Palmas de Gran Canaria, 2023) fue otro de los testigos que vivió, desde los inicios hasta su desarrollo, pasando por la eclosión de los títulos, la vida del Calvo Sotelo, una entidad a la que reconoció tener "mucho cariño y respeto" por la contribución que hizo en la historia del deporte en Canarias.</p>

      <p>"Siempre presté mi ayuda a todos los clubes y equipos y el Calvo Sotelo no fue una excepción. Su labor con los chicos, con la cantera, fue muy valiosa y tuvo el acierto, además, de complementar el bloque con algunos veteranos. Se veía que era un proyecto que podía llegar alto por la dedicación y el empeño que le ponían, con Felipe Nuez al frente, y con el paso de los años no ocurrió otra cosa que confirmarse lo que todos esperábamos", resaltó.</p>

      <p>El dirigente reafirmó que la consecución de títulos por parte del ya denominado Guaguas Las Palmas "supuso un gran espaldarazo" para el voleibol canario, por lo que cabía distinguir al club "por ser el primero y el que contribuyó a que la afición se volcara". Ahí estaban las imágenes de las canchas llenas, primero el San Román, luego el Centro Insular, y la repercusión mediática que conllevó. Y no pasó por alto el impulso que llegó con Juan Ruiz, a mitad de la década de los ochenta: "Juan disparó al Guaguas, lo llevó a lo más alto cuando parecía que lo que él quería era imposible. Hizo un equipo del que todos disfrutamos. Tenemos que ser justos con él y darle el mérito que le corresponde. Hubo un antes y un después en la historia del voleibol y del deporte en nuestras islas. Juan Ruiz fue quien marcó el cambio de una etapa a otra".</p>

      <p>"Hay que valorar lo que hicieron, saliendo de un colegio y con muy pocos medios. Fueron superándose, nunca se rindieron ante las dificultades. Como dirigente que era en esos años, contemplé con mucha satisfacción su labor formativa, su salto al profesionalismo, los fichajes de grandes jugadores... Fue una evolución preciosa y que, pienso, hizo muy feliz a los aficionados. Irrepetible, diría yo", añadió.</p>

      <p>Millán tampoco obvió el valor añadido que dio codearse con los mejores de Europa, otro de los hitos del Guaguas: "Colocaron en el mapa nuestro voleibol, nuestra tierra. Fueron embajadores de España. Faltó suerte para lograr un título continental, pero su contribución fue impresionante y digna de aplauso en todos los sentidos".</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 02: Los Estatutos Fundacionales
  // ═══════════════════════════════════════════════
  "capitulo-02": (
    <>
      <SectionHeader highlighted>Aprobado en la Junta del día 6 de noviembre de 1976 a las 20.00 horas</SectionHeader>

      <SectionHeader>Capítulo I — Constitución, fines y domicilio</SectionHeader>
      <ArticleBlock number="1º">El nombre que adoptará la nueva entidad será el de Club Voleibol Calvo Sotelo.</ArticleBlock>
      <ArticleBlock number="2º">El objeto de la presente entidad es el fomento y práctica del deporte entre los asociados y, en especial, el Voleibol.</ArticleBlock>
      <ArticleBlock number="3º">Podrá asimismo la presente entidad ampliar sus funciones deportivas con otras secciones secundarias, recreativas o de otros deportes, siempre que lo acuerden la junta directiva y a cuyo fin crearan aquellas secciones que, previa aprobación en Asamblea General, se estimen necesarias y que sus medios lo permitan.</ArticleBlock>
      <ArticleBlock number="4º">La entidad, que con todos sus socios y componentes quedan sujetos a la jurisdicción de la Delegación Nacional de Deportes, Comité Olímpico Español, Federación Española de Voleibol, a través de la cual queda incorporada al completo de la instituciones del Estado Español obligándose a acatar todo lo dispuesto en los estatutos, reglamentos, disposiciones y acuerdos de la expresada federación.</ArticleBlock>
      <ArticleBlock number="5º">Se fija el domicilio de la entidad en Las Palmas, calle Montejurra, número 1.</ArticleBlock>
      <ArticleBlock number="6º">La duración de la entidad es por tiempo indefinido.</ArticleBlock>

      <SectionHeader>Capítulo II — De los socios</SectionHeader>
      <ArticleBlock number="7º">
        La entidad Club Voleibol Calvo Sotelo se compondrá de las siguientes clases de socios: de HONOR y ACTIVOS.
        {"\n"}Serán de HONOR aquellos asociados que, a juicio de la directiva, previa aprobación de la asamblea general extraordinaria de socios, merezcan tal distinción por su labor en pro de la entidad o del deporte en general, los cuales estarán exentos del pago de la cuota.
        {"\n"}Tendrán los mismos derechos que los socios activos si proceden de la categoría de activos.
        {"\n\n"}<strong>HONORÍFICOS-.</strong>
        {"\n"}Los asociados que a criterio de la junta directiva merezcan tal distinción por su actuación en pro de la entidad, los cuales estarán exentos del pago de la cuota.
        {"\n\n"}<strong>ACTIVOS-.</strong>
        {"\n"}Los que satisfagan la cuota de entrada y mensual fijada por la junta directiva y aprobada en asamblea.
        {"\n\n"}Asimismo, tendrán plenitud de derechos en el uso del material de la entidad. Estos disfrutarán del derecho de voz y voto, de acuerdo con el artículo 41 y en la forma y con las limitaciones fijadas por la Federación Española.
      </ArticleBlock>
      <ArticleBlock number="8º">Todos los socios, sea cual fuese su categoría, tendrán el libre acceso a los locales y campos de la entidad.</ArticleBlock>
      <ArticleBlock number="9º">Todo socio viene obligado a comunicar por escrito a la directiva las deficiencias que observe en las instalaciones, con la colaboración del personal empleado, fiestas o concursos que en el mismo se organicen para lograr la mayor perfección en todas sus actividades.</ArticleBlock>
      <ArticleBlock number="10º">De acuerdo con las asambleas, la junta directiva impondrá una cuota de entrada a los socios, según las necesidades de la entidad.</ArticleBlock>
      <ArticleBlock number="11º">Podrá nombrarse presidente de la entidad a quien por su relevante personalidad y especiales condiciones sea propuesto y elegido en la forma y con los requisitos establecidos en los artículos 35 y siguientes, aunque no fuese socio con anterioridad a la presentación de su candidatura.</ArticleBlock>
      <ArticleBlock number="12º">Para formalizar el ingreso en la entidad, los interesados deberán firmar una propuesta avalada por dos socios, la cual estará expuesta en la tablilla de la entidad durante ocho días, a fin de que los socios puedan efectuar las reclamaciones que consideren pertinentes sobre la admisión de los mismos.</ArticleBlock>
      <ArticleBlock number="13º">La entidad llevará una lista por orden de ingreso de todos los socios, sin distinción de clase, y cada socio recibirá el número correlativo que le corresponda por la fecha de ingreso.</ArticleBlock>
      <ArticleBlock number="14º">Las bajas como socios serán definitivas o temporales.</ArticleBlock>
      <ArticleBlock number="15º">
        Perderá la calidad de socio, sea cual fuese su categoría, por una de las siguientes causas:
        {"\n"}a) Por voluntad del socio, expresada en escrito dirigido a la junta directiva.
        {"\n"}b) Por dejar sin pagar tres cuota mensuales consecutivas.
        {"\n"}c) Por incumplimiento de las obligaciones que le imponen los presentes estatutos o por perjuicio moral o material ocasionado a la entidad.
        {"\n"}d) Por haber transcurrido los dos años de haber solicitado una baja temporal.
        {"\n"}e) Por defunción.
      </ArticleBlock>
      <ArticleBlock number="16º">Todo socio que sea baja en la entidad voluntaria o por expulsión perderá todos los derechos adquiridos.</ArticleBlock>
      <ArticleBlock number="17º">Todo socio deberá identificar su personalidad presentando a la entrada de la entidad, o por petición de persona autorizada por la junta directiva, su carnet de identidad de socio junto con el recibo del mes corriente.</ArticleBlock>
      <ArticleBlock number="18º">
        Serán deberes de los socios:
        {"\n"}a) La leal observancia de lo establecido en los presentes estatutos y reglamentos interiores de la entidad.
        {"\n"}b) Obedecer las disposiciones emanadas de la junta directiva.
        {"\n"}c) Aportar su concurso a todas las manifestaciones deportivas-económico-sociales que le sean encomendadas.
        {"\n"}d) Satisfacer, a través de la entidad, a la Federación Española del sello federativo.
      </ArticleBlock>
      <ArticleBlock number="19º">
        Serán derechos de los socios activos:
        {"\n"}a) Formar parte de la junta directiva cuando reúnan los requisitos señalados en el artículo 11 y por la Federación Española.
        {"\n"}b) Intervenir con voz y voto en las asambleas, según los artículos y las disposiciones de la Federación Española.
        {"\n"}c) Examinar las liquidaciones y balances de la entidad.
      </ArticleBlock>

      <SectionHeader>Capítulo III — Del Gobierno de la Sociedad</SectionHeader>
      <p className="text-sm text-muted-foreground italic mb-4">(Sección 1ª: Junta Directiva)</p>
      <ArticleBlock number="20º">La entidad estará dirigida, regida y administrada de conformidad con los presentes estatutos por la junta directiva.</ArticleBlock>
      <ArticleBlock number="21º">La junta directiva se compondrá: presidente, uno o dos vicepresidentes, secretario, tesorero contador y el número de vocales que se estime conveniente.</ArticleBlock>
      <ArticleBlock number="22º">Los nombramientos y duración de los cargos de presidente y miembros de la junta directiva de la entidad se harán de conformidad con las disposiciones vigentes sobre el particular emanadas de la Delegación Nacional de Educación Física y Deportes.</ArticleBlock>
      <ArticleBlock number="23º">El presidente convocará junta directiva todas las veces que estime necesario y, al menos, una vez cada mes.</ArticleBlock>
      <ArticleBlock number="24º">Los acuerdos de la junta directiva se tomarán por mayoría de votación, teniendo cada componente un voto y, en caso de empate, decidirá el voto del presidente.</ArticleBlock>
      <ArticleBlock number="25º">El presidente tendrá la representación legal y jurídica de la entidad, dirigirá los debates y discusiones y velará para que se cumplan los acuerdos de las juntas directivas y asambleas generales ordinarias y extraordinarias de socios, autorizará con su firma los pagos y operaciones que efectúe la entidad, unida dicha firma con la del contador, para asuntos económicos y con la del secretario para documentos y contratos.</ArticleBlock>
      <ArticleBlock number="26º">El secretario llevará el libro de actas, un registro de socios con orden correlativo, cuidará de la correspondencia de la entidad, extenderá los oportunos certificados con referencias a los acuerdos tomados, autorizará con su firma, junto con la del presidente, los contratos que se celebren en nombre de la entidad, formalizará la memoria anual de las actividades de la entidad, actuará como tal en las juntas directivas y asambleas y cuidará de tener toda la documentación en las asambleas preparadas según las secciones segunda, tercera y cuarta. Todos los escritos llevarán el visto bueno del presidente.</ArticleBlock>
      <ArticleBlock number="27º">El tesorero cuidará de la parte económica de la entidad llevando, al efecto, un libro de caja donde anotará todos los ingresos y gastos que hubiere. No efectuará ningún pago sin el visto bueno del presidente.</ArticleBlock>
      <ArticleBlock number="28º">El contador velará por el fiel cumplimiento de la distribución de fondos de la entidad, así como el pago de la cuotas por los asociados y, también, comprobará los estados de cuentas y beneficios o pérdidas por fiestas, homenajes, etc. Presentará, bimensualmente, a la aprobación de la junta directiva el estado de cuentas de la entidad. De acuerdo con el tesorero, presentará y formalizará para la junta general ordinaria un balance inventario de la situación económica de la entidad durante el año para su aprobación, el cual deberá exhibir durante quince días con anterioridad a dicha reunión en la tablilla de la entidad, a los fines de poderlo comprobar todos los asociados. Sustituirá al tesorero en caso de ausencia o enfermedad.</ArticleBlock>
      <ArticleBlock number="29º">El vicepresidente hará las veces de presidente en ausencia o enfermedad del mismo.</ArticleBlock>
      <ArticleBlock number="30º">Los vocales ayudarán a los demás miembros de la junta directiva en sus funciones, sustituyendo a estos en caso de enfermedad o ausencia y serán los que presidan las distintas ponencias deportivas o sociales que crea conveniente formar la junta directiva, cuidando de exponer a aprobación de la junta los acuerdos tomados en principio, por tales ponencias.</ArticleBlock>

      <p className="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 2ª: La Asamblea General de socios)</p>
      <ArticleBlock number="31º">Las asambleas serán ordinarias o extraordinarias y se convocarán y celebrarán según lo prescrito y dispuesto por la Delegación Nacional de Educación Física y Deportes, en sus disposiciones vigentes sobre la materia.</ArticleBlock>
      <ArticleBlock number="32º">Necesariamente deberá ser celebrada asamblea general extraordinaria para la modificación de los estatutos y para tener validez ha de ser aprobado por la Federación Española. Las asambleas generales ordinarias y extraordinarias estarán integradas por aquellos socios que, con arreglo a la sección 3ª que sigue, tengan derecho a voto.</ArticleBlock>

      <p className="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 3ª: Socios con derecho a voto)</p>
      <ArticleBlock number="33º">Tendrán derecho de asistencia a las asambleas generales ordinarias y extraordinarias todos los socios de la entidad.</ArticleBlock>
      <ArticleBlock number="34º">Cada año, en primero de enero, quedarán expuestas en el cuadro de anuncios de la entidad las listas de socios, por riguroso orden de fecha de ingreso.</ArticleBlock>

      <p className="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 4ª: Procedimientos para elegir la Junta Directiva)</p>
      <ArticleBlock number="35º">Cuando deba procederse a la elección de presidente con la totalidad de la directiva, se efectuará previamente la proclamación de candidato.</ArticleBlock>
      <ArticleBlock number="36º">Los candidatos a la junta directiva serán todos aquellos socios que reúnan las condiciones del artículo 11 y sean presentados con la firma del 10% de los asociados que tengan derecho a voto.</ArticleBlock>
      <ArticleBlock number="37º">El plazo para la presentación de las propuestas de candidatos finalizará a los cinco días a partir de la convocatoria de la asamblea en que haya de producirse la elección.</ArticleBlock>
      <ArticleBlock number="38º">Finalizado dicho plazo de cinco días, la entidad elevará a la Federación Española, a través de la Regional, las propuestas de candidatura, las cuales, una vez aceptadas, se expondrán en el local social durante cinco días anteriores a la celebración de la asamblea.</ArticleBlock>
      <ArticleBlock number="39º">En la asamblea solo podrán votarse candidaturas completas, considerándose nula cualquier enmienda o sustitución que se hiciera.</ArticleBlock>
      <ArticleBlock number="40º">Ningún socio podrá firmar a la vez dos o más propuestas de candidatura y, aunque si tal ocurre no se invalidará esta, el socio que incurra en duplicidad de firma será inhabilitado para tomar parte en las asambleas generales que se celebren en lo sucesivo.</ArticleBlock>
      <ArticleBlock number="41º">Todas las propuestas de candidatos a la presidencia deberán citarse acompañadas de la aceptación de los interesados y con la lista de candidatos que estos propongan para los demás cargos que deban proveerse.</ArticleBlock>
      <ArticleBlock number="42º">La asamblea por mayoría de votos sobre la elección del presidente y miembros de la directiva y de conformidad con las disposiciones vigentes de la D. N. de Educación Física y Deportes.</ArticleBlock>
      <ArticleBlock number="43º">Si se produjera la dimisión o cese total de presidente o directiva, esta no podrá abandonar sus funciones bajo pena de inhabilitación de sus miembros mientras no se haya procedido a la elección de otra nueva y, a este fin, convocará inmediatamente la asamblea general extraordinaria.</ArticleBlock>

      <SectionHeader>Capítulo IV — De la administración de la Entidad</SectionHeader>
      <ArticleBlock number="44º">De conformidad con los artículos 27 y 28 de los presentes estatutos, llevarán la administración y contabilidad de la entidad el tesorero y contador con las facultades en dichos artículos expresadas y sujetas a los artículos 24 y 25.</ArticleBlock>
      <ArticleBlock number="45º">La entidad dará cuenta a sus socios, una vez al año por lo menos, en una memoria presentada a la asamblea general ordinaria, de su gestión deportiva y económica y de sus proyectos para el futuro.</ArticleBlock>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 1: Así se forjó una leyenda
  // ═══════════════════════════════════════════════
  "capitulo-03": (
    <>
      <SectionHeader>Llegar a la élite para quedarse</SectionHeader>

      <DropCap>La temporada 1985-86 fue la del estreno del Calvo Sotelo en la División de Honor y se afrontó bajo las mismas líneas maestras que habían marcado su trayecto, desde las consideraciones de Felipe Nuez, aunque con la importante novedad del fichaje del yugoslavo Ivo Martinovic, primer extranjero en la historia del club que, con 30 años y amplio bagaje profesional e internacional, venía a darle a la plantilla la cuota de veteranía que se requería para competir a escala máxima.</DropCap>

      <p>
        Martinovic, elegido capitán en su primera campaña, y un Camarero que ya demostraba que iba para jugador de época, fueron los sostenes de un grupo que rindió por encima de lo esperado. Para el recuerdo queda aquel 2 de noviembre de 1985, fecha del debut del Calvo Sotelo en la División de Honor con triunfo en Cáceres ante el Licenciados Reunidos por 0-3.
      </p>

      <p>
        El 21 de octubre de 1986 se celebra la asamblea general extraordinaria del club. Ahí arranca la etapa de Juan Ruiz en el alto mando y que se prolongaría, de manera ininterrumpida, hasta 1998. Y la noticia más esperada desde hacía meses se anunció el 5 de noviembre: Juan Ruiz confirma que Guaguas Municipales patrocinará a la entidad, que, desde entonces pasará a denominarse Guaguas Las Palmas.
      </p>
      <ContentImage 
        src={imgEquipoChampions} 
        alt="El CV Guaguas celebra una victoria en competición europea" 
        caption="El Guaguas inauguró su palmarés con la Copa del Rey de 1989 y forjó una hegemonía de cinco Ligas consecutivas." 
        fullWidth 
      />

      <SectionHeader>Fichajes de impacto y hegemonía</SectionHeader>

      <p>
        El verano de 1987, ya con dos años de experiencia en la élite, marca el escalón cualitativo que instala al Guaguas en la excelencia. El fichaje de Paco Sánchez Jover, figura indiscutible del voleibol nacional, fue una auténtica jugada maestra de Juan Ruiz al captar al jugador del momento. Por si fuera poco, con Sánchez Jover llegan su hermano Jesús, Venancio Costa, Antonio Miralles.
      </p>

      <p>
        Los resultados se disparan y son un aviso al resto de que Gran Canaria exhibe proyecto ganador. Los subcampeonatos de Liga y Copa del Rey suponen la antesala de los éxitos que ya eran inminentes. El aterrizaje de los mexicanos Sergio Hernández, para el banquillo, y Chava González, así como la apuesta por el canadiense Brad Willock terminan por ensamblar un Guaguas que inaugura su palmarés con la Copa del Rey conquistada el 9 de abril de 1989 ante el Palma en el Centro Insular.
      </p>

      <p>
        Esa Copa, que abría las vitrinas del Guaguas, no hizo más que multiplicar las ambiciones de Juan Ruiz, quien une a su elenco de estrellas, en el verano de 1989, a los internacionales polacos Ireneusz Klos y Waclaw Golec. Esa primera Liga sería una realidad el 1 de mayo de 1990 con la inolvidable final ante el Bomberos de Barcelona.
      </p>

      <p>
        A esa primera Liga le sucederían otras cuatro consecutivas hasta 1994, estableciendo una hegemonía nacional inédita. Además, estuvo aderezada con tres dobletes por las Copas del Rey también conquistadas en los años 1991, 1992 y 1993. Son campañas en la Copa de Europa, llenos a reventar en el Centro Insular, máximo esplendor dentro y fuera de España.
      </p>

      <p>
        Fueron doce los títulos que se atraparon desde 1989 a 1997, etapa de concentración luminosa, y que granjeó la leyenda de un Guaguas que, por momentos, llevó la bandera del deporte en Gran Canaria.
      </p>
      <ContentImage 
        src={imgVictoriaGuaguas} 
        alt="El CV Guaguas celebra un título de Liga" 
        caption="Los años dorados del Guaguas: cinco Ligas consecutivas, Copas del Rey y presencia en Europa." 
      />

      <SectionHeader>La salida de Juan Ruiz, principio del fin</SectionHeader>

      <p>
        Tras doce años en la presidencia, Juan Ruiz quiso respetar lo reflejado en los estatutos y ceñirse a lo establecido con la máxima durabilidad de su cargo. A la conclusión de la temporada 1997-98, saldada con la Supercopa de España, dio el relevo en la cúpula a Mario Hugendubel.
      </p>

      <p>
        Fue algo más que un traspaso de poderes para alguien que dedicó su vida al servicio de un club que heredó en ruinas y legó en una posición de privilegio. Títulos (doce en total), cantera, superávit, crédito en entidades privadas y credibilidad a ojos de los organismos públicos. Un Guaguas respetado en España y en Europa.
      </p>

      <EditorialQuote>
        "Todo cambió y para peor. Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos."
      </EditorialQuote>
    </>
  ),

  // ═══════════════════════════════════════════════
  // Subcapítulos del Cap. 03: Así se forjó una leyenda
  // ═══════════════════════════════════════════════
  "cap04-elite": (
    <>
      <DropCap>La temporada 1985-86 fue la del estreno del Calvo Sotelo en la División de Honor y se afrontó bajo las mismas líneas maestras que habían marcado su trayecto, desde las consideraciones de Felipe Nuez, aunque con la importante novedad del fichaje del yugoslavo Ivo Martinovic, primer extranjero en la historia del club que, con 30 años y amplio bagaje profesional e internacional, venía a darle a la plantilla la cuota de veteranía que se requería para competir a escala máxima. Jorge Ramón, Juanma Martín, Alfredo Padrón, Miguel Mendaño, Óscar Campos, Francisco Reyes, Sergio Miguel Camarero, Martín Medina, el mencionado Ivo Martinovic, Enrique González Silva y José Ramón, más los juveniles Javier Ulacia, Alejandro Menéndez, Roberto Padrón y Alejandro Gil eran los componentes de aquel histórico equipo que se adentró entre los grandes y lo hizo con relativo éxito. Pese a los condicionantes económicos derivados de no tener un patrocinador (tras dos años con las denominaciones Reales y Lucky, relacionadas con el tabaco, Tabacanarias no renovó su compromiso), lo que supuso un hándicap sustancial, se logró eludir con solvencia el riesgo de descenso y hasta quedar encuadrado en la entonces denominada Serie A1, en la que competían los primeros clasificados de cada grupo. Martinovic, elegido capitán en su primera campaña, y un Camarero que ya demostraba que iba para jugador de época, fueron los sostenes de un grupo que rindió por encima de lo esperado. Para el recuerdo queda aquel 2 de noviembre de 1985, fecha del debut del Calvo Sotelo en la División de Honor con triunfo en Cáceres ante el Licenciados Reunidos por 0-3. Jorge Ramón, Juanma Martín, Campos, Camarero, Martinovic y González fueron los jugadores alineados en el inicio de un trayecto que iba a conducir a la gloria.</DropCap>

      <p>El 21 de octubre de 1986 se celebra en el salón de la Boutique del Jamón, sita en Mesa y López, la asamblea general extraordinaria del club motivada por la salida del anterior presidente, José María Rodríguez, y la transición que comanda como coordinador Gustavo Rodríguez. Se anuncia en los medios de comunicación la posibilidad de que entre una plancha que "pueda llevar al Calvo Sotelo por buen camino y consolidarlo como un club grande dentro del voleibol español". Ahí arranca la etapa de Juan Ruiz en el alto mando y que se prolongaría, de manera ininterrumpida, hasta 1998. El déficit heredado es de "aproximadamente seis millones de pesetas". En realidad la mala situación financiera que atravesaba el Calvo Sotelo ya era de sobra conocida y publicitada. Y el papel de los medios de comunicación pidiendo una alternativa para evitar la desaparición fue lo que atrajo el interés de Juan Ruiz, hasta entonces un neófito en el voleibol y que, alertado por las informaciones que le llegaban a través de su periodista de cabecera, el que escuchaba a diario a través de las ondas de Antena 3: Paco García Caridad.</p>

      <EditorialQuote author="Paco García Caridad">
        "Fue un ejercicio de responsabilidad con la sociedad canaria lanzar desde las ondas un mensaje de auxilio en favor del Calvo Sotelo. No podíamos dejar que un proyecto de cantera tan serio y valioso se viniera abajo. Más que un club, el Calvo Sotelo era un modelo educativo, un espejo en el que mirarse por sus orígenes y crecimiento. Actué conmovido por una situación límite. Defender al Calvo Sotelo y su supervivencia era un acto de justicia social, un alegato por el patrimonio deportivo del momento. Saber que Juan Ruiz dio el paso al frente tras hablar conmigo y tener referencia de mis informaciones me lo tomo como el resultado de mi labor profesional."
      </EditorialQuote>

      <p>Siguen los movimientos en ese periodo, ya con el equipo iniciando su segundo año en la División de Honor: el 23 de octubre de 1986, Gustavo Rodríguez, coordinador de la junta gestora, informa de que "hay una nefasta gestión de la directiva anterior". Ismael Chinea, Fidel Morales, Felipe Nuez, Juan M. Martín e Ivo Martinovic son los miembros del equipo de trabajo designado para pilotar el cambio necesario en la gestión y el gobierno de la institución. Aunque no se menciona expresamente, Juan Ruiz ya está integrado en el mismo, como bien se certificaría días después anunciando, de su mano, la llegada del ansiado patrocinador. Se detalla, además, un presupuesto para la temporada 1986-87 de 13.500.000 de pesetas y que, a la espera de un anunciante, el equipo se denomine Club Voleibol Las Palmas, propuesta que había correspondido, originalmente a Juan José Apolinario, anterior gerente del Calvo Sotelo. Una semana después, Juan Ruiz Ramos es oficializado como presidente de la junta gestora en sustitución de Gustavo Rodríguez.</p>

      <p>Y la noticia más esperada desde hacía meses, la de la aparición de un patrocinador que otorgara la estabilidad perdida y permitiera cuadrar números, se anunció el 5 de noviembre de ese mismo 1986. Juan Ruiz, que ya ejerce como miembro visible de la junta gestora del Club Voleibol Las Palmas, confirma que, "después de varias conversaciones con Juan Rodríguez Doreste", alcalde de Las Palmas de Gran Canaria, Guaguas Municipales patrocinará a la entidad, que, desde entonces pasará a denominarse Guaguas Las Palmas. Su primer partido con este nombre lo disputó el 15 de noviembre ante el Cisneros y en Tenerife. La consecución de este patrocinador, con el que el club ganaría títulos y adquiriría fama internacional, es el primer golpe de efecto de Ruiz en la historia de su mandato. Él mismo aparecería firmando el histórico contrato de vinculación con la compañía de transporte público.</p>

      <p>En el plano deportivo, el equipo, con las grandes novedades del regreso de Pericles y Batista, mantiene su buen tono. El 19 de enero de 1987 queda tercero en la Copa del Rey celebrada en Sa Pobla, Mallorca, tras imponerse por 3-1 al Cisneros de Tenerife, consiguiendo, de esta manera, su clasificación para la Copa Confederación. Jorge Ramón, Ivo Martinovic, Sergio Camarero, Juanma Martín, Óscar Campos y Eduardo Macías integraron un equipo inicial al que luego se sumó Alejandro Gil. El quinto puesto logrado, posteriormente, en la Liga redondeó una campaña de sobresaliente considerando la naturaleza advenediza del Guaguas.</p>
    </>
  ),

  "cap04-fichajes": (
    <>
      <DropCap>El verano de 1987, ya con dos años de experiencia en la élite, marca el escalón cualitativo que instala al Guaguas en la excelencia. El fichaje de Paco Sánchez Jover, figura indiscutible del voleibol nacional, fue una auténtica jugada maestra de Juan Ruiz al captar al jugador del momento. Por si fuera poco, con Sánchez Jover llegan su hermano Jesús, Venancio Costa, Antonio Miralles. Todos darían excelentes réditos al escudo. Y Paco vino para no irse jamás y liderar los años dorados que ya estaban incubándose. Los resultados se disparan y son un aviso al resto de que Gran Canaria exhibe proyecto ganador. Además del bautizo europeo frente al Knack de Bélgica, en una eliminatoria saldada con derrota pero cuya importancia trascendió al resultado por su valor simbólico, los subcampeonatos de Liga y Copa del Rey suponen la antesala de los éxitos que ya eran inminentes. El relevo en el banquillo de Felipe Nuez en 1988, el técnico de toda la vida y que tras más de quince años ininterrumpidos en su cargo se despedía de la entidad que vio nacer, fue la nota discordante en la crecida colectiva que cogió una velocidad imparable en esta campaña.</DropCap>

      <p>El aterrizaje de los mexicanos Sergio Hernández, para el banquillo, y Chava González, así como la apuesta por el canadiense Brad Willock terminan por ensamblar un Guaguas ya de valores consolidados de los años anteriores y que, como fruta madura, inaugura su palmarés con la Copa del Rey conquistada el 9 de abril de 1989 ante el Palma en el Centro Insular. El recinto capitalino ya era la nueva casa del club después de haber estado desde siempre, tras su ingreso en las competiciones estatales, como anfitrión en el García San Román.</p>

      <p>La mudanza a la nueva instalación generó ciertas controversias, pues había dudas de que se ajustara a las necesidades de un club todavía con una afición fiel pero minoritaria. Los éxitos trajeron las muchedumbres desde que un 22 de octubre de 1988 se disputara el primer partido del Guaguas en el CID con motivo de su inauguración. Fue en el Torneo Internacional Isla de Gran Canaria, integrando cartel con el Seven Up Santa Catalina, Cisneros de Tenerife y Slavia de Sofía. El Guaguas ganó 3-0 al Seven Up. Sergio Hernández, entrenador del equipo entonces, alineó a Venancio Costa, Juanma Martín, Chava, Jorge Ramón, Sánchez Jover y Camarero en el sexteto inicial y, además, utilizó a Óscar Campos, Antonio, Felipe, David y Jesús. El Seven Up estaba dirigido por Felipe Nuez.</p>

      <p>Esa Copa, que abría las vitrinas del Guaguas, no hizo más que multiplicar las ambiciones de Juan Ruiz, quien une a su elenco de estrellas, en el verano de 1989, a los internacionales polacos Ireneusz Klos y Waclaw Golec, llamados a ser ídolos y figuras diferenciales. Esa primera Liga que se resistía sería una realidad el 1 de mayo de 1990 con la inolvidable final ante el Bomberos de Barcelona, bajo la denominación comercial de Constructora Atlántica Canaria, y con Sánchez Jover ejerciendo de jugador-entrenador y luego de ocupar la vacante en el banquillo que dejó a mitad del calendario el americano Robert Croteau.</p>

      <p>A esa primera Liga le sucederían otras cuatro consecutivas hasta 1994, estableciendo una hegemonía nacional inédita en los representativos canarios y que, además, estuvo aderezada con tres dobletes por las Copas del Rey también conquistadas en los años 1991, 1992 y 1993. Son campañas en la Copa de Europa, con cruces ante los mejores del continente, llenos a reventar en el Centro Insular, máximo esplendor dentro y fuera de España y un desfile de nombres que se hicieron un sitio en el corazón de todos los aficionados. A los ya conocidos de Camarero, Juanma Martín, Jorge Ramón, Sánchez Jover, Miralles, Costa, Klos o Golec, se unieron los Sharma, Falasca o Wiernes.</p>

      <p>Particular mención merecen Sánchez Jover y Juanma Martín, consagrados al simultanear sus labores de jugador con las de técnicos y de igual fertilidad para los éxitos de la entidad, poniendo, también, el foco en el cuidado de la cantera. Ya entonces, en ese inicio de la década de los noventa, se reclutan por los colegios (y hasta por la calle, a golpe de intuición) a jóvenes de la tierra para que garanticen el relevo generacional y revaliden el espíritu primigenio del Calvo Sotelo, creado en torno al jugador isleño. Antonio Sánchez es uno de los canteranos criados en esta fase y que tendría larga continuidad en los Alexis Valido, Juan Carlos Vega, los hermanos Cabrera, Raúl Dávila o Níchel Gómez, entre otros.</p>

      <p>Fueron doce los títulos que se atraparon desde 1989 a 1997, etapa de concentración luminosa, y que granjeó la leyenda de un Guaguas que, por momentos, llevó la bandera del deporte en Gran Canaria, al coincidir sus hitos con momentos menos pujantes de UD Las Palmas o CB Gran Canaria, los símbolos más tradicionales de las disciplinas por equipos de la isla. Iniciativas pioneras como lucir publicidad en contra de las drogas, abrir las puertas del pabellón a todos los que quisieran entrar sin pagar precio alguno, como sucedió ante el PSG, o democratizar la práctica del voleibol creando alianzas y convenios con clubes de la geografía local impulsaron, más si cabe, la fama y prestigio de un club también profesionalizado y gestionado por un modelo administrativo riguroso y que en los años de presidencia de Juan Ruiz siempre arrojó balances favorables, con niveles de endeudamiento asumible y un apoyo unánime del sector empresarial. Los llenos habituales en el Centro Insular, a la par que las más que frecuentes retransmisiones en directo por la televisión, convirtieron las vallas publicitarias en soportes codiciados y que redundaron, para bien, en los dineros del Guaguas. Eso permitió mantener una base de primera categoría cada temporada y unir, cuando procedía, a refuerzos de contrastada calidad.</p>

      <p>La creación de una cultura ganadora, que convertía en noticia y crisis cada título que se escapaba, habla a las claras del listón en el que se movió el club, siempre orientado a construir plantillas que aspiraran a todo y sin eludir la presión que aparejaba tener el balance de galardones que se exhibía.</p>
    </>
  ),

  "cap04-salida-ruiz": (
    <>
      <DropCap>Tras doce años en la presidencia y algún amago de abandono prematuro, tal y como reconoció a cuenta de críticas que consideraba desproporcionadas, Juan Ruiz quiso respetar lo reflejado en los estatutos y ceñirse a lo establecido con la máxima durabilidad de su cargo. A la conclusión de la temporada 1997-98, saldada con la Supercopa de España, dio el relevo en la cúpula a Mario Hugendubel. Fue algo más que un traspaso de poderes para alguien que dedicó su vida al servicio de un club que heredó en ruinas y legó en una posición de privilegio. Títulos (doce en total), cantera (ya con internacionales absolutos salidos de las categorías inferiores), superávit, crédito en entidades privadas y credibilidad a ojos de los organismos públicos. Un Guaguas respetado en España y en Europa (con participaciones en competiciones continentales de manera ininterrumpida desde 1987) y con las bases para continuar su expansión, dada la estructura existente y el nivel de profesionalización instaurado. Fueron muchas las voces que trataron de disuadir a Juan Ruiz del paso que iba a dar, quizás intuyendo que sin él nada sería igual, como así ocurriría.</DropCap>

      <p>De repente, ya con el presidente histórico fuera, el sentimiento de orfandad fue inmediato, por muchos esfuerzos que pusiera Hugendubel, quien trató de ilusionar desde sus primeras manifestaciones. "Todo cambió y para peor", admite Sánchez Jover, que permanecería en el club hasta el verano de 1999. Su presencia se consideraba de especial valor estratégico para la pervivencia del proyecto, tanto en la rama sénior como en las categorías de base. Y, tras dos años como testigo de "la deriva", según sus palabras, que fue cogiendo el club bajo otros parámetros directivos. El cambio de siglo deparaba la marcha del último gran símbolo del Calvo Sotelo. Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos y que le ligaron por siempre a esta tierra.</p>
    </>
  ),

  "cap04-cronologia": (
    <Timeline title="La cronología">
      <TimelineEvent year="1985">El 2 de noviembre, y ante el Licenciados Reunidos en Cáceres, el Calvo Sotelo disputa su primer encuentro en la División de Honor con victoria (0-3).</TimelineEvent>
      <TimelineEvent year="1986">El 21 de octubre se celebra la asamblea general extraordinaria del club en la que Juan Ruiz tiene su primera toma de contacto formal con la junta gestora. Días después anunciaría el histórico acuerdo con Guaguas Municipales para que patrocinase y diera su nomenclatura al equipo, gestión exitosa que le terminaría catapultando a la presidencia.</TimelineEvent>
      <TimelineEvent year="1987">Tercera posición en la Copa del Rey (enero), fichajes de Paco Sánchez Jover, Venancio Costa y Antonio Miralles (julio) y estreno en competiciones europeas ante el Knack de Bélgica (noviembre).</TimelineEvent>
      <TimelineEvent year="1988">Subcampeonatos de Liga y Copa del Rey y salida del club del histórico preparador Felipe Nuez tras más de quince años.</TimelineEvent>
      <TimelineEvent year="1989">El 9 de abril se conquista el primer título, con la Copa del Rey ganada al Palma en el Centro Insular (3-0). En verano se producen los fichajes de los polacos Ireneusz Klos y Waclaw Golec.</TimelineEvent>
      <TimelineEvent year="1990">El 1 de mayo se gana la primera Liga, con Paco Sánchez Jover como jugador-entrenador, con un rotundo 3-0 al Bomberos de Barcelona en el Centro Insular.</TimelineEvent>
      <TimelineEvent year="1991">Año con un mes de abril mágico con el primer doblete: Liga el día 13 ante el Orisba Palma (3-0) y la Copa, el 28 frente al Construcciones Alcalá de Tenerife por idéntico tanteador.</TimelineEvent>
      <TimelineEvent year="1992">Se repite la gesta con los dos torneos nacionales: Liga el 4 de abril ante el Andorra (3-1) y Copa, el 25 del mismo mes y repitiendo rival por 3-0.</TimelineEvent>
      <TimelineEvent year="1993">La supremacía nacional del equipo se constata por tercera campaña consecutiva y alzando los dos trofeos lejos de Gran Canaria: Liga en Soria ante el Caja Duero (2-3) y Copa del Rey en Murcia sometiendo al Almería por 2-3.</TimelineEvent>
      <TimelineEvent year="1994">Continúa el reinado en la Liga con un triunfo en Soria ante el Grupo Duero por 1-3, acaecido el 27 de marzo, que vale el quinto campeonato consecutivo.</TimelineEvent>
      <TimelineEvent year="1995">El 8 de septiembre, en un amistoso ante el conjunto brasileño del Banca Suzano, se rindió homenaje en el Centro Insular a Paco Sánchez Jover tras su retirada como jugador.</TimelineEvent>
      <TimelineEvent year="1996">Nueva Copa del Rey: llega el 13 de abril, ante el Soria, en el Centro Insular (3-2), un partido emotivo, pues sería el último de leyendas como Klos, Golec o Camarero. También se logra la primera Supercopa de España, el 16 de septiembre, igualmente en el Centro Insular y repitiendo adversario (3-1).</TimelineEvent>
      <TimelineEvent year="1997">Con una remontada memorable, el 5 de abril en el Centro Insular, el Gran Canaria Arehucas se apunta otra Copa frente al Unicaja Almería (3-2).</TimelineEvent>
      <TimelineEvent year="1998">Tres hechos trascendentales marcan el año: el homenaje a Sergio Miguel Camarero (7 de enero, con un amistoso ante el Zonhoven belga), la participación en la Final Four de la Recopa en Cuneo (Italia), el mayor hito en Europa alcanzado por el equipo, y Juan Ruiz pone fin a su presidencia tras doce años de sobresaliente gestión deportiva y empresarial.</TimelineEvent>
      <TimelineEvent year="1999">En el verano de ese año, finalizada la campaña 1998-99, Paco Sánchez Jover, hasta ese momento entrenador, abandona el club.</TimelineEvent>
    </Timeline>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 04: El proyecto visionario de Juan Ruiz
  // ═══════════════════════════════════════════════
  "capitulo-04": (
    <>
      <DropCap>Nacido en La Aldea de San Nicolás en 1953, emigrante con su familia a Tenerife durante gran parte su adolescencia (1960-1969), en la que hizo sus pinitos en la lucha canaria o el fútbol ("con 16 años llegué a jugar en Tercera División en las filas del Adeje"), Juan Ruiz estaba llamado, sin saberlo, a escribir una historia sin parangón en el deporte canario y al frente del Calvo Sotelo.</DropCap>

      <p>
        No hay dirigente isleño con tal nómina de títulos en su poder, todos los conquistados por la entidad, y con el mérito añadido de haber armado un equipo campeón desde las cenizas. Tanto en 1987 como en 2020 acudió al rescate recogiendo una tesorería en ruinas y un porvenir tan comprometido que apuntaba a la desaparición.
      </p>

      <p>
        "El secreto es trabajo y pasión. Constancia y ambición. No rendirse jamás. Si para conseguir un patrocinador tengo que visitar veinte empresas, acabo entrando en cuarenta. Si para ser campeón me tengo que traer a una estrella, trato de que sean dos. Y si el club necesita de mí cinco horas al día, acabo dándole el doble. Así empecé, así seguí, así me fui y así regresé."
      </p>

      <p>
        El punto de partida arranca de manera "casi casual y del todo inesperada". Año 1986. Desde su estabilidad laboral como apoderado de la empresa Napesca, Juan Ruiz sigue a la distancia, "como un aficionado más", las evoluciones de los distintos clubes de Gran Canaria. "Fiel a mi costumbre de desayunar en la cafetería del periódico La Provincia en el polígono industrial de El Sebadal, allí coincidía cada mañana con informadores del medio. Hasta que un día Paco García Caridad me comentó que un histórico, el Calvo Sotelo, estaba a punto de desaparecer."
      </p>

      <EditorialQuote>
        "Por lo que fuera, me sentí en la obligación de hacer algo. Me movió una motivación de responsabilidad. Le pregunté abiertamente a Nuez por el mejor jugador de España. Me dijo que era Paco Sánchez Jover. Le contesté que entonces habría que traerlo. Y me miró como si hubiese dicho un disparate."
      </EditorialQuote>

      <SectionHeader>La génesis de su proyecto: patrocinios y fichas estelares</SectionHeader>

      <NewspaperQuote source="La Provincia, 17 de julio de 1987">
        "Estamos en una nube con muchos cimientos. Aquí hay un club con cantera, con una estructura deportiva muy sólida basada en excelentes técnicos, y hay también unas buenas razones económicas que se gestan con una administración del club que considero muy responsables. Felipe Nuez me facilitó a principios de temporada una lista de jugadores para hacer al equipo campeón de Liga. Hemos traído quizá a los mejores y esperamos al menos ocupar uno de los tres primeros puestos del campeonato."
      </NewspaperQuote>

      <SectionHeader>El primer título como estímulo</SectionHeader>

      <NewspaperQuote source="Diario de Las Palmas, 10 de abril de 1989">
        "Este es el triunfo del trabajo y del esfuerzo de muchos años, comenzado por otros, como José Luzardo, Antonio Trejo o Felipe Nuez, y rematado por nosotros y por nuestra afición. Es el triunfo de todos y un gran día para el voleibol canario."
      </NewspaperQuote>

      <SectionHeader>El sueño cumplido de jugar la Copa de Europa</SectionHeader>

      <NewspaperQuote source="Canarias7, 13 de septiembre de 1990">
        "No gana el que más presupuesto tiene sino el que más trabajo derroche. Es un gran reto, asimismo, representar a Canarias por vez primera en la Copa de Europa, un prestigio y orgullo que deseamos para el resto de los equipos de élite grancanarios."
      </NewspaperQuote>

      <SectionHeader>Éxito deportivo y compromiso social</SectionHeader>

      <NewspaperQuote source="La Provincia, 6 de julio de 1990">
        "Lo de la campaña pasada fue logrado con gran merecimiento. Después de cuatro años de gran trabajo, el título de Liga tenía que llegar. Fue una temporada inolvidable. El Constructora ha hecho historia para el deporte de Canarias. También entiendo que para nuestro equipo ha sido un triunfo ser la única entidad deportiva del país que ha abierto una brecha contra la droga, porque lucimos publicidad en su contra en nuestras camisetas."
      </NewspaperQuote>

      <SectionHeader>Elogio de la afición</SectionHeader>

      <NewspaperQuote source="Canarias7, 5 de abril de 1992">
        "El público ha estado maravilloso. Solo le faltó rematar los balones en la cancha. El Gran Canaria merece que se le apoye porque tenemos a la juventud con nosotros. Este club no va a quedar a la deriva."
      </NewspaperQuote>

      <SectionHeader>6.000 aficionados en el CID</SectionHeader>

      <NewspaperQuote source="Canarias7, 21 de enero de 1994">
        "Personas relacionadas directamente con el club y familiares nuestros se han quedado fuera debido a la gran multitud que se agolpó en la entrada, por lo que pido perdón públicamente a todos los que no pudieron presenciar el partido en el pabellón, pero nuestra intención con la gratuidad de la entrada era la de ofrecer un homenaje a la afición y no creímos que fueran a venir más de 6.000 personas."
      </NewspaperQuote>

      <SectionHeader>Una despedida con legado</SectionHeader>

      <NewspaperQuote source="Canarias7, 4 de diciembre de 1998">
        "Los canarios no valoramos lo que tenemos en casa hasta que lo echamos de menos. Con el cariño que recibo de la calle me doy por bien pagado. He visto a mucha gente llorar de emoción y tristeza en el Centro Insular de Deportes, y eso es imborrable."
      </NewspaperQuote>

      <SectionHeader>La repercusión del regreso</SectionHeader>

      <NewspaperQuote source="La Provincia, 9 de septiembre de 2020">
        "La historia del Guaguas es muy grande. Cuando fuimos a París para jugar contra el PSG nos acompañó Aniceto Rodríguez, que era el director general de Deportes. Cuando llegamos al aeropuerto nos llevaron a una sala de prensa y vimos seis o siete cámaras, seis o siete fotógrafos: L'Equipe, Canal +, Eurosport... El director general quiso que le preguntáramos a ellos por qué había venido tanta gente y ellos nos dijeron que éramos el Real Madrid del voleibol."
      </NewspaperQuote>

      <SectionHeader>Laureles renovados</SectionHeader>

      <NewspaperQuote source="Canarias7, 9 de febrero de 2021">
        "No esperaba que fuese así. Ni en el mejor de los sueños esperaba que todo saliera tan redondo. Lo hemos cumplido. Nadie se puede sentir defraudado en ese sentido. El Guaguas tiene un gen ganador y, con humildad y respetando a todos los rivales, nuestra obligación es siempre ir a ganar."
      </NewspaperQuote>
    </>
  ),

  // (Chapter 2 player profiles and Chapter 6 full content below)

  "cap02-jose-miguel-santana": (
    <>
      <DropCap>Descubridor de Sergio Miguel Camarero "por un tirón de orejas" ("siendo un niño me robaba los balones que caían fuera de la cancha y terminé recomendándole que se pusiera a jugar, como así haría y no le fue nada mal"), fue testigo y partícipe de un fichaje de leyenda como resultó ser Paco Sánchez Jover, a mitad de los ochenta y en un hotel del Puerto de Santa María durante un Preeuropeo ("convencí al recepcionista para estar en la habitación de al lado para que, cuando hubo que negociar, pudiese colarse por el balcón y que nadie lo viera") y actor impulsor, desde la tribuna de prensa, del fortalecimiento del proyecto justo en la etapa anterior a la gloria de los títulos. Pero antes, mucho antes, José Miguel Santana (Las Palmas de Gran Canaria, 1958) también se significó por jugar un papel activo en los inicios del Calvo Sotelo, entusiasta como siempre fue del voleibol tras pasar por las aulas del Alonso Quesada, en las que era deporte predominante y predilecto. Fichado del Santa Teresa al término de la temporada 1976-77, donde ejercía como entrenador y tras una llamada de Felipe Nuez para que se hiciera cargo del juvenil B masculino y femenino, Santana también hizo una contribución altruista y entusiasta que le procura un sitio privilegiado en la historia.</DropCap>

      <p>
        "Fueron años increíbles que uno recuerda con mucha emoción. Éramos jóvenes, atrevidos, soñábamos con todo y el voleibol fue el vehículo para cumplir con esas ilusiones. Lo hicimos desde la base de un compañerismo ejemplar. Nunca me cansaré de repetir que más que un club, éramos un grupo de amigos, una familia. Todos los jugadores de los equipos nos juntábamos en la cancha y, también, en el tiempo libre. Aquellas meriendas en la casa de Mendaño con bocadillos y botellas de refresco y nos daban las tantas, el tiempo volaba. Era una manera de vivir intensa, sana y que a todos nos dio valores y un patrón de conducta impecable", subraya.
      </p>

      <p>
        Hace un encendido elogio de varias figuras que considera "capitales" en el surgimiento y desarrollo del Calvo Sotelo, tales como Paco Rodríguez ("el que inició todo"), Guillermo Gil o Miguel Nieves ("también fundamentales con su trabajo e ideas") o Felipe Nuez ("el entrenador de entrenadores en el voleibol canario") y no escatima admiración por el comportamiento de los jugadores, "ejemplos de nobleza, afán de superación y lealtad".
      </p>

      <p>
        "Eran hombres siendo niños. Lo digo porque, siendo juveniles, exhibían una madurez y concentración propia de adultos. Eso fue lo que inculcó Felipe. El juego y la competición. Debían ir unidos. De ahí los entrenamientos con una intensidad brutal. Era una gozada entrenar a esos chicos y chicas que se tomaban cada sesión o cada partido con una disciplina intachable. Entre todos se aconsejaban, querían ser los mejores, se ayudaban, eran una piña al grito de 'cis', la C de Calvo y la S de Sotelo que decían en voz alta antes de empezar un partido como conjura. Y tener el apoyo del colegio, de los padres, era el respaldo ideal para continuar con esa obra que no paró de crecer", argumenta.
      </p>

      <p>
        Habla de sacrificio porque no fueron pocas las veces en las que tuvo que poner de su bolsillo el dinero para sufragar el agua de sus jugadores y, como no podía ser menos, participar de "las artimañas típicas de la época" cada vez que se viajaba a la península, "con maletas cargadas de tabaco y artículos que se pudieran vender" para sacar un beneficio que permitiera costear los gastos.
      </p>

      <p>
        "Fue una implicación total de todos los que formábamos parte del Calvo Sotelo, creando un vínculo especial que, en mi caso, me llevó a conocer a mi mujer o a tener amistades para toda la vida dentro de la misma disciplina del club. Nos marcó la vida porque, además nos cogió en una etapa especial, la que va de los 18-20 años en adelante", incide. Una llamada para entrar a formar parte de la redacción de Diario de Las Palmas, en 1982 y estando estudiando en Madrid, clausura su militancia en el club como miembro del organigrama y activo en todas las funciones que se le requirieran, si bien jamás dejó de "echar una mano en todo lo posible".
      </p>

      <p>
        "Ver cómo se alcanzó la plenitud de las Ligas y las Copas, con protagonistas que uno conoció siendo niños como Camarero, el liderazgo de Sánchez Jover, la continuidad a la obra de Felipe, que puso los pilares de todo con su sabiduría, con su trabajo... Al final dices que sí, que todo se justifica, que lo que se hizo entonces debió estar bien por lo que vino después y por lo que pervive", concluye.
      </p>
    </>
  ),

  "cap02-florencio-tejera": (
    <>
      <DropCap>Jugador fundacional del Calvo Sotelo tras la redacción de los estatutos del club y presidente "casi por accidente" en la temporada 1983-84, el testimonio de Florencio Tejera (Las Palmas de Gran Canaria, 1956) también resulta de inestimable valor para conocer la naturaleza primigenia de la entidad en sus albores ya insertada en las exigencias de la alta competición. Porque ese Calvo Sotelo al que se enroló "para poder cumplir el cupo de dos fichas séniors junto a Alfonso Déniz" que se requería ya le impactó por "su nivel de organización, ambición y desarrollo".</DropCap>

      <p>
        "Yo jugaba en el equipo de Magisterio mientras hacía la carrera y Felipe Nuez me invitó a formar parte del Calvo Sotelo por mi edad, ya que entonces había sobrepasado la categoría juvenil y le venía bien para el reglamento, que obligaba a combinar juveniles con, al menos, dos fichas de mayores, aunque yo tenía 20 años. Fue una etapa en la que disfruté del deporte, del espíritu de equipo y en la que me impliqué al máximo porque, más que un equipo, era una manera de vivir".
      </p>

      <p>
        Florencio lo justifica al especificar la metodología al detalle de Nuez, "quien componía unas rutinas de trabajo que eran propias del profesionalismo", lo que generó "una mentalidad de equipo única y que no entendía de horarios". Sesiones de gimnasio a las cinco de la mañana, carreras interminables en circuitos urbanos ("del colegio al López Socas y volver por todo el paseo de Chil"), entrenamientos con un nivel de tecnificación "sin competencia"...
      </p>

      <p>
        "Teníamos un equipazo. Pericles, Tony Vázquez, Paco Santana, Araña... Pero es que, además, físicamente superábamos a todos porque, en los partidos, se notaba una superioridad en todos los aspectos. Felipe nos tenía adiestrados a la perfección. Siempre queríamos ganar y, al ser un grupo de amigos, el apoyo entre todos era una máxima. Había una sana competencia, el afán de mejora era continuo, nadie ahorraba nada... Y luego cada uno retomaba sus rutinas en los estudios, en su entorno, pero siempre con el voleibol en mente. Con el siguiente partido, con el siguiente entrenamiento...", subraya.
      </p>

      <p>
        Las rivalidades con el Juventud, el ambiente "impresionante" en los partidos, "con llenos en las canchas" en las que comparecía el Calvo Sotelo, los desplazamientos a la península, aquel campeonato provincial que dio derecho a disputar la Fase Sector en Madrid para aspirar a la Segunda Nacional...
      </p>

      <p>
        "Fue impresionante asistir en primera persona a los inicios de lo que luego sería un equipo campeón y leyenda del deporte canario y recordar que, por encima de la maestría de un Felipe Nuez que era un adelantado a su tiempo, un entrenador que lo dominaba todo y preparaba cada partido al detalle, lo que nos distinguió era la amistad, el aprecio que nos teníamos, el sentimiento de pertenencia, la responsabilidad, asumida con naturalidad, de hacer crecer aquel escudo que nadie podía imaginar entonces que llegaría tan alto. Fue algo irrepetible. Y todos querían estar con nosotros, pertenecer al Calvo Sotelo era un signo de distinción porque llevaba implícita una rectitud de comportamiento y una mentalidad que nadie tenía entonces al menos en el voleibol canario. Sin cobrar, sacando adelante viajes llevando tabaco y otros artículos para vender en la península que servían para cubrir gastos, respirábamos voleibol siempre. Una madurez impropia a esa edad, se podría decir. Era nuestra vida", insiste.
      </p>

      <p>
        Un accidente que le provocó, entre otras consecuencias, una rotura de fémur puso fin a su carrera como jugador en el Calvo Sotelo, en el que también ejerció funciones de entrenador, al tener la titulación de técnico internacional, ("el primer triunfo ante el Juventud que logró el Calvo Sotelo, 2-3 en el Obispo Frías, fue bajo mi dirección técnica al estar Felipe Nuez ausente"). Pero lo que nunca pudo augurar es que, en 1983, de vuelta a Gran Canaria tras una larga estancia de índole académico por Madrid, sería propuesto e investido presidente.
      </p>

      <p>
        "El club venía de una presidencia marcada por algunos desfases económicos. De regreso a casa, me pasaba por la cancha del Calvo Sotelo a saludar a los compañeros, interesarme por el equipo. Incluso seguí jugando un tiempo tras recuperarme en equipos como el Tabaiba... Primero me ofrecieron ser dirigente, pero llegó un momento que nadie quería asumir la presidencia, me lo dijeron y sentí la obligación de aceptarlo porque, repito, la situación era muy delicada y el club necesitaba una cabeza visible. Entré por un ejercicio de responsabilidad y de servicio a unos colores con los que mi vinculación, además de deportiva, era emocional. Y hasta tuve que poner dinero de mi bolsillo en un momento dado para abonar unos gastos. Ese dinero, pasados los años, me lo reintegró religiosamente Juan Ruiz. Durante mi presidencia me veía más como un colaborador del club que como un presidente. No tenía apego al cargo, mi voluntad era la de echar una mano en todo lo que pudiera", detalla.
      </p>

      <p>
        Al ser requerido por Canarias7 para firmar un contrato como periodista del medio escrito creado dos años antes, en 1982, Florencio Tejera puso fin en 1984 a su cargo y vinculación formal con el Calvo Sotelo. "En adelante escribí del club, siempre con el cariño y afecto que le tenía, aunque con la obligación profesional, también, de anteponer mi integridad y fin informativo. Fui crítico con Juan Ruiz en lo que estimé, reconociéndole, eso sí, que puso al Calvo Sotelo en una dimensión privilegiada cuando entró como presidente, con estrellas nacionales e internacionales, títulos, prestigio... Desde la tribuna de prensa también asistí con dolor a la salida de Nuez en 1988, una figura de su calado yéndose, casi, por la puerta de atrás de un club que él había hecho nacer y prosperar, escribí con emoción de las gestas deportivas, del ambiente de un Centro Insular que vivió noches mágicas, me impactó la etapa en la que vinieron tiempos de incertidumbre por la crisis económica y, ya jubilado, he vuelto a sonreír y emocionarme con el renacimiento del Guaguas...".
      </p>

      <p>
        ¿Esperaba que aquel equipo de colegio, que jugaba sobre un cemento "en el que destrozarse las rodillas o romperse la barbilla era lo común", fuese el germen de una referencia de leyenda en el voleibol nacional? "Nadie se podía hacer a la idea de lo que acabaría siendo un Guaguas campeón que fue cogiendo el testigo de un equipo de cantera, plagado de juveniles y chicos de barrio, que llegaron a lo más alto que pudieron. Yo, evidentemente, tampoco. Pero siento que todo lo que hicimos mereció la pena. Fuimos unos locos, por decirlo de alguna manera. Soñamos, competimos, ganamos, entendimos el deporte desde el lado más humano y comprometido. Con eso me quedo".
      </p>
    </>
  ),

  "cap02-tony-vazquez": (
    <>
      <DropCap>Andaluz de nacimiento (Cádiz, 1960), pero grancanario de pleno derecho ("me trajeron con tres años y esta es mi tierra"), sobre Tony Vázquez recae el privilegio de haber sido otro de los jugadores fundacionales del Calvo Sotelo. Tras sus inicios en los Salesianos ("iba para el atletismo, pero Silvestre Cabrera me dijo que tenía la altura apropiada y me metió en el voleibol"), la creación de la selección cadete de Las Palmas, a mediados de los setenta y bajo la dirección de Felipe Nuez, fue el impulso definitivo a su posterior trayectoria como receptor ("era un 4 de toda la vida, aunque acabé jugando en todas las posiciones").</DropCap>

      <p>Vázquez tiene muy nítidos aquellos momentos en los que tomó la decisión de enrolarse en las filas del equipo que marcaría su porvenir: "Después de terminar la experiencia en la selección cadete, en la que recuerdo que intervenimos en unos Campeonatos de España tras eliminar al Tenerife, el camino para aquellos jugadores era ir al Juventud o al Calvo Sotelo. Tenía muy buena relación con Felipe, había estado con él y no me costó decidir. Para nada me arrepiento porque todo lo que vendría después fueron tiempos muy felices, tanto dentro como fuera de la cancha".</p>

      <p>"Hasta 1984 formé parte de un equipo que, como siempre dije, se inició con cuatro pelagatos, sin un duro y solo sostenido en el trabajo, la disciplina y el amor por el deporte. Empezamos el camino con la pretensión de divertirnos, sin más. Pero comenzamos a ganar, ganar y ganar y aquello se nos fue de las manos. Del cemento del colegio pasamos a querer subir de categoría, de competir con los mejores de España, de estar a un nivel impensable...", detalla.</p>

      <p>Fueron tiempos "irrepetibles" en los que sus protagonistas se sintieron únicos por la distinción que les daba pertenecer al club: "Todos querían formar parte del Calvo Sotelo y no todos se quedaban. La dureza de los entrenamientos, la calidad de los jugadores... Nos veían como a unos elegidos, por decirlo de alguna manera, y sentíamos el respeto de todos. Sitúense en Las Rehoyas de finales de los setenta y comienzos de los ochenta. Droga, delincuencia, problemas sociales... Nosotros nunca tuvimos el más mínimo problema y eso que terminábamos de entrenar de noche y teníamos que pasar por calles que, en teoría, debías evitar. Nos saludaban, nos respetaban, nos apoyaban".</p>

      <p>"El Calvo Sotelo representó para Las Rehoyas un orgullo —continúa—, una especie de tabla de salvación dentro de tiempos duros. De repente, en un entorno del que no se esperaba nada, surge un club de voleibol que es envidia de Canarias, que viaja y da la talla ante clubes de otras ciudades, que es un modelo de comportamiento y superación. Hay que poner en contexto todo eso para entender que el voleibol canalizó a través de ese equipo un crecimiento para todos los vecinos".</p>

      <p>El ascenso a Segunda en 1979 empodera la labor de Felipe Nuez y el trabajo de una plantilla "de amigos", como bien resalta Vázquez: "Fue la culminación. Aquí la rivalidad con el Juventud era enorme, se llenaban las canchas para vernos. Pero ir a Madrid, Sevilla, Cáceres, Málaga... Y ver que eras mejor que otros clubes de mayor potencial fue un subidón".</p>

      <p>"Nos encantaba viajar. Estar días fuera de casa, conocer ciudades. Era lo máximo. Y eso que no disponíamos de medios económicos. La cantidad de tabaco Winston que llevamos para vender. Rifas, boletos, hacíamos de todo con tal de sufragarnos los gastos. El apoyo del APA del colegio, de los padres, resultó fundamental. De lo contrario, no hubiésemos llegado tan lejos", añade.</p>

      <p>Tres nombres propios de aquellos inicios le vienen a la mente de manera inmediata. Inevitable, el de Felipe Nuez, al que define como "un técnico estricto, demasiado en ocasiones, muy apasionado por el voleibol pero que terminó siendo un compañero por su implicación con el grupo". Impuso un modelo disciplinario "implacable", con castigos para purgar los comportamientos que no quería ("una vez nos pilló a tres, entre los que me incluyo, por ir a la playa, algo que estaba prohibido, y nos tuvo subiendo y bajando las gradas del López Socas tres horas"), pero a la larga fue lo que forjó la estirpe de campeones que venía en camino. "Fue el técnico ideal y apropiado. Hay que reconocérselo. Vivía por y para el Calvo Sotelo, un ejemplo de compromiso en todos los sentidos", añade.</p>

      <p>También tiene palabras para Pericles, "el gran capitán" y guía de todos en el vestuario: "Pericles era nuestro referente. El único que era capaz de enfrentarse, entre comillas, a Felipe. Nadie le discutía nada. Jugaba siendo asmático y tenía una calidad asombrosa. El alma del Calvo Sotelo sin discusión. No se entiende ese equipo sin Pericles".</p>

      <p>Y el desaparecido Mendaño, fallecido en accidente de tráfico en pleno apogeo de su carrera: "Poco antes de irse para siempre, estábamos compartiendo unas cervezas en el pub Diseño, de Las Canteras. Me dijo que me fuera con él para hacer paracaidismo. Le dije que me daba miedo. Recuerdo como si fuese ayer despedirme de él... Sin pensar que era la última vez".</p>

      <p>"Mendaño estaba llamado a ser un jugador de época, pero tuvo una lesión en el brazo derecho, con el que le pegaba a la pelota, y acabó rematando con la zurda. Felipe lo reconvirtió a colocador. Nunca podré olvidarle", agrega.</p>

      <p>Fue testigo, igualmente, de los inicios del legendario Sergio Camarero, con quien coincidió cuando el actual técnico del equipo era un juvenil emergente: "Pese a no ser muy alto, era central. Se le veían ya unas condiciones fabulosas. Todo lo que hizo después no me pilló de sorpresa. Era un portento".</p>

      <p>Su ciclo en el Calvo Sotelo terminó un año antes de que se lograra el ascenso a la División de Honor, punto de arranque de la posterior cronología gloriosa de títulos y fama internacional. "Acabé con los que fundaron el Seven-Up porque no contaban conmigo, aunque Felipe me llamó para tratar de convencerme cuando ya me habían pedido que me fuera. No guardo ningún tipo de rencor, todo lo contrario. El espíritu de aquel Calvo Sotelo está en mi corazón como al igual que en el resto de corazones de todos aquellos que iniciamos el camino", pondera.</p>

      <p>Espectador en el CID de las finales gloriosas ganadas ("siempre pagando mi entrada"), asistió "emocionado" a la consagración de un club que siempre lo consideró "de cantera y por la cantera", aunque los tiempos de élite y profesionalismo "marcaran otro camino".</p>
    </>
  ),

  "cap02-pericles": (
    <>
      <DropCap>Un pelo abundante y la barba que le daba aires intelectuales le valieron el apodo, Pericles, con el que se incrustaría, por derecho propio, en el listado de imprescindibles del Calvo Sotelo. "Me dijeron, medio en serio medio en broma, que me parecía a Pericles. No me lo tomé mal y así me quedé", admite. Pedro Román Rosario (Las Palmas de Gran Canaria, 1958) no fue uno más. Durante muchos años capitán y guía del resto, añadió a sus grandes dotes para el voleibol ("como receptor formé con Tony Vázquez una línea fabulosa en esa función") una lección de compromiso y entrega de impresión, ya que, pese a su condición de asmático, perteneció durante largo periplo al equipo y con un rendimiento ejemplar. "Salía a la cancha con mi Ventolín para poder resistir los esfuerzos. En los tiempos muertos y descansos casi prefería el fuelle que me daba el medicamento al agua. Y alguna vez me pincharon por las asfixias que me entraban. Que se lo pregunten a Alfredo Padrón, que iba para doctor, como ejerció posteriormente, y en más de una ocasión fue mi practicante en el vestuario", rememora. Así, venciendo a una patología tan severa ("hoy en día, jugar en esas condiciones sería impensable por todos los exámenes médicos que se hacen, pero en esa época no teníamos controles de este tipo, no había tanta vigilancia para preservar la salud de los miembros de los equipos"), adquirió galones y ascendente hasta situarse en un estatus que ya siempre le correspondería. De la primera época del Calvo Sotelo no hay miembro que pase por alto la influencia ejercida por Pericles y su aura de liderazgo única.</DropCap>

      <p>"Me tomo como un halago el respeto y las muestras de cariño que siempre me dieron todos los compañeros. Nunca me consideré más o mejor que nadie. No va con mi carácter. Pero en lo que sí era muy estricto era en el sentido de la justicia y en pedir a todos que dieran lo que llevaban dentro en beneficio del equipo. Porque yo, con mi asma, me dejaba la vida por cada pelota, me tiraba a todas, peleaba cada punto, iba al límite. Y si yo podía, los demás no tenían excusa. Y tengo que decir que eso fue así, que éramos un grupo muy unido, muy solidario y que vivía el deporte de una manera intensa sin perder la enorme amistad que todos forjamos día a día y con un vínculo increíble", aclara.</p>

      <p>Pericles comenzó a jugar en el colegio Santa Catalina ("sobre un patio de tierra y piedras") y, antes de definir sus pasos, probó en el balonmano y el fútbol. "Cuando Felipe Nuez me llamó para formar parte del equipo absoluto del Calvo Sotelo ahí ya me dije que quería el futuro dentro del voleibol porque me gustaba, se me daba bien. Y aprendí mucho yendo a ver a los Salesianos en sus partidos antes de iniciar mi carrera. Me lo tomé todo muy en serio. Por eso el Calvo Sotelo me marcó tanto y es para mí algo incomparable", afirma con la emoción a flor de piel.</p>

      <p>"Infinidad de anécdotas y situaciones" tiene muy presentes en su memoria porque, como significa, "fueron muchísimas horas de entrenamiento y convivencia" pese a que pertenecer a la entidad "daba satisfacciones pero sin alcanzar para cubrir las necesidades básicas".</p>

      <p>"Hicimos de todo para lograr medios económicos y, por ejemplo, poder realizar viajes. Felipe Nuez y yo nos turnábamos como conductores para desplazar al resto porque, por edad, teníamos el carné de conducir a diferencia de la mayoría. Si no había guagua, ya sabíamos lo que nos tocaba. Cádiz-Cáceres, por ejemplo, del tirón y en las carreteras de antes. Yo conducía y, al día siguiente, a jugar. O si íbamos en guagua desde Madrid, pues a superar problemas, como cuando se averió el parabrisas e hicimos un recorrido de tres horas y diluviando con esa incidencia y todos cubriéndonos con mantas del miedo que nos invadió", precisa.</p>

      <p>Además, resalta la manera de desempeñarse de aquel equipo que estaba llamado a cubrir un camino de gestas: "Felipez Nuez nos llevó a un listón increíble, con horas y horas de entrenamiento. Mañana y tarde. Trabajaba, porque me casé y fui padre muy joven, y tenía que hacer magia para alternar mi oficio con los horarios en el gimnasio, en la pista... Pero eso nos vino bien a todos porque valorábamos que tanto perfeccionamiento nos llevaba a ganar. Notábamos que los rivales estaban por debajo de nuestros. Superamos al Juventud, que era impensable. Y ya luego los ascensos fueron algo tremendo".</p>

      <p>"En los partidos no parábamos de movernos. Tuviéramos o no el balón. Siempre en tensión, preparados para todo tipo de situaciones. Era como una seña de identidad y porque disponíamos de la condición física necesaria para ello. Y los partidos se iban a las tres horas por el antiguo formato de tener que ganar tu punto, no como en la actualidad. Por eso cuando veo algún encuentro y noto que hay jugadores como si la cosa no fuera con ellos, parados, casi con los brazos cruzados, me pillo unos cabreos enormes. Eso va en contra de lo que yo pienso del voleibol y de lo que a mí me enseñaron", argumenta.</p>

      <p>Hay un recuerdo especial, por su parte, "a dos caballeros como fueron Luzardo y Antonio Trejo", según opina, "grandes artífices con su empeño, trabajo y dedicación" a que el club "creciera y llegara hasta donde llegó", aunque matiza que la lista de personas que posibilitaron los sueños cumplidos "es muy amplia y nadie que lo merece debe quedarse fuera".</p>

      <p>"Mi etapa llegó hasta el inicio de la temporada 1986-87, justo con la llegada de Ivo Martinovic. Desde 1977, que se dice pronto. En ese momento sentí que no estaba capacitado para dar el nivel que requería un equipo ya con los mejores de España. Decidí irme. Creía que había dado lo mejor que tenía, que mis servicios al Calvo Sotelo se habían completado llevando al equipo desde abajo a la máxima categoría. Luego seguiría jugando en el Luna, un equipo que creamos varios compañeros que salimos del Guaguas en esa época para tratar de mantener el espíritu de cantera que se fue perdiendo poco a poco", añade.</p>

      <p>Pericles optó, tras su retirada definitiva, luego de una incursión en el vóley-playa "desconectar del todo" y se alejó del deporte para centrarse en su vida familiar, si bien, por el contacto que mantuvo con varios excomponentes del Guaguas, conoció la desaparición del club en 2009 y el retorno, de nuevo, once años después.</p>

      <p>"Dejaron morir injustamente un equipo que lo ha significado todo para el deporte en Canarias. Eso me produjo un disgusto enorme. Por suerte, ahora se ha recuperado la entidad, aunque preferiría que se apostara más por jóvenes de la tierra aunque eso supusiera no ganar títulos. Eso sí, hay que felicitar a Juan Ruiz por el trabajo que ha hecho para que no cayera en el olvido esta institución tan querida", subraya.</p>
    </>
  
  ),

  "cap02-miriam-quiroga": (
    <>
      <DropCap>Miriam Quiroga, licenciada en Educación Física y profesora universitaria, publicó en el año 2010 el libro 'Génesis y evolución del voleibol en Gran Canaria 1934-1978', editado por el Servicio de Publicaciones de la Universidad de Las Palmas de Gran Canaria, en el que se incluye amplia documentación escrita y gráfica del nacimiento y desarrollo del Club Voleibol Calvo Sotelo. Su testimonio es de indudable valor a la hora de analizar el surgimiento de la entidad y, a petición del autor de esta obra, además de mostrar una generosa colaboración bibliográfica, cediendo numeroso material que obraba en su poder, entre el que cabe destacar el documento original de los estatutos fundacionales que se reproduce en su integridad al final de este capítulo, accedió a responder este breve cuestionario y en el que aporta información alusiva a los primeros tiempos de la institución. Conste desde estas páginas el agradecimiento y reconocimiento de la directiva actual del Guaguas, presidida por Juan Ruiz, a su labor investigadora así como a su gesto de ayudar a este proyecto editorial.</DropCap>

      <p><strong>En el ámbito del deporte escolar de los setenta, germen del voleibol profesional y de éxito posterior, ¿qué destaca de la contribución del Calvo Sotelo y de técnicos pioneros como Francisco Rodríguez o Felipe Nuez?</strong></p>

      <p>-La contribución del Colegio Nacional Calvo Sotelo y de técnicos pioneros como Francisco Rodríguez Álvarez, Miguel Nieves Toledo, Félix Rodríguez Delgado y Felipe Nuez Domínguez es fundamental en el desarrollo del voleibol en Gran Canaria. A mediados de los años 60, del siglo XX, el crecimiento de los barrios de Las Rehoyas Bajas, Cruz de Piedra, Miller Bajo y Los Arapiles, hizo que muchas familias jóvenes, con hijos, se instalaran en ellos, haciendo necesaria la edificación de centros escolares en estas zonas. Uno de esos centros, ubicado en el barrio de Las Rehoyas, fue el Colegio Nacional Calvo Sotelo, que inició su andadura en el curso 1967-68 (Boletín Oficial del Estado, nº 220 de 14 de septiembre de 1967. Orden de 26 de agosto de 1967 por la que se crean Escuelas Nacionales de Enseñanza Primaria).</p>

      <p>En dicho colegio, el curso 1968-69, imparte docencia, como maestro nacional, Francisco Rodríguez Álvarez, quien es también conocedor del voleibol, e introduce este deporte en el centro participando en los III Juegos Deportivos para Enseñanza Primaria, también denominados III Juegos para la Juventud. Francisco Rodríguez Álvarez dedica gran parte de su tiempo libre preparando tanto a los niños como a las niñas del Colegio Nacional Calvo Sotelo para participar en las competiciones escolares de la época, llegando a conseguir destacados triunfos como el Campeonato de España Femenino de Voleibol en los Juegos Deportivos de Enseñanza General Básica, el curso 1971-72.</p>

      <p>La semilla del voleibol fue sembrada, a nivel escolar, en el Colegio Nacional Calvo Sotelo por Francisco Rodríguez Álvarez, quien trabajó en dicho centro hasta el curso 1975-76, sin dejar de participar con equipos, fundamentalmente femeninos, en las competiciones escolares de voleibol de categoría Infantil, Cadete y Juvenil, y también por otro maestro nacional, Miguel Nieves Toledo, quien el curso 1972-73 entrena al equipo de categoría infantil masculina que participa representando al colegio en los Campeonatos Escolares Provinciales, y que está relacionado con la participación federada, por vez primera, de un equipo del Colegio Nacional Calvo Sotelo.</p>

      <p>La temporada 1974-75, el Colegio Nacional Calvo Sotelo participa por primera vez en una competición a nivel federado y lo hace con un equipo masculino. Concretamente competirá en el Campeonato Provincial de Segunda División y será Miguel Nieves Toledo quien traerá como entrenadores a Félix Rodríguez Delgado y a Felipe Nuez Domínguez. Ambos procedentes de la desaparecida sección de voleibol masculino del Club Canteras Unión Deportiva, traen también con ellos a jugadores de ese club. No será hasta noviembre de 1976 que el Club Calvo Sotelo es fundado de forma oficial. Felipe Nuez Domínguez, estudiante de Magisterio y entrenador de voleibol, la temporada 1974-75, quedará como entrenador, al frente del voleibol federado del Club Voleibol Calvo Sotelo, consiguiendo el ascenso a División de Honor la temporada 1984-85 y permaneciendo como primer entrenador del mismo hasta mayo de 1988.</p>

      <p><strong>¿Qué momento considera más crucial, antes de la composición de los estatutos, en la cronología primigenia del club?</strong></p>

      <p>-Un momento clave es el de la creación de la primera directiva, como esbozo de lo que sería la fundación oficial del club con la redacción de sus Estatutos en noviembre de 1976. El apoyo de los componentes de esta directiva hacia el voleibol que se practicaba en el Colegio Nacional Calvo Sotelo fue fundamental para que el voleibol continuara practicándose con fuerza en el colegio, siendo su presidente José Celestino Luzardo Hernández, y también miembros de la misma Antonio Trejo Cruz (encargado de la imprenta del colegio), el director del colegio, Guillermo Gil Mayor y los maestros del colegio Pardo y Miguel Nieves Toledo. Y todo ello, con el apoyo de la Asociación de Padres de Alumnos del centro.</p>

      <p>También es un momento clave la llegada como entrenador, la temporada 1974-75, de Felipe Nuez Domínguez, pues será quien dedicará mucho tiempo a la formación de los jóvenes que se aficionarán a practicar voleibol, elevando cada temporada el nivel de los entrenamientos.</p>

      <p><strong>¿Qué aspecto le resultó más significativo o característico del Calvo Sotelo en comparación con otros clubes en sus primeros años de vida?</strong></p>

      <p>-La dedicación de los maestros nacionales de la época hacia este deporte es un hecho significativo, pero no solo en la génesis del CV Calvo Sotelo, sino también en la mayoría de los clubes. Paralelamente al Club Voleibol Calvo Sotelo, en Gran Canaria otros clubes también se crearon a través de su presencia en centros escolares, como, entre otros: el Juventud Las Palmas (que tiene sus orígenes en el colegio Salesianos), el Club Voleibol Jóvenes Aficionados al Voleibol Olímpico (que crea una escuela de voleibol en el Colegio Nacional 29 de Abril), el Club Voleibol San Roque (que sienta sus bases en el Colegio Nacional San Roque) o el Club Voleibol Russell Hall Las Palmas (que se origina en el Instituto Santa Teresa).</p>

      <p><strong>¿Supuso el modelo del Calvo Sotelo el triunfo del romanticismo y del espíritu de superación al salir del patio de un colegio y terminar derivando en aquel Guaguas campeón de España?</strong></p>

      <p>-El modelo del Club Calvo Sotelo supuso saber compartir la pasión por un deporte y lo que ello significa. Dedicar horas de trabajo al entrenamiento, estar dispuestos a dar siempre lo mejor de uno mismo en la cancha representando a tu equipo, aprendiendo de todo lo que llegó a la isla, voleibolísticamente hablando, a lo largo del tiempo. Tener las puertas abiertas y aprender de los mejores, a la vez que el esfuerzo incesante realizado, hizo que el Guaguas, apoyado por la afición, alcanzara elevados resultados deportivos.</p>

      <p><strong>¿Qué legado queda de aquella época irrepetible del primer Calvo Sotelo?</strong></p>

      <p>-Todos los momentos vividos en la historia del Club Voleibol Calvo Sotelo constituyen un valioso legado para el deporte canario. Pero, sobre todo, queda la constatación de que si se hace un buen trabajo, tanto desde el punto de vista deportivo como organizativo, se consiguen excelentes resultados, tanto a nivel nacional como internacional. La recuperación del Club Voleibol Calvo Sotelo con un equipo en la máxima división del voleibol español permite la posibilidad de recuperar un nivel deportivo elevado pero, al mismo tiempo, evitando repetir errores que llevaron a la desaparición del club años atrás.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 05: Iconos y estrellas del CV Guaguas
  // ═══════════════════════════════════════════════
  "capitulo-05": (
    <>
      <DropCap>Los grandes nombres que han escrito la historia del CV Guaguas. Jugadores que dejaron su huella en el voleibol español y que convirtieron al club en leyenda. Desde los canteranos que crecieron en el patio del Calvo Sotelo hasta las estrellas internacionales que llegaron para elevar el proyecto a cotas inimaginables, todos contribuyeron a forjar un legado deportivo sin parangón en Canarias.</DropCap>

      <ContentImage 
        src={imgJugadorAccion} 
        alt="Jugador del CV Guaguas en acción durante un partido" 
        caption="El talento individual al servicio del colectivo: seña de identidad del Guaguas a lo largo de su historia." 
        fullWidth 
      />
    </>
  ),

  "cap06-camarero": (
    <PlayerProfile name="Sergio Miguel Camarero">
      <DropCap>Cuando Sergio Miguel Camarero (Las Palmas de Gran Canaria, 1967) destacaba en el fútbol y como prometedor jugador del San Antonio, el equipo de su barrio, ya soñaba con hacer historia en el deporte. Su aspiración se iba a cumplir, aunque de manera insospechada porque, efectivamente, haría carrera pero en otra disciplina que tardó en practicar y a la que llegó de rebote. "Empecé a jugar al voleibol porque, al regreso de unas vacaciones en el sur de la isla, ya no tenía posibilidad de inscribirme en el equipo de fútbol. Se había acabado el plazo. Y me apunté en la Escuela de Voleibol del San Román. Mis primeros entrenadores fueron Félix Rodríguez, Joselu Sánchez e Ignacio Brito. Tendría 14 o 15 años. Y me enganché."</DropCap>
      <ContentImage 
        src={imgJorgeAlmansa} 
        alt="Jorge Almansa, capitán del CV Guaguas" 
        caption="Jorge Almansa, actual capitán del CV Guaguas, heredero de una larga tradición de líderes en la cancha." 
      />

      <p>
        "Era una época complicada en la calle, el riesgo de las malas influencias, las amistades que en esa etapa de la vida te pueden llevar por el mal camino. Mi suerte fue que elegí el deporte, el voleibol, y conocí a una persona como Felipe Nuez con la que pude crecer y desarrollarme en el mejor ambiente posible. Ya integrado en el Calvo Sotelo se puede decir que empecé a ver que esta iba a ser mi vida, que quería dedicarme a esto pese a ser muy joven."
      </p>

      <p>
        Camarero incide en la influencia capital de Nuez en sus inicios. "Detrás del ascenso a la División de Honor de 1985 hay muchísimo trabajo, sacrificio y un grupo de compañeros, de amigos, que supimos plasmar en la pista todas las enseñanzas y conceptos que nos inculcó un entrenador que fue figura fundamental."
      </p>

      <EditorialQuote>
        "Pude irme en el inicio de mi carrera. Me llamó del Cisneros Miguel Ocón. Pero aposté por quedarme en mi tierra y no me equivoqué. Por encima del dinero siempre antepuse el orgullo de defender los colores del Guaguas, que ha sido mi club siempre."
      </EditorialQuote>

      <p>
        Camarero se erige desde el principio en uno de los referentes del equipo con su manera pasional de competir. Sus imágenes icónicas pidiendo, brazos abiertos, el apoyo del Centro Insular en partidos memorables ya se daban en los tiempos iniciáticos en el García San Román.
      </p>

      <p>
        "Sánchez Jover, Venancio, Miralles, Chava, Golec, Klos... El Guaguas mejoraba año a año y se conservaba la base. Se construyó una grandísima plantilla, llegaron los títulos, jugar en Europa... Nadie podía esperar eso, pero, al mismo tiempo, creo que fue el premio a la valentía y a la ambición. Fue un proceso de unos años en el que siempre se mantuvo el crecimiento, sin dar pasos atrás."
      </p>

      <p>
        Hasta que se retiró en 1996, vivió años "inolvidables". "El primer título, la primera Liga, debutar en Europa, los compañeros, la afición, partidos que levantamos cuando estaban casi perdidos, el espíritu que forjamos, esa grada que nos llevó siempre hacia lo que queríamos... Fueron experiencias muy intensas, muy seguidas y que, en el momento, casi ni asimilas porque la competición te impide parar."
      </p>

      <p>
        Sergio Miguel Camarero acumuló 48 internacionalidades absolutas y 10 títulos oficiales (5 Ligas y 5 Copas). "Juan Ruiz es, indiscutiblemente, la persona más importante en la historia del club por todo lo que hizo y ha hecho. Llegó en momentos complicados. El último, sin club, directamente. Y de la nada ha vuelto a construir un Guaguas campeón."
      </p>
    </PlayerProfile>
  ),

  "cap06-sanchez-jover": (
    <PlayerProfile name="Paco Sánchez Jover">
      <DropCap>Paco Sánchez Jover es, junto a Camarero, el otro gran pilar sobre el que se construyó la leyenda del Guaguas. Llegado en el verano de 1987 como el gran fichaje estrella de Juan Ruiz, el mejor jugador de España en aquel momento, vino para no irse jamás y liderar los años dorados que ya estaban incubándose.</DropCap>

      <p>
        Su fichaje fue una auténtica jugada maestra de Juan Ruiz. "Le pregunté abiertamente a Nuez por el mejor jugador de España. Me dijo que era Paco Sánchez Jover. Le contesté que entonces habría que traerlo. Me planté en Palma, hablé con él. Le convencí de que viniera con nosotros sin poder alcanzar o igualar el contrato que tenía en el Palma."
      </p>

      <p>
        Con Sánchez Jover llegaron su hermano Jesús, Venancio Costa y Antonio Miralles. Todos darían excelentes réditos al escudo. Los resultados se dispararon y fueron un aviso al resto de que Gran Canaria exhibía proyecto ganador.
      </p>

      <p>
        Sánchez Jover ejerció como jugador y como entrenador, ganando títulos en ambas facetas y dando un ejemplo de lealtad y compromiso. "Renunció a más dinero por seguir aquí", como reconoce Juan Ruiz. "No entiendo el Guaguas sin Paco ni Sergio. Ni yo ni nadie."
      </p>

      <EditorialQuote>
        "Todo cambió y para peor. Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos."
      </EditorialQuote>
    </PlayerProfile>
  ),

  "cap06-golec": (
    <PlayerProfile name="Waclaw Golec">
      <DropCap>En el verano de 1989, Juan Ruiz une a su elenco de estrellas a los internacionales polacos Ireneusz Klos y Waclaw Golec, llamados a ser ídolos y figuras diferenciales. Golec, gran rematador de potente salto, especialista en remates de zona cuatro y zagueros, con gran recepción, fue considerado un jugador muy completo.</DropCap>

      <p>
        "Me gusta mucho el número 11 de la selección polaca, Golec, un gran rematador de potente salto, especialista en remates de zona cuatro y zagueros, con gran recepción, y creemos que es un jugador muy completo tras verle jugar cuatro encuentros en Polonia", describía Juan Ruiz cuando anunció su fichaje.
      </p>

      <p>
        La conexión entre Golec y Klos, junto con la potencia de Camarero y el liderazgo de Sánchez Jover, formó un cuarteto irrepetible que llevó al Guaguas a conquistar cinco Ligas consecutivas y múltiples Copas del Rey, estableciendo una hegemonía sin precedentes en el voleibol español.
      </p>
    </PlayerProfile>
  ),

  "cap06-klos": (
    <PlayerProfile name="Ireneusz Klos">
      <DropCap>Ireneusz Klos aterrizó en Gran Canaria junto a su compatriota Golec en 1989 y rápidamente se convirtió en una de las piezas fundamentales del engranaje del Guaguas campeón. Considerado uno de los cinco mejores colocadores del mundo, "no sabías si iba a rematar o a colocar", como recordaba Isidro Quintana.</DropCap>

      <ContentImage 
        src={imgOsmanyJuantorena} 
        alt="Osmany Juantorena, estrella internacional del CV Guaguas" 
        caption="El Guaguas siempre ha contado con estrellas internacionales que elevaron el nivel del equipo." 
      />
      <p>
        Su inteligencia táctica y su capacidad para dirigir el juego elevaron al Guaguas a un nivel que pocos equipos en la historia del voleibol español han alcanzado. La precisión de sus colocaciones alimentó el arsenal ofensivo de un equipo que dominó la Liga española durante un lustro.
      </p>

      <EditorialQuote>
        "Tener a un superclase como Golec, o Klos, que no sabías si iba a rematar o a colocar, considerado uno de los cinco mejores colocadores del mundo, la conexión brutal de Camarero con una grada que hacía volar a los jugadores... Es una secuencia increíble de éxitos y superaciones."
      </EditorialQuote>
    </PlayerProfile>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 06: Ignacio Brito / Tributo a los Salesianos
  // ═══════════════════════════════════════════════
  "capitulo-06": (
    <>
      <DropCap>La historia del voleibol en Gran Canaria no puede entenderse sin la contribución de los Salesianos. Ignacio Brito, formado en las instalaciones del colegio salesiano, fue uno de los primeros técnicos que comprendió que la cantera era el verdadero tesoro del club.</DropCap>

      <ContentImage 
        src={imgCopaDelRey} 
        alt="Los Salesianos, cuna del voleibol grancanario" 
        caption="El colegio Salesiano fue uno de los principales viveros del voleibol en Las Palmas de Gran Canaria." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 07: Marek, ayer, hoy y siempre
  // ═══════════════════════════════════════════════
  "capitulo-07": (
    <>
      <DropCap>Marek llegó a Gran Canaria como una estrella internacional y se marchó convertido en leyenda. Su impacto en el Guaguas trascendió lo deportivo para convertirse en un referente cultural del voleibol en las islas.</DropCap>

      <ContentImage 
        src={imgDobromirSaque} 
        alt="Momento de un saque en un partido del CV Guaguas" 
        caption="El nivel técnico de los jugadores internacionales elevó la competitividad del Guaguas en todas las competiciones." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 08: Embajadores por Europa
  // ═══════════════════════════════════════════════
  "capitulo-08": (
    <>
      <DropCap>La aventura europea del CV Guaguas es una de las páginas más brillantes de su historia. Desde la primera participación en la Copa de Europa hasta las campañas recientes en la Champions League, el club ha sido embajador del voleibol canario en los más prestigiosos escenarios del continente.</DropCap>

      <ContentImage 
        src={imgEquipoChampions} 
        alt="El CV Guaguas en competición europea" 
        caption="La expedición del CV Guaguas antes de un partido de Champions League, continuando la tradición europea del club." 
        fullWidth 
      />

      <ContentImage 
        src={imgAugustoColito} 
        alt="Augusto Colito en la Champions League" 
        caption="Augusto Colito, pieza clave del Guaguas en la Champions League 2025-2026." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 09: El relevo generacional
  // ═══════════════════════════════════════════════
  "capitulo-09": (
    <>
      <DropCap>Cada generación del Guaguas ha sido el eslabón de una cadena ininterrumpida de talento canario. El relevo generacional ha sido una constante en la vida del club, desde los pioneros del Calvo Sotelo hasta los actuales jugadores de la cantera que sueñan con vestir la camiseta amarilla.</DropCap>

      <ContentImage 
        src={imgNicoBruno} 
        alt="Nico Bruno, receptor del CV Guaguas" 
        caption="Nico Bruno representa la nueva generación de jugadores que llegan al Guaguas con hambre de títulos." 
      />

      <ContentImage 
        src={imgHelderSpencer} 
        alt="Hélder Spencer, central del CV Guaguas" 
        caption="Hélder Spencer, uno de los refuerzos internacionales que alimentan la competitividad del equipo." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAP 08 - JUGADORES (Embajadores por Europa)
  // ═══════════════════════════════════════════════

  "cap09-manuel-palacio": (
    <>
      <DropCap>Recorrió toda España y viajó, también, por media Europa siguiendo los partidos del mejor Guaguas en competiciones internacionales ("Polonia, Italia, Grecia, Rusia, Portugal, Rumanía, Turquía...") para dar cuenta en sus crónicas de las hazañas de aquella memorable pléyade de jugadores ("entonces, sin internet ni móviles, el método era contratar una llamada internacional en el hotel, rezar para que las comunicaciones no fallaran, y dictarla a la redacción") y como enviado especial del periódico La Provincia. Desde mitad de los setenta, sin embargo, se remontaba su actividad como informador del voleibol en las páginas de El Eco de Canarias y Hoja del Lunes ("tuve que utilizar el seudónimo de Plongeon para poder compatibilizar los dos medios de comunicación"). Fue testigo, por tanto, del nacimiento del Calvo Sotelo y siguió al detalle toda su evolución hasta el apogeo que llegó con los títulos pioneros y que llenaron hasta la bandera el CID. Manuel Palacio (Las Palmas de Gran Canaria, 1958-2023) fue una de las grandes autoridades del voleibol canario tanto por su experiencia en las canchas ("fui jugador y técnico del Juventud, compañero de Isidro Quintana y Joselu Sánchez en el ascenso a Primera División de 1982, además de ejercer de árbitro nacional") como por formación ("profesor de Educación Física y entrenador internacional") y constituyó una referencia obligada. "Perdí la cuenta ya de todas las reseñas que hice del Calvo Sotelo a lo largo de su historia, entre reportajes, entrevistas o crónicas. Podemos hablar de más de mil y lo mismo hasta me quedo corto", se sinceró para dar cuenta de las vivencias que acumulaba a pie de pista ("me sentaba en el mismo banquillo del equipo") y que le convirtieron en testigo único y de valor inestimable.</DropCap>

      <p>"Como a otros muchos de mi época, fue Silvestre Cabrera, con el tiempo presidente federativo, el que me captó para el voleibol en los Salesianos y ahí me quedé. Jugaba de colocador y me defendí lo que pude, por así decirlo. Formé parte de aquel Juventud de comienzos de los ochenta tan emergente y, al tiempo, tampoco descuidé sacarme las titulaciones que me permitieran conocer en profundidad el deporte al que me dediqué. Recuerdo que en los primeros tiempos, y por iniciativa del propio Silvestre Cabrera, se nos daba una ayuda de 25 pesetas por cada artículo de voleibol que publicáramos en prensa y con el fin de darle más relevancia. Isidro Quintana, Tony Vázquez, José Miguel Santana o yo nos sacábamos una ayudita de esa manera. Cobrábamos a mes vencido. Le poníamos más entusiasmo que interés económico de todas formas, pero se hizo una labor valiosa. Y más cuando aquí se celebró, en el año 1978, una final de la Copa del Rey entre el Bomberos de Barcelona y el Real Madrid, brindando a la afición la posibilidad de ver un voleibol de un nivel sublime", opinó.</p>

      <p>Palacio resaltó que "el gran trabajo de cantera y potenciación de la base" que se consolidó en la década de los setenta permitió a Gran Canaria "disponer de una buena representatividad a nivel nacional" en el voleibol, traducida en equipos masculinos y femeninos "de enorme talento y competitividad". Y el Calvo Sotelo, al que le benefició el descenso del Juventud en 1983 para adquirir más notoriedad, "terminó llevando la bandera de la isla con una camada extraordinaria de juveniles que no paró de crecer y crecer".</p>

      <p>"El trabajo de Felipe Nuez fue sensacional. Y dio su fruto tras varios años de continuidad en el modelo que impuso. Tony Vázquez, Pericles, Mendaño, Araña, Ramón Rodríguez, luego se unió Camarero, que vivía al lado del San Román... Era cuestión de tiempo que acabara en la máxima categoría como así sucedió. Se veía venir. Lo que no era tan predecible era que llegara a la cima. No creo que nadie lo esperara en Canarias, hay que ser sinceros y decirlo así", estimó.</p>

      <p>En este "enorme salto cualitativo" enfocó sus impresiones en la figura de Juan Ruiz quien, "con sus aciertos y errores", supo transportar al club "a lo más alto y rompiendo la hegemonía de clubes con más presupuesto y que se llevaban todos los títulos".</p>

      <p>"Cuando Juan se trajo a Sánchez Jover, Venancio Costa y Antonio Miralles, tres figuras de las mejores que había en el país, comencé a plantearme que iba en serio. Ya con Klos, el mejor colocador del mundo, o Golec, el sexteto era una cosa de locos: Costa, Miralles, Sánchez Jover, Klos, Golec y Camarero. Reventaron el CID literalmente. Y pasó lo que tenía que pasar. Juan fue a por todo, apostó a lo grande y le puso valentía. Mereció todo lo que vino por su empeño. Es de justicia reconocerle lo que hay que reconocerle", añadió.</p>

      <p>Consideró Manuel Palacio que Ruiz "hizo realidad todos los sueños de la afición" al construir un Guaguas "campeón e imbatible" y tirando "de su habilidad social para conseguir muchos patrocinadores, con aportaciones pequeñas pero importantes, para sostener un proyecto lleno de estrellas".</p>

      <p>Retroceder a esa etapa le llenó de "recuerdos muy bonitos" porque, al margen de los títulos ("fue un privilegio vivir en primera persona gestas únicas, con una marea humana de seguidores que no se ha vuelto a repetir"), tuvo muy presentes situaciones que no pudo olvidar por la carga emocional que comportaron. Enciclopedia abierta, Palacio las relató al detalle y con una sonrisa nostálgica: "En Grecia nos topamos con una afición que se quería meter en la cancha a morder. Le dije a Juan Ruiz, que estaba a mi lado, que ni se le ocurriera protestar nada si queríamos salir vivos de allí. Ahora lo cuento y me río. Pero había que estar allí en ese momento con miles de personas a tu espalda gritando y haciendo gestos muy agresivos. En Polonia, a Klos le gritaban pesetero desde la grada. No entendía nada pero él mismo me lo dijo y también que se iba a encargar de arreglarlo en un set. Y así lo hizo. Su categoría como jugador era universal. Los calló a todos con un vendaval de juego. Y cómo olvidar aquel viaje a Zagreb cuando, a inicios de los noventa, comenzaron los bombardeos de los serbios. En el mismo aeropuerto de Barcelona, poco antes de embarcar, Juan Ruiz tuvo que llamar al Ministerio de Asuntos Exteriores para ver si autorizaban o no el viaje porque la zona de conflicto coincidía con la localización del partido. Tras unas consultas y mucha tensión, nos desplazamos. He de decir que allí encontramos gente amable y humilde, nos protegieron todo el rato y se pudo jugar sin problema alguno".</p>

      <p>Aquel partido ante el PSG en el CID "con más de 6.000 espectadores" o la Final Four de la Recopa en Cuneo constituyen otros hitos que resalta por el eco que tuvieron y la expectación que generaron antes, durante y después. "Fueron momentos en los que se hablaba más del Guaguas que de la UD Las Palmas, y eso son palabras mayores. Un equipo que ganaba títulos, competía en Europa y tenía figuras mundiales", añade.</p>

      <p>Palacio valora que el Guaguas se haya vuelto a levantar "después de años durísimos en los que parecía que no habría salida", lo que le hace valorar el momento actual: "No se puede entrar en comparaciones. Hace treinta años teníamos un Guaguas campeón y ahora podemos decir lo mismo. Pienso que es lo más importante. Ojalá que la afición se vuelque con el equipo y que cuando lleguen tiempos duros, siga ahí, porque en el deporte no siempre se gana. Será la mejor manera de mantener el espíritu original del Calvo Sotelo y de lo que ha venido después".</p>
    </>
  ),

  "cap09-antonio-benitez": (
    <>
      <DropCap>Fue por un anuncio de periódico, a finales de 1990. Antonio Benítez (Las Palmas de Gran Canaria, 1960) desarrollaba su labor profesional como profesor de inglés cuando leyó el llamamiento en prensa de un club que requería un gerente para labores logísticas y relacionadas con la organización del personal y de la estructura propia. "Me resultó muy atractivo, me presenté, pasé el proceso de selección y me quedé... Hasta 1998. Nunca imaginé que iba a cubrir una etapa tan duradera y fructífera en el Guaguas y que ha supuesto un orgullo especial", admite un dirigente que siempre tuvo a Juan Ruiz como presidente y no ha dudado en regresar con él tras la refundación de la entidad.</DropCap>

      <p>Las peticiones del técnico argentino Enrique Edelstein, que demandó la figura de un mánager con el que reportar y que ejerciera de enlace con la cúpula, motivaron que en el club isleño crearan este cargo de responsabilidad que, desde los inicios, recayó en la misma persona. Organización de viajes, relaciones con los otros clubes, atención a las necesidades de los jugadores que procedían de fuera y necesitaban resolver y tramitar gestiones, planificación de las pretemporadas... Una cartera bien amplia que, concentrada en un único representante, requirió lo mejor de sus capacidades.</p>

      <EditorialQuote author="Antonio Benítez">Poco a poco, y gracias al enorme rendimiento del equipo, con títulos y participaciones en las competiciones europeas, fuimos cumpliendo con el propósito de situar en el mapa al Guaguas, de que cogiera posicionamiento internacional, de que la marca se diera a conocer fuera de España y se prestigiara, con el orgullo añadido de representar a Canarias y a un nivel magnífico. De la nada a tener un nombre en Francia, Alemania, Polonia, Rusia, Checoslovaquia, Italia, Bulgaria, Portugal...</EditorialQuote>

      <p>Tan reconocida y eficiente ha sido su hoja de servicios que, en su momento, fue llamado para incorporarse al organigrama de la Confederación Europea de Voleibol en su sede de Luxemburgo, propuesta que supuso "un reconocimiento inigualable" pero que no pudo aceptar por cuestiones familiares.</p>

      <p>"En su día logramos consolidar relaciones estables y muy sólidas con los grandes clubes de Europa y ahora, en el retorno, hemos vuelto a dar prioridad a este aspecto. Volvemos a notar un gran respeto y consideración por el Guaguas. Y lo digo con el conocimiento de causa que me da haber realizado todos los viajes por infinidad de países al frente de la expedición. Además, hemos recuperado la tradición de realizar torneos internacionales aquí y con clubes de enorme potencial y que están encantados de estar con nosotros... Es una satisfacción ver recompensados todos los esfuerzos de esta manera, sabiendo que estás presente en el concierto internacional, que el Guaguas tiene su sitio", abunda.</p>

      <p>Y la sempiterna cuestión pendiente de ese título continental que no llega la zanja Benítez desde la proporcionalidad de su juicio: "Aspirar a la Champions es una utopía porque hay rivales que multiplican por siete y ocho nuestro presupuesto. Encima, el sistema de competición te obliga a pasar varias rondas para luego acabar en un grupo con varios favoritos. Resumiendo, siendo realistas, ahora lo máximo es llegar a esa fase final de grupos. A nivel nacional volvemos a ser los mejores y, fuera de España, participar en la Champions ya debe considerarse un logro. Todo lo que venga, será para subir nota".</p>

      <p>De Juan Ruiz, todo son parabienes: "Llegué con él, me fui con él y regresé con él. Su capacidad de trabajo y de superación es asombrosa. Y siempre guiado por el interés de la institución".</p>
    </>
  ),

  "cap09-jorge-ramon": (
    <>
      <DropCap>Ya tenía el voleibol en la familia, con sus hermanos Jose y Marisa y su primo Joselu Sánchez como influencias capitales, cuando Jorge Ramón (Las Palmas de Gran Canaria, 1967) arrancó en el deporte que estaba instalado en casa y en las filas del Olímpico. Su altura, a edad juvenil, terminó de catapultarle para ingresar en el Calvo Sotelo después de que se creara la selección juvenil para el Salesianos. "Felipe Nuez me vio y me dijo que me quería en el equipo", rememora. Sin más pretensión que la de "pasarlo bien y disfrutar del deporte" y sin pensar "para nada" en que haría carrera en el equipo, arrancó un ciclo que le llevaría a ganar 5 Ligas y 4 Copas del Rey hasta 1995, el año en el que decidió retirarse, pese a contar con 28 años, para dedicarse plenamente a la informática, campo en el que ha desarrollado su actividad profesional. "Podría haber seguido jugando más, pero hablé con mi mujer y consideré que era el momento".</DropCap>

      <p>"Pericles, Batista, Mendaño y Tony Vázquez eran los veteranos cuando yo llegué. Camarero ya se sabía que iba a llegar pese a que era muy joven... En general había un grupo muy bueno con Felipe al frente y eso me ayudó a querer seguir, porque no era fácil compaginar estudios con entrenamientos. Pero, en ese momento, sigues adelante sin plantearte otra cosa. Es como la vida, que pasas de niño a hombre sin darte cuenta. En mi caso, ya estaba jugando en la División de Honor con Ivo Martinovic y Carrasco como refuerzos de fuera y un grupo de jugadores de la tierra realmente bueno".</p>

      <EditorialQuote author="Jorge Ramón">Creíamos en la filosofía del trabajo, de recoger los frutos a entrenar fuerte y darlo todo en la pista. Eso fue lo que me caracterizó. Entraba en la pista y me comía la pelota y la red. Si era el recambio de un compañero, ni se notaba que faltaba porque lo ponía todo. Pero es que no podía ser de otra manera. Cuando estás en un equipo con Camarero, Martinovic, luego Sánchez Jover, Venancio, Klos o Golec es que no te quedaba otro remedio que ser así porque entre esas estrellas estabas muerto si no te partías el alma.</EditorialQuote>

      <p>El ascenso a la élite, la permanencia y esa continuidad que habilitó el escenario para la llegada de los títulos constituyó un proceso en el que Jorge Ramón fue uno de los testigos activos: "Subir ya fue increíble. Luego lo que no queríamos era bajar y ese sexto puesto en el primer año en la División de Honor nos supo a gloria. Teníamos la mentalidad de ir poco a poco... Pero con la llegada de Juan Ruiz a la presidencia y los fichajes que hizo, esto se fue de las manos. Ligas, Copas, jugar en Europa, ganarle al Palma, que era algo impensable... Fue una evolución brutal y que nos pilló a todos por sorpresa", concreta.</p>

      <p>Sonríe cuando le toca mirar para atrás y rescatar momentos que guarda con especial devoción en su memoria: "Aquellas broncas con Ire (Klos) cuando no nos dejaba rematar nada en los partidos, o el encuentro de Copa en el que Edelstein me sacó y ayudé a los compañeros a levantar lo que estaba perdido y terminamos llorando de emoción, la afición del CID que era mágica, las bromas con Golec, que era alguien fantástico, crecer junto a Sergio, Juanma o David, que eran de aquí como tú y con los que pudiste mezclarte con figuras mundiales... Empiezo y no paro si tengo que destacar todo lo bueno que me pasó en el Guaguas".</p>

      <p>"Realmente me considero un gran privilegiado por haber formado parte de esa etapa que fue única. Terminamos viendo como lo más normal del mundo ganar títulos, exhibir un nivel de voleibol que, en muchas ocasiones, rayaba la perfección o que, en agosto, cuando arrancaban las pretemporadas, ni pudieras moverte de los dolores musculares derivados de la dureza de los entrenamientos... Ahora lo piensas y te das cuenta de que era tan grande la exigencia, que ni tiempo había para pensar sobre la misma. Entrenabas, jugabas, ganabas y así siempre".</p>

      <p>Sobre su rol en la plantilla, con el pedigrí de canterano que siempre le dio un diferencial, reflexiona: "Jugué más con algunos entrenadores que con otros. Pero ninguno de los técnicos que tuve puede decir que Jorge Ramón jugó un partido sin vaciarse. Cogía todas las oportunidades que me daban con la máxima intensidad. Y sin ser un fuera de serie, sin las condiciones técnicas de muchos de mis compañeros, nadie me ganaba en entusiasmo y derroche físico. Si me caía una pelota, la reventaba, si tenía que bloquear, iba con todo, si había que tirarse al suelo, me lanzaba como si me fuera la vida... En ese sentido, me sentí siempre feliz de jugar, con mayor o menor acierto, porque sabía que mis compañeros me veían como un guerrero, como alguien dispuesto a dejarse lo que hiciera falta por el Guaguas".</p>
    </>
  ),

  "cap09-juanma-martin": (
    <>
      <DropCap>Iba para futbolista y hasta los 16 años no tocó un balón de voleibol. Pero el destino quiso que Juanma Martín (Las Palmas de Gran Canaria, 1965) comenzara a jugar en la Universidad Laboral Felo Monzón con el San Roque "casi de casualidad" y, cuando se quiso dar cuenta, ya estaba enrolado en la disciplina del Calvo Sotelo. "Lo único que recuerdo es que Felipe Nuez organizó unos entrenamientos para seleccionar jugadores. Estaban Camarero, Joselu, Jorge Ramón... Y ya pasé a formar parte del club. Me cogió siendo juvenil y ya estaba en Segunda División. Fue todo rapidísimo, sin tiempo para asimilar nada", subraya.</DropCap>

      <p>Todavía rememora aquellas sesiones de trabajo en el gimnasio del instituto Pérez Galdós en la etapa previa a la mudanza al San Román en las que, "casi a razón de ocho horas diarias", tanto él como los jugadores de la época adquirieron "nivel y disciplina a la altura de los mejores profesionales".</p>

      <p>"Yo estudiaba la carrera de Educación Física y trataba de perderme los menos entrenamientos posibles. Por la tarde no fallaba nunca. Pero, tengo que reconocerlo, jamás me planteé jugar a alto nivel al voleibol. Todo lo que vino después con el ascenso a la División de Honor, los títulos y la locura de la afición a mí me pilló por sorpresa. Realmente no tuve tiempo de asimilar esa evolución. Jugábamos, ganábamos, entrenábamos, jugábamos, ganábamos, entrenábamos... Era para mí la misma secuencia, sin pararte a pensar que, como luego se ha visto y valorado, aquel Calvo Sotelo hizo algo increíble", argumenta.</p>

      <p>"Al ingresar en la División de Honor, con los fichajes de Ivo Martinovic y Pepe Carrasco, que venía de Barcelona solo para los partidos, ya comenzamos a entrar en otra dimensión. Fue un salto de calidad pero sin perder las esencias porque, quiero dejarlo muy claro, la clave del Calvo Sotelo, del Lucky Strike, del Guaguas, del Constructora, la clave de todos los éxitos estuvo en que éramos una familia. El grupo humano resultó inmejorable y todos los que vinieron de fuera se adaptaron a las mil maravillas a la gente de la casa. Paco Sánchez Jover, Sergio, Venancio, Miralles, Willock, Chava... Formamos un núcleo muy unido. Y Juan Ruiz como presidente también fue un elemento clave. Él le dio a todo una visión más perfeccionista, orientada a ganar", expone.</p>

      <EditorialQuote author="Juanma Martín">Me vienen a la memoria anécdotas muy entrañables que evidencian lo unidos que estábamos y lo que nos queríamos y protegíamos unos a otros. En la etapa de entrenador de Felipe Nuez, durante las concentraciones que él organizaba en el sur de Gran Canaria, mi madre era la que hacía de cocinera para todos. Y ya cuando jugábamos contra los mejores, en los viajes a Palma teníamos que hacer escala en Jerez y, luego, en Alicante. Pues a Alicante iba a vernos la madre de Miralles y nos llevaba conejo con tomate para alimentarnos. Y nos poníamos hasta arriba.</EditorialQuote>

      <p>"Como jugador era un currante, un líbero no reconocido. Paco me decía que si hubiese jugado unos años más tarde, hubiese sido un líbero de oro. Me caracterizaba por el trabajo y por tratar de ayudar siempre a los compañeros. Y como entrenador, mantuve mi estilo de tratar de colaborar en todo y encontré una disposición perfecta en muchos de los que habían sido mis compañeros. Era muy fácil entrenar a jugadores de esa calidad. Lo normal, que es lo que pasó, es que ganáramos, que siguiéramos en lo más alto", añade.</p>

      <p>Parte de sus evocaciones también ponderan el papel jugado por la afición: "El deporte es para la gente y nosotros tuvimos la suerte de disfrutar de un acompañamiento espectacular. Es que entrabas al CID y hasta las escaleras eran ocupadas por los seguidores. El ruido, los aplausos, los gritos... Una gozada jugar así, te llevaban a lo que te propusieras, era casi imposible perder con miles y miles de personas empujando a tu favor".</p>

      <p>El resurgimiento del club lo contempla, como todos los históricos de su generación, "con una alegría tremenda", pues considera que "es de justicia poder recuperar un emblema del deporte canario", ya que su consideración del Calvo Sotelo "va más allá del voleibol" dado el significado que comportó en su momento como "modelo deportivo y educativo, convirtiéndose en una manera de vivir".</p>
    </>
  ),

  "cap09-oscar-campos": (
    <>
      <DropCap>Integrante de la primera plantilla que defendió los colores del Calvo Sotelo en la División de Honor, Óscar Campos (Las Palmas de Gran Canaria, 1966) fue otro de los testigos que vivió la transformación del club en su paso de superviviente a candidato a todo. Colocador fichado del Juventud en 1985, cuando mira para atrás para entrar en detalles de aquellos tiempos "predominan los recuerdos positivos" ya que, por encima del balón y los partidos, "la complicidad entre todos era magnífica".</DropCap>

      <p>"En mis años en el club siempre recuerdo un vestuario unido, de compañeros, de amigos. Cada uno jugaba su rol. En mi caso, tuve más protagonismo en los primeros años, pues luego con las llegadas de Paco, Venancio, Miralles, Willock, Klos o Golec se puso muy complicado tener minutos. Pero, con independencia de eso, lo que prevalece en mi memoria es un grupo sano y que fue creciendo sin parar hasta lograr títulos y logros de muchísima importancia. Titulares y suplentes íbamos a una, había un verdadero espíritu de equipo. Pensar que íbamos a ser campeones de Liga, sin ir más lejos, parecía de locos. Y se consiguió", razona.</p>

      <p>Campos destaca tres nombres propios de su etapa en la entidad. Ensalza las figuras de Felipe Nuez, su primer entrenador y del que no olvida una metodología de trabajo única ("profesionalizó el voleibol porque diseñó entrenamientos muy intensos, con muchas horas, y, a la vez, muy completos, lo que contribuyó a elevar nuestro nivel y perfeccionar el juego"), del presidente Juan Ruiz ("hubo un antes y un después de su llegada, porque se dedicó a buscar medios económicos para el club y eso permitió una gestión muy eficiente y fichajes que posibilitaron los títulos") y de Paco Sánchez Jover ("su incorporación nos cambió la mentalidad y realizó una labor fundamental dentro y fuera de la pista para crear un equipo campeón").</p>

      <p>"La primera Copa, la primera Liga, el ambiente del Centro Insular después de haber empezado sin tanta expectación en el San Román, el estreno en competiciones europeas... Hasta que me marché, tras fichar por el Almería en 1991, todo fueron experiencias positivas porque coincidieron con una etapa de grandes resultados, de una evolución constante", sintetiza.</p>

      <p>Regresó un año, en el curso 1992-93, después de la marcha del argentino Wiernes y para completar la posición de colocador junto a Falasca, segunda etapa en la que, pese a no jugar mucho, "se siguió disfrutando de un equipo único".</p>
    </>
  ),

  "cap09-venancio-acosta": (
    <>
      <DropCap>A los 12 años ya estaba en el equipo de Almoradí, empezó gracias al profesor de educación física que lo vio "largirucho" y dijo que era para el voleibol. "En nuestro pueblo hay mucha tradición y es un club con mucha historia. A pesar de ser un pueblo muy pequeño me ofreció una oportunidad". Antes de llegar al Guaguas, jugó dos temporadas en el Son Amar (Palma de Mallorca), su último año juvenil, campeones de España en el año 1985-86, y su primer año como jugador en categoría absoluta 1986-87, en la que se ganó la Liga y la Copa del Rey y debutó con la selección nacional.</DropCap>

      <p>"Aterricé en 1987 en el García San Román de la mano de Juan Ruiz Ramos, llegué al Guaguas en un momento de pleno crecimiento y desarrollo del club. Más bien un jugador por consagrar, diría yo, era muy joven y con poca experiencia, pero con muchas ganas y dispuesto a crecer, a pesar de estar ya en el equipo nacional. Desde ese momento comenzó a escribirse una historia única y formar parte de ella siempre ha sido un honor".</p>

      <EditorialQuote author="Venancio Acosta">Deben darse muchos factores para que un grupo pase de ser un buen equipo a ser un equipo ganador y todo esto se dio con mucho esfuerzo por parte de todos, en un breve espacio de tiempo. Era un equipo con muchas ganas de ganar. Lo primero es que los componentes del grupo crean realmente en las posibilidades del equipo. Una cosa es lo que se dice, otra lo que se siente y otra lo que se hace. Hay que creer en uno mismo y creer en el compañero. En este sentido la confianza entre los principales componentes de nuestro grupo era absoluta.</EditorialQuote>

      <p>"Después hay que crear un buen ambiente de trabajo, que no es diversión, sino comunicación fluida y franca, exigencia, respeto y ganas de sacrificarse. Y no hablo solo de echarle horas en el pabellón y el gimnasio sino de comer bien, descansar mucho y salir poco durante muchísimo tiempo. Nosotros nos exigíamos los unos a los otros en todos los sentidos".</p>

      <p>"Todo lo vivido permanece intacto a pesar de los años, más allá de las victorias o derrotas, que forman parte indivisible de la vida del deporte de alta competición".</p>

      <p>"Después de 30 años de aquellos primeros títulos se valora mucho más todo lo vivido. En aquel momento nuestra primera Copa del Rey fue muy especial, pero los recuerdos del Centro Insular lleno son imborrables, todo el mundo recuerda el partido frente al París Saint Germain, cuando quedaron más de 1.500 aficionados a las puertas. Lo más bonito es prepararse, crecer, madurar, luchar, cuidarse, esforzarse, preocuparse, sufrir, perder, ganar... Y hacerlo uno y otro día, eso es lo difícil y lo atractivo".</p>

      <p>"En Gran Canaria conocí a mi mujer, grandísima jugadora mexicana de voleibol, vimos crecer a nuestra hija Danira Costa, jugadora de Superliga y de Selección Nacional. Completé mi formación en la Universidad de Las Palmas de Gran Canaria, siendo jugador del Guaguas participé en los Juegos Olímpicos de Barcelona... No podía pedir más".</p>

      <p>"A día de hoy puedo asegurar que la afición grancanaria fue determinante, maravillosa, nos transmitía la energía necesaria para cada momento. Nos enseñó a entregarnos en cuerpo y alma y eso lo valoraban. La afición nos hizo creer, crecimos juntos, convivimos y compartimos sus costumbres y aprendimos a defender con profesionalidad y orgullo los colores de la tierra canaria".</p>

      <p>"Recuerdo con mucho cariño la compañía de tantos amigos y amigas fuera de la pista. Fueron un pilar fundamental para seguir adelante, gracias a la suma de pequeños esfuerzos repartidos día a día durante más de 14 años. Ellos son parte de mi familia y espero llegar a todos sin tener que nombrarlos".</p>

      <EditorialQuote author="Venancio Acosta">Te enseña el valor del sentimiento de pertenencia, del sentido de identidad. En ese equipo había personas que influyeron de manera muy importante en mi vida. Esa época y el voleibol marcaron mi vida, se grabó en mí a fuego, con pasión, se lleva en la sangre. Hasta hace muy poco pensé qué era mi vida y gracias a Dios he descubierto que solo es parte de ella.</EditorialQuote>

      <p>"Después de jugar continué durante más de 14 años como entrenador de diferentes equipos. Pude disfrutar como segundo entrenador de la Selección Nacional en los Juegos Olímpicos de Sídney (2000) y de la consecución del Campeonato de Europa en Moscú (2007)".</p>

      <p>"Antes de despedirme quisiera enviar un caluroso saludo a todos los compañeros que han pasado por este gran Club, especialmente a Miguel Ángel Falasca, que dejó un vacío imposible de cubrir en nuestros corazones. A Paco Sánchez Jover, mi mentor, por tantos años a su lado. ¡Gracias maestro! A mi entrañable amigo Tomás Álvarez Vera, por su nobleza y sincera amistad. ¡Gracias hermano! Querido Juan Ruiz, mucha fuerza y mucho ánimo en el nuevo proyecto Club Voleibol Guaguas".</p>
    </>
  ),

  "cap09-antonio-miralles": (
    <>
      <DropCap>Fue otro de los fichajes estelares con los que se puso el punto de partida del mejor Guaguas de siempre, el que encadenó títulos sin parar entre finales de los ochenta e inicios de los noventa. "Paco Sánchez Jover era el líder absoluto del voleibol español. Y cuando decidió venir al Guaguas era señal de que algo grande venía en camino. Alguien como él no se iba a ir a cualquier sitio. Fue fácil que, al igual que hizo Venancio Costa, me decidiera". Así justifica su elección por la entidad grancanaria Antonio Miralles (Alicante, 1965), otra de las adquisiciones de época. Venía de un Palma campeón de Liga y Copa y también colgaba de su cuello el oro en los recientes Juegos del Mediterráneo conquistado con España (junto a Costa) y podía elegir destino. Y un Guaguas "de mitad de la tabla" entonces terminó convirtiéndose para él en un club en el que enraizaría "de una manera inimaginable".</DropCap>

      <p>"Llegué muy joven, en 1987, y empujado, además de por querer ganar títulos, como me acostumbraron desde niño con una mentalidad en la que no vale ser segundo, por el hecho de que aquí se podía estudiar Educación Física, la carrera que terminaría completando y que siempre fue mi aspiración para formarme. En ese momento ayudó todo y me vi jugando en el Guaguas pese a que creo que terminé llegando porque el deseo de Juan Ruiz, que era Sixto Jiménez, no pudo ser. Con todo, me sentí importante desde el primer momento en un proyecto que no paró de ir hacia arriba. Encontramos una buena base en Camarero, Jorge Ramón... Y se fueron añadiendo retoques de una calidad enorme como Willock o el Chava. No podía acabar de otra forma teniendo el equipazo que teníamos, por mucho que fuese muy especial levantar Ligas y Copas", reconoce.</p>

      <p>El Zorro, apelativo que le puso el técnico Miguel Ocón por sus rasgos faciales, permaneció en la plantilla hasta el año 1992, cuando decidió enrolarse en el Gáldar, pero regresó en 1995, luego de superar una grave lesión de rodilla, para cumplir un ciclo de dos años más y completar siete como jugador, en el que añadió una Copa del Rey más al palmarés que atesoró con la camiseta amarilla: 3 Ligas, 5 Copas y 1 Supercopa.</p>

      <EditorialQuote author="Antonio Miralles">Me viene a la memoria la primera Copa del Rey porque coincidió con época de carnavales y el ambiente era indescriptible. Un gentío tremendo, bombos sonando, un CID a reventar, el final deseado. Fue el inicio y eso queda para siempre. Encima se la ganamos al Palma, que eso ya eran palabras mayores.</EditorialQuote>

      <p>Asegura que disfrutó "una barbaridad" formando parte de generaciones irrepetibles, en las dos etapas diferenciadas que cumplimentó: "Hice la mili en 1991 con Camarero y coincidimos con Rafa, que era un delantero de la UD Las Palmas. Nos conocían más a nosotros que a los jugadores de fútbol. Logramos que la gente se interesara por el voleibol, se hablara del equipo, del club. Claro que, en el deporte profesional, pasa lo mismo en todas las disciplinas: cuando ganas interesas y cuando no lo haces, acabas cayendo en el olvido. Pero, al menos, mientras eso duró, fue algo impresionante y que, efectivamente, nos hizo sentir muy especiales".</p>

      <p>En Miralles el escudo y la tierra se quedaron para siempre y ahí permanecen: "Aquí terminé los estudios universitarios, aquí me casé, aquí nacieron mis hijos, trabajé en la docencia, también dentro del club... Imposible que Gran Canaria me pudiese dar más después de mi ciclo como jugador profesional en el que el balance fue magnífico".</p>

      <p>A las lecciones de talento que dejó sobre la pista colaborando en aumentar el prestigio del club, añadió una posterior experiencia como entrenador en el Guaguas como auxiliar de Benjamín Vicedo, primero, y, posteriormente, de David Rodríguez. Fueron cinco años en total en la banda con balance, a su parecer, "bastante bueno si se atienden las circunstancias del momento".</p>

      <p>"Con Benjamín teníamos un grupo muy joven, que había moldeado Paco Sánchez Jover como los hermanos Cabrera, Raúl... Vivimos un periodo extraño, en el que las cosas no salieron como esperábamos. Luego, con David, manejando un presupuesto muy limitado, hilando muy fino en los fichajes, dimos la cara ante los mejores y el nivel competitivo fue enorme. Recuerdo ganarle a equipos como el Montpellier, que tenía unas posibilidades económicas que triplicaban las nuestras, llegar a las semifinales en Europa, discutirle el título de España al Almería, al que le ganamos los dos partidos de local en el play-off. Un subcampeonato que supo a título... Tuvo mucho mérito hacer lo que hicimos con un grupo de jugadores que dieron todo y más de lo que llevaban dentro", ensalza.</p>

      <p>Fue una vida "diferente" a la de jugador y en la que "todo se sufre más", pero de la que "también se sacan conclusiones positivas", pese a que en el año 2006 decidió irse porque "las cosas empezaron a ponerse demasiado mal", anticipo de lo que terminaría derivando en la desaparición del Guaguas.</p>

      <p>"Dediqué más de diez años de mi vida al Guaguas y me siento orgulloso de que haya sido así. Son demasiadas vivencias especiales que justifican todo lo vivido, todos los sacrificios, todos los esfuerzos, aunque es verdad que siempre predominaron los momentos felices. Nos sentíamos unos elegidos. Ahora contemplo con ilusión que, con Juan Ruiz, el mismo presidente que logró lo que logró, regrese la entidad con fuerza. No lo ha podido hacer mejor, fruto de un trabajo excepcional de sus dirigentes, jugadores y técnicos", concluye.</p>
    </>
  ),

  "cap09-chava-gonzalez": (
    <>
      <DropCap>Un saque suyo terminó derivando en punto de partido y título histórico para el Guaguas, con aquella Copa del Rey de 1989 ante el Palma que estrenó el palmarés del club. Así quedó para siempre asociado Salvador González, Chava, (Mazatlán, México, 1958) a una de las explosiones de felicidad más atronadoras y recordadas del Centro Insular, abarrotado en un partido irrepetible. Más de treinta años después, todavía conserva frescos en la memoria detalles de todo lo que vino tras la consumación de un triunfo celebrado entre lágrimas y emociones.</DropCap>

      <EditorialQuote author="Chava González">Jamás imaginé que viviría algo así porque, cuando me ficharon, lo que me dijeron es que la aspiración era ganarle algún partido al Palma. Para nada se mencionó la posibilidad de levantar trofeos. La pista llena de gente, todo el mundo tocaba el cielo al sentirnos campeones, el abrazo con los compañeros, Juan Ruiz llorando como un niño... Son momentos que quedan para toda la vida, grabados a fuego. De lo mejor que me ha pasado, indudablemente.</EditorialQuote>

      <p>Chava llegó a Gran Canaria en el verano de 1988 e invitado por el club, junto a su compatriota y que sería el entrenador Sergio Hernández, para pasar un periodo de pruebas. "Danira Aragón, que se terminaría convirtiendo en la mujer de Venancio Costa, era una de las mejores voleibolistas de mi país y, cuando le preguntaron referencias de gente que conociera para unirse al proyecto, nos recomendó. Vinimos por las valoraciones que ella dio de nosotros. Por mi parte, era el capitán del equipo nacional de México, llevaba más de una década compitiendo en eventos internacionales. Pero, por lo que fuera, no me conocían lo suficiente. Había manejado posibilidades en Francia e Italia que no se concretaron y, cuando llegó esta, no me lo pensé. Y más al ver que Paco Sánchez Jover, que era la imagen del voleibol español en el mundo, era uno de los jugadores del Guaguas".</p>

      <p>Su adaptación e integración al club y a Gran Canaria fueron "instantáneas", como admite. "Necesitaban un buen receptor y era una posición que dominaba porque, además, al haber hecho mucho vóley playa, me había habituado a recibir con dos compañeros. Paco era el opuesto y teníamos dos buenos centrales. No puedo olvidarme de Willock, que era un pedazo de jugador. En suma, logró moldearse un bloque muy compacto y coordinado que funcionó desde el principio", describe.</p>

      <p>"No olvido un aspecto esencial que fue la absoluta implicación de la directiva, con Juan Ruiz a la cabeza, en brindarnos cuidados, apoyos y atenciones. Para un jugador profesional es muy importante sentir, en determinados momentos, la cercanía de la dirigencia, de sus superiores. En este caso, así se dio", añade.</p>

      <p>Y, además de su rendimiento inmediato, aportó el compromiso de "responder a la confianza": "Amaba la camiseta, mi empatía con el club, con todo lo que tuviera que ver con el Guaguas, era absoluta. Porque no me hicieron un español más, me hicieron un canario, uno de los suyos. Moría y mataba por ese vestuario. De hecho guardo en casa muchísimos recortes de periódicos, equipaciones y recuerdos porque, para mí, ver todo eso supone volver a la felicidad".</p>

      <p>Chava no maneja dudas al asegurar que las dos campañas que vivió como jugador del Calvo Sotelo, 1988-89 y 1989-90, pusieron el punto culminante a su carrera, porque "fue imposible mejorar" el bagaje de esos años. "No recuerdo haber disfrutado más dentro y fuera de la cancha. Llegar a un club que no había ganado nada y colaborar en lograrlo fue algo fabuloso. Siempre desde un trabajo enorme, un sacrificio diario tremendo. Todo lo que conseguimos nos lo ganamos a pulso. Pienso que se hizo justicia con el crecimiento y méritos de un gran equipo que se forjó en la unión y el respeto, con cada jugador adaptado a su rol y asumiendo sus responsabilidades. Una ejecución perfecta de la labor de un colectivo".</p>

      <p>En el verano de 1989, coincidiendo con la histórica llegada de los polacos Klos y Golec, llegó a figurar como entrenador provisional del equipo tras la marcha de Hernández y la posterior llegada de Robert Croteau y en un acto de servicio a la entidad: "Me pidieron que ayudara en la dirección, algo que hice junto a Paco Sánchez Jover, y con naturalidad, sabiendo que era un momento particular y a la espera que de viniera otro preparador. Todo lo que estuviera en mi mano por favorecer a la institución, estaba de más pedirlo".</p>

      <p>"El cupo de extranjeros me impidió seguir más tiempo. Pero el Guaguas y Gran Canaria, con mi posterior ciclo en el Gáldar, van metidos en mi corazón de por vida. Saber que fui parte de aquella historia tan bonita, haber dejado tantas amistades allá y ver mi nombre junto a los de otros compañeros presente en la memoria supone para mí una satisfacción indescriptible", finaliza.</p>
    </>
  ),

  "cap09-sandeep-sharma": (
    <>
      <DropCap>Fue en un partido de Copa de Europa: "En Polonia, ante el Olstyn, en mi primera temporada en el Guaguas. Habíamos ganado en la ida por 3-1 y teníamos el pase encarrilado porque éramos mejores que ellos. Hacía un frío terrible. Oía que la gente cuando yo tocaba la pelota reaccionaba de manera diferente. La verdad es que me estaba saliendo un gran partido. Edelstein decide sentarme junto a otros compañeros al estar todo resuelto cuando ganamos dos sets porque nos esperaba luego un partido muy importante en Almería y quería dar descansos. Pero, de repente, me piden que vuelva, que debía seguir jugando porque, según me enteré después, el público quería verme. Por la megafonía del pabellón, que estaba lleno, repetían que si nadie había visto nunca a un hindú jugar al voleibol que esa era la oportunidad. Y lo decían desde el respeto, porque me aplaudieron y, después del partido, en la cena con la directiva visitante me felicitaron. También cuando salimos los chicos a dar una vuelta a una discoteca como premio de haber logrado la clasificación. Allí me bautizaron como el Tigre de Bengala".</DropCap>

      <p>Sandeep Sharma (Nangal, India, 1966) no ha podido olvidar aquel partido de la campaña 1991-92 en el que su nacionalidad, por sí misma, derivó en una expectación inusitada. Su juego y maestría terminaron elevándole a los cielos a ojos de miles de espectadores que no dudaron en ovacionarle pese a pertenecer a las filas del adversario. Esa admiración fue episódica en Polonia pero más arraigada e intensa en el Centro Insular durante su estancia en el Guaguas (1991-1993 y 1995-96) en la que, además de llenar su palmarés de títulos, se ganó un hueco en la historia del club.</p>

      <EditorialQuote author="Sandeep Sharma">Era el capitán de la selección de mi país y ya me había enfrentado varias veces a Paco Sánchez Jover en encuentros internacionales. Me encantaba su manera de jugar. Era de los mejores que había visto. Por eso cuando me llegó la posibilidad de fichar por el Guaguas, sabiendo que ya habían hecho grandes cosas y tenían un equipazo, me gustó la posibilidad de poder estar junto a él. Estaba en el Cisneros, pero no me lo pensé. Y pienso que fue un acierto, porque me adapté muy bien al grupo y tuve unos compañeros que eran increíbles.</EditorialQuote>

      <p>Opuesto de enorme poderío, adaptable a lo que se requiriera de él, "siempre con mentalidad de equipo y de ayudar", Sharma alcanzó un nivel de rendimiento que justificó con creces la apuesta que hicieron para integrar el trío de extranjeros con Golec y Nilsson, en su primer año. "Fue todo muy bien desde el principio, con un vestuario sano y comprometido. Los resultados fueron increíbles, el apoyo de la gente también. La verdad es que era positivo cuando fiché pensando que todo podría funcionar, pero a ese nivel, con dos dobletes consecutivos, ya era demasiado".</p>

      <p>Sharma, considerado en su país como una leyenda del voleibol y con multitud de condecoraciones que así lo acreditan, no tiene dudas acerca de su sentimiento de pertenencia al club: "Soy del Guaguas de por vida. Siempre lo digo. Y a mis hijos, que están vinculados al deporte, les recuerdo que su padre fue campeón en España con un club de Canarias que es único". Preguntado por si le dolió no ser profeta en su tierra como sí lo fue en la isla, reflexiona: "A nivel profesional, el voleibol indio no estaba preparado para retenerme. Por eso tuve la necesidad de emigrar a Europa, donde las condiciones y oportunidades eran infinitamente superiores. Dicho esto, en mi país también se me reconoce y se valora lo que hice fuera".</p>

      <p>En su última campaña, en la que se obtuvo la Copa del Rey de 1996 a las órdenes de Paco Sánchez Jover, también disfrutó, como en las anteriores, del "clima especial" que se generaba con cada actuación del equipo, pese a que la etapa más brillante había quedado atrás. "Era de los veteranos y mi misión, además de dar rendimiento, era la de aportar experiencia. Para mí fue una motivación especial regresar y volver a ganar un título porque me sentía muy identificado aunque muchos compañeros de la primera etapa ya no estuviesen", revela.</p>

      <p>"Fueron tres años pero de enorme intensidad que dejaron muy buen recuerdo en mi corazón. Juan Ruiz era un presidente que estaba muy cerca de nosotros, siempre soñando en grande. Para un jugador es importante que el jefe se involucre, se alegre con las victorias y sufra con las derrotas. Y eso lo teníamos con Juan. Un grupo maravilloso de jugadores en el que todos éramos amigos, todos nos ayudábamos. Pudimos mostrar nuestro nivel, ganar campeonatos, hacer un voleibol muy bueno y que permitió darle muchas alegrías a la afición. Pienso que todo salió perfecto. Nos quedó pendiente ganar algo en Europa, pero yo no cambio nada de lo que viví en el Guaguas. Profesional y personalmente fue algo magnífico para mí. Experiencias únicas. Firmaría que todo fuese igual si tuviera que repetirse la historia", concluye.</p>
    </>
  ),

  "cap09-juan-jose-cardona": (
    <>
      <DropCap>En su etapa de concejal de Movilidad, Transporte y Tráfico del ayuntamiento de Las Palmas de Gran Canaria, cargo que le otorgaba la presidencia de Guaguas Municipales, la empresa municipal de transporte público, Juan José Cardona (Las Palmas de Gran Canaria, 1962) se significó por ser una de las autoridades públicas que más se implicó en procurarle apoyo y financiación al Guaguas de finales de los noventa. Así se reconoce y valora en el club y con hechos, además, incontestables. En junio de 1997 propició la renovación del patrocinio que siempre ha sido seña de identidad y no dudó, tampoco, en vivir en directo la Final Four de la Recopa de 1998 en Cuneo (Italia). "Siempre me gustó el voleibol y lo practiqué en mi juventud en Arucas. Pero es que, además, el Guaguas tuvo una representatividad e importancia en Las Palmas de Gran Canaria que le hacía llenar el Centro Insular. Palabras mayores porque hablamos de 5.000 espectadores o más en una disciplina que, con todo el respeto se diga, no es de las denominadas mayoritarias, muy por debajo siempre del fútbol y del baloncesto", detalla.</DropCap>

      <p>Cardona afirma que el impacto del equipo "traspasó el ámbito deportivo" para convertirse en "una marca de éxito y representatividad", lo que, como gestor público, "no podía desatenderse".</p>

      <EditorialQuote author="Juan José Cardona">Tengo que reconocer que todo el grupo de gobierno del ayuntamiento, con José Manuel Soria al frente, me brindó apoyo cuando propuse que se recuperara el histórico patrocinio de Guaguas Municipales para el club. Con Juan Ruiz en la presidencia, todo un ejemplo de honestidad y competencia, y Paco Sánchez Jover en el banquillo, un símbolo, la credibilidad era total.</EditorialQuote>

      <p>"El fin de ese dinero destinado a la entidad era más bien social, pues no hay que olvidar la labor de cantera desarrollada, con muchos jugadores que terminaron llegando a la selección española. En suma, fue una decisión justificada, proporcionada, celebrada y merecida. Llegó en un momento oportuno, en el que la entidad lo requería y allí estuvimos. A mí me reconfortó", argumenta.</p>

      <p>Y añade: "Hubo un retorno de sobra a la confianza municipal porque el proyecto era ejemplar. Hay que recordar que la finalidad de una empresa de transporte público no es ganar dinero, es servir. Y este tipo de servicio, con el mecenazgo de un club al que ya se le asociaba desde años anteriores, fue una manera de cumplir con este propósito. La promoción que le dio a nuestra isla dentro y fuera de España era impagable en aquellos años".</p>

      <p>El que fuera alcalde de la ciudad tiempo después no oculta que el regreso del Guaguas le parece "una iniciativa preciosa" y que, en su opinión, "colaborará en hacer más grande y respetado el deporte grancanario".</p>
    </>
  ),

"cap10-cantera": (
    <>
      <DropCap>La leyenda del Guaguas campeón, cuya hegemonía nacional fue absoluta a inicios de los noventa, se cimentó en un grupo de jugadores de base estable y a la que se fueron añadiendo refuerzos seleccionados, tanto del panorama español como de la pasarela internacional, que no hicieron más que mejorar el nivel de un grupo ya de por sí de una regularidad asombrosa e impermeable a la feroz competencia de otros clubes con mayor presupuesto. El sexteto titular, sujeto a mínimos cambios, era recitado de memoria por aficionados y adversarios, toda vez que figuras como Golec, Camarero, Sánchez Jover o Venancio Costa, entre otros, tuvieron una larga vigencia en la defensa de la camiseta y conformaron un núcleo duro, con una coordinación y automatismos que depararon infinidad de partidos para el recuerdo y con el premio añadido de títulos y prestigio.</DropCap>

      <p>Pero en el deporte los cambios generacionales y de ciclo son inevitables y en el caso propio vino pilotado por jóvenes de la casa y alguno traído de fuera que, en líneas generales, cumplieron con nota para mantener en lo más alto la credibilidad del proyecto. Nombres como Alexis Valido, Daniel Castañeda, los hermanos Cabrera, Pedro y Antonio, Raúl Dávila o Níchel Gómez fueron algunos de los exponentes más sobresalientes de la nueva hornada de mitad de la última década del siglo XX y que merecen reconocimiento propio por la labor desarrollada, así como su ejemplo en el prestigio del escudo. Antonio Sánchez, superviviente de la vieja guardia, de una precocidad igualmente asombrosa (ejercía de capitán con 23 años), estuvo presente en ese florecimiento.</p>

      <EditorialQuote author="Paco Sánchez Jover">Le doy el valor de un campeonato a los segundos puestos logrados después de las cinco Ligas consecutivas porque tuvo un mérito terrible que compitiéramos hasta el final contra todos con gente joven, inexperta y que, aún así, nos hizo sentirnos orgullosos y capaces de ganarle a cualquiera con su lección de entrega, compromiso y competitividad.</EditorialQuote>

      <p>Sánchez Jover fue uno de los convencidos de que muchas de las soluciones pasaban por mirar a la cantera. Incluso él mismo se encargó en repetidas ocasiones de reclutar a jóvenes que, con el tiempo, llegarían a consagrarse siendo internacionales absolutos, además de adornar su palmarés con alguno de los títulos que se fechan en el último tramo de este periodo, tales como las Copas del Rey de 1996 y 1997 o la primera Supercopa de España que entró en las vitrinas, lograda en septiembre de 1996. La manera en la que captó a los hermanos Cabrera, a Raúl Dávila, a Níchel Gómez o, años atrás, a Antonio Sánchez evidencia su grado de implicación. Pero no se quedó ahí, ya que, además de dar la reválida mantuvo una línea de actuación, combinando exigencia y ejemplaridad, que permitió a juveniles codearse con nombres estelares. Todos, sin excepción, agradecen al que primero fue ídolo y, posteriormente, técnico, el papel intervencionista que tuvo, ya que les cambió la vida, llevando los valores sagrados implícitos al deporte al desarrollo y crecimiento personal.</p>

      <p>Cuando algunos inolvidables ya estaban en su crepúsculo y se hizo inevitable la necesidad de una inyección de savia nueva y más bríos en la cancha, varios fueron los que asumieron la responsabilidad con unas prestaciones todavía recordadas y puestas en valor.</p>
    </>
  ),

  "cap10-alexis-valido": (
    <>
      <DropCap>Tres etapas tuvo Alexis Valido (Las Palmas de Gran Canaria, 1976) en el Guaguas. Todas cortas, pero, igualmente, trascendentes y de las que asegura sentirse "muy orgulloso", pese a que su prosperidad profesional en el voleibol llegó fuera del club, al igual que su prolongada estancia en la selección absoluta, con la que fue olímpico en Sídney 2000 además de tomar parte en ligas mundiales y torneos internacionales. "Salí de La Paterna y entré en el Guaguas porque Juan Ruiz y Antonio Benítez contactaron conmigo. Entré en edad juvenil porque recuerdo haber participado en el Campeonato de España de la categoría ya integrado en el Guaguas. Y muy pronto, antes de que quise darme cuenta, estaba en el vestuario con los mayores, cambiándome de ropa junto a Camarero, Golec o Sánchez Jover, que eran mis ídolos. Fue una experiencia increíble porque, siendo un todavía un niño, estaba rodeado de figuras de ese nivel. No tuve ni tiempo de asimilarlo", afirma.</DropCap>

      <p>Valido fue miembro de la plantilla que alzó la Liga en la temporada 1993-94 ("apenas jugué esa campaña porque había un equipazo y para un canterano tener minutos era poco menos que imposible") y, tras un año a gran nivel en las filas del Cisneros ("teniendo como compañeros a Joel Sotelo o Castañeda"), regresó en 1995. "Cuando supe que querían que volviera, ni me lo pensé. Había rendido muy bien en Tenerife y me sentía preparado para ser importante. Seguía siendo un equipazo, aunque sí tuve más oportunidades y todo concluyó de manera muy feliz con la Copa que ganamos en el Centro Insular", subraya.</p>

      <p>Valido tendría un nuevo capítulo, ya al borde de la retirada en 2007 cuando, a requerimiento de David Rodríguez, fichó por el Jusan para facilitar su salvación "jugando algunos partidos sueltos", en lo que constituyó otro acto de servicio al escudo del que también presume. "Me necesitaban en un momento complicado y no lo dudé. Era una situación límite y lo consideré una responsabilidad y como agradecimiento a un equipo al que le debo mucho", reconoce.</p>

      <p>"Fui internacional júnior jugando en el Guaguas y, por supuesto, considero que en mi carrera significó muchísimo pertenecer al club por todo lo que me aportó como jugador, como persona, por el privilegio que supuso tener compañeros muy valiosos desde el punto de vista humano. Es cierto que fue una etapa en la que las oportunidades para los chicos de la casa eran muy escasas pero, con todo, fue lo que me tocó vivir y solo saco conclusiones positivas", valora.</p>
    </>
  ),

  "cap10-antonio-sanchez": (
    <>
      <DropCap>Las casualidades de la vida hicieron que Antonio Sánchez (Las Palmas de Gran Canaria, 1974) viviera en el mismo edificio en el que residió en sus inicios en el Guaguas Paco Sánchez Jover. Se cruzaban en el ascensor, él un niño y Paco ya consagrado como una figura internacional. "Y un día me dice que me presentara en la pista del San Román a entrenarme con la base del Guaguas, que tenía que hacer voleibol. En mi vida había tocado una pelota, pero ni se me ocurrió llevarle la contraria. Así arranca mi historia con apenas 13 años en el equipo que me marcaría la vida", describe.</DropCap>

      <p>Antonio ya se asoma con los profesionales en los tiempos del técnico mexicano Sergio Hernández, la histórica campaña 1988-89 que deparó el primer título con la Copa del Rey ganada al Palma en el Centro Insular, si bien su estreno no se produce hasta 1992, con el argentino Marcelo Giovanacci en el banquillo. La espera tiene su explicación: "Me fui a realizar la concentración permanente en Palencia con la selección júnior, la primera convocatoria de ese tipo que se celebraba y luego se convirtió en habitual. Era una concentración para captar talentos para el equipo nacional. De ahí, al acabar, ya pasé al primer equipo".</p>

      <p>Tiempos de esplendor, con los célebres dobletes y un grupo de jugadores que colmaba la capacidad del Centro Insular: "Vivir aquello fue algo magnífico. No era fácil hacerse sitio entre tanta figura y los entrenamientos eran una guerra, en el buen sentido de la palabra. Con 18 años a mí me masacraban en las sesiones diarias. Un error en un saque, en una recepción, ya era motivo de que todos se te tiraran encima. Era una presión total pero que, a la larga, me permitió ser el que fui. Es impensable que eso suceda hoy en el deporte profesional. Era otra época, con otros valores. Para mí mejores, aunque implicaran un sacrificio continuo".</p>

      <p>"Desde esa etapa, que me dio un aprendizaje tremendo, al lado de los Camarero, Golec, Costa, Miralles, Paco, Klos o Chava, me tomaba cada entrenamiento como si de un partido se tratara. Perder un partidillo en una sesión de trabajo me fastidiaba el día y no pensaba en otra cosa que regresar al día siguiente a la pista para resarcirme. Ganar era una obsesión. Ya fuera en partidos oficiales o en los ensayos", insiste.</p>

      <EditorialQuote author="Antonio Sánchez">Paco se dirigió a mí en el banquillo y me dijo que la armara. Que agitara todo. Me centré en Matheus, la gran figura del Almería. Con miradas, susurros y comentarios, con ese otro juego que también vale, lo saqué del partido y luego, claro está, funcionó a las mil maravillas el plan de Paco, magistral a la hora de leer lo que necesitábamos.</EditorialQuote>

      <p>Tal era su manera de entregarse, que desvela una multa que le puso el club ("de 5.000 pesetas") por protagonizar una disputa dialéctica con su compañero Falasca durante el transcurso de un partido: "Nos dijimos de todo, es verdad. Pero siempre por el bien del equipo. Falasca (Q.E.P.D.) y yo éramos uña y carne. Con él, como con el resto, en la pista era una batalla sin cuartel pero, al terminar, salíamos juntos a tomar algo, nos queríamos y respetábamos todos. Nos protegíamos. Pero entendíamos el deporte de esa manera, con un perfeccionismo enfermizo y que no toleraba errores".</p>

      <p>De igual manera él lo hizo con la camada de canteranos que surgió a finales de los noventa: "Antonio Cabrera me odiaba porque en los entrenamientos estaba siempre encima de él. Él estaba allí para hacernos ganar. No para equivocarse o aprender. Fue lo que me enseñaron y lo que yo quise trasladar. A Juan Carlos Vega igual. Valido, Pedro Cabrera, Raúl Dávila... Me los comía. Pero luego, cuando tocaba competir, volaban. Asumían la presión con una naturalidad absoluta".</p>

      <p>Y abunda en el que considera urdidor de ese estilo guerrero y ganador: "Paco era un adelantado. Siempre lo fue. Además de que el voleibol español es imposible entenderlo sin su figura, fue el primero en poner publicidad en las redes, tratar de hacer lo mismo en los balones. Siempre estaba con iniciativas. Si el entrenamiento era a las cuatro, a las tres él ya estaba revisando qué música ponernos, de qué manera señalizar el suelo, qué ejercicios había que practicar. Su nivel de conocimientos era inalcanzable para el resto. Una vez, en Alemania, nos llevó a un bosque a entrenar porque no teníamos pista. Quería que imagináramos que los árboles hacían de red... Podría estar contando anécdotas con él y no terminar. Una enciclopedia abierta en inteligencia, gestión de grupo, motivación, capacidad comunicativa. El mejor", opina.</p>

      <p>Tras un paréntesis fuera, con paso por el Gijón en el curso 1997-98, regresó para una segunda etapa con la que cubrió su ciclo de 6 años en el Guaguas (1992-97 y 1998-99).</p>

      <p>Con 24 años, y tras aprobar las oposiciones para ejercer de policía, Antonio Sánchez decidió dejarlo, si bien luego añadió dos años más en las filas del Compaktuna atraído por la llamada de Sánchez Jover. "Tras proclamarnos subcampeones de Liga, en 1999, miré por mi futuro personal porque el dinero que nos daban no te alcanzaba para mirar a largo plazo. Fue una pena que, luego, en el club nadie tuviera la idea de poner en valor la base que había, con muchísima gente de la casa de una calidad enorme. Se tiró por la borda un legado muy valioso y eso terminó llevando a la fatalidad con la desaparición".</p>
    </>
  ),

  "cap10-daniel-castaneda": (
    <>
      <DropCap>Figura relevante en el Guaguas del cambio de siglo, Daniel Castañeda (Madrid, 1975) admite que, cuando en 1996 formalizó su fichaje por el club, tras sobresalir en el Palencia y el Cisneros, con el premio de ser citado por la selección española, puso "el punto culminante" a su carrera, ya que, como recuerda, "pocas camisetas más importantes se podían vestir" que la amarilla del equipo grancanario.</DropCap>

      <p>"Sabía que iba a un equipo ganador, que iba a estar en los primeros puestos y que, además, estaba entrenado por Paco Sánchez Jover, una referencia en el voleibol. Por si fuera poco, a nivel personal, se me brindaba la opción de compatibilizar el deporte con mis estudios de Arquitectura. No lo dudé y no me arrepentí", asegura a propósito de un periplo que se alargó hasta el año 2002.</p>

      <p>Castañeda se convirtió en un jugador apreciado y valorado por la afición del Centro Insular en una trayectoria que fue de menos a más, con un protagonismo creciente que eclosionó en la final de la Copa del Rey ganada en 1997 y en la recordada Final Four de la Recopa, disputada un año después en Italia.</p>

      <EditorialQuote author="Daniel Castañeda">Son momentos que quedan para siempre. Nunca antes había logrado un título y esa Copa, que se sacó adelante, además, en unas circunstancias muy especiales, con varios saliendo desde el banquillo como revulsivos y remontando un 0-2 ante el Almería, significó muchísimo, una felicidad enorme. Y, después, hacer un papel muy brillante en Europa y estar entre los mejores fue otro premio.</EditorialQuote>

      <p>Castañeda también destaca que, en esa transición que se desarrolló en sus años de militancia, "los subcampeonatos de Liga tuvieron muchísimo mérito", al tener que competir el Guaguas "ante clubes de mayores presupuestos y potencial", lo que dio mayor realce a "competir por todo y dar un nivel destacado". En este sentido, matiza que "había un equipo muy justo, sin la profundidad de recursos que tenían otros adversarios" para poder haber llegado más lejos en los objetivos.</p>

      <p>"Nos quedamos sin Liga, es verdad, pero me siento muy orgulloso de haber formado parte de esas plantillas que, año tras año, lucharon por mantener el prestigio del club en lo más alto, pese a que comenzó a hacerse patente una decadencia, tras la salida de Juan Ruiz de la presidencia, que terminó alcanzando todo. De hecho, cuando me voy ya se empezaban a vivir situaciones complicadas", añade.</p>

      <p>Asegura que su experiencia en el Guaguas le creó un vínculo que hoy se mantiene y del que presume: "Se me puso la piel de gallina cuando me dijeron que el Guaguas volvía tras muchos años sin competir. Y me considero uno más porque vivo los partidos con mucha emoción, celebro los títulos que se han ganado y deseo todo lo mejor a jugadores, técnicos y dirigentes. El equipo lo llevo metido muy adentro".</p>
    </>
  ),

  "cap10-juan-carlos-vega": (
    <>
      <DropCap>Lo lleva en el corazón. "El San Roque me hizo jugador y persona. Y el Guaguas, en la figura de su presidente Juan Ruiz, hasta me ayudó a salir adelante con aportaciones económicas cuando estaba en categoría júnior. Luego tuve el privilegio de defender sus colores, de ganar una Copa, de llegar a la selección absoluta y desarrollar mi carrera profesional en otros clubes gracias a todo lo que me enseñaron en mi casa. Eso va en el corazón para toda la vida". Juan Carlos Vega (Las Palmas de Gran Canaria, 1975) todavía ríe cuando recuerda sus sesiones de entrenamiento en los pasillos del Centro Insular, a las órdenes de Esteban Paganini, para ejercitar el antebrazo. La fusión entre San Roque y Gran Canaria le hizo ingresar en las categorías inferiores del club antes de dar el salto a la primera plantilla y con dos temporadas enlazadas (1997-1999) de buenas prestaciones bajo la batuta técnica de Sánchez Jover.</DropCap>

      <p>"Ganamos una Copa del Rey que fue muy festejada, por la remontada que logramos ante el Almería, y, en general, creo que respondimos bien a lo que se esperaba. Paco fue un entrenador muy valiente. Para mí ya era un ídolo por todo lo que nos había dado con los Golec, Klos o Camarero, aquellos tiempos de gloria. Pero cuando me tocó trabajar con él, que le diera confianza a la cantera, que apostara por muchos chicos de la tierra, me hizo tener mejor concepto de él, que ya era difícil por toda la admiración que le tenía", añade.</p>

      <EditorialQuote author="Juan Carlos Vega">Comencé tarde a jugar, ya con 14 años. Pero empecé y no paré. Vivía cada partido al límite. Más allá de recursos técnicos o físicos, me tomaba como si fuera la última batalla cada jornada, cada encuentro. En el Guaguas no tuve un rol principal, pero en lo que me utilizara Paco, salía a comerme la pista. Daba todo lo que tenía y más.</EditorialQuote>

      <p>Esa manera de competir le dio la excelencia, posteriormente, con su prolongado periplo internacional con España y compartiendo experiencias con los mejores del país: "Fueron dos años en el equipo de mi tierra. Quizás pocos, la verdad. Luego Almería, Málaga... Pero el Guaguas es el Guaguas. Para mí, tras el San Roque, fue el inicio de todo. Y la formación que me dieron, la confianza, la oportunidad... Todo supone un tesoro incalculable para mí. Me considero un privilegiado por lo que me tocó vivir, por las personas que estuvieron a mi lado siempre. Pasan los años y, por encima de títulos, medallas, trofeos y elogios, me quedo con eso, con la vivencia que, a través del voleibol, me convirtieron en quien fui y en quien soy. Mi agradecimiento a la entidad lo voy a llevar siempre y con el mayor de los orgullos".</p>
    </>
  ),

  "cap10-hermanos-cabrera": (
    <>
      <DropCap>De cómo entraron a formar parte del Guaguas los hermanos Cabrera, Antonio y Pedro, con el tiempo internacionales absolutos y figuras consolidadas en el panorama profesional, habla y mucho de la fuerza del destino. Ambos acudieron como espectadores, entre los miles que se congregaron en el Centro Insular, a presenciar el histórico partido de Copa de Europa frente al PSG en la temporada 1993-94. "A mí en el Claret ya me perseguía Camarero, que daba clases de voleibol allí, para que me metiera en el vóley. Yo le decía que no, que eso no era de hombres. Y él insistiendo", rememora Antonio (Las Palmas de Gran Canaria, 1977).</DropCap>

      <p>El caso es que ambos hicieron uso de las invitaciones para acudir a un encuentro que colapsó la capital por la riada de gente que se congregó en el recinto de la Avenida Marítima. Y al acabar el choque, culminado con una victoria para el recuerdo, sucedió lo impensable. "De pronto, en mitad de la avalancha de gente celebrando el triunfo, con la pista invadida de gente, Sánchez Jover, todavía vestido con la equipación del Guaguas, se dirige a mí y me dice que me vaya con él al vestuario. Surrealista. Yo era uno más entre la multitud. Me quedé de piedra", relata Pedro (Las Palmas de Gran Canaria, 1978). No acabó todo ahí: "Y Camarero, que andaba por allí, le dijo a Paco que yo tenía un hermano, que también tenía que venirse conmigo", añade. Y así, de repente, los dos se vieron en mitad de autoridades y dirigentes felicitando a jugadores y técnicos. "Lo cuentas y es normal que cueste que te crean, pero fue tal cual. Pasamos de ir a ver al equipo a salir con una propuesta para entrenar en las inferiores del Guaguas en Cruz de Piedra por invitación directa de Paco", remarca Pedro. "Venía de quien venía. Imposible negarse", añade Antonio.</p>

      <p>Una anécdota más en los inicios, ahora a cuenta del menor de la saga. "Un día me vio Paco jugando un partido de baloncesto en las canchas de Las Alcaravaneras y me abroncó como ni mi padre había hecho. Que no se me ocurriera más hacer eso, que me fuera directo a casa... En vez de estar jugando al basket parecía que estaba haciendo algo malo", ironiza.</p>

      <p>Antonio va directamente concentrado a la selección júnior a Guadalajara tras dar sus primeros pasos y con apenas conocimiento del juego. "Medía dos metros y me citaron sin verme tocar un balón. Se puede decir que era internacional antes de jugar. Porque la llamada de Buchaga, que era el seleccionador de la categoría, me llegó sin apenas haber practicado". Y de allí, de esa estancia entre los mejores del país, se incorporó a la primera plantilla, ya para la temporada 1996-97, la que se saldó con la Copa del Rey.</p>

      <EditorialQuote author="Antonio Cabrera">Durante un tiempo, el Guaguas era la base de la selección absoluta. Vega, Valido, Dávila, mi hermano y yo... Era algo increíble. Y todo, por obra y gracia de Sánchez Jover, que fue quien le dio un patrimonio humano de incalculable valor sacando a chicos de la cantera y dándonos oportunidades, confianza, exigiéndonos siempre porque sabía que ese era el camino. Me mataba a gritos, a recriminarme fallos, a pedirme más y luego se iba conmigo tras el entrenamiento a tomar un café y a decirme que era el mejor. Te motivaba de una manera espectacular.</EditorialQuote>

      <p>"Una vez casi llegamos a las manos de la tensión tras un partido... Y al día siguiente me guiñó el ojo y me sonrió, diciéndome palabras de apoyo. Te ganaba siempre. Disfruté muchísimo en esos años porque, aunque no llegaron más títulos tras la Supercopa de España, me hice un hombre. Más de un día regresaba a casa llorando tras un entrenamiento porque no me habían salido las cosas. Estaba obsesionado con ser mejor siempre", dice.</p>

      <p>Después de competir en los Juegos del Mediterráneo en Túnez con la absoluta, verano de 2001, pone fin a su etapa en el Guaguas tras ser, sorprendentemente, descartado. "Recibí muchísimas llamadas de gente que no se creían que me daban la baja estando en la plenitud de mi carrera y siendo un fijo con España. Sé los motivos, pero me los guardo. Fue una injusticia lo que hicieron conmigo. Si hubiese seguido Paco o si hubiese estado Juan Ruiz, eso no se hubiese producido. Perdí la ilusión, comencé a estudiar Derecho y una lesión que sufrí cuando me puse a entrenar con el Compaktuna, con rotura de los ligamentos del tobillo, terminó de alejarme ya del deporte profesional", relata.</p>

      <p>Pedro, en cambio, tuvo mayor recorrido, con posterior paso por Soria, Almería o Son Amar, tras su reluciente estreno con el Guaguas, en 1996, y crecimiento inmediato. "No paré de ir para arriba y eso se lo debo a los compañeros, que me empujaron siempre desde una competitividad sana pero absoluta. Cada día era una batalla. Ibas a entrenarte sabiendo que o rayabas la perfección, o te exponías a una humillación. Siendo un juvenil me pedían ser como el más experto. Hoy te meterían en la cárcel por eso. Pero te curtía porque luego, en los partidos, ni notabas la presión. Y el ambiente entre todos era impresionante. Si en un viaje te quedabas dormido en el avión, estabas perdido. Te hacían de todo", expone.</p>

      <p>"Ser canterano y notar el apoyo y aliento de una figura como Paco o de veteranos como Antonio Sánchez, Costa, Miralles, luego Gallis... Era un lujo porque tú no dejabas de ser un niño y crecías protegido por gente consagrada y que te defendía en cada partido. Encima, con el acompañamiento de muchísimos chicos salidos de la base, lo que ya te daba un sentido de la identificación mayor. A ese proyecto de cantera que impulsó y desarrolló Sánchez Jover le doy un valor enorme. Coincido con todos al indicar que su marcha fue el principio del fin porque comenzó a valorarse más al que venía de fuera. Yo mismo tuve que irme porque fuera me daban lo que aquí no. Me causó mucha pena tener que dejar mi casa, el Guaguas".</p>

      <p>Al término de la temporada 2000-2001 clausura un ciclo que guarda "en el corazón" porque, como en el caso de Antonio, "fue una experiencia enriquecedora a más no poder desde el punto de vista deportivo y personal".</p>
    </>
  ),

  "cap10-nichel-gomez": (
    <>
      <DropCap>Lo recuerda con toda precisión. Después de un partido en la competición Intersector ante el Guaguas, en las filas de La Paterna, su barrio de toda la vida, se le acercó Paco Sánchez Jover para proponerle que entrenara en los juveniles del club capitalino. "Yo, que era un chiquillo, hablando con alguien a quien admiraba, al que había visto jugar muchísimas veces, por las guaguas que nos llevaban desde el colegio al Centro Insular con invitaciones para estar en la grada, al que había aplaudido y animado. Y ahí estaba delante de mí... Ni me lo podía creer. Y, como es normal, le dije que estaría encantado, que sí", narra. Así entró Níchel Gómez (Las Palmas de Gran Canaria, 1978) a formar parte de la disciplina del club, de la manera más espontánea y rápida posible.</DropCap>

      <p>Y sin parar de crecer durante su formación hasta su debut, que se produjo en 1998. Primero como receptor, y con el tiempo reconvertido al líbero, Níchel asegura que hasta su marcha, al término de la campaña 2002-03, "los buenos recuerdos son abundantes" y le hacen mirar a ese tiempo "con muchísima felicidad".</p>

      <p>"Compartía vestuario con muchísimos jugadores de la tierra, lo que fue muy importante para todos nosotros, pero, además, teníamos en la plantilla auténticos monstruos. Ya no hablo de Paco Sánchez Jover, que estaba por encima de todos. Me viene a la memoria Venancio Costa y las broncas que me daba. Me decía que si él decía que algo era blanco, era blanco aunque fuese negro y yo lo viese negro. Todo con tal de ayudarme a mí y al resto a crecer. Eran veteranos ejemplares, que lo hacían todo por el bien del grupo, que te protegían pero, al tiempo, no te pasaban una. La exigencia resultaba brutal, a veces agotadora, pero no había otro camino para superarse y hacerse sitio", apunta.</p>

      <EditorialQuote author="Níchel Gómez">Se nos pedía la permanencia, pero logramos subcampeonatos. Incluso ya en la última etapa en el Jusan, con todo en una dinámica muy negativa, nos sobreponíamos siempre y a punto estuvimos de meternos en los play-off.</EditorialQuote>

      <p>"Cumplí un sueño por defender esa camiseta. Miro las fotos de la época y me viene a la mente un grupo muy sano, en el que, pese a las dificultades, todo eran apoyos. Tenía muchísimo mérito sostener al Guaguas con gente de la casa más algunos refuerzos que vinieron de fuera. Dimos todo lo que llevábamos dentro, en mi caso pelea, entrega, intensidad en la pista, aunque, por desgracia, muchas cosas que se nos escapaban a los jugadores terminaron precipitando lo que nadie quería que pasara, que fue la desaparición del Guaguas. Soy de la opinión de que se pudo evitar. Yo terminé en el Compaktuna con Paco y contemplando con mucha tristeza todo lo que pasó. Por fortuna, ahora se ha hecho justicia recuperando un equipo que significa muchísimo tanto para la isla como para el voleibol español. Y espero que haya vuelto para no volverse a ir", se felicita.</p>
    </>
  ),

  "cap10-raul-davila": (
    <>
      <DropCap>Iba para tenista, al ganar el Campeonato de Canarias de su categoría siendo un niño, y, tras obtener una beca para estudiar en Seattle (Estados Unidos), "ya con los billetes comprados", nada le hacía pensar que haría carrera en un deporte, el voleibol, que desconocía "por completo". Pero en el porvenir de Raúl Dávila (Vigo, 1978) se cruzó la figura de Paco Sánchez Jover. "Y eso lo cambió todo", admite. "Un amigo me invitó a unas pruebas de voleibol en Cruz de Piedra. Fui por curiosidad, por matar el rato, sin más pretensión que divertirme. Y algo debía hacer bien porque Paco fue a hablar con mi padre y nos terminó de convencer para que renunciara a irme a América. Ahora se dice fácil, pero fue una decisión muy importante en ese momento. Me hizo enamorarme del voleibol y me quedé por él", apunta.</DropCap>

      <p>Con unas condiciones físicas privilegiadas, 1,95 metros de estatura como carta de presentación siendo un juvenil, forjó sus progresos a la par que los hermanos Cabrera, con los que compartía generación y afinidad ("nos hicimos de la familia", aclara), además de tejer una mentalidad en la que no cabía un paso atrás.</p>

      <p>"Sabíamos el grado de competencia que había en el equipo profesional y todo nos parecía poco para mejorar. Recuerdo llegar a jugar dos partidos en un mismo día en las categorías inferiores del Guaguas y acabar la jornada en el banquillo de la primera plantilla con un encuentro oficial. O quedarme con Pedro Cabrera, una Nochevieja entera, viendo vídeos de otros equipos para aprender. Y en los entrenamientos, dejarme el alma. No tenía ni 18 años y ya había sido internacional júnior. Y con 19 ya estaba en la absoluta. Para mí progresar en el voleibol se convirtió en una obsesión, en una cuestión fundamental", remarca.</p>

      <EditorialQuote author="Raúl Dávila">Fue lo que me transmitieron. Ganar, ganar y ganar. En un mes tuve que aprender porque fue empezar y todo venir a velocidad de vértigo. Guaguas, selecciones... Si pude llegar, si pude evolucionar, fue por el entorno, por ese vestuario en el que nunca había una excusa. Costa, Paco, Pedro, Antonio, Rueda, Robles, Castañeda, Gallis... Ganadores natos y con una cultura del sacrificio y la superación.</EditorialQuote>

      <p>"Siempre me costó medirme en mis reacciones, era demasiado temperamental. Con el voleibol, y en el Guaguas que conocí, aprendí a contenerme, a entender, a madurar", afirma.</p>

      <p>Dávila debutó en 1997 y permaneció en nómina hasta el año 2000. "Fueron campañas irrepetibles en las que la cohesión humana, la fortaleza del grupo, alcanzó unas cotas impensables. Había sentimiento de pertenencia, de equipo con mayúsculas. Merecimos más, en el apartado de los títulos, porque plantamos cara a clubes como el Almería que nos triplicaban en presupuesto. Pero no cambio nada porque me siento partícipe de una época muy especial por el compañerismo y camaradería que no paramos de cultivar", valora.</p>

      <p>Su marcha, rumbo a Alemania, se debió a que no sintió que le valoraban como creía ("al ser de la cantera, como a otros muchos compañeros, no se me tomó en serio cuando así lo exigí") además de subrayar que la salida de Sánchez Jover, en el verano de 1999, "tuvo un efecto demoledor en el proyecto de cantera que se había ido construyendo con mucha paciencia y trabajo en los años anteriores".</p>

      <p>"La salida de Paco fue el principio del fin. Se generó un sentimiento de orfandad en todos nosotros que no se superó, como se comprobó con el paso del tiempo y la marcha sucesiva de mucha gente muy valiosa y de una calidad inmensa. Ahora me alegro que haya vuelto con el nuevo proyecto del Guaguas. Me convenció para jugar en el Compaktuna a sus órdenes y lo considero como una de las personas más importantes de mi vida por todo lo que me ha enseñado y aportado", afirma.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 10: Una transición dolorosa
  // ═══════════════════════════════════════════════
  "capitulo-10": (
    <>
      <DropCap>Los años posteriores a la marcha de Juan Ruiz fueron los más convulsos en la historia del club. La inestabilidad directiva, los problemas económicos y la pérdida progresiva de competitividad culminaron en el peor desenlace posible: la desaparición temporal del equipo en 2009.</DropCap>

      <ContentImage 
        src={imgEquipoLiga} 
        alt="El equipo del CV Guaguas en competición" 
        caption="A pesar de las dificultades, el espíritu del Guaguas nunca se extinguió completamente." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  "cap11-traspaso-poderes": (
    <>
      <DropCap>El 9 de junio de 1998 se produjo el relevo presidencial en el Guaguas. Mario Hugendubel, economista que había estado ligado a la directiva saliente el año anterior, asume el mando de la entidad por la salida de Juan Ruiz, quien ponía fin a su largo y exitoso mandato y que se había prolongado desde 1987. El propio Juan Ruiz bendijo la sucesión al declarar que Hugendubel reunía los requisitos para asumir la responsabilidad de mantener en lo más alto al club que, meses antes, en marzo, había alcanzado su mejor participación en competiciones europeas al participar en la Final Four de la Recopa. "Honestidad, trabajo e ilusión", fue lo que solicitó el histórico dirigente a su heredero. A nivel institucional, cuentas saneadas y un prestigio forjado a base de éxitos deportivos y crecimiento sostenido. Hugendubel, que quiso mantener con él a varios ejecutivos de la anterior cúpula, casos de Ismael Chinea o Marcial Ginory, admitía que recogía un legado reluciente.</DropCap>

      <NewspaperQuote source="Diario de Las Palmas, 13 de junio de 1998">La posibilidad surgió por la amistad que me une con Juan Ruiz. Me lo propuso hace cosa de un año, que necesitaba a alguien que fuera su sucesor y me veía a mí como la persona indicada. Yo en principio no quería hacerle mucho caso, entre otras cosas porque no tenía en mente ser presidente de un club. Me fue involucrando en el tema, me fue dando confianza y al final me decidí. Ha sido una decisión totalmente mía.</NewspaperQuote>

      <p>Y añadía a modo de advertencia: "El listón está altísimo. Deportivamente yo pienso que es muy difícil igualar lo que se ha hecho en los doce últimos años. Ahora nosotros lo que vamos a intentar al máximo es no defraudar a la afición y a Gran Canaria, y vamos a trabajar al máximo para por lo menos intentar conseguir estar entre los tres primeros puestos en la Liga española y hacer un buen papel en Europa".</p>

      <NewspaperQuote source="Canarias7">Nuestra filosofía contempla el apoyo sin límites al trabajo de la cantera, y sus valores tendrán un protagonismo especial como el caso de Raúl Dávila, hoy en día en la selección. Con una buena organización en las categorías infantiles, cadetes y juveniles podemos depender en el futuro de nosotros mismos, sin que tengamos que recurrir al mercado nacional o internacional de jugadores.</NewspaperQuote>

      <p>La temporada 1998-99, la de su estreno en el palco, deja mal sabor de boca. El Guaguas no gana ningún título, tras quedar subcampeón de Liga por detrás del Soria, tampoco resultan relevantes sus prestaciones en la Copa del Rey o en la competición europea, y la primera gran crisis se desata en verano, cuando discrepancias con Paco Sánchez Jover provocan su salida de la entidad, lo que constituyó un serio contratiempo para el proyecto de cantera ya iniciado por él y que, con el tiempo, se desmoronaría ante la ausencia del gran valedor de los chicos de la casa.</p>

      <p>La apuesta de Benjamín Vicedo como su sustituto en el banquillo, auxiliado por un histórico como Antonio Miralles, tampoco funcionó, al igual que una política de fichajes destapada como errónea. Fuera de la lucha por el título y sin clasificarse para competiciones europeas por primera vez desde 1987.</p>

      <p>Los problemas internos comienzan a aflorar con las dimisiones en la junta directiva de Hugendubel de varios miembros, casos de José Rodríguez y Miguel Ángel Hernández, lo que termina derivando en un desgaste hasta entonces desconocido en la historia reciente del Guaguas. Ni la consecución de un nuevo patrocinador (Idecnet) que inyectó más músculo financiero logró impulsar un proyecto que estaba muy lejos de las expectativas. La llegada de David Rodríguez en sustitución de Vicedo, exjugador y con experiencia en la dirección técnica tras ser segundo de Sánchez Jover y estar integrado en la selección, se pensó como un estímulo para reactivar al club. Una medida tan bien intencionada como ineficaz como así se delataría con el paso del tiempo.</p>
    </>
  ),

  "cap11-estabilidad-imposible": (
    <>
      <DropCap>El Guaguas había logrado retener a alguno de sus veteranos más importantes, con Peter Galis y Daniel Castañeda al frente del grupo, pero problemas acrecentados terminarían afectando a la integridad del equipo y sin posibilidad alguna de que se pudieran disimular. Así, en diciembre de 2001 se anuncia un plante de los jugadores por las deudas acumuladas. Los profesionales acordaron no entrenar ni jugar más hasta que se actualizaran sus salarios. La huelga se solucionó días después con el compromiso de pago por parte del presidente, aunque en el ánimo de los jugadores ya pesó este condicionante en el resto de la temporada, lo que motivó una incertidumbre palpable y por todos reconocida. En ninguna de las tres competiciones pudo brillar el Guaguas. Y es que el subcampeonato liguero obtenido, y tan valorado y en las situaciones de adversidad descritas, no bastó para estabilizar los cimientos del representativo.</DropCap>

      <p>En junio, cerrado el curso 2001-02, las noticias negativas se suceden. David Rodríguez decide poner fin a su ciclo como técnico para pasar a funciones como director general, pero ese contratiempo queda minimizado cuando se anuncia que, por la grave situación económica que se atraviesa, no estaba garantizada la inscripción del equipo tanto en la Superliga como en la Copa Confederación Europea. El retraso en el cobro de las subvenciones públicas y las deudas que se mantenían con los jugadores arrojaron un escenario de inquietud que se admitió de manera pública a fin de recabar apoyos y soluciones. Un indicativo más de que la salud financiera de la entidad, además de transitar muy lejos de los balances positivos de etapas anteriores, ya era una amenaza para su porvenir.</p>

      <p>La intervención del ayuntamiento de Las Palmas de Gran Canaria, a través de la concejalía de Deportes encabezada por Felipe Afonso El Jaber, resultó providencial para salvar de manera airosa esta encrucijada. La aportación municipal, con un patrocinio, permitió afrontar el primer plazo de la cuota de inscripción. Una solución eficaz pero transitoria debido a la gravedad de un problema estructural de mayor envergadura.</p>

      <p>Y en un giro de tuerca más, se produce el relevo en la presidencia del Calvo Sotelo, en concreto el 8 de julio de 2002, con José Luis Cano en lugar de Mario Hugendubel, quien, cuatro años después de su entrada, cedía el mando, hastiado, como reconocía, de los discretos resultados deportivos y las cada vez más recurrentes piruetas económicas a cuenta de un déficit que iba en aumento. La apuesta por el banquillo, con David Rodríguez en los despachos, sería Ángel Alonso. Pero David Rodríguez sería despedido en diciembre de ese mismo año por discrepancias con la directiva, lo que acentuaba todavía más una precariedad integral. En unos meses, David Rodríguez regresaría, para mayor retorcimiento.</p>

      <p>Tras otra temporada sin títulos y con eliminación prematura de la competición continental, en junio de 2003 se anuncia el acuerdo con la empresa constructora Jusan Canarias, que sería la denominación del equipo en adelante. El patrocinio era de cinco años y se sumaba al que ya brindaba Guaguas Municipales. "Pasamos de las penurias a poder ilusionar a todos", confesaba Cano al respecto. Es ahí cuando se produce la primera toma de contacto formal de Pedro Cuarental, que sería el siguiente en ser proclamado presidente.</p>

      <p>El Jusan Canarias Las Palmas arrancó el curso 2003-04 con energías renovadas y recurriendo a viejos conocidos como Pedro Cabrera o Joel Sotelo, repescados para liderar una plantilla que completaban José Luis Martell, Fran Carballo, Juan Carlos Parada, Rayco Hernández, Semidán Déniz, Rubén Cano, Níchel Gómez, Igor Hernández y Paulo Carballo.</p>
    </>
  ),

  "cap11-camino-2009": (
    <>
      <DropCap>Con David Rodríguez restituido en el cargo, el grupo humano no paró de crecer, favorecido por la progresiva puesta en escena de Pedro Cuarental quien asumió la presidencia en julio de 2004, aunque desde meses antes ejercía a los mandos tras la renuncia de Cano. En el curso 2003-04 se logra la décima posición y en la 2004-05, ya con jugadores de jerarquía como el brasileño Marcos Dreyer, el balance se resumió en una quinta plaza que daba de nuevo derecho a jugar en Europa al curso siguiente. Una evolución deportiva evidente, que dejaba atrás años más grises e invitaba a todos a soñar con grandes logros en el futuro inmediato. Tanto Cuarental como Rodríguez se prodigaron en los medios de comunicación con optimismo al respecto y tratando de volver a enganchar a una afición que no terminaba de animarse a volver al Centro Insular.</DropCap>

      <p>Desafortunadamente, esa progresión no tuvo cimientos sólidos porque, ya en 2007, comienza a merodear el riesgo de que el club pudiera desaparecer. El presidente así lo advierte, sin ambigüedades, dado que se reconocía un déficit superior a los 280.000 euros con La Caja de Canarias, acreedor que, para asegurarse el cobro de lo adeudado, solicitó el embargo de todas las subvenciones públicas. «Cuando asumí la presidencia hace tres años la deuda era de 300.000 euros, y apenas hemos podido reducirla en trece mil. Sin embargo, nosotros mantenemos predisposición para un pago aplazado, que queremos negociar para diez o doce años. Llevamos más de veinte años trabajando con La Caja y aspiramos a seguir así», dijo el presidente, abierto a una solución que, no obstante, se antojaba complicada sin la intervención de las autoridades políticas.</p>

      <p>De hecho, no dudó en dar libertad a los jugadores para que se buscaran destino ante la gravedad de la situación que amenazaba, igualmente, con llevarse por delante la cadena de filiales, compuesta por más de 350 niños. "Sé que las posibilidades de estar una temporada más en la élite del voleibol son mínimas, pero seguimos trabajando para intentar buscar otras condiciones con La Caja de Canarias y que nos permita hacer frente a la deuda de 300.000 euros. Con las cuentas embargadas por La Caja nos es imposible hacer frente a los compromisos inmediatos del club, su inscripción, y el aval en la Superliga y el primer pago de la deuda, unos 120.000 euros", añadía Cuarental, quien ponía como fecha límite el 22 de junio, al expirar ese día el plazo para la formalización de los pagos para la plaza en la máxima categoría, aunque, finalmente, obtuvo un aplazamiento para ese trámite que era de obligado cumplimiento.</p>

      <p>Jerónimo Saavedra, por entonces alcalde de Las Palmas de Gran Canaria, recogió el guante. El 27 de junio se anunciaba que la corporación municipal capitalina otorgaría una subvención plurianual de cuatro años y sin incrementar la ayuda de los últimos ejercicios económicos para presentar una "toma de razón, que La Caja de Canarias acepta dentro de un plan de pago de la deuda".</p>

      <EditorialQuote author="Roque Díaz, concejal de Deportes">La sabiduría y sensibilidad de Jerónimo Saavedra permitieron encontrar soluciones donde no las había.</EditorialQuote>

      <EditorialQuote author="Roque Díaz">En mi época me tocó gestionar miseria. No teníamos medios, pero tampoco podíamos permitir que un club como el Guaguas se fuera por la borda de esa manera. Así que, como pudimos, poniendo el mayor ingenio y cariño por esos colores que tanto habían significado para la sociedad grancanaria, actuamos. Fue una satisfacción especial lograrlo en base a un acuerdo que era de justicia y no supuso alteración alguna en los dineros públicos.</EditorialQuote>

      <p>Lejos de que el aval consistorial se plasmara en la deseada vuelta a la normalidad, y pese a los esfuerzos de Cuarental en esa dirección, el reloj ya estaba en cuenta atrás.</p>
    </>
  ),

  "cap11-peor-desenlace": (
    <>
      <DropCap>La temporada 2007-08 se inició con el aparente paraguas que daba el respaldo municipal... Pero ya con una plantilla de circunstancias y que no iba a tardar en implosionar por los sempiternos retrasos en los pagos. El opuesto checo Kolacny, el central estadounidense Scheftic y el colocador finlandés Mikula causaron baja en las primeras semanas de competición al no ver cubiertos sus salarios. Y a finales de enero de 2008 fue el entrenador, Álvaro Bourousouzian, quien presentó su renuncia al cargo por idéntico motivo. "Tenemos un mes de retraso en el pago y, además, el plan que nos presentó la entidad contempla más problemas inmediatos, aunque, según nos dice, al final de temporada todo se pondrá al día. Unos podrán esperar y otros no, y en mi caso no", adujo. Días después, ya en febrero, la plantilla, con Samuel Díaz como entrenador, se plantó en protesta por los retrasos en el abono al club de las subvenciones prometidas, lo que ocasionaba una falta de liquidez que ahogaba a los profesionales.</DropCap>

      <NewspaperQuote source="Paulo Carballo, jugador y portavoz de la plantilla">La huelga es para que las instituciones que habían comprometido una subvención hagan el ingreso al club. A los jugadores nos deben dos meses de nómina, y también se debe dinero a entrenadores de la base. No sé por qué, pero parece que hay un trato diferente hacia nosotros por parte de las instituciones.</NewspaperQuote>

      <p>Cuarental cifraba en 120.000 euros lo que se adeudaba al club y apoyaba la medida de presión ejercida por la plantilla. "Tienen toda la razón", esgrimía.</p>

      <p>Los fantasmas de incomparecencias en algunos encuentros fuera de casa terminaron disipándose hasta poder completar, con muchísimas apreturas y esfuerzos, el curso en su integridad, aunque la descomposición saltaba a la vista y el descenso a la Superliga Masculina 2 fue consecuencia irremediable.</p>

      <p>El 19 de agosto de 2008 se hacía oficial el nombramiento de Samuel Díaz como presidente del Jusan Canarias tras la renuncia de Pedro Cuarental luego de cuatro años de mandato. "Estoy contento con el cargo y con ganas de trabajar para que el club salga adelante. Llevo cinco años en el Jusan y en diferentes cargos, desde entrenador de la base hasta técnico del primer equipo. Nuestro trabajo está encaminado a seguir la misma línea de coherencia que mi antecesor en el cargo. Pedro Cuarental hizo un buen trabajo durante los cuatro años que dirigió el club. Metió al equipo en competiciones europeas después de mucho tiempo sin disputarlas. La política económica será de austeridad y nos ajustaremos al presupuesto que tenemos establecido. En lo deportivo queremos reforzar la relación con los equipos de base de la capital y profundizar en el trabajo de cantera que hemos iniciado hace algunos meses", indicaba el nuevo regente como esperanzadora declaración de intenciones. Díaz ya llevaba al mando de la entidad varias semanas y, de hecho, fue él quien pilotó la inscripción federativa del Calvo Sotelo, el 19 de junio de 2008, para competir en la campaña 2008-09 en la Superliga gracias a la cesión de los derechos deportivos del Universidad de Granada.</p>

      <p>Díaz puso al frente de la plantilla a Chema Sánchez, quien inició la que iba a ser la última campaña antes de la desaparición del club con Aarón de la Cruz, Yeray Peña, Sergi Martín, Vicente Gutiérrez, Aday González, Lorenzo Vicente, Leandro Pires, Wilson Pires, Máximo Torcello, Tibo Filo y Eury Almonte como efectivos sobre la pista.</p>

      <p>La temporada se planteó como un reto de supervivencia dadas las condiciones de precariedad. David Rodríguez aceptó volver a integrarse en la estructura de la entidad "para ayudar en lo que hicera falta". Pero más que milagro, lo que se constató fue el final fatal que ya se venía tejiendo desde hacía varios años.</p>

      <p>El 14 de marzo de 2009, tras una derrota en Teruel (3-0), se consumó el descenso a la Superliga 2 del Jusan Canarias y se descartaba de plano la opción, ya utilizada meses atrás, de comprar una plaza en la máxima categoría. "No vamos a jugar en la Superliga, hay que ser realistas y no hipotecar el club. Si no hay nivel para jugar arriba estaremos en la Superliga 2 y seguiremos trabajando para formar un conjunto en condiciones para recuperar la categoría, donde el papel de la cantera debe ser importante", aseguraba el presidente, quien encabezaría, el 29 de abril de ese año, un acto institucional de entrega de insignias de oro y brillantes a varias personalidades de la historia del club, con David Rodríguez entre los elegidos. Sería una de las últimas apariciones públicas de Samuel Díaz como presidente del Calvo Sotelo, cargo del que dimitiría el 2 de junio.</p>

      <EditorialQuote author="David Rodríguez">Con todo el dolor de mi corazón no me quedó otro remedio que gestionar todo el papeleo para liquidar la entidad, ya que se mantenían deudas significativas que podían tener consecuencias legales si no se procedía a la desaparición formal del Calvo Sotelo como club deportivo de voleibol.</EditorialQuote>
    </>
  ),

  "cap11-cronologia": (
    <>
      <Timeline title="Cronología de la transición (2000-2009)">
        <TimelineEvent year="2000">El Guaguas queda fuera de competiciones europeas después de trece años consecutivos estando presente en los distintos torneos continentales.</TimelineEvent>
        <TimelineEvent year="2001">El 23 de octubre se nombra a Juan Ruiz presidente de honor en reconocimiento a su labor y legado. En diciembre se produce una huelga de la plantilla por el retraso en los cobros que termina solucionándose aunque generando un problema que ya sobrevolaría siempre en el entorno del club, pues se realizarían nuevas huelgas en años posteriores por este mismo asunto.</TimelineEvent>
        <TimelineEvent year="2002">Primera intervención del ayuntamiento de Las Palmas de Gran Canaria para evitar que el equipo se quede sin inscribirse en la Superliga para la temporada 2002-03. El 8 de julio se produce un nuevo relevo en la presidencia con la entrada de José Luis Cano por Mario Hugendubel.</TimelineEvent>
        <TimelineEvent year="2003">En junio, entra la empresa Jusan Canarias como patrocinador del club con un contrato de cinco años. Pedro Cuarental, que se convertiría en presidente pocos meses después, es quien posibilita la entrada de este nuevo mecenas.</TimelineEvent>
        <TimelineEvent year="2004">Pedro Cuarental asume la presidencia del club.</TimelineEvent>
        <TimelineEvent year="2005">Bajo la dirección técnica de David Rodríguez, el equipo termina la campaña 2004-05 en una meritoria quinta plaza que da derecho a volver a jugar competición europea.</TimelineEvent>
        <TimelineEvent year="2007">Otra maniobra salvadora del ayuntamiento capitalino para evitar que, por un embargo de La Caja de Canarias, la entidad no ingrese dinero por las subvenciones y pueda afrontar su inscripción federativa.</TimelineEvent>
        <TimelineEvent year="2008">Descenso a la Superliga 2, tras la marcha a mitad de campaña de varios jugadores y del entrenador por las demoras en los cobros, aunque Samuel Díaz, que sería proclamado oficialmente presidente en agosto de ese año, logra la cesión de los derechos del Universidad de Granada para continuar compitiendo en la máxima categoría.</TimelineEvent>
        <TimelineEvent year="2009">Nuevo descenso de categoría, renuncia de Samuel Díaz a la presidencia y liquidación de la entidad después de que la junta gestora encabezada por David Rodríguez no inscribiera al equipo para la siguiente temporada por las deudas existentes y que hacían inviable el proyecto.</TimelineEvent>
      </Timeline>
    </>
  ),

  "cap11-david-rodriguez": (
    <>
      <DropCap>Jugador, preparador físico, coordinador de cantera, segundo entrenador, técnico y presidente. David Rodríguez (Las Palmas de Gran Canaria, 1968) ha dedicado 25 años al Calvo Sotelo en todos los cargos posibles dentro y fuera de la pista, lo que le convierte en un caso único y de obligada referencia en el repaso vital de una entidad que considera "parte fundamental de su vida", dado el largo recorrido que tuvo en la misma así como la disparidad de momentos que, según la época, le tocó vivir en carne propia. "Jugué en un equipo irrepetible, allí me hice hombre, tuve compañeros maravillosos, disfruté en la pista, gané títulos, sentí el cariño de una afición increíble, y adquirí un prestigio como entrenador que me terminó llevando nada más y nada menos que a la selección española. A nivel deportivo, todo fue lo máximo. Pero, por desgracia, a mi vuelta al club, desde la temporada 2000-01, la situación pasó de mala a insostenible, en nada parecido a lo que me tocó vivir anteriormente, hasta el punto de que terminé asumiendo la presidencia para firmar la liquidación del club por la deuda que se tenía y sin solución alguna a la vista. Fue algo que me dolió en el alma pero que tuve que hacer en un gesto de responsabilidad", aclara.</DropCap>

      <p>Educado en el Claret ("y en la primera promoción en la que entrenaban juntos chicos y chicas"), muy pronto sintió David la llamada del voleibol ("como era el más grande, jugaba de central") y, entre entrenamientos en la cancha descubierta de Las Alcaravaneras ("un compañero mío jugaba en el Calvo Sotelo B y me animó a que me ejercitara con ellos") y su perfecta integración a ese grupo para perfeccionar sus habilidades, un día recibió la llamada de Felipe Nuez, incansable captador de talentos y que le invitó a que formara parte del club. Era el inicio de su historia defendiendo una camiseta que lleva "en el corazón".</p>

      <EditorialQuote author="David Rodríguez">Ni me planteaba ser profesional, llegar a la élite... Para nada. Quería divertirme. Pero cuando me quise dar cuenta ya estaba jugando con Camarero, Jorge Ramón, Juanma Martín o Martinovic en la primera campaña en la División de Honor. Yo tenía 17 años y verme en ese vestuario era, sencillamente, una pasada. Un sueño impensable.</EditorialQuote>

      <p>Su vinculación fue tan pronunciada con el Calvo Sotelo que, en su segundo año en la plantilla, Gustavo Rodríguez, su padre, farmacéutico de profesión, decide poner dinero de su bolsillo para financiar dos viajes que, con la situación económica del momento, no se podían sufragar. Un gesto que valora al enfatizar que "fue con el único ánimo de echar una mano en un momento muy crítico y en el que se corría el riesgo de ser descalificados" por incomparecencia. "Se puso al frente de una junta gestora de emergencia y luego continuó como vicepresidente con Juan Ruiz. Aportó su granito de arena cuando nadie quería hacerlo", pondera.</p>

      <p>El crecimiento imparable de las potencialidades del equipo lo sitúa en la llegada, al unísono, de Paco Sánchez Jover, Antonio Miralles y Venancio Acosta en 1987, a su juicio, "un salto de calidad definitivo" y que puso los cimientos de todos los éxitos posteriores. "Recuerdo el tercer puesto en la Copa del Rey en Palma, ganando la final de consolación al Cisneros, que ya era algo que pocos pensaban. O el título que se nos escapó en casa frente al Palma y que, pese a todo, la afición se quedó animando una vez acabado el partido. Te dabas cuenta de que algo grande venía en camino. Pero traer a Paco ya era el fichaje de los fichajes, un mensaje al resto. Inevitable que comenzaran a caer los títulos. La primera Copa, la Liga ante el Bomberos...".</p>

      <p>Quiere tener un recuerdo especial con un jugador foráneo al que no le acompañó la suerte, al caer lesionado nada más llegar y no poder desplegar su juego: el sueco Lars Nilsson, fichado en 1991. Y lo razona: "Teníamos un grupo de nacionales top y, de fuera, llegaron Martinovic, Chava, Golec, Klos, Sharma, Nalazek... Un nivel brutal en los entrenamientos, muchas veces superior al de los partidos. Pero Nilsson nos enseñó a serenarnos, a encontrar el punto exacto de equilibrio, a medir bien los tiempos. Lo valoré mucho en su momento porque, repito, ese Guaguas era una fuerza de la naturaleza, por talento y empuje, y, a veces, convenía esa pausa que beneficiaba la competitividad".</p>

      <EditorialQuote author="David Rodríguez">La primera Copa, que era el título que inauguraba nuestro palmarés, fue lo nunca visto. Antes, durante y después del partido. Luego vinieron más Copas, las Ligas, jugar por Europa, ser los mejores... Pero la primera vez queda para siempre y la realzo. Fue el cimiento de una etapa impresionante. ¿El dinero? Eran fichas para escapar. No te ibas a hacer rico jugando en el Guaguas. Ni siquiera los extranjeros, que eran los mejor pagados. Pero, en mi caso, ni eso me importaba. Ya era un privilegio estar ahí.</EditorialQuote>

      <p>El rol de los canarios, de los jugadores de la casa en esa pléyade de estrellas, es descrito así por uno de los representantes de la escuela isleña: "Camarero tenía una clase tremenda y lo catalogo dentro de los mejores de la plantilla y del país. Los chicos de la casa sabíamos que no podíamos fallar cuando nos daban minutos. Golec e Ire (Klos) te ponían el listón en las nubes. Entrabas y la presión de no equivocarte te empujaba. Creo que, dentro de un Guaguas insuperable, los canteranos dimos lo que teníamos que dar".</p>

      <p>Sin descuidar sus estudios, cursando la carrera de Educación Física mientras jugaba, y también obteniendo el nivel 2 de entrenador, que le capacitaba para dirigir en categoría regional (el nivel 1 lo sacaría en 1995), sin saberlo, David Rodríguez ya encaminaba sus pasos al banquillo. "Felipe Nuez fue quien me metió esa motivación, fue un gran ejemplo para mí siempre. Y eso me vino muy bien porque en 1992, con Quique Edelstein como técnico, sentí que había llegado el momento de dejarlo, pese a tener 27 años. Fueron circunstancias concretas: falta de protagonismo, cierta incomodidad por algunas decisiones que adoptó y que, dentro del respeto que me merecían, no eran compartidas... Era joven, me llamaron del Gáldar, pero estaba decidido a irme y dedicarme a mi titulación académica hasta que Juan Ruiz me ofreció llevar la estructura de filiales. Por así decirlo, éramos un gigante con pies de barro, sin una base, todo centrado en el equipo sénior. Y me ilusionó. Formamos un regional, un juvenil, un cadete y un infantil. Y, al mismo tiempo, era segundo entrenador y preparador físico con Juanma Martín".</p>

      <p>"Al final tuve que fijar mi atención y fuerzas en el equipo profesional, que te exigía todo. Seguían llegando los títulos, se mantenía la excelencia de las temporadas anteriores. Y cuando Juanma regresa a las canchas y Sánchez Jover asume el mando, me mantengo con él. Fueron años, hasta 1998, en los que aprendí muchísimo. A Paco lo considero un maestro. Me hizo crecer y ver el voleibol de una manera única. Por algo fue un jugador de leyenda y un entrenador como pocos por su inteligencia y manera de dirigir", agrega.</p>

      <p>En 1997 recibe una llamada del dirigente Luis Buchaga que le cambia la vida: ser técnico asistente y preparador físico de la selección española, ciclo que dura hasta el 2000 ("una experiencia única"), cuando el presidente Mario Hugendubel le propone sustituir a Benjamín Vicedo como entrenador del Guaguas. Sería su primera vez con máximo rango en la banda del equipo de su vida: "No nos fue nada mal esa primera temporada 2001-02. Quedamos subcampeones de Liga, con gente de la casa y el refuerzo de los checos, y en Europa también hicimos un papel muy digno".</p>

      <EditorialQuote author="David Rodríguez">2001-2002 ya fue un curso duro. Recuerdo pagar de mi bolsillo hoteles para que durmiera el equipo en algunos desplazamientos porque en el club ya comenzaban los apuros. Me retiro del banquillo para poder preparar un plan de viabilidad y fichamos como técnico a Ángel Alonso, que tampoco funciona. Regreso al banquillo, jugamos los play-off... Pero ya todo va de mal en peor. En la campaña 2002-2003 ya competimos solo con canarios más Joel Sotelo, que regresó para ayudarnos con su experiencia. Pero se mantuvo la caída en picado hasta que en 2007 la pelota se nos hizo más grande que el club, nos sobrepasó la situación.</EditorialQuote>

      <p>Renuncié, se fue Pedro Cuarental, entró otro presidente... Y en 2009 se organiza un acto de homenaje en el que me dan la insignia de oro y brillantes, con la colaboración del Cabildo, con Óscar Hernández como consejero, y el ayuntamiento de Las Palmas de Gran Canaria, siendo concejal de Deportes Roque Díaz. También estuvo presente don José Millán. Fue en el Centro Insular y antecedió a la firma de la liquidación porque la deuda con La Caja de Canarias era inasumible. Recuerdo que el periodista Isidro Quintana me preguntó que si aquello escenificaba el acto de defunción de la entidad. Era la única manera de dejar el club a cero, por decirlo de alguna manera, y aunque fuese algo muy doloroso. Desde 2006 el lastre no había hecho más que crecer y crecer. Tuve que firmar como presidente. Fue un rato durísimo que no se lo deseo a nadie", zanja conmovido.</p>

      <p>El renacer de la entidad con el regreso de viejos conocidos de su primera etapa como Camarero, Juan Ruiz, Felipe Nuez o Sánchez Jover le parece "una magnífica noticia" y más por la ilusión que están generando con sus títulos y nueva trayectoria exitosa.</p>
    </>
  ),

  "cap11-joel-sotelo": (
    <>
      <DropCap>Cuatro temporadas como jugador (1995-1998 y 2003-2004), otra como entrenador de la cantera, tres títulos oficiales (2 Copas del Rey y 1 Supercopa de España) y el reconocimiento y afecto unánime del Centro Insular, que siempre rindió pleitesía a un jugador que adoptó como propio desde que llegó y en el que reconoció tanto sus virtudes técnicas como valores humanos. La figura de Joel Sotelo (Ciudad de México, 1970) sigue intacta y vigente cuando toca repasar la nómina de grandes extranjeros que han pasado por el Guaguas. Y él corresponde a semejante estatus con su pasión característica: "Fue el sueño de mi vida, el equipo en el que me consagré, el ciclo que guardo dentro de mi corazón como algo privilegiado, como lo mejor que puedo contar cuando hablo a mi familia y amigos del voleibol". En un palmarés como el suyo, plagado de laureles en el vóley playa, con participaciones en circuitos nacionales y mundiales, más el corolario de los Juegos Olímpicos de Sídney 2000, no resulta gratuita esta jerarquización tan rotunda.</DropCap>

      <EditorialQuote author="Joel Sotelo">Llegué al Guaguas después de varios años en España y cuando en el Cisneros había alcanzado mi máximo nivel. Ese verano, el de 1995, me proclamé, junto a Camarero, campeón de España de vóley-playa y él fue quien habló con Juan Ruiz al intuir que un jugador de mis características podía venirle bien al Guaguas. Cuando Juan me llamó, ni me lo pensé. Era llegar al que, en mi opinión, era el mejor club de España. Y al fichar me encuentro con los Klos, Golec, Miralles, Rueda, Camarero, Sharma y un entrenador como Paco Sánchez Jover. Un impacto. Impresionante.</EditorialQuote>

      <p>Desde sus inicios "todo funciona a las mil maravillas", pues se conjunta con la base a la que se suma y aporta al Guaguas "riqueza táctica", al jugar "como central, receptor y opuesto", dada su facilidad para reciclarse en los planes del técnico. "Lo que quería era ser útil, jugar, disfrutar. Por encima de todo, mi gran capacidad de trabajo era la tarjeta de presentación que ponía por delante de todo. Con una humildad tremenda. Eso creo que me permitió ser un jugador de rendimiento y prestaciones. Así me lo hicieron ver siempre. Me entregaba al máximo y sabía asumir la presión en las distintas tareas que me encomendaban".</p>

      <EditorialQuote author="Joel Sotelo">La final de 1996 ante el Soria fue tremenda y, además de llevarnos el trofeo, salí elegido como MVP. Ha sido uno de los días más felices de mi vida. Me sentí pleno y completo. Salir campeón con los compañeros y tener, además, esa satisfacción añadida de que te distingan como el mejor cuando en la pista había figuras de una categoría enorme.</EditorialQuote>

      <p>"Si ya estaba en el Guaguas a tope y en cuerpo y alma, ese primer título terminó de darme más moral y cuerda para las dos campañas siguientes. Falasca, Robles, Costa... Seguía creciendo la competencia y yo mantenía mis buenas sensaciones. Nos quedó la lástima de no ganar alguna Liga en esa fase porque creo que debió de ser nuestra. También fue dolorosa aquella Final Four de la Recopa en Cuneo y después de aquella clasificación espectacular ganando 3-0 al Lennick con la afición de diez. Esperábamos rematarlo con el título europeo y no fue posible. Pero no puedo poner un reparo a esa etapa. Fui feliz, fuimos felices. Disfrutamos. Un lujo", considera.</p>

      <p>No imaginaba entonces que cinco años después regresaría por una llamada de su amigo David Rodríguez, entonces entrenador del denominado Jusan Canarias: "Había hecho dos años muy buenos en el Arona y no pude negarme. Pedro Cuarental, al que le estoy muy agradecido por su comportamiento conmigo, me habló de construir, de que aportara mi experiencia a los jóvenes, de que ayudara con todo mi saber del deporte. Me pareció una propuesta insuperable y, lo admito, desde el punto de vista afectivo me cautivó".</p>

      <EditorialQuote author="Joel Sotelo">Fue un año diferente a los anteriores porque el equipo no tenía la pretensión de ganar títulos. Quedamos en una meritoria séptima plaza y me quedó el mal sabor de boca de que una lesión en el gemelo se me complicó y, lo que nunca me había pasado, estuve mucho tiempo fuera sin poder jugar. Era como un león enjaulado. David me tuvo que parar los pies porque quería entrar aunque estuviese cojo. Me comían las ganas. Era insoportable no poder ayudar a mis compañeros.</EditorialQuote>

      <p>El club le propuso seguir integrado en su organigrama de cantera como entrenador y le agradeció, con un emotivo acto en el Centro Insular y la entrega de una placa, su ejemplo profesional en sus años de pertenencia a la entidad.</p>

      <EditorialQuote author="Joel Sotelo">Pasé más de 20 años en Canarias y dos de mis tres hijas nacieron en Gran Canaria. Salí campeón con el Guaguas. El Centro Insular fue el escenario de mis sueños, con Sergio Miguel Camarero tengo una relación familiar de todo lo que hemos compartido, a Juan Ruiz lo tengo como una de las personas más importantes de mi vida por darme la oportunidad de jugar en ese equipo maravilloso. No hay un día en el que no me salga a la mente un recuerdo del Guaguas y de esa etapa tan fantástica.</EditorialQuote>
    </>
  ),

  "cap11-pedro-cuarental": (
    <>
      <DropCap>Le tocó gestionar en una coyuntura "delicadísima", en su propio calificativo, a inicios del siglo XXI y cuando acudió, de manera voluntaria, al auxilio de un Guaguas "que no tenía dinero ni para inscribirse" ante la ausencia de patrocinios. Corría 2003 y Pedro Cuarental (Las Palmas de Gran Canaria, 1975), en tiempos jugador de la casa en categorías inferiores ("milité en cadete y juvenil y siempre mantuve mi afición por el voleibol"), fue alertado por parte de un amigo ("Rayco Hernández", precisa) de que el riesgo de desaparición era casi una realidad. "Era el director comercial de Jusan, una empresa constructora, y propuse que nos convirtiéramos en patrocinador principal. José Luis Cano era el presidente cuando entramos y ya me proponen a mí asumir el control porque el mandatario que estaba no tenía ganas de continuar. Al principio estuve al frente de una junta gestora y, luego ya, de pleno derecho en el cargo más alto".</DropCap>

      <p>De ejercer de salvavidas "sin propósito alguno de entrar ni en la directiva", Cuarental termina encabezando un club "con un grave desajuste económico" por la póliza de crédito suscrita con La Caja de Canarias y que acaba absorbiendo "el cien por cien de los ingresos", lo que ahogaba la economía y hacía inviable cualquier intento de normalización en la vida financiera del club.</p>

      <EditorialQuote author="Pedro Cuarental">Desde el inicio me propuse reducir la deuda contraída y se hizo una labor muy importante en cuanto a la captación de patrocinadores privados. Eso nos permitió tener cierto margen, cumplir con las nóminas de los jugadores de manera regular, con algún retraso lógico, pero siendo todos los profesionales conscientes de la situación. Hay que recordar que una buena parte de nuestro presupuesto se iba directo a cubrir la póliza y era un condicionante enorme. La deuda era de unos 300.000 euros y, con todo, la reducción de la misma no fue significativa por los intereses generados. Pero lo fuimos salvando y creo que logramos mantener una competitividad impensable para los dineros que manejábamos, con una política de fichajes muy austera pero certera. No podíamos equivocarnos. No había margen para ello. Pongo en valor el trabajo de David Rodríguez y de Antonio Miralles, además del de las diferentes plantillas por su comprensión y paciencia.</EditorialQuote>

      <p>En este sentido, destaca como hitos deportivos en esa transición marcada por las estrecheces económicas, terminar una campaña "invictos en casa y terceros del campeonato" así como participar en competiciones europeas. "No me cansaré de resaltar el valor que tuvo mantenerse en pie y con esa dignidad durante años en los que atravesamos un desierto. Había días en los que se hacía muy complicado todo. Nunca pensé que la entidad fuese a desaparecer. Directamente es que ni tenía tiempo en ponerme en lo peor porque cada día había que solventar muchos problemas. Y siempre, cada campaña, pendiente de que llegara febrero, cuando se ejecutaban las subvenciones públicas, que cabe recordar que siempre llegan tarde, para ganar oxígeno y tiempo", añade.</p>

      <p>Una llamada tan inesperada como providencial termina procurándole la solución en junio de 2007, cuando se anuncia que el ayuntamiento de Las Palmas de Gran Canaria, a través del Instituto Municipal de Deportes, con Roque Díaz al frente, otorgaba una ayuda plurianual que, dentro de un plan de pagos, La Caja aceptaba como "una toma de razón".</p>

      <EditorialQuote author="Pedro Cuarental">Tuve que hacer un llamamiento público de auxilio y Roque Díaz me llamó, me citó en su despacho y encontró la vía para desenredar toda la maraña que nos asfixiaba. Fue un acuerdo muy ventajoso y que, además, era el único posible para que la Obra Social de La Caja tuviera un menor impacto en nuestra economía. Porque en nuestros balances había superávit pero, siempre, con esta póliza, los números se descuadraban. Fue un respiro.</EditorialQuote>

      <p>Cuarental se mantuvo en el cargo hasta el verano de 2008 y durante esa última campaña tuvo que lidiar ante numerosas incidencias que terminaron dinamitando la estabilidad interna como la dimisión, nada más comenzar la campaña de David Rodríguez, la posterior de Álvaro Bourousouzian, su sustituto en el banquillo tras apenas cuatro meses en el cargo o una huelga de jugadores, en febrero de 2008, que él mismo apoyó al entender sus reivindicaciones en materia de cobros pendientes.</p>

      <p>Más de cuatro años en la presidencia en los que puso "el mayor esmero posible en ordenar la vida económica" de un Calvo Sotelo que terminaría desapareciendo meses después pese a que se hizo oficial su relevo en la cúpula en favor de Samuel Díaz, que había ejercido anteriormente como entrenador.</p>
    </>
  ),

  "cap11-marcos-dreyer": (
    <>
      <DropCap>Tres años, los que van de mayo de 2004 al mismo mes de 2007, duró la estancia del brasileño Marcos Dreyer (Teresópolis, 1971) en la etapa en la que el equipo se denominó Jusán Canarias. Pero por implicación, rendimiento y compromiso es resaltado como una figura capital en el proceso de transición que se vivió en aquella época. Tanto David Rodríguez, que fue su entrenador, como Pedro Cuarental, entonces presidente, le señalan como el líder del vestuario y distinguido siempre "por velar por el club y mantener el equilibrio en momentos en los que eso era muy complicado". Nadie dudó en cuestionar su rol de capitán y dejó honda huella por su manera de entender el deporte, basada siempre "en la honestidad, sacrificio y máxima profesionalidad", tal y como él mismo describe.</DropCap>

      <p>Dreyer llegó procedente del Elche, donde había ganado una Copa del Rey, y dibujaba, antes, una amplia trayectoria internacional, bagaje que puso "al servicio" de los compañeros con el fin de "tratar de hacer las cosas lo mejor posible". Tenía muy claro que el camino a seguir pasaba "por ser exigentes día a día, en cada entrenamiento y en cada partido" y su afán radicó en ese perfeccionismo que nunca rebajó.</p>

      <EditorialQuote author="Marcos Dreyer">Vine a Gran Canaria siendo un veterano y empujado, además, por la idea de formar una familia con mi mujer, que también jugaba al vóley. Fue un proyecto para mí en el que se mezclaba lo profesional y lo personal, por lo que me lo tomé con toda la intensidad del mundo. Encontré un grupo sano y joven en el que pude ayudar desde mis vivencias, siempre con la mejor voluntad. Me impliqué incluso en los fichajes, ayudando a traer a compañeros que conocía y a los que convencí para que se unieran al Jusan, como Renato Adornelas. Todo lo que hiciera me parecía poco para el bien de la institución. Me tomé con naturalidad ese liderazgo porque siempre ha sido así durante mi carrera. No supuso esfuerzo alguno por mi parte porque es algo que llevo dentro, que desarrollo allá donde estoy.</EditorialQuote>

      <p>Referente dentro y fuera de la pista, su intermediación cuando los pagos a los profesionales se dilataban también reunió un valor trascendental porque a ese ámbito llegó igualmente su influencia, recomendando en el vestuario "paciencia y confianza" en los esfuerzos que hacía la directiva. Él predicó con el ejemplo renovando en 2005 pese a que disponía de ofertas que le eran más ventajosas desde el punto de vista económico. "No dudé en quedarme porque sentía que era necesario aquí y que debía seguir. No me lo pensé. Era lo adecuado", confiesa.</p>

      <EditorialQuote author="Marcos Dreyer">Ningún jugador profesional vive al día de su sueldo. Por supuesto que juegas para ganar dinero, pero cuando ves que en el club hacen todo lo que pueden y tienen problemas, debes ayudar, colaborar, ser receptivo. Y eso es lo que hablaba yo con los chicos. Todos apoyaron y creo que colaboramos en hacer más llevadera alguna etapa en la que las dificultades económicas fueron más importantes. Era fundamental que nos mantuviésemos unidos, que el grupo no se rompiera, que se aguantara en lo posible. Creo que lo conseguimos.</EditorialQuote>

      <p>Y ese espíritu gremial permitió al Jusan que el lideró "superar las expectativas" y ofrecer un tono competitivo "mucho mejor del que se podía esperar", superando, por ejemplo, a un Tenerife "con mejor presupuesto y medios" que los que se disponían en la entidad grancanaria.</p>

      <EditorialQuote author="Marcos Dreyer">Hicimos las cosas bien en España y en Europa. Recuerdo un partido en Turquía ante el Halbank como uno de los mejores que completé. Pienso que defendimos bien el honor de un club que lo había sido todo en el voleibol y que, durante esos años, tuvo que asumir otra realidad y con menos posibilidades. Pero tuvimos nuestro orgullo y, por mi manera de entender el deporte, de vivir el voleibol, quise siempre transmitir a los compañeros que teníamos que tirar para adelante como fuera. Fue un orgullo comprobar que, ganáramos o perdiéramos, siempre dábamos todo. Por mi parte, nada me dejé dentro. Puse lo que tenía como jugador y como persona para el club y estoy muy agradecido a la gente que confió en mí, tanto David Rodríguez como Pedro Cuarental, además de los jugadores con los que tuve el honor de formar el equipo.</EditorialQuote>

      <p>En una etapa profesional posterior, ya en el Vecindario, coincidió con una de las leyendas del mejor Guaguas, Paco Sánchez Jover, circunstancia que considera "un privilegio" al tiempo que le permite sacar una reflexión explícita: "Siempre me consideré un monstruo competitivo por querer ganar, entrenar y jugar más y mejor cada día. Pero Paco, para mí, es un dinosaurio competitivo. Su manera de interpretar y conocer el vóley es algo que me produce admiración. Cuando le conocí comprendí que hay gente que siempre estará muy por encima de ti y Paco es uno de ellos".</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 11: Títulos para una gran historia
  // ═══════════════════════════════════════════════
  "capitulo-11": (
    <>
      <DropCap>El palmarés del CV Guaguas es el más brillante del voleibol español. Nueve Ligas, nueve Copas del Rey, cinco Supercopas y una Copa Ibérica conforman un historial de éxitos que ningún otro club del país ha igualado.</DropCap>

      <ContentImage 
        src={imgVictoriaGuaguas} 
        alt="El CV Guaguas celebra un título" 
        caption="La celebración de los títulos ha sido una constante en la historia del club amarillo." 
        fullWidth 
      />

      <ContentImage 
        src={imgPartidoGuaguas} 
        alt="Ambiente en un partido del CV Guaguas" 
        caption="El Centro Insular de Deportes y el Gran Canaria Arena han sido testigos de las gestas del club." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 12: Vuelve el gran Guaguas
  // ═══════════════════════════════════════════════
  "capitulo-12": (
    <>
      <DropCap>En 2020, cuando el club se encontraba de nuevo al borde del abismo, Juan Ruiz regresó para devolver al Guaguas a la élite. Su vuelta fue recibida con esperanza y emoción por una afición que no había olvidado los años gloriosos.</DropCap>

      <ContentImage 
        src={imgRemateGuaguas} 
        alt="Remate del CV Guaguas en un partido de Superliga" 
        caption="El regreso del Guaguas a los títulos confirmó que la leyenda no había terminado." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 13: Del CID al Arenas
  // ═══════════════════════════════════════════════
  "capitulo-13": (
    <>
      <DropCap>Del Centro Insular de Deportes al Gran Canaria Arena: la evolución de la casa del voleibol grancanario. El CID fue durante décadas la catedral del voleibol en Canarias, un pabellón cuyo ambiente era temido por todos los rivales.</DropCap>

      <ContentImage 
        src={imgBannerEntradas} 
        alt="Cartelería de partidos del CV Guaguas en el Gran Canaria Arena" 
        caption="El Gran Canaria Arena acoge hoy los grandes eventos del voleibol canario." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 14: Los nuevos ídolos
  // ═══════════════════════════════════════════════
  "capitulo-14": (
    <>
      <DropCap>Una nueva generación de estrellas ha tomado el relevo en el Gran Canaria Arena. Los nuevos ídolos del Guaguas combinan talento internacional con la pasión local para escribir nuevos capítulos en la historia del club.</DropCap>

      <ContentImage 
        src={imgWallaSouza} 
        alt="Walla Souza, opuesto del CV Guaguas" 
        caption="Walla Souza, uno de los jugadores más determinantes del Guaguas actual." 
      />

      <ContentImage 
        src={imgAugustoPerfil} 
        alt="Augusto Colito, internacional español del CV Guaguas" 
        caption="Augusto Colito, internacional español y pilar del proyecto deportivo del Guaguas." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 15: El impacto del escudo
  // ═══════════════════════════════════════════════
  "capitulo-15": (
    <>
      <DropCap>El escudo del CV Guaguas es mucho más que un símbolo deportivo. Representa la identidad de un club que ha trascendido el voleibol para convertirse en un referente cultural de Gran Canaria y del deporte canario.</DropCap>

      <ContentImage 
        src={imgJugadorAccion} 
        alt="Jugador del CV Guaguas en acción" 
        caption="El escudo del Guaguas, presente en cada camiseta que viste un jugador que sale a la cancha a defender los colores amarillos." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 16: La directiva y el futuro que viene
  // ═══════════════════════════════════════════════
  "capitulo-16": (
    <>
      <DropCap>Detrás de cada título y cada logro deportivo hay una estructura directiva que ha trabajado incansablemente por el bien del club. Desde los fundadores del Calvo Sotelo hasta la actual junta directiva, la gestión del Guaguas ha sido un ejemplo de compromiso y sacrificio.</DropCap>

      <ContentImage 
        src={imgEquipoLiga} 
        alt="El equipo y cuerpo técnico del CV Guaguas" 
        caption="La directiva y el cuerpo técnico, piezas fundamentales del engranaje del Guaguas." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 17: Más honores
  // ═══════════════════════════════════════════════
  "capitulo-17": (
    <>
      <DropCap>Más allá de los títulos oficiales, el CV Guaguas ha recibido numerosos reconocimientos institucionales y deportivos que avalan su trayectoria como uno de los clubes más importantes del deporte canario.</DropCap>

      <ContentImage 
        src={imgNicoBruno} 
        alt="Reconocimientos del CV Guaguas" 
        caption="Los honores institucionales reconocen la contribución del Guaguas al deporte y la sociedad canaria." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 19: Empleados y técnicos
  // ═══════════════════════════════════════════════
  "capitulo-19": (
    <>
      <DropCap>Un club no funciona solo con jugadores. Detrás de cada partido, cada entrenamiento y cada evento hay un equipo de profesionales que hace posible la maquinaria del CV Guaguas: empleados, técnicos, fisioterapeutas, utilleros y tantos otros nombres sin los cuales nada sería posible.</DropCap>

      <ContentImage 
        src={imgIoDeAmo} 
        alt="Io De Amo, colocador del CV Guaguas" 
        caption="Io De Amo, uno de los jugadores del plantel actual bajo la dirección técnica de Sergio Miguel Camarero." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 20: La plantilla del cincuentenario
  // ═══════════════════════════════════════════════
  "capitulo-20": (
    <>
      <DropCap>La temporada 2025-2026 marca el cincuentenario del Club Voleibol Guaguas. Una plantilla competitiva en cuatro frentes —Liga, Copa, Supercopa y Champions League— escribe las últimas líneas de esta historia de medio siglo de pasión por el voleibol.</DropCap>

      <ContentImage 
        src={imgEquipoChampions} 
        alt="La plantilla del CV Guaguas en la temporada del cincuentenario" 
        caption="La plantilla del cincuentenario, competitiva en todas las competiciones nacionales y europeas." 
        fullWidth 
      />

      <ContentImage 
        src={imgJorgeAlmansa} 
        alt="Jorge Almansa, capitán del CV Guaguas" 
        caption="Jorge Almansa, capitán y símbolo de una generación que honra el legado del club." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 22: Miguel Ángel Ramírez
  // ═══════════════════════════════════════════════
  "capitulo-22": (
    <>
      <DropCap>Miguel Ángel Ramírez, presidente de la UD Las Palmas, ha sido una figura clave en el apoyo institucional al CV Guaguas. Su visión del deporte como motor de la sociedad canaria ha permitido que el club cuente con los recursos necesarios para competir al máximo nivel.</DropCap>

      <ContentImage 
        src={imgDobromirSaque} 
        alt="El CV Guaguas en competición" 
        caption="El apoyo institucional ha sido fundamental para mantener la competitividad del club a nivel nacional y europeo." 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 23: A la vanguardia de la tecnología
  // ═══════════════════════════════════════════════
  "capitulo-23": (
    <>
      <DropCap>El CV Guaguas ha sido pionero en la comunicación digital dentro del deporte español. Su presencia en redes sociales, la producción de contenidos audiovisuales y la cobertura periodística propia han creado un modelo de referencia para otros clubes.</DropCap>

      <ContentImage 
        src={imgBannerEntradas} 
        alt="Comunicación digital del CV Guaguas" 
        caption="La comunicación digital del Guaguas conecta al club con su afición en todos los rincones del mundo." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 24: Socios y abonados
  // ═══════════════════════════════════════════════
  "capitulo-24": (
    <>
      <DropCap>La afición del Guaguas es el motor del club. Desde aquellos primeros espectadores en el patio del colegio hasta los miles de abonados que llenan el Gran Canaria Arena, los socios han sido el alma del proyecto deportivo más exitoso del voleibol español.</DropCap>

      <ContentImage 
        src={imgPartidoGuaguas} 
        alt="La afición del CV Guaguas en el Gran Canaria Arena" 
        caption="La marea amarilla, incondicional con su equipo en cada partido, en cada competición." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
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
  "cap12-copa-1989": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-1990": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-1991": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-1991": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-1992": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-1992": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-1993": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-1993": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-1994": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-1996": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-supercopa-1994": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-1997": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-2021": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-2021": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-supercopa-2021": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-2023": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-iberica-2023": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-supercopa-2023": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-2024": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-2024": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-supercopa-2024": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-copa-2025": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-liga-2025": (<p>Contenido del capítulo próximamente.</p>),
  "cap12-supercopa-2025": (<p>Contenido del capítulo próximamente.</p>),

  // ═══════════════════════════════════════════════
  // NEW: Nuevos ídolos adicionales (Cap 14 children)
  // ═══════════════════════════════════════════════
  "cap15-alejandro-fernandez": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-guilherme-hage": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-jorge-almansa": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-matt-knigge": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-paulo-renan": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-paolo-zonca": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-martin-ramos": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-io-de-amo": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-nico-bruno": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-unai-larranaga": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-walla-souza": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-jean-pascal": (<p>Contenido del subcapítulo próximamente.</p>),
  "cap15-osmany-juantorena": (<p>Contenido del subcapítulo próximamente.</p>),

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
