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
    // CAPÍTULO 01: PRÓLOGOS (PADRE)
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Prólogos',
        'numero' => '01',
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

    // Prólogos individuales (hijos)
    array('title' => 'Fernando Clavijo', 'numero' => '', 'order' => 2, 'show_marker' => false, 'parent_ref' => 'prologos',
        'content' => '<p><strong>Fernando Clavijo</strong>, presidente del Gobierno de Canarias.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Antonio Morales', 'numero' => '', 'order' => 3, 'show_marker' => false, 'parent_ref' => 'prologos',
        'content' => '<p><strong>Antonio Morales</strong>, presidente del Cabildo de Gran Canaria.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Carolina Darias', 'numero' => '', 'order' => 4, 'show_marker' => false, 'parent_ref' => 'prologos',
        'content' => '<p><strong>Carolina Darias</strong>, alcaldesa de Las Palmas de Gran Canaria.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Roberto Melián', 'numero' => '', 'order' => 5, 'show_marker' => false, 'parent_ref' => 'prologos',
        'content' => '<p><strong>Roberto Melián</strong>, presidente de la Federación Canaria de Voleibol.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Jorge Almansa', 'numero' => '', 'order' => 6, 'show_marker' => false, 'parent_ref' => 'prologos',
        'content' => '<p><strong>Jorge Almansa</strong>, capitán del CV Guaguas.</p><p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Juan Ruiz', 'numero' => '', 'order' => 7, 'show_marker' => false, 'parent_ref' => 'prologos',
        'content' => '<p><strong>Juan Ruiz</strong>, presidente del CV Guaguas.</p><p>Texto del prólogo pendiente de redacción.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 02: DEL PATIO DEL COLEGIO
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Del patio del colegio a División de Honor',
        'numero' => '02',
        'order' => 12,
        'show_marker' => true,
        'ref_id' => 'cap02',
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
    array('title' => 'Felipe Nuez', 'numero' => '', 'order' => 13, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '
[perfil_jugador nombre="Felipe Nuez"]
[capitular]Felipe Nuez (Moya, 1956) es la figura fundamental y maestra en la vida del club. Presente desde el mismo inicio de la actividad escolar que se dedicó al voleibol con especial ahínco, llegó como profesor en prácticas al colegio Calvo Sotelo en 1973 sin saber que, junto a otros precursores, iniciaría una historia de superación y éxitos que todavía perdura y que es, también, orgullo del deporte canario.[/capitular]

<p>"Como todos los chicos de la época, empecé en el fútbol. Pero Giráldez me dijo que me veía condiciones mejores para el voleibol y le hice caso. Lo disfruté más en la faceta de entrenador, aunque hice alguna vez de árbitro y asumí otras responsabilidades. Como jugador no destacaba especialmente en nada y supe darme cuenta para volcarme en lo que siempre me gustó", incide.</p>

<p>"Fui autodidacta. Obtuve el título de entrenador nacional con 20 años y, en 1984, el de técnico internacional. En esos años de los comienzos, la única manera de ampliar conocimientos en el voleibol era explorando métodos de trabajo en otros países, como Japón, que era una potencia inalcanzable por su nivel de desarrollo."</p>

[cita_editorial]"Entrenara a cadetes, juveniles o séniors. El trabajo, el compromiso y el sacrificio eran para mí innegociables. De lo contrario, prefería quedarme en mi casa."[/cita_editorial]
[/perfil_jugador]
'),
    array('title' => 'José Miguel Santana', 'numero' => '', 'order' => 14, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '[perfil_jugador nombre="José Miguel Santana"][capitular]José Miguel Santana fue una pieza fundamental en la construcción del Calvo Sotelo durante sus primeros años de existencia. Su compromiso con el proyecto y su entrega en la pista le convirtieron en uno de los referentes del equipo en la época de los ascensos y la consolidación en las categorías nacionales.[/capitular]<p>Como parte del grupo de jugadores que creció bajo la tutela de Felipe Nuez, Santana encarnó los valores de sacrificio y superación que definieron al club desde sus orígenes en el patio del colegio de Las Rehoyas.</p>[/perfil_jugador]'),
    array('title' => 'Florencio Tejera', 'numero' => '', 'order' => 15, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '[perfil_jugador nombre="Florencio Tejera"][capitular]Florencio Tejera perteneció al núcleo de jugadores y entrenadores que dieron forma al Calvo Sotelo en su etapa formativa. Además de su aportación como jugador, asumió funciones de entrenador en las categorías inferiores, contribuyendo a la formación de nuevos talentos que alimentarían el crecimiento del club.[/capitular]<p>Su polivalencia y entrega fueron características de una generación de deportistas que lo dieron todo por un proyecto nacido en la humildad de un colegio de barrio y que terminaría alcanzando la cima del voleibol español.</p>[/perfil_jugador]'),
    array('title' => 'Tony Vázquez', 'numero' => '', 'order' => 16, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '[perfil_jugador nombre="Tony Vázquez"][capitular]Tony Vázquez formó con Pericles una línea de recepción formidable que fue seña de identidad del Calvo Sotelo durante varios años. Su talento y constancia le convirtieron en uno de los jugadores más destacados de la formación que protagonizó los ascensos y la llegada a la máxima categoría del voleibol español.[/capitular]<p>Vázquez también contribuyó como entrenador en las categorías femeninas del club, demostrando un compromiso integral con la entidad que iba más allá de su rol como jugador.</p>[/perfil_jugador]'),
    array('title' => 'Isidro Quintana', 'numero' => '', 'order' => 17, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '
[perfil_jugador nombre="Isidro Quintana"]
[capitular]A Isidro Quintana (Las Palmas de Gran Canaria, 1957) le metieron el voleibol en su vida "por obligación", como reconoce, porque, integrado en la sección de baloncesto de la UD Las Palmas durante su adolescencia ("llegué a jugar contra Domingo Díaz, que luego ha sido lo que ha sido"), iba para pívot con su imponente estatura en plena pubertad.[/capitular]

<p>"Pero se me cruzó en el camino Silvestre Cabrera, que me daba clases en los Salesianos, y me dijo, medio en serio, medio en broma, que o hacía voleibol o me suspendía. Me convenció prometiéndome que me llevaría directamente a la selección júnior. Empecé y ya no lo dejé. Fue mi interés que me saqué la titulación nacional de entrenador con 17 o 18 años para tener una formación más amplia y poder dirigir equipos."</p>

<p>Para mí es el rey, la persona clave. No se entiende el Guaguas sin Juan Ruiz y creo que no se entiende Juan Ruiz sin el Guaguas. Apostó por traer extranjeros, por ir a por los mejores jugadores que había en los rivales. Era la única manera de hacer un proyecto ganador.</p>
[/perfil_jugador]
'),
    array('title' => 'Pericles', 'numero' => '', 'order' => 18, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '
[perfil_jugador nombre="Pericles" subtitulo="Pedro Román Rosario"]
[capitular]Un pelo abundante y la barba que le daba aires intelectuales le valieron el apodo, Pericles, con el que se incrustaría, por derecho propio, en el listado de imprescindibles del Calvo Sotelo. "Me dijeron, medio en serio medio en broma, que me parecía a Pericles. No me lo tomé mal y así me quedé", admite. Pedro Román Rosario (Las Palmas de Gran Canaria, 1958) no fue uno más.[/capitular]

[cita_editorial]"Salía a la cancha con mi Ventolín para poder resistir los esfuerzos. En los tiempos muertos y descansos casi prefería el fuelle que me daba el medicamento al agua. Y alguna vez me pincharon por las asfixias que me entraban."[/cita_editorial]

<p>Pericles comenzó a jugar en el colegio Santa Catalina ("sobre un patio de tierra y piedras") y, antes de definir sus pasos, probó en el balonmano y el fútbol. "Cuando Felipe Nuez me llamó para formar parte del equipo absoluto del Calvo Sotelo ahí ya me dije que quería el futuro dentro del voleibol porque me gustaba, se me daba bien."</p>

<p>"Me tomo como un halago el respeto y las muestras de cariño que siempre me dieron todos los compañeros. Nunca me consideré más o mejor que nadie. Pero en lo que sí era muy estricto era en el sentido de la justicia y en pedir a todos que dieran lo que llevaban dentro en beneficio del equipo."</p>

<p>"Hicimos de todo para lograr medios económicos y, por ejemplo, poder realizar viajes. Felipe Nuez y yo nos turnábamos como conductores para desplazar al resto. Si no había guagua, ya sabíamos lo que nos tocaba. Cádiz-Cáceres, por ejemplo, del tirón y en las carreteras de antes."</p>

<p>"Mi etapa llegó hasta el inicio de la temporada 1986-87, justo con la llegada de Ivo Martinovic. Desde 1977, que se dice pronto. En ese momento sentí que no estaba capacitado para dar el nivel que requería un equipo ya con los mejores de España. Decidí irme."</p>
[/perfil_jugador]
'),
    array('title' => 'José Millán', 'numero' => '', 'order' => 19, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '
[perfil_jugador nombre="José Millán"]
[capitular]Si la figura de Silvestre Cabrera fue de trascendencia capital para auspiciar el voleibol durante su mandato como presidente de la Federación de Las Palmas (1973-1985), no es menos relevante la influencia, también de enorme impacto, de José Millán, quien en diciembre de 1976 asume el cargo de secretario del ente presidido por Cabrera, toma su relevo a la conclusión de su ciclo como máximo mandatario y termina encabezando la Federación Canaria de Voleibol hasta 2008.[/capitular]

<p>Millán (Sevilla, 1933) es otro de los testigos que vivió, desde los inicios hasta su desarrollo, pasando por la eclosión de los títulos, la vida del Calvo Sotelo, una entidad a la que reconoce tener "mucho cariño y respeto" por la contribución que hizo en la historia del deporte en Canarias.</p>

[cita_editorial]"Hay que valorar lo que hicieron, saliendo de un colegio y con muy pocos medios. Fueron superándose, nunca se rindieron ante las dificultades."[/cita_editorial]
[/perfil_jugador]
'),
    array('title' => 'Miriam Quiroga', 'numero' => '', 'order' => 20, 'show_marker' => false, 'parent_ref' => 'cap02',
        'content' => '
[perfil_jugador nombre="Miriam Quiroga"]
[capitular]Miriam Quiroga, licenciada en Educación Física y profesora universitaria, publicó en el año 2010 el libro \'Génesis y evolución del voleibol en Gran Canaria 1934-1978\', editado por el Servicio de Publicaciones de la Universidad de Las Palmas de Gran Canaria.[/capitular]

[seccion_header]Contribución del Calvo Sotelo y técnicos pioneros[/seccion_header]

<p>"La contribución del Colegio Nacional Calvo Sotelo y de técnicos pioneros como Francisco Rodríguez Álvarez, Miguel Nieves Toledo, Félix Rodríguez Delgado y Felipe Nuez Domínguez es fundamental en el desarrollo del voleibol en Gran Canaria."</p>

[cita_editorial]"Todos los momentos vividos en la historia del Club Voleibol Calvo Sotelo constituyen un valioso legado para el deporte canario. Pero, sobre todo, queda la constatación de que si se hace un buen trabajo, tanto desde el punto de vista deportivo como organizativo, se consiguen excelentes resultados."[/cita_editorial]
[/perfil_jugador]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 03: ESTATUTOS FUNDACIONALES
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Estatutos Fundacionales',
        'numero' => '03',
        'order' => 25,
        'show_marker' => true,
        'hero' => array(
            'image' => libro_img('hero-estatutos.jpg'),
            'overlay' => 'rgba(62, 39, 15, 0.75)',
            'icon' => 'custom', 'custom_icon' => $star,
            'icon_width' => 50, 'icon_height' => 50,
            'alignment' => 'left', 'vertical' => 'center',
            'height' => '420px',
            'title_lines' => array(
                libro_hero_line('ESTATUTOS', '#D4AF37'),
                libro_hero_line('FUNDACIONALES', '#FFFFFF'),
            ),
        ),
        'content' => '
[seccion_header]Capítulo I. Constitución, fines y domicilio[/seccion_header]

[articulo numero="1º"]El nombre que adoptará la nueva entidad será el de Club Voleibol Calvo Sotelo.[/articulo]
[articulo numero="2º"]El objeto de la presente entidad es el fomento y práctica del deporte entre los asociados y, en especial, el Voleibol.[/articulo]
[articulo numero="3º"]Podrá asimismo la presente entidad ampliar sus funciones deportivas con otras secciones secundarias, recreativas o de otros deportes, siempre que lo acuerden la junta directiva.[/articulo]
[articulo numero="4º"]La entidad, que con todos sus socios y componentes quedan sujetos a la jurisdicción de la Delegación Nacional de Deportes, Comité Olímpico Español, Federación Española de Voleibol.[/articulo]
[articulo numero="5º"]Se fija el domicilio de la entidad en Las Palmas, calle Montejurra, número 1.[/articulo]
[articulo numero="6º"]La duración de la entidad es por tiempo indefinido.[/articulo]

[seccion_header]Capítulo II. De los socios[/seccion_header]

[articulo numero="7º"]La entidad Club Voleibol Calvo Sotelo se compondrá de las siguientes clases de socios: de HONOR y ACTIVOS.[/articulo]
[articulo numero="8º"]Todos los socios, sea cual fuese su categoría, tendrán el libre acceso a los locales y campos de la entidad.[/articulo]
[articulo numero="9º"]Todo socio viene obligado a comunicar por escrito a la directiva las deficiencias que observe en las instalaciones.[/articulo]
[articulo numero="10º"]De acuerdo con las asambleas, la junta directiva impondrá una cuota de entrada a los socios, según las necesidades de la entidad.[/articulo]
[articulo numero="11º"]Podrá nombrarse presidente de la entidad a quien por su relevante personalidad y especiales condiciones sea propuesto y elegido.[/articulo]

[seccion_header]Capítulo III. Del Gobierno de la Sociedad[/seccion_header]

[articulo numero="20º"]La entidad estará dirigida, regida y administrada de conformidad con los presentes estatutos por la junta directiva.[/articulo]
[articulo numero="21º"]La junta directiva se compondrá: presidente, uno o dos vicepresidentes, secretario, tesorero contador y el número de vocales que se estime conveniente.[/articulo]
[articulo numero="23º"]El presidente convocará junta directiva todas las veces que estime necesario y, al menos, una vez cada mes.[/articulo]
[articulo numero="24º"]Los acuerdos de la junta directiva se tomarán por mayoría de votación, teniendo cada componente un voto y, en caso de empate, decidirá el voto del presidente.[/articulo]
[articulo numero="25º"]El presidente tendrá la representación legal y jurídica de la entidad, dirigirá los debates y discusiones y velará para que se cumplan los acuerdos.[/articulo]

[seccion_header]Capítulo IV. De la administración de la Entidad[/seccion_header]

[articulo numero="44º"]De conformidad con los artículos 27 y 28 de los presentes estatutos, llevarán la administración y contabilidad de la entidad el tesorero y contador.[/articulo]
[articulo numero="45º"]La entidad dará cuenta a sus socios, una vez al año por lo menos, en una memoria presentada a la asamblea general ordinaria, de su gestión deportiva y económica y de sus proyectos para el futuro.[/articulo]
',
    ),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 04: ASÍ SE FORJÓ UNA LEYENDA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Así se forjó una leyenda',
        'numero' => '04',
        'order' => 30,
        'show_marker' => true,
        'ref_id' => 'cap04',
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
    array('title' => 'El proyecto visionario de Juan Ruiz', 'numero' => '', 'order' => 31, 'show_marker' => false, 'parent_ref' => 'cap04',
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
    // CAPÍTULOS 05-23 (con hero y contenido)
    // ═══════════════════════════════════════════════

    // Cap 05
    array(
        'title' => 'Iconos y estrellas del Guaguas', 'numero' => '05', 'order' => 40, 'show_marker' => true, 'ref_id' => 'cap05',
        'hero' => array('image' => libro_img('hero-volleyball-match.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 80, 'icon_height' => 80, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('ICONOS Y', '#1a237e', '#FFFFFF'), libro_hero_line('ESTRELLAS', '#1a237e', '#FFFFFF'), libro_hero_line('DEL GUAGUAS', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]Los grandes nombres que han escrito la historia del CV Guaguas. Jugadores que dejaron su huella en el voleibol español y que convirtieron al club en leyenda. Desde los canteranos que crecieron en el patio del Calvo Sotelo hasta las estrellas internacionales que llegaron para elevar el proyecto a cotas inimaginables, todos contribuyeron a forjar un legado deportivo sin parangón en Canarias.[/capitular]
[imagen_contenido src="' . libro_img('content/jugador-accion.png') . '" alt="Jugador del CV Guaguas en acción" caption="El talento individual al servicio del colectivo: seña de identidad del Guaguas a lo largo de su historia." fullwidth="true"]'),

    // Cap 05 children
    array('title' => 'Sergio Miguel Camarero', 'numero' => '', 'order' => 41, 'show_marker' => false, 'parent_ref' => 'cap05',
        'content' => '
[perfil_jugador nombre="Sergio Miguel Camarero"]
[capitular]Cuando Sergio Miguel Camarero (Las Palmas de Gran Canaria, 1967) destacaba en el fútbol y como prometedor jugador del San Antonio, el equipo de su barrio, ya soñaba con hacer historia en el deporte.[/capitular]

[imagen_contenido src="' . libro_img('content/jorge-almansa.png') . '" alt="Jorge Almansa, capitán del CV Guaguas" caption="Jorge Almansa, actual capitán del CV Guaguas, heredero de una larga tradición de líderes en la cancha."]

<p>"Era una época complicada en la calle, el riesgo de las malas influencias. Mi suerte fue que elegí el deporte, el voleibol, y conocí a una persona como Felipe Nuez con la que pude crecer y desarrollarme en el mejor ambiente posible."</p>

[cita_editorial]"Pude irme en el inicio de mi carrera. Me llamó del Cisneros Miguel Ocón. Pero aposté por quedarme en mi tierra y no me equivoqué."[/cita_editorial]

<p>Sergio Miguel Camarero acumuló 48 internacionalidades absolutas y 10 títulos oficiales (5 Ligas y 5 Copas).</p>
[/perfil_jugador]'),
    array('title' => 'Paco Sánchez Jover', 'numero' => '', 'order' => 42, 'show_marker' => false, 'parent_ref' => 'cap05',
        'content' => '
[perfil_jugador nombre="Paco Sánchez Jover"]
[capitular]Paco Sánchez Jover es, junto a Camarero, el otro gran pilar sobre el que se construyó la leyenda del Guaguas. Llegado en el verano de 1987 como el gran fichaje estrella de Juan Ruiz, el mejor jugador de España en aquel momento.[/capitular]

<p>Su fichaje fue una auténtica jugada maestra de Juan Ruiz. Con Sánchez Jover llegaron su hermano Jesús, Venancio Costa y Antonio Miralles.</p>

[cita_editorial]"Todo cambió y para peor. Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos."[/cita_editorial]
[/perfil_jugador]'),
    array('title' => 'Waclaw Golec', 'numero' => '', 'order' => 43, 'show_marker' => false, 'parent_ref' => 'cap05',
        'content' => '
[perfil_jugador nombre="Waclaw Golec"]
[capitular]En el verano de 1989, Juan Ruiz une a su elenco de estrellas a los internacionales polacos Ireneusz Klos y Waclaw Golec, llamados a ser ídolos y figuras diferenciales.[/capitular]
<p>La conexión entre Golec y Klos, junto con la potencia de Camarero y el liderazgo de Sánchez Jover, formó un cuarteto irrepetible que llevó al Guaguas a conquistar cinco Ligas consecutivas.</p>
[/perfil_jugador]'),
    array('title' => 'Ireneusz Klos', 'numero' => '', 'order' => 44, 'show_marker' => false, 'parent_ref' => 'cap05',
        'content' => '
[perfil_jugador nombre="Ireneusz Klos"]
[capitular]Ireneusz Klos aterrizó en Gran Canaria junto a su compatriota Golec en 1989 y rápidamente se convirtió en una de las piezas fundamentales del engranaje del Guaguas campeón.[/capitular]

[imagen_contenido src="' . libro_img('content/osmany-juantorena.png') . '" alt="Osmany Juantorena" caption="El Guaguas siempre ha contado con estrellas internacionales que elevaron el nivel del equipo."]

[cita_editorial]"Tener a un superclase como Golec, o Klos, que no sabías si iba a rematar o a colocar, considerado uno de los cinco mejores colocadores del mundo..."[/cita_editorial]
[/perfil_jugador]'),

    // Cap 06-23 with heroes and intro content
    array('title' => 'Ignacio Brito y Tributo a los Salesianos', 'numero' => '06', 'order' => 50, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-patio-colegio.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('IGNACIO BRITO', '#D4AF37'), libro_hero_line('Y TRIBUTO A', '#FFFFFF'), libro_hero_line('LOS SALESIANOS', '#FFFFFF'))),
        'content' => '[capitular]La historia del voleibol en Gran Canaria no puede entenderse sin la contribución de los Salesianos. Ignacio Brito, formado en las instalaciones del colegio salesiano, fue uno de los primeros técnicos que comprendió que la cantera era el verdadero tesoro del club.[/capitular]
[imagen_contenido src="' . libro_img('content/copa-del-rey.jpg') . '" alt="Los Salesianos, cuna del voleibol grancanario" caption="El colegio Salesiano fue uno de los principales viveros del voleibol en Las Palmas de Gran Canaria." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Marek', 'numero' => '07', 'order' => 55, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-europa.jpg'), 'overlay' => 'rgba(180, 30, 30, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'right', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('MAREK', '#FFFFFF'))),
        'content' => '[capitular]Marek llegó a Gran Canaria como una estrella internacional y se marchó convertido en leyenda. Su impacto en el Guaguas trascendió lo deportivo para convertirse en un referente cultural del voleibol en las islas.[/capitular]
[imagen_contenido src="' . libro_img('content/dobromir-saque.jpg') . '" alt="Momento de un saque" caption="El nivel técnico de los jugadores internacionales elevó la competitividad del Guaguas en todas las competiciones."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Embajadores por Europa', 'numero' => '08', 'order' => 60, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-europa.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.78)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('EMBAJADORES', '#D4AF37'), libro_hero_line('POR EUROPA', '#FFFFFF'))),
        'content' => '[capitular]La aventura europea del CV Guaguas es una de las páginas más brillantes de su historia. Desde la primera participación en la Copa de Europa hasta las campañas recientes en la Champions League, el club ha sido embajador del voleibol canario en los más prestigiosos escenarios del continente.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-champions.jpg') . '" alt="El CV Guaguas en competición europea" caption="La expedición del CV Guaguas antes de un partido de Champions League." fullwidth="true"]
[imagen_contenido src="' . libro_img('content/augusto-colito.jpg') . '" alt="Augusto Colito en la Champions League" caption="Augusto Colito, pieza clave del Guaguas en la Champions League 2025-2026."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Relevo generacional', 'numero' => '09', 'order' => 65, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-cantera.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '480px',
            'title_lines' => array(libro_hero_line('RELEVO', '#1a237e', '#FFFFFF'), libro_hero_line('GENERACIONAL', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]Cada generación del Guaguas ha sido el eslabón de una cadena ininterrumpida de talento canario. El relevo generacional ha sido una constante en la vida del club, desde los pioneros del Calvo Sotelo hasta los actuales jugadores de la cantera.[/capitular]
[imagen_contenido src="' . libro_img('content/nico-bruno.png') . '" alt="Nico Bruno" caption="Nico Bruno representa la nueva generación de jugadores que llegan al Guaguas con hambre de títulos."]
[imagen_contenido src="' . libro_img('content/helder-spencer.png') . '" alt="Hélder Spencer" caption="Hélder Spencer, uno de los refuerzos internacionales que alimentan la competitividad del equipo."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Una transición dolorosa', 'numero' => '10', 'order' => 70, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-transicion.jpg'), 'overlay' => 'rgba(0, 0, 0, 0.40)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('UNA TRANSICIÓN', '#8faabe'), libro_hero_line('DOLOROSA', '#FFFFFF'))),
        'content' => '[capitular]Los años posteriores a la marcha de Juan Ruiz fueron los más convulsos en la historia del club. La inestabilidad directiva, los problemas económicos y la pérdida progresiva de competitividad culminaron en el peor desenlace posible: la desaparición temporal del equipo en 2009.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-liga.jpeg') . '" alt="El equipo del CV Guaguas" caption="A pesar de las dificultades, el espíritu del Guaguas nunca se extinguió completamente." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Todos los títulos', 'numero' => '11', 'order' => 75, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-trophies.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.75)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 80, 'icon_height' => 80, 'alignment' => 'center', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('TODOS', '#1a237e', '#FFFFFF'), libro_hero_line('LOS TÍTULOS', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]El palmarés del CV Guaguas es el más brillante del voleibol español. Nueve Ligas, nueve Copas del Rey, cinco Supercopas y una Copa Ibérica conforman un historial de éxitos que ningún otro club del país ha igualado.[/capitular]
[imagen_contenido src="' . libro_img('content/victoria-guaguas.png') . '" alt="El CV Guaguas celebra un título" caption="La celebración de los títulos ha sido una constante en la historia del club amarillo." fullwidth="true"]
[imagen_contenido src="' . libro_img('content/partido-guaguas.jpg') . '" alt="Ambiente en un partido del CV Guaguas" caption="El Centro Insular de Deportes y el Gran Canaria Arena han sido testigos de las gestas del club."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Vuelve el gran Guaguas', 'numero' => '12', 'order' => 80, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-celebracion.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.75)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'right', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('VUELVE', '#D4AF37'), libro_hero_line('EL GRAN', '#FFFFFF'), libro_hero_line('GUAGUAS', '#D4AF37'))),
        'content' => '[capitular]En 2020, cuando el club se encontraba de nuevo al borde del abismo, Juan Ruiz regresó para devolver al Guaguas a la élite. Su vuelta fue recibida con esperanza y emoción por una afición que no había olvidado los años gloriosos.[/capitular]
[imagen_contenido src="' . libro_img('content/remate-guaguas.png') . '" alt="Remate del CV Guaguas" caption="El regreso del Guaguas a los títulos confirmó que la leyenda no había terminado." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Del CID al Arenas', 'numero' => '13', 'order' => 85, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('DEL CID', '#D4AF37'), libro_hero_line('AL ARENAS', '#FFFFFF'))),
        'content' => '[capitular]Del Centro Insular de Deportes al Gran Canaria Arena: la evolución de la casa del voleibol grancanario. El CID fue durante décadas la catedral del voleibol en Canarias, un pabellón cuyo ambiente era temido por todos los rivales.[/capitular]
[imagen_contenido src="' . libro_img('content/banner-entradas.png') . '" alt="Cartelería del CV Guaguas en el Gran Canaria Arena" caption="El Gran Canaria Arena acoge hoy los grandes eventos del voleibol canario." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Los nuevos ídolos', 'numero' => '14', 'order' => 90, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-volleyball-match.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'right', 'vertical' => 'center', 'height' => '480px',
            'title_lines' => array(libro_hero_line('LOS NUEVOS', '#1a237e', '#FFFFFF'), libro_hero_line('ÍDOLOS', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]Una nueva generación de estrellas ha tomado el relevo en el Gran Canaria Arena. Los nuevos ídolos del Guaguas combinan talento internacional con la pasión local para escribir nuevos capítulos en la historia del club.[/capitular]
[imagen_contenido src="' . libro_img('content/walla-souza.png') . '" alt="Walla Souza" caption="Walla Souza, uno de los jugadores más determinantes del Guaguas actual."]
[imagen_contenido src="' . libro_img('content/augusto-colito-perfil.png') . '" alt="Augusto Colito" caption="Augusto Colito, internacional español y pilar del proyecto deportivo del Guaguas."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'El impacto del escudo', 'numero' => '15', 'order' => 95, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.88)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 90, 'icon_height' => 90, 'alignment' => 'center', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('EL IMPACTO', '#1a237e', '#FFFFFF'), libro_hero_line('DEL ESCUDO', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]El escudo del CV Guaguas es mucho más que un símbolo deportivo. Representa la identidad de un club que ha trascendido el voleibol para convertirse en un referente cultural de Gran Canaria y del deporte canario.[/capitular]
[imagen_contenido src="' . libro_img('content/jugador-accion.png') . '" alt="Jugador del CV Guaguas en acción" caption="El escudo del Guaguas, presente en cada camiseta que viste un jugador que sale a la cancha."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'La directiva', 'numero' => '16', 'order' => 100, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-estatutos.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'right', 'vertical' => 'center', 'height' => '420px',
            'title_lines' => array(libro_hero_line('LA', '#FFFFFF'), libro_hero_line('DIRECTIVA', '#D4AF37'))),
        'content' => '[capitular]Detrás de cada título y cada logro deportivo hay una estructura directiva que ha trabajado incansablemente por el bien del club. Desde los fundadores del Calvo Sotelo hasta la actual junta directiva, la gestión del Guaguas ha sido un ejemplo de compromiso y sacrificio.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-liga.jpeg') . '" alt="El equipo y cuerpo técnico del CV Guaguas" caption="La directiva y el cuerpo técnico, piezas fundamentales del engranaje del Guaguas."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'El Guaguas que viene', 'numero' => '17', 'order' => 105, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-cantera.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '480px',
            'title_lines' => array(libro_hero_line('EL GUAGUAS', '#D4AF37'), libro_hero_line('QUE VIENE', '#FFFFFF'))),
        'content' => '[capitular]El futuro del Guaguas se construye en la cantera. Los equipos de categorías inferiores trabajan cada día para formar a los jugadores que, algún día, defenderán los colores amarillos en la máxima competición.[/capitular]
[imagen_contenido src="' . libro_img('content/nico-bruno.png') . '" alt="Jóvenes promesas del CV Guaguas" caption="La apuesta por la cantera es una seña de identidad del club desde sus orígenes en el Calvo Sotelo." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Empleados y técnicos', 'numero' => '18', 'order' => 110, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(62, 39, 15, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'center', 'vertical' => 'center', 'height' => '420px',
            'title_lines' => array(libro_hero_line('EMPLEADOS', '#D4AF37'), libro_hero_line('Y TÉCNICOS', '#FFFFFF'))),
        'content' => '[capitular]Un club no funciona solo con jugadores. Detrás de cada partido, cada entrenamiento y cada evento hay un equipo de profesionales que hace posible la maquinaria del CV Guaguas.[/capitular]
[imagen_contenido src="' . libro_img('content/io-de-amo.png') . '" alt="Io De Amo" caption="Io De Amo, uno de los jugadores del plantel actual bajo la dirección técnica de Sergio Miguel Camarero."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'La plantilla del cincuentenario', 'numero' => '19', 'order' => 115, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-celebracion.jpg'), 'overlay' => 'rgba(212, 175, 55, 0.82)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 70, 'icon_height' => 70, 'alignment' => 'right', 'vertical' => 'center', 'height' => '500px',
            'title_lines' => array(libro_hero_line('LA PLANTILLA', '#1a237e', '#FFFFFF'), libro_hero_line('DEL', '#1a237e', '#FFFFFF'), libro_hero_line('CINCUENTENARIO', '#1a237e', '#FFFFFF'))),
        'content' => '[capitular]La temporada 2025-2026 marca el cincuentenario del Club Voleibol Guaguas. Una plantilla competitiva en cuatro frentes —Liga, Copa, Supercopa y Champions League— escribe las últimas líneas de esta historia de medio siglo de pasión por el voleibol.[/capitular]
[imagen_contenido src="' . libro_img('content/equipo-champions.jpg') . '" alt="La plantilla del CV Guaguas en la temporada del cincuentenario" caption="La plantilla del cincuentenario, competitiva en todas las competiciones nacionales y europeas." fullwidth="true"]
[imagen_contenido src="' . libro_img('content/jorge-almansa.png') . '" alt="Jorge Almansa" caption="Jorge Almansa, capitán y símbolo de una generación que honra el legado del club."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Miguel Ángel Ramírez', 'numero' => '20', 'order' => 120, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-stadium.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'left', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('MIGUEL ÁNGEL', '#D4AF37'), libro_hero_line('RAMÍREZ', '#FFFFFF'))),
        'content' => '[capitular]Miguel Ángel Ramírez, presidente de la UD Las Palmas, ha sido una figura clave en el apoyo institucional al CV Guaguas. Su visión del deporte como motor de la sociedad canaria ha permitido que el club cuente con los recursos necesarios para competir al máximo nivel.[/capitular]
[imagen_contenido src="' . libro_img('content/dobromir-saque.jpg') . '" alt="El CV Guaguas en competición" caption="El apoyo institucional ha sido fundamental para mantener la competitividad del club a nivel nacional y europeo."]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Comunicación digital', 'numero' => '21', 'order' => 125, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-volleyball-match.jpg'), 'overlay' => 'rgba(30, 30, 60, 0.85)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 50, 'icon_height' => 50, 'alignment' => 'right', 'vertical' => 'center', 'height' => '420px',
            'title_lines' => array(libro_hero_line('COMUNICACIÓN', '#D4AF37'), libro_hero_line('DIGITAL', '#FFFFFF'))),
        'content' => '[capitular]El CV Guaguas ha sido pionero en la comunicación digital dentro del deporte español. Su presencia en redes sociales, la producción de contenidos audiovisuales y la cobertura periodística propia han creado un modelo de referencia para otros clubes.[/capitular]
[imagen_contenido src="' . libro_img('content/banner-entradas.png') . '" alt="Comunicación digital del CV Guaguas" caption="La comunicación digital del Guaguas conecta al club con su afición en todos los rincones del mundo." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Socios y abonados', 'numero' => '22', 'order' => 130, 'show_marker' => true,
        'hero' => array('image' => libro_img('hero-celebracion.jpg'), 'overlay' => 'rgba(26, 35, 126, 0.80)', 'icon' => 'custom', 'custom_icon' => $star, 'icon_width' => 60, 'icon_height' => 60, 'alignment' => 'center', 'vertical' => 'center', 'height' => '450px',
            'title_lines' => array(libro_hero_line('SOCIOS Y', '#D4AF37'), libro_hero_line('ABONADOS', '#FFFFFF'))),
        'content' => '[capitular]La afición del Guaguas es el motor del club. Desde aquellos primeros espectadores en el patio del colegio hasta los miles de abonados que llenan el Gran Canaria Arena, los socios han sido el alma del proyecto deportivo más exitoso del voleibol español.[/capitular]
[imagen_contenido src="' . libro_img('content/partido-guaguas.jpg') . '" alt="La afición del CV Guaguas en el Gran Canaria Arena" caption="La marea amarilla, incondicional con su equipo en cada partido, en cada competición." fullwidth="true"]
<p>Contenido pendiente de importación del documento original.</p>'),

    array('title' => 'Empresarios de la tierra', 'numero' => '23', 'order' => 135, 'show_marker' => true,
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
