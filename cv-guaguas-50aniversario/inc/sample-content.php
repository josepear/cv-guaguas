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
            if (!empty($cap['anclas_internas'])) {
                update_post_meta($post_id, '_anclas_internas', $cap['anclas_internas']);
            }
            
            // Save chapter number (strlen check: '0' is valid but empty() treats it as false)
            if (isset($cap['numero']) && strlen($cap['numero']) > 0) {
                update_post_meta($post_id, '_numero_capitulo', $cap['numero']);
            }
            
            // Save marker visibility
            update_post_meta($post_id, '_mostrar_marcador', isset($cap['show_marker']) ? ($cap['show_marker'] ? '1' : '0') : '1');

            // Save ocultar_titulo flag
            if (!empty($cap['ocultar_titulo'])) {
                update_post_meta($post_id, '_ocultar_titulo', '1');
            }
            
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
                if (!empty($hero['background_color'])) update_post_meta($post_id, '_hero_background_color', $hero['background_color']);
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
            'height' => '600px',
            'title_lines' => array(libro_hero_line('PRÓLOGOS', '#D4AF37', '', 'black')),
        ),
        'content' => '',
    ),
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
        'content' => '<p>Cincuenta años después de que en el patio de un colegio del barrio de Las Rehoyas se pusiera la semilla de lo que hoy es el Guaguas, aquí seguimos en pie y con una historia que nos enorgullece y se basa en superaciones, trofeos y reconocimiento tanto dentro como fuera de Canarias. He sido testigo de los grandes momentos de este club y eso me ha marcado la vida. Hace cuatro décadas encontré una entidad al borde de la desaparición y, partiendo desde la nada, construimos un proyecto ganador que fue bandera de Gran Canaria y nos regaló momentos inolvidables que, todavía, son recordados con orgullo. Supimos navegar, luego, entre situaciones menos favorables y que terminaron derivando en lo que nadie esperaba, esa desaparición dolorosa. Me tocó vivirlo desde fuera, pero, de igual manera, me llegó al alma. Sin embargo, ese borrón no hizo que el Guaguas cayera en el olvido. Todo lo contrario. He ahí su fuerza y valor. Sin estar físicamente, permanecía en la memoria de todos. Seguía siendo patrimonio sentimental de nuestra sociedad.</p>
<p>Por eso volvimos en 2020, iniciando un camino hoy más vigente que nunca y que se basa en títulos, transparencia, empatía con una masa social que no para de crecer, entendimiento con las instituciones públicas y una firme alianza con el empresariado de la tierra. Una atmósfera de credibilidad, de coherencia y de éxito, el que garantizamos cada temporada con los trofeos que pueblan nuestras vitrinas y que, también he decirlo, nos diferencian del resto de entidades isleñas. Ninguna otra ofrece semejante palmarés, mérito de todos y cada uno de los jugadores y empleados que han contribuido a la causa y que, en su totalidad, merecen el reconocimiento justo.</p>
<p>El Guaguas no para. Saboreamos el medio siglo de vida pero con la mirada puesta en el futuro, en mantener en lo más alto el legado que queremos dejar, lo que implica todo un desafío que afrontamos desde la humildad y el trabajo, desde el amor y la entrega por estos colores. No entendemos otro camino. Nos ha llevado a lo que somos y vamos a continuar bajo el mismo paradigma. Adaptándonos a los nuevos tiempos con la misma esencia de siempre.</p>'),
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
        'content' => '<p>De un tiempo a esta parte, nos hemos acostumbrado a hablar y a escribir sobre el Club Voleibol Guaguas como el club deportivo más laureado de Canarias. No en vano, ha ganado varias ligas, una decena de Copas del Rey, varias Supercopas de España y una Copa Ibérica. Triunfos que le han hecho merecedor de la Medalla de Oro de la ciudad de Las Palmas (2023) y del Premio al Deporte Canario 2024.</p>
<p>Todos estos triunfos no solo son muy merecidos, sino que son enormemente meritorios por lo que significan desde el punto de vista deportivo y por lo que nos enseñan sobre nuestra ciudad, sobre el valor de los proyectos y las personas que los hacen posible.</p>
<p>Por eso, quiero destacar que hoy celebramos cincuenta años de historia de un club deportivo, el Club Voleibol Guaguas, pero también celebramos una historia de resiliencia, de memoria y de aprendizaje colectivo. Y, como alcaldesa de la ciudad, me interesan mucho ambas historias.</p>
<p>La historia del voleibol comenzó en el Colegio Calvo Sotelo, en el barrio de Las Rehoyas, donde hace medio siglo un grupo de jóvenes, profesores y entusiastas del deporte empezó a construir algo que nadie imaginaba hasta dónde llegaría.</p>
<p>Desde aquel patio de colegio, el proyecto comenzó a crecer, y lo que empezó como una iniciativa local fue convirtiéndose poco a poco en uno de los grandes proyectos deportivos del voleibol español. Pero, como ocurre con muchas historias deportivas, el camino no fue siempre fácil. Llegaron momentos difíciles. Cambiaron las condiciones económicas, el proyecto se debilitó y finalmente desapareció.</p>
<p>Durante un tiempo, pareció que aquella historia que había nacido en Las Rehoyas había llegado a su final. Sin embargo, lo que se había construido durante décadas no era solo un club. Era una memoria colectiva. Era una cultura deportiva profundamente arraigada en la ciudad. De ese aprendizaje nació el Club Voleibol Guaguas: un nuevo nombre para una historia que siempre ha estado vinculada a esta ciudad; un nuevo club con muchas lecciones aprendidas.</p>
<p>Hoy el equipo vuelve a competir al máximo nivel, vuelve a ganar títulos y vuelve a proyectar el nombre de Las Palmas de Gran Canaria en el voleibol nacional y europeo. Pero lo verdaderamente importante es que ese proyecto sigue conectado con su origen.</p>
<p>Y por eso, cuando hoy celebramos la historia del Club Voleibol Guaguas, también estamos celebrando la historia de un colegio, de un barrio y de una ciudad que supieron convertir el deporte en una forma de construir comunidad.</p>
<p>Me gustaría que esta celebración sirviera para recordarnos algo que este club nos ha enseñado: que el trabajo en equipo puede transformar una idea sencilla en una gran historia.</p>'),
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
        'content' => '<p>Llegué en 2020 al CV Guaguas sin saber que aquí iba a encontrar mi casa. Eran, entonces, tiempos de incertidumbre, sin la certeza de que el proyecto iba a desarrollarse con el éxito y la plenitud que se ha visto posteriormente. Títulos, destacadas participaciones en competiciones europeas hasta brillar en la Champions y un cariño de la afición para el que no encuentro palabras... Sin duda, el trabajo de nuestro presidente, incansable año a año, tiene mucho que ver en que el club sea hoy lo que es: el más laureado de Canarias, la referencia nacional y, de manera paulatina, un escudo respetado en todo el continente.</p>
<p>Para mí supone un honor ser el capitán de este equipo y aportar toda mi experiencia a los compañeros. Siempre con los cambios inevitables de cada temporada, y con nuestro entrenador como líder indiscutible, puedo asegurar que todas las conquistas que hemos logrado, tanto en los tiempos en el CID como ahora en el Gran Canaria Arena, se han sustentado en vestuarios unidos y profesionales, comprometidos con lo que representamos y sabiendo que defendemos una camiseta histórica en la que no se puede negociar un gramo de esfuerzo.</p>
<p>En este cincuentenario de nuestra entidad nos invade la satisfacción por haber podido culminar una campaña 2025-26 con dos títulos para mayor prestigio del Guaguas y, también, el deseo de continuar escribiendo su historia como hasta ahora. Con el máximo sacrificio y la ambición de seguir cumpliendo objetivos y sueños.</p>'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 01: DEL PATIO DEL COLEGIO A DIVISIÓN DE HONOR
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Del patio del colegio a la División de Honor',
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
            'height' => '600px',
            'title_lines' => array(libro_hero_line('DEL PATIO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DEL COLEGIO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('A LA DIVISIÓN', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DE HONOR', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => ''),
    array('title' => 'Del patio del colegio a la División de Honor', 'numero' => '', 'order' => 13, 'show_marker' => false, 'parent_ref' => 'cap01',
        'hero' => array(
            'image' => libro_img('1cap_pati_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center 30%',
            'title_lines' => array(libro_hero_line('DEL PATIO DEL COLEGIO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('A LA DIVISIÓN DE HONOR', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[seccion_header]Las horas extraescolares con Francisco Rodríguez[/seccion_header]

[capitular]Antes que el club fue el colegio. Porque el Calvo Sotelo nació del centro educativo del mismo nombre que se inauguró para el curso escolar 1967-68 en el barrio de Las Rehoyas, en la época punto de convergencia de la zona alta de Las Palmas de Gran Canaria y con familias de extracción social y economías precarias. "Gentes muy humildes, pero no necesariamente problemáticas. Se veían situaciones complicadas por la calle, no se puede negar. Pero de mi experiencia como maestro en el trato con padres y alumnos guardo un gran recuerdo por los esfuerzos y sacrificios que hacían para que los niños completaran su educación. No había medios materiales, pero sobraba el orgullo y la capacidad de superación", rememora Felipe Nuez, quien desembarcó en esta escuela para desarrollar sus prácticas de magisterio sin saber que allí enraizaría y forjaría una leyenda deportiva que nadie podía esperar.[/capitular]

<p>Con todo, y según ha dejado documentado Miriam Quiroga en su libro \'Génesis y evolución del voleibol en Gran Canaria 1934/78\', las primeras influencias para introducir el juego del voleibol en el Calvo Sotelo corresponden a Francisco Rodríguez, profesor que, de manera experimental, fomenta su práctica en las horas extraescolares. La aceptación de su propuesta lúdica es inmediata, lo que permite crear, de modo informal, los primeros equipos para competir de manera interna y, con el tiempo, concurrir a competencias de ámbito local.</p>

<p>A la espera de que cale en categoría masculina, donde su introducción es más paulatina, las niñas toman la bandera y es la sección femenina la que inicia los pasos del Calvo Sotelo en los primeros torneos rivalizando con otros equipos. Y con resultados de impresión. Así, en los III Juegos Escolares Femeninos de la Enseñanza General Básica (EGB), correspondientes al curso 1971-72, el equipo infantil del Colegio Nacional Calvo Sotelo se impone a nivel provincial y regional, desplazándose en junio de 1972 hasta Málaga para disputar la fase final en la que se proclama campeón de España.</p>

<p>Y, desde la temporada 1972-73, participa en categoría infantil masculina en los Campeonatos Escolares Provinciales por iniciativa y empeño de la Asociación de Padres de Alumnos, presidida por José Celestino Luzardo, y también representada por Antonio Trejo, encargado de la imprenta del colegio, Guillermo Gil, director del centro, y los profesores Pardo y Miguel Nieves. El crecimiento es sostenido, como queda documentado con otro logro: el 18 de febrero de 1973, el equipo femenino de 2ª categoría juvenil, entrenado por Francisco Rodríguez, se proclama campeón provincial escolar tras ganar, en la cancha Eliseo Ojeda, al Instituto Isabel de España. Un guiño del destino: el partido fue arbitrado por Felipe Nuez, quien ya ha orientado sus pasos al voleibol como actividad complementaria a la que ejercía de profesor. Apenas un año después sería pionero al frente de la selección cadete de Las Palmas, germen del equipo sénior que iniciaría la andadura del Calvo Sotelo ya a nivel federado.</p>

<p>La creación, también en 1973, de un trofeo organizado por la propia escuela certifica la consolidación y crecimiento del voleibol en la rústica pista donde los alumnos ya se entregaban con entusiasmo y empeño en perfeccionar sus maneras y habilidades.</p>

[imagen_contenido file="1cap_pati_foto15.jpg" caption="Equipo B masculino de la clase 20ª del Colegio Nacional Calvo Sotelo que quedó campeón del Torneo Interior organizado por el mismo centro educativo en el curso 1968-69. El profesor Francisco Rodríguez, pionero en la enseñanza del voleibol ese mismo año, aparece junto a los jóvenes aprendices. (Foto cortesía de Miriam Quiroga)."]

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

[imagen_contenido file="1cap_pati_foto10.jpg" caption="Equipo infantil femenino del Calvo Sotelo, que se proclamó campeón de España de los III Juegos Deportivos de la Enseñanza General Básica que se disputaron en el curso 1971/72. (Foto cortesía de Miriam Quiroga y de su libro \u2018Génesis y evolución del voleibol en Gran Canaria 1934/1978\u2019)."]

[imagen_contenido file="1cap_pati_foto_juvfem7475.jpg" caption="Plantilla del juvenil femenino de la temporada 1974/75, entrenada por Francisco Rodríguez, que se proclamó campeón provincial escolar de su categoría. (Foto cortesía de Miriam Quiroga y de su libro \u2018Génesis y evolución del voleibol en Gran Canaria 1934/1978\u2019)."]

[seccion_header]Estatutos fundacionales y despegue[/seccion_header]

<p>En noviembre de 1976, concretamente el día 6, se redactan los estatutos de fundación del Club Voleibol Calvo Sotelo, lo que ya supone, formalmente, el avance que se demandaba para que el proyecto deportivo se oficializara a todos los niveles y adquiriera una consistencia definitiva, como así se demostraría con el transcurso de los años posteriores. Fue el punto de partida que permitía ir del deporte escolar propiamente dicho, y que había sustentado la naturaleza del Calvo Sotelo, al integrado en la competición federada.</p>

[cita_prensa source="La Provincia, 1 de septiembre de 1976"]Junto al preparador técnico, Felipe Nuez, ha venido a incrementar el plantel de entrenadores Emilio Bonilla, conocido por todos dentro del ámbito del fútbol regional. De estos dos entrenadores, hay que decir que formarán un tándem que dará muchos frutos al equipo colegial y al voleibol canario en general.[/cita_prensa]

<p>El artículo proseguía detallando las incorporaciones de jugadores procedentes del infantil —Manolo, Casiano, José Luis, Simón, Ramón, Octavio y Gavira— y el regreso de Falero y Déniz al equipo absoluto. Con el equipo de voleibol, las aspiraciones llegaban aún más lejos. Se tenía una base, que era el equipo juvenil, en él se habían puesto todas las ilusiones con vistas a un futuro.</p>

[imagen_contenido file="1cap_pati_foto18.jpg" caption="Calvo Sotelo masculino de la temporada 1976/77. De pie, de izquierda a derecha, Ramón, Leandro, Juan Carlos, Felipe Nuez (entrenador), José, Acosta y Silva. Agachados, en el mismo orden, José Antonio, Araña, Mendaño, Padrón y Tony Vázquez."]

[imagen_contenido file="1cap_pati_foto_receso.jpg" caption="Receso en un partido con conjura de los jóvenes jugadores del Calvo Sotelo."]

[imagen_contenido file="1cap_pati_foto_saludo.jpg" caption="Saludo de los jugadores poco antes de un partido disputado en el Obispo Frías."]

[cita_editorial]Es loable el comprobar cómo en este club todos están mentalizados con una meta fijada a cuatro años vista, nadie espera resultados inmediatos, todos están plenamente convencidos de que, dentro de tres temporadas, el Calvo Sotelo sonará fuerte dentro del ámbito nacional.[/cita_editorial]

<p>Dicho y hecho. El Calvo Sotelo logró clasificarse para la fase de ascenso a Segunda División que se disputó en Cáceres en febrero de 1977. El Santa Ana, que ejercía de anfitrión, el Chamartín de Madrid, Camilo de Segovia, el Cisneros de Tenerife, la Universidad Laboral de Toledo y el Galerías Florita de Salamanca completaron el cartel de aspirantes que, divididos en dos grupos, buscaban el salto de categoría. No pudo ser en esta ocasión para el Calvo Sotelo, en el mapa nacional en todo caso y con los honores preceptivos por estar entre los mejores.</p>

<p>El amplio eco de la eclosión del proyecto se ensalza en la prensa por su labor cuidada de la base, verdadero orgullo de los integrantes del club. Así se hablaba de las excelencias del Calvo Sotelo, resaltando que tenía "el futuro asegurado al disponer de 16 equipos repartidos en todas las categorías".</p>

[cita_prensa source="La Provincia, 16 de junio de 1977"]Todos los componentes de esta gran familia pasando desde el conserje del colegio, encargado de servicios, director, padres de jugadores, junta directiva y, cómo no, la totalidad de los jugadores han hecho posible todo esto. Son estos últimos los que merecen especial atención, sacrificando alrededor de catorce horas semanales de los ratos en que no estudian o trabajan, en los entrenamientos, no desperdiciando ningún sábado o domingo, ni días de fiestas, para entrenar.[/cita_prensa]

[imagen_contenido file="1cap_pati_foto22.jpg" caption="El Calvo Sotelo en sus primeros tiempos. De pie, de izquierda a derecha, Ramón Rodríguez, Padín, Alfredo, Pericles y Juan Carlos. Agachados, en el mismo orden, Tony Vázquez, Chago, Martín y Mendaño."]

[imagen_contenido file="1cap_pati_foto_partido80.jpg" caption="Imagen de un partido de inicios de los ochenta del Calvo Sotelo."]

[imagen_contenido file="1cap_pati_foto_valladolid.jpg" caption="Fase de ascenso a la División de Honor disputada en Valladolid a comienzos de los ochenta. De pie, de izquierda a derecha, Isidro Quintana, Quique Silva, Pericles, José Ramón, Chicha, Francés y Jose. Agachados, en el mismo orden, Tony Vázquez, Felo, Juani Navarro, Ignacio y Juan Carlos."]

[imagen_contenido file="1cap_pati_foto_mendano.jpg" caption="Miguel Mendaño, con su dorsal número 5, en acción ofensiva."]

[seccion_header]El ascenso a Segunda División de 1979[/seccion_header]

<p>Lo que había quedado pendiente del año anterior, el ascenso a Segunda División, sí se materializó en 1979, en la fase decisiva que se libró en Málaga los días 9, 10 y 11 de marzo. En su primer partido, ganó con autoridad al Málaga por 3-0 (17-15, 15-10 y 15-4), luego se impuso por 3-1 al Dos Hermanas de Sevilla (15-1, 3-15, 15-6 y 15-1) y completó la fase previa con otro triunfo, esta vez ante el Jaén y por 3-0 (15-4, 15-2 y 15-4). Y en la gran final disputada en el turno vespertino del domingo 11 de marzo, y de nuevo frente al Dos Hermanas, se consumó el gran éxito con un 3-0 (15-12, 15-11 y 15-2) para la historia.</p>

<p>Con este ascenso al Grupo Sur de la Segunda División, el Calvo Sotelo se queda como representante en el voleibol nacional junto al Juventud Las Palmas de Isidro Quintana y Joselu Sánchez.</p>

<p>En su estreno en Segunda, temporada 1979-80, el saldo no pudo ser mejor, toda vez que se logró un segundo puesto que dio derecho a disputar la fase de ascenso a Primera División gracias, fundamentalmente, a que se mantuvo invicto en su feudo. En Cáceres afrontó una fase decisiva en la que no pudo culminar la gesta de haber encadenado otro éxito. La coincidencia del ascenso del Juventud permitió que se viviera el derbi capitalino en Segunda durante la campaña 1981-82, algo que se calificó como otro hito del voleibol grancanario.</p>

<p>La entrada en escena de patrocinios, como ya se imponía en la realidad del deporte de comienzo de los ochenta, también formó parte de la historia del Calvo Sotelo, que, en virtud de un acuerdo con Tabacanaria, adoptó, de manera sucesiva, las denominaciones Reales y Lucky, dos marcas de cigarros. Un impulso económico que demandaba su auge en el panorama deportivo español, ya con el listón de la División de Honor en mente.</p>

[imagen_contenido file="1cap_pati_foto20.jpg" caption="Fase de sector del Campeonato de España Juvenil. Calvo Sotelo-Atlético de Madrid. Mayo de 1978, Polideportivo Obispo Frías. De pie, de izquierda a derecha, Ramón Rodríguez, Juan Carlos Rodríguez, Florencio Tejera, Alfredo Padrón, Juan el Zurdo, José Luis Alemán y Tony Vázquez. Agachados, en el mismo orden, Toni Acosta, Miguel Mendaño, José Antonio Rodríguez, Araña y Leandro Fernández."]

[seccion_header]El acceso a la élite y su conflicto burocrático[/seccion_header]

<p>Juan Carlos, Pericles, Isidro, Vázquez, Felo, Juani, José Luis, Silva, José, Ignacio, Valentín y Manolo integraron la plantilla que inició el curso 1983-84, si bien luego se añadieron nombres como Francés, Quique o José Ramón.</p>

<p>Es en esta temporada cuando se va a producir un conflicto burocrático ("una cacicada federativa", según Felipe Nuez) que impidió el sueño de estar entre los mejores del país. A saber: en marzo de 1984 tomó parte de la fase de ascenso a la División de Honor que se celebró en Valladolid y junto a los equipos del Vigo, Gijón, Hellín, Veracruz de Huelva y Salesianos Atocha de Madrid. La tercera plaza obtenida, que en principio tenía un valor testimonial sin mayor trascendencia, pues solo subían los dos primeros, terminó adquiriendo una importancia capital al renunciar el Son Amar balear a su plaza en la máxima categoría. José María Rodríguez, presidente del Calvo Sotelo, elevó ante la Federación Española la intención de ocupar esa vacante, con el apoyo de Manuel Navarro, director general de Deportes del Gobierno de Canarias, e, incluso, contando con el beneplácito del Consejo Superior de Deportes en la figura de Antonio Abad, uno de sus delegados.</p>

<p>Sin embargo, los clubes de la División de Honor se opusieron a una ampliación de la misma aludiendo a factores económicos relacionados con los desplazamientos, el Comité Superior de Disciplina Deportiva se declaró "manifiestamente incompetente", agotándose la vía administrativa, por lo que, ya habiendo arrancado la temporada oficial, y con el Calvo Sotelo compitiendo en Primera pero con la vía abierta de pasar a la División de Honor, el asunto llegó a la Audiencia Nacional en octubre de 1984.</p>

[cita_prensa source="Comité Superior de Disciplina Deportiva, 8 de octubre de 1984"]En el día de la fecha por este Comité Superior de Disciplina Deportiva, se notifica lo siguiente a la Federación Española de Voleibol (...) Este Comité Superior de Disciplina Deportiva acuerda no admitir a trámite el recurso presentado por don José María Rodríguez Herrera por ser manifiestamente incompetente para conocer sobre el fondo del asunto.[/cita_prensa]

<p>Finalmente, todos los esfuerzos quedarían desestimados. Así, la temporada 1984-85 arranca condicionada por este frente ajeno a lo deportivo pero que supuso una enorme decepción en el plano institucional, pues se contaba con que prosperaran unas alegaciones fundamentadas.</p>

[imagen_contenido file="1cap_pati_foto13.jpg" caption="Partido de la época en el Obispo Frías. Tony Vázquez se dispone a ejecutar un remate."]

[imagen_contenido file="1cap_pati_foto_iqremate.jpg" caption="Isidro Quintana observa el remate de su compañero Ramón Rodríguez durante un partido de la época."]

<p>Vuelta a empezar con un equipo de nuevo llamado a aspirar a la élite y cuya principal novedad estuvo en Sergio Miguel Camarero, un prometedor juvenil de 17 años llamado, con el tiempo, a ser parte del escudo por su impronta y ascendente. El calendario regular se desarrolla con los resultados esperados hasta desembocar, con un meritorio subcampeonato del grupo C, en la fase de ascenso que acogió Mallorca a mitad de marzo de 1985. Ya sería, felizmente, el intento definitivo. Los rivales que le tocaron en suerte esta vez fueron, por este orden, el Renfe de Lérida, el Son Amar de Mallorca, el Jovellanos de Gijón, el José María Pereda de Santander y, ya en la quinta ronda, el Orient Puerto de Málaga.</p>

<p>No le fueron bien las cosas a los muchachos de Nuez en tierras baleares, pues concluyeron la liguilla en una cuarta plaza que no daba derecho a subir, ya que solo ascendían los tres primeros... Pero dos meses después, en concreto el 17 de mayo, la Comisión Ejecutiva de la Federación Española presidida por Feliciano Mayoral, aprobaba la propuesta de la Asociación de Clubes de ampliar a doce los componentes de la máxima categoría. Curiosidades del destino, el mismo colectivo que vetó al Reales en 1984 le dio vía libre un año después. Tal y como se anunció, el Lucky Calvo Sotelo competiría en el grupo par junto al Sanitas, Recuerdo, Biodrink Hispano Francés, Vigo Foqué y Orient Puerto de Málaga.</p>

[imagen_contenido file="1cap_pati_foto28.jpg" caption="Primeros tiempos del histórico Sergio Miguel Camarero en el Calvo Sotelo. En la imagen aparece el sexto por la derecha en el viaje a Mallorca de 1985 para disputar la fase de ascenso a la División de Honor."]

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
        'hero' => array(
            'image' => libro_img('1cap_felnue_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center 10%',
            'title_lines' => array(libro_hero_line('FELIPE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('NUEZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('1956–2024', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Felipe Nuez (Moya, 1956-Las Palmas de Gran Canaria, 2024) fue la figura fundamental y maestra en la vida del club. Presente desde el mismo inicio de la actividad escolar que se dedicó al voleibol con especial ahínco, llegó como profesor en prácticas al colegio Calvo Sotelo en 1973 sin saber que, junto a otros precursores, iniciaría una historia de superación y éxitos que todavía perdura y que fue, también, orgullo del deporte canario. Su pasión por la disciplina que le dio fama y prestigio vino por consejo de José Antonio Giráldez, quien fue uno de sus maestros más respetados. "Como todos los chicos de la época, empecé en el fútbol. Pero Giráldez me dijo que me veía condiciones mejores para el voleibol y le hice caso. Lo disfruté más en la faceta de entrenador, aunque hice alguna vez de árbitro y asumí otras responsabilidades. Como jugador no destacaba especialmente en nada y supe darme cuenta para volcarme en lo que siempre me gustó", indicó.[/capitular]

<p>Un repaso a su cronología personal evidenciaba que, a edad temprana, ya era elemento referencial. En 1974 fue designado como el técnico de la recién creada selección cadete de Las Palmas, cargo que compatibilizaba, tras haber ejercido en el Canteras, con la formación de la base en el Calvo Sotelo, en aquella época el segundo colegio con mayor densidad de España, con alumnos procedentes del mismo barrio de Las Rehoyas pero también de otros parajes aledaños ("venían guaguas abarrotadas de alumnos cada mañana"). Y con el apoyo del director del centro, Guillermo Gil, y una Asociación de Padres de Alumnos (APA) "volcada con el deporte y la formación".</p>

<p>Porque, como bien resaltaba, el programa de actividades extraescolares contemplaba otras modalidades como baloncesto o lucha canaria... "Pero el voleibol acabó llevándose toda la atención por el nivel de preparación, organización y crecimiento que fuimos teniendo desde los inicios, aunque ya con una importante base heredada por el trabajo de Francisco Rodríguez, quien acabaría siendo destinado a Arinaga pero que, a finales de los sesenta y comienzos de los setenta, sembró una semilla muy valiosa a la que se dio continuidad".</p>

[imagen_contenido file="1cap_pati_foto17.jpg" caption="18 de febrero de 1973. Felipe Nuez aparece al fondo de la imagen, junto al poste de la red, realizando labores de árbitro, en un partido disputado por el equipo juvenil femenino del Colegio Nacional Calvo Sotelo frente al Instituto Isabel de España en la cancha Eliseo Ojeda. (Foto cortesía de Miriam Quiroga)."]

[cita_editorial author="Felipe Nuez"]Fui autodidacta. Obtuve el título de entrenador nacional con 20 años y, en 1984, el de técnico internacional. En esos años de los comienzos, la única manera de ampliar conocimientos en el voleibol era explorando métodos de trabajo en otros países, como Japón, que era una potencia inalcanzable por su nivel de desarrollo.[/cita_editorial]

<p>"Y cada vez que podía viajar, ya fuera con el equipo o en los cursos formativos, pasaba por la librería deportiva Esteban Sanz de Madrid y me compraba unos tomos fantásticos que solo podían encontrarse allí. Y de vez en cuando conseguía las cintas de vídeo super-8 para empaparme de lo que se hacía en otros países. Uno de mis ejercicios que llamó más la atención, el de agresividad, consistente en dar balonazos a un jugador que se cubre la cara y sus partes para que se acostumbre al impacto del balón, lo saqué de lo que se hacía en Japón. Siempre entendí el deporte de manera perfeccionista y ganadora. Entrenara a cadetes, juveniles o séniors. El trabajo, el compromiso y el sacrificio eran para mí innegociables. De lo contrario, prefería quedarme en mi casa", dijo.</p>

[imagen_contenido file="1cap_pati_foto16.jpg" caption="Año 1976. Imagen del equipo del Calvo Sotelo que se proclamó campeón del I Trofeo Armería Perojo. Felipe Nuez aparece de pie, el cuarto por la izquierda, flanqueado por Juan el Zurdo y Alfredo Padrón. (Foto cortesía de Miriam Quiroga)."]

[imagen_contenido file="1cap_nuez_foto_cartel76.jpg" caption="Cartel del primer Trofeo Interprovincial de Segunda División Masculina disputado los días 6 y 7 de marzo de 1976 en Escaleritas. (Cortesía de Miriam Quiroga y de su libro \u2018Génesis y evolución del voleibol en Gran Canaria 1934/1978\u2019)."]

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

[imagen_contenido file="1cap_nuez_foto_equipo78.jpg" caption="1 de febrero de 1978. Equipo absoluto masculino del CV Calvo Sotelo. De pie, de izquierda a derecha, Paco Santana, Florencio Tejera, Tony Vázquez y Felipe Nuez. Agachados, en el mismo orden, Pericles, Araña, Toni Acosta y Alfonso Déniz. (Foto cortesía de Miriam Quiroga)."]

[imagen_contenido file="1cap_nuez_foto_espaldas.jpg" caption="Nuez, de espaldas, dando instrucciones a sus jugadores durante el tiempo muerto de un partido. Comienzos de los ochenta."]

[imagen_contenido file="1cap_pati_foto11.webp" caption="La recordada pegatina que se repartió a los aficionados del Calvo Sotelo."]

[seccion_header]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1975</span><div class="timeline-content"><strong>La selección cadete</strong>“Nuestra intención con la selección cadete de Las Palmas es continuar con ellos para recoger el fruto de nuestra labor dentro de unos 3 o 4 años y poder presentar un gran equipo que destaque en la Liga Nacional”. <em>(El Eco de Canarias, 16 de octubre de 1975)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1976</span><div class="timeline-content"><strong>Un primer diagnóstico</strong>“El futuro de nuestro voleibol lo veo, según las últimas competiciones que he visto de las categorías infantil, cadete y juvenil, muy negro, debido a que se le da poca importancia a la preparación de las categorías de base y, en cambio, se preocupan mucho por su equipo representativo en categoría absoluta”. <em>(El Eco de Canarias, 12 de junio de 1976)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1976</span><div class="timeline-content"><strong>La estructura primigenia</strong>“Nuestras plantillas absolutas y juveniles entrenan los lunes, miércoles y viernes, con doble sesión el miércoles. La preparación física la realizamos en el Gimnasio Falla y la técnica en nuestra cancha Calvo Sotelo. Actualmente, solo hay dos técnicos, que son insuficientes, si tenemos en cuenta el número de equipos”. <em>(La Provincia, 18 de noviembre de 1976)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1978</span><div class="timeline-content"><strong>El sueño emergente de la Primera</strong>“A nivel nacional, estamos entre los dos primeros. Si no fuera por la lejanía, hay algunos jugadores que en la selección española no desentonarían lo más mínimo. Muchos técnicos me han dicho que el Calvo Sotelo si sigue su trayectoria subirá a Primera”. <em>(El Eco de Canarias, 18 de febrero de 1978)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1978</span><div class="timeline-content"><strong>Naturaleza del proyecto y una afición única</strong>“Somos un club de voleibol cuyo único fin es el intentar llegar a conseguir los objetivos máximos del deporte, así como la formación integral del deportista dentro de la faceta de aficionados. En ningún otro lado de la geografía hispana he tenido ocasión de ver algo igual en cuanto a afición. La nuestra es muy numerosa, pero, además, entendida y sin fanatismos”. <em>(La Provincia, 18 de febrero de 1978)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1979</span><div class="timeline-content"><strong>Sin límites a la hora de progresar</strong>“La directiva me ha dicho que lleve al equipo hasta donde pueda rendir, y no me han puesto trabas de ninguna especie económica. El único fichaje procedente del exterior es el gaditano Vélez, que llega del Avante”. <em>(Diario de Las Palmas, 30 de agosto de 1979)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1980</span><div class="timeline-content"><strong>Seguridad en el éxito</strong>“El Calvo Sotelo tiene una excelente plantilla como para colocarse entre los dos primeros puestos de ambas series y ascender a la Primera División. Si no ocurre una desgracia, conseguiremos el ascenso”. <em>(Diario de Las Palmas, 7 de marzo de 1980)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1980</span><div class="timeline-content"><strong>Afán innegociable de superación</strong>“Nuestra meta, por supuesto, es superar la campaña anterior, incluso mejorarla. Las dificultades son los pocos jugadores de la temporada anterior y los varios juveniles que quiero adaptar al primer equipo”. <em>(El Eco de Canarias, 17 de agosto de 1980)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1983</span><div class="timeline-content"><strong>Al rescate</strong>“Mi vuelta al equipo de Segunda División, tras la dimisión de Fidel Morales, es provisional. Para estar a gusto me gustaría estar con infantiles futuribles y con todos los medios disponibles para hacer una buena labor”. <em>(Canarias7, 10 de marzo de 1983)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content"><strong>Cantera, cantera y cantera</strong>“El tiempo ha sido el verdadero juez. Se nos tachaba de que nos nutríamos poco de la cantera propia. El 80% del primer equipo ha sido formado en nuestros filiales. Estoy plenamente convencido de que, de subir de categoría, y trayendo uno o dos jugadores, con el futuro de los nuestros, podemos llegar a metas antes insospechadas en nuestro voleibol”. <em>(Canarias7, 1 de marzo de 1985)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content"><strong>La profesionalización necesaria y la predicción sobre Camarero</strong>“Los equipos que no se profesionalicen o semiprofesionalicen prácticamente no tienen nada que hacer. Nosotros confiamos en que con la incorporación de Ortiz y Martinovic, más la aportación de jugadores de la cantera, como es el caso de Sergio Camarero, pese a sus 17 años sin duda el mejor del Archipiélago, el éxito está garantizado”. <em>(La Provincia, 15 de junio de 1985)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content"><strong>Un adiós que no lo fue</strong>“A principios de junio dejé el club por no estar de acuerdo con las directrices que se estaban llevando a cabo. A partir de la segunda quincena de julio mantuve unas conversaciones con el presidente del club y le expuse mi esquema de trabajo deportivo, con unos presupuestos mínimos para la ejecución de un plan a ocho años”. <em>(Diario de Las Palmas, 15 de agosto de 1985)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1988</span><div class="timeline-content"><strong>El subcampeonato más dulce</strong>“Este subcampeonato de Copa del Rey sabe a mucho a pesar de que hay personas que piensan que pudimos dar la sorpresa en la final y ganarle al todopoderoso e invencible CV Palma. Quiero felicitar a la junta directiva, jugadores, técnicos de la cantera, socios, aficionados... A todos los que se han desvivido para que esto sea una realidad”. <em>(Canarias7, 26 de enero de 1988)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1988</span><div class="timeline-content"><strong>El mérito del colectivo</strong>“La trayectoria ascendente del Guaguas Las Palmas no se logra con un entrenador que no conoce profundamente este deporte. Sobre Sánchez Jover diré que es un gran líder, sin lugar a dudas, el mejor jugador de España”. <em>(Canarias7, 8 de agosto de 1988)</em>.</div></div>
</div>

[imagen_contenido file="1cap_nuez_foto_plantilla88.jpg" caption="La plantilla de la temporada 1987-88 posa sobre el parqué del García San Román. De pie, de izquierda a derecha, Fidel Morales, Venancio Costa, Paco Sánchez Jover, Antonio Miralles, Jorge Ramón, Joselu, Jesús Sánchez Jover, Óscar Campos, Chinea y Felipe Nuez. Agachados, en el mismo orden, David Rodríguez, Álex, Juanma Martín, Camarero, Manolo Miralles, Borja y Felipe."]
'),
    array('title' => 'José Miguel Santana', 'numero' => '', 'order' => 15, 'show_marker' => false, 'parent_ref' => 'cap01',
        'hero' => array(
            'image' => libro_img('1cap_josmisan_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('JOSÉ MIGUEL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('SANTANA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Descubridor de Sergio Miguel Camarero "por un tirón de orejas" ("siendo un niño me robaba los balones que caían fuera de la cancha y terminé recomendándole que se pusiera a jugar, como así haría y no le fue nada mal"), fue testigo y partícipe de un fichaje de leyenda como resultó ser Paco Sánchez Jover, a mitad de los ochenta y en un hotel del Puerto de Santa María durante un Preeuropeo ("convencí al recepcionista para estar en la habitación de al lado para que, cuando hubo que negociar, pudiese colarse por el balcón y que nadie lo viera") y actor impulsor, desde la tribuna de prensa, del fortalecimiento del proyecto justo en la etapa anterior a la gloria de los títulos. Pero antes, mucho antes, José Miguel Santana (Las Palmas de Gran Canaria, 1958) también se significó por jugar un papel activo en los inicios del Calvo Sotelo, entusiasta como siempre fue del voleibol tras pasar por las aulas del Alonso Quesada, en las que era deporte predominante y predilecto. Fichado del Santa Teresa al término de la temporada 1976-77, donde ejercía como entrenador y tras una llamada de Felipe Nuez para que se hiciera cargo del juvenil B masculino y femenino, Santana también hizo una contribución altruista y entusiasta que le procura un sitio privilegiado en la historia.[/capitular]

[imagen_contenido file="1cap_pati_foto29.jpg" caption="Almuerzo con varios compañeros de profesión periodística y con miembros del Guaguas como Felipe Nuez, entre otros."]

[imagen_contenido file="1cap_pati_foto27.jpg" caption="Expedición del Calvo Sotelo en uno de sus viajes en los setenta."]

[cita_editorial author="José Miguel Santana"]Fueron años increíbles que uno recuerda con mucha emoción. Éramos jóvenes, atrevidos, soñábamos con todo y el voleibol fue el vehículo para cumplir con esas ilusiones. Lo hicimos desde la base de un compañerismo ejemplar. Nunca me cansaré de repetir que más que un club, éramos un grupo de amigos, una familia.[/cita_editorial]

<p>"Todos los jugadores de los equipos nos juntábamos en la cancha y, también, en el tiempo libre. Aquellas meriendas en la casa de Mendaño con bocadillos y botellas de refresco y nos daban las tantas, el tiempo volaba. Era una manera de vivir intensa, sana y que a todos nos dio valores y un patrón de conducta impecable", subraya.</p>

<p>Hace un encendido elogio de varias figuras que considera "capitales" en el surgimiento y desarrollo del Calvo Sotelo, tales como Paco Rodríguez ("el que inició todo"), Guillermo Gil o Miguel Nieves ("también fundamentales con su trabajo e ideas") o Felipe Nuez ("el entrenador de entrenadores en el voleibol canario") y no escatima admiración por el comportamiento de los jugadores, "ejemplos de nobleza, afán de superación y lealtad".</p>

<p>"Eran hombres siendo niños. Lo digo porque, siendo juveniles, exhibían una madurez y concentración propia de adultos. Eso fue lo que inculcó Felipe. El juego y la competición. Debían ir unidos. De ahí los entrenamientos con una intensidad brutal. Era una gozada entrenar a esos chicos y chicas que se tomaban cada sesión o cada partido con una disciplina intachable. Entre todos se aconsejaban, querían ser los mejores, se ayudaban, eran una piña al grito de \'cis\', la C de Calvo y la S de Sotelo que decían en voz alta antes de empezar un partido como conjura. Y tener el apoyo del colegio, de los padres, era el respaldo ideal para continuar con esa obra que no paró de crecer", argumenta.</p>

<p>Habla de sacrificio porque no fueron pocas las veces en las que tuvo que poner de su bolsillo el dinero para sufragar el agua de sus jugadores y, como no podía ser menos, participar de "las artimañas típicas de la época" cada vez que se viajaba a la península, "con maletas cargadas de tabaco y artículos que se pudieran vender" para sacar un beneficio que permitiera costear los gastos.</p>

<p>"Fue una implicación total de todos los que formábamos parte del Calvo Sotelo, creando un vínculo especial que, en mi caso, me llevó a conocer a mi mujer o a tener amistades para toda la vida dentro de la misma disciplina del club. Nos marcó la vida porque, además nos cogió en una etapa especial, la que va de los 18-20 años en adelante", incide. Una llamada para entrar a formar parte de la redacción de Diario de Las Palmas, en 1982 y estando estudiando en Madrid, clausura su militancia en el club como miembro del organigrama y activo en todas las funciones que se le requirieran, si bien jamás dejó de "echar una mano en todo lo posible".</p>

<p>"Ver cómo se alcanzó la plenitud de las Ligas y las Copas, con protagonistas que uno conoció siendo niños como Camarero, el liderazgo de Sánchez Jover, la continuidad a la obra de Felipe, que puso los pilares de todo con su sabiduría, con su trabajo... Al final dices que sí, que todo se justifica, que lo que se hizo entonces debió estar bien por lo que vino después y por lo que pervive", concluye.</p>

[imagen_contenido file="1cap_pati_foto1.jpg" caption="Febrero de 1977. Fase de ascenso a Segunda División disputada en Cáceres. De pie, de izquierda a derecha, Ramón Rodríguez, Florencio Tejera, Alfredo Padrón, Juan Carlos Rodríguez y Felipe Nuez. Agachados, en el mismo orden, Miguel Mendaño, Juan Díaz, Alfonso Déniz, Paco Santana y Pericles."]

[imagen_contenido file="1cap_pati_foto14.jpg" caption="Imagen de un partido a inicios de la década de los ochenta, con remate de Tony Vázquez."]
'),
    array('title' => 'Florencio Tejera', 'numero' => '', 'order' => 16, 'show_marker' => false, 'parent_ref' => 'cap01',
        'hero' => array(
            'image' => libro_img('1cap_floteje_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('FLORENCIO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('TEJERA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Jugador fundacional del Calvo Sotelo tras la redacción de los estatutos del club y presidente "casi por accidente" en la temporada 1983-84, el testimonio de Florencio Tejera (Las Palmas de Gran Canaria, 1956) también resulta de inestimable valor para conocer la naturaleza primigenia de la entidad en sus albores ya insertada en las exigencias de la alta competición. Porque ese Calvo Sotelo al que se enroló "para poder cumplir el cupo de dos fichas séniors junto a Alfonso Déniz" que se requería ya le impactó por "su nivel de organización, ambición y desarrollo".[/capitular]

[imagen_contenido file="1cap_pati_foto19.jpg" caption="Receso en un partido con conjura de los jóvenes jugadores del Calvo Sotelo."]

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
        'hero' => array(
            'image' => libro_img('1cap_tonvaz_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('TONY', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('VÁZQUEZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Andaluz de nacimiento (Cádiz, 1960), pero grancanario de pleno derecho ("me trajeron con tres años y esta es mi tierra"), sobre Tony Vázquez recae el privilegio de haber sido otro de los jugadores fundacionales del Calvo Sotelo. Tras sus inicios en los Salesianos ("iba para el atletismo, pero Silvestre Cabrera me dijo que tenía la altura apropiada y me metió en el voleibol"), la creación de la selección cadete de Las Palmas, a mediados de los setenta y bajo la dirección de Felipe Nuez, fue el impulso definitivo a su posterior trayectoria como receptor ("era un 4 de toda la vida, aunque acabé jugando en todas las posiciones").[/capitular]

[imagen_contenido file="1cap_pati_foto26.webp"]

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
        'hero' => array(
            'image' => libro_img('1cap_isiquin_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('ISIDRO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('QUINTANA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]A Isidro Quintana (Las Palmas de Gran Canaria, 1957) le metieron el voleibol en su vida "por obligación", como reconoce, porque, integrado en la sección de baloncesto de la UD Las Palmas durante su adolescencia ("llegué a jugar contra Domingo Díaz, que luego ha sido lo que ha sido"), iba para pívot con su imponente estatura en plena pubertad. "Pero se me cruzó en el camino Silvestre Cabrera, que me daba clases en los Salesianos, y me dijo, medio en serio, medio en broma, que o hacía voleibol o me suspendía. Me convenció prometiéndome que me llevaría directamente a la selección júnior. Empecé y ya no lo dejé. Fue tal mi interés que me saqué la titulación nacional de entrenador con 17 o 18 años para tener una formación más amplia y poder dirigir equipos, como luego haría con el Santa Teresa, y que, con Carlos Bermúdez como presidente, alcanzó enorme relevancia", añade.[/capitular]

[imagen_contenido file="1cap_iq_foto_recepcion.jpg" caption="Isidro Quintana, en labores de recepción."]

<p>El caso es que, compaginando su labor de jugador, con inicio en el Juventud, con el de técnico en el conocido como Rusell Hall en honor a su patrocinio, y el de periodista, ejerciendo como informador en distintos medios de comunicación, Isidro Quintana se fue convirtiendo en toda una personalidad del voleibol isleño y con una influencia en todos los ámbitos que no paró de expandirse desde finales de los setenta hasta su reciente jubilación.</p>

<p>"Fue por una gestión mía, que hice a título personal y altruista, la llegada del primer sponsor de la historia del Calvo Sotelo, como ya antes había hecho con el Santa Teresa. Hablé con un contacto que tenía en Tabacalera y de ahí terminaron viniendo las denominaciones de Reales o Lucky Stricke. De hecho, en mi coche de entonces llevaba serigrafiados esos dos logotipos para dar mayor publicidad. Y Juan Ruiz, tanto antes de entrar por primera vez como presidente como cuando refundó la entidad, me llamó a título particular para avanzarme sus planes y pedirme consejos en virtud de mi experiencia. Un gesto que me llenó de orgullo. Por supuesto, siempre traté de ayudarle y brindarle el máximo apoyo que podía", razona.</p>

<p>Reclutado para el Calvo Sotelo por Felipe Nuez ("me convenció hablándome de potenciar un proyecto que iba para arriba y con una metodología de trabajo que yo sabía que nadie tenía en Canarias"), su desembarco en el club, en la campaña 1983-84, coincidió con el de otros dos compañeros del Juventud ("Ignacio Brito y el Chicha") que, según su parecer, "desniveló la balanza en favor del Calvo Sotelo en la rivalidad capitalina que existía y que, hasta ahí, era favorable al otro equipo".</p>

[cita_editorial author="Isidro Quintana"]Felipe me puso de central, cuando siempre había sido receptor. Fue un acierto porque pude dar un rendimiento importante para ayudar a los compañeros. Y me terminó de demostrar su enorme inteligencia como entrenador cuando transformó a Mendaño de rematador a colocador después de que sufriera una lesión que le dejó secuelas y le impedían subir a la red como antes. Fue una maniobra genial de Felipe, quien fue una figura capital en los primeros tiempos del Calvo Sotelo.[/cita_editorial]

<p>Fueron tres temporadas de militancia en el equipo, con picos de relevancia, como el ascenso a la División de Honor en 1985 o "la multitud de momentos de enorme compañerismo y amistad" que le deparó esta gran experiencia.</p>

<p>"Éramos un grupo sano, de amigos y que teníamos una gran relación dentro y fuera de la cancha. Ninguno podíamos pensar que aquello terminaría yéndose de las manos a todo el mundo y convirtiéndose en lo que fue, un equipo campeón, con dobletes nacionales, algo que tiene un mérito tremendo. La clave en esta transformación, en este salto al estrellato, se personifica en Juan Ruiz. Para mí es el rey, la persona clave. No se entiende el Guaguas sin Juan Ruiz y creo que no se entiende Juan Ruiz sin el Guaguas. Apostó por traer extranjeros, por ir a por los mejores jugadores que había en los rivales. Era la única manera de hacer un proyecto ganador", afirma.</p>

<p>En su rol de periodista, ya finalizada su etapa como jugador en el club, ha sido testigo puntual y al detalle de todas las gestas y progresos del Calvo Sotelo, "acompañado de otros históricos de talla inigualable como Sánchez Jover, Nuez o Camarero", haya podido rescatar un proyecto que parecía ya enterrado: "Fundé un club como el Cantur y terminó desapareciendo pese a los éxitos que logró. En el Vecindario sé que Sánchez Jover se dejó un dineral de su bolsillo y acabó quemado. De ahí que la jugada de coger esta plaza, con derecho a jugar en Europa como premio añadido, haya sido otro acierto más de Juan, capaz de reinventarse de nuevo en favor de un club que es patrimonio de nuestra tierra por trayectoria, historia e importancia".</p>
'),
    array('title' => 'Pericles', 'numero' => '', 'order' => 19, 'show_marker' => false, 'parent_ref' => 'cap01',
        'hero' => array(
            'image' => libro_img('1cap_pericles_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('PERICLES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Un pelo abundante y la barba que le daba aires intelectuales le valieron el apodo, Pericles, con el que se incrustaría, por derecho propio, en el listado de imprescindibles del Calvo Sotelo. "Me dijeron, medio en serio medio en broma, que me parecía a Pericles. No me lo tomé mal y así me quedé", admite. Pedro Román Rosario (Las Palmas de Gran Canaria, 1958) no fue uno más. Durante muchos años capitán y guía del resto, añadió a sus grandes dotes para el voleibol ("como receptor formé con Tony Vázquez una línea fabulosa en esa función") una lección de compromiso y entrega de impresión, ya que, pese a su condición de asmático, perteneció durante largo periplo al equipo y con un rendimiento ejemplar. "Salía a la cancha con mi Ventolín para poder resistir los esfuerzos. En los tiempos muertos y descansos casi prefería el fuelle que me daba el medicamento al agua. Y alguna vez me pincharon por las asfixias que me entraban. Que se lo pregunten a Alfredo Padrón, que iba para doctor, como ejerció posteriormente, y en más de una ocasión fue mi practicante en el vestuario", rememora.[/capitular]

[imagen_contenido file="1cap_pati_foto25.jpg"]

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
        'hero' => array(
            'image' => libro_img('1cap_josemillan_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('JOSÉ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('MILLÁN', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Si la figura de Silvestre Cabrera fue de trascendencia capital para auspiciar el voleibol durante su mandato como presidente de la Federación de Las Palmas (1973-1985), no es menos relevante la influencia, también de enorme impacto, de José Millán, quien en diciembre de 1976 asumió el cargo de secretario del ente presidido por Cabrera, tomó su relevo a la conclusión de su ciclo como máximo mandatario y terminó encabezando la Federación Canaria de Voleibol hasta 2008. Más de tres décadas de contribución y entrega que le hicieron tener una atalaya privilegiada de los acontecimientos, al tiempo de otorgarle un lugar preferencial en la historia de esta disciplina.[/capitular]

[imagen_contenido file="1cap_pati_foto24.jpg"]

<p>Millán (Sevilla, 1933-Las Palmas de Gran Canaria, 2023) fue otro de los testigos que vivió, desde los inicios hasta su desarrollo, pasando por la eclosión de los títulos, la vida del Calvo Sotelo, una entidad a la que reconoció tener "mucho cariño y respeto" por la contribución que hizo en la historia del deporte en Canarias.</p>

[cita_editorial author="José Millán"]Siempre presté mi ayuda a todos los clubes y equipos y el Calvo Sotelo no fue una excepción. Su labor con los chicos, con la cantera, fue muy valiosa y tuvo el acierto, además, de complementar el bloque con algunos veteranos. Se veía que era un proyecto que podía llegar alto por la dedicación y el empeño que le ponían, con Felipe Nuez al frente.[/cita_editorial]

<p>El dirigente reafirmó que la consecución de títulos por parte del ya denominado Guaguas Las Palmas "supuso un gran espaldarazo" para el voleibol canario, por lo que cabía distinguir al club "por ser el primero y el que contribuyó a que la afición se volcara". Ahí estaban las imágenes de las canchas llenas, primero el San Román, luego el Centro Insular, y la repercusión mediática que conllevó.</p>

<p>Y no pasó por alto el impulso que llegó con Juan Ruiz, a mitad de la década de los ochenta: "Juan disparó al Guaguas, lo llevó a lo más alto cuando parecía que lo que él quería era imposible. Hizo un equipo del que todos disfrutamos. Tenemos que ser justos con él y darle el mérito que le corresponde. Hubo un antes y un después en la historia del voleibol y del deporte en nuestras islas. Juan Ruiz fue quien marcó el cambio de una etapa a otra".</p>

<p>"Hay que valorar lo que hicieron, saliendo de un colegio y con muy pocos medios. Fueron superándose, nunca se rindieron ante las dificultades. Como dirigente que era en esos años, contemplé con mucha satisfacción su labor formativa, su salto al profesionalismo, los fichajes de grandes jugadores... Fue una evolución preciosa y que, pienso, hizo muy feliz a los aficionados. Irrepetible, diría yo", añadió.</p>

<p>Millán tampoco obvió el valor añadido que dio codearse con los mejores de Europa, otro de los hitos del Guaguas: "Colocaron en el mapa nuestro voleibol, nuestra tierra. Fueron embajadores de España. Faltó suerte para lograr un título continental, pero su contribución fue impresionante y digna de aplauso en todos los sentidos".</p>

[imagen_contenido file="1cap_pati_foto23.jpg" caption="José Millán, sentado el segundo por la derecha, durante un agasajo al Guaguas en el transcurso de la temporada 1987-88 y con motivo del celebrado subcampeonato de la Copa del Rey. Millán ocupaba, entonces, la presidencia de la Federación de Voleibol de Gran Canaria."]
'),
    array('title' => 'Miriam Quiroga', 'numero' => '', 'order' => 21, 'show_marker' => false, 'parent_ref' => 'cap01',
        'hero' => array(
            'image' => libro_img('1cap_mirquir_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('MIRIAM', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('QUIROGA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Miriam Quiroga, licenciada en Educación Física y profesora universitaria, publicó en el año 2010 el libro \'Génesis y evolución del voleibol en Gran Canaria 1934-1978\', editado por el Servicio de Publicaciones de la Universidad de Las Palmas de Gran Canaria, en el que se incluye amplia documentación escrita y gráfica del nacimiento y desarrollo del Club Voleibol Calvo Sotelo. Su testimonio es de indudable valor a la hora de analizar el surgimiento de la entidad y, a petición del autor de esta obra, además de mostrar una generosa colaboración bibliográfica, cediendo numeroso material que obraba en su poder, entre el que cabe destacar el documento original de los estatutos fundacionales que se reproduce en su integridad al final de este capítulo, accedió a responder este breve cuestionario y en el que aporta información alusiva a los primeros tiempos de la institución. Conste desde estas páginas el agradecimiento y reconocimiento de la directiva actual del Guaguas, presidida por Juan Ruiz, a su labor investigadora así como a su gesto de ayudar a este proyecto editorial.[/capitular]

[dos_columnas igual="true"][imagen_contenido file="1cap_pati_quiroga_libro.jpg" caption="↑ Portada del libro &quot;Génesis y evolución del voleibol en Gran Canaria 1934-1978&quot; escrito por Miriam Quiroga y publicado en el año 2010."]|||[imagen_contenido file="1cap_pati_quiroga_cartel71.jpg" caption="↑↑ Cartel anunciador de los Juegos Provinciales de la Juventud, para Enseñanza Primaria, del año 1971."][/dos_columnas]

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

[imagen_contenido file="1cap_pati_foto_juvfem7576.jpg" caption="Equipo juvenil femenino del Colegio Nacional Calvo Sotelo de la temporada 1975/76, entrenado por Francisco Rodríguez, que aparece formando con sus jugadoras. (Foto cortesía de Miriam Quiroga y de su libro \u2018Génesis y evolución del voleibol en Gran Canaria 1934/1978\u2019)."]
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
        'anclas_internas' => "Capítulo I — Constitución, fines y domicilio | capitulo-i\nCapítulo II — De los socios | capitulo-ii\nCapítulo III — Del Gobierno de la Sociedad | capitulo-iii\nCapítulo IV — De la administración de la Entidad. | capitulo-iv",
        'hero' => array(
            'image' => libro_img('2cap_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ESTATUTOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('FUNDACIONALES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
            'border_color' => 'hsl(45 100% 50%)',
        ),
        'content' => '
[encabezado_seccion]Aprobado en la Junta del día 6 de noviembre de 1976 a las 20.00 horas[/encabezado_seccion]

[encabezado_seccion id="capitulo-i"]Capítulo I — Constitución, fines y domicilio[/encabezado_seccion]
[articulo numero="1º"]El nombre que adoptará la nueva entidad será el de Club Voleibol Calvo Sotelo.[/articulo]
[articulo numero="2º"]El objeto de la presente entidad es el fomento y práctica del deporte entre los asociados y, en especial, el Voleibol.[/articulo]
[articulo numero="3º"]Podrá asimismo la presente entidad ampliar sus funciones deportivas con otras secciones secundarias, recreativas o de otros deportes, siempre que lo acuerden la junta directiva y a cuyo fin crearan aquellas secciones que, previa aprobación en Asamblea General, se estimen necesarias y que sus medios lo permitan.[/articulo]
[articulo numero="4º"]La entidad, que con todos sus socios y componentes quedan sujetos a la jurisdicción de la Delegación Nacional de Deportes, Comité Olímpico Español, Federación Española de Voleibol, a través de la cual queda incorporada al completo de la instituciones del Estado Español obligándose a acatar todo lo dispuesto en los estatutos, reglamentos, disposiciones y acuerdos de la expresada federación.[/articulo]
[articulo numero="5º"]Se fija el domicilio de la entidad en Las Palmas, calle Montejurra, número 1.[/articulo]
[articulo numero="6º"]La duración de la entidad es por tiempo indefinido.[/articulo]

[encabezado_seccion id="capitulo-ii"]Capítulo II — De los socios[/encabezado_seccion]
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

[encabezado_seccion id="capitulo-iii"]Capítulo III — Del Gobierno de la Sociedad[/encabezado_seccion]
<p class="text-sm text-muted-foreground italic mb-4">(Sección 1ª: Junta Directiva)</p>
[articulo numero="20º"]La entidad estará dirigida, regida y administrada de conformidad con los presentes estatutos por la junta directiva.[/articulo]
[articulo numero="21º"]La junta directiva se compondrá: presidente, uno o dos vicepresidentes, secretario, tesorero contador y el número de vocales que se estime conveniente.[/articulo]
[articulo numero="22º"]Los nombramientos y duración de los cargos de presidente y miembros de la junta directiva de la entidad se harán de conformidad con las disposiciones vigentes sobre el particular emanadas de la Delegación Nacional de Educación Física y Deportes.[/articulo]
[articulo numero="23º"]El presidente convocará junta directiva todas las veces que estime necesario y, al menos, una vez cada mes.[/articulo]
[articulo numero="24º"]Los acuerdos de la junta directiva se tomarán por mayoría de votación, teniendo cada componente un voto y, en caso de empate, decidirá el voto del presidente.[/articulo]
[articulo numero="25º"]El presidente tendrá la representación legal y jurídica de la entidad, dirigirá los debates y discusiones y velará para que se cumplan los acuerdos de las juntas directivas y asambleas generales ordinarias y extraordinarias de socios, autorizará con su firma los pagos y operaciones que efectúe la entidad, unida dicha firma con la del contador, para asuntos económicos y con la del secretario para documentos y contratos.[/articulo]
[articulo numero="26º"]El secretario llevará el libro de actas, un registro de socios con orden correlativo, cuidará de la correspondencia de la entidad, extenderá los oportunos certificados con referencias a los acuerdos tomados, autorizará con su firma, junto con la del presidente, los contratos que se celebren en nombre de la entidad, formalizará la memoria anual de las actividades de la entidad, actuará como tal en las juntas directivas y asambleas y cuidará de tener toda la documentación en las asambleas preparadas según las secciones segunda, tercera y cuarta. Todos los escritos llevarán el visto bueno del presidente.[/articulo]
[articulo numero="27º"]El tesorero cuidará de la parte económica de la entidad llevando, al efecto, un libro de caja donde anotará todos los ingresos y gastos que hubiere. No efectuará ningún pago sin el visto bueno del presidente.[/articulo]
[articulo numero="28º"]El contador velará por el fiel cumplimiento de la distribución de fondos de la entidad, así como el pago de la cuotas por los asociados y, también, comprobará los estados de cuentas y beneficios o pérdidas por fiestas, homenajes, etc. Presentará, bimensualmente, a la aprobación de la junta directiva el estado de cuentas de la entidad. De acuerdo con el tesorero, presentará y formalizará para la junta general ordinaria un balance inventario de la situación económica de la entidad durante el año para su aprobación, el cual deberá exhibir durante quince días con anterioridad a dicha reunión en la tablilla de la entidad, a los fines de poderlo comprobar todos los asociados, Sustituirá al tesorero en caso de ausencia o enfermedad.[/articulo]
[articulo numero="29º"]El vicepresidente hará las veces de presidente en ausencia o enfermedad del mismo.[/articulo]
[articulo numero="30º"]Los vocales ayudarán a los demás miembros de la junta directiva en sus funciones, sustituyendo a estos en caso de enfermedad o ausencia y serán los que presidan las distintas ponencias deportivas o sociales que crea conveniente formar la junta directiva, cuidando de exponer a aprobación de la junta los acuerdos tomados en principio, por tales ponencias.[/articulo]

<p class="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 2ª: La Asamblea General de socios)</p>
[articulo numero="31º"]Las asambleas serán ordinarias o extraordinarias y se convocarán y celebrarán según lo prescrito y dispuesto por la Delegación Nacional de Educación Física y Deportes, en sus disposiciones vigentes sobre la materia.[/articulo]
[articulo numero="32º"]Necesariamente deberá ser celebrada asamblea general extraordinaria para la modificación de los estatutos y para tener validez ha de ser aprobado por la Federación Española. Las asambleas generales ordinarias y extraordinarias estarán integradas por aquellos socios que, con arreglo a la sección 3ª que sigue, tengan derecho a voto.[/articulo]

<p class="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 3ª. Socios con derecho a voto)</p>
[articulo numero="33º"]Tendrán derecho de asistencia a las asambleas generales ordinarias y extraordinarias todos los socios de la entidad.[/articulo]
[articulo numero="34ª"]Cada año, en primero de enero, quedarán expuestas en el cuadro de anuncios de la entidad las listas de socios, por riguroso orden de fecha de ingreso.[/articulo]

<p class="text-sm text-muted-foreground italic mb-4 mt-8">(Sección 4ª: Procedimientos para elegir la Junta Directiva)</p>
[articulo numero="35º"]Cuando deba procederse a la elección de presidente con la totalidad de la directiva, se efectuará previamente la proclamación de candidato.[/articulo]
[articulo numero="36º"]Los candidatos a la junta directiva serán todos aquellos socios que reúnan las condiciones del artículo 11 y sean presentados con la firma del 10% de los asociados que tengan derecho a voto.[/articulo]
[articulo numero="37ª"]El plazo para la presentación de las propuestas de candidatos finalizará a los cinco días a partir de la convocatoria de la asamblea en que haya de producirse la elección.[/articulo]
[articulo numero="38º"]Finalizado dicho plazo de cinco días, la entidad elevará a la Federación Española, a través de la Regional, las propuestas de candidatura, las cuales, una vez aceptadas, se expondrán en el local social durante cinco días anteriores a la celebración de la asamblea.[/articulo]
[articulo numero="39º"]En la asamblea solo podrán votarse candidaturas completas, considerándose nula cualquier enmienda o sustitución que se hiciera.[/articulo]
[articulo numero="40º"]Ningún socio podrá firmar a la vez dos o más propuestas de candidatura y, aunque si tal ocurre no se invalidará esta, el socio que incurra en duplicidad de firma será inhabilitado para tomar parte en las asambleas generales que se celebren en lo sucesivo.[/articulo]
[articulo numero="41º"]Todas las propuestas de candidatos a la presidencia deberán citarse acompañadas de la aceptación de los interesados y con la lista de candidatos que estos propongan para los demás cargos que deban proveerse.[/articulo]
[articulo numero="42º"]La asamblea por mayoría de votos sobre la elección del presidente y miembros de la directiva y de conformidad con las disposiciones vigentes de la D. N. de Educación Física y Deportes.[/articulo]
[articulo numero="43º"]Si se produjera la dimisión o cese total de presidente o directiva, esta no podrá abandonar sus funciones bajo pena de inhabilitación de sus miembros mientras no se haya procedido a la elección de otra nueva y, a este fin, convocará inmediatamente la asamblea general extraordinaria.[/articulo]

[encabezado_seccion id="capitulo-iv"]Capítulo IV — De la administración de la Entidad.[/encabezado_seccion]
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
            'image' => libro_img('3cap_asi_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.45)',
            'background_color' => 'hsl(2 82% 30%)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(2 82% 30%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ASÍ SE FORJÓ', '#FFFFFF', 'hsl(2 82% 30%)', 'none'), libro_hero_line('UNA LEYENDA', '#FFFFFF', 'hsl(2 82% 30%)', 'none')),
            'border_color' => '',
        ),
        'content' => '
[seccion_header color="hsl(2 82% 30%)"]I. Llegar a la élite para quedarse[/seccion_header]

[imagen_contenido file="3cap_asi_foto16.jpg" caption="Guaguas de la temporada 1986-87. De pie, de izquierda a derecha, Pericles, Jorge Ramón, Camarero, Óscar Campos, Martinovic, Macías y Juan Ruiz. Agachados, en el mismo orden, Juanma Martín, Batista, David Rodríguez, Domingo, Carlos y Felipe."]

[capitular]La temporada 1985-86 fue la del estreno del Calvo Sotelo en la División de Honor y se afrontó bajo las mismas líneas maestras que habían marcado su trayecto, desde las consideraciones de Felipe Nuez, aunque con la importante novedad del fichaje del yugoslavo Ivo Martinovic, primer extranjero en la historia del club que, con 30 años y amplio bagaje profesional e internacional, venía a darle a la plantilla la cuota de veteranía que se requería para competir a escala máxima. Jorge Ramón, Juanma Martín, Alfredo Padrón, Miguel Mendaño, Óscar Campos, Francisco Reyes, Sergio Miguel Camarero, Martín Medina, el mencionado Ivo Martinovic, Enrique González Silva y José Ramón, más los juveniles Javier Ulacia, Alejandro Menéndez, Roberto Padrón y Alejandro Gil eran los componentes de aquel histórico equipo que se adentró entre los grandes y lo hizo con relativo éxito.[/capitular]

<p>Pese a los condicionantes económicos derivados de no tener un patrocinador (tras dos años con las denominaciones Reales y Lucky, relacionadas con el tabaco, Tabacanarias no renovó su compromiso), lo que supuso un hándicap sustancial, se logró eludir con solvencia el riesgo de descenso y hasta quedar encuadrado en la entonces denominada Serie A1, en la que competían los primeros clasificados de cada grupo. Martinovic, elegido capitán en su primera campaña, y un Camarero que ya demostraba que iba para jugador de época, fueron los sostenes de un grupo que rindió por encima de lo esperado. Para el recuerdo queda aquel 2 de noviembre de 1985, fecha del debut del Calvo Sotelo en la División de Honor con triunfo en Cáceres ante el Licenciados Reunidos por 0-3. Jorge Ramón, Juanma Martín, Campos, Camarero, Martinovic y González fueron los jugadores alineados en el inicio de un trayecto que iba a conducir a la gloria.</p>

[imagen_contenido file="3cap_asi_foto_aficion.jpg" caption="El apoyo incondicional y multitudinario de los seguidores al equipo fue una de las señas de identidad de la etapa dorada."]

<p>El 21 de octubre de 1986 se celebra en el salón de la Boutique del Jamón, sita en Mesa y López, la asamblea general extraordinaria del club motivada por la salida del anterior presidente, José María Rodríguez, y la transición que comanda como coordinador Gustavo Rodríguez. Se anuncia en los medios de comunicación la posibilidad de que entre una plancha que "pueda llevar al Calvo Sotelo por buen camino y consolidarlo como un club grande dentro del voleibol español". Ahí arranca la etapa de Juan Ruiz en el alto mando y que se prolongaría, de manera ininterrumpida, hasta 1998. El déficit heredado es de "aproximadamente seis millones de pesetas".</p>

<p>En realidad la mala situación financiera que atravesaba el Calvo Sotelo ya era de sobra conocida y publicitada. Y el papel de los medios de comunicación pidiendo una alternativa para evitar la desaparición fue lo que atrajo el interés de Juan Ruiz, hasta entonces un neófito en el voleibol y que, alertado por las informaciones que le llegaban a través de su periodista de cabecera, el que escuchaba a diario a través de las ondas de Antena 3: Paco García Caridad.</p>

[cita_editorial author="Paco García Caridad"]Fue un ejercicio de responsabilidad con la sociedad canaria lanzar desde las ondas un mensaje de auxilio en favor del Calvo Sotelo. No podíamos dejar que un proyecto de cantera tan serio y valioso se viniera abajo. Más que un club, el Calvo Sotelo era un modelo educativo, un espejo en el que mirarse por sus orígenes y crecimiento. Actué conmovido por una situación límite. Igual que pedí ayudas para la UD, el baloncesto, el balonmano y hasta me impliqué activamente en la necesidad que se tenía de convertir un solar yermo que había en la Avenida Marítima en lo que iba a ser el flamante Centro Insular de Deportes. Defender al Calvo Sotelo y su supervivencia era un acto de justicia social, un alegato por el patrimonio deportivo del momento. Saber que Juan Ruiz dio el paso al frente tras hablar conmigo y tener referencia de mis informaciones me lo tomo como el resultado de mi labor profesional. Y no me añado méritos ni medallas. Lo de menos somos los personas, que estamos de paso. Lo que prevalece es que el club tuvo ese relevo en su cúpula que sirvió para rescatarlo de la quiebra.[/cita_editorial]

[imagen_contenido file="3cap_asi_foto_alin87.jpg" caption="De pie, de izquierda a derecha, Felipe, Paco Sánchez Jover, Jesús Sánchez Jover, Miralles, Joselu Sánchez, Venancio Costa y Jorge Ramón. Agachados, en el mismo orden, Óscar Campos, Álex, Juanma Martín, Camarero y David Rodríguez. Temporada 1987-88."]

[imagen_contenido file="3cap_asi_foto_alin91.jpg" caption="Formación del Guaguas a inicios de la década de los noventa, en el tramo floreciente de títulos y prestigio."]

[imagen_contenido file="3cap_asi_foto17.jpg" caption="Temporada 1991-92. De pie, de izquierda a derecha, Enrique Edelstein (primer entrenador), Esteban Paganini (técnico ayudante), Jorge Ramón, Antonio Miralles, Waclaw Golec, Sandeep Sharma, Lars Nilsson, Marcelo Giovannacci (segundo entrenador), Ismael Chinea (delegado). De rodilla, en el mismo orden, David Rodríguez, Emilio Agustí, Pablo Bautista, Javi Dios, Sergio Miguel Camarero y Juanma Martín."]

<p>Siguen los movimientos en ese periodo, ya con el equipo iniciando su segundo año en la División de Honor: el 23 de octubre de 1986, Gustavo Rodríguez, coordinador de la junta gestora, informa de que "hay una nefasta gestión de la directiva anterior". Ismael Chinea, Fidel Morales, Felipe Nuez, Juan M. Martín e Ivo Martinovic son los miembros del equipo de trabajo designado para pilotar el cambio necesario en la gestión y el gobierno de la institución. Aunque no se menciona expresamente, Juan Ruiz ya está integrado en el mismo, como bien se certificaría días después anunciando, de su mano, la llegada del ansiado patrocinador.</p>

<p>Se detalla, además, un presupuesto para la temporada 1986-87 de 13.500.000 de pesetas y que, a la espera de un anunciante, el equipo se denomine Club Voleibol Las Palmas, propuesta que había correspondido, originalmente a Juan José Apolinario, anterior gerente del Calvo Sotelo. Una semana después, Juan Ruiz Ramos es oficializado como presidente de la junta gestora en sustitución de Gustavo Rodríguez.</p>

<p>Y la noticia más esperada desde hacía meses, la de la aparición de un patrocinador que otorgara la estabilidad perdida y permitiera cuadrar números, se anunció el 5 de noviembre de ese mismo 1986. Juan Ruiz, que ya ejerce como miembro visible de la junta gestora del Club Voleibol Las Palmas, confirma que, "después de varias conversaciones con Juan Rodríguez Doreste", alcalde de Las Palmas de Gran Canaria, Guaguas Municipales patrocinará a la entidad, que, desde entonces pasará a denominarse Guaguas Las Palmas. Su primer partido con este nombre lo disputó el 15 de noviembre ante el Cisneros y en Tenerife. La consecución de este patrocinador, con el que el club ganaría títulos y adquiriría fama internacional, es el primer golpe de efecto de Ruiz en la historia de su mandato. Él mismo aparecería firmando el histórico contrato de vinculación con la compañía de transporte público.</p>

<p>En el plano deportivo, el equipo, con las grandes novedades del regreso de Pericles y Batista, mantiene su buen tono. El 19 de enero de 1987 queda tercero en la Copa del Rey celebrada en Sa Pobla, Mallorca, tras imponerse por 3-1 al Cisneros de Tenerife, consiguiendo, de esta manera, su clasificación para la Copa Confederación. Jorge Ramón, Ivo Martinovic, Sergio Camarero, Juanma Martín, Óscar Campos y Eduardo Macías integraron un equipo inicial al que luego se sumó Alejandro Gil. El quinto puesto logrado, posteriormente, en la Liga redondeó una campaña de sobresaliente considerando la naturaleza advenediza del Guaguas.</p>

[seccion_header color="hsl(2 82% 30%)"]II. Fichajes de impacto y hegemonía[/seccion_header]

<p>El verano de 1987, ya con dos años de experiencia en la élite, marca el escalón cualitativo que instala al Guaguas en la excelencia. El fichaje de Paco Sánchez Jover, figura indiscutible del voleibol nacional, fue una auténtica jugada maestra de Juan Ruiz al captar al jugador del momento. Por si fuera poco, con Sánchez Jover llegan su hermano Jesús, Venancio Costa, Antonio Miralles. Todos darían excelentes réditos al escudo. Y Paco vino para no irse jamás y liderar los años dorados que ya estaban incubándose.</p>

<p>Los resultados se disparan y son un aviso al resto de que Gran Canaria exhibe proyecto ganador. Además del bautizo europeo frente al Knack de Bélgica, en una eliminatoria saldada con derrota pero cuya importancia trascendió al resultado por su valor simbólico, los subcampeonatos de Liga y Copa del Rey suponen la antesala de los éxitos que ya eran inminentes. El relevo en el banquillo de Felipe Nuez en 1988, el técnico de toda la vida y que tras más de quince años ininterrumpidos en su cargo se despedía de la entidad que vio nacer, fue la nota discordante en la crecida colectiva que cogió una velocidad imparable en esta campaña.</p>

<p>El aterrizaje de los mexicanos Sergio Hernández, para el banquillo, y Chava González, así como la apuesta por el canadiense Brad Willock terminan por ensamblar un Guaguas ya de valores consolidados de los años anteriores y que, como fruta madura, inaugura su palmarés con la Copa del Rey conquistada el 9 de abril de 1989 ante el Palma en el Centro Insular.</p>

[imagen_contenido file="3cap_asi_foto15.jpg" caption="Camarero y Juanma Martín, en el festejo de un título."]

[imagen_contenido file="3cap_asi_foto_vcosta_bloqueo.jpg" caption="Venancio Costa, uno de los inolvidables."]

[imagen_contenido file="3cap_asi_foto_vcosta_camarero.jpg" caption="Antonio Miralles, en imponente subida a la red."]

<p>El recinto capitalino ya era la nueva casa del club después de haber estado desde siempre, tras su ingreso en las competiciones estatales, como anfitrión en el García San Román. La mudanza a la nueva instalación generó ciertas controversias, pues había dudas de que se ajustara a las necesidades de un club todavía con una afición fiel pero minoritaria. Los éxitos trajeron las muchedumbres desde que un 22 de octubre de 1988 se disputara el primer partido del Guaguas en el CID con motivo de su inauguración. Fue en el Torneo Internacional Isla de Gran Canaria, integrando cartel con el Seven Up Santa Catalina, Cisneros de Tenerife y Slavia de Sofía. El Guaguas ganó 3-0 al Seven Up. Sergio Hernández, entrenador del equipo entonces, alineó a Venancio Costa, Juanma Martín, Chava, Jorge Ramón, Sánchez Jover y Camarero en el sexteto inicial y, además, utilizó a Óscar Campos, Antonio, Felipe, David y Jesús. El Seven Up estaba dirigido por Felipe Nuez.</p>

<p>Esa Copa, que abría las vitrinas del Guaguas, no hizo más que multiplicar las ambiciones de Juan Ruiz, quien une a su elenco de estrellas, en el verano de 1989, a los internacionales polacos Ireneusz Klos y Waclaw Golec, llamados a ser ídolos y figuras diferenciales. Esa primera Liga que se resistía sería una realidad el 1 de mayo de 1990 con la inolvidable final ante el Bomberos de Barcelona, bajo la denominación comercial de Constructora Atlántica Canaria, y con Sánchez Jover ejerciendo de jugador-entrenador y luego de ocupar la vacante en el banquillo que dejó a mitad del calendario el americano Robert Croteau.</p>

<p>A esa primera Liga le sucederían otras cuatro consecutivas hasta 1994, estableciendo una hegemonía nacional inédita en los representativos canarios y que, además, estuvo aderezada con tres dobletes por las Copas del Rey también conquistadas en los años 1991, 1992 y 1993.</p>

<p>Son campañas en la Copa de Europa, con cruces ante los mejores del continente, llenos a reventar en el Centro Insular, máximo esplendor dentro y fuera de España y un desfile de nombres que se hicieron un sitio en el corazón de todos los aficionados. A los ya conocidos de Camarero, Juanma Martín, Jorge Ramón, Sánchez Jover, Miralles, Costa, Klos o Golec, se unieron los Sharma, Falasca o Wiernes.</p>

[imagen_contenido file="3cap_asi_foto_pabellon.jpg" caption="Los partidos en el CID eran una manifestación de entusiasmo y pasión popular por el equipo."]

<p>Particular mención merecen Sánchez Jover y Juanma Martín, consagrados al simultanear sus labores de jugador con las de técnicos y de igual fertilidad para los éxitos de la entidad, poniendo, también, el foco en el cuidado de la cantera. Ya entonces, en ese inicio de la década de los noventa, se reclutan por los colegios (y hasta por la calle, a golpe de intuición) a jóvenes de la tierra para que garanticen el relevo generacional y revaliden el espíritu primigenio del Calvo Sotelo, creado en torno al jugador isleño. Antonio Sánchez es uno de los canteranos criados en esta fase y que tendría larga continuidad en los Alexis Valido, Juan Carlos Vega, los hermanos Cabrera, Raúl Dávila o Níchel Gómez, entre otros.</p>

[imagen_contenido file="3cap_asi_foto10.jpg" caption="Los técnicos argentinos Marcelo Giovannacci y Quique Edelstein, figuras de importancia a comienzos de los noventa por los títulos logrados bajo sus ciclos."]

[imagen_contenido file="3cap_asi_foto_invasion.jpg" caption="Invasión de pista por parte de la afición tras un memorable triunfo."]

<p>Fueron doce los títulos que se atraparon desde 1989 a 1997, etapa de concentración luminosa, y que granjeó la leyenda de un Guaguas que, por momentos, llevó la bandera del deporte en Gran Canaria, al coincidir sus hitos con momentos menos pujantes de UD Las Palmas o CB Gran Canaria, los símbolos más tradicionales de las disciplinas por equipos de la isla.</p>

<p>Iniciativas pioneras como lucir publicidad en contra de las drogas, abrir las puertas del pabellón a todos los que quisieran entrar sin pagar precio alguno, como sucedió ante el PSG, o democratizar la práctica del voleibol creando alianzas y convenios con clubes de la geografía local impulsaron, más si cabe, la fama y prestigio de un club también profesionalizado y gestionado por un modelo administrativo riguroso y que en los años de presidencia de Juan Ruiz siempre arrojó balances favorables, con niveles de endeudamiento asumible y un apoyo unánime del sector empresarial.</p>

<p>Los llenos habituales en el Centro Insular, a la par que las más que frecuentes retransmisiones en directo por la televisión, convirtieron las vallas publicitarias en soportes codiciados y que redundaron, para bien, en los dineros del Guaguas. Eso permitió mantener una base de primera categoría cada temporada y unir, cuando procedía, a refuerzos de contrastada calidad.</p>

<p>La creación de una cultura ganadora, que convertía en noticia y crisis cada título que se escapaba, habla a las claras del listón en el que se movió el club, siempre orientado a construir plantillas que aspiraran a todo y sin eludir la presión que aparejaba tener el balance de galardones que se exhibía.</p>

[imagen_contenido file="3cap_asi_foto1.jpg" caption="Ofrenda de la Liga 1993-94 a la Virgen del Pino. Sánchez Jover, Jorge Ramón, Milanov, Golec, Falasca, Colom, Antonio Sánchez, Valido, Campos, Juan Ruiz y Costa."]

[imagen_contenido file="3cap_asi_foto_extasis.jpg" caption="Éxtasis sobre el parqué."]

[imagen_contenido file="3cap_asi_foto_golec_camarero.jpg" caption="Costa, Golec y Miralles observan a Camarero."]

[imagen_contenido file="3cap_asi_foto_cid_felicidad.jpg" caption="El CID se convirtió en la capital de la felicidad gracias al Guaguas."]

[imagen_contenido file="3cap_asi_foto_alegria2.jpg" caption="Alegría con los éxitos que se iban cosechando a finales de los ochenta."]

[seccion_header color="hsl(2 82% 30%)"]III. La salida de Juan Ruiz, principio del fin[/seccion_header]

<p>Tras doce años en la presidencia y algún amago de abandono prematuro, tal y como reconoció a cuenta de críticas que consideraba desproporcionadas, Juan Ruiz quiso respetar lo reflejado en los estatutos y ceñirse a lo establecido con la máxima durabilidad de su cargo. A la conclusión de la temporada 1997-98, saldada con la Supercopa de España, dio el relevo en la cúpula a Mario Hugendubel. Fue algo más que un traspaso de poderes para alguien que dedicó su vida al servicio de un club que heredó en ruinas y legó en una posición de privilegio.</p>

<p>Títulos (doce en total), cantera (ya con internacionales absolutos salidos de las categorías inferiores), superávit, crédito en entidades privadas y credibilidad a ojos de los organismos públicos. Un Guaguas respetado en España y en Europa (con participaciones en competiciones continentales de manera ininterrumpida desde 1987) y con las bases para continuar su expansión, dada la estructura existente y el nivel de profesionalización instaurado. Fueron muchas las voces que trataron de disuadir a Juan Ruiz del paso que iba a dar, quizás intuyendo que sin él nada sería igual, como así ocurriría.</p>

[cita_editorial author="Paco Sánchez Jover"]Todo cambió y para peor.[/cita_editorial]

<p>De repente, ya con el presidente histórico fuera, el sentimiento de orfandad fue inmediato, por muchos esfuerzos que pusiera Hugendubel, quien trató de ilusionar desde sus primeras manifestaciones.</p>

<p>Admite Sánchez Jover, que permanecería en el club hasta el verano de 1999. Su presencia se consideraba de especial valor estratégico para la pervivencia del proyecto, tanto en la rama sénior como en las categorías de base. Y, tras dos años como testigo de "la deriva", según sus palabras, que fue cogiendo el club bajo otros parámetros directivos. El cambio de siglo deparaba la marcha del último gran símbolo del Calvo Sotelo.</p>

<p>Tras Felipe Nuez (1988), Sergio Miguel Camarero (1996) y Juan Ruiz (1998), el gigante que hizo feliz al Centro Insular clausuraba un ciclo de doce años con otros tantos títulos y episodios únicos y que le ligaron por siempre a esta tierra.</p>

[imagen_contenido file="3cap_asi_foto12.jpg" fullwidth="true" caption="Ganadores de la primera Liga en el curso 1989-90. De pie, Chinea (delegado), Jesús Sánchez Jover, Klos, Golec, Paco Sánchez Jover, Miralles y Venancio Costa. De rodillas, Jorge Ramón, Óscar Campos, David Rodríguez, Juanma Martín, Chava y Camarero."]

[seccion_header color="hsl(2 82% 30%)"]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1985</span><div class="timeline-content">El 2 de noviembre, y ante el Licenciados Reunidos en Cáceres, el Calvo Sotelo disputa su primer encuentro en la División de Honor con victoria (0-3).</div></div>
<div class="timeline-event"><span class="timeline-year">1986</span><div class="timeline-content">El 21 de octubre se celebra la asamblea general extraordinaria del club en la que Juan Ruiz tiene su primera toma de contacto formal con la junta gestora. Días después anunciaría el histórico acuerdo con Guaguas Municipales para que patrocinase y diera su nomenclatura al equipo, gestión exitosa que le terminaría catapultando a la presidencia.</div></div>
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content">Tercera posición en la Copa del Rey (enero), fichajes de Paco Sánchez Jover, Venancio Costa y Antonio Miralles (julio) y estreno en competiciones europeas ante el Knack de Bélgica (noviembre).</div></div>
<div class="timeline-event"><span class="timeline-year">1988</span><div class="timeline-content">Subcampeonatos de Liga y Copa del Rey y salida del club del histórico preparador Felipe Nuez tras más de quince años.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content">El 9 de abril se conquista el primer título, con la Copa del Rey ganada al Palma en el Centro Insular (3-0). En verano se producen los fichajes de los polacos Ireneusz Klos y Waclaw Golec.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content">El 1 de mayo se gana la primera Liga, con Paco Sánchez Jover como jugador-entrenador, con un rotundo 3-0 al Bomberos de Barcelona en el Centro Insular.</div></div>
<div class="timeline-event"><span class="timeline-year">1991</span><div class="timeline-content">Año con un mes de abril mágico con el primer doblete: Liga el día 13 ante el Orisba Palma (3-0) y la Copa, el 28 frente al Construcciones Alcalá de Tenerife por idéntico tanteador.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content">Se repite la gesta con los dos torneos nacionales: Liga el 4 de abril ante el Andorra (3-1) y Copa, el 25 del mismo mes y repitiendo rival por 3-0.</div></div>
<div class="timeline-event"><span class="timeline-year">1993</span><div class="timeline-content">La supremacía nacional del equipo se constata por tercera campaña consecutiva y alzando los dos trofeos lejos de Gran Canaria: Liga en Soria ante el Caja Duero (2-3) y Copa del Rey en Murcia sometiendo al Almería por 2-3.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content">Continúa el reinado en la Liga con un triunfo en Soria ante el Grupo Duero por 1-3, acaecido el 27 de marzo, que vale el quinto campeonato consecutivo.</div></div>
<div class="timeline-event"><span class="timeline-year">1995</span><div class="timeline-content">El 8 de septiembre, en un amistoso ante el conjunto brasileño del Banca Suzano, se rindió homenaje en el Centro Insular a Paco Sánchez Jover tras su retirada como jugador.</div></div>
<div class="timeline-event"><span class="timeline-year">1996</span><div class="timeline-content">Nueva Copa del Rey: llega el 13 de abril, ante el Soria, en el Centro Insular (3-2), un partido emotivo, pues sería el último de leyendas como Klos, Golec o Camarero. También se logra la primera Supercopa de España, el 16 de septiembre, igualmente en el Centro Insular y repitiendo adversario (3-1).</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content">Con una remontada memorable, el 5 de abril en el Centro Insular, el Gran Canaria Arehucas se apunta otra Copa frente al Unicaja Almería (3-2).</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content">Tres hechos trascendentales marcan el año: el homenaje a Sergio Miguel Camarero (7 de enero, con un amistoso ante el Zonhoven belga), la participación en la Final Four de la Recopa en Cuneo (Italia), el mayor hito en Europa alcanzado por el equipo, y Juan Ruiz pone fin a su presidencia tras doce años de sobresaliente gestión deportiva y empresarial.</div></div>
<div class="timeline-event"><span class="timeline-year">1999</span><div class="timeline-content">En el verano de ese año, finalizada la campaña 1998-99, Paco Sánchez Jover, hasta ese momento entrenador, abandona el club.</div></div>
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
            'image' => libro_img('4cap_hero.jpg'),
            'overlay' => 'rgba(26, 35, 126, 0.85)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'icon_width' => 60,
            'icon_height' => 60,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('EL PROYECTO', '#D4AF37', '', 'black'), libro_hero_line('VISIONARIO', '#FFFFFF', '', 'black'), libro_hero_line('DE JUAN RUIZ', '#D4AF37', '', 'black')),
        ),
        'content' => ''),
    array('title' => 'El proyecto visionario de Juan Ruiz', 'numero' => '', 'order' => 37, 'show_marker' => false, 'parent_ref' => 'cap04',
        'anclas_internas' => "La génesis de su proyecto en cronología | genesis-cronologia",
        'hero' => array(
            'image' => libro_img('4cap_proy_hero.jpg'),
            'background_color' => '#000000',
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('EL PROYECTO VISIONARIO', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none'), libro_hero_line('DE JUAN RUIZ', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[imagen_contenido file="4cap_proy_juanruiz_color.jpg" caption="Juan Ruiz, el presidente visionario que construyó el proyecto ganador del Guaguas."]

[imagen_contenido file="4cap_proy_foto3.jpg" caption="Festejando el histórico subcampeonato de Copa de 1988 en sus tiempos iniciales como presidente. Juan Ruiz es el primero en la fila inferior por la derecha y está abrazado por Jorge Ramón."]


<p>Nacido en La Aldea de San Nicolás en 1953, emigrante con su familia a Tenerife durante gran parte su adolescencia (1960-1969), en la que hizo sus pinitos en la lucha canaria o el fútbol (“con 16 años llegué a jugar en Tercera División en las filas del Adeje”), Juan Ruiz estaba llamado, sin saberlo, a escribir una historia sin parangón en el deporte canario y al frente del Calvo Sotelo. No hay dirigente isleño con tal nómina de títulos en su poder, todos los conquistados por la entidad, y con el mérito añadido de haber armado un equipo campeón desde las cenizas. Tanto en 1986 como en 2020 acudió al rescate recogiendo una tesorería en ruinas y un porvenir tan comprometido que apuntaba a la desaparición. Ciertamente, en su regreso, dos años atrás, se vio obligado a refundar la institución para poder reactivarla y tras una década liquidada. Fue el más difícil todavía de una carrera de superaciones en la que, reconoce, se ha dejado “la vida”. Solo así, desde el compromiso “absoluto y sin otro propósito que el de servir”, y añade “sin recibir un céntimo a cambio jamás”, ha entendido Juan Ruiz sus dos periodos de gobierno, ambos exitosos y en los que su modelo de gestión económica y deportiva le han valido el reconocimiento unánime de la sociedad grancanaria en todos los ámbitos.</p>

[cita_editorial author="Juan Ruiz"]El secreto es trabajo y pasión. Constancia y ambición. No rendirse jamás. Si para conseguir un patrocinador tengo que visitar veinte empresas, acabo entrando en cuarenta. Si para ser campeón me tengo que traer a una estrella, trato de que sean dos. Y si el club necesita de mí cinco horas al día, acabo dándole el doble. Así empecé, así seguí, así me fui y así regresé. Movido por la ilusión, por hacer feliz a la gente, por construir. Entiendo la vida queriendo que los sueños se cumplan. No siempre se puede, pero tienes que intentarlo por muchos obstáculos y dificultades que se te pongan delante”, explica.[/cita_editorial]

[imagen_contenido file="4cap_proy_foto9.jpg" caption="Junto a Antonio Benítez, su hombre de confianza en la gerencia del Guaguas, en la sede de la entidad, a inicios de los noventa."]

<p>El punto de partida de este fértil y exitoso ciclo en el palco, en un hombre “sin tradición alguna en el voleibol”, arranca de manera “casi casual y del todo inesperada”. Año 1986. Desde su estabilidad laboral como apoderado de la empresa Napesca, Juan Ruiz sigue a la distancia, “como un aficionado más”, las evoluciones de los distintos clubes de Gran Canaria. “Siempre me ha gustado el deporte y estaba al día de todo”, reconoce sin pretender, como así fue, embarcarse en un proyecto que marcaría su vida. Fiel a su costumbre de desayunar en la cafetería del periódico La Provincia en el polígono industrial de El Sebadal, allí coincidía cada mañana con informadores del medio, debatían temas de actualidad, resultados... “Era habitual oyente de Paco García Caridad, que estaba en Antena 3 Radio. Nos saludábamos, hablábamos a menudo de manera desenfadada... Hasta que un día me comentó que un histórico, el Calvo Sotelo, estaba a punto de desaparecer. Que necesitaba alguien que echara una mano... O dos. Porque la situación era de extrema gravedad”.</p>

[cita_editorial author="Juan Ruiz"]Por lo que fuera, me sentí en la obligación de hacer algo. Me movió una motivación de responsabilidad. Me reuní con Felipe Nuez, estaba también Ivo Martinovic. Me explicaron la situación. Lo primero que hice fue hablar con el director de Cajacanarias de Tenerife. Buscaban ampliar su mercado e implantarse en Gran Canaria. Les dije que nada mejor para adquirir publicidad que invertir en un club de tradición y que le daría impacto. Aceptó y dieron 500.000 pesetas, un alivio para cómo estaba todo. Mantuve varias conversaciones luego con Gustavo Rodríguez, entonces presidente de la junta gestora, con Ismael Chinea, con Nuez. Les comenté que yo podía entrar en la directiva. No pensaba ser presidente. No quería ni necesitaba notoriedad porque mi vida la tenía cubierta con mi trabajo. Pero resulta que ninguno podía asumir las funciones ejecutivas que se requerían para buscar fondos y anunciantes que le dieran músculo financiero al club. Había que visitar, también, a representantes del Cabildo, ayuntamientos, la Dirección General de Deportes y otros organismos para explicarles el proyecto... Y eso implicaba una disponibilidad que sí la tenía yo por mi horario laboral. Total, vine para ayudar y me pusieron al frente de todo”, sintetiza.[/cita_editorial]

<p>Pronto, recién aterrizado en la junta gestora, se apunta otro logro de capital importancia estratégica: la firma del patrocinio de Guaguas Municipales y que venía a solucionar una problemática que acuciaba la vida institucional con la falta de un sponsor, motivo que ya había sido expuesto con honda preocupación por parte de los dirigentes.</p>

[imagen_contenido file="4cap_proy_foto7.jpg" caption="Nervios en el palco durante un partido disputado en el Centro Insular."]

[imagen_contenido file="4cap_proy_foto4.jpg" caption="Visita a la redacción del periódico La Provincia, que fue uno de los primeros patrocinadores en los primeros años de la presidencia de Juan Ruiz, tras la conquista de la Copa del Rey de 1989."]

[imagen_contenido file="4cap_proy_foto8.jpg" caption="Recepción oficial en el Cabildo de Gran Canaria presidido por Carmelo Artiles y con motivo de la Liga conquistada en 1991."]

[seccion_header color="inverted"]El fichaje de Sánchez Jover y la construcción del equipo campeón[/seccion_header]

<p>Tenía 33 años y, “desde el primer momento”, tuvo claro el mandamiento que siempre regiría sus movimientos y gestiones: “Ganar, ganar y ganar”. Ruiz orienta cada maniobra a buscar “el máximo” y no duda en explorar posibilidades que parecían prohibidas. Así lo ejemplifica:</p>

[cita_editorial author="Juan Ruiz"]Le pregunté abiertamente a Nuez por el mejor jugador de España. Me dijo que era Paco Sánchez Jover. Le contesté que entonces habría que traerlo. Y me miró como si hubiese dicho un disparate. Me aseguró que era imposible. Me planté en Palma, hablé con él. Y en el Puerto de Santa María, donde jugaba con la selección española un Preeuropeo, pude cerrar todo. Le convencí de que viniera con nosotros sin poder alcanzar o igualar el contrato que tenía en el Palma. Pero le hablé de liderar un proyecto que iba a ser el mejor del país, que sería nuestro líder, que iba a vivir en un sitio maravilloso, que la afición le haría sentirse único... Paco siempre ha sido una persona muy inteligente y entendió lo que yo quería decirle de manera instantánea. Nadie creía que el Calvo Sotelo podía fichar a la gran estrella de España. Pues nos los trajimos junto a Venancio Costa y Antonio Miralles, otros dos fenómenos.[/cita_editorial]

<p>El impacto mediático que tuvo esta operación rápidamente se tradujo en un mensaje al resto: “Habíamos llegado para ser los mejores”, indica. Y lo que parecía una jugada maestra aislada, el golpe de efecto de unir a sus filas a tres internacionales absolutos con España, alcanzaría el grado superlativo cuando, también de una tacada, ya en 1989, son los polacos Ireneusz Klos y Waclaw Golec, también figuras mundiales, quienes aterrizan en Gran Canaria.</p>

[cita_editorial author="Juan Ruiz"]En la primera temporada completa en la que estuve de principio a fin, la 1987-88, quedamos subcampeones de Liga y de Copa. Y fue un hito. Jamás se había llegado a pelear por títulos de esa manera. Eso demostró que se podía, nos había faltado un último paso. La base de años anteriores, con la gente de la casa, más la aportación de Paco, Venancio y Miralles iba destinada al éxito. La clave era mantener un bloque e ir sumando piezas de calidad, crecer temporada a temporada. La destitución de una figura de la relevancia de Felipe Nuez fue, de largo, el momento más crítico de esa campaña. No resultó fácil prescindir de él y prueba de ello es que no acertamos con un inquilino en el banquillo en los años siguientes, primero con el mexicano Sergio Hernández y, posteriormente, con la apuesta por el americano Robert Croteau. Pero ese primer balance, salvando lo de Felipe, no pudo ser mejor. El club pasó de estar al borde de la desaparición a discutir títulos, regenerar una afición perdida, que acabó trasladándose con nosotros del San Román al Centro Insular, cuando abrió sus puertas en 1988, y tener en sus filas una mezcla de juventud, cantera y estrellas que terminaría, como no podía ser de otra manera, dando sus frutos. Y, lo que también me producía un orgullo especial: jugar y competir contra los mejores de Europa”, reseña.[/cita_editorial]

[seccion_header color="inverted"]Un modelo de gestión basado en la intuición y la constancia[/seccion_header]

[imagen_contenido file="4cap_proy_foto6.jpg" caption="Comparecencia pública en una presentación del equipo."]

<p>Su modelo presidencialista de entonces, como el de ahora, se basaba en “la intuición, la capacidad de anticipación y delegar, aunque la decisión de calidad corresponda siempre al que más manda”. En puridad, no se trata de “imponer por imponer”, como razona convenientemente:</p>

[cita_editorial author="Juan Ruiz"]Creo con firmeza en la participación de todos los miembros de la directiva, en la fuerza del equipo dentro de la pista pero también fuera, en la labor ejecutiva. Predicar con el ejemplo.[/cita_editorial]

<p>Otra de sus máximas, relacionadas con el aspecto financiero, el que da sostenibilidad a los proyectos, se fundamenta en “no dar nunca nada por perdido”, por mucho que las coyunturas económicas sean adversas e impliquen dificultades añadidas para lograr patrocinios:</p>

[cita_editorial author="Juan Ruiz"]Logramos firmar un acuerdo que nos salvó con Guaguas Municipales, a finales de 1986, y, desde entonces, siempre sorteamos todo tipo de impedimentos para que el club mantuviera una estructura y competitividad gracias al apoyo de la pequeña y mediana empresa. Constructora Canaria, Editorial Prensa Ibérica, Pepsi, Arehucas... Incluso fuimos pioneros en llevar una campaña en contra de las drogas sin contraprestación alguna. Tanto en los inicios de la primera etapa como cuando decidí regresar encontré malas previsiones, pesimismo. Nadie creía que podíamos hacer un equipo campeón con la herencia que nos dieron y fue posible gracias a la determinación y fe que pusimos. Tocamos la puerta de todas las empresas y somos muy sensibles a los apoyos que nos dan. Cuando hemos ganado títulos, he puesto especial énfasis en ir con los trofeos a visitar a la gente que ha creído en nosotros para hacerles saber el fruto de su inversión. Aunque algunos aporten más o menos. Me quedo con el gesto de abonarse, de brindarnos la ayuda que se pueden permitir. Valoro muchísimo el gesto de ayudarnos, de creer en nosotros. Teníamos credibilidad en bancos, empresas e instituciones. Nos la ganamos.[/cita_editorial]

<p>La consecución paulatina de títulos, cinco Ligas consecutivas entre 1990 y 1994, a las que hay que añadir la última en 2021, las Copas y las Supercopas, también con renovación reciente del trono, la contempló “como la justa recompensa a un duro trabajo de equipo” y en el que “todos son fundamentales por su implicación”.</p>

[cita_editorial author="Juan Ruiz"]En los noventa llegamos a ser el primer equipo de la isla por delante de la UD Las Palmas. También es justo recordar que coincidió con una etapa mala de la UD, en Segunda B y cierto desapego social. Nosotros llenábamos el CID, éramos los mejores de España y en Europa nos habíamos ganado un prestigio que notábamos cada vez que viajábamos, como cuando fuimos a París a enfrentarnos al PSG y nos esperaban al aterrizar multitud de medios de comunicación. Y en aquel momento, no tuve reparo alguno en proponerle a Luis Sicilia, presidente de la UD, y a Lisandro Hernández, presidente del Gran Canaria, que unificáramos bajo un mismo escudo un gran club representativo. Siempre creí en la unión y pienso, como pensaba, que era una iniciativa viable. Por lo que fuera no se dio, pero en esa coyuntura era la mejor de las posibilidades para el deporte en nuestra isla, porque, incluso, se planteaba, igualmente, integrar el balonmano”, aclara.[/cita_editorial]

<p>El Calvo Sotelo, con sus distintas denominaciones, siguió su camino bajo el mandato de Juan Ruiz hasta 1998, convirtiéndose en club referencial por su crecimiento y palmarés, con la dificultad añadida de tener que superarse año a año.</p>

[cita_editorial author="Juan Ruiz"]Las mejores lágrimas de la gente son las de la alegría. Y ver a miles de personas emocionadas y llorando de felicidad en el CID, las que podían entrar, porque muchas se quedaban fuera al estar el aforo completo, cuando levantábamos un título, era el mejor incentivo para seguir. Evidentemente, renovar los éxitos y acertar con los fichajes en su integridad es algo imposible en el deporte profesional. Nosotros lo intentamos, competimos con clubes españoles y extranjeros que nos superaban en presupuesto, pienso que sensibilizamos a los organismos públicos aunque no terminaran de darnos la respuesta que merecíamos en materia de ayudas y subvenciones y fue muy meritorio mantener a jugadores tentados cada verano con cifras que mejoraban lo que tenían aquí y, al tiempo, traer refuerzos de un nivel indiscutible. El dinero siempre ha sido un factor muy importante, pero en las dos etapas doradas del club, la de finales de los ochenta y noventa, y la actual, puedo afirmar que no lo ha supuesto todo porque hemos sido los mejores sin disponer de los medios financieros de algunos de nuestros rivales.[/cita_editorial]

<p>La primera Copa del Rey, aquella Liga inaugural frente al Bomberos de Barcelona, la fiebre que despertó el equipo colmando cada pabellón que pisaba...</p>

[cita_editorial author="Juan Ruiz"]Elegir momentos es complicado. Son muchísimos y muy buenos, inesperados en muchos de los casos. Recuerdo a mi padre decirme que qué necesidad tenía yo, sin cobrar un duro, de estar siempre al pie del cañón y recibir, en momentos puntuales, críticas que fueron dolorosas. Pero la voluntad de servicio todo lo puede y puedo presumir de haber tenido el apoyo de fieles compañeros de viaje, leales a la causa, de jugadores que se dejaron la vida en la pista, ganaran o no.[/cita_editorial]

[seccion_header color="inverted"]Sánchez Jover y Camarero, los nombres por encima de todos[/seccion_header]

[imagen_contenido file="4cap_proy_foto_brindis.jpg" caption="Brindando con Sánchez Jover tras la gesta protagonizada en 1998 en competiciones europeas."]

[imagen_contenido file="4cap_proy_foto_camarero_homenaje.jpg" caption="Agasajando a Camarero en el partido de homenaje que le organizó el club en reconocimiento a su trayectoria y servicios."]

[imagen_contenido file="4cap_proy_foto_escudo.jpg" caption="El presidente, presumiendo de escudo en las instalaciones del Gran Canaria Arena."]

<p>Paco Sánchez Jover y Sergio Miguel Camarero son los nombres que pone por encima de todos y lo razona con amplitud:</p>

[cita_editorial author="Juan Ruiz"]Para muchos jugadores era como un padre y, reconozco, a muchos los quise como a hijos. Pero Paco, que vino de fuera pero se hizo de los nuestros nada más pisar Gran Canaria, y Sergio, que salió de nuestra cantera y es parte del escudo por su recorrido, me marcaron. Años y años de convivencia y siempre coincidiendo en lo esencial, en la defensa del club. Con momentos tensos, mejores y peores, como pasa en la vida, como pasa en el deporte. Fueron jugadores y ejercieron como entrenadores ganando títulos, dando un ejemplo de lealtad y de compromiso. En su día renunciaron a más dinero por seguir aquí y, sin desmerecer a otros compañeros que también fueron grandes figuras, no me equivoco si digo que mucho del respeto que nos ganamos se debía a ellos. No entiendo el Guaguas sin Paco ni Sergio. Ni yo ni nadie. Es un acto de justicia que volvieran después de que, obligados por las circunstancias, tuvieran que irse. Particularmente me siento muy feliz de que decidieran volver conmigo y en un gesto que demuestra, a las claras, lo que sigue siendo el club para ellos. Es muy complicado en el deporte profesional y en los tiempos que corren encontrar ejemplos como ellos. Para mí es un orgullo haber compartido con estos dos deportistas ejemplares tantos años y tantas vivencias. Entendemos de la misma manera el deporte: somos trabajadores, luchadores y ganadores. Ya los considero de mi familia.[/cita_editorial]

[seccion_header color="inverted"]La marcha, la desaparición y el regreso[/seccion_header]

[imagen_contenido file="4cap_proy_foto2.jpg" caption="La entrada de Guaguas Municipales como patrocinador del club fue uno de los primeros logros de Juan Ruiz."]

<p>De 1986 a 1998, año en el que decide dejarlo "porque ya tocaba y, además, así lo establecían unos estatutos que se respetaron", Juan Ruiz se siente particularmente realizado por "contribuir a la felicidad de la gente", al considerar que el Guaguas "cumplió con su rol de dar a la sociedad alegrías, sentimiento de pertenencia y unión y el premio de los campeonatos".</p>

<p>"Cuando decidí irme, entregué las llaves de la sede y con lágrimas en los ojos mantuve mi decisión, eso era lo que más me dolía. Nunca tuve apego al cargo. A ningún cargo, en realidad. Y lo que sabía que más iba a extrañar era el pulso de la calle, el interactuar con la gente. Y así ocurrió. Dejé de ir al pabellón porque sufría, pero me seguían parando para contarme anécdotas, hacerme partícipes de sus vivencias. Siempre he sido muy sensible a eso y me emocionaba. Creo que es el mejor legado que te queda tras tantos fichajes, títulos, viajes, victorias, recepciones oficiales... Que el Guaguas haya llevado sonrisas y buenos momentos a los hogares canarios es algo insuperable", pondera.</p>

<p>A su marcha, dejó dicho que "en caso de necesidad, el teléfono estaba abierto", ya que, por encima de personalismos, seguía "comprometido" con la entidad aunque estuviese fuera. "Dejé dos millones de pesetas en caja, vallas publicitarias pagadas, patrocinadores comprometidos, el prestigio intacto ante autoridades políticas y deportivas. Una base para salir adelante. Pero no sirvió de nada", lamenta. Le tocó vivir la decadencia deportiva e institucional, algo que derivó en la desaparición en 2009. "Lo que más dolió es que no me vinieron a buscar para echar una mano en ese proceso de crisis y únicamente me llamaron cuando la deuda era insostenible. Estoy seguro de que si hubiesen hecho lo que les dije, de avisarme en caso de necesidad, alguna solución se habría habilitado. Pero no fue así y, por lo que fuera, dejaron morir un club que no se lo merecía", añade.</p>

<p>Ese sentimiento de rabia contenida le hizo incubar la idea de volver, pese a "muchas opiniones en contra al no tener nada que ganar y mucho que perder". Insiste en que, por razones de edad ("con 67 años yo no estaba para aventuras"), "todo fue muy meditado". "Hablé con Sergio y Paco. Les dije que si dábamos el paso era para hacer un Guaguas campeón. Estuvimos de acuerdo desde el primer momento. Quería que Paco fuese el presidente, pero su condición de empleado público habría puesto impedimentos en la solicitud de subvenciones. Por eso me puse yo al frente, con Sergio como entrenador, una función que teníamos decidida. Paco nos cedió la plaza del equipo que presidía en Vecindario para evitarnos la larga travesía que hubiese supuesto una refundación desde cero. Fue una nueva contribución suya en favor del escudo de su vida".</p>

<p>"Todo coincidió con la pandemia -continúa-, pero no me vine abajo. Rastreamos el mercado de jugadores, fuimos a por los mejores que nos podíamos permitir, hice las gestiones como en los viejos tiempos, a base de llamadas y constancia. No nos dejamos contagiar por el clima de pesimismo que había y, al final, los resultados están ahí. Volvimos a la cima y sin el público que tanto queríamos por las restricciones del coronavirus. Ganar sin gente en la grada se hizo raro, pero tuvimos que adaptarnos y tirar para adelante. Entramos en el Top-20 mundial del voleibol, mantuvimos la base ganadora y añadimos fichajes que nos han permitido subir el nivel más. La temporada 2020-21 fue inmejorable y arrancamos la 2021-22 con la Supercopa y a un rendimiento ilusionante", detalla.</p>

<p>Europa sigue siendo la asignatura pendiente y Juan Ruiz enfoca sus cuentas por cuadrar a levantar un título continental, materia que se le ha resistido hasta ahora, con momentos especialmente dolorosos como la eliminación ante el PSG, a inicios de los noventa, por la alineación indebida de un entonces juvenil Alexis Valido ("perdimos en los despachos lo que ganamos en la cancha con una actuación impresionante y eso quedó como algo que a todos nos hizo daño") o la Final Four de la Recopa en Cuneo (Italia) en 1998, que se saldó con dos derrotas amargas pese a que se esperaba una participación más brillante en esa edición.</p>

[cita_editorial author="Juan Ruiz"]No dudo de que ese momento llegará porque nos lo deben. Cuando llegamos a la Final Four dije que Dios me debía eso, poder disputar una fase final de un título europeo. Sigo diciendo que Dios me debe un título europeo y creo que va a llegar. Cada vez estamos más cerca y lo conseguiremos.[/cita_editorial]

<p>Más allá de su legado en las vitrinas, en la adquisición de leyendas y en el periplo internacional que siempre le dio a sus proyectos ("como embajadores de Canarias por toda Europa") como componentes de un ciclo dorado, Juan Ruiz aspira a que se le recuerde como alguien "que no vino al deporte a servirse, sino a servir, y con la idea de hacer feliz a la gente". Tan sencillo y tan complejo a la vez.</p>

[seccion_header id="genesis-cronologia" color="inverted"]La génesis de su proyecto en cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content"><strong>Patrocinios y fichas estelares</strong>“Estamos en una nube con muchos cimientos. Aquí hay un club con cantera, con una estructura deportiva muy sólida basada en excelentes técnicos, y hay también unas buenas razones económicas que se gestan con una administración del club que considero muy responsables. Felipe Nuez me facilitó a principios de temporada una lista de jugadores para hacer al equipo campeón de Liga. Hemos traído quizá a los mejores”. <em>(La Provincia, 17 de julio de 1987)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content"><strong>El primer título como estímulo</strong>“Este es el triunfo del trabajo y del esfuerzo de muchos años, comenzado por otros, como José Luzardo, Antonio Trejo o Felipe Nuez, y rematado por nosotros y por nuestra afición. Es el triunfo de todos y un gran día para el voleibol canario”. <em>(Diario de Las Palmas, 10 de abril de 1989)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content"><strong>El hallazgo de Golec y la defensa de Camarero</strong>“Me gusta mucho el número 11 de la selección polaca, Golec, un gran rematador de potente salto, especialista en remates de zona cuatro y zagueros, con gran recepción. El objetivo que nos planteamos es la obtención de un título nacional como mínimo”. <em>(Canarias7, 23 de agosto de 1989)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>Éxito deportivo y compromiso social</strong>“Lo de la campaña pasada fue logrado con gran merecimiento. Después de cuatro años de gran trabajo, el título de Liga tenía que llegar. También entiendo que para nuestro equipo ha sido un triunfo ser la única entidad deportiva del país que ha abierto una brecha contra la droga”. <em>(La Provincia, 6 de julio de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>El sueño cumplido de jugar la Copa de Europa</strong>“No gana el que más presupuesto tiene sino el que más trabajo derroche. Es un gran reto, asimismo, representar a Canarias por vez primera en la Copa de Europa, un prestigio y orgullo que deseamos para el resto de los equipos de élite grancanarios”. <em>(Canarias7, 13 de septiembre de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content"><strong>Elogio de la afición</strong>“El público ha estado maravilloso. Solo le faltó rematar los balones en la cancha. El Gran Canaria merece que se le apoye porque tenemos a la juventud con nosotros. Este club no va a quedar a la deriva”. <em>(Canarias7, 5 de abril de 1992)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content"><strong>La responsabilidad directiva</strong>“Debemos tener en cuenta que este es el único conjunto canario al que le han televisado varios partidos en Europa, damos una gran difusión a esta tierra, y por contra recibimos poco”. <em>(Diario de Las Palmas, 27 de abril de 1992)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1992</span><div class="timeline-content"><strong>Una representatividad única</strong>“No creo que después del esfuerzo que hemos realizado todos los componentes del Gran Canaria, el Ejecutivo canario pueda abandonarnos a la buena de Dios, cuando nuestro equipo promocionará el nombre del Archipiélago por toda Europa”. <em>(Canarias7, 14 de diciembre de 1992)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>6.000 aficionados en el CID</strong>“Nuestra intención con la gratuidad de la entrada era la de ofrecer un homenaje a la afición y no creímos que fueran a venir más de 6.000 personas”. <em>(Canarias7, 21 de enero de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1995</span><div class="timeline-content"><strong>Reinvención, nunca rendición</strong>“Los jugadores han perdido la erótica de la ilusión y eso es fundamental para ser campeones. Un paso atrás invita a reflexionar para luego dar muchos hacia adelante. Queremos en el equipo jugadores con hambre de títulos y también en las gradas una afición que vuelva a hacer de Las Palmas el centro del voleibol nacional”. <em>(La Provincia, 30 de abril de 1995)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1996</span><div class="timeline-content"><strong>Continuidad necesaria</strong>“En dos ocasiones estuve tentado de abandonarlo todo. Pero si cuando pierdes te marchas es de cobardes, por eso continué, porque el día que me marche lo debo hacer con el equipo campeón”. <em>(Canarias7, 7 de octubre de 1996)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>El apoyo definitivo</strong>“Guaguas ha hecho una gran inversión y, además, con ellos finalizaré mi mandato el año que viene”. <em>(Canarias7, 21 de junio de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Aunque el corazón no aguante</strong>“A pesar de los problemas de corazón que sufrí tras los partidos de Eslovenia y frente al Olympiakos, yo decidí acompañar al equipo y me han dado una gran alegría”. <em>(Diario de Las Palmas, 18 de febrero de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>La culminación de la Final Four</strong>“Ha sido un partido donde casi siempre hemos estado por debajo. El público, fundamental, me recordó al del día del Paris Saint Germain. La Final Four ya está conseguida, y ahora todo lo que venga será un premio añadido”. <em>(Diario de Las Palmas, 26 de febrero de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Una despedida con legado</strong>“He visto a mucha gente llorar de emoción y tristeza en el Centro Insular de Deportes, y eso es imborrable. Ahora estamos en el momento de volver a empezar, pero que se recuerde que venimos de jugar una Final Four hace unos meses”. <em>(Canarias7, 4 de diciembre de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2020</span><div class="timeline-content"><strong>La repercusión del regreso</strong>“Vamos con la intención de ir a por todas y para ello tenemos todos que trabajar más que los demás y entrenar más que los demás. Cada día estamos más contentos. Estamos muy satisfechos de las expectativas que está generando el poder volver a ver al Guaguas competir a nivel nacional y europeo”. <em>(Canarias7, 18 de junio de 2020)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2020</span><div class="timeline-content"><strong>Una historia que respetar y dignificar</strong>“Con casi 70 años no estoy para aventuras, esto es un equipo ganador. Cuando fuimos a París para jugar contra el PSG nos acompañó Aniceto Rodríguez. Cuando llegamos al aeropuerto nos llevaron a una sala de prensa y ellos nos dijeron que éramos el Real Madrid del voleibol”. <em>(La Provincia, 9 de septiembre de 2020)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2021</span><div class="timeline-content"><strong>Laureles renovados</strong>“No esperaba que fuese así. Ni en el mejor de los sueños esperaba que todo saliera tan redondo. Lo hemos cumplido. Nadie se puede sentir defraudado. El Guaguas tiene un gen ganador y nuestra obligación es siempre ir a ganar”. <em>(Canarias7, 9 de febrero de 2021)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2022</span><div class="timeline-content"><strong>ADN ganador</strong>“El Guaguas tiene el ADN de Real Madrid o Barcelona. Sale a ganar siempre. Cada vez que llega un jugador nuevo le pregunto si sabe qué escudo va a defender porque nuestra historia ha sido y es grande. Estamos entre los mejores cincuenta clubes del mundo”. <em>(Canarias7, 23 de agosto de 2022)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2023</span><div class="timeline-content"><strong>Dedicatoria especial</strong>“Sergio Camarero es una persona muy especial para mí. Lo tengo conmigo desde los 17 años. Es una de las personas que más quiere al club, incluso más que yo. Desde la directiva queremos además dedicarle especialmente este título a la madre de Sergio Camarero”. <em>(La Provincia, 7 de mayo de 2023)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2024</span><div class="timeline-content"><strong>Reivindicación institucional</strong>“El Guaguas merece más ayuda por parte de los organismos oficiales. Un suplemento de un millón de euros serviría para progresar a nivel europeo. A día de hoy peleamos con los mejores de Europa en inferioridad de condiciones”. <em>(Canarias7, 25 de diciembre de 2024)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2025</span><div class="timeline-content"><strong>Orgullo de equipo</strong>“Supone un orgullo ser el presidente de este grupo de deportistas y creo que mi satisfacción se extiende a la afición y a todos los que quieren y valoran el voleibol y el espíritu de superación”. <em>(Canarias7, 20 de noviembre de 2025)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2026</span><div class="timeline-content"><strong>El éxito colectivo</strong>“El éxito no es mío, sino de todos los que colaboran. La directiva y el presidente del Guaguas nunca ha cobrado en los doce años de la primera etapa ni en los seis años de esta segunda. El Guaguas es una gran familia. Estar entre los diez mejores equipos del mundo es para nosotros fundamental”. <em>(Sport, 12 de febrero de 2026)</em>.</div></div>
</div>

[imagen_contenido file="4cap_proy_foto_presidencia25.jpg" caption="Visita de la plantilla a la sede de Presidencia de Gobierno en Las Palmas de Gran Canaria para ofrecer, en junio de 2025, el triplete de títulos de esa temporada: Supercopa, Copa del Rey y Superliga. Juan Ruiz explica a los dirigentes Manuel Domínguez, Fernando Clavijo y Poli Suárez los entresijos del éxito deportivo. Al fondo, técnicos y jugadores."]

[imagen_contenido file="4cap_proy_foto1.jpg" caption="Arriba, día de partido en el palco del Gran Canaria Arena. De izquierda a derecha, Ángel Sabroso, Carolina Darias, Antonio Morales, Juan Ruiz y Poli Suárez, entre otras autoridades."]

[imagen_contenido file="4cap_proy_foto_cabildo25.jpg" caption="Recepción en el Cabildo de Gran Canaria con motivo de la conquista de la Copa del Rey 2025. El presidente Antonio Morales, junto a Juan Ruiz y Jorge Almansa."]
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
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ICONOS Y', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('ESTRELLAS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('DEL GUAGUAS', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => ''),
    array('title' => 'Sergio Miguel Camarero', 'numero' => '', 'order' => 41, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('5cap_cam_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'custom_icon_color' => 'hsl(204, 13%, 55%)',
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center bottom',
            'title_lines' => array(libro_hero_line('SERGIO MIGUEL', '#FFFFFF', 'hsl(204, 13%, 55%)', 'none'), libro_hero_line('CAMARERO', '#FFFFFF', 'hsl(204, 13%, 55%)', 'none')),
        ),
        'content' => '
[capitular]Cuando Sergio Miguel Camarero (Las Palmas de Gran Canaria, 1967) destacaba en el fútbol y como prometedor jugador del San Antonio, el equipo de su barrio, ya soñaba con hacer historia en el deporte. Su aspiración se iba a cumplir, aunque de manera insospechada porque, efectivamente, haría carrera pero en otra disciplina que tardó en practicar y a la que llegó de rebote. "Empecé a jugar al voleibol porque, al regreso de unas vacaciones en el sur de la isla, ya no tenía posibilidad de inscribirme en el equipo de fútbol. Se había acabado el plazo. Y me apunté en la Escuela de Voleibol del San Román. Mis primeros entrenadores fueron Félix Rodríguez, Joselu Sánchez e Ignacio Brito. Tendría 14 o 15 años. Y me enganché", concreta.[/capitular]

[imagen_contenido file="5cap_camarero_foto2.jpg" caption="Con Marcelo Giovanacci, que tomaría el relevo en el banquillo en sustitución de Edelstein."]

<p>Así fue su punto de partida y siempre a una velocidad vertiginosa porque, ya en sus tiempos en el Juventud, dibujó una progresión descomunal, convirtiéndose en el primer jugador canario en ser llamado por la selección española en categoría juvenil y júnior. Y mantendría su exclusividad con el representativo nacional, al ser, igualmente, pionero en las citaciones de máximo nivel internacional. "Era una época complicada en la calle, el riesgo de las malas influencias, las amistades que en esa etapa de la vida te pueden llevar por el mal camino. Mi suerte fue que elegí el deporte, el voleibol, y conocí a una persona como Felipe Nuez con la que pude crecer y desarrollarme en el mejor ambiente posible. Ya integrado en el Calvo Sotelo se puede decir que empecé a ver que esta iba a ser mi vida, que quería dedicarme a esto pese a ser muy joven", afirma.</p>

<p>Camarero incide en la influencia capital de Nuez en sus inicios y, también, en la consolidación del proyecto del club, aspirante entonces a entrar en la élite nacional. "Detrás del ascenso a la División de Honor de 1985 hay muchísimo trabajo, sacrificio y un grupo de compañeros, de amigos, que supimos plasmar en la pista todas las enseñanzas y conceptos que nos inculcó un entrenador que fue figura fundamental en esos inicios y en el desarrollo posterior. Fue una labor colectiva muy meritoria porque no todos creían en nosotros, en que podíamos conseguir eso".</p>

[cita_editorial author="Sergio Miguel Camarero"]Pude irme en el inicio de mi carrera. Me llamó del Cisneros Miguel Ocón, que luego, como seleccionador, confió muchísimo en mí. Pero aposté por quedarme en mi tierra y no me equivoqué. Por encima del dinero siempre antepuse el orgullo de defender los colores del Guaguas, que ha sido mi club siempre.[/cita_editorial]

[imagen_contenido file="5cap_camarero_foto3.jpg" caption="Imagen icónica de Camarero en el CID."]

[imagen_contenido file="5cap_camarero_foto_edelstein1.jpg" caption="Animado por el técnico Enrique Edelstein durante un encuentro."]

<p>Camarero se erige desde el principio, y con el núcleo de canteranos que viven ese despegue ("Jorge Ramón, Juanma, David Rodríguez..."), en uno de los referentes del equipo con su manera pasional de competir y de entender el deporte. Porque sus imágenes icónicas pidiendo, brazos abiertos, el apoyo del Centro Insular en partidos memorables ya se daban en los tiempos iniciáticos en el García San Román. "Nunca he cambiado y, aunque hay que reconocer que todo lo que vino después tuvo mayor repercusión con el traslado al CID, los títulos y miles de espectadores viéndonos en directo, cuando todavía no nos habíamos mudado y jugábamos en ambientes más modestos también era el Camarero que quería comerse la pista, contagiar a los compañeros, tirar para arriba cuando el equipo estaba en momentos complicados, pedir a los seguidores que se metieran en el partido... Es implicarse al máximo en todos los sentidos".</p>

<p>Al igual que sucede con todos los protagonistas con los que compartió el crecimiento del proyecto, sitúa el punto de inicio con la llegada a la presidencia de Juan Ruiz, quien, en su opinión, "realizó unos fichajes impensables, que parecían imposibles, y que terminaron dándole al equipo un nivel impresionante".</p>

[cita_editorial author="Sergio Miguel Camarero"]Sánchez Jover, Venancio, Miralles, Chava, Golec, Klos... El Guaguas mejoraba año a año y se conservaba la base. Se construyó una grandísima plantilla, llegaron los títulos, jugar en Europa... Nadie podía esperar eso, pero, al mismo tiempo, creo que fue el premio a la valentía y a la ambición.[/cita_editorial]

<p>"Era una etapa en la que el Palma dominaba y nadie le hacía sombra. Poco a poco crecimos, nos situamos a su nivel y terminamos superándoles. Fue un proceso de unos años en el que siempre se mantuvo el crecimiento, sin dar pasos atrás. Es algo muy complicado en el deporte profesional, el mantenerse arriba tanto tiempo. El Guaguas lo consiguió", se congratula.</p>

<p>Hasta que se retiró en 1996, en opinión generalizada de manera prematura ("sentí que llegó el momento y lo hice dejando a un Guaguas campeón, que era lo que deseaba"), vivió años "inolvidables" en los que prefiere no diferenciar gesta alguna porque, como subraya, "todo fue demasiado especial".</p>

<p>"El primer título, la primera Liga, debutar en Europa, los compañeros, la afición, partidos que levantamos cuando estaban casi perdidos, el espíritu que forjamos, esa grada que nos llevó siempre hacia lo que queríamos, el respeto que se nos tenían en otras pistas... Fueron experiencias muy intensas, muy seguidas y que, en el momento, casi ni asimilas porque la competición te impide parar. En mi caso, desde los inicios, sin mayores pretensiones, a estar levantando títulos y compitiendo con los mejores equipos de Europa. Todo pasó demasiado rápido pero, a la vez, todo mereció la pena", apunta.</p>

[imagen_contenido file="5cap_camarero_foto_edelstein2.jpg" caption="En un entrenamiento con Edelstein."]

<p>Insiste en que uno de sus mayores motivos de felicitación en su trayectoria profesional en el club radicó en su rendimiento y compromiso "dentro de un grupo humano insuperable" en el que "todos" aportaron su cuota de compromiso y trabajo, lo que permitió "crear una identidad" y diferenciar al Guaguas "por su manera de jugar y pelear cada encuentro y cada desafío", algo en lo que destaca la figura de Sánchez Jover, "un líder tanto como jugador como entrenador y coincidiendo con unos años inigualables". Porque, como enfatiza, "suponía un privilegio" formar parte de la entidad en pleno apogeo.</p>

<p>Como ocurrió con los grandes nombres que han pertenecido al Guaguas, Sergio Miguel Camarero, que acumuló 48 internacionalidades absolutas y 10 títulos oficiales (5 Ligas y 5 Copas), tuvo un homenaje de despedida con un amistoso ante el Zonhoven de Bélgica, celebrado el 7 de enero de 1998 en el Centro Insular y en el que, además de recibir los máximos honores del club, con la insignia de oro y brillantes, y de la Federación Canaria, con una placa entregada por el histórico dirigente José Millán, no pudo contener las lágrimas de emoción. "Había estado un año pensando en si volvía o no pero, al final, lo dejé. Y en ese momento ya sabía que todo había acabado, pese a que era relativamente joven y podía haber estirado mi carrera. Ya estaba entonces con el proyecto educativo en las Escuelas Municipales de Ingenio, iba terminando mis estudios universitarios también y afrontaba un cambio en mi vida, sabiendo, eso sí, que seguiría con el voleibol. Tenía incluso proyectos con el vóley playa pero todo no iba a ser lo mismo".</p>

<p>Inició, como era previsible, su trayectoria en los banquillos, con amplia y exitosa carrera en el extinto Hotel Cantur, contempló, desde la distancia, la desaparición del Guaguas ("fue muy doloroso para todos los que defendimos y sentimos esa camiseta desde los tiempos del Calvo Sotelo") y ha sido, igualmente, actor principal, en el regreso del club con la refundación obrada por Juan Ruiz en el año 2020.</p>

[cita_editorial author="Sergio Miguel Camarero"]Juan Ruiz es, indiscutiblemente, la persona más importante en la historia del club por todo lo que hizo y ha hecho. Llegó en momentos complicados. El último, sin club, directamente. Y de la nada ha vuelto a construir un Guaguas campeón. Ahí están los hechos y su contribución. Muy pocas figuras en el deporte canario tienen su legado.[/cita_editorial]

[imagen_contenido file="5cap_camarero_foto_pose.jpg" caption="En la imagen superior, pose de máxima atención en un entrenamiento. Abajo, éxtasis junto a Golec, Dávila y Valido."]

[imagen_contenido file="5cap_camarero_foto_gesto.jpg" caption="Gesto concentrado antes de un encuentro y en el saludo protocolario al rival."]

<p>"A nivel afectivo y emocional, regresar al Guaguas como entrenador para iniciar una nueva etapa fue algo que me motivó desde el primer momento. Y que en el club estén Juan, Paco Sánchez Jover o Felipe Nuez supuso un aliciente enorme. Volvernos a encontrar, después de tantos años, y por y para el club que tanta felicidad nos dio. He trabajado y sentido los triunfos como cuando estaba en la cancha. Como entrenador mantengo la misma filosofía de jugador, esto es, luchar cada punto, ir a ganar siempre, cada partido tomárselo como una final... Y estoy muy contento con la respuesta que he venido teniendo de mis jugadores. La directiva no ha parado de mejorar el equipo y los resultados son los que son, con varios títulos ya en este año largo desde que volvimos y la pretensión de seguir creciendo, sin escatimar en ambiciones y sueños. Es el ADN del Guaguas", finaliza.</p>

[imagen_contenido file="5cap_camarero_foto1.jpg" caption="Gestos pasionales y triunfadores, los que siempre le caracterizaron en la cancha."]

[imagen_contenido file="5cap_camarero_foto_constructora91.jpg" caption="En una mítica formación del Constructora Atlántica de la temporada 1990-91 que se saldó con doblete nacional."]

[seccion_header]Su cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content"><strong>Cotizado desde sus inicios</strong>“Yo ahora mismo me debo al Guaguas Las Palmas, donde estoy muy a gusto, con grandes compañeros, entrenador, directiva, en fin, que es mi club. De todas formas, y con respecto a las ofertas, puedo decir que he tenido propuestas de la vecina isla y de la Península, que serán estudiadas en su momento, cuando finalice la presente temporada en la que me debo al Guaguas. Ya el Cisneros habló conmigo. La propuesta era buena, pero no tanto como para que yo en aquella ocasión cambiara de aires, máxime cuando nosotros teníamos su misma categoría. Me encontraba muy a gusto en mi actual club y no me fui a Tenerife. Repito que estoy muy a gusto en mi actual club, en el que todos somos una piña. Vamos a dejar transcurrir la temporada, y después será cuestión de ver las propuestas, que lo mismo al final quedan en nada”. <em>(Diario de Las Palmas, 27 de febrero de 1982)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>Rompiendo pronósticos con los títulos</strong>“Realmente ha sido una sorpresa para todos que juguemos con el Bomberos. Agradable porque hace que tengamos más fácil, en teoría, el conseguir el título y desagradable porque la gente esperaba que la final fuera con el Palma. Pienso que este año estamos bastante fuertes y que el Bomberos es un equipo inferior a nosotros, aunque no se puede decir nada hasta que tengamos el título en la mano. Pienso que en los dos próximos encuentros podremos dar el título a Canarias. Seguramente será en Barcelona donde lo logremos, porque estamos hartos de que nos hagan jugarretas. Pero esto es así y hay que aguantarlo, y lo bueno de todo es que vamos a ganar la Liga, aunque haya gente a la que no le guste”. <em>(Diario de Las Palmas, 15 de marzo de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1991</span><div class="timeline-content"><strong>El poder de la afición del CID</strong>“Si jugamos como sabemos, este título no saldrá de aquí. Ya en la cancha tendremos que intentar parar a Rafa Pascual, es el mejor de ellos. Luego sus extranjeros, aunque ahora parecen un poco cansados, lo que es lógico, puesto que la competición, contando con los torneos europeos, es muy larga. Todos los equipos que pasan por aquí en las grandes ocasiones terminan asombrados de cómo chilla esta afición. Sin ellos no estaríamos disputando esta final con todo a favor. Si no soy agresivo no sé jugar, es mi estilo. Necesito estar en continuo contacto con la afición, lo que para mí es algo fundamental en el deporte de alta competición, el público vive con su equipo las derrotas y las victorias, sobre todo estas últimas”. <em>(La Provincia, 12 de abril de 1991)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>Ni el PSG pudo</strong>“Ya he dicho que necesitábamos el calor de la gente para superar a los franceses y esta batalla la hemos ganado con el apoyo de todos, pero esta guerra aún no ha acabado y volvemos a estar en la lucha”. <em>(La Provincia, 20 de enero de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>En defensa de su honorabilidad</strong>“No voy a la selección desde el siguiente año de venir el entrenador cubano Gilberto Herrera. Un año antes, en el 88, un grupo de jugadores hicimos una huelga, y dijimos que no acudiríamos a la selección, por problemas de tipo económico. Luego llegué a jugar con Gilberto bastantes partidos, pero más tarde hubo muchas cosas raras. Algunos jugadores tuvimos muchos problemas, y yo sé que por ahí tengo fama de malo de la película, y eso no es así. Hay gente que yo pensaba que eran amigos, y hablaban mal de mí, pero los que me llegan a conocer, y saben como soy, se llevan un chasco, porque ya digo que hay otras personas que se dedican a hablar mal de mí, y después comprueban que no es así. En este mundo hay pocos amigos. La Federación Española cada vez que puede poner una zancadilla a nuestro club lo hace, y a la mínima que te pueda meter una puñalada por la espalda te la da. En mi caso, yo soy el rematado de turno. Si me volviesen a llamar a la selección, yo no iría; ahora mismo la tengo totalmente descartada. Solo diría que sí por la gente de aquí, porque Gran Canaria se merece que alguien de esta tierra esté en la selección. No creo que vayamos a barrer en la Liga. Todos los años suele comentarse lo mismo sobre este tema, pero la verdad es que a la gente importante de nuestro conjunto le cuesta cada año más conquistar el título. De todas formas, lo más importante es lograr estar en la Final Four europea, algo que ya le hace falta a este equipo, porque en España tenemos muchos títulos, y tanto por nosotros, los jugadores, como por la afición, debemos intentar entrar en la Final Four. Lo cierto es que la temporada pasada cuando los aficionados se emocionaron y llenaron nuestra cancha fue durante la Copa de Europa”. <em>(Diario de Las Palmas, 12 de septiembre de 1994)</em>.</div></div>
[imagen_contenido file="5cap_camarero_foto_copa96.jpg" caption="En la final de la Copa del Rey de 1996, sabiendo que era su despedida y regalando su camiseta."]

<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>Acordes de despedida</strong>“Ha sido, un año sabático. Psicológicamente es importante recuperarse, porque yo soy un jugador que necesita estar bien de mente para poder jugar bien, porque siempre me empleo al cien por cien. Yo creo que este año me ha venido muy bien, ya me había quitado de la mente el tema de volver a jugar, pero con las ofertas todo ha cambiado. He estado todo el año entrenando al vóley-playa, he estado jugando al squash a nivel regional y he realizado un trabajo fuerte con las pesas, porque había grupos musculares que los tenía mal, y eso me ha hecho estar muy bien físicamente, porque mentalmente estoy a tope. Lo que sí me ha molestado han sido comentarios de gente que dice que ya yo no podía jugar con treinta años. Creo que esa gente está ocultando la realidad y el motivo no es el físico, porque yo con treinta años me encuentro mejor que con veinticinco”. <em>(Diario de Las Palmas, 4 de agosto de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2001</span><div class="timeline-content"><strong>De su vida</strong>“Desde pequeño he vivido en casa de mi madre, en el barrio de San Antonio (junto a las cuatro esquinas), al lado de Schamann y del Polvorín. Es una zona complicada, ya que la droga está muy cerca. Gracias a mis abuelos y a la educación que me dieron mi madre y mis dos hermanos mayores (mi padre ya falleció) pude escapar a las drogas, aunque tengo muchos amigos que están metidos en ese mundo, a los que sigo viendo y a los que les tengo mucho cariño. Nos vemos, nos saludamos y nos tenemos un tremendo respeto. Ellos me cuidan el coche y yo les daba muchas entradas cuando jugaba en el Guaguas Las Palmas para que viniesen a ver al equipo. Hoy me dan muchos ánimos en los días previos a los partidos en los que dirijo al Hotel Cantur Costa de Mogán. Hoy en día sigo viendo a nuevas generaciones, chicos jóvenes de ambos sexos, que también consumen drogas. Creo que ellos son las víctimas de esta lacra social que nos afecta a todos. Yo, por mi parte, desde muy pequeño jugaba al fútbol sala en el colegio García Escámez y luego estuve en varios equipos federados de fútbol, como el San Antonio, Quillet y Gregil, todos ellos de la zona alta de la ciudad. Yo jugaba en el centro del campo, pero era medio malillo. El bueno de la familia era mi hermano Florencio, que jugaba muy bien al fútbol, mientras que mi hermana Lourdes jugó al baloncesto con Domingo Díaz de entrenador, pero tuvo que dejar el deporte por una lesión. Yo era un estudiante malísimo, aunque más tarde, sobre los 27 años, hice Magisterio y ahora estoy a falta de poco más de un curso para licenciarme en Educación Física. La verdad es que mi familia ha sido muy deportiva y yo particularmente jugaba a todo: fútbol, natación, hockey, baloncesto... hasta que me decanté por el voleibol. El deporte me ha ayudado mucho a llevar una vida sana; es clave para no meterte en ese negocio que es para algunos la droga. Mi primer equipo de voleibol era el Juventud cadete, que entrenaba Ignacio Brito, aunque nos conocían por el tres a cero, porque siempre mi equipo perdía por ese resultado. Ya en juveniles empecé a destacar y fui internacional en esa categoría, luego en la júnior y más tarde en la absoluta. Recuerdo que de pequeño hacía gamberradas en la calle. Era una época distinta a la actual, en la que no existían los ordenadores, por lo que solíamos jugar a las cartas, al boliche, la petanca, la tángara, las cometas y hacíamos las hogueras de San Juan y de San Antonio. Luego estaban las peleas; lo básico era pelearse en el colegio con todo el mundo. Además, en la calle, junto a otros chicos, nos tirábamos piedras. Imperaba la ley del más fuerte. Creo que fui a la clínica mil veces por accidentes sufridos en el barrio: mordeduras de perros, un coche que me atropellaba cuando cruzaba la calle, una pedrada... Todo lo hacíamos en la calle; cuando llegaba el día de Reyes, yo salía contento con el equipaje nuevo de fútbol y con el balón”. <em>(La Provincia, 8 de diciembre de 2001)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2003</span><div class="timeline-content"><strong>Dolor a la distancia</strong>“Me duele muchísimo ver al Guaguas tan abajo. Siempre será mi casa. Ahora es cuando más hay que arrimar el hombro por todas las satisfacciones que nos dio. Es cuestión de ciclos y volverá al lugar que tuvo”. <em>(Canarias7, 3 de marzo de 2003)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2020</span><div class="timeline-content"><strong>El regreso soñado</strong>“Creo que esto ha demostrado la ambición y las ganas que hay en las personas que están detrás de este renacimiento del club. La situación ahora mismo no puede ser más adversa, a priori. En ese sentido, Juan Ruiz me sorprende. Quiero darle las gracias por la fuerza que ha demostrado en este proyecto. Tal y como se puso la situación actual era para decir no y olvidarse. Él continuó, peleó y siguió adelante. Es capaz de convencer a todo el mundo a que crea en el Guaguas Las Palmas. Sé que el nivel de exigencia y de implicación está siendo asombroso. Tiene un gran poder de convicción y eso es lo que llevó en su día al Guaguas, entre otras cosas, a poder ganar 12 títulos con él. Estoy muy sorprendido y convencido de que va a salir bien. Paco Sánchez Jover ha sido un luchador siempre, un apasionado de este deporte. La primera llamada junto con la de Juan, fue suya. Contar con su respaldo significa mucho para mí. Ha luchado tanto por este deporte, con tantos sacrificios en Vecindario... Ha hecho algo grandísimo. Es su Guaguas y es su equipo. Está implicadísimo. Es pieza clave. Tanto él como Juan son dos personas importantísimas. Lo ha llevado todo en Vecindario: entrenador, fichajes, presidente. En la faceta actual será importante, pero tendrá donde apoyarse. Será importante en todos los ámbitos. Es su club. Estoy totalmente convencido de que engancharemos a la gente. El ciudadano de Las Palmas de Gran Canaria, los canarios en sí, somos muy competitivos. Si conseguimos pelear por títulos, por estar en las finales, por jugar en Europa como antes, la gente va a acudir y va a animar. El aficionado canario es selecto y le gusta el alto nivel. Creo que vamos a estar cerca de ese punto. Conseguir la conexión con la grada es básico. Y para eso tenemos que ser competitivos, luchadores, talentosos, humildes y entregados. Eso es lo que hará que la gente vuelva. Me he quedado sorprendido porque hasta gente por la calle que te reconoce de aquella época te lo comenta y me pregunta por la calle, me dicen que vaya notición. Mi familia y mis amigos, igual. La gente tiene ganas de volver a vivir lo que se vivió. Todos tenemos aquellas vivencias. Se agradece mucho”. <em>(La Provincia, 28 de mayo de 2020)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2021</span><div class="timeline-content"><strong>Con el espíritu de siempre</strong>“El equipo ha estado muy bien durante todo el año, solo hemos perdido dos partidos y fue cuando sufrimos un brote de coronavirus. Quitando eso, que lo sufrimos y mucho, creo que ha sido un año fantástico. Además de ganar la Copa y la Superliga, en Europa estuvimos a un set de meternos entre los cuatro mejores. Sobre todo estamos muy contentos de la imagen que hemos dado: recuperar el espíritu del Guaguas, enganchar de nuevo a la gente al voleibol, ver a un equipo serio dentro de la cancha… Eso lo hemos rescatado, que es lo que queríamos, el volver con fuerza y demostrar que el proyecto es fuerte y que se puede continuar consiguiendo éxitos. Está claro que si el Guaguas regresaba era para intentar estar arriba y pelear por títulos, que la gente se ilusionara otra vez con el proyecto… En ese sentido estábamos convencidos de que si así era íbamos a llenar de nuevo el pabellón, porque este equipo engancha, y la verdad es que en ese sentido ha salido todo fantástico. Al final los éxitos se consiguen de esa manera, dando el máximo y logrando que todo el mundo se ilusione con el proyecto. Hemos recuperado el espíritu del Guaguas y logrado que mucha gente se vuelva a enganchar. Que confíen en uno como entrenador, viniendo del vóley femenino, desconociendo todo lo masculino es de agradecer mucho, la verdad. Porque luego hay que acertar en los fichajes, tomar decisiones muy difíciles, etcétera, que pueden salir bien o mal. En este sentido Juan ha trabajado una barbaridad y en plena pandemia, que lo complica todo. Él es el que ha sacado todo este proyecto adelante incluso cuando muchos le decían que si estaba loco por hacerlo en estos momentos. Yo siempre lo he tomado con muchísima responsabilidad. Primero emocionalmente, el volver a sentir los colores del Guaguas, representar a Gran Canaria y Canarias es una responsabilidad muy grande, pero siempre lo he disfrutado y al final han salido todas las cosas bien y cómo queríamos por la gente que nos ha rodeado y, sobre todo, por el trabajo tan bestial que ha realizado Juan Ruiz”. <em>(Canarias7, 24 de abril de 2021)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2022</span><div class="timeline-content"><strong>Implicación</strong>“Si el vestuario funciona y la directiva y técnicos van en la misma dirección, esa unión hace que vaya todo bien. Estoy muy orgulloso de todos los jugadores. Juan Ruiz y todos los directivos están haciendo una labor muy implicada que hace que el equipo salga adelante, pero lo principal es el grupo, estoy muy contento”. <em>(Mundo Deportivo, 26 de diciembre de 2022)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2023</span><div class="timeline-content"><strong>Mentalidad innegociable</strong>“Es un orgullo y también una responsabilidad representar a nuestro país, sería histórico meter a un equipo español en este nuevo formato de Champions. Tenemos que ir con la mentalidad de jugar y ganar cada punto, estar concentrado en los momentos importantes y pelear cada balón. Esa es nuestra mentalidad, a partir de ahí vamos a intentar controlar lo que podamos. Estos días es fácil entrenar, no hace falta motivarles, están todos ilusionados y con ganas de conseguirlo”. <em>(Web del club, 8 de noviembre de 2023)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2024</span><div class="timeline-content"><strong>Respeto generalizado</strong>“Hemos conseguido cosas antes de tiempo y estamos haciendo logros importantes, ahora los jugadores quieren venir aquí. El Guaguas ahora es considerado por toda Europa y nuestra afición es gran parte de nuestro éxito. Todo es posible, con nuestra gente se puede conseguir todo lo que nos propongamos”. <em>(Canarias7, 26 de julio de 2024)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2025</span><div class="timeline-content"><strong>Profesionalidad</strong>“Otra vez hemos tenido la suerte de poder trabajar con grupo de jugadores increíbles, los que jugaron más, y los que no lo hicieron tanto, pero en cada entrenamiento fueron súper profesionales y le exigieron a sus compañeros para que sacaran lo mejor de cada uno. Hemos vivido muchas sesiones de trabajo de un nivelazo tremendo.. Nuestro cuerpo técnico se ha mostrado incansable, y, por supuesto, que tenemos mucho que agradecer también al presidente Juan Ruiz, y sus compañeros de directiva, que se desviven por el club, al igual que otras personas que están en el día a día, sacando adelante mucho trabajo, solventando los detalles. Esto es suyo al ciento uno por cien”. <em>(Web del club, 2 de mayo de 2025)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">2026</span><div class="timeline-content"><strong>La pasión como motor</strong>“Yo no me fijo en los títulos. Me fijo en el día a día, en el entrenamiento de hoy, el partido a partido. Y después yo creo que cuando ya no esté aquí y no esté en el voley y quiera recordar todos esos momentos, pues sí me fijaré más en estos datos. Es bonito saberlo, pero yo a cada partido que entro, entro a intentar hacerlo lo mejor, y si conseguimos la Copa y es así como dices, pues genial. Pero yo en esas cosas no me paro a pensar. Porque lo más importante ahora mismo es el día a día, el partido a partido porque sabemos que ganar es muy difícil. El Guaguas lo es todo, es mi vida. Llevo muchos años aquí metido y sobre todo es mi pasión. Creo que lo hago por pasión, no lo hago por otra cosa. Y seguiré haciéndolo por pasión. Cuando se me quite esa pasión, que no creo, pues me iré a otra cosa. Pero por ahora lo vivo todo como si fuese el primer día”. <em>(8sports, 25 de febrero de 2026)</em>.</div></div>
</div>

[imagen_contenido file="5cap_camarero_foto_elevado.jpg" caption="Camarero, elevado a los cielos por sus jugadores después de la conquista de un título."]

[imagen_contenido file="5cap_camarero_foto_magistral.jpg" caption="Siempre magistral en la dirección del equipo, combinando temperamento y sabiduría. Abajo a la izquierda, en cariñoso saludo con Antonio Morales y Jorge Almansa. A la derecha, gesto triunfal en medio de la tensión propia de un partido."]
'),
    array('title' => 'Paco Sánchez Jover', 'numero' => '', 'order' => 42, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('5cap_jov_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'custom_icon_color' => '#d69745',
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center 30%',
            'title_lines' => array(libro_hero_line('PACO SÁNCHEZ', '#000000', '#d69745', 'none'), libro_hero_line('JOVER', '#000000', '#d69745', 'none')),
        ),
        'content' => '
[capitular]Fue uno de sus profesores, "don Mariano", como matiza, el que, ya en su último año como cadete, le introdujo en el deporte que le haría célebre. Porque Paco Sánchez Jover (Murcia, 1960) estaba predestinado al éxito como uno de los jugadores más reconocidos de todos los tiempos en el voleibol nacional. Pero en su niñez, que se desarrolló en el colegio Nuestra Señora de Atocha, "jamás" imaginó que su vida iba a transcurrir en las pistas y de manera profesional. "Como el voleibol se practicaba en horario lectivo, que te permitía saltarte clases, todo el mundo quería jugar. Nunca lo había practicado, pero me animé y me enganché desde el principio. Medía 1,96 metros, no había quien me ganara por alto. Las condiciones eran precarias: suelo de tierra, red con tela mosquitera y sandalias de las de ir a pescar... Pero éramos felices, lo pasábamos bien y, poco a poco, fui evolucionando. Cuando le ganamos, en la Liga Escolar, al Capuchinos, que era el campeón, me ficharon y me llevaron con ellos, por lo que hice el Bachillerato allí. Entré en otra dimensión porque ya había material para entrenar, balones, equipaciones, un pabellón, regularidad y constancia en las sesiones...", precisa.[/capitular]

<p>Y no pasa por alto la influencia de su madre, que le animó a seguir estudiando y a no dejar el deporte en el momento en el que tuvo que decidir si emulaba los pasos de su padre en la empresa familiar de albañilería o tirar para adelante con su pasión por el voleibol combinándola con la formación académica: "Acerté y se lo debo a mi madre. Parece que fue ayer cuando me llamó a la cocina de la casa y me dijo que mi futuro estaba en los libros, lo que me permitió continuar jugando", resume.</p>

<p>Sus progresos son asombrosos. Estrena condición de internacional júnior, acudiendo al Mundial de la categoría en Brasil, y es fichado, en 1977, por el Real Madrid, ya el escaparate definitivo para su despegue. En tres temporadas, dos Ligas y tres Copas, además de la constatación de que venía en camino un jugador de leyenda. Son Amar de Mallorca, Cisneros y de nuevo al conjunto balear son las estaciones previas a su definitivo desembarco en el Guaguas, ya como estrella consagrada y cotizada.</p>

<p>Le querían en todas partes, pero las artes de Juan Ruiz le terminaron convenciendo: "Sabía del Guaguas porque había hecho una buena Copa en Mallorca y, además, allí estaba Martinovic, que había sido compañero mío. Pero Juan Ruiz consiguió mi número de teléfono, el de casa, porque en esos años no existían los móviles, por una carambola. El tío de mi pareja de entonces, que era de Gran Canaria, vivía al lado de Juan y jugaban a las cartas. Casualidad de las buenas. Un día le comentó que su sobrina estaba conmigo, a Juan se le encendió la luz y le dijo que quería hablarme. Le dio mi contacto... ¡Y durante meses me llamaba casi todos los días!".</p>

[cita_editorial author="Paco Sánchez Jover"]Juan me ilusionó. Me pedía consejo, me hablaba de que iba a construir un club grande, que la isla era el mejor sitio para vivir, me trataba como a un hijo... Simpaticé muchísimo con él, la verdad. Nunca me moví por el dinero, siempre por la ilusión, por el corazón.[/cita_editorial]

<p>"Luego tuvimos contacto ya en persona en el Preeuropeo de Cádiz de 1987, pero fue ese interés suyo tan grande el que me terminó de convencer. El Falconara de Italia me propuso el que podía haber sido el contrato de mi vida. Pero me comprometí con Juan y ni quise saber el dinero que me ponían encima de la mesa. Soy un hombre de palabra. Otro, en mi lugar, lo mismo hubiese aprovechado que no había nada firmado. Pero mi palabra era sagrada y la cumplí. Me dio igual perder en el aspecto económico", añade.</p>

<p>No aterrizó aquel verano de 1987 solo. Tanto se implicó en el proyecto que le había atraído que recomendó los fichajes de Venancio Costa y Antonio Miralles ("apenas jugaban en Mallorca y le dije a Juan que era una oportunidad buena para el club por la calidad que tenían, y que luego se demostró con creces"), además de su hermano Jesús. Reconoce que intuía que "algo bonito" venía en camino porque "desde el primer momento" percibió que en el Guaguas "se estaban haciendo las cosas muy bien y todos iban a una".</p>

[imagen_contenido file="5cap_paco_sanches_jover_foto1.jpg" caption="Junto a su hermano Jesús, con el que compartió tiempos en el Guaguas y experiencia olímpica en Barcelona 92, en labores de bloqueo."]

[imagen_contenido file="5cap_paco_foto_defensa.jpg" caption="Sánchez Jover realizando ejercicios específicos en defensa."]

<p>Eso sí, es sincero al confesar que el ciclo de éxitos que se iba a firmar "era impensable para todos" dada su magnitud y vigencia: "Que podíamos ganar algo, bueno, sí, se podía esperar porque había un grupo de calidad. Pero eso de ganar Ligas y Copas sin parar, con los presupuestos de los rivales, no entraba en la mente de nadie".</p>

<p>"El paso del San Román al Centro Insular fue el primer gran avance. Teníamos que crecer, aunque a Juan le daba respeto. Pensaba que se nos iba a quedar grande el nuevo pabellón. Pegábamos carteles para dar visibilidad al club, hacíamos de todo por la modestia que imperaba al ser un club sin estructura. Pero no paramos de crecer. Ya la primera temporada, subcampeones de Liga y Copa. Se mantiene la base y comienzan a llegar refuerzos de la talla del Chava, Klos, Golec... Aquello ya era imparable. Ver el CID lleno fue la prueba de que sí, de que aquello iba muy en serio", enfatiza.</p>

<p>Sánchez Jover se hace líder del equipo nada más llegar. Su amplísima experiencia previa en la élite y como internacional absoluto le convierten en referencia indiscutible en un vestuario plagado de jóvenes: "Camarero tenía 20 años, Jorge Ramón también estaba casi empezando... Me tocaba ser algo más que un jugador y no dudé en asumir la responsabilidad que fuera".</p>

[imagen_contenido file="5cap_paco_sanches_jover_foto4.jpg" caption="Concentrado en una sesión preparatoria."]

<p>Abunda en la figura de Camarero con palabras de agradecimiento: "Los dos tenemos una personalidad fuerte. Y, con tantos años juntos, normal que hubiese épocas en las que queríamos matarnos, dicho de una manera metafórica. Y cuando me tocó ser su entrenador, la tensión a veces cortaba el aire. Eso sí, podíamos no hablarnos en la ducha pero en la pista moríamos por el Guaguas. Pero siempre predominó el respeto y la camaradería entre él y yo. Y así se ha demostrado con el paso de los años. Le agradecí que me acogiera con los brazos abiertos, siendo él una de las figuras del Guaguas que me encontré, y que me cediera el rango de capitán, por decirlo de alguna manera, desde el compañerismo y el bien común. Sergio fue, ha sido y es para mí, por encima de todo, un amigo. Y es el compañero que más me ha marcado en mi historia en la entidad. Junto con Juan Ruiz, está para mí en un escalón privilegiado".</p>

[cita_editorial author="Paco Sánchez Jover"]Mentalmente no negociaba ganar y competir. Cada partido lo encaraba con máxima tensión y así lo hacía ver a los compañeros. Camarero era similar a mí en ese sentido. A veces tenía que pararlo, porque a él le podía la sangre caliente. Yo controlaba más el aspecto emocional.[/cita_editorial]

<p>"Era una gozada y muy fácil jugar y hacer jugar a aquel equipo. La calidad era impresionante. Y todos querían superarse. Recuerdo entrenamientos que fueron una carnicería, de ir a aplastarnos unos a otros. Luego llegaban los partidos y en muchísimas ocasiones veíamos que el nivel de nuestras sesiones de trabajo era tres veces superior a la resistencia de los rivales. La cultura del trabajo y del sacrificio era la clave. Y, por supuesto, que todos nos queríamos como hermanos. Hubiese sido imposible llegar al sitio que alcanzamos sin que hubiese un vestuario sano, una relación sincera. Y eso que tuvimos situaciones complicadas. Las superamos porque éramos una familia", agrega.</p>

<p>La Copa ganada al Palma en 1989 la tiene en su memoria como "lo más especial" cuando repasa el palmarés: "En la Liga ante el Bomberos, en 1990, sabíamos que no se nos escapaba el título. Fue grandioso, claro. Pero la Copa, esa primera vez, es inigualable. Ganarle al Palma, nada más y nada menos. Mucha gente lloró de emoción, de no creérselo".</p>

[imagen_contenido file="5cap_paco_sanches_jover_foto5.jpg" caption="Levantando uno de los innumerables títulos que ganó el Guaguas ante la adoración de los seguidores."]

<p>"Vinieron años preciosos. Los dobletes, jugar en Europa, ser los mejores. Cada verano me llegaban ofertas y yo pensaba que en ninguna parte iba a estar mejor que aquí. Tras jugar las Olimpiadas de Barcelona 92, más me buscaron para que cambiara de aires. Me lo pasé en grande jugando. Lo hacíamos casi de memoria. Con Venancio, Miralles, Juanma, Sergio o Golec fueron muchísimos años. Con una mirada ya sabíamos por donde tirar. La gente te hacía sentir importante, venían miles de personas a vernos, daban los partidos por la tele cuando solo había dos canales, fuera nos recibían como el rival a batir... Imposible pedir más".</p>

[imagen_contenido file="5cap_paco_sanches_jover_foto3.jpg" caption="Gesto de complicidad con Camarero en el transcurso de un partido."]

<p>"Y no me olvido de la clase dirigente que teníamos. Juan Ruiz siempre ejerció de presidente cercano, sensible y eficiente con nosotros. Es clave en el funcionamiento del club que los que mandan sepan qué se llevan entre manos. Y nosotros teníamos la suerte de que nuestro presidente, supiera más o menos de voleibol, sí tenía muy claro lo que había que hacer y lo que había que evitar para que los proyectos funcionaran", matiza.</p>

<p>Respecto a las ocasiones en las que tuvo que compatibilizar las labores de entrenador con las de jugador, apunta: "Desgasta muchísimo. Siempre le dije al presidente que no era lo ideal, comprendiendo que en determinados momentos tocaba solucionar problemas de esa manera. Como pasó con Juanma Martín, fue un honor ser campeón con este club como jugador y como técnico a la misma vez. Se vive con igual intensidad, quizás con más nervios cuando sabes que todo depende de ti. Me tomé como un honor que se depositara en mí esa responsabilidad".</p>

<p>Tras su retirada como jugador profesional y el partido homenaje que se le brindó en 1995, se mantuvo como entrenador logrando hitos como añadir a su extenso historial dos Copas del Rey más y una Supercopa de España y clasificar al equipo para la Final Four de la Recopa en 1998. Además, se caracterizó por confiar y apostar por la cantera.</p>

<p>"Viví momentos muy bonitos. Recuerdo a Golec, antes de la final de 1996, diciéndome que íbamos a ganar esa Copa y que me iba a ahorrar la conversación que tenía pendiente con él para comunicarle que no iba a seguir porque él ya lo presuponía. Era el padrino de mi hija. Se me puso un nudo en la garganta. Dar oportunidades a los jóvenes, ayudar al club, ya sin Juan Ruiz, en todo lo que pude...", reseña.</p>

<p>Sánchez Jover vivió "con mucho dolor y pena" la desaparición de la entidad porque considera que "se pudo evitar de haber pedido ayuda". No obstante, nunca se resignó a que todo quedara así: "Sepultar la historia de un club, privar a las generaciones que quedan por venir de disfrutarlo, mantener un emblema tan importante como el Guaguas para Gran Canaria... Durante mucho tiempo no paré de darle vueltas a la manera en la que podíamos recuperar la entidad. Muchísima gente me animaba por la calle, me hacía ver que era algo deseado por muchos. Cuando Juan Ruiz nos habló a mí, a Sergio o a Felipe Nuez fue un subidón porque conocemos de su capacidad para aglutinar medios y voluntades y no dudé de que iba a conseguirlo, como así ha sido".</p>

[cita_editorial author="Paco Sánchez Jover"]Ver otra vez al Guaguas campeón es una alegría, pero en el deporte no siempre se gana. Y llegará un momento en el que no nos llevemos la Liga. Pero la satisfacción de reactivar la institución y poder dejarla a los que vengan, porque las personas somos circunstanciales, es algo que no se puede describir. Nos hemos quitado una espina todos los que queremos y sentimos en el corazón este escudo.[/cita_editorial]

[imagen_contenido file="5cap_paco_sanches_jover_foto6.jpg" caption="Punto, set y partido. Abrazo emocionado con un compañero. Al fondo, un CID a reventar."]

[imagen_contenido file="5cap_paco_foto_homenaje95.jpg" caption="Distintas secuencias del homenaje que se le brindó tras su despedida como jugador en 1995."]

[seccion_header]Su cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">1987</span><div class="timeline-content"><strong>La intuición de un Guaguas que iría a más</strong>“El Guaguas puede padecer en el transcurso de la liga dificultad de no contar con un banquillo que reemplace al equipo titular. Antonio y Venancio son buenos jugadores pero necesitan jugar muchos partidos que les den ritmo de competición y eso es lo que van a lograr en Las Palmas. Asimismo, los jugadores actuales del equipo necesitan más rodaje, más horas de pista. Si hay continuidad, si seguimos un par de años, el Guaguas puede tener un gran equipo con aspiraciones muy grandes. Pero esto solo se consigue con tiempo y con partidos y más partidos”. <em>(La Provincia, 31 de julio de 1987)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1989</span><div class="timeline-content"><strong>Ambición y más ambición</strong>“Para que en Las Palmas el voleibol suba a la cúspide necesita que el Guaguas gane un título. Ahí está el ascenso del Gran Canaria en baloncesto. Si se metiera de nuevo entre los grandes, sería de locura. En el vóley lo mismo. Nuestro porvenir está en acabar en la primera posición. Creo que es un sueño posible”. <em>(Diario de Las Palmas, 8 de marzo de 1989)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1990</span><div class="timeline-content"><strong>La Liga más especial</strong>“Ya he ganado ligas con otros equipos pero esta es la que mejor sabor tiene, porque es la mejor afición que hay en España. Con un público así no podíamos perder. Nunca, en ninguna cancha, he visto una afición así. Ha influido bastante en el rival, han salido bastante nerviosos y encima hemos encontrado nuestro ritmo muy rápido, además de que Klos lo ha hecho fenomenal. Seguiré en el Constructora y nuestra próxima intención es ir por la Copa de Europa; tenemos que reforzarnos, pero si seguimos en este nivel y trabajando podemos hacer grandes cosas y sobre todo seguir siendo los primeros en España; tenemos que conseguir la Liga y la Copa. Cuando se comience a planificar la temporada y venga el nuevo entrenador, veremos cuáles son nuestras posibilidades, pero tenemos afición y equipo para estar siempre arriba”. <em>(La Provincia, 2 de mayo de 1990)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1991</span><div class="timeline-content"><strong>Un auge imparable</strong>“No me ha sorprendido el auge del voleibol aquí porque es un deporte que siempre había estado, con buenos jugadores y nivel. Luego el clima, las instalaciones... Todo era propicio para que se diera un buen espectáculo, la gente acudiera y se tuviera en unos años un equipo de nivel. Es mejor partir de perdedores y luego ganar, que no como ha hecho el Palma, salir de ganadores y luego perder la Liga. Esto nos benefició, porque incluso los propios jugadores del Palma ya pensaban que esto era pan comido y que todo se iba a solucionar muy fácil”. <em>(Diario de Las Palmas, 26 de abril de 1991)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1994</span><div class="timeline-content"><strong>De homenajes y retos pendientes</strong>“No quiero un homenaje porque yo soy poco amigo de las ceremonias. Hombre, si durante la próxima campaña me dan una plaquita, muy bien, pero eso del homenaje, de verdad que no me gusta. Es como las bodas yo prefiero que se casen los demás, que no hacerlo yo. Sería una espinita retirarme sin disputar una Final Four con el Gran Canaria, pero seguiré trabajando en cualquiera de los apartados del club para poder lograrlo y estoy convencido de que se logrará algún día”. <em>(Diario de Las Palmas, 17 de enero de 1994)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1996</span><div class="timeline-content"><strong>A por todos los títulos</strong>“El Gran Canaria va a luchar por cada uno de los cuatro títulos que afrontará. Somos favoritos al primer puesto tanto en la Liga ACEVOL como en la Copa del Rey, porque hemos configurado una plantilla en la que se mezcla a la perfección el presente con el futuro y la experiencia con la juventud. Nuestro equipo puede, como mínimo, tratar de igualar a cualquier rival. Luego, dependiendo del trabajo que se desarrolle en la cancha se podrá jugar mejor o peor”. <em>(Canarias7, 18 de junio de 1996)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>Un legado para el futuro</strong>“Afortunadamente el futuro deportivo del club está asegurado hasta el 2010. El próximo año subirán al primer equipo dos juveniles, Raúl Dávila, un receptor de 1,98, y Pedro Cabrera, un central de 2,05. En el año 2000, el 80% del equipo lo compondrán jugadores de la isla. Tuvimos dos semanas de descanso para afrontar la Copa del Rey”. <em>(La Provincia, 13 de abril de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1997</span><div class="timeline-content"><strong>La exigencia constante</strong>“Tenemos un potencial suficiente como para aspirar a lo máximo, pero todo esto son hipótesis. El Guaguas es un club que siempre parte con una plantilla con calidad suficiente para afrontar grandes retos. Sí es verdad que Unicaja Almería parece que sale con cierta ventaja porque mantiene al grupo del año pasado. En los equipos, el tiempo es un factor importante y en eso el Unicaja nos aventaja”. <em>(Diario de Las Palmas, 8 de septiembre de 1997)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Sueño cumplido</strong>“Llevo desde 1983 soñando con estar en una Final-Four. En Las Palmas llevamos soñando e intentando entrar en esta gran fiesta europea del voleibol desde hace mucho tiempo. Cada año intentábamos hacer lo que vamos a realizar ahora. Para mí el sueño se ha acabado. Se convierte en realidad. Esta Final-Four debe ser el punto de partida para una nueva época del club, una nueva forma de trabajar. Que el equipo sea más fuerte y que el año próximo podamos repetir otra vez”. <em>(Canarias7, 14 de marzo de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1998</span><div class="timeline-content"><strong>Contra el desgaste, cantera</strong>“Estaba cansado, pero no de voleibol, porque a mí este deporte me encanta, pero sí llevaba tres años muy duros, de mucho trabajo, y no llegaban los resultados que yo quería. Sobre todo eso: trabajar mucho para ver que recoges pocos frutos. Sé que el trabajo está ahí, porque viendo a los chicos me compensa el esfuerzo que hemos hecho, viendo la cantera, pero sí que es verdad que nos hubiese venido bien, al menos estos tres años, ganar una Liga. Hemos ganado dos Copas y llegamos a una Final Four, pero la Liga se nos resiste. A ver si este año somos capaces de conseguirla. ¿El líbero? El juego cambiará bastante, sobre todo porque ya no hay que contar con seis hombres, sino digamos con un siete base, porque la figura del líbero va a estar siempre presente en el juego. También facilitará mucho el trabajo y más en los entrenamientos, pues habrá hombres que se especializarán en la red, como los centrales, que no tendrán que pasar por detrás, en la zona zaguera, pues ese trabajo lo hará el líbero, simplificando así mucho el entrenamiento. A la larga puede modificar la composición de los equipos, en el caso de los fichajes, porque se hará la plantilla en función de cómo pretenda jugar el técnico. Espero mucho de la afición grancanaria, que para mí siempre ha sido un jugador más de nuestro equipo y creo que hay que tratarla como una parte importantísima del equipo, porque nos dan muchísimo a conseguir la victoria, y por eso hay que cuidarla. Espero que la llegada de Venancio Costa suponga mucho, porque es un hombre con el que, en principio, ganamos un capitán tras la marcha del mexicano Joel Sotelo, y además tiene mucha experiencia y nos puede echar una mano en cualquier parcela del club, no solamente como jugador, sino incluso como entrenador de los jóvenes. Es un hombre que ha sido de casa, de toda la vida, y por eso estoy contento de su recuperación, aunque siempre hay que esperar al desarrollo de la temporada para dar una opinión al respecto, sobre si efectivamente el equipo ha rendido, si un fichaje ha venido bien o no, aunque siempre todos los fichajes que se hacen es con la intención de que sean buenos para el club”. <em>(Diario de Las Palmas, 24 de agosto de 1998)</em>.</div></div>
<div class="timeline-event"><span class="timeline-year">1999</span><div class="timeline-content"><strong>El patrimonio de la casa</strong>“Después de cuatro años hemos conseguido llevar a ocho canteranos al primer equipo, pero todavía nos queda un último esfuerzo para que empiecen a ser fiables, expertos y con solera para ganar títulos, y eso no puede alargarse más de dos años. El principal patrimonio del club son los jugadores locales, pero también tenemos que hacer un equipo que nos ilusione y con el que podamos soñar con ganar algo”. <em>(Canarias7, 1 de junio de 1999)</em>.</div></div>
</div>

[imagen_contenido file="5cap_paco_foto_tecnico.jpg" caption="Fue un técnico sin igual por su experiencia, conocimientos del juego y empatía con los jugadores."]
'),
    array('title' => 'Waclaw Golec', 'numero' => '', 'order' => 43, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('5cap_gol_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'custom_icon_color' => '#f6ae50',
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center 10%',
            'title_lines' => array(libro_hero_line('WACLAW', '#000000', '#f6ae50', 'none'), libro_hero_line('GOLEC', '#000000', '#f6ae50', 'none')),
        ),
        'content' => '
[capitular]Waclaw Golec (Tarnow, 1963) remite, directamente, a la etapa de esplendor que vivió el Guaguas en la década de los noventa con su registro memorable de cinco Ligas consecutivas (1990-1994), conquista en la que el jugador nacido en Polonia tuvo un papel estelar. "Llegué con 26 años y pasé siete temporadas increíbles en todos los sentidos. Encontré un equipo de guerreros, unos compañeros maravillosos y una tierra fantástica, con una afición que llevo en el corazón", resume cuando le toca hacer retrospectiva y en un castellano que conserva impecable pese al paso del tiempo.[/capitular]

[imagen_contenido file="5cap_golec_foto1.jpg" caption="Con sus brazos eternos y retando a la gravedad para uno de sus remates."]

<p>No fue nada fácil el fichaje de Golec, en aquel entonces toda una estrella en su patria, con más de 100 encuentros internacionales con la absoluta y campeón de todo tras despuntar en el Dunajec Nowy Sadz y consagrarse en las filas del Hutnik de Cracovia y Legia de Varsovia. Por un lado, Golec ya tenía "firmado y totalmente cerrado" su compromiso con un equipo italiano para cuando Juan Ruiz vino a contactarle. Y, por si fuera poco, la legislación de la época en el país centroeuropeo impedía emigrar a los deportistas profesionales menores de 28 años. Su compatriota Ireneusz Klos, adquirido semanas antes, no encontró esa traba burocrática al haber rebasado ese límite impuesto. Ruiz, auxiliado por Marcos Sznchenovic, relaciones externas de la entidad, tuvo que realizar arduas gestiones para obtener el permiso correspondiente de la Oficina Central de Deportes de Polonia, órgano competente para autorizar su salida, además de convencer al propio Golec a renunciar a un contrato con mejores cifras económicas en el campeonato italiano para recalar en un proyecto todavía por modelar.</p>

[cita_editorial author="Waclaw Golec"]Nunca miré por el dinero a lo largo de mi carrera y ya todos sabemos que Juan Ruiz es un hombre que, cuando se propone algo, lo normal es que lo consiga. Yo estaba bien en mi país y podía elegir club si me decidía a salir. De hecho, había aceptado la propuesta del Falconara, que era el subcampeón de Italia. Pero Juan me llamó, hablamos... Y no sé bien por qué me convenció.[/cita_editorial]

<p>"Me dio mucha fiabilidad. Me dijo que quería un equipo campeón, que ya tenía grandes jugadores como Sergio Camarero o Paco (Sánchez Jover). También había logrado llevarse a Klos. Además, yo quería unas condiciones de vida buenas para mi mujer y mi hijo y entonces el presidente me habló de que Gran Canaria era un paraíso, algo que pude comprobar. Se puede decir que se juntó todo. Llegó un momento que decidí no ir a Italia, pese a que iba a perder económicamente, y aposté por el Guaguas. Fue una decisión arriesgada... Pero la más acertada que pude tomar para mi futuro", recalca.</p>

<p>Golec, de planta imponente con su 1,95 metros de estatura, con desempeño habitual en la zona cuatro y con habilidades manifiestas como rematador y receptor, encajó "desde el primer momento" en el proyecto, inicialmente dirigido por Robert Croteau, porque, como esperaba, pasó a formar parte "de una plantilla de guerreros dispuestos a morir en la pista".</p>

[imagen_contenido file="5cap_golec_foto2.jpg" caption="Si había que ir al suelo para ganar un balón, Golec ni lo dudaba."]

[cita_editorial author="Waclaw Golec"]Me acostumbré a ganar y, aunque ya se sabe que en el deporte también se pierde, es inevitable, lo que quería era seguir y seguir levantando trofeos. Y en ese equipo era posible. También, tengo que decirlo, con Paco en el banquillo, Juan en el palco y compañeros como Sergio, Klos o Venancio, entre otros, era imposible que aquello saliera mal.[/cita_editorial]

<p>"Entrenábamos y jugábamos al límite. Y eso se notaba en los partidos. Muy pocas veces fuimos inferiores a los rivales, y eso que el Palma tenía una plantilla de lujo. Pero nosotros estábamos un escalón por encima", opina.</p>

<p>Golec también incide en un componente que terminó por disparar la potencialidad del Calvo Sotelo de la transición entre los ochenta y los noventa: el compañerismo. "Éramos amigos. Había un sentimiento de respeto y de apoyo a todos que todavía sigue. Porque aún sigo llamando a muchos con los que compartí aquella experiencia, me preocupo por ellos, les deseo siempre lo mejor. Y cuando jugábamos juntos, era exactamente igual. Queríamos ganar la Liga como fuese y el camino era, además de la calidad y experiencia, del trabajo duro y la constancia, el que en el vestuario todos fuésemos en la misma dirección. Esa fue la base de todo lo que vivimos. Compañeros dentro y fuera", insiste.</p>

[imagen_contenido file="5cap_golec_foto7.jpg" caption="Celebración eufórica de un punto. Klos, Costa, Golec, Jorge Ramón y Sánchez Jover."]

<p>Son "muchísimos los recuerdos" que afloran en su memoria a la hora de hacer balance de su estancia en la entidad isleña. De la afición "todo lo que se diga es poco" porque, en su caso, se congratula de haber sentido "cariño, apoyo y pasión" desde la hinchada que le idolatraba: "Para cualquier deportista profesional siempre es importante notar desde la grada el empuje que necesitas. Yo tuve grandes momentos de forma, pero también sufrí otros menos buenos. Y siempre estuvieron conmigo, jamás una palabra negativa. Eso me hizo muy feliz. Venía de muy lejos y aquí me hacían sentir como si estuviese en mi casa".</p>

<p>"No era el único al que eso le pasaba. En el resto del equipo también estaba la seguridad de que, cuando fallaran las fuerzas, o si no tuviésemos acierto, nuestra gente nos iba a ayudar. Era una seguridad enorme. Notábamos cuando jugábamos como local que al rival todo se le hacía más complicado con el Centro Insular de nuestro lado".</p>

<p>Su sensacional rendimiento despertó el interés de numerosos equipos, que le tentaron para hacer las maletas durante su estancia en el Guaguas: "Me llamaron de Bélgica, el Almería me daba lo que quisiera... Pero no podía ir en contra de mi corazón. Y mi corazón estaba en Gran Canaria y junto a los chicos con los que me divertía jugando y logrando muchísimas cosas bonitas. Las Ligas, las Copas, jugar por Europa, sentir que nos respetaban en cada lugar.

[imagen_contenido file="5cap_golec_foto6.jpg" caption="El poderío de Golec fue una de las armas letales del Guaguas en el que fue figura y referente."]

Otros en mi lugar lo mismo sí hubiesen dado un paso a otro sitio porque las ofertas eran muy pero que muy buenas. Pero no. Realmente, nunca me planteé irme hasta que regresé a Polonia con 33 años y ya para retirarme. Mientras me quisieron aquí, aquí me quedé".</p>

[imagen_contenido file="5cap_golec_foto4.jpg" caption="Golec no pudo evitar las lágrimas y la emoción al despedirse del club en el que se hizo leyenda. Su último acto de servicio fue levantar la Copa del Rey de 1996."]

[seccion_header]La Liga de 1991: la obra maestra[/seccion_header]

<p>Golec reconoce que en su vitrina particular guarda "con especial alegría" la Liga conquistada en 1991, ante el Palma y con un CID colmado hasta la bandera. Dice que todos los campeonatos "son únicos" pero ese en particular lo rescata por las circunstancias en las que se produjeron: "Ellos eran los grandes favoritos. Nos habían ganado en la Liga regular, en la Supercopa, tenían un equipazo. Sixto Jiménez, Rafa Pascual, Willock, Vicedo... Impresionante. Pero nosotros queríamos esa copa, ser los mejores, y completamos un tercer partido, el definitivo ya, maravilloso".</p>

[cita_editorial author="Waclaw Golec"]Recuerdo que no empezamos bien en el primer set. Un mal parcial y, sin venirnos abajo, reaccionamos y no paramos. Es de esos partidos que nunca quieres que acaben porque termina saliéndote todo. En la pista estábamos muy concentrados. Y mirabas a la grada y todo era amarillo, con la gente aplaudiendo y gritando. Ganamos 3-0 y fuimos campeones con el máximo honor. Los aplastamos en todos los sentidos. Fuimos una máquina perfecta de voleibol.[/cita_editorial]

[imagen_contenido file="5cap_golec_foto8.jpg" caption="Golec y Klos, siempre inseparables."]

<p>Confortado por el bagaje profesional y personal que le dejó su larga estancia en el Guaguas ("mejoré en todos los aspectos, maduré muchísimo y compartí muchos sentimientos con gente especial que no hubiese conocido en otro sitio"), Golec asegura estar "muy agradecido" a todos los que confiaron en él y le hicieron entrar en la historia del deporte canario por ser uno de los referentes del club más laureado.</p>

[imagen_contenido file="5cap_golec_foto3.jpg" caption="Imparable con sus remates letales. Al fondo, la afición del CID."]

<p>"Sigo la actualidad del equipo y me pone muy contento que gente como Juan Ruiz, Paco o Sergio hayan vuelto y lo levantaran haciéndolo, de nuevo, campeón. Estoy a miles de kilómetros pero siento como si estuviese allí los títulos que se han conseguido en los últimos años. Ojalá que aquellos años tan bonitos que vivimos se repitan, que la afición regrese, que todos disfruten de esa manera...", concluye desde su tierra pero convertido, "para siempre", en un militante más de la causa.</p>

[imagen_contenido file="5cap_golec_foto5.webp" caption="Junto a su compatriota Ireneusz Klos."]
'),
    array('title' => 'Ireneusz Klos', 'numero' => '', 'order' => 44, 'show_marker' => false, 'parent_ref' => 'cap05',
        'hero' => array(
            'image' => libro_img('5cap_klo_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-iconos.svg'),
            'custom_icon_color' => '#f3ab4f',
            'icon_width' => 80,
            'icon_height' => 80,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('IRENEUSZ', '#000000', '#f3ab4f', 'none'), libro_hero_line('KLOS', '#000000', '#f3ab4f', 'none')),
        ),
        'content' => '
[capitular]Considerado uno de los mejores jugadores del mundo, con 364 partidos acumulados con la selección polaca y una amplísima trayectoria jalonada de títulos y prestigio. Así aterrizó en Gran Canaria un 2 de agosto de 1989 Ireneusz Klos (Gorzow Wielkopolski, 1959) para fichar por el Guaguas, todo un bombazo en el mercado internacional. Procedía de su equipo de toda la vida, el Gwardia Wroclaw, fue recibido en el aeropuerto por una comitiva del club encabezada por Juan Ruiz, presidente, y el directivo Ricardo Ramírez.[/capitular]

[imagen_contenido file="5cap_klos_foto1.jpg" caption="Klos cubrió una etapa llena de títulos, reconocimientos y fama en la disciplina del club."]

[cita_prensa source="Prensa local, 2 de agosto de 1989"]Paco Sánchez Jover me ha dicho que es un equipo de futuro y perspectivas enormes.[/cita_prensa]

<p>La entidad informó de que su adquisición superó los tres millones de pesetas y que culminaba las gestiones iniciadas en el Preeuropeo celebrado en Cádiz en 1987 y en el que se fijaron los primeros contactos para traerlo, aunque la negativa de la federación polaca en ese momento impidió que se ejecutaran las intenciones de las partes. Finalmente, tras una larga espera, y con la vacante que dejaba el colocador canadiense Brad Willock, Juan Ruiz lograba hacer realidad una de las incorporaciones de mayor impacto en la historia.</p>

<p>"No tenía ni idea de Canarias, del voleibol que se podría practicar aquí, vine un poco a ciegas, pero sabiendo que debía haber un buen proyecto porque estaban Sánchez Jover, Venancio Costa o Antonio Miralles, a los que conocía de haberme enfrentado con la selección española. También a Camarero. Pensaba que había potencial para hacer grandes cosas y si decidí dar el paso a salir de mi país era por eso, para conseguir cosas grandes. Me ofrecieron un contrato por dos temporadas con la idea de hacer un proyecto estable, de crecer. Desde el primer momento sentí que tomaba la decisión correcta porque, además, me encantó la isla para vivir con mi mujer y mi hijo. Para mí era muy importante la estabilidad familiar y desde el Guaguas me dieron todas las facilidades del mundo. Se volcaron conmigo al igual que con Golec, que llegó unas semanas después, nos pusieron un traductor y cuidaron todos los detalles. Fue algo impresionante para mí el recibir ese trato tan cariñoso", asegura.</p>

<p>Klos mezcla de inmediato con sus compañeros y, pese a no dominar el idioma, "el entendimiento fue total porque el lenguaje del voleibol es universal", según sus consideraciones. "Fui cogiendo el tono físico y, a la vez, integrándome en el grupo. Estar con Golec fue, igualmente, algo que me ayudó, al igual que a él estar conmigo. Rápidamente adquirí mi nivel y me percaté de la calidad que había en el resto del equipo. Llegué con humildad, con ganas de ayudar y pensando que, quizás, todo iba a resultar más complicado, pero era muy fácil jugar con gente como la que tenía al lado. No esperaba encontrar tanta calidad y fue una gran sorpresa, muy positiva. Al poco tiempo de estar en el Guaguas ya sabía que saldríamos campeones".</p>

[imagen_contenido file="5cap_klos_foto2.jpg"]

<p>Al igual que todos sus coetáneos de aquella etapa gloriosa, el aspecto humano es una de las claves que pondera para el asalto a la primera Liga o el doblete de 1991, éxitos en los que tuvo un papel capital. "Había una gran relación entre todos, conocíamos a las familias de los compañeros, compartíamos tiempo libre y éramos un grupo fuerte, unido, muy sano. Era muy importante tener esos vínculos tan fuertes porque, a lo largo de una competición, siempre hay momentos buenos y malos y necesitas confiar en quien tienes al lado, saber que va a apoyarte, a ayudarte".</p>

[imagen_contenido file="5cap_klos_foto3.jpg" caption="Klos, rememorando viejos tiempos con Golec."]

<p>"Era normal que con Golec tuviese más trato porque ya éramos amigos y compañeros antes de venir al Guaguas. Pero tanto él como yo nos abrimos al resto porque aquí nos hicieron sentir como en nuestra propia casa. Era feliz jugando, entrenando y también al ver a mi familia muy adaptada a la vida en la isla. Yo le había dicho al presidente que necesitaba que los míos estuviesen bien, él me prometió que así sería y, la verdad, cumplió con su palabra. Eso, sin duda, me ayudó a dar mi mejor rendimiento".</p>

[cita_editorial author="Ireneusz Klos"]Siempre ponía por delante de todo la concentración en los partidos. Pienso que en un jugador los porcentajes se dividen, a partes iguales, en lo que se refiere al aspecto físico y mental. Todo va al 50%. Puedes estar muy atento al juego pero si no tienes la condición física necesaria, no vas a llegar al sitio que quieres.[/cita_editorial]

<p>"Alguna bronca me echaban los compañeros cuando me soltaba a rematar todo lo que me venía por delante. Pero lo que hice, con aciertos y errores, fue por el bien del equipo. Nunca busqué sobresalir. No me creía mejor que nadie. Lo único que quería es que el equipo ganara", admite.</p>

<p>Reconoce, además, que el apoyo que sintió de la afición grancanaria "fue muy especial", ya que aunaba "sentimiento y fidelidad", dando cuenta de que, incluso, en las derrotas "la gente estuvo detrás del equipo", algo que valora "de corazón" al estimar el simbolismo que tiene "una fidelidad tan grande".</p>

<p>"Hubiese firmado, al llegar al Guaguas, ganar todo lo que gané en los dos primeros años. Dos Ligas y una Copa. Impresionante. Me alegré muchísimo por los compañeros, por la gente, por la directiva que tanto luchó. Fue todo muy bonito. Y nada fácil, porque los rivales eran muy fuertes. Esa final ante el Bomberos de Barcelona la tengo como uno de mis grandes recuerdos por la alegría que supuso para todos. Los tres títulos que ganamos en esos dos años de 1989 a 1991 significaron muchísimo. Ese grupo de jugadores lo merecía", destaca.</p>

<p>Como aconteció con la mayoría de jugadores del Guaguas de principios de los noventa, Klos recibió numerosas propuestas para cambiar de aires y, pese a que tenía la opción de renovar por otro año más a la conclusión de su contrato, terminó aceptando una del Grenoble de Francia. Fue un adiós "inesperado", dada su pretensión de seguir ligado a un escudo en el que se hizo ídolo y con el que se le intuía un recorrido más duradero. "No fue un paso fácil, pero tuve que elegir. Dejé al Guaguas en lo más alto y, al menos, me quedó ese consuelo. Irme dándolo todo y colaborando en una etapa maravillosa para el equipo de la ciudad", valora.</p>

[imagen_contenido file="5cap_klos_foto5.jpg" caption="Facilitando el remate a Jorge Ramón con una de sus colocaciones."]

[seccion_header]El regreso inesperado[/seccion_header]

<p>"Nunca" imaginó que, con los años, en 1995, tendría un retorno al Guaguas, tras su etapa en Francia y Luxemburgo, ya en el tramo final de su carrera profesional. Todo fue de una manera casual y cuando enfocaba sus pasos a un retiro tranquilo en su país.</p>

[cita_editorial author="Ireneusz Klos"]Golec me invitó a pasar la Navidad en Gran Canaria con la familia. Me gustó la idea porque hacía muchos años que no regresaba. Quería pasar unos días agradables con Golec... Pero, al poco de llegar, me dijo de ir a entrenar al CID, a ver a antiguos compañeros. No había llevado ni ropa deportiva ni zapatillas. Él me dijo que me lo resolvía todo.[/cita_editorial]

<p>"Y así fue. De nuevo pisé esa pista en un partido de entrenamiento en el que jugué con los suplentes. Ganamos 3-1. Estaban en el Centro Insular Juan Ruiz y Antonio Benítez. Me vinieron a saludar, me felicitaron al ver el nivel que tenía ya con 35 años y me dijeron que les gustaría que regresara. Sinceramente, me puso muy contento esa posibilidad y quise que se hiciera realidad".</p>

<p>A Klos le ofrecieron "unas condiciones económicas muy buenas" y con las que se sintió "bastante valorado" pese a estar en la recta final de su trayectoria en activo. "En mi etapa en Luxemburgo tenía que entrenar a un equipo femenino para completar mi salario y eso, obviamente, me quitaba tiempo de mi preparación. Cuando regresé al Guaguas, Juan Ruiz me hizo un buen contrato que me permitió, además, volver a estar enfocado al ciento por ciento en el voleibol profesional. Fue un año muy bonito, recuperando viejas sensaciones con muchos compañeros que ya conocía y Paco Sánchez Jover de entrenador, y que terminamos con otro título, la Copa del Rey que le ganamos al Soria. Fue mi despedida, junto a la de Golec, y con un gran triunfo. No se puede pedir más".</p>

<p>En su balance de las tres campañas defendiendo la camiseta amarilla pesa todo lo bueno y así lo evidencia: "Para mí fue una época maravillosa y que me gusta recordar. Momentos especiales que siempre van conmigo. Volví en 2015 a un homenaje que nos hicieron y todo me vino a la cabeza. Asocio el Guaguas a una parte muy bonita de mi vida. Y saber que los aficionados disfrutaron de mi juego es lo que más valoro".</p>

[imagen_contenido file="5cap_klos_foto_copa96.jpg" caption="Celebración de la Copa del Rey de 1996, con un público entregado a sus héroes. Entre ellos, y en el centro de la imagen, con el 8 inolvidable, Klos."]

[imagen_contenido file="5cap_klos_foto4.jpg" caption="Junto a su compatriota Wlodzimierz Nalazek."]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 06: IGNACIO BRITO / TRIBUTO A LOS SALESIANOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Tributo a los Salesianos / Ignacio Brito',
        'numero' => '06',
        'order' => 50,
        'show_marker' => false,
        'ocultar_titulo' => true,
        'ref_id' => 'cap06',
        'hero' => array(
            'image' => libro_img('6cap_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('TRIBUTO A LOS SALESIANOS', '#FFFFFF', 'hsl(204, 13%, 55%)', 'none'), libro_hero_line('IGNACIO BRITO', '#FFFFFF', 'hsl(204, 13%, 55%)', 'none')),
        ),
        'content' => '
[seccion_header color="hsl(92, 37%, 74%)" star="true" star_position="left" texto="#111111" tag="h2"]Tributo a los Salesianos[/seccion_header]

<p><em style="font-weight:600;">Por Joselu Sánchez</em></p>

[capitular]El Colegio Salesianos Las Palmas, fundado en el año 1923, ha sido un pilar fundamental en el desarrollo del voleibol en Gran Canaria. El apoyo al deporte como vehículo de educación y convivencia entre sus alumnos hizo de este centro un referente en el desarrollo de las actividades de competición deportiva de la isla.[/capitular]

<p>El profesor de Educación Física Silvestre Cabrera Monzón, presidente de la Federación de Voleibol de Las Palmas entre 1973 a 1985, comenzó a impartir los principios de esta disciplina entre sus alumnos y propició el desarrollo de la pasión por este deporte en la vida de muchos colegiales. Algunos de ellos se aficionaron y lo practicaron durante años y llegaron a ser grandes jugadores que compitieron en las ligas de honor nacionales con equipos, tan relevantes en la historia del voleibol canario, como el CV Juventud Las Palmas y el CV Calvo Sotelo.</p>

<p>El primer equipo canario en alcanzar la máxima categoría del voleibol en España, el CV Juventud Las Palmas, liderado por los entrenadores Manuel Evaristo y Félix Rodríguez, en la temporada de 1981-82, contó con una plantilla mayoritaria de alumnos salesianos. Entre ellos podemos mencionar jugadores tan sobresalientes como Javier Rodríguez, Manuel Palacios, Tony Acosta, Alberto Calero, Isidro Quintana, Jordi Comi, Juani Nogales, Luis Apolinario, Alfonso Gallardo, Fefo Montelongo, Antonio Díaz, Carlos Franchy, Carmelo Torres, Andrés Martínez o mi caso, entre otros.</p>

[imagen_contenido file="6cap_igna_foto2.jpg"]

<p>Por otro lado, además, alumnos procedentes de esta cantera colegial contribuyeron a la excelente trayectoria del CV Calvo Sotelo, que también lograría ascender, en la temporada 1984-85, a la división de honor de este deporte. Bajo las órdenes de su entrenador y pieza importante del voleibol grancanario, el fallecido Felipe Nuez, en las canchas del colegio nacional Calvo Sotelo, fueron entrenados Miguel Mendaño, Alfredo Padrón, Tony Vázquez, Juan Carlos Rodríguez, Ortega Araña, Ramón Rodríguez, Tony Acosta, Enrique Ramírez. En la temporada 1985-1986 este equipo adoptó el nombre de su patrocinador y pasó a denominarse CV Guaguas.</p>
[seccion_header color="hsl(92, 37%, 74%)" star="true" star_position="left" texto="#111111" tag="h2"]Ignacio Brito[/seccion_header]

[capitular]Estuvo en la génesis del gran Guaguas, el equipo que se hizo leyenda con su irrupción triunfal a finales de la década de los ochenta, lo que considera "un orgullo que queda para toda la vida" al ser esa una pertenencia "demasiado especial". Ignacio Brito (Las Palmas de Gran Canaria, 1962), todavía hombre activo del voleibol por su condición de director deportivo del CV Sayre CC La Ballena, fue, en sus tiempos, "un colocador temperamental, competitivo y que quería ganar siempre" en aquel grupo que logró dos ascensos a la máxima categoría, aunque el primero no se ejecutara "por cuestiones ajenas al deporte", y en el que se acogió a un joven empresario como Juan Ruiz que llegó "para revolucionarlo todo".[/capitular]

[cita_editorial author="Ignacio Brito"]Ahora es fácil elogiar a Juan porque ha conseguido cosas impensables. Pero en aquellos años, sin ser un entendido del voleibol, fue un futurista, un visionario porque introdujo en el club una visión nunca antes vista y que supuso un impulso total. Deportivo, económico, institucional... Fue una gestión magistral sin la cual no se sabe qué hubiese sido del club.[/cita_editorial]

<p>"Cuando llegó al vestuario, era normal que lo miráramos con ciertas reservas. Nos pidió que le dejásemos trabajar y muy pronto se ganó nuestra credibilidad por lo que consiguió", subraya Brito, quien coincidió con el histórico presidente en los primeros compases de su mandato.</p>

[imagen_contenido file="6cap_igna_foto1.jpg"]

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
            'image' => libro_img('7cap_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center 20%',
            'title_lines' => array(libro_hero_line('MAREK', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('AYER, HOY', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('Y SIEMPRE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Ayer, hoy y siempre. No hay otro manera de referenciar el significado de la figura de Marek Szczesnowicz (Gdansk, Polonia, 1957), historia viva del club por una pertenencia que data de finales de la década de los ochenta y que sigue vigente. Team mánager del equipo ("hice y hago todo lo que sea necesario con tal de ayudar al club"), es testimonio obligado a la hora de celebrar el cincuentenario de la institución por el bagaje que personifica. "El Guaguas ha sido mi vida, mi familia. Ha trascendido lo meramente deportivo porque los años que he dedicado al equipo así lo reflejan. Entré casi de casualidad y, sin saberlo, ahí se inició una historia de la que me siento muy orgulloso", significa.[/capitular]

[imagen_contenido file="7cap_mare_foto1.webp" caption="Década de los 90, con motivo de una visita a Moscú para jugar un partido de Copa de Europa. Marek, el tercero desde la izquierda, posa en la Plaza Roja con periodistas y jugadores."]

<p>El inicio de todo se sitúa con los fichajes de las estrellas polacas Ireneusz Klos y Waclaw Golec, compatriotas suyos: "Estaba el problema del idioma y, también, el de una legislación complicada, entonces en el campo comunista, y que impedía salir a los deportistas por debajo de una edad. Yo me había establecido ya en Gran Canaria y, seguramente, no había muchos polacos por aquí porque Juan Ruiz preguntó por gente que fuese de mi país, me localizó y me pidió que lo ayudara en las gestiones, en ir allí a arreglar todo. Lo que iba a ser un trabajo puntual terminó derivando en esta larga relación que se interrumpió unos años por cuestiones laborales pero que no dudé en retomar cuando se dio el momento oportuno".</p>

[imagen_contenido file="7cap_mare_foto2.jpg" caption="Al frente de una expedición del Guaguas en uno de sus innumerables viajes continentales."]

<p>Ese punto de partida sumerge a Marek en recuerdos imborrables con la etapa dorada de aquel Guaguas que asombró a España con sus títulos y resonancia: "Ahora hemos vuelto a recuperar brillo. Somos campeones, seguimos trayendo a jugadores muy buenos, la afición está regresando... Pero ese Centro Insular lleno hasta la bandera, con las escaleras de acceso atestadas de gente que se había quedado sin asiento, las noches mágicas... Uno se emociona porque fueron campañas preciosas, con plantillas que eran una familia, otros tiempos en los que las relaciones eran familiares, pues te implicabas hasta en temas personales de los jugadores para poder echarles una mano en lo que te pidieran".</p>

[cita_editorial author="Marek Szczesnowicz"]Supone un motivo de satisfacción enorme haber vivido esos años mágicos, irrepetibles, que tampoco podemos comparar porque corresponden a otro contexto. Hoy el fútbol arrasa con todo. Pero nosotros, en esos años de los primeros títulos, nos llegamos a convertir en la bandera del deporte de Gran Canaria.[/cita_editorial]

<p>"Se agotaban las entradas para ver nuestros partidos. Jugábamos por Europa y nos recibían como a las estrellas... Y eso, en un país como España, que no tiene la tradición del voleibol como otros países, tiene un mérito increíble. Y hoy pervive ese espíritu, mantenemos el prestigio, la esencia de un proyecto que ilusionó a todos y que se ha ido adaptando a la modernidad".</p>

[imagen_contenido file="7cap_mare_foto3.jpg"]

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
            'image' => libro_img('8cap_emba_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('EMBAJADORES', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none'), libro_hero_line('POR EUROPA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => ''),
    array('title' => 'Embajadores por Europa', 'numero' => '', 'order' => 60, 'show_marker' => false, 'parent_ref' => 'cap08',
        'anclas_internas' => "Todas las competiciones europeas | todas-competiciones-europeas",
        'hero' => array(
            'image' => libro_img('8cap_emba_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('EMBAJADORES', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none'), libro_hero_line('POR EUROPA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Si brillantísima ha sido la trayectoria nacional del Guaguas, con dominio de las dos competiciones domésticas, reinado que ha logrado revalidar tras su refundación en 2020, su amplia presencia en competiciones europeas, con punto de inicio de 1987 ante el Knack de Bélgica en la emblemática pista del San Román, también es digna de valoración. Con un balance de más de cincuenta partidos oficiales frente a escudos de otros países, el Guaguas se ha convertido, por méritos propios, en uno de los mejores embajadores de Canarias por todo el mundo.[/capitular]

[imagen_contenido file="8cap_emba_foto4.jpg" caption="Año 1987. La expedición del Guaguas acaba de llegar a Bruselas, en el que fue el primer viaje internacional de la historia del club, con motivo de la eliminatoria de la Copa Confederación ante el Knack de Bélgica."]

<p>Esa vocación sin fronteras a la hora de exportar los valores y potencialidades del club también ha llevado aparejada la bandera tricolor para mayor orgullo de aficionados e instituciones públicas, de alta sensibilidad siempre con la representatividad fuera de España.</p>

[cita_editorial author="Juan Ruiz"]Queremos ser alguien en Europa.[/cita_editorial]

<p>Decía Juan Ruiz nada más llegar a la presidencia, a finales de los ochenta, evidenciando que el crecimiento de la entidad pasaba por hacerse un hueco entre los mejores del continente.</p>

<p>Un repaso a su camino rivalizando con equipos extranjeros deja momentos culminantes, como el histórico triunfo ante el PSG francés o la victoria ante el Lennick belga que, en 1998, abrió las puertas a la Final Four de la Recopa que se celebró en Cuneo (Italia), entre otras citas que ya tienen su relevancia en la historia. Y tal ha sido su calado, pasado y reciente, que en el ránking mundial de clubes de voleibol realizado en los últimos meses, el equipo grancanario ocupa uno de los lugares de privilegio, lo que se valora como si fuese un trofeo oficial más en las vitrinas, dada la importancia que tiene un posicionamiento de este calibre.</p>

<p>Como precisa Antonio Benítez, sempiterno mánager y que ha encabezado casi todas las delegaciones del Guaguas en sus comparecencias por las capitales de varios países, esta presencia sostenida procuró una red de relaciones de alto prestigio, además de convertir al equipo en un atractivo para jugar torneos amistosos de primer nivel cada verano. Así lo atestiguan los banderines y placas acumuladas a lo largo de los años, algo que aumenta más si cabe este bagaje más allá de Canarias y España. Las pretemporadas y giras realizadas fuera del país fueron habituales durante varias campañas y reforzaron estos vínculos al margen de los relacionados estrictamente con el ámbito competitivo.</p>

[imagen_contenido file="8cap_emba_foto6.jpg" caption="Celebración de un triunfo en la Champions League de la temporada 2025-26."]

<p>Así, el binomio Guaguas-Europa ya es un clásico en el calendario, con una relación ininterrumpida de trece años (1987-2000), y que ofrece el recorrido con los oponentes que a continuación se detalla.</p>

[competiciones_europa bg="8cap_emba_compeuro_bg.jpg" titulo="Todas las competiciones europeas" id="todas-competiciones-europeas"]

[temp anio="1987-88" comp="Copa Confederación"][rival]Knack Roeselare (Bélgica)[/rival][/temp]

[temp anio="1988-89" comp="Copa Confederación"][rival]Benfica (Portugal)[/rival][rival]Panathinaikos (Grecia)[/rival][/temp]

[temp anio="1989-90" comp="Copa de Europa"][rival]Sisley de Treviso (Italia)[/rival][/temp]

[temp anio="1990-91" comp="Copa de Europa"][rival]Saxon Torhout (Bélgica)[/rival][rival]Steaua de Bucarest (Rumanía)[/rival][rival]CSKA de Moscú (Rusia)[/rival][rival]Philips de Módena (Italia)[/rival][rival]Zcestochowa (Polonia)[/rival][/temp]

[temp anio="1991-92" comp="Copa de Europa"][rival]AZS Olstyn (Polonia)[/rival][rival]Eczacibasi de Estambul (Turquía)[/rival][rival]CSKA de Moscú (Rusia)[/rival][rival]Cannes (Francia)[/rival][/temp]

[temp anio="1992-93" comp="Copa de Europa"][rival]Halk Bank (Turquía)[/rival][rival]Maxicono (Italia)[/rival][rival]Zellit (Bélgica)[/rival][rival]Mladost de Zagreb (Yugoslavia)[/rival][/temp]

[temp anio="1993-94" comp="Copa de Europa"][rival]París Saint Germain (Francia)[/rival][/temp]

[temp anio="1994-95" comp="Copa de Europa"][rival]Dinamo de Bucarest (Rumanía)[/rival][rival]Lokomotiv (Ucrania)[/rival][rival]Olympiakos (Grecia)[/rival][/temp]

[temp anio="1995-96" comp="Copa Confederación"][rival]Nacional de Funchal (Portugal)[/rival][rival]Salonit Anhovo (Eslovenia)[/rival][rival]Estrella Roja (Yugoslavia)[/rival][rival]Arago de Sete (Francia)[/rival][/temp]

[temp anio="1996-97" comp="Recopa"][rival]Zonhoven (Bélgica)[/rival][rival]Belgorod (Rusia)[/rival][rival]Nafels (Suiza)[/rival][rival]Nysan (Polonia)[/rival][rival]Poitiers (Francia)[/rival][rival]Berlín (Alemania)[/rival][rival]Aris (Grecia)[/rival][/temp]

[temp anio="1997-98" comp="Recopa"][rival]Stilon Gorzow (Polonia)[/rival][rival]Maribor (Eslovenia)[/rival][rival]Olympiakos (Grecia)[/rival][rival]Dachau (Alemania)[/rival][rival]Matador Puchov (Eslovaquia)[/rival][rival]Akademiscar Zagreb (Croacia)[/rival][rival]Lennick (Bélgica)[/rival][rival]Alpitour Cuneo (Italia)[/rival][rival]Castelo da Maia (Portugal)[/rival][/temp]

[temp anio="1998-99" comp="Copa Confederación"][rival]Levski Siconco (Bulgaria)[/rival][rival]S. Sab Banka Sarajevo (Yugoslavia)[/rival][rival]Sokol (Austria)[/rival][/temp]

[temp anio="1999-2000" comp="Copa Confederación"][rival]Lennick (Bélgica)[/rival][rival]Maribor (Eslovenia)[/rival][rival]Montegeardino (San Marino)[/rival][/temp]

[temp anio="2001-02" comp="Copa Confederación"][rival]Tiroler de Innsbruck (Austria)[/rival][rival]Nacional de Funchal (Portugal)[/rival][rival]Durener (Alemania)[/rival][rival]Montpellier (Francia)[/rival][rival]Asystel Milán (Italia)[/rival][/temp]

[temp anio="2002-03" comp="Copa Confederación"][rival]Partizán de Belgrado (Yugoslavia)[/rival][rival]Zapadny Bug Brest (Bielorrusia)[/rival][rival]Tourcouring Lille M. (Francia)[/rival][/temp]

[temp anio="2006-07" comp="Copa Confederación"][rival]Halk Bank (Turquía)[/rival][/temp]

[temp anio="2020-21" comp="CEV Cup"][rival]Fino Kaposvar (Hungría)[/rival][nota_rival]* No se disputó la eliminatoria por contagios de Covid en la plantilla del adversario.[/nota_rival][rival]Glatasaray (Turquía)[/rival][rival]Maaseik (Bélgica)[/rival][/temp]

[temp anio="2021-22" comp="CEV Cup"][rival]Hebar Pazardzhik (Bulgaria)[/rival][rival]Calcit Kamnik (Eslovenia)[/rival][rival]Decospan VT Menen (Bélgica)[/rival][rival]Volley Haasrode Leuven (Bélgica)[/rival][rival]Vero Volley Monza (Italia)[/rival][/temp]

[temp anio="2022-23" comp="CEV Challenge"][rival]Deya Volley Burgas (Bulgaria)[/rival][/temp]

[temp anio="2023/2024" comp="CEV Champions League"][rival]CS Arcada (Rumanía)[/rival][rival]HAOK Mladost (Croacia)[/rival][rival]Budvanska Rivijera (Montenegro)[/rival][rival]Hypo Tirol Innsbruck (Austria)[/rival][rival]Partizan Beobrag (Serbia)[/rival][rival]Jastrzebski Wegiel (Polonia)[/rival][rival]SVG Lüneburg (Alemania)[/rival][rival]Jihostroj Č. Budějovice (Rep. Checa)[/rival][rival]VK LVI Praha (Rep. Checa)[/rival][rival]Ziraat Bank Ankara (Turquía)[/rival][/temp]

[temp anio="2023/2024" comp="Copa Ibérica"][rival]Benfica (Portugal)[/rival][rival]Sporting de Lisboa (Portugal)[/rival][/temp]

[temp anio="2024/2025" comp="CEV Champions League"][rival]Olympiakos Piraeus (Grecia)[/rival][/temp]

[temp anio="2024/2025" comp="CEV Volleyball Cup"][rival]TSV Hartberg (Austria)[/rival][rival]Aons Milon Athens (Grecia)[/rival][rival]Ziraat Bank Ankara (Turquía)[/rival][/temp]

[temp anio="2024/2025" comp="Copa Ibérica"][rival]Sporting de Lisboa (Portugal)[/rival][/temp]

[temp anio="2025/2026" comp="CEV Champions League"][rival]MAV Foxconn (Hungría)[/rival][rival]Olympiakos Piraeus (Grecia)[/rival][rival]CV Levski Sofia (Bulgaria)[/rival][rival]Berling Recy. Volleys (Alemania)[/rival][rival]Sir Sicoma Monini Perugia (Italia)[/rival][rival]VK LVI Praha (Rep. Checa)[/rival][rival]Montpellier HSC VB (Francia)[/rival][rival]Sir Sicoma Monini Perugia (Italia)[/rival][/temp]

[/competiciones_europa]
'),
    array('title' => 'Manuel Palacio', 'numero' => '', 'order' => 62, 'show_marker' => false, 'parent_ref' => 'cap08',
        'hero' => array(
            'image' => libro_img('8cap_manpal_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('MANUEL PALACIO', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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

[imagen_contenido file="8cap_emba_foto5.jpg"]
'),
    array('title' => 'Antonio Benítez', 'numero' => '', 'order' => 63, 'show_marker' => false, 'parent_ref' => 'cap08',
        'hero' => array(
            'image' => libro_img('8cap_antben_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ANTONIO BENÍTEZ', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
        'hero' => array(
            'image' => libro_img('8cap_joramon_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'bottom center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('JORGE RAMÓN', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
        'hero' => array(
            'image' => libro_img('8cap_juanmart_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'top center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('JUANMA MARTÍN', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
        'hero' => array(
            'image' => libro_img('8cap_oscar_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ÓSCAR CAMPOS', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Integrante de la primera plantilla que defendió los colores del Calvo Sotelo en la División de Honor, Óscar Campos (Las Palmas de Gran Canaria, 1966) fue otro de los testigos que vivió la transformación del club en su paso de superviviente a candidato a todo. Colocador fichado del Juventud en 1985, cuando mira para atrás para entrar en detalles de aquellos tiempos "predominan los recuerdos positivos" ya que, por encima del balón y los partidos, "la complicidad entre todos era magnífica".[/capitular]

<p>"En mis años en el club siempre recuerdo un vestuario unido, de compañeros, de amigos. Cada uno jugaba su rol. En mi caso, tuve más protagonismo en los primeros años, pues luego con las llegadas de Paco, Venancio, Miralles, Willock, Klos o Golec se puso muy complicado tener minutos. Pero, con independencia de eso, lo que prevalece en mi memoria es un grupo sano y que fue creciendo sin parar hasta lograr títulos y logros de muchísima importancia. Titulares y suplentes íbamos a una, había un verdadero espíritu de equipo. Pensar que íbamos a ser campeones de Liga, sin ir más lejos, parecía de locos. Y se consiguió", razona.</p>

<p>Campos destaca tres nombres propios de su etapa en la entidad. Ensalza las figuras de Felipe Nuez, su primer entrenador y del que no olvida una metodología de trabajo única ("profesionalizó el voleibol porque diseñó entrenamientos muy intensos, con muchas horas, y, a la vez, muy completos, lo que contribuyó a elevar nuestro nivel y perfeccionar el juego"), del presidente Juan Ruiz ("hubo un antes y un después de su llegada, porque se dedicó a buscar medios económicos para el club y eso permitió una gestión muy eficiente y fichajes que posibilitaron los títulos") y de Paco Sánchez Jover ("su incorporación nos cambió la mentalidad y realizó una labor fundamental dentro y fuera de la pista para crear un equipo campeón").</p>

<p>"La primera Copa, la primera Liga, el ambiente del Centro Insular después de haber empezado sin tanta expectación en el San Román, el estreno en competiciones europeas... Hasta que me marché, tras fichar por el Almería en 1991, todo fueron experiencias positivas porque coincidieron con una etapa de grandes resultados, de una evolución constante", sintetiza.</p>

<p>Regresó un año, en el curso 1992-93, después de la marcha del argentino Wiernes y para completar la posición de colocador junto a Falasca, segunda etapa en la que, pese a no jugar mucho, "se siguió disfrutando de un equipo único".</p>
'),
    array('title' => 'Venancio Costa', 'numero' => '', 'order' => 67, 'show_marker' => false, 'parent_ref' => 'cap08',
        'hero' => array(
            'image' => libro_img('8cap_venacos_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('VENANCIO COSTA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]A los 12 años ya estaba en el equipo de Almoradí, empezó gracias al profesor de educación física que lo vio "largirucho" y dijo que era para el voleibol. "En nuestro pueblo hay mucha tradición y es un club con mucha historia. A pesar de ser un pueblo muy pequeño me ofreció una oportunidad". Antes de llegar al Guaguas, jugó dos temporadas en el Son Amar (Palma de Mallorca), su último año juvenil, campeones de España en el año 1985-86, y su primer año como jugador en categoría absoluta 1986-87, en la que se ganó la Liga y la Copa del Rey y debutó con la selección nacional.[/capitular]

<p>"Aterricé en 1987 en el García San Román de la mano de Juan Ruiz Ramos, llegué al Guaguas en un momento de pleno crecimiento y desarrollo del club. Más bien un jugador por consagrar, diría yo, era muy joven y con poca experiencia, pero con muchas ganas y dispuesto a crecer, a pesar de estar ya en el equipo nacional. Desde ese momento comenzó a escribirse una historia única y formar parte de ella siempre ha sido un honor".</p>

[cita_editorial author="Venancio Costa"]Deben darse muchos factores para que un grupo pase de ser un buen equipo a ser un equipo ganador y todo esto se dio con mucho esfuerzo por parte de todos, en un breve espacio de tiempo. Era un equipo con muchas ganas de ganar. Lo primero es que los componentes del grupo crean realmente en las posibilidades del equipo. Una cosa es lo que se dice, otra lo que se siente y otra lo que se hace. Hay que creer en uno mismo y creer en el compañero. En este sentido la confianza entre los principales componentes de nuestro grupo era absoluta.[/cita_editorial]

<p>"Después hay que crear un buen ambiente de trabajo, que no es diversión, sino comunicación fluida y franca, exigencia, respeto y ganas de sacrificarse. Y no hablo solo de echarle horas en el pabellón y el gimnasio sino de comer bien, descansar mucho y salir poco durante muchísimo tiempo. Nosotros nos exigíamos los unos a los otros en todos los sentidos".</p>

<p>"Todo lo vivido permanece intacto a pesar de los años, más allá de las victorias o derrotas, que forman parte indivisible de la vida del deporte de alta competición".</p>

<p>"Después de 30 años de aquellos primeros títulos se valora mucho más todo lo vivido. En aquel momento nuestra primera Copa del Rey fue muy especial, pero los recuerdos del Centro Insular lleno son imborrables, todo el mundo recuerda el partido frente al París Saint Germain, cuando quedaron más de 1.500 aficionados a las puertas. Lo más bonito es prepararse, crecer, madurar, luchar, cuidarse, esforzarse, preocuparse, sufrir, perder, ganar... Y hacerlo uno y otro día, eso es lo difícil y lo atractivo".</p>

<p>"En Gran Canaria conocí a mi mujer, grandísima jugadora mexicana de voleibol, vimos crecer a nuestra hija Danira Costa, jugadora de Superliga y de Selección Nacional. Completé mi formación en la Universidad de Las Palmas de Gran Canaria, siendo jugador del Guaguas participé en los Juegos Olímpicos de Barcelona... No podía pedir más".</p>

<p>"A día de hoy puedo asegurar que la afición grancanaria fue determinante, maravillosa, nos transmitía la energía necesaria para cada momento. Nos enseñó a entregarnos en cuerpo y alma y eso lo valoraban. La afición nos hizo creer, crecimos juntos, convivimos y compartimos sus costumbres y aprendimos a defender con profesionalidad y orgullo los colores de la tierra canaria".</p>

<p>"Recuerdo con mucho cariño la compañía de tantos amigos y amigas fuera de la pista. Fueron un pilar fundamental para seguir adelante, gracias a la suma de pequeños esfuerzos repartidos día a día durante más de 14 años. Ellos son parte de mi familia y espero llegar a todos sin tener que nombrarlos".</p>

[cita_editorial author="Venancio Costa"]Te enseña el valor del sentimiento de pertenencia, del sentido de identidad. En ese equipo había personas que influyeron de manera muy importante en mi vida. Esa época y el voleibol marcaron mi vida, se grabó en mí a fuego, con pasión, se lleva en la sangre. Hasta hace muy poco pensé qué era mi vida y gracias a Dios he descubierto que solo es parte de ella.[/cita_editorial]

<p>"Después de jugar continué durante más de 14 años como entrenador de diferentes equipos. Pude disfrutar como segundo entrenador de la Selección Nacional en los Juegos Olímpicos de Sídney (2000) y de la consecución del Campeonato de Europa en Moscú (2007)".</p>

<p>"Antes de despedirme quisiera enviar un caluroso saludo a todos los compañeros que han pasado por este gran Club, especialmente a Miguel Ángel Falasca, que dejó un vacío imposible de cubrir en nuestros corazones. A Paco Sánchez Jover, mi mentor, por tantos años a su lado. ¡Gracias maestro! A mi entrañable amigo Tomás Álvarez Vera, por su nobleza y sincera amistad. ¡Gracias hermano! Querido Juan Ruiz, mucha fuerza y mucho ánimo en el nuevo proyecto Club Voleibol Guaguas".</p>
'),
    array('title' => 'Antonio Miralles', 'numero' => '', 'order' => 68, 'show_marker' => false, 'parent_ref' => 'cap08',
        'hero' => array(
            'image' => libro_img('8cap_miralles_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ANTONIO MIRALLES', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
        'hero' => array(
            'image' => libro_img('8cap_chavgonz_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('CHAVA GONZÁLEZ', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
        'hero' => array(
            'image' => libro_img('8cap_sandeep_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('SANDEEP SHARMA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
        'hero' => array(
            'image' => libro_img('8cap_cardo_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'top center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('JUAN JOSÉ CARDONA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
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
            'height' => '600px',
            'title_lines' => array(libro_hero_line('EL RELEVO', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('GENERACIONAL', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => ''),
    array('title' => 'El relevo generacional', 'numero' => '', 'order' => 75, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_relevo_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'bottom',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('EL RELEVO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('GENERACIONAL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]La leyenda del Guaguas campeón, cuya hegemonía nacional fue absoluta a inicios de los noventa, se cimentó en un grupo de jugadores de base estable y a la que se fueron añadiendo refuerzos seleccionados, tanto del panorama español como de la pasarela internacional, que no hicieron más que mejorar el nivel de un grupo ya de por sí de una regularidad asombrosa e impermeable a la feroz competencia de otros clubes con mayor presupuesto. El sexteto titular, sujeto a mínimos cambios, era recitado de memoria por aficionados y adversarios, toda vez que figuras como Golec, Camarero, Sánchez Jover o Venancio Costa, entre otros, tuvieron una larga vigencia en la defensa de la camiseta y conformaron un núcleo duro, con una coordinación y automatismos que depararon infinidad de partidos para el recuerdo y con el premio añadido de títulos y prestigio.[/capitular]

<p>Pero en el deporte los cambios generacionales y de ciclo son inevitables y en el caso propio vino pilotado por jóvenes de la casa y alguno traído de fuera que, en líneas generales, cumplieron con nota para mantener en lo más alto la credibilidad del proyecto. Nombres como Alexis Valido, Daniel Castañeda, los hermanos Cabrera, Pedro y Antonio, Raúl Dávila o Níchel Gómez fueron algunos de los exponentes más sobresalientes de la nueva hornada de mitad de la última década del siglo XX y que merecen reconocimiento propio por la labor desarrollada, así como su ejemplo en el prestigio del escudo. Antonio Sánchez, superviviente de la vieja guardia, de una precocidad igualmente asombrosa (ejercía de capitán con 23 años), estuvo presente en ese florecimiento.</p>

[cita_editorial author="Paco Sánchez Jover"]Le doy el valor de un campeonato a los segundos puestos logrados después de las cinco Ligas consecutivas porque tuvo un mérito terrible que compitiéramos hasta el final contra todos con gente joven, inexperta y que, aún así, nos hizo sentirnos orgullosos y capaces de ganarle a cualquiera con su lección de entrega, compromiso y competitividad.[/cita_editorial]

<p>Sánchez Jover fue uno de los convencidos de que muchas de las soluciones pasaban por mirar a la cantera. Incluso él mismo se encargó en repetidas ocasiones de reclutar a jóvenes que, con el tiempo, llegarían a consagrarse siendo internacionales absolutos, además de adornar su palmarés con alguno de los títulos que se fechan en el último tramo de este periodo, tales como las Copas del Rey de 1996 y 1997 o la primera Supercopa de España que entró en las vitrinas, lograda en septiembre de 1996. La manera en la que captó a los hermanos Cabrera, a Raúl Dávila, a Níchel Gómez o, años atrás, a Antonio Sánchez evidencia su grado de implicación. Pero no se quedó ahí, ya que, además de dar la reválida mantuvo una línea de actuación, combinando exigencia y ejemplaridad, que permitió a juveniles codearse con nombres estelares. Todos, sin excepción, agradecen al que primero fue ídolo y, posteriormente, técnico, el papel intervencionista que tuvo, ya que les cambió la vida, llevando los valores sagrados implícitos al deporte al desarrollo y crecimiento personal.</p>

<p>Cuando algunos inolvidables ya estaban en su crepúsculo y se hizo inevitable la necesidad de una inyección de savia nueva y más bríos en la cancha, varios fueron los que asumieron la responsabilidad con unas prestaciones todavía recordadas y puestas en valor.</p>
'),
    array('title' => 'Alexis Valido', 'numero' => '', 'order' => 77, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_alevali_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ALEXIS VALIDO', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Tres etapas tuvo Alexis Valido (Las Palmas de Gran Canaria, 1976) en el Guaguas. Todas cortas, pero, igualmente, trascendentes y de las que asegura sentirse "muy orgulloso", pese a que su prosperidad profesional en el voleibol llegó fuera del club, al igual que su prolongada estancia en la selección absoluta, con la que fue olímpico en Sídney 2000 además de tomar parte en ligas mundiales y torneos internacionales. "Salí de La Paterna y entré en el Guaguas porque Juan Ruiz y Antonio Benítez contactaron conmigo. Entré en edad juvenil porque recuerdo haber participado en el Campeonato de España de la categoría ya integrado en el Guaguas. Y muy pronto, antes de que quise darme cuenta, estaba en el vestuario con los mayores, cambiándome de ropa junto a Camarero, Golec o Sánchez Jover, que eran mis ídolos. Fue una experiencia increíble porque, siendo un todavía un niño, estaba rodeado de figuras de ese nivel. No tuve ni tiempo de asimilarlo", afirma.[/capitular]

<p>Valido fue miembro de la plantilla que alzó la Liga en la temporada 1993-94 ("apenas jugué esa campaña porque había un equipazo y para un canterano tener minutos era poco menos que imposible") y, tras un año a gran nivel en las filas del Cisneros ("teniendo como compañeros a Joel Sotelo o Castañeda"), regresó en 1995. "Cuando supe que querían que volviera, ni me lo pensé. Había rendido muy bien en Tenerife y me sentía preparado para ser importante. Seguía siendo un equipazo, aunque sí tuve más oportunidades y todo concluyó de manera muy feliz con la Copa que ganamos en el Centro Insular", subraya.</p>

<p>Valido tendría un nuevo capítulo, ya al borde de la retirada en 2007 cuando, a requerimiento de David Rodríguez, fichó por el Jusan para facilitar su salvación "jugando algunos partidos sueltos", en lo que constituyó otro acto de servicio al escudo del que también presume. "Me necesitaban en un momento complicado y no lo dudé. Era una situación límite y lo consideré una responsabilidad y como agradecimiento a un equipo al que le debo mucho", reconoce.</p>

<p>"Fui internacional júnior jugando en el Guaguas y, por supuesto, considero que en mi carrera significó muchísimo pertenecer al club por todo lo que me aportó como jugador, como persona, por el privilegio que supuso tener compañeros muy valiosos desde el punto de vista humano. Es cierto que fue una etapa en la que las oportunidades para los chicos de la casa eran muy escasas pero, con todo, fue lo que me tocó vivir y solo saco conclusiones positivas", valora.</p>
'),
    array('title' => 'Antonio Sánchez', 'numero' => '', 'order' => 78, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_antsanc_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('ANTONIO SÁNCHEZ', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Las casualidades de la vida hicieron que Antonio Sánchez (Las Palmas de Gran Canaria, 1974) viviera en el mismo edificio en el que residió en sus inicios en el Guaguas Paco Sánchez Jover. Se cruzaban en el ascensor, él un niño y Paco ya consagrado como una figura internacional. "Y un día me dice que me presentara en la pista del San Román a entrenarme con la base del Guaguas, que tenía que hacer voleibol. En mi vida había tocado una pelota, pero ni se me ocurrió llevarle la contraria. Así arranca mi historia con apenas 13 años en el equipo que me marcaría la vida", describe.[/capitular]

<p>Antonio ya se asoma con los profesionales en los tiempos del técnico mexicano Sergio Hernández, la histórica campaña 1988-89 que deparó el primer título con la Copa del Rey ganada al Palma en el Centro Insular, si bien su estreno no se produce hasta 1992, con el argentino Marcelo Giovanacci en el banquillo. La espera tiene su explicación: "Me fui a realizar la concentración permanente en Palencia con la selección júnior, la primera convocatoria de ese tipo que se celebraba y luego se convirtió en habitual. Era una concentración para captar talentos para el equipo nacional. De ahí, al acabar, ya pasé al primer equipo".</p>

<p>Tiempos de esplendor, con los célebres dobletes y un grupo de jugadores que colmaba la capacidad del Centro Insular: "Vivir aquello fue algo magnífico. No era fácil hacerse sitio entre tanta figura y los entrenamientos eran una guerra, en el buen sentido de la palabra. Con 18 años a mí me masacraban en las sesiones diarias. Un error en un saque, en una recepción, ya era motivo de que todos se te tiraran encima. Era una presión total pero que, a la larga, me permitió ser el que fui. Es impensable que eso suceda hoy en el deporte profesional. Era otra época, con otros valores. Para mí mejores, aunque implicaran un sacrificio continuo".</p>

<p>"Desde esa etapa, que me dio un aprendizaje tremendo, al lado de los Camarero, Golec, Costa, Miralles, Paco, Klos o Chava, me tomaba cada entrenamiento como si de un partido se tratara. Perder un partidillo en una sesión de trabajo me fastidiaba el día y no pensaba en otra cosa que regresar al día siguiente a la pista para resarcirme. Ganar era una obsesión. Ya fuera en partidos oficiales o en los ensayos", insiste.</p>

[cita_editorial author="Antonio Sánchez"]Paco se dirigió a mí en el banquillo y me dijo que la armara. Que agitara todo. Me centré en Matheus, la gran figura del Almería. Con miradas, susurros y comentarios, con ese otro juego que también vale, lo saqué del partido y luego, claro está, funcionó a las mil maravillas el plan de Paco, magistral a la hora de leer lo que necesitábamos. Nos dieron por muertos y él ofreció una lección moviendo piezas y haciendo que no perdiéramos la fe.[/cita_editorial]

<p>Inevitable, entre tantos recuerdos, rescatarle la Copa del Rey ganada en 1997 al Almería y remontando un 0-2 adverso. Junto a Castañeda y Miralles, él fue uno de los artífices de un triunfo memorable.</p>

<p>Tal era su manera de entregarse, que desvela una multa que le puso el club ("de 5.000 pesetas") por protagonizar una disputa dialéctica con su compañero Falasca durante el transcurso de un partido: "Nos dijimos de todo, es verdad. Pero siempre por el bien del equipo. Falasca (Q.E.P.D.) y yo éramos uña y carne. Con él, como con el resto, en la pista era una batalla sin cuartel pero, al terminar, salíamos juntos a tomar algo, nos queríamos y respetábamos todos. Nos protegíamos. Pero entendíamos el deporte de esa manera, con un perfeccionismo enfermizo y que no toleraba errores".</p>

<p>De igual manera él lo hizo con la camada de canteranos que surgió a finales de los noventa: "Antonio Cabrera me odiaba porque en los entrenamientos estaba siempre encima de él. Él estaba allí para hacernos ganar. No para equivocarse o aprender. Fue lo que me enseñaron y lo que yo quise trasladar. A Juan Carlos Vega igual. Valido, Pedro Cabrera, Raúl Dávila... Me los comía. Pero luego, cuando tocaba competir, volaban. Asumían la presión con una naturalidad absoluta".</p>

<p>Y abunda en el que considera urdidor de ese estilo guerrero y ganador: "Paco era un adelantado. Siempre lo fue. Además de que el voleibol español es imposible entenderlo sin su figura, fue el primero en poner publicidad en las redes, tratar de hacer lo mismo en los balones. Siempre estaba con iniciativas. Si el entrenamiento era a las cuatro, a las tres él ya estaba revisando qué música ponernos, de qué manera señalizar el suelo, qué ejercicios había que practicar. Su nivel de conocimientos era inalcanzable para el resto. Una vez, en Alemania, nos llevó a un bosque a entrenar porque no teníamos pista. Quería que imagináramos que los árboles hacían de red... Podría estar contando anécdotas con él y no terminar. Una enciclopedia abierta en inteligencia, gestión de grupo, motivación, capacidad comunicativa. El mejor", opina.</p>

<p>Tras un paréntesis fuera, con paso por el Gijón en el curso 1997-98, regresó para una segunda etapa con la que cubrió su ciclo de 6 años en el Guaguas (1992-97 y 1998-99).</p>

<p>Con 24 años, y tras aprobar las oposiciones para ejercer de policía, Antonio Sánchez decidió dejarlo, si bien luego añadió dos años más en las filas del Compaktuna atraído por la llamada de Sánchez Jover. "Tras proclamarnos subcampeones de Liga, en 1999, miré por mi futuro personal porque el dinero que nos daban no te alcanzaba para mirar a largo plazo. Y eso que rendí muy bien, como todos me admitieron. Fue una pena que, luego, en el club nadie tuviera la idea de poner en valor la base que había, con muchísima gente de la casa de una calidad enorme, para, con un par de retoques, potenciar a un Guaguas que podía haber vuelto a ganar Ligas. Se tiró por la borda un legado muy valioso y eso terminó llevando a la fatalidad con la desaparición".</p>
'),
    array('title' => 'Daniel Castañeda', 'numero' => '', 'order' => 79, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_dancasta_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('DANIEL CASTAÑEDA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Figura relevante en el Guaguas del cambio de siglo, Daniel Castañeda (Madrid, 1975) admite que, cuando en 1996 formalizó su fichaje por el club, tras sobresalir en el Palencia y el Cisneros, con el premio de ser citado por la selección española, puso "el punto culminante" a su carrera, ya que, como recuerda, "pocas camisetas más importantes se podían vestir" que la amarilla del equipo grancanario.[/capitular]

<p>"Sabía que iba a un equipo ganador, que iba a estar en los primeros puestos y que, además, estaba entrenado por Paco Sánchez Jover, una referencia en el voleibol. Por si fuera poco, a nivel personal, se me brindaba la opción de compatibilizar el deporte con mis estudios de Arquitectura. No lo dudé y no me arrepentí", asegura a propósito de un periplo que se alargó hasta el año 2002.</p>

<p>Castañeda se convirtió en un jugador apreciado y valorado por la afición del Centro Insular en una trayectoria que fue de menos a más, con un protagonismo creciente que eclosionó en la final de la Copa del Rey ganada en 1997 y en la recordada Final Four de la Recopa, disputada un año después en Italia.</p>

[cita_editorial author="Daniel Castañeda"]Son momentos que quedan para siempre. Nunca antes había logrado un título y esa Copa, que se sacó adelante, además, en unas circunstancias muy especiales, con varios saliendo desde el banquillo como revulsivos y remontando un 0-2 ante el Almería, significó muchísimo, una felicidad enorme. Y, después, hacer un papel muy brillante en Europa y estar entre los mejores fue otro premio aunque no tuviese el trofeo como recompensa.[/cita_editorial]

<p>Castañeda también destaca que, en esa transición que se desarrolló en sus años de militancia, "los subcampeonatos de Liga tuvieron muchísimo mérito", al tener que competir el Guaguas "ante clubes de mayores presupuestos y potencial", lo que dio mayor realce a "competir por todo y dar un nivel destacado". En este sentido, matiza que "había un equipo muy justo, sin la profundidad de recursos que tenían otros adversarios" para poder haber llegado más lejos en los objetivos.</p>

<p>"Nos quedamos sin Liga, es verdad, pero me siento muy orgulloso de haber formado parte de esas plantillas que, año tras año, lucharon por mantener el prestigio del club en lo más alto, pese a que comenzó a hacerse patente una decadencia, tras la salida de Juan Ruiz de la presidencia, que terminó alcanzando todo. De hecho, cuando me voy ya se empezaban a vivir situaciones complicadas", añade.</p>

<p>Asegura que su experiencia en el Guaguas le creó un vínculo que hoy se mantiene y del que presume: "Se me puso la piel de gallina cuando me dijeron que el Guaguas volvía tras muchos años sin competir. Y me considero uno más porque vivo los partidos con mucha emoción, celebro los títulos que se han ganado y deseo todo lo mejor a jugadores, técnicos y dirigentes. El equipo lo llevo metido muy adentro".</p>
'),
    array('title' => 'Juan Carlos Vega', 'numero' => '', 'order' => 80, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_jcarvega_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('JUAN CARLOS VEGA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Lo lleva en el corazón. "El San Roque me hizo jugador y persona. Y el Guaguas, en la figura de su presidente Juan Ruiz, hasta me ayudó a salir adelante con aportaciones económicas cuando estaba en categoría júnior. Luego tuve el privilegio de defender sus colores, de ganar una Copa, de llegar a la selección absoluta y desarrollar mi carrera profesional en otros clubes gracias a todo lo que me enseñaron en mi casa. Eso va en el corazón para toda la vida". Juan Carlos Vega (Las Palmas de Gran Canaria, 1975) todavía ríe cuando recuerda sus sesiones de entrenamiento en los pasillos del Centro Insular, a las órdenes de Esteban Paganini, para ejercitar el antebrazo. La fusión entre San Roque y Gran Canaria le hizo ingresar en las categorías inferiores del club antes de dar el salto a la primera plantilla y con dos temporadas enlazadas (1997-1999) de buenas prestaciones bajo la batuta técnica de Sánchez Jover.[/capitular]

<p>"Ganamos una Copa del Rey que fue muy festejada, por la remontada que logramos ante el Almería, y, en general, creo que respondimos bien a lo que se esperaba. Paco fue un entrenador muy valiente. Para mí ya era un ídolo por todo lo que nos había dado con los Golec, Klos o Camarero, aquellos tiempos de gloria. Pero cuando me tocó trabajar con él, que le diera confianza a la cantera, que apostara por muchos chicos de la tierra, me hizo tener mejor concepto de él, que ya era difícil por toda la admiración que le tenía", añade.</p>

[cita_editorial author="Juan Carlos Vega"]Comencé tarde a jugar, ya con 14 años. Pero empecé y no paré. Vivía cada partido al límite. Más allá de recursos técnicos o físicos, me tomaba como si fuera la última batalla cada jornada, cada encuentro. En el Guaguas no tuve un rol principal, pero en lo que me utilizara Paco, salía a comerme la pista. Daba todo lo que tenía y más. Quería ir a por todos los balones, ayudar a los compañeros, transmitir a los aficionados, defender todos los ataques. Era todo o nada. No me valía con menos.[/cita_editorial]

<p>Esa manera de competir le dio la excelencia, posteriormente, con su prolongado periplo internacional con España y compartiendo experiencias con los mejores del país: "Fueron dos años en el equipo de mi tierra. Quizás pocos, la verdad. Luego Almería, Málaga... Pero el Guaguas es el Guaguas. Para mí, tras el San Roque, fue el inicio de todo. Y la formación que me dieron, la confianza, la oportunidad... Todo supone un tesoro incalculable para mí. Me considero un privilegiado por lo que me tocó vivir, por las personas que estuvieron a mi lado siempre. Pasan los años y, por encima de títulos, medallas, trofeos y elogios, me quedo con eso, con la vivencia que, a través del voleibol, me convirtieron en quien fui y en quien soy. Mi agradecimiento a la entidad lo voy a llevar siempre y con el mayor de los orgullos".</p>
'),
    array('title' => 'Hermanos Cabrera', 'numero' => '', 'order' => 81, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_hermcabre_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'top center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('HERMANOS CABRERA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]De cómo entraron a formar parte del Guaguas los hermanos Cabrera, Antonio y Pedro, con el tiempo internacionales absolutos y figuras consolidadas en el panorama profesional, habla y mucho de la fuerza del destino. Ambos acudieron como espectadores, entre los miles que se congregaron en el Centro Insular, a presenciar el histórico partido de Copa de Europa frente al PSG en la temporada 1993-94. "A mí en el Claret ya me perseguía Camarero, que daba clases de voleibol allí, para que me metiera en el vóley. Yo le decía que no, que eso no era de hombres. Y él insistiendo", rememora Antonio (Las Palmas de Gran Canaria, 1977).[/capitular]

<p>El caso es que ambos hicieron uso de las invitaciones para acudir a un encuentro que colapsó la capital por la riada de gente que se congregó en el recinto de la Avenida Marítima. Y al acabar el choque, culminado con una victoria para el recuerdo, sucedió lo impensable. "De pronto, en mitad de la avalancha de gente celebrando el triunfo, con la pista invadida de gente, Sánchez Jover, todavía vestido con la equipación del Guaguas, se dirige a mí y me dice que me vaya con él al vestuario. Surrealista. Yo era uno más entre la multitud. Me quedé de piedra", relata Pedro (Las Palmas de Gran Canaria, 1978). No acabó todo ahí: "Y Camarero, que andaba por allí, le dijo a Paco que yo tenía un hermano, que también tenía que venirse conmigo", añade. Y así, de repente, los dos se vieron en mitad de autoridades y dirigentes felicitando a jugadores y técnicos. "Lo cuentas y es normal que cueste que te crean, pero fue tal cual. Pasamos de ir a ver al equipo a salir con una propuesta para entrenar en las inferiores del Guaguas en Cruz de Piedra por invitación directa de Paco", remarca Pedro, convencido, como Antonio, sobre la marcha. "Venía de quien venía. Imposible negarse", añade Antonio.</p>

<p>Una anécdota más en los inicios, ahora a cuenta del menor de la saga. "Un día me vio Paco jugando un partido de baloncesto en las canchas de Las Alcaravaneras y me abroncó como ni mi padre había hecho. Que no se me ocurriera más hacer eso, que me fuera directo a casa... En vez de estar jugando al basket parecía que estaba haciendo algo malo", ironiza.</p>

<p>Antonio va directamente concentrado a la selección júnior a Guadalajara tras dar sus primeros pasos y con apenas conocimiento del juego. "Medía dos metros y me citaron sin verme tocar un balón. Se puede decir que era internacional antes de jugar. Porque la llamada de Buchaga, que era el seleccionador de la categoría, me llegó sin apenas haber practicado". Y de allí, de esa estancia entre los mejores del país, se incorporó a la primera plantilla, ya para la temporada 1996-97, la que se saldó con la Copa del Rey.</p>

[cita_editorial author="Antonio Cabrera"]Durante un tiempo, el Guaguas era la base de la selección absoluta. Vega, Valido, Dávila, mi hermano y yo... Era algo increíble. Y todo, por obra y gracia de Sánchez Jover, que fue quien le dio un patrimonio humano de incalculable valor sacando a chicos de la cantera y dándonos oportunidades, confianza, exigiéndonos siempre porque sabía que ese era el camino. Me mataba a gritos, a recriminarme fallos, a pedirme más y luego se iba conmigo tras el entrenamiento a tomar un café y a decirme que era el mejor. Te motivaba de una manera espectacular.[/cita_editorial]

<p>"Una vez casi llegamos a las manos de la tensión tras un partido... Y al día siguiente me guiñó el ojo y me sonrió, diciéndome palabras de apoyo. Te ganaba siempre. Disfruté muchísimo en esos años porque, aunque no llegaron más títulos tras la Supercopa de España, me hice un hombre. Más de un día regresaba a casa llorando tras un entrenamiento porque no me habían salido las cosas. Estaba obsesionado con ser mejor siempre", dice.</p>

<p>Después de competir en los Juegos del Mediterráneo en Túnez con la absoluta, verano de 2001, pone fin a su etapa en el Guaguas tras ser, sorprendentemente, descartado. "Recibí muchísimas llamadas de gente que no se creían que me daban la baja estando en la plenitud de mi carrera y siendo un fijo con España. Sé los motivos, pero me los guardo. Fue una injusticia lo que hicieron conmigo. Si hubiese seguido Paco o si hubiese estado Juan Ruiz, eso no se hubiese producido. Perdí la ilusión, comencé a estudiar Derecho y una lesión que sufrí cuando me puse a entrenar con el Compaktuna, con rotura de los ligamentos del tobillo, terminó de alejarme ya del deporte profesional", relata.</p>

<p>Pedro, en cambio, tuvo mayor recorrido, con posterior paso por Soria, Almería o Son Amar, tras su reluciente estreno con el Guaguas, en 1996, y crecimiento inmediato. "No paré de ir para arriba y eso se lo debo a los compañeros, que me empujaron siempre desde una competitividad sana pero absoluta. Cada día era una batalla. Ibas a entrenarte sabiendo que o rayabas la perfección, o te exponías a una humillación. Siendo un juvenil me pedían ser como el más experto. Hoy te meterían en la cárcel por eso. Pero te curtía porque luego, en los partidos, ni notabas la presión, por mucho que jugaras fuera y te pitaran o insultaran miles de personas, estabas centrado en lo tuyo. Y el ambiente entre todos era impresionante. Si en un viaje te quedabas dormido en el avión, estabas perdido. Te hacían de todo", expone.</p>

<p>"Ser canterano y notar el apoyo y aliento de una figura como Paco -razona- o de veteranos como Antonio Sánchez, Costa, Miralles, luego Gallis... Era un lujo porque tú no dejabas de ser un niño y crecías protegido por gente consagrada y que te defendía en cada partido. Encima, con el acompañamiento de muchísimos chicos salidos de la base, lo que ya te daba un sentido de la identificación mayor. A ese proyecto de cantera que impulsó y desarrolló Sánchez Jover le doy un valor enorme. Coincido con todos al indicar que su marcha fue el principio del fin porque comenzó a valorarse más al que venía de fuera. Yo mismo tuve que irme porque fuera me daban lo que aquí no. Me causó mucha pena tener que dejar mi casa, el Guaguas".</p>

<p>Al término de la temporada 2000-2001 clausura un ciclo que guarda "en el corazón" porque, como en el caso de Antonio, "fue una experiencia enriquecedora a más no poder desde el punto de vista deportivo y personal".</p>
'),
    array('title' => 'Níchel Gómez', 'numero' => '', 'order' => 82, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_nichgom_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('NÍCHEL GÓMEZ', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Lo recuerda con toda precisión. Después de un partido en la competición Intersector ante el Guaguas, en las filas de La Paterna, su barrio de toda la vida, se le acercó Paco Sánchez Jover para proponerle que entrenara en los juveniles del club capitalino. "Yo, que era un chiquillo, hablando con alguien a quien admiraba, al que había visto jugar muchísimas veces, por las guaguas que nos llevaban desde el colegio al Centro Insular con invitaciones para estar en la grada, al que había aplaudido y animado. Y ahí estaba delante de mí... Ni me lo podía creer. Y, como es normal, le dije que estaría encantado, que sí", narra. Así entró Níchel Gómez (Las Palmas de Gran Canaria, 1978) a formar parte de la disciplina del club, de la manera más espontánea y rápida posible.[/capitular]

<p>Y sin parar de crecer durante su formación hasta su debut, que se produjo en 1998. Primero como receptor, y con el tiempo reconvertido al líbero, Níchel asegura que hasta su marcha, al término de la campaña 2002-03, "los buenos recuerdos son abundantes" y le hacen mirar a ese tiempo "con muchísima felicidad".</p>

<p>"Compartía vestuario con muchísimos jugadores de la tierra, lo que fue muy importante para todos nosotros, pero, además, teníamos en la plantilla auténticos monstruos. Ya no hablo de Paco Sánchez Jover, que estaba por encima de todos. Me viene a la memoria Venancio Costa y las broncas que me daba. Me decía que si él decía que algo era blanco, era blanco aunque fuese negro y yo lo viese negro. Todo con tal de ayudarme a mí y al resto a crecer. Eran veteranos ejemplares, que lo hacían todo por el bien del grupo, que te protegían pero, al tiempo, no te pasaban una. La exigencia resultaba brutal, a veces agotadora, pero no había otro camino para superarse y hacerse sitio", apunta.</p>

<p>Fueron años, tras la Final Four de la Recopa en Cuneo, sin el premio de los títulos pero con un nivel de rendimiento "asombroso" para los medios y potencial que manejaba aquel Guaguas, tal y como resalta:</p>

[cita_editorial author="Níchel Gómez"]Se nos pedía la permanencia, pero logramos subcampeonatos. Incluso ya en la última etapa en el Jusan, con todo en una dinámica muy negativa, nos sobreponíamos siempre y a punto estuvimos de meternos en los play-off.[/cita_editorial]

<p>"Cumplí un sueño por defender esa camiseta. Miro las fotos de la época y me viene a la mente un grupo muy sano, en el que, pese a las dificultades, todo eran apoyos. Tenía muchísimo mérito sostener al Guaguas con gente de la casa más algunos refuerzos que vinieron de fuera. Dimos todo lo que llevábamos dentro, en mi caso pelea, entrega, intensidad en la pista, aunque, por desgracia, muchas cosas que se nos escapaban a los jugadores terminaron precipitando lo que nadie quería que pasara, que fue la desaparación del Guaguas. Soy de la opinión de que se pudo evitar. Yo terminé en el Compaktuna con Paco y contemplando con mucha tristeza todo lo que pasó. Por fortuna, ahora se ha hecho justicia recuperando un equipo que significa muchísimo tanto para la isla como para el voleibol español. Y espero que haya vuelto para no volverse a ir", se felicita.</p>
'),
    array('title' => 'Raúl Dávila', 'numero' => '', 'order' => 83, 'show_marker' => false, 'parent_ref' => 'cap09',
        'hero' => array(
            'image' => libro_img('9cap_rauldav_hero.jpg'),
            'background_color' => 'hsl(220, 30%, 8%)',
            'background_position' => 'center center',
            'overlay' => 'rgba(0, 0, 0, 0.35)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(201, 16%, 77%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('RAÚL DÁVILA', 'hsl(0, 0%, 0%)', 'hsl(201, 16%, 77%)', 'none')),
        ),
        'content' => '
[capitular]Iba para tenista, al ganar el Campeonato de Canarias de su categoría siendo un niño, y, tras obtener una beca para estudiar en Seattle (Estados Unidos), "ya con los billetes comprados", nada le hacía pensar que haría carrera en un deporte, el voleibol, que desconocía "por completo". Pero en el porvenir de Raúl Dávila (Vigo, 1978) se cruzó la figura de Paco Sánchez Jover. "Y eso lo cambió todo", admite. "Un amigo me invitó a unas pruebas de voleibol en Cruz de Piedra. Fui por curiosidad, por matar el rato, sin más pretensión que divertirme. Y algo debía hacer bien porque Paco fue a hablar con mi padre y nos terminó de convencer para que renunciara a irme a América. Ahora se dice fácil, pero fue una decisión muy importante en ese momento. Me hizo enamorarme del voleibol y me quedé por él", apunta.[/capitular]

<p>Con unas condiciones físicas privilegiadas, 1,95 metros de estatura como carta de presentación siendo un juvenil, forjó sus progresos a la par que los hermanos Cabrera, con los que compartía generación y afinidad ("nos hicimos de la familia", aclara), además de tejer una mentalidad en la que no cabía un paso atrás.</p>

<p>"Sabíamos el grado de competencia que había en el equipo profesional y todo nos parecía poco para mejorar. Recuerdo llegar a jugar dos partidos en un mismo día en las categorías inferiores del Guaguas y acabar la jornada en el banquillo de la primera plantilla con un encuentro oficial. O quedarme con Pedro Cabrera, una Nochevieja entera, viendo vídeos de otros equipos para aprender. Y en los entrenamientos, dejarme el alma. No tenía ni 18 años y ya había sido internacional júnior. Y con 19 ya estaba en la absoluta. Para mí progresar en el voleibol se convirtió en una obsesión, en una cuestión fundamental", remarca.</p>

[cita_editorial author="Raúl Dávila"]Fue lo que me transmitieron. Ganar, ganar y ganar. En un mes tuve que aprender porque fue empezar y todo venir a velocidad de vértigo. Guaguas, selecciones... Si pude llegar, si pude evolucionar, fue por el entorno, por ese vestuario en el que nunca había una excusa. Costa, Paco, Pedro, Antonio, Rueda, Robles, Castañeda, Gallis... Ganadores natos y con una cultura del sacrificio y la superación que a mí me sirvió de educación en otros ámbitos de la vida, ya fuera del deporte. Siempre me costó medirme en mis reacciones, era demasiado temperamental. Con el voleibol, y en el Guaguas que conocí, aprendí a contenerme, a entender, a madurar.[/cita_editorial]

<p>Dávila debutó en 1997 y permaneció en nómina hasta el año 2000. "Fueron campañas irrepetibles en las que la cohesión humana, la fortaleza del grupo, alcanzó unas cotas impensables. Había sentimiento de pertenencia, de equipo con máyusculas. Merecimos más, en el apartado de los títulos, porque plantamos cara a clubes como el Almería que nos triplicaban en presupuesto. Pero no cambio nada porque me siento partícipe de una época muy especial por el compañerismo y camaradería que no paramos de cultivar", valora.</p>

<p>Su marcha, rumbo a Alemania, se debió a que no sintió que le valoraban como creía ("al ser de la cantera, como a otros muchos compañeros, no se me tomó en serio cuando así lo exigí") además de subrayar que la salida de Sánchez Jover, en el verano de 1999, "tuvo un efecto demoledor en el proyecto de cantera que se había ido construyendo con mucha paciencia y trabajo en los años anteriores".</p>

<p>"La salida de Paco fue el principio del fin. Se generó un sentimiento de orfandad en todos nosotros que no se superó, como se comprobó con el paso del tiempo y la marcha sucesiva de mucha gente muy valiosa y de una calidad inmensa. Ahora me alegro que haya vuelto con el nuevo proyecto del Guaguas. Me convenció para jugar en el Compaktuna a sus órdenes y lo considero como una de las personas más importantes de mi vida por todo lo que me ha enseñado y aportado", afirma.</p>
'),

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
            'image' => '',
            'background_color' => 'hsl(14, 10%, 20%)',
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'custom_icon_color' => 'hsl(14, 16%, 69%)',
            'icon_width' => 50,
            'icon_height' => 50,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('UNA TRANSICIÓN', 'hsl(220 50% 12%)', 'hsl(14, 16%, 69%)', 'none'), libro_hero_line('DOLOROSA', 'hsl(220 50% 12%)', 'hsl(14, 16%, 69%)', 'none')),
        ),
        'content' => ''),
    array('title' => 'Una transición dolorosa', 'numero' => '', 'order' => 86, 'show_marker' => false, 'parent_ref' => 'cap10',
        'hero' => array(
            'image' => libro_img('10cap_tran_hero.jpg'),
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(14, 16%, 69%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('UNA TRANSICIÓN', 'hsl(220 50% 12%)', 'hsl(14, 16%, 69%)', 'none'), libro_hero_line('DOLOROSA', 'hsl(220 50% 12%)', 'hsl(14, 16%, 69%)', 'none')),
        ),
        'content' => '
[imagen_contenido file="10cap_tran_foto1_color.jpg" caption="El 9 de junio de 1998 se produjo el relevo presidencial en el Guaguas. Juan Ruiz escenificó con este abrazo el traspaso de poderes a Mario Hugendubel, su sustituto."]

[seccion_header color="navy"]Juan Ruiz traspasa sus poderes; comienza la decadencia[/seccion_header]

[capitular]El 9 de junio de 1998 se produjo el relevo presidencial en el Guaguas. Mario Hugendubel, economista que había estado ligado a la directiva saliente el año anterior, asume el mando de la entidad por la salida de Juan Ruiz, quien ponía fin a su largo y exitoso mandato y que se había prolongado desde 1986. El propio Juan Ruiz bendijo la sucesión al declarar que Hugendubel reunía los requisitos para asumir la responsabilidad de mantener en lo más alto al club que, meses antes, en marzo, había alcanzado su mejor participación en competiciones europeas al participar en la Final Four de la Recopa. "Honestidad, trabajo e ilusión", fue lo que solicitó el histórico dirigente a su heredero. A nivel institucional, cuentas saneadas y un prestigio forjado a base de éxitos deportivos y crecimiento sostenido. Hugendubel, que quiso mantener con él a varios ejecutivos de la anterior cúpula, casos de Ismael Chinea o Marcial Ginory, admitía que recogía un legado reluciente.[/capitular]

[cita_prensa source="Diario de Las Palmas, 13 de junio de 1998"]La posibilidad surgió por la amistad que me une con Juan Ruiz. Me lo propuso hace cosa de un año, que necesitaba a alguien que fuera su sucesor y me veía a mí como la persona indicada. Yo en principio no quería hacerle mucho caso, entre otras cosas porque no tenía en mente ser presidente de un club. Me fue involucrando en el tema, me fue dando confianza y al final me decidí. Ha sido una decisión totalmente mía.[/cita_prensa]

<p>Y añadía a modo de advertencia: "El listón está altísimo. Deportivamente yo pienso que es muy difícil igualar lo que se ha hecho en los doce últimos años. Ahora nosotros lo que vamos a intentar al máximo es no defraudar a la afición y a Gran Canaria, y vamos a trabajar al máximo para por lo menos intentar conseguir estar entre los tres primeros puestos en la Liga española y hacer un buen papel en Europa".</p>

[cita_prensa source="Canarias7"]Nuestra filosofía contempla el apoyo sin límites al trabajo de la cantera, y sus valores tendrán un protagonismo especial como el caso de Raúl Dávila, hoy en día en la selección. Con una buena organización en las categorías infantiles, cadetes y juveniles podemos depender en el futuro de nosotros mismos, sin que tengamos que recurrir al mercado nacional o internacional de jugadores.[/cita_prensa]

<p>La temporada 1998-99, la de su estreno en el palco, deja mal sabor de boca. El Guaguas no gana ningún título, tras quedar subcampeón de Liga por detrás del Soria, tampoco resultan relevantes sus prestaciones en la Copa del Rey o en la competición europea, y la primera gran crisis se desata en verano, cuando discrepancias con Paco Sánchez Jover provocan su salida de la entidad, lo que constituyó un serio contratiempo para el proyecto de cantera ya iniciado por él y que, con el tiempo, se desmoronaría ante la ausencia del gran valedor de los chicos de la casa.</p>

<p>La apuesta de Benjamín Vicedo como su sustituto en el banquillo, auxiliado por un histórico como Antonio Miralles, tampoco funcionó, al igual que una política de fichajes destapada como errónea. Fuera de la lucha por el título y sin clasificarse para competiciones europeas por primera vez desde 1987.</p>

<p>Los problemas internos comienzan a aflorar con las dimisiones en la junta directiva de Hugendubel de varios miembros, casos de José Rodríguez y Miguel Ángel Hernández, lo que termina derivando en un desgaste hasta entonces desconocido en la historia reciente del Guaguas. Ni la consecución de un nuevo patrocinador (Idecnet) que inyectó más músculo financiero logró impulsar un proyecto que estaba muy lejos de las expectativas. La llegada de David Rodríguez en sustitución de Vicedo, exjugador y con experiencia en la dirección técnica tras ser segundo de Sánchez Jover y estar integrado en la selección, se pensó como un estímulo para reactivar al club. Una medida tan bien intencionada como ineficaz como así se delataría con el paso del tiempo.</p>

[seccion_header color="navy"]La estabilidad imposible[/seccion_header]

[imagen_contenido file="10cap_tran_alin9900.jpg" caption="Guaguas 1999-2000. En la fila superior, de izquierda a derecha, David Bordón, Antonio Cabrera, Andersen, Pedro Cabrera, Guido Bruinsman y Peter Gallis. En la inferior, en el mismo orden, Raúl Dávila, Manolo Batista, Níchel Gómez, Chugui Pérez, Chiqui Mesa y Daniel Castañeda."]

[imagen_contenido file="10cap_tran_pointe.jpg" caption="Felicidad desbordada en Danny Pointe."]

[capitular]El Guaguas había logrado retener a alguno de sus veteranos más importantes, con Peter Galis y Daniel Castañeda al frente del grupo, pero problemas acrecentados terminarían afectando a la integridad del equipo y sin posibilidad alguna de que se pudieran disimular. Así, en diciembre de 2001 se anuncia un plante de los jugadores por las deudas acumuladas. Los profesionales acordaron no entrenar ni jugar más hasta que se actualizaran sus salarios. La huelga se solucionó días después con el compromiso de pago por parte del presidente, aunque en el ánimo de los jugadores ya pesó este condicionante en el resto de la temporada, lo que motivó una incertidumbre palpable y por todos reconocida. En ninguna de las tres competiciones pudo brillar el Guaguas. Y es que el subcampeonato liguero obtenido, y tan valorado y en las situaciones de adversidad descritas, no bastó para estabilizar los cimientos del representativo.[/capitular]

<p>En junio, cerrado el curso 2001-02, las noticias negativas se suceden. David Rodríguez decide poner fin a su ciclo como técnico para pasar a funciones como director general, pero ese contratiempo queda minimizado cuando se anuncia que, por la grave situación económica que se atraviesa, no estaba garantizada la inscripción del equipo tanto en la Superliga como en la Copa Confederación Europea. El retraso en el cobro de las subvenciones públicas y las deudas que se mantenían con los jugadores arrojaron un escenario de inquietud que se admitió de manera pública a fin de recabar apoyos y soluciones. Un indicativo más de que la salud financiera de la entidad, además de transitar muy lejos de los balances positivos de etapas anteriores, ya era una amenaza para su porvenir.</p>

<p>La intervención del ayuntamiento de Las Palmas de Gran Canaria, a través de la concejalía de Deportes encabezada por Felipe Afonso El Jaber, resultó providencial para salvar de manera airosa esta encrucijada. La aportación municipal, con un patrocinio, permitió afrontar el primer plazo de la cuota de inscripción. Una solución eficaz pero transitoria debido a la gravedad de un problema estructural de mayor envergadura.</p>

<p>Y en un giro de tuerca más, se produce el relevo en la presidencia del Calvo Sotelo, en concreto el 8 de julio de 2002, con José Luis Cano en lugar de Mario Hugendubel, quien, cuatro años después de su entrada, cedía el mando, hastiado, como reconocía, de los discretos resultados deportivos y las cada vez más recurrentes piruetas económicas a cuenta de un déficit que iba en aumento. La apuesta por el banquillo, con David Rodríguez en los despachos, sería Ángel Alonso. Pero David Rodríguez sería despedido en diciembre de ese mismo año por discrepancias con la directiva, lo que acentuaba todavía más una precariedad integral. En unos meses, David Rodríguez regresaría, para mayor retorcimiento.</p>

<p>Tras otra temporada sin títulos y con eliminación prematura de la competición continental, en junio de 2003 se anuncia el acuerdo con la empresa constructora Jusan Canarias, que sería la denominación del equipo en adelante. El patrocinio era de cinco años y se sumaba al que ya brindaba Guaguas Municipales. "Pasamos de las penurias a poder ilusionar a todos", confesaba Cano al respecto. Es ahí cuando se produce la primera toma de contacto formal de Pedro Cuarental, que sería el siguiente en ser proclamado presidente.</p>

<p>El Jusan Canarias Las Palmas arrancó el curso 2003-04 con energías renovadas y recurriendo a viejos conocidos como Pedro Cabrera o Joel Sotelo, repescados para liderar una plantilla que completaban José Luis Martell, Fran Carballo, Juan Carlos Parada, Rayco Hernández, Semidán Déniz, Rubén Cano, Níchel Gómez, Igor Hernández y Paulo Carballo.</p>

[seccion_header color="navy"]Camino del fatídico 2009[/seccion_header]

[imagen_contenido file="10cap_tran_foto8.jpg" caption="Jusan 2009: el entrenador Chema Sánchez, durante un entrenamiento ya en los meses anteriores a la desaparición de la entidad."]

[imagen_contenido file="10cap_tran_foto2.jpg" caption="Homenaje a Joel Sotelo el 19 de septiembre de 2004, presidido por Pedro Cuarental."]

[capitular]Con David Rodríguez restituido en el cargo, el grupo humano no paró de crecer, favorecido por la progresiva puesta en escena de Pedro Cuarental quien asumió la presidencia en julio de 2004, aunque desde meses antes ejercía a los mandos tras la renuncia de Cano. En el curso 2003-04 se logra la décima posición y en la 2004-05, ya con jugadores de jerarquía como el brasileño Marcos Dreyer, el balance se resumió en una quinta plaza que daba de nuevo derecho a jugar en Europa al curso siguiente. Una evolución deportiva evidente, que dejaba atrás años más grises e invitaba a todos a soñar con grandes logros en el futuro inmediato. Tanto Cuarental como Rodríguez se prodigaron en los medios de comunicación con optimismo al respecto y tratando de volver a enganchar a una afición que no terminaba de animarse a volver al Centro Insular.[/capitular]

<p>Desafortunadamente, esa progresión no tuvo cimientos sólidos porque, ya en 2007, comienza a merodear el riesgo de que el club pudiera desaparecer. El presidente así lo advierte, sin ambigüedades, dado que se reconocía un déficit superior a los 280.000 euros con La Caja de Canarias, acreedor que, para asegurarse el cobro de lo adeudado, solicitó el embargo de todas las subvenciones públicas. «Cuando asumí la presidencia hace tres años la deuda era de 300.000 euros, y apenas hemos podido reducirla en trece mil. Sin embargo, nosotros mantenemos predisposición para un pago aplazado, que queremos negociar para diez o doce años. Llevamos más de veinte años trabajando con La Caja y aspiramos a seguir así», dijo el presidente, abierto a una solución que, no obstante, se antojaba complicada sin la intervención de las autoridades políticas.</p>

<p>De hecho, no dudó en dar libertad a los jugadores para que se buscaran destino ante la gravedad de la situación que amenazaba, igualmente, con llevarse por delante la cadena de filiales, compuesta por más de 350 niños. "Sé que las posibilidades de estar una temporada más en la élite del voleibol son mínimas, pero seguimos trabajando para intentar buscar otras condiciones con La Caja de Canarias y que nos permita hacer frente a la deuda de 300.000 euros. Con las cuentas embargadas por La Caja nos es imposible hacer frente a los compromisos inmediatos del club, su inscripción, y el aval en la Superliga y el primer pago de la deuda, unos 120.000 euros", añadía Cuarental, quien ponía como fecha límite el 22 de junio, al expirar ese día el plazo para la formalización de los pagos para la plaza en la máxima categoría, aunque, finalmente, obtuvo un aplazamiento para ese trámite que era de obligado cumplimiento.</p>

<p>Jerónimo Saavedra, por entonces alcalde de Las Palmas de Gran Canaria, recogió el guante. El 27 de junio se anunciaba que la corporación municipal capitalina otorgaría una subvención plurianual de cuatro años y sin incrementar la ayuda de los últimos ejercicios económicos para presentar una "toma de razón, que La Caja de Canarias acepta dentro de un plan de pago de la deuda".</p>

[cita_editorial author="Roque Díaz, concejal de Deportes"]La sabiduría y sensibilidad de Jerónimo Saavedra permitieron encontrar soluciones donde no las había.[/cita_editorial]

[cita_editorial author="Roque Díaz"]En mi época me tocó gestionar miseria. No teníamos medios, pero tampoco podíamos permitir que un club como el Guaguas se fuera por la borda de esa manera. Así que, como pudimos, poniendo el mayor ingenio y cariño por esos colores que tanto habían significado para la sociedad grancanaria, actuamos. Fue una satisfacción especial lograrlo en base a un acuerdo que era de justicia y no supuso alteración alguna en los dineros públicos.[/cita_editorial]

<p>Lejos de que el aval consistorial se plasmara en la deseada vuelta a la normalidad, y pese a los esfuerzos de Cuarental en esa dirección, el reloj ya estaba en cuenta atrás.</p>

[imagen_contenido file="10cap_tran_foto3.jpg" caption="Jusan 2004-05. De pie, de izquierda a derecha, David Rodríguez (entrenador), Renato, Haroldo, Dreyer, Parada, Kvasnicka, Antonio Miralles (segundo entrenador) y Manu del Valle (fisioterapeuta). Agachados, en el mismo orden, De Moura, Rayco Hernández, Lorenzo Vicente, Cárdenes, Artemi Vega y Young."]

[imagen_contenido file="10cap_tran_foto4.jpg" caption="Jusan 2006-07. De pie, de izquierda a derecha, Iker Domínguez (segundo entrenador), Johan Andersson, David Sánchez, Marcos Dreyer, Da Luz, Ignacio García y David Rodríguez (entrenador). Agachados, en el mismo orden, Rayco Hernández, Lorenzo Vicente, Alexandro Rodríguez y Miroslav Svoboda."]

[seccion_header color="navy"]El peor desenlace posible[/seccion_header]

[imagen_contenido file="10cap_tran_jusan2008.jpg" caption="Acción del Jusan Canarias en sus últimas temporadas."]

[capitular]La temporada 2007-08 se inició con el aparente paraguas que daba el respaldo municipal... Pero ya con una plantilla de circunstancias y que no iba a tardar en implosionar por los sempiternos retrasos en los pagos. El opuesto checo Kolacny, el central estadounidense Scheftic y el colocador finlandés Mikula causaron baja en las primeras semanas de competición al no ver cubiertos sus salarios. Y a finales de enero de 2008 fue el entrenador, Álvaro Bourousouzian, quien presentó su renuncia al cargo por idéntico motivo. "Tenemos un mes de retraso en el pago y, además, el plan que nos presentó la entidad contempla más problemas inmediatos, aunque, según nos dice, al final de temporada todo se pondrá al día. Unos podrán esperar y otros no, y en mi caso no", adujo. Días después, ya en febrero, la plantilla, con Samuel Díaz como entrenador, se plantó en protesta por los retrasos en el abono al club de las subvenciones prometidas, lo que ocasionaba una falta de liquidez que ahogaba a los profesionales.[/capitular]

[cita_prensa source="Paulo Carballo, jugador y portavoz de la plantilla"]La huelga es para que las instituciones que habían comprometido una subvención hagan el ingreso al club. A los jugadores nos deben dos meses de nómina, y también se debe dinero a entrenadores de la base. No sé por qué, pero parece que hay un trato diferente hacia nosotros por parte de las instituciones.[/cita_prensa]

[imagen_contenido file="10cap_tran_foto5.jpg" caption="El brasileño Marcos Dreyer, pensativo en el transcurso de un encuentro."]

<p>Cuarental cifraba en 120.000 euros lo que se adeudaba al club y apoyaba la medida de presión ejercida por la plantilla. "Tienen toda la razón", esgrimía.</p>

<p>Los fantasmas de incomparecencias en algunos encuentros fuera de casa terminaron disipándose hasta poder completar, con muchísimas apreturas y esfuerzos, el curso en su integridad, aunque la descomposición saltaba a la vista y el descenso a la Superliga Masculina 2 fue consecuencia irremediable.</p>

<p>El 19 de agosto de 2008 se hacía oficial el nombramiento de Samuel Díaz como presidente del Jusan Canarias tras la renuncia de Pedro Cuarental luego de cuatro años de mandato. "Estoy contento con el cargo y con ganas de trabajar para que el club salga adelante. Llevo cinco años en el Jusan y en diferentes cargos, desde entrenador de la base hasta técnico del primer equipo. Nuestro trabajo está encaminado a seguir la misma línea de coherencia que mi antecesor en el cargo. Pedro Cuarental hizo un buen trabajo durante los cuatro años que dirigió el club. Metió al equipo en competiciones europeas después de mucho tiempo sin disputarlas. La política económica será de austeridad y nos ajustaremos al presupuesto que tenemos establecido. En lo deportivo queremos reforzar la relación con los equipos de base de la capital y profundizar en el trabajo de cantera que hemos iniciado hace algunos meses", indicaba el nuevo regente como esperanzadora declaración de intenciones. Díaz ya llevaba al mando de la entidad varias semanas y, de hecho, fue él quien pilotó la inscripción federativa del Calvo Sotelo, el 19 de junio de 2008, para competir en la campaña 2008-09 en la Superliga gracias a la cesión de los derechos deportivos del Universidad de Granada.</p>

<p>Díaz puso al frente de la plantilla a Chema Sánchez, quien inició la que iba a ser la última campaña antes de la desaparición del club con Aarón de la Cruz, Yeray Peña, Sergi Martín, Vicente Gutiérrez, Aday González, Lorenzo Vicente, Leandro Pires, Wilson Pires, Máximo Torcello, Tibo Filo y Eury Almonte como efectivos sobre la pista.</p>

<p>La temporada se planteó como un reto de supervivencia dadas las condiciones de precariedad. David Rodríguez aceptó volver a integrarse en la estructura de la entidad "para ayudar en lo que hicera falta". Pero más que milagro, lo que se constató fue el final fatal que ya se venía tejiendo desde hacía varios años.</p>

<p>El 14 de marzo de 2009, tras una derrota en Teruel (3-0), se consumó el descenso a la Superliga 2 del Jusan Canarias y se descartaba de plano la opción, ya utilizada meses atrás, de comprar una plaza en la máxima categoría. "No vamos a jugar en la Superliga, hay que ser realistas y no hipotecar el club. Si no hay nivel para jugar arriba estaremos en la Superliga 2 y seguiremos trabajando para formar un conjunto en condiciones para recuperar la categoría, donde el papel de la cantera debe ser importante", aseguraba el presidente, quien encabezaría, el 29 de abril de ese año, un acto institucional de entrega de insignias de oro y brillantes a varias personalidades de la historia del club, con David Rodríguez entre los elegidos. Sería una de las últimas apariciones públicas de Samuel Díaz como presidente del Calvo Sotelo, cargo del que dimitiría el 2 de junio.</p>

[cita_editorial author="David Rodríguez"]Con todo el dolor de mi corazón no me quedó otro remedio que gestionar todo el papeleo para liquidar la entidad, ya que se mantenían deudas significativas que podían tener consecuencias legales si no se procedía a la desaparición formal del Calvo Sotelo como club deportivo de voleibol.[/cita_editorial]

[seccion_header color="navy"]La cronología[/seccion_header]

<div class="timeline-container">
<div class="timeline-event"><span class="timeline-year">2000</span><div class="timeline-content">El Guaguas queda fuera de competiciones europeas después de trece años consecutivos estando presente en los distintos torneos continentales.</div></div>
<div class="timeline-event"><span class="timeline-year">2001</span><div class="timeline-content">El 23 de octubre se nombra a Juan Ruiz presidente de honor en reconocimiento a su labor y legado. En diciembre se produce una huelga de la plantilla por el retraso en los cobros que termina solucionándose aunque generando un problema que ya sobrevolaría siempre en el entorno del club, pues se realizarían nuevas huelgas en años posteriores por este mismo asunto.</div></div>
<div class="timeline-event"><span class="timeline-year">2002</span><div class="timeline-content">Primera intervención del ayuntamiento de Las Palmas de Gran Canaria para evitar que el equipo se quede sin inscribirse en la Superliga para la temporada 2002-03. El 8 de julio se produce un nuevo relevo en la presidencia con la entrada de José Luis Cano por Mario Hugendubel.</div></div>
<div class="timeline-event"><span class="timeline-year">2003</span><div class="timeline-content">En junio, entra la empresa Jusan Canarias como patrocinador del club con un contrato de cinco años. Pedro Cuarental, que se convertiría en presidente pocos meses después, es quien posibilita la entrada de este nuevo mecenas.</div></div>
<div class="timeline-event"><span class="timeline-year">2004</span><div class="timeline-content">Pedro Cuarental asume la presidencia del club.</div></div>
<div class="timeline-event"><span class="timeline-year">2005</span><div class="timeline-content">Bajo la dirección técnica de David Rodríguez, el equipo termina la campaña 2004-05 en una meritoria quinta plaza que da derecho a volver a jugar competición europea.</div></div>
<div class="timeline-event"><span class="timeline-year">2007</span><div class="timeline-content">Otra maniobra salvadora del ayuntamiento capitalino para evitar que, por un embargo de La Caja de Canarias, la entidad no ingrese dinero por las subvenciones y pueda afrontar su inscripción federativa.</div></div>
<div class="timeline-event"><span class="timeline-year">2008</span><div class="timeline-content">Descenso a la Superliga 2, tras la marcha a mitad de campaña de varios jugadores y del entrenador por las demoras en los cobros, aunque Samuel Díaz, que sería proclamado oficialmente presidente en agosto de ese año, logra la cesión de los derechos del Universidad de Granada para continuar compitiendo en la máxima categoría.</div></div>
<div class="timeline-event"><span class="timeline-year">2009</span><div class="timeline-content">Nuevo descenso de categoría, renuncia de Samuel Díaz a la presidencia y liquidación de la entidad después de que la junta gestora encabezada por David Rodríguez no inscribiera al equipo para la siguiente temporada por las deudas existentes y que hacían inviable el proyecto.</div></div>
</div>
'),
    array('title' => 'David Rodríguez', 'numero' => '', 'order' => 91, 'show_marker' => false, 'parent_ref' => 'cap10',
        'hero' => array(
            'image' => libro_img('10cap_davrod_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('DAVID', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('RODRÍGUEZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Jugador, preparador físico, coordinador de cantera, segundo entrenador, técnico y presidente. David Rodríguez (Las Palmas de Gran Canaria, 1968) ha dedicado 25 años al Calvo Sotelo en todos los cargos posibles dentro y fuera de la pista, lo que le convierte en un caso único y de obligada referencia en el repaso vital de una entidad que considera "parte fundamental de su vida", dado el largo recorrido que tuvo en la misma así como la disparidad de momentos que, según la época, le tocó vivir en carne propia. "Jugué en un equipo irrepetible, allí me hice hombre, tuve compañeros maravillosos, disfruté en la pista, gané títulos, sentí el cariño de una afición increíble, y adquirí un prestigio como entrenador que me terminó llevando nada más y nada menos que a la selección española. A nivel deportivo, todo fue lo máximo. Pero, por desgracia, a mi vuelta al club, desde la temporada 2000-01, la situación pasó de mala a insostenible, en nada parecido a lo que me tocó vivir anteriormente, hasta el punto de que terminé asumiendo la presidencia para firmar la liquidación del club por la deuda que se tenía y sin solución alguna a la vista. Fue algo que me dolió en el alma pero que tuve que hacer en un gesto de responsabilidad", aclara.[/capitular]

<p>Educado en el Claret ("y en la primera promoción en la que entrenaban juntos chicos y chicas"), muy pronto sintió David la llamada del voleibol ("como era el más grande, jugaba de central") y, entre entrenamientos en la cancha descubierta de Las Alcaravaneras ("un compañero mío jugaba en el Calvo Sotelo B y me animó a que me ejercitara con ellos") y su perfecta integración a ese grupo para perfeccionar sus habilidades, un día recibió la llamada de Felipe Nuez, incansable captador de talentos y que le invitó a que formara parte del club. Era el inicio de su historia defendiendo una camiseta que lleva "en el corazón".</p>

[cita_editorial author="David Rodríguez"]Ni me planteaba ser profesional, llegar a la élite... Para nada. Quería divertirme. Pero cuando me quise dar cuenta ya estaba jugando con Camarero, Jorge Ramón, Juanma Martín o Martinovic en la primera campaña en la División de Honor. Yo tenía 17 años y verme en ese vestuario era, sencillamente, una pasada. Un sueño impensable.[/cita_editorial]

<p>Su vinculación fue tan pronunciada con el Calvo Sotelo que, en su segundo año en la plantilla, Gustavo Rodríguez, su padre, farmacéutico de profesión, decide poner dinero de su bolsillo para financiar dos viajes que, con la situación económica del momento, no se podían sufragar. Un gesto que valora al enfatizar que "fue con el único ánimo de echar una mano en un momento muy crítico y en el que se corría el riesgo de ser descalificados" por incomparecencia. "Se puso al frente de una junta gestora de emergencia y luego continuó como vicepresidente con Juan Ruiz. Aportó su granito de arena cuando nadie quería hacerlo", pondera.</p>

<p>El crecimiento imparable de las potencialidades del equipo lo sitúa en la llegada, al unísono, de Paco Sánchez Jover, Antonio Miralles y Venancio Costa en 1987, a su juicio, "un salto de calidad definitivo" y que puso los cimientos de todos los éxitos posteriores. "Recuerdo el tercer puesto en la Copa del Rey en Palma, ganando la final de consolación al Cisneros, que ya era algo que pocos pensaban. O el título que se nos escapó en casa frente al Palma y que, pese a todo, la afición se quedó animando una vez acabado el partido. Te dabas cuenta de que algo grande venía en camino. Pero traer a Paco ya era el fichaje de los fichajes, un mensaje al resto. Inevitable que comenzaran a caer los títulos. La primera Copa, la Liga ante el Bomberos...".</p>

<p>Quiere tener un recuerdo especial con un jugador foráneo al que no le acompañó la suerte, al caer lesionado nada más llegar y no poder desplegar su juego: el sueco Lars Nilsson, fichado en 1991. Y lo razona: "Teníamos un grupo de nacionales top y, de fuera, llegaron Martinovic, Chava, Golec, Klos, Sharma, Nalazek... Un nivel brutal en los entrenamientos, muchas veces superior al de los partidos. Pero Nilsson nos enseñó a serenarnos, a encontrar el punto exacto de equilibrio, a medir bien los tiempos. Lo valoré mucho en su momento porque, repito, ese Guaguas era una fuerza de la naturaleza, por talento y empuje, y, a veces, convenía esa pausa que beneficiaba la competitividad".</p>

[cita_editorial author="David Rodríguez"]La primera Copa, que era el título que inauguraba nuestro palmarés, fue lo nunca visto. Antes, durante y después del partido. Luego vinieron más Copas, las Ligas, jugar por Europa, ser los mejores... Pero la primera vez queda para siempre y la realzo. Fue el cimiento de una etapa impresionante. ¿El dinero? Eran fichas para escapar. No te ibas a hacer rico jugando en el Guaguas. Ni siquiera los extranjeros, que eran los mejor pagados. Pero, en mi caso, ni eso me importaba. Ya era un privilegio estar ahí.[/cita_editorial]

<p>El rol de los canarios, de los jugadores de la casa en esa pléyade de estrellas, es descrito así por uno de los representantes de la escuela isleña: "Camarero tenía una clase tremenda y lo catalogo dentro de los mejores de la plantilla y del país. Los chicos de la casa sabíamos que no podíamos fallar cuando nos daban minutos. Golec e Ire (Klos) te ponían el listón en las nubes. Entrabas y la presión de no equivocarte te empujaba. Creo que, dentro de un Guaguas insuperable, los canteranos dimos lo que teníamos que dar".</p>

<p>Sin descuidar sus estudios, cursando la carrera de Educación Física mientras jugaba, y también obteniendo el nivel 2 de entrenador, que le capacitaba para dirigir en categoría regional (el nivel 1 lo sacaría en 1995), sin saberlo, David Rodríguez ya encaminaba sus pasos al banquillo. "Felipe Nuez fue quien me metió esa motivación, fue un gran ejemplo para mí siempre. Y eso me vino muy bien porque en 1992, con Quique Edelstein como técnico, sentí que había llegado el momento de dejarlo, pese a tener 27 años. Fueron circunstancias concretas: falta de protagonismo, cierta incomodidad por algunas decisiones que adoptó y que, dentro del respeto que me merecían, no eran compartidas... Era joven, me llamaron del Gáldar, pero estaba decidido a irme y dedicarme a mi titulación académica hasta que Juan Ruiz me ofreció llevar la estructura de filiales. Por así decirlo, éramos un gigante con pies de barro, sin una base, todo centrado en el equipo sénior. Y me ilusionó. Formamos un regional, un juvenil, un cadete y un infantil. Y, al mismo tiempo, era segundo entrenador y preparador físico con Juanma Martín".</p>

<p>"Al final tuve que fijar mi atención y fuerzas en el equipo profesional, que te exigía todo. Seguían llegando los títulos, se mantenía la excelencia de las temporadas anteriores. Y cuando Juanma regresa a las canchas y Sánchez Jover asume el mando, me mantengo con él. Fueron años, hasta 1998, en los que aprendí muchísimo. A Paco lo considero un maestro. Me hizo crecer y ver el voleibol de una manera única. Por algo fue un jugador de leyenda y un entrenador como pocos por su inteligencia y manera de dirigir", agrega.</p>

<p>En 1997 recibe una llamada del dirigente Luis Buchaga que le cambia la vida: ser técnico asistente y preparador físico de la selección española, ciclo que dura hasta el 2000 ("una experiencia única"), cuando el presidente Mario Hugendubel le propone sustituir a Benjamín Vicedo como entrenador del Guaguas. Sería su primera vez con máximo rango en la banda del equipo de su vida: "No nos fue nada mal esa primera temporada 2001-02. Quedamos subcampeones de Liga, con gente de la casa y el refuerzo de los checos, y en Europa también hicimos un papel muy digno".</p>

[cita_editorial author="David Rodríguez"]2001-2002 ya fue un curso duro. Recuerdo pagar de mi bolsillo hoteles para que durmiera el equipo en algunos desplazamientos porque en el club ya comenzaban los apuros. Me retiro del banquillo para poder preparar un plan de viabilidad y fichamos como técnico a Ángel Alonso, que tampoco funciona. Regreso al banquillo, jugamos los play-off... Pero ya todo va de mal en peor. En la campaña 2002-2003 ya competimos solo con canarios más Joel Sotelo, que regresó para ayudarnos con su experiencia. Pero se mantuvo la caída en picado hasta que en 2007 la pelota se nos hizo más grande que el club, nos sobrepasó la situación.[/cita_editorial]

<p>Renuncié, se fue Pedro Cuarental, entró otro presidente... Y en 2009 se organiza un acto de homenaje en el que me dan la insignia de oro y brillantes, con la colaboración del Cabildo, con Óscar Hernández como consejero, y el ayuntamiento de Las Palmas de Gran Canaria, siendo concejal de Deportes Roque Díaz. También estuvo presente don José Millán. Fue en el Centro Insular y antecedió a la firma de la liquidación porque la deuda con La Caja de Canarias era inasumible. Recuerdo que el periodista Isidro Quintana me preguntó que si aquello escenificaba el acto de defunción de la entidad. Era la única manera de dejar el club a cero, por decirlo de alguna manera, y aunque fuese algo muy doloroso. Desde 2006 el lastre no había hecho más que crecer y crecer. Tuve que firmar como presidente. Fue un rato durísimo que no se lo deseo a nadie", zanja conmovido.</p>

<p>El renacer de la entidad con el regreso de viejos conocidos de su primera etapa como Camarero, Juan Ruiz, Felipe Nuez o Sánchez Jover le parece "una magnífica noticia" y más por la ilusión que están generando con sus títulos y nueva trayectoria exitosa.</p>
'),
    array('title' => 'Joel Sotelo', 'numero' => '', 'order' => 92, 'show_marker' => false, 'parent_ref' => 'cap10',
        'hero' => array(
            'image' => libro_img('10cap_joelsot_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'bottom center',
            'title_lines' => array(libro_hero_line('JOEL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('SOTELO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Cuatro temporadas como jugador (1995-1998 y 2003-2004), otra como entrenador de la cantera, tres títulos oficiales (2 Copas del Rey y 1 Supercopa de España) y el reconocimiento y afecto unánime del Centro Insular, que siempre rindió pleitesía a un jugador que adoptó como propio desde que llegó y en el que reconoció tanto sus virtudes técnicas como valores humanos. La figura de Joel Sotelo (Ciudad de México, 1970) sigue intacta y vigente cuando toca repasar la nómina de grandes extranjeros que han pasado por el Guaguas. Y él corresponde a semejante estatus con su pasión característica: "Fue el sueño de mi vida, el equipo en el que me consagré, el ciclo que guardo dentro de mi corazón como algo privilegiado, como lo mejor que puedo contar cuando hablo a mi familia y amigos del voleibol". En un palmarés como el suyo, plagado de laureles en el vóley playa, con participaciones en circuitos nacionales y mundiales, más el corolario de los Juegos Olímpicos de Sídney 2000, no resulta gratuita esta jerarquización tan rotunda.[/capitular]

[cita_editorial author="Joel Sotelo"]Llegué al Guaguas después de varios años en España y cuando en el Cisneros había alcanzado mi máximo nivel. Ese verano, el de 1995, me proclamé, junto a Camarero, campeón de España de vóley-playa y él fue quien habló con Juan Ruiz al intuir que un jugador de mis características podía venirle bien al Guaguas. Cuando Juan me llamó, ni me lo pensé. Era llegar al que, en mi opinión, era el mejor club de España. Y al fichar me encuentro con los Klos, Golec, Miralles, Rueda, Camarero, Sharma y un entrenador como Paco Sánchez Jover. Un impacto. Impresionante.[/cita_editorial]

<p>Desde sus inicios "todo funciona a las mil maravillas", pues se conjunta con la base a la que se suma y aporta al Guaguas "riqueza táctica", al jugar "como central, receptor y opuesto", dada su facilidad para reciclarse en los planes del técnico. "Lo que quería era ser útil, jugar, disfrutar. Por encima de todo, mi gran capacidad de trabajo era la tarjeta de presentación que ponía por delante de todo. Con una humildad tremenda. Eso creo que me permitió ser un jugador de rendimiento y prestaciones. Así me lo hicieron ver siempre. Me entregaba al máximo y sabía asumir la presión en las distintas tareas que me encomendaban".</p>

[cita_editorial author="Joel Sotelo"]La final de 1996 ante el Soria fue tremenda y, además de llevarnos el trofeo, salí elegido como MVP. Ha sido uno de los días más felices de mi vida. Me sentí pleno y completo. Salir campeón con los compañeros y tener, además, esa satisfacción añadida de que te distingan como el mejor cuando en la pista había figuras de una categoría enorme.[/cita_editorial]

<p>"Si ya estaba en el Guaguas a tope y en cuerpo y alma, ese primer título terminó de darme más moral y cuerda para las dos campañas siguientes. Falasca, Robles, Costa... Seguía creciendo la competencia y yo mantenía mis buenas sensaciones. Nos quedó la lástima de no ganar alguna Liga en esa fase porque creo que debió de ser nuestra. También fue dolorosa aquella Final Four de la Recopa en Cuneo y después de aquella clasificación espectacular ganando 3-0 al Lennick con la afición de diez. Esperábamos rematarlo con el título europeo y no fue posible. Pero no puedo poner un reparo a esa etapa. Fui feliz, fuimos felices. Disfrutamos. Un lujo", considera.</p>

<p>No imaginaba entonces que cinco años después regresaría por una llamada de su amigo David Rodríguez, entonces entrenador del denominado Jusan Canarias: "Había hecho dos años muy buenos en el Arona y no pude negarme. Pedro Cuarental, al que le estoy muy agradecido por su comportamiento conmigo, me habló de construir, de que aportara mi experiencia a los jóvenes, de que ayudara con todo mi saber del deporte. Me pareció una propuesta insuperable y, lo admito, desde el punto de vista afectivo me cautivó".</p>

[cita_editorial author="Joel Sotelo"]Fue un año diferente a los anteriores porque el equipo no tenía la pretensión de ganar títulos. Quedamos en una meritoria séptima plaza y me quedó el mal sabor de boca de que una lesión en el gemelo se me complicó y, lo que nunca me había pasado, estuve mucho tiempo fuera sin poder jugar. Era como un león enjaulado. David me tuvo que parar los pies porque quería entrar aunque estuviese cojo. Me comían las ganas. Era insoportable no poder ayudar a mis compañeros.[/cita_editorial]

<p>El club le propuso seguir integrado en su organigrama de cantera como entrenador y le agradeció, con un emotivo acto en el Centro Insular y la entrega de una placa, su ejemplo profesional en sus años de pertenencia a la entidad.</p>

[cita_editorial author="Joel Sotelo"]Pasé más de 20 años en Canarias y dos de mis tres hijas nacieron en Gran Canaria. Salí campeón con el Guaguas. El Centro Insular fue el escenario de mis sueños, con Sergio Miguel Camarero tengo una relación familiar de todo lo que hemos compartido, a Juan Ruiz lo tengo como una de las personas más importantes de mi vida por darme la oportunidad de jugar en ese equipo maravilloso. No hay un día en el que no me salga a la mente un recuerdo del Guaguas y de esa etapa tan fantástica.[/cita_editorial]
'),
    array('title' => 'Pedro Cuarental', 'numero' => '', 'order' => 93, 'show_marker' => false, 'parent_ref' => 'cap10',
        'hero' => array(
            'image' => libro_img('10cap_pedrocua_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('PEDRO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('CUARENTAL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Le tocó gestionar en una coyuntura "delicadísima", en su propio calificativo, a inicios del siglo XXI y cuando acudió, de manera voluntaria, al auxilio de un Guaguas "que no tenía dinero ni para inscribirse" ante la ausencia de patrocinios. Corría 2003 y Pedro Cuarental (Las Palmas de Gran Canaria, 1975), en tiempos jugador de la casa en categorías inferiores ("milité en cadete y juvenil y siempre mantuve mi afición por el voleibol"), fue alertado por parte de un amigo ("Rayco Hernández", precisa) de que el riesgo de desaparición era casi una realidad. "Era el director comercial de Jusan, una empresa constructora, y propuse que nos convirtiéramos en patrocinador principal. José Luis Cano era el presidente cuando entramos y ya me proponen a mí asumir el control porque el mandatario que estaba no tenía ganas de continuar. Al principio estuve al frente de una junta gestora y, luego ya, de pleno derecho en el cargo más alto".[/capitular]

<p>De ejercer de salvavidas "sin propósito alguno de entrar ni en la directiva", Cuarental termina encabezando un club "con un grave desajuste económico" por la póliza de crédito suscrita con La Caja de Canarias y que acaba absorbiendo "el cien por cien de los ingresos", lo que ahogaba la economía y hacía inviable cualquier intento de normalización en la vida financiera del club.</p>

[cita_editorial author="Pedro Cuarental"]Desde el inicio me propuse reducir la deuda contraída y se hizo una labor muy importante en cuanto a la captación de patrocinadores privados. Eso nos permitió tener cierto margen, cumplir con las nóminas de los jugadores de manera regular, con algún retraso lógico, pero siendo todos los profesionales conscientes de la situación. Hay que recordar que una buena parte de nuestro presupuesto se iba directo a cubrir la póliza y era un condicionante enorme. La deuda era de unos 300.000 euros y, con todo, la reducción de la misma no fue significativa por los intereses generados. Pero lo fuimos salvando y creo que logramos mantener una competitividad impensable para los dineros que manejábamos, con una política de fichajes muy austera pero certera. No podíamos equivocarnos. No había margen para ello. Pongo en valor el trabajo de David Rodríguez y de Antonio Miralles, además del de las diferentes plantillas por su comprensión y paciencia.[/cita_editorial]

<p>En este sentido, destaca como hitos deportivos en esa transición marcada por las estrecheces económicas, terminar una campaña "invictos en casa y terceros del campeonato" así como participar en competiciones europeas. "No me cansaré de resaltar el valor que tuvo mantenerse en pie y con esa dignidad durante años en los que atravesamos un desierto. Había días en los que se hacía muy complicado todo. Nunca pensé que la entidad fuese a desaparecer. Directamente es que ni tenía tiempo en ponerme en lo peor porque cada día había que solventar muchos problemas. Y siempre, cada campaña, pendiente de que llegara febrero, cuando se ejecutaban las subvenciones públicas, que cabe recordar que siempre llegan tarde, para ganar oxígeno y tiempo", añade.</p>

<p>Una llamada tan inesperada como providencial termina procurándole la solución en junio de 2007, cuando se anuncia que el ayuntamiento de Las Palmas de Gran Canaria, a través del Instituto Municipal de Deportes, con Roque Díaz al frente, otorgaba una ayuda plurianual que, dentro de un plan de pagos, La Caja aceptaba como "una toma de razón".</p>

[cita_editorial author="Pedro Cuarental"]Tuve que hacer un llamamiento público de auxilio y Roque Díaz me llamó, me citó en su despacho y encontró la vía para desenredar toda la maraña que nos asfixiaba. Fue un acuerdo muy ventajoso y que, además, era el único posible para que la Obra Social de La Caja tuviera un menor impacto en nuestra economía. Porque en nuestros balances había superávit pero, siempre, con esta póliza, los números se descuadraban. Fue un respiro.[/cita_editorial]

<p>Cuarental se mantuvo en el cargo hasta el verano de 2008 y durante esa última campaña tuvo que lidiar ante numerosas incidencias que terminaron dinamitando la estabilidad interna como la dimisión, nada más comenzar la campaña de David Rodríguez, la posterior de Álvaro Bourousouzian, su sustituto en el banquillo tras apenas cuatro meses en el cargo o una huelga de jugadores, en febrero de 2008, que él mismo apoyó al entender sus reivindicaciones en materia de cobros pendientes.</p>

<p>Más de cuatro años en la presidencia en los que puso "el mayor esmero posible en ordenar la vida económica" de un Calvo Sotelo que terminaría desapareciendo meses después pese a que se hizo oficial su relevo en la cúpula en favor de Samuel Díaz, que había ejercido anteriormente como entrenador.</p>
'),
    array('title' => 'Marcos Dreyer', 'numero' => '', 'order' => 94, 'show_marker' => false, 'parent_ref' => 'cap10',
        'hero' => array(
            'image' => libro_img('10cap_marcosdre_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('MARCOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('DREYER', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Tres años, los que van de mayo de 2004 al mismo mes de 2007, duró la estancia del brasileño Marcos Dreyer (Teresópolis, 1971) en la etapa en la que el equipo se denominó Jusán Canarias. Pero por implicación, rendimiento y compromiso es resaltado como una figura capital en el proceso de transición que se vivió en aquella época. Tanto David Rodríguez, que fue su entrenador, como Pedro Cuarental, entonces presidente, le señalan como el líder del vestuario y distinguido siempre "por velar por el club y mantener el equilibrio en momentos en los que eso era muy complicado". Nadie dudó en cuestionar su rol de capitán y dejó honda huella por su manera de entender el deporte, basada siempre "en la honestidad, sacrificio y máxima profesionalidad", tal y como él mismo describe.[/capitular]

<p>Dreyer llegó procedente del Elche, donde había ganado una Copa del Rey, y dibujaba, antes, una amplia trayectoria internacional, bagaje que puso "al servicio" de los compañeros con el fin de "tratar de hacer las cosas lo mejor posible". Tenía muy claro que el camino a seguir pasaba "por ser exigentes día a día, en cada entrenamiento y en cada partido" y su afán radicó en ese perfeccionismo que nunca rebajó.</p>

[cita_editorial author="Marcos Dreyer"]Vine a Gran Canaria siendo un veterano y empujado, además, por la idea de formar una familia con mi mujer, que también jugaba al vóley. Fue un proyecto para mí en el que se mezclaba lo profesional y lo personal, por lo que me lo tomé con toda la intensidad del mundo. Encontré un grupo sano y joven en el que pude ayudar desde mis vivencias, siempre con la mejor voluntad. Me impliqué incluso en los fichajes, ayudando a traer a compañeros que conocía y a los que convencí para que se unieran al Jusan, como Renato Adornelas. Todo lo que hiciera me parecía poco para el bien de la institución. Me tomé con naturalidad ese liderazgo porque siempre ha sido así durante mi carrera. No supuso esfuerzo alguno por mi parte porque es algo que llevo dentro, que desarrollo allá donde estoy.[/cita_editorial]

<p>Referente dentro y fuera de la pista, su intermediación cuando los pagos a los profesionales se dilataban también reunió un valor trascendental porque a ese ámbito llegó igualmente su influencia, recomendando en el vestuario "paciencia y confianza" en los esfuerzos que hacía la directiva. Él predicó con el ejemplo renovando en 2005 pese a que disponía de ofertas que le eran más ventajosas desde el punto de vista económico. "No dudé en quedarme porque sentía que era necesario aquí y que debía seguir. No me lo pensé. Era lo adecuado", confiesa.</p>

[cita_editorial author="Marcos Dreyer"]Ningún jugador profesional vive al día de su sueldo. Por supuesto que juegas para ganar dinero, pero cuando ves que en el club hacen todo lo que pueden y tienen problemas, debes ayudar, colaborar, ser receptivo. Y eso es lo que hablaba yo con los chicos. Todos apoyaron y creo que colaboramos en hacer más llevadera alguna etapa en la que las dificultades económicas fueron más importantes. Era fundamental que nos mantuviésemos unidos, que el grupo no se rompiera, que se aguantara en lo posible. Creo que lo conseguimos.[/cita_editorial]

<p>Y ese espíritu gremial permitió al Jusan que el lideró "superar las expectativas" y ofrecer un tono competitivo "mucho mejor del que se podía esperar", superando, por ejemplo, a un Tenerife "con mejor presupuesto y medios" que los que se disponían en la entidad grancanaria.</p>

[cita_editorial author="Marcos Dreyer"]Hicimos las cosas bien en España y en Europa. Recuerdo un partido en Turquía ante el Halbank como uno de los mejores que completé. Pienso que defendimos bien el honor de un club que lo había sido todo en el voleibol y que, durante esos años, tuvo que asumir otra realidad y con menos posibilidades. Pero tuvimos nuestro orgullo y, por mi manera de entender el deporte, de vivir el voleibol, quise siempre transmitir a los compañeros que teníamos que tirar para adelante como fuera. Fue un orgullo comprobar que, ganáramos o perdiéramos, siempre dábamos todo. Por mi parte, nada me dejé dentro. Puse lo que tenía como jugador y como persona para el club y estoy muy agradecido a la gente que confió en mí, tanto David Rodríguez como Pedro Cuarental, además de los jugadores con los que tuve el honor de formar el equipo.[/cita_editorial]

<p>En una etapa profesional posterior, ya en el Vecindario, coincidió con una de las leyendas del mejor Guaguas, Paco Sánchez Jover, circunstancia que considera "un privilegio" al tiempo que le permite sacar una reflexión explícita: "Siempre me consideré un monstruo competitivo por querer ganar, entrenar y jugar más y mejor cada día. Pero Paco, para mí, es un dinosaurio competitivo. Su manera de interpretar y conocer el vóley es algo que me produce admiración. Cuando le conocí comprendí que hay gente que siempre estará muy por encima de ti y Paco es uno de ellos".</p>

[imagen_contenido file="10cap_tran_petergallis.jpg" caption="Peter Gallis, uno de los históricos del Guaguas en el tránsito del siglo XX al XXI."]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 11: 25 TÍTULOS PARA UNA GRAN HISTORIA
    // ═══════════════════════════════════════════════
    array(
        'title' => '25 Títulos para una gran historia',
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
            'height' => '600px',
            'title_lines' => array(libro_hero_line('25 TÍTULOS PARA', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('UNA GRAN', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('HISTORIA', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]El palmarés del CV Guaguas es el más brillante del voleibol español. Nueve Ligas, nueve Copas del Rey, cinco Supercopas y una Copa Ibérica conforman un historial de éxitos que ningún otro club del país ha igualado.[/capitular]
'),
    array('title' => 'Copa del Rey 1989', 'numero' => '1', 'order' => 101, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="1" foto="11cap_tro2_foto1.webp" nombre="COPA DEL REY" anio="1989"]
[ficha_tecnica]
[equipo numero="3" nombre="GUAGUAS LAS PALMAS"]Chava, Willock, Paco Sánchez Jover, Miralles, Venancio Costa y Camarero. También jugó Juanma Martín. <strong>Entrenador:</strong> Sergio Hernández.[/equipo]
[equipo numero="1" nombre="C. V. PALMA"]Fernández, Saxton, Jiménez, Vicedo, Martín Lobo y Ernesto. También jugaron Ortiz, Luiso y Calvo. <strong>Entrenador:</strong> Jaime Fernández Barros.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-10, 11-15, 15-5 y 15-8</p>
<p><strong>Árbitros:</strong> Jiménez Callejón (Almería) y Antonio Morales (Gijón). Amonestaron a Camarero por los locales y a Martín y Saxton por los visitantes.</p>
<p><strong>Incidencias:</strong> Más de 5.000 espectadores en el Centro Insular de Deportes con pleno de autoridades políticas y deportivas en el palco y encabezadas por el presidente del Gobierno de Canarias, Lorenzo Olarte, que fue el encargado de entregar el trofeo de campeón a Paco Sánchez Jover como capitán del Guaguas. Carmelo Artiles, presidente del Cabildo de Gran Canaria, José Vicente de León, alcalde de Las Palmas de Gran Canaria, y Miguel Ángel Quintana, presidente de la Federación Española de Voleibol, fueron otras personalidades ilustres presentes.</p>
[/ficha_tecnica]
[narrativa]La Copa del Rey conquistada el 9 de abril de 1989 inauguró el palmarés del Guaguas y, por extensión, el del voleibol canario. Una importancia histórica redoblada y de la que fueron testigos directos los más de 5.000 espectadores que abarrotaron hasta la bandera el Centro Insular de Deportes inaugurado meses antes, además de todos los que lo siguieron en directo por la segunda cadena de Televisión Española. El rival, el Palma, no traía buenos recuerdos porque, apenas una semana antes, le había arrebatado la Liga a los jugadores entonces dirigidos por Sergio Hernández. El deseo de revancha no escondía, sin embargo, el favoritismo que colgaba sobre el conjunto balear pese a su condición de visitante. El partido respondió a las expectativas ya que aunó emoción y un altísimo nivel por parte de los contendientes. En las crónicas se destaca el papel coral de todo el Guaguas, motivadísimo para no fallar ante su afición, aunque dos fueron los nombres propios que emergieron sobre el resto, los integrantes de la pareja extranjera, el mexicano Chava González, que dio el punto del triunfo final con un saque desde el fondo, y el canadiense Brad Willock, magistral en la dirección que ejerció sobre el resto. La invasión espontánea de la pista y la felicidad desatada, que obligó a los jugadores a salir de los vestuarios a saludar ante la insistencia de los incondicionales, condimentaron un día grande, el primero de todos los que quedaban por venir al abrir el ciclo exitoso.[/narrativa]
[/titulo_deportivo]
'),
    array('title' => 'Liga 1989-90', 'numero' => '2', 'order' => 102, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="2" foto="11cap_tro2_foto2.webp" nombre="LIGA" anio="1989-90"]
[ficha_tecnica]
[equipo numero="3" nombre="CONSTRUCTORA ATLÁNTICA CANARIA"]Paco Sánchez Jover, Venancio Costa, Antonio Miralles, Ireneusz Klos, Sergio Camarero y Chava González. También jugaron Juanma Martín, Jesús Sánchez Jover, David Rodríguez, Jorge Ramón y Óscar Campos. <strong>Entrenador:</strong> Paco Sánchez Jover.[/equipo]
[equipo numero="0" nombre="BOMBEROS ONCE DE BARCELONA"]Javier Rodríguez, Germán López, Antonio Alemany, Cosme Prenafeta, Rafa Pascual y Sergio Arregui. También jugó Javier Bosma. <strong>Entrenador:</strong> Vladimir Bogdevski.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-4, 15-5 y 15-9</p>
<p><strong>Árbitros:</strong> Víctor Viña y Javier Aller, del comité asturiano. Sin amonestaciones.</p>
<p><strong>Incidencias:</strong> Más de 6.000 espectadores en el Centro Insular de Deportes, lo que constituyó un récord histórico de asistencia. Lorenzo Olarte, presidente del Gobierno de Canarias, entregó la copa de campeones a Paco Sánchez Jover.</p>
[/ficha_tecnica]
[narrativa]Vino a lo grande el segundo trofeo que ingresó en las vitrinas del Guaguas, en 1990 denominada Constructora Atlántica Canaria. Nada más y nada menos que la Liga, un escenario que parecía inalcanzable poco antes y por las diferencias de presupuesto y potencial que se daban con los adversarios por el cetro nacional. Fue en el cuarto partido del play-off, con una exhibición de suficiencia demoledora frente al Bomberos de Barcelona, y que encumbró a un equipo con la omnipresente figura de Paco Sánchez Jover, que a mitad de campaña se hizo con la dirección técnica del equipo y lo condujo a la gloria cumpliendo, además, con su rol de vital importancia dentro del funcionamiento colectivo. El encuentro fue un monólogo amarillo y ratificó los buenos augurios de una plantilla conjurada y que nunca dudó en que culminaría con alegría una campaña en la que las exigencias ya eran totales y en virtud de un bloque reforzado con figuras de talla mundial como los polacos Golec o Klos. Una hora exacta duró la confrontación decisiva en la que Sánchez Jover tuvo un gesto inolvidable con la grada cuando quiso hacer coincidir en la cancha a cuatro grancanarios (David Rodríguez, Óscar Campos, Juanma Martín y Jorge Ramón) en el tramo final del choque y estando la fiesta ya montada a la luz de un marcador inapelable. El Centro Insular entró en éxtasis en el momento en el que se le brindó la copa soñada.[/narrativa]
[/titulo_deportivo]
'),
    array('title' => 'Liga 1990-91', 'numero' => '3', 'order' => 103, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="3" foto="11cap_tro2_foto3.webp" nombre="LIGA" anio="1990-91"]
[ficha_tecnica]
[equipo numero="3" nombre="CLUB VOLEIBOL GRAN CANARIA"]Waclaw Golec, Sergio Camarero, Wlodzimierz Nalazek, Paco Sánchez Jover, Ireneusz Klos y Venancio Costa. También jugaron Juanma Martín y Antonio Miralles. <strong>Entrenador:</strong> Enrique Edelstein.[/equipo]
[equipo numero="0" nombre="ORISBA PALMA"]Benjamín Vicedo, Pompiliu Dascalu, Ramón Martín Lobo, Ernesto Rodríguez, Rafa Pascual y Bradley Willock. También jugaron Sixto Jiménez, Vladimir Shkurikin y Guillermo Calvo. <strong>Entrenador:</strong> Corneliu Oros.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-8, 15-3 y 15-3</p>
<p><strong>Árbitros:</strong> Alfonso González y Alfonso Zuazua (comité asturiano). Amonestados los entrenadores de ambos equipos.</p>
<p><strong>Incidencias:</strong> Lleno total en el Centro Insular de Deportes, con casi 6.000 espectadores. Entre las autoridades destacó la asistencia del presidente y consejero de Deportes del Cabildo, Carmelo Artiles, que entregó la copa, y José Antonio Ruiz Caballero, el alcalde y concejal de Deportes del ayuntamiento capitalino, Emilio Mayoral y Sebastián Franquis, y el delegado del Gobierno en Canarias, Anastasio Travieso.</p>
[/ficha_tecnica]
[narrativa]Revalidar el reinado nacional con un partido para el recuerdo, sacando literalmente de la pista al Palma, que se presentaba como el claro candidato, luego de haberle ganado en los tres precedentes inmediatos y disponer de un presupuesto que doblaba al de la entidad de Juan Ruiz, fue una gesta que, directamente, elevó a la excelencia al Gran Canaria, en opinión unánime protagonista de una exhibición acaso irrepetible. Los jugadores dirigidos por Edelstein sentenciaron la final en el tercer encuentro y haciendo valer el factor cancha, un Centro Insular de nuevo convertido en una caldera de emociones y que catapultó a sus ídolos. El partido no tuvo más historia que la que quiso el campeón, que no dio opción alguna al adversario y, por momentos, tal y como reflejan los parciales, bailó a un Palma desbordado y sin recursos ante el recital del anfitrión. Imposible destacar algún nombre porque el recital colectivo rozó la perfección, aunque la conexión que orquestó Camarero con las gradas, todo nervio y corazón el del emblema de la casa, fue uno de los factores determinantes en la espectacular versión de cada uno de sus compañeros, quienes demostraron de principio a fin que la hegemonía isleña no había hecho más que comenzar a lomos de un equipo de leyenda y que estaba tirando la puerta abajo para delirio de una isla entera.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 1991', 'numero' => '4', 'order' => 104, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="4" foto="11cap_tro2_foto4.webp" nombre="COPA DEL REY" anio="1991"]
[ficha_tecnica]
[equipo numero="3" nombre="CLUB VOLEIBOL GRAN CANARIA"]Waclaw Golec, Sergio Camarero, Wlodzimierz Nalazek, Paco Sánchez Jover, Ireneusz Klos y Venancio Costa. También jugaron Juanma Martín y Antonio Miralles. <strong>Entrenador:</strong> Enrique Edelstein.[/equipo]
[equipo numero="0" nombre="CONSTRUCCIONES ALCALÁ DE TENERIFE"]Héctor López, Paco Hervás, Sead Omeragic, Sandeep Sharma, Pero Stanic y Juan Carlos Robles. También jugaron Toño Jiménez y Pedro Bonache. <strong>Entrenador:</strong> Paco Hervás.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-8, 15-8 y 15-10</p>
<p><strong>Árbitros:</strong> Antonio Morales (Gijón) y González Alonso (Vigo). Amonestaron a los locales Paco Sánchez Jover y Venancio Costa y al visitante Pero Stanic.</p>
<p><strong>Incidencias:</strong> 4.500 espectadores en el Centro Insular.</p>
[/ficha_tecnica]
[narrativa]La fiesta no paró en el Gran Canaria, que poco después de haberse hecho con el título de Liga añadía un nivel más en su crecimiento imparable con la consecución de una Copa que suponía su primer doblete de la historia. En realidad nadie dudaba de que, lanzado e imparable por su exhibición en el torneo de la regularidad, los Klos, Sánchez Jover y compañía iban a seguir acaparando todos los honores, como así fue. El aliciente venía por tratarse de un derbi frente al Construcciones Alcalá Cisneros de Tenerife y en cuyas filas militaba el hindú Sandeep Sharma, un jugador muy querido en el club y que con el tiempo regresaría a la disciplina grancanaria. De nuevo con un Centro Insular engalanado para la ocasión y ya convertido en talismán, la hegemonía de Canarias se ratificó por la vía rápida, sin capacidad de respuesta del adversario y con Klos llevando el delirio a los aficionados con un saque chino que supuso el punto de partido. Antes, el internacional polaco, junto a sus compatriotas Nalazek y Golec, desarboló por completo a un Cisneros siempre por debajo del flamante ya bicampeón de Liga y de Copa, insaciable a la hora de ampliar sus vitrinas y cuyo idilio con la grada se fortificaba a base de gestas y partidos que entrarían en la hemeroteca por su resonancia única y valor especial.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 1991-92', 'numero' => '5', 'order' => 105, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="5" foto="11cap_tro2_foto5.webp" nombre="LIGA" anio="1991-92"]
[ficha_tecnica]
[equipo numero="3" nombre="CALVO SOTELO GRAN CANARIA"]Sergio Camarero, Paco Sánchez Jover, Waclaw Golec, Antonio Miralles, Lars Nilsson y Juanma Martín. También jugaron Jorge Ramón, Javi Dios, Sandeep Sharma y Emilio Agustí. <strong>Entrenador:</strong> Enrique Edelstein.[/equipo]
[equipo numero="1" nombre="ANDORRA"]Adrián Garrido, Genido da Silva, Pascual Saurín, Angel Ortiz, Antonio Alemany y Leonardo Wiernes. También jugaron Javier Bosma, Cosme Prenafeta y Sergio Arregui. <strong>Entrenador:</strong> Luis Hillaire.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 14-16, 15-11, 15-8 y 15-7</p>
<p><strong>Árbitros:</strong> Francisco Manuel Fraile y José Fernández (comité andaluz). Amonestaron a los técnicos de ambos equipos, al local Juanma Martín y al visitante Genido da Silva.</p>
<p><strong>Incidencias:</strong> El Centro Insular de Deportes registró la mayor entrada de la temporada, unos 5.000 espectadores, en el último partido del play-off final al título de la Liga de la División de Honor masculina de voleibol. El presidente del Cabildo Insular de Gran Canaria, Pedro Lezcano, entregó al capitán Juanma Martín la copa de campeón de Liga ACEVOL.</p>
[/ficha_tecnica]
[narrativa]Tercer título consecutivo de Liga, que se dice pronto y que venía a ampliar la marcha triunfal de un Calvo Sotelo ya en la cima y convertido en el enemigo a batir por todos. Esta vez le tocó al Andorra doblar la rodilla en el que era el último partido del play-off y que requirió la capacidad de reacción de los jugadores de Edelstein, por debajo tras ceder el primer set y artífices de una remontada que tuvo justa recompensa. En paralelismo con los anteriores, este campeonato se fraguó en la interacción mágica con un Centro Insular de nuevo escenario de una tarde llena de emociones y con el desenlace esperado. Todos y cada uno de los protagonistas pusieron en valor el papel protagonista de la gente, animosa a más no poder en los primeros compases críticos, cuando el Gran Canaria desaprovechó hasta tres balones de set y perdió el primer juego, y cimentando la posterior exhibición de fuerza sincronizada y técnica para volver a llenar de orgullo y alegría a los presentes. Un &lsquo;penalti&rsquo; de Golec fue el punto que cerró una final ganada a pulso y que situaba a la entidad en otra dimensión por la complejidad, hecha realidad, de establecer una hegemonía clara e indiscutible. En apenas siete años entre los grandes, ya sumaba casi la mitad de entorchados y al calor de un pabellón inexpugnable.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 1992', 'numero' => '6', 'order' => 106, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="6" foto="11cap_tro2_foto6.webp" nombre="COPA DEL REY" anio="1992"]
[ficha_tecnica]
[equipo numero="3" nombre="CLUB VOLEIBOL GRAN CANARIA"]Paco Sánchez Jover, Antonio Miralles, Waclaw Golec, Juanma Martín, Lars Nilsson y Sandeep Sharma. También jugaron Javi Dios, Jorge Ramón y Emilio Agustí. <strong>Entrenador:</strong> Marcelo Giovanacci.[/equipo]
[equipo numero="0" nombre="ANDORRA"]Da Silva, Wiernes, Ortiz, Garrido, Alemany y Saurín. También jugaron Bosma y Prenafeta. <strong>Entrenador:</strong> Luis Hillaire.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-6, 15-12 y 15-9</p>
<p><strong>Árbitros:</strong> Inocencio Cean (Gijón) y Alfonso Alonso (Vigo). Expulsaron al técnico visitante en el segundo set y amonestaron al jugador del Andorra da Silva.</p>
<p><strong>Incidencias:</strong> El Centro Insular de Deportes registró una asistencia de aproximadamente 4.000 espectadores para presenciar la final de la XVII Copa del Rey. El presidente del Gobierno de Canarias, Jerónimo Saavedra, entregó el trofeo de campeón a Juanma Martín.</p>
[/ficha_tecnica]
[narrativa]El título con el que se cerró la campaña 1991-92 tenía el premio añadido, como ocurrió una campaña antes, de revalidar el doblete nacional, una proeza al alcance de elegidos, los componentes del Club Voleibol Gran Canaria que, aquella tarde del 25 de abril de 1992, estaban dirigidos por el banquillo por Marcelo Giovanacci, dado que Enrique Edelstein, con el que se había ganado la Liga poco antes, había sido destituido por unas manifestaciones públicas que no iban en concordancia con los intereses de la entidad. Pese a esta fulminante decisión, y que podría haber sido causa de desestabilización, el bloque mantuvo su inercia y despachó al Andorra con solvencia y empaque, ese aroma que tienen los campeones cuando llegaba el momento de pujar por este trofeo. Se mantenía, además, la tradición en casa, jugando y ganando ante la afición propia, que ya tenía somatizados todos los rituales del momento estelar de festejar alegrías de este calibre. Salvando el segundo set, en el que el oponente quiso rebelarse, el 3-0 final acreditó que solo hubo un dueño de las distintas situaciones del juego. Juanma Martín, Nilsson, Paco Sánchez Jover y Golec eran entronizados por su papel decisivo, alternando sus recursos técnicos con el oficio y jerarquía que pusieron al servicio del resto de sus compañeros para provocar la invasión final del parqué.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 1992-93', 'numero' => '7', 'order' => 107, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="7" foto="11cap_tro2_foto7.webp" nombre="LIGA" anio="1992-93"]
[ficha_tecnica]
[equipo numero="2" nombre="GRUPO DUERO"]Eduardo Macías, Roman Macek, Stand Pochop, Benjamín Vicedo, Ernesto Rodríguez y Antonio Alemany. También jugaron Juan Ignacio Osuna, Jordi Palencia, Raúl Palacios y David Díaz. <strong>Entrenador:</strong> Humberto Rodríguez.[/equipo]
[equipo numero="3" nombre="GRAN CANARIA"]Paco Sánchez Jover, Waclaw Golec, Chiqui Wiernes, Venancio Costa, Sergio Miguel Camarero y Jorge Ramón. También jugaron Sandeep Sharma, Falasca y Juanma Martín. <strong>Entrenador:</strong> Juanma Martín.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-7, 11-15, 9-15, 15-8 y 11-15</p>
<p><strong>Árbitros:</strong> León y Carreño.</p>
<p><strong>Incidencias:</strong> Partido disputado en el pabellón de La Juventud de Soria.</p>
[/ficha_tecnica]
[narrativa]A las órdenes de Juanma Martín, en cancha contraria, con Soria como testigo, y en un partido disputadísimo, resuelto en el tie break del último set y a la heroica. Así llegó la cuarta Liga, consecutiva y revestida del mérito que comportó la prueba de resistencia en tierras castellanas. Porque, a estas alturas, derrocar al equipo isleño se había convertido en una cuestión compartida por el resto de integrantes de la División de Honor, lo que redoblaba la dificultad de mantener la posición de privilegio. Fue esta Liga muy sudada y trabajada a cuenta de la resistencia que exhibió el Grupo Duero, que llevó al límite al vigente campeón pero que, a la hora de la verdad, no le alcanzó para que sus esfuerzos se tradujeran en lo que buscaba. La buena aportación del banquillo resultó clave para que las rotaciones dieran descanso a los jugadores más castigados físicamente al tiempo que se mantenía el nivel de los que estaban en la cancha. Esa profundidad de recursos marcó el diferencial, además de la perfecta compenetración que daba el disponer de jugadores que llevaban varias temporadas juntos y que, en momentos de máxima tensión, disponían de la capacidad de respuesta y eficiencia máxima. Lo que se suele denominar en todas las disciplinas como &lsquo;la suerte del campeón&rsquo; y que radica en ese instinto de supervivencia.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 1993', 'numero' => '8', 'order' => 108, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="8" foto="11cap_tro2_foto8.webp" nombre="COPA DEL REY" anio="1993"]
[ficha_tecnica]
[equipo numero="2" nombre="UNICAJA ALMERÍA"]Yu Yiqing, Milanov, Rafa Pascual, Cosme Prenafeta, Joaquín Parrado y Jesús Sánchez Jover. También jugaron Fabio Díez, Carlos Carreño y Javi Dios. <strong>Entrenador:</strong> Axel Mondi.[/equipo]
[equipo numero="3" nombre="GRAN CANARIA"]Paco Sánchez Jover, Waclaw Golec, Venancio Costa, Sergio Miguel Camarero, Chiqui Wiernes y Jorge Ramón. También jugaron Sandeep Sharma y Miguel Ángel Falasca. <strong>Entrenador:</strong> Juanma Martín.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-2, 11-15, 15-12, 5-15 y 18-20</p>
<p><strong>Árbitros:</strong> José Antonio González (Vigo) y Víctor Viña (Gijón). Amonestaron a Rafa Pascual, Wiernes y Paco Sánchez Jover.</p>
<p><strong>Incidencias:</strong> Un millar de espectadores en el Polideportivo Municipal Príncipe de Asturias de Murcia.</p>
[/ficha_tecnica]
[narrativa]El suma y sigue en el reinado nacional del Gran Canaria, materializando su tercer doblete consecutivo con la Copa del Rey alzada en Murcia y con una sobresaliente actuación en la final frente a un Almería poderoso y que, por momentos, soñó con salir por la puerta grande. De hecho, inició el choque con un imponente 10-0 a favor, lo que le puso en bandeja un primer set que prácticamente tenía desde la salida de los vestuarios. Pero un entonado Falasca, señalado como el líder en la reacción posterior, así como la eficiente labor defensiva de Paco Sánchez Jover ante las acometidas de Rafa Pascual, canalizaron el camino para no bajarse del trono. La afición grancanaria, que animó en minoría aunque haciéndose notar, pudo disfrutar de una actuación completísima, y de menos a más, de sus jugadores, también con la fortuna de cara ya que el Unicaja dispuso de hasta tres balones de partido que no aprovechó, a diferencia de los hombres de Juanma Martín, que no perdonaron cuando llegó el momento decisivo demostrando una casta y personalidad a prueba de circunstancias. En el club valoraron de la mejor manera esta Copa porque, además de prolongar una línea perfecta en las competencias domésticas, suponía una prueba más de la vena competitiva y ambiciosa de un grupo que no se cansaba de ganar y asumía cada desafío con la ilusión del principiante, que no era el caso precisamente por la trayectoria jalonada de éxitos y reconocimientos que ya se acumulaba y que diferenciaba al Gran Canaria del resto. Encima, en la Copa de Europa se había materializado un quinto puesto que ayudaba a cerrar, con inmejorable balance, otra temporada de objetivos cumplidos y satisfacciones plenas.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 1993-94', 'numero' => '9', 'order' => 109, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="9" foto="11cap_tro2_foto9.webp" nombre="LIGA" anio="1993-94"]
[ficha_tecnica]
[equipo numero="1" nombre="GRUPO DUERO"]Macek, Macías, Vicedo, Pochop, Garrido y Rodríguez. También jugaron Palacios, Díaz, Palencia y Sharma. <strong>Entrenador:</strong> Paulo Sevciuc.[/equipo]
[equipo numero="3" nombre="GRAN CANARIA"]Venancio Costa, Paco Sánchez Jover, Waclaw Golec, Milanov, Falasca y Sergio Miguel Camarero. También jugaron Colom, Sánchez y Jorge Ramón. <strong>Entrenador:</strong> Juanma Martín.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 12-15, 15-5, 12-15 y 8-15</p>
<p><strong>Árbitros:</strong> Andrés (Madrid) y Aller (Gijón).</p>
<p><strong>Incidencias:</strong> Más de 1.500 espectadores en el pabellón de La Joventud de Soria.</p>
[/ficha_tecnica]
[narrativa]Quinta Liga consecutiva, récord en el voleibol nacional que pertenecía a la extinta sección del Real Madrid, que lo logró entre 1976 y 1980, y que el Gran Canaria igualó con su sensacional actuación en Soria y en el cuarto partido de los play-offs de la temporada 1993-94. Imposible pedirle más al conjunto dirigido con maestría por Juanma Martín desde la banda y en el que, una vez más, emergió un Golec intratable que condujo a sus compañeros a este hito. Pese a los esfuerzos de Sharma, viejo conocido que ejerció de rival en el Grupo Duero, y a la presión ejercida por las 1.500 personas que empujaron a favor de los anfitriones, la enésima demostración de superioridad trajo el premio mayor de añadir un diamante más a la corona. Especialmente emotivo fue el multitudinario recibimiento en el aeropuerto a los miembros de la expedición al grito de &lsquo;campeones&rsquo; y tal fue la emoción que Paco Sánchez Jover, ya convertido en una institución, optó, al calor de esta alegría, aplazar su retirada como jugador profesional. Seguía, pues, bien vigente y abrillantado el ciclo de un Gran Canaria convertido en rey nacional y ejemplificando un perfecto binomio ambición-compañerismo, señalado como la clave de esta cadena de gloria y triunfos trascendentes. Esa nueva Liga venía a sublimar un proyecto sostenido en el tiempo y perfeccionado siempre.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 1996', 'numero' => '10', 'order' => 110, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="10" foto="11cap_tro2_foto10.webp" nombre="COPA DEL REY" anio="1996"]
[ficha_tecnica]
[equipo numero="3" nombre="GRAN CANARIA"]Sharma, Klos, Golec, Joel Sotelo, Rueda y Miralles. También jugaron Alexis Valido, Martín, Antonio Sánchez y Camarero. <strong>Entrenador:</strong> Paco Sánchez Jover.[/equipo]
[equipo numero="2" nombre="CAJA SALAMANCA Y SORIA"]Pochop, Gallis, Hernández, Garrido, David Sánchez y Eduardo Sánchez. También jugaron Osuna, Saura y Díaz. <strong>Entrenador:</strong> Benjamín Vicedo.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-3, 15-13, 14-16, 13-15 y 15-11</p>
<p><strong>Árbitros:</strong> Vicente Crespo (Valencia) y Andrés Tomás (Madrid).</p>
<p><strong>Incidencias:</strong> Más de 3.000 espectadores asistieron a este encuentro disputado en el Centro Insular de Deportes.</p>
[/ficha_tecnica]
[narrativa]Dos años de sequía sin títulos, demasiado tiempo para un equipo cimentado a base de campeonatos y festejos, hicieron que la celebración de la Copa del Rey conquistada en 1996 se amplificara al máximo y en reconocimiento a unos jugadores que, como así se demostró, mantenían el orgullo intacto y el carácter ganador. Así se explica que volvieran a provocar un terremoto de felicidad en el Centro Insular con la final ganada al Soria, emotiva, también, por despedidas ilustres como la de los polacos Golec y Klos, emblemas en la cronología moderna de la entidad y que, entre lágrimas y emoción, pudieron poner el epílogo de oro a su maravillosa historia en el club. Tampoco volvería a verse de corto a Camarero, desde los tiempos remotos del Lucky Calvo Sotelo en nómina y que también cerraba una etapa insuperable. Inevitable que tanto condicionante afectivo no marcara un partido en el que hubo que superar adversidades como la temprana lesión de Sandeep Sharma, lo que obligó a Sánchez Jover a retocar su plan inicial en un encuentro que se fue hasta los 155 minutos por la igualdad imperante. Eso sí, la justicia final brilló en lo más alto del electrónico porque las mejores acciones y la mayor intensidad correspondieron a un Gran Canaria mejor posicionado y en el que el mexicano Joel Sotelo fue un elemento destacado por sus acciones ganadoras.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Supercopa de España 1996', 'numero' => '11', 'order' => 111, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="11" foto="11cap_tro2_foto11.webp" nombre="SUPERCOPA DE ESPAÑA" anio="1996"]
[ficha_tecnica]
[equipo numero="3" nombre="GRAN CANARIA AREHUCAS"]Venancio Costa, Carlos Carreño, Antonio Sánchez, Miguel Ángel Falasca, Danny Pointe y Joel Sotelo. También jugaron Juan Carlos Robles, Antonio Miralles y Dani Castañeda. <strong>Entrenador:</strong> Paco Sánchez Jover.[/equipo]
[equipo numero="1" nombre="CAJA SALAMANCA Y SORIA"]Ángel Alonso, Garrido, José Luis Moltó, Peter Gallis, Pochop y Saura. También jugaron Martínez, Sánchez y Parejo. <strong>Entrenador:</strong> Benjamín Vicedo.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 10-15, 15-10, 15-4 y 15-12</p>
<p><strong>Árbitros:</strong> Andrés Tomás (Madrid) y Miguel Ángel Santiago (Tenerife). Amonestaron al local Falasca y al técnico Paco Sánchez Jover por parte local y a Garrido del Soria.</p>
<p><strong>Incidencias:</strong> Unos 1.000 espectadores en el Centro Insular de Deportes. En la entrega de trofeos estuvieron presentes el director general de Deportes del Gobierno de Canarias, Díaz Almeida, y el vicepresidente del Ejecutivo autónomo, Lorenzo Olarte, así como el presidente de la Federación Canaria de Voleibol, José Millán, y el presidente del club grancanario Juan Ruiz.</p>
[/ficha_tecnica]
[narrativa]Era un título que faltaba en las vitrinas y que, tras dos intentonas anteriores y con su rango oficial, tenía un valor indudable en los intereses del Gran Canaria Arehucas, que abrió la temporada 1996-97 de la mejor manera. Derrotar al vigente campeón de Liga, por mucho que a mitad de septiembre el nivel de juego y rendimiento estuviese pendiente de mayor rodaje y perfeccionamiento, fue un empujón de optimismo y energía, como así se admitió de manera unánime por parte de los protagonistas. El papel jugado por Danny Pointe, una de las incorporaciones del nuevo proyecto, resultó de importancia fundamental para tumbar al equipo castellano, que obligó a remontar un 0-1 en contra, por los fallos cometidos en la recepción, pero que no pudo contener la oleada posterior de los amarillos, en la que la veteranía de Venancio Costa ejerció de correa transmisora para que el resto se aplicara con la suficiente contundencia y precisión para apuntarse las tres mangas posteriores. Sánchez Jover, ya en plena gestión del relevo generacional y con una plantilla muy renovada, resaltaba que, en las aspiraciones futuras, contar con el respaldo de esta conquista iba a ser de enorme ayuda, más en el contexto de los cambios que estaban en camino en la entidad tras un inicio de década para enmarcar y que situó listones ya inalcanzables.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 1997', 'numero' => '12', 'order' => 112, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="12" foto="11cap_tro2_foto12.webp" nombre="COPA DEL REY" anio="1997"]
[ficha_tecnica]
[equipo numero="3" nombre="GRAN CANARIA AREHUCAS"]Joel Sotelo, Miguel Ángel Falasca, Venancio Costa, Robles, Vega y Carreño. También jugaron Miralles, Pointe, Castañeda, Antonio Sánchez y Andersson. <strong>Entrenador:</strong> Paco Sánchez Jover.[/equipo]
[equipo numero="2" nombre="UNICAJA ALMERÍA"]Prenafeta, Elgueta, Rodríguez, Sánchez, Matheus y Parrado. También jugaron Prieto y Berenguel. <strong>Entrenador:</strong> Axel Mondi.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 3-15, 6-15, 15-8, 15-2 y 15-12</p>
<p><strong>Árbitros:</strong> Diego León (Barcelona) y Andrés Tomás (Madrid). Tarjeta roja a Robles y Elgueta.</p>
<p><strong>Incidencias:</strong> El Centro Insular de Deportes reunió a más de 4.000 espectadores en la final de la XXII Copa de voleibol. Destacó la presencia del consejero de Cultura y Deportes y el director general de Deportes del Gobierno de Canarias, José Mendoza y Juan Antonio Díaz, respectivamente, y de los concejales del ayuntamiento de Las Palmas de Gran Canaria Juan José Cardona y Pascual Mota.</p>
[/ficha_tecnica]
[narrativa]En poco más de cuarenta minutos, la final parecía sentenciada con un 0-2 para el Almería y con parciales más que ilustrativos. El Centro Insular se resignaba al desmoronamiento de los suyos cuando Sánchez Jover movió fichas de manera providencial y, con un sexteto revolucionario, con especial influencia de Castañeda, Antonio Sánchez y un Miralles que, tras haber contado poco durante la campaña, revivió su mejor versión, el Gran Canaria obró una remontada soberbia y, en una hora justa de juego, justificó su fama de rey de Copas (era la décima final consecutiva de este torneo que disputaba). Fue una exhibición como en los viejos tiempos, mezclando raza, talento, casta y ambición. Volvieron los abrazos y las caras iluminadas por la felicidad cuando se consumó un triunfo que, en palabras del técnico, &ldquo;dejaba las cosas en su sitio&rdquo;. Porque ni con todo en contra hubo amago alguno de rendición. Los más de 4.000 espectadores presentes hicieron el resto empujando a los suyos a medida que tomaba forma una rebelión que terminó de la mejor manera. Esta final se equiparó a la primera saldada con éxito, allá por 1989, por su nivel de dificultad y las complejidades que presentó en su arranque y así se saboreó, de una manera única y poniendo en justa medida el esfuerzo y tesón que implicó levantarse de la lona cuando el adversario tocaba con los dedos el trofeo.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 2021', 'numero' => '13', 'order' => 113, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="13" foto="11cap_tro2_foto13.webp" nombre="COPA DEL REY" anio="2021"]
[ficha_tecnica]
[equipo numero="3" nombre="CLUB VOLEIBOL GUAGUAS"]Paulo Bertassoni, Jorge Almansa, Matt Knigge, Pablo Kukartsev, Guilherme Hage, Moisés Cézar y Alejandro Fernández. También jugaron Javier Sánchez y Stéfano Nassini. <strong>Entrenador:</strong> Sergio Camarero.[/equipo]
[equipo numero="0" nombre="URBIA U ENERGIA PALMA"]Ricardo Perini, Gabriel del Carmen, Elvis de Oliveira, Roberto de Melo, Juan Manuel González, Walter da Cruz y Daniel Ruiz. También jugaron Abel Bernal, De la Rosa, Pont, Renzo Cairus y Juan Lladó. <strong>Entrenador:</strong> Marcos Dreyer.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-20, 25-15 y 25-14</p>
<p><strong>Árbitros:</strong> Erce Álvarez y Correa Álvarez.</p>
<p><strong>Incidencias:</strong> Encuentro disputado en el Centro Insular.</p>
[/ficha_tecnica]
[narrativa]En el proyecto de reconstrucción materializado en 2020 para que el Guaguas volviera a ser lo que fue, la conquista de títulos era una misión de obligado cumplimiento. La naturaleza ganadora jamás se había negociado en la historia de la entidad y por muy buenos propósitos que se pusieran, la vitrina esperaba. Y el 7 de febrero de 2021, en un Centro Insular vacío por imperativos sanitarios derivados de la pandemia de covid-19, el equipo dirigido por Sergio Miguel Camarero comenzaba a responder con hechos. La Copa del Rey era el primer desafío, con el Palma como rival en el partido decisivo, y la respuesta de los jugadores fue impecable. Un claro 3-0, con protagonismo especial de un Pablo Kukartsev letal, designado como MVP del torneo tras anotar 20 puntos en la final, evidenció que, efectivamente, las líneas maestras trazadas para el retorno del escudo habían sido precisas. Apenas unos meses después de la puesta en funcionamiento del club, volver a levantar un trofeo oficial era la mejor manera de ratificar aspiraciones y premiar esfuerzos. De ahí que la satisfacción en todos los jugadores, técnicos y dirigentes fuese palpable a la vista de una celebración merecida y oportuna que, sin que todavía no se supiera, abría un año en el que seguirían sucediéndose los éxitos para mayor gloria propia.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 2020-21', 'numero' => '14', 'order' => 114, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="14" foto="11cap_tro2_foto14.webp" nombre="LIGA" anio="2020-21"]
[ficha_tecnica]
[equipo numero="1" nombre="UNICAJA COSTA DE ALMERÍA"]Javier Jiménez, Alejandro Vigil, Ignacio Sánchez, Fran Iribarne, Miki Fornés y Augusto Colito. También jugaron Mario Ferrera, Curro Sáez, Esteban Villarreal, Jean Pascal Diedhiou y Marlon Palharini. <strong>Entrenador:</strong> Manuel Berenguel.[/equipo]
[equipo numero="3" nombre="CLUB VOLEIBOL GUAGUAS"]Paulo Renan, Jorge Almansa, Matthew Knigge, Pablo Kukartsev, Guilherme Hage y Moisés Cézar. También jugaron Álex Fernández, Nassini y Javier Sánchez. <strong>Entrenador:</strong> Sergio Camarero.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 26-24, 19-25, 19-25 y 20-25</p>
<p><strong>Árbitros:</strong> Susana Rodríguez (Albacete) y Fernando Cerrato (Murcia). Amonestaron al local Iribarne y al jugador del Guaguas Hage.</p>
<p><strong>Incidencias:</strong> Partido disputado en el pabellón Moisés Ruiz de Almería a puerta cerrada.</p>
[/ficha_tecnica]
[narrativa]No conseguía un doblete de Liga y Copa el Guaguas desde hacía casi 30 años. Y el sueño de coronarse de nuevo como dominador del panorama nacional acaparando los dos trofeos oficiales más importantes volvió a ser una realidad en 2021. Semanas después de apuntarse el torneo copero, el equipo afrontó el desafío de no fallar en la conquista que todos aguardaban con mayor expectación y cuyo último entorchado se remontaba a 1994, nada más y nada menos. La Liga era la razón de ser de todos los esfuerzos y Camarero mentalizó a sus hombres a conciencia y el resultado fue el esperado, alzando los brazos al cielo en el encuentro definitorio ante el Unicaja Almería, para el 3-0 final de la serie, pese a que tocó remontar un set en contra. El excelente papel protagonizado por Kukartsev, autor de 25 puntos y guía del resto en su condición de jugador más valioso de la gran final, aupó al Guaguas a la cima que suponía su sexta Liga y que se recibía por todo lo alto, como era menester. Toda la expedición desplazada a tierras andaluzas, con el presidente Juan Ruiz al frente, explotó de alegría cuando el capitán, Moisés Cézar, recibió el trofeo acreditativo y que ratificaba un reinado indiscutible, guiño por los viejos tiempos y sustento del futuro que se sigue escribiendo en estos momentos.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Supercopa de España 2021', 'numero' => '15', 'order' => 115, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="15" foto="11cap_tro2_foto15.webp" nombre="SUPERCOPA DE ESPAÑA" anio="2021"]
[ficha_tecnica]
[equipo numero="3" nombre="CLUB VOLEIBOL GUAGUAS"]Borja Ruiz, Paulo Renan, Jorge Almansa, Matt Knigge, Yosvany Hernández, Guilherme Hage y Alejandro Fernández. También jugaron Adrián Escobar, Moisés Cézar y César Martín. <strong>Entrenador:</strong> Sergio Camarero.[/equipo]
[equipo numero="0" nombre="URBIA U ENERGIA PALMA"]Ignacio Sánchez, Chema Giménez, Sunny Wu, Rodrigo Pernambuco, Renzo Cairus, Manu Carvalho y Daniel Ruiz. También jugaron Guillem Pont y Juan Lladó. <strong>Entrenador:</strong> Abel Bernal.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-22, 25-15 y 25-20</p>
<p><strong>Árbitros:</strong> Rodríguez Machín y R. Sánchez.</p>
<p><strong>Incidencias:</strong> Partido disputado en el Centro Insular de Deportes con media entrada.</p>
[/ficha_tecnica]
[narrativa]No podía darse mejor inicio de temporada 2021-22 que en el Centro Insular, ya con asistencia permitida de público, y un título oficial en juego, en este caso, la Supercopa de España, en la que comparecía como finalista invitado el Palma, luego del doblete nacional logrado en el curso 2020-21. Era el estreno, además, de un nuevo Guaguas, reforzado con fichajes de postín, como los cubanos Hernández y Escobar, y con un proyecto ya consolidado, tras un año de rodaje triunfal, y en búsqueda de más desafíos. Y como lo inmediato siempre manda, Camarero, insaciable, le pidió a sus hombres que no dejaran de hacer lo que mejor sabían: ganar y ganar. Y así cayó la segunda Supercopa de la historia, en una final con un desarrollo lineal: dominio de principio a fin y con protagonismo estelar para Yosvany Hernández, MVP de la jornada merced a sus 24 puntos y una demostración magnífica de poderío y recursos. No tuvo opciones un adversario superado y que comprobó la potencia de un equipo cohesionado, con los automatismos del juego bien definidos, y que no dejó pasar la oportunidad de seguir dando brillo a su sala de trofeos. Una segunda Supercopa en el historial que fue bien valorada y considerada por todos en un momento de especial emotividad en Canarias por la explosión volcánica en La Palma, acaecida una semana antes, y que motivó una sincera dedicatoria de este nuevo éxito.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 2023', 'numero' => '16', 'order' => 116, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="16" foto="11cap_tro2_foto16.webp" nombre="LIGA" anio="2023"]
[ficha_tecnica]
[equipo numero="3" nombre="CV GUAGUAS"]Escobar, De Amo, Almansa, Zonca, Knigge, Ramos, Ruiz. También jugaron: Fernández, Olalla, Bertassoni, Rattray, Fernández, Ruiz, Conde. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="1" nombre="RÍO DUERO SORIA"]Lorente, Villalba, Moreno, Vargas, Dos Santos, Domenech, San Martín. También jugaron: Pérez, Salvador, Pyvovarenko, Jiménez, Tenorio. <strong>Entrenador:</strong> Alberto Toribio.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-22, 25-15, 22-25 y 25-21</p>
<p><strong>Árbitros:</strong> Juan Antonio Erce – Rafael González.</p>
<p><strong>Incidencias:</strong> Tercer encuentro de la final de la Superliga Masculina disputado en el Centro Insular de Deportes de Las Palmas de Gran Canaria ante 3.800 espectadores. El presidente de la RFEVB Agustín Martín Santos entregó a Alejandro Fernández, capitán de CV Guaguas, el trofeo de campeón. El receptor de CV Guaguas Paolo Zonca fue designado MVP de la final por su aportación a lo largo de la eliminatoria.</p>
[/ficha_tecnica]
[narrativa]Venía el Guaguas de un año 2022 seco de alegrías y con la necesidad imperiosa de sacudirse el vértigo heredado. Y la mejor medicina vino con la restitución de la hegemonía doméstica en el campeonato regular. Lo hizo de una manera abrumadora, ganando todos y cada uno de los partidos con una lección de eficacia y superioridad imbatible y ante la que los rivales no tuvieron capacidad alguna de contestación. El Río Duero Soria, en último término, y en la eliminatoria decisiva, no pudo más que someterse a la neta superioridad amarilla, rubricada con pleno de triunfos en el emparejamiento y fin de fiesta perfecto en el CID. Pese los intentos de resistencia visitante, el festival de Zonca, a la sazón MVP, así como la maestría en la distribución de Miguel Ángel De Amo resultaron determinantes en el desenlace por todos esperado y que registraba en la historia una nueva conquista. Camarero pudo darse el lujo de otorgar minutos a todos sus jugadores a modo de homenaje y con el acompañamiento inigualable de un Centro Insular que registró un magnífico ambiente para la ocasión. La recogida del trofeo provocó una oleada de felicidad y alegría por parte del auditorio, entregado a un equipo que volvía por sus fueros ampliando su cosecha de entorchados. Otra vez el Guaguas era motivo de orgullo y admiración por su genética ganadora y espíritu de superación.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa Ibérica 2023', 'numero' => '17', 'order' => 117, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="17" foto="11cap_tro2_foto17.webp" nombre="COPA IBÉRICA" anio="2023"]
[ficha_tecnica]
[equipo numero="3" nombre="CV GUAGUAS"]Nico Bruno, Vigrass, Furtado, Walla Souza, Io de Amo, Jorge Almansa, Juan Moreno, Jean Pascal, Maxi Cavanna, Unai Larrañaga, Hugo López y Ezequiel Pérez. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="1" nombre="BENFICA"]Thiago de Oliveira, Wohlfahrtsatatter, Seabra, Lucas Gaspar, Pablo Ventura, Felipe Airton, Lucas dos Santos, Eduardo da Cruz, Tiago da Silva, André Ryuma, Nuno Marques, Diodo Fernandes, Pontes Cabral e Ivo Correia. <strong>Entrenador:</strong> Marcel Eickhoff.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-23, 25-22, 19-25 y 25-18</p>
<p><strong>Árbitros:</strong> Juan Antonio Erce y Ricardo Ferreira.</p>
<p><strong>Incidencias:</strong> Partido disputado en el CID, que presentó media entrada.</p>
[/ficha_tecnica]
[narrativa]El honor de adjudicarse la primera edición de este trofeo oficial correspondió al Guaguas que, además, lo hizo en su condición de anfitrión. El formato de la Copa Ibérica contemplaba una eliminatoria previa, saldada con triunfo ante el Sporting de Lisboa, y la correspondiente final, en la que tocó en suerte otro destacado representante luso, en este caso el Benfica, que había superado en su cruce al Soria. El encuentro pillaba al bloque en el inicio de un nuevo proyecto, con rodaje justo pero ambición siempre innegociable. Con un título en juego, Camarero jamás negocia. Y bien que se aplicaron sus pupilos en dejar la copa en casa, con un inicio fulminante (2-0) que encarriló, definitivamente, la contienda. El argentino Cavanna, una de las grandes apuestas de entonces, se erigió en figura y referente, liderando al resto para desembocar en la foto triunfal. El mérito añadido vino con el arreón de orgullo de un Benfica que requirió un cuarto set en el que sí se dio la sentencia para reproducir la habitual foto final del Guaguas en lo alto del podio y presumiendo de una nueva adquisición para sus vitrinas. En la entidad hizo especial ilusión ganar la Copa Ibérica inaugural por el componente histórico que implicaba, sin descuidar el impulso anímico que también implicó batirse, con excelente nota, a lo mejor del voleibol portugués.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Supercopa de España 2023', 'numero' => '18', 'order' => 118, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="18" foto="11cap_tro2_foto18.webp" nombre="SUPERCOPA DE ESPAÑA" anio="2023"]
[ficha_tecnica]
[equipo numero="3" nombre="CV GUAGUAS"]Nicolás Bruno, Manu Furtado, Wallyson Bezerra Souza, Jean Pascal Diedhiou, Paolo Zonca, Maxi Cavanna, Unai Larrañaga. También jugaron: Graham Vigrass, de Amo, Jorge Almansa, Juan Pablo Moreno. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="2" nombre="GRUPO HERCE SORIA"]Lucas Lorente, Fabián Flores, Adrián Olalla, José Villalba, Bruno Cunha, Joan Domenech, Alejandro San Martín. También jugaron: Luke Belda, Santiago Aulisi. <strong>Entrenador:</strong> Luis Alberto Toribio.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 23-25, 25-20, 25-19, 22-25 y 15-8</p>
<p><strong>Árbitros:</strong> Hugo Suárez – Rafael González.</p>
<p><strong>Incidencias:</strong> Partido correspondiente a la Supercopa Masculina que abrió la temporada 2023-24 en la máxima categoría disputado en el Centro Insular de Deportes.</p>
[/ficha_tecnica]
[narrativa]Con los ecos recientes de la Copa Ibérica, ganada pocos días antes, la sed de gloria del Guaguas escribió un capítulo más con motivo de la tradicional apertura de curso con la primera corona nacional en juego. Enfrente, un rival de sobra conocido y con numerosos antecedentes en duelos fratricidas, el Grupo Herce Soria, lo que garantizaba emociones fuertes sobre la pista del Centro Insular. Y todos los pronósticos se cumplieron porque el pleito tuvo que irse hasta el tie break (2-2). Había empezado todo con rebelión visitante para ponerse 0-1 y costó un esfuerzo titánico (y un Paolo Zonca sublime, autor de 23 puntos y apariciones oportunísimas). Y en la manga decisiva, temple y madurez: el Guaguas abrió con seis puntos de ventaja el quinto y último set (9-3), alejándose lo suficiente del marcador para asegurar la tercera Supercopa de España en su palmarés hasta ese momento y alargaba una inercia triunfal de indudable impacto positivo para arrancar una campaña que depararía muchas más alegrías. El impulso que había dado la Copa Ibérica tuvo continuación en este frente abierto y terminó por propulsar a un equipo con automatismos marcados y capaz de lograr todo lo que se propusiera, ya fuera un pleno nacional, como así volvería a suceder. Más leyenda con nombres propios.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 2024', 'numero' => '19', 'order' => 119, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="19" foto="11cap_tro2_foto19.webp" nombre="COPA DEL REY" anio="2024"]
[ficha_tecnica]
[equipo numero="0" nombre="UNICAJA COSTA DE ALMERÍA"]Rodríguez, Bertassoni, Fernández, Neaves, Ruiz, Ruiz, Fernández. También jugaron: Viera, Fernández, Vizcaino. <strong>Entrenador:</strong> Manuel Berenguel.[/equipo]
[equipo numero="3" nombre="CV GUAGUAS"]Bruno, Saxton, Bezerra, De Amo, Diedhiou, Zonca, Larrañaga. También jugaron: Furtado, Almansa, Ramos. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-27, 17-25 y 20-25</p>
<p><strong>Árbitros:</strong> Carlos Robles – David Fernández.</p>
<p><strong>Incidencias:</strong> Final de la XLIX Copa de SM El Rey celebrada en el Pabellón Europa de Leganés ante 4.000 espectadores (Lleno). El Presidente del Comité Olímpico Español Alejandro Blanco hizo entrega a Miguel Ángel de Amo el trofeo acreditativo como MVP de la XLIX Copa de SM el Rey. El alcalde de Leganés, Miguel Ángel Recuenco, y Agustín Martín Santos, presidente de la RFEVB, entregaron a Jorge Almansa, capitán de CV Guaguas, el trofeo de campeón de la XLIX Copa de SM El Rey.</p>
[/ficha_tecnica]
[narrativa]Un pabellón Europa de Leganés abarrotado, rozando el techo de los 5.000 espectadores, contempló una nueva exhibición que valió otro título más y con absoluta justicia, dado un marcador inapelable que evidenció la superioridad manifiesta del campeón. La distribución de Miguel Ángel de Amo, elegido MVP del torneo, y las aportaciones mayúsculas de Walla Bezerra, Paolo Zonca y Nicolás Bruno anularon completamente al equipo andaluz, en el que los puntos de Neaves resultaron insuficientes en sus deseos de mantenerse en el partido. Tras un primer set igualado, y que se decidió por pequeños detalles y con un punto de oro de Bruno, todo lo que vino después fue más concluyente para los intereses del Guaguas, favorecido, además, por los errores en el saque del oponente. Y sin perder la tensión, pese a que el marcador acompañó siempre, se fue cincelando la consecución de una Copa del Rey que engordaba todavía más un curso que había arrancado con el doblete Copa Ibérica-Supercopa de España. Jean Pascal Diedhiou, de menos a más a nivel individual en la gran final, fue el encargado de coronar la faena en Madrid con el remate ganador y que inició los festejos en un ambiente inmejorable y que aumentó, más si cabe, el impacto de un nuevo laurel añadido a la corona insuperable de la entidad.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 2024', 'numero' => '20', 'order' => 120, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="20" foto="11cap_tro2_foto20.webp" nombre="LIGA" anio="2024"]
[ficha_tecnica]
[equipo numero="1" nombre="GRUPO HERCE SORIA"]Llorente, Pequeño, Olalla, San Martín, Flores, Tenorio, Santos, Aluisi, Villalba, Salvador, Zazo, Belda, Sanchís, Giménez y Doménech. <strong>Entrenador:</strong> Alberto Toribio.[/equipo]
[equipo numero="3" nombre="CV GUAGUAS"]Pascal, Bruno, Walla, Zonca, Ramos, De Amo, Larrañaga, Moreno, Finoli, Vigrass, Pérez, Furtado, Almansa y López. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 24-26, 22-25, 25-17 y 17-25</p>
<p><strong>Incidencias:</strong> Partido disputado en el Pabellón Municipal Los Pajaritos de Soria con gran afluencia de público y seguidores del Guaguas en las gradas.</p>
[/ficha_tecnica]
[narrativa]La octava Liga del Guaguas vino a poner el corolario de lujo a un curso en el que antes se habían levantado otros tres trofeos (Copa Ibérica, Supercopa de España y Copa del Rey). El festejo en Soria consagró a una plantilla que cumplió con nota sobresaliente con todos los objetivos propuestos y, por encima de todo, protegió esa hegemonía nacional que ha sido sello distintivo y una cuestión de orgullo. La conclusión favorable de la serie no estuvo exenta de algunas dificultades, como el hecho de que el Grupo Herce Soria rompiera el factor cacha ganando uno de los dos primeros encuentros celebrados en el CID. Todo un órdago para los jugadores de Camarero, ya obligados a lidiar con ambiente adverso en lo que quedaba de la serie si no se llegaba al quinto encuentro. Y fue así, no se llegó al límite porque la respuesta en cancha castellana fue perfecta. Y en la primera ocasión que se pudo sentenciar la eliminatoria, a nadie le temblaron las piernas. Walla y Zonca fueron los actores más destacados en un esfuerzo coral y constante que neutralizó cualquier intento de los locales. Una nueva lección, y ya son incontables, del gen único de un equipo habituado a lo que en otros sitios resulta imposible e inalcanzable: encadenar victorias y campeonatos como rutina existencial.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Supercopa de España 2024', 'numero' => '21', 'order' => 121, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="21" foto="11cap_tro2_foto21.webp" nombre="SUPERCOPA DE ESPAÑA" anio="2024"]
[ficha_tecnica]
[equipo numero="3" nombre="CV GUAGUAS"]Pascal, Walla, Bruno, Ramos, De Amo, Rousseaux y Larrañaga. También jugaron: Trinidad, Moreno, Almansa, Nalobin y Pereira. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="0" nombre="UNICAJA COSTA DE ALMERÍA"]González, Ruiz, Bertassoni, J. Fernández, Tarrazo, Todd y F.J. Fernández. También jugaron: Filip. <strong>Entrenador:</strong> Pablo Ruiz.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-18, 25-18 y 25-10</p>
<p><strong>Árbitros:</strong> Fernández Fuentes y Sabroso Moratilla.</p>
<p><strong>Incidencias:</strong> Partido correspondiente a la XXVII Supercopa de España en la temporada 2024-25 disputado en el Gran Canaria Arena ante 2.700 espectadores.</p>
[/ficha_tecnica]
[narrativa]Todos los títulos son especiales &ldquo;porque cuesta muchísimo ganarlos&rdquo;, recuerda siempre que puede el presidente Juan Ruiz. Y debe ser verdad porque lleva unos cuantos bajo su mandato y nunca deja de enfatizar la importancia de valorarlos y saborearlos. La Supercopa del año 2024 tuvo la connotación distinguida de producirse en el estreno del equipo en el Gran Canaria Arena. El CID había sido el escenario de todos los sueños cumplidos y, por los trabajos de rehabilitación y modernización del emblemático recinto de la Avenida Marítima, ahora tocaba continuar la vida en Siete Palmas, sin rebajar lo más mínimo ambiciones y desafíos. Y el debut en la nueva casa era ni más ni menos que una final y con el premio de seguir ampliando la leyenda. Un cartel imbatible que activó, como de costumbre, a los jugadores, hasta el punto de arrasar al Almería. Camarero no buscó excusas en que se estaba al inicio de una nueva temporada y que el nivel físico o la cohesión del grupo caminaban todavía por una estación experimental. Pidió que se ganara y pasó lo que tenía que pasar con Walla de nuevo en plan estelar y aportaciones también destacadas de Bruno, Ramos o Rousseaux, entre otros. Inmejorable bautizo con delirio de la afición por seguir reconociendo a su Guaguas campeón pese a la inevitable mudanza.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Copa del Rey 2025', 'numero' => '22', 'order' => 122, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="22" foto="11cap_tro2_foto22.webp" nombre="COPA DEL REY" anio="2025"]
[ficha_tecnica]
[equipo numero="1" nombre="CONECTABALEAR CV MANACOR"]Ribas, Romaní, Lorente, Godbold, Calvo, Cairus, Marzo. También jugaron: Alomar, Vanco, Flequer. <strong>Entrenador:</strong> Alexis González.[/equipo]
[equipo numero="3" nombre="CV GUAGUAS"]Bruno, Bezerra, De Amo, Diedhiou, Rousseaux, Ramos, Larrañaga. También jugaron: Pérez, Almansa, Trinidad. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 15-25, 18-25, 25-23 y 23-25</p>
<p><strong>Árbitros:</strong> Rubén Sánchez y Carlos A. Robles.</p>
<p><strong>Incidencias:</strong> Final de la Copa de SM el Rey celebrada en el CDM Siglo XXI de Zaragoza ante 1.360 espectadores. Cristina García, directora general de Deportes del Gobierno de Aragón, hizo entrega del trofeo de MVP de la Copa al opuesto de CV Guaguas Wallyson Bezerra. Jorge Almansa, capitán de CV Guaguas, recogió el trofeo de campeón.</p>
[/ficha_tecnica]
[narrativa]Hacía más de diez años que un equipo no lograba encadenar dos títulos coperos seguidos y tuvo que ser el Guaguas, que en Zaragoza defendía trono, el que rompió esa mala tradición para el campeón. Frente a un debutante en la élite que jamás se rindió y trató de darle emoción al partido, el brazo ejecutor de Walla (¡28 puntos!) se elevó por encima de todos y terminó agarrando el trofeo con determinación, para bien de su equipo. El ambientazo en Zaragoza y el entusiasmo del oponente, muy por debajo del Guaguas pero que plantó batalla, condimentaron una actuación característica del Guaguas en cada final que ha jugado: intensidad, concentración y madurez. Esa cualidad competitiva se valió para abrir brecha con dos sets a favor, disputar la tercera manga que se le fue por poco y, ya en el juego decisivo, exhibir artillería para aplacar al Manacor. Walla, apariciones puntuales pero valiosísimas de Martín Ramos, encargado de sellar el triunfo, o Diedhiou se encargaron de que Jorge Almansa, el gran capitán, alzara al cielo una Copa del Rey con sabor especial porque ratificaba aún más un reinado firme y brillante y que anticipaba más alegrías en camino. De hecho, semanas después, volvería a darse una celebración con un nuevo campeonato liguero que conformó el siempre ansiado y tan complicado doblete.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Liga 2025', 'numero' => '23', 'order' => 123, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="23" foto="11cap_tro2_foto23.webp" nombre="LIGA" anio="2025"]
[ficha_tecnica]
[equipo numero="0" nombre="GRUPO HERCE SORIA"]Arjones, Flores, Olalla, J. Villalba, Cunha, Domenech y Osado. También jugaron: Aulisi, A. Villalba. <strong>Entrenador:</strong> Alberto Toribio.[/equipo]
[equipo numero="3" nombre="CV GUAGUAS"]Bruno, Walla Souza, Pascal, Rousseaux, Ramos, Trinidad y Larrañaga. También jugaron: De Amo. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 23-25, 21-25 y 20-25</p>
<p><strong>Árbitros:</strong> María Gloria Souto – Juan Antonio Erce.</p>
<p><strong>Incidencias:</strong> Tercer partido correspondiente a la serie final de la Superliga Masculina de Voleibol 2024-25 disputado en el Pabellón de Los Pajaritos ante 2.600 espectadores.</p>
[/ficha_tecnica]
[narrativa]Después de ganar los dos primeros partidos de la final, e inclinar de manera muy favorable el título del campeonato regular, el Guaguas no quiso esperar más y certificó en Soria, con un nuevo triunfo para el 3-0 de rigor. Pese a un 9-4 de entrada en contra, que encendió los ánimos de un rival que aspiraba a forzar un cuarto envite, Walla Souza, máximo anotador del encuentro junto al local Cunha con 14 puntos, tomó las riendas de la situación, secundado siempre por sus compañeros, y fue poniendo las cosas en su sitio. La presión de ser el favorito ejerció el efecto pretendido de rendir a conciencia y, en las situaciones en las que el marcador ofrecía cierta emoción, instaurar de inmediato respeto y jerarquía. El saber estar del equipo, constante en su crecimiento hasta la victoria, y tirando de galones y madurez, cimentó un resultado más que merecido y que añadía a la cosecha otra copa más. Tomas Rousseaux finiquitaba el partido con una diagonal cerrada, ya cuando todo estaba visto para sentencia, y alargaba la dinastía ganadora del club. El clásico de todos abrazados, gritando el nombre del Guaguas y como envidia del voleibol nacional, volvió a darse en Soria, ratificando que el rey de España en este deporte viste de amarillo y mantiene firmes sus pasos.[/narrativa]
[/titulo_deportivo]
'),

    array('title' => 'Supercopa de España 2025', 'numero' => '24', 'order' => 124, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="24" foto="11cap_tro2_foto24.webp" nombre="SUPERCOPA DE ESPAÑA" anio="2025"]
[ficha_tecnica]
[equipo numero="3" nombre="CV GUAGUAS"]Nico Bruno, Ezequiel Pérez, Hélder Spencer, Osmany Juantorena, Walla Souza, Miguel Ángel de Amo, Unai Larrañaga, Jorge Almansa, Augusto Colito, Jean Pascal Diedhiou, Tomas Rousseaux, Martín Ramos y Dobromir Dimitrov. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="0" nombre="GRUPO HERCE SORIA"]Óscar Arnaiz, Carlos Montero, Lucas Lorente, Omar Hoyos, Diego Miguel, Moisés Rodrigo, Juan Pablo Moreno, Rodrigo Jiménez (líbero), Alejandro Villalba, Mikel Kalstad, Bernat Castella, Viktor Lindberg, Joan Domenech, Azddin Mimoun y Arnau Masià. <strong>Entrenador:</strong> Luis Alberto Toribio.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-23, 25-23 y 25-23</p>
<p><strong>Árbitros:</strong> Francisco Javier Pedrosa y Joaquín Ventura.</p>
<p><strong>Incidencias:</strong> Encuentro correspondiente a la final de la Supercopa de España, disputada en el Polideportivo Pisuerga de Valladolid.</p>
[/ficha_tecnica]
[narrativa]El año 2025, con la Superliga y la Copa del Rey como bagaje anterior, merecía el corolario que trajo la conquista de la Supercopa de España, movida de fecha, del habitual inicio de calendario a uno de los últimos días del año y en sede neutral, en este caso, Valladolid. Y, como es habitual, al Guaguas, ante una final, con la posibilidad de seguir añadiendo títulos, se le abrió el hambre. Poco importó que el adversario, el Grupo Herce Soria, le hubiera ganado en los días previos a la cita en lo que se podía interpretar como un mal presagio. En un partido de poder a poder, con tres sets disputadísimos, todos resueltos por el mismo 25-23, lo que evidencia la intensidad y emoción que hubo, el comportamiento maduro y constante del equipo tuvo su justa recompensa. A la habitual cohesión colectiva se sumaron las apariciones oportunas y decisivas de Walla, Bruno o Juantorena, contundentes en la red para que el 24.º título oficial de la historia cobrara cuerpo y se convirtiera en realidad. Pese a los intentos del contrario de revertir el orden, nada pudo frente a la contundencia amarilla, de principio a fin y sin dar opción a la rebelión soriana. La versión más reconocible del campeón hegemónico permitió que la Supercopa volviera con el equipaje para Gran Canaria.[/narrativa]
[/titulo_deportivo]
'),
    array('title' => 'Liga 2026', 'numero' => '25', 'order' => 125, 'show_marker' => false, 'parent_ref' => 'cap11',
        'content' => '
[titulo_deportivo numero="25" foto="11cap_tro2_foto25.webp" nombre="LIGA" anio="2026"]
[ficha_tecnica]
[equipo numero="3" nombre="CV GUAGUAS"]Nico Bruno, Ezequiel Pérez, Hélder Spencer, Osmany Juantorena (10), Walla Souza, Miguel Ángel de Amo, Unai Larrañaga, Jorge Almansa, Augusto Colito, Jean Pascal Diedhiou, Tomas Rousseaux, Elio Montesdeoca, Martín Ramos y Dobromir Dimitrov. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="0" nombre="CV MELILLA"]Lucas Malaber, Víctor Méndez, Héctor García, Abdelhafid Mohamer, Arthur Nath, Federico Arquez, Aurelio Rodríguez, Daniel Macarro, Zeus París, Eduardo Álvarez y Federico Martina. <strong>Entrenador:</strong> Salim Abdelkader.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-17, 25-19 y 25-16</p>
<p><strong>Árbitros:</strong> David Fernández y Francisco Javier Pedrosa.</p>
<p><strong>Incidencias:</strong> Segundo partido de la final de la Superliga disputado en el Gran Canaria Arena ante unos 3.000 espectadores.</p>
[/ficha_tecnica]
[narrativa]Siendo 2026 el año en el que se conmemora el cincuentenario de la fundación del Guaguas cobraba una importancia capital ponerle el lazo con la conquista del título de mayor prestigio y eco en España: la Superliga. Y, como no podía ser de otra manera tras haber dominado la fase regular con mano de hierro, el Guaguas no dejó escapar la oportunidad de revalidar su hegemonía nacional con el cuarto entorchado consecutivo y el décimo en toda su historia. Fue ante un Gran Canaria Arena con cerca de 3.000 aficionados que vibraron con la manifiesta superioridad de los jugadores de Sergio Miguel Camarero, que en poco más de una hora, pasaron por encima del Melilla (3-0), después de haber logrado el mismo tanteador en el partido de ida disputado en la capital norteafricana. El Guaguas quería el título por la vía rápida y, desde el primer instante, se percibió la determinación para cumplir con esa misión. Walla, Spencer, Martín Ramos y Juantorena se diferenciaron con su poder realizador y a Colito, con un bloqueo, le correspondió el honor de firmar la acción que desató la fiesta.[/narrativa]
[/titulo_deportivo]
'),
    array('title' => 'Joselu Sánchez', 'numero' => '', 'order' => 176, 'show_marker' => false, 'parent_ref' => 'cap17',
        'hero' => array(
            'image' => libro_img('11cap_titu_joselu.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('JOSELU', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('SÁNCHEZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Fue uno de los jugadores que estuvieron presentes en la pista del García San Román en el histórico partido disputado ante el Knack de Bélgica, correspondiente a la Recopa de Europa, el 7 de noviembre de 1987, bautizo continental de un Guaguas que luego se haría asiduo y respetado en competiciones internacionales.[/capitular]

<p>Y aunque su paso por la plantilla fue fugaz (&ldquo;estuve entrenando, sin fichar, durante la campaña 1986-87 y luego, al tener el servicio militar, tuve que marcharme en enero de 1988, con lo que apenas fueron tres meses como miembro de la plantilla&rdquo;), Joselu Sánchez (Ferrol, 1962) dejó tanta huella que, décadas después, cuando Juan Ruiz ideó la refundación, tuvo muy presente su nombre para integrarlo en el organigrama ejecutivo con las funciones de secretario.</p>

[cita_editorial]Nací en Galicia por circunstancias laborales de mi padre. Pero llegué a Gran Canaria con apenas unos meses y mi condición de canario es algo que llevo con honra y orgullo. Estoy enamorado de mi isla. Por eso, recuperar una entidad que ha sido tan representativa para nuestra sociedad era para mí algo de obligado cumplimiento. Mi relación laboral con Juan Ruiz ha sido de toda la vida. Nos conocemos muy bien. Y recibí su ofrecimiento con muchísimo entusiasmo. Va más allá de lo deportivo. Para mí el Guaguas es un sentimiento.[/cita_editorial]

<p>Confiesa.</p>

<p>En este sentido, destaca que &ldquo;el trabajo ha sido considerable&rdquo; desde que comenzaron las gestiones para que el club volviera al ámbito competitivo: &ldquo;Captar patrocinios y apoyos en época de pandemia y crisis económica es algo que muy pocas personas pueden conseguir. Juan Ruiz lo ha vuelto a lograr. Ya hizo un proyecto sensacional a finales de los ochenta y ahora, de la nada, el Guaguas vuelve a ser campeón. Para todos los que sentimos muy adentro estos colores supone una emoción enorme&rdquo;.</p>

<p>&ldquo;Estoy convencido de que se están sentando las bases para que la entidad se vuelva a consolidar. En eso estamos todos los que formamos parte de esta familia. Sin duda, los éxitos deportivos que se han cosechado son un respaldo importante, pero queda mucho por hacer y seguimos con todo tipo de esfuerzos e ideas para permitir el crecimiento de nuestro escudo&rdquo;, apostilla. Joselu, que guarda parentesco familiar con Jorge Ramón, insiste en que el Guaguas &ldquo;es una seña de identidad&rdquo; y que forma parte &ldquo;del patrimonio deportivo y sentimental&rdquo; de Gran Canaria.</p>

[cita_editorial]Recuerdo mis comienzos en los Salesianos, Universidad Laboral, Gran Canaria y Juventud, a entrenar con el Guaguas en la temporada 1986-87 y mi ficha por ese equipo en la siguiente por invitación de Felipe Nuez. Mi posterior etapa en el Santa Catalina de Isidro Quintana en Tercera División, equipo con el que alcanzamos la Segunda y la División de Honor. Incluso cuando formé parte del Canteras de balonmano quedando campeón de Primera y alcanzando la División de Honor. El deporte siempre ha formado parte de mi vida y en estos últimos años incluso saqué un título de entrenador de voleibol para estar más cerca de mi hija Laura. Una de mis ilusiones es ayudar al Guaguas porque será bueno para nuestra tierra.[/cita_editorial]

<p>Dice.</p>
'),

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
            'image' => '',
            'background_color' => 'hsl(206, 20%, 15%)',
            'overlay' => 'rgba(0, 0, 0, 0.25)',
            'icon' => 'custom',
            'custom_icon' => $star,
            'custom_icon_color' => 'hsl(206, 20%, 93%)',
            'icon_width' => 50,
            'icon_height' => 50,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'title_lines' => array(libro_hero_line('VUELVE EL GRAN', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'), libro_hero_line('GUAGUAS', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none')),
        ),
        'content' => ''),
    array('title' => 'Vuelve el gran Guaguas', 'numero' => '', 'order' => 131, 'show_marker' => false, 'parent_ref' => 'cap12',
        'hero' => array(
            'image' => libro_img('12cap_vuel_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'custom',
            'custom_icon' => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(206, 20%, 93%)',
            'icon_width' => 40,
            'icon_height' => 40,
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(
                libro_hero_line('VUELVE EL GRAN', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'),
                libro_hero_line('GUAGUAS', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'),
            ),
        ),
        'content' => '
[imagen_contenido file="12cap_vuel_foto3.jpg" caption="Felipe Nuez, Juan Ruiz, Sergio Miguel Camarero y Paco Sánchez Jover, retratados juntos, a comienzos de la temporada 2021-22" fullwidth="true"]

[seccion_header color="navy"]Un paso por aclamación[/seccion_header]

[capitular]No fue una opinión aislada, tampoco la petición de algún nostálgico suelto, ni siquiera una suma de sugerencias. A Juan Ruiz llevaban parándole por la calle &ldquo;años y años&rdquo;, como significa, multitud de aficionados que, directamente, no terminaban de digerir que un emblema del deporte y de la sociedad grancanaria contemporánea hubiese desaparecido.[/capitular]

[imagen_contenido file="12cap_vuel_foto2.jpg" caption="El rugido ganador y de orgullo de Camarero desde el banquillo contribuye a que el nuevo Guaguas siga en lo más alto."]

<p>Y el histórico presidente, siempre receptivo a la voz de la gente, fue aparcando el escepticismo inicial para ir modelando un regreso que, sabía, iba a implicar serias complejidades. La refundación de una entidad deportiva, y diez años después de su liquidación como era el caso del Guaguas, obligaba a un proyecto de cimientos estables, de garantías plenas. &ldquo;Estaba prohibido dar un paso en falso&rdquo;, resume Ruiz, quien durante muchos meses fue gestando de qué manera y con qué apoyos iba a rescatar del olvido un escudo que, por historia, apego popular y prestigio jamás mereció caer en el olvido. Ya jubilado y liberado de servidumbres horarias, con una familia &ldquo;que estaba encaminada y siempre se mostró comprensiva&rdquo; con su motivación sentimental de rescatar a la entidad de su vida, inició la maniobras desde la discreción necesaria. Cualquier tipo de publicidad antes de consolidar las estructuras y el andamiaje de patrocinadores podría resultar contraproducente, lo que motivó que esas rondas de contactos y consultas no pasaran del ámbito privado.</p>

<p>Paco Sánchez Jover y Sergio Miguel Camarero, los símbolos de la época de esplendor, fueron de los primeros en conocer sus intenciones. Había que acudir a las raíces y en la estructura y tradición del Calvo Sotelo esos dos nombres eran irrenunciables. Como también el de Felipe Nuez, el entrenador fundacional y referente obligado en esa reconstrucción en ciernes. En todos encontró receptividad y predisposición. Pese al paso del tiempo y a las incertidumbre inevitables, Juan Ruiz supo que la vieja guardia estaba con él. Y ejecutivos que le acompañaron antes de su marcha en 1998, tales como Antonio Benítez, Miguel Ángel Hernández, el exjugador Joselu Sánchez o Marek Szczesnowicz también le tendieron la mano, prestos a colaborar en lo necesario sin más interés que el de revivir un emblema como el que, en tiempos, llenó hasta la bandera el Centro Insular y campeonó por España.</p>

[imagen_contenido file="12cap_vuel_foto1.jpg" caption="Vuelo sin motor de Hage en un partido disputado en el Centro Insular de Deportes y correspondiente a competición europea."]

<p>La decisión ya era firme. El consenso deseado para emprender el nuevo Guaguas, el paso necesario que tantas meditaciones había alimentado en la mente de Juan Ruiz... Todo encajaba y ya a finales de 2019, pese a los rigores de la pandemia, el sueño de restituir una entidad con cinco Ligas, seis Copas del Rey, una Supercopa de España, ídolos inolvidables en su camino y más de cincuenta partidos oficiales en competiciones europeas, comenzaba a cristalizar. Un legado inigualable.</p>

<p>El 11 de mayo de 2020 quedó constancia en el Registro de Entidades Deportivas de Canarias de la entrada de toda la documentación pertinente del nuevo Guaguas con la intención de entrar en el ámbito competitivo y, menos de dos meses después, el 2 de julio, tenía lugar en el Cabildo de Gran Canaria la presentación institucional de un proyecto incubado con mimo, paciencia y entusiasmo.</p>

[imagen_contenido file="12cap_vuel_foto5.jpg" caption="Zonca, Knigge, Ramos, De Amo y Almansa, celebrando un punto."]

<p>Juan Ruiz volvía para ganar. No se conformaba con un Guaguas de transición y así lo demostró con arduas y hábiles gestiones para poner a disposición de Sergio Miguel Camarero una plantilla de calidad y experiencia. Entre las novedades más destacadas, Sánchez Jover se trajo del Vecindario al central brasileño Moisés Cézar, toda una garantía por su amplio recorrido profesional, y también sobresalió la llegada del opuesto argentino Pablo Kukartsev quien, a la postre, sería la pieza más decisiva para la consecución de los títulos que venían en camino.</p>

[imagen_contenido file="12cap_vuel_foto6.webp" caption="Jorge Almansa, ejemplo de capitán y representatividad en el Guaguas contemporáneo."]

<p>Alejandro Fernández Rojas, Guilherme Magnani Hage, Carlos Manuel de Carvalho Furtado, Moisés Dos Santos Cézar, Javier Sánchez Carreres, Paulo Renán Bertassoni, Jorge Almansa Martínez, Luca Biliato, Ruiman David Artiles Sosa, Matthew Lambert Knigge, Stefano Nassini Hidalgo, Pablo Sergio Kukartsev y Gustavo Delgado Escribano fueron los integrantes de la plantilla de la campaña 2020-21 y cuyo primer partido oficial fue como visitante, contra el Rotogal Boiro en el pabellón A Cachada de Galicia, el 3 de octubre de 2020, ganando 0-3. Punto de partida de la nueva era en la que el Guaguas vuelve a ser protagonista por su presente de éxito y horizonte de ilusiones.</p>
'),

    array('title' => 'Todos los presidentes', 'numero' => '', 'order' => 132, 'show_marker' => false, 'parent_ref' => 'cap12',
        'hero' => array(
            'image' => libro_img('12cap_presidentes_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(
                libro_hero_line('TODOS LOS', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'),
                libro_hero_line('PRESIDENTES', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'),
            ),
        ),
        'content' => '
[capitular]Juan Ruiz ocupa un lugar preeminente e indiscutible en este capítulo de dirigentes por la vigencia, bagaje y trascendencia de su mandato, dividido en dos partes, la inicial entre 1986 y 1998, y la actual, nacida en plena pandemia, año 2020 y todavía en curso.[/capitular]

<p>Es el presidente por antonomasia del Guaguas. Todos los títulos del palmarés han llegado bajo sus directrices, también las contrataciones más exitosas y recordadas, así como los ciclos de mayor calado social y repercusión, tanto a nivel regional como nacional y más allá de las fronteras. El escudo va asociado a su figura y no se entiende la trayectoria sin igual del club sin su referencia. A ese servicio continuado, estelar y que ha entrado por derecho propio en la historia del deporte canario por ser un modelo de eficiencia integral, con solvencia económica, sostenibilidad institucional y voracidad en la cancha.</p>

<p>En su haber también figura, como dato inmaculado, no haber percibido remuneración alguna por su dedicación, tiempo y gestiones en aras de procurar al Guaguas un presente y un futuro. El perfil de ejecutivo remunerado se ha normalizado en los últimos tiempos e incluso hay una legitimización de esa contraprestación económica. Pero Juan Ruiz, que no ha escatimado en sacrificios, renuncias personales y todo tipo de iniciativas desde el altruismo, entiende que su representatividad ya tiene suficiente retorno como para cuantificarla o monetizarla. Ahí también se diferencia de la mayoría de sus homólogos. Esa concepción romántica de dar sin pedir a cambio, la que le llevó a adentrarse en aquel Guaguas de los ochenta que estaba a punto desaparecer guiado por su vocación de ayudar, la mantiene blindada al tiempo como ejemplo y emblema.</p>

<p>Si sobre Guillermo Gil recae el honor de haber sido el presidente fundacional, allá por 1976, en Juan Ruiz reposan los laureles del club con mayor número de títulos de Canarias y el despegue hacia el infinito de un Guaguas instalado en la excelencia.</p>

[bloque_lista_foto file="12cap_vuel_foto8.webp" alt="Juan Ruiz"]
[resaltado color_texto="hsl(220, 50%, 12%)"]Guillermo Gil[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]José Luzardo[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Arturo Sureda[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Florencio Tejera[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]José María Rodríguez[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Gustavo Rodríguez[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Juan Ruiz[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Mario Hugendubel[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]José Luis Cano[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Pedro Cuarental[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Samuel Díaz[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]David Rodríguez[/resaltado]
[/bloque_lista_foto]
'),
    array('title' => 'Todos los entrenadores', 'numero' => '', 'order' => 133, 'show_marker' => false, 'parent_ref' => 'cap12',
        'hero' => array(
            'image' => libro_img('12cap_entrenadores_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(
                libro_hero_line('TODOS LOS', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'),
                libro_hero_line('ENTRENADORES', 'hsl(220 50% 12%)', 'hsl(206, 20%, 93%)', 'none'),
            ),
        ),
        'content' => '
[capitular]De Felipe Nuez, el precursor y con el que empezó todo, pasando por Sánchez Jover, la escuela argentina en los noventa con Quique Edelstein o Marcelo Giovanacci, el sello de la casa como Juanma Martín, siempre con nuevos logros para las vitrinas, hasta el desembarco absolutamente insuperable de Sergio Miguel Camarero, en tiempos estrella en la cancha y reciclado, de igual manera, a entrenador de aureola.[/capitular]

<p>Con él en el banquillo, ya desde la refundación en 2020, la lluvia de títulos ha sido incesante. Representante en su máxima expresión de los valores del Guaguas, implicación, compromiso, ambición y sacrificio como señas de identidad, a lo que Camarero añade de su cosecha el orgullo de pertenencia, algo que ya le caracterizó cuando incendiaba de pasión el Centro Insular con su conexión única con la grada.</p>

<p>Lo cierto es que la galería de preparadores en el medio siglo de vida del club luce ilustres que son inolvidables y de una contribución diferencial para que el equipo se haya convertido en un icono del voleibol español. Esta catarata de conquistas consagra unas líneas maestras en las que un denominador común salta a la vista: el perfil de hombre de la casa siempre se ha elevado y distinguido. Los mencionados ejemplos de Nuez, Sánchez Jover y Camarero constituyen un trío ineludible y que perdurará sin caducidad. Lo que significaron (y en el caso de Camarero todavía se conjuga en presente) ha marcado un camino de exigencia, profesionalidad y maestría sin igual, a la altura de la genética ganadora de la entidad. Si resultó irrepetible aquel tránsito de los ochenta a los noventa jalonada de épica y proezas, ya adentrados en el siglo XXI es Camarero, representante de la vieja guardia, el encargado de mantener la esencia y contagiarla a las nuevas generaciones. Y promete seguir, inasequible al desaliento y con la ambición por bandera.</p>

[bloque_lista_foto file="12cap_vuel_foto7.webp" alt="Sergio Miguel Camarero"]
[resaltado color_texto="hsl(220, 50%, 12%)"]Felipe Nuez[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Fidel Morales[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Sergio Hernández[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Paco Sánchez Jover[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Chava González<br>(interino en el verano de 1989)[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Robert Croteau[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Quique Edelstein[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Marcelo Giovanacci[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Juanma Martín[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Benjamín Vicedo[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]David Rodríguez[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Ángel Alonso[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Álvaro Bourousouzian[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Chema Sánchez[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Samuel Díaz[/resaltado]
[resaltado color_texto="hsl(220, 50%, 12%)"]Sergio Miguel Camarero[/resaltado]
[/bloque_lista_foto]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 13: DEL CID AL ARENAS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Del CID al Arena',
        'numero' => '13',
        'order' => 140,
        'show_marker' => true,
        'ref_id' => 'cap13',
        'hero' => array(
            'image'               => libro_img('13cap_cid_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'bottom center',
            'title_lines'         => array(
                libro_hero_line('DEL CID', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('AL ARENA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
<p>Primero fue en la cancha del colegio Calvo Sotelo de Las Rehoyas. Años setenta y transición a los ochenta. De ahí, al Obispo Frías y, luego, al pabellón García San Román, enclavado en el mismo barrio y entonces la mejor instalación cubierta de la capital hasta la inauguración, en 1988, del Centro Insular de Deportes (CID) de la Avenida Marítima.</p>

[ficha_debut titulo="LA FICHA DEL DEBUT"]
[equipo numero="3" nombre="CV GUAGUAS"]Pascal, Walla, Bruno, Ramos, De Amo, Rousseaux y Larrañaga. También jugaron: Trinidad, Moreno, Almansa, Nalobin y Pereira. <strong>Entrenador:</strong> Sergio Miguel Camarero.[/equipo]
[equipo numero="0" nombre="UNICAJA COSTA DE ALMERÍA"]González, Ruiz, Bertassoni, J. Fernández, Tarrazo, Todd y F.J. Fernández. También jugaron: Filip. <strong>Entrenador:</strong> Pablo Ruiz.[/equipo]
<hr class="ficha-tecnica-separador">
<p><strong>Parciales:</strong> 25-18, 25-18 y 25-10</p>
<p><strong>Árbitros:</strong> Fernández Fuentes y Sabroso Moratilla.</p>
<p><strong>Incidencias:</strong> Partido correspondiente a la XXVII Supercopa de España en la temporada 2024-25 disputado en el Gran Canaria Arena ante 2.700 espectadores.</p>
[/ficha_debut]

[imagen_contenido file="13cap_cid_foto3.jpg" fullwidth="true"]

<p>El Guaguas fue adecuándose a exigencias y nuevos tiempos en lo que se refiere a sus objetivos competitivos y, también, a los escenarios de sus partidos como anfitrión. A la par que su crecimiento, canchas más equipadas, como capacidad superior y aumento notorio de su visibilidad. De un enclave periférico en sus inicios, a establecer su casa en el corazón de la urbe con todo el impacto que eso conllevó. Y sin dejar, jamás, de prestigiar la apuesta municipal por buscarle un enclave que cubriera sus necesidades y merecimientos.</p>

[cita_editorial author="Juan Ruiz"]Desde el Guaguas siempre hemos agradecido los esfuerzos de Ayuntamiento y Cabildo por brindarnos el mejor escenario posible para nuestras competiciones. Nunca hemos tenido queja alguna y así lo hemos reconocido, sabiendo convivir, además, con otros clubes en la misma instalación y en un clima de absoluta colaboración.[/cita_editorial]

<p>El asentamiento prolongado y jalonado de triunfos, épica y títulos, en el año 2024 se produce un nuevo traslado y de un nivel superlativo: el Gran Canaria Arena. Las obras de remodelación en el Centro Insular obligaron a mudar todas las actividades que acogía a otros pabellones y ubicaciones. Y al Guaguas, como a otros equipos de la elite que allí tenían su punto neurálgico, le correspondió establecerse en el grandioso complejo del barrio de Siete Palmas, estrenado en 2014 y con unas condiciones logísticas incomparables. Gimnasio, vestuarios confortables, canchas auxiliares, salas multidisciplinares, amplios espacios para actos promocionales y comparecencias públicas... Otra dimensión, en suma, que redundaba, de manera directa, en la mejor preparación y rendimiento de los profesionales al disponer de todo lo necesario y más para el ejercicio de sus labores.</p>

<p>Además de una capacidad mayor, su accesibilidad y equipamientos llevaban al club a la modernidad. Porque, entre otras ventajas añadidas, también conllevó la apertura de unas oficinas más amplias de las que se disponían antes en el CID para desarrollar los trabajos administrativos y ejercer de sede oficial. Un mundo de ventajas que permitían un salto cualitativo indudable.</p>

[imagen_contenido file="13cap_cid_foto8.jpg" caption="Panorámica del Arena en el partido de Champions disputado entre Guaguas y Berlín el 12 de febrero de 2026 y que registró una entrada que superó los 5.000 espectadores." fullwidth="true"]

<p>El compromiso del Cabildo de Gran Canaria es el de devolver la actividad deportiva al Centro Insular cuando haya finalizado su completa remodelación, en torno a mediados de 2027 si se cumplen los plazos y previsiones. Mientras, la vida se está desarrollando en un entorno privilegiado y contribuyendo a diario en la expansión de la marca.</p>

<p>El destino quiso que el primer partido oficial del Guaguas en su nueva casa fuese una final de la Supercopa de España, otro título en juego, y que se saldó de la mejor manera. Fue el 28 de septiembre de 2024 y con un bautizo a pedir de boca. Triunfo claro y contundente por 3-0 al Almería y nuevo título para las vitrinas.</p>

[imagen_contenido file="13cap_cid_foto5.jpg" caption="Bufandas al viento de nuevas generaciones de aficionados del Guaguas, animando a su equipo en un partido como local."]

[cita_editorial]En una de esas en la que no puedes dormir, recordaba a tantas personas que han pasado por la vida del club, y a las que están ahora dando el callo, segundo a segundo. Ellos potencian el papel de un grupo de jugadores magníficos y que pueden crecer mucho aún. El éxito dura muy poco, te consume mucha energía, pero merece la pena por ver las caras de alegría de la gente.[/cita_editorial]

[imagen_contenido file="13cap_cid_foto2.jpg" caption="El debut oficial en el Gran Canaria Arena trajo la alegría de un nuevo título oficial, en este caso, la Supercopa de España 2024."]

[imagen_contenido file="13cap_cid_foto4.jpg" fullwidth="true"]

[imagen_contenido file="13cap_cid_foto6.jpg" caption="Los dirigentes Adolfo Rodríguez, Joselu Sánchez, Juan Ruiz, Antonio Benítez y Marek Szczesnowicz celebran sobre el parqué del Arena la gesta que supuso ganar al Berlín (3-1) en la Champions 2025-26."]

[imagen_contenido file="13cap_cid_foto1.jpg" caption="Argentina, bien presente en el Guaguas con Nico Bruno, el asistente Facundo Leal y Martín Ramos."]

[cita_editorial]Ganar la Supercopa en el Gran Canaria Arena es como abrir una nueva era para el Guaguas. Es un escenario moderno, repleto de posibilidades de crecimiento y desde el club quisiéramos agradecer el trato y el trabajo de los profesionales del Instituto Insular de Deportes, como ya le transmitimos al presidente Antonio Morales y al consejero Aridany Romero.[/cita_editorial]
',
    ),

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
            'height' => '600px',
            'title_lines' => array(libro_hero_line('LOS NUEVOS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('ÍDOLOS', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '[capitular]Una nueva generación de estrellas ha tomado el relevo en el Gran Canaria Arena. Los nuevos ídolos del Guaguas combinan talento internacional con la pasión local para escribir nuevos capítulos en la historia del club.[/capitular]
'),
    array('title' => 'Pablo Kukartsev', 'numero' => '', 'order' => 1461, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_kukartsev_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('PABLO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('KUKARTSEV', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]En el doblete de 2021, con Liga y Copa del Rey que no se daba desde 1994, el opuesto Pablo Kukartsev (Buenos Aires, 1993) fue una de las figuras más indiscutibles como prueba su designación como jugador más valioso de la temporada.[/capitular]

<p>&ldquo;Uno no busca distinciones individuales porque esto es un juego de equipo. Todo lo que conseguí en ese año se lo debo a mis compañeros, al trabajo que realizamos conjuntamente entre todos porque, aunque pudiera parecerlo, no fue nada fácil hacer lo que hicimos&rdquo;, apunta desde las filas del Almería, su destino profesional actual y del que, precisamente, llegó en el verano de 2020.</p>

<p>&ldquo;Me ofrecieron la oportunidad de jugar competiciones europeas, algo que no todos los clubes en España pueden hacer, además de formar parte de un proyecto muy ilusionante. Es cierto que sobrevolaba la incertidumbre de qué respuesta podría darse al ser un club que regresaba tras una larga ausencia. Encima la pandemia tampoco ayudaba al optimismo. De hecho, fui el primero de la plantilla en contraer el virus, con la incertidumbre que eso conllevaba. Pero pusieron mucho interés en mí, me convencieron con unas ideas ambiciosas. Desde mi entorno me apoyaron cuando me decidí a aceptar la oferta y, la verdad, desde el primer momento todo fue rodado&rdquo;, consigna.</p>

<p>Kukartsev opina que el grupo &ldquo;fue de diez a nivel profesional y humano&rdquo;, lo que terminó derivando en la cosecha de éxitos que se dio: &ldquo;No jugamos la Supercopa de España y en Europa caímos mucho antes de lo que merecíamos. Disputamos encuentros de máximo nivel, de los que a todo jugador le gusta tomar parte, llegamos a finales, las ganamos... No se puede pedir mucho más, la verdad. Disfruté, crecí, pude desarrollarme todo lo que esperaba. Merecimos lo logrado porque lo peleamos desde el primer entrenamiento y con toda la intensidad posible&rdquo;.</p>

<p>Y bien presente, pese al paso del tiempo, dos momentos elegidos: &ldquo;Cuando Javi me la colocó para hacer el punto ganador ante el Almería en la Liga y la definición de Hage en la Copa, que también valió el trofeo que nos llevamos. Es imposible olvidar esa alegría, la satisfacción de ver premiado tanto trabajo&rdquo;.</p>

<p>Además, se muestra como una persona agradecida al hacer balance de su única campaña, la 2020-21, defendiendo el escudo al que ayudó a volver a la cima: &ldquo;Al Guaguas siempre le voy a guardar cariño, respeto y admiración. Me trataron de maravilla y, a nivel personal, fue un tiempo de evolución constante. Mi balance es totalmente espectacular&rdquo;.</p>
'),

    array('title' => 'Moisés Cézar', 'numero' => '', 'order' => 1462, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_moisescezar_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('MOISÉS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('CÉZAR', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]En su primer año como jugador del Guaguas, brazalete de capitán y levantando hasta tres títulos: Copa, Liga y Supercopa. Todo, con diferencia de unos meses. &ldquo;Cada vez que me tocó ir a recoger un trofeo, las emociones fueron increíbles, únicas&rdquo;.[/capitular]

<p>El receptor brasileño Moisés Cézar (Belo Horizonte, 1983) ya había tenido una experiencia similar en el Almería, años atrás, acaparando todos los laureles nacionales. Pero hacerlo aquí, con la jerarquía que se le otorgó en virtud de su experiencia previa, tuvo &ldquo;un sabor especial&rdquo;, tal y como admite.</p>

<p>Después de tres temporadas en el Vecindario, la consigna que le dio Paco Sánchez Jover, su técnico en el conjunto sureño, le marcó a fuego: &ldquo;Me habló del proyecto de recuperar el Guaguas y me dijo que yo tenía que estar, que me quería con él. A Paco es imposible decirle que no. Y tampoco me lo pensé. Seguía en Gran Canaria, que es una tierra a la que me adapté muy bien y, encima, ya en el final de mi carrera, iba a poder formar parte de un equipo histórico, con aspiraciones. Todo me motivó mucho&rdquo;.</p>

<p>Cézar ya tenía referencias de lo que había significado el Guaguas décadas atrás, por lo que asumió con &ldquo;orgullo y responsabilidad&rdquo; la misión de liderar el grupo a las órdenes de Camarero, sabiendo que &ldquo;había que ir a por todas desde el primer momento&rdquo; para respetar, precisamente, la naturaleza de un proyecto diseñado para ganar.</p>

<p>&ldquo;Vine con una edad ya importante y me produjo una gran satisfacción jugar todos los partidos y poder darle mi mejor nivel al servicio de los compañeros. Creo que no dejé ninguna duda sobre la pista y, encima, tuve el privilegio de jugar con grandes personas, de enorme calidad humana y profesional. Eso fue clave. Y también el míster, que es otro ganador y ha hecho grupo en los momentos más complicados. Fuimos un equipo con todas las letras y eso explica tanto éxito&rdquo;, opina.</p>

<p>A nivel individual, no oculta que vestir el dorsal 5 también supone un guiño a la nostalgia: &ldquo;Fue el que llevó Paco y es un honor llevarlo en el Guaguas como hizo él. Me da un plus de fuerza, de energía. Otro motivo más para dar lo que llevo dentro en cada encuentro, en cada entrenamiento&rdquo;.</p>

<p>Centrado en &ldquo;continuar dando alegrías&rdquo;, pondera que la presencia gradual de público &ldquo;lo ha hecho todo más fácil&rdquo; tras muchos meses de compromisos a puerta cerrada por la pandemia: &ldquo;Jugar y ganar finales sin gente fue duro, aunque no quedaba otra opción. Nos acordamos de todos y brindamos cada copa por ellos. Ahora es una alegría poder competir con la fuerza que nos dan desde la grada y ojalá que todo siga yendo tan bien como hasta el momento. Y con la ilusión de mejorar en Europa y poder realizar una buena campaña en general. Es la exigencia que asumimos con la máxima profesionalidad&rdquo;.</p>
'),

    array('title' => 'Alejandro Fernández', 'numero' => '', 'order' => 1463, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_alejandro_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('ALEJANDRO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('FERNÁNDEZ', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Diez años fuera de Canarias y la oferta de regresar a una isla, Gran Canaria, que considera su casa, hicieron que Alejandro Fernández (La Laguna, 1987) sintiera un pellizco en el corazón al recibir la propuesta del Guaguas.[/capitular]

<p>&ldquo;Estaba en el Almería, con Hage o Almansa, y no nos faltaban alicientes deportivos. Pero el Guaguas es el Guaguas. La única manera de mejorar lo que tenía era estar aquí. Y más al saber los fichajes que se iban a realizar para que el proyecto tuviese la importancia que se quería. Ni me lo pensé&rdquo;, aclara.</p>

<p>El líbero tinerfeño, que se ha asentado como si llevara &ldquo;toda la vida&rdquo; a las órdenes de Camarero, opina que el actual Guaguas &ldquo;es la versión 2.0&rdquo; del legendario que se hizo un sitio en la leyenda con sus primeros títulos: &ldquo;Defendemos un escudo de un gran peso e importancia en el voleibol español y somos conscientes de esa gran responsabilidad. Particularmente, supone un privilegio estar aquí y dar continuidad a un legado tan importante. Cambian los tiempos, pero pervive el espíritu que hizo y hace a este club tan grande&rdquo;.</p>

<p>&ldquo;Cada día aumentan las ganas de seguir creciendo y dando alegrías al club y a la afición. Lo noto en todos los que formamos esta gran familia, dándonos siempre toda la fuerza que podemos. A lo largo de una temporada hay momentos buenos y menos buenos, pero disponemos de un vestuario comprometido y de una enorme calidad humana y profesional&rdquo;, añade.</p>

<p>Su condición de canario le añade &ldquo;un plus&rdquo;, tal y como confiesa, porque llevar a un equipo de la tierra a lo más alto, como ha podido experimentar, &ldquo;es algo inolvidable&rdquo;.</p>

<p>&ldquo;Cuando acepté afrontar este reto sabía que había que dar el máximo y, en lo posible, ganarlo todo&rdquo;, una misión que se ha ido cumpliendo, salvo alguna excepción, pero que en su balance individual le llena &ldquo;de satisfacción&rdquo;.</p>

<p>Para Alejandro, &ldquo;lo mejor está por venir&rdquo; porque, tras el triplete de 2021, &ldquo;se han sentado unas bases muy importantes con vistas a un futuro de igual competitividad, ambición y nivel&rdquo;.</p>

<p>De ahí que piense que la afición &ldquo;seguirá teniendo motivos para la ilusión&rdquo;, ya que el proyecto deportivo &ldquo;no parará de asentarse&rdquo; para poder mantener el escalafón adquirido y que, dice, &ldquo;es el propio del Guaguas, siempre en lo más alto&rdquo;.</p>
'),

    array('title' => 'Guilherme Hage', 'numero' => '', 'order' => 1464, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_hage_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('GUILHERME', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('HAGE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Cuando el Guaguas llamó a Guilherme Hage para incorporarlo a filas, en plena pandemia y tratándose de un jugador contrastado, sin necesidad de aventuras (&ldquo;en el Almería lo tenía todo&rdquo;), pocos creyeron en que tal gestión prosperaría.[/capitular]

<p>Pero tal fue la insistencia, que el jugador nacido en Araquara (Sao Paulo, Brasil) en 1988 se vio en la isla &ldquo;mucho antes de esperarlo&rdquo;, como reconoce. Y fue un flechazo, ni más ni menos. &ldquo;Me enamoré de esta tierra y del club nada más llegar. La sensación que tuve desde el primer momento era de que estaba justo donde quería, en el lugar exacto para mí y mi familia. Y eso me ayudó, indudablemente, a rendir, a responder a la confianza que puso Juan Ruiz en traerme. Un deportista necesita estabilidad dentro y fuera de la cancha y en el Guaguas encontré un equilibrio perfecto&rdquo;, explica. Y, por si fuera poco, títulos y honor a las primeras de cambio, lo que ya supuso el corolario perfecto.</p>

<p>&ldquo;Venía de un club ganador y, sinceramente, no esperaba que fuésemos a salir campeones de Liga y Copa en la primera campaña. Por supuesto que todos, y yo más que nadie, jugamos para ganar, para ser inconformistas y superarnos. Pero también hay que ser realistas. El Guaguas venía de muchos años sin competir al contrario que otros equipos que ya tenían una estructura mucho más consolidada y eso siempre da una ventaja. Ni eso nos pasó factura. Se juntó un grupo espectacular, los resultados acompañaron y fue muy especial culminar todo el trabajo y esfuerzo de esa manera, levantando trofeos... Demasiado especial diría yo&rdquo;, esgrime.</p>

<p>Hage admite que su personalidad y manera de ver la competición, &ldquo;que es la que tiene Sergio Camarero&rdquo;, le permitió encajar en un proyecto también de naturaleza ambiciosa como es el actual y en el que no entra en previsiones perder. &ldquo;Más gano y más quiero ganar. He tenido la suerte en mi carrera de llevarme muchas alegrías, pero soy de los jugadores que se acuerdan de todo al detalle. En el caso del Guaguas, de mi equipo, me preguntan por la Liga, la Copa o la Supercopa de España, los tres títulos que nos llevamos en el año 2021, y soy capaz hasta de recordar los puntos, de qué manera transcurrieron las finales... Porque eso es lo que queda luego, con el paso del tiempo. Las vivencias felices&rdquo;.</p>

<p>Y, aunque ha sido hasta la fecha año y medio de militancia, ni duda en expresar su &ldquo;enorme orgullo&rdquo; por haber dejado su nombre escrito en la historia del club. &ldquo;Me siento tan identificado con la institución, con los compañeros y con Gran Canaria que vivir este renacimiento del Guaguas y de esta manera tan bonita es algo que me completa a todos los niveles. Y quiero seguir escribiendo esta historia todo lo que pueda&rdquo;, finaliza.</p>
'),

    array('title' => 'Gustavo Delgado', 'numero' => '', 'order' => 1465, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_gustavo_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('GUSTAVO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('DELGADO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]La historia del Guaguas, esa tradición de lustre y prestigio que estaba de vuelta en 2020, fue el imán que atrajo al madrileño Gustavo Delgado (Móstoles, 1986) a alistarse al proyecto de reconstrucción desde las filas del Rennes francés.[/capitular]

<p>Una experiencia en sus inicios le ayudó a eliminar cualquier atisbo de dudas: &ldquo;Tendría 19 años cuando me enfrenté al Guaguas. Entonces el equipo no era el de los títulos de los noventa y estaba en un momento delicado, pero recuerdo que ya daba respeto tener enfrente a un club de tanto recorrido y éxitos. Y al llamarme Juan Ruiz para estar aquí, ese momento me vino a la cabeza. No podía dejar pasar la oportunidad de vestir esta camiseta&rdquo;.</p>

<p>Pese a que las lesiones le impidieron coger vuelo en su primera temporada, Gustavo se hizo un hueco en el corazón del Guaguas por su manera de implicarse desde fuera, ganándose la consideración de todos con un ejemplo de constancia, compañerismo y optimismo que caló en el vestuario. Ese empeño le ha permitido regresar a las pistas reciclado como líbero y con &ldquo;todas las ganas del mundo&rdquo; de ayudar como más le gusta, participando y sintiéndose actor de pleno derecho. &ldquo;Verlo todo desde fuera no es fácil, pero a mí me tocó aportar cuando no estuve apto y, tanto cuando ganamos la Copa como la Liga, tengo que agradecer a compañeros, técnicos y dirigentes que me permitieran vivir esos triunfos con toda la intensidad posible. Fue muy especial&rdquo;, valora.</p>

<p>Considera que el año y medio transcurrido tras la refundación &ldquo;ha sido espectacular&rdquo; desde el punto de vista competitivo porque, pondera, &ldquo;no es nada fácil ganar tres títulos en un año, como se hizo en 2021&rdquo;, logro que, según su opinión, &ldquo;terminará valorándose como se debe con el paso del tiempo&rdquo;.</p>

<p>&ldquo;Creo que todo ha ido más rápido de lo que podíamos esperar. Nos queda llegar lejos en Europa, que son palabras mayores porque hablamos de un escenario en el que hay clubes de un potencial bestial y, de momento, diría que inalcanzable para nosotros. Pero esto es el Guaguas y aquí vivimos de desafíos y tratar de superarnos en todo. Si ganamos, hay que seguir igual. Y si perdemos, porque no siempre todo son triunfos, estamos obligados a levantarnos de inmediato&rdquo;, matiza.</p>

<p>Delgado no duda en asegurar que para él supone &ldquo;un orgullo&rdquo; poder decir, en un futuro, que durante su etapa profesional perteneció a esta entidad que califica como &ldquo;única en todos los sentidos&rdquo;.</p>
'),

    array('title' => 'Jorge Almansa', 'numero' => '', 'order' => 1466, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_almansa_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('JORGE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('ALMANSA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Jorge Almansa (Cartagena, 1991) llevaba diez años en el Almería, era el capitán y emblema, tenía todas las consideraciones posibles como uno de los receptores de máximo nivel a escala nacional. Por si fuera poco, factores de índole personal, ya a punto de estrenar paternidad, le invitaban &ldquo;muy poco&rdquo; a cambiar de aires.[/capitular]

<p>Le rompieron los esquemas &ldquo;para bien&rdquo; cuando, desde el Guaguas, le lanzaron el reto de unirse a Sergio Camarero y sus muchachos. &ldquo;Me supieron ilusionar, me hablaron de una manera que me conmovió y me llegó al fondo. Tanto es así que pasé de pensármelo a hacer las maletas en muy poco tiempo. Encima tuve la promesa, que se cumplió totalmente, de que tendría el apoyo que necesitaba para que mi familia pudiese estar bien en Gran Canaria. Y ahora, con el paso del tiempo, puedo decir que tomé la mejor decisión posible&rdquo;, argumenta.</p>

<p>Su pasado laureado con otros colores lo ha actualizado ahora de amarillo y acumulando más títulos pese a que, advierte, &ldquo;si salir campeón una vez ya es complicado, hacerlo tres veces en el mismo año entra directamente en un nivel de dificultad tremendo&rdquo;.</p>

<p>&ldquo;Fue duro, muy duro, no poder disfrutar de la afición cuando, por la pandemia, los partidos no admitían público. Uno no se acostumbra a pabellones vacíos, a levantar un título sin nadie en las gradas. Por suerte, todo ha ido evolucionando mejor, y, en este sentido, para los que venimos de fuera también ha resultado una experiencia muy bonita sentir la manera de animar y empujar de la afición del Guaguas. En muchos momentos nos ha ayudado y estamos muy responsabilizados en seguir dándoles las mayores satisfacciones posibles&rdquo;, dice.</p>

<p>Almansa ve &ldquo;una base sólida y fuerte&rdquo; para que en el futuro se sigan sucediendo los éxitos y se percata de un factor esencial para dar continuidad a la buena línea exhibida: la implicación. &ldquo;Todos los que formamos parte del equipo tenemos muy claro lo que tenemos que dar, lo que debemos ofrecer, sin escatimar en ningún momento esfuerzo, sacrificio y trabajo. Hay una cultura muy definida en todos nosotros para entrenar a tope y tratar de competir siempre de la misma manera. No vas a ganar cada semana. Eso es imposible y menos con un calendario tan cargado como el que hemos tenido, con viajes complicados por la competición europea y sin apenas tiempo, muchas veces, para el descanso y la recuperación. Pero nunca hay excusas y perder siempre debe dolernos muchísimo. Nuestro entrenador así nos lo ha inculcado y así lo hemos asumido. Y no nos ha ido mal&rdquo;.</p>
'),

    array('title' => 'Matt Knigge', 'numero' => '', 'order' => 1467, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_knigge_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'bottom center',
            'title_lines' => array(libro_hero_line('MATT', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('KNIGGE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]&ldquo;Cuando pruebas el sabor de ganar, el sabor de ser campeón, no quieres otro. Y trabajas y haces todo lo posible para que no se acabe. En el Guaguas se sigue la misma filosofía y es la que se adapta a mi manera de vivir el deporte y el voleibol&rdquo;.[/capitular]

<p>El central norteamericano Matt Knigge (Nueva Jersey, 1996) cambió el reconocimiento que tenía en Lugo, su anterior club en el campeonato español, por el órdago que se le abría en un equipo &ldquo;en el que no vale ser segundo&rdquo;. Y en el momento de repasar todo lo vivido aquí (&ldquo;la isla es increíble, me encanta la gente, me siento muy integrado y feliz en el equipo y se han conquistado, hasta la fecha, tres títulos de cinco posibles&rdquo;), el balance le hace esbozar una sonrisa. &ldquo;No puedo pedir más&rdquo;, sintetiza.</p>

<p>Knigge pronto percibió que el Guaguas era &ldquo;el sitio perfecto&rdquo; para que pudiera alcanzar la plenitud con su fortaleza física y disfrutar, como no ha parado de hacer, en compañía del resto. &ldquo;Encontré un equipo increíble y no puedo dejar de tener ganas siempre de venir al pabellón a entrenar y a jugar. Es un privilegio tener la oportunidad de estar con este grupo porque sientes que hay una calidad superior&rdquo;, matiza.</p>

<p>Guarda un recuerdo &ldquo;impresionante&rdquo; de cada uno de los títulos que ganó con la camiseta amarilla, si bien la Copa de 2021, la que inició el ciclo actual, tiene un lugar especial en su memoria. &ldquo;El formato de la Copa, con todo concentrado en tres días, mucha adrenalina y sabiendo que si pierdes quedas eliminado, le da un valor tremendo a la Copa. La que ganamos al Palma fue un partidazo y nos dio un subidón tremendo que, luego, también ayudó a que nos lleváramos la Liga. Fue el principio de todo y hay que reconocerlo así&rdquo;, valora.</p>

<p>Para lo que viene, lo tiene claro: mantener la filosofía que persigue la excelencia. &ldquo;Levantas un trofeo y ya piensas en el próximo. Vienes a un entrenamiento y sabes que o das todo o no juegas. Ganas un partido y sabes que tienes la obligación de volver a ganar el próximo. Pero eso es lo que queremos todos los que estamos aquí, no nos quedamos sentados a mirar lo que hemos hecho. Si no fuera así, no seríamos el Guaguas. Siempre nos pedimos más y más. Y pensamos continuar de la misma manera&rdquo;. Y todo porque, como Matt recalca, &ldquo;es muy fácil sentirse comprometido con estos colores&rdquo;. En su caso, además, &ldquo;en cada día y en cada partido&rdquo;.</p>
'),

    array('title' => 'Paulo Renan', 'numero' => '', 'order' => 1468, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_renan_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('PAULO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('RENAN', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Portugal, Grecia, Italia y, claro está, su Brasil natal. Nunca había podido jugar en un club español Paulo Renan (Curitiba, 1985) hasta que desde Gran Canaria le echaron el lazo.[/capitular]

<p>&ldquo;Siempre tuve ganas de competir aquí y no me lo pensé mucho. Estaba en mi país y me gustó el reto de volver a salir al extranjero y demostrar mis condiciones como colocador. El Guaguas me pareció un desafío perfecto y, después de todo lo que se ha hecho desde 2020, desde luego que me reafirmo en aquel pensamiento que tuve&rdquo;, reconoce.</p>

<p>Fue llegar y darse cuenta de que aquí se daba la actitud con la que siempre se sintió identificado. Vio que, con la mano magistral de Sergio Camarero, &ldquo;hay un espíritu de lucha tremendo&rdquo;, lo que casa con la electricidad que siempre le ha sido característica.</p>

<p>&ldquo;Vivo este deporte con muchísima pasión, con intensidad siempre, esté jugando o fuera esperando una oportunidad. Y me encanta sentir que esa manera de desarrollar mi profesión es la misma que quiere nuestro entrenador. No valgo para salir a ver qué pasa. Salgo a ganar, a dejarme todo lo que llevo dentro. Creo, además, que esa ha sido la clave de que hayamos ganado tantos títulos en este tiempo. Y, sin duda, será igualmente fundamental para que sigan llegando&rdquo;, opina.</p>

<p>Renan se considera &ldquo;un jugador de equipo y para el equipo&rdquo; y que no tiene otro propósito que el de ser &ldquo;útil a los compañeros&rdquo;, al entender que en el voleibol &ldquo;debe primar el interés colectivo&rdquo;, y asegura &ldquo;ser feliz&rdquo; cuando un esfuerzo suyo &ldquo;se convierte en punto para todos&rdquo;.</p>

<p>&ldquo;Quiero que se me relacione con ese tipo de jugador que está para servir y ayudar. Además, por mi función específica siempre tengo la prioridad de dejar al compañero la mejor disposición posible para su remate&rdquo;, añade.</p>

<p>Que tenga varios compatriotas en la plantilla como Hage o Cézar lo celebra porque &ldquo;siempre es positivo&rdquo; a la hora de agilizar una integración que ha sido perfecta, ya que tanto su mujer e hija &ldquo;se han adaptado a las mil maravillas en el idioma, las costumbres y la vida en Gran Canaria, donde todo es muy sencillo para vivir bien&rdquo;.</p>

<p>La Liga ganada en 2021 fue la primera de su palmarés (&ldquo;conquisté otros títulos, pero nunca un campeonato regular hasta llegar al Guaguas&rdquo;), por lo que elige esa final ganada al Almería como un momento &ldquo;de gran felicidad&rdquo; en su historia con el equipo grancanario. Aunque no se conforma con lo vivido. &ldquo;En el deporte siempre importa lo que viene. Y espero que sean más éxitos aquí&rdquo;, pide.</p>
'),

    array('title' => 'Paolo Zonca', 'numero' => '', 'order' => 1469, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_paolozonca_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('PAOLO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('ZONCA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]El receptor italiano Paolo Zonca (Gorizia, 1997) pasó como un trueno por el Guaguas. Decisivo en sus dos temporadas (2022-2024) en la consecución de cinco títulos, con dos Superligas, una Copa del Rey, una Supercopa de España y una Copa Ibérica como legado visible, su impacto resultó incuestionable en el ciclo reciente plagado de laureles.[/capitular]

<p>Figura dentro de la cancha, con jerarquía, ambición y compromiso, su adaptación al club y a la vida en Gran Canaria resultó excepcional, lo que engrandeció más su figura si cabe. Le encantaba la vida en la isla, de hecho no dudaba en pasar sus vacaciones sin moverse de aquí, y presumía de ser el mejor embajador posible de cara al exterior al presumir de una tierra &ldquo;especial, preciosa y única&rdquo;, como repetía a modo de identificación plena.</p>

[cita_editorial]Siempre he estado muy a gusto en la cancha, la gente lo ve y yo intento demostrar mis emociones con la afición en cada partido, y eso me permite subir el nivel. Noto como la gente me quiere, como celebra cada uno de mis puntos, eso me ayuda para estar focalizado en mi juego, con el fin de hacer más puntos y poder dedicarles la victoria en cada partido. No soy grancanario, ni español, pero lo que quiere lograr el Guaguas tanto en España como en Europa encaja a la perfección con mi pensamiento y con la forma que tengo de vivir el voleibol cada día.[/cita_editorial]

<p>Cuando Juan Ruiz lo fichó desde el campeonato francés sabía que era una apuesta sobre seguro y que, como así pasó, resultaría muy complicado poder retenerle ante su magnitud y carisma, pero el tiempo de militancia en el Guaguas le hizo ganarse, por derecho propio, un lugar entre los grandes que han defendido su camiseta. Zonca consideró &ldquo;un honor&rdquo; su paso por el club por todo lo que significó en su vida deportiva y personal y, de igual manera, dejó un recuerdo imborrable por su contribución a la historia de la entidad y a enriquecer al vestuario a base de profesionalidad y valores de todo tipo.</p>
'),

    array('title' => 'Martín Ramos', 'numero' => '', 'order' => 1470, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_martinramos_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('MARTÍN', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('RAMOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Pese a que tenía un palmarés envidiable, con una medalla olímpica en Río de Janeiro 2016 como guinda, Martín Ramos (Buenos Aires, 1991) sintió el deseo de unir su historia exitosa a la del Guaguas, otro paradigma de triunfos, y no dudó en aceptar el reto que le pusieron encima de la mesa en el verano de 2022.[/capitular]

<p>Y la intuición que tuvo de que ese era el inicio de un ciclo de conquistas no ha parado de cumplirse desde entonces porque la cosecha de títulos y de alegrías se ha sucedido sin fin, consecuencia lógica de un binomio imparable, el que forma con el club y, también, de que haya podido encontrar un sitio ideal para, en la madurez de su carrera, sacar a relucir toda su potencia y poder en la pista.</p>

<p>El central argentino, desde el comienzo adaptado al Guaguas &ldquo;como si llevara toda una vida&rdquo; en la disciplina isleña, ha sido parte activa de las campañas plagadas de logros que ha vivido en carne propia y con su compatriota Nico Bruno como uno de sus aliados infalibles. &ldquo;A los centrales nos pide que seamos muy protagonistas en el ataque, y estoy adaptándome a eso. Yo me siento un central atacante, por lo que me gusta que el entrenador piense así y que me pida eso&rdquo;. Así define su estilo y que encaja plenamente con lo que busca Camarero en sus jugadores: arrojo, valentía, sacrificio y orgullo además de la calidad que no se discute.</p>

[cita_editorial]Me gusta formar parte del equipo al que todos quieren ganar. Voy a seguir en el club, he renovado por dos años más con la entidad. Me encuentro muy feliz en Gran Canaria, con su gente y con la política del equipo. Es un orgullo formar parte de esta familia, los compañeros de vestuario ya son parte de mi vida diaria.[/cita_editorial]

<p>Feliz tras rubricar su contrato hasta 2027 y como muestra inequívoca de que, océano Atlántico de por medio del lugar que le vio nacer, aquí está su sitio. Y como estandarte del Guaguas, puntual a su cita en los momentos culminantes de las finales y partidos más importantes, va a continuar aportando su sello distinguido para que las victorias y los elogios marquen el paso y jalonen una senda en la que ha sido partícipe como el que más.</p>
'),

    array('title' => 'Io de Amo', 'numero' => '', 'order' => 1471, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_ioamo_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('IO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('DE AMO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]&ldquo;Mi padre fue jugador del Atlético de Madrid de voleibol y coincidió con este club en sus inicios. Soy consciente de todo lo que ha significado el Guaguas en el voleibol español y ese fue uno de los motivos que me hicieron regresar desde el extranjero&rdquo;.[/capitular]

<p>Miguel Ángel de Amo, Io, (Madrid, 1985) sabía bien el destino que elegía para volver a España después de consagrarse en Eslovaquia y Chequia con experiencias que le apuntalaron más si cabe una hoja de servicios privilegiada, con infinidad de títulos y medallas tanto en la pista como sobre la arena en sus incursiones en el vóley-playa. Juan Ruiz llevaba tras su pista largo tiempo y fue en 2022 cuando, al fin, pudo captarlo para importar su sapiencia, destreza y maestría como colocador.</p>

<p>&ldquo;Vine para unirme a un proyecto ganador y, también, para poner al servicio del vestuario mis vivencias, mis años de jugador en muchos clubes. Ayudar a unir a los compañeros, a generar el clima interno que siempre es fundamental, es una labor que asumí con naturalidad y en la que he tratado de aportar todo lo que sé&rdquo;, reconocía en sus inicios, asimilando con profesionalidad su rol de veterano.</p>

<p>Pero esa tarea de ser el pegamento interno ha evolucionado hasta convertirle en un referente, a la altura de un grande como Jorge Almansa y recordando, por su influencia, carácter y prestaciones a otros capitanes históricos como Camarero o Sánchez Jover.</p>

<p>Ganador nato y guía para sus compañeros, en el club lo tienen como una pieza esencial, consideración que comparte el cuerpo técnico por la ejemplaridad que ofrece en todo, ya sean entrenamientos, partidos o actos promocionales. Y todo, sin perder competitividad y manteniendo un listón de intensidad y exigencia que le hacen único, ya sobrepasados los 40 años pero con una manera de entender la profesión que explica la impresionante trayectoria que tiene a sus espaldas. Y siempre con la premisa de que continuará, porque cada título que logra con el Guaguas activa, para él, la cuenta atrás para el siguiente. Insaciable, Io de Amo representa como pocos los valores históricos de una camiseta que ha ayudado a seguir engrandeciendo.</p>
'),

    array('title' => 'Nico Bruno', 'numero' => '', 'order' => 1472, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_nicobruno_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('NICO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('BRUNO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Otro exponente más de la raza argentina y de la pasión con la que entienden allí el deporte, convertido casi siempre en una cuestión de vida o muerte. Así se desempeña y juega Nico Bruno (Buenos Aires, 1989), receptor que recaló en el club en 2023.[/capitular]

<p>Brasil, Italia, Bélgica y Turquía, además de su país natal, habían sido escenarios de su imparable ascensión y, tras ser proclamado cuatro veces mejor jugador del campeonato otomano, con lo que eso conlleva, su siguiente paso exigía más excelencia. &ldquo;El Guaguas es el mejor equipo de la liga española, el presidente me trasladó la idea de seguir cosechando títulos y dar un salto de calidad en Europa. Era una propuesta ambiciosa y me interesó sumarme al proyecto&rdquo;, explicaba al argumentar su dirección a Gran Canaria pese a disponer de propuestas que, en términos económicos, mejoraban la realizada por Juan Ruiz.</p>

<p>No le importó ceder ahí al anteponer la exclusividad profesional que otorgaba unirse a un representativo único, anclado en la cima y que, temporada a temporada, va a por todas sin discriminar competición o adversarios. Competir y ganar como modus vivendi.</p>

[cita_editorial]Tenemos una seña de identidad muy marcada, es la de siempre querer ganar. En lo personal, he tenido partidos en los que me he llevado más puntos y otros en los que he podido contribuir en defensa o en recepción. Lo principal es ganar como equipo, las actuaciones individuales quedan en segundo plano.[/cita_editorial]

<p>Bruno es, además, un vínculo de unión reconocible con la grada por el desempeño que juega en conectar al equipo con el aficionado y, en efecto camaleónico, se crece en ambientes adversos. La cualidad de rendir con presión no abunda y en el caso de Nico Bruno constituye una de sus grandes divisas, lo que le hace indispensable a ojos de Camarero y ejerce de recurso infalible para sus compañeros. Vino para seguir haciendo historia y siempre pensando en lo que viene.</p>
'),

    array('title' => 'Unai Larrañaga', 'numero' => '', 'order' => 1473, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_larranaga_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('UNAI', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('LARRAÑAGA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Eficiencia silenciosa, no siempre espectacular pero, invariablemente, valiosísima para el rendimiento y los resultados del equipo. Es el perfil de Unai Larrañaga (Dumbría, La Coruña, 2000), desde 2023 componente esencial del mecanismo de funcionamiento pluscuamperfecto del Guaguas desde su posición estratégica e infalible.[/capitular]

<p>Curtido en el voleibol nacional, con paso por Arenal Emeve, Santanderina y Melilla, y con la condición de fijo en la selección española, en el club hubo unanimidad a la hora de valorar su incorporación, con el añadido de aumentar la cuota española del plantel, aspecto siempre bienvenido y que no se descuida. Larrañaga encajó desde el primer momento con la naturalidad que tienen los grandes.</p>

[cita_editorial]Soy un jugador muy tranquilo pero, a la vez, apasionado. En la pista lo doy todo y, en mi faceta defensiva, trato de poner al servicio de los compañeros lo mejor de mí. Me gusta competir, ganar, afrontar cada partido al máximo.[/cita_editorial]

<p>Desde esa serenidad para leer todas las situaciones y aportar su riqueza táctica se hace omnipresente su figura para que todo funcione de manera armónica y precisa. &ldquo;Fue algo muy especial sentir el interés del Guaguas. Cuando te llama el Guaguas sabes que es un desafío que tienes que aceptar como sea. Reconozco que no esperaba que me llegara tan pronto esta oportunidad. Es verdad que llevo rindiendo a buen nivel varios años y que estar en la selección española siempre te da un valor especial. Pero me veía en el Guaguas en una o dos temporadas más&rdquo;, reconoce a propósito de esa llamada que le cambió la vida y le ha permitido levantar títulos, hacerse más visible a todas las escalas.</p>

<p>Querido y respetado por su carácter cercano, poco a poco se ha labrado la relevancia que ahora nadie cuestiona dentro del grupo. Sergio Miguel Camarero ve en él, como en Io de Amo, una mente precisa para canalizar talento y fuerza, cualidades que abundan en la plantilla. &ldquo;Sé que pertenezco a un club en el que no hay excusas. Eso me gusta y me motiva&rdquo;, se congratula el líbero gallego que llegó para quedarse y construir, con el resto, un Guaguas más y más grande.</p>
'),

    array('title' => 'Walla Souza', 'numero' => '', 'order' => 1474, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_walla_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'bottom center',
            'title_lines' => array(libro_hero_line('WALLA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('SOUZA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Fue en julio de 2023. Llegaba con 33 años y con la competencia abierta en la demarcación de opuesto con el colombiano Juan Pablo Moreno. Pocos preveían lo que venía en camino con el fichaje del brasileño Francisco Wallysson Souza, Walla (Jaguaribe, 1990).[/capitular]

<p>&ldquo;Creo firmemente que estaremos enfocados en nuestro principal objetivo, que es conquistar títulos. No solo yo, sino todo el equipo estará entregado al 100% para brindar a nuestros aficionados una temporada memorable, culminando con más de un título para nuestro club&rdquo;, declaraba en sus primeras palabras como componente del equipo.</p>

<p>Recuerdan en el club que desde sus primeros entrenamientos no solo confirmó las mejores referencias. También impresionó por su potencia y precisión en la ejecución de remates. Un espectáculo verlo reventar, literalmente, la pelota, práctica que le ha hecho célebre ya en la competición oficial convirtiéndole en una auténtica máquina de hacer puntos, promediando en algunos tramos del calendario más de veinte y llegando a picos de hasta 28 (sumó la friolera de 171 en los últimos ocho encuentros de la temporada 2024-2025 como ejemplo ilustrativo de su voracidad). Saques directos, diagonales, en bloqueos... Un repertorio infinito el suyo para convertirse en elemento indefendible para los contrarios y diferenciador y decisivo en los intereses propios.</p>

[cita_editorial]Me gusta que se espere todo de mí. Sabes que en el Guaguas hay que ganarlo todo y eso hace que te exijas cada día para dar el máximo. A mí me gusta la presión, jugar para ganar, para conseguir cosas importantes. Todo jugador quiere estar siempre con metas importantes por cumplir y eso es lo que busco, por eso estoy tan contento y adaptado al Guaguas. La mentalidad de este club es la mentalidad que siempre he tenido yo. No hay día en el que no quiera ganar y dar lo mejor de mí en todos los partidos. Siempre trato de mantenerme enfocado en los entrenamientos y luego ponerlos en práctica de la mejor manera posible. El golpeo de balón que tengo es muy fuerte. Los potentes remates a campo rival podrían ser una de mis virtudes técnicas.[/cita_editorial]
'),

    array('title' => 'Tomas Rousseaux', 'numero' => '', 'order' => 1475, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_rousseaux_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'center center',
            'title_lines' => array(libro_hero_line('TOMAS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('ROUSSEAUX', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]Un internacional belga procedente de Arabia Saudí, en la mejor etapa de su carrera y con disposición de dar lo mejor de su experiencia y valía en favor de la causa. Eso fue lo que se aseguró el Guaguas cuando en 2024, y tras la repentina marcha del italiano Paolo Zonca, analizó el mercado y se decantó por Tomas Rousseaux.[/capitular]

[cita_editorial]El compromiso del club con la excelencia y su entorno de apoyo a los jugadores fueron factores clave. Además, la oportunidad de trabajar con su experimentado cuerpo técnico y unirme a un equipo con una cultura ganadora hizo que la decisión fuera fácil para mí.[/cita_editorial]

<p>El receptor, ya con paso triunfal por campeonatos tan reputados como los de Italia, Alemania, Polonia o Grecia, no pudo tener una adaptación más satisfactoria porque en el primer año de militancia fue actor destacado del triplete de títulos nacionales (Superliga, Copa del Rey y Supercopa de España), dándole forma a su más que merecida renovación.</p>

[cita_editorial]En cada partido intento dejar el ego de lado y evaluar lo que el juego me está ofreciendo, porque cada partido es diferente. Hago lo que sea necesario para ganar en grupo. También intento aportar mucha energía positiva y apoyo a mis compañeros, porque para mí es algo natural sonreír y disfrutar. Cada partido es estresante, pero no querríamos que fuera de otra manera porque ganar tiene su sacrificio.[/cita_editorial]

<p>El saber estar que siempre luce, tenga mayor o menor protagonismo, y una concentración extrema que le hace aprovechar al máximo sus oportunidades siendo diferencial y dejando sello. Es lo que valora de manera especial Sergio Miguel Camarero a la hora de poder tirar de un jugador cerebral, con capacidad para decidir y que, acostumbrado a la presión, maneja como nadie los tiempos.</p>

<p>Por eso y por mucho más se ha ganado Rousseaux un lugar en la galería de los mejores del Guaguas, siempre con una sonrisa contagiosa para hacer grupo, hombre de vestuario como es, pero sin renunciar nunca a esa ambición competitiva que le trajo a Gran Canaria desde el lejano Oriente y para seguir aumentando su figura e influencia.</p>
'),

    array('title' => 'Osmany Juantorena', 'numero' => '', 'order' => 1476, 'show_marker' => false, 'parent_ref' => 'cap14',
        'hero' => array(
            'image' => libro_img('14cap_juantorena_hero.jpg'),
            'overlay' => 'rgba(0,0,0,0.25)',
            'icon' => 'none',
            'alignment' => 'center',
            'vertical' => 'center',
            'height' => '600px',
            'background_position' => 'top center',
            'title_lines' => array(libro_hero_line('OSMANY', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'), libro_hero_line('JUANTORENA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black')),
        ),
        'content' => '
[capitular]La noticia del fichaje de Osmany Juantorena (Santiago de Cuba, 1985) por el Guaguas en el verano de 2025 fue una bomba informativa en toda regla por lo que suponía unir a una plantilla que lo había ganado todo el curso anterior un campeón de primer calibre.[/capitular]

<p>El receptor cubano, con un palmarés plagado de títulos y condecoraciones, incluyendo medallas en Olimpiadas, Europeos y Mundiales a nivel de selecciones, venía a apuntalar un proyecto estelar con su incuestionable liderazgo, calidad y experiencia. &ldquo;Es un milagro que hayamos podido traerlo&rdquo;, significaba el presidente Juan Ruiz tras certificar su incorporación y dar cuenta de la dimensión que implicaba.</p>

[cita_editorial]Tuve varias ofertas y elegí al Guaguas con la idea de ganar nuevamente y seguir contribuyendo al éxito del equipo. No conozco la Superliga más allá de conocer al CV Guaguas por su participación en Europa, pero tengo curiosidad de saber el nivel que existe y competir al máximo.[/cita_editorial]

<p>Muy pronto se encargó Osmany de justificar todos los esfuerzos realizados por él porque, a su inmediata adaptación al vestuario y a la vida en Gran Canaria, añadió en la cancha esa cuota diferencial que es exclusiva de su figura. Venía de un tiempo marcado por las lesiones y espantó a las primeras de cambio cualquier incógnita al respecto con una implicación ejemplar.</p>

<p>Compañeros y cuerpo técnico se vieron enriquecidos por un aporte que iba más allá del rendimiento, pues carisma, personalidad y sentido de pertenencia ampliaban el catálogo de prestaciones. En la marcha triunfal del Guaguas 2025-26 ha tenido un papel indiscutible, con actuaciones sobresalientes en partidos señalados, léase la final de la Supercopa de España ganada en Valladolid a final de año o en citas de la Champions, con especial hincapié en la celebrada victoria frente al Berlín en el Arena, que puso los cimientos para la clasificación posterior a los octavos de final. Y, por si fuera poco, una conexión especial con la grada, sensible como es al factor ambiental. Sin duda, un acierto mayúsculo el de su ciclo de amarillo.</p>
'),

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
            'image'               => libro_img('15cap_impa_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'center center',
            'title_lines'         => array(
                libro_hero_line('EL IMPACTO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('DEL ESCUDO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]La relevancia social del CV Guaguas, proyecto deportivo en su génesis y actor ineludible de la vida global de Gran Canaria, no ha parado de crecer, consolidarse y enraizar. Es un logro añadido más, congraciando tradición, presente y alcance multidisciplinar.[/capitular]

<p>Y es que el club ha sido puesto como ejemplo en diversos ámbitos, no todos relacionados de manera directa con el deporte, por lo que inspira en cuanto a su genética ganadora, ejemplo de continuidad en la cima y carácter representativo, con una gestión eficaz y autosuficiente y un compromiso rotundo con la tierra que representa.</p>

[cita_editorial author="Juan Ruiz"]En los años en los que el Guaguas no compitió, tras su desaparición, y hasta que en 2020 retomamos el proyecto, la gente no paraba de preguntar y de desear que volviéramos. Eso habla del lugar que nos habíamos ganado y que no se resintió pese a una larga ausencia. Le faltaba algo al deporte canario y era el Guaguas.[/cita_editorial]

<p>Destaca el presidente Juan Ruiz a propósito de ese vacío ya felizmente cubierto y que dimensionó la altura de la institución.</p>

<p>La presencia y eco del Guaguas, privilegio ganado a pulso por títulos, competitividad y arraigo, le han granjeado apoyos empresariales y de orden público, a través de las correspondientes subvenciones, para su sostenibilidad, si bien dos de estos pilares se destacan por su enjundia y valor histórico: la empresa municipal de transporte público de la ciudad de Las Palmas de Gran Canaria, Guaguas Municipales, cuyo vínculo con el club se remonta a la década de los ochenta y al que se debe la nomenclatura actual y más reconocible del equipo, y el Gobierno de Canarias, la máxima autoridad política en la región y que ha brindado, de igual manera, un apoyo valioso y decidido al proyecto.</p>

[cita_editorial author="Juan Ruiz"]No tenemos ninguna queja de los organismos que nos dirigen. Todo lo contrario. Nos han brindado su colaboración, su reconocimiento y atención. Gobierno de Canarias, Cabildo de Gran Canaria y Ayuntamiento de Las Palmas de Gran Canaria. No me olvido de las federaciones, tanto de Canarias como la Nacional. Por nuestra parte, todo son agradecimientos por la sensibilidad que recibimos, pero en los casos de Guaguas Municipales y del Gobierno de Canarias consideramos que, por rango y antigüedad, un capítulo especial.[/cita_editorial]

<p>Así lo revela Ruiz.</p>

[seccion_header]José Eduardo Ramírez — Presidente de Guaguas Municipales[/seccion_header]

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

[seccion_header]Ángel Sabroso — Viceconsejero de Deportes del Gobierno de Canarias[/seccion_header]

<p>Por su parte, Ángel Sabroso, viceconsejero de Deportes del Gobierno de Canarias luego de una brillantísima carrera como árbitro internacional de balonmano, con presencia en Olimpiadas, Mundiales, y Europeos, así valora esta alianza.</p>

<p><strong>¿Qué calado tiene para el deporte y la sociedad canaria la catarata de éxitos deportivos del Guaguas según su óptica como viceconsejero de Deportes del Gobierno de Canarias?</strong></p>

<p>El Guaguas es mucho más que un equipo que gana; es una declaración de intenciones del deporte canario. Sus triunfos nos recuerdan que, desde unas islas en medio del Atlántico, también se puede tocar el cielo si se trabaja con método, pasión y orgullo de pertenencia. Cada título del Guaguas es una bandera que ondea por todos los canarios, una prueba de que el talento, la organización y sobre todo la pasión, pueden vencer a cualquier frontera, incluida la geográfica. Lo que este club ha conseguido en los últimos años no solo dignifica a la Superliga o a Canarias, sino que inspira a cientos de jóvenes que encuentran en el deporte una escuela de vida y en su equipo un espejo donde mirarse.</p>

<p><strong>Siempre fue un hombre de deporte. ¿Normalizar esta racha triunfal no es desmerecerla por la complejidad que tiene ganar títulos cada temporada?</strong></p>

<p>Sin duda. Ganar una vez puede ser fruto de la inspiración; ganar siempre solo lo consigue quien convierte la excelencia en hábito. El Guaguas ha logrado algo que en el deporte es rarísimo: que el éxito parezca natural sin dejar de ser heroico. Porque detrás de cada copa hay horas de entrenamiento, planificación, humildad y un vestuario que funciona como familia. Normalizar sus victorias sería tan injusto como olvidar lo difícil que es mantenerse en la cima sin perder el alma. Y eso, precisamente, es lo que el Guaguas está consiguiendo; competir con grandeza y con valores.</p>

<p><strong>El Guaguas es el club más laureado de Canarias y ejerce de embajador histórico por Europa, con participaciones en torneos continentales desde los ochenta. Ahora que se analizan los modelos de gestión, ¿hay aquí uno de referencia por la regularidad y solvencia del mismo?</strong></p>

<p>Así lo creo, porque el Guaguas representa un modelo de gestión que combina raíces y modernidad. Una institución que aprendió a profesionalizarse sin perder su identidad canaria, que se financia con responsabilidad, que cuida a su masa social y que entiende que la comunicación y la marca también son parte del juego. Es, en definitiva, un ejemplo de que la gestión deportiva, cuando se hace bien, también es una forma de amor al territorio.</p>

<p><strong>Juan Ruiz como sempiterno presidente. ¿Qué reflexión le merece su legado y labor al frente del club en el cincuentenario de su fundación que se cumple en 2026?</strong></p>

<p>Juan Ruiz es, sencillamente, el alma del Guaguas. Un hombre que ha entregado su vida entera a un proyecto que ama como se ama a un hijo, con esa mezcla de orgullo y desvelo que solo entienden quienes sienten el deporte como vocación y no como cargo. Durante cinco décadas ha sabido mantener encendida la llama, incluso cuando el viento soplaba en contra. Ha visto caer y renacer al club, ha soñado con él cada noche y lo ha levantado cada mañana. Su legado no se mide solo en títulos, sino en la huella que deja en las personas: jugadores, técnicos, aficionados, generaciones enteras que crecieron bajo su ejemplo. El Guaguas es hoy lo que es porque tuvo a su lado a alguien que nunca se rindió, que creyó en la fuerza del trabajo y en el valor de la palabra dada. Alguien que se entrega de esta manera encarna una forma de entender la vida, la constancia y la pasión por Canarias a través del deporte, que es para agradecerle siempre como tiene que ser de justicia.</p>

<p><strong>¿En qué grado se siente partícipe el Gobierno de Canarias de esta bandera, la del Guaguas, que ondea a nivel nacional y europeo con tanta fama y prestigio?</strong></p>

<p>Intentamos estar cerca de todos, marca de la casa que el Consejero Poli Suárez ejerce en primera persona y, de ahí para abajo, todo su equipo. Eso nos hace sentirnos profundamente partícipes y orgullosos de los éxitos del deporte canario. El Guaguas representa lo que este Gobierno defiende: la seriedad en la gestión, la igualdad de oportunidades, la conexión entre deporte y sociedad. Cada vez que el Guaguas pisa una cancha europea, está representando al conjunto del archipiélago y ahí también está la mano de una administración que cree en su gente, que apuesta por el alto rendimiento y que entiende el deporte como política pública. El Guaguas no compite solo, lo hace en nombre de todos los canarios que creen en el esfuerzo, en la superación y en la capacidad de nuestra tierra para ganar. Y estar cerca de ellos, acompañarlos, no es protocolo: es una forma de agradecer lo que hacen por el nombre de Canarias.</p>

[imagen_contenido file="15cap_impa_foto2.jpg" caption="Sabroso saluda a Joselu Sánchez en un agajaso oficial."]

[imagen_contenido file="15cap_impa_foto1.jpg" caption="Acompañando a Io de Amo tras recoger el premio como MVP en la Supercopa de España 2024." fullwidth="true"]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 16: LA DIRECTIVA Y EL FUTURO QUE VIENE
    // ═══════════════════════════════════════════════
    array(
        'title' => 'La directiva y el futuro que viene',
        'numero' => '16',
        'order' => 170,
        'show_marker' => true,
        'ref_id' => 'cap16',
        'content' => '',
    ),

    array('title' => 'La directiva', 'numero' => '', 'order' => 1701, 'show_marker' => false, 'parent_ref' => 'cap16',
        'hero' => array(
            'image'               => libro_img('16cap_directiva_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'top center',
            'title_lines'         => array(
                libro_hero_line('LA DIRECTIVA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]Un grupo directivo homogéneo, implicado, en el que la única fuerza motora es la estabilidad, el crecimiento y la funcionalidad del Guaguas. Nadie cobra un euro por sus funciones representativas, con Juan Ruiz como ejemplo histórico y vigente de la entrega altruista por el escudo.[/capitular]

<p>El presidente ha sido testigo de todas las épocas del club, desde las más precarias hasta las que mejor representan la solidez del proyecto, y bajo su tutela se vertebra un equipo ejecutivo con representantes de todas las generaciones y en el que se salvaguarda la filosofía original de servicio y lealtad. &ldquo;Hay un compromiso decidido y firme en servir al escudo, en poner lo mejor que tenemos para procurar el crecimiento, la sostenibilidad y el porvenir de la entidad y el trabajo que se está realizando en los últimos años, desde la refundación en 2020, así lo evidencia. La generación de recursos, las relaciones institucionales con los estamentos públicos, la búsqueda de patrocinios, la consolidación de la marca, la transformación necesaria para los desafíos de los nuevos tiempos, la necesaria modernización y profesionalización&hellip; Vamos todos en la misma dirección con la responsabilidad que implican nuestros cargos&rdquo;, argumenta el presidente.</p>

<p>Ruiz diseñó un grupo de trabajo en la dirigencia con sumo cuidado y sensibilidad, con representantes de la primera etapa, como salvaguarda de las tradiciones y esencias, actores del mundo empresarial y de gestión actual y una importante cuota femenina. Roles definidos, compenetrados y que privilegian el consenso en la toma de decisiones, siempre vinculada al bien del Guaguas dentro de un modelo de gestión transparente.</p>

<p>&ldquo;Con los medios que tenemos y las aspiraciones competitivas siempre máximas que hay en nuestros proyectos es esencial una manera de dirigir y decidir desde la seriedad, desde el rigor que comporta estar donde estamos y con muchísimo tacto y firmeza en cada paso, en cada gestión, en cada determinación. Nos guía nuestro amor por el Guaguas y por el deporte, sabiendo que representamos a Canarias y que la ejemplaridad debe ser una constante en nuestro proceder&rdquo;, insiste el mandatario.</p>

<p>Joselu Sánchez, exjugador del Guaguas, y que ejerce de secretario, junto a Antonio Benítez, asesor, y Marek Szczesnowicz, team mánager y vocal a la vez, fueron testigos del Guaguas que emergió en los ochenta para ya quedarse entre los grandes y ahora siguen vinculados al proyecto desde sus respectivas carteras y con el mismo ímpetu y pasión que no han perdido pese al paso del tiempo y del que es representante imbatible Juan Ruiz, enérgico y activo tal y como se le conoció en sus inicios en la presidencia en 1986.</p>

<p>La vía de las segundas generaciones también está presente con David Ruiz, tesorero e hijo de Juan Ruiz, y las vocales Lucía Ramón y Laura Sánchez, hijas de Jorge Ramón y Joselu Sánchez respectivamente. Otra garantía de calidad.</p>

<p>Y añadir a la dirigencia a Ariel Ortega como vicepresidente, con el aval de su trayectoria empresarial y tener a un exdirector de Deportes del Gobierno de Canarias como José Manuel Betancort, otro de los asesores, añade fortaleza y experiencia a una junta en la que Adolfo Rodríguez representa la continuidad y eficiencia.</p>

[imagen_contenido file="16cap_dire_foto3_num.jpg" fullwidth="true"]

<div class="directiva-list">
<div class="directiva-item"><span class="d-num">1</span><div class="d-info"><span class="d-name">Lucía Ramón</span><span class="d-role">Vocal</span></div></div>
<div class="directiva-item"><span class="d-num">2</span><div class="d-info"><span class="d-name">Joselu Sánchez</span><span class="d-role">Secretario</span></div></div>
<div class="directiva-item"><span class="d-num">3</span><div class="d-info"><span class="d-name">Laura Sánchez</span><span class="d-role">Vocal</span></div></div>
<div class="directiva-item"><span class="d-num">4</span><div class="d-info"><span class="d-name">Ariel Ortega</span><span class="d-role">Vicepresidente</span></div></div>
<div class="directiva-item"><span class="d-num">5</span><div class="d-info"><span class="d-name">Juan Ruiz</span><span class="d-role">Presidente</span></div></div>
<div class="directiva-item"><span class="d-num">6</span><div class="d-info"><span class="d-name">Rosa Montesdeoca</span><span class="d-role">Vocal</span></div></div>
<div class="directiva-item"><span class="d-num">7</span><div class="d-info"><span class="d-name">Antonio Benítez</span><span class="d-role">Asesor</span></div></div>
<div class="directiva-item"><span class="d-num">8</span><div class="d-info"><span class="d-name">Marek Szczesnowicz</span><span class="d-role">Vocal</span></div></div>
<div class="directiva-item"><span class="d-num">9</span><div class="d-info"><span class="d-name">Adolfo Rodríguez</span><span class="d-role">Vocal</span></div></div>
<div class="directiva-item"><span class="d-num">10</span><div class="d-info"><span class="d-name">José Manuel Betancort</span><span class="d-role">Asesor</span></div></div>
</div>
'),

    array('title' => 'El futuro que viene', 'numero' => '', 'order' => 1702, 'show_marker' => false, 'parent_ref' => 'cap16',
        'anclas_internas' => "Ariel Ortega | ariel-ortega\nLaura Sánchez | laura-sanchez\nLucía Ramón | lucia-ramon\nDavid Ruiz | david-ruiz",
        'hero' => array(
            'image'               => libro_img('16cap_futuro_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'top center',
            'title_lines'         => array(
                libro_hero_line('EL FUTURO QUE VIENE', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]Juan Ruiz ha ido modelando un equipo directivo adaptado a los nuevos tiempos y en el que la diversidad generacional y de perfiles, como reconoce, &ldquo;enriquece&rdquo; la gestión y toma de decisiones.[/capitular]

<p>Pese a que el presidente mantiene una frenética actividad que le hace estar al tanto de todo tipo de gestiones y de cualquier naturaleza, pues en su modelo de dirección lleva implícita esa omnipresencia, el crecimiento de la entidad así como las obligaciones sobrevenidas han recomendado dotar a la entidad de un equipo administrativo perfectamente profesionalizado y, por encima, una cúpula ejecutiva jerarquizada pero en la que todos tienen voz y voto.</p>

<p>Y en este elenco de personalidades próximas al máximo mandatario destacan, por edad y capacitación, cuatro nombres propios llamados a tener relevancia en la transición al futuro en la que ya se trabaja. Ariel Ortega, reconocido empresario grancanario, en las funciones de vicepresidente, David Ruiz, tesorero e hijo del factótum histórico y guía del resto, y las vocales Lucía Ramón y Laura Sánchez, también con reconocibles antecedentes familiares en la trayectoria de la entidad, personifican ese aire nuevo y renovado que, en conjunción con la mayor experiencia y antigüedad de los compañeros de la dirigencia, resulta el complemento perfecto.</p>

<p>Un Guaguas en transformación, adaptado a la vanguardia del siglo XXI en su manera de desarrollarse y desplegarse a la sociedad y sin perder la esencia de su herencia triunfal, y bajo unos parámetros de sostenibilidad, compromiso social y alianza con el éxito deportivo, lo que aboca a una gestión impecable, son los cimientos en esta etapa.</p>

[imagen_contenido file="16cap_dire_foto5.webp" fullwidth="true"]

[seccion_header color="navy" id="ariel-ortega"]Ariel Ortega[/seccion_header]

[imagen_contenido file="16cap_dire_foto2.webp" max_width="50%"]

[capitular]Ariel Ortega (Las Palmas de Gran Canaria, 1972) fue una de las incorporaciones estratégicas de Juan Ruiz para su directiva en el verano de 2023. Licenciado en Empresariales por la Universidad de Salford (Mánchester) y Máster MBA en Dirección de Empresas por Esden (Madrid), a Ortega le avalaba su sólida experiencia al frente de Café Ortega, industria familiar de la que es director general, además de su pasión e inquietud por el deporte, faceta heredada de su padre, en tiempos enrolado en la directiva de la UD Las Palmas.[/capitular]

[cita_editorial author="Ariel Ortega"]Cuando Juan Ruiz me llamó pensé que me iba a pedir dinero, porque él siempre está pensando en el crecimiento del club... Pero no, lo que me trasladó es que quería contar conmigo en virtud de mi trayectoria profesional y mi afición por el deporte. Y pensaba que podía prestigiar la directiva del Guaguas si yo me unía a ellos. No lo consulté a nadie y ni me lo pensé. Acepté al momento.[/cita_editorial]

<p>&ldquo;A nivel empresa, Café Ortega colabora con el club desde el relanzamiento del Guaguas. Juan me pidió si podía implicarme más en el proyecto a nivel personal y acepté con la condición de que nunca me proponga para sustituirle como presidente porque para ser presidente hay que tener la cabeza 100% en el Guaguas como la tiene Juan. Mi cabeza está al 100% en Café Ortega. Hace tres años me encontré una junta directiva magnífica, unida, implicada y con una calidad humana extraordinaria… Entre ellos hay muchos que podrían ser futuros presidentes cuando llegue el momento del relevo&rdquo;, aclara.</p>

<p>Ariel Ortega lleva con &ldquo;responsabilidad, humildad, temple y dedicación&rdquo; su agenda como vicepresidente del Guaguas: &ldquo;Estoy para cualquier cosa que me pida el club, pero mi gestión va más enfocada a lo económico que a lo deportivo. Somos un club humilde y me ha tocado desde estar en la puerta de entrada recogiendo entradas los días de partido a estar con autoridades en el palco, a viajar de directivo delegado con el equipo, a negociar con sponsors, a atender a los medios de comunicación, a recibir a jugadores nuevos… Todos los directivos estamos implicados al máximo&rdquo;.</p>

<p>&ldquo;El voleibol es un deporte minoritario y da lo que da, tiene el recorrido que tiene. Cuesta muchísimo conseguir patrocinios privados, aún así casi un 40% de nuestros ingresos vienen de sponsors, publicidad, colaboradores, abonados y taquilla. Si el termómetro para cobrar fuera por títulos obtenidos, sin duda que seríamos los más ricos del deporte canario, pero hay equipos de otros deportes como fútbol y baloncesto que, sin obtener títulos, tienen más tirón popular. Ahí está nuestro reto, el de intentar atraer a la gente a que se enganche al Guaguas&rdquo;, asegura a propósito de las limitaciones financieras.</p>

<p>Con todo, admite que encontró una estructura consolidada en la que &ldquo;todo se hace más fácil&rdquo; por el prestigio acumulado: &ldquo;Llegué en un buen momento y me subí a caballo ganador. Lo fácil es sumarse ahora. Lo difícil es llegar hasta aquí desde la fundación del club en 1976. De ahí el mérito de Juan Ruiz y de todos los que han hecho posible que el Guaguas haya escrito esta historia. Personalmente, es un halago que quieran contar conmigo. Y viendo el ADN del Guaguas, que siempre sale a ganar, creo que hay posibilidad de recorrido, de crecimiento, como se ha visto en todos estos años&rdquo;.</p>

<p>En relación al apoyo recibido por parte del empresariado isleño, razona: &ldquo;Para nosotros es vital poder seguir contando con empresas privadas canarias para poder mantener el presupuesto. Aspiramos a conseguir nuevos y a intentar arañar más parte del presupuesto promocional que las empresas comparten con otros deportes. Aquí competimos con el fútbol, baloncesto, balonmano, lucha canaria, vela...&rdquo;</p>

<p>&ldquo;Hay una consigna clara: no podemos gastar más de lo que ingresamos. Tenemos una virtud y es que la estructura es muy sencilla, los directivos nos implicamos en gestión y tareas y el costo de personal no deportivo es bajo porque son pocos. Peleamos mucho los costos de explotación, buscamos el último céntimo y resulta de todo ello un presupuesto para fichar buenos profesionales que nos hagan ser competitivos en la cancha&rdquo;, apunta a propósito de la sostenibilidad de un proyecto campeón temporada tras temporada y con recursos financieros más limitados que otros clubes.</p>

<p>&ldquo;La recaudación por taquilla y abonados no suponen el gran grueso de ingresos, pero por supuesto que todo suma. Aquí lo más importante es el calor humano en la cancha, necesitamos a los seguidores para alentar al equipo porque su energía se transmite en positivo al equipo. Competir en el Arena es provisional hasta que se termine de renovar el CID, en febrero de 2027 si se cumplen los plazos. Aún así, estamos muy contentos con el apoyo de los aficionados y hemos notado un aumento de la asistencia. Somos un club saneado porque no gastamos más de lo que ingresamos, pero sí es cierto que sufrimos tensiones de tesorería por depender en un 60% de los ingresos de las instituciones públicas que llegan después de incurrido el gasto&rdquo;.</p>

[cita_editorial author="Ariel Ortega"]Es un trabajo lento, pero aspiramos algún día a poder contar con un gran sponsor privado que pueda complementar a Guaguas Municipales y poder dar ese salto cualitativo en el presupuesto que nos permita aspirar a más en Europa. Sueño con volver al CID renovado y las gradas a tope animando al Guaguas.[/cita_editorial]

[seccion_header color="navy" id="laura-sanchez"]Laura Sánchez[/seccion_header]

[imagen_contenido file="16cap_dire_foto6.webp" max_width="50%"]

[capitular]Laura Sánchez (Las Palmas de Gran Canaria, 1999) entró a formar parte de la directiva en 2020 como vocal. Estudió Ingeniería en Organización Industrial y cursó el Máster habilitante de Ingeniería Industrial en la Universidad de Las Palmas de Gran Canaria y el Máster de Minería de Datos e Inteligencia de Negocios en la Universidad Complutense de Madrid. Actualmente ejerce de auditora interna en el Canal de Isabel II, la empresa que gestiona el agua en la Comunidad de Madrid.[/capitular]

<p>Hija de Joselu Sánchez, admite que esa influencia le ha marcado: &ldquo;Mi padre, desde muy pequeña, me ha transmitido tan importantes valores como el amor por el deporte, la disciplina, el esfuerzo y el compromiso, que son exactamente los mismos que siempre han definido la historia del club. Un club que a lo largo de estos años ha conseguido grandes triunfos para el deporte grancanario y para su afición. El voleibol ha estado siempre presente en nuestra historia familiar, primero a través de sus logros como jugador de balonmano, luego del CV Guaguas y, más tarde, en mi trayectoria deportiva en el CV Claret y el JAV Olímpico, con mi padre como mejor apoyo y ejemplo&rdquo;.</p>

<p>&ldquo;Desde pequeña estuve vinculada al voleibol como jugadora, un deporte que me enseñó valores fundamentales y que me permitió crecer tanto a nivel personal como deportivo, no solo por los entrenamientos y la competición, sino también por las relaciones personales tan enriquecedoras que vas haciendo en cada temporada deportiva y en cada categoría. Por todo ello, pertenecer a la directiva de un club con tanta historia y tan alto nivel deportivo es un honor. Me satisface enormemente saber que puedo contribuir a seguir consiguiendo triunfos, crear mayor afición y conseguir que el nombre de nuestra isla, Gran Canaria, esté asociado al voleibol con mayúsculas. El equipo tiene una trayectoria histórica extraordinaria y creo que es importante que las nuevas generaciones asumamos también la responsabilidad de trabajar por él, hacerlo crecer y adaptarlo a los nuevos tiempos, siempre desde el respeto a sus logros pasados&rdquo;, añade.</p>

<p>Respecto a su cometido en el equipo ejecutivo, detalla: &ldquo;Mis funciones abarcan diferentes áreas de apoyo a la gestión del club, colaborando en la organización y también en el día a día del equipo, incluido el acompañamiento y el apoyo en los partidos. Es un trabajo cercano y comprometido. Me siento escuchada y valorada dentro de la directiva, y existe un clima de trabajo muy abierto en el que se fomenta el intercambio de ideas y la mejora continua, siempre con el objetivo común de fortalecer al Guaguas&rdquo;.</p>

<p>&ldquo;Asumo con mucha responsabilidad todo, pero también con orgullo e ilusión. Representar a una nueva generación y aportar una visión femenina dentro de la directiva no es una carga, sino una oportunidad para enriquecer el proyecto. Creo firmemente que la diversidad de perfiles, experiencias e ideas fortalece a cualquier institución y permite afrontar los retos con una visión más amplia y actual. Soy consciente de la importancia de abrir camino y de servir de referencia, especialmente para las jóvenes que ven en el deporte un espacio en el que desarrollarse no solo como deportistas, sino también en ámbitos de gestión. Afronto esta responsabilidad con respeto al club, con ganas de aprender de quienes llevan más tiempo y con el compromiso de contribuir a que el Guaguas siga siendo una entidad moderna, inclusiva y fiel a sus valores&rdquo;, agrega.</p>

<p>Laura Sánchez se congratula de formar parte de un emblema social de Gran Canaria y que va más allá de la red, como así lo percibe: &ldquo;La imagen del Guaguas en la calle es, en general, muy positiva. Es un club reconocido y respetado, con una historia y un palmarés que lo sitúan como una referencia del deporte canario. Mucha gente ya conocía al Guaguas y valoraba su trayectoria, pero es cierto que, desde que formo parte de la directiva, he podido comprobar cómo ese sentimiento se contagia aún más. En mi entorno personal, he conseguido motivar a muchos amigos y conocidos a acercarse al club, a asistir a los partidos y a enamorarse del Guaguas de la misma manera que lo estoy yo. Eso demuestra que el club tiene un enorme potencial social y emocional. Quizá a veces no somos del todo conscientes de la dimensión real de lo que representa, pero cuando se vive de cerca se entiende que el club no es solo tradición y títulos, sino identidad, orgullo y sentimiento de pertenencia&rdquo;.</p>

[cita_editorial author="Laura Sánchez"]Al Guaguas lo veo como un proyecto ambicioso e ilusionante. Con todo el esfuerzo y el trabajo que está realizando el equipo directivo, estoy convencida de que el club seguirá creciendo y consolidándose tanto a nivel nacional como internacional. Además, en el ámbito competitivo, espero que continúe siendo un referente, manteniendo la ambición y el espíritu de superación que siempre lo han caracterizado. Pero, más allá de los resultados, confío en que el Guaguas siga teniendo un papel fundamental a nivel social, inspirando a muchos jóvenes a través del deporte, transmitiendo valores como el esfuerzo, la constancia y el trabajo en equipo, y demostrando que con compromiso y pasión se pueden construir proyectos sólidos y duraderos.[/cita_editorial]

<p>E inevitable la referencia a Juan Ruiz: &ldquo;Juan Ruiz es una figura clave en la historia reciente del club. Destacaría su compromiso, su capacidad de liderazgo y su visión a largo plazo. Es un presidente cercano, que escucha a su equipo y que se apoya y confía plenamente en las personas que le rodean, fomentando un clima de trabajo basado en la colaboración y el respeto. Esa forma de dirigir ha sido fundamental para consolidar un proyecto sólido, ambicioso y con identidad propia, siempre con el Guaguas como prioridad&rdquo;.</p>

[seccion_header color="navy" id="lucia-ramon"]Lucía Ramón[/seccion_header]

[imagen_contenido file="16cap_dire_foto7.webp" max_width="50%"]

[capitular]Graduada en Fisioterapia, rama en la que ejerce, y estudiante del Grado en Educación Física, Lucía Ramón (Las Palmas de Gran Canaria, 1999) es vocal de la junta directiva desde el año 2024. Hija de un histórico como Jorge Ramón, reconoce que ese legado personal &ldquo;ayuda a valorar más el trabajo que se está realizando para mantener al Guaguas en lo más alto y seguir construyendo un futuro a la altura de su historia&rdquo;.[/capitular]

<p>&ldquo;Desde muy pequeña he visto reflejada en los ojos de mi padre la pasión por el voleibol y, especialmente, por el Club Voleibol Guaguas. Conocer de primera mano la historia del club, sus orígenes y los logros alcanzados en el pasado gracias al esfuerzo, el sacrificio y la ilusión de tantas personas, me ha permitido comprender la verdadera grandeza de este club. El voleibol siempre ha formado parte de mi vida. Desde pequeña he estado en las gradas, viendo partidos y viviendo ese ambiente tan especial que se crea. Aunque nunca he jugado de manera oficial, siento el voleibol como algo muy mío, porque lo he vivido en casa y lo he sentido desde niña. Poder conocer el club desde dentro y participar activamente en su día a día es para mí una oportunidad muy ilusionante. Por eso, cuando Juan Ruiz me propuso formar parte de la directiva, sentí que era el momento de implicarme de una forma diferente y aceptar el reto con muchas ganas&rdquo;, admite.</p>

<p>Dentro de la directiva, su papel &ldquo;es colaborar en todo lo que se necesite&rdquo;, aportando siempre &ldquo;ilusión y ganas de ayudar&rdquo;. &ldquo;Tengo la suerte de poder acompañar al equipo en algunos partidos fuera de la isla, una experiencia que me hace sentir aún más parte de este proyecto. Me siento escuchada y valorada, poder compartir ideas, proponer iniciativas y ver que se tienen en cuenta me llena de motivación y refuerza el cariño que siento por el CV Guaguas. Formar parte de la directiva me hace sentir que, pese a mi corta edad, puedo contribuir a seguir construyendo la historia del club. Ser una de las representantes de la cuota femenina y de la nueva generación en la directiva lo asumo con ilusión y responsabilidad. Para mí es un privilegio poder aportar nuevas ideas y energía joven al club, y al mismo tiempo sentirme parte de la historia que construyeron generaciones anteriores, incluida la de mi padre. Más que presión, lo veo como una oportunidad de contribuir y aprender, y considero muy importante que, en un deporte mayoritariamente masculino, también se tenga en cuenta la opinión de las mujeres. Poder formar parte de este equipo y aportar mi visión me hace sentir que ayudo a que el CV Guaguas siga creciendo y abriendo sus puertas a quienes quieran sumarse a este proyecto&rdquo;, enfatiza con evidente satisfacción.</p>

<p>La excelencia en la que está instalado el club, con títulos y éxitos continuados temporada tras temporada, la valora Lucía Ramón con una mezcla de entusiasmo y admiración: &ldquo;Quienes hemos vivido la afición por el voleibol y conocemos tanto el pasado como el presente del Guaguas sabemos lo que cuesta mantener a un equipo en lo más alto. Por eso, sentimos una profunda admiración por un club humilde que, con esfuerzo y dedicación, sigue creciendo cada día. Intentamos aportar nuestro granito de arena para que cada vez más personas puedan compartir la pasión que nos une. Aun así, en la isla el voleibol sigue siendo un deporte discreto y todavía hay mucha gente que desconoce la grandeza de este club. Creo que es fundamental seguir trabajando para darle la visibilidad y el reconocimiento que merece, recordando siempre su historia, celebrando sus logros y mostrando a todos que el Guaguas es mucho más que un equipo: es una tradición, una familia y un orgullo para nuestra ciudad&rdquo;.</p>

[cita_editorial author="Lucía Ramón"]Veo al Guaguas del futuro como un club que sigue creciendo, no solo en lo deportivo, sino también como un referente social y emocional de nuestra ciudad. Si seguimos trabajando en la línea que llevamos, estoy segura de que conseguiremos grandes logros y consolidaremos nuestra presencia en la élite del voleibol. Me emociona ver cómo cada vez más personas se acercan a los partidos y cómo los niños admiran a nuestros jugadores, soñando con seguir sus pasos y formar parte de este equipo algún día. Espero que en los próximos años el Guaguas siga siendo un lugar donde se fomente la pasión por el deporte y donde se transmitan valores que perduren más allá del juego.[/cita_editorial]

<p>En sus reflexiones también cabe una personalizada en la figura del presidente: &ldquo;Para mí, Juan Ruiz es mucho más que el presidente del Guaguas. Lo conozco desde que era niña, porque ya estuvo al frente del club en la época en la que jugaba mi padre, y siempre lo he visto como alguien que ha dedicado su vida a que este club crezca y se mantenga en lo más alto. Es tenaz, apasionado y comprometido, capaz de enfrentar cualquier dificultad con determinación y de transmitir ilusión a todos los que formamos parte de este proyecto. Para mí, Juan Ruiz no es solo un presidente; es historia viva y una inspiración constante que une pasado, presente y futuro del Club Voleibol Guaguas&rdquo;.</p>

[seccion_header color="navy" id="david-ruiz"]David Ruiz[/seccion_header]

[imagen_contenido file="16cap_dire_foto8.webp" max_width="50%"]

[capitular]David Ruiz (Las Palmas de Gran Canaria, 1977) supo desde niño, y por la vía directa de su padre, qué era el Guaguas y su significado en el deporte y la sociedad grancanaria. Creció siendo testigo directo del auge imparable en la década de los noventa y, conforme a su formación académica, diplomado en Turismo en la Escuela Oficial de Turismo, era inevitable que, en algún momento, trasladara la pasión heredada de su padre, el gran Juan Ruiz, a una función concreta y ejecutiva al servicio del escudo.[/capitular]

<p>Y, con la refundación fechada en 2020, y avalado por su experiencia en el mundo de la banca, en el que ejerce, asumió la tarea de ser el tesorero y vigilar la salud de las cuentas del club que ha marcado su vida.</p>

[cita_editorial author="David Ruiz"]La figura de mi padre lo ha sido todo en el sentimiento e implicación en el club. Desde siempre me recuerdo junto a él viviendo y sintiendo con toda la intensidad las vicisitudes del equipo, con momentos muy felices. También con la pena que nos dejó esa mala etapa en la que, tras dejar mi padre la presidencia, todo acabó de la peor manera con la desaparición de la entidad. Por eso cuando retomó el proyecto y me pidió que le ayudara, no lo dudé. Los directivos no cobramos sueldo ni dietas. Lo hacemos todo en nuestro tiempo libre y con la mayor dedicación posible. Pero es un esfuerzo que decidí asumir por una cuestión sentimental.[/cita_editorial]

<p>David Ruiz se congratula de que el crecimiento que ha experimentado el Guaguas en los últimos años no le haya hecho perder &ldquo;el ambiente familiar y personal&rdquo; que le caracteriza y que, a su juicio, &ldquo;es algo que debe mantenerse&rdquo;.</p>

<p>&ldquo;La profesionalización y modernización que perseguimos, y que es una obligación en los tiempos que vivimos, no tiene que estar reñida con las relaciones de respeto, amistad, colaboración y aprecio que mantenemos todos los que formamos parte de la estructura, tanto administrativa como deportiva. Vamos en la misma dirección y es una de las claves del compromiso que impera&rdquo;, considera.</p>

<p>&ldquo;En un club de voleibol la gestión de recursos es lo más importante. La premisa principal es que el Guaguas es un club campeón y eso es lo que intentamos vender y promocionar para que tanto las instituciones como patrocinadores privados inviertan en el club, para alimentar el presente y, cómo no, el futuro. Ofrecemos lo que no cualquiera puede: títulos, prestigio internacional, seriedad en nuestro modelo de gestión, representatividad de la tierra y defensa de unos valores que, a lo largo de cincuenta años de historia, siempre nos han acompañado&rdquo;, añade.</p>

<p>Consciente de que &ldquo;la marca es conocida y ayuda a conseguir recursos, aparte de las aportaciones de los organismos públicos&rdquo;, insiste en sacar el valor justo a lo que representa el club en Canarias, prestigiado en sus vitrinas y, también, con reconocimientos oficiales que respaldan sus éxitos continuados. En este sentido, otorga &ldquo;una importancia esencial&rdquo; a la captación de recursos del gremio del empresariado de la tierra: &ldquo;Para nosotros es un orgullo que las empresas isleñas aporten su granito de arena y apoyen al club. Son bastante fieles y eso tiene muchísimo mérito. Ven en el Guaguas una entidad que siempre ofrece unos resultados brillantes y, además, saben que cada euro que depositan se va a fiscalizar al detalle para sacarle el máximo partido. Esa combinación de competitividad en la pista y gestión responsable es la que hace que, temporada tras temporada, nos acompañen con sus apoyos&rdquo;.</p>

<p>&ldquo;La salud económica del club es positiva, cumpliendo con los compromisos de pago y lo presupuestado por temporada. No renunciamos a subir el presupuesto en la medida de lo posible, algo normal porque los costes siempre incrementan. Pero en este apartado estamos satisfechos porque es un crecimiento sostenido, un crecimiento en el que mantenemos el control de todo sin perder la perspectiva de lo que somos, lo que queremos y lo que pretendemos&rdquo;, expone.</p>

<p>En alusión a esa capacidad de sostener al Guaguas en la cima del voleibol, vertebra la receta mágica en cuatro términos: &ldquo;Esfuerzo, trabajo, perseverancia e ilusión&rdquo;.</p>

[cita_editorial author="David Ruiz"]No veo otra opción que la de seguir ganando títulos y disponer de un grupo de jugadores que sean campeones, que lo lleven en la sangre y defiendan de esa manera la camiseta del Guaguas. Y con Juan Ruiz al frente, sin duda que será nuestra tarjeta de presentación tanto en España como en Europa.[/cita_editorial]

[imagen_contenido file="16cap_dire_foto4.png" fullwidth="true"]
'
),

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
            'image'               => libro_img('17cap_mas_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'top center',
            'title_lines'         => array(
                libro_hero_line('MÁS HONORES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
'content' => '
[capitular]El prestigio de la entidad ha trascendido al ámbito del voleibol y le ha permitido alzarse con galardones de máxima relevancia provincial y regional, en reconocimiento a sus méritos deportivos y, también, representativos a niveles globales.[/capitular]

<p>Porque la nominación a condecoraciones como las acumuladas en los últimos tiempos y casi de manera consecutiva, Premio Roque Nublo Deportivo por parte del Cabildo de Gran Canaria (2023), Medalla de Oro de la Ciudad de Las Palmas de Gran Canaria (2023) y Premio al Deporte Canario del Gobierno de Canarias (2024), responde, precisamente, a su indudable calado, de manera unánime valorado por las autoridades correspondientes en su baremación objetiva a la hora de las correspondientes designaciones. Para un club como el Guaguas, abanderado de su tierra por toda Europa, y con una historia de éxitos y superaciones, el significado de estos laureles supone el espaldarazo perfecto y preciso a esa constancia en la cima competitiva, a esa aureola de éxito sostenido, de vitrinas sin comparación. También a la consagración en la que se ha instalado bajo el liderazgo de Juan Ruiz en el palco y Sergio Miguel Camarero a pie de pista, representantes de la vieja guardia, la inolvidable de una hegemonía que todavía perdura, y líderes de la nueva era también jalonada de conquistas.</p>

<p>Tener el elogio y tributo de las instituciones más representativas de Canarias, desde el Gobierno al Cabildo de Gran Canaria, pasando por el Ayuntamiento capitalino, siempre ha tenido un valor superlativo para el club, por tanto en cuanto su naturaleza deportiva, al que le sustancia, siempre ha contemplado un sustrato social ineludible.</p>

[cita_editorial author="Juan Ruiz"]Son muchos años llevando la canariedad por toda España e infinidad de países, el orgullo de pertenencia, el talento que nos pertenece, esa singularidad que nos caracteriza y nos hace únicos. He vivido los recibimientos que nos han brindado, la admiración que hemos despertado, la expectación generada... Y sentir que en tu lugar de origen así lo consideran y te lo admiten de la mejor manera posible, con un tributo público que queda para siempre, sin duda que es motivo de una satisfacción muy especial.[/cita_editorial]

<p>Argumenta el presidente.</p>

<p>Entre los trofeos y recuerdos que forman parte del patrimonio vital del Guaguas, las menciones detalladas ocupan, por su dimensión tan preciada, un lugar privilegiado.</p>

[seccion_header color="navy"]Premio Roque Nublo Deportivo del Cabildo de Gran Canaria (2023)[/seccion_header]

[imagen_contenido file="17cap_mas_foto3.jpg" fullwidth="true"]

<p>El 17 de marzo de 2023 recogió Juan Ruiz, visiblemente emocionado, y ante una ovación clamorosa, la placa y diploma acreditativos &ldquo;por su contribución de manera decisiva al crecimiento y la práctica del voleibol entre los jóvenes grancanarios, situando de nuevo a Gran Canaria como referente del voleibol nacional y potenciando, además, los valores y promoción turística de la isla en el exterior, siendo el club deportivo más laureado de Canarias&rdquo;. Antonio Morales encabezó en su condición de máximo dirigente cabildicio este evento. El presidente del Guaguas repartió los méritos acumulados para lograr esta designación:</p>

[cita_editorial author="Juan Ruiz"]Es la culminación de muchísimos años de trabajo, de todos los que apostaron por este club en 1976. Es un premio para todos los jugadores, entrenadores, dirigentes y técnicos, que han colaborado en estos 45 años de historia que tiene el club. Este reconocimiento de prestigio también es de los aficionados, patrocinadores y todos los que siguen haciendo grande esta entidad.[/cita_editorial]

[cita_editorial author="Juan Ruiz"]Es un premio de toda la familia del Guaguas. Siendo el club más laureado de Canarias tras la desaparición del Marichal, mucha gente me decía que no comprendía que el Guaguas no tuviese un premio del Gobierno de Canarias, del Cabildo de Gran Canaria o del Ayuntamiento de Las Palmas de Gran Canaria. Hablamos de un premio honorífico, de prestigio, sin connotaciones económicas. Ya se ha hecho justicia.[/cita_editorial]

<p>Añadió.</p>

[seccion_header color="navy"]Medalla de Oro de la Ciudad de Las Palmas de Gran Canaria (2023)[/seccion_header]

[imagen_contenido file="17cap_mas_foto4.png" fullwidth="true"]

<p>El 23 de junio de 2023, en una gala celebrada en el teatro Pérez Galdós, la ciudad de Las Palmas de Gran Canaria destacó la labor de 25 personalidades e instituciones en el acto de honores y distinciones relacionadas con la ciudad y fueron reconocidos con los correspondientes títulos de Hijos e Hijas Predilectos, Hijos e Hijas Adoptivos y Medallas de Oro de la ciudad. El acto institucional de entrega de reconocimientos se celebró en el marco de las Fiestas Fundacionales y el Guaguas, representado por su presidente, obtuvo este galardón por haberse hecho sitio, con todos los honores, en la historia deportiva capitalina.</p>

[cita_editorial author="Juan Ruiz"]Valoraron nuestros títulos, nuestro apoyo a la base, nuestra predisposición siempre a ayudar, promocionar e impulsar las virtudes de nuestra ciudad. Fue otro acto para el recuerdo, muy emotivo, muy brillante y que engrandeció más aún nuestro camino y escudo.[/cita_editorial]

<p>Significó Juan Ruiz al respecto, al que agasajó la alcaldesa Carolina Darias.</p>

[seccion_header color="navy"]Premio al Deporte Canario del Gobierno de Canarias (2024)[/seccion_header]

<p>El 15 de noviembre de 2024, y en reconocimiento a su brillante temporada 2023/2024, en la que conquistó cuatro títulos (Superliga, Copa de SM El Rey, Supercopa y Copa Ibérica), además de una sobresaliente participación en la Champions League, principal competición de clubes de Europa, donde alcanzó los cuartos de final, codeándose con los equipos más potentes del Viejo Continente, el club recibió este premio en el transcurso de la feria ExpoDeca, celebrada en Infecar.</p>

<p>La consejería de Educación, Formación Profesional, Actividad Física y Deportes del Gobierno de Canarias quiso, con ello, reconocer la excelencia deportiva y el talento de deportistas, clubes y organizaciones canarias destacados durante la temporada, elevando el nombre del CV Guaguas.</p>

[cita_editorial author="Juan Ruiz"]Nos han votado los 27 periodistas de las Islas Canarias y me alegra mucho como nuestra familia ve recompensado este trabajo en equipo que iniciamos en una época tan dura como fue la pandemia del Covid-19. Y supimos resistir, aguantar y superarlo. Tanto en los primeros años del club como en esta etapa reciente, muchas personas tienen que sentirse partícipes de los éxitos deportivos y también de los buenos momentos que estamos viviendo ahora, con aficionados veteranos y muchos jóvenes que acuden al Gran Canaria Arena.[/cita_editorial]

<p>Subrayó Juan Ruiz, de nuevo encargado de representar a la entidad en tan señalada convocatoria.</p>

[imagen_contenido file="17cap_mas_foto1.jpg" fullwidth="true"]

[imagen_contenido file="17cap_mas_foto2.jpg" fullwidth="true"]
'),

    // ═══════════════════════════════════════════════
    // ═══════════════════════════════════════════════
    // CAPÍTULO 18: EMPLEADOS Y TÉCNICOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'También son imprescindibles',
        'numero' => '18',
        'order' => 185,
        'show_marker' => true,
        'ref_id' => 'cap18',
        'hero' => array(
            'image'               => libro_img('18cap_empl_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'bottom center',
            'title_lines'         => array(
                libro_hero_line('TAMBIÉN SON', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('IMPRESCINDIBLES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[imagen_contenido file="19cap_empl_foto3.jpg" caption="Facundo Leal, en pose victoriosa con Walla." fullwidth="true"]

[capitular]El proceso de profesionalización de las estructuras del club ha sido una tarea ineludible en el Guaguas contemporáneo y en consonancia con los nuevos tiempos que se imponen en el ámbito deportivo.[/capitular]

[imagen_contenido file="19cap_empl_foto1.jpg" caption="Adolfo Rodríguez, administrativo del club, junto a Rafael Sosa y Rubén Carreño, miembros del cuerpo técnico." fullwidth="true"]

<p>Aunque el modelo de gobierno presidencialista se mantiene, con la omnipresencia de Juan Ruiz en gestiones de todo tipo, desde la directiva se ha entendido la conveniencia de disponer de un andamiaje de orden administrativo para atender frentes diarios y de obligado cumplimiento tanto en relación directa con el equipo como en otros frentes. Ir reduciendo la dependencia directa del presidente se entiende como un símbolo de modernidad y funcionalidad sin menoscabo alguno de la jerarquía establecida en el organigrama.</p>

[cita_editorial author="Juan Ruiz"]El personal no deportivo tiene una importancia fundamental en nuestro funcionamiento por la valiosa labor que desempeña, así como su dedicación, esmero y compromiso en cada uno de sus cometidos. No salen en la foto como los jugadores, pero sí marcan, para bien, el rendimiento, porque facilitan todo y posibilitan que la vida diaria del club se desarrolle con normalidad y sin incidencias.[/cita_editorial]

<p>Resalta el propio presidente.</p>

<p>Ruiz no solo ha rearmado su junta directiva, también ha puesto cuidado y énfasis en dotar de equipo humano especializado al ámbito comercial y administrativo, empleados a tiempo completo que, antes en las dependencias de la entidad en el Centro Insular y ahora en la sede habilitada en el Gran Canaria Arena, se aplican en superar adversidades y los contratiempos propios de una entidad deportiva de alto nivel.</p>

<p>Así, para la parcela comercial, en la búsqueda de anunciantes, cobro de facturas, atención a proveedores y renovación de contratos, así como de actividades promocionales de tipo con colectivos de aficionados ejerce como directora comercial Eva Ruiz. Este cargo no se le exime de asumir funciones sobrevenidas si así lo marca la agenda institucional y se requiere su presencia.</p>

<p>De igual manera, Adolfo Rodríguez, responsable de administración, tiene bajo su potestad &ldquo;todo el papeleo derivado de la actividad del club&rdquo;, según sus impresiones y auxilia a Eva Ruiz en lo que se presente. Cuenta siempre con la voz sabia de Marek Szczesnowich, el emblemático Team Mánager, en relación a la organización de viajes y trámites que tengan que ver con las licencias, nacionales e internacionales de los jugadores de la entidad.</p>

<p>Eva Ruiz y Adolfo Rodríguez reportan al presidente de todos los efectos que tienen sus acciones, también a los miembros de la junta directiva que así lo solicitan, y, aunque en comparación con los medios de otros clubes ambos son una minoría, el sentimiento que desprenden por los colores, así como la tradición heredada en sus propias casas, son el mejor motor para que se multipliquen y abarquen más si cabe.</p>

<p>En lo que se refiere al mapa de técnicos, con Sergio Camarero como el cabeza visible de todos por sus atribuciones en el equipo profesional, Facundo Leal (segundo entrenador y analista), Rubén Carreño, Rafa Sosa y Giovanni de Vincentis completan su cuerpo de auxiliares, mientras que Manuel Santana, Tobías Cabrera y Margarita Georgieva ejercen en filiales.</p>

[imagen_contenido file="19cap_empl_foto2.jpg" caption="Eva Ruiz, directora comercial del CV Guaguas, con Margarita Georgieva." fullwidth="true"]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 19: LA PLANTILLA DEL CINCUENTENARIO
    // ═══════════════════════════════════════════════
    array(
        'title' => 'La plantilla del cincuentenario',
        'numero' => '19',
        'order' => 190,
        'show_marker' => true,
        'ref_id' => 'cap19',
        'hero' => array(
            'image'               => libro_img('19cap_plan_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'center center',
            'title_lines'         => array(
                libro_hero_line('LA PLANTILLA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('DEL CINCUENTENARIO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[foto_plantilla file="20cap_plan_foto1.jpg" alt="Plantilla del CV Guaguas del 50 aniversario, con los dorsales identificados."]

<div class="directiva-list plantilla-list-full">
<div class="directiva-item"><span class="d-num">1</span><div class="d-info"><span class="d-name">Osmany Juantorena</span><span class="d-role">Receptor</span></div></div>
<div class="directiva-item"><span class="d-num">2</span><div class="d-info"><span class="d-name">Jorge Almansa</span><span class="d-role">Receptor</span></div></div>
<div class="directiva-item"><span class="d-num">3</span><div class="d-info"><span class="d-name">Jean Pascal Diedhiou</span><span class="d-role">Central</span></div></div>
<div class="directiva-item"><span class="d-num">4</span><div class="d-info"><span class="d-name">Hélder Spencer</span><span class="d-role">Central</span></div></div>
<div class="directiva-item"><span class="d-num">5</span><div class="d-info"><span class="d-name">Martín Ramos</span><span class="d-role">Central</span></div></div>
<div class="directiva-item"><span class="d-num">6</span><div class="d-info"><span class="d-name">Augusto Colito</span><span class="d-role">Opuesto</span></div></div>
<div class="directiva-item"><span class="d-num">7</span><div class="d-info"><span class="d-name">Dobromir Dimitrov</span><span class="d-role">Colocador</span></div></div>
<div class="directiva-item"><span class="d-num">8</span><div class="d-info"><span class="d-name">Unai Larrañaga</span><span class="d-role">Líbero</span></div></div>
<div class="directiva-item"><span class="d-num">9</span><div class="d-info"><span class="d-name">Tomas Rousseaux</span><span class="d-role">Receptor</span></div></div>
<div class="directiva-item"><span class="d-num">10</span><div class="d-info"><span class="d-name">Io de Amo</span><span class="d-role">Colocador</span></div></div>
<div class="directiva-item"><span class="d-num">12</span><div class="d-info"><span class="d-name">Nico Bruno</span><span class="d-role">Receptor</span></div></div>
<div class="directiva-item"><span class="d-num">13</span><div class="d-info"><span class="d-name">Elio Montesdeoca</span><span class="d-role">Central</span></div></div>
<div class="directiva-item"><span class="d-num">14</span><div class="d-info"><span class="d-name">Ezequiel Figueroa</span><span class="d-role">Líbero</span></div></div>
</div>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 20: RECONOCIMIENTO DEL COLECTIVO ARBITRAL
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Reconocimiento del colectivo arbitral',
        'numero' => '20',
        'order' => 195,
        'show_marker' => true,
        'ref_id' => 'cap20',
        'hero' => array(
            'image'               => libro_img('20cap_reco_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'top center',
            'title_lines'         => array(
                libro_hero_line('RECONOCIMIENTO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('DEL COLECTIVO', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('ARBITRAL', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]José Antonio Santana Andueza, Alexis Fuentes y Mariola Rodríguez integran la santísima trinidad del arbitraje canario de élite, con décadas de experiencia y sabiduría en el gremio y distinguidos por un prestigio sin igual. Voces ineludibles, sus testimonios, a propósito del medio siglo de vida del club proceden y con todos los honores.[/capitular]

[seccion_header]José Antonio Santana Andueza[/seccion_header]

[imagen_contenido file="21cap_reco_foto1.jpg" caption="Homenaje brindado por el Guaguas a la trayectoria de José Antonio Santana Andueza en el gremio arbitral."]

<p>Santana Andueza (Las Palmas de Gran Canaria, 1959), de 1990 a 2014, ininterrumpidamente, como colegiado en la máxima categoría, considera que el club &ldquo;ha tenido un papel fundamental en la historia deportiva de la edad contemporánea de Canarias&rdquo;, además de una faceta educativa indudable: &ldquo;Ejercí de profesor de Educación Física y viví en primera persona el furor que se estableció en la juventud por este deporte, superando al fútbol, por las acciones promocionales del club, regalando entradas y fomentando el voleibol de manera continuada&rdquo;.</p>

<p>&ldquo;Aquel CID lleno a reventar y aquellos jugadores que fueron ídolos de toda Gran Canaria están para siempre en la memoria, igual que la nueva etapa con la refundación y nuevos éxitos de la mano de Juan Ruiz. Por eso resulta indudable su trascendencia y huella, con una contribución única y respetada en toda España. De hecho, el Guaguas desbancó a los grandes clubes del país para situarse en lo más alto y ser la referencia indiscutible&rdquo;, razona.</p>

<p>Antes de que la reglamentación estableciera el sistema de parejas cerradas para dirigir partidos, Andueza pudo, como asistente, ejercer en encuentros oficiales del Guaguas (&ldquo;recuerdo un partido ante el Unicaja en el que estaba Rafa Pascual&rdquo;) y sentir, a pie de pista, &ldquo;ambientes irrepetibles&rdquo;.</p>

<p>El homenaje que le brindó el club el pasado 25 de octubre de 2025 en reconocimiento a su trayectoria le llegó &ldquo;al fondo del corazón&rdquo; por lo que supone disfrutar de un tributo &ldquo;en casa&rdquo;.</p>

[seccion_header]Alexis Fuentes[/seccion_header]

[imagen_contenido file="21cap_reco_foto3.webp" caption="Alexis Fuentes posa con Jorge Almansa antes del inicio de un encuentro."]

<p>Alexis Fuentes (Las Palmas de Gran Canaria, 1974), con más de dos décadas en la Superliga e internacional desde 2006, valora la capacidad que ha tenido Juan Ruiz, &ldquo;al igual que el desaparecido Quico Cabrera&rdquo;, de poder &ldquo;traer a unas islas del Atlántico una cantidad de títulos que causa impresión y admiración&rdquo;.</p>

<p>&ldquo;Debe suponer un lujo para todos los canarios, amantes o no del voleibol, disponer de esta representación absolutamente increíble. Hay un mérito y un trabajo sensacional detrás de tantos años de conquistas, de competitividad, de vivir en lo más alto. Tiene que ser valorado en su justa medida y creo que es así&rdquo;, argumenta.</p>

<p>Todavía en activo y pudiendo impartir justicia, además, en los derbis isleños con el equipo de Camarero en acción, se considera &ldquo;un privilegiado&rdquo; por haber sido testigo directo del progreso y consolidación de este proyecto deportivo: &ldquo;Maestro Gumersindo, recordado empleado de la UD que vivía en el Estadio Insular, era uno de mis abuelos y, aunque me transmitió la pasión por el fútbol y por la UD, no pudo con mi vocación de ser colegiado de voleibol, en gran parte por el impacto que tuvo en mí todo lo que hizo el Guaguas. Recuerdo con cariño como él y Merino González trataban de convencerme para que me decantara por el fútbol y yo, nada, convencido de lo que hoy soy&rdquo;.</p>

[cita_editorial author="Alexis Fuentes"]La felicitación al Guaguas por su cincuentenario es, conociendo a Juan Ruiz, el principio de otro medio siglo que, con personas diferentes por ley de vida, deben mantener al Guaguas en el sitio que heredan, que es el mejor, concluye.[/cita_editorial]

[seccion_header]Mariola Rodríguez[/seccion_header]

[imagen_contenido file="21cap_reco_foto2.png" caption="Mariola Rodríguez, en el transcurso de una de sus actuaciones arbitrales."]

<p>Por su parte, Mariola Rodríguez (Santa Cruz de Tenerife, 1974), otra leyenda del arbitraje, internacional desde 2011 y de Superliga desde 2004, tampoco escatima elogios a la institución: &ldquo;El CV Guaguas es historia viva del voleibol español. Cuando empecé a arbitrar, en los años noventa, pude disfrutar de ese Guaguas irrepetible, con Juan Ruiz, junto al CV Tenerife, con Quico Cabrera al frente, que dominaban la división de honor. Dos grandes y que durante muchos años se llevaban todos los títulos&rdquo;.</p>

<p>&ldquo;Siempre recordaré mi primer partido de la Superliga, que coincidió con los últimos años de Juan Ruiz en su primera etapa. Ir a pitar al CID un Guaguas-Sonamar Palma era como ir a pitar un Real Madrid-Barcelona en fútbol. Imaginen la dimensión. Y ese Guaguas que dominó ha vuelto, con la mente privilegiada de Juan Ruiz detrás&rdquo;, enfatiza.</p>

<p>La árbitra tinerfeña siempre ha tenido un lema sagrado (&ldquo;en España, el vóley donde se juega es en Canarias&rdquo;) por la tradición de, entre otros, el Guaguas y presume que, cuando viaja a otros países por compromisos de Champions, &ldquo;la gente siempre tiene presente al Guaguas&rdquo; porque, insiste, su presencia dentro y fuera de España &ldquo;es continua&rdquo;.</p>

[cita_editorial author="Mariola Rodríguez"]Nunca debió desaparecer el club como ocurrió por desgracia y por todo lo que representa. Pero lo importante es que volvió, sigue y va a continuar. Es lo que deseo como canaria y amante del deporte y del voleibol, finaliza.[/cita_editorial]
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 21: MIGUEL ÁNGEL RAMÍREZ
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Desde la UD Las Palmas',
        'numero' => '21',
        'order' => 200,
        'show_marker' => true,
        'ref_id' => 'cap21',
        'hero' => array(
            'image'               => libro_img('21cap_migu_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'center center',
            'title_lines'         => array(
                libro_hero_line('DESDE LA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('UD LAS PALMAS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[seccion_header]MIGUEL ÁNGEL RAMÍREZ[/seccion_header]

[capitular]La historia y representatividad de la UD Las Palmas, bandera de Gran Canaria desde 1949, trasciende al deporte en la sociedad isleña y es símbolo unificador y sinónimo de prestigio. Desde la entidad amarilla, en voz de Miguel Ángel Ramírez, su presidente, hay un reconocimiento sincero y elogioso de lo que significa el CV Guaguas con su medio siglo de existencia y un palmarés que le diferencia.[/capitular]

[cita_editorial author="Miguel Ángel Ramírez"]Todos conocemos la trayectoria de superaciones y éxitos del Guaguas, que ha permitido a nuestra tierra tener un papel hegemónico en el voleibol español, con gestas y triunfos de enorme mérito y brillo. Aquellos tiempos en el CID lleno con los Camarero, Klos, Golec, Sánchez Jover... Y ahora, también, después de su refundación. En el deporte no es fácil ganar y, frecuentemente, son más habituales las derrotas. Con el Guaguas no ha sido así. Hay que valorar todo lo que ha ido logrando con el paso de los años, siempre con una exigencia máxima y compitiendo con clubes que manejaban mayores presupuestos. Repasar su colección de títulos es motivo de orgullo y satisfacción para todos los grancanarios y ahora que cumple 50 años desde la UD Las Palmas le trasladamos nuestro aprecio, admiración y felicitación, expone Ramírez.[/cita_editorial]

<p>El dirigente no obvia una mención especial a la figura de Juan Ruiz, &ldquo;el auténtico artífice de que el Guaguas sea lo que es&rdquo;.</p>

<p>&ldquo;Juan Ruiz se ha destacado por ser una persona muy importante para nuestro deporte, pues además de su labor titánica al frente del Guaguas, también brindó sus servicios a la UD en una etapa en la que fue consejero y de la que me consta su sensibilidad, compromiso y diligencia en todo lo que hace. Le conozco desde hace muchos años y, sin duda, es un referente por la entrega altruista y ejemplar que ha puesto al servicio de su club. Sigue construyendo día a día una obra que va a dejar un legado impresionante y es de justicia ponerlo en el lugar que se merece&rdquo;, argumenta.</p>

<p>Ramírez recuerda que la UD Las Palmas &ldquo;siempre estará al lado de todos los clubes, de la modalidad que sea, que dan visibilidad y reputación a Gran Canaria&rdquo; y, en este sentido, sitúa al Guaguas &ldquo;en una posición de privilegio porque así se lo ha ganado&rdquo;.</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 22: A LA VANGUARDIA DE LA TECNOLOGÍA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'A la vanguardia tecnológica',
        'numero' => '22',
        'order' => 205,
        'show_marker' => true,
        'ref_id' => 'cap22',
        'hero' => array(
            'image'               => libro_img('22cap_vang_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'center center',
            'title_lines'         => array(
                libro_hero_line('A LA VANGUARDIA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('TECNOLÓGICA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]El CV Guaguas cabalga a buen ritmo en los nuevos tiempos y con las vías de comunicación que se imponen a la hora de interactuar con aficionados, medios de comunicación y público en general. Las redes sociales y la fidelización de la comunidad propia de seguidores juegan un papel esencial en este ámbito.[/capitular]

[imagen_contenido file="23cap_vang_montaje.webp" fullwidth="true"]

<p>Y el club, sensible a esta tendencia, cuida de manera especial sus cuentas oficiales, consciente del alcance que tienen, además de aportar una ayuda incalculable en la internacionalización de la marca, otro de las grandes retos en los que se trabaja de una manera específica.</p>

[cita_editorial author="Juan Ruiz"]A estas alturas del siglo XXI se demanda otra manera de captar información. Todo ha de ser instantáneo, en la medida de lo posible personalizado y cuidado, que tenga impacto en el destinatario y que, además, genere un vínculo que le haga volver a ese canal. En el Guaguas no solo queremos prestar atención al seguidor de la tierra que puede venir al pabellón a animarnos. También al que vive aquí y, por lo que sea, no puede estar en directo con el equipo y, por supuesto, los que no residen en Gran Canaria. Y qué mejor manera que mantenerlos al día de la actualidad competitiva y con contenidos propios en torno a la plantilla y el club, asevera Juan Ruiz.[/cita_editorial]

<p>Las actualizaciones diarias, así como la elaboración de reportajes, stories y vídeos monográficos mantienen con vida y vigencia las cuentas de la entidad, con espacios exclusivos y que combinan información con entretenimiento, la fórmula que ahora se impone. &ldquo;Para llegar a un público joven, que ha institucionalizado esta vía para interaccionar, es básico ofrecer un servicio ágil, dinámico y atractivo. Sin descuidar promociones y ventajas&rdquo;, añaden desde el departamento de prensa, orientado, además, a dar a los medios de comunicación convencionales todos los datos y novedades para facilitar su difusión.</p>

<p>Aunque la masa social sostenida en las redes es fluctuante, hay una base de más de 20.000 fieles que integran la gran familia del Guaguas en el espacio digital y que es, como no podía ser menos, reclamo para anunciantes y patrocinadores ligados al escudo. En base a los impactos, algunas de las tarifas pueden tener más valor. Es la ley ahora imperante en el mundo empresarial y que tiene su extensión en el deporte, ya entendido como una industria de entretenimiento que ha de manejar audiencias e incentivarlas.</p>

<div class="redes-sociales">
<a href="https://clubvoleibolguaguas.com" target="_blank" rel="noopener" class="redes-sociales-item">
  <span class="redes-sociales-icono"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg></span>
  <span class="redes-sociales-info"><span class="redes-sociales-nombre">Web</span><span class="redes-sociales-handle">clubvoleibolguaguas.com</span></span>
</a>
<a href="https://x.com/cvguaguas" target="_blank" rel="noopener" class="redes-sociales-item">
  <span class="redes-sociales-icono"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.745l7.737-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></span>
  <span class="redes-sociales-info"><span class="redes-sociales-nombre">X (Twitter)</span><span class="redes-sociales-handle">@cvguaguas</span></span>
</a>
<a href="https://instagram.com/cvguaguas" target="_blank" rel="noopener" class="redes-sociales-item">
  <span class="redes-sociales-icono"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></span>
  <span class="redes-sociales-info"><span class="redes-sociales-nombre">Instagram</span><span class="redes-sociales-handle">@cvguaguas/</span></span>
</a>
<a href="https://www.ivoox.com/cv-guaguas" target="_blank" rel="noopener" class="redes-sociales-item">
  <span class="redes-sociales-icono"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg></span>
  <span class="redes-sociales-info"><span class="redes-sociales-nombre">Ivoox</span><span class="redes-sociales-handle">/cv guaguas</span></span>
</a>
<a href="https://youtube.com/@clubvoleibolguaguas" target="_blank" rel="noopener" class="redes-sociales-item">
  <span class="redes-sociales-icono"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></span>
  <span class="redes-sociales-info"><span class="redes-sociales-nombre">YouTube</span><span class="redes-sociales-handle">@clubvoleibolguaguas</span></span>
</a>
<a href="https://facebook.com/cvguaguas" target="_blank" rel="noopener" class="redes-sociales-item">
  <span class="redes-sociales-icono"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></span>
  <span class="redes-sociales-info"><span class="redes-sociales-nombre">Facebook</span><span class="redes-sociales-handle">@cvguaguas</span></span>
</a>
</div>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 23: SOCIOS Y ABONADOS
    // ═══════════════════════════════════════════════
    array(
        'title' => 'La familia de la afición',
        'numero' => '23',
        'order' => 210,
        'show_marker' => true,
        'ref_id' => 'cap23',
        'hero' => array(
            'image'               => libro_img('23cap_afic_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'center center',
            'title_lines'         => array(
                libro_hero_line('LA GRAN FAMILIA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('DE LA AFICIÓN', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]La recuperación del tejido social, esa afición que llenó hasta la bandera el CID en la década de los noventa y convirtió la defensa de la causa en una religión popular, es uno de los puntos cardinales del Guaguas contemporáneo, el surgido tras la refundación del año 2020.[/capitular]

<p>Después de la desaparición física del proyecto, y tras un inicio de siglo XXI marcado por las noticias negativas de toda índole y que terminaron derivando en el cierre de la actividad asociada al escudo, el reto de la reconquista popular, el de poblar las gradas en los partidos del equipo, ha ido en paralelo al encaje de piezas para configurar proyectos ganadores. Hay que considerar que hasta la nueva era de la entidad se acumulaban dos décadas de abandono progresivo de todo lo relacionado con la institución, un ciclo negro que causó un silencio y olvido difíciles de restañar. Y, como enemigo añadido, el periodo de la pandemia, coincidente con el del segundo ciclo, y que obligó a desarrollar todos los eventos deportivos con pabellones cerrados, como así aconteció con un Guaguas que celebró títulos con las gradas desiertas.</p>

<p>Pero ni esa coyuntura marcada por la incertidumbre derribó las pretensiones de volver a matrimoniar al club con la gente. Las campañas de abonados marcadas por precios al alcance de todos y con atención especial a las familias, menores y jubilados, con tarifas diferenciadas, han ido subiendo los índices de afiliados de manera progresiva, un incremento que también se ha registrado en la asistencia a los partidos, tanto en el CID como, en última instancia, ya en el Gran Canaria Arena.</p>

[cita_editorial author="CV Guaguas"]&lsquo;La fuerza del equipo, la energía de todos&rsquo; es el lema de la campaña del cincuentenario en el que se refleja a la perfección la necesidad de una simbiosis perfecta.[/cita_editorial]

<p>Y, con más de un millar de fieles ya como base estable para seguir aumentando la familia, desde la sede de la entidad no se escatiman esfuerzos e iniciativas para fortalecer esa correspondencia. Tal es así, que Juan Ruiz, siempre muy sensible en esta materia, testigo como fue de aquellas multitudes enfervorizadas con los Sánchez-Jover, Golec, Klos o Camarero, entre otros, no duda en llamar a cada abonado para agradecerle, de manera personal, su apoyo y creencia en el Guaguas. Una labora tan meticulosa como ilustrativa del valor que se da a cada carné y el empeño vigente en otorgarle la máxima distinción. Así se hace, de igual manera, con los aficionados que acuden a los partidos. La sorpresa de recibir esta comunicación de Juan Ruiz, quien, además, añade un mensaje de optimismo y ambición a sus palabras de reconocimiento (&laquo;no vamos a fallar a su confianza porque seguiremos trayendo títulos&raquo;), ha sido bienvenida por los beneficiarios, tal y como reconoce el dirigente.</p>

<p>En realidad, no es nuevo este gesto, pues en temporadas anteriores también lo hizo, pero no deja de ser una iniciativa &laquo;que hace club y ayuda a engrandecerlo&raquo; por brindar un trato personalizado y sensible a la afición, que no deja de ser el sustento principal de todos sus esfuerzos. Los jugadores, también muy comprometidos con esta labor, tampoco dudan en aportar su presencia y tiempo en todo tipo de actos e iniciativas para tal fin.</p>

<p>El mérito de sustentar un núcleo estable de socios con la amplia oferta de equipos de élite que hay en Gran Canaria no debe pasar desapercibido. El talante conciliador del club, que no rivaliza con otras entidades isleñas y siempre ofrece &ldquo;mano tendida&rdquo; en lo que pueda ayudar, tal y como pondera Ruiz, colabora en esa dirección, y desde la humildad característica pese a disponer de un palmarés de logros sin igual en Canarias.</p>
'),

    // ═══════════════════════════════════════════════
    // CAPÍTULO 24: EMPRESARIOS DE LA TIERRA
    // ═══════════════════════════════════════════════
    array(
        'title' => 'Vínculos empresariales',
        'numero' => '24',
        'order' => 215,
        'show_marker' => true,
        'ref_id' => 'cap24',
        'hero' => array(
            'image'             => libro_img('hero-estatutos.jpg'),
            'overlay'           => 'rgba(212, 175, 55, 0.80)',
            'icon'              => 'custom',
            'custom_icon'       => $star,
            'icon_width'        => 60,
            'icon_height'       => 60,
            'alignment'         => 'left',
            'vertical'          => 'center',
            'height'            => '600px',
            'background_position' => 'center center',
            'title_lines'       => array(libro_hero_line('VÍNCULOS', '#1a237e', '#FFFFFF', 'black'), libro_hero_line('EMPRESARIALES', '#1a237e', '#FFFFFF', 'black')),
        ),
        'content' => '',
    ),

    array('title' => 'Vínculos empresariales', 'numero' => '', 'order' => 2151, 'show_marker' => false, 'parent_ref' => 'cap24',
        'hero' => array(
            'image'             => libro_img('24cap_vinc_hero.jpg'),
            'overlay'           => 'rgba(0,0,0,0.25)',
            'icon'              => 'custom',
            'custom_icon'       => libro_img('estrella-icon.svg'),
            'custom_icon_color' => 'hsl(45 100% 50%)',
            'icon_width'        => 40,
            'icon_height'       => 40,
            'alignment'         => 'center',
            'vertical'          => 'center',
            'height'            => '600px',
            'background_position' => 'center center',
            'title_lines'       => array(
                libro_hero_line('VÍNCULOS', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('EMPRESARIALES', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]Además de las subvenciones públicas del Cabildo de Gran Canaria, del Ayuntamiento de Las Palmas de Gran Canaria y del Gobierno de Canarias, ayudas a las que tiene derecho el Guaguas por su condición de club de élite y representativo, con el añadido de ganar títulos y disfrutar de un prestigio histórico fuera de debates, Juan Ruiz y toda su junta directiva han dado un paso más en la viabilidad y sostenibilidad del proyecto esmerándose en la captación de apoyos por parte del empresariado de la tierra.[/capitular]

[imagen_contenido file="25cap_empr_foto5.jpg" fullwidth="true" caption="Presentación de temporada del CV Guaguas junto a sus patrocinadores."]

<p>Y se lleva con mucho orgullo la consecución de una amplia cobertura en este apartado, sin tener nada que envidiar a otras instituciones porque, como admite el presidente, &ldquo;el apoyo es masivo, decidido y con reciprocidad&rdquo;. Como advierte el mandatario, las marcas que se asocian a las siglas corporativas ven un retorno en términos relacionados con el espíritu ganador, la representatividad y la fama que van implícitas al escudo.</p>

[cita_editorial author="Juan Ruiz"]El Guaguas lleva en su esencia expandir Canarias, ser embajador de su tierra, llevar más allá de nuestras islas los símbolos y siglas que ayudan al desarrollo de nuestra región. Y captar la confianza y patrocinio de empresas que aportan empleo, riqueza y ejemplaridad a Gran Canaria es una manera perfecta de hacerlo.[/cita_editorial]

<p>Resalta Ruiz, quien encabeza todas las gestiones, junto a sus ejecutivos, para ampliar la familia de apoyos privados y, además fidelizarlos.</p>

<p>El Guaguas se ha ganado un nicho de mercado &ldquo;indiscutible y apreciado&rdquo; en el empresariado local por su política competente de tarifas brindando la aureola única que posee atendiendo a su palmarés. Y gestos como el de dedicar cada trofeo a sus patrocinadores, cuidando al máximo los detalles, colaboran en una sinergia establecida que permite, temporada tras temporada, asegurar una vía de ingresos fundamental para vertebrar cada proyecto, temporada a temporada y sin perder las ambiciones competitivas.</p>

[cita_editorial author="Juan Ruiz"]Nunca nos hemos abandonado al dinero público. Y nuestro método de trabajo contempla explorar continuamente financiación extra. Nos hemos acostumbrado a ser competitivos como el que más tanto en España como en Europa con presupuestos ajustados pero en los que el cumplimiento de todas las obligaciones es sagrado y además por parte de unos directivos que no cobran un céntimo por los servicios que prestan.[/cita_editorial]

<p>El presidente ya fue pionero, a mitad de los años ochenta, y como tarjeta de presentación en su recién estrenado mandato, en privilegiar la independencia económica del club. Por aquel entonces causó elogio generalizado su contrato con Guaguas Municipales, que terminaría dando la denominación al equipo. Y, ya desde esa época, y bajo su dirección, jamás faltaron los ingresos derivados de la pequeña y mediana empresa para apuntalar a la gran marca predominante.</p>

<p>Décadas después, hoy se mantiene ese modelo que combina diferentes escalones en cuanto a participaciones económicas &ldquo;pero todas necesarias, fundamentales y valoradas&rdquo;.</p>

<div class="patrocinador-fotos-grid">
<div class="patrocinador-fotos-row">
<figure class="content-image"><div class="content-image__inner"><img src="' . libro_img('25cap_empr_foto4.jpg') . '" alt="Juan Ruiz junto al representante de Aguas de Firgas."></div><figcaption>Juan Ruiz junto al representante de Aguas de Firgas en la renovación del acuerdo de patrocinio.</figcaption></figure>
<figure class="content-image"><div class="content-image__inner"><img src="' . libro_img('25cap_empr_foto3.jpg') . '" alt="Firma del acuerdo con Toyota Canarias."></div><figcaption>Firma del acuerdo de patrocinio con Toyota Canarias, en presencia de Osmany Juantorena.</figcaption></figure>
</div>
<figure class="content-image"><div class="content-image__inner"><img src="' . libro_img('25cap_empr_foto1.jpg') . '" alt="Entrega de camiseta firmada en el CID."></div><figcaption>Entrega de la camiseta firmada del CV Guaguas en el Centro Insular de Deportes.</figcaption></figure>
</div>
'),

    array('title' => 'Agua Firgas', 'numero' => '', 'order' => 2152, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('firgas.svg') . '" alt="Firgas Aquavia"></div>
<div class="patrocinador-texto">
<p>Para Aguas de Firgas vincular la marca al Guaguas es una apuesta por lo nuestro, por los deportistas que representan nuestra tierra aquí y fuera de Canarias y además son los números uno. Supone un refuerzo, además, para nuestra marca porque el Guaguas es un equipo campeón, un emblema de Canarias, como Aguas de Firgas como compañía 100% canaria y líder del mercado regional.</p>
<p>La lucha, la capacidad ganadora, los valores como equipo y la cultura del esfuerzo son las características del Guaguas con las que nos sentimos más identificados.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Aguas Minerales de Firgas S.A. &bull; <strong>Año de fundación:</strong> 1930 &bull; <strong>Dirección de la sede principal:</strong> Autovía GC-2, Km.3,Túnel Aguas de Firgas – 35010, Las Palmas de Gran Canaria &bull; <strong>Número de empleados:</strong> Más de 400 (entre personal propio y autónomos distribuidores) &bull; <strong>Naturaleza de la misma:</strong> Embotellado y distribución de aguas y bebidas refrescantes.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Redes sociales</p>
<p><strong>Instagram:</strong> <a href="https://instagram.com/aguasdefirgas.oficial" target="_blank" rel="noopener">@aguasdefirgas.oficial</a></p>
</div>
</div>
'),

    array('title' => 'Icare', 'numero' => '', 'order' => 2153, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('icare.svg') . '" alt="Icare"></div>
<div class="patrocinador-texto">
<p>Para Icare la unión con el CV Guaguas representa un compromiso con nuestras señas de identidad y un apoyo a un proyecto deportivo basado en el compromiso y el esfuerzo y que nos representa los logros y valores de nuestra comunidad. Y por supuesto que nos refuerza. Es un orgullo colaborar con el equipo deportivo más laureado de Canarias y uno de los mejores equipos de voleibol de España de todos los tiempos, y sin duda el mejor de los últimos años.</p>
<p>Apoyamos al club desde septiembre del año 2020.</p>
<p>Las señas de identidad de la empresa ven reflejadas en el Guaguas son las del esfuerzo , compromiso y defensa de nuestros valores como comunidad.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Instituto Canario de Retina (Icare) &bull; <strong>Año de fundación:</strong> 2013 &bull; <strong>Dirección de la sede principal:</strong> León y Castillo, 75, bajo. 35003, Las Palmas de Gran Canaria &bull; <strong>Número de empleados:</strong> 11 &bull; <strong>Naturaleza de la misma:</strong> Clínica oftalmológica.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web y redes sociales</p>
<p><strong>Web:</strong> <a href="https://www.retinacanarias.com" target="_blank" rel="noopener">www.retinacanarias.com</a> &bull; <strong>Instagram:</strong> <a href="https://instagram.com/icare.oftalmologia" target="_blank" rel="noopener">@icare.oftalmologia</a></p>
</div>
</div>
'),

    array('title' => 'R2 Hotels', 'numero' => '', 'order' => 2154, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('r2hotels.svg') . '" alt="R2 Hotels"></div>
<div class="patrocinador-texto">
<p>Para R2 Hotels, patrocinar al Club Voleibol Guaguas va mucho más allá de poner nuestro logotipo en una camiseta. Supone apoyar a un proyecto deportivo referente en Canarias, que representa esfuerzo, disciplina y trabajo en equipo, valores que también forman parte de nuestro día a día en los hoteles.</p>
<p>Además, este patrocinio nos permite conectar de una forma muy auténtica con nuestra tierra y con las personas que nos visitan: muchos de nuestros clientes descubren el Guaguas a través de nosotros, y nosotros sentimos sus triunfos como propios, como un aficionado más. En cierto modo, compartir este camino con el club es también una forma de devolver a Canarias parte de todo lo que nos ha dado.</p>
<p>Estar unidos a un club histórico y ganador como el Club Voleibol Guaguas refuerza nuestro posicionamiento como una empresa que apuesta por la excelencia y los proyectos sólidos. Cuando el Guaguas compite y gana, no solo gana el club: se refuerza la imagen de Canarias y también se proyectan los valores con los que queremos que se identifique R2 Hotels. Formar parte de su historia de éxitos, especialmente en esta etapa en la que el club vuelve a la élite del voleibol español, nos sitúa al lado de un referente deportivo y emocional para muchos canarios. Esa asociación con un escudo ganador transmite confianza, compromiso y ambición, cualidades que queremos que nuestros huéspedes perciban también en nuestra marca.</p>
<p>Apoyamos al Club Voleibol Guaguas desde 2023, un punto de partida que para nosotros no es una simple fecha, sino el inicio de una relación que queremos que sea duradera. Desde entonces hemos ido afianzando esta alianza, no solo como patrocinadores, sino como auténticos compañeros de viaje en un proyecto común: impulsar el deporte, el talento local y la marca Canarias. Nuestra intención es seguir construyendo, temporada tras temporada, una colaboración que crezca en acciones, impacto y cercanía con la afición.</p>
<p>Nos vemos reflejados en el Guaguas en varios aspectos clave: su espíritu ganador, su constancia y su capacidad para reinventarse sin perder sus raíces. El club ha demostrado que, con esfuerzo y una visión clara, es posible mantenerse en la élite y volver a lo más alto, algo muy parecido al camino que recorremos en el sector hotelero. También compartimos una profunda pasión por Canarias. Tanto el Guaguas como R2 Hotels llevamos el nombre y la imagen de las islas por muchos lugares, y sentimos la responsabilidad de ser buenos embajadores de nuestro territorio. La cercanía con la gente, el trato humano y el orgullo de lo local son valores que definen tanto al club como a nuestra empresa.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> SLR Turismo España S.L. (nombre comercial R2 Hotels) &bull; <strong>Año de fundación:</strong> 2015 &bull; <strong>Dirección de la sede principal:</strong> Calle Artistas Canarios, 8. 35627 Costa Calma Las Palmas &bull; <strong>Número de empleados:</strong> 750 &bull; <strong>Naturaleza de la misma:</strong> Cadena hotelera.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Redes sociales</p>
<p><strong>Instagram:</strong> <a href="https://instagram.com/r2hotelsofficial" target="_blank" rel="noopener">r2hotelsofficial</a> &bull; <strong>Facebook:</strong> <a href="https://facebook.com/r2hotels" target="_blank" rel="noopener">r2hotels</a> &bull; <strong>LinkedIn:</strong> <a href="https://linkedin.com/company/r2-hotels" target="_blank" rel="noopener">r2-hotels</a> &bull; <strong>TikTok:</strong> <a href="https://tiktok.com/@r2hotels" target="_blank" rel="noopener">@r2hotels</a></p>
</div>
</div>
'),

    array('title' => 'Hoteles Vistaflor', 'numero' => '', 'order' => 2155, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('vistaflor.svg') . '" alt="Hoteles Vistaflor"></div>
<div class="patrocinador-texto">
<p>Cuando comenzamos este patrocinio, el club nos pidió apoyo en un momento muy complicado tras la pandemia y las dificultades económicas que atravesaba. Decidimos apostar por la historia de un equipo con los mayores éxitos de Canarias, un referente del deporte regional, y entendimos que era importante respaldar esos valores que, con tan pocos recursos, siguen sacando adelante un proyecto tan significativo. Por ello apoyamos al club desde 2021.</p>
<p>La identidad del Guaguas conecta de manera muy especial con la de Hoteles Vistaflor: Ambos somos organizaciones que han crecido desde el esfuerzo diario, con una filosofía humilde, familiar y luchadora. Somos una empresa pequeña, pero con una gran dedicación, igual que el espíritu del equipo. Trabajamos como una gran familia para ofrecer siempre a nuestros clientes una atención cercana y una gran sonrisa.</p>
<p>Bajo la dirección de Domingo Espino Hernández, CEO de la empresa, seguimos consolidando nuestro compromiso con el deporte, con la isla y con las personas que forman parte de Hoteles Vistaflor.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Bungalows Vistaflor &bull; <strong>Año de fundación:</strong> 1987 &bull; <strong>Dirección de la sede principal:</strong> Av. Touroperador Neckermann, 1A. 35100 -Maspalomas. Las Palmas &bull; <strong>Número de empleados:</strong> 88 &bull; <strong>Naturaleza de la misma:</strong> Actividad hotelera, somos promotores y colaboradores de numerosos eventos deportivos y sociales, como la Liga Fútbol Promise, congresos de baile, competiciones de cartas, torneos de baloncesto y muchas otras iniciativas.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web y redes sociales</p>
<p><strong>Web:</strong> <a href="https://www.bungalowsvistaflor.com" target="_blank" rel="noopener">www.bungalowsvistaflor.com</a> &bull; <strong>Instagram:</strong> <a href="https://instagram.com/vistaflorbungalows" target="_blank" rel="noopener">@vistaflorbungalows</a></p>
</div>
</div>
'),

    array('title' => 'El Extinguidor', 'numero' => '', 'order' => 2156, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('elextinguidor.svg') . '" alt="El Extinguidor"></div>
<div class="patrocinador-texto">
<p>Para El Extinguidor el patrocinio al CV Guaguas supone más visibilidad de cara al público local, al estar en el mercado con un equipo representativo como el que más a nivel insular. Nuestro patrocinio al club surgió en el año 2020.</p>
<p>Seriedad, esfuerzo y transparencia son los valores del CV Guaguas con los que nos sentimos identificados y representados.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> El Extinguidor, S.A. &bull; <strong>Año de fundación:</strong> 1983 &bull; <strong>Dirección:</strong> C/ Dr. Juan Domínguez Pérez, nº 7 – 35008 Polígono Industrial El Sebadal, Las Palmas de Gran Canaria &bull; <strong>Número de empleados:</strong> 26 &bull; <strong>Naturaleza:</strong> Mantenimientos de Sistemas contra incendios, Robo y CCTV.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web</p>
<p><strong>Web:</strong> <a href="https://elextinguidor.com" target="_blank" rel="noopener">elextinguidor.com</a></p>
<p><strong>Redes sociales:</strong> <a href="https://elextinguidor.com" target="_blank" rel="noopener">elextinguidor.com</a></p>
</div>
</div>
'),

    array('title' => 'AFS Formación', 'numero' => '', 'order' => 2157, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('afs.svg') . '" alt="AFS Formación"></div>
<div class="patrocinador-texto">
<p>Para AFS Formación y Aula de Formación Superior, el patrocinio es una declaración de principios: apostar por el esfuerzo, la excelencia y el trabajo en equipo. Un escudo ganador no solo refuerza la marca; nos obliga a estar a la altura. Cuando te alineas con un club que compite para ganar, también tú entrenas mejor, aunque sea fuera de la pista.</p>
<p>Además, este patrocinio es una forma de impulsar el talento deportivo canario y de acercar esos ejemplos de compromiso y superación a nuestro alumnado. Queremos que nuestros estudiantes vean en el deporte una fuente de inspiración, un espejo de los valores que promovemos en el aula: disciplina, trabajo en equipo y pasión por alcanzar metas ambiciosas.</p>
<p>Apoyamos al CV Guaguas desde 2020 y nos reconocemos en la cultura del Guaguas: disciplina, mejora continua, constancia y ambición con los pies en la tierra. Son valores que también definen nuestra forma de trabajar. Igual que en la cancha, en la formación profesional solo cuentan los resultados: capacitar, certificar y transformar el talento en oportunidades reales de empleo. Compartimos la misma mentalidad ganadora, la misma búsqueda de la excelencia y el mismo compromiso con el progreso de las personas y del entorno.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Aula de Formación Superior, S.L. y Centro de Formación AFS &bull; <strong>Fundación:</strong> 15 enero 1996 &bull; <strong>Dirección:</strong> Avda. Carlos V, 110 Ingenio, Las Palmas – 35240 &bull; <strong>Número de empleados:</strong> 50 &bull; <strong>Naturaleza:</strong> Centro de formación especializado en certificados de profesionalidad y programas de formación para el empleo.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web y redes sociales</p>
<p><strong>Web:</strong> <a href="https://grupoafs.com" target="_blank" rel="noopener">grupoafs.com</a> &bull; <a href="https://afsformacion.com" target="_blank" rel="noopener">afsformacion.com</a> &bull; <a href="https://aulaformacionsuperior.com" target="_blank" rel="noopener">aulaformacionsuperior.com</a> &bull; <strong>LinkedIn:</strong> <a href="https://linkedin.com/company/grupoafs" target="_blank" rel="noopener">@grupoafs</a> &bull; <strong>Instagram:</strong> <a href="https://instagram.com/grupoafs" target="_blank" rel="noopener">@grupoafs</a> &bull; <strong>Facebook:</strong> <a href="https://facebook.com/grupoafs" target="_blank" rel="noopener">grupoafs</a></p>
</div>
</div>
'),

    array('title' => 'Universidad del Atlántico Medio', 'numero' => '', 'order' => 2158, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('universidad.svg') . '" alt="Universidad del Atlántico Medio"></div>
<div class="patrocinador-texto">
<p>Desde un principio entendimos que los valores de esfuerzo, compromiso, dedicación y generosidad que desprende el CV Guaguas y su directiva, así como los resultados que éstos valores han generado en lo deportivo, significaban para la Universidad del Atlántico Medio una suma con nuestros propios valores, visión y misión como institución que forma personas en valores.</p>
<p>La trayectoria de ambas instituciones y la suma de los valores, sin lugar a dudas refuerza la marca de ambas. Arrancamos de la mano del presidente Juan Ruiz, a partir de 2020, nuestro patrocinio. Los valores de compromiso y generosidad en el esfuerzo y la imagen que ello transmite son los que nos identifican con el CV Guaguas.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Universidad del Atlántico Medio &bull; <strong>Año de fundación:</strong> Desde 1988, con reconocimiento del Parlamento de Canarias en 2015 &bull; <strong>Dirección de la sede principal:</strong> Campus en carretera de Quilmes, nº 37 (Tafira Baja) &bull; <strong>Número de empleados:</strong> 295 &bull; <strong>Naturaleza de la misma:</strong> Formación universitaria y programas directivos.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Canales de comunicación</p>
<p><a href="https://linktr.ee/atlanticomedio" target="_blank" rel="noopener">linktr.ee/atlanticomedio</a></p>
</div>
</div>
'),

    array('title' => 'HiperDino', 'numero' => '', 'order' => 2159, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('hiperdino.svg') . '" alt="HiperDino"></div>
<div class="patrocinador-texto">
<p>Para HiperDino, cadena de supermercados 100% canaria, apoyar al Club de Voleibol Guaguas Municipales simboliza nuestro compromiso de confianza, de apoyo y de vocación al deporte, especialmente a esta práctica deportiva tan arraigada en nuestras islas y que inculca valores claves para nuestra empresa como es el trabajo en equipo y la importancia de la preparación física y mental para alcanzar unos objetivos planificados y que se encuentran establecidos por una hoja de ruta que en este caso es la que define y marca en entrenador y el capitán de equipo.</p>
<p>Este año apoyamos la cuarta temporada y han sido cuatro años de grandes logros y de consolidar el reconocimiento deportivo y social que los canarios tienen hacia el club, un club que forma parte de la esencia de nuestras islas y que refleja los valores que nos representan.</p>
<p>El trabajo en equipo, en coordinación y con la definición planificada de los roles que cada jugador del equipo tiene asignadas y ese espíritu competitivo pero asertivo, reflejan perfectamente la filosofía de nuestra cadena de supermercados en donde trabajan 10.000 personas. Consideramos que tanto en el deporte como en la empresa es importante ser competitivos, pero siempre con la mirada puesta, en el caso de la empresa, de ofrecer un producto y una atención de calidad a nuestro cliente y de disfrutar de la práctica deportiva en el caso de la competición.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> HiperDino &bull; <strong>Fundación:</strong> El 28 de octubre de 1985 abrió la primera tienda HiperDino en Miller Bajo. &bull; <strong>Dirección de la sede principal:</strong> calle Luis Correa Medina 9, 35013 Las Palmas de Gran Canaria &bull; <strong>Número de empleados:</strong> 9.963 empleados a octubre de 2025 &bull; <strong>Naturaleza de la misma:</strong> Sector de la alimentación.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web y redes sociales</p>
<p><strong>Web:</strong> <a href="https://hiperdino.es" target="_blank" rel="noopener">hiperdino.es</a> &bull; <strong>Facebook:</strong> <a href="https://facebook.com/HiperdinoSupermercados.es" target="_blank" rel="noopener">HiperdinoSupermercados.es</a> &bull; <strong>Twitter:</strong> <a href="https://x.com/HiperDino_" target="_blank" rel="noopener">@HiperDino_</a> &bull; <strong>Instagram:</strong> <a href="https://instagram.com/hiperdino_" target="_blank" rel="noopener">@hiperdino_</a> &bull; <strong>TikTok:</strong> <a href="https://tiktok.com/@hiperdino_" target="_blank" rel="noopener">@hiperdino_</a> &bull; <strong>YouTube:</strong> <a href="https://youtube.com/@HiperDinoSupermercadosCanarias" target="_blank" rel="noopener">@HiperDinoSupermercadosCanarias</a> &bull; <strong>LinkedIn:</strong> <a href="https://linkedin.com/company/hiperdino-supermercados" target="_blank" rel="noopener">hiperdino-supermercados</a></p>
</div>
</div>
'),

    array('title' => 'Toyota Canarias', 'numero' => '', 'order' => 2160, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('toyota.svg') . '" alt="Toyota Canarias"></div>
<div class="patrocinador-texto">
<p>Para Toyota Canarias, el patrocinio de este equipo de la máxima división de voleibol masculino representa mucho más que un acuerdo de patrocinio con fines comerciales. En este caso, el patrocinio del Club Voleibol Guaguas es una oportunidad para impulsar valores compartidos, como el trabajo en equipo, el esfuerzo constante y poder trasladar un mensaje a los más jóvenes sobre la importancia de una vida activa y saludable. Además, este patrocinio nos permite contribuir al desarrollo del deporte canario y fortalecer los vínculos con nuestra comunidad. Para Toyota el deporte es una actividad transformadora ya que proyecta un modelo de conducta que contribuye al bienestar y la cohesión social.</p>
<p>Sin duda hay una transferencia de atributos. Guaguas probablemente posee el mayor palmarés deportivo de Canarias pero no solo son sus éxitos en la cancha lo importante. Estamos vinculando nuestra imagen a valores positivos como la dedicación, la superación, el espíritu competitivo, la tolerancia y el trabajo en equipo.</p>
<p>Nos acabamos de incorporar este año al proyecto del Guaguas. Llevamos décadas vinculados al baloncesto y desde 2019 al fútbol femenino. Esta nueva colaboración nos está permitiendo aprender y compartir una nueva experiencia con un club extraordinario, un sólido equipo y una afición ejemplar.</p>

<p>La pasión por el trabajo en equipo, con la idea de que sin esfuerzo, dedicación y determinación no se alcanzan los resultados y la humildad con la que se debe abordar el éxito son los valores del Guaguas con los que nos sentimos plenamente identificados.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Toyota Canarias &bull; <strong>Año de fundación:</strong> 1973 &bull; <strong>Dirección:</strong> Diego Vega Sarmiento, 5 – 35004, Las Palmas de Gran Canaria &bull; <strong>Naturaleza:</strong> Toyota Canarias distribuye y comercializa los vehículos de las marcas Toyota y Lexus en las Islas Canarias y presta servicios de posventa y venta de recambios y accesorios.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web y redes sociales</p>
<p><strong>Web:</strong> <a href="https://toyota-canarias.es" target="_blank" rel="noopener">toyota-canarias.es</a> &bull; <strong>X:</strong> <a href="https://x.com/toyotacanarias" target="_blank" rel="noopener">@toyotacanarias</a> &bull; <strong>Instagram:</strong> <a href="https://instagram.com/toyotacanarias" target="_blank" rel="noopener">@toyotacanarias</a> &bull; <a href="https://linktr.ee/toyotacanarias" target="_blank" rel="noopener">linktr.ee/toyotacanarias</a></p>
</div>
</div>
'),

    array('title' => 'Acerbis', 'numero' => '', 'order' => 2161, 'show_marker' => false, 'parent_ref' => 'cap24',
        'ocultar_titulo' => true,
        'content' => '
<div class="patrocinador-page">
<div class="patrocinador-logo"><img src="' . libro_img('acerbis.svg') . '" alt="Acerbis"></div>
<div class="patrocinador-texto">
<p>Para Acerbis, el patrocinio del CV Guaguas va más allá de la simple visibilidad y representa una elección de valores. Nos identificamos con un proyecto que trabaja con integridad, construyendo una identidad sólida a través de la organización, el respeto y las personas.</p>
<p>Hay también un fuerte valor simbólico en el vínculo con el mundo de las islas y el mar, que evoca libertad y horizontes abiertos, encajando perfectamente con nuestra marca, siempre orientada a mirar lejos y evolucionar en los mercados internacionales sin perder su identidad.</p>
<p>Apoyar a un equipo ganador refuerza nuestra credibilidad, especialmente cuando la victoria nace de la simplicidad operativa, el espíritu de equipo y la evolución continua, principios que Acerbis reconoce y comparte. Por eso, el patrocinio no es solo una alianza deportiva, sino un camino común basado en la responsabilidad y el crecimiento constante.</p>
<p>Este es nuestro tercer año apoyando al equipo, y con nuestra equipación el club ha ganado varios títulos, proporcionándonos muchas satisfacciones.</p>
<p>En el CV Guaguas encontramos muchos elementos de nuestro ADN. El espíritu de equipo: un proyecto donde dirección, personal y atletas comparten responsabilidades y objetivos, el mismo principio que guía a Acerbis cada día. La integridad: construyendo éxito con identidad clara y decisiones transparentes. La responsabilidad: afrontando cada temporada con seriedad y visión a largo plazo. La sencillez como concreción: un enfoque directo orientado a resultados, apostando por la eficacia del trabajo diario. Y la evolución continua: trabajando constantemente para crecer y subir el listón, el mismo impulso que ha permitido a Acerbis evolucionar durante más de cincuenta años.</p>
</div>
<div class="patrocinador-ficha">
<p class="patrocinador-ficha-titulo">Ficha técnica de la empresa</p>
<p><strong>Nombre completo:</strong> Acerbis S.p.A &bull; <strong>Año de fundación:</strong> 1973 &bull; <strong>Dirección de la sede principal:</strong> Via Serio 37 – 24021 Albino (BG) Italy &bull; <strong>Número de empleados:</strong> 450</p>
<p><strong>Naturaleza de la empresa:</strong> Acerbis es una empresa industrial italiana que nace como fabricante de componentes plásticos para motocicletas y ropa para todo tipo de usos, vistiendo tanto a motociclistas aficionados como profesionales, y ampliando su know-how hasta convertirse en una marca internacional reconocida por su calidad, funcionalidad e innovación. También opera en el sector de la ropa deportiva, desarrollando soluciones técnicas diseñadas para el rendimiento y la comodidad, centrándose siempre en el usuario final y en las necesidades reales de quienes practican deporte a diario.</p>
</div>
<div class="patrocinador-redes">
<p class="patrocinador-redes-titulo">Web y redes sociales</p>
<p><strong>Web:</strong> <a href="https://acerbiscentralsport.com" target="_blank" rel="noopener">acerbiscentralsport.com</a> &bull; <strong>Facebook:</strong> <a href="https://facebook.com/AcerbisSport" target="_blank" rel="noopener">AcerbisSport</a> &bull; <strong>Instagram:</strong> <a href="https://instagram.com/acerbissport" target="_blank" rel="noopener">@acerbissport</a> &bull; <strong>YouTube:</strong> <a href="https://youtube.com/@ACERBIS1973" target="_blank" rel="noopener">@ACERBIS1973</a> &bull; <strong>LinkedIn:</strong> <a href="https://linkedin.com/company/acerbis-italia-spa" target="_blank" rel="noopener">acerbis-italia-spa</a></p>
</div>
</div>
'),

        array(
        'title' => 'La gala conmemorativa',
        'numero' => '25',
        'order' => 2200,
        'show_marker' => true,
        'ref_id' => 'cap25',
        'hero' => array(
            'image'               => libro_img('25cap_gala_hero.jpg'),
            'overlay'             => 'rgba(0,0,0,0.25)',
            'icon'                => 'custom',
            'custom_icon'         => libro_img('estrella-icon.svg'),
            'custom_icon_color'   => 'hsl(45 100% 50%)',
            'icon_width'          => 40,
            'icon_height'         => 40,
            'alignment'           => 'center',
            'vertical'            => 'center',
            'height'              => '600px',
            'background_position' => 'center center',
            'title_lines'         => array(
                libro_hero_line('LA GALA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
                libro_hero_line('CONMEMORATIVA', 'hsl(220 50% 12%)', 'hsl(45 100% 50%)', 'black'),
            ),
        ),
        'content' => '
[capitular]Fue el pasado 23 de mayo, en el emblemático hotel Santa Catalina y con un éxito de convocatoria a la altura de la ocasión: la cena de gala para conmemorar el cincuenta aniversario de la fundación del club.[/capitular]

<p>Durante meses se preparó con empeño e ilusión esta velada, bajo un cuidado protocolo y sin desatender detalle alguno. Todo tenía que salir a la perfección y así fue. Toda la gran familia del CV Guaguas, jugadores, dirigentes, empleados y miembros de antigua militancia, agasajaron a autoridades y personalidades de la sociedad grancanaria, citadas para tomar parte de un acto simbólico y en el que se evidenció la fuerza, vigencia y representatividad del escudo.</p>

<p>El presidente del Cabildo de Gran Canaria, Antonio Morales, la alcaldesa capitalina, Carolina Darias, y el viceconsejero de Deportes del Gobierno de Canarias, Ángel Sabroso, respondieron a la invitación cursada y, en sus respectivos parlamentos, no ahorraron elogios y parabienes al pasado, presente y futuro del Guaguas, poniendo de relieve su impacto y prestigio dentro y fuera de la cancha. Ese valor añadido, acompañado por un palmarés sin igual, que le otorga al equipo una exclusividad reluciente.</p>

<p>Un vídeo que sintetizó los éxitos contemporáneos, y que levantó el aplauso unánime de los presentes, contextualizó un entorno marcado por la satisfacción compartida de ser testigos del medio centenario de una institución deportiva que ya forma parte de la historia por derecho propio.</p>

<p>Juan Ruiz no pudo evitar su emoción al tomar la palabra y se comprometió a mantener la línea de progreso, eficiencia y ambición que han llevado al Guaguas a la élite del voleibol continental, además de haber implantado una hegemonía nacional que nadie discute y se certifica con su cascada de títulos temporada a temporada.</p>

<p>La actuación del artista majorero Domingo Rodríguez, El Colorao, junto al guitarrista Javier Cerpa y el cantante Pedro Manuel Afonso, puso el colofón perfecto ante los 200 asistentes.</p>

[imagen_contenido file="25cap_gala_foto1.jpg" alt="Invitados durante la cena de gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto2.jpg" alt="Invitadas junto a Juan Ruiz" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto3.jpg" alt="Autoridades e invitados en la gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto4.jpg" alt="Invitados en la cena de gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto5.jpg" alt="Representantes del club e invitados" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto6.jpg" alt="Intervencion durante la gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto7.jpg" alt="Publico durante la cena de gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto8.jpg" alt="Intervencion en el escenario" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto9.jpg" alt="Intervencion en el escenario" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto10.jpg" alt="Intervencion en el escenario" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto11.jpg" alt="Grupo del Club Voleibol Guaguas" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto12.jpg" alt="Actuacion musical durante la gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto13.jpg" alt="Invitados durante la cena" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto14.jpg" alt="Jugadores durante la gala" fullwidth="true"]
[imagen_contenido file="25cap_gala_foto15.jpg" alt="Juan Ruiz durante su intervencion" fullwidth="true"]
',
        ),

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
// El reimportador borra todos los capítulos existentes. Se deja el código como
// referencia, pero no se activa para proteger el contenido real del libro.
// add_action('admin_init', 'libro_add_reimport_button');

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
// add_filter('views_edit-capitulo', 'libro_add_reimport_link');

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

/**
 * Crear páginas legales (Aviso legal, Política de cookies, Política de privacidad)
 */
function libro_create_legal_pages() {
    $legal_pages = array(

        // ── Aviso legal ──────────────────────────────────────────
        array(
            'slug'    => 'aviso-legal',
            'title'   => 'Aviso legal',
            'content' => '
<div class="reading-content">
<p>CV Guaguas pone a disposición de los usuarios el presente documento, con el que pretende dar cumplimiento a las obligaciones dispuestas en la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico (LSSICE), BOE N.º 166, así como informar a todos los usuarios del sitio web respecto a cuáles son las condiciones de uso.</p>
<p>Toda persona que acceda a este sitio web asume el papel de usuario, comprometiéndose a la observancia y cumplimiento riguroso de las disposiciones aquí dispuestas, así como a cualquier otra disposición legal que fuera de aplicación.</p>
<p>CV Guaguas se reserva el derecho de modificar cualquier tipo de información que pudiera aparecer en el sitio web, sin que exista obligación de preavisar o poner en conocimiento de los usuarios dichas obligaciones, entendiéndose como suficiente con la publicación en el sitio web de CV Guaguas.</p>

<span class="libro-section-title">Datos identificativos</span>
<div class="libro-card">
<div class="libro-meta-grid">
<div class="libro-meta-row"><span class="libro-meta-key">Nombre de dominio</span><span class="libro-meta-val"><a href="http://clubvoleibolguaguas.com">clubvoleibolguaguas.com</a></span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Nombre comercial</span><span class="libro-meta-val">CV Guaguas</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Denominación social</span><span class="libro-meta-val">CV Guaguas</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">NIF</span><span class="libro-meta-val">G76371350</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Domicilio social</span><span class="libro-meta-val">Avda. Alcalde José Ramírez Bethencourt – 35004 Las Palmas</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Teléfono</span><span class="libro-meta-val">645 622 115</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Email</span><span class="libro-meta-val"><a href="mailto:info@clubvoleibolguaguas.com">info@clubvoleibolguaguas.com</a></span></div>
</div>
</div>

<span class="libro-section-title">Derechos de propiedad intelectual e industrial</span>
<p>El sitio web, incluyendo a título enunciativo pero no limitativo su programación, edición, compilación y demás elementos necesarios para su funcionamiento, los diseños, logotipos, texto y/o gráficos, son propiedad del Responsable o, si es el caso, dispone de licencia o autorización expresa por parte de los autores.</p>
<p>Todos los contenidos del sitio web se encuentran debidamente protegidos por la normativa de propiedad intelectual e industrial, así como inscritos en los registros públicos correspondientes.</p>
<p>Independientemente de la finalidad para la que fueran destinados, la reproducción total o parcial, uso, explotación, distribución y comercialización, requiere en todo caso de la autorización escrita previa por parte del Responsable. Cualquier uso no autorizado previamente se considera un incumplimiento grave de los derechos de propiedad intelectual o industrial del autor.</p>
<p>Los diseños, logotipos, texto y/o gráficos ajenos al Responsable y que pudieran aparecer en el sitio web, pertenecen a sus respectivos propietarios, siendo ellos mismos responsables de cualquier posible controversia que pudiera suscitarse respecto a los mismos. El Responsable reconoce a favor de sus titulares los correspondientes derechos de propiedad intelectual e industrial, no implicando su sola mención o aparición en el sitio web la existencia de derechos o responsabilidad alguna sobre los mismos, como tampoco respaldo, patrocinio o recomendación por parte del mismo.</p>
<p>Para realizar cualquier tipo de observación respecto a posibles incumplimientos de los derechos de propiedad intelectual o industrial, así como sobre cualquiera de los contenidos del sitio web, puede hacerlo a través del correo electrónico <a href="mailto:info@clubvoleibolguaguas.com">info@clubvoleibolguaguas.com</a>.</p>

<span class="libro-section-title">Exención de responsabilidades</span>
<p>El Responsable se exime de cualquier tipo de responsabilidad derivada de la información publicada en su sitio web siempre que esta información haya sido manipulada o introducida por un tercero ajeno al mismo.</p>

<span class="libro-section-title">Contenido de la web y enlaces</span>
<p>CV Guaguas se reserva el derecho a actualizar, modificar o eliminar la información contenida en sus páginas web pudiendo incluso limitar o no permitir el acceso a dicha información a ciertos usuarios.</p>
<p>CV Guaguas no asume responsabilidad alguna por la información contenida en páginas web de terceros a las que se pueda acceder por «links» o enlaces desde cualquier página web propiedad de CV Guaguas. La presencia de «links» o enlaces en las páginas web de CV Guaguas tiene finalidad meramente informativa y en ningún caso supone sugerencia, invitación o recomendación sobre los mismos.</p>
</div>',
        ),

        // ── Política de cookies ──────────────────────────────────
        array(
            'slug'    => 'politica-de-cookies',
            'title'   => 'Política de cookies',
            'content' => '
<div class="reading-content">
<p>Una cookie es un pequeño fichero de texto que se almacena en su navegador cuando visita casi cualquier página web. Su utilidad es que la web sea capaz de recordar su visita cuando vuelva a navegar por esa página. Las cookies suelen almacenar información de carácter técnico, preferencias personales, personalización de contenidos, estadísticas de uso, enlaces a redes sociales, acceso a cuentas de usuario, etc. El objetivo de la cookie es adaptar el contenido de la web a su perfil y necesidades, sin cookies los servicios ofrecidos por cualquier página se verían mermados notablemente.</p>

<span class="libro-section-title">Cookies utilizadas en este sitio web</span>
<p>Siguiendo las directrices de la Agencia Española de Protección de Datos procedemos a detallar el uso de cookies que hace esta web con el fin de informarle con la máxima exactitud posible.</p>

<div class="libro-card">
<span class="libro-card-label">Cookies propias</span>
<p><strong>Cookies de sesión</strong> — Para garantizar que los usuarios que escriban comentarios en el blog sean humanos y no aplicaciones automatizadas. De esta forma se combate el spam.</p>
</div>

<div class="libro-card">
<span class="libro-card-label">Cookies de terceros</span>
<p><strong>Google Analytics</strong> — Almacena cookies para poder elaborar estadísticas sobre el tráfico y volumen de visitas de esta web. Al utilizar este sitio web está consintiendo el tratamiento de información acerca de usted por Google. Por tanto, el ejercicio de cualquier derecho en este sentido deberá hacerlo comunicando directamente con Google.</p>
<p><strong>Redes sociales</strong> — Cada red social utiliza sus propias cookies para que usted pueda pinchar en botones del tipo Me gusta o Compartir.</p>
</div>

<span class="libro-section-title">Desactivación o eliminación de cookies</span>
<p>En cualquier momento podrá ejercer su derecho de desactivación o eliminación de cookies de este sitio web. Estas acciones se realizan de forma diferente en función del navegador que esté usando.</p>

<span class="libro-section-title">Notas adicionales</span>
<ul>
<li>Ni esta web ni sus representantes legales se hacen responsables ni del contenido ni de la veracidad de las políticas de privacidad que puedan tener los terceros mencionados en esta política de cookies.</li>
<li>Los navegadores web son las herramientas encargadas de almacenar las cookies y desde este lugar debe efectuar su derecho a eliminación o desactivación de las mismas. Ni esta web ni sus representantes legales pueden garantizar la correcta o incorrecta manipulación de las cookies por parte de los mencionados navegadores.</li>
<li>En algunos casos es necesario instalar cookies para que el navegador no olvide su decisión de no aceptación de las mismas.</li>
<li>En el caso de las cookies de Google Analytics, esta empresa almacena las cookies en servidores ubicados en Estados Unidos y se compromete a no compartirla con terceros, excepto en los casos en los que sea necesario para el funcionamiento del sistema o cuando la ley obligue a tal efecto.</li>
</ul>
<p>Para cualquier duda o consulta acerca de esta política de cookies no dude en comunicarse con nosotros a través de la sección de contacto.</p>
</div>',
        ),

        // ── Política de privacidad ───────────────────────────────
        array(
            'slug'    => 'politica-de-privacidad',
            'title'   => 'Política de privacidad',
            'content' => '
<div class="reading-content">
<p>CV Guaguas, en adelante Responsable, es el Responsable del tratamiento de los datos personales del Usuario y le informa que estos datos serán tratados de conformidad con lo dispuesto en el Reglamento (UE) 2016/679 de 27 de abril de 2016 (GDPR) relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos.</p>

<span class="libro-section-title">Información al usuario</span>
<div class="libro-card">
<span class="libro-card-label">Fin del tratamiento</span>
<p>Mantener una relación comercial con el Usuario. Las operaciones previstas para realizar el tratamiento son: tramitar encargos, solicitudes o cualquier tipo de petición que sea realizada por el usuario a través de cualquiera de las formas de contacto que se ponen a su disposición.</p>
</div>
<div class="libro-card">
<span class="libro-card-label">Criterios de conservación de los datos</span>
<p>Se conservarán mientras exista un interés mutuo para mantener el fin del tratamiento y cuando ya no sea necesario para tal fin, se suprimirán con medidas de seguridad adecuadas para garantizar la seudonimización de los datos o la destrucción total de los mismos.</p>
</div>
<div class="libro-card">
<span class="libro-card-label">Comunicación de los datos</span>
<p>No se comunicarán los datos a terceros salvo obligación legal.</p>
</div>

<span class="libro-section-title">Derechos que asisten al usuario</span>
<ul>
<li>Derecho a retirar el consentimiento en cualquier momento.</li>
<li>Derecho de acceso, rectificación, portabilidad y supresión de sus datos y a la limitación u oposición al su tratamiento.</li>
<li>Derecho a presentar una reclamación ante la autoridad de control (agpd.es) si considera que el tratamiento no se ajusta a la normativa vigente.</li>
</ul>

<div class="libro-card">
<span class="libro-card-label">Datos de contacto para ejercer sus derechos</span>
<div class="libro-meta-grid">
<div class="libro-meta-row"><span class="libro-meta-key">Dirección postal</span><span class="libro-meta-val">Avda. Alcalde José Ramírez Bethencourt – 35004 Las Palmas</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Email</span><span class="libro-meta-val"><a href="mailto:info@clubvoleibolguaguas.com">info@clubvoleibolguaguas.com</a></span></div>
</div>
</div>

<span class="libro-section-title">Carácter obligatorio o facultativo de la información facilitada por el usuario</span>
<p>Los Usuarios, mediante la marcación de las casillas correspondientes y entrada de datos en los campos marcados con un asterisco (*) en los formularios de contacto, aceptan expresamente y de forma libre e inequívoca, que sus datos son necesarios para atender su petición, siendo voluntaria la inclusión de datos en los campos restantes. El Usuario garantiza que los datos personales facilitados al Responsable son veraces y se hace responsable de comunicar cualquier modificación de los mismos.</p>
<p>El Responsable informa y garantiza expresamente a los usuarios que sus datos personales no serán cedidos en ningún caso a terceros, y que siempre que realizara algún tipo de cesión de datos personales, se pedirá previamente el consentimiento expreso, informado e inequívoco por parte de los Usuarios.</p>

<span class="libro-section-title">Medidas de seguridad</span>
<p>De conformidad con lo dispuesto en las normativas vigentes en protección de datos personales, el Responsable está cumpliendo con todas las disposiciones de las normativas GDPR para el tratamiento de los datos personales de su responsabilidad, y manifiestamente con los principios descritos en el artículo 5 del GDPR, por los cuales son tratados de manera lícita, leal y transparente en relación con el interesado y adecuados, pertinentes y limitados a lo necesario en relación con los fines para los que son tratados. El Responsable garantiza que ha implementado políticas técnicas y organizativas apropiadas para aplicar las medidas de seguridad que establecen el GDPR con el fin de proteger los derechos y libertades de los Usuarios.</p>
</div>',
        ),

        // ── Declaración de accesibilidad ─────────────────────────
        array(
            'slug'    => 'accesibilidad',
            'title'   => 'Declaración de accesibilidad',
            'content' => '
<div class="reading-content">
<p>El Club Voleibol Guaguas se ha comprometido a hacer accesible su sitio web de conformidad con el Real Decreto 1112/2018, de 7 de septiembre, sobre accesibilidad de los sitios web y aplicaciones para dispositivos móviles del sector público, que transpone la Directiva (UE) 2016/2102 del Parlamento Europeo y del Consejo.</p>
<p>La presente declaración de accesibilidad se aplica al sitio web <a href="http://clubvoleibolguaguas.com">clubvoleibolguaguas.com</a>.</p>

<span class="libro-section-title">Situación de cumplimiento</span>
<p>Este sitio web es <strong>parcialmente conforme</strong> con el Real Decreto 1112/2018, de 7 de septiembre, debido a las excepciones y a la falta de conformidad de los aspectos que se indican a continuación.</p>

<span class="libro-section-title">Contenido no accesible</span>
<div class="libro-card">
<span class="libro-card-label">Excepciones</span>
<p>Los siguientes contenidos no son accesibles por las razones que se indican:</p>
<p><strong>Falta de conformidad con el RD 1112/2018</strong> — Algunos documentos en formato PDF y otros formatos ofimáticos publicados antes del 23 de septiembre de 2018 pueden no cumplir todos los requisitos de accesibilidad.</p>
<p><strong>Carga desproporcionada</strong> — No aplica.</p>
<p><strong>El contenido no entra dentro del ámbito de la legislación aplicable</strong> — Los contenidos de terceros que no estén financiados ni desarrollados por CV Guaguas y que no estén bajo su control quedan excluidos del ámbito de aplicación.</p>
</div>

<span class="libro-section-title">Preparación de la presente declaración de accesibilidad</span>
<div class="libro-card">
<div class="libro-meta-grid">
<div class="libro-meta-row"><span class="libro-meta-key">Preparada el</span><span class="libro-meta-val">Mayo de 2026</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Última revisión</span><span class="libro-meta-val">Mayo de 2026</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Método</span><span class="libro-meta-val">Autoevaluación realizada por el propio organismo</span></div>
</div>
</div>

<span class="libro-section-title">Contacto y solicitud de información accesible</span>
<p>Si necesita información en un formato accesible alternativo, puede ponerse en contacto con el Club Voleibol Guaguas a través de los siguientes medios:</p>
<div class="libro-card">
<div class="libro-meta-grid">
<div class="libro-meta-row"><span class="libro-meta-key">Email</span><span class="libro-meta-val"><a href="mailto:info@clubvoleibolguaguas.com">info@clubvoleibolguaguas.com</a></span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Teléfono</span><span class="libro-meta-val">645 622 115</span></div>
<div class="libro-meta-row"><span class="libro-meta-key">Dirección</span><span class="libro-meta-val">Avda. Alcalde José Ramírez Bethencourt – 35004 Las Palmas</span></div>
</div>
</div>
<p>Las comunicaciones serán recibidas y estudiadas, y se responderá a la persona interesada en un plazo de tres días hábiles.</p>

<span class="libro-section-title">Procedimiento de aplicación</span>
<p>Si una vez realizada una solicitud de información accesible o queja, esta hubiera sido desestimada, no se estuviera de acuerdo con la decisión adoptada, o la respuesta no cumpliera los requisitos contemplados en el artículo 12.5, la persona interesada podrá iniciar una reclamación. La reclamación puede realizarse a través de la <a href="https://administracion.gob.es">sede electrónica de la Administración General del Estado</a>.</p>
</div>',
        ),
    );

    foreach ($legal_pages as $page) {
        $q = new WP_Query(array(
            'post_type'      => 'page',
            'name'           => $page['slug'],
            'posts_per_page' => 1,
            'post_status'    => array('publish', 'draft', 'private'),
            'no_found_rows'  => true,
            'fields'         => 'ids',
        ));
        wp_reset_postdata();
        if ($q->have_posts()) {
            continue;
        }
        wp_insert_post(array(
            'post_title'     => $page['title'],
            'post_name'      => $page['slug'],
            'post_content'   => $page['content'],
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ), false);
    }
}
add_action('after_switch_theme', 'libro_create_legal_pages');

/**
 * Asegura que las páginas legales existen en cada carga de admin.
 * Usa WP_Query (más fiable que get_page_by_path en algunos contextos).
 */
function libro_ensure_legal_pages() {
    if (!is_admin()) return;
    $slugs = array('aviso-legal', 'politica-de-cookies', 'politica-de-privacidad', 'accesibilidad');
    $q = new WP_Query(array(
        'post_type'      => 'page',
        'post_name__in'  => $slugs,
        'posts_per_page' => count($slugs),
        'post_status'    => array('publish', 'draft', 'private'),
        'fields'         => 'ids',
    ));
    $found = $q->found_posts;
    wp_reset_postdata();
    if ($found >= count($slugs)) return;
    libro_create_legal_pages();
}
add_action('admin_init', 'libro_ensure_legal_pages');
