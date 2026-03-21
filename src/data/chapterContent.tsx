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
    <PlayerProfile name="José Millán">
      <DropCap>Si la figura de Silvestre Cabrera fue de trascendencia capital para auspiciar el voleibol durante su mandato como presidente de la Federación de Las Palmas (1973-1985), no es menos relevante la influencia, también de enorme impacto, de José Millán, quien en diciembre de 1976 asume el cargo de secretario del ente presidido por Cabrera, toma su relevo a la conclusión de su ciclo como máximo mandatario y termina encabezando la Federación Canaria de Voleibol hasta 2008.</DropCap>

      <p>
        Millán (Sevilla, 1933) es otro de los testigos que vivió, desde los inicios hasta su desarrollo, pasando por la eclosión de los títulos, la vida del Calvo Sotelo, una entidad a la que reconoce tener "mucho cariño y respeto" por la contribución que hizo en la historia del deporte en Canarias.
      </p>

      <EditorialQuote>
        "Hay que valorar lo que hicieron, saliendo de un colegio y con muy pocos medios. Fueron superándose, nunca se rindieron ante las dificultades."
      </EditorialQuote>
    </PlayerProfile>
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
  // El proyecto visionario de Juan Ruiz (subcapítulo de Cap. 4)
  // ═══════════════════════════════════════════════
  "cap04-proyecto-juan-ruiz": (
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
    <PlayerProfile name="Miriam Quiroga">
      <DropCap>Miriam Quiroga, licenciada en Educación Física y profesora universitaria, publicó en el año 2010 el libro 'Génesis y evolución del voleibol en Gran Canaria 1934-1978', editado por el Servicio de Publicaciones de la Universidad de Las Palmas de Gran Canaria, en el que se incluye amplia documentación escrita y gráfica del nacimiento y desarrollo del Club Voleibol Calvo Sotelo.</DropCap>

      <SectionHeader>Contribución del Calvo Sotelo y técnicos pioneros</SectionHeader>

      <p>
        "La contribución del Colegio Nacional Calvo Sotelo y de técnicos pioneros como Francisco Rodríguez Álvarez, Miguel Nieves Toledo, Félix Rodríguez Delgado y Felipe Nuez Domínguez es fundamental en el desarrollo del voleibol en Gran Canaria. En dicho colegio, el curso 1968-69, imparte docencia Francisco Rodríguez Álvarez, quien introduce este deporte en el centro. La semilla del voleibol fue sembrada, a nivel escolar, por Francisco Rodríguez Álvarez y por otro maestro nacional, Miguel Nieves Toledo."
      </p>

      <SectionHeader>El legado de aquella época irrepetible</SectionHeader>

      <EditorialQuote>
        "Todos los momentos vividos en la historia del Club Voleibol Calvo Sotelo constituyen un valioso legado para el deporte canario. Pero, sobre todo, queda la constatación de que si se hace un buen trabajo, tanto desde el punto de vista deportivo como organizativo, se consiguen excelentes resultados, tanto a nivel nacional como internacional."
      </EditorialQuote>
    </PlayerProfile>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 1: Iconos y estrellas del Guaguas (COMPLETO)
  // ═══════════════════════════════════════════════
  "capitulo-04": (
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

  "cap05-camarero": (
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

  "cap05-sanchez-jover": (
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

  "cap05-golec": (
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

  "cap05-klos": (
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
  // CAPÍTULO 1: Ignacio Brito y Tributo a los Salesianos
  // ═══════════════════════════════════════════════
  "capitulo-05": (
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
  // CAPÍTULO 1: Marek
  // ═══════════════════════════════════════════════
  "capitulo-06": (
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
  // CAPÍTULO 1: Embajadores por Europa
  // ═══════════════════════════════════════════════
  "capitulo-07": (
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
  // CAPÍTULO 1: Relevo generacional
  // ═══════════════════════════════════════════════
  "capitulo-08": (
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
  // CAPÍTULO 1: Una transición dolorosa
  // ═══════════════════════════════════════════════
  "capitulo-09": (
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

  // ═══════════════════════════════════════════════
  // CAPÍTULO 1: Todos los títulos
  // ═══════════════════════════════════════════════
  "capitulo-10": (
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
  // CAPÍTULO 1: Vuelve el gran Guaguas
  // ═══════════════════════════════════════════════
  "capitulo-11": (
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
  // CAPÍTULO 1: Del CID al Arenas
  // ═══════════════════════════════════════════════
  "capitulo-12": (
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
  // CAPÍTULO 1: Los nuevos ídolos
  // ═══════════════════════════════════════════════
  "capitulo-13": (
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
  // CAPÍTULO 1: El impacto del escudo
  // ═══════════════════════════════════════════════
  "capitulo-14": (
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
  // CAPÍTULO 1: La directiva
  // ═══════════════════════════════════════════════
  "capitulo-15": (
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
  // CAPÍTULO 1: El Guaguas que viene
  // ═══════════════════════════════════════════════
  "capitulo-16": (
    <>
      <DropCap>El futuro del Guaguas se construye en la cantera. Los equipos de categorías inferiores trabajan cada día para formar a los jugadores que, algún día, defenderán los colores amarillos en la máxima competición.</DropCap>

      <ContentImage 
        src={imgNicoBruno} 
        alt="Jóvenes promesas del CV Guaguas" 
        caption="La apuesta por la cantera es una seña de identidad del club desde sus orígenes en el Calvo Sotelo." 
        fullWidth 
      />

      <p>Contenido pendiente de importación del documento original.</p>
    </>
  ),

  // ═══════════════════════════════════════════════
  // CAPÍTULO 1: Empleados y técnicos
  // ═══════════════════════════════════════════════
  "capitulo-17": (
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
  // CAPÍTULO 1: La plantilla del cincuentenario
  // ═══════════════════════════════════════════════
  "capitulo-18": (
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
  // CAPÍTULO 1: Miguel Ángel Ramírez
  // ═══════════════════════════════════════════════
  "capitulo-19": (
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
  // CAPÍTULO 1: Comunicación digital
  // ═══════════════════════════════════════════════
  "capitulo-20": (
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
  // CAPÍTULO 1: Socios y abonados
  // ═══════════════════════════════════════════════
  "capitulo-21": (
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
  // CAPÍTULO 1: Empresarios de la tierra
  // ═══════════════════════════════════════════════
  "capitulo-22": (
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

};
