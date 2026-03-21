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
      <p><strong>Fernando Clavijo</strong>, presidente del Gobierno de Canarias.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-antonio-morales": (
    <>
      <p><strong>Antonio Morales</strong>, presidente del Cabildo de Gran Canaria.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-juan-ruiz": (
    <>
      <p><strong>Juan Ruiz</strong>, presidente del CV Guaguas.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-poli-suarez": (
    <>
      <p><strong>Poli Suárez</strong>, consejero de Deportes del Gobierno de Canarias.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-aridany-romero": (
    <>
      <p><strong>Aridany Romero</strong>, consejero de Deportes del Cabildo de Gran Canaria.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-carolina-darias": (
    <>
      <p><strong>Carolina Darias</strong>, alcaldesa de Las Palmas de Gran Canaria.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-roberto-melian": (
    <>
      <p><strong>Roberto Melián</strong>, presidente de la Federación Canaria de Voleibol.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
  ),
  "prologo-jorge-almansa": (
    <>
      <p><strong>Jorge Almansa</strong>, capitán del CV Guaguas.</p>
      <p>Texto del prólogo pendiente de redacción.</p>
    </>
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
  // Player profiles for Chapter 2
  // ═══════════════════════════════════════════════
  "cap02-felipe-nuez": (
    <PlayerProfile name="Felipe Nuez">
      <DropCap>Felipe Nuez (Moya, 1956) es la figura fundamental y maestra en la vida del club. Presente desde el mismo inicio de la actividad escolar que se dedicó al voleibol con especial ahínco, llegó como profesor en prácticas al colegio Calvo Sotelo en 1973 sin saber que, junto a otros precursores, iniciaría una historia de superación y éxitos que todavía perdura y que es, también, orgullo del deporte canario.</DropCap>

      <p>
        "Como todos los chicos de la época, empecé en el fútbol. Pero Giráldez me dijo que me veía condiciones mejores para el voleibol y le hice caso. Lo disfruté más en la faceta de entrenador, aunque hice alguna vez de árbitro y asumí otras responsabilidades. Como jugador no destacaba especialmente en nada y supe darme cuenta para volcarme en lo que siempre me gustó", incide.
      </p>

      <p>
        "Fui autodidacta. Obtuve el título de entrenador nacional con 20 años y, en 1984, el de técnico internacional. En esos años de los comienzos, la única manera de ampliar conocimientos en el voleibol era explorando métodos de trabajo en otros países, como Japón, que era una potencia inalcanzable por su nivel de desarrollo."
      </p>

      <EditorialQuote>
        "Entrenara a cadetes, juveniles o séniors. El trabajo, el compromiso y el sacrificio eran para mí innegociables. De lo contrario, prefería quedarme en mi casa."
      </EditorialQuote>
    </PlayerProfile>
  ),

  "cap02-isidro-quintana": (
    <PlayerProfile name="Isidro Quintana">
      <DropCap>A Isidro Quintana (Las Palmas de Gran Canaria, 1957) le metieron el voleibol en su vida "por obligación", como reconoce, porque, integrado en la sección de baloncesto de la UD Las Palmas durante su adolescencia ("llegué a jugar contra Domingo Díaz, que luego ha sido lo que ha sido"), iba para pívot con su imponente estatura en plena pubertad.</DropCap>

      <p>
        "Pero se me cruzó en el camino Silvestre Cabrera, que me daba clases en los Salesianos, y me dijo, medio en serio, medio en broma, que o hacía voleibol o me suspendía. Me convenció prometiéndome que me llevaría directamente a la selección júnior. Empecé y ya no lo dejé. Fue mi interés que me saqué la titulación nacional de entrenador con 17 o 18 años para tener una formación más amplia y poder dirigir equipos."
      </p>

      <p>
        Para mí es el rey, la persona clave. No se entiende el Guaguas sin Juan Ruiz y creo que no se entiende Juan Ruiz sin el Guaguas. Apostó por traer extranjeros, por ir a por los mejores jugadores que había en los rivales. Era la única manera de hacer un proyecto ganador.
      </p>
    </PlayerProfile>
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
  "capitulo-02-01": (
    <>
      <ArticleBlock number="1º">El nombre que adoptará la nueva entidad será el de Club Voleibol Calvo Sotelo.</ArticleBlock>
      <ArticleBlock number="2º">El objeto de la presente entidad es el fomento y práctica del deporte entre los asociados y, en especial, el Voleibol.</ArticleBlock>
      <ArticleBlock number="3º">Podrá asimismo la presente entidad ampliar sus funciones deportivas con otras secciones secundarias, recreativas o de otros deportes, siempre que lo acuerden la junta directiva.</ArticleBlock>
      <ArticleBlock number="4º">La entidad, que con todos sus socios y componentes quedan sujetos a la jurisdicción de la Delegación Nacional de Deportes, Comité Olímpico Español, Federación Española de Voleibol.</ArticleBlock>
      <ArticleBlock number="5º">Se fija el domicilio de la entidad en Las Palmas, calle Montejurra, número 1.</ArticleBlock>
      <ArticleBlock number="6º">La duración de la entidad es por tiempo indefinido.</ArticleBlock>
    </>
  ),

  "capitulo-02-02": (
    <>
      <ArticleBlock number="7º">La entidad Club Voleibol Calvo Sotelo se compondrá de las siguientes clases de socios: de HONOR y ACTIVOS.</ArticleBlock>
      <ArticleBlock number="8º">Todos los socios, sea cual fuese su categoría, tendrán el libre acceso a los locales y campos de la entidad.</ArticleBlock>
      <ArticleBlock number="9º">Todo socio viene obligado a comunicar por escrito a la directiva las deficiencias que observe en las instalaciones.</ArticleBlock>
      <ArticleBlock number="10º">De acuerdo con las asambleas, la junta directiva impondrá una cuota de entrada a los socios, según las necesidades de la entidad.</ArticleBlock>
      <ArticleBlock number="11º">Podrá nombrarse presidente de la entidad a quien por su relevante personalidad y especiales condiciones sea propuesto y elegido.</ArticleBlock>
    </>
  ),

  "capitulo-02-03": (
    <>
      <ArticleBlock number="20º">La entidad estará dirigida, regida y administrada de conformidad con los presentes estatutos por la junta directiva.</ArticleBlock>
      <ArticleBlock number="21º">La junta directiva se compondrá: presidente, uno o dos vicepresidentes, secretario, tesorero contador y el número de vocales que se estime conveniente.</ArticleBlock>
      <ArticleBlock number="23º">El presidente convocará junta directiva todas las veces que estime necesario y, al menos, una vez cada mes.</ArticleBlock>
      <ArticleBlock number="24º">Los acuerdos de la junta directiva se tomarán por mayoría de votación, teniendo cada componente un voto y, en caso de empate, decidirá el voto del presidente.</ArticleBlock>
      <ArticleBlock number="25º">El presidente tendrá la representación legal y jurídica de la entidad, dirigirá los debates y discusiones y velará para que se cumplan los acuerdos.</ArticleBlock>
    </>
  ),

  "capitulo-02-04": (
    <>
      <ArticleBlock number="44º">De conformidad con los artículos 27 y 28 de los presentes estatutos, llevarán la administración y contabilidad de la entidad el tesorero y contador.</ArticleBlock>
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
    <PlayerProfile name="José Miguel Santana">
      <DropCap>José Miguel Santana fue una pieza fundamental en la construcción del Calvo Sotelo durante sus primeros años de existencia. Su compromiso con el proyecto y su entrega en la pista le convirtieron en uno de los referentes del equipo en la época de los ascensos y la consolidación en las categorías nacionales.</DropCap>
      <p>
        Como parte del grupo de jugadores que creció bajo la tutela de Felipe Nuez, Santana encarnó los valores de sacrificio y superación que definieron al club desde sus orígenes en el patio del colegio de Las Rehoyas.
      </p>
    </PlayerProfile>
  ),

  "cap02-florencio-tejera": (
    <PlayerProfile name="Florencio Tejera">
      <DropCap>Florencio Tejera perteneció al núcleo de jugadores y entrenadores que dieron forma al Calvo Sotelo en su etapa formativa. Además de su aportación como jugador, asumió funciones de entrenador en las categorías inferiores, contribuyendo a la formación de nuevos talentos que alimentarían el crecimiento del club.</DropCap>
      <p>
        Su polivalencia y entrega fueron características de una generación de deportistas que lo dieron todo por un proyecto nacido en la humildad de un colegio de barrio y que terminaría alcanzando la cima del voleibol español.
      </p>
    </PlayerProfile>
  ),

  "cap02-tony-vazquez": (
    <PlayerProfile name="Tony Vázquez">
      <DropCap>Tony Vázquez formó con Pericles una línea de recepción formidable que fue seña de identidad del Calvo Sotelo durante varios años. Su talento y constancia le convirtieron en uno de los jugadores más destacados de la formación que protagonizó los ascensos y la llegada a la máxima categoría del voleibol español.</DropCap>
      <p>
        Vázquez también contribuyó como entrenador en las categorías femeninas del club, demostrando un compromiso integral con la entidad que iba más allá de su rol como jugador.
      </p>
    </PlayerProfile>
  ),

  "cap02-pericles": (
    <PlayerProfile name="Pericles" subtitle="Pedro Román Rosario">
      <DropCap>Un pelo abundante y la barba que le daba aires intelectuales le valieron el apodo, Pericles, con el que se incrustaría, por derecho propio, en el listado de imprescindibles del Calvo Sotelo. "Me dijeron, medio en serio medio en broma, que me parecía a Pericles. No me lo tomé mal y así me quedé", admite. Pedro Román Rosario (Las Palmas de Gran Canaria, 1958) no fue uno más. Durante muchos años capitán y guía del resto, añadió a sus grandes dotes para el voleibol una lección de compromiso y entrega de impresión, ya que, pese a su condición de asmático, perteneció durante largo periplo al equipo y con un rendimiento ejemplar.</DropCap>

      <EditorialQuote>
        "Salía a la cancha con mi Ventolín para poder resistir los esfuerzos. En los tiempos muertos y descansos casi prefería el fuelle que me daba el medicamento al agua. Y alguna vez me pincharon por las asfixias que me entraban."
      </EditorialQuote>

      <p>
        Pericles comenzó a jugar en el colegio Santa Catalina ("sobre un patio de tierra y piedras") y, antes de definir sus pasos, probó en el balonmano y el fútbol. "Cuando Felipe Nuez me llamó para formar parte del equipo absoluto del Calvo Sotelo ahí ya me dije que quería el futuro dentro del voleibol porque me gustaba, se me daba bien."
      </p>

      <p>
        "Me tomo como un halago el respeto y las muestras de cariño que siempre me dieron todos los compañeros. Nunca me consideré más o mejor que nadie. Pero en lo que sí era muy estricto era en el sentido de la justicia y en pedir a todos que dieran lo que llevaban dentro en beneficio del equipo. Porque yo, con mi asma, me dejaba la vida por cada pelota, me tiraba a todas, peleaba cada punto, iba al límite. Y si yo podía, los demás no tenían excusa."
      </p>

      <p>
        "Hicimos de todo para lograr medios económicos y, por ejemplo, poder realizar viajes. Felipe Nuez y yo nos turnábamos como conductores para desplazar al resto. Si no había guagua, ya sabíamos lo que nos tocaba. Cádiz-Cáceres, por ejemplo, del tirón y en las carreteras de antes. Yo conducía y, al día siguiente, a jugar."
      </p>

      <p>
        "Mi etapa llegó hasta el inicio de la temporada 1986-87, justo con la llegada de Ivo Martinovic. Desde 1977, que se dice pronto. En ese momento sentí que no estaba capacitado para dar el nivel que requería un equipo ya con los mejores de España. Decidí irme. Creía que había dado lo mejor que tenía, que mis servicios al Calvo Sotelo se habían completado llevando al equipo desde abajo a la máxima categoría."
      </p>
    </PlayerProfile>
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
