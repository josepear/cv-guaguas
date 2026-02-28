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
            'title' => 'Fernando Clavijo',
            'numero' => '',
            'order' => 2,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente del Gobierno de Canarias</p>
<p>Texto del prólogo pendiente de redacción.</p>
',
        ),
        
        array(
            'title' => 'Antonio Morales',
            'numero' => '',
            'order' => 3,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente del Cabildo de Gran Canaria</p>
<p>Texto del prólogo pendiente de redacción.</p>
',
        ),
        
        array(
            'title' => 'Carolina Darias',
            'numero' => '',
            'order' => 4,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Alcaldesa de Las Palmas de Gran Canaria</p>
<p>Texto del prólogo pendiente de redacción.</p>
',
        ),
        
        array(
            'title' => 'Roberto Melián',
            'numero' => '',
            'order' => 5,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente de la Federación Canaria de Voleibol</p>
<p>Texto del prólogo pendiente de redacción.</p>
',
        ),
        
        array(
            'title' => 'Jorge Almansa',
            'numero' => '',
            'order' => 6,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Capitán del CV Guaguas</p>
<p>Texto del prólogo pendiente de redacción.</p>
',
        ),
        
        array(
            'title' => 'Juan Ruiz',
            'numero' => '',
            'order' => 7,
            'show_marker' => false,
            'parent' => 'prologos',
            'content' => '
<p class="text-gold uppercase tracking-widest text-sm mb-4">Presidente del CV Guaguas</p>
<p>Texto del prólogo pendiente de redacción.</p>
',
        ),
        
        // ===== CAPÍTULO 02: DEL PATIO DEL COLEGIO A DIVISIÓN DE HONOR =====
        array(
            'title' => 'Del patio del colegio a División de Honor',
            'numero' => '02',
            'order' => 12,
            'show_marker' => true,
            'content' => '
[seccion_header]Las horas extraescolares con Francisco Rodríguez[/seccion_header]

[capitular]Antes que el club fue el colegio. Porque el Calvo Sotelo nació del centro educativo del mismo nombre que se inauguró para el curso escolar 1967-68 en el barrio de Las Rehoyas, en la época punto de convergencia de la zona alta de Las Palmas de Gran Canaria y con familias de extracción social y economías precarias.[/capitular]

<p>Con todo, y según ha dejado documentado Miriam Quiroga, las primeras influencias para introducir el juego del voleibol en el Calvo Sotelo corresponden a Francisco Rodríguez, profesor que, de manera experimental, fomenta su práctica en las horas extraescolares.</p>

[seccion_header]Silvestre Cabrera y el salto cualitativo[/seccion_header]

<p>Un acontecimiento externo va a suponer el definitivo impulso para el desarrollo y crecimiento de la disciplina: la llegada a la presidencia de la Federación de Las Palmas de Voleibol de Silvestre Cabrera.</p>

[seccion_header]La selección cadete con Felipe Nuez como germen[/seccion_header]

<p>La temporada 1974-75 resulta crucial en el desarrollo del Calvo Sotelo, pues se materializa la creación de la selección cadete de Las Palmas, que estará a cargo de Felipe Nuez.</p>

[seccion_header]Estatutos fundacionales y despegue[/seccion_header]

<p>En noviembre de 1976, concretamente el día 6, se redactan los estatutos de fundación del Club Voleibol Calvo Sotelo.</p>

[seccion_header]El ascenso a Segunda División de 1979[/seccion_header]

<p>Contenido pendiente de importación del documento Word.</p>

[seccion_header]El acceso a la élite y su conflicto burocrático[/seccion_header]

<p>Contenido pendiente de importación del documento Word.</p>

[seccion_header]La cronología[/seccion_header]

<p>Contenido pendiente de importación del documento Word.</p>
',
            'quote' => 'En aquellos patios de colegio nació algo más que un equipo: nació una familia que ha perdurado durante décadas.',
            'quote_author' => 'Historia del CV Guaguas',
        ),
        
        // ===== CAPÍTULO 03: ESTATUTOS FUNDACIONALES =====
        array(
            'title' => 'Estatutos Fundacionales',
            'numero' => '03',
            'order' => 13,
            'show_marker' => true,
            'content' => '
[seccion_header]Capítulo I. Constitución, fines y domicilio[/seccion_header]

[articulo numero="1º"]El nombre que adoptará la nueva entidad será el de Club Voleibol Calvo Sotelo.[/articulo]

[seccion_header]Capítulo II. De los socios[/seccion_header]

<p>Articulado completo de los estatutos fundacionales del club.</p>
',
        ),
        
        // ===== CAPÍTULO 04: ASÍ SE FORJÓ UNA LEYENDA =====
        array(
            'title' => 'Así se forjó una leyenda',
            'numero' => '04',
            'order' => 14,
            'show_marker' => true,
            'content' => '
[seccion_header]Llegar a la élite para quedarse[/seccion_header]

[capitular]La temporada 1985-86 fue la del estreno del Calvo Sotelo en la División de Honor y se afrontó bajo las mismas líneas maestras que habían marcado su trayecto, desde las consideraciones de Felipe Nuez, aunque con la importante novedad del fichaje del yugoslavo Ivo Martinovic.[/capitular]

[seccion_header]Fichajes de impacto y hegemonía[/seccion_header]

<p>El verano de 1987, ya con dos años de experiencia en la élite, marca el escalón cualitativo que instala al Guaguas en la excelencia. El fichaje de Paco Sánchez Jover fue una auténtica jugada maestra de Juan Ruiz.</p>

[seccion_header]La salida de Juan Ruiz, principio del fin[/seccion_header]

<p>Tras doce años en la presidencia, Juan Ruiz quiso respetar lo reflejado en los estatutos y ceñirse a lo establecido con la máxima durabilidad de su cargo.</p>
',
            'quote' => 'La leyenda del Guaguas se forjó partido a partido.',
            'quote_author' => 'Historia del club',
        ),
        
        // ===== CAPÍTULO 05: ICONOS Y ESTRELLAS DEL GUAGUAS =====
        array(
            'title' => 'Iconos y estrellas del Guaguas',
            'numero' => '05',
            'order' => 15,
            'show_marker' => true,
            'content' => '
[capitular]Los grandes nombres que han escrito la historia del CV Guaguas. Jugadores que dejaron su huella en el voleibol español y que convirtieron al club en leyenda.[/capitular]

[perfil_jugador nombre="Sergio Miguel Camarero"]
<p>Cuando Sergio Miguel Camarero (Las Palmas de Gran Canaria, 1967) destacaba en el fútbol, ya soñaba con hacer historia en el deporte. Su aspiración se iba a cumplir en el voleibol.</p>
[/perfil_jugador]

[perfil_jugador nombre="Paco Sánchez Jover"]
<p>Paco Sánchez Jover es, junto a Camarero, el otro gran pilar sobre el que se construyó la leyenda del Guaguas.</p>
[/perfil_jugador]

[perfil_jugador nombre="Waclaw Golec"]
<p>En el verano de 1989, Juan Ruiz une a su elenco de estrellas a los internacionales polacos Ireneusz Klos y Waclaw Golec.</p>
[/perfil_jugador]

[perfil_jugador nombre="Ireneusz Klos"]
<p>Ireneusz Klos aterrizó en Gran Canaria junto a su compatriota Golec en 1989 y rápidamente se convirtió en una de las piezas fundamentales.</p>
[/perfil_jugador]
',
        ),
        
        // ===== CAPÍTULO 06: IGNACIO BRITO Y TRIBUTO A LOS SALESIANOS =====
        array(
            'title' => 'Ignacio Brito y Tributo a los Salesianos',
            'numero' => '06',
            'order' => 16,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 07: MAREK =====
        array(
            'title' => 'Marek',
            'numero' => '07',
            'order' => 17,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 08: EMBAJADORES POR EUROPA =====
        array(
            'title' => 'Embajadores por Europa',
            'numero' => '08',
            'order' => 18,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 09: RELEVO GENERACIONAL =====
        array(
            'title' => 'Relevo generacional',
            'numero' => '09',
            'order' => 19,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 10: UNA TRANSICIÓN DOLOROSA =====
        array(
            'title' => 'Una transición dolorosa',
            'numero' => '10',
            'order' => 20,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 11: TODOS LOS TÍTULOS =====
        array(
            'title' => 'Todos los títulos',
            'numero' => '11',
            'order' => 21,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 12: VUELVE EL GRAN GUAGUAS =====
        array(
            'title' => 'Vuelve el gran Guaguas',
            'numero' => '12',
            'order' => 22,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 13: DEL CID AL ARENAS =====
        array(
            'title' => 'Del CID al Arenas',
            'numero' => '13',
            'order' => 23,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 14: LOS NUEVOS ÍDOLOS =====
        array(
            'title' => 'Los nuevos ídolos',
            'numero' => '14',
            'order' => 24,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 15: EL IMPACTO DEL ESCUDO =====
        array(
            'title' => 'El impacto del escudo',
            'numero' => '15',
            'order' => 25,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 16: LA DIRECTIVA =====
        array(
            'title' => 'La directiva',
            'numero' => '16',
            'order' => 26,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 17: EL GUAGUAS QUE VIENE =====
        array(
            'title' => 'El Guaguas que viene',
            'numero' => '17',
            'order' => 27,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 18: EMPLEADOS Y TÉCNICOS =====
        array(
            'title' => 'Empleados y técnicos',
            'numero' => '18',
            'order' => 28,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 19: LA PLANTILLA DEL CINCUENTENARIO =====
        array(
            'title' => 'La plantilla del cincuentenario',
            'numero' => '19',
            'order' => 29,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 20: MIGUEL ÁNGEL RAMÍREZ =====
        array(
            'title' => 'Miguel Ángel Ramírez',
            'numero' => '20',
            'order' => 30,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 21: COMUNICACIÓN DIGITAL =====
        array(
            'title' => 'Comunicación digital',
            'numero' => '21',
            'order' => 31,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 22: SOCIOS Y ABONADOS =====
        array(
            'title' => 'Socios y abonados',
            'numero' => '22',
            'order' => 32,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
        ),
        
        // ===== CAPÍTULO 23: EMPRESARIOS DE LA TIERRA =====
        array(
            'title' => 'Empresarios de la tierra',
            'numero' => '23',
            'order' => 33,
            'show_marker' => true,
            'content' => '<p>Contenido pendiente de importación.</p>',
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
