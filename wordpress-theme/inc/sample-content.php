<?php
/**
 * Contenido de ejemplo para el libro CV Guaguas
 * Se ejecuta al activar el tema
 *
 * @package CV_Guaguas_Libro
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Importar contenido de capítulos al activar el tema
 */
function libro_import_sample_content() {
    // Verificar si ya hay capítulos
    $existing = get_posts(array(
        'post_type' => 'capitulo',
        'posts_per_page' => 1,
        'post_status' => 'any',
    ));
    
    if (!empty($existing)) {
        // Ya hay contenido, no importar
        return;
    }
    
    // Definir todos los capítulos
    $capitulos = libro_get_sample_chapters();
    
    // Variable para guardar el ID del capítulo padre (Prólogos)
    $prologos_parent_id = 0;
    
    foreach ($capitulos as $index => $cap) {
        $post_data = array(
            'post_title'   => $cap['title'],
            'post_content' => $cap['content'],
            'post_status'  => 'publish',
            'post_type'    => 'capitulo',
            'menu_order'   => $cap['order'],
            'post_parent'  => isset($cap['parent']) && $cap['parent'] === 'prologos' ? $prologos_parent_id : 0,
        );
        
        $post_id = wp_insert_post($post_data);
        
        if (!is_wp_error($post_id)) {
            // Guardar meta datos
            if (!empty($cap['numero'])) {
                update_post_meta($post_id, '_numero_capitulo', $cap['numero']);
            }
            
            update_post_meta($post_id, '_mostrar_marcador', isset($cap['show_marker']) ? ($cap['show_marker'] ? '1' : '0') : '1');
            
            if (!empty($cap['quote'])) {
                update_post_meta($post_id, '_cita_destacada', $cap['quote']);
            }
            
            if (!empty($cap['quote_author'])) {
                update_post_meta($post_id, '_autor_cita', $cap['quote_author']);
            }
            
            // Si es el capítulo de Prólogos, guardar su ID
            if (isset($cap['is_prologos_parent']) && $cap['is_prologos_parent']) {
                $prologos_parent_id = $post_id;
            }
        }
    }
    
    // Mostrar mensaje de éxito
    add_action('admin_notices', function() {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><strong>¡Libro CV Guaguas importado!</strong> Se han creado todos los capítulos automáticamente. Puedes editarlos desde <a href="<?php echo admin_url('edit.php?post_type=capitulo'); ?>">Libro → Capítulos</a>.</p>
        </div>
        <?php
    });
}
add_action('after_switch_theme', 'libro_import_sample_content');

/**
 * Obtener contenido de los capítulos
 */
function libro_get_sample_chapters() {
    $image_url = LIBRO_URI . '/assets/images/hero-stadium.jpg';
    
    return array(
        // ===== CAPÍTULO 01: PRÓLOGOS (PADRE) =====
        array(
            'title' => 'Prólogos',
            'numero' => '01',
            'order' => 1,
            'show_marker' => true,
            'is_prologos_parent' => true,
            'content' => '
<p>El libro que tiene entre sus manos es mucho más que una recopilación de datos y fechas. Es el testimonio vivo de una pasión que ha unido a generaciones de canarios en torno a un deporte que, en Las Palmas de Gran Canaria, tiene nombre propio: CV Guaguas.</p>

<p>A través de estas páginas, recorreremos juntos un camino que comenzó en los patios de colegio y que nos ha llevado a lo más alto del voleibol nacional. Un camino plagado de sacrificios, de sueños compartidos, de noches en las que la incertidumbre parecía ganar la partida, pero también de mañanas luminosas en las que la victoria sabía a gloria.</p>

<p>Este libro es un homenaje a todos aquellos que, de una forma u otra, han sido parte de esta historia: jugadores, entrenadores, directivos, patrocinadores, medios de comunicación y, sobre todo, esa afición incondicional que ha convertido el Centro Insular de Deportes en una auténtica caldera amarilla.</p>
',
            'quote' => 'El CV Guaguas no es solo un club de voleibol. Es una familia que crece con cada punto, que sufre con cada derrota y que celebra cada victoria como si fuera la primera.',
            'quote_author' => 'Club Voleibol Guaguas',
        ),
        
        // ===== PRÓLOGOS INDIVIDUALES (HIJOS) =====
        array(
            'title' => 'Fernando Clavijo Batlle',
            'numero' => '',
            'order' => 2,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente del Gobierno de Canarias</p>

<p>Es un honor para mí presentar esta obra que recoge la extraordinaria trayectoria del Club Voleibol Guaguas, una institución que ha sabido convertirse en un referente del deporte canario y español.</p>

<p>El CV Guaguas representa los valores que definen a nuestra tierra: el esfuerzo, la constancia, el trabajo en equipo y esa capacidad única de superar las adversidades que siempre ha caracterizado al pueblo canario. Desde el Gobierno de Canarias, seguiremos apoyando iniciativas como esta que ponen en valor nuestra cultura deportiva.</p>

<p>A lo largo de estas páginas, el lector podrá sumergirse en una historia de pasión y entrega que ha situado a Gran Canaria en el mapa del voleibol internacional. Una historia que nos llena de orgullo a todos los canarios.</p>
',
            'quote' => 'El deporte es un reflejo de los valores de una sociedad, y el CV Guaguas encarna lo mejor de Canarias.',
            'quote_author' => 'Fernando Clavijo Batlle',
        ),
        
        array(
            'title' => 'Antonio Morales Méndez',
            'numero' => '',
            'order' => 3,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente del Cabildo de Gran Canaria</p>

<p>Gran Canaria ha sido siempre una tierra de deportistas, de personas que entienden que la práctica deportiva va más allá de la competición. El CV Guaguas es el máximo exponente de esta filosofía.</p>

<p>Desde el Cabildo de Gran Canaria hemos sido testigos privilegiados de la evolución de este club, que ha pasado de ser un proyecto local a convertirse en una referencia nacional. El Centro Insular de Deportes ha sido escenario de noches mágicas que quedarán para siempre en la memoria colectiva de nuestra isla.</p>

<p>Este libro es un merecido reconocimiento a todos los que han hecho posible este sueño. Un sueño que, temporada tras temporada, sigue creciendo y conquistando nuevas metas.</p>
',
            'quote' => 'El Centro Insular de Deportes vibra cada vez que juega el Guaguas. Es nuestra casa, nuestra fortaleza.',
            'quote_author' => 'Antonio Morales Méndez',
        ),
        
        array(
            'title' => 'Carolina Darias San Sebastián',
            'numero' => '',
            'order' => 4,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Alcaldesa de Las Palmas de Gran Canaria</p>

<p>Las Palmas de Gran Canaria es una ciudad que vive el deporte con intensidad, y el voleibol ocupa un lugar especial en el corazón de nuestros ciudadanos gracias, en gran medida, al CV Guaguas.</p>

<p>Como alcaldesa, me enorgullece ver cómo un club de nuestra ciudad representa con tanta dignidad los valores del deporte: respeto, superación, compañerismo y fair play. El Guaguas no solo compite, educa y forma a las nuevas generaciones en estos principios.</p>

<p>Este libro recoge la esencia de un proyecto que ha trascendido lo deportivo para convertirse en un fenómeno social que une a familias, amigos y vecinos bajo los colores amarillo y azul.</p>
',
            'quote' => 'El Guaguas ha convertido Las Palmas de Gran Canaria en la capital del voleibol español.',
            'quote_author' => 'Carolina Darias San Sebastián',
        ),
        
        array(
            'title' => 'Poli Suárez Nuez',
            'numero' => '',
            'order' => 5,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Consejero de Deportes del Gobierno de Canarias</p>

<p>El deporte canario tiene en el CV Guaguas uno de sus máximos exponentes. Un club que ha demostrado que desde las islas se puede competir al más alto nivel nacional e internacional.</p>

<p>La historia del Guaguas es la historia del voleibol canario. Una disciplina que ha crecido de la mano de este club y que hoy cuenta con una base de practicantes y aficionados que no para de crecer gracias al efecto arrastre de los éxitos del primer equipo.</p>

<p>Desde la Consejería de Deportes seguiremos trabajando para que clubes como el Guaguas cuenten con los recursos necesarios para seguir poniendo el nombre de Canarias en lo más alto del deporte español.</p>
',
            'quote' => 'El Guaguas ha demostrado que la insularidad no es un obstáculo, sino un impulso para alcanzar la excelencia.',
            'quote_author' => 'Poli Suárez Nuez',
        ),
        
        array(
            'title' => 'Carla Campoamor Padilla',
            'numero' => '',
            'order' => 6,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Concejala de Deportes de Las Palmas de Gran Canaria</p>

<p>Trabajar mano a mano con el CV Guaguas ha sido una de las experiencias más gratificantes de mi trayectoria en la gestión deportiva municipal. Estamos ante un club modelo en todos los sentidos.</p>

<p>Su compromiso con la cantera, su profesionalidad en la gestión y su capacidad para generar ilusión en la ciudad son valores que desde el Ayuntamiento queremos seguir apoyando y potenciando.</p>

<p>Este libro es un testimonio de todo lo que se puede conseguir cuando hay pasión, trabajo y una visión clara de hacia dónde se quiere llegar. El Guaguas es un orgullo para nuestra ciudad.</p>
',
            'quote' => 'El Guaguas es mucho más que un club: es un proyecto de ciudad.',
            'quote_author' => 'Carla Campoamor Padilla',
        ),
        
        array(
            'title' => 'Felipe Pascual Cobo',
            'numero' => '',
            'order' => 7,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente de la Real Federación Española de Voleibol</p>

<p>El CV Guaguas representa lo mejor del voleibol español. Un club que ha sabido combinar la excelencia deportiva con una gestión ejemplar y un compromiso inquebrantable con la formación de jóvenes talentos.</p>

<p>Desde la Real Federación Española de Voleibol contemplamos con admiración el trabajo que se realiza en Las Palmas de Gran Canaria. El ambiente que se vive en el Centro Insular de Deportes es único en España y comparable a los mejores pabellones europeos.</p>

<p>Este libro es un merecido homenaje a una institución que ha contribuido decisivamente al crecimiento de nuestro deporte en España.</p>
',
            'quote' => 'El modelo Guaguas es un ejemplo a seguir para todos los clubes de voleibol de España.',
            'quote_author' => 'Felipe Pascual Cobo',
        ),
        
        array(
            'title' => 'Roberto Melián Arbelo',
            'numero' => '',
            'order' => 8,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente de la Federación Canaria de Voleibol</p>

<p>Como presidente de la Federación Canaria de Voleibol, he tenido el privilegio de vivir en primera persona la evolución del CV Guaguas. Un club que ha sido locomotora de nuestro deporte en las islas.</p>

<p>Los éxitos del Guaguas han tenido un efecto multiplicador en la práctica del voleibol en Canarias. Hoy contamos con más licencias, más clubes y más competiciones gracias, en buena medida, al efecto inspirador que ejerce el primer equipo sobre las nuevas generaciones.</p>

<p>Este libro recoge una historia de éxito que no ha hecho más que empezar.</p>
',
            'quote' => 'El Guaguas ha sido el motor que ha impulsado el voleibol canario hacia la excelencia.',
            'quote_author' => 'Roberto Melián Arbelo',
        ),
        
        array(
            'title' => 'Eduardo Ramírez González',
            'numero' => '',
            'order' => 9,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente de Guaguas Municipales</p>

<p>Cuando Guaguas Municipales decidió apostar por el patrocinio del Club Voleibol Guaguas, sabíamos que estábamos uniéndonos a un proyecto especial. Lo que no imaginábamos era hasta qué punto esta alianza iba a transformar la imagen de nuestra empresa y la percepción de los ciudadanos.</p>

<p>El Guaguas lleva nuestro nombre por toda España, y lo hace con orgullo, con trabajo y con resultados. Es un embajador excepcional de nuestra ciudad y de nuestra empresa.</p>

<p>Esta obra refleja una historia de éxito compartido que esperamos se prolongue durante muchos años más.</p>
',
            'quote' => 'Ser el patrocinador principal del Guaguas es un orgullo para toda la familia de Guaguas Municipales.',
            'quote_author' => 'Eduardo Ramírez González',
        ),
        
        array(
            'title' => 'Prólogo 09',
            'numero' => '',
            'order' => 10,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Nombre y cargo pendiente de confirmación</p>

<p>Contenido del prólogo pendiente de redacción. Este espacio está reservado para un prólogo adicional que se incorporará a la versión final del libro.</p>

<p>El texto definitivo será proporcionado por el autor correspondiente y reflejará su visión personal sobre la trayectoria y el significado del CV Guaguas para el deporte canario.</p>
',
            'quote' => '',
            'quote_author' => '',
        ),
        
        array(
            'title' => 'Prólogo 10',
            'numero' => '',
            'order' => 11,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Nombre y cargo pendiente de confirmación</p>

<p>Contenido del prólogo pendiente de redacción. Este espacio está reservado para el último prólogo que completará esta sección introductoria del libro institucional.</p>

<p>Una vez confirmado el autor, se incorporará el texto definitivo que cerrará esta serie de presentaciones institucionales.</p>
',
            'quote' => '',
            'quote_author' => '',
        ),
        
        // ===== CAPÍTULO 02 =====
        array(
            'title' => 'Del patio del colegio a la División de Honor',
            'numero' => '02',
            'order' => 12,
            'show_marker' => true,
            'content' => '
<p>Todo comenzó en los patios de los colegios de Las Palmas de Gran Canaria, donde un grupo de jóvenes descubrió en el voleibol algo más que un simple pasatiempo. Era la década de los ochenta, y el voleibol comenzaba a ganar adeptos en una isla donde el fútbol reinaba sin discusión.</p>

<figure class="content-image my-8 md:my-12">
    <img 
        src="' . $image_url . '" 
        alt="Los inicios del CV Guaguas" 
        class="w-full rounded-lg shadow-lg"
        loading="lazy"
    >
    <figcaption class="text-sm text-muted-foreground mt-3 italic">
        El Centro Insular de Deportes, testigo de la historia del voleibol grancanario
    </figcaption>
</figure>

<p>Aquellos pioneros no podían imaginar que estaban sentando las bases de lo que décadas después se convertiría en el club de voleibol más laureado de Canarias. Con recursos limitados pero con una ilusión desbordante, comenzaron a competir en las categorías regionales.</p>

<p>Los primeros años fueron de aprendizaje. Las derrotas dolían, pero cada partido era una lección que acercaba al equipo a sus objetivos. La perseverancia fue la seña de identidad de aquellos primeros equipos, que entrenaban donde podían y competían con lo que tenían.</p>

<p>El salto a las competiciones nacionales supuso un antes y un después. Por primera vez, el voleibol grancanario se medía a los grandes clubes peninsulares. Las dificultades logísticas de la insularidad, lejos de ser un obstáculo, se convirtieron en un acicate para superarse.</p>

<h3>Los primeros títulos</h3>

<p>La llegada de los primeros títulos regionales consolidó el proyecto. El CV Guaguas comenzaba a ser un nombre reconocido en el panorama del voleibol español. Las gradas del Centro Insular de Deportes empezaban a llenarse de aficionados que veían en aquel equipo algo diferente.</p>

<p>El ascenso a la División de Honor, la máxima categoría del voleibol español, fue el culmen de aquellos años de trabajo silencioso. Un logro que parecía inalcanzable se hacía realidad gracias al esfuerzo colectivo de jugadores, técnicos y directivos.</p>
',
            'quote' => 'En aquellos patios de colegio nació algo más que un equipo: nació una familia que ha perdurado durante décadas.',
            'quote_author' => 'Historia del CV Guaguas',
        ),
        
        // ===== CAPÍTULO 03 =====
        array(
            'title' => 'Así se forjó una leyenda',
            'numero' => '03',
            'order' => 13,
            'show_marker' => true,
            'content' => '
<p>La permanencia en la División de Honor no fue tarea fácil. Cada temporada suponía un reto mayúsculo para un club que, pese a su crecimiento, seguía siendo modesto en comparación con los grandes presupuestos del voleibol peninsular.</p>

<p>Sin embargo, fue precisamente esa condición de "pequeño" la que forjó el carácter del Guaguas. La obligación de hacer más con menos agudizó el ingenio directivo y deportivo. Se apostó por la cantera como pilar fundamental del proyecto, formando jugadores que más tarde brillarían en el primer equipo y en la selección española.</p>

<p>Los años noventa trajeron los primeros éxitos nacionales. Copas del Rey, Supercopas y un protagonismo creciente en la Superliga convirtieron al Guaguas en un habitual de las fases finales. La afición respondía llenando el pabellón en cada partido importante.</p>

<h3>El factor cancha</h3>

<p>Jugar en el Centro Insular de Deportes se convirtió en una ventaja competitiva. El ambiente creado por una afición entregada hacía de cada partido en casa una fortaleza casi inexpugnable. Los rivales temían visitar Las Palmas, donde el ruido ensordecedor de la grada amarilla podía decidir los puntos más ajustados.</p>

<p>La identidad del club se fue definiendo temporada tras temporada. El Guaguas era sinónimo de lucha, de entrega, de no dar un balón por perdido. Una filosofía que conectaba perfectamente con el carácter canario y que generaba una identificación única entre el equipo y su afición.</p>

<p>Los jugadores que vestían la camiseta amarilla sabían que llevaban sobre sus hombros el peso de toda una isla. Una responsabilidad que, lejos de abrumar, motivaba a dar siempre el máximo en cada entrenamiento y en cada partido.</p>
',
            'quote' => 'La leyenda del Guaguas se forjó partido a partido, con el sudor de quienes dieron todo por estos colores.',
            'quote_author' => 'Historia del club',
        ),
        
        // ===== CAPÍTULO 04 =====
        array(
            'title' => 'Una transición dolorosa',
            'numero' => '04',
            'order' => 14,
            'show_marker' => true,
            'content' => '
<p>Como toda gran historia, la del CV Guaguas también tiene sus capítulos oscuros. Hubo momentos en los que el futuro del club estuvo en entredicho, años en los que las dificultades económicas amenazaron con acabar con décadas de trabajo.</p>

<p>La crisis económica que azotó España a finales de la primera década del siglo XXI golpeó con especial dureza al deporte. Los patrocinadores se retiraban, las subvenciones se recortaban y mantener un equipo profesional se convertía en una hazaña casi imposible.</p>

<p>Fueron años de incertidumbre, de reuniones interminables buscando soluciones, de jugadores que aceptaban cobrar tarde o incluso renunciar a parte de sus salarios por mantener vivo el proyecto. La familia del Guaguas demostró en aquellos momentos difíciles que los lazos que les unían iban mucho más allá de un contrato laboral.</p>

<h3>La luz al final del túnel</h3>

<p>Cuando todo parecía perdido, surgieron las manos salvadoras. Nuevos directivos tomaron las riendas con la determinación de reflotar el club. Se renegociaron deudas, se ajustaron presupuestos y se diseñó un plan de viabilidad que, poco a poco, fue devolviendo la estabilidad a la entidad.</p>

<p>La afición, una vez más, fue clave en este proceso. Nunca dejó de acudir al pabellón, de animar a sus jugadores, de creer que volverían los buenos tiempos. Esa fidelidad incondicional fue el mejor aval para convencer a nuevos patrocinadores de que apostar por el Guaguas merecía la pena.</p>

<p>De aquella crisis el club salió reforzado. Las estructuras se profesionalizaron, la gestión se modernizó y se establecieron las bases para el crecimiento sostenible que vendría después.</p>
',
            'quote' => 'En los momentos más oscuros, cuando todo parecía perdido, la familia del Guaguas demostró que hay lazos más fuertes que cualquier crisis.',
            'quote_author' => 'Crónica del CV Guaguas',
        ),
        
        // ===== CAPÍTULO 05 =====
        array(
            'title' => 'Vuelve el gran Guaguas',
            'numero' => '05',
            'order' => 15,
            'show_marker' => true,
            'content' => '
<p>El renacimiento del CV Guaguas ha sido, quizás, el capítulo más emocionante de toda su historia. De las cenizas de la crisis surgió un proyecto renovado, más ambicioso que nunca, dispuesto a conquistar las cotas más altas del voleibol español y europeo.</p>

<figure class="content-image my-8 md:my-12">
    <img 
        src="' . $image_url . '" 
        alt="Celebración del CV Guaguas" 
        class="w-full rounded-lg shadow-lg"
        loading="lazy"
    >
    <figcaption class="text-sm text-muted-foreground mt-3 italic">
        La afición del CV Guaguas celebrando uno de los múltiples títulos conquistados
    </figcaption>
</figure>

<p>Las últimas temporadas han sido de ensueño. Títulos de liga, copas del rey, supercopas... el palmarés del club ha crecido exponencialmente, situando al Guaguas como el equipo más laureado del voleibol español en el siglo XXI.</p>

<p>Pero más allá de los trofeos, lo que verdaderamente define esta nueva era es la consolidación de un modelo de club ejemplar. La cantera sigue siendo el pilar fundamental, nutriendo al primer equipo de talentos locales que compiten codo con codo con las mejores incorporaciones internacionales.</p>

<h3>Mirando al futuro</h3>

<p>El Centro Insular de Deportes se ha convertido en un templo del voleibol europeo. Partidos de competiciones continentales con lleno absoluto, noches mágicas que quedan grabadas en la memoria de los aficionados, momentos que trascienden lo deportivo para convertirse en experiencias vitales.</p>

<p>El CV Guaguas de hoy es una institución consolidada, respetada en toda Europa, que sigue creciendo sin perder su esencia. Los valores que caracterizaron a aquellos pioneros de los patios de colegio siguen vigentes: trabajo, humildad, pasión y un amor incondicional por estos colores.</p>

<p>El futuro se presenta lleno de retos y oportunidades. Nuevas instalaciones, mayor proyección internacional, más títulos por conquistar... pero siempre con los pies en la tierra, recordando de dónde venimos y honrando a todos los que hicieron posible este sueño.</p>

<p>Esta historia continúa escribiéndose cada día. Y tú, que sostienes este libro entre tus manos, eres parte de ella.</p>
',
            'quote' => 'El Guaguas no es solo un club: es el latido de una isla, el orgullo de una ciudad, el sueño cumplido de generaciones.',
            'quote_author' => 'Afición del CV Guaguas',
        ),
    );
}

/**
 * Añadir botón en admin para reimportar contenido
 */
function libro_add_reimport_button() {
    // Solo mostrar a administradores
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Verificar si se ha solicitado reimportar
    if (isset($_GET['libro_reimport']) && $_GET['libro_reimport'] === '1') {
        // Verificar nonce
        if (wp_verify_nonce($_GET['_wpnonce'], 'libro_reimport_content')) {
            // Eliminar capítulos existentes
            $capitulos = get_posts(array(
                'post_type' => 'capitulo',
                'posts_per_page' => -1,
                'post_status' => 'any',
            ));
            
            foreach ($capitulos as $cap) {
                wp_delete_post($cap->ID, true);
            }
            
            // Reimportar
            libro_import_sample_content();
            
            // Redirigir con mensaje
            wp_redirect(admin_url('edit.php?post_type=capitulo&reimported=1'));
            exit;
        }
    }
    
    // Mostrar mensaje de éxito
    if (isset($_GET['reimported']) && $_GET['reimported'] === '1') {
        add_action('admin_notices', function() {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>¡Contenido reimportado!</strong> Todos los capítulos han sido recreados con el contenido de ejemplo.</p>
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
    
    $views['reimport'] = '<a href="' . esc_url($reimport_url) . '" class="reimport-link" style="color: #d63638;" onclick="return confirm(\'¿Estás seguro? Esto eliminará todos los capítulos existentes y los reemplazará por el contenido de ejemplo.\');">🔄 Reimportar contenido de ejemplo</a>';
    
    return $views;
}
add_filter('views_edit-capitulo', 'libro_add_reimport_link');
