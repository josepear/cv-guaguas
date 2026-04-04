<?php
/**
 * Contenido completo para el libro CV Guaguas
 * Se ejecuta al activar el tema - crea los 26 capítulos (0-25) con todo su contenido,
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
            
            // Save chapter number (strlen check: '0' is valid but empty() treats it as false)
            if (isset($cap['numero']) && strlen($cap['numero']) > 0) {
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
                if (!empty($hero['background_position'])) update_post_meta($post_id, '_hero_background_position', $hero['background_position']);
            }
            
            // Save prologue image fields
            if (!empty($cap['prologo_imagen'])) {
                update_post_meta($post_id, '_prologo_imagen', $cap['prologo_imagen']);
            }
            if (!empty($cap['prologo_posicion'])) {
                update_post_meta($post_id, '_prologo_posicion', $cap['prologo_posicion']);
            }
            if (!empty($cap['prologo_escala'])) {
                update_post_meta($post_id, '_prologo_escala', $cap['prologo_escala']);
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
    // CAPÍTULO 0: PRÓLOGOS
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
            'title_lines' => array(libro_hero_line('PRÓLOGOS', '#D4AF37', '', 'black')),
        ),
        'content' => '
<p>Este capítulo reúne las palabras de las personalidades más destacadas del ámbito deportivo, político e institucional que han acompañado al CV Guaguas en su extraordinaria trayectoria. Sus testimonios reflejan el impacto del club en la sociedad canaria y en el voleibol español.</p>

[imagen_contenido src="'),
    array('title' => 'Fernando Clavijo', 'numero' => '', 'order' => 2, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente del Gobierno de Canarias',
        'prologo_imagen' => libro_img('prologues/fernando-clavijo.jpg'),
        'prologo_posicion' => 'center 15%',
        'content' => '<p>Conmemorar el 50 aniversario del Club Voleibol Guaguas es reconocer la trayectoria de una entidad que forma parte de la historia del deporte en Canarias. Desde su fundación en 1976 este club ha construido un proyecto basado en el talento, el esfuerzo y la ambición de competir al más alto nivel.</p>
<p>Hoy el Club Voleibol Guaguas se ha ganado ser uno de los clubes más reconocidos avalados por una hoja deportiva brillante. Un recorrido que ha situado a Gran Canaria y a todo el archipiélago en el mapa del voleibol estatal e internacional. Precisamente a lo largo de su historia, el Guaguas ha llevado también el nombre de Canarias a las competiciones europeas proyectando el talento y la capacidad del deporte de nuestras islas más allá de nuestras fronteras.</p>
<p>Pero más allá de los títulos y los logros deportivos, la verdadera dimensión del Club Voleibol Guaguas está en las personas que han formado parte de su historia: jugadores, entrenadores, directivos, patrocinadores y una afición que ha acompañado al equipo durante décadas y que ha hecho del voleibol una de las grandes señas de identidad del deporte en Gran Canaria.</p>
<p>El club representa valores que definen al deporte y que forman parte también de nuestra forma de entender Canarias: el trabajo constante, el espíritu de superación, el compromiso con un proyecto común y la capacidad de mirar siempre hacia nuevos retos.</p>
<p>En nombre del Gobierno de Canarias, quiero felicitar al Club Voleibol Guaguas por estos cincuenta años de historia y agradecer su contribución al desarrollo del deporte en nuestras islas. Su trayectoria es motivo de orgullo para toda Canarias y un ejemplo para las nuevas generaciones que ven en el deporte una oportunidad para crecer y soñar.</p>
<p>Felicidades por este aniversario y por seguir escribiendo una historia que forma ya parte del patrimonio deportivo de Canarias.</p>'),
    array('title' => 'Antonio Morales', 'numero' => '', 'order' => 3, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente del Cabildo de Gran Canaria',
        'prologo_imagen' => libro_img('prologues/antonio-morales.jpg'),
        'prologo_posicion' => 'center 20%',
        'content' => '<p>El deporte es emoción o no es nada, apenas un esférico, un movimiento indescifrable. La diferencia radica en la pasión que es capaz de desencadenar a su alrededor. En el caso de Gran Canaria, el voleibol ha sido mucho más que un balón pasando de un lado al otro de la red. Es un vuelo extraordinario y magnético que sigue su curso.</p>
<p>Y gran parte de este fenómeno se explica a través de la trayectoria del actual CV Guaguas. Su nombre, no en vano, está escrito con letras mayúsculas y doradas en el libro que incluye las páginas más gloriosas del deporte canario. Y la historia, por fortuna, continúa escribiéndose.</p>
<p>Las gestas del conjunto grancanario convirtieron al viejo Centro Insular de Deportes, ahora inmerso en una profunda remodelación, en una gran caja de resonancia donde latía con toda su fuerza la energía conjunta del equipo y la afición. Pocas veces se ha repetido esta magia en un recinto deportivo en el archipiélago. Los años ochenta y, sobre todo, la década de los noventa del siglo pasado, fueron testigo de veladas que forman parte de la memoria colectiva, absolutamente imborrables de hecho para quienes tuvieron la fortuna de vivirlas vibrando en la grada.</p>
<p>De ese modo, y prácticamente por contagio, el equipo se transformó en algo más que en un club deportivo que jugaba al voleibol. Se volvió orgullo, identidad, proyección de una isla, en este caso de Gran Canaria, en cantera y en plataforma para promover valores deportivos y sociales. Este fue su set definitivo y su mayor logro.</p>
<p>El partido continuó tras afrontar un tiempo muerto más largo de lo deseable. Sin embargo, la isla seguía escuchando a lo lejos, en algún lugar, el eco del balón botando sobre las tablas. Esperaba su momento, como un magma que, tarde o temprano, debía volver a aflorar y ocupar su lugar en el paisaje deportivo y social de Gran Canaria.</p>
<p>El Cabildo de Gran Canaria respaldó el regreso a la élite del actual CV Guaguas aferrado a la importancia de contar con referentes deportivos que hagan de arrastre social para la práctica deportiva y sean embajadores de la manera canaria y grancanaria de afrontar el deporte y la vida desde nuestra doble condición de isla y territorio cosmopolita abierta al mundo en el Atlántico. Y por esos mismos motivos lideramos el apoyo anual a la entidad.</p>
<p>Podríamos insistir en que se trata del club más laureado de Canarias. Pero sabemos que su mayor triunfo es el vínculo que se ha establecido entre el equipo y la sociedad, de la que surge y a la que representa temporada tras temporada. Estoy seguro de que llegarán nuevos triunfos y tardes de gloria. Pero hay victorias, como el respeto, la admiración y el cariño de tu gente, que brillan mucho más que los trofeos y se prolongan cuando cesa el aplauso y se apagan los focos del pabellón.</p>'),
    array('title' => 'Juan Ruiz', 'numero' => '', 'order' => 4, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente del CV Guaguas',
        'prologo_imagen' => libro_img('prologues/juan-ruiz.jpg'),
        'prologo_posicion' => '70% 25px',
        'prologo_escala' => '2',
        'content' => '<p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Poli Suárez', 'numero' => '', 'order' => 5, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Consejero de Deportes del Gobierno de Canarias',
        'prologo_imagen' => libro_img('prologues/poli-suarez.jpg'),
        'prologo_posicion' => 'center 15%',
        'content' => '<p>Hoy celebramos el 50.º aniversario del Club Voleibol Guaguas Las Palmas, una entidad que forma parte indiscutible de la historia deportiva de nuestro archipiélago. Medio siglo después de su fundación en el popular barrio de Las Rehoyas, en Las Palmas de Gran Canaria, el Guaguas se ha consolidado por derecho propio como uno de los clubes más laureados de Canarias y como un referente de éxito y ambición en el deporte de nuestra tierra.</p>
<p>A lo largo de estas cinco décadas, originalmente como Club de Voleibol Calvo Sotelo, denominación con la que nació en 1976, hasta su estructura actual, la institución ha ido cimentando, a base de trabajo y esfuerzo, un envidiable palmarés al alcance de muy pocos. Su colección de títulos crece cada temporada.</p>
<p>Pero, más allá de los números, que hablan por sí solos, esta efeméride pone en valor además la solidez de un proyecto bien dirigido y capaz de mantenerse en la élite a lo largo de todo este tiempo.</p>
<p>Además de los innumerables reconocimientos que ha recibido la entidad a lo largo de estos años, desde el Gobierno de Canarias constatamos esta excelencia cuando en 2024 el CV Guaguas Las Palmas fue galardonado como mejor equipo en la primera edición de los Premios al Deporte Canario. Un reconocimiento que, si bien distinguió el éxito de su actualidad en ese momento, supuso también de alguna manera honrar su vasta historia de triunfos y conquistas. Dicho de otra forma, un galardón que simbolizó lo que significa este club en la historia del deporte de nuestra tierra: una referencia y un ejemplo de competitividad.</p>
<p>A nadie se le esconde que el voleibol en las islas, de gran tradición histórica, vive hoy uno de sus mejores momentos y es referencia a nivel nacional. Y, dentro de ese contexto, el Guaguas es, sin lugar a dudas, su principal referente. Su aportación ha sido determinante para consolidar el prestigio de este deporte en nuestras islas y para situar a Canarias en una posición destacada dentro del panorama del voleibol español e internacional.</p>
<p>Celebremos, pues, con este libro, su pasado brillante, plagado de grandes momentos y gestas que quedarán en el imaginario colectivo de nuestra gente. Pero, al mismo tiempo, reconozcamos su presente sólido y ambicioso, mirando con confianza a un prometedor porvenir, con la convicción de que el futuro del Guaguas Las Palmas seguirá estando marcado por el éxito. Un cincuentenario que refleja memoria pero, al mismo tiempo, continuidad y esperanza. A por otros cincuenta. ¡Felicidades, Guaguas!</p>'),
    array('title' => 'Aridany Romero', 'numero' => '', 'order' => 6, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Consejero de Deportes del Cabildo de Gran Canaria',
        'prologo_imagen' => libro_img('prologues/aridany-romero.jpg'),
        'prologo_posicion' => 'center 20%',
        'content' => '<p>Hace medio siglo, entre los caminos del parque Parque Calvo Sotelo, en el barrio de Las Rehoyas, un grupo de jóvenes decidió reunirse alrededor de una red, un balón y una ilusión compartida: el voleibol. Aquel impulso espontáneo, casi artesanal, germinó en 1976 en lo que hoy conocemos con orgullo como el Club Voleibol Guaguas.</p>
<p>Desde entonces, la suma de empresas locales, personas comprometidas y una afición fiel ha consolidado algo más grande que un club: una pasión profundamente arraigada en la identidad de Gran Canaria. El Guaguas no solo es historia viva del deporte insular, sino también un referente indiscutible a nivel nacional y europeo.</p>
<p>Con el paso de los años, el club se ha consolidado como uno de los grandes referentes del voleibol grancanario, proyectando su influencia posteriormente al ámbito canario y nacional. Esa evolución constante se ha traducido en una trayectoria repleta de títulos, prestigio y reconocimiento dentro y fuera de nuestras fronteras. Como reflejo de décadas de excelencia deportiva y compromiso con la sociedad, el Guaguas fue distinguido con el Premio Roque Nublo al Deporte 2023, uno de los mayores reconocimientos del deporte en Gran Canaria.</p>
<p>Ilustres nombres como Paco Sánchez Jover, Antonio Miralles, Willock, Juanma Martín, Venancio Costa o Sergio Miguel Camarero defendieron la camiseta amarilla con honor, dejando huella dentro y fuera de la cancha y fortaleciendo el vínculo entre el club y su gente. A esos éxitos les siguieron muchos más, para el disfrute de una ciudad que, en numerosas ocasiones, abarrotó las gradas del Centro Insular de Deportes. Inolvidable permanece la noche del 20 de enero de 1994, cuando el Guaguas se jugó ante el Paris Saint-Germain el pase a la Final Four de la Copa de Europa.</p>
<p>Mi reconocimiento y felicitación a una entidad que continúa ampliando su palmarés con nuevos títulos y entorchados, aunque el mayor mérito del Guaguas no se mide solo en copas. Su verdadero valor reside en décadas de trabajo constante para promover y visibilizar el deporte, uniendo generaciones, familias y sueños alrededor de una misma pasión.</p>
<p>Muy pronto, el futuro seguirá escribiéndose en una nueva instalación moderna y adaptada, heredera del espíritu del CID, donde cada punto, cada bloqueo y cada victoria continuarán alimentando esta historia de éxito.</p>
<p>Cincuenta años después, el Guaguas sigue siendo presente, memoria y futuro. A por otros 50.</p>'),
    array('title' => 'Carolina Darias', 'numero' => '', 'order' => 7, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Alcaldesa de Las Palmas de Gran Canaria',
        'prologo_imagen' => libro_img('prologues/carolina-darias.jpg'),
        'prologo_posicion' => 'center 20%',
        'content' => '<p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Roberto Melián', 'numero' => '', 'order' => 8, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Presidente de la Federación Canaria de Voleibol',
        'prologo_imagen' => libro_img('prologues/roberto-melian.jpg'),
        'prologo_posicion' => '-15px -15%',
        'prologo_escala' => '2',
        'content' => '<p>Cumplir cincuenta años no es simplemente alcanzar una cifra redonda. Es, sobre todo, demostrar que un proyecto deportivo ha sabido convertirse en parte de la vida de mucha gente: de quienes lo fundaron, de quienes lo sostuvieron en silencio durante décadas, de quienes lo defendieron en la pista, y de quienes lo han sentido como propio desde la grada o desde su casa.</p>
<p>Como presidente de la Federación Canaria de Voleibol y como representante institucional de nuestro deporte en Canarias, es para mí un orgullo poder escribir estas líneas en un momento tan significativo. Este libro conmemora el 50 aniversario de un club que ha sido referente, escuela y motor del voleibol canario, y que ha contribuido a que nuestro archipiélago siga siendo una tierra reconocida por su pasión, su talento y su manera única de vivir el voleibol.</p>
<p>Hablar de cincuenta años es hablar de memoria. De aquellas primeras generaciones que entendieron que el deporte podía ser una herramienta de educación, de convivencia y de crecimiento personal. De los entrenamientos en instalaciones que muchas veces no eran las ideales, pero sí estaban llenas de ilusión. De los viajes, de los sacrificios, de la organización diaria, del compromiso de familias enteras y del trabajo de personas que, sin buscar protagonismo, han hecho posible que el club sea hoy lo que es.</p>
<p>Pero hablar de cincuenta años también es hablar de identidad. De una forma de hacer las cosas basada en valores que no pasan de moda: el esfuerzo, la disciplina, el compañerismo, el respeto, la humildad cuando llegan los éxitos y la fortaleza cuando aparecen las dificultades. Porque los clubes con historia no se explican solo por los resultados; se explican por lo que transmiten y por lo que dejan en quienes pasan por ellos.</p>
<p>Por supuesto, el voleibol también vive de sus grandes noches: partidos inolvidables, etapas brillantes, finales, ascensos, títulos, participación en competiciones de máximo nivel, y momentos que quedan grabados en la memoria colectiva. Esas páginas son importantes y son motivo de orgullo. Pero tan importante como levantar un trofeo es haber sido capaces de sostener un proyecto, temporada tras temporada, con seriedad, con planificación y con una ambición sana: la de crecer sin perder el sentido de comunidad.</p>
<p>Este 50 aniversario debe ser también una oportunidad para mirar hacia adelante. El voleibol canario atraviesa una etapa de impulso y visibilidad, y eso no ocurre por casualidad: sucede porque existen clubes que trabajan, que innovan, que cuidan a su gente y que apuestan por estructuras sólidas. En esa construcción, el papel de los clubes es insustituible, y la Federación estará siempre al lado de quienes entienden el deporte no solo como competición, sino como servicio social y formativo.</p>
<p>Quiero aprovechar estas líneas para expresar mi reconocimiento a todas las personas que han construido esta historia: a quienes estuvieron al principio, a quienes tomaron el relevo, a quienes hoy sostienen el día a día, y a quienes seguirán haciéndolo. Reconocimiento a los cuerpos técnicos, a los y las deportistas de todas las categorías, al equipo directivo, a los voluntarios, a los patrocinadores y colaboradores, y a una afición que, con su apoyo, hace que todo tenga sentido.</p>
<p>Un aniversario así no pertenece solo al club. Pertenece a su barrio, a su ciudad, a su isla y, en definitiva, al voleibol canario. Porque cuando un club cumple cincuenta años, quien gana es el deporte: gana en raíces, en futuro y en credibilidad.</p>
<p>Felicidades por este hito. Que este libro sea un homenaje justo a lo vivido y, al mismo tiempo, un impulso para lo que está por venir. Ojalá los próximos años traigan nuevos retos, nuevas alegrías y la misma convicción que ha hecho posible llegar hasta aquí: la de creer en el voleibol como una ilusión compartida.</p>'),
    array('title' => 'Jorge Almansa', 'numero' => '', 'order' => 9, 'show_marker' => false, 'parent_ref' => 'prologos',
        'subtitulo' => 'Capitán del CV Guaguas',
        'prologo_imagen' => libro_img('prologues/jorge-almansa.jpg'),
        'prologo_posicion' => '3px -150%',
        'prologo_escala' => '2',
        'content' => '<p>Texto del prólogo pendiente de redacción.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 01: DEL PATIO DEL COLEGIO A DIVISIÓN DE HONOR
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
            'title_lines' => array(libro_hero_line('DEL PATIO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DEL COLEGIO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('A LA DIVISIÓN', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DE HONOR', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => ''),
    array('title' => 'Los orígenes', 'numero' => '', 'order' => 13, 'show_marker' => false, 'parent_ref' => 'cap01',
        'hero' => array(
            'image' => libro_img('hero-patio-colegio.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('LOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('ORÍGENES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[seccion_header]Las horas extraescolares con Francisco Rodríguez[/seccion_header]

[capitular]Antes que el club fue el colegio. Porque el Calvo Sotelo nació del centro educativo del mismo nombre que se inauguró para el curso escolar 1967-68 en el barrio de Las Rehoyas, en la época punto de convergencia de la zona alta de Las Palmas de Gran Canaria y con familias de extracción social y economías precarias. "Gentes muy humildes, pero no necesariamente problemáticas. Se veían situaciones complicadas por la calle, no se puede negar. Pero de mi experiencia como maestro en el trato con padres y alumnos guardo un gran recuerdo por los esfuerzos y sacrificios que hacían para que los niños completaran su educación. No había medios materiales, pero sobraba el orgullo y la capacidad de superación", rememora Felipe Nuez, quien desembarcó en esta escuela para desarrollar sus prácticas de magisterio sin saber que allí enraizaría y forjaría una leyenda deportiva que nadie podía esperar.[/capitular]

<p>Con todo, y según ha dejado documentado Miriam Quiroga en su libro \'Génesis y evolución del voleibol en Gran Canaria 1934/78\', las primeras influencias para introducir el juego del voleibol en el Calvo Sotelo corresponden a Francisco Rodríguez, profesor que, de manera experimental, fomenta su práctica en las horas extraescolares. La aceptación de su propuesta lúdica es inmediata, lo que permite crear, de modo informal, los primeros equipos para competir de manera interna y, con el tiempo, concurrir a competencias de ámbito local.</p>

<p>A la espera de que cale en categoría masculina, donde su introducción es más paulatina, las niñas toman la bandera y es la sección femenina la que inicia los pasos del Calvo Sotelo en los primeros torneos rivalizando con otros equipos. Y con resultados de impresión. Así, en los III Juegos Escolares Femeninos de la Enseñanza General Básica (EGB), correspondientes al curso 1971-72, el equipo infantil del Colegio Nacional Calvo Sotelo se impone a nivel provincial y regional, desplazándose en junio de 1972 hasta Málaga para disputar la fase final en la que se proclama campeón de España.</p>

<p>Y, desde la temporada 1972-73, participa en categoría infantil masculina en los Campeonatos Escolares Provinciales por iniciativa y empeño de la Asociación de Padres de Alumnos, presidida por José Celestino Luzardo, y también representada por Antonio Trejo, encargado de la imprenta del colegio, Guillermo Gil, director del centro, y los profesores Pardo y Miguel Nieves. El crecimiento es sostenido, como queda documentado con otro logro: el 18 de febrero de 1973, el equipo femenino de 2ª categoría juvenil, entrenado por Francisco Rodríguez, se proclama campeón provincial escolar tras ganar, en la cancha Eliseo Ojeda, al Instituto Isabel de España. Un guiño del destino: el partido fue arbitrado por Felipe Nuez, quien ya ha orientado sus pasos al voleibol como actividad complementaria a la que ejercía de profesor. Apenas un año después sería pionero al frente de la selección cadete de Las Palmas, germen del equipo sénior que iniciaría la andadura del Calvo Sotelo ya a nivel federado.</p>

<p>La creación, también en 1973, de un trofeo organizado por la propia escuela certifica la consolidación y crecimiento del voleibol en la rústica pista donde los alumnos ya se entregaban con entusiasmo y empeño en perfeccionar sus maneras y habilidades.</p>

[seccion_header]Silvestre Cabrera y el salto cualitativo[/seccion_header]

<p>Un acontecimiento externo va a suponer el definitivo impulso para el desarrollo y crecimiento de la disciplina, tanto en el propio Calvo Sotelo como en los otros caladeros de la cantera grancanaria de mitad de los setenta: la llegada a la presidencia de la Federación de Las Palmas de Voleibol de Silvestre Cabrera, a instancias de Manuel Hernández, director técnico de la Federación Española y que permite recuperar el voleibol federado en la provincia de Las Palmas. Cabrera, que era instructor de Educación Física y profesor del Instituto de Enseñanza Media de Escaleritas, toma posesión de su cargo el 19 de septiembre de 1973. Su equipo de gobierno lo conforman Ramón Limiñana, vicepresidente primero, Alberto Armas, vicepresidente segundo, Felipe Nuez, secretario, José Antonio Giráldez, director de la escuela de preparadores, y Leoncio Castellano, presidente del colegio de árbitros.</p>

[cita_prensa source="Diario de Las Palmas, 26 de septiembre de 1973"]La pasada temporada contamos con doscientos ochenta jugadores juveniles. Solo en esa categoría, porque no se trabajó con los séniors. Este año esperamos contar con muchos más, pues aparte de los dichos, se pondrá en marcha el campeonato femenino y el de los mayores. Habrá 10 equipos en la Segunda División Nacional, cuatro femeninos y todos los juveniles que hay actualmente.[/cita_prensa]

<p>Sus esfuerzos se traducirían rápidamente en hechos, pues en 1974 ya detallaba que Canarias era "la quinta comunidad de España en cuanto a licencias de voleibol con un total de 1.057 fichas".</p>

[cita_editorial author="Silvestre Cabrera"]El voleibol ya dejó de ser un deporte minoritario para convertirse en algo tremendamente atractivo. No es un deporte de patios o de recreos, aunque la labor escolar, que en este aspecto lleva la Delegación de la Juventud, es muy importante. Sus campañas están dando al voleibol el lugar que le corresponde.[/cita_editorial]

<p>Y añadía el dirigente: "Dentro de la labor que desarrolla la Delegación Provincial de la Juventud es de destacar las competiciones de cadetes, infantiles y alevines, gestión tremendamente meritoria. Además, la Delegación Provincial de Educación Física y Deportes ha patrocinado este año cuatro escuelas, funcionando en centros de Educación General Básica, con más de doscientos participantes masculinos. La sección femenina, por su parte, también ha sobrepasado el número en este sentido".</p>

<p>Y dos frentes más fueron los que vertebraron el fértil periodo de gobierno de Silvestre Cabrera, como lo ponderaba en una entrevista concedida a La Provincia y firmada por Santiago Betancor: el logístico y el competitivo a escala nacional.</p>

[cita_prensa source="La Provincia"]Es otro de nuestros grandes problemas, la falta de una cancha cubierta que nos permita consolidar nuestra preparación para acceder a las fases de sector con ciertas garantías. Nuestros equipos fallan por circunstancias como estas, aunque, según tengo entendido, pronto contaremos con dos, que nos darán la oportunidad de preparar mejor a nuestros muchachos.[/cita_prensa]

<p>Y sobre el otro reto, apuntaba: "Es fundamental que se acabe de una vez esa falta de contacto del voleibol canario con el nacional. El baloncesto y otros deportes han consolidado su afición por la competencia con los equipos nacionales, cosa que ahora le viene ocurriendo al balonmano. Esperamos que pronto le corresponda al voleibol. Si no visitamos y nos visitan equipos nacionales, que nos estimulen, no saldremos nunca del estancamiento".</p>

[seccion_header]La selección cadete con Felipe Nuez como germen[/seccion_header]

<p>La temporada 1974-75, ya con los primeros resultados de la gestión de Cabrera al frente del voleibol provincial, resulta crucial en el desarrollo del Calvo Sotelo, pues se materializa la creación de la selección cadete de Las Palmas, que estará a cargo de Felipe Nuez ("con exactamente 15 jugadores y cuyos nombres son Mendaño, Araña, Padrón, Montelongo, Vázquez, José Luis, José Antonio, Juan, Navarro, L. Acosta, Willy, Ramón, Eugenio, T. Acosta y Juan Carlos", detallaba Nuez).</p>

[cita_editorial author="Felipe Nuez"]Nuestra intención es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional.[/cita_editorial]

<p>De esta selección cadete saldría la base del primer Calvo Sotelo masculino, que, en esa misma campaña, debutaría en competición federada: el Campeonato Provincial de Segunda División Masculino. El equipo está dirigido por los entrenadores Félix Rodríguez y Felipe Nuez, ambos procedentes del Club Canteras UD. En 1975 ya inicia su carrera como entrenador titular Felipe Nuez, cuya estancia se prolongará hasta 1988. En este campeonato, el Calvo Sotelo queda subcampeón, por detrás del Salesianos, y completando el cuadro de participación los equipos Juventud de Gáldar, Juventud de Guía, Juventud de Telde, Juventud de Arucas, Bandera de Paracaidistas y Colegio Universitario de Medicina. El equipo del Calvo Sotelo lo configuraron los jugadores José Tirado, Falero, Ceferino, Fidel, José de la Cruz, Macías y Juan Ramón Dávila.</p>

<p>En 1975 el equipo juvenil femenino se proclama campeón provincial escolar bajo la dirección técnica de Francisco Rodríguez. Y otro hecho relevante acaece como clausura de la temporada 1974-75: en agosto se organizan, en las canchas del Calvo Sotelo y las instalaciones municipales García San Román, las 12 horas de Voleibol, de 9.00 a 21.00 horas. Más de 200 participantes entre las categorías alevín masculina, juvenil masculina, absoluta femenina y Segunda División masculina.</p>

<p>A propuesta de Silvestre Cabrera, se funda un equipo denominado "Calsa", fusión del Calvo Sotelo y del Salesianos, con vistas a formar un grupo de primer nivel para el futuro, algo que no tendría continuidad y acabaría derivando en el Juventud Las Palmas. El Calvo Sotelo aporta un equipo juvenil y dos femeninos (A y B). En la Segunda División masculina disputa la final ante el Calsa, cayendo por 3-1.</p>

<p>Entre el 9 de septiembre y el 5 de octubre de 1975 tiene lugar la Copa Federación, o Torneo Apertura, que abre la temporada 1975-76. El Calvo Sotelo participa en las tres categorías, Segunda División masculina, Absoluta femenina y Juvenil masculina. Ya hay una estructura sólida, a juzgar por el número de conjuntos que gestiona y como fruto de una continuada labor siempre en auge y cada vez con mayor calado en resultados e impacto.</p>

<p>Otro acontecimiento del momento digno de mención se desarrolló del 31 de octubre de 1975 al 29 de febrero de 1976 con el Campeonato Provincial de Segunda División Masculina en el que el Calvo Sotelo queda en segunda posición de una nómina de nueve equipos, con el Juventud como campeón y Arucas, Guía, Gáldar, Drago, Zona Aérea de Canarias, Paracaidistas y Filial Perojo como equipos restantes. El entrenador es Felipe Nuez y sus jugadores, Miguel Mendaño, Alfredo Padrón, Juan Carlos Ortega Araña, José Montelongo, Juan Carlos Rodríguez, Ramón Rodríguez, José Luis Alemán, William Caballero y Navarro. En el Campeonato Juvenil Provincial Federado de esa temporada también quedaría subcampeón el Calvo Sotelo.</p>

[seccion_header]Estatutos fundacionales y despegue[/seccion_header]

<p>En noviembre de 1976, concretamente el día 6, se redactan los estatutos de fundación del Club Voleibol Calvo Sotelo, lo que ya supone, formalmente, el avance que se demandaba para que el proyecto deportivo se oficializara a todos los niveles y adquiriera una consistencia definitiva, como así se demostraría con el transcurso de los años posteriores. Fue el punto de partida que permitía ir del deporte escolar propiamente dicho, y que había sustentado la naturaleza del Calvo Sotelo, al integrado en la competición federada.</p>

[cita_prensa source="La Provincia, 1 de septiembre de 1976"]Junto al preparador técnico, Felipe Nuez, ha venido a incrementar el plantel de entrenadores Emilio Bonilla, conocido por todos dentro del ámbito del fútbol regional. De estos dos entrenadores, hay que decir que formarán un tándem que dará muchos frutos al equipo colegial y al voleibol canario en general.[/cita_prensa]

<p>El artículo proseguía detallando las incorporaciones de jugadores procedentes del infantil —Manolo, Casiano, José Luis, Simón, Ramón, Octavio y Gavira— y el regreso de Falero y Déniz al equipo absoluto. Con el equipo de voleibol, las aspiraciones llegaban aún más lejos. Se tenía una base, que era el equipo juvenil, en él se habían puesto todas las ilusiones con vistas a un futuro.</p>

[cita_editorial]Es loable el comprobar cómo en este club todos están mentalizados con una meta fijada a cuatro años vista, nadie espera resultados inmediatos, todos están plenamente convencidos de que, dentro de tres temporadas, el Calvo Sotelo sonará fuerte dentro del ámbito nacional.[/cita_editorial]

<p>Dicho y hecho. El Calvo Sotelo logró clasificarse para la fase de ascenso a Segunda División que se disputó en Cáceres en febrero de 1977. El Santa Ana, que ejercía de anfitrión, el Chamartín de Madrid, Camilo de Segovia, el Cisneros de Tenerife, la Universidad Laboral de Toledo y el Galerías Florita de Salamanca completaron el cartel de aspirantes que, divididos en dos grupos, buscaban el salto de categoría. No pudo ser en esta ocasión para el Calvo Sotelo, en el mapa nacional en todo caso y con los honores preceptivos por estar entre los mejores.</p>

<p>El amplio eco de la eclosión del proyecto se ensalza en la prensa por su labor cuidada de la base, verdadero orgullo de los integrantes del club. Así se hablaba de las excelencias del Calvo Sotelo, resaltando que tenía "el futuro asegurado al disponer de 16 equipos repartidos en todas las categorías".</p>

[cita_prensa source="La Provincia, 16 de junio de 1977"]Todos los componentes de esta gran familia pasando desde el conserje del colegio, encargado de servicios, director, padres de jugadores, junta directiva y, cómo no, la totalidad de los jugadores han hecho posible todo esto. Son estos últimos los que merecen especial atención, sacrificando alrededor de catorce horas semanales de los ratos en que no estudian o trabajan, en los entrenamientos, no desperdiciando ningún sábado o domingo, ni días de fiestas, para entrenar.[/cita_prensa]

[seccion_header]El ascenso a Segunda División de 1979[/seccion_header]

<p>Lo que había quedado pendiente del año anterior, el ascenso a Segunda División, sí se materializó en 1979, en la fase decisiva que se libró en Málaga los días 9, 10 y 11 de marzo. En su primer partido, ganó con autoridad al Málaga por 3-0 (17-15, 15-10 y 15-4), luego se impuso por 3-1 al Dos Hermanas de Sevilla (15-1, 3-15, 15-6 y 15-1) y completó la fase previa con otro triunfo, esta vez ante el Jaén y por 3-0 (15-4, 15-2 y 15-4). Y en la gran final disputada en el turno vespertino del domingo 11 de marzo, y de nuevo frente al Dos Hermanas, se consumó el gran éxito con un 3-0 (15-12, 15-11 y 15-2) para la historia.</p>

<p>Con este ascenso al Grupo Sur de la Segunda División, el Calvo Sotelo se queda como representante en el voleibol nacional junto al Juventud Las Palmas de Isidro Quintana y Joselu Sánchez.</p>

<p>En su estreno en Segunda, temporada 1979-80, el saldo no pudo ser mejor, toda vez que se logró un segundo puesto que dio derecho a disputar la fase de ascenso a Primera División gracias, fundamentalmente, a que se mantuvo invicto en su feudo. En Cáceres afrontó una fase decisiva en la que no pudo culminar la gesta de haber encadenado otro éxito. La coincidencia del ascenso del Juventud permitió que se viviera el derbi capitalino en Segunda durante la campaña 1981-82, algo que se calificó como otro hito del voleibol grancanario.</p>

<p>La entrada en escena de patrocinios, como ya se imponía en la realidad del deporte de comienzo de los ochenta, también formó parte de la historia del Calvo Sotelo, que, en virtud de un acuerdo con Tabacanaria, adoptó, de manera sucesiva, las denominaciones Reales y Lucky, dos marcas de cigarros. Un impulso económico que demandaba su auge en el panorama deportivo español, ya con el listón de la División de Honor en mente.</p>

[seccion_header]El acceso a la élite y su conflicto burocrático[/seccion_header]

<p>Juan Carlos, Pericles, Isidro, Vázquez, Felo, Juani, José Luis, Silva, José, Ignacio, Valentín y Manolo integraron la plantilla que inició el curso 1983-84, si bien luego se añadieron nombres como Francés, Quique o José Ramón.</p>

<p>Es en esta temporada cuando se va a producir un conflicto burocrático ("una cacicada federativa", según Felipe Nuez) que impidió el sueño de estar entre los mejores del país. A saber: en marzo de 1984 tomó parte de la fase de ascenso a la División de Honor que se celebró en Valladolid y junto a los equipos del Vigo, Gijón, Hellín, Veracruz de Huelva y Salesianos Atocha de Madrid. La tercera plaza obtenida, que en principio tenía un valor testimonial sin mayor trascendencia, pues solo subían los dos primeros, terminó adquiriendo una importancia capital al renunciar el Son Amar balear a su plaza en la máxima categoría. José María Rodríguez, presidente del Calvo Sotelo, elevó ante la Federación Española la intención de ocupar esa vacante, con el apoyo de Manuel Navarro, director general de Deportes del Gobierno de Canarias, e, incluso, contando con el beneplácito del Consejo Superior de Deportes en la figura de Antonio Abad, uno de sus delegados.</p>

<p>Sin embargo, los clubes de la División de Honor se opusieron a una ampliación de la misma aludiendo a factores económicos relacionados con los desplazamientos, el Comité Superior de Disciplina Deportiva se declaró "manifiestamente incompetente", agotándose la vía administrativa, por lo que, ya habiendo arrancado la temporada oficial, y con el Calvo Sotelo compitiendo en Primera pero con la vía abierta de pasar a la División de Honor, el asunto llegó a la Audiencia Nacional en octubre de 1984.</p>

[cita_prensa source="Comité Superior de Disciplina Deportiva, 8 de octubre de 1984"]En el día de la fecha por este Comité Superior de Disciplina Deportiva, se notifica lo siguiente a la Federación Española de Voleibol (...) Este Comité Superior de Disciplina Deportiva acuerda no admitir a trámite el recurso presentado por don José María Rodríguez Herrera por ser manifiestamente incompetente para conocer sobre el fondo del asunto.[/cita_prensa]

<p>Finalmente, todos los esfuerzos quedarían desestimados. Así, la temporada 1984-85 arranca condicionada por este frente ajeno a lo deportivo pero que supuso una enorme decepción en el plano institucional, pues se contaba con que prosperaran unas alegaciones fundamentadas.</p>

<p>Vuelta a empezar con un equipo de nuevo llamado a aspirar a la élite y cuya principal novedad estuvo en Sergio Miguel Camarero, un prometedor juvenil de 17 años llamado, con el tiempo, a ser parte del escudo por su impronta y ascendente. El calendario regular se desarrolla con los resultados esperados hasta desembocar, con un meritorio subcampeonato del grupo C, en la fase de ascenso que acogió Mallorca a mitad de marzo de 1985. Ya sería, felizmente, el intento definitivo. Los rivales que le tocaron en suerte esta vez fueron, por este orden, el Renfe de Lérida, el Son Amar de Mallorca, el Jovellanos de Gijón, el José María Pereda de Santander y, ya en la quinta ronda, el Orient Puerto de Málaga.</p>

<p>No le fueron bien las cosas a los muchachos de Nuez en tierras baleares, pues concluyeron la liguilla en una cuarta plaza que no daba derecho a subir, ya que solo ascendían los tres primeros... Pero dos meses después, en concreto el 17 de mayo, la Comisión Ejecutiva de la Federación Española presidida por Feliciano Mayoral, aprobaba la propuesta de la Asociación de Clubes de ampliar a doce los componentes de la máxima categoría. Curiosidades del destino, el mismo colectivo que vetó al Reales en 1984 le dio vía libre un año después. Tal y como se anunció, el Lucky Calvo Sotelo competiría en el grupo par junto al Sanitas, Recuerdo, Biodrink Hispano Francés, Vigo Foqué y Orient Puerto de Málaga.</p>

[seccion_header]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1967</span><div class="timeline-content">Se inaugura el colegio Calvo Sotelo en el barrio de Las Rehoyas.</div></div>
<div class="timeline-event"><span class="timeline-year">1968</span><div class="timeline-content">El profesor Francisco Rodríguez introduce el voleibol como actividad deportiva extraescolar.</div></div>
<div class="timeline-event"><span class="timeline-year">1972</span><div class="timeline-content">Después de proclamarse campeón provincial, el equipo infantil femenino del Calvo Sotelo se alza con el título a nivel nacional en los II Juegos Escolares de su categoría.</div></div>
<div class="timeline-event"><span class="timeline-year">1973</span><div class="timeline-content">El equipo femenino de 2ª categoría juvenil, entrenado por Francisco Rodríguez, se proclama campeón Provincial Escolar tras ganar, en la cancha Eliseo Ojeda, al Instituto Isabel de España. El partido fue arbitrado por Felipe Nuez. Ese mismo año el centro crea un torneo con su propio nombre.</div></div>
<div class="timeline-event"><span class="timeline-year">1974</span><div class="timeline-content">Creación de la selección cadete de Las Palmas, a cargo de Felipe Nuez, que sería la base del posterior equipo juvenil masculino del Calvo Sotelo. También se produce el debut en competiciones federadas del equipo masculino en el Campeonato Provincial de Segunda División.</div></div>
<div class="timeline-event"><span class="timeline-year">1975</span><div class="timeline-content">Entre el 9 de septiembre y el 5 de octubre tiene lugar la Copa Federación, o Torneo Apertura, que abre la temporada 1975-76. El Calvo Sotelo participa en las tres categorías, Segunda División masculina, Absoluta femenina y Juvenil masculina.</div></div>
<div class="timeline-event"><span class="timeline-year">1976</span><div class="timeline-content">Redacción de los Estatutos Fundacionales del Club Voleibol Calvo Sotelo.</div></div>
<div class="timeline-event"><span class="timeline-year">1977</span><div class="timeline-content">Primer intento del Calvo Sotelo por ascender a la Segunda División que no culmina en la fase decisiva celebrada en Cáceres.</div></div>
<div class="timeline-event"><span class="timeline-year">1979</span><div class="timeline-content">Se consuma el ascenso a la Segunda División, tras saldar con éxito sus partidos definitorios en Málaga ante el anfitrión, el Dos Hermanas y el Jaén, quedando como representativo a escala nacional del voleibol grancanario junto al Juventud.</div></div>
<div class="timeline-event"><span class="timeline-year">1984</span><div class="timeline-content">La Federación Española le niega al Reales, denominación comercial de entonces del equipo, el ascenso a la División de Honor a instancias de los clubes peninsulares, que no aceptan que la renuncia del Son Amar sea cubierta por el equipo grancanario que, en virtud de la tercera plaza obtenida en la fase de ascenso celebrada en Valladolid, estaba en el legítimo derecho de reclamar esa posición, llegando, incluso, a apelar a la Audiencia Nacional.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content">Ascenso a la División de Honor con una secuencia similar a la del año pasado pero con final en dirección feliz. El Calvo Sotelo, en el que ya sobresale un Sergio Miguel Camarero en edad juvenil, no logra subir en la cancha, tras quedar cuarto en la liguilla disputada en Mallorca, pero una posterior ampliación de la División de Honor a doce equipos le hace sitio entre los mejores del país, tal y como ratificó la Federación Española.</div></div>
</div>
'),
    array('title' => 'Felipe Nuez', 'numero' => '', 'order' => 14, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Felipe Nuez (Moya, 1956-Las Palmas de Gran Canaria, 2024) fue la figura fundamental y maestra en la vida del club. Presente desde el mismo inicio de la actividad escolar que se dedicó al voleibol con especial ahínco, llegó como profesor en prácticas al colegio Calvo Sotelo en 1973 sin saber que, junto a otros precursores, iniciaría una historia de superación y éxitos que todavía perdura y que fue, también, orgullo del deporte canario. Su pasión por la disciplina que le dio fama y prestigio vino por consejo de José Antonio Giráldez, quien fue uno de sus maestros más respetados. "Como todos los chicos de la época, empecé en el fútbol. Pero Giráldez me dijo que me veía condiciones mejores para el voleibol y le hice caso. Lo disfruté más en la faceta de entrenador, aunque hice alguna vez de árbitro y asumí otras responsabilidades. Como jugador no destacaba especialmente en nada y supe darme cuenta para volcarme en lo que siempre me gustó", indicó.[/capitular]

<p>Un repaso a su cronología personal evidenciaba que, a edad temprana, ya era elemento referencial. En 1974 fue designado como el técnico de la recién creada selección cadete de Las Palmas, cargo que compatibilizaba, tras haber ejercido en el Canteras, con la formación de la base en el Calvo Sotelo, en aquella época el segundo colegio con mayor densidad de España, con alumnos procedentes del mismo barrio de Las Rehoyas pero también de otros parajes aledaños ("venían guaguas abarrotadas de alumnos cada mañana"). Y con el apoyo del director del centro, Guillermo Gil, y una Asociación de Padres de Alumnos (APA) "volcada con el deporte y la formación".</p>

<p>Porque, como bien resaltaba, el programa de actividades extraescolares contemplaba otras modalidades como baloncesto o lucha canaria... "Pero el voleibol acabó llevándose toda la atención por el nivel de preparación, organización y crecimiento que fuimos teniendo desde los inicios, aunque ya con una importante base heredada por el trabajo de Francisco Rodríguez, quien acabaría siendo destinado a Arinaga pero que, a finales de los sesenta y comienzos de los setenta, sembró una semilla muy valiosa a la que se dio continuidad".</p>

[cita_editorial author="Felipe Nuez"]Fui autodidacta. Obtuve el título de entrenador nacional con 20 años y, en 1984, el de técnico internacional. En esos años de los comienzos, la única manera de ampliar conocimientos en el voleibol era explorando métodos de trabajo en otros países, como Japón, que era una potencia inalcanzable por su nivel de desarrollo.[/cita_editorial]

<p>"Y cada vez que podía viajar, ya fuera con el equipo o en los cursos formativos, pasaba por la librería deportiva Esteban Sanz de Madrid y me compraba unos tomos fantásticos que solo podían encontrarse allí. Y de vez en cuando conseguía las cintas de vídeo super-8 para empaparme de lo que se hacía en otros países. Uno de mis ejercicios que llamó más la atención, el de agresividad, consistente en dar balonazos a un jugador que se cubre la cara y sus partes para que se acostumbre al impacto del balón, lo saqué de lo que se hacía en Japón. Siempre entendí el deporte de manera perfeccionista y ganadora. Entrenara a cadetes, juveniles o séniors. El trabajo, el compromiso y el sacrificio eran para mí innegociables. De lo contrario, prefería quedarme en mi casa", dijo.</p>

<p>Y así lo cumplió. Sus pupilos de entonces recordaban una metodología que rozaba la exigencia profesional. Sesiones físicas de hasta cinco horas diarias ("veía lo que hacían otros equipos y doblaba en tiempo e intensidad mi programa de trabajo para superarlos; que corrían dos horas, pues nosotros cuatro"), ejercicios en el gimnasio antes de que amaneciera, concentraciones en Navidad o Semana Santa, prohibición de ir a la playa durante el calendario...</p>

[cita_editorial author="Felipe Nuez"]Hicimos del deporte un modo de vida y eso aumentó el apoyo de los padres a nosotros. Ver que a sus hijos se les exigía disciplina y se les modelaba con hábitos sanos, incentivando también el compañerismo, era de su total agrado. También queríamos que estudiaran, que sacaran buenas notas.[/cita_editorial]

<p>"En un entorno geográfico un tanto problemático, con barrios en la periferia de rentas bajas y deficiencias estructurales, el Calvo Sotelo era una especie de excepción en la que no había límites a la hora de superarse. La gente se transformaba al entrar allí. Y el APA del Calvo Sotelo nos daba todo lo que necesitábamos en cuanto a material. Equipaciones, balones... Incluso no me quiero olvidar de la implicación de Pepito, el portero, que no dudaba en ir casa por casa cobrando la cuota del APA para ayudar al proyecto. Había una unión espectacular entre jugadores, técnicos, padres, dirigentes del colegio...".</p>

<p>El crecimiento y los progresos continuados de los distintos equipos representativos del Calvo Sotelo, en todas sus categorías, así como el prestigio que se fue granjeando lo vivió Nuez "con naturalidad", pues siempre sostuvo "que el trabajo acaba teniendo resultado".</p>

<p>Una anécdota resumía su exigencia: "En varios viajes coincidíamos con la expedición de la UD Las Palmas y los jugadores, cuando hablaban con los nuestros y veían lo que entrenábamos, nos pedían que ni se nos ocurriera decirle eso al cuerpo técnico que tenían. Se quedaban asustados".</p>

<p>Recordaba la rivalidad con el Salesianos o el Juventud, en los primeros tiempos, "como un aliciente para ser más competitivos siempre" y, también, "como una aportación para que el voleibol se consolidara más en Canarias". Porque "los llenos a reventar" en las distintas canchas en las que se disputaban partidos, a veces hasta con independencia de los contendientes, aunque el Calvo Sotelo "arrastraba muchísimo", fueron una contribución "de enorme valor" y generaron un efecto llamada, ya que "hubo un auge enorme a final de los setenta y comienzos de los ochenta en las fichas e inscripciones de jugadores".</p>

[cita_editorial author="Felipe Nuez"]¿Si esperaba que el Calvo Sotelo llegara tan alto? Realmente no tenía pretensiones. Vivía el día a día, disfrutaba, me entregaba en cuerpo y alma, quería estar al lado de los chicos, ayudarles a desarrollarse... Es verdad que fue muy confortante ver que pasaban los años y un proyecto escolar terminaba tomando forma, se convertía en club, ascendía de categorías, se codeaba con los mejores del país...[/cita_editorial]

<p>"Y ya ni qué decir cuando se logró entrar en la División de Honor, a mitad de los ochenta. Pero no tenía tiempo para pararme a pensar, para el elogio. Cada año era empezar de nuevo e ir a por más, con el apoyo, eso sí, de un grupo de jugadores que siempre fue sensacional. Con los cambios que se dieran, con las circunstancias que fueran. No distingo porque guardo un recuerdo especial de todo ese tiempo. Miro atrás y mi lectura es positiva al máximo", añadió.</p>

<p>El ascenso a la Segunda División en Málaga, en 1980, el posterior que se negó a la División de Honor por imperativo federativo, por la reducción de equipos en 1984 ("fue un escándalo de tal dimensión que hasta José María García nos llamó para su programa en la Cadena SER, número uno de audiencia a nivel nacional, para que denunciáramos una injusticia que, finalmente, se materializó"), las temporadas de transición hasta que en 1985 sí se alcanzó la máxima categoría ("un premio merecido y que honró el trabajo de base, de cantera, en las campañas precedentes, jugando siempre con cuatro juveniles de la casa como Camarero, Jorge Ramón, Campos y Juanma Martín"), el debut en competiciones europeas ante el Knack de Bélgica, allá por 1987, en el San Román ("una noche irrepetible, una experiencia increíble por lo que suponía a todos los niveles"), los subcampeonatos de Copa y de Liga que antecedieron a los hitos que luego vendrían... Todo lo vivió en carne propia alguien que llegó sin más motivación que realizar sus prácticas de magisterio en el Calvo Sotelo y acabó erigiéndose en entrenador de leyenda.</p>

<p>Fueron numerosas las ofertas que recibió para cambiar de aires, aunque nunca terminaron de seducirle en fondo y forma. Celoso de su porvenir, el conservar la plaza de profesor siempre antepuso su estabilidad laboral. "Cobraba un complemento del APA por dirigir al equipo de voleibol y eso lo añadía a mi sueldo de maestro. Pero no hablo de dinero cuando lo hago de voleibol porque para mí el deporte ha estado siempre por encima de cualquier otro interés fuera de la cancha. Es mi vocación absoluta y he renunciado a muchísimas cosas por ello. Y no me arrepiento. Lo volvería a hacer".</p>

<p>"La entrada de Juan Ruiz en el club, ya entonces con denominaciones de patrocinadores como Reales, Lucky, Guaguas, luego Constructora para de nuevo ser el Guaguas de toda la vida, supuso un paso a la modernidad. Desde el primer momento, no hubo imposibles para él. Fichó de una tacada a Sánchez Jover o Venancio Costa y dejó apalabrados, ya para el año siguiente, a Klos o Golec, figuras mundiales. Lo que se le metía en la cabeza lo conseguía. Ya no hablo de patrocinadores. Nos llegaron a multar por exceso de publicidad estática en el pabellón. Había un límite y se sobrepasó con la cantidad de anunciantes que consiguió... Era todo surrealista en el buen sentido de la palabra".</p>

[seccion_header]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1975</span><div class="timeline-content"><strong>La selección cadete</strong> — "Nuestra intención con la selección cadete de Las Palmas es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional". <em>(El Eco de Canarias, 16 de octubre de 1975)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1976</span><div class="timeline-content"><strong>Un primer diagnóstico</strong> — "El futuro de nuestro voleibol lo veo, según las últimas competiciones que he visto de las categorías infantil, cadete y juvenil, muy negro, debido a que se le da poca importancia a la preparación de las categorías de base y, en cambio, se preocupan mucho por su equipo representativo en categoría absoluta". <em>(El Eco de Canarias, 12 de junio de 1976)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1976</span><div class="timeline-content"><strong>La estructura primigenia</strong> — "Nuestras plantillas absolutas y juveniles entrenan los lunes, miércoles y viernes, con doble sesión el miércoles. La preparación física la realizamos en el Gimnasio Falla y la técnica en nuestra cancha Calvo Sotelo. Actualmente, solo hay dos técnicos, que son insuficientes, si tenemos en cuenta el número de equipos". <em>(La Provincia, 18 de noviembre de 1976)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1978</span><div class="timeline-content"><strong>El sueño emergente de la Primera</strong> — "A nivel nacional, estamos entre los dos primeros. Si no fuera por la lejanía, hay algunos jugadores que en la selección española no desentonarían lo más mínimo. Muchos técnicos me han dicho que el Calvo Sotelo si sigue su trayectoria subirá a Primera". <em>(El Eco de Canarias, 18 de febrero de 1978)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1978</span><div class="timeline-content"><strong>Naturaleza del proyecto y una afición única</strong> — "Somos un club de voleibol cuyo único fin es el intentar llegar a conseguir los objetivos máximos del deporte, así como la formación integral del deportista dentro de la faceta de aficionados. En ningún otro lado de la geografía hispana he tenido ocasión de ver algo igual en cuanto a afición. La nuestra es muy numerosa, pero, además, entendida y sin fanatismos". <em>(La Provincia, 18 de febrero de 1978)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1979</span><div class="timeline-content"><strong>Sin límites a la hora de progresar</strong> — "La directiva me ha dicho que lleve al equipo hasta donde pueda rendir, y no me han puesto trabas de ninguna especie económica. El único fichaje procedente del exterior es el gaditano Vélez, que llega del Avante". <em>(Diario de Las Palmas, 30 de agosto de 1979)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1980</span><div class="timeline-content"><strong>Seguridad en el éxito</strong> — "El Calvo Sotelo tiene una excelente plantilla como para colocarse entre los dos primeros puestos de ambas series y ascender a la Primera División. Si no ocurre una desgracia, conseguiremos el ascenso". <em>(Diario de Las Palmas, 7 de marzo de 1980)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1980</span><div class="timeline-content"><strong>Afán innegociable de superación</strong> — "Nuestra meta, por supuesto, es superar la campaña anterior, incluso mejorarla. Las dificultades son los pocos jugadores de la temporada anterior y los varios juveniles que quiero adaptar al primer equipo". <em>(El Eco de Canarias, 17 de agosto de 1980)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1983</span><div class="timeline-content"><strong>Al rescate</strong> — "Mi vuelta al equipo de Segunda División, tras la dimisión de Fidel Morales, es provisional. Para estar a gusto me gustaría estar con infantiles futuribles y con todos los medios disponibles para hacer una buena labor". <em>(Canarias7, 10 de marzo de 1983)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content"><strong>Cantera, cantera y cantera</strong> — "El tiempo ha sido el verdadero juez. Se nos tachaba de que nos nutríamos poco de la cantera propia. El 80% del primer equipo ha sido formado en nuestros filiales. Estoy plenamente convencido de que, de subir de categoría, y trayendo uno o dos jugadores, con el futuro de los nuestros, podemos llegar a metas antes insospechadas en nuestro voleibol". <em>(Canarias7, 1 de marzo de 1985)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content"><strong>La profesionalización necesaria y la predicción sobre Camarero</strong> — "Los equipos que no se profesionalicen o semiprofesionalicen prácticamente no tienen nada que hacer. Nosotros confiamos en que con la incorporación de Ortiz y Martinovic, más la aportación de jugadores de la cantera, como es el caso de Sergio Camarero, pese a sus 17 años sin duda el mejor del Archipiélago, el éxito está garantizado". <em>(La Provincia, 15 de junio de 1985)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content"><strong>Un adiós que no lo fue</strong> — "A principios de junio dejé el club por no estar de acuerdo con las directrices que se estaban llevando a cabo. A partir de la segunda quincena de julio mantuve unas conversaciones con el presidente del club y le expuse mi esquema de trabajo deportivo, con unos presupuestos mínimos para la ejecución de un plan a ocho años". <em>(Diario de Las Palmas, 15 de agosto de 1985)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1988</span><div class="timeline-content"><strong>El subcampeonato más dulce</strong> — "Este subcampeonato de Copa del Rey sabe a mucho a pesar de que hay personas que piensan que pudimos dar la sorpresa en la final y ganarle al todopoderoso e invencible CV Palma. Quiero felicitar a la junta directiva, jugadores, técnicos de la cantera, socios, aficionados... A todos los que se han desvivido para que esto sea una realidad". <em>(Canarias7, 26 de enero de 1988)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1988</span><div class="timeline-content"><strong>El mérito del colectivo</strong> — "La trayectoria ascendente del Guaguas Las Palmas no se logra con un entrenador que no conoce profundamente este deporte. Sobre Sánchez Jover diré que es un gran líder, sin lugar a dudas, el mejor jugador de España". <em>(Canarias7, 8 de agosto de 1988)</em>.</div></div>
</div>
'),
    array('title' => 'José Miguel Santana', 'numero' => '', 'order' => 15, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Descubridor de Sergio Miguel Camarero "por un tirón de orejas" ("siendo un niño me robaba los balones que caían fuera de la cancha y terminé recomendándole que se pusiera a jugar, como así haría y no le fue nada mal"), fue testigo y partícipe de un fichaje de leyenda como resultó ser Paco Sánchez Jover, a mitad de los ochenta y en un hotel del Puerto de Santa María durante un Preeuropeo ("convencí al recepcionista para estar en la habitación de al lado para que, cuando hubo que negociar, pudiese colarse por el balcón y que nadie lo viera") y actor impulsor, desde la tribuna de prensa, del fortalecimiento del proyecto justo en la etapa anterior a la gloria de los títulos. Pero antes, mucho antes, José Miguel Santana (Las Palmas de Gran Canaria, 1958) también se significó por jugar un papel activo en los inicios del Calvo Sotelo, entusiasta como siempre fue del voleibol tras pasar por las aulas del Alonso Quesada, en las que era deporte predominante y predilecto. Fichado del Santa Teresa al término de la temporada 1976-77, donde ejercía como entrenador y tras una llamada de Felipe Nuez para que se hiciera cargo del juvenil B masculino y femenino, Santana también hizo una contribución altruista y entusiasta que le procura un sitio privilegiado en la historia.[/capitular]

[cita_editorial author="José Miguel Santana"]Fueron años increíbles que uno recuerda con mucha emoción. Éramos jóvenes, atrevidos, soñábamos con todo y el voleibol fue el vehículo para cumplir con esas ilusiones. Lo hicimos desde la base de un compañerismo ejemplar. Nunca me cansaré de repetir que más que un club, éramos un grupo de amigos, una familia.[/cita_editorial]

<p>"Todos los jugadores de los equipos nos juntábamos en la cancha y, también, en el tiempo libre. Aquellas meriendas en la casa de Mendaño con bocadillos y botellas de refresco y nos daban las tantas, el tiempo volaba. Era una manera de vivir intensa, sana y que a todos nos dio valores y un patrón de conducta impecable", subraya.</p>

<p>Hace un encendido elogio de varias figuras que considera "capitales" en el surgimiento y desarrollo del Calvo Sotelo, tales como Paco Rodríguez ("el que inició todo"), Guillermo Gil o Miguel Nieves ("también fundamentales con su trabajo e ideas") o Felipe Nuez ("el entrenador de entrenadores en el voleibol canario") y no escatima admiración por el comportamiento de los jugadores, "ejemplos de nobleza, afán de superación y lealtad".</p>

<p>"Eran hombres siendo niños. Lo digo porque, siendo juveniles, exhibían una madurez y concentración propia de adultos. Eso fue lo que inculcó Felipe. El juego y la competición. Debían ir unidos. De ahí los entrenamientos con una intensidad brutal. Era una gozada entrenar a esos chicos y chicas que se tomaban cada sesión o cada partido con una disciplina intachable. Entre todos se aconsejaban, querían ser los mejores, se ayudaban, eran una piña al grito de \'cis\', la C de Calvo y la S de Sotelo que decían en voz alta antes de empezar un partido como conjura. Y tener el apoyo del colegio, de los padres, era el respaldo ideal para continuar con esa obra que no paró de crecer", argumenta.</p>

<p>Habla de sacrificio porque no fueron pocas las veces en las que tuvo que poner de su bolsillo el dinero para sufragar el agua de sus jugadores y, como no podía ser menos, participar de "las artimañas típicas de la época" cada vez que se viajaba a la península, "con maletas cargadas de tabaco y artículos que se pudieran vender" para sacar un beneficio que permitiera costear los gastos.</p>

<p>"Fue una implicación total de todos los que formábamos parte del Calvo Sotelo, creando un vínculo especial que, en mi caso, me llevó a conocer a mi mujer o a tener amistades para toda la vida dentro de la misma disciplina del club. Nos marcó la vida porque, además nos cogió en una etapa especial, la que va de los 18-20 años en adelante", incide. Una llamada para entrar a formar parte de la redacción de Diario de Las Palmas, en 1982 y estando estudiando en Madrid, clausura su militancia en el club como miembro del organigrama y activo en todas las funciones que se le requirieran, si bien jamás dejó de "echar una mano en todo lo posible".</p>

<p>"Ver cómo se alcanzó la plenitud de las Ligas y las Copas, con protagonistas que uno conoció siendo niños como Camarero, el liderazgo de Sánchez Jover, la continuidad a la obra de Felipe, que puso los pilares de todo con su sabiduría, con su trabajo... Al final dices que sí, que todo se justifica, que lo que se hizo entonces debió estar bien por lo que vino después y por lo que pervive", concluye.</p>
'),
    array('title' => 'Florencio Tejera', 'numero' => '', 'order' => 16, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Jugador fundacional del Calvo Sotelo tras la redacción de los estatutos del club y presidente "casi por accidente" en la temporada 1983-84, el testimonio de Florencio Tejera (Las Palmas de Gran Canaria, 1956) también resulta de inestimable valor para conocer la naturaleza primigenia de la entidad en sus albores ya insertada en las exigencias de la alta competición. Porque ese Calvo Sotelo al que se enroló "para poder cumplir el cupo de dos fichas séniors junto a Alfonso Déniz" que se requería ya le impactó por "su nivel de organización, ambición y desarrollo".[/capitular]

<p>"Yo jugaba en el equipo de Magisterio mientras hacía la carrera y Felipe Nuez me invitó a formar parte del Calvo Sotelo por mi edad, ya que entonces había sobrepasado la categoría juvenil y le venía bien para el reglamento, que obligaba a combinar juveniles con, al menos, dos fichas de mayores, aunque yo tenía 20 años. Fue una etapa en la que disfruté del deporte, del espíritu de equipo y en la que me impliqué al máximo porque, más que un equipo, era una manera de vivir".</p>

<p>Florencio lo justifica al especificar la metodología al detalle de Nuez, "quien componía unas rutinas de trabajo que eran propias del profesionalismo", lo que generó "una mentalidad de equipo única y que no entendía de horarios". Sesiones de gimnasio a las cinco de la mañana, carreras interminables en circuitos urbanos ("del colegio al López Socas y volver por todo el paseo de Chil"), entrenamientos con un nivel de tecnificación "sin competencia"...</p>

[cita_editorial author="Florencio Tejera"]Teníamos un equipazo. Pericles, Tony Vázquez, Paco Santana, Araña... Pero es que, además, físicamente superábamos a todos porque, en los partidos, se notaba una superioridad en todos los aspectos. Felipe nos tenía adiestrados a la perfección.[/cita_editorial]

<p>"Siempre queríamos ganar y, al ser un grupo de amigos, el apoyo entre todos era una máxima. Había una sana competencia, el afán de mejora era continuo, nadie ahorraba nada... Y luego cada uno retomaba sus rutinas en los estudios, en su entorno, pero siempre con el voleibol en mente. Con el siguiente partido, con el siguiente entrenamiento...", subraya.</p>

<p>Las rivalidades con el Juventud, el ambiente "impresionante" en los partidos, "con llenos en las canchas" en las que comparecía el Calvo Sotelo, los desplazamientos a la península, aquel campeonato provincial que dio derecho a disputar la Fase Sector en Madrid para aspirar a la Segunda Nacional...</p>

<p>"Fue impresionante asistir en primera persona a los inicios de lo que luego sería un equipo campeón y leyenda del deporte canario y recordar que, por encima de la maestría de un Felipe Nuez que era un adelantado a su tiempo, un entrenador que lo dominaba todo y preparaba cada partido al detalle, lo que nos distinguió era la amistad, el aprecio que nos teníamos, el sentimiento de pertenencia, la responsabilidad, asumida con naturalidad, de hacer crecer aquel escudo que nadie podía imaginar entonces que llegaría tan alto. Fue algo irrepetible. Y todos querían estar con nosotros, pertenecer al Calvo Sotelo era un signo de distinción porque llevaba implícita una rectitud de comportamiento y una mentalidad que nadie tenía entonces al menos en el voleibol canario. Sin cobrar, sacando adelante viajes llevando tabaco y otros artículos para vender en la península que servían para cubrir gastos, respirábamos voleibol siempre. Una madurez impropia a esa edad, se podría decir. Era nuestra vida", insiste.</p>

<p>Un accidente que le provocó, entre otras consecuencias, una rotura de fémur puso fin a su carrera como jugador en el Calvo Sotelo, en el que también ejerció funciones de entrenador, al tener la titulación de técnico internacional ("el primer triunfo ante el Juventud que logró el Calvo Sotelo, 2-3 en el Obispo Frías, fue bajo mi dirección técnica al estar Felipe Nuez ausente"). Pero lo que nunca pudo augurar es que, en 1983, de vuelta a Gran Canaria tras una larga estancia de índole académico por Madrid, sería propuesto e investido presidente.</p>

<p>"El club venía de una presidencia marcada por algunos desfases económicos. De regreso a casa, me pasaba por la cancha del Calvo Sotelo a saludar a los compañeros, interesarme por el equipo. Incluso seguí jugando un tiempo tras recuperarme en equipos como el Tabaiba... Primero me ofrecieron ser dirigente, pero llegó un momento que nadie quería asumir la presidencia, me lo dijeron y sentí la obligación de aceptarlo porque, repito, la situación era muy delicada y el club necesitaba una cabeza visible. Entré por un ejercicio de responsabilidad y de servicio a unos colores con los que mi vinculación, además de deportiva, era emocional. Y hasta tuve que poner dinero de mi bolsillo en un momento dado para abonar unos gastos. Ese dinero, pasados los años, me lo reintegró religiosamente Juan Ruiz. Durante mi presidencia me veía más como un colaborador del club que como un presidente. No tenía apego al cargo, mi voluntad era la de echar una mano en todo lo que pudiera", detalla.</p>

<p>Al ser requerido por Canarias7 para firmar un contrato como periodista del medio escrito creado dos años antes, en 1982, Florencio Tejera puso fin en 1984 a su cargo y vinculación formal con el Calvo Sotelo. "En adelante escribí del club, siempre con el cariño y afecto que le tenía, aunque con la obligación profesional, también, de anteponer mi integridad y fin informativo. Fui crítico con Juan Ruiz en lo que estimé, reconociéndole, eso sí, que puso al Calvo Sotelo en una dimensión privilegiada cuando entró como presidente, con estrellas nacionales e internacionales, títulos, prestigio... Desde la tribuna de prensa también asistí con dolor a la salida de Nuez en 1988, una figura de su calado yéndose, casi, por la puerta de atrás de un club que él había hecho nacer y prosperar, escribí con emoción de las gestas deportivas, del ambiente de un Centro Insular que vivió noches mágicas, me impactó la etapa en la que vinieron tiempos de incertidumbre por la crisis económica y, ya jubilado, he vuelto a sonreír y emocionarme con el renacimiento del Guaguas...".</p>

[cita_editorial author="Florencio Tejera"]Nadie se podía hacer a la idea de lo que acabaría siendo un Guaguas campeón que fue cogiendo el testigo de un equipo de cantera, plagado de juveniles y chicos de barrio, que llegaron a lo más alto que pudieron. Yo, evidentemente, tampoco. Pero siento que todo lo que hicimos mereció la pena. Fuimos unos locos, por decirlo de alguna manera. Soñamos, competimos, ganamos, entendimos el deporte desde el lado más humano y comprometido. Con eso me quedo.[/cita_editorial]
'),
    array('title' => 'Tony Vázquez', 'numero' => '', 'order' => 17, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Andaluz de nacimiento (Cádiz, 1960), pero grancanario de pleno derecho ("me trajeron con tres años y esta es mi tierra"), sobre Tony Vázquez recae el privilegio de haber sido otro de los jugadores fundacionales del Calvo Sotelo. Tras sus inicios en los Salesianos ("iba para el atletismo, pero Silvestre Cabrera me dijo que tenía la altura apropiada y me metió en el voleibol"), la creación de la selección cadete de Las Palmas, a mediados de los setenta y bajo la dirección de Felipe Nuez, fue el impulso definitivo a su posterior trayectoria como receptor ("era un 4 de toda la vida, aunque acabé jugando en todas las posiciones").[/capitular]

<p>Vázquez tiene muy nítidos aquellos momentos en los que tomó la decisión de enrolarse en las filas del equipo que marcaría su porvenir: "Después de terminar la experiencia en la selección cadete, en la que recuerdo que intervenimos en unos Campeonatos de España tras eliminar al Tenerife, el camino para aquellos jugadores era ir al Juventud o al Calvo Sotelo. Tenía muy buena relación con Felipe, había estado con él y no me costó decidir. Para nada me arrepiento porque todo lo que vendría después fueron tiempos muy felices, tanto dentro como fuera de la cancha".</p>

[cita_editorial author="Tony Vázquez"]Hasta 1984 formé parte de un equipo que, como siempre dije, se inició con cuatro pelagatos, sin un duro y solo sostenido en el trabajo, la disciplina y el amor por el deporte. Empezamos el camino con la pretensión de divertirnos, sin más. Pero comenzamos a ganar, ganar y ganar y aquello se nos fue de las manos.[/cita_editorial]

<p>"Del cemento del colegio pasamos a querer subir de categoría, de competir con los mejores de España, de estar a un nivel impensable...", detalla.</p>

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
'),
    array('title' => 'Isidro Quintana', 'numero' => '', 'order' => 18, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]A Isidro Quintana (Las Palmas de Gran Canaria, 1957) le metieron el voleibol en su vida "por obligación", como reconoce, porque, integrado en la sección de baloncesto de la UD Las Palmas durante su adolescencia ("llegué a jugar contra Domingo Díaz, que luego ha sido lo que ha sido"), iba para pívot con su imponente estatura en plena pubertad. "Pero se me cruzó en el camino Silvestre Cabrera, que me daba clases en los Salesianos, y me dijo, medio en serio, medio en broma, que o hacía voleibol o me suspendía. Me convenció prometiéndome que me llevaría directamente a la selección júnior. Empecé y ya no lo dejé. Fue tal mi interés que me saqué la titulación nacional de entrenador con 17 o 18 años para tener una formación más amplia y poder dirigir equipos, como luego haría con el Santa Teresa, y que, con Carlos Bermúdez como presidente, alcanzó enorme relevancia", añade.[/capitular]

<p>El caso es que, compaginando su labor de jugador, con inicio en el Juventud, con el de técnico en el conocido como Rusell Hall en honor a su patrocinio, y el de periodista, ejerciendo como informador en distintos medios de comunicación, Isidro Quintana se fue convirtiendo en toda una personalidad del voleibol isleño y con una influencia en todos los ámbitos que no paró de expandirse desde finales de los setenta hasta su reciente jubilación.</p>

<p>"Fue por una gestión mía, que hice a título personal y altruista, la llegada del primer sponsor de la historia del Calvo Sotelo, como ya antes había hecho con el Santa Teresa. Hablé con un contacto que tenía en Tabacalera y de ahí terminaron viniendo las denominaciones de Reales o Lucky Stricke. De hecho, en mi coche de entonces llevaba serigrafiados esos dos logotipos para dar mayor publicidad. Y Juan Ruiz, tanto antes de entrar por primera vez como presidente como cuando refundó la entidad, me llamó a título particular para avanzarme sus planes y pedirme consejos en virtud de mi experiencia. Un gesto que me llenó de orgullo. Por supuesto, siempre traté de ayudarle y brindarle el máximo apoyo que podía", razona.</p>

<p>Reclutado para el Calvo Sotelo por Felipe Nuez ("me convenció hablándome de potenciar un proyecto que iba para arriba y con una metodología de trabajo que yo sabía que nadie tenía en Canarias"), su desembarco en el club, en la campaña 1983-84, coincidió con el de otros dos compañeros del Juventud ("Ignacio Brito y el Chicha") que, según su parecer, "desniveló la balanza en favor del Calvo Sotelo en la rivalidad capitalina que existía y que, hasta ahí, era favorable al otro equipo".</p>

[cita_editorial author="Isidro Quintana"]Felipe me puso de central, cuando siempre había sido receptor. Fue un acierto porque pude dar un rendimiento importante para ayudar a los compañeros. Y me terminó de demostrar su enorme inteligencia como entrenador cuando transformó a Mendaño de rematador a colocador después de que sufriera una lesión que le dejó secuelas y le impedían subir a la red como antes. Fue una maniobra genial de Felipe, quien fue una figura capital en los primeros tiempos del Calvo Sotelo.[/cita_editorial]

<p>Fueron tres temporadas de militancia en el equipo, con picos de relevancia, como el ascenso a la División de Honor en 1985 o "la multitud de momentos de enorme compañerismo y amistad" que le deparó esta gran experiencia.</p>

<p>"Éramos un grupo sano, de amigos y que teníamos una gran relación dentro y fuera de la cancha. Ninguno podíamos pensar que aquello terminaría yéndose de las manos a todo el mundo y convirtiéndose en lo que fue, un equipo campeón, con dobletes nacionales, algo que tiene un mérito tremendo. La clave en esta transformación, en este salto al estrellato, se personifica en Juan Ruiz. Para mí es el rey, la persona clave. No se entiende el Guaguas sin Juan Ruiz y creo que no se entiende Juan Ruiz sin el Guaguas. Apostó por traer extranjeros, por ir a por los mejores jugadores que había en los rivales. Era la única manera de hacer un proyecto ganador", afirma.</p>

<p>En su rol de periodista, ya finalizada su etapa como jugador en el club, ha sido testigo puntual y al detalle de todas las gestas y progresos del Calvo Sotelo: "Su historia, desde el patio de un colegio, a la cima nacional, es de una grandeza enorme. Irrepetible. Tener a un superclase como Golec, o Klos, que no sabías si iba a rematar o a colocar, considerado uno de los cinco mejores colocadores del mundo, la conexión brutal de Camarero con una grada que hacía volar a los jugadores, ese CID lleno ante el PSG con casi 2.000 personas sin poder entrar, destronar al Palma, que parecía un imposible, regresar tras la desaparición con otro proyecto ganador y que vuelve a ilusionar a todos... Es una secuencia increíble de éxitos y superaciones".</p>

<p>Se congratula de que Juan Ruiz, "acompañado de otros históricos de talla inigualable como Sánchez Jover, Nuez o Camarero", haya podido rescatar un proyecto que parecía ya enterrado: "Fundé un club como el Cantur y terminó desapareciendo pese a los éxitos que logró. En el Vecindario sé que Sánchez Jover se dejó un dineral de su bolsillo y acabó quemado. De ahí que la jugada de coger esta plaza, con derecho a jugar en Europa como premio añadido, haya sido otro acierto más de Juan, capaz de reinventarse de nuevo en favor de un club que es patrimonio de nuestra tierra por trayectoria, historia e importancia".</p>
'),
    array('title' => 'Pericles', 'numero' => '', 'order' => 19, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Un pelo abundante y la barba que le daba aires intelectuales le valieron el apodo, Pericles, con el que se incrustaría, por derecho propio, en el listado de imprescindibles del Calvo Sotelo. "Me dijeron, medio en serio medio en broma, que me parecía a Pericles. No me lo tomé mal y así me quedé", admite. Pedro Román Rosario (Las Palmas de Gran Canaria, 1958) no fue uno más. Durante muchos años capitán y guía del resto, añadió a sus grandes dotes para el voleibol ("como receptor formé con Tony Vázquez una línea fabulosa en esa función") una lección de compromiso y entrega de impresión, ya que, pese a su condición de asmático, perteneció durante largo periplo al equipo y con un rendimiento ejemplar. "Salía a la cancha con mi Ventolín para poder resistir los esfuerzos. En los tiempos muertos y descansos casi prefería el fuelle que me daba el medicamento al agua. Y alguna vez me pincharon por las asfixias que me entraban. Que se lo pregunten a Alfredo Padrón, que iba para doctor, como ejerció posteriormente, y en más de una ocasión fue mi practicante en el vestuario", rememora.[/capitular]

<p>Así, venciendo a una patología tan severa ("hoy en día, jugar en esas condiciones sería impensable por todos los exámenes médicos que se hacen, pero en esa época no teníamos controles de este tipo, no había tanta vigilancia para preservar la salud de los miembros de los equipos"), adquirió galones y ascendente hasta situarse en un estatus que ya siempre le correspondería. De la primera época del Calvo Sotelo no hay miembro que pase por alto la influencia ejercida por Pericles y su aura de liderazgo única.</p>

[cita_editorial author="Pericles"]Me tomo como un halago el respeto y las muestras de cariño que siempre me dieron todos los compañeros. Nunca me consideré más o mejor que nadie. No va con mi carácter. Pero en lo que sí era muy estricto era en el sentido de la justicia y en pedir a todos que dieran lo que llevaban dentro en beneficio del equipo.[/cita_editorial]

<p>"Porque yo, con mi asma, me dejaba la vida por cada pelota, me tiraba a todas, peleaba cada punto, iba al límite. Y si yo podía, los demás no tenían excusa. Y tengo que decir que eso fue así, que éramos un grupo muy unido, muy solidario y que vivía el deporte de una manera intensa sin perder la enorme amistad que todos forjamos día a día y con un vínculo increíble", aclara.</p>

<p>Pericles comenzó a jugar en el colegio Santa Catalina ("sobre un patio de tierra y piedras") y, antes de definir sus pasos, probó en el balonmano y el fútbol. "Cuando Felipe Nuez me llamó para formar parte del equipo absoluto del Calvo Sotelo ahí ya me dije que quería el futuro dentro del voleibol porque me gustaba, se me daba bien. Y aprendí mucho yendo a ver a los Salesianos en sus partidos antes de iniciar mi carrera. Me lo tomé todo muy en serio. Por eso el Calvo Sotelo me marcó tanto y es para mí algo incomparable", afirma.</p>

<p>"Infinidad de anécdotas y situaciones" tiene muy presentes en su memoria porque, como significa, "fueron muchísimas horas de entrenamiento y convivencia" pese a que pertenecer a la entidad "daba satisfacciones pero sin alcanzar para cubrir las necesidades básicas".</p>

<p>"Hicimos de todo para lograr medios económicos y, por ejemplo, poder realizar viajes. Felipe Nuez y yo nos turnábamos como conductores para desplazar al resto porque, por edad, teníamos el carné de conducir a diferencia de la mayoría. Si no había guagua, ya sabíamos lo que nos tocaba. Cádiz-Cáceres, por ejemplo, del tirón y en las carreteras de antes. Yo conducía y, al día siguiente, a jugar. O si íbamos en guagua desde Madrid, pues a superar problemas, como cuando se averió el parabrisas e hicimos un recorrido de tres horas y diluviando con esa incidencia y todos cubriéndonos con mantas del miedo que nos invadió", precisa.</p>

<p>Además, resalta la manera de desempeñarse de aquel equipo que estaba llamado a cubrir un camino de gestas: "Felipe Nuez nos llevó a un listón increíble, con horas y horas de entrenamiento. Mañana y tarde. Trabajaba, porque me casé y fui padre muy joven, y tenía que hacer magia para alternar mi oficio con los horarios en el gimnasio, en la pista... Pero eso nos vino bien a todos porque valorábamos que tanto perfeccionamiento nos llevaba a ganar. Notábamos que los rivales estaban por debajo de nosotros. Superamos al Juventud, que era impensable. Y ya luego los ascensos fueron algo tremendo".</p>

<p>"En los partidos no parábamos de movernos. Tuviéramos o no el balón. Siempre en tensión, preparados para todo tipo de situaciones. Era como una seña de identidad y porque disponíamos de la condición física necesaria para ello. Y los partidos se iban a las tres horas por el antiguo formato de tener que ganar tu punto, no como en la actualidad. Por eso cuando veo algún encuentro y noto que hay jugadores como si la cosa no fuera con ellos, parados, casi con los brazos cruzados, me pillo unos cabreos enormes. Eso va en contra de lo que yo pienso del voleibol y de lo que a mí me enseñaron", argumenta.</p>

<p>Hay un recuerdo especial, por su parte, "a dos caballeros como fueron Luzardo y Antonio Trejo", según opina, "grandes artífices con su empeño, trabajo y dedicación" a que el club "creciera y llegara hasta donde llegó", aunque matiza que la lista de personas que posibilitaron los sueños cumplidos "es muy amplia y nadie que lo merece debe quedarse fuera".</p>

<p>"Mi etapa llegó hasta el inicio de la temporada 1986-87, justo con la llegada de Ivo Martinovic. Desde 1977, que se dice pronto. En ese momento sentí que no estaba capacitado para dar el nivel que requería un equipo ya con los mejores de España. Decidí irme. Creía que había dado lo mejor que tenía, que mis servicios al Calvo Sotelo se habían completado llevando al equipo desde abajo a la máxima categoría. Luego seguiría jugando en el Luna, un equipo que creamos varios compañeros que salimos del Guaguas en esa época para tratar de mantener el espíritu de cantera que se fue perdiendo poco a poco", añade.</p>

<p>Pericles optó, tras su retirada definitiva, luego de una incursión en el vóley-playa "desconectar del todo" y se alejó del deporte para centrarse en su vida familiar, si bien, por el contacto que mantuvo con varios excomponentes del Guaguas, conoció la desaparición del club en 2009 y el retorno, de nuevo, once años después.</p>

[cita_editorial author="Pericles"]Dejaron morir injustamente un equipo que lo ha significado todo para el deporte en Canarias. Eso me produjo un disgusto enorme. Por suerte, ahora se ha recuperado la entidad, aunque preferiría que se apostara más por jóvenes de la tierra aunque eso supusiera no ganar títulos. Eso sí, hay que felicitar a Juan Ruiz por el trabajo que ha hecho para que no cayera en el olvido esta institución tan querida.[/cita_editorial]
'),
    array('title' => 'José Millán', 'numero' => '', 'order' => 20, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Si la figura de Silvestre Cabrera fue de trascendencia capital para auspiciar el voleibol durante su mandato como presidente de la Federación de Las Palmas (1973-1985), no es menos relevante la influencia, también de enorme impacto, de José Millán, quien en diciembre de 1976 asumió el cargo de secretario del ente presidido por Cabrera, tomó su relevo a la conclusión de su ciclo como máximo mandatario y terminó encabezando la Federación Canaria de Voleibol hasta 2008. Más de tres décadas de contribución y entrega que le hicieron tener una atalaya privilegiada de los acontecimientos, al tiempo de otorgarle un lugar preferencial en la historia de esta disciplina.[/capitular]

<p>Millán (Sevilla, 1933-Las Palmas de Gran Canaria, 2023) fue otro de los testigos que vivió, desde los inicios hasta su desarrollo, pasando por la eclosión de los títulos, la vida del Calvo Sotelo, una entidad a la que reconoció tener "mucho cariño y respeto" por la contribución que hizo en la historia del deporte en Canarias.</p>

[cita_editorial author="José Millán"]Siempre presté mi ayuda a todos los clubes y equipos y el Calvo Sotelo no fue una excepción. Su labor con los chicos, con la cantera, fue muy valiosa y tuvo el acierto, además, de complementar el bloque con algunos veteranos. Se veía que era un proyecto que podía llegar alto por la dedicación y el empeño que le ponían, con Felipe Nuez al frente.[/cita_editorial]

<p>El dirigente reafirmó que la consecución de títulos por parte del ya denominado Guaguas Las Palmas "supuso un gran espaldarazo" para el voleibol canario, por lo que cabía distinguir al club "por ser el primero y el que contribuyó a que la afición se volcara". Ahí estaban las imágenes de las canchas llenas, primero el San Román, luego el Centro Insular, y la repercusión mediática que conllevó.</p>

<p>Y no pasó por alto el impulso que llegó con Juan Ruiz, a mitad de la década de los ochenta: "Juan disparó al Guaguas, lo llevó a lo más alto cuando parecía que lo que él quería era imposible. Hizo un equipo del que todos disfrutamos. Tenemos que ser justos con él y darle el mérito que le corresponde. Hubo un antes y un después en la historia del voleibol y del deporte en nuestras islas. Juan Ruiz fue quien marcó el cambio de una etapa a otra".</p>

<p>"Hay que valorar lo que hicieron, saliendo de un colegio y con muy pocos medios. Fueron superándose, nunca se rindieron ante las dificultades. Como dirigente que era en esos años, contemplé con mucha satisfacción su labor formativa, su salto al profesionalismo, los fichajes de grandes jugadores... Fue una evolución preciosa y que, pienso, hizo muy feliz a los aficionados. Irrepetible, diría yo", añadió.</p>

<p>Millán tampoco obvió el valor añadido que dio codearse con los mejores de Europa, otro de los hitos del Guaguas: "Colocaron en el mapa nuestro voleibol, nuestra tierra. Fueron embajadores de España. Faltó suerte para lograr un título continental, pero su contribución fue impresionante y digna de aplauso en todos los sentidos".</p>
'),
    array('title' => 'Miriam Quiroga', 'numero' => '', 'order' => 21, 'show_marker' => false, 'parent_ref' => 'cap01',
        'content' => '
[capitular]Miriam Quiroga, licenciada en Educación Física y profesora universitaria, publicó en el año 2010 el libro \'Génesis y evolución del voleibol en Gran Canaria 1934-1978\', editado por el Servicio de Publicaciones de la Universidad de Las Palmas de Gran Canaria, en el que se incluye amplia documentación escrita y gráfica del nacimiento y desarrollo del Club Voleibol Calvo Sotelo. Su testimonio es de indudable valor a la hora de analizar el surgimiento de la entidad y, a petición del autor de esta obra, además de mostrar una generosa colaboración bibliográfica, cediendo numeroso material que obraba en su poder, entre el que cabe destacar el documento original de los estatutos fundacionales que se reproduce en su integridad al final de este capítulo, accedió a responder este breve cuestionario y en el que aporta información alusiva a los primeros tiempos de la institución. Conste desde estas páginas el agradecimiento y reconocimiento de la directiva actual del Guaguas, presidida por Juan Ruiz, a su labor investigadora así como a su gesto de ayudar a este proyecto editorial.[/capitular]

<p><strong>En el ámbito del deporte escolar de los setenta, germen del voleibol profesional y de éxito posterior, ¿qué destaca de la contribución del Calvo Sotelo y de técnicos pioneros como Francisco Rodríguez o Felipe Nuez?</strong></p>

<p>"La contribución del Colegio Nacional Calvo Sotelo y de técnicos pioneros como Francisco Rodríguez Álvarez, Miguel Nieves Toledo, Félix Rodríguez Delgado y Felipe Nuez Domínguez es fundamental en el desarrollo del voleibol en Gran Canaria. A mediados de los años 60, del siglo XX, el crecimiento de los barrios de Las Rehoyas Bajas, Cruz de Piedra, Miller Bajo y Los Arapiles, hizo que muchas familias jóvenes, con hijos, se instalaran en ellos, haciendo necesaria la edificación de centros escolares en estas zonas. Uno de esos centros, ubicado en el barrio de Las Rehoyas, fue el Colegio Nacional Calvo Sotelo, que inició su andadura en el curso 1967-68".</p>

<p>"En dicho colegio, el curso 1968-69, imparte docencia, como maestro nacional, Francisco Rodríguez Álvarez, quien es también conocedor del voleibol, e introduce este deporte en el centro participando en los III Juegos Deportivos para Enseñanza Primaria. Francisco Rodríguez Álvarez dedica gran parte de su tiempo libre preparando tanto a los niños como a las niñas del Colegio Nacional Calvo Sotelo para participar en las competiciones escolares de la época, llegando a conseguir destacados triunfos como el Campeonato de España Femenino de Voleibol en los Juegos Deportivos de Enseñanza General Básica, el curso 1971-72".</p>

<p>"La semilla del voleibol fue sembrada, a nivel escolar, en el Colegio Nacional Calvo Sotelo por Francisco Rodríguez Álvarez, quien trabajó en dicho centro hasta el curso 1975-76, y también por otro maestro nacional, Miguel Nieves Toledo, quien el curso 1972-73 entrena al equipo de categoría infantil masculina".</p>

<p>"La temporada 1974-75, el Colegio Nacional Calvo Sotelo participa por primera vez en una competición a nivel federado y lo hace con un equipo masculino. Concretamente competirá en el Campeonato Provincial de Segunda División y será Miguel Nieves Toledo quien traerá como entrenadores a Félix Rodríguez Delgado y a Felipe Nuez Domínguez. Ambos procedentes de la desaparecida sección de voleibol masculino del Club Canteras Unión Deportiva. Felipe Nuez Domínguez, estudiante de Magisterio y entrenador de voleibol, la temporada 1974-75, quedará como entrenador, al frente del voleibol federado del Club Voleibol Calvo Sotelo, consiguiendo el ascenso a División de Honor la temporada 1984-85 y permaneciendo como primer entrenador del mismo hasta mayo de 1988".</p>

<p><strong>¿Qué momento considera más crucial, antes de la composición de los estatutos, en la cronología primigenia del club?</strong></p>

<p>"Un momento clave es el de la creación de la primera directiva, como esbozo de lo que sería la fundación oficial del club con la redacción de sus Estatutos en noviembre de 1976. El apoyo de los componentes de esta directiva hacia el voleibol que se practicaba en el Colegio Nacional Calvo Sotelo fue fundamental para que el voleibol continuara practicándose con fuerza en el colegio, siendo su presidente José Celestino Luzardo Hernández".</p>

<p>"También es un momento clave la llegada como entrenador, la temporada 1974-75, de Felipe Nuez Domínguez, pues será quien dedicará mucho tiempo a la formación de los jóvenes que se aficionarán a practicar voleibol, elevando cada temporada el nivel de los entrenamientos".</p>

<p><strong>¿Qué aspecto le resultó más significativo o característico del Calvo Sotelo en comparación con otros clubes en sus primeros años de vida?</strong></p>

<p>"La dedicación de los maestros nacionales de la época hacia este deporte es un hecho significativo, pero no solo en la génesis del CV Calvo Sotelo, sino también en la mayoría de los clubes. Paralelamente al Club Voleibol Calvo Sotelo, en Gran Canaria otros clubes también se crearon a través de su presencia en centros escolares, como, entre otros: el Juventud Las Palmas, el Club Voleibol Jóvenes Aficionados al Voleibol Olímpico, el Club Voleibol San Roque o el Club Voleibol Russell Hall Las Palmas".</p>

<p><strong>¿Supuso el modelo del Calvo Sotelo el triunfo del romanticismo y del espíritu de superación al salir del patio de un colegio y terminar derivando en aquel Guaguas campeón de España?</strong></p>

[cita_editorial author="Miriam Quiroga"]El modelo del Club Calvo Sotelo supuso saber compartir la pasión por un deporte y lo que ello significa. Dedicar horas de trabajo al entrenamiento, estar dispuestos a dar siempre lo mejor de uno mismo en la cancha representando a tu equipo, aprendiendo de todo lo que llegó a la isla, voleibolísticamente hablando, a lo largo del tiempo.[/cita_editorial]

<p><strong>¿Qué legado queda de aquella época irrepetible del primer Calvo Sotelo?</strong></p>

<p>"Todos los momentos vividos en la historia del Club Voleibol Calvo Sotelo constituyen un valioso legado para el deporte canario. Pero, sobre todo, queda la constatación de que si se hace un buen trabajo, tanto desde el punto de vista deportivo como organizativo, se consiguen excelentes resultados, tanto a nivel nacional como internacional. La recuperación del Club Voleibol Calvo Sotelo con un equipo en la máxima división del voleibol español permite la posibilidad de recuperar un nivel deportivo elevado pero, al mismo tiempo, evitando repetir errores que llevaron a la desaparición del club años atrás".</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 02: LOS ESTATUTOS FUNDACIONALES
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Estatutos Fundacionales',
        'numero' => '02',
        'order' => 25,
        'show_marker' => true,
        'ref_id' => 'cap02',
        'hero' => array(
            'image' => libro_img('hero-estatutos.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('ESTATUTOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('FUNDACIONALES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
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
'),

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
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 70,
            'icon_height' => 70,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('ASÍ SE FORJÓ', '#D4AF37', '', 'black'), libro_hero_line('UNA LEYENDA', '#FFFFFF', '', 'black')),
        ),
        'content' => ''),
    array('title' => 'Llegar a la élite para quedarse', 'numero' => '', 'order' => 31, 'show_marker' => false, 'parent_ref' => 'cap03',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('LLEGAR A LA ÉLITE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('PARA QUEDARSE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]La temporada 1985-86 fue la del estreno del Calvo Sotelo en la División de Honor y se afrontó bajo las mismas líneas maestras que habían marcado su trayecto, desde las consideraciones de Felipe Nuez, aunque con la importante novedad del fichaje del yugoslavo Ivo Martinovic, primer extranjero en la historia del club que, con 30 años y amplio bagaje profesional e internacional, venía a darle a la plantilla la cuota de veteranía que se requería para competir a escala máxima. Jorge Ramón, Juanma Martín, Alfredo Padrón, Miguel Mendaño, Óscar Campos, Francisco Reyes, Sergio Miguel Camarero, Martín Medina, el mencionado Ivo Martinovic, Enrique González Silva y José Ramón, más los juveniles Javier Ulacia, Alejandro Menéndez, Roberto Padrón y Alejandro Gil eran los componentes de aquel histórico equipo que se adentró entre los grandes y lo hizo con relativo éxito.[/capitular]

<p>Pese a los condicionantes económicos derivados de no tener un patrocinador (tras dos años con las denominaciones Reales y Lucky, relacionadas con el tabaco, Tabacanarias no renovó su compromiso), lo que supuso un hándicap sustancial, se logró eludir con solvencia el riesgo de descenso y hasta quedar encuadrado en la entonces denominada Serie A1, en la que competían los primeros clasificados de cada grupo. Martinovic, elegido capitán en su primera campaña, y un Camarero que ya demostraba que iba para jugador de época, fueron los sostenes de un grupo que rindió por encima de lo esperado. Para el recuerdo queda aquel 2 de noviembre de 1985, fecha del debut del Calvo Sotelo en la División de Honor con triunfo en Cáceres ante el Licenciados Reunidos por 0-3. Jorge Ramón, Juanma Martín, Campos, Camarero, Martinovic y González fueron los jugadores alineados en el inicio de un trayecto que iba a conducir a la gloria.</p>

<p>El 21 de octubre de 1986 se celebra en el salón de la Boutique del Jamón, sita en Mesa y López, la asamblea general extraordinaria del club motivada por la salida del anterior presidente, José María Rodríguez, y la transición que comanda como coordinador Gustavo Rodríguez. Se anuncia en los medios de comunicación la posibilidad de que entre una plancha que "pueda llevar al Calvo Sotelo por buen camino y consolidarlo como un club grande dentro del voleibol español". Ahí arranca la etapa de Juan Ruiz en el alto mando y que se prolongaría, de manera ininterrumpida, hasta 1998. El déficit heredado es de "aproximadamente seis millones de pesetas".</p>

<p>En realidad la mala situación financiera que atravesaba el Calvo Sotelo ya era de sobra conocida y publicitada. Y el papel de los medios de comunicación pidiendo una alternativa para evitar la desaparición fue lo que atrajo el interés de Juan Ruiz, hasta entonces un neófito en el voleibol y que, alertado por las informaciones que le llegaban a través de su periodista de cabecera, el que escuchaba a diario a través de las ondas de Antena 3: Paco García Caridad.</p>

[cita_editorial author="Paco García Caridad"]Fue un ejercicio de responsabilidad con la sociedad canaria lanzar desde las ondas un mensaje de auxilio en favor del Calvo Sotelo. No podíamos dejar que un proyecto de cantera tan serio y valioso se viniera abajo. Más que un club, el Calvo Sotelo era un modelo educativo, un espejo en el que mirarse por sus orígenes y crecimiento. Defender al Calvo Sotelo y su supervivencia era un acto de justicia social, un alegato por el patrimonio deportivo del momento.[/cita_editorial]

<p>Siguen los movimientos en ese periodo, ya con el equipo iniciando su segundo año en la División de Honor: el 23 de octubre de 1986, Gustavo Rodríguez, coordinador de la junta gestora, informa de que "hay una nefasta gestión de la directiva anterior". Ismael Chinea, Fidel Morales, Felipe Nuez, Juan M. Martín e Ivo Martinovic son los miembros del equipo de trabajo designado para pilotar el cambio necesario en la gestión y el gobierno de la institución. Aunque no se menciona expresamente, Juan Ruiz ya está integrado en el mismo, como bien se certificaría días después anunciando, de su mano, la llegada del ansiado patrocinador.</p>

<p>Y la noticia más esperada desde hacía meses, la de la aparición de un patrocinador que otorgara la estabilidad perdida y permitiera cuadrar números, se anunció el 5 de noviembre de ese mismo 1986. Juan Ruiz, que ya ejerce como miembro visible de la junta gestora del Club Voleibol Las Palmas, confirma que, "después de varias conversaciones con Juan Rodríguez Doreste", alcalde de Las Palmas de Gran Canaria, Guaguas Municipales patrocinará a la entidad, que, desde entonces pasará a denominarse Guaguas Las Palmas. Su primer partido con este nombre lo disputó el 15 de noviembre ante el Cisneros y en Tenerife. La consecución de este patrocinador, con el que el club ganaría títulos y adquiriría fama internacional, es el primer golpe de efecto de Ruiz en la historia de su mandato.</p>

<p>En el plano deportivo, el equipo, con las grandes novedades del regreso de Pericles y Batista, mantiene su buen tono. El 19 de enero de 1987 queda tercero en la Copa del Rey celebrada en Sa Pobla, Mallorca, tras imponerse por 3-1 al Cisneros de Tenerife, consiguiendo, de esta manera, su clasificación para la Copa Confederación. Jorge Ramón, Ivo Martinovic, Sergio Camarero, Juanma Martín, Óscar Campos y Eduardo Macías integraron un equipo inicial al que luego se sumó Alejandro Gil. El quinto puesto logrado, posteriormente, en la Liga redondeó una campaña de sobresaliente considerando la naturaleza advenediza del Guaguas.</p>
'),
    array('title' => 'Fichajes de impacto y hegemonía', 'numero' => '', 'order' => 32, 'show_marker' => false, 'parent_ref' => 'cap03',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('FICHAJES DE IMPACTO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('Y HEGEMONÍA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]El verano de 1987, ya con dos años de experiencia en la élite, marca el escalón cualitativo que instala al Guaguas en la excelencia. El fichaje de Paco Sánchez Jover, figura indiscutible del voleibol nacional, fue una auténtica jugada maestra de Juan Ruiz al captar al jugador del momento. Por si fuera poco, con Sánchez Jover llegan su hermano Jesús, Venancio Costa, Antonio Miralles. Todos darían excelentes réditos al escudo. Y Paco vino para no irse jamás y liderar los años dorados que ya estaban incubándose.[/capitular]

<p>Los resultados se disparan y son un aviso al resto de que Gran Canaria exhibe proyecto ganador. Además del bautizo europeo frente al Knack de Bélgica, en una eliminatoria saldada con derrota pero cuya importancia trascendió al resultado por su valor simbólico, los subcampeonatos de Liga y Copa del Rey suponen la antesala de los éxitos que ya eran inminentes. El relevo en el banquillo de Felipe Nuez en 1988, el técnico de toda la vida y que tras más de quince años ininterrumpidos en su cargo se despedía de la entidad que vio nacer, fue la nota discordante en la crecida colectiva que cogió una velocidad imparable en esta campaña.</p>

<p>El aterrizaje de los mexicanos Sergio Hernández, para el banquillo, y Chava González, así como la apuesta por el canadiense Brad Willock terminan por ensamblar un Guaguas ya de valores consolidados de los años anteriores y que, como fruta madura, inaugura su palmarés con la Copa del Rey conquistada el 9 de abril de 1989 ante el Palma en el Centro Insular.</p>

<p>El recinto capitalino ya era la nueva casa del club después de haber estado desde siempre, tras su ingreso en las competiciones estatales, como anfitrión en el García San Román. La mudanza a la nueva instalación generó ciertas controversias, pues había dudas de que se ajustara a las necesidades de un club todavía con una afición fiel pero minoritaria. Los éxitos trajeron las muchedumbres desde que un 22 de octubre de 1988 se disputara el primer partido del Guaguas en el CID con motivo de su inauguración. Fue en el Torneo Internacional Isla de Gran Canaria, integrando cartel con el Seven Up Santa Catalina, Cisneros de Tenerife y Slavia de Sofía. El Guaguas ganó 3-0 al Seven Up.</p>

<p>Esa Copa, que abría las vitrinas del Guaguas, no hizo más que multiplicar las ambiciones de Juan Ruiz, quien une a su elenco de estrellas, en el verano de 1989, a los internacionales polacos Ireneusz Klos y Waclaw Golec, llamados a ser ídolos y figuras diferenciales. Esa primera Liga que se resistía sería una realidad el 1 de mayo de 1990 con la inolvidable final ante el Bomberos de Barcelona, bajo la denominación comercial de Constructora Atlántica Canaria, y con Sánchez Jover ejerciendo de jugador-entrenador y luego de ocupar la vacante en el banquillo que dejó a mitad del calendario el americano Robert Croteau.</p>

[resaltado]A esa primera Liga le sucederían otras cuatro consecutivas hasta 1994, estableciendo una hegemonía nacional inédita en los representativos canarios y que, además, estuvo aderezada con tres dobletes por las Copas del Rey también conquistadas en los años 1991, 1992 y 1993.[/resaltado]

<p>Son campañas en la Copa de Europa, con cruces ante los mejores del continente, llenos a reventar en el Centro Insular, máximo esplendor dentro y fuera de España y un desfile de nombres que se hicieron un sitio en el corazón de todos los aficionados. A los ya conocidos de Camarero, Juanma Martín, Jorge Ramón, Sánchez Jover, Miralles, Costa, Klos o Golec, se unieron los Sharma, Falasca o Wiernes.</p>

<p>Particular mención merecen Sánchez Jover y Juanma Martín, consagrados al simultanear sus labores de jugador con las de técnicos y de igual fertilidad para los éxitos de la entidad, poniendo, también, el foco en el cuidado de la cantera. Ya entonces, en ese inicio de la década de los noventa, se reclutan por los colegios (y hasta por la calle, a golpe de intuición) a jóvenes de la tierra para que garanticen el relevo generacional y revaliden el espíritu primigenio del Calvo Sotelo, creado en torno al jugador isleño. Antonio Sánchez es uno de los canteranos criados en esta fase y que tendría larga continuidad en los Alexis Valido, Juan Carlos Vega, los hermanos Cabrera, Raúl Dávila o Níchel Gómez, entre otros.</p>

<p>Fueron doce los títulos que se atraparon desde 1989 a 1997, etapa de concentración luminosa, y que granjeó la leyenda de un Guaguas que, por momentos, llevó la bandera del deporte en Gran Canaria, al coincidir sus hitos con momentos menos pujantes de UD Las Palmas o CB Gran Canaria, los símbolos más tradicionales de las disciplinas por equipos de la isla.</p>

<p>Iniciativas pioneras como lucir publicidad en contra de las drogas, abrir las puertas del pabellón a todos los que quisieran entrar sin pagar precio alguno, como sucedió ante el PSG, o democratizar la práctica del voleibol creando alianzas y convenios con clubes de la geografía local impulsaron, más si cabe, la fama y prestigio de un club también profesionalizado y gestionado por un modelo administrativo riguroso y que en los años de presidencia de Juan Ruiz siempre arrojó balances favorables, con niveles de endeudamiento asumible y un apoyo unánime del sector empresarial.</p>

<p>Los llenos habituales en el Centro Insular, a la par que las más que frecuentes retransmisiones en directo por la televisión, convirtieron las vallas publicitarias en soportes codiciados y que redundaron, para bien, en los dineros del Guaguas. Eso permitió mantener una base de primera categoría cada temporada y unir, cuando procedía, a refuerzos de contrastada calidad.</p>

<p>La creación de una cultura ganadora, que convertía en noticia y crisis cada título que se escapaba, habla a las claras del listón en el que se movió el club, siempre orientado a construir plantillas que aspiraran a todo y sin eludir la presión que aparejaba tener el balance de galardones que se exhibía.</p>
'),
    array('title' => 'La salida de Juan Ruiz, principio del fin', 'numero' => '', 'order' => 33, 'show_marker' => false, 'parent_ref' => 'cap03',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('LA SALIDA DE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('JUAN RUIZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Tras doce años en la presidencia y algún amago de abandono prematuro, tal y como reconoció a cuenta de críticas que consideraba desproporcionadas, Juan Ruiz quiso respetar lo reflejado en los estatutos y ceñirse a lo establecido con la máxima durabilidad de su cargo. A la conclusión de la temporada 1997-98, saldada con la Supercopa de España, dio el relevo en la cúpula a Mario Hugendubel. Fue algo más que un traspaso de poderes para alguien que dedicó su vida al servicio de un club que heredó en ruinas y legó en una posición de privilegio.[/capitular]

<p>Títulos (doce en total), cantera (ya con internacionales absolutos salidos de las categorías inferiores), superávit, crédito en entidades privadas y credibilidad a ojos de los organismos públicos. Un Guaguas respetado en España y en Europa (con participaciones en competiciones continentales de manera ininterrumpida desde 1987) y con las bases para continuar su expansión, dada la estructura existente y el nivel de profesionalización instaurado. Fueron muchas las voces que trataron de disuadir a Juan Ruiz del paso que iba a dar, quizás intuyendo que sin él nada sería igual, como así ocurriría.</p>

[cita_editorial author="Paco Sánchez Jover"]Todo cambió y para peor.[/cita_editorial]

<p>De repente, ya con el presidente histórico fuera, el sentimiento de orfandad fue inmediato, por muchos esfuerzos que pusiera Hugendubel, quien trató de ilusionar desde sus primeras manifestaciones. Sánchez Jover permanecería en el club hasta el verano de 1999. Su presencia se consideraba de especial valor estratégico para la pervivencia del proyecto, tanto en la rama sénior como en las categorías de base. Y, tras dos años como testigo de "la deriva", según sus palabras, que fue cogiendo el club bajo otros parámetros directivos. El cambio de siglo deparaba la marcha del último gran símbolo del Calvo Sotelo.</p>

<p>Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos y que le ligaron por siempre a esta tierra.</p>
'),
    array('title' => 'La cronología', 'numero' => '', 'order' => 34, 'show_marker' => false, 'parent_ref' => 'cap03',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('LA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('CRONOLOGÍA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content">El 2 de noviembre, y ante el Licenciados Reunidos en Cáceres, el Calvo Sotelo disputa su primer encuentro en la División de Honor con victoria (0-3).</div></div>
<div class="timeline-event"><span class="timeline-year">1986</span><div class="timeline-content">El 21 de octubre se celebra la asamblea general extraordinaria del club en la que Juan Ruiz tiene su primera toma de contacto formal con la junta gestora. Días después anunciaría el histórico acuerdo con Guaguas Municipales para que patrocinase y diera su nomenclatura al equipo.</div></div>
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content">Tercera posición en la Copa del Rey (enero), fichajes de Paco Sánchez Jover, Venancio Costa y Antonio Miralles (julio) y estreno en competiciones europeas ante el Knack de Bélgica (noviembre).</div></div>
<div class="timeline-event"><span class="timeline-year">1988</span><div class="timeline-content">Subcampeonatos de Liga y Copa del Rey y salida del club del histórico preparador Felipe Nuez tras más de quince años.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content">El 9 de abril se conquista el primer título, con la Copa del Rey ganada al Palma en el Centro Insular (3-0). En verano se producen los fichajes de los polacos Ireneusz Klos y Waclaw Golec.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content">El 1 de mayo se gana la primera Liga, con Paco Sánchez Jover como jugador-entrenador, con un rotundo 3-0 al Bomberos de Barcelona en el Centro Insular.</div></div>
<div class="timeline-event"><span class="timeline-year">1991</span><div class="timeline-content">Año con un mes de abril mágico con el primer doblete: Liga el día 13 ante el Orisba Palma (3-0) y la Copa, el 28 frente al Construcciones Alcalá de Tenerife por idéntico tanteador.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content">Se repite la gesta con los dos torneos nacionales: Liga el 4 de abril ante el Andorra (3-1) y Copa, el 25 del mismo mes y repitiendo rival por 3-0.</div></div>
<div class="timeline-event"><span class="timeline-year">1993</span><div class="timeline-content">La supremacía nacional del equipo se constata por tercera campaña consecutiva y alzando los dos trofeos lejos de Gran Canaria: Liga en Soria ante el Caja Duero (2-3) y Copa del Rey en Murcia sometiendo al Almería por 2-3.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content">Continúa el reinado en la Liga con un triunfo en Soria ante el Grupo Duero por 1-3, acaecido el 27 de marzo, que vale el quinto campeonato consecutivo.</div></div>
<div class="timeline-event"><span class="timeline-year">1995</span><div class="timeline-content">El 8 de septiembre, en un amistoso ante el conjunto brasileño del Banca Suzano, se rindió homenaje en el Centro Insular a Paco Sánchez Jover tras su retirada como jugador.</div></div>
<div class="timeline-event"><span class="timeline-year">1996</span><div class="timeline-content">Nueva Copa del Rey: llega el 13 de abril, ante el Soria, en el Centro Insular (3-2), un partido emotivo, pues sería el último de leyendas como Klos, Golec o Camarero. También se logra la primera Supercopa de España, el 16 de septiembre (3-1).</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content">Con una remontada memorable, el 5 de abril en el Centro Insular, el Gran Canaria Arehucas se apunta otra Copa frente al Unicaja Almería (3-2).</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content">Tres hechos trascendentales: el homenaje a Sergio Miguel Camarero (7 de enero), la participación en la Final Four de la Recopa en Cuneo (Italia), el mayor hito europeo del equipo, y Juan Ruiz pone fin a su presidencia tras doce años de sobresaliente gestión.</div></div>
<div class="timeline-event"><span class="timeline-year">1999</span><div class="timeline-content">En el verano, finalizada la campaña 1998-99, Paco Sánchez Jover, hasta ese momento entrenador, abandona el club.</div></div>
</div>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 04: EL PROYECTO VISIONARIO DE JUAN RUIZ
    // ═══════════════════════════════════════════════
    array(
        'title' => 'El proyecto visionario de Juan Ruiz',
        'numero' => '04',
        'order' => 36,
        'show_marker' => true,
        'ref_id' => 'cap04',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.85)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('EL PROYECTO', '#D4AF37', '', 'black'), libro_hero_line('VISIONARIO', '#FFFFFF', '', 'black'), libro_hero_line('DE JUAN RUIZ', '#D4AF37', '', 'black')),
        ),
        'content' => ''),
    array('title' => 'El hombre que lo cambió todo', 'numero' => '', 'order' => 37, 'show_marker' => false, 'parent_ref' => 'cap04',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('EL HOMBRE QUE LO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('CAMBIÓ TODO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Nacido en La Aldea de San Nicolás en 1953, emigrante con su familia a Tenerife durante gran parte su adolescencia (1960-1969), en la que hizo sus pinitos en la lucha canaria o el fútbol ("con 16 años llegué a jugar en Tercera División en las filas del Adeje"), Juan Ruiz estaba llamado, sin saberlo, a escribir una historia sin parangón en el deporte canario y al frente del Calvo Sotelo. No hay dirigente isleño con tal nómina de títulos en su poder, todos los conquistados por la entidad, y con el mérito añadido de haber armado un equipo campeón desde las cenizas. Tanto en 1987 como en 2020 acudió al rescate recogiendo una tesorería en ruinas y un porvenir tan comprometido que apuntaba a la desaparición.[/capitular]

[cita_editorial author="Juan Ruiz"]El secreto es trabajo y pasión. Constancia y ambición. No rendirse jamás. Si para conseguir un patrocinador tengo que visitar veinte empresas, acabo entrando en cuarenta. Si para ser campeón me tengo que traer a una estrella, trato de que sean dos.[/cita_editorial]

<p>El punto de partida de este fértil y exitoso ciclo en el palco, en un hombre "sin tradición alguna en el voleibol", arranca de manera "casi casual y del todo inesperada". Año 1986. Desde su estabilidad laboral como apoderado de la empresa Napesca, Juan Ruiz sigue a la distancia, "como un aficionado más", las evoluciones de los distintos clubes de Gran Canaria. "Siempre me ha gustado el deporte y estaba al día de todo", reconoce. Fiel a su costumbre de desayunar en la cafetería del periódico La Provincia en el polígono industrial de El Sebadal, allí coincidía cada mañana con informadores del medio. "Era habitual oyente de Paco García Caridad, que estaba en Antena 3 Radio. Nos saludábamos, hablábamos a menudo de manera desenfadada... Hasta que un día me comentó que un histórico, el Calvo Sotelo, estaba a punto de desaparecer. Que necesitaba alguien que echara una mano... O dos. Porque la situación era de extrema gravedad".</p>

[cita_editorial author="Juan Ruiz"]Por lo que fuera, me sentí en la obligación de hacer algo. Me movió una motivación de responsabilidad. Le pregunté abiertamente a Nuez por el mejor jugador de España. Me dijo que era Paco Sánchez Jover. Le contesté que entonces habría que traerlo. Y me miró como si hubiese dicho un disparate.[/cita_editorial]

<p>"Me reuní con Felipe Nuez, estaba también Ivo Martinovic. Me explicaron la situación. Lo primero que hice fue hablar con el director de Cajacanarias de Tenerife. Buscaban ampliar su mercado e implantarse en Gran Canaria. Les dije que nada mejor para adquirir publicidad que invertir en un club de tradición y que le daría impacto. Aceptó y dieron 500.000 pesetas, un alivio para cómo estaba todo".</p>

<p>"Mantuve varias conversaciones luego con Gustavo Rodríguez, entonces presidente de la junta gestora, con Ismael Chinea, con Nuez. Le dije que yo podía entrar en la directiva. No pensaba ser presidente. No quería ni necesitaba notoriedad porque mi vida la tenía cubierta con mi trabajo. Pero resulta que ninguno podía asumir las funciones ejecutivas que se requerían para buscar fondos y anunciantes que le dieran músculo financiero al club. Total, vine para ayudar y me pusieron al frente de todo", sintetiza.</p>

<p>Pronto, recién aterrizado en la junta gestora, se apunta otro logro de capital importancia estratégica: la firma del patrocinio de Guaguas Municipales y que venía a solucionar una problemática que acuciaba la vida institucional con la falta de un sponsor.</p>

[seccion_header]El fichaje de Sánchez Jover y la construcción del equipo campeón[/seccion_header]

<p>Tenía 33 años y, "desde el primer momento", tuvo claro el mandamiento que siempre regiría sus movimientos y gestiones: "Ganar, ganar y ganar". Ruiz orienta cada maniobra a buscar "el máximo" y no duda en explorar posibilidades que parecían prohibidas.</p>

<p>"Me planté en Palma, hablé con él. Y en el Puerto de Santa María, donde jugaba con la selección española un Preeuropeo, pude cerrar todo. Le convencí de que viniera con nosotros sin poder alcanzar o igualar el contrato que tenía en el Palma. Pero le hablé de liderar un proyecto que iba a ser el mejor del país, que sería nuestro líder, que iba a vivir en un sitio maravilloso, que la afición le haría sentirse único... Paco siempre ha sido una persona muy inteligente y entendió lo que yo quería decirle de manera instantánea. Nadie creía que el Calvo Sotelo podía fichar a la gran estrella de España. Pues nos los trajimos junto a Venancio Costa y Antonio Miralles, otros dos fenómenos".</p>

<p>El impacto mediático que tuvo esta operación rápidamente se tradujo en un mensaje al resto: "Habíamos llegado para ser los mejores". Y lo que parecía una jugada maestra aislada alcanzaría el grado superlativo cuando, también de una tacada, ya en 1989, son los polacos Ireneusz Klos y Waclaw Golec, también figuras mundiales, quienes aterrizan en Gran Canaria.</p>

<p>"En la primera temporada completa en la que estuve de principio a fin, la 1987-88, quedamos subcampeones de Liga y de Copa. Y fue un hito. Jamás se había llegado a pelear por títulos de esa manera. La destitución de una figura de la relevancia de Felipe Nuez fue, de largo, el momento más crítico de esa campaña. No resultó fácil prescindir de él. Pero ese primer balance, salvando lo de Felipe, no pudo ser mejor. El club pasó de estar al borde de la desaparición a discutir títulos, regenerar una afición perdida, que acabó trasladándose con nosotros del San Román al Centro Insular, cuando abrió sus puertas en 1988, y tener en sus filas una mezcla de juventud, cantera y estrellas que terminaría, como no podía ser de otra manera, dando sus frutos. Y, lo que también me producía un orgullo especial: jugar y competir contra los mejores de Europa", reseña.</p>

[seccion_header]Un modelo de gestión basado en la intuición y la constancia[/seccion_header]

<p>Su modelo presidencialista de entonces, como el de ahora, se basaba en "la intuición, la capacidad de anticipación y delegar, aunque la decisión de calidad corresponda siempre al que más manda".</p>

<p>"Logramos firmar un acuerdo que nos salvó con Guaguas Municipales, a finales de 1986, y, desde entonces, siempre sorteamos todo tipo de impedimentos para que el club mantuviera una estructura y competitividad gracias al apoyo de la pequeña y mediana empresa. Constructora Canaria, Editorial Prensa Ibérica, Pepsi, Arehucas... Incluso fuimos pioneros en llevar una campaña en contra de las drogas sin contraprestación alguna. Tocamos la puerta de todas las empresas y somos muy sensibles a los apoyos que nos dan. Cuando hemos ganado títulos, he puesto especial énfasis en ir con los trofeos a visitar a la gente que ha creído en nosotros para hacerles saber el fruto de su inversión. Valoro muchísimo el gesto de ayudarnos, de creer en nosotros. Teníamos credibilidad en bancos, empresas e instituciones. Nos la ganamos".</p>

<p>La consecución paulatina de títulos, cinco Ligas consecutivas entre 1990 y 1994, a las que hay que añadir la última en 2021, las Copas y las Supercopas, también con renovación reciente del trono, la contempló "como la justa recompensa a un duro trabajo de equipo" y en el que "todos son fundamentales por su implicación".</p>

[cita_editorial author="Juan Ruiz"]En los noventa llegamos a ser el primer equipo de la isla por delante de la UD Las Palmas. Nosotros llenábamos el CID, éramos los mejores de España y en Europa nos habíamos ganado un prestigio que notábamos cada vez que viajábamos, como cuando fuimos a París a enfrentarnos al PSG y nos esperaban al aterrizar multitud de medios de comunicación.[/cita_editorial]

<p>"Y en aquel momento, no tuve reparo alguno en proponerle a Luis Sicilia, presidente de la UD, y a Lisandro Hernández, presidente del Gran Canaria, que unificáramos bajo un mismo escudo un gran club representativo. Siempre creí en la unión y pienso, como pensaba, que era una iniciativa viable. Por lo que fuera no se dio, pero en esa coyuntura era la mejor de las posibilidades para el deporte en nuestra isla, porque, incluso, se planteaba, igualmente, integrar el balonmano", aclara.</p>

<p>El Calvo Sotelo, con sus distintas denominaciones, siguió su camino bajo el mandato de Juan Ruiz hasta 1998, convirtiéndose en club referencial por su crecimiento y palmarés, con la dificultad añadida de tener que superarse año a año. "Las mejores lágrimas de la gente son las de la alegría. Y ver a miles de personas emocionadas y llorando de felicidad en el CID, las que podían entrar, porque muchas se quedaban fuera al estar el aforo completo, cuando levantábamos un título, era el mejor incentivo para seguir. Evidentemente, renovar los éxitos y acertar con los fichajes en su integridad es algo imposible en el deporte profesional. El dinero siempre ha sido un factor muy importante, pero en las dos etapas doradas del club, la de finales de los ochenta y noventa, y la actual, puedo afirmar que no lo ha supuesto todo porque hemos sido los mejores sin disponer de los medios financieros de algunos de nuestros rivales".</p>

<p>La primera Copa del Rey, aquella Liga inaugural frente al Bomberos de Barcelona, la fiebre que despertó el equipo colmando cada pabellón que pisaba... "Elegir momentos es complicado. Son muchísimos y muy buenos, inesperados en muchos de los casos. Recuerdo a mi padre decirme que qué necesidad tenía yo, sin cobrar un duro, de estar siempre al pie del cañón y recibir, en momentos puntuales, críticas que fueron dolorosas. Pero la voluntad de servicio todo lo puede y puedo presumir de haber tenido el apoyo de fieles compañeros de viaje, leales a la causa, de jugadores que se dejaron la vida en la pista, ganaran o no".</p>

[seccion_header]Sánchez Jover y Camarero, los nombres por encima de todos[/seccion_header]

<p>Paco Sánchez Jover y Sergio Miguel Camarero son los nombres que pone por encima de todos: "Para muchos jugadores era como un padre y, reconozco, a muchos los quise como a hijos. Pero Paco, que vino de fuera pero se hizo de los nuestros nada más pisar Gran Canaria, y Sergio, que salió de nuestra cantera y es parte del escudo por su recorrido, me marcaron. Años y años de convivencia y siempre coincidiendo en lo esencial, en la defensa del club. Con momentos tensos, mejores y peores, como pasa en la vida, como pasa en el deporte".</p>

<p>"Fueron jugadores y ejercieron como entrenadores ganando títulos, dando un ejemplo de lealtad y de compromiso. En su día renunciaron a más dinero por seguir aquí y, sin desmerecer a otros compañeros que también fueron grandes figuras, no me equivoco si digo que mucho del respeto que nos ganamos se debía a ellos. No entiendo el Guaguas sin Paco ni Sergio. Ni yo ni nadie. Hoy en día siguen con nosotros porque es un acto de justicia que aquí estén después de que, obligados por las circunstancias, tuvieran que irse. Ya los considero de mi familia".</p>

[seccion_header]La marcha, la desaparición y el regreso[/seccion_header]

<p>De 1986 a 1998, año en el que decide dejarlo "porque ya tocaba y, además, así lo establecían unos estatutos que se respetaron", Juan Ruiz se siente particularmente realizado por "contribuir a la felicidad de la gente", al considerar que el Guaguas "cumplió con su rol de dar a la sociedad alegrías, sentimiento de pertenencia y unión y el premio de los campeonatos".</p>

<p>"Cuando decidí irme, entregué las llaves de la sede y con lágrimas en los ojos mantuve mi decisión, eso era lo que más me dolía. Nunca tuve apego al cargo. Y lo que sabía que más iba a extrañar era el pulso de la calle, el interactuar con la gente. Creo que es el mejor legado que te queda tras tantos fichajes, títulos, viajes, victorias, recepciones oficiales... Que el Guaguas haya llevado sonrisas y buenos momentos a los hogares canarios es algo insuperable", pondera.</p>

<p>A su marcha, dejó dicho que "en caso de necesidad, el teléfono estaba abierto". "Dejé dos millones de pesetas en caja, vallas publicitarias pagadas, patrocinadores comprometidos, el prestigio intacto ante autoridades políticas y deportivas. Una base para salir adelante. Pero no sirvió de nada", lamenta. Le tocó vivir la decadencia deportiva e institucional, algo que derivó en la desaparición en 2009. "Lo que más dolió es que no me vinieron a buscar para echar una mano en ese proceso de crisis y únicamente me llamaron cuando la deuda era insostenible. Estoy seguro de que si hubiesen hecho lo que les dije, de avisarme en caso de necesidad, alguna solución se habría habilitado. Pero no fue así y, por lo que fuera, dejaron morir un club que no se lo merecía", añade.</p>

<p>Ese sentimiento de rabia contenida le hizo incubar la idea de volver, pese a "muchas opiniones en contra al no tener nada que ganar y mucho que perder". Insiste en que, por razones de edad ("con 67 años yo no estaba para aventuras"), "todo fue muy meditado". "Hablé con Sergio y Paco. Les dije que si dábamos el paso era para hacer un Guaguas campeón. Estuvimos de acuerdo desde el primer momento. Quería que Paco fuese el presidente, pero su condición de empleado público habría puesto impedimentos en la solicitud de subvenciones. Por eso me puse yo al frente, con Sergio como entrenador, una función que teníamos decidida. Paco nos cedió la plaza del equipo que presidía en Vecindario para evitarnos la larga travesía que hubiese supuesto una refundación desde cero. Fue una nueva contribución suya en favor del escudo de su vida".</p>

<p>"Todo coincidió con la pandemia, pero no me vine abajo. Rastreamos el mercado de jugadores, fuimos a por los mejores que nos podíamos permitir, hice las gestiones como en los viejos tiempos, a base de llamadas y constancia. Volvimos a la cima y sin el público que tanto queríamos por las restricciones del coronavirus. Entramos en el Top-20 mundial del voleibol, mantuvimos la base ganadora y añadimos fichajes que nos han permitido subir el nivel más. La temporada 2020-21 fue inmejorable y arrancamos la 2021-22 con la Supercopa y a un rendimiento ilusionante", detalla.</p>

<p>Europa sigue siendo la asignatura pendiente y Juan Ruiz enfoca sus cuentas por cuadrar a levantar un título continental, materia que se le ha resistido hasta ahora, con momentos especialmente dolorosos como la eliminación ante el PSG, a inicios de los noventa, por la alineación indebida de un entonces juvenil Alexis Valido ("perdimos en los despachos lo que ganamos en la cancha con una actuación impresionante y eso quedó como algo que a todos nos hizo daño") o la Final Four de la Recopa en Cuneo (Italia) en 1998.</p>

[cita_editorial author="Juan Ruiz"]No dudo de que ese momento llegará porque nos lo deben. Cuando llegamos a la Final Four dije que Dios me debía eso, poder disputar una fase final de un título europeo. Sigo diciendo que Dios me debe un título europeo y creo que va a llegar.[/cita_editorial]

<p>Más allá de su legado en las vitrinas, en la adquisición de leyendas y en el periplo internacional que siempre le dio a sus proyectos ("como embajadores de Canarias por toda Europa") como componentes de un ciclo dorado, Juan Ruiz aspira a que se le recuerde como alguien "que no vino al deporte a servirse, sino a servir, y con la idea de hacer feliz a la gente". Tan sencillo y tan complejo a la vez.</p>
'),
    array('title' => 'La génesis de su proyecto en cronología', 'numero' => '', 'order' => 38, 'show_marker' => false, 'parent_ref' => 'cap04',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('LA GÉNESIS DE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('SU PROYECTO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content"><strong>Patrocinios y fichas estelares</strong> — "Estamos en una nube con muchos cimientos. Aquí hay un club con cantera, con una estructura deportiva muy sólida basada en excelentes técnicos, y hay también unas buenas razones económicas que se gestan con una administración del club que considero muy responsables. Felipe Nuez me facilitó a principios de temporada una lista de jugadores para hacer al equipo campeón de Liga. Hemos traído quizá a los mejores". <em>(La Provincia, 17 de julio de 1987)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content"><strong>El primer título como estímulo</strong> — "Este es el triunfo del trabajo y del esfuerzo de muchos años, comenzado por otros, como José Luzardo, Antonio Trejo o Felipe Nuez, y rematado por nosotros y por nuestra afición. Es el triunfo de todos y un gran día para el voleibol canario". <em>(Diario de Las Palmas, 10 de abril de 1989)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content"><strong>El hallazgo de Golec y la defensa de Camarero</strong> — "Me gusta mucho el número 11 de la selección polaca, Golec, un gran rematador de potente salto, especialista en remates de zona cuatro y zagueros, con gran recepción. El objetivo que nos planteamos es la obtención de un título nacional como mínimo". <em>(Canarias7, 23 de agosto de 1989)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>Éxito deportivo y compromiso social</strong> — "Lo de la campaña pasada fue logrado con gran merecimiento. Después de cuatro años de gran trabajo, el título de Liga tenía que llegar. También entiendo que para nuestro equipo ha sido un triunfo ser la única entidad deportiva del país que ha abierto una brecha contra la droga". <em>(La Provincia, 6 de julio de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>El sueño cumplido de jugar la Copa de Europa</strong> — "No gana el que más presupuesto tiene sino el que más trabajo derroche. Es un gran reto, asimismo, representar a Canarias por vez primera en la Copa de Europa, un prestigio y orgullo que deseamos para el resto de los equipos de élite grancanarios". <em>(Canarias7, 13 de septiembre de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content"><strong>Elogio de la afición</strong> — "El público ha estado maravilloso. Solo le faltó rematar los balones en la cancha. El Gran Canaria merece que se le apoye porque tenemos a la juventud con nosotros. Este club no va a quedar a la deriva". <em>(Canarias7, 5 de abril de 1992)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content"><strong>La responsabilidad directiva</strong> — "Debemos tener en cuenta que este es el único conjunto canario al que le han televisado varios partidos en Europa, damos una gran difusión a esta tierra, y por contra recibimos poco". <em>(Diario de Las Palmas, 27 de abril de 1992)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content"><strong>Una representatividad única</strong> — "No creo que después del esfuerzo que hemos realizado todos los componentes del Gran Canaria, el Ejecutivo canario pueda abandonarnos a la buena de Dios, cuando nuestro equipo promocionará el nombre del Archipiélago por toda Europa". <em>(Canarias7, 14 de diciembre de 1992)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>6.000 aficionados en el CID</strong> — "Nuestra intención con la gratuidad de la entrada era la de ofrecer un homenaje a la afición y no creímos que fueran a venir más de 6.000 personas". <em>(Canarias7, 21 de enero de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1995</span><div class="timeline-content"><strong>Reinvención, nunca rendición</strong> — "Los jugadores han perdido la erótica de la ilusión y eso es fundamental para ser campeones. Un paso atrás invita a reflexionar para luego dar muchos hacia adelante. Queremos en el equipo jugadores con hambre de títulos y también en las gradas una afición que vuelva a hacer de Las Palmas el centro del voleibol nacional". <em>(La Provincia, 30 de abril de 1995)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1996</span><div class="timeline-content"><strong>Continuidad necesaria</strong> — "En dos ocasiones estuve tentado de abandonarlo todo. Pero si cuando pierdes te marchas es de cobardes, por eso continué, porque el día que me marche lo debo hacer con el equipo campeón". <em>(Canarias7, 7 de octubre de 1996)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>El apoyo definitivo</strong> — "Guaguas ha hecho una gran inversión y, además, con ellos finalizaré mi mandato el año que viene". <em>(Canarias7, 21 de junio de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Aunque el corazón no aguante</strong> — "A pesar de los problemas de corazón que sufrí tras los partidos de Eslovenia y frente al Olympiakos, yo decidí acompañar al equipo y me han dado una gran alegría". <em>(Diario de Las Palmas, 18 de febrero de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>La culminación de la Final Four</strong> — "Ha sido un partido donde casi siempre hemos estado por debajo. El público, fundamental, me recordó al del día del Paris Saint Germain. La Final Four ya está conseguida, y ahora todo lo que venga será un premio añadido". <em>(Diario de Las Palmas, 26 de febrero de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Una despedida con legado</strong> — "He visto a mucha gente llorar de emoción y tristeza en el Centro Insular de Deportes, y eso es imborrable. Ahora estamos en el momento de volver a empezar, pero que se recuerde que venimos de jugar una Final Four hace unos meses". <em>(Canarias7, 4 de diciembre de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2020</span><div class="timeline-content"><strong>La repercusión del regreso</strong> — "Vamos con la intención de ir a por todas y para ello tenemos todos que trabajar más que los demás y entrenar más que los demás. Cada día estamos más contentos. Estamos muy satisfechos de las expectativas que está generando el poder volver a ver al Guaguas competir a nivel nacional y europeo". <em>(Canarias7, 18 de junio de 2020)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2020</span><div class="timeline-content"><strong>Una historia que respetar y dignificar</strong> — "Con casi 70 años no estoy para aventuras, esto es un equipo ganador. Cuando fuimos a París para jugar contra el PSG nos acompañó Aniceto Rodríguez. Cuando llegamos al aeropuerto nos llevaron a una sala de prensa y ellos nos dijeron que éramos el Real Madrid del voleibol". <em>(La Provincia, 9 de septiembre de 2020)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2021</span><div class="timeline-content"><strong>Laureles renovados</strong> — "No esperaba que fuese así. Ni en el mejor de los sueños esperaba que todo saliera tan redondo. Lo hemos cumplido. Nadie se puede sentir defraudado. El Guaguas tiene un gen ganador y nuestra obligación es siempre ir a ganar". <em>(Canarias7, 9 de febrero de 2021)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2022</span><div class="timeline-content"><strong>ADN ganador</strong> — "El Guaguas tiene el ADN de Real Madrid o Barcelona. Sale a ganar siempre. Cada vez que llega un jugador nuevo le pregunto si sabe qué escudo va a defender porque nuestra historia ha sido y es grande. Estamos entre los mejores cincuenta clubes del mundo". <em>(Canarias7, 23 de agosto de 2022)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2023</span><div class="timeline-content"><strong>Dedicatoria especial</strong> — "Sergio Camarero es una persona muy especial para mí. Lo tengo conmigo desde los 17 años. Es una de las personas que más quiere al club, incluso más que yo. Desde la directiva queremos además dedicarle especialmente este título a la madre de Sergio Camarero". <em>(La Provincia, 7 de mayo de 2023)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2024</span><div class="timeline-content"><strong>Reivindicación institucional</strong> — "El Guaguas merece más ayuda por parte de los organismos oficiales. Un suplemento de un millón de euros serviría para progresar a nivel europeo. A día de hoy peleamos con los mejores de Europa en inferioridad de condiciones". <em>(Canarias7, 25 de diciembre de 2024)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2025</span><div class="timeline-content"><strong>Orgullo de equipo</strong> — "Supone un orgullo ser el presidente de este grupo de deportistas y creo que mi satisfacción se extiende a la afición y a todos los que quieren y valoran el voleibol y el espíritu de superación". <em>(Canarias7, 20 de noviembre de 2025)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2026</span><div class="timeline-content"><strong>El éxito colectivo</strong> — "El éxito no es mío, sino de todos los que colaboran. La directiva y el presidente del Guaguas nunca ha cobrado en los doce años de la primera etapa ni en los seis años de esta segunda. El Guaguas es una gran familia. Estar entre los diez mejores equipos del mundo es para nosotros fundamental". <em>(Sport, 12 de febrero de 2026)</em>.</div></div>
</div>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 05: ICONOS Y ESTRELLAS DEL CV GUAGUAS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Iconos y estrellas del CV Guaguas',
        'numero' => '05',
        'order' => 40,
        'show_marker' => true,
        'ref_id' => 'cap05',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.85)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('ICONOS Y', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('ESTRELLAS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DEL GUAGUAS', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => ''),
    array('title' => 'Sergio Miguel Camarero', 'numero' => '', 'order' => 41, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('SERGIO MIGUEL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('CAMARERO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Cuando Sergio Miguel Camarero (Las Palmas de Gran Canaria, 1967) destacaba en el fútbol y como prometedor jugador del San Antonio, el equipo de su barrio, ya soñaba con hacer historia en el deporte. Su aspiración se iba a cumplir, aunque de manera insospechada porque, efectivamente, haría carrera pero en otra disciplina que tardó en practicar y a la que llegó de rebote. "Empecé a jugar al voleibol porque, al regreso de unas vacaciones en el sur de la isla, ya no tenía posibilidad de inscribirme en el equipo de fútbol. Se había acabado el plazo. Y me apunté en la Escuela de Voleibol del San Román. Mis primeros entrenadores fueron Félix Rodríguez, Joselu Sánchez e Ignacio Brito. Tendría 14 o 15 años. Y me enganché", concreta.[/capitular]

<p>Así fue su punto de partida y siempre a una velocidad vertiginosa porque, ya en sus tiempos en el Juventud, dibujó una progresión descomunal, convirtiéndose en el primer jugador canario en ser llamado por la selección española en categoría juvenil y júnior. Y mantendría su exclusividad con el representativo nacional, al ser, igualmente, pionero en las citaciones de máximo nivel internacional. "Era una época complicada en la calle, el riesgo de las malas influencias, las amistades que en esa etapa de la vida te pueden llevar por el mal camino. Mi suerte fue que elegí el deporte, el voleibol, y conocí a una persona como Felipe Nuez con la que pude crecer y desarrollarme en el mejor ambiente posible. Ya integrado en el Calvo Sotelo se puede decir que empecé a ver que esta iba a ser mi vida, que quería dedicarme a esto pese a ser muy joven", afirma.</p>

<p>Camarero incide en la influencia capital de Nuez en sus inicios y, también, en la consolidación del proyecto del club, aspirante entonces a entrar en la élite nacional. "Detrás del ascenso a la División de Honor de 1985 hay muchísimo trabajo, sacrificio y un grupo de compañeros, de amigos, que supimos plasmar en la pista todas las enseñanzas y conceptos que nos inculcó un entrenador que fue figura fundamental en esos inicios y en el desarrollo posterior. Fue una labor colectiva muy meritoria porque no todos creían en nosotros, en que podíamos conseguir eso".</p>

[cita_editorial author="Sergio Miguel Camarero"]Pude irme en el inicio de mi carrera. Me llamó del Cisneros Miguel Ocón, que luego, como seleccionador, confió muchísimo en mí. Pero aposté por quedarme en mi tierra y no me equivoqué. Por encima del dinero siempre antepuse el orgullo de defender los colores del Guaguas, que ha sido mi club siempre.[/cita_editorial]

<p>Camarero se erige desde el principio, y con el núcleo de canteranos que viven ese despegue ("Jorge Ramón, Juanma, David Rodríguez..."), en uno de los referentes del equipo con su manera pasional de competir y de entender el deporte. Porque sus imágenes icónicas pidiendo, brazos abiertos, el apoyo del Centro Insular en partidos memorables ya se daban en los tiempos iniciáticos en el García San Román. "Nunca he cambiado y, aunque hay que reconocer que todo lo que vino después tuvo mayor repercusión con el traslado al CID, los títulos y miles de espectadores viéndonos en directo, cuando todavía no nos habíamos mudado y jugábamos en ambientes más modestos también era el Camarero que quería comerse la pista, contagiar a los compañeros, tirar para arriba cuando el equipo estaba en momentos complicados, pedir a los seguidores que se metieran en el partido... Es implicarse al máximo en todos los sentidos".</p>

<p>Al igual que sucede con todos los protagonistas con los que compartió el crecimiento del proyecto, sitúa el punto de inicio con la llegada a la presidencia de Juan Ruiz, quien, en su opinión, "realizó unos fichajes impensables, que parecían imposibles, y que terminaron dándole al equipo un nivel impresionante".</p>

[cita_editorial author="Sergio Miguel Camarero"]Sánchez Jover, Venancio, Miralles, Chava, Golec, Klos... El Guaguas mejoraba año a año y se conservaba la base. Se construyó una grandísima plantilla, llegaron los títulos, jugar en Europa... Nadie podía esperar eso, pero, al mismo tiempo, creo que fue el premio a la valentía y a la ambición.[/cita_editorial]

<p>"Era una etapa en la que el Palma dominaba y nadie le hacía sombra. Poco a poco crecimos, nos situamos a su nivel y terminamos superándoles. Fue un proceso de unos años en el que siempre se mantuvo el crecimiento, sin dar pasos atrás. Es algo muy complicado en el deporte profesional, el mantenerse arriba tanto tiempo. El Guaguas lo consiguió", se congratula.</p>

<p>Hasta que se retiró en 1996, en opinión generalizada de manera prematura ("sentí que llegó el momento y lo hice dejando a un Guaguas campeón, que era lo que deseaba"), vivió años "inolvidables" en los que prefiere no diferenciar gesta alguna porque, como subraya, "todo fue demasiado especial".</p>

<p>"El primer título, la primera Liga, debutar en Europa, los compañeros, la afición, partidos que levantamos cuando estaban casi perdidos, el espíritu que forjamos, esa grada que nos llevó siempre hacia lo que queríamos, el respeto que se nos tenían en otras pistas... Fueron experiencias muy intensas, muy seguidas y que, en el momento, casi ni asimilas porque la competición te impide parar. En mi caso, desde los inicios, sin mayores pretensiones, a estar levantando títulos y compitiendo con los mejores equipos de Europa. Todo pasó demasiado rápido pero, a la vez, todo mereció la pena", apunta.</p>

<p>Insiste en que uno de sus mayores motivos de felicitación en su trayectoria profesional en el club radicó en su rendimiento y compromiso "dentro de un grupo humano insuperable" en el que "todos" aportaron su cuota de compromiso y trabajo, lo que permitió "crear una identidad" y diferenciar al Guaguas "por su manera de jugar y pelear cada encuentro y cada desafío", algo en lo que destaca la figura de Sánchez Jover, "un líder tanto como jugador como entrenador y coincidiendo con unos años inigualables". Porque, como enfatiza, "suponía un privilegio" formar parte de la entidad en pleno apogeo.</p>

<p>Como ocurrió con los grandes nombres que han pertenecido al Guaguas, Sergio Miguel Camarero, que acumuló 48 internacionalidades absolutas y 10 títulos oficiales (5 Ligas y 5 Copas), tuvo un homenaje de despedida con un amistoso ante el Zonhoven de Bélgica, celebrado el 7 de enero de 1998 en el Centro Insular y en el que, además de recibir los máximos honores del club, con la insignia de oro y brillantes, y de la Federación Canaria, con una placa entregada por el histórico dirigente José Millán, no pudo contener las lágrimas de emoción. "Había estado un año pensando en si volvía o no pero, al final, lo dejé. Y en ese momento ya sabía que todo había acabado, pese a que era relativamente joven y podía haber estirado mi carrera. Ya estaba entonces con el proyecto educativo en las Escuelas Municipales de Ingenio, iba terminando mis estudios universitarios también y afrontaba un cambio en mi vida, sabiendo, eso sí, que seguiría con el voleibol. Tenía incluso proyectos con el vóley playa pero todo no iba a ser lo mismo".</p>

<p>Inició, como era previsible, su trayectoria en los banquillos, con amplia y exitosa carrera en el extinto Hotel Cantur, contempló, desde la distancia, la desaparición del Guaguas ("fue muy doloroso para todos los que defendimos y sentimos esa camiseta desde los tiempos del Calvo Sotelo") y ha sido, igualmente, actor principal, en el regreso del club con la refundación obrada por Juan Ruiz en el año 2020.</p>

[cita_editorial author="Sergio Miguel Camarero"]Juan Ruiz es, indiscutiblemente, la persona más importante en la historia del club por todo lo que hizo y ha hecho. Llegó en momentos complicados. El último, sin club, directamente. Y de la nada ha vuelto a construir un Guaguas campeón. Ahí están los hechos y su contribución. Muy pocas figuras en el deporte canario tienen su legado.[/cita_editorial]

<p>"A nivel afectivo y emocional, regresar al Guaguas como entrenador para iniciar una nueva etapa fue algo que me motivó desde el primer momento. Y que en el club estén Juan, Paco Sánchez Jover o Felipe Nuez supuso un aliciente enorme. Volvernos a encontrar, después de tantos años, y por y para el club que tanta felicidad nos dio. He trabajado y sentido los triunfos como cuando estaba en la cancha. Como entrenador mantengo la misma filosofía de jugador, esto es, luchar cada punto, ir a ganar siempre, cada partido tomárselo como una final... Y estoy muy contento con la respuesta que he venido teniendo de mis jugadores. La directiva no ha parado de mejorar el equipo y los resultados son los que son, con varios títulos ya en este año largo desde que volvimos y la pretensión de seguir creciendo, sin escatimar en ambiciones y sueños. Es el ADN del Guaguas", finaliza.</p>

[seccion_header]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content"><strong>Cotizado desde sus inicios</strong> — "Yo ahora mismo me debo al Guaguas Las Palmas, donde estoy muy a gusto, con grandes compañeros, entrenador, directiva, en fin, que es mi club. He tenido propuestas de la vecina isla y de la Península, que serán estudiadas en su momento". <em>(Diario de Las Palmas, 27 de febrero de 1982)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>Rompiendo pronósticos con los títulos</strong> — "Realmente ha sido una sorpresa para todos que juguemos con el Bomberos. Pienso que en los dos próximos encuentros podremos dar el título a Canarias". <em>(Diario de Las Palmas, 15 de marzo de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1991</span><div class="timeline-content"><strong>El poder de la afición del CID</strong> — "Todos los equipos que pasan por aquí en las grandes ocasiones terminan asombrados de cómo chilla esta afición. Sin ellos no estaríamos disputando esta final con todo a favor. Si no soy agresivo no sé jugar, es mi estilo". <em>(La Provincia, 12 de abril de 1991)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>Ni el PSG pudo</strong> — "Ya he dicho que necesitábamos el calor de la gente para superar a los franceses y esta batalla la hemos ganado con el apoyo de todos, pero esta guerra aún no ha acabado y volvemos a estar en la lucha". <em>(La Provincia, 20 de enero de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>En defensa de su honorabilidad</strong> — "En este mundo hay pocos amigos. La Federación Española cada vez que puede poner una zancadilla a nuestro club lo hace. Lo más importante es lograr estar en la Final Four europea". <em>(Diario de Las Palmas, 12 de septiembre de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>Acordes de despedida</strong> — "Ha sido un año sabático. Psicológicamente es importante recuperarse, porque yo soy un jugador que necesita estar bien de mente para poder jugar bien, porque siempre me empleo al cien por cien". <em>(Diario de Las Palmas, 4 de agosto de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2001</span><div class="timeline-content"><strong>De su vida</strong> — "Es una zona complicada, ya que la droga está muy cerca. Gracias a mis abuelos y a la educación que me dieron mi madre y mis dos hermanos mayores pude escapar a las drogas. El deporte me ha ayudado mucho a llevar una vida sana". <em>(La Provincia, 8 de diciembre de 2001)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2003</span><div class="timeline-content"><strong>Dolor a la distancia</strong> — "Me duele muchísimo ver al Guaguas tan abajo. Siempre será mi casa. Ahora es cuando más hay que arrimar el hombro por todas las satisfacciones que nos dio. Es cuestión de ciclos y volverá al lugar que tuvo". <em>(Canarias7, 3 de marzo de 2003)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2020</span><div class="timeline-content"><strong>El regreso soñado</strong> — "Creo que esto ha demostrado la ambición y las ganas que hay en las personas que están detrás de este renacimiento del club. Juan Ruiz me sorprende. Quiero darle las gracias por la fuerza que ha demostrado en este proyecto. Es capaz de convencer a todo el mundo a que crea en el Guaguas Las Palmas". <em>(La Provincia, 28 de mayo de 2020)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2021</span><div class="timeline-content"><strong>Con el espíritu de siempre</strong> — "Hemos recuperado el espíritu del Guaguas y logrado que mucha gente se vuelva a enganchar. Juan ha trabajado una barbaridad y en plena pandemia. Él es el que ha sacado todo este proyecto adelante". <em>(Canarias7, 24 de abril de 2021)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2022</span><div class="timeline-content"><strong>Unión como clave</strong> — "Si el vestuario funciona y la directiva y técnicos van en la misma dirección, esa unión hace que vaya todo bien. Estoy muy orgulloso de todos los jugadores". <em>(Mundo Deportivo, 26 de diciembre de 2022)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2023</span><div class="timeline-content"><strong>Champions</strong> — "Es un orgullo y también una responsabilidad representar a nuestro país, sería histórico meter a un equipo español en este nuevo formato de Champions. Tenemos que ir con la mentalidad de jugar y ganar cada punto". <em>(Web del club, 8 de noviembre de 2023)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2024</span><div class="timeline-content"><strong>Reconocimiento europeo</strong> — "Hemos conseguido cosas antes de tiempo y estamos haciendo logros importantes, ahora los jugadores quieren venir aquí. El Guaguas ahora es considerado por toda Europa y nuestra afición es gran parte de nuestro éxito". <em>(Canarias7, 26 de julio de 2024)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2025</span><div class="timeline-content"><strong>Agradecimiento colectivo</strong> — "Otra vez hemos tenido la suerte de poder trabajar con grupo de jugadores increíbles. Nuestro cuerpo técnico se ha mostrado incansable, y tenemos mucho que agradecer al presidente Juan Ruiz". <em>(Web del club, 2 de mayo de 2025)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2026</span><div class="timeline-content"><strong>Pasión como motor</strong> — "El Guaguas lo es todo, es mi vida. Llevo muchos años aquí metido y sobre todo es mi pasión. Creo que lo hago por pasión, no lo hago por otra cosa. Cuando se me quite esa pasión, que no creo, pues me iré a otra cosa. Pero por ahora lo vivo todo como si fuese el primer día". <em>(8sports, 25 de febrero de 2026)</em>.</div></div>
</div>
'),
    array('title' => 'Paco Sánchez Jover', 'numero' => '', 'order' => 42, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('PACO SÁNCHEZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('JOVER', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Fue uno de sus profesores, "don Mariano", como matiza, el que, ya en su último año como cadete, le introdujo en el deporte que le haría célebre. Porque Paco Sánchez Jover (Murcia, 1960) estaba predestinado al éxito como uno de los jugadores más reconocidos de todos los tiempos en el voleibol nacional. Pero en su niñez, que se desarrolló en el colegio Nuestra Señora de Atocha, "jamás" imaginó que su vida iba a transcurrir en las pistas y de manera profesional. "Como el voleibol se practicaba en horario lectivo, que te permitía saltarte clases, todo el mundo quería jugar. Nunca lo había practicado, pero me animé y me enganché desde el principio. Medía 1,96 metros, no había quien me ganara por alto. Las condiciones eran precarias: suelo de tierra, red con tela mosquitera y sandalias de las de ir a pescar... Pero éramos felices, lo pasábamos bien y, poco a poco, fui evolucionando. Cuando le ganamos, en la Liga Escolar, al Capuchinos, que era el campeón, me ficharon y me llevaron con ellos, por lo que hice el Bachillerato allí. Entré en otra dimensión porque ya había material para entrenar, balones, equipaciones, un pabellón, regularidad y constancia en las sesiones...", precisa.[/capitular]

<p>Y no pasa por alto la influencia de su madre, que le animó a seguir estudiando y a no dejar el deporte en el momento en el que tuvo que decidir si emulaba los pasos de su padre en la empresa familiar de albañilería o tirar para adelante con su pasión por el voleibol combinándola con la formación académica: "Acerté y se lo debo a mi madre. Parece que fue ayer cuando me llamó a la cocina de la casa y me dijo que mi futuro estaba en los libros, lo que me permitió continuar jugando", resume.</p>

<p>Sus progresos son asombrosos. Estrena condición de internacional júnior, acudiendo al Mundial de la categoría en Brasil, y es fichado, en 1977, por el Real Madrid, ya el escaparate definitivo para su despegue. En tres temporadas, dos Ligas y tres Copas, además de la constatación de que venía en camino un jugador de leyenda. Son Amar de Mallorca, Cisneros y de nuevo al conjunto balear son las estaciones previas a su definitivo desembarco en el Guaguas, ya como estrella consagrada y cotizada.</p>

<p>Le querían en todas partes, pero las artes de Juan Ruiz le terminaron convenciendo: "Sabía del Guaguas porque había hecho una buena Copa en Mallorca y, además, allí estaba Martinovic, que había sido compañero mío. Pero Juan Ruiz consiguió mi número de teléfono, el de casa, porque en esos años no existían los móviles, por una carambola. El tío de mi pareja de entonces, que era de Gran Canaria, vivía al lado de Juan y jugaban a las cartas. Casualidad de las buenas. Un día le comentó que su sobrina estaba conmigo, a Juan se le encendió la luz y le dijo que quería hablarme. Le dio mi contacto... ¡Y durante meses me llamaba casi todos los días!".</p>

[cita_editorial author="Paco Sánchez Jover"]Juan me ilusionó. Me pedía consejo, me hablaba de que iba a construir un club grande, que la isla era el mejor sitio para vivir, me trataba como a un hijo... Simpaticé muchísimo con él, la verdad. Nunca me moví por el dinero, siempre por la ilusión, por el corazón.[/cita_editorial]

<p>"Luego tuvimos contacto ya en persona en el Preeuropeo de Cádiz de 1987, pero fue ese interés suyo tan grande el que me terminó de convencer. El Falconara de Italia me propuso el que podía haber sido el contrato de mi vida. Pero me comprometí con Juan y ni quise saber el dinero que me ponían encima de la mesa. Soy un hombre de palabra. Otro, en mi lugar, lo mismo hubiese aprovechado que no había nada firmado. Pero mi palabra era sagrada y la cumplí. Me dio igual perder en el aspecto económico", añade.</p>

<p>No aterrizó aquel verano de 1987 solo. Tanto se implicó en el proyecto que le había atraído que recomendó los fichajes de Venancio Costa y Antonio Miralles ("apenas jugaban en Mallorca y le dije a Juan que era una oportunidad buena para el club por la calidad que tenían, y que luego se demostró con creces"), además de su hermano Jesús. Reconoce que intuía que "algo bonito" venía en camino porque "desde el primer momento" percibió que en el Guaguas "se estaban haciendo las cosas muy bien y todos iban a una".</p>

<p>Eso sí, es sincero al confesar que el ciclo de éxitos que se iba a firmar "era impensable para todos" dada su magnitud y vigencia: "Que podíamos ganar algo, bueno, sí, se podía esperar porque había un grupo de calidad. Pero eso de ganar Ligas y Copas sin parar, con los presupuestos de los rivales, no entraba en la mente de nadie".</p>

<p>"El paso del San Román al Centro Insular fue el primer gran avance. Teníamos que crecer, aunque a Juan le daba respeto. Pensaba que se nos iba a quedar grande el nuevo pabellón. Pegábamos carteles para dar visibilidad al club, hacíamos de todo por la modestia que imperaba al ser un club sin estructura. Pero no paramos de crecer. Ya la primera temporada, subcampeones de Liga y Copa. Se mantiene la base y comienzan a llegar refuerzos de la talla del Chava, Klos, Golec... Aquello ya era imparable. Ver el CID lleno fue la prueba de que sí, de que aquello iba muy en serio", enfatiza.</p>

<p>Sánchez Jover se hace líder del equipo nada más llegar. Su amplísima experiencia previa en la élite y como internacional absoluto le convierten en referencia indiscutible en un vestuario plagado de jóvenes: "Camarero tenía 20 años, Jorge Ramón también estaba casi empezando... Me tocaba ser algo más que un jugador y no dudé en asumir la responsabilidad que fuera".</p>

<p>Abunda en la figura de Camarero con palabras de agradecimiento: "Los dos tenemos una personalidad fuerte. Y, con tantos años juntos, normal que hubiese épocas en las que queríamos matarnos, dicho de una manera metafórica. Y cuando me tocó ser su entrenador, la tensión a veces cortaba el aire. Eso sí, podíamos no hablarnos en la ducha pero en la pista moríamos por el Guaguas. Pero siempre predominó el respeto y la camaradería entre él y yo. Y así se ha demostrado con el paso de los años. Le agradecí que me acogiera con los brazos abiertos, siendo él una de las figuras del Guaguas que me encontré, y que me cediera el rango de capitán, por decirlo de alguna manera, desde el compañerismo y el bien común. Sergio fue, ha sido y es para mí, por encima de todo, un amigo. Y es el compañero que más me ha marcado en mi historia en la entidad. Junto con Juan Ruiz, está para mí en un escalón privilegiado".</p>

[cita_editorial author="Paco Sánchez Jover"]Mentalmente no negociaba ganar y competir. Cada partido lo encaraba con máxima tensión y así lo hacía ver a los compañeros. Camarero era similar a mí en ese sentido. A veces tenía que pararlo, porque a él le podía la sangre caliente. Yo controlaba más el aspecto emocional.[/cita_editorial]

<p>"Era una gozada y muy fácil jugar y hacer jugar a aquel equipo. La calidad era impresionante. Y todos querían superarse. Recuerdo entrenamientos que fueron una carnicería, de ir a aplastarnos unos a otros. Luego llegaban los partidos y en muchísimas ocasiones veíamos que el nivel de nuestras sesiones de trabajo era tres veces superior a la resistencia de los rivales. La cultura del trabajo y del sacrificio era la clave. Y, por supuesto, que todos nos queríamos como hermanos. Hubiese sido imposible llegar al sitio que alcanzamos sin que hubiese un vestuario sano, una relación sincera. Y eso que tuvimos situaciones complicadas. Las superamos porque éramos una familia", agrega.</p>

<p>La Copa ganada al Palma en 1989 la tiene en su memoria como "lo más especial" cuando repasa el palmarés: "En la Liga ante el Bomberos, en 1990, sabíamos que no se nos escapaba el título. Fue grandioso, claro. Pero la Copa, esa primera vez, es inigualable. Ganarle al Palma, nada más y nada menos. Mucha gente lloró de emoción, de no creérselo".</p>

<p>"Vinieron años preciosos. Los dobletes, jugar en Europa, ser los mejores. Cada verano me llegaban ofertas y yo pensaba que en ninguna parte iba a estar mejor que aquí. Tras jugar las Olimpiadas de Barcelona 92, más me buscaron para que cambiara de aires. Me lo pasé en grande jugando. Lo hacíamos casi de memoria. Con Venancio, Miralles, Juanma, Sergio o Golec fueron muchísimos años. Con una mirada ya sabíamos por donde tirar. La gente te hacía sentir importante, venían miles de personas a vernos, daban los partidos por la tele cuando solo había dos canales, fuera nos recibían como el rival a batir... Imposible pedir más".</p>

<p>"Y no me olvido de la clase dirigente que teníamos. Juan Ruiz siempre ejerció de presidente cercano, sensible y eficiente con nosotros. Es clave en el funcionamiento del club que los que mandan sepan qué se llevan entre manos. Y nosotros teníamos la suerte de que nuestro presidente, supiera más o menos de voleibol, sí tenía muy claro lo que había que hacer y lo que había que evitar para que los proyectos funcionaran", matiza.</p>

<p>Respecto a las ocasiones en las que tuvo que compatibilizar las labores de entrenador con las de jugador, apunta: "Desgasta muchísimo. Siempre le dije al presidente que no era lo ideal, comprendiendo que en determinados momentos tocaba solucionar problemas de esa manera. Como pasó con Juanma Martín, fue un honor ser campeón con este club como jugador y como técnico a la misma vez. Se vive con igual intensidad, quizás con más nervios cuando sabes que todo depende de ti. Me tomé como un honor que se depositara en mí esa responsabilidad".</p>

<p>Tras su retirada como jugador profesional y el partido homenaje que se le brindó en 1995, se mantuvo como entrenador logrando hitos como añadir a su extenso historial dos Copas del Rey más y una Supercopa de España y clasificar al equipo para la Final Four de la Recopa en 1998. Además, se caracterizó por confiar y apostar por la cantera.</p>

<p>"Viví momentos muy bonitos. Recuerdo a Golec, antes de la final de 1996, diciéndome que íbamos a ganar esa Copa y que me iba a ahorrar la conversación que tenía pendiente con él para comunicarle que no iba a seguir porque él ya lo presuponía. Era el padrino de mi hija. Se me puso un nudo en la garganta. Dar oportunidades a los jóvenes, ayudar al club, ya sin Juan Ruiz, en todo lo que pude...", reseña.</p>

<p>Sánchez Jover vivió "con mucho dolor y pena" la desaparición de la entidad porque considera que "se pudo evitar de haber pedido ayuda". No obstante, nunca se resignó a que todo quedara así: "Sepultar la historia de un club, privar a las generaciones que quedan por venir de disfrutarlo, mantener un emblema tan importante como el Guaguas para Gran Canaria... Durante mucho tiempo no paré de darle vueltas a la manera en la que podíamos recuperar la entidad. Muchísima gente me animaba por la calle, me hacía ver que era algo deseado por muchos. Cuando Juan Ruiz nos habló a mí, a Sergio o a Felipe Nuez fue un subidón porque conocemos de su capacidad para aglutinar medios y voluntades y no dudé de que iba a conseguirlo, como así ha sido".</p>

[cita_editorial author="Paco Sánchez Jover"]Ver otra vez al Guaguas campeón es una alegría, pero en el deporte no siempre se gana. Y llegará un momento en el que no nos llevemos la Liga. Pero la satisfacción de reactivar la institución y poder dejarla a los que vengan, porque las personas somos circunstanciales, es algo que no se puede describir. Nos hemos quitado una espina todos los que queremos y sentimos en el corazón este escudo.[/cita_editorial]

[seccion_header]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content"><strong>La intuición de un Guaguas que iría a más</strong> — "Si hay continuidad, si seguimos un par de años, el Guaguas puede tener un gran equipo con aspiraciones muy grandes. Pero esto solo se consigue con tiempo y con partidos y más partidos". <em>(La Provincia, 31 de julio de 1987)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content"><strong>Ambición y más ambición</strong> — "Para que en Las Palmas el voleibol suba a la cúspide necesita que el Guaguas gane un título. Creo que es un sueño posible". <em>(Diario de Las Palmas, 8 de marzo de 1989)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>La Liga más especial</strong> — "Ya he ganado ligas con otros equipos pero esta es la que mejor sabor tiene, porque es la mejor afición que hay en España. Con un público así no podíamos perder. Nunca, en ninguna cancha, he visto una afición así". <em>(La Provincia, 2 de mayo de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1991</span><div class="timeline-content"><strong>Un auge imparable</strong> — "No me ha sorprendido el auge del voleibol aquí porque es un deporte que siempre había estado, con buenos jugadores y nivel. Es mejor partir de perdedores y luego ganar, que no como ha hecho el Palma". <em>(Diario de Las Palmas, 26 de abril de 1991)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>De homenajes y retos pendientes</strong> — "No quiero un homenaje porque yo soy poco amigo de las ceremonias. Sería una espinita retirarme sin disputar una Final Four con el Gran Canaria". <em>(Diario de Las Palmas, 17 de enero de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1996</span><div class="timeline-content"><strong>A por todos los títulos</strong> — "El Gran Canaria va a luchar por cada uno de los cuatro títulos que afrontará. Somos favoritos al primer puesto tanto en la Liga ACEVOL como en la Copa del Rey". <em>(Canarias7, 18 de junio de 1996)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>Un legado para el futuro</strong> — "Afortunadamente el futuro deportivo del club está asegurado hasta el 2010. El próximo año subirán al primer equipo dos juveniles, Raúl Dávila, un receptor de 1,98, y Pedro Cabrera, un central de 2,05". <em>(La Provincia, 13 de abril de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>La exigencia constante</strong> — "Tenemos un potencial suficiente como para aspirar a lo máximo. El Guaguas es un club que siempre parte con una plantilla con calidad suficiente para afrontar grandes retos". <em>(Diario de Las Palmas, 8 de septiembre de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Sueño cumplido</strong> — "Llevo desde 1983 soñando con estar en una Final Four. Para mí el sueño se ha acabado. Se convierte en realidad. Esta Final Four debe ser el punto de partida para una nueva época del club". <em>(Canarias7, 14 de marzo de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Contra el desgaste, cantera</strong> — "Estaba cansado, pero no de voleibol. Sí llevaba tres años muy duros, de mucho trabajo, y no llegaban los resultados que yo quería. Espero mucho de la afición grancanaria, que para mí siempre ha sido un jugador más de nuestro equipo". <em>(Diario de Las Palmas, 24 de agosto de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1999</span><div class="timeline-content"><strong>El patrimonio de la casa</strong> — "Después de cuatro años hemos conseguido llevar a ocho canteranos al primer equipo. El principal patrimonio del club son los jugadores locales, pero también tenemos que hacer un equipo que nos ilusione y con el que podamos soñar con ganar algo". <em>(Canarias7, 1 de junio de 1999)</em>.</div></div>
</div>
'),
    array('title' => 'Waclaw Golec', 'numero' => '', 'order' => 43, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('WACLAW', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('GOLEC', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Waclaw Golec (Tarnow, 1963) remite, directamente, a la etapa de esplendor que vivió el Guaguas en la década de los noventa con su registro memorable de cinco Ligas consecutivas (1990-1994), conquista en la que el jugador nacido en Polonia tuvo un papel estelar. "Llegué con 26 años y pasé siete temporadas increíbles en todos los sentidos. Encontré un equipo de guerreros, unos compañeros maravillosos y una tierra fantástica, con una afición que llevo en el corazón", resume cuando le toca hacer retrospectiva y en un castellano que conserva impecable pese al paso del tiempo.[/capitular]

<p>No fue nada fácil el fichaje de Golec, en aquel entonces toda una estrella en su patria, con más de 100 encuentros internacionales con la absoluta y campeón de todo tras despuntar en el Dunajec Nowy Sadz y consagrarse en las filas del Hutnik de Cracovia y Legia de Varsovia. Por un lado, Golec ya tenía "firmado y totalmente cerrado" su compromiso con un equipo italiano para cuando Juan Ruiz vino a contactarle. Y, por si fuera poco, la legislación de la época en el país centroeuropeo impedía emigrar a los deportistas profesionales menores de 28 años. Su compatriota Ireneusz Klos, adquirido semanas antes, no encontró esa traba burocrática al haber rebasado ese límite impuesto. Ruiz, auxiliado por Marcos Sznchenovic, relaciones externas de la entidad, tuvo que realizar arduas gestiones para obtener el permiso correspondiente de la Oficina Central de Deportes de Polonia, órgano competente para autorizar su salida, además de convencer al propio Golec a renunciar a un contrato con mejores cifras económicas en el campeonato italiano para recalar en un proyecto todavía por modelar.</p>

[cita_editorial author="Waclaw Golec"]Nunca miré por el dinero a lo largo de mi carrera y ya todos sabemos que Juan Ruiz es un hombre que, cuando se propone algo, lo normal es que lo consiga. Yo estaba bien en mi país y podía elegir club si me decidía a salir. De hecho, había aceptado la propuesta del Falconara, que era el subcampeón de Italia. Pero Juan me llamó, hablamos... Y no sé bien por qué me convenció.[/cita_editorial]

<p>"Me dio mucha fiabilidad. Me dijo que quería un equipo campeón, que ya tenía grandes jugadores como Sergio Camarero o Paco (Sánchez Jover). También había logrado llevarse a Klos. Además, yo quería unas condiciones de vida buenas para mi mujer y mi hijo y entonces el presidente me habló de que Gran Canaria era un paraíso, algo que pude comprobar. Se puede decir que se juntó todo. Llegó un momento que decidí no ir a Italia, pese a que iba a perder económicamente, y aposté por el Guaguas. Fue una decisión arriesgada... Pero la más acertada que pude tomar para mi futuro", recalca.</p>

<p>Golec, de planta imponente con su 1,95 metros de estatura, con desempeño habitual en la zona cuatro y con habilidades manifiestas como rematador y receptor, encajó "desde el primer momento" en el proyecto, inicialmente dirigido por Robert Croteau, porque, como esperaba, pasó a formar parte "de una plantilla de guerreros dispuestos a morir en la pista".</p>

[cita_editorial author="Waclaw Golec"]Me acostumbré a ganar y, aunque ya se sabe que en el deporte también se pierde, es inevitable, lo que quería era seguir y seguir levantando trofeos. Y en ese equipo era posible. También, tengo que decirlo, con Paco en el banquillo, Juan en el palco y compañeros como Sergio, Klos o Venancio, entre otros, era imposible que aquello saliera mal.[/cita_editorial]

<p>"Entrenábamos y jugábamos al límite. Y eso se notaba en los partidos. Muy pocas veces fuimos inferiores a los rivales, y eso que el Palma tenía una plantilla de lujo. Pero nosotros estábamos un escalón por encima", opina.</p>

<p>Golec también incide en un componente que terminó por disparar la potencialidad del Calvo Sotelo de la transición entre los ochenta y los noventa: el compañerismo. "Éramos amigos. Había un sentimiento de respeto y de apoyo a todos que todavía sigue. Porque aún sigo llamando a muchos con los que compartí aquella experiencia, me preocupo por ellos, les deseo siempre lo mejor. Y cuando jugábamos juntos, era exactamente igual. Queríamos ganar la Liga como fuese y el camino era, además de la calidad y experiencia, del trabajo duro y la constancia, el que en el vestuario todos fuésemos en la misma dirección. Esa fue la base de todo lo que vivimos. Compañeros dentro y fuera", insiste.</p>

<p>Son "muchísimos los recuerdos" que afloran en su memoria a la hora de hacer balance de su estancia en la entidad isleña. De la afición "todo lo que se diga es poco" porque, en su caso, se congratula de haber sentido "cariño, apoyo y pasión" desde la hinchada que le idolatraba: "Para cualquier deportista profesional siempre es importante notar desde la grada el empuje que necesitas. Yo tuve grandes momentos de forma, pero también sufrí otros menos buenos. Y siempre estuvieron conmigo, jamás una palabra negativa. Eso me hizo muy feliz. Venía de muy lejos y aquí me hacían sentir como si estuviese en mi casa".</p>

<p>"No era el único al que eso le pasaba. En el resto del equipo también estaba la seguridad de que, cuando fallaran las fuerzas, o si no tuviésemos acierto, nuestra gente nos iba a ayudar. Era una seguridad enorme. Notábamos cuando jugábamos como local que al rival todo se le hacía más complicado con el Centro Insular de nuestro lado".</p>

<p>Su sensacional rendimiento despertó el interés de numerosos equipos, que le tentaron para hacer las maletas durante su estancia en el Guaguas: "Me llamaron de Bélgica, el Almería me daba lo que quisiera... Pero no podía ir en contra de mi corazón. Y mi corazón estaba en Gran Canaria y junto a los chicos con los que me divertía jugando y logrando muchísimas cosas bonitas. Las Ligas, las Copas, jugar por Europa, sentir que nos respetaban en cada lugar. Otros en mi lugar lo mismo sí hubiesen dado un paso a otro sitio porque las ofertas eran muy pero que muy buenas. Pero no. Realmente, nunca me planteé irme hasta que regresé a Polonia con 33 años y ya para retirarme. Mientras me quisieron aquí, aquí me quedé".</p>

[seccion_header]La Liga de 1991: la obra maestra[/seccion_header]

<p>Golec reconoce que en su vitrina particular guarda "con especial alegría" la Liga conquistada en 1991, ante el Palma y con un CID colmado hasta la bandera. Dice que todos los campeonatos "son únicos" pero ese en particular lo rescata por las circunstancias en las que se produjeron: "Ellos eran los grandes favoritos. Nos habían ganado en la Liga regular, en la Supercopa, tenían un equipazo. Sixto Jiménez, Rafa Pascual, Willock, Vicedo... Impresionante. Pero nosotros queríamos esa copa, ser los mejores, y completamos un tercer partido, el definitivo ya, maravilloso".</p>

[cita_editorial author="Waclaw Golec"]Recuerdo que no empezamos bien en el primer set. Un mal parcial y, sin venirnos abajo, reaccionamos y no paramos. Es de esos partidos que nunca quieres que acaben porque termina saliéndote todo. En la pista estábamos muy concentrados. Y mirabas a la grada y todo era amarillo, con la gente aplaudiendo y gritando. Ganamos 3-0 y fuimos campeones con el máximo honor. Los aplastamos en todos los sentidos. Fuimos una máquina perfecta de voleibol.[/cita_editorial]

<p>Confortado por el bagaje profesional y personal que le dejó su larga estancia en el Guaguas ("mejoré en todos los aspectos, maduré muchísimo y compartí muchos sentimientos con gente especial que no hubiese conocido en otro sitio"), Golec asegura estar "muy agradecido" a todos los que confiaron en él y le hicieron entrar en la historia del deporte canario por ser uno de los referentes del club más laureado.</p>

<p>"Sigo la actualidad del equipo y me pone muy contento que gente como Juan Ruiz, Paco o Sergio hayan vuelto y lo levantaran haciéndolo, de nuevo, campeón. Estoy a miles de kilómetros pero siento como si estuviese allí los títulos que se han conseguido en los últimos años. Ojalá que aquellos años tan bonitos que vivimos se repitan, que la afición regrese, que todos disfruten de esa manera...", concluye desde su tierra pero convertido, "para siempre", en un militante más de la causa.</p>
'),
    array('title' => 'Ireneusz Klos', 'numero' => '', 'order' => 44, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('IRENEUSZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('KLOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Considerado uno de los mejores jugadores del mundo, con 364 partidos acumulados con la selección polaca y una amplísima trayectoria jalonada de títulos y prestigio. Así aterrizó en Gran Canaria un 2 de agosto de 1989 Ireneusz Klos (Gorzow Wielkopolski, 1959) para fichar por el Guaguas, todo un bombazo en el mercado internacional. Procedía de su equipo de toda la vida, el Gwardia Wroclaw, fue recibido en el aeropuerto por una comitiva del club encabezada por Juan Ruiz, presidente, y el directivo Ricardo Ramírez.[/capitular]

[cita_prensa source="Prensa local, 2 de agosto de 1989"]Paco Sánchez Jover me ha dicho que es un equipo de futuro y perspectivas enormes.[/cita_prensa]

<p>La entidad informó de que su adquisición superó los tres millones de pesetas y que culminaba las gestiones iniciadas en el Preeuropeo celebrado en Cádiz en 1987 y en el que se fijaron los primeros contactos para traerlo, aunque la negativa de la federación polaca en ese momento impidió que se ejecutaran las intenciones de las partes. Finalmente, tras una larga espera, y con la vacante que dejaba el colocador canadiense Brad Willock, Juan Ruiz lograba hacer realidad una de las incorporaciones de mayor impacto en la historia.</p>

<p>"No tenía ni idea de Canarias, del voleibol que se podría practicar aquí, vine un poco a ciegas, pero sabiendo que debía haber un buen proyecto porque estaban Sánchez Jover, Venancio Costa o Antonio Miralles, a los que conocía de haberme enfrentado con la selección española. También a Camarero. Pensaba que había potencial para hacer grandes cosas y si decidí dar el paso a salir de mi país era por eso, para conseguir cosas grandes. Me ofrecieron un contrato por dos temporadas con la idea de hacer un proyecto estable, de crecer. Desde el primer momento sentí que tomaba la decisión correcta porque, además, me encantó la isla para vivir con mi mujer y mi hijo. Para mí era muy importante la estabilidad familiar y desde el Guaguas me dieron todas las facilidades del mundo. Se volcaron conmigo al igual que con Golec, que llegó unas semanas después, nos pusieron un traductor y cuidaron todos los detalles. Fue algo impresionante para mí el recibir ese trato tan cariñoso", asegura.</p>

<p>Klos mezcla de inmediato con sus compañeros y, pese a no dominar el idioma, "el entendimiento fue total porque el lenguaje del voleibol es universal", según sus consideraciones. "Fui cogiendo el tono físico y, a la vez, integrándome en el grupo. Estar con Golec fue, igualmente, algo que me ayudó, al igual que a él estar conmigo. Rápidamente adquirí mi nivel y me percaté de la calidad que había en el resto del equipo. Llegué con humildad, con ganas de ayudar y pensando que, quizás, todo iba a resultar más complicado, pero era muy fácil jugar con gente como la que tenía al lado. No esperaba encontrar tanta calidad y fue una gran sorpresa, muy positiva. Al poco tiempo de estar en el Guaguas ya sabía que saldríamos campeones".</p>

<p>Al igual que todos sus coetáneos de aquella etapa gloriosa, el aspecto humano es una de las claves que pondera para el asalto a la primera Liga o el doblete de 1991, éxitos en los que tuvo un papel capital. "Había una gran relación entre todos, conocíamos a las familias de los compañeros, compartíamos tiempo libre y éramos un grupo fuerte, unido, muy sano. Era muy importante tener esos vínculos tan fuertes porque, a lo largo de una competición, siempre hay momentos buenos y malos y necesitas confiar en quien tienes al lado, saber que va a apoyarte, a ayudarte".</p>

<p>"Era normal que con Golec tuviese más trato porque ya éramos amigos y compañeros antes de venir al Guaguas. Pero tanto él como yo nos abrimos al resto porque aquí nos hicieron sentir como en nuestra propia casa. Era feliz jugando, entrenando y también al ver a mi familia muy adaptada a la vida en la isla. Yo le había dicho al presidente que necesitaba que los míos estuviesen bien, él me prometió que así sería y, la verdad, cumplió con su palabra. Eso, sin duda, me ayudó a dar mi mejor rendimiento".</p>

[cita_editorial author="Ireneusz Klos"]Siempre ponía por delante de todo la concentración en los partidos. Pienso que en un jugador los porcentajes se dividen, a partes iguales, en lo que se refiere al aspecto físico y mental. Todo va al 50%. Puedes estar muy atento al juego pero si no tienes la condición física necesaria, no vas a llegar al sitio que quieres.[/cita_editorial]

<p>"Alguna bronca me echaban los compañeros cuando me soltaba a rematar todo lo que me venía por delante. Pero lo que hice, con aciertos y errores, fue por el bien del equipo. Nunca busqué sobresalir. No me creía mejor que nadie. Lo único que quería es que el equipo ganara", admite.</p>

<p>Reconoce, además, que el apoyo que sintió de la afición grancanaria "fue muy especial", ya que aunaba "sentimiento y fidelidad", dando cuenta de que, incluso, en las derrotas "la gente estuvo detrás del equipo", algo que valora "de corazón" al estimar el simbolismo que tiene "una fidelidad tan grande".</p>

<p>"Hubiese firmado, al llegar al Guaguas, ganar todo lo que gané en los dos primeros años. Dos Ligas y una Copa. Impresionante. Me alegré muchísimo por los compañeros, por la gente, por la directiva que tanto luchó. Fue todo muy bonito. Y nada fácil, porque los rivales eran muy fuertes. Esa final ante el Bomberos de Barcelona la tengo como uno de mis grandes recuerdos por la alegría que supuso para todos. Los tres títulos que ganamos en esos dos años de 1989 a 1991 significaron muchísimo. Ese grupo de jugadores lo merecía", destaca.</p>

<p>Como aconteció con la mayoría de jugadores del Guaguas de principios de los noventa, Klos recibió numerosas propuestas para cambiar de aires y, pese a que tenía la opción de renovar por otro año más a la conclusión de su contrato, terminó aceptando una del Grenoble de Francia. Fue un adiós "inesperado", dada su pretensión de seguir ligado a un escudo en el que se hizo ídolo y con el que se le intuía un recorrido más duradero. "No fue un paso fácil, pero tuve que elegir. Dejé al Guaguas en lo más alto y, al menos, me quedó ese consuelo. Irme dándolo todo y colaborando en una etapa maravillosa para el equipo de la ciudad", valora.</p>

[seccion_header]El regreso inesperado[/seccion_header]

<p>"Nunca" imaginó que, con los años, en 1995, tendría un retorno al Guaguas, tras su etapa en Francia y Luxemburgo, ya en el tramo final de su carrera profesional. Todo fue de una manera casual y cuando enfocaba sus pasos a un retiro tranquilo en su país.</p>

[cita_editorial author="Ireneusz Klos"]Golec me invitó a pasar la Navidad en Gran Canaria con la familia. Me gustó la idea porque hacía muchos años que no regresaba. Quería pasar unos días agradables con Golec... Pero, al poco de llegar, me dijo de ir a entrenar al CID, a ver a antiguos compañeros. No había llevado ni ropa deportiva ni zapatillas. Él me dijo que me lo resolvía todo.[/cita_editorial]

<p>"Y así fue. De nuevo pisé esa pista en un partido de entrenamiento en el que jugué con los suplentes. Ganamos 3-1. Estaban en el Centro Insular Juan Ruiz y Antonio Benítez. Me vinieron a saludar, me felicitaron al ver el nivel que tenía ya con 35 años y me dijeron que les gustaría que regresara. Sinceramente, me puso muy contento esa posibilidad y quise que se hiciera realidad".</p>

<p>A Klos le ofrecieron "unas condiciones económicas muy buenas" y con las que se sintió "bastante valorado" pese a estar en la recta final de su trayectoria en activo. "En mi etapa en Luxemburgo tenía que entrenar a un equipo femenino para completar mi salario y eso, obviamente, me quitaba tiempo de mi preparación. Cuando regresé al Guaguas, Juan Ruiz me hizo un buen contrato que me permitió, además, volver a estar enfocado al ciento por ciento en el voleibol profesional. Fue un año muy bonito, recuperando viejas sensaciones con muchos compañeros que ya conocía y Paco Sánchez Jover de entrenador, y que terminamos con otro título, la Copa del Rey que le ganamos al Soria. Fue mi despedida, junto a la de Golec, y con un gran triunfo. No se puede pedir más".</p>

<p>En su balance de las tres campañas defendiendo la camiseta amarilla pesa todo lo bueno y así lo evidencia: "Para mí fue una época maravillosa y que me gusta recordar. Momentos especiales que siempre van conmigo. Volví en 2015 a un homenaje que nos hicieron y todo me vino a la cabeza. Asocio el Guaguas a una parte muy bonita de mi vida. Y saber que los aficionados disfrutaron de mi juego es lo que más valoro".</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 06: IGNACIO BRITO / TRIBUTO A LOS SALESIANOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Ignacio Brito / Tributo a los Salesianos',
        'numero' => '06',
        'order' => 50,
        'show_marker' => true,
        'ref_id' => 'cap06',
        'hero' => array(
            'image' => libro_img('hero-patio-colegio.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('IGNACIO BRITO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('TRIBUTO A LOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('SALESIANOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[seccion_header]Tributo a los Salesianos[/seccion_header]

<p><em>Por Joselu Sánchez</em></p>

[capitular]El Colegio Salesianos Las Palmas, fundado en el año 1923, ha sido un pilar fundamental en el desarrollo del voleibol en Gran Canaria. El apoyo al deporte como vehículo de educación y convivencia entre sus alumnos hizo de este centro un referente en el desarrollo de las actividades de competición deportiva de la isla.[/capitular]

<p>El profesor de Educación Física Silvestre Cabrera Monzón, presidente de la Federación de Voleibol de Las Palmas entre 1973 a 1985, comenzó a impartir los principios de esta disciplina entre sus alumnos y propició el desarrollo de la pasión por este deporte en la vida de muchos colegiales. Algunos de ellos se aficionaron y lo practicaron durante años y llegaron a ser grandes jugadores que compitieron en las ligas de honor nacionales con equipos, tan relevantes en la historia del voleibol canario, como el CV Juventud Las Palmas y el CV Calvo Sotelo.</p>

<p>El primer equipo canario en alcanzar la máxima categoría del voleibol en España, el CV Juventud Las Palmas, liderado por los entrenadores Manuel Evaristo y Félix Rodríguez, en la temporada de 1981-82, contó con una plantilla mayoritaria de alumnos salesianos. Entre ellos podemos mencionar jugadores tan sobresalientes como Javier Rodríguez, Manuel Palacios, Tony Acosta, Alberto Calero, Isidro Quintana, Jordi Comi, Juani Nogales, Luis Apolinario, Alfonso Gallardo, Fefo Montelongo, Antonio Díaz, Carlos Franchy, Carmelo Torres, Andrés Martínez o mi caso, entre otros.</p>

<p>Por otro lado, además, alumnos procedentes de esta cantera colegial contribuyeron a la excelente trayectoria del CV Calvo Sotelo, que también lograría ascender, en la temporada 1984-85, a la división de honor de este deporte. Bajo las órdenes de su entrenador y pieza importante del voleibol grancanario, el fallecido Felipe Nuez, en las canchas del colegio nacional Calvo Sotelo, fueron entrenados Miguel Mendaño, Alfredo Padrón, Tony Vázquez, Juan Carlos Rodríguez, Ortega Araña, Ramón Rodríguez, Tony Acosta, Enrique Ramírez. En la temporada 1985-1986 este equipo adoptó el nombre de su patrocinador y pasó a denominarse CV Guaguas.</p>

[seccion_header]Ignacio Brito[/seccion_header]

[capitular]Estuvo en la génesis del gran Guaguas, el equipo que se hizo leyenda con su irrupción triunfal a finales de la década de los ochenta, lo que considera "un orgullo que queda para toda la vida" al ser esa una pertenencia "demasiado especial". Ignacio Brito (Las Palmas de Gran Canaria, 1962), todavía hombre activo del voleibol por su condición de director deportivo del CV Sayre CC La Ballena, fue, en sus tiempos, "un colocador temperamental, competitivo y que quería ganar siempre" en aquel grupo que logró dos ascensos a la máxima categoría, aunque el primero no se ejecutara "por cuestiones ajenas al deporte", y en el que se acogió a un joven empresario como Juan Ruiz que llegó "para revolucionarlo todo".[/capitular]

[cita_editorial author="Ignacio Brito"]Ahora es fácil elogiar a Juan porque ha conseguido cosas impensables. Pero en aquellos años, sin ser un entendido del voleibol, fue un futurista, un visionario porque introdujo en el club una visión nunca antes vista y que supuso un impulso total. Deportivo, económico, institucional... Fue una gestión magistral sin la cual no se sabe qué hubiese sido del club.[/cita_editorial]

<p>"Cuando llegó al vestuario, era normal que lo miráramos con ciertas reservas. Nos pidió que le dejásemos trabajar y muy pronto se ganó nuestra credibilidad por lo que consiguió", subraya Brito, quien coincidió con el histórico presidente en los primeros compases de su mandato.</p>

<p>Surgido en el Marpe y aficionado al voleibol "por el maestro don Eliseo", aunque las canchas de entrenamiento "fueran de cemento, un desastre para la integridad física", y sus primeros pasos como jugador federado los da en el Juventud Las Palmas ("entonces el equipo estrella del vóley en Gran Canaria, el primero en tocar la élite") hasta que, "convencido por Felipe Nuez", desembarca en el embrión del Guaguas que estaba por venir.</p>

<p>"Tras el descenso del Juventud, se produce un desembarco de jugadores a aquél Calvo Sotelo, en el que me encuentro un sistema de entrenamiento y una exigencia que me encantó por la manera en la que entendía el deporte. Siempre queriendo mejorar, progresar, ganar... Felipe Nuez fue un mundo de enseñanzas para mí. Y también recuerdo a Ivo Martinovic, otro sabio en la docencia de este deporte", destaca.</p>

<p>Compañero, entre otros, de un jovencísimo y destacado Sergio Miguel Camarero en sus inicios, tiene muy vivos los recuerdos de aquella etapa: "Logramos subir, tras dos intentos, aunque solo debió ser uno, y medirte a gente que tenías como ídolos en las filas del Bomberos, del Madrid o del Málaga ya era un sueño. Pero es que, encima, les ganabas. Sin palabras. Fueron años preciosos, aunque tuve una lesión muy grave en Valladolid que me lo hizo pasar mal, aunque me terminé recuperando".</p>

<p>"Disfrutábamos del voleibol, nos iban las cosas bien. Nos dedicábamos en cuerpo y alma a ser más competitivos, aunque, en mi caso, nunca dejé de estudiar. Y era como cumplir un sueño. Viajes, partidos, victorias, notoriedad en los medios de comunicación... Cuando miro para atrás lo hago con satisfacción y agradecido a la vida por haberme permitido estar allí y en ese momento. Muchos no llegaron o se quedaron por el camino, como el caso de Mendaño y su desgraciada pérdida. De ahí que me considere, en cierta medida, un privilegiado", añade.</p>

<p>Sus pasos los continuó, luego, en el Seven Up Santa Catalina hasta la retirada en activo. Vivió desde fuera la consagración del Guaguas y "con una alegría inmensa" por haber sido partícipe de lo que vino después, como lo hace ahora en su condición de socio.</p>

<p>"La historia del Guaguas, ya son cincuenta años que se dice pronto, es de una importancia y valor enorme para el deporte canario. Si tuvo mérito lo que hizo a finales del siglo pasado, más lo que ha logrado tras su refundación, volviendo a cosechar éxitos, a dar que hablar en competiciones europeas, a seguir dando prestigio a nuestro voleibol", concluye.</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 07: MAREK, AYER, HOY Y SIEMPRE
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Marek, ayer, hoy y siempre',
        'numero' => '07',
        'order' => 55,
        'show_marker' => true,
        'ref_id' => 'cap07',
        'hero' => array(
            'image' => libro_img('hero-europa.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('MAREK', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('AYER, HOY', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('Y SIEMPRE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Ayer, hoy y siempre. No hay otra manera de referenciar el significado de la figura de Marek Szczesnowicz (Gdansk, Polonia, 1957), historia viva del club por una pertenencia que data de finales de la década de los ochenta y que sigue vigente. Team mánager del equipo ("hice y hago todo lo que sea necesario con tal de ayudar al club"), es testimonio obligado a la hora de celebrar el cincuentenario de la institución por el bagaje que personifica. "El Guaguas ha sido mi vida, mi familia. Ha trascendido lo meramente deportivo porque los años que he dedicado al equipo así lo reflejan. Entré casi de casualidad y, sin saberlo, ahí se inició una historia de la que me siento muy orgulloso", significa.[/capitular]

<p>El inicio de todo se sitúa con los fichajes de las estrellas polacas Ireneusz Klos y Waclaw Golec, compatriotas suyos: "Estaba el problema del idioma y, también, el de una legislación complicada, entonces en el campo comunista, y que impedía salir a los deportistas por debajo de una edad. Yo me había establecido ya en Gran Canaria y, seguramente, no había muchos polacos por aquí porque Juan Ruiz preguntó por gente que fuese de mi país, me localizó y me pidió que lo ayudara en las gestiones, en ir allí a arreglar todo. Lo que iba a ser un trabajo puntual terminó derivando en esta larga relación que se interrumpió unos años por cuestiones laborales pero que no dudé en retomar cuando se dio el momento oportuno".</p>

<p>Ese punto de partida sumerge a Marek en recuerdos imborrables con la etapa dorada de aquel Guaguas que asombró a España con sus títulos y resonancia: "Ahora hemos vuelto a recuperar brillo. Somos campeones, seguimos trayendo a jugadores muy buenos, la afición está regresando... Pero ese Centro Insular lleno hasta la bandera, con las escaleras de acceso atestadas de gente que se había quedado sin asiento, las noches mágicas... Uno se emociona porque fueron campañas preciosas, con plantillas que eran una familia, otros tiempos en los que las relaciones eran familiares, pues te implicabas hasta en temas personales de los jugadores para poder echarles una mano en lo que te pidieran".</p>

[cita_editorial author="Marek Szczesnowicz"]Supone un motivo de satisfacción enorme haber vivido esos años mágicos, irrepetibles, que tampoco podemos comparar porque corresponden a otro contexto. Hoy el fútbol arrasa con todo. Pero nosotros, en esos años de los primeros títulos, nos llegamos a convertir en la bandera del deporte de Gran Canaria.[/cita_editorial]

<p>"Se agotaban las entradas para ver nuestros partidos. Jugábamos por Europa y nos recibían como a las estrellas... Y eso, en un país como España, que no tiene la tradición del voleibol como otros países, tiene un mérito increíble. Y hoy pervive ese espíritu, mantenemos el prestigio, la esencia de un proyecto que ilusionó a todos y que se ha ido adaptando a la modernidad".</p>

<p>Habla Marek de que la conservación de esa raíz que hace único al Guaguas por su experiencia y conocimiento en primera persona, pues sigue liderando las expediciones por Europa y las acogidas que reciben "están a la altura de un club de primer nivel".</p>

<p>"Como pasa con todo en la vida, puede que se valore más fuera que dentro lo que significa este escudo. No es fácil sostenerse año a año en la cima deportiva, llegando a finales, que ya es muy difícil, y ganándolas, que es todavía más complicado. Nosotros no hemos crecido presupuestariamente conforme a los objetivos y exigencias deportivas que nos ponemos. Siempre vamos a por todo sin poder competir con otros clubes que disponen del doble o triple de recursos económicos que nosotros. Y Juan Ruiz, no sé cómo se las ingenia, sigue trayendo estrellas, jugadores que de una calidad indiscutible. Cada campaña, más y más", subraya.</p>

<p>Y es que Juan Ruiz explica y razona todo su compendio de servicios para la causa: "Vine por él, volví por él, cuando en la época de la pandemia me llamó, y mientras esté, le acompañaré. Juan es una persona demasiado especial y con la que he logrado entenderme siempre. Muy pasional, siempre con ideas para que el Guaguas crezca. Antes todo dependía de él y se entregaba al límite. Ahora ya hay una estructura de club y eso, desde luego, le ayuda, aunque sigue siendo el mismo que se acuesta y se levanta pensando en el club. Es inagotable".</p>

<p>Sergio Miguel Camarero, jugador de éxito y entrenador, igualmente, laureado, es el otro gran nombre propio que le brota de manera espontánea: "Otro de la vieja guardia que defiende la camiseta como el que más. Cuando saltaba a la pista no se conformaba con ser uno de los mejores, pues exigía a los compañeros que lo dieran todo y, además, conectaba con la grada, encendía a la afición con su temperamento. Y ahora, desde el banquillo, es el mismo en distinta función. Admirable que no se canse nunca de ganar y que día a día sea un ejemplo de compromiso y lealtad".</p>

<p>Testigo y partícipe de innumerables éxitos y títulos, reconoce que sentirse en lo alto "es demasiado especial" como para no apreciarlo como se debe: "Cada título es único. Por mi parte, así lo vivo. Sé todo lo que cuesta llegar a ser campeón y siempre lo saboreo de la mejor manera y no dudo en felicitar a técnicos y jugadores. Ha sido una suerte y un privilegio pertenecer al Guaguas tanto en la primera etapa con Juan Ruiz como en la refundación. Impresionante cosecha de campeonatos, de profesionales intachables... No hay palabras para describir tanta felicidad, tanto sacrificio recompensado".</p>

<p>¿Y el futuro? "Disfruto del día a día. Todos estamos de paso. Aquí y en cualquier ámbito de la vida. Mientras las fuerzas aguanten y la ilusión sea la misma, el Guaguas sabe que puede contar conmigo. Y cuando no esté, espero que el legado que se haya dejado facilite a los que vengan el trabajo y sigan construyendo un club que sea orgullo de Gran Canaria en todos los aspectos".</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 08: EMBAJADORES POR EUROPA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Embajadores por Europa',
        'numero' => '08',
        'order' => 60,
        'show_marker' => true,
        'ref_id' => 'cap08',
        'hero' => array(
            'image' => libro_img('hero-europa.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.78)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 70,
            'icon_height' => 70,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('EMBAJADORES', '#D4AF37', '', 'black'), libro_hero_line('POR EUROPA', '#FFFFFF', '', 'black')),
        ),
        'content' => ''),
    array('title' => 'La aventura europea', 'numero' => '', 'order' => 60, 'show_marker' => false, 'parent_ref' => 'cap08',
        'hero' => array(
            'image' => libro_img('hero-europa.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.15)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('LA AVENTURA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('EUROPEA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[capitular]Si brillantísima ha sido la trayectoria nacional del Guaguas, con dominio de las dos competiciones domésticas, reinado que ha logrado revalidar tras su refundación en 2020, su amplia presencia en competiciones europeas, con punto de inicio de 1987 ante el Knack de Bélgica en la emblemática pista del San Román, también es digna de valoración. Con un balance de más de cincuenta partidos oficiales frente a escudos de otros países, el Guaguas se ha convertido, por méritos propios, en uno de los mejores embajadores de Canarias por todo el mundo.[/capitular]

<p>Esa vocación sin fronteras a la hora de exportar los valores y potencialidades del club también ha llevado aparejada la bandera tricolor para mayor orgullo de aficionados e instituciones públicas, de alta sensibilidad siempre con la representatividad fuera de España.</p>

[cita_editorial author="Juan Ruiz"]Queremos ser alguien en Europa.[/cita_editorial]

<p>Decía Juan Ruiz nada más llegar a la presidencia, a finales de los ochenta, evidenciando que el crecimiento de la entidad pasaba por hacerse un hueco entre los mejores del continente.</p>

<p>Un repaso a su camino rivalizando con equipos extranjeros deja momentos culminantes, como el histórico triunfo ante el PSG francés o la victoria ante el Lennick belga que, en 1998, abrió las puertas a la Final Four de la Recopa que se celebró en Cuneo (Italia), entre otras citas que ya tienen su relevancia en la historia. Y tal ha sido su calado, pasado y reciente, que en el ránking mundial de clubes de voleibol realizado en los últimos meses, el equipo grancanario ocupa uno de los lugares de privilegio, lo que se valora como si fuese un trofeo oficial más en las vitrinas, dada la importancia que tiene un posicionamiento de este calibre.</p>

<p>Como precisa Antonio Benítez, sempiterno mánager y que ha encabezado casi todas las delegaciones del Guaguas en sus comparecencias por las capitales de varios países, esta presencia sostenida procuró una red de relaciones de alto prestigio, además de convertir al equipo en un atractivo para jugar torneos amistosos de primer nivel cada verano. Así lo atestiguan los banderines y placas acumuladas a lo largo de los años, algo que aumenta más si cabe este bagaje más allá de Canarias y España. Las pretemporadas y giras realizadas fuera del país fueron habituales durante varias campañas y reforzaron estos vínculos al margen de los relacionados estrictamente con el ámbito competitivo.</p>

<p>Así, el binomio Guaguas-Europa ya es un clásico en el calendario, con una relación ininterrumpida de trece años (1987-2000), y que ofrece el recorrido con los oponentes que a continuación se detalla.</p>
'),
    array('title' => 'Manuel Palacio', 'numero' => '', 'order' => 62, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Recorrió toda España y viajó, también, por media Europa siguiendo los partidos del mejor Guaguas en competiciones internacionales ("Polonia, Italia, Grecia, Rusia, Portugal, Rumanía, Turquía...") para dar cuenta en sus crónicas de las hazañas de aquella memorable pléyade de jugadores ("entonces, sin internet ni móviles, el método era contratar una llamada internacional en el hotel, rezar para que las comunicaciones no fallaran, y dictarla a la redacción") y como enviado especial del periódico La Provincia. Desde mitad de los setenta, sin embargo, se remontaba su actividad como informador del voleibol en las páginas de El Eco de Canarias y Hoja del Lunes ("tuve que utilizar el seudónimo de Plongeon para poder compatibilizar los dos medios de comunicación"). Fue testigo, por tanto, del nacimiento del Calvo Sotelo y siguió al detalle toda su evolución hasta el apogeo que llegó con los títulos pioneros y que llenaron hasta la bandera el CID. Manuel Palacio (Las Palmas de Gran Canaria, 1958-2023) fue una de las grandes autoridades del voleibol canario tanto por su experiencia en las canchas ("fui jugador y técnico del Juventud, compañero de Isidro Quintana y Joselu Sánchez en el ascenso a Primera División de 1982, además de ejercer de árbitro nacional") como por formación ("profesor de Educación Física y entrenador internacional") y constituyó una referencia obligada. "Perdí la cuenta ya de todas las reseñas que hice del Calvo Sotelo a lo largo de su historia, entre reportajes, entrevistas o crónicas. Podemos hablar de más de mil y lo mismo hasta me quedo corto", se sinceró para dar cuenta de las vivencias que acumulaba a pie de pista ("me sentaba en el mismo banquillo del equipo") y que le convirtieron en testigo único y de valor inestimable.[/capitular]

<p>"Como a otros muchos de mi época, fue Silvestre Cabrera, con el tiempo presidente federativo, el que me captó para el voleibol en los Salesianos y ahí me quedé. Jugaba de colocador y me defendí lo que pude, por así decirlo. Formé parte de aquel Juventud de comienzos de los ochenta tan emergente y, al tiempo, tampoco descuidé sacarme las titulaciones que me permitieran conocer en profundidad el deporte al que me dediqué. Recuerdo que en los primeros tiempos, y por iniciativa del propio Silvestre Cabrera, se nos daba una ayuda de 25 pesetas por cada artículo de voleibol que publicáramos en prensa y con el fin de darle más relevancia. Isidro Quintana, Tony Vázquez, José Miguel Santana o yo nos sacábamos una ayudita de esa manera. Cobrábamos a mes vencido. Le poníamos más entusiasmo que interés económico de todas formas, pero se hizo una labor valiosa. Y más cuando aquí se celebró, en el año 1978, una final de la Copa del Rey entre el Bomberos de Barcelona y el Real Madrid, brindando a la afición la posibilidad de ver un voleibol de un nivel sublime", opinó.</p>

<p>Palacio resaltó que "el gran trabajo de cantera y potenciación de la base" que se consolidó en la década de los setenta permitió a Gran Canaria "disponer de una buena representatividad a nivel nacional" en el voleibol, traducida en equipos masculinos y femeninos "de enorme talento y competitividad". Y el Calvo Sotelo, al que le benefició el descenso del Juventud en 1983 para adquirir más notoriedad, "terminó llevando la bandera de la isla con una camada extraordinaria de juveniles que no paró de crecer y crecer".</p>

<p>"El trabajo de Felipe Nuez fue sensacional. Y dio su fruto tras varios años de continuidad en el modelo que impuso. Tony Vázquez, Pericles, Mendaño, Araña, Ramón Rodríguez, luego se unió Camarero, que vivía al lado del San Román... Era cuestión de tiempo que acabara en la máxima categoría como así sucedió. Se veía venir. Lo que no era tan predecible era que llegara a la cima. No creo que nadie lo esperara en Canarias, hay que ser sinceros y decirlo así", estimó.</p>

<p>En este "enorme salto cualitativo" enfocó sus impresiones en la figura de Juan Ruiz quien, "con sus aciertos y errores", supo transportar al club "a lo más alto y rompiendo la hegemonía de clubes con más presupuesto y que se llevaban todos los títulos".</p>

<p>"Cuando Juan se trajo a Sánchez Jover, Venancio Costa y Antonio Miralles, tres figuras de las mejores que había en el país, comencé a plantearme que iba en serio. Ya con Klos, el mejor colocador del mundo, o Golec, el sexteto era una cosa de locos: Costa, Miralles, Sánchez Jover, Klos, Golec y Camarero. Reventaron el CID literalmente. Y pasó lo que tenía que pasar. Juan fue a por todo, apostó a lo grande y le puso valentía. Mereció todo lo que vino por su empeño. Es de justicia reconocerle lo que hay que reconocerle", añadió.</p>

<p>Consideró Manuel Palacio que Ruiz "hizo realidad todos los sueños de la afición" al construir un Guaguas "campeón e imbatible" y tirando "de su habilidad social para conseguir muchos patrocinadores, con aportaciones pequeñas pero importantes, para sostener un proyecto lleno de estrellas".</p>

<p>Retroceder a esa etapa le llenó de "recuerdos muy bonitos" porque, al margen de los títulos ("fue un privilegio vivir en primera persona gestas únicas, con una marea humana de seguidores que no se ha vuelto a repetir"), tuvo muy presentes situaciones que no pudo olvidar por la carga emocional que comportaron. Enciclopedia abierta, Palacio las relató al detalle y con una sonrisa nostálgica: "En Grecia nos topamos con una afición que se quería meter en la cancha a morder. Le dije a Juan Ruiz, que estaba a mi lado, que ni se le ocurriera protestar nada si queríamos salir vivos de allí. Ahora lo cuento y me río. Pero había que estar allí en ese momento con miles de personas a tu espalda gritando y haciendo gestos muy agresivos. En Polonia, a Klos le gritaban pesetero desde la grada. No entendía nada pero él mismo me lo dijo y también que se iba a encargar de arreglarlo en un set. Y así lo hizo. Su categoría como jugador era universal. Los calló a todos con un vendaval de juego. Y cómo olvidar aquel viaje a Zagreb cuando, a inicios de los noventa, comenzaron los bombardeos de los serbios. En el mismo aeropuerto de Barcelona, poco antes de embarcar, Juan Ruiz tuvo que llamar al Ministerio de Asuntos Exteriores para ver si autorizaban o no el viaje porque la zona de conflicto coincidía con la localización del partido. Tras unas consultas y mucha tensión, nos desplazamos. He de decir que allí encontramos gente amable y humilde, nos protegieron todo el rato y se pudo jugar sin problema alguno".</p>

<p>Aquel partido ante el PSG en el CID "con más de 6.000 espectadores" o la Final Four de la Recopa en Cuneo constituyen otros hitos que resalta por el eco que tuvieron y la expectación que generaron antes, durante y después. "Fueron momentos en los que se hablaba más del Guaguas que de la UD Las Palmas, y eso son palabras mayores. Un equipo que ganaba títulos, competía en Europa y tenía figuras mundiales", añade.</p>

<p>Palacio valora que el Guaguas se haya vuelto a levantar "después de años durísimos en los que parecía que no habría salida", lo que le hace valorar el momento actual: "No se puede entrar en comparaciones. Hace treinta años teníamos un Guaguas campeón y ahora podemos decir lo mismo. Pienso que es lo más importante. Ojalá que la afición se vuelque con el equipo y que cuando lleguen tiempos duros, siga ahí, porque en el deporte no siempre se gana. Será la mejor manera de mantener el espíritu original del Calvo Sotelo y de lo que ha venido después".</p>
'),
    array('title' => 'Antonio Benítez', 'numero' => '', 'order' => 63, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Fue por un anuncio de periódico, a finales de 1990. Antonio Benítez (Las Palmas de Gran Canaria, 1960) desarrollaba su labor profesional como profesor de inglés cuando leyó el llamamiento en prensa de un club que requería un gerente para labores logísticas y relacionadas con la organización del personal y de la estructura propia. "Me resultó muy atractivo, me presenté, pasé el proceso de selección y me quedé... Hasta 1998. Nunca imaginé que iba a cubrir una etapa tan duradera y fructífera en el Guaguas y que ha supuesto un orgullo especial", admite un dirigente que siempre tuvo a Juan Ruiz como presidente y no ha dudado en regresar con él tras la refundación de la entidad.[/capitular]

<p>Las peticiones del técnico argentino Enrique Edelstein, que demandó la figura de un mánager con el que reportar y que ejerciera de enlace con la cúpula, motivaron que en el club isleño crearan este cargo de responsabilidad que, desde los inicios, recayó en la misma persona. Organización de viajes, relaciones con los otros clubes, atención a las necesidades de los jugadores que procedían de fuera y necesitaban resolver y tramitar gestiones, planificación de las pretemporadas... Una cartera bien amplia que, concentrada en un único representante, requirió lo mejor de sus capacidades.</p>

[cita_editorial author="Antonio Benítez"]Poco a poco, y gracias al enorme rendimiento del equipo, con títulos y participaciones en las competiciones europeas, fuimos cumpliendo con el propósito de situar en el mapa al Guaguas, de que cogiera posicionamiento internacional, de que la marca se diera a conocer fuera de España y se prestigiara, con el orgullo añadido de representar a Canarias y a un nivel magnífico. De la nada a tener un nombre en Francia, Alemania, Polonia, Rusia, Checoslovaquia, Italia, Bulgaria, Portugal....[/cita_editorial]

<p>Benítez admite que su tarea resultó "tan enriquecedora como compleja y agotadora", dada la dimensión que adquirió el Guaguas, participando en encuentros "de altísimo nivel" en el concierto europeo, con el punto culminante de la Final Four de la Recopa, disputada en la ciudad italiana de Cuneo, en 1998.</p>

<p>"Hay infinidad de recuerdos. El recibimiento que una vez nos hicieron en Francia y nos compararon al Real Madrid, los partidos en el CID ante el PSG... O aquel ante el Lennick, cuando teníamos que ganar por 3-0 para entrar en la Final Four. Como si fuese ayer estoy viendo a Omeragic, que era la estrella del rival, elevarse para hacer el punto que les daba a ellos el set y nos arruinaba el sueño. Pero lo que parecía inevitable con ese \'penalti\' que no entró por la defensa que hicimos, terminó cimentando una remontada memorable. Fue uno de esos días en los que se te pone el corazón en la boca de las emociones que te depara el voleibol. O, como canario, ver jugar a seis jugadores de la tierra de manera simultánea en una Final Four, como hizo Sánchez Jover en la final de consolación en Cuneo, también te queda para siempre", argumenta.</p>

<p>Los vaivenes presupuestarios por el cambio de patrocinador o esas incertidumbres financieras que son propias a cualquier club profesional no alteraron su hoja de ruta y en la que el respeto por la estabilidad económica "era sagrado".</p>

<p>"Manejábamos unos presupuestos ajustados y, a la vez, unas plantillas con jugadores muy cotizados. Teníamos que hacer convivir todo eso y la gestión encabezada por Juan Ruiz siempre permitió la sostenibilidad del Guaguas. Eso tiene un mérito que debe reconocerse. Cuando nos fuimos, en 1998, había dinero en caja y patrocinadores ya cerrados. Creo que fue un modelo responsable y que permitió crecer sin generar descontrol en la tesorería. Tal y como estamos haciendo ahora. Porque no hay otra alternativa", advierte.</p>

<p>Tan reconocida y eficiente ha sido su hoja de servicios que, en su momento, fue llamado para incorporarse al organigrama de la Confederación Europea de Voleibol en su sede de Luxemburgo, propuesta que supuso "un reconocimiento inigualable" pero que no pudo aceptar por cuestiones familiares.</p>

<p>"En su día logramos consolidar relaciones estables y muy sólidas con los grandes clubes de Europa y ahora, en el retorno, hemos vuelto a dar prioridad a este aspecto. Volvemos a notar un gran respeto y consideración por el Guaguas. Y lo digo con el conocimiento de causa que me da haber realizado todos los viajes por infinidad de países al frente de la expedición. Además, hemos recuperado la tradición de realizar torneos internacionales aquí y con clubes de enorme potencial y que están encantados de estar con nosotros... Es una satisfacción ver recompensados todos los esfuerzos de esta manera, sabiendo que estás presente en el concierto internacional, que el Guaguas tiene su sitio", abunda.</p>

<p>Y la sempiterna cuestión pendiente de ese título continental que no llega la zanja Benítez desde la proporcionalidad de su juicio: "Aspirar a la Champions es una utopía porque hay rivales que multiplican por siete y ocho nuestro presupuesto. Encima, el sistema de competición te obliga a pasar varias rondas para luego acabar en un grupo con varios favoritos. Resumiendo, siendo realistas, ahora lo máximo es llegar a esa fase final de grupos. A nivel nacional volvemos a ser los mejores y, fuera de España, participar en la Champions ya debe considerarse un logro. Todo lo que venga, será para subir nota".</p>

<p>De Juan Ruiz, todo son parabienes: "Llegué con él, me fui con él y regresé con él. Su capacidad de trabajo y de superación es asombrosa. Y siempre guiado por el interés de la institución".</p>
'),
    array('title' => 'Jorge Ramón', 'numero' => '', 'order' => 64, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Ya tenía el voleibol en la familia, con sus hermanos Jose y Marisa y su primo Joselu Sánchez como influencias capitales, cuando Jorge Ramón (Las Palmas de Gran Canaria, 1967) arrancó en el deporte que estaba instalado en casa y en las filas del Olímpico. Su altura, a edad juvenil, terminó de catapultarle para ingresar en el Calvo Sotelo después de que se creara la selección juvenil para el Salesianos. "Felipe Nuez me vio y me dijo que me quería en el equipo", rememora. Sin más pretensión que la de "pasarlo bien y disfrutar del deporte" y sin pensar "para nada" en que haría carrera en el equipo, arrancó un ciclo que le llevaría a ganar 5 Ligas y 4 Copas del Rey hasta 1995, el año en el que decidió retirarse, pese a contar con 28 años, para dedicarse plenamente a la informática, campo en el que ha desarrollado su actividad profesional. "Podría haber seguido jugando más, pero hablé con mi mujer y consideré que era el momento".[/capitular]

<p>"Pericles, Batista, Mendaño y Tony Vázquez eran los veteranos cuando yo llegué. Camarero ya se sabía que iba a llegar pese a que era muy joven... En general había un grupo muy bueno con Felipe al frente y eso me ayudó a querer seguir, porque no era fácil compaginar estudios con entrenamientos. Pero, en ese momento, sigues adelante sin plantearte otra cosa. Es como la vida, que pasas de niño a hombre sin darte cuenta. En mi caso, ya estaba jugando en la División de Honor con Ivo Martinovic y Carrasco como refuerzos de fuera y un grupo de jugadores de la tierra realmente bueno".</p>

[cita_editorial author="Jorge Ramón"]Creíamos en la filosofía del trabajo, de recoger los frutos a entrenar fuerte y darlo todo en la pista. Eso fue lo que me caracterizó. Entraba en la pista y me comía la pelota y la red. Si era el recambio de un compañero, ni se notaba que faltaba porque lo ponía todo. Pero es que no podía ser de otra manera. Cuando estás en un equipo con Camarero, Martinovic, luego Sánchez Jover, Venancio, Klos o Golec es que no te quedaba otro remedio que ser así porque entre esas estrellas estabas muerto si no te partías el alma.[/cita_editorial]

<p>El ascenso a la élite, la permanencia y esa continuidad que habilitó el escenario para la llegada de los títulos constituyó un proceso en el que Jorge Ramón fue uno de los testigos activos: "Subir ya fue increíble. Luego lo que no queríamos era bajar y ese sexto puesto en el primer año en la División de Honor nos supo a gloria. Teníamos la mentalidad de ir poco a poco... Pero con la llegada de Juan Ruiz a la presidencia y los fichajes que hizo, esto se fue de las manos. Ligas, Copas, jugar en Europa, ganarle al Palma, que era algo impensable... Fue una evolución brutal y que nos pilló a todos por sorpresa", concreta.</p>

<p>Sonríe cuando le toca mirar para atrás y rescatar momentos que guarda con especial devoción en su memoria: "Aquellas broncas con Ire (Klos) cuando no nos dejaba rematar nada en los partidos, o el encuentro de Copa en el que Edelstein me sacó y ayudé a los compañeros a levantar lo que estaba perdido y terminamos llorando de emoción, la afición del CID que era mágica, las bromas con Golec, que era alguien fantástico, crecer junto a Sergio, Juanma o David, que eran de aquí como tú y con los que pudiste mezclarte con figuras mundiales... Empiezo y no paro si tengo que destacar todo lo bueno que me pasó en el Guaguas".</p>

<p>"Realmente me considero un gran privilegiado por haber formado parte de esa etapa que fue única. Terminamos viendo como lo más normal del mundo ganar títulos, exhibir un nivel de voleibol que, en muchas ocasiones, rayaba la perfección o que, en agosto, cuando arrancaban las pretemporadas, ni pudieras moverte de los dolores musculares derivados de la dureza de los entrenamientos... Ahora lo piensas y te das cuenta de que era tan grande la exigencia, que ni tiempo había para pensar sobre la misma. Entrenabas, jugabas, ganabas y así siempre".</p>

<p>Sobre su rol en la plantilla, con el pedigrí de canterano que siempre le dio un diferencial, reflexiona: "Jugué más con algunos entrenadores que con otros. Pero ninguno de los técnicos que tuve puede decir que Jorge Ramón jugó un partido sin vaciarse. Cogía todas las oportunidades que me daban con la máxima intensidad. Y sin ser un fuera de serie, sin las condiciones técnicas de muchos de mis compañeros, nadie me ganaba en entusiasmo y derroche físico. Si me caía una pelota, la reventaba, si tenía que bloquear, iba con todo, si había que tirarse al suelo, me lanzaba como si me fuera la vida... En ese sentido, me sentí siempre feliz de jugar, con mayor o menor acierto, porque sabía que mis compañeros me veían como un guerrero, como alguien dispuesto a dejarse lo que hiciera falta por el Guaguas".</p>
'),
    array('title' => 'Juanma Martín', 'numero' => '', 'order' => 65, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Iba para futbolista y hasta los 16 años no tocó un balón de voleibol. Pero el destino quiso que Juanma Martín (Las Palmas de Gran Canaria, 1965) comenzara a jugar en la Universidad Laboral Felo Monzón con el San Roque "casi de casualidad" y, cuando se quiso dar cuenta, ya estaba enrolado en la disciplina del Calvo Sotelo. "Lo único que recuerdo es que Felipe Nuez organizó unos entrenamientos para seleccionar jugadores. Estaban Camarero, Joselu, Jorge Ramón... Y ya pasé a formar parte del club. Me cogió siendo juvenil y ya estaba en Segunda División. Fue todo rapidísimo, sin tiempo para asimilar nada", subraya.[/capitular]

<p>Todavía rememora aquellas sesiones de trabajo en el gimnasio del instituto Pérez Galdós en la etapa previa a la mudanza al San Román en las que, "casi a razón de ocho horas diarias", tanto él como los jugadores de la época adquirieron "nivel y disciplina a la altura de los mejores profesionales".</p>

<p>"Yo estudiaba la carrera de Educación Física y trataba de perderme los menos entrenamientos posibles. Por la tarde no fallaba nunca. Pero, tengo que reconocerlo, jamás me planteé jugar a alto nivel al voleibol. Todo lo que vino después con el ascenso a la División de Honor, los títulos y la locura de la afición a mí me pilló por sorpresa. Realmente no tuve tiempo de asimilar esa evolución. Jugábamos, ganábamos, entrenábamos, jugábamos, ganábamos, entrenábamos... Era para mí la misma secuencia, sin pararte a pensar que, como luego se ha visto y valorado, aquel Calvo Sotelo hizo algo increíble", argumenta.</p>

<p>"Al ingresar en la División de Honor, con los fichajes de Ivo Martinovic y Pepe Carrasco, que venía de Barcelona solo para los partidos, ya comenzamos a entrar en otra dimensión. Fue un salto de calidad pero sin perder las esencias porque, quiero dejarlo muy claro, la clave del Calvo Sotelo, del Lucky Strike, del Guaguas, del Constructora, la clave de todos los éxitos estuvo en que éramos una familia. El grupo humano resultó inmejorable y todos los que vinieron de fuera se adaptaron a las mil maravillas a la gente de la casa. Paco Sánchez Jover, Sergio, Venancio, Miralles, Willock, Chava... Formamos un núcleo muy unido. Y Juan Ruiz como presidente también fue un elemento clave. Él le dio a todo una visión más perfeccionista, orientada a ganar", expone.</p>

[cita_editorial author="Juanma Martín"]Me vienen a la memoria anécdotas muy entrañables que evidencian lo unidos que estábamos y lo que nos queríamos y protegíamos unos a otros. En la etapa de entrenador de Felipe Nuez, durante las concentraciones que él organizaba en el sur de Gran Canaria, mi madre era la que hacía de cocinera para todos. Y ya cuando jugábamos contra los mejores, en los viajes a Palma teníamos que hacer escala en Jerez y, luego, en Alicante. Pues a Alicante iba a vernos la madre de Miralles y nos llevaba conejo con tomate para alimentarnos. Y nos poníamos hasta arriba.[/cita_editorial]

<p>"Fue clave el respeto, el compañerismo llevado a la máxima expresión. Es de lo que más orgulloso me siento con diferencia cuando miro hacia atrás. Tuve compañeros de una calidad técnica insuperable. Klos, Golec, Paco, Camarero, Venancio, Miralles... La lista sería inmensa. Pero, por encima de que eran unos fenómenos del voleibol, se superaban como compañeros, como personas, como amigos. Todo lo que conseguimos fue, en mi opinión, fruto de esa fortaleza humana", considera.</p>

<p>Fueron cinco años como jugador ("me retiré y me obligaron a volver porque falló la opción de segundo colocador con Falasca") y uno como entrenador, cuando tuvo que sustituir al argentino Giovanacci ("ya me había sacado la titulación para ejercer"), en el que añadió a su palmarés la Liga y la Copa conquistadas en 1993.</p>

<p>"Como jugador era un currante, un líbero no reconocido. Paco me decía que si hubiese jugado unos años más tarde, hubiese sido un líbero de oro. Me caracterizaba por el trabajo y por tratar de ayudar siempre a los compañeros. Y como entrenador, mantuve mi estilo de tratar de colaborar en todo y encontré una disposición perfecta en muchos de los que habían sido mis compañeros. Era muy fácil entrenar a jugadores de esa calidad. Lo normal, que es lo que pasó, es que ganáramos, que siguiéramos en lo más alto", añade.</p>

<p>Parte de sus evocaciones también ponderan el papel jugado por la afición: "El deporte es para la gente y nosotros tuvimos la suerte de disfrutar de un acompañamiento espectacular. Es que entrabas al CID y hasta las escaleras eran ocupadas por los seguidores. El ruido, los aplausos, los gritos... Una gozada jugar así, te llevaban a lo que te propusieras, era casi imposible perder con miles y miles de personas empujando a tu favor".</p>

<p>El resurgimiento del club lo contempla, como todos los históricos de su generación, "con una alegría tremenda", pues considera que "es de justicia poder recuperar un emblema del deporte canario", ya que su consideración del Calvo Sotelo "va más allá del voleibol" dado el significado que comportó en su momento como "modelo deportivo y educativo, convirtiéndose en una manera de vivir".</p>
'),
    array('title' => 'Óscar Campos', 'numero' => '', 'order' => 66, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Integrante de la primera plantilla que defendió los colores del Calvo Sotelo en la División de Honor, Óscar Campos (Las Palmas de Gran Canaria, 1966) fue otro de los testigos que vivió la transformación del club en su paso de superviviente a candidato a todo. Colocador fichado del Juventud en 1985, cuando mira para atrás para entrar en detalles de aquellos tiempos "predominan los recuerdos positivos" ya que, por encima del balón y los partidos, "la complicidad entre todos era magnífica".[/capitular]

<p>"En mis años en el club siempre recuerdo un vestuario unido, de compañeros, de amigos. Cada uno jugaba su rol. En mi caso, tuve más protagonismo en los primeros años, pues luego con las llegadas de Paco, Venancio, Miralles, Willock, Klos o Golec se puso muy complicado tener minutos. Pero, con independencia de eso, lo que prevalece en mi memoria es un grupo sano y que fue creciendo sin parar hasta lograr títulos y logros de muchísima importancia. Titulares y suplentes íbamos a una, había un verdadero espíritu de equipo. Pensar que íbamos a ser campeones de Liga, sin ir más lejos, parecía de locos. Y se consiguió", razona.</p>

<p>Campos destaca tres nombres propios de su etapa en la entidad. Ensalza las figuras de Felipe Nuez, su primer entrenador y del que no olvida una metodología de trabajo única ("profesionalizó el voleibol porque diseñó entrenamientos muy intensos, con muchas horas, y, a la vez, muy completos, lo que contribuyó a elevar nuestro nivel y perfeccionar el juego"), del presidente Juan Ruiz ("hubo un antes y un después de su llegada, porque se dedicó a buscar medios económicos para el club y eso permitió una gestión muy eficiente y fichajes que posibilitaron los títulos") y de Paco Sánchez Jover ("su incorporación nos cambió la mentalidad y realizó una labor fundamental dentro y fuera de la pista para crear un equipo campeón").</p>

<p>"La primera Copa, la primera Liga, el ambiente del Centro Insular después de haber empezado sin tanta expectación en el San Román, el estreno en competiciones europeas... Hasta que me marché, tras fichar por el Almería en 1991, todo fueron experiencias positivas porque coincidieron con una etapa de grandes resultados, de una evolución constante", sintetiza.</p>

<p>Regresó un año, en el curso 1992-93, después de la marcha del argentino Wiernes y para completar la posición de colocador junto a Falasca, segunda etapa en la que, pese a no jugar mucho, "se siguió disfrutando de un equipo único".</p>
'),
    array('title' => 'Venancio Acosta', 'numero' => '', 'order' => 67, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]A los 12 años ya estaba en el equipo de Almoradí, empezó gracias al profesor de educación física que lo vio "largirucho" y dijo que era para el voleibol. "En nuestro pueblo hay mucha tradición y es un club con mucha historia. A pesar de ser un pueblo muy pequeño me ofreció una oportunidad". Antes de llegar al Guaguas, jugó dos temporadas en el Son Amar (Palma de Mallorca), su último año juvenil, campeones de España en el año 1985-86, y su primer año como jugador en categoría absoluta 1986-87, en la que se ganó la Liga y la Copa del Rey y debutó con la selección nacional.[/capitular]

<p>"Aterricé en 1987 en el García San Román de la mano de Juan Ruiz Ramos, llegué al Guaguas en un momento de pleno crecimiento y desarrollo del club. Más bien un jugador por consagrar, diría yo, era muy joven y con poca experiencia, pero con muchas ganas y dispuesto a crecer, a pesar de estar ya en el equipo nacional. Desde ese momento comenzó a escribirse una historia única y formar parte de ella siempre ha sido un honor".</p>

[cita_editorial author="Venancio Acosta"]Deben darse muchos factores para que un grupo pase de ser un buen equipo a ser un equipo ganador y todo esto se dio con mucho esfuerzo por parte de todos, en un breve espacio de tiempo. Era un equipo con muchas ganas de ganar. Lo primero es que los componentes del grupo crean realmente en las posibilidades del equipo. Una cosa es lo que se dice, otra lo que se siente y otra lo que se hace. Hay que creer en uno mismo y creer en el compañero. En este sentido la confianza entre los principales componentes de nuestro grupo era absoluta.[/cita_editorial]

<p>"Después hay que crear un buen ambiente de trabajo, que no es diversión, sino comunicación fluida y franca, exigencia, respeto y ganas de sacrificarse. Y no hablo solo de echarle horas en el pabellón y el gimnasio sino de comer bien, descansar mucho y salir poco durante muchísimo tiempo. Nosotros nos exigíamos los unos a los otros en todos los sentidos".</p>

<p>"Todo lo vivido permanece intacto a pesar de los años, más allá de las victorias o derrotas, que forman parte indivisible de la vida del deporte de alta competición".</p>

<p>"Después de 30 años de aquellos primeros títulos se valora mucho más todo lo vivido. En aquel momento nuestra primera Copa del Rey fue muy especial, pero los recuerdos del Centro Insular lleno son imborrables, todo el mundo recuerda el partido frente al París Saint Germain, cuando quedaron más de 1.500 aficionados a las puertas. Lo más bonito es prepararse, crecer, madurar, luchar, cuidarse, esforzarse, preocuparse, sufrir, perder, ganar... Y hacerlo uno y otro día, eso es lo difícil y lo atractivo".</p>

<p>"En Gran Canaria conocí a mi mujer, grandísima jugadora mexicana de voleibol, vimos crecer a nuestra hija Danira Costa, jugadora de Superliga y de Selección Nacional. Completé mi formación en la Universidad de Las Palmas de Gran Canaria, siendo jugador del Guaguas participé en los Juegos Olímpicos de Barcelona... No podía pedir más".</p>

<p>"A día de hoy puedo asegurar que la afición grancanaria fue determinante, maravillosa, nos transmitía la energía necesaria para cada momento. Nos enseñó a entregarnos en cuerpo y alma y eso lo valoraban. La afición nos hizo creer, crecimos juntos, convivimos y compartimos sus costumbres y aprendimos a defender con profesionalidad y orgullo los colores de la tierra canaria".</p>

<p>"Recuerdo con mucho cariño la compañía de tantos amigos y amigas fuera de la pista. Fueron un pilar fundamental para seguir adelante, gracias a la suma de pequeños esfuerzos repartidos día a día durante más de 14 años. Ellos son parte de mi familia y espero llegar a todos sin tener que nombrarlos".</p>

[cita_editorial author="Venancio Acosta"]Te enseña el valor del sentimiento de pertenencia, del sentido de identidad. En ese equipo había personas que influyeron de manera muy importante en mi vida. Esa época y el voleibol marcaron mi vida, se grabó en mí a fuego, con pasión, se lleva en la sangre. Hasta hace muy poco pensé qué era mi vida y gracias a Dios he descubierto que solo es parte de ella.[/cita_editorial]

<p>"Después de jugar continué durante más de 14 años como entrenador de diferentes equipos. Pude disfrutar como segundo entrenador de la Selección Nacional en los Juegos Olímpicos de Sídney (2000) y de la consecución del Campeonato de Europa en Moscú (2007)".</p>

<p>"Antes de despedirme quisiera enviar un caluroso saludo a todos los compañeros que han pasado por este gran Club, especialmente a Miguel Ángel Falasca, que dejó un vacío imposible de cubrir en nuestros corazones. A Paco Sánchez Jover, mi mentor, por tantos años a su lado. ¡Gracias maestro! A mi entrañable amigo Tomás Álvarez Vera, por su nobleza y sincera amistad. ¡Gracias hermano! Querido Juan Ruiz, mucha fuerza y mucho ánimo en el nuevo proyecto Club Voleibol Guaguas".</p>
'),
    array('title' => 'Antonio Miralles', 'numero' => '', 'order' => 68, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Fue otro de los fichajes estelares con los que se puso el punto de partida del mejor Guaguas de siempre, el que encadenó títulos sin parar entre finales de los ochenta e inicios de los noventa. "Paco Sánchez Jover era el líder absoluto del voleibol español. Y cuando decidió venir al Guaguas era señal de que algo grande venía en camino. Alguien como él no se iba a ir a cualquier sitio. Fue fácil que, al igual que hizo Venancio Costa, me decidiera". Así justifica su elección por la entidad grancanaria Antonio Miralles (Alicante, 1965), otra de las adquisiciones de época. Venía de un Palma campeón de Liga y Copa y también colgaba de su cuello el oro en los recientes Juegos del Mediterráneo conquistado con España (junto a Costa) y podía elegir destino. Y un Guaguas "de mitad de la tabla" entonces terminó convirtiéndose para él en un club en el que enraizaría "de una manera inimaginable".[/capitular]

<p>"Llegué muy joven, en 1987, y empujado, además de por querer ganar títulos, como me acostumbraron desde niño con una mentalidad en la que no vale ser segundo, por el hecho de que aquí se podía estudiar Educación Física, la carrera que terminaría completando y que siempre fue mi aspiración para formarme. En ese momento ayudó todo y me vi jugando en el Guaguas pese a que creo que terminé llegando porque el deseo de Juan Ruiz, que era Sixto Jiménez, no pudo ser. Con todo, me sentí importante desde el primer momento en un proyecto que no paró de ir hacia arriba. Encontramos una buena base en Camarero, Jorge Ramón... Y se fueron añadiendo retoques de una calidad enorme como Willock o el Chava. No podía acabar de otra forma teniendo el equipazo que teníamos, por mucho que fuese muy especial levantar Ligas y Copas", reconoce.</p>

<p>El Zorro, apelativo que le puso el técnico Miguel Ocón por sus rasgos faciales, permaneció en la plantilla hasta el año 1992, cuando decidió enrolarse en el Gáldar, pero regresó en 1995, luego de superar una grave lesión de rodilla, para cumplir un ciclo de dos años más y completar siete como jugador, en el que añadió una Copa del Rey más al palmarés que atesoró con la camiseta amarilla: 3 Ligas, 5 Copas y 1 Supercopa.</p>

[cita_editorial author="Antonio Miralles"]Me viene a la memoria la primera Copa del Rey porque coincidió con época de carnavales y el ambiente era indescriptible. Un gentío tremendo, bombos sonando, un CID a reventar, el final deseado. Fue el inicio y eso queda para siempre. Encima se la ganamos al Palma, que eso ya eran palabras mayores.[/cita_editorial]

<p>Asegura que disfrutó "una barbaridad" formando parte de generaciones irrepetibles, en las dos etapas diferenciadas que cumplimentó: "Hice la mili en 1991 con Camarero y coincidimos con Rafa, que era un delantero de la UD Las Palmas. Nos conocían más a nosotros que a los jugadores de fútbol. Logramos que la gente se interesara por el voleibol, se hablara del equipo, del club. Claro que, en el deporte profesional, pasa lo mismo en todas las disciplinas: cuando ganas interesas y cuando no lo haces, acabas cayendo en el olvido. Pero, al menos, mientras eso duró, fue algo impresionante y que, efectivamente, nos hizo sentir muy especiales".</p>

<p>En Miralles el escudo y la tierra se quedaron para siempre y ahí permanecen: "Aquí terminé los estudios universitarios, aquí me casé, aquí nacieron mis hijos, trabajé en la docencia, también dentro del club... Imposible que Gran Canaria me pudiese dar más después de mi ciclo como jugador profesional en el que el balance fue magnífico".</p>

<p>A las lecciones de talento que dejó sobre la pista colaborando en aumentar el prestigio del club, añadió una posterior experiencia como entrenador en el Guaguas como auxiliar de Benjamín Vicedo, primero, y, posteriormente, de David Rodríguez. Fueron cinco años en total en la banda con balance, a su parecer, "bastante bueno si se atienden las circunstancias del momento".</p>

<p>"Con Benjamín teníamos un grupo muy joven, que había moldeado Paco Sánchez Jover como los hermanos Cabrera, Raúl... Vivimos un periodo extraño, en el que las cosas no salieron como esperábamos. Luego, con David, manejando un presupuesto muy limitado, hilando muy fino en los fichajes, dimos la cara ante los mejores y el nivel competitivo fue enorme. Recuerdo ganarle a equipos como el Montpellier, que tenía unas posibilidades económicas que triplicaban las nuestras, llegar a las semifinales en Europa, discutirle el título de España al Almería, al que le ganamos los dos partidos de local en el play-off. Un subcampeonato que supo a título... Tuvo mucho mérito hacer lo que hicimos con un grupo de jugadores que dieron todo y más de lo que llevaban dentro", ensalza.</p>

<p>Fue una vida "diferente" a la de jugador y en la que "todo se sufre más", pero de la que "también se sacan conclusiones positivas", pese a que en el año 2006 decidió irse porque "las cosas empezaron a ponerse demasiado mal", anticipo de lo que terminaría derivando en la desaparición del Guaguas.</p>

<p>"Dediqué más de diez años de mi vida al Guaguas y me siento orgulloso de que haya sido así. Son demasiadas vivencias especiales que justifican todo lo vivido, todos los sacrificios, todos los esfuerzos, aunque es verdad que siempre predominaron los momentos felices. Nos sentíamos unos elegidos. Ahora contemplo con ilusión que, con Juan Ruiz, el mismo presidente que logró lo que logró, regrese la entidad con fuerza. No lo ha podido hacer mejor, fruto de un trabajo excepcional de sus dirigentes, jugadores y técnicos", concluye.</p>
'),
    array('title' => 'Chava González', 'numero' => '', 'order' => 69, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Un saque suyo terminó derivando en punto de partido y título histórico para el Guaguas, con aquella Copa del Rey de 1989 ante el Palma que estrenó el palmarés del club. Así quedó para siempre asociado Salvador González, Chava, (Mazatlán, México, 1958) a una de las explosiones de felicidad más atronadoras y recordadas del Centro Insular, abarrotado en un partido irrepetible. Más de treinta años después, todavía conserva frescos en la memoria detalles de todo lo que vino tras la consumación de un triunfo celebrado entre lágrimas y emociones.[/capitular]

[cita_editorial author="Chava González"]Jamás imaginé que viviría algo así porque, cuando me ficharon, lo que me dijeron es que la aspiración era ganarle algún partido al Palma. Para nada se mencionó la posibilidad de levantar trofeos. La pista llena de gente, todo el mundo tocaba el cielo al sentirnos campeones, el abrazo con los compañeros, Juan Ruiz llorando como un niño... Son momentos que quedan para toda la vida, grabados a fuego. De lo mejor que me ha pasado, indudablemente.[/cita_editorial]

<p>Chava llegó a Gran Canaria en el verano de 1988 e invitado por el club, junto a su compatriota y que sería el entrenador Sergio Hernández, para pasar un periodo de pruebas. "Danira Aragón, que se terminaría convirtiendo en la mujer de Venancio Costa, era una de las mejores voleibolistas de mi país y, cuando le preguntaron referencias de gente que conociera para unirse al proyecto, nos recomendó. Vinimos por las valoraciones que ella dio de nosotros. Por mi parte, era el capitán del equipo nacional de México, llevaba más de una década compitiendo en eventos internacionales. Pero, por lo que fuera, no me conocían lo suficiente. Había manejado posibilidades en Francia e Italia que no se concretaron y, cuando llegó esta, no me lo pensé. Y más al ver que Paco Sánchez Jover, que era la imagen del voleibol español en el mundo, era uno de los jugadores del Guaguas".</p>

<p>Su adaptación e integración al club y a Gran Canaria fueron "instantáneas", como admite. "Necesitaban un buen receptor y era una posición que dominaba porque, además, al haber hecho mucho vóley playa, me había habituado a recibir con dos compañeros. Paco era el opuesto y teníamos dos buenos centrales. No puedo olvidarme de Willock, que era un pedazo de jugador. En suma, logró moldearse un bloque muy compacto y coordinado que funcionó desde el principio", describe.</p>

<p>"No olvido un aspecto esencial que fue la absoluta implicación de la directiva, con Juan Ruiz a la cabeza, en brindarnos cuidados, apoyos y atenciones. Para un jugador profesional es muy importante sentir, en determinados momentos, la cercanía de la dirigencia, de sus superiores. En este caso, así se dio", añade.</p>

<p>Y, además de su rendimiento inmediato, aportó el compromiso de "responder a la confianza": "Amaba la camiseta, mi empatía con el club, con todo lo que tuviera que ver con el Guaguas, era absoluta. Porque no me hicieron un español más, me hicieron un canario, uno de los suyos. Moría y mataba por ese vestuario. De hecho guardo en casa muchísimos recortes de periódicos, equipaciones y recuerdos porque, para mí, ver todo eso supone volver a la felicidad".</p>

<p>Chava no maneja dudas al asegurar que las dos campañas que vivió como jugador del Calvo Sotelo, 1988-89 y 1989-90, pusieron el punto culminante a su carrera, porque "fue imposible mejorar" el bagaje de esos años. "No recuerdo haber disfrutado más dentro y fuera de la cancha. Llegar a un club que no había ganado nada y colaborar en lograrlo fue algo fabuloso. Siempre desde un trabajo enorme, un sacrificio diario tremendo. Todo lo que conseguimos nos lo ganamos a pulso. Pienso que se hizo justicia con el crecimiento y méritos de un gran equipo que se forjó en la unión y el respeto, con cada jugador adaptado a su rol y asumiendo sus responsabilidades. Una ejecución perfecta de la labor de un colectivo".</p>

<p>En el verano de 1989, coincidiendo con la histórica llegada de los polacos Klos y Golec, llegó a figurar como entrenador provisional del equipo tras la marcha de Hernández y la posterior llegada de Robert Croteau y en un acto de servicio a la entidad: "Me pidieron que ayudara en la dirección, algo que hice junto a Paco Sánchez Jover, y con naturalidad, sabiendo que era un momento particular y a la espera que de viniera otro preparador. Todo lo que estuviera en mi mano por favorecer a la institución, estaba de más pedirlo".</p>

<p>"El cupo de extranjeros me impidió seguir más tiempo. Pero el Guaguas y Gran Canaria, con mi posterior ciclo en el Gáldar, van metidos en mi corazón de por vida. Saber que fui parte de aquella historia tan bonita, haber dejado tantas amistades allá y ver mi nombre junto a los de otros compañeros presente en la memoria supone para mí una satisfacción indescriptible", finaliza.</p>
'),
    array('title' => 'Sandeep Sharma', 'numero' => '', 'order' => 70, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]Fue en un partido de Copa de Europa: "En Polonia, ante el Olstyn, en mi primera temporada en el Guaguas. Habíamos ganado en la ida por 3-1 y teníamos el pase encarrilado porque éramos mejores que ellos. Hacía un frío terrible. Oía que la gente cuando yo tocaba la pelota reaccionaba de manera diferente. La verdad es que me estaba saliendo un gran partido. Edelstein decide sentarme junto a otros compañeros al estar todo resuelto cuando ganamos dos sets porque nos esperaba luego un partido muy importante en Almería y quería dar descansos. Pero, de repente, me piden que vuelva, que debía seguir jugando porque, según me enteré después, el público quería verme. Por la megafonía del pabellón, que estaba lleno, repetían que si nadie había visto nunca a un hindú jugar al voleibol que esa era la oportunidad. Y lo decían desde el respeto, porque me aplaudieron y, después del partido, en la cena con la directiva visitante me felicitaron. También cuando salimos los chicos a dar una vuelta a una discoteca como premio de haber logrado la clasificación. Allí me bautizaron como el Tigre de Bengala".[/capitular]

<p>Sandeep Sharma (Nangal, India, 1966) no ha podido olvidar aquel partido de la campaña 1991-92 en el que su nacionalidad, por sí misma, derivó en una expectación inusitada. Su juego y maestría terminaron elevándole a los cielos a ojos de miles de espectadores que no dudaron en ovacionarle pese a pertenecer a las filas del adversario. Esa admiración fue episódica en Polonia pero más arraigada e intensa en el Centro Insular durante su estancia en el Guaguas (1991-1993 y 1995-96) en la que, además de llenar su palmarés de títulos, se ganó un hueco en la historia del club.</p>

[cita_editorial author="Sandeep Sharma"]Era el capitán de la selección de mi país y ya me había enfrentado varias veces a Paco Sánchez Jover en encuentros internacionales. Me encantaba su manera de jugar. Era de los mejores que había visto. Por eso cuando me llegó la posibilidad de fichar por el Guaguas, sabiendo que ya habían hecho grandes cosas y tenían un equipazo, me gustó la posibilidad de poder estar junto a él. Estaba en el Cisneros, pero no me lo pensé. Y pienso que fue un acierto, porque me adapté muy bien al grupo y tuve unos compañeros que eran increíbles.[/cita_editorial]

<p>Opuesto de enorme poderío, adaptable a lo que se requiriera de él, "siempre con mentalidad de equipo y de ayudar", Sharma alcanzó un nivel de rendimiento que justificó con creces la apuesta que hicieron para integrar el trío de extranjeros con Golec y Nilsson, en su primer año. "Fue todo muy bien desde el principio, con un vestuario sano y comprometido. Los resultados fueron increíbles, el apoyo de la gente también. La verdad es que era positivo cuando fiché pensando que todo podría funcionar, pero a ese nivel, con dos dobletes consecutivos, ya era demasiado".</p>

<p>Sharma, considerado en su país como una leyenda del voleibol y con multitud de condecoraciones que así lo acreditan, no tiene dudas acerca de su sentimiento de pertenencia a una entidad en la que se sintió "como en ninguna otra parte".</p>

<p>"Me fui a Soria y volví porque era aquí donde más quería estar. Incluso no me importó nacionalizarme si con eso se facilitaba que pudiese seguir jugando en España y en el Guaguas. Quisieron llevarme a la selección española, pero no lo veía bien por mi sentimiento patriótico. Hubiese sido como una traición a mi país ponerme la camiseta de otra selección", remarca.</p>

<p>En su última campaña, en la que se obtuvo la Copa del Rey de 1996 a las órdenes de Paco Sánchez Jover, también disfrutó, como en las anteriores, del "clima especial" que se generaba con cada actuación del equipo, pese a que la etapa más brillante había quedado atrás. "Era de los veteranos y mi misión, además de dar rendimiento, era la de aportar experiencia. Para mí fue una motivación especial regresar y volver a ganar un título porque me sentía muy identificado aunque muchos compañeros de la primera etapa ya no estuviesen", revela.</p>

<p>"Fueron tres años pero de enorme intensidad que dejaron muy buen recuerdo en mi corazón. Juan Ruiz era un presidente que estaba muy cerca de nosotros, siempre soñando en grande. Para un jugador es importante que el jefe se involucre, se alegre con las victorias y sufra con las derrotas. Y eso lo teníamos con Juan. Un grupo maravilloso de jugadores en el que todos éramos amigos, todos nos ayudábamos. Pudimos mostrar nuestro nivel, ganar campeonatos, hacer un voleibol muy bueno y que permitió darle muchas alegrías a la afición. Pienso que todo salió perfecto. Nos quedó pendiente ganar algo en Europa, pero yo no cambio nada de lo que viví en el Guaguas. Profesional y personalmente fue algo magnífico para mí. Experiencias únicas. Firmaría que todo fuese igual si tuviera que repetirse la historia", concluye.</p>
'),
    array('title' => 'Juan José Cardona', 'numero' => '', 'order' => 71, 'show_marker' => false, 'parent_ref' => 'cap08',
        'content' => '
[capitular]En su etapa de concejal de Movilidad, Transporte y Tráfico del ayuntamiento de Las Palmas de Gran Canaria, cargo que le otorgaba la presidencia de Guaguas Municipales, la empresa municipal de transporte público, Juan José Cardona (Las Palmas de Gran Canaria, 1962) se significó por ser una de las autoridades públicas que más se implicó en procurarle apoyo y financiación al Guaguas de finales de los noventa. Así se reconoce y valora en el club y con hechos, además, incontestables. En junio de 1997 propició la renovación del patrocinio que siempre ha sido seña de identidad y no dudó, tampoco, en vivir en directo la Final Four de la Recopa de 1998 en Cuneo (Italia). "Siempre me gustó el voleibol y lo practiqué en mi juventud en Arucas. Pero es que, además, el Guaguas tuvo una representatividad e importancia en Las Palmas de Gran Canaria que le hacía llenar el Centro Insular. Palabras mayores porque hablamos de 5.000 espectadores o más en una disciplina que, con todo el respeto se diga, no es de las denominadas mayoritarias, muy por debajo siempre del fútbol y del baloncesto", detalla.[/capitular]

<p>Cardona afirma que el impacto del equipo "traspasó el ámbito deportivo" para convertirse en "una marca de éxito y representatividad", lo que, como gestor público, "no podía desatenderse".</p>

[cita_editorial author="Juan José Cardona"]Tengo que reconocer que todo el grupo de gobierno del ayuntamiento, con José Manuel Soria al frente, me brindó apoyo cuando propuse que se recuperara el histórico patrocinio de Guaguas Municipales para el club. Con Juan Ruiz en la presidencia, todo un ejemplo de honestidad y competencia, y Paco Sánchez Jover en el banquillo, un símbolo, la credibilidad era total.[/cita_editorial]

<p>"El fin de ese dinero destinado a la entidad era más bien social, pues no hay que olvidar la labor de cantera desarrollada, con muchos jugadores que terminaron llegando a la selección española. En suma, fue una decisión justificada, proporcionada, celebrada y merecida. Llegó en un momento oportuno, en el que la entidad lo requería y allí estuvimos. A mí me reconfortó", argumenta.</p>

<p>Y añade: "Hubo un retorno de sobra a la confianza municipal porque el proyecto era ejemplar. Hay que recordar que la finalidad de una empresa de transporte público no es ganar dinero, es servir. Y este tipo de servicio, con el mecenazgo de un club al que ya se le asociaba desde años anteriores, fue una manera de cumplir con este propósito. La promoción que le dio a nuestra isla dentro y fuera de España era impagable en aquellos años".</p>

<p>El que fuera alcalde de la ciudad tiempo después no oculta que el regreso del Guaguas le parece "una iniciativa preciosa" y que, en su opinión, "colaborará en hacer más grande y respetado el deporte grancanario".</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 09: EL RELEVO GENERACIONAL
    // ═══════════════════════════════════════════════
    array(
        'title' => 'El relevo generacional',
        'numero' => '09',
        'order' => 75,
        'show_marker' => true,
        'ref_id' => 'cap09',
        'hero' => array(
            'image' => libro_img('hero-cantera.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.80)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'left',
            'vertical' => 'center',
            'height' => '480px',
            'title_lines' => array(libro_hero_line('EL RELEVO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('GENERACIONAL', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]Cada generación del Guaguas ha sido el eslabón de una cadena ininterrumpida de talento canario. El relevo generacional ha sido una constante en la vida del club, desde los pioneros del Calvo Sotelo hasta los actuales jugadores de la cantera.[/capitular]
[imagen_contenido src="'),
    array('title' => 'Alexis Valido', 'numero' => '', 'order' => 76, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Antonio Sánchez', 'numero' => '', 'order' => 77, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Daniel Castañeda', 'numero' => '', 'order' => 78, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Juan Carlos Vega', 'numero' => '', 'order' => 79, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Hermanos Cabrera', 'numero' => '', 'order' => 80, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Níchel Gómez', 'numero' => '', 'order' => 81, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Raúl Dávila', 'numero' => '', 'order' => 82, 'show_marker' => false, 'parent_ref' => 'cap09',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 10: UNA TRANSICIÓN DOLOROSA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Una transición dolorosa',
        'numero' => '10',
        'order' => 85,
        'show_marker' => true,
        'ref_id' => 'cap10',
        'hero' => array(
            'image' => libro_img('hero-transicion.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.40)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 50,
            'icon_height' => 50,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('UNA TRANSICIÓN', '#8faabe', '', 'black'), libro_hero_line('DOLOROSA', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]Los años posteriores a la marcha de Juan Ruiz fueron los más convulsos en la historia del club. La inestabilidad directiva, los problemas económicos y la pérdida progresiva de competitividad culminaron en el peor desenlace posible: la desaparición temporal del equipo en 2009.[/capitular]
[imagen_contenido src="'),
    array('title' => 'Juan Ruiz traspasa sus poderes', 'numero' => '', 'order' => 86, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'La estabilidad imposible', 'numero' => '', 'order' => 87, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Camino del fatídico 2009', 'numero' => '', 'order' => 88, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'El peor desenlace posible', 'numero' => '', 'order' => 89, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'La cronología', 'numero' => '', 'order' => 90, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'David Rodríguez', 'numero' => '', 'order' => 91, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Joel Sotelo', 'numero' => '', 'order' => 92, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Pedro Cuarental', 'numero' => '', 'order' => 93, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Marcos Dreyer', 'numero' => '', 'order' => 94, 'show_marker' => false, 'parent_ref' => 'cap10',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 11: TÍTULOS PARA UNA GRAN HISTORIA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Títulos para una gran historia',
        'numero' => '11',
        'order' => 100,
        'show_marker' => true,
        'ref_id' => 'cap11',
        'hero' => array(
            'image' => libro_img('hero-trophies.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.75)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('TÍTULOS PARA', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('UNA GRAN', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('HISTORIA', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]El palmarés del CV Guaguas es el más brillante del voleibol español. Nueve Ligas, nueve Copas del Rey, cinco Supercopas y una Copa Ibérica conforman un historial de éxitos que ningún otro club del país ha igualado.[/capitular]
[imagen_contenido src="'),
    array('title' => 'Copa del Rey 1989', 'numero' => '', 'order' => 101, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 1989-90', 'numero' => '', 'order' => 102, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 1990-91', 'numero' => '', 'order' => 103, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 1991', 'numero' => '', 'order' => 104, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 1991-92', 'numero' => '', 'order' => 105, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 1992', 'numero' => '', 'order' => 106, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 1992-93', 'numero' => '', 'order' => 107, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 1993', 'numero' => '', 'order' => 108, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 1993-94', 'numero' => '', 'order' => 109, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 1996', 'numero' => '', 'order' => 110, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Supercopa de España 1993-94', 'numero' => '', 'order' => 111, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 1997', 'numero' => '', 'order' => 112, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 2021', 'numero' => '', 'order' => 113, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 2020-21', 'numero' => '', 'order' => 114, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Supercopa de España 2021', 'numero' => '', 'order' => 115, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 2023', 'numero' => '', 'order' => 116, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa Ibérica 2023', 'numero' => '', 'order' => 117, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Supercopa de España 2023', 'numero' => '', 'order' => 118, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 2024', 'numero' => '', 'order' => 119, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 2024', 'numero' => '', 'order' => 120, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Supercopa de España 2024', 'numero' => '', 'order' => 121, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Copa del Rey 2025', 'numero' => '', 'order' => 122, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Liga 2025', 'numero' => '', 'order' => 123, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Supercopa de España 2025', 'numero' => '', 'order' => 124, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del capítulo próximamente.</p>'),
    array('title' => 'Joselu Sánchez', 'numero' => '', 'order' => 125, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 12: VUELVE EL GRAN GUAGUAS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Vuelve el gran Guaguas',
        'numero' => '12',
        'order' => 130,
        'show_marker' => true,
        'ref_id' => 'cap12',
        'hero' => array(
            'image' => libro_img('hero-celebracion.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.75)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 70,
            'icon_height' => 70,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '500px',
            'title_lines' => array(libro_hero_line('VUELVE', '#D4AF37', '', 'black'), libro_hero_line('EL GRAN', '#FFFFFF', '', 'black'), libro_hero_line('GUAGUAS', '#D4AF37', '', 'black')),
        ),
        'content' => '[capitular]En 2020, cuando el club se encontraba de nuevo al borde del abismo, Juan Ruiz regresó para devolver al Guaguas a la élite. Su vuelta fue recibida con esperanza y emoción por una afición que no había olvidado los años gloriosos.[/capitular]
[imagen_contenido src="'),
    array('title' => 'Un paso por aclamación', 'numero' => '', 'order' => 131, 'show_marker' => false, 'parent_ref' => 'cap12',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Presidentes', 'numero' => '', 'order' => 132, 'show_marker' => false, 'parent_ref' => 'cap12',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Entrenadores', 'numero' => '', 'order' => 133, 'show_marker' => false, 'parent_ref' => 'cap12',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 13: DEL CID AL ARENAS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Del CID al Arenas',
        'numero' => '13',
        'order' => 140,
        'show_marker' => true,
        'ref_id' => 'cap13',
        'hero' => array(
            'image' => libro_img('hero-stadium.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.82)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'left',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('DEL CID', '#D4AF37', '', 'black'), libro_hero_line('AL ARENAS', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]Del Centro Insular de Deportes al Gran Canaria Arena: la evolución de la casa del voleibol grancanario. El CID fue durante décadas la catedral del voleibol en Canarias, un pabellón cuyo ambiente era temido por todos los rivales.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 14: LOS NUEVOS ÍDOLOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Los nuevos ídolos',
        'numero' => '14',
        'order' => 145,
        'show_marker' => true,
        'ref_id' => 'cap14',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.82)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 70,
            'icon_height' => 70,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '480px',
            'title_lines' => array(libro_hero_line('LOS NUEVOS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('ÍDOLOS', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]Una nueva generación de estrellas ha tomado el relevo en el Gran Canaria Arena. Los nuevos ídolos del Guaguas combinan talento internacional con la pasión local para escribir nuevos capítulos en la historia del club.[/capitular]
[imagen_contenido src="'),
    array('title' => 'Pablo Kukartsev', 'numero' => '', 'order' => 146, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Moisés Cézar', 'numero' => '', 'order' => 147, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Alejandro Fernández', 'numero' => '', 'order' => 148, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Guilherme Hage', 'numero' => '', 'order' => 149, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Jorge Almansa', 'numero' => '', 'order' => 150, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Texto del prólogo pendiente de redacción.</p>'),
    array('title' => 'Matt Knigge', 'numero' => '', 'order' => 151, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Paulo Renan', 'numero' => '', 'order' => 152, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Paolo Zonca', 'numero' => '', 'order' => 153, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Martín Ramos', 'numero' => '', 'order' => 154, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Io de Amo', 'numero' => '', 'order' => 155, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Nico Bruno', 'numero' => '', 'order' => 156, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Unai Larrañaga', 'numero' => '', 'order' => 157, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Walla Souza', 'numero' => '', 'order' => 158, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Jean Pascal', 'numero' => '', 'order' => 159, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),
    array('title' => 'Osmany Juantorena', 'numero' => '', 'order' => 160, 'show_marker' => false, 'parent_ref' => 'cap14',
        'content' => '<p>Contenido del subcapítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 15: EL IMPACTO DEL ESCUDO
    // ═══════════════════════════════════════════════
    array(
        'title' => 'El impacto del escudo',
        'numero' => '15',
        'order' => 165,
        'show_marker' => true,
        'ref_id' => 'cap15',
        'hero' => array(
            'image' => libro_img('hero-stadium.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.88)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('EL IMPACTO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DEL ESCUDO', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]El escudo del CV Guaguas es mucho más que un símbolo deportivo. Representa la identidad de un club que ha trascendido el voleibol para convertirse en un referente cultural de Gran Canaria y del deporte canario.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 16: LA DIRECTIVA Y EL FUTURO QUE VIENE
    // ═══════════════════════════════════════════════
    array(
        'title' => 'La directiva y el futuro que viene',
        'numero' => '16',
        'order' => 170,
        'show_marker' => true,
        'ref_id' => 'cap16',
        'hero' => array(
            'image' => libro_img('hero-estatutos.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.85)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('LA DIRECTIVA', '#D4AF37', '', 'black'), libro_hero_line('Y EL FUTURO', '#FFFFFF', '', 'black'), libro_hero_line('QUE VIENE', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]Detrás de cada título y cada logro deportivo hay una estructura directiva que ha trabajado incansablemente por el bien del club. Desde los fundadores del Calvo Sotelo hasta la actual junta directiva, la gestión del Guaguas ha sido un ejemplo de compromiso y sacrificio.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 17: MÁS HONORES
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Más honores',
        'numero' => '17',
        'order' => 175,
        'show_marker' => true,
        'ref_id' => 'cap17',
        'hero' => array(
            'image' => libro_img('hero-trophies.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.80)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('MÁS', '#D4AF37', '', 'black'), libro_hero_line('HONORES', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]El futuro del Guaguas se construye en la cantera. Los equipos de categorías inferiores trabajan cada día para formar a los jugadores que, algún día, defenderán los colores amarillos en la máxima competición.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 18: EL GUAGUAS COMO EN LOS VIEJOS TIEMPOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'El Guaguas como en los viejos tiempos',
        'numero' => '18',
        'order' => 180,
        'show_marker' => true,
        'ref_id' => 'cap18',
        'hero' => array(
            'image' => libro_img('hero-celebracion.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.80)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'left',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('EL GUAGUAS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('COMO EN LOS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('VIEJOS TIEMPOS', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '<p>Contenido del capítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 19: EMPLEADOS Y TÉCNICOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Empleados y técnicos',
        'numero' => '19',
        'order' => 185,
        'show_marker' => true,
        'ref_id' => 'cap19',
        'hero' => array(
            'image' => libro_img('hero-stadium.jpg'),
            'overlay' => 'rgba(62, 39, 15, 0.82)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('EMPLEADOS', '#D4AF37', '', 'black'), libro_hero_line('Y TÉCNICOS', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]Un club no funciona solo con jugadores. Detrás de cada partido, cada entrenamiento y cada evento hay un equipo de profesionales que hace posible la maquinaria del CV Guaguas.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 20: LA PLANTILLA DEL CINCUENTENARIO
    // ═══════════════════════════════════════════════
    array(
        'title' => 'La plantilla del cincuentenario',
        'numero' => '20',
        'order' => 190,
        'show_marker' => true,
        'ref_id' => 'cap20',
        'hero' => array(
            'image' => libro_img('hero-celebracion.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.82)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('LA PLANTILLA', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DEL', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('CINCUENTENARIO', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]La temporada 2025-2026 marca el cincuentenario del Club Voleibol Guaguas. Una plantilla competitiva en cuatro frentes —Liga, Copa, Supercopa y Champions League— escribe las últimas líneas de esta historia de medio siglo de pasión por el voleibol.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 21: RECONOCIMIENTO DEL COLECTIVO ARBITRAL
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Reconocimiento del colectivo arbitral',
        'numero' => '21',
        'order' => 195,
        'show_marker' => true,
        'ref_id' => 'cap21',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.82)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'left',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('RECONOCIMIENTO', '#D4AF37', '', 'black'), libro_hero_line('DEL COLECTIVO', '#FFFFFF', '', 'black'), libro_hero_line('ARBITRAL', '#FFFFFF', '', 'black')),
        ),
        'content' => '<p>Contenido del capítulo próximamente.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 22: MIGUEL ÁNGEL RAMÍREZ
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Miguel Ángel Ramírez',
        'numero' => '22',
        'order' => 200,
        'show_marker' => true,
        'ref_id' => 'cap22',
        'hero' => array(
            'image' => libro_img('hero-stadium.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.85)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'left',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('MIGUEL ÁNGEL', '#D4AF37', '', 'black'), libro_hero_line('RAMÍREZ', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]Miguel Ángel Ramírez, presidente de la UD Las Palmas, ha sido una figura clave en el apoyo institucional al CV Guaguas. Su visión del deporte como motor de la sociedad canaria ha permitido que el club cuente con los recursos necesarios para competir al máximo nivel.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 23: A LA VANGUARDIA DE LA TECNOLOGÍA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'A la vanguardia de la tecnología',
        'numero' => '23',
        'order' => 205,
        'show_marker' => true,
        'ref_id' => 'cap23',
        'hero' => array(
            'image' => libro_img('hero-volleyball-match.jpg'),
            'overlay' => 'rgba(30, 30, 60, 0.85)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'right',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('A LA VANGUARDIA', '#D4AF37', '', 'black'), libro_hero_line('DE LA', '#FFFFFF', '', 'black'), libro_hero_line('TECNOLOGÍA', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]El CV Guaguas ha sido pionero en la comunicación digital dentro del deporte español. Su presencia en redes sociales, la producción de contenidos audiovisuales y la cobertura periodística propia han creado un modelo de referencia para otros clubes.[/capitular]
[imagen_contenido src="'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 24: SOCIOS Y ABONADOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Socios y abonados',
        'numero' => '24',
        'order' => 210,
        'show_marker' => true,
        'ref_id' => 'cap24',
        'hero' => array(
            'image' => libro_img('hero-celebracion.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.80)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('SOCIOS Y', '#D4AF37', '', 'black'), libro_hero_line('ABONADOS', '#FFFFFF', '', 'black')),
        ),
        'content' => '[capitular]La afición del Guaguas es el motor del club. Desde aquellos primeros espectadores en el patio del colegio hasta los miles de abonados que llenan el Gran Canaria Arena, los socios han sido el alma del proyecto deportivo más exitoso del voleibol español.[/capitular]
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
            'image' => libro_img('hero-estatutos.jpg'),
            'overlay' => 'rgba(212, 175, 55, 0.80)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'left',
            'vertical' => 'center',
            'height' => '450px',
            'title_lines' => array(libro_hero_line('EMPRESARIOS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DE LA TIERRA', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]El CV Guaguas ha contado siempre con el apoyo de empresarios canarios que creyeron en el proyecto. Desde Guaguas Municipales, el primer gran patrocinador, hasta las empresas que hoy respaldan al club, el tejido empresarial de la tierra ha sido pilar fundamental de la entidad.[/capitular]
[imagen_contenido src="'),

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

/**
 * Asegurar que el capítulo "Prólogos" tenga _numero_capitulo = '0'
 * Repara importaciones anteriores donde este meta podría faltar
 */
function libro_fix_prologos_numero() {
    $prologos = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => 1,
        'post_parent'    => 0,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => '_numero_capitulo',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => '_numero_capitulo',
                'value'   => '',
            ),
        ),
        'title'          => 'Prólogos',
    ));
    
    if (!empty($prologos)) {
        update_post_meta($prologos[0]->ID, '_numero_capitulo', '0');
    }
}
add_action('after_switch_theme', 'libro_fix_prologos_numero');
