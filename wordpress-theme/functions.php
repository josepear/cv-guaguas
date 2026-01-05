<?php
/**
 * CV Guaguas - Libro Institucional Functions
 */

// Definir constantes del tema
define('LIBRO_VERSION', '1.0.0');
define('LIBRO_DIR', get_template_directory());
define('LIBRO_URI', get_template_directory_uri());

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
 * Registrar campos personalizados con ACF (opcional)
 */
function libro_register_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_capitulo',
            'title' => 'Datos del Capítulo',
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
    ));
    
    if (empty($capitulos)) {
        return '<p>No hay capítulos disponibles.</p>';
    }
    
    ob_start();
    ?>
    <nav class="indice-libro">
        <ul class="lista-capitulos space-y-1">
            <?php foreach ($capitulos as $cap) : 
                $numero = get_field('numero_capitulo', $cap->ID);
                $slug = sanitize_title($cap->post_title);
            ?>
            <li class="capitulo-item">
                <a href="#<?php echo esc_attr($slug); ?>" class="capitulo-link sidebar-active-indicator">
                    <?php if ($numero) : ?>
                        <span class="capitulo-numero"><?php echo esc_html($numero); ?></span>
                    <?php endif; ?>
                    <span class="capitulo-titulo"><?php echo esc_html($cap->post_title); ?></span>
                </a>
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
    $capitulos = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    
    if (empty($capitulos)) {
        return '';
    }
    
    ob_start();
    foreach ($capitulos as $cap) :
        $numero = get_field('numero_capitulo', $cap->ID);
        $mostrar_marcador = get_field('mostrar_marcador', $cap->ID);
        $cita = get_field('cita_destacada', $cap->ID);
        $autor_cita = get_field('autor_cita', $cap->ID);
        $slug = sanitize_title($cap->post_title);
    ?>
    <section id="<?php echo esc_attr($slug); ?>" class="capitulo-section scroll-mt-24 py-16 md:py-24 border-b border-border/30">
        <header class="capitulo-header mb-8 md:mb-12">
            <?php if ($mostrar_marcador && $numero) : ?>
                <span class="chapter-marker block mb-4">Capítulo <?php echo esc_html($numero); ?></span>
            <?php endif; ?>
            <h2 class="font-serif text-3xl md:text-4xl lg:text-5xl text-foreground leading-tight">
                <?php echo esc_html($cap->post_title); ?>
            </h2>
        </header>
        
        <div class="reading-content text-foreground/85">
            <?php echo apply_filters('the_content', $cap->post_content); ?>
            
            <?php if ($cita) : ?>
            <blockquote class="editorial-quote my-8 md:my-12 py-4">
                <p class="text-xl md:text-2xl text-foreground/90 leading-relaxed mb-4">
                    <?php echo esc_html($cita); ?>
                </p>
                <?php if ($autor_cita) : ?>
                <footer class="text-sm text-muted-foreground">
                    <cite class="not-italic font-medium"><?php echo esc_html($autor_cita); ?></cite>
                </footer>
                <?php endif; ?>
            </blockquote>
            <?php endif; ?>
        </div>
    </section>
    <?php
    endforeach;
    return ob_get_clean();
}
add_shortcode('contenido_libro', 'libro_shortcode_contenido');

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
                    <td><input type="text" id="libro_hero_title" name="libro_hero_title" value="<?php echo esc_attr(get_option('libro_hero_title', 'CV Guaguas: Historia de un Club')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_hero_subtitle">Subtítulo del Hero</label></th>
                    <td><textarea id="libro_hero_subtitle" name="libro_hero_subtitle" class="large-text" rows="2"><?php echo esc_textarea(get_option('libro_hero_subtitle', 'Una crónica apasionante del voleibol en Las Palmas de Gran Canaria')); ?></textarea></td>
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
    </div>
    <?php
}
