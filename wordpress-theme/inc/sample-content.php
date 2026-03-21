<?php
/**
 * Contenido completo para el libro CV Guaguas
 * Se ejecuta al activar el tema - crea los 23 capítulos con todo su contenido,
 * configuración de heroes e imágenes.
 *
 * @package CV_Guaguas_Libro
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Importar contenido de capítulos al activar el tema
 */
function libro_import_sample_content() {
    $existing = get_posts(array(
        'post_type' => 'capitulo',
        'posts_per_page' => 1,
        'post_status' => 'any',
    ));
    
    if (!empty($existing)) {
        return;
    }
    
    $capitulos = libro_get_sample_chapters();
    $parent_ids = array(); // Track parent IDs for children
    
    foreach ($capitulos as $cap) {
        // Resolve parent
        $parent_id = 0;
        if (!empty($cap['parent_ref']) && isset($parent_ids[$cap['parent_ref']])) {
            $parent_id = $parent_ids[$cap['parent_ref']];
        }
        
        $post_data = array(
            'post_title'   => $cap['title'],
            'post_content' => $cap['content'],
            'post_status'  => 'publish',
            'post_type'    => 'capitulo',
            'menu_order'   => $cap['order'],
            'post_parent'  => $parent_id,
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id)) {
            // Save subtitle
            if (!empty($cap['subtitulo'])) {
                update_post_meta($post_id, '_subtitulo', $cap['subtitulo']);
            }
            
            // Save chapter number
            if (!empty($cap['numero'])) {
                update_post_meta($post_id, '_numero_capitulo', $cap['numero']);
            }
            
            // Save marker visibility
            update_post_meta($post_id, '_mostrar_marcador', isset($cap['show_marker']) ? ($cap['show_marker'] ? '1' : '0') : '1');
            
            // Save hero configuration
            if (!empty($cap['hero'])) {
                $hero = $cap['hero'];
                update_post_meta($post_id, '_hero_enabled', '1');
                if (!empty($hero['image'])) update_post_meta($post_id, '_hero_image', $hero['image']);
                if (!empty($hero['height'])) update_post_meta($post_id, '_hero_height', $hero['height']);
                if (!empty($hero['overlay'])) update_post_meta($post_id, '_hero_overlay', $hero['overlay']);
                if (!empty($hero['icon'])) update_post_meta($post_id, '_hero_icon', $hero['icon']);
                if (!empty($hero['icon_color'])) update_post_meta($post_id, '_hero_icon_color', $hero['icon_color']);
                if (!empty($hero['custom_icon'])) update_post_meta($post_id, '_hero_custom_icon', $hero['custom_icon']);
                if (!empty($hero['custom_icon_color'])) update_post_meta($post_id, '_hero_custom_icon_color', $hero['custom_icon_color']);
                if (!empty($hero['icon_width'])) update_post_meta($post_id, '_hero_icon_width', $hero['icon_width']);
                if (!empty($hero['icon_height'])) update_post_meta($post_id, '_hero_icon_height', $hero['icon_height']);
                if (!empty($hero['alignment'])) update_post_meta($post_id, '_hero_alignment', $hero['alignment']);
                if (!empty($hero['vertical'])) update_post_meta($post_id, '_hero_vertical', $hero['vertical']);
                if (!empty($hero['border_color'])) update_post_meta($post_id, '_hero_border_color', $hero['border_color']);
                if (!empty($hero['title_lines'])) update_post_meta($post_id, '_hero_title_lines', $hero['title_lines']);
            }
            
            // Track ID for children
            if (!empty($cap['ref_id'])) {
                $parent_ids[$cap['ref_id']] = $post_id;
            }
        }
    }
    
    add_action('admin_notices', function() {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><strong>¡Libro CV Guaguas importado!</strong> Se han creado todos los capítulos con su contenido, héroes e imágenes. <a href="<?php echo admin_url('edit.php?post_type=capitulo'); ?>">Ver capítulos</a>.</p>
        </div>
        <?php
    });
}
add_action('after_switch_theme', 'libro_import_sample_content');

/**
 * Helper: Build image URL from theme assets
 */
function libro_img($path) {
    return LIBRO_URI . '/assets/images/' . $path;
}

/**
 * Helper: Build hero title line
 */
function libro_hero_line($text, $color = '#FFFFFF', $highlight = '', $font_weight = 'black') {
    $line = array(
        'text' => $text,
        'color' => $color,
        'font_weight' => $font_weight,
    );
    if ($highlight) {
        $line['use_highlight'] = '1';
        $line['highlight'] = $highlight;
    }
    return $line;
}

/**
 * All chapters with full content and hero configuration
 */
function libro_get_sample_chapters() {
    $img = 'libro_img';
    $star = libro_img('star-gold.png');
    
    return array(

    // ═══════════════════════════════════════════════
    // CAPÍTULO 0: PRÓLOGOS (PADRE)
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Prólogos',
        'numero' => '0',
        'order' => 1,
        'show_marker' => true,
        'ref_id' => 'prologos',
        'hero' => array(
            'image' => libro_img('hero-stadium.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.88)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '400px',
            'title_lines' => array(
                libro_hero_line('PRÓLOGOS', '#D4AF37'),
            ),
        ),
        'content' => '
<p>Este capítulo reúne las palabras de las personalidades más destacadas del ámbito deportivo, político e institucional que han acompañado al CV Guaguas en su extraordinaria trayectoria. Sus testimonios reflejan el impacto del club en la sociedad canaria y en el voleibol español.</p>

[imagen_contenido src="' . libro_img('content/equipo-champions.jpg') . '" alt="El CV Guaguas en competición europea" caption="El CV Guaguas, embajador del voleibol canario en las competiciones europeas." fullwidth="true"]

[cita_editorial]"Más que un club, una familia. Más que voleibol, pasión por nuestra tierra."[/cita_editorial]
',
    ),

    // Prólogos individuales (hijos) — orden idéntico a React chaptersStructure.ts
    array('title' => 'Fernando Clavijo', 'numero' => '', 'order' => 2, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente del Gobierno de Canarias',
        'content' => '<p><strong>Fernando Clavijo</strong>, presidente del Gobierno de Canarias.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Antonio Morales', 'numero' => '', 'order' => 3, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente del Cabildo de Gran Canaria',
        'content' => '<p><strong>Antonio Morales</strong>, presidente del Cabildo de Gran Canaria.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Juan Ruiz', 'numero' => '', 'order' => 4, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente del CV Guaguas',
        'content' => '<p><strong>Juan Ruiz</strong>, presidente del CV Guaguas.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Poli Suárez', 'numero' => '', 'order' => 5, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Consejero de Deportes del Gobierno de Canarias',
        'content' => '<p><strong>Poli Suárez</strong>, consejero de Deportes del Gobierno de Canarias.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Aridany Romero', 'numero' => '', 'order' => 6, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Consejero de Deportes del Cabildo de Gran Canaria',
        'content' => '<p><strong>Aridany Romero</strong>, consejero de Deportes del Cabildo de Gran Canaria.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Carolina Darias', 'numero' => '', 'order' => 7, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Alcaldesa de Las Palmas de Gran Canaria',
        'content' => '<p><strong>Carolina Darias</strong>, alcaldesa de Las Palmas de Gran Canaria.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Roberto Melián', 'numero' => '', 'order' => 8, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente de la Federación Canaria de Voleibol',
        'content' => '<p><strong>Roberto Melián</strong>, presidente de la Federación Canaria de Voleibol.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Jorge Almansa', 'numero' => '', 'order' => 9, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Capitán del CV Guaguas',
        'content' => '<p><strong>Jorge Almansa</strong>, capitán del CV Guaguas.</p><p>Texto del prólogo pendiente de redacción.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 01: DEL PATIO DEL COLEGIO
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Del patio del colegio a División de Honor',
        'numero' => '01',
        'order' => 12,
        'show_marker' => true,
        'ref_id' => 'cap01',
        'hero' => array(
            'image' => libro_img('hero-patio-colegio.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.82)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(
                libro_hero_line('DEL PATIO', '#1a237e', '#FFFFFF'),
                libro_hero_line('DEL COLEGIO', '#1a237e', '#FFFFFF'),
                libro_hero_line('A LA DIVISIÓN', '#1a237e', '#FFFFFF'),
                libro_hero_line('DE HONOR', '#1a237e', '#FFFFFF'),
            ),
        ),
        'content' => '
[seccion_header]Las horas extraescolares con Francisco Rodríguez[/seccion_header]

[capitular]Antes que el club fue el colegio. Porque el Calvo Sotelo nació del centro educativo del mismo nombre que se inauguró para el curso escolar 1967-68 en el barrio de Las Rehoyas, en la época punto de convergencia de la zona alta de Las Palmas de Gran Canaria y con familias de extracción social y economías precarias. "Gentes muy humildes, pero no necesariamente problemáticas. Se veían situaciones complicadas por la calle, no se puede negar. Pero de mi experiencia como maestro en el trato con padres y alumnos guardo un gran recuerdo por los esfuerzos y sacrificios que hacían para que los niños completaran su educación. No había medios materiales, pero sobraba el orgullo y la capacidad de superación", rememora Felipe Nuez, quien desembarcó en esta escuela para desarrollar sus prácticas de magisterio sin saber que allí enraizaría y forjaría una leyenda deportiva que nadie podía esperar.[/capitular]

<p>Con todo, y según ha dejado documentado Miriam Quiroga en su libro \'Génesis y evolución del voleibol en Gran Canaria 1934/78\', las primeras influencias para introducir el juego del voleibol en el Calvo Sotelo corresponden a Francisco Rodríguez, profesor que, de manera experimental, fomenta su práctica en las horas extraescolares. La aceptación de su propuesta lúdica es inmediata, lo que permite crear, de modo informal, los primeros equipos para competir de manera interna y, con el tiempo, concurrir a competencias de ámbito local.</p>

<p>A la espera de que cale en categoría masculina, donde su introducción es más paulatina, las niñas toman la bandera y es la sección femenina la que inicia los pasos del Calvo Sotelo en los primeros torneos rivalizando con otros equipos. Y con resultados de impresión. Así, en los III Juegos Escolares Femeninos de la Enseñanza General Básica (EGB), correspondientes al curso 1971-72, el equipo infantil del Colegio Nacional Calvo Sotelo se impone a nivel provincial y regional, desplazándose en junio de 1972 hasta Málaga para disputar la fase final en la que se proclama campeón de España.</p>

[imagen_contenido src="' . libro_img('content/copa-del-rey.jpg') . '" alt="Jugadores del Calvo Sotelo en sus primeros años de competición" caption="Los primeros años del Calvo Sotelo en competición federada marcaron el inicio de una leyenda."]

[seccion_header]Silvestre Cabrera y el salto cualitativo[/seccion_header]

<p>Un acontecimiento externo va a suponer el definitivo impulso para el desarrollo y crecimiento de la disciplina, tanto en el propio Calvo Sotelo como en los otros caladeros de la cantera grancanaria de mitad de los setenta: la llegada a la presidencia de la Federación de Las Palmas de Voleibol de Silvestre Cabrera, a instancias de Manuel Hernández, director técnico de la Federación Española y que permite recuperar el voleibol federado en la provincia de Las Palmas. Cabrera, que era instructor de Educación Física y profesor del Instituto de Enseñanza Media de Escaleritas, toma posesión de su cargo el 19 de septiembre de 1973.</p>

[cita_prensa source="Diario de Las Palmas, 26 de septiembre de 1973"]"El voleibol ya dejó de ser un deporte minoritario para convertirse en algo tremendamente atractivo. No es un deporte de patios o de recreos, aunque la labor escolar, que en este aspecto lleva la Delegación de la Juventud, es muy importante. Sus campañas están dando al voleibol el lugar que le corresponde."[/cita_prensa]

[seccion_header]La selección cadete con Felipe Nuez como germen[/seccion_header]

<p>La temporada 1974-75, ya con los primeros resultados de la gestión de Cabrera al frente del voleibol provincial, resulta crucial en el desarrollo del Calvo Sotelo, pues se materializa la creación de la selección cadete de Las Palmas, que estará a cargo de Felipe Nuez. "Nuestra intención es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional", añadía, a modo de premonición, el técnico. De esta selección cadete saldría la base del primer Calvo Sotelo masculino, que, en esa misma campaña, debutaría en competición federada: el Campeonato Provincial de Segunda División Masculino.</p>

[imagen_contenido src="' . libro_img('content/partido-guaguas.jpg') . '" alt="Partido de voleibol en el Centro Insular de Deportes" caption="El Centro Insular de Deportes se convirtió en la casa del voleibol grancanario." fullwidth="true"]

[seccion_header]Estatutos fundacionales y despegue[/seccion_header]

<p>En noviembre de 1976, concretamente el día 6, se redactan los estatutos de fundación del Club Voleibol Calvo Sotelo, lo que ya supone, formalmente, el avance que se demandaba para que el proyecto deportivo se oficializara a todos los niveles y adquiriera una consistencia definitiva, como así se demostraría con el transcurso de los años posteriores. Fue el punto de partida que permitía ir del deporte escolar propiamente dicho, y que había sustentado la naturaleza del Calvo Sotelo, al integrado en la competición federada.</p>

[seccion_header]El ascenso a Segunda División de 1979[/seccion_header]

<p>Lo que había quedado pendiente del año anterior, el ascenso a Segunda División, sí se materializó en 1979, en la fase decisiva que se libró en Málaga los días 9, 10 y 11 de marzo. En su primer partido, ganó con autoridad al Málaga por 3-0 (17-15, 15-10 y 15-4), luego se impuso por 3-1 al Dos Hermanas de Sevilla y completó la fase previa con otro triunfo, esta vez ante el Jaén y por 3-0. Y en la gran final disputada en el turno vespertino del domingo 11 de marzo, y de nuevo frente al Dos Hermanas, se consumó el gran éxito con un 3-0 (15-12, 15-11 y 15-2) para la historia.</p>

[seccion_header]El acceso a la élite y su conflicto burocrático[/seccion_header]

<p>Es en la temporada 1983-84 cuando se va a producir un conflicto burocrático ("una cacicada federativa", según Felipe Nuez) que impidió el sueño de estar entre los mejores del país. En marzo de 1984 tomó parte de la fase de ascenso a la División de Honor que se celebró en Valladolid. La tercera plaza obtenida, que en principio tenía un valor testimonial, terminó adquiriendo una importancia capital al renunciar el Son Amar balear a su plaza en la máxima categoría.</p>

<p>Sin embargo, los clubes de la División de Honor se opusieron a una ampliación de la misma aludiendo a factores económicos. El asunto llegó a la Audiencia Nacional en octubre de 1984. Finalmente, todos los esfuerzos quedarían desestimados.</p>

<p>Así, la temporada 1984-85 arranca condicionada por este frente. Vuelta a empezar con un equipo de nuevo llamado a aspirar a la élite y cuya principal novedad estuvo en Sergio Miguel Camarero, un prometedor juvenil de 17 años llamado, con el tiempo, a ser parte del escudo. El Lucky Calvo Sotelo competiría finalmente en la División de Honor tras una posterior ampliación a doce equipos aprobada por la Federación Española el 17 de mayo de 1985.</p>
',
    ),

    // Cap 02 children
    array('title' => 'Felipe Nuez', 'numero' => '', 'order' => 13, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[perfil_jugador nombre="Felipe Nuez"]
[capitular]Felipe Nuez (Moya, 1956) es la figura fundamental y maestra en la vida del club. Presente desde el mismo inicio de la actividad escolar que se dedicó al voleibol con especial ahínco, llegó como profesor en prácticas al colegio Calvo Sotelo en 1973 sin saber que, junto a otros precursores, iniciaría una historia de superación y éxitos que todavía perdura y que es, también, orgullo del deporte canario.[/capitular]

<p>"Como todos los chicos de la época, empecé en el fútbol. Pero Giráldez me dijo que me veía condiciones mejores para el voleibol y le hice caso. Lo disfruté más en la faceta de entrenador, aunque hice alguna vez de árbitro y asumí otras responsabilidades. Como jugador no destacaba especialmente en nada y supe darme cuenta para volcarme en lo que siempre me gustó", incide.</p>

<p>"Fui autodidacta. Obtuve el título de entrenador nacional con 20 años y, en 1984, el de técnico internacional. En esos años de los comienzos, la única manera de ampliar conocimientos en el voleibol era explorando métodos de trabajo en otros países, como Japón, que era una potencia inalcanzable por su nivel de desarrollo."</p>

[cita_editorial]"Entrenara a cadetes, juveniles o séniors. El trabajo, el compromiso y el sacrificio eran para mí innegociables. De lo contrario, prefería quedarme en mi casa."[/cita_editorial]
[/perfil_jugador]
'),
    array('title' => 'José Miguel Santana', 'numero' => '', 'order' => 14, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Descubridor de Sergio Miguel Camarero "por un tirón de orejas" ("siendo un niño me robaba los balones que caían fuera de la cancha y terminé recomendándole que se pusiera a jugar, como así haría y no le fue nada mal"), fue testigo y partícipe de un fichaje de leyenda como resultó ser Paco Sánchez Jover, a mitad de los ochenta y en un hotel del Puerto de Santa María durante un Preeuropeo ("convencí al recepcionista para estar en la habitación de al lado para que, cuando hubo que negociar, pudiese colarse por el balcón y que nadie lo viera") y actor impulsor, desde la tribuna de prensa, del fortalecimiento del proyecto justo en la etapa anterior a la gloria de los títulos. Pero antes, mucho antes, José Miguel Santana (Las Palmas de Gran Canaria, 1958) también se significó por jugar un papel activo en los inicios del Calvo Sotelo, entusiasta como siempre fue del voleibol tras pasar por las aulas del Alonso Quesada, en las que era deporte predominante y predilecto. Fichado del Santa Teresa al término de la temporada 1976-77, donde ejercía como entrenador y tras una llamada de Felipe Nuez para que se hiciera cargo del juvenil B masculino y femenino, Santana también hizo una contribución altruista y entusiasta que le procura un sitio privilegiado en la historia.[/capitular]

<p>"Fueron años increíbles que uno recuerda con mucha emoción. Éramos jóvenes, atrevidos, soñábamos con todo y el voleibol fue el vehículo para cumplir con esas ilusiones. Lo hicimos desde la base de un compañerismo ejemplar. Nunca me cansaré de repetir que más que un club, éramos un grupo de amigos, una familia. Todos los jugadores de los equipos nos juntábamos en la cancha y, también, en el tiempo libre. Aquellas meriendas en la casa de Mendaño con bocadillos y botellas de refresco y nos daban las tantas, el tiempo volaba. Era una manera de vivir intensa, sana y que a todos nos dio valores y un patrón de conducta impecable", subraya.</p>

<p>Hace un encendido elogio de varias figuras que considera "capitales" en el surgimiento y desarrollo del Calvo Sotelo, tales como Paco Rodríguez ("el que inició todo"), Guillermo Gil o Miguel Nieves ("también fundamentales con su trabajo e ideas") o Felipe Nuez ("el entrenador de entrenadores en el voleibol canario") y no escatima admiración por el comportamiento de los jugadores, "ejemplos de nobleza, afán de superación y lealtad".</p>

<p>"Eran hombres siendo niños. Lo digo porque, siendo juveniles, exhibían una madurez y concentración propia de adultos. Eso fue lo que inculcó Felipe. El juego y la competición. Debían ir unidos. De ahí los entrenamientos con una intensidad brutal. Era una gozada entrenar a esos chicos y chicas que se tomaban cada sesión o cada partido con una disciplina intachable. Entre todos se aconsejaban, querían ser los mejores, se ayudaban, eran una piña al grito de \'cis\', la C de Calvo y la S de Sotelo que decían en voz alta antes de empezar un partido como conjura. Y tener el apoyo del colegio, de los padres, era el respaldo ideal para continuar con esa obra que no paró de crecer", argumenta.</p>

<p>Habla de sacrificio porque no fueron pocas las veces en las que tuvo que poner de su bolsillo el dinero para sufragar el agua de sus jugadores y, como no podía ser menos, participar de "las artimañas típicas de la época" cada vez que se viajaba a la península, "con maletas cargadas de tabaco y artículos que se pudieran vender" para sacar un beneficio que permitiera costear los gastos.</p>

<p>"Fue una implicación total de todos los que formábamos parte del Calvo Sotelo, creando un vínculo especial que, en mi caso, me llevó a conocer a mi mujer o a tener amistades para toda la vida dentro de la misma disciplina del club. Nos marcó la vida porque, además nos cogió en una etapa especial, la que va de los 18-20 años en adelante", incide. Una llamada para entrar a formar parte de la redacción de Diario de Las Palmas, en 1982 y estando estudiando en Madrid, clausura su militancia en el club como miembro del organigrama y activo en todas las funciones que se le requirieran, si bien jamás dejó de "echar una mano en todo lo posible".</p>

<p>"Ver cómo se alcanzó la plenitud de las Ligas y las Copas, con protagonistas que uno conoció siendo niños como Camarero, el liderazgo de Sánchez Jover, la continuidad a la obra de Felipe, que puso los pilares de todo con su sabiduría, con su trabajo... Al final dices que sí, que todo se justifica, que lo que se hizo entonces debió estar bien por lo que vino después y por lo que pervive", concluye.</p>
'),
    array('title' => 'Florencio Tejera', 'numero' => '', 'order' => 15, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Jugador fundacional del Calvo Sotelo tras la redacción de los estatutos del club y presidente "casi por accidente" en la temporada 1983-84, el testimonio de Florencio Tejera (Las Palmas de Gran Canaria, 1956) también resulta de inestimable valor para conocer la naturaleza primigenia de la entidad en sus albores ya insertada en las exigencias de la alta competición. Porque ese Calvo Sotelo al que se enroló "para poder cumplir el cupo de dos fichas séniors junto a Alfonso Déniz" que se requería ya le impactó por "su nivel de organización, ambición y desarrollo".[/capitular]

<p>"Yo jugaba en el equipo de Magisterio mientras hacía la carrera y Felipe Nuez me invitó a formar parte del Calvo Sotelo por mi edad, ya que entonces había sobrepasado la categoría juvenil y le venía bien para el reglamento, que obligaba a combinar juveniles con, al menos, dos fichas de mayores, aunque yo tenía 20 años. Fue una etapa en la que disfruté del deporte, del espíritu de equipo y en la que me impliqué al máximo porque, más que un equipo, era una manera de vivir".</p>

<p>Florencio lo justifica al especificar la metodología al detalle de Nuez, "quien componía unas rutinas de trabajo que eran propias del profesionalismo", lo que generó "una mentalidad de equipo única y que no entendía de horarios". Sesiones de gimnasio a las cinco de la mañana, carreras interminables en circuitos urbanos ("del colegio al López Socas y volver por todo el paseo de Chil"), entrenamientos con un nivel de tecnificación "sin competencia"...</p>

<p>"Teníamos un equipazo. Pericles, Tony Vázquez, Paco Santana, Araña... Pero es que, además, físicamente superábamos a todos porque, en los partidos, se notaba una superioridad en todos los aspectos. Felipe nos tenía adiestrados a la perfección. Siempre queríamos ganar y, al ser un grupo de amigos, el apoyo entre todos era una máxima. Había una sana competencia, el afán de mejora era continuo, nadie ahorraba nada... Y luego cada uno retomaba sus rutinas en los estudios, en su entorno, pero siempre con el voleibol en mente. Con el siguiente partido, con el siguiente entrenamiento...", subraya.</p>

<p>Las rivalidades con el Juventud, el ambiente "impresionante" en los partidos, "con llenos en las canchas" en las que comparecía el Calvo Sotelo, los desplazamientos a la península, aquel campeonato provincial que dio derecho a disputar la Fase Sector en Madrid para aspirar a la Segunda Nacional...</p>

<p>"Fue impresionante asistir en primera persona a los inicios de lo que luego sería un equipo campeón y leyenda del deporte canario y recordar que, por encima de la maestría de un Felipe Nuez que era un adelantado a su tiempo, un entrenador que lo dominaba todo y preparaba cada partido al detalle, lo que nos distinguió era la amistad, el aprecio que nos teníamos, el sentimiento de pertenencia, la responsabilidad, asumida con naturalidad, de hacer crecer aquel escudo que nadie podía imaginar entonces que llegaría tan alto. Fue algo irrepetible. Y todos querían estar con nosotros, pertenecer al Calvo Sotelo era un signo de distinción porque llevaba implícita una rectitud de comportamiento y una mentalidad que nadie tenía entonces al menos en el voleibol canario. Sin cobrar, sacando adelante viajes llevando tabaco y otros artículos para vender en la península que servían para cubrir gastos, respirábamos voleibol siempre. Una madurez impropia a esa edad, se podría decir. Era nuestra vida", insiste.</p>

<p>Un accidente que le provocó, entre otras consecuencias, una rotura de fémur puso fin a su carrera como jugador en el Calvo Sotelo, en el que también ejerció funciones de entrenador, al tener la titulación de técnico internacional, ("el primer triunfo ante el Juventud que logró el Calvo Sotelo, 2-3 en el Obispo Frías, fue bajo mi dirección técnica al estar Felipe Nuez ausente"). Pero lo que nunca pudo augurar es que, en 1983, de vuelta a Gran Canaria tras una larga estancia de índole académico por Madrid, sería propuesto e investido presidente.</p>

<p>"El club venía de una presidencia marcada por algunos desfases económicos. De regreso a casa, me pasaba por la cancha del Calvo Sotelo a saludar a los compañeros, interesarme por el equipo. Incluso seguí jugando un tiempo tras recuperarme en equipos como el Tabaiba... Primero me ofrecieron ser dirigente, pero llegó un momento que nadie quería asumir la presidencia, me lo dijeron y sentí la obligación de aceptarlo porque, repito, la situación era muy delicada y el club necesitaba una cabeza visible. Entré por un ejercicio de responsabilidad y de servicio a unos colores con los que mi vinculación, además de deportiva, era emocional. Y hasta tuve que poner dinero de mi bolsillo en un momento dado para abonar unos gastos. Ese dinero, pasados los años, me lo reintegró religiosamente Juan Ruiz. Durante mi presidencia me veía más como un colaborador del club que como un presidente. No tenía apego al cargo, mi voluntad era la de echar una mano en todo lo que pudiera", detalla.</p>

<p>Al ser requerido por Canarias7 para firmar un contrato como periodista del medio escrito creado dos años antes, en 1982, Florencio Tejera puso fin en 1984 a su cargo y vinculación formal con el Calvo Sotelo. "En adelante escribí del club, siempre con el cariño y afecto que le tenía, aunque con la obligación profesional, también, de anteponer mi integridad y fin informativo. Fui crítico con Juan Ruiz en lo que estimé, reconociéndole, eso sí, que puso al Calvo Sotelo en una dimensión privilegiada cuando entró como presidente, con estrellas nacionales e internacionales, títulos, prestigio... Desde la tribuna de prensa también asistí con dolor a la salida de Nuez en 1988, una figura de su calado yéndose, casi, por la puerta de atrás de un club que él había hecho nacer y prosperar, escribí con emoción de las gestas deportivas, del ambiente de un Centro Insular que vivió noches mágicas, me impactó la etapa en la que vinieron tiempos de incertidumbre por la crisis económica y, ya jubilado, he vuelto a sonreír y emocionarme con el renacimiento del Guaguas...".</p>

<p>¿Esperaba que aquel equipo de colegio, que jugaba sobre un cemento "en el que destrozarse las rodillas o romperse la barbilla era lo común", fuese el germen de una referencia de leyenda en el voleibol nacional? "Nadie se podía hacer a la idea de lo que acabaría siendo un Guaguas campeón que fue cogiendo el testigo de un equipo de cantera, plagado de juveniles y chicos de barrio, que llegaron a lo más alto que pudieron. Yo, evidentemente, tampoco. Pero siento que todo lo que hicimos mereció la pena. Fuimos unos locos, por decirlo de alguna manera. Soñamos, competimos, ganamos, entendimos el deporte desde el lado más humano y comprometido. Con eso me quedo".</p>
'),
    array('title' => 'Tony Vázquez', 'numero' => '', 'order' => 16, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Andaluz de nacimiento (Cádiz, 1960), pero grancanario de pleno derecho ("me trajeron con tres años y esta es mi tierra"), sobre Tony Vázquez recae el privilegio de haber sido otro de los jugadores fundacionales del Calvo Sotelo. Tras sus inicios en los Salesianos ("iba para el atletismo, pero Silvestre Cabrera me dijo que tenía la altura apropiada y me metió en el voleibol"), la creación de la selección cadete de Las Palmas, a mediados de los setenta y bajo la dirección de Felipe Nuez, fue el impulso definitivo a su posterior trayectoria como receptor ("era un 4 de toda la vida, aunque acabé jugando en todas las posiciones").[/capitular]

<p>Vázquez tiene muy nítidos aquellos momentos en los que tomó la decisión de enrolarse en las filas del equipo que marcaría su porvenir: "Después de terminar la experiencia en la selección cadete, en la que recuerdo que intervenimos en unos Campeonatos de España tras eliminar al Tenerife, el camino para aquellos jugadores era ir al Juventud o al Calvo Sotelo. Tenía muy buena relación con Felipe, había estado con él y no me costó decidir. Para nada me arrepiento porque todo lo que vendría después fueron tiempos muy felices, tanto dentro como fuera de la cancha".</p>

<p>"Hasta 1984 formé parte de un equipo que, como siempre dije, se inició con cuatro pelagatos, sin un duro y solo sostenido en el trabajo, la disciplina y el amor por el deporte. Empezamos el camino con la pretensión de divertirnos, sin más. Pero comenzamos a ganar, ganar y ganar y aquello se nos fue de las manos. Del cemento del colegio pasamos a querer subir de categoría, de competir con los mejores de España, de estar a un nivel impensable...", detalla.</p>

<p>Fueron tiempos "irrepetibles" en los que sus protagonistas se sintieron únicos por la distinción que les daba pertenecer al club: "Todos querían formar parte del Calvo Sotelo y no todos se quedaban. La dureza de los entrenamientos, la calidad de los jugadores... Nos veían como a unos elegidos, por decirlo de alguna manera, y sentíamos el respeto de todos. Sitúense en Las Rehoyas de finales de los setenta y comienzos de los ochenta. Droga, delincuencia, problemas sociales... Nosotros nunca tuvimos el más mínimo problema y eso que terminábamos de entrenar de noche y teníamos que pasar por calles que, en teoría, debías evitar. Nos saludaban, nos respetaban, nos apoyaban".</p>

<p>"El Calvo Sotelo representó para Las Rehoyas un orgullo -continúa-, una especie de tabla de salvación dentro de tiempos duros. De repente, en un entorno del que no se esperaba nada, surge un club de voleibol que es envidia de Canarias, que viaja y da la talla ante clubes de otras ciudades, que es un modelo de comportamiento y superación. Hay que poner en contexto todo eso para entender que el voleibol canalizó a través de ese equipo un crecimiento para todos los vecinos".</p>

<p>El ascenso a Segunda en 1979 empodera la labor de Felipe Nuez y el trabajo de una plantilla "de amigos", como bien resalta Vázquez: "Fue la culminación. Aquí la rivalidad con el Juventud era enorme, se llenaban las canchas para vernos. Pero ir a Madrid, Sevilla, Cáceres, Málaga... Y ver que eras mejor que otros clubes de mayor potencial fue un subidón".</p>

<p>"Nos encantaba viajar. Estar días fuera de casa, conocer ciudades. Era lo máximo. Y eso que no disponíamos de medios económicos. La cantidad de tabaco Winston que llevamos para vender. Rifas, boletos, hacíamos de todo con tal de sufragarnos los gastos. El apoyo del APA del colegio, de los padres, resultó fundamental. De lo contrario, no hubiésemos llegado tan lejos", añade.</p>

<p>Tres nombres propios de aquellos inicios le vienen a la mente de manera inmediata. Inevitable, el de Felipe Nuez, al que define como "un técnico estricto, demasiado en ocasiones, muy apasionado por el voleibol pero que terminó siendo un compañero por su implicación con el grupo". Impuso un modelo disciplinario "implacable", con castigos para purgar los comportamientos que no quería ("una vez nos pilló a tres, entre los que me incluyo, por ir a la playa, algo que estaba prohibido, y nos tuvo subiendo y bajando las gradas del López Socas tres horas"), pero a la larga fue lo que forjó la estirpe de campeones que venía en camino. "Fue el técnico ideal y apropiado. Hay que reconocérselo. Vivía por y para el Calvo Sotelo, un ejemplo de compromiso en todos los sentidos", añade.</p>

<p>También tiene palabras para Pericles, "el gran capitán" y guía de todos en el vestuario: "Pericles era nuestro referente. El único que era capaz de enfrentarse, entre comillas, a Felipe. Nadie le discutía nada. Jugaba siendo asmático y tenía una calidad asombrosa. El alma del Calvo Sotelo sin discusión. No se entiende ese equipo sin Pericles".</p>

<p>Y el desaparecido Mendaño, fallecido en accidente de tráfico en pleno apogeo de su carrera: "Poco antes de irse para siempre, estábamos compartiendo unas cervezas en el pub Diseño, de Las Canteras. Me dijo que me fuera con él para hacer paracaidismo. Le dije que me daba miedo. Recuerdo como si fuese ayer despedirme de él... Sin pensar que era la última vez".</p>

<p>"Mendaño estaba llamado a ser un jugador de época, pero tuvo una lesión en el brazo derecho, con el que le pegaba a la pelota, y acabó rematando con la zurda. Felipe lo reconvirtió a colocador. Nunca podré olvidarle", agrega.</p>

<p>Fue testigo, igualmente, de los inicios del legendario Sergio Camarero, con quien coincidió cuando el actual técnico del equipo era un juvenil emergente: "Pese a no ser muy alto, era central. Se le veían ya unas condiciones fabulosas. Todo lo que hizo después no me pilló de sorpresa. Era un portento".</p>

<p>Su ciclo en el Calvo Sotelo terminó un año antes de que se lograra el ascenso a la División de Honor, punto de arranque de la posterior cronología gloriosa de títulos y fama internacional. "Acabé con los que fundaron el Seven-Up porque no contaban conmigo, aunque Felipe me llamó para tratar de convencerme cuando ya me habían pedido que me fuera. No guardo ningún tipo de rencor, todo lo contrario. El espíritu de aquel Calvo Sotelo está en mi corazón como al igual que en el resto de corazones de todos aquellos que iniciamos el camino", pondera.</p>

<p>Espectador en el CID de las finales gloriosas ganadas ("siempre pagando mi entrada"), asistió "emocionado" a la consagración de un club que siempre lo consideró "de cantera y por la cantera", aunque los tiempos de élite y profesionalismo "marcaran otro camino".</p>
'),
    array('title' => 'Isidro Quintana', 'numero' => '', 'order' => 17, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]A Isidro Quintana (Las Palmas de Gran Canaria, 1957) le metieron el voleibol en su vida "por obligación", como reconoce, porque, integrado en la sección de baloncesto de la UD Las Palmas durante su adolescencia ("llegué a jugar contra Domingo Díaz, que luego ha sido lo que ha sido"), iba para pívot con su imponente estatura en plena pubertad. "Pero se me cruzó en el camino Silvestre Cabrera, que me daba clases en los Salesianos, y me dijo, medio en serio, medio en broma, que o hacía voleibol o me suspendía. Me convenció prometiéndome que me llevaría directamente a la selección júnior. Empecé y ya no lo dejé. Fue tal mi interés que me saqué la titulación nacional de entrenador con 17 o 18 años para tener una formación más amplia y poder dirigir equipos, como luego haría con el Santa Teresa, y que, con Carlos Bermúdez como presidente, alcanzó enorme relevancia", añade.[/capitular]

<p>El caso es que, compaginando su labor de jugador, con inicio en el Juventud, con el de técnico en el conocido como Rusell Hall en honor a su patrocinio, y el de periodista, ejerciendo como informador en distintos medios de comunicación, Isidro Quintana se fue convirtiendo en toda una personalidad del voleibol isleño y con una influencia en todos los ámbitos que no paró de expandirse desde finales de los setenta hasta su reciente jubilación.</p>

<p>"Fue por una gestión mía, que hice a título personal y altruista, la llegada del primer sponsor de la historia del Calvo Sotelo, como ya antes había hecho con el Santa Teresa. Hablé con un contacto que tenía en Tabacalera y de ahí terminaron viniendo las denominaciones de Reales o Lucky Stricke. De hecho, en mi coche de entonces llevaba serigrafiados esos dos logotipos para dar mayor publicidad. Y Juan Ruiz, tanto antes de entrar por primera vez como presidente como cuando refundó la entidad, me llamó a título particular para avanzarme sus planes y pedirme consejos en virtud de mi experiencia. Un gesto que me llenó de orgullo. Por supuesto, siempre traté de ayudarle y brindarle el máximo apoyo que podía", razona.</p>

<p>Reclutado para el Calvo Sotelo por Felipe Nuez ("me convenció hablándome de potenciar un proyecto que iba para arriba y con una metodología de trabajo que yo sabía que nadie tenía en Canarias"), su desembarco en el club, en la campaña 1983-84, coincidió con el de otros dos compañeros del Juventud ("Ignacio Brito y el Chicha") que, según su parecer, "desniveló la balanza en favor del Calvo Sotelo en la rivalidad capitalina que existía y que, hasta ahí, era favorable al otro equipo".</p>

<p>"Felipe me puso de central, cuando siempre había sido receptor. Fue un acierto porque pude dar un rendimiento importante para ayudar a los compañeros. Y me terminó de demostrar su enorme inteligencia como entrenador cuando transformó a Mendaño de rematador a colocador después de que sufriera una lesión que le dejó secuelas y le impedían subir a la red como antes. Fue una maniobra genial de Felipe, quien fue una figura capital en los primeros tiempos del Calvo Sotelo con su constancia, perfeccionismo y dirección magistral. Él puso las bases de lo que vendría después", opina Quintana.</p>

<p>Fueron tres temporadas de militancia en el equipo, con picos de relevancia, como el ascenso a la División de Honor en 1985 o "la multitud de momentos de enorme compañerismo y amistad" que le deparó esta gran experiencia.</p>

<p>"Éramos un grupo sano, de amigos y que teníamos una gran relación dentro y fuera de la cancha. Ninguno podíamos pensar que aquello terminaría yéndose de las manos a todo el mundo y convirtiéndose en lo que fue, un equipo campeón, con dobletes nacionales, algo que tiene un mérito tremendo. La clave en esta transformación, en este salto al estrellato, se personifica en Juan Ruiz. Para mí es el rey, la persona clave. No se entiende el Guaguas sin Juan Ruiz y creo que no se entiende Juan Ruiz sin el Guaguas. Apostó por traer extranjeros, por ir a por los mejores jugadores que había en los rivales. Era la única manera de hacer un proyecto ganador. Asumió sus riesgos pero también hizo valer sus contactos, el don de gentes, su capacidad para aglutinar patrocinios y apoyos. Realizó un trabajo sensacional cuando llegó a la presidencia y, también ahora, cuando ha vuelto desafiando un periodo de crisis, y los títulos constituyen un justo premio a su impresionante gestión", afirma.</p>

<p>En su rol de periodista, ya finalizada su etapa como jugador en el club, ha sido testigo puntual y al detalle de todas las gestas y progresos del Calvo Sotelo: "Su historia, desde el patio de un colegio, a la cima nacional, es de una grandeza enorme. Irrepetible. Tener a un superclase como Golec, o Klos, que no sabías si iba a rematar o a colocar, considerado uno de los cinco mejores colocadores del mundo, la conexión brutal de Camarero con una grada que hacía volar a los jugadores, ese CID lleno ante el PSG con casi 2.000 personas sin poder entrar, destronar al Palma, que parecía un imposible, regresar tras la desaparición con otro proyecto ganador y que vuelve a ilusionar a todos... Es una secuencia increíble de éxitos y superaciones".</p>

<p>"Pienso que siempre se han valorado los éxitos del Guaguas. En seguimiento mediático, en sensibilidad de las instituciones, en reconocimiento. Y eso ha sido para bien del deporte y del voleibol en Canarias. En este sentido, ha trascendido el ámbito deportivo porque llegó a ser un fenómeno social. Así lo comprobé desde el ámbito informativo y la demanda de noticias que se daba en determinados momentos", apunta.</p>

<p>Se congratula de que Juan Ruiz, "acompañado de otros históricos de talla inigualable como Sánchez Jover, Nuez o Camarero", haya podido rescatar un proyecto que parecía ya enterrado: "Fundé un club como el Cantur y terminó desapareciendo pese a los éxitos que logró. En el Vecindario sé que Sánchez Jover se dejó un dineral de su bolsillo y acabó quemado. De ahí que la jugada de coger esta plaza, con derecho a jugar en Europa como premio añadido, haya sido otro acierto más de Juan, capaz de reinventarse de nuevo en favor de un club que es patrimonio de nuestra tierra por trayectoria, historia e importancia".</p>
'),
    array('title' => 'Pericles', 'numero' => '', 'order' => 18, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Un pelo abundante y la barba que le daba aires intelectuales le valieron el apodo, Pericles, con el que se incrustaría, por derecho propio, en el listado de imprescindibles del Calvo Sotelo. "Me dijeron, medio en serio medio en broma, que me parecía a Pericles. No me lo tomé mal y así me quedé", admite. Pedro Román Rosario (Las Palmas de Gran Canaria, 1958) no fue uno más. Durante muchos años capitán y guía del resto, añadió a sus grandes dotes para el voleibol ("como receptor formé con Tony Vázquez una línea fabulosa en esa función") una lección de compromiso y entrega de impresión, ya que, pese a su condición de asmático, perteneció durante largo periplo al equipo y con un rendimiento ejemplar. "Salía a la cancha con mi Ventolín para poder resistir los esfuerzos. En los tiempos muertos y descansos casi prefería el fuelle que me daba el medicamento al agua. Y alguna vez me pincharon por las asfixias que me entraban. Que se lo pregunten a Alfredo Padrón, que iba para doctor, como ejerció posteriormente, y en más de una ocasión fue mi practicante en el vestuario", rememora. Así, venciendo a una patología tan severa ("hoy en día, jugar en esas condiciones sería impensable por todos los exámenes médicos que se hacen, pero en esa época no teníamos controles de este tipo, no había tanta vigilancia para preservar la salud de los miembros de los equipos"), adquirió galones y ascendente hasta situarse en un estatus que ya siempre le correspondería. De la primera época del Calvo Sotelo no hay miembro que pase por alto la influencia ejercida por Pericles y su aura de liderazgo única.[/capitular]

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
'),
    array('title' => 'José Millán', 'numero' => '', 'order' => 19, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Si la figura de Silvestre Cabrera fue de trascendencia capital para auspiciar el voleibol durante su mandato como presidente de la Federación de Las Palmas (1973-1985), no es menos relevante la influencia, también de enorme impacto, de José Millán, quien en diciembre de 1976 asumió el cargo de secretario del ente presidido por Cabrera, tomó su relevo a la conclusión de su ciclo como máximo mandatario y terminó encabezando la Federación Canaria de Voleibol hasta 2008. Más de tres décadas de contribución y entrega que le hicieron tener una atalaya privilegiada de los acontecimientos, al tiempo de otorgarle un lugar preferencial en la historia de esta disciplina.[/capitular]

<p>Millán (Sevilla, 1933-Las Palmas de Gran Canaria, 2023) fue otro de los testigos que vivió, desde los inicios hasta su desarrollo, pasando por la eclosión de los títulos, la vida del Calvo Sotelo, una entidad a la que reconoció tener "mucho cariño y respeto" por la contribución que hizo en la historia del deporte en Canarias.</p>

<p>"Siempre presté mi ayuda a todos los clubes y equipos y el Calvo Sotelo no fue una excepción. Su labor con los chicos, con la cantera, fue muy valiosa y tuvo el acierto, además, de complementar el bloque con algunos veteranos. Se veía que era un proyecto que podía llegar alto por la dedicación y el empeño que le ponían, con Felipe Nuez al frente, y con el paso de los años no ocurrió otra cosa que confirmarse lo que todos esperábamos", resaltó.</p>

<p>El dirigente reafirmó que la consecución de títulos por parte del ya denominado Guaguas Las Palmas "supuso un gran espaldarazo" para el voleibol canario, por lo que cabía distinguir al club "por ser el primero y el que contribuyó a que la afición se volcara". Ahí estaban las imágenes de las canchas llenas, primero el San Román, luego el Centro Insular, y la repercusión mediática que conllevó. Y no pasó por alto el impulso que llegó con Juan Ruiz, a mitad de la década de los ochenta: "Juan disparó al Guaguas, lo llevó a lo más alto cuando parecía que lo que él quería era imposible. Hizo un equipo del que todos disfrutamos. Tenemos que ser justos con él y darle el mérito que le corresponde. Hubo un antes y un después en la historia del voleibol y del deporte en nuestras islas. Juan Ruiz fue quien marcó el cambio de una etapa a otra".</p>

<p>"Hay que valorar lo que hicieron, saliendo de un colegio y con muy pocos medios. Fueron superándose, nunca se rindieron ante las dificultades. Como dirigente que era en esos años, contemplé con mucha satisfacción su labor formativa, su salto al profesionalismo, los fichajes de grandes jugadores... Fue una evolución preciosa y que, pienso, hizo muy feliz a los aficionados. Irrepetible, diría yo", añadió.</p>

<p>Millán tampoco obvió el valor añadido que dio codearse con los mejores de Europa, otro de los hitos del Guaguas: "Colocaron en el mapa nuestro voleibol, nuestra tierra. Fueron embajadores de España. Faltó suerte para lograr un título continental, pero su contribución fue impresionante y digna de aplauso en todos los sentidos".</p>
'),
    array('title' => 'Miriam Quiroga', 'numero' => '', 'order' => 20, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Miriam Quiroga, licenciada en Educación Física y profesora universitaria, publicó en el año 2010 el libro \'Génesis y evolución del voleibol en Gran Canaria 1934-1978\', editado por el Servicio de Publicaciones de la Universidad de Las Palmas de Gran Canaria, en el que se incluye amplia documentación escrita y gráfica del nacimiento y desarrollo del Club Voleibol Calvo Sotelo. Su testimonio es de indudable valor a la hora de analizar el surgimiento de la entidad y, a petición del autor de esta obra, además de mostrar una generosa colaboración bibliográfica, cediendo numeroso material que obraba en su poder, entre el que cabe destacar el documento original de los estatutos fundacionales que se reproduce en su integridad al final de este capítulo, accedió a responder este breve cuestionario y en el que aporta información alusiva a los primeros tiempos de la institución. Conste desde estas páginas el agradecimiento y reconocimiento de la directiva actual del Guaguas, presidida por Juan Ruiz, a su labor investigadora así como a su gesto de ayudar a este proyecto editorial.[/capitular]

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
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 02: LOS ESTATUTOS FUNDACIONALES
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Los Estatutos Fundacionales',
        'numero' => '02',
        'order' => 25,
        'ref_id' => 'cap02',
        'hero' => array(
            'image' => libro_img('hero-estatutos.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom', 'custom_icon' => $star,
            'icon_width' => 40, 'icon_height' => 40,
            'alignment' => 'center', 'vertical' => 'center',
            'height' => '500px',
            'border_color' => 'hsl(45 100% 50%)',
            'icon_color' => 'hsl(45 100% 50%)',
            'title_lines' => array(
                libro_hero_line('ESTATUTOS', '#1a1a1a', 'hsl(45, 100%, 50%)'),
                libro_hero_line('FUNDACIONALES', '#1a1a1a', 'hsl(45, 100%, 50%)'),
            ),
        ),
        'content' => '
[encabezado_seccion]Aprobado en la Junta del día 6 de noviembre de 1976 a las 20.00 horas[/encabezado_seccion]

[encabezado_seccion]Capítulo I — Constitución, fines y domicilio[/encabezado_seccion]
[articulo numero="1º"]El nombre que adoptará la nueva entidad será el de Club Voleibol Calvo Sotelo.[/articulo]
[articulo numero="2º"]El objeto de la presente entidad es el fomento y práctica del deporte entre los asociados y, en especial, el Voleibol.[/articulo]
[articulo numero="3º"]Podrá asimismo la presente entidad ampliar sus funciones deportivas con otras secciones secundarias, recreativas o de otros deportes, siempre que lo acuerden la junta directiva y a cuyo fin crearan aquellas secciones que, previa aprobación en Asamblea General, se estimen necesarias y que sus medios lo permitan.[/articulo]
[articulo numero="4º"]La entidad, que con todos sus socios y componentes quedan sujetos a la jurisdicción de la Delegación Nacional de Deportes, Comité Olímpico Español, Federación Española de Voleibol, a través de la cual queda incorporada al completo de la instituciones del Estado Español obligándose a acatar todo lo dispuesto en los estatutos, reglamentos, disposiciones y acuerdos de la expresada federación.[/articulo]
[articulo numero="5º"]Se fija el domicilio de la entidad en Las Palmas, calle Montejurra, número 1.[/articulo]
[articulo numero="6º"]La duración de la entidad es por tiempo indefinido.[/articulo]

[encabezado_seccion]Capítulo II — De los socios[/encabezado_seccion]
[articulo numero="7º"]La entidad Club Voleibol Calvo Sotelo se compondrá de las siguientes clases de socios: de HONOR y ACTIVOS.
Serán de HONOR aquellos asociados que, a juicio de la directiva, previa aprobación de la asamblea general extraordinaria de socios, merezcan tal distinción por su labor en pro de la entidad o del deporte en general, los cuales estarán exentos del pago de la cuota.
Tendrán los mismos derechos que los socios activos si proceden de la categoría de activos.

<strong>HONORÍFICOS-.</strong>
Los asociados que a criterio de la junta directiva merezcan tal distinción por su actuación en pro de la entidad, los cuales estarán exentos del pago de la cuota.

<strong>ACTIVOS-.</strong>
Los que satisfagan la cuota de entrada y mensual fijada por la junta directiva y aprobada en asamblea.

Asimismo, tendrán plenitud de derechos en el uso del material de la entidad. Estos disfrutarán del derecho de voz y voto, de acuerdo con el artículo 41 y en la forma y con las limitaciones fijadas por la Federación Española.[/articulo]
[articulo numero="8º"]Todos los socios, sea cual fuese su categoría, tendrán el libre acceso a los locales y campos de la entidad.[/articulo]
[articulo numero="9º"]Todo socio viene obligado a comunicar por escrito a la directiva las deficiencias que observe en las instalaciones, con la colaboración del personal empleado, fiestas o concursos que en el mismo se organicen para lograr la mayor perfección en todas sus actividades.[/articulo]
[articulo numero="10º"]De acuerdo con las asambleas, la junta directiva impondrá una cuota de entrada a los socios, según las necesidades de la entidad.[/articulo]
[articulo numero="11º"]Podrá nombrarse presidente de la entidad a quien por su relevante personalidad y especiales condiciones sea propuesto y elegido en la forma y con los requisitos establecidos en los artículos 35 y siguientes, aunque no fuese socio con anterioridad a la presentación de su candidatura.[/articulo]
[articulo numero="12º"]Para formalizar el ingreso en la entidad, los interesados deberán firmar una propuesta avalada por dos socios, la cual estará expuesta en la tablilla de la entidad durante ocho días, a fin de que los socios puedan efectuar las reclamaciones que consideren pertinentes sobre la admisión de los mismos.[/articulo]
[articulo numero="13º"]La entidad llevará una lista por orden de ingreso de todos los socios, sin distinción de clase, y cada socio recibirá el número correlativo que le corresponda por la fecha de ingreso.[/articulo]
[articulo numero="14º"]Las bajas como socios serán definitivas o temporales.[/articulo]
[articulo numero="15º"]Perderá la calidad de socio, sea cual fuese su categoría, por una de las siguientes causas:
a) Por voluntad del socio, expresada en escrito dirigido a la junta directiva.
b) Por dejar sin pagar tres cuota mensuales consecutivas.
c) Por incumplimiento de las obligaciones que le imponen los presentes estatutos o por perjuicio moral o material ocasionado a la entidad.
d) Por haber transcurrido los dos años de haber solicitado una baja temporal.
e) Por defunción.[/articulo]
[articulo numero="16º"]Todo socio que sea baja en la entidad voluntaria o por expulsión perderá todos los derechos adquiridos.[/articulo]
[articulo numero="17º"]Todo socio deberá identificar su personalidad presentando a la entrada de la entidad, o por petición de persona autorizada por la junta directiva, su carnet de identidad de socio junto con el recibo del mes corriente.[/articulo]
[articulo numero="18º"]Serán deberes de los socios:
a) La leal observancia de lo establecido en los presentes estatutos y reglamentos interiores de la entidad.
b) Obedecer las disposiciones emanadas de la junta directiva.
c) Aportar su concurso a todas las manifestaciones deportivas-económico-sociales que le sean encomendadas.
d) Satisfacer, a través de la entidad, a la Federación Española del sello federativo.[/articulo]
[articulo numero="19º"]Serán derechos de los socios activos:
a) Formar parte de la junta directiva cuando reúnan los requisitos señalados en el artículo 11 y por la Federación Española.
b) Intervenir con voz y voto en las asambleas, según los artículos y las disposiciones de la Federación Española.
c) Examinar las liquidaciones y balances de la entidad.[/articulo]

[encabezado_seccion]Capítulo III — Del Gobierno de la Sociedad[/encabezado_seccion]
<p class="text-sm text-muted-foreground italic mb-4">(Sección 1ª: Junta Directiva)</p>
[articulo numero="20º"]La entidad estará dirigida, regida y administrada de conformidad con los presentes estatutos por la junta directiva.[/articulo]
[articulo numero="21º"]La junta directiva se compondrá: presidente, uno o dos vicepresidentes, secretario, tesorero contador y el número de vocales que se estime conveniente.[/articulo]
[articulo numero="22º"]Los nombramientos y duración de los cargos de presidente y miembros de la junta directiva de la entidad se harán de conformidad con las disposiciones vigentes sobre el particular emanadas de la Delegación Nacional de Educación Física y Deportes.[/articulo]
[articulo numero="23º"]El presidente convocará junta directiva todas las veces que estime necesario y, al menos, una vez cada mes.[/articulo]
[articulo numero="24º"]Los acuerdos de la junta directiva se tomarán por mayoría de votación, teniendo cada componente un voto y, en caso de empate, decidirá el voto del presidente.[/articulo]
[articulo numero="25º"]El presidente tendrá la representación legal y jurídica de la entidad, dirigirá los debates y discusiones y velará para que se cumplan los acuerdos de las juntas directivas y asambleas generales ordinarias y extraordinarias de socios, autorizará con su firma los pagos y operaciones que efectúe la entidad, unida dicha firma con la del contador, para asuntos económicos y con la del secretario para documentos y contratos.[/articulo]
[articulo numero="26º"]El secretario llevará el libro de actas, un registro de socios con orden correlativo, cuidará de la correspondencia de la entidad, extenderá los oportunos certificados con referencias a los acuerdos tomados, autorizará con su firma, junto con la del presidente, los contratos que se celebren en nombre de la entidad, formalizará la memoria anual de las actividades de la entidad, actuará como tal en las juntas directivas y asambleas y cuidará de tener toda la documentación en las asambleas preparadas según las secciones segunda, tercera y cuarta. Todos los escritos llevarán el visto bueno del presidente.[/articulo]
[articulo numero="27º"]El tesorero cuidará de la parte económica de la entidad llevando, al efecto, un libro de caja donde anotará todos los ingresos y gastos que hubiere. No efectuará ningún pago sin el visto bueno del presidente.[/articulo]
[articulo numero="28º"]El contador velará por el fiel cumplimiento de la distribución de fondos de la entidad, así como el pago de la cuotas por los asociados y, también, comprobará los estados de cuentas y beneficios o pérdidas por fiestas, homenajes, etc. Presentará, bimensualmente, a la aprobación de la junta directiva el estado de cuentas de la entidad. De acuerdo con el tesorero, presentará y formalizará para la junta general ordinaria un balance inventario de la situación económica de la entidad durante el año para su aprobación, el cual deberá exhibir durante quince días con anterioridad a dicha reunión en la tablilla de la entidad, a los fines de poderlo comprobar todos los asociados. Sustituirá al tesorero en caso de ausencia o enfermedad.[/articulo]
[articulo numero="29º"]El vicepresidente hará las veces de presidente en ausencia o enfermedad del mismo.[/articulo]
[articulo numero="30º"]Los vocales ayudarán a los demás miembros de la junta directiva en sus funciones, sustituyendo a estos en caso de enfermedad o ausencia y serán los que presidan las distintas ponencias deportivas o sociales que crea conveniente formar la junta directiva, cuidando de exponer a aprobación de la junta los acuerdos tomados en principio, por tales ponencias.[/articulo]

<p class="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 2ª: La Asamblea General de socios)</p>
[articulo numero="31º"]Las asambleas serán ordinarias o extraordinarias y se convocarán y celebrarán según lo prescrito y dispuesto por la Delegación Nacional de Educación Física y Deportes, en sus disposiciones vigentes sobre la materia.[/articulo]
[articulo numero="32º"]Necesariamente deberá ser celebrada asamblea general extraordinaria para la modificación de los estatutos y para tener validez ha de ser aprobado por la Federación Española. Las asambleas generales ordinarias y extraordinarias estarán integradas por aquellos socios que, con arreglo a la sección 3ª que sigue, tengan derecho a voto.[/articulo]

<p class="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 3ª: Socios con derecho a voto)</p>
[articulo numero="33º"]Tendrán derecho de asistencia a las asambleas generales ordinarias y extraordinarias todos los socios de la entidad.[/articulo]
[articulo numero="34º"]Cada año, en primero de enero, quedarán expuestas en el cuadro de anuncios de la entidad las listas de socios, por riguroso orden de fecha de ingreso.[/articulo]

<p class="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 4ª: Procedimientos para elegir la Junta Directiva)</p>
[articulo numero="35º"]Cuando deba procederse a la elección de presidente con la totalidad de la directiva, se efectuará previamente la proclamación de candidato.[/articulo]
[articulo numero="36º"]Los candidatos a la junta directiva serán todos aquellos socios que reúnan las condiciones del artículo 11 y sean presentados con la firma del 10% de los asociados que tengan derecho a voto.[/articulo]
[articulo numero="37º"]El plazo para la presentación de las propuestas de candidatos finalizará a los cinco días a partir de la convocatoria de la asamblea en que haya de producirse la elección.[/articulo]
[articulo numero="38º"]Finalizado dicho plazo de cinco días, la entidad elevará a la Federación Española, a través de la Regional, las propuestas de candidatura, las cuales, una vez aceptadas, se expondrán en el local social durante cinco días anteriores a la celebración de la asamblea.[/articulo]
[articulo numero="39º"]En la asamblea solo podrán votarse candidaturas completas, considerándose nula cualquier enmienda o sustitución que se hiciera.[/articulo]
[articulo numero="40º"]Ningún socio podrá firmar a la vez dos o más propuestas de candidatura y, aunque si tal ocurre no se invalidará esta, el socio que incurra en duplicidad de firma será inhabilitado para tomar parte en las asambleas generales que se celebren en lo sucesivo.[/articulo]
[articulo numero="41º"]Todas las propuestas de candidatos a la presidencia deberán citarse acompañadas de la aceptación de los interesados y con la lista de candidatos que estos propongan para los demás cargos que deban proveerse.[/articulo]
[articulo numero="42º"]La asamblea por mayoría de votos sobre la elección del presidente y miembros de la directiva y de conformidad con las disposiciones vigentes de la D. N. de Educación Física y Deportes.[/articulo]
[articulo numero="43º"]Si se produjera la dimisión o cese total de presidente o directiva, esta no podrá abandonar sus funciones bajo pena de inhabilitación de sus miembros mientras no se haya procedido a la elección de otra nueva y, a este fin, convocará inmediatamente la asamblea general extraordinaria.[/articulo]

[encabezado_seccion]Capítulo IV — De la administración de la Entidad[/encabezado_seccion]
[articulo numero="44º"]De conformidad con los artículos 27 y 28 de los presentes estatutos, llevarán la administración y contabilidad de la entidad el tesorero y contador con las facultades en dichos artículos expresadas y sujetas a los artículos 24 y 25.[/articulo]
[articulo numero="45º"]La entidad dará cuenta a sus socios, una vez al año por lo menos, en una memoria presentada a la asamblea general ordinaria, de su gestión deportiva y económica y de sus proyectos para el futuro.[/articulo]
',
    ),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 03: ASÍ SE FORJÓ UNA LEYENDA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Así se forjó una leyenda',
        'numero' => '03',
        'order' => 30,
        'show_marker' => true,
        'ref_id' => 'cap03',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.80)',
            'icon' => 'custom', 'custom_icon' => $star,
            'icon_width' => 70, 'icon_height' => 70,
            'alignment' => 'right', 'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(
                libro_hero_line('ASÍ SE FORJÓ', '#D4AF37'),
                libro_hero_line('UNA LEYENDA', '#FFFFFF'),
            ),
        ),
        'content' => '
[seccion_header]Llegar a la élite para quedarse[/seccion_header]

[capitular]La temporada 1985-86 fue la del estreno del Calvo Sotelo en la División de Honor y se afrontó bajo las mismas líneas maestras que habían marcado su trayecto, desde las consideraciones de Felipe Nuez, aunque con la importante novedad del fichaje del yugoslavo Ivo Martinovic, primer extranjero en la historia del club que, con 30 años y amplio bagaje profesional e internacional, venía a darle a la plantilla la cuota de veteranía que se requería para competir a escala máxima.[/capitular]

<p>Martinovic, elegido capitán en su primera campaña, y un Camarero que ya demostraba que iba para jugador de época, fueron los sostenes de un grupo que rindió por encima de lo esperado. Para el recuerdo queda aquel 2 de noviembre de 1985, fecha del debut del Calvo Sotelo en la División de Honor con triunfo en Cáceres ante el Licenciados Reunidos por 0-3.</p>

<p>El 21 de octubre de 1986 se celebra la asamblea general extraordinaria del club. Ahí arranca la etapa de Juan Ruiz en el alto mando y que se prolongaría, de manera ininterrumpida, hasta 1998. Y la noticia más esperada desde hacía meses se anunció el 5 de noviembre: Juan Ruiz confirma que Guaguas Municipales patrocinará a la entidad, que, desde entonces pasará a denominarse Guaguas Las Palmas.</p>

[imagen_contenido src="' . libro_img('content/equipo-champions.jpg') . '" alt="El CV Guaguas celebra una victoria en competición europea" caption="El Guaguas inauguró su palmarés con la Copa del Rey de 1989 y forjó una hegemonía de cinco Ligas consecutivas." fullwidth="true"]

[seccion_header]Fichajes de impacto y hegemonía[/seccion_header]

<p>El verano de 1987, ya con dos años de experiencia en la élite, marca el escalón cualitativo que instala al Guaguas en la excelencia. El fichaje de Paco Sánchez Jover, figura indiscutible del voleibol nacional, fue una auténtica jugada maestra de Juan Ruiz al captar al jugador del momento.</p>

<p>Los resultados se disparan y son un aviso al resto de que Gran Canaria exhibe proyecto ganador. Los subcampeonatos de Liga y Copa del Rey suponen la antesala de los éxitos que ya eran inminentes. El aterrizaje de los mexicanos Sergio Hernández, para el banquillo, y Chava González, así como la apuesta por el canadiense Brad Willock terminan por ensamblar un Guaguas que inaugura su palmarés con la Copa del Rey conquistada el 9 de abril de 1989 ante el Palma en el Centro Insular.</p>

<p>Esa Copa, que abría las vitrinas del Guaguas, no hizo más que multiplicar las ambiciones de Juan Ruiz, quien une a su elenco de estrellas, en el verano de 1989, a los internacionales polacos Ireneusz Klos y Waclaw Golec. Esa primera Liga sería una realidad el 1 de mayo de 1990 con la inolvidable final ante el Bomberos de Barcelona.</p>

<p>A esa primera Liga le sucederían otras cuatro consecutivas hasta 1994, estableciendo una hegemonía nacional inédita. Además, estuvo aderezada con tres dobletes por las Copas del Rey también conquistadas en los años 1991, 1992 y 1993. Son campañas en la Copa de Europa, llenos a reventar en el Centro Insular, máximo esplendor dentro y fuera de España.</p>

<p>Fueron doce los títulos que se atraparon desde 1989 a 1997, etapa de concentración luminosa, y que granjeó la leyenda de un Guaguas que, por momentos, llevó la bandera del deporte en Gran Canaria.</p>

[imagen_contenido src="' . libro_img('content/victoria-guaguas.png') . '" alt="El CV Guaguas celebra un título de Liga" caption="Los años dorados del Guaguas: cinco Ligas consecutivas, Copas del Rey y presencia en Europa."]

[seccion_header]La salida de Juan Ruiz, principio del fin[/seccion_header]

<p>Tras doce años en la presidencia, Juan Ruiz quiso respetar lo reflejado en los estatutos y ceñirse a lo establecido con la máxima durabilidad de su cargo. A la conclusión de la temporada 1997-98, saldada con la Supercopa de España, dio el relevo en la cúpula a Mario Hugendubel.</p>

<p>Fue algo más que un traspaso de poderes para alguien que dedicó su vida al servicio de un club que heredó en ruinas y legó en una posición de privilegio. Títulos (doce en total), cantera, superávit, crédito en entidades privadas y credibilidad a ojos de los organismos públicos. Un Guaguas respetado en España y en Europa.</p>

[cita_editorial]"Todo cambió y para peor. Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos."[/cita_editorial]
',
    ),

    // Cap 04 child: El proyecto visionario de Juan Ruiz
    array('title' => 'El proyecto visionario de Juan Ruiz', 'numero' => '', 'order' => 31, 'show_marker' => false, 'parent_ref' => 'cap03',
        'content' => '
[capitular]Nacido en La Aldea de San Nicolás en 1953, emigrante con su familia a Tenerife durante gran parte su adolescencia (1960-1969), en la que hizo sus pinitos en la lucha canaria o el fútbol ("con 16 años llegué a jugar en Tercera División en las filas del Adeje"), Juan Ruiz estaba llamado, sin saberlo, a escribir una historia sin parangón en el deporte canario y al frente del Calvo Sotelo.[/capitular]

<p>No hay dirigente isleño con tal nómina de títulos en su poder, todos los conquistados por la entidad, y con el mérito añadido de haber armado un equipo campeón desde las cenizas. Tanto en 1987 como en 2020 acudió al rescate recogiendo una tesorería en ruinas y un porvenir tan comprometido que apuntaba a la desaparición.</p>

<p>"El secreto es trabajo y pasión. Constancia y ambición. No rendirse jamás. Si para conseguir un patrocinador tengo que visitar veinte empresas, acabo entrando en cuarenta. Si para ser campeón me tengo que traer a una estrella, trato de que sean dos."</p>

[cita_editorial]"Por lo que fuera, me sentí en la obligación de hacer algo. Me movió una motivación de responsabilidad. Le pregunté abiertamente a Nuez por el mejor jugador de España. Me dijo que era Paco Sánchez Jover. Le contesté que entonces habría que traerlo. Y me miró como si hubiese dicho un disparate."[/cita_editorial]

[seccion_header]La génesis de su proyecto: patrocinios y fichas estelares[/seccion_header]

[cita_prensa source="La Provincia, 17 de julio de 1987"]"Estamos en una nube con muchos cimientos. Aquí hay un club con cantera, con una estructura deportiva muy sólida basada en excelentes técnicos, y hay también unas buenas razones económicas que se gestan con una administración del club que considero muy responsables."[/cita_prensa]

[seccion_header]El primer título como estímulo[/seccion_header]

[cita_prensa source="Diario de Las Palmas, 10 de abril de 1989"]"Este es el triunfo del trabajo y del esfuerzo de muchos años, comenzado por otros, como José Luzardo, Antonio Trejo o Felipe Nuez, y rematado por nosotros y por nuestra afición."[/cita_prensa]

[seccion_header]El sueño cumplido de jugar la Copa de Europa[/seccion_header]

[cita_prensa source="Canarias7, 13 de septiembre de 1990"]"No gana el que más presupuesto tiene sino el que más trabajo derroche. Es un gran reto, asimismo, representar a Canarias por vez primera en la Copa de Europa."[/cita_prensa]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULOS 04-22 (con hero y contenido)
    // ═══════════════════════════════════════════════

    // Cap 05
    array(
        'title' => 'Iconos y estrellas del Guaguas', 'numero' => '04', 'order' => 40, 'show_marker' => true, 'ref_id' => 'cap04',
        'hero' => array('image' => libro_img('hero-volleyball-match.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 80, 'icon_height' => 80, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('ICONOS Y', '#1a237e', '#FFFFFF'), libro_hero_line('ESTRELLAS', '#1a237e', '#FFFFFF'), libro_hero_line('DEL GUAGUAS', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]Los grandes nombres que han escrito la historia del CV Guaguas. Jugadores que dejaron su huella en el voleibol español y que convirtieron al club en leyenda. Desde los canteranos que crecieron en el patio del Calvo Sotelo hasta las estrellas internacionales que llegaron para elevar el proyecto a cotas inimaginables, todos contribuyeron a forjar un legado deportivo sin parangón en Canarias.[/capitular]
[imagen_contenido src="' . libro_img('content/jugador-accion.png') . '" alt="Jugador del CV Guaguas en acción" caption="El talento individual al servicio del colectivo: seña de identidad del Guaguas a lo largo de su historia." fullwidth="true"]'),

    // Cap 05 children
    array('title' => 'Sergio Miguel Camarero', 'numero' => '', 'order' => 41, 'show_marker' => false, 'parent_ref' => 'cap04',
        'content' => '
[perfil_jugador nombre="Sergio Miguel Camarero"]
[capitular]Cuando Sergio Miguel Camarero (Las Palmas de Gran Canaria, 1967) destacaba en el fútbol y como prometedor jugador del San Antonio, el equipo de su barrio, ya soñaba con hacer historia en el deporte.[/capitular]

[imagen_contenido src="' . libro_img('content/jorge-almansa.png') . '" alt="Jorge Almansa, capitán del CV Guaguas" caption="Jorge Almansa, actual capitán del CV Guaguas, heredero de una larga tradición de líderes en la cancha."]

<p>"Era una época complicada en la calle, el riesgo de las malas influencias. Mi suerte fue que elegí el deporte, el voleibol, y conocí a una persona como Felipe Nuez con la que pude crecer y desarrollarme en el mejor ambiente posible."</p>

[cita_editorial]"Pude irme en el inicio de mi carrera. Me llamó del Cisneros Miguel Ocón. Pero aposté por quedarme en mi tierra y no me equivoqué."[/cita_editorial]

<p>Sergio Miguel Camarero acumuló 48 internacionalidades absolutas y 10 títulos oficiales (5 Ligas y 5 Copas).</p>
[/perfil_jugador]'),
    array('title' => 'Paco Sánchez Jover', 'numero' => '', 'order' => 42, 'show_marker' => false, 'parent_ref' => 'cap04',
        'content' => '
[perfil_jugador nombre="Paco Sánchez Jover"]
[capitular]Paco Sánchez Jover es, junto a Camarero, el otro gran pilar sobre el que se construyó la leyenda del Guaguas. Llegado en el verano de 1987 como el gran fichaje estrella de Juan Ruiz, el mejor jugador de España en aquel momento.[/capitular]

<p>Su fichaje fue una auténtica jugada maestra de Juan Ruiz. Con Sánchez Jover llegaron su hermano Jesús, Venancio Costa y Antonio Miralles.</p>

[cita_editorial]"Todo cambió y para peor. Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos."[/cita_editorial]
[/perfil_jugador]'),
    array('title' => 'Waclaw Golec', 'numero' => '', 'order' => 43, 'show_marker' => false, 'parent_ref' => 'cap04',
        'content' => '
[perfil_jugador nombre="Waclaw Golec"]
[capitular]En el verano de 1989, Juan Ruiz une a su elenco de estrellas a los internacionales polacos Ireneusz Klos y Waclaw Golec, llamados a ser ídolos y figuras diferenciales.[/capitular]
<p>La conexión entre Golec y Klos, junto con la potencia de Camarero y el liderazgo de Sánchez Jover, formó un cuarteto irrepetible que llevó al Guaguas a conquistar cinco Ligas consecutivas.</p>
[/perfil_jugador]'),
    array('title' => 'Ireneusz Klos', 'numero' => '', 'order' => 44, 'show_marker' => false, 'parent_ref' => 'cap04',
        'content' => '
[perfil_jugador nombre="Ireneusz Klos"]
[capitular]Ireneusz Klos aterrizó en Gran Canaria junto a su compatriota Golec en 1989 y rápidamente se convirtió en una de las piezas fundamentales del engranaje del Guaguas campeón.[/capitular]

[imagen_contenido src="' . libro_img('content/osmany-juantorena.png') . '" alt="Osmany Juantorena" caption="El Guaguas siempre ha contado con estrellas internacionales que elevaron el nivel del equipo."]

[cita_editorial]"Tener a un superclase como Golec, o Klos, que no sabías si iba a rematar o a colocar, considerado uno de los cinco mejores colocadores del mundo..."[/cita_editorial]
[/perfil_jugador]'),

    // Cap 06-23 with heroes and intro content
    array('title' => 'Ignacio Brito y Tributo a los Salesianos', 'numero' => '05', 'order' => 50, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-patio-colegio.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('IGNACIO BRITO', '#D4AF37'), libro_hero_line('Y TRIBUTO A', '#FFFFFF'), libro_hero_line('LOS SALESIANOS', '#FFFFFF'))),
        'content' => '[capitular]La historia del voleibol en Gran Canaria no puede entenderse sin la contribución de los Salesianos. Ignacio Brito, formado en las instalaciones del colegio salesiano, fue uno de los primeros técnicos que comprendió que la cantera era el verdadero tesoro del club.[/capitular]
[imagen_contenido src="' . libro_img('content/copa-del-rey.jpg') . '" alt="Los Salesianos, cuna del voleibol grancanario" caption="El colegio Salesiano fue uno de los principales viveros del voleibol en Las Palmas de Gran Canaria." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Marek', 'numero' => '06', 'order' => 55, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-europa.jpg'), 'overlay' => 'rgba(180, 30, 30, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'right', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('MAREK', '#FFFFFF'))),
        'content' => '[capitular]Marek llegó a Gran Canaria como una estrella internacional y se marchó convertido en leyenda. Su impacto en el Guaguas trascendió lo deportivo para convertirse en un referente cultural del voleibol en las islas.[/capitular]
[imagen_contenido src="' . libro_img('content/dobromir-saque.jpg') . '" alt="Momento de un saque" caption="El nivel técnico de los jugadores internacionales elevó la competitividad del Guaguas en todas las competiciones."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Embajadores por Europa', 'numero' => '07', 'order' => 60, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-europa.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.78)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('EMBAJADORES', '#D4AF37'), libro_hero_line('POR EUROPA', '#FFFFFF'))),
        'content' => '[capitular]La aventura europea del CV Guaguas es una de las páginas más brillantes de su historia. Desde la primera participación en la Copa de Europa hasta las campañas recientes en la Champions League, el club ha sido embajador del voleibol canario en los más prestigiosos escenarios del continente.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-champions.jpg') . '" alt="El CV Guaguas en competición europea" caption="La expedición del CV Guaguas antes de un partido de Champions League." fullwidth="true"]
[imagen_contenido src="' . libro_img('content/augusto-colito.jpg') . '" alt="Augusto Colito en la Champions League" caption="Augusto Colito, pieza clave del Guaguas en la Champions League 2025-2026."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Relevo generacional', 'numero' => '08', 'order' => 65, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-cantera.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '480px',
            'title_lines' => array(libro_hero_line('RELEVO', '#1a237e', '#FFFFFF'), libro_hero_line('GENERACIONAL', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]Cada generación del Guaguas ha sido el eslabón de una cadena ininterrumpida de talento canario. El relevo generacional ha sido una constante en la vida del club, desde los pioneros del Calvo Sotelo hasta los actuales jugadores de la cantera.[/capitular]
[imagen_contenido src="' . libro_img('content/nico-bruno.png') . '" alt="Nico Bruno" caption="Nico Bruno representa la nueva generación de jugadores que llegan al Guaguas con hambre de títulos."]
[imagen_contenido src="' . libro_img('content/helder-spencer.png') . '" alt="Hélder Spencer" caption="Hélder Spencer, uno de los refuerzos internacionales que alimentan la competitividad del equipo."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Una transición dolorosa', 'numero' => '09', 'order' => 70, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-transicion.jpg'), 'overlay' => 'rgba(0, 0, 0, 0.40)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('UNA TRANSICIÓN', '#8faabe'), libro_hero_line('DOLOROSA', '#FFFFFF'))),
        'content' => '[capitular]Los años posteriores a la marcha de Juan Ruiz fueron los más convulsos en la historia del club. La inestabilidad directiva, los problemas económicos y la pérdida progresiva de competitividad culminaron en el peor desenlace posible: la desaparición temporal del equipo en 2009.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-liga.jpeg') . '" alt="El equipo del CV Guaguas" caption="A pesar de las dificultades, el espíritu del Guaguas nunca se extinguió completamente." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Todos los títulos', 'numero' => '10', 'order' => 75, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-trophies.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.75)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 80, 'icon_height' => 80, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('TODOS', '#1a237e', '#FFFFFF'), libro_hero_line('LOS TÍTULOS', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]El palmarés del CV Guaguas es el más brillante del voleibol español. Nueve Ligas, nueve Copas del Rey, cinco Supercopas y una Copa Ibérica conforman un historial de éxitos que ningún otro club del país ha igualado.[/capitular]
[imagen_contenido src="' . libro_img('content/victoria-guaguas.png') . '" alt="El CV Guaguas celebra un título" caption="La celebración de los títulos ha sido una constante en la historia del club amarillo." fullwidth="true"]
[imagen_contenido src="' . libro_img('content/partido-guaguas.jpg') . '" alt="Ambiente en un partido del CV Guaguas" caption="El Centro Insular de Deportes y el Gran Canaria Arena han sido testigos de las gestas del club."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Vuelve el gran Guaguas', 'numero' => '11', 'order' => 80, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-celebracion.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.75)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'right', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('VUELVE', '#D4AF37'), libro_hero_line('EL GRAN', '#FFFFFF'), libro_hero_line('GUAGUAS', '#D4AF37'))),
        'content' => '[capitular]En 2020, cuando el club se encontraba de nuevo al borde del abismo, Juan Ruiz regresó para devolver al Guaguas a la élite. Su vuelta fue recibida con esperanza y emoción por una afición que no había olvidado los años gloriosos.[/capitular]
[imagen_contenido src="' . libro_img('content/remate-guaguas.png') . '" alt="Remate del CV Guaguas" caption="El regreso del Guaguas a los títulos confirmó que la leyenda no había terminado." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Del CID al Arenas', 'numero' => '12', 'order' => 85, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('DEL CID', '#D4AF37'), libro_hero_line('AL ARENAS', '#FFFFFF'))),
        'content' => '[capitular]Del Centro Insular de Deportes al Gran Canaria Arena: la evolución de la casa del voleibol grancanario. El CID fue durante décadas la catedral del voleibol en Canarias, un pabellón cuyo ambiente era temido por todos los rivales.[/capitular]
[imagen_contenido src="' . libro_img('content/banner-entradas.png') . '" alt="Cartelería del CV Guaguas en el Gran Canaria Arena" caption="El Gran Canaria Arena acoge hoy los grandes eventos del voleibol canario." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Los nuevos ídolos', 'numero' => '13', 'order' => 90, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-volleyball-match.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'right', 'vertical' => 'center', 'height' => '480px',
            'title_lines' => array(libro_hero_line('LOS NUEVOS', '#1a237e', '#FFFFFF'), libro_hero_line('ÍDOLOS', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]Una nueva generación de estrellas ha tomado el relevo en el Gran Canaria Arena. Los nuevos ídolos del Guaguas combinan talento internacional con la pasión local para escribir nuevos capítulos en la historia del club.[/capitular]
[imagen_contenido src="' . libro_img('content/walla-souza.png') . '" alt="Walla Souza" caption="Walla Souza, uno de los jugadores más determinantes del Guaguas actual."]
[imagen_contenido src="' . libro_img('content/augusto-colito-perfil.png') . '" alt="Augusto Colito" caption="Augusto Colito, internacional español y pilar del proyecto deportivo del Guaguas."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'El impacto del escudo', 'numero' => '14', 'order' => 95, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.88)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 90, 'icon_height' => 90, 'alignment' => 'center', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('EL IMPACTO', '#1a237e', '#FFFFFF'), libro_hero_line('DEL ESCUDO', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]El escudo del CV Guaguas es mucho más que un símbolo deportivo. Representa la identidad de un club que ha trascendido el voleibol para convertirse en un referente cultural de Gran Canaria y del deporte canario.[/capitular]
[imagen_contenido src="' . libro_img('content/jugador-accion.png') . '" alt="Jugador del CV Guaguas en acción" caption="El escudo del Guaguas, presente en cada camiseta que viste un jugador que sale a la cancha."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'La directiva', 'numero' => '15', 'order' => 100, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-estatutos.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'right', 'vertical' => 'center', 'height' => '420px',
            'title_lines' => array(libro_hero_line('LA', '#FFFFFF'), libro_hero_line('DIRECTIVA', '#D4AF37'))),
        'content' => '[capitular]Detrás de cada título y cada logro deportivo hay una estructura directiva que ha trabajado incansablemente por el bien del club. Desde los fundadores del Calvo Sotelo hasta la actual junta directiva, la gestión del Guaguas ha sido un ejemplo de compromiso y sacrificio.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-liga.jpeg') . '" alt="El equipo y cuerpo técnico del CV Guaguas" caption="La directiva y el cuerpo técnico, piezas fundamentales del engranaje del Guaguas."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'El Guaguas que viene', 'numero' => '16', 'order' => 105, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-cantera.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '480px',
            'title_lines' => array(libro_hero_line('EL GUAGUAS', '#D4AF37'), libro_hero_line('QUE VIENE', '#FFFFFF'))),
        'content' => '[capitular]El futuro del Guaguas se construye en la cantera. Los equipos de categorías inferiores trabajan cada día para formar a los jugadores que, algún día, defenderán los colores amarillos en la máxima competición.[/capitular]
[imagen_contenido src="' . libro_img('content/nico-bruno.png') . '" alt="Jóvenes promesas del CV Guaguas" caption="La apuesta por la cantera es una seña de identidad del club desde sus orígenes en el Calvo Sotelo." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Empleados y técnicos', 'numero' => '17', 'order' => 110, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(62, 39, 15, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'center', 'vertical' => 'center', 'height' => '420px',
            'title_lines' => array(libro_hero_line('EMPLEADOS', '#D4AF37'), libro_hero_line('Y TÉCNICOS', '#FFFFFF'))),
        'content' => '[capitular]Un club no funciona solo con jugadores. Detrás de cada partido, cada entrenamiento y cada evento hay un equipo de profesionales que hace posible la maquinaria del CV Guaguas.[/capitular]
[imagen_contenido src="' . libro_img('content/io-de-amo.png') . '" alt="Io De Amo" caption="Io De Amo, uno de los jugadores del plantel actual bajo la dirección técnica de Sergio Miguel Camarero."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'La plantilla del cincuentenario', 'numero' => '18', 'order' => 115, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-celebracion.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'right', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('LA PLANTILLA', '#1a237e', '#FFFFFF'), libro_hero_line('DEL', '#1a237e', '#FFFFFF'), libro_hero_line('CINCUENTENARIO', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]La temporada 2025-2026 marca el cincuentenario del Club Voleibol Guaguas. Una plantilla competitiva en cuatro frentes —Liga, Copa, Supercopa y Champions League— escribe las últimas líneas de esta historia de medio siglo de pasión por el voleibol.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-champions.jpg') . '" alt="La plantilla del CV Guaguas en la temporada del cincuentenario" caption="La plantilla del cincuentenario, competitiva en todas las competiciones nacionales y europeas." fullwidth="true"]
[imagen_contenido src="' . libro_img('content/jorge-almansa.png') . '" alt="Jorge Almansa" caption="Jorge Almansa, capitán y símbolo de una generación que honra el legado del club."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Miguel Ángel Ramírez', 'numero' => '19', 'order' => 120, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('MIGUEL ÁNGEL', '#D4AF37'), libro_hero_line('RAMÍREZ', '#FFFFFF'))),
        'content' => '[capitular]Miguel Ángel Ramírez, presidente de la UD Las Palmas, ha sido una figura clave en el apoyo institucional al CV Guaguas. Su visión del deporte como motor de la sociedad canaria ha permitido que el club cuente con los recursos necesarios para competir al máximo nivel.[/capitular]
[imagen_contenido src="' . libro_img('content/dobromir-saque.jpg') . '" alt="El CV Guaguas en competición" caption="El apoyo institucional ha sido fundamental para mantener la competitividad del club a nivel nacional y europeo."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Comunicación digital', 'numero' => '20', 'order' => 125, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-volleyball-match.jpg'), 'overlay' => 'rgba(30, 30, 60, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'right', 'vertical' => 'center', 'height' => '420px',
            'title_lines' => array(libro_hero_line('COMUNICACIÓN', '#D4AF37'), libro_hero_line('DIGITAL', '#FFFFFF'))),
        'content' => '[capitular]El CV Guaguas ha sido pionero en la comunicación digital dentro del deporte español. Su presencia en redes sociales, la producción de contenidos audiovisuales y la cobertura periodística propia han creado un modelo de referencia para otros clubes.[/capitular]
[imagen_contenido src="' . libro_img('content/banner-entradas.png') . '" alt="Comunicación digital del CV Guaguas" caption="La comunicación digital del Guaguas conecta al club con su afición en todos los rincones del mundo." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Socios y abonados', 'numero' => '21', 'order' => 130, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-celebracion.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'center', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('SOCIOS Y', '#D4AF37'), libro_hero_line('ABONADOS', '#FFFFFF'))),
        'content' => '[capitular]La afición del Guaguas es el motor del club. Desde aquellos primeros espectadores en el patio del colegio hasta los miles de abonados que llenan el Gran Canaria Arena, los socios han sido el alma del proyecto deportivo más exitoso del voleibol español.[/capitular]
[imagen_contenido src="' . libro_img('content/partido-guaguas.jpg') . '" alt="La afición del CV Guaguas en el Gran Canaria Arena" caption="La marea amarilla, incondicional con su equipo en cada partido, en cada competición." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Empresarios de la tierra', 'numero' => '22', 'order' => 135, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-estatutos.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('EMPRESARIOS', '#1a237e', '#FFFFFF'), libro_hero_line('DE LA TIERRA', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]El CV Guaguas ha contado siempre con el apoyo de empresarios canarios que creyeron en el proyecto. Desde Guaguas Municipales, el primer gran patrocinador, hasta las empresas que hoy respaldan al club, el tejido empresarial de la tierra ha sido pilar fundamental de la entidad.[/capitular]
[imagen_contenido src="' . libro_img('content/remate-guaguas.png') . '" alt="El CV Guaguas en acción con sus patrocinadores" caption="Los patrocinadores locales han sido parte esencial de la historia del club, acompañándolo en cada etapa."]
<p>Contenido pendiente de importación del documento original.</p>'),

    ); // end chapters array
}

/**
 * Añadir botón en admin para reimportar contenido
 */
function libro_add_reimport_button() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    if (isset($_GET['libro_reimport']) && $_GET['libro_reimport'] === '1') {
        if (wp_verify_nonce($_GET['_wpnonce'], 'libro_reimport_content')) {
            $capitulos = get_posts(array(
                'post_type' => 'capitulo',
                'posts_per_page' => -1,
                'post_status' => 'any',
            ));
            
            foreach ($capitulos as $cap) {
                wp_delete_post($cap->ID, true);
            }
            
            libro_import_sample_content();
            
            wp_redirect(admin_url('edit.php?post_type=capitulo&reimported=1'));
            exit;
        }
    }
    
    if (isset($_GET['reimported']) && $_GET['reimported'] === '1') {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>¡Contenido reimportado!</strong> Todos los capítulos han sido recreados con el contenido completo, heroes e imágenes.</p>
            </div>
            <?php
        });
    }
}
add_action('admin_init', 'libro_add_reimport_button');

/**
 * Añadir enlace de reimportar en la página de capítulos
 */
function libro_add_reimport_link($views) {
    if (!current_user_can('manage_options')) {
        return $views;
    }
    
    $reimport_url = wp_nonce_url(
        admin_url('edit.php?post_type=capitulo&libro_reimport=1'),
        'libro_reimport_content'
    );
    
    $views['reimport'] = '<a href="' . esc_url($reimport_url) . '" class="reimport-link" style="color: #d63638;" onclick="return confirm(\'¿Estás seguro? Esto eliminará todos los capítulos existentes y los reemplazará por el contenido completo.\');">🔄 Reimportar contenido de ejemplo</a>';
    
    return $views;
}
add_filter('views_edit-capitulo', 'libro_add_reimport_link');
