<?php
/**
 * CV Guaguas - 50 Aniversario Functions
 */

// Definir constantes del tema
define('LIBRO_VERSION', '1.0.0');
define('LIBRO_DIR', get_template_directory());
define('LIBRO_URI', get_template_directory_uri());

// Cargar módulos del tema
require_once LIBRO_DIR . '/inc/meta-boxes.php';
require_once LIBRO_DIR . '/inc/sample-content.php';

/**
 * Enqueue scripts y styles
 */
function libro_enqueue_assets() {
    // Google Fonts - Montserrat + Inter (colores CV Guaguas)
    wp_enqueue_style(
        'libro-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Estilos principales
    wp_enqueue_style(
        'libro-main',
        LIBRO_URI . '/assets/css/main.css',
        array('libro-fonts'),
        LIBRO_VERSION
    );
    
    // JavaScript principal
    wp_enqueue_script(
        'libro-main',
        LIBRO_URI . '/assets/js/main.js',
        array(),
        LIBRO_VERSION,
        true
    );
    
    // Pasar variables a JS
    wp_localize_script('libro-main', 'libroVars', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'siteUrl' => home_url(),
    ));
}
add_action('wp_enqueue_scripts', 'libro_enqueue_assets');

/**
 * Registrar Custom Post Type: Capítulos
 */
function libro_register_capitulos_cpt() {
    $labels = array(
        'name'               => 'Capítulos',
        'singular_name'      => 'Capítulo',
        'menu_name'          => 'Libro',
        'add_new'            => 'Añadir capítulo',
        'add_new_item'       => 'Añadir nuevo capítulo',
        'edit_item'          => 'Editar capítulo',
        'new_item'           => 'Nuevo capítulo',
        'view_item'          => 'Ver capítulo',
        'search_items'       => 'Buscar capítulos',
        'not_found'          => 'No se encontraron capítulos',
        'parent_item_colon'  => 'Capítulo padre:',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'capitulo'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true,
    );
    
    register_post_type('capitulo', $args);
}
add_action('init', 'libro_register_capitulos_cpt');

/**
 * Registrar campos personalizados con ACF (opcional - como fallback)
 * Si ACF está instalado, estos campos estarán disponibles además de los meta boxes nativos
 */
function libro_register_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_capitulo',
            'title' => 'Datos del Capítulo (ACF)',
            'fields' => array(
                array(
                    'key' => 'field_numero_capitulo',
                    'label' => 'Número de Capítulo',
                    'name' => 'numero_capitulo',
                    'type' => 'text',
                    'instructions' => 'Ej: 01, 02, etc. Dejar vacío para prólogo/epílogo',
                ),
                array(
                    'key' => 'field_mostrar_marcador',
                    'label' => 'Mostrar marcador de capítulo',
                    'name' => 'mostrar_marcador',
                    'type' => 'true_false',
                    'default_value' => 1,
                ),
                array(
                    'key' => 'field_cita_destacada',
                    'label' => 'Cita destacada',
                    'name' => 'cita_destacada',
                    'type' => 'textarea',
                ),
                array(
                    'key' => 'field_autor_cita',
                    'label' => 'Autor de la cita',
                    'name' => 'autor_cita',
                    'type' => 'text',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'capitulo',
                    ),
                ),
            ),
            'active' => false, // Desactivado por defecto, se usa meta-boxes.php
        ));
    }
}
add_action('acf/init', 'libro_register_acf_fields');

/**
 * Shortcode para índice automático
 * Uso: [indice_libro]
 */
function libro_shortcode_indice($atts) {
    $capitulos = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_parent'    => 0, // Solo capítulos principales
    ));
    
    if (empty($capitulos)) {
        return '<p>No hay capítulos disponibles.</p>';
    }
    
    ob_start();
    ?>
    <nav class="indice-libro">
        <ul class="lista-capitulos space-y-1">
            <?php foreach ($capitulos as $cap) : 
                $numero = libro_get_field('numero_capitulo', $cap->ID);
                $slug = sanitize_title($cap->post_title);
                
                // Obtener hijos
                $hijos = get_posts(array(
                    'post_type'      => 'capitulo',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'post_parent'    => $cap->ID,
                ));
            ?>
            <li class="capitulo-item">
                <a href="#<?php echo esc_attr($slug); ?>" class="capitulo-link sidebar-active-indicator">
                    <?php if ($numero) : ?>
                        <span class="capitulo-numero"><?php echo esc_html($numero); ?></span>
                    <?php endif; ?>
                    <span class="capitulo-titulo"><?php echo esc_html($cap->post_title); ?></span>
                </a>
                
                <?php if (!empty($hijos)) : ?>
                <ul class="subcapitulos pl-4 mt-1 space-y-1">
                    <?php foreach ($hijos as $hijo) : 
                        $hijo_slug = sanitize_title($hijo->post_title);
                    ?>
                    <li>
                        <a href="#<?php echo esc_attr($hijo_slug); ?>" class="text-sm text-muted-foreground hover:text-gold">
                            <?php echo esc_html($hijo->post_title); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php
    return ob_get_clean();
}
add_shortcode('indice_libro', 'libro_shortcode_indice');

/**
 * Shortcode para mostrar contenido de capítulos
 * Uso: [contenido_libro]
 */
function libro_shortcode_contenido($atts) {
    // Obtener todos los capítulos ordenados
    $capitulos = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    
    if (empty($capitulos)) {
        return '';
    }
    
    // Organizar en estructura jerárquica
    $capitulos_organizados = array();
    $hijos_por_padre = array();
    
    foreach ($capitulos as $cap) {
        if ($cap->post_parent === 0) {
            $capitulos_organizados[] = $cap;
        } else {
            if (!isset($hijos_por_padre[$cap->post_parent])) {
                $hijos_por_padre[$cap->post_parent] = array();
            }
            $hijos_por_padre[$cap->post_parent][] = $cap;
        }
    }
    
    ob_start();
    
    foreach ($capitulos_organizados as $cap) :
        echo libro_render_capitulo($cap);
        
        // Renderizar hijos si existen
        if (isset($hijos_por_padre[$cap->ID])) {
            foreach ($hijos_por_padre[$cap->ID] as $hijo) {
                echo libro_render_capitulo($hijo, true);
            }
        }
    endforeach;
    
    return ob_get_clean();
}
add_shortcode('contenido_libro', 'libro_shortcode_contenido');

/**
 * Renderizar un capítulo individual
 */
function libro_render_capitulo($cap, $is_child = false) {
    $numero = libro_get_field('numero_capitulo', $cap->ID);
    $mostrar_marcador = libro_get_field('mostrar_marcador', $cap->ID);
    $cita = libro_get_field('cita_destacada', $cap->ID);
    $autor_cita = libro_get_field('autor_cita', $cap->ID);
    $slug = sanitize_title($cap->post_title);
    
    // Clase adicional para hijos
    $section_class = $is_child ? 'capitulo-section capitulo-hijo' : 'capitulo-section';
    $header_size = $is_child ? 'text-2xl md:text-3xl lg:text-4xl' : 'text-3xl md:text-4xl lg:text-5xl';
    
    ob_start();
    ?>
    <section id="<?php echo esc_attr($slug); ?>" class="<?php echo esc_attr($section_class); ?> scroll-mt-24 py-16 md:py-24 border-b border-border/30">
        <header class="capitulo-header mb-8 md:mb-12">
            <?php if ($mostrar_marcador && $numero) : ?>
                <span class="chapter-marker block mb-4">Capítulo <?php echo esc_html($numero); ?></span>
            <?php endif; ?>
            <h2 class="font-serif <?php echo esc_attr($header_size); ?> text-foreground leading-tight">
                <?php echo esc_html($cap->post_title); ?>
            </h2>
        </header>
        
        <div class="reading-content text-foreground/85">
            <?php echo apply_filters('the_content', $cap->post_content); ?>
            
            <?php if ($cita) : ?>
            <blockquote class="editorial-quote my-8 md:my-12 py-4">
                <p class="text-xl md:text-2xl text-foreground/90 leading-relaxed mb-4">
                    "<?php echo esc_html($cita); ?>"
                </p>
                <?php if ($autor_cita) : ?>
                <footer class="text-sm text-muted-foreground">
                    <cite class="not-italic font-medium">— <?php echo esc_html($autor_cita); ?></cite>
                </footer>
                <?php endif; ?>
            </blockquote>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Añadir soporte para el tema
 */
function libro_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    
    // Registrar menús
    register_nav_menus(array(
        'footer-menu' => 'Menú del Footer',
    ));
}
add_action('after_setup_theme', 'libro_theme_setup');

/**
 * Registrar Widgets
 */
function libro_widgets_init() {
    register_sidebar(array(
        'name'          => 'Área de Logos Footer',
        'id'            => 'footer-logos',
        'description'   => 'Añade widgets de imagen para los logos institucionales',
        'before_widget' => '<div class="footer-logo-item">',
        'after_widget'  => '</div>',
    ));
}
add_action('widgets_init', 'libro_widgets_init');

/**
 * Opciones del tema para URLs de descarga
 */
function libro_register_settings() {
    register_setting('libro_options', 'libro_pdf_url');
    register_setting('libro_options', 'libro_epub_url');
    register_setting('libro_options', 'libro_hero_title');
    register_setting('libro_options', 'libro_hero_subtitle');
}
add_action('admin_init', 'libro_register_settings');

/**
 * Página de opciones del tema
 */
function libro_add_options_page() {
    add_theme_page(
        'Opciones del Libro',
        'Opciones Libro',
        'manage_options',
        'libro-options',
        'libro_options_page_html'
    );
}
add_action('admin_menu', 'libro_add_options_page');

function libro_options_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    if (isset($_GET['settings-updated'])) {
        add_settings_error('libro_messages', 'libro_message', 'Configuración guardada', 'updated');
    }
    
    settings_errors('libro_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php settings_fields('libro_options'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="libro_hero_title">Título del Hero</label></th>
                    <td><input type="text" id="libro_hero_title" name="libro_hero_title" value="<?php echo esc_attr(get_option('libro_hero_title', '50 Años de Historia')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_hero_subtitle">Subtítulo del Hero</label></th>
                    <td><textarea id="libro_hero_subtitle" name="libro_hero_subtitle" class="large-text" rows="2"><?php echo esc_textarea(get_option('libro_hero_subtitle', 'Cinco décadas de pasión, títulos y leyendas del voleibol canario')); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_pdf_url">URL del PDF</label></th>
                    <td><input type="url" id="libro_pdf_url" name="libro_pdf_url" value="<?php echo esc_attr(get_option('libro_pdf_url', '#')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_epub_url">URL del EPUB</label></th>
                    <td><input type="url" id="libro_epub_url" name="libro_epub_url" value="<?php echo esc_attr(get_option('libro_epub_url', '#')); ?>" class="regular-text"></td>
                </tr>
            </table>
            <?php submit_button('Guardar cambios'); ?>
        </form>
        
        <hr>
        
        <h2>Información del Tema</h2>
        <p>Este tema incluye:</p>
        <ul style="list-style: disc; margin-left: 20px;">
            <li><strong>Custom Post Type "Capítulo"</strong> - Para gestionar los capítulos del libro</li>
            <li><strong>Estructura jerárquica</strong> - Los capítulos pueden tener subcapítulos (prólogos, secciones, etc.)</li>
            <li><strong>Campos personalizados nativos</strong> - No necesitas ACF</li>
            <li><strong>Contenido de ejemplo</strong> - Se importa automáticamente al activar el tema</li>
        </ul>
        
        <h3>Cómo añadir nuevos capítulos</h3>
        <ol style="margin-left: 20px;">
            <li>Ve a <strong>Libro → Añadir capítulo</strong></li>
            <li>Escribe el título y contenido</li>
            <li>Usa los campos personalizados para número de capítulo, citas, etc.</li>
            <li>Si es un subcapítulo, selecciona el padre en "Atributos de página"</li>
            <li>Ajusta el "Orden" para controlar la posición en el índice</li>
        </ol>
    </div>
    <?php
}

/**
 * Flush rewrite rules al activar el tema
 */
function libro_theme_activation() {
    libro_register_capitulos_cpt();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'libro_theme_activation');
