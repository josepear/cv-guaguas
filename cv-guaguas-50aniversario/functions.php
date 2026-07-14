<?php
/**
 * CV Guaguas - 50 Aniversario Functions
 */

// Definir constantes del tema
define('LIBRO_DIR', get_template_directory());
define('LIBRO_URI', get_template_directory_uri());

/**
 * Genera una versión nueva cuando cambia un archivo del tema.
 * Así el navegador descarga el CSS y JavaScript actualizados.
 */
function libro_asset_version($relative_path) {
    $file_path = LIBRO_DIR . $relative_path;

    return file_exists($file_path) ? (string) filemtime($file_path) : '1.0.0';
}

// Cargar módulos del tema
require_once LIBRO_DIR . '/inc/meta-boxes.php';
require_once LIBRO_DIR . '/inc/sample-content.php';

/**
 * Enqueue scripts y styles
 */
function libro_enqueue_assets() {
    // Google Fonts - Antonio + Archivo (colores CV Guaguas)
    wp_enqueue_style(
        'libro-fonts',
        'https://fonts.googleapis.com/css2?family=Antonio:wght@400;700;900&family=Archivo:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700&display=swap',
        array(),
        null
    );
    
    // Estilos principales
    wp_enqueue_style(
        'libro-main',
        LIBRO_URI . '/assets/css/main.css',
        array('libro-fonts'),
        libro_asset_version('/assets/css/main.css')
    );
    
    // JavaScript principal
    wp_enqueue_script(
        'libro-main',
        LIBRO_URI . '/assets/js/main.js',
        array(),
        libro_asset_version('/assets/js/main.js'),
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
 * Enqueue media uploader para la página de opciones
 */
function libro_admin_scripts($hook) {
    if ($hook === 'appearance_page_libro-options') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'libro_admin_scripts');

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
                $numero = get_post_meta($cap->ID, '_numero_capitulo', true);
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
    $numero = get_post_meta($cap->ID, '_numero_capitulo', true);
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
 * Opciones del tema para URLs de descarga y logos
 */
function libro_register_settings() {
    register_setting('libro_options', 'libro_pdf_url');
    register_setting('libro_options', 'libro_epub_url');
    register_setting('libro_options', 'libro_hero_image');
    register_setting('libro_options', 'libro_hero_title');
    register_setting('libro_options', 'libro_hero_subtitle');
    register_setting('libro_options', 'libro_hero_year_start');
    register_setting('libro_options', 'libro_hero_year_end');
    register_setting('libro_options', 'libro_hero_star');
    register_setting('libro_options', 'libro_btn_pdf_text');
    register_setting('libro_options', 'libro_btn_epub_text');
    register_setting('libro_options', 'libro_btn_leer_text');
    register_setting('libro_options', 'libro_footer_logos');
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

    // Red de seguridad: siembra los logos por defecto si aún no hay ninguno
    // (por ejemplo, si el tema ya estaba activo antes de añadir esta función).
    libro_seed_footer_logos();

    // Handle regenerate content action
    if (
        isset($_POST['libro_action']) &&
        $_POST['libro_action'] === 'regenerate_content' &&
        isset($_POST['libro_regenerate_nonce_field']) &&
        wp_verify_nonce($_POST['libro_regenerate_nonce_field'], 'libro_regenerate_nonce')
    ) {
        // Delete all existing capitulos
        $existing = get_posts(array(
            'post_type'      => 'capitulo',
            'posts_per_page' => -1,
            'post_status'    => 'any',
            'fields'         => 'ids',
        ));
        foreach ($existing as $post_id) {
            wp_delete_post($post_id, true);
        }
        // Re-run import
        libro_import_sample_content();
        echo '<div class="notice notice-success"><p><strong>✅ Contenido regenerado correctamente.</strong> Se han creado ' . count($existing) . ' capítulos eliminados y reemplazados.</p></div>';
    }

    if (isset($_GET['settings-updated'])) {
        add_settings_error('libro_messages', 'libro_message', 'Configuración guardada', 'updated');
    }
    
    settings_errors('libro_messages');
    
    // Obtener logos actuales
    $logos = get_option('libro_footer_logos', array());
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php settings_fields('libro_options'); ?>
            
            <h2>Sección Hero (página principal)</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="libro_hero_image">Imagen de fondo</label></th>
                    <td>
                        <input type="url" id="libro_hero_image" name="libro_hero_image" value="<?php echo esc_attr(get_option('libro_hero_image', LIBRO_URI . '/assets/images/hero-home.jpg')); ?>" class="regular-text">
                        <button type="button" class="button libro-upload-logo">Seleccionar imagen</button>
                        <p class="description">Imagen de fondo a pantalla completa de la portada. Recomendado: formato apaisado, mínimo 1600px de ancho.</p>
                        <?php $current_hero_image = get_option('libro_hero_image', LIBRO_URI . '/assets/images/hero-home.jpg'); ?>
                        <?php if ($current_hero_image) : ?>
                            <div style="margin-top: 10px;"><img src="<?php echo esc_url($current_hero_image); ?>" style="max-width: 320px; height: auto; border: 1px solid #ddd;"></div>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_hero_title">Título</label></th>
                    <td><input type="text" id="libro_hero_title" name="libro_hero_title" value="<?php echo esc_attr(get_option('libro_hero_title', 'Guaguas:')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_hero_subtitle">Subtítulo</label></th>
                    <td>
                        <textarea id="libro_hero_subtitle" name="libro_hero_subtitle" class="large-text" rows="2"><?php echo esc_textarea(get_option('libro_hero_subtitle', "Una historia\nde leyenda")); ?></textarea>
                        <p class="description">Pulsa Intro para forzar un salto de línea (se muestra en dos líneas en la portada).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Años (con símbolo)</th>
                    <td>
                        <input type="text" name="libro_hero_year_start" value="<?php echo esc_attr(get_option('libro_hero_year_start', '1976')); ?>" class="small-text" style="width:80px;">
                        <input type="text" name="libro_hero_star" value="<?php echo esc_attr(get_option('libro_hero_star', '★')); ?>" class="small-text" style="width:50px; text-align:center; margin: 0 8px;">
                        <input type="text" name="libro_hero_year_end" value="<?php echo esc_attr(get_option('libro_hero_year_end', '2026')); ?>" class="small-text" style="width:80px;">
                        <p class="description">El símbolo central puede ser cualquier carácter o emoji (★, •, —, 🏐...).</p>
                    </td>
                </tr>
            </table>
            
            <h2>Botones de la Portada</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="libro_pdf_url">URL del PDF</label></th>
                    <td><input type="url" id="libro_pdf_url" name="libro_pdf_url" value="<?php echo esc_attr(get_option('libro_pdf_url', '#')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_btn_pdf_text">Texto del botón PDF</label></th>
                    <td><input type="text" id="libro_btn_pdf_text" name="libro_btn_pdf_text" value="<?php echo esc_attr(get_option('libro_btn_pdf_text', 'Descargar PDF')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_epub_url">URL del EPUB</label></th>
                    <td><input type="url" id="libro_epub_url" name="libro_epub_url" value="<?php echo esc_attr(get_option('libro_epub_url', '#')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_btn_epub_text">Texto del botón EPUB</label></th>
                    <td><input type="text" id="libro_btn_epub_text" name="libro_btn_epub_text" value="<?php echo esc_attr(get_option('libro_btn_epub_text', 'Descargar EPUB')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="libro_btn_leer_text">Texto del botón "Comenzar a leer"</label></th>
                    <td>
                        <input type="text" id="libro_btn_leer_text" name="libro_btn_leer_text" value="<?php echo esc_attr(get_option('libro_btn_leer_text', 'Comenzar a leer')); ?>" class="regular-text">
                        <p class="description">El enlace de este botón es siempre automático: apunta al primer capítulo del libro, así que no necesita configurarse.</p>
                    </td>
                </tr>
            </table>
            
            <h2>Logos del Footer</h2>
            <p class="description">Añade los logos de las instituciones colaboradoras. Si no añades ninguno, se mostrarán placeholders. Usa las flechas para cambiar el orden en que aparecen.</p>
            
            <div id="logos-container" style="margin-top: 20px;">
                <?php if (!empty($logos)) : ?>
                    <?php foreach ($logos as $index => $logo) : ?>
                    <div class="logo-row" style="background: #f9f9f9; padding: 15px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 8px;">
                            <span class="libro-logo-position" style="font-weight:600; color:#555;">Posición <?php echo (int)$index + 1; ?></span>
                            <span>
                                <button type="button" class="button libro-move-up" title="Subir">↑</button>
                                <button type="button" class="button libro-move-down" title="Bajar">↓</button>
                            </span>
                        </div>
                        <p>
                            <label><strong>Nombre/Alt:</strong></label><br>
                            <input type="text" name="libro_footer_logos[<?php echo $index; ?>][alt]" value="<?php echo esc_attr($logo['alt']); ?>" class="regular-text" placeholder="Ej: Gobierno de Canarias">
                        </p>
                        <p>
                            <label><strong>URL de la imagen:</strong></label><br>
                            <input type="url" name="libro_footer_logos[<?php echo $index; ?>][src]" value="<?php echo esc_attr($logo['src']); ?>" class="regular-text" placeholder="https://...">
                            <button type="button" class="button libro-upload-logo">Seleccionar imagen</button>
                        </p>
                        <p>
                            <label><strong>Enlace (opcional):</strong></label><br>
                            <input type="url" name="libro_footer_logos[<?php echo $index; ?>][url]" value="<?php echo esc_attr($logo['url']); ?>" class="regular-text" placeholder="https://...">
                        </p>
                        <button type="button" class="button libro-remove-logo" style="color: #a00;">Eliminar logo</button>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <button type="button" id="add-logo" class="button button-secondary" style="margin-top: 10px;">+ Añadir logo</button>
            
            <p style="margin-top: 30px;">
                <?php submit_button('Guardar cambios', 'primary', 'submit', false); ?>
            </p>
        </form>
        
        <hr>
        
        <h2>Regenerar contenido</h2>
        <p>Usa este botón para <strong>borrar y regenerar todos los capítulos</strong> con el contenido más reciente del tema. Útil cuando se actualiza el tema con nuevo contenido.</p>
        <form method="post">
            <?php wp_nonce_field('libro_regenerate_nonce', 'libro_regenerate_nonce_field'); ?>
            <input type="hidden" name="libro_action" value="regenerate_content">
            <button type="submit" class="button button-secondary" onclick="return confirm('¿Seguro? Esto borrará todos los capítulos existentes y los regenerará desde cero.');">
                🔄 Regenerar todo el contenido
            </button>
        </form>
        
        <hr>
        
        <h2>Información del Tema</h2>
        <p>Este tema incluye:</p>
        <ul style="list-style: disc; margin-left: 20px;">
            <li><strong>Custom Post Type "Capítulo"</strong> - Para gestionar los capítulos del libro</li>
            <li><strong>Estructura jerárquica</strong> - Los capítulos pueden tener subcapítulos</li>
            <li><strong>Campos personalizados nativos</strong> - No necesitas ACF</li>
            <li><strong>Logos del footer configurables</strong> - Sin necesidad de widgets</li>
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
    
    <script>
    jQuery(document).ready(function($) {
        var logoIndex = <?php echo !empty($logos) ? count($logos) : 0; ?>;
        
        // Renumera los atributos name="" y la etiqueta "Posición N" según el
        // orden visual actual de las filas, para que el orden mostrado sea
        // siempre el que se guarda al pulsar "Guardar cambios".
        function renumberLogoRows() {
            $('#logos-container .logo-row').each(function(i) {
                var $row = $(this);
                $row.find('.libro-logo-position').text('Posición ' + (i + 1));
                $row.find('input[name]').each(function() {
                    var name = $(this).attr('name');
                    var newName = name.replace(/libro_footer_logos\[\d+\]/, 'libro_footer_logos[' + i + ']');
                    $(this).attr('name', newName);
                });
            });
        }
        
        // Añadir nuevo logo
        $('#add-logo').on('click', function() {
            var html = '<div class="logo-row" style="background: #f9f9f9; padding: 15px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 4px;">' +
                '<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 8px;">' +
                '<span class="libro-logo-position" style="font-weight:600; color:#555;">Posición</span>' +
                '<span><button type="button" class="button libro-move-up" title="Subir">↑</button> ' +
                '<button type="button" class="button libro-move-down" title="Bajar">↓</button></span></div>' +
                '<p><label><strong>Nombre/Alt:</strong></label><br>' +
                '<input type="text" name="libro_footer_logos[' + logoIndex + '][alt]" class="regular-text" placeholder="Ej: Gobierno de Canarias"></p>' +
                '<p><label><strong>URL de la imagen:</strong></label><br>' +
                '<input type="url" name="libro_footer_logos[' + logoIndex + '][src]" class="regular-text" placeholder="https://...">' +
                ' <button type="button" class="button libro-upload-logo">Seleccionar imagen</button></p>' +
                '<p><label><strong>Enlace (opcional):</strong></label><br>' +
                '<input type="url" name="libro_footer_logos[' + logoIndex + '][url]" class="regular-text" placeholder="https://..."></p>' +
                '<button type="button" class="button libro-remove-logo" style="color: #a00;">Eliminar logo</button></div>';
            
            $('#logos-container').append(html);
            logoIndex++;
            renumberLogoRows();
        });
        
        // Eliminar logo
        $(document).on('click', '.libro-remove-logo', function() {
            $(this).closest('.logo-row').remove();
            renumberLogoRows();
        });
        
        // Subir / bajar posición
        $(document).on('click', '.libro-move-up', function() {
            var $row = $(this).closest('.logo-row');
            var $prev = $row.prev('.logo-row');
            if ($prev.length) {
                $row.insertBefore($prev);
                renumberLogoRows();
            }
        });
        $(document).on('click', '.libro-move-down', function() {
            var $row = $(this).closest('.logo-row');
            var $next = $row.next('.logo-row');
            if ($next.length) {
                $row.insertAfter($next);
                renumberLogoRows();
            }
        });
        
        // Media uploader para logos
        $(document).on('click', '.libro-upload-logo', function(e) {
            e.preventDefault();
            var button = $(this);
            var inputField = button.prev('input');
            
            var mediaUploader = wp.media({
                title: 'Seleccionar logo',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
            });
            
            mediaUploader.open();
        });
    });
    </script>
    <?php
}

/**
 * Siembra la opción 'libro_footer_logos' con los 8 logos por defecto del tema,
 * si todavía no hay ninguno guardado. Así aparecen ya como filas editables
 * en el panel "Opciones Libro" en vez de ser solo un fallback en código.
 */
function libro_seed_footer_logos() {
    $logos = get_option('libro_footer_logos', array());
    if (!empty($logos)) {
        return;
    }
    $base = get_template_directory_uri() . '/assets/images/sponsors/';
    update_option('libro_footer_logos', array(
        array('alt' => 'Cabildo de Gran Canaria', 'src' => $base . 'cabildo-gran-canaria.webp', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Instituto Insular de Deportes', 'src' => $base . 'instituto-insular-deportes.webp', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Gobierno de Canarias', 'src' => $base . 'gobierno-canarias.webp', 'url' => 'https://www.gobiernodecanarias.org'),
        array('alt' => 'Islas Canarias', 'src' => $base . 'islas-canarias.webp', 'url' => 'https://www.islascanarias.org'),
        array('alt' => 'Ayuntamiento de Las Palmas de Gran Canaria', 'src' => $base . 'ayuntamiento-las-palmas.webp', 'url' => 'https://www.laspalmasgc.es'),
        array('alt' => 'Instituto Municipal de Deportes', 'src' => $base . 'instituto-municipal-deportes.webp', 'url' => 'https://www.laspalmasgc.es'),
        array('alt' => 'Turismo de Gran Canaria', 'src' => $base . 'turismo-gran-canaria.webp', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Real Federación Española de Voleibol', 'src' => $base . 'rfevb.webp', 'url' => 'https://www.rfevb.com'),
    ));
}
add_action('after_switch_theme', 'libro_seed_footer_logos');

/**
 * Crea automáticamente la página de inicio (con la plantilla del 50 Aniversario)
 * y la establece como página de portada, si no existe ya una página usando
 * esta plantilla. Evita el paso manual de "Ajustes → Lectura".
 */
function libro_setup_homepage() {
    $template_file = 'template-home.php';

    // ¿Ya existe una página con esta plantilla asignada?
    $existing = get_posts(array(
        'post_type'      => 'page',
        'posts_per_page'  => 1,
        'post_status'    => array('publish', 'draft', 'private'),
        'meta_key'       => '_wp_page_template',
        'meta_value'     => $template_file,
        'fields'         => 'ids',
    ));

    if (!empty($existing)) {
        $home_page_id = $existing[0];
    } else {
        $home_page_id = wp_insert_post(array(
            'post_title'     => 'Inicio',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ), false);

        if ($home_page_id && !is_wp_error($home_page_id)) {
            update_post_meta($home_page_id, '_wp_page_template', $template_file);
        }
    }

    if (empty($home_page_id) || is_wp_error($home_page_id)) {
        return;
    }

    // Establecerla como página de portada, solo si la portada actual
    // no es ya una página válida (para no pisar una elección deliberada).
    $current_front_id = (int) get_option('page_on_front');
    if (get_option('show_on_front') !== 'page' || !$current_front_id || !get_post($current_front_id)) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page_id);
    }
}
add_action('after_switch_theme', 'libro_setup_homepage');


function libro_theme_activation() {
    libro_register_capitulos_cpt();
    flush_rewrite_rules();
    // Nota: la importación de capítulos (libro_import_sample_content) y la
    // creación de páginas legales (libro_create_legal_pages) ya están
    // enganchadas a 'after_switch_theme' de forma independiente en
    // inc/sample-content.php, así que no es necesario llamarlas aquí.
}
add_action('after_switch_theme', 'libro_theme_activation');

/**
 * La cita ya puede traer una comilla inicial desde el texto del libro.
 * La retiramos solo al mostrarla porque el estilo visual añade una única
 * comilla decorativa; el contenido guardado en WordPress no se modifica.
 */
function libro_mostrar_cita_con_una_sola_comilla($content) {
    return preg_replace('/^(\s*(?:<p>)?\s*)[\"\x{201C}\x{00AB}]/u', '$1', $content, 1);
}

/**
 * Shortcode: Editorial Quote - idéntico a React EditorialQuote.tsx
 * Uso: [cita_editorial author="Nombre" source="Fuente"]Texto de la cita[/cita_editorial]
 */
function libro_shortcode_cita_editorial($atts, $content = null) {
    $atts = shortcode_atts(array(
        'author' => '',
        'source' => '',
    ), $atts, 'cita_editorial');

    ob_start();
    ?>
    <blockquote class="editorial-quote my-8 md:my-12 py-4" data-reveal="left">
        <p class="text-xl md:text-2xl text-foreground/90 leading-relaxed mb-4">
            <?php echo wp_kses_post(libro_mostrar_cita_con_una_sola_comilla($content)); ?>
        </p>
        <?php if ($atts['author'] || $atts['source']) : ?>
        <footer class="text-sm text-muted-foreground">
            <?php if ($atts['author']) : ?>
            <cite class="not-italic font-medium"><?php echo esc_html($atts['author']); ?></cite>
            <?php endif; ?>
            <?php if ($atts['source']) : ?>
            <span class="ml-2">— <?php echo esc_html($atts['source']); ?></span>
            <?php endif; ?>
        </footer>
        <?php endif; ?>
    </blockquote>
    <?php
    return ob_get_clean();
}
add_shortcode('cita_editorial', 'libro_shortcode_cita_editorial');

/**
 * Shortcode: Content Image - idéntico a React ContentImage.tsx
 * Uso: [imagen_contenido src="url" alt="descripción" caption="pie de foto" fullwidth="true"]
 */
function libro_shortcode_imagen_contenido($atts) {
    $atts = shortcode_atts(array(
        'src'       => '',
        'file'      => '',
        'alt'       => '',
        'caption'   => '',
        'fullwidth' => 'false',
        'max_width' => '',
    ), $atts, 'imagen_contenido');

    // Allow file="filename.jpg" as shorthand for assets/images/
    if ( empty($atts['src']) && ! empty($atts['file']) ) {
        $atts['src'] = get_template_directory_uri() . '/assets/images/' . $atts['file'];
    }

    if (empty($atts['src'])) {
        return '';
    }
    
    $fullwidth_class = $atts['fullwidth'] === 'true' ? '-mx-4 md:-mx-8' : '';
    $figure_style    = '';
    if ( ! empty($atts['max_width']) ) {
        $figure_style = ' style="max-width:' . esc_attr($atts['max_width']) . ';margin-left:auto;margin-right:auto;"';
    }
    
    ob_start();
    ?>
    <figure class="content-image my-8 md:my-12 <?php echo esc_attr($fullwidth_class); ?>"<?php echo $figure_style; ?> data-reveal="up">
        <div class="overflow-hidden rounded">
            <img 
                src="<?php echo esc_url($atts['src']); ?>" 
                alt="<?php echo esc_attr($atts['alt']); ?>"
                class="w-full h-auto object-cover transition-transform duration-500 hover:scale-[1.02]"
                loading="lazy"
            >
        </div>
        <?php if ($atts['caption']) : ?>
        <figcaption class="mt-3 text-sm text-muted-foreground italic text-center">
            <?php echo esc_html($atts['caption']); ?>
        </figcaption>
        <?php endif; ?>
    </figure>
    <?php
    return ob_get_clean();
}
add_shortcode('imagen_contenido', 'libro_shortcode_imagen_contenido');

/**
 * Shortcode alternativo para imágenes usando ID de media
 * Uso: [imagen id="123" caption="pie de foto" fullwidth="true"]
 */
function libro_shortcode_imagen_id($atts) {
    $atts = shortcode_atts(array(
        'id' => '',
        'size' => 'large',
        'caption' => '',
        'fullwidth' => 'false',
    ), $atts, 'imagen');
    
    if (empty($atts['id'])) {
        return '';
    }
    
    $image_src = wp_get_attachment_image_url($atts['id'], $atts['size']);
    $image_alt = get_post_meta($atts['id'], '_wp_attachment_image_alt', true);
    
    if (!$image_src) {
        return '';
    }
    
    $fullwidth_class = $atts['fullwidth'] === 'true' ? '-mx-4 md:-mx-8' : '';
    
    ob_start();
    ?>
    <figure class="content-image my-8 md:my-12 <?php echo esc_attr($fullwidth_class); ?>" data-reveal="up">
        <div class="overflow-hidden rounded">
            <img 
                src="<?php echo esc_url($image_src); ?>" 
                alt="<?php echo esc_attr($image_alt); ?>"
                class="w-full h-auto object-cover transition-transform duration-500 hover:scale-[1.02]"
                loading="lazy"
            >
        </div>
        <?php if ($atts['caption']) : ?>
        <figcaption class="mt-3 text-sm text-muted-foreground italic text-center">
            <?php echo esc_html($atts['caption']); ?>
        </figcaption>
        <?php endif; ?>
    </figure>
    <?php
    return ob_get_clean();
}
add_shortcode('imagen', 'libro_shortcode_imagen_id');

/**
 * Shortcode: Chapter Hero - Cabecera de capítulo personalizable
 * Uso: [hero_capitulo background="url" overlay="rgba(0,0,0,0.5)" icon="star" icon_color="#D4AF37" alignment="center" vertical="center" border_color="#D4AF37"]
 *      [hero_linea color="#FFFFFF" highlight="#D4AF37"]Texto de la línea[/hero_linea]
 * [/hero_capitulo]
 */
function libro_shortcode_hero_capitulo($atts, $content = null) {
    $atts = shortcode_atts(array(
        'background' => '',
        'background_color' => '',
        'height' => '',
        'overlay' => '',
        'icon' => 'star',
        'icon_color' => '#D4AF37',
        'custom_icon' => '',
        'custom_icon_color' => '',
        'icon_width' => '80',
        'icon_height' => '80',
        'alignment' => 'center',
        'vertical' => 'center',
        'border_color' => '',
        'min_height' => '400px',
        'aspect_ratio' => '',
    ), $atts, 'hero_capitulo');
    
    // Alignment classes
    $align_classes = array(
        'left' => 'items-start text-left',
        'center' => 'items-center text-center',
        'right' => 'items-end text-right',
    );
    
    $vertical_classes = array(
        'top' => 'justify-start pt-16',
        'center' => 'justify-center',
        'bottom' => 'justify-end pb-16',
    );
    
    $alignment_class = isset($align_classes[$atts['alignment']]) ? $align_classes[$atts['alignment']] : $align_classes['center'];
    $vertical_class = isset($vertical_classes[$atts['vertical']]) ? $vertical_classes[$atts['vertical']] : $vertical_classes['center'];
    
    // Icon size style
    $icon_width = intval($atts['icon_width']) ?: 80;
    $icon_height = intval($atts['icon_height']) ?: 80;
    $icon_size_style = 'width: ' . $icon_width . 'px; height: ' . $icon_height . 'px;';
    
    // Icon HTML
    $icon_html = '';
    if ($atts['icon'] === 'custom' && $atts['custom_icon']) {
        // Check if it's an SVG file
        $is_svg = preg_match('/\.svg$/i', $atts['custom_icon']);
        
        if ($is_svg && $atts['custom_icon_color']) {
            // For SVG with color - use inline SVG via JavaScript
            $icon_html = '<div class="inline-svg-icon" 
                data-src="' . esc_url($atts['custom_icon']) . '" 
                data-color="' . esc_attr($atts['custom_icon_color']) . '" 
                style="' . $icon_size_style . ' display: inline-block;"
            ></div>';
        } else {
            // Regular image (PNG, JPG, or SVG without color change)
            $icon_html = '<img src="' . esc_url($atts['custom_icon']) . '" alt="" style="' . $icon_size_style . ' object-fit: contain;" class="drop-shadow-lg">';
        }
    } elseif ($atts['icon'] === 'star') {
        $icon_html = '<svg style="' . $icon_size_style . ' color: ' . esc_attr($atts['icon_color']) . ';" class="fill-current drop-shadow-lg" viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>';
    } elseif ($atts['icon'] === 'star-outline') {
        $icon_html = '<svg style="' . $icon_size_style . ' color: ' . esc_attr($atts['icon_color']) . ';" fill="none" stroke="currentColor" stroke-width="2" class="drop-shadow-lg" viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>';
    }
    
    // Style for container
    $container_style = '';
    if ($atts['height']) {
        $container_style .= 'height: ' . esc_attr($atts['height']) . '; min-height: auto;';
    } elseif ($atts['aspect_ratio']) {
        $container_style .= 'aspect-ratio: ' . esc_attr($atts['aspect_ratio']) . ';';
    } else {
        $container_style .= 'min-height: ' . esc_attr($atts['min_height']) . ';';
    }
    
    ob_start();
    ?>
    <div class="chapter-hero relative overflow-hidden" style="<?php echo $container_style; ?><?php if ($atts['background_color']) echo 'background-color:' . esc_attr($atts['background_color']) . ';'; ?>">
        <?php if ($atts['background']) : ?>
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat hero-bg-parallax" style="background-image: url('<?php echo esc_url($atts['background']); ?>');"></div>
        <?php endif; ?>
        
        <?php if ($atts['overlay']) : ?>
        <div class="absolute inset-0" style="background-color: <?php echo esc_attr($atts['overlay']); ?>;"></div>
        <?php endif; ?>
        
        <?php if ($atts['border_color']) : ?>
        <div class="absolute inset-4 sm:inset-6 md:inset-8 border-2 pointer-events-none" style="border-color: <?php echo esc_attr($atts['border_color']); ?>;"></div>
        <?php endif; ?>
        
        <div class="relative z-10 flex flex-col h-full w-full px-6 sm:px-8 md:px-12 py-8 <?php echo esc_attr($alignment_class . ' ' . $vertical_class); ?>">
            <?php if ($icon_html) : ?>
            <div class="mb-4 hero-icon-animated"><?php echo $icon_html; ?></div>
            <?php endif; ?>
            
            <div class="flex flex-col gap-1 <?php echo $atts['alignment'] === 'center' ? 'items-center' : ($atts['alignment'] === 'right' ? 'items-end' : 'items-start'); ?>">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('hero_capitulo', 'libro_shortcode_hero_capitulo');

/**
 * Shortcode: Hero Line - Línea de título dentro del hero
 * Uso: [hero_linea color="#FFFFFF" highlight="#D4AF37"]Texto[/hero_linea]
 */
function libro_shortcode_hero_linea($atts, $content = null) {
    $atts = shortcode_atts(array(
        'color' => '#FFFFFF',
        'highlight' => '',
    ), $atts, 'hero_linea');
    
    $style = 'color: ' . esc_attr($atts['color']) . ';';
    $classes = 'font-display font-black text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight';
    
    if ($atts['highlight']) {
        $style .= ' background-color: ' . esc_attr($atts['highlight']) . ';';
        $classes .= ' inline-block px-2 py-1';
        return '<div class="hero-line-animated"><span class="' . esc_attr($classes) . '" style="' . esc_attr($style) . '">' . wp_kses_post($content) . '</span></div>';
    }
    
    return '<div class="hero-line-animated"><span class="block ' . esc_attr($classes) . '" style="' . esc_attr($style) . '">' . wp_kses_post($content) . '</span></div>';
}
add_shortcode('hero_linea', 'libro_shortcode_hero_linea');

/**
 * Shortcode: Resaltado de texto - idéntico a React HighlightText.tsx
 * Uso: [resaltado color_fondo="hsl(45, 100%, 50%)" color_texto="#1a237e"]Texto resaltado[/resaltado]
 */
function libro_shortcode_resaltado($atts, $content = null) {
    $atts = shortcode_atts(array(
        'color_fondo' => 'hsl(45, 100%, 50%)',
        'color_texto' => '#1a237e',
    ), $atts, 'resaltado');

    $style = 'background-color: ' . esc_attr($atts['color_fondo']) . '; color: ' . esc_attr($atts['color_texto']) . ';';

    return '<mark class="px-1 py-0.5 rounded-sm font-semibold" style="' . esc_attr($style) . '">' . wp_kses_post($content) . '</mark>';
}
add_shortcode('resaltado', 'libro_shortcode_resaltado');

/**
 * [bloque_lista_foto file="foto.png" alt="Nombre"]
 * Dos columnas: listado (resaltados fit-content) a la izquierda,
 * foto cut-out a la derecha alineada al bottom.
 */
function libro_shortcode_bloque_lista_foto($atts, $content = null) {
    $atts = shortcode_atts(array(
        'file' => '',
        'alt'  => '',
    ), $atts, 'bloque_lista_foto');

    $img_url = '';
    if (!empty($atts['file'])) {
        $img_url = get_template_directory_uri() . '/assets/images/' . $atts['file'];
    }

    // Strip wpautop-inserted <br> and empty <p> between shortcodes
    $content = shortcode_unautop($content);
    $inner   = do_shortcode($content);
    // Only strip <br> that appear between </mark> and <mark> (wpautop artefacts),
    // NOT <br> inside a <mark> (e.g. Chava González two-line pill)
    $inner   = preg_replace('|</mark>\s*<br\s*/?>\s*<mark|i', '</mark><mark', $inner);
    $inner   = preg_replace('/<p>\s*<\/p>/i', '', $inner);

    ob_start();
    ?>
    <div class="lista-foto-grid">
        <div class="lista-foto-col">
            <?php echo $inner; ?>
        </div>
        <?php if ($img_url) : ?>
        <div>
            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($atts['alt']); ?>" class="lista-foto-img">
        </div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('bloque_lista_foto', 'libro_shortcode_bloque_lista_foto');

/**
 * Shortcode: Section Header - idéntico a React SectionHeader.tsx
 * Uso: [seccion_header]Título de la sección[/seccion_header]
 * Uso sin resalte: [seccion_header highlighted="false"]Título[/seccion_header]
 * Uso con color personalizado (SOLO para capítulos con color propio, ej. Cap 3 vino):
 *   [seccion_header color="hsl(2 82% 30%)"]Título[/seccion_header]
 *   → El color DEBE definirse explícitamente en cada header. No se hereda automáticamente.
 *   → Sin color= el highlight es siempre dorado (comportamiento por defecto).
 */
function libro_shortcode_seccion_header($atts, $content = null) {
    $atts = shortcode_atts(array(
        'highlighted' => 'true',
        'color'       => '',
        'star'        => 'false',
        'texto'       => '',   // text color override; defaults to #ffffff for dark bg, class default for no-color
        'tag'         => 'h3', // html tag: h2 or h3
        'id'          => '',   // optional HTML id, used as anchor target for sidebar deep-links
    ), $atts, 'seccion_header');

    $tag = in_array($atts['tag'], array('h2', 'h3')) ? $atts['tag'] : 'h3';
    $anchor_id = $atts['id'] ? ' id="' . esc_attr(sanitize_title($atts['id'])) . '"' : '';

    // Star above the header — left-aligned, estrella-icon.svg path inline, proportional to section text (1rem)
    $star_above = '';
    if ($atts['star'] === 'true' || $atts['star'] === '1') {
        // Norma editorial: las estrellas de los subtítulos usan siempre el dorado corporativo.
        $star_color = 'hsl(45 100% 50%)';
        // estrella-icon.svg viewBox 1280×1181 → aspect ratio ~1.08:1 → at 1.2rem height, width ≈ 1.3rem
        $star_above = '<span aria-hidden="true" style="display:block;margin-bottom:0.3rem;">'
            . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 1181" style="width:2.3rem;height:2.2rem;display:inline-block;" fill="' . $star_color . '">'
            . '<g transform="translate(0,1181) scale(0.1,-0.1)" fill="' . $star_color . '" stroke="none">'
            . '<path d="M6327 11292 c-60 -180 -161 -489 -227 -687 -65 -198 -233 -709 -373 -1135 -141 -426 -367 -1114 -503 -1527 l-248 -753 -2358 0 c-1297 0 -2358 -3 -2358 -7 0 -5 170 -130 378 -279 207 -149 1057 -758 1887 -1353 831 -596 1518 -1091 1528 -1100 20 -19 55 94 -420 -1346 -187 -570 -344 -1047 -628 -1910 -141 -429 -286 -869 -322 -978 -36 -109 -63 -201 -60 -204 7 -6 -236 -180 1912 1362 1012 726 1855 1331 1872 1343 l33 23 762 -548 c2447 -1758 3053 -2191 3056 -2188 2 2 -46 153 -106 337 -61 183 -216 655 -346 1048 -511 1556 -712 2168 -811 2470 -145 440 -185 563 -185 575 0 6 855 623 1900 1373 1045 750 1900 1368 1900 1373 0 5 -909 10 -2357 11 l-2356 3 -164 500 c-90 275 -272 826 -403 1225 -131 399 -383 1166 -560 1705 -177 539 -325 983 -329 987 -4 5 -55 -139 -114 -320z"/>'
            . '</g></svg></span>';
    }

    if ($atts['highlighted'] === 'true' || $atts['highlighted'] === '1') {
        if ($atts['color'] === 'inverted') {
            return '<div class="mt-10 mb-5"' . $anchor_id . ' data-reveal="left">' . $star_above . '<' . $tag . ' class="section-header-highlighted section-header-inverted">' . wp_kses_post($content) . '</' . $tag . '></div>';
        }
        if ($atts['color'] === 'navy') {
            return '<div class="mt-10 mb-5"' . $anchor_id . ' data-reveal="left">' . $star_above . '<' . $tag . ' class="section-header-highlighted section-header-navy">' . wp_kses_post($content) . '</' . $tag . '></div>';
        }
        $text_color = $atts['texto'] ? esc_attr($atts['texto']) : ($atts['color'] ? '#ffffff' : '');
        $style = '';
        if ($atts['color'] || $text_color) {
            $style = ' style="' . ($atts['color'] ? 'background-color:' . esc_attr($atts['color']) . ';' : '') . ($text_color ? 'color:' . $text_color . ';' : '') . '"';
        }
        return '<div class="mt-10 mb-5"' . $anchor_id . ' data-reveal="left">' . $star_above . '<' . $tag . ' class="section-header-highlighted"' . $style . '>' . wp_kses_post($content) . '</' . $tag . '></div>';
    }

    return '<' . $tag . ' class="font-serif text-xl md:text-2xl font-bold text-foreground mt-12 mb-6 uppercase tracking-wide"' . $anchor_id . ' data-reveal="left">' . wp_kses_post($content) . '</' . $tag . '>';
}
add_shortcode('seccion_header', 'libro_shortcode_seccion_header');
add_shortcode('encabezado_seccion', 'libro_shortcode_seccion_header');

/**
 * Shortcode: Bloque de color — envuelve contenido en un div con fondo coloreado
 * Uso: [bloque_color fondo="hsl(46, 92%, 62%)"]...[/bloque_color]
 */
function libro_shortcode_bloque_color($atts, $content = null) {
    $atts = shortcode_atts(array(
        'fondo'  => 'hsl(46, 92%, 62%)',
        'texto'  => '#1a1a0a',
        'radio'  => '0.5rem',
    ), $atts, 'bloque_color');

    $style = 'background-color:' . esc_attr($atts['fondo']) . ';color:' . esc_attr($atts['texto']) . ';border-radius:' . esc_attr($atts['radio']) . ';padding:1.5rem 2rem;margin:2rem 0;';

    $processed = do_shortcode($content);
    // wpautop runs before do_shortcode and injects <br> / empty <p> at the start — strip them
    $processed = preg_replace('/^(\s*(<br\s*\/?>|<p>\s*<\/p>|<p>&nbsp;<\/p>)\s*)+/i', '', $processed);
    return '<div class="bloque-color" style="' . $style . '">' . $processed . '</div>';
}
add_shortcode('bloque_color', 'libro_shortcode_bloque_color');

/**
 * Shortcode: Foto pendiente — placeholder visual para fotos no subidas aún
 * Uso: [foto_pendiente descripcion="Descripción de la foto pendiente"]
 */
function libro_shortcode_foto_pendiente($atts) {
    $atts = shortcode_atts(array(
        'descripcion' => 'Imagen pendiente',
    ), $atts, 'foto_pendiente');

    $camera_svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="hsl(45,100%,50%)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width:2.5rem;height:2.5rem;opacity:0.7;display:block;margin:0 auto 0.75rem;"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>';

    $desc = esc_html($atts['descripcion']);
    $style = 'background-color:hsl(220,25%,10%);border:1px dashed hsl(220,20%,25%);border-radius:0.25rem;padding:2.5rem 2rem;margin:2rem 0;text-align:center;';

    return '<div class="foto-pendiente" style="' . $style . '">'
        . $camera_svg
        . '<p style="color:hsl(220,15%,60%);font-size:0.8rem;font-style:italic;margin:0;line-height:1.4;">' . $desc . '</p>'
        . '</div>';
}
add_shortcode('foto_pendiente', 'libro_shortcode_foto_pendiente');

/**
 * Shortcode: Encabezado de sección (alias) - usado en Estatutos
 * Uso: [encabezado_seccion]Capítulo I — Constitución[/encabezado_seccion]
 */
add_shortcode('encabezado_seccion', 'libro_shortcode_seccion_header');

/**
 * Shortcode: Player Profile - idéntico a React PlayerProfile.tsx
 * Uso: [perfil_jugador nombre="Nombre" subtitulo="Subtítulo" imagen="url" imagen_alt="alt" imagen_caption="caption" posicion_imagen="left"]
 *      Contenido del perfil...
 * [/perfil_jugador]
 */
function libro_shortcode_perfil_jugador($atts, $content = null) {
    $atts = shortcode_atts(array(
        'nombre'          => '',
        'subtitulo'       => '',
        'imagen'          => '',
        'imagen_alt'      => '',
        'imagen_caption'  => '',
        'posicion_imagen' => 'left',
    ), $atts, 'perfil_jugador');

    ob_start();
    ?>
    <div class="my-12 md:my-16" data-reveal="up">
        <h3 class="player-profile-name"><?php echo esc_html($atts['nombre']); ?></h3>
        <?php if ($atts['subtitulo']) : ?>
        <p class="text-sm text-muted-foreground italic mb-6"><?php echo esc_html($atts['subtitulo']); ?></p>
        <?php endif; ?>

        <div class="flex flex-col <?php echo $atts['imagen'] ? 'md:flex-row gap-8' : ''; ?> <?php echo $atts['posicion_imagen'] === 'right' ? 'md:flex-row-reverse' : ''; ?>">
            <?php if ($atts['imagen']) : ?>
            <div class="md:w-2/5 flex-shrink-0">
                <figure>
                    <img src="<?php echo esc_url($atts['imagen']); ?>"
                         alt="<?php echo esc_attr($atts['imagen_alt'] ?: $atts['nombre']); ?>"
                         class="w-full h-auto object-cover grayscale hover:grayscale-0 transition-all duration-700"
                         loading="lazy">
                    <?php if ($atts['imagen_caption']) : ?>
                    <figcaption class="mt-2 text-xs text-muted-foreground italic leading-relaxed">
                        <?php echo esc_html($atts['imagen_caption']); ?>
                    </figcaption>
                    <?php endif; ?>
                </figure>
            </div>
            <?php endif; ?>

            <div class="<?php echo $atts['imagen'] ? 'md:w-3/5' : ''; ?> reading-content">
                <?php echo do_shortcode(wp_kses_post($content)); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('perfil_jugador', 'libro_shortcode_perfil_jugador');

/**
 * Shortcode: Newspaper Quote - idéntico a React NewspaperQuote.tsx
 * Uso: [cita_prensa source="La Provincia, 1987"]Texto de la cita[/cita_prensa]
 */
function libro_shortcode_cita_prensa($atts, $content = null) {
    $atts = shortcode_atts(array(
        'source' => '',
    ), $atts, 'cita_prensa');

    ob_start();
    ?>
    <div data-reveal="left">
        <blockquote class="newspaper-quote">
            <p><?php echo wp_kses_post(libro_mostrar_cita_con_una_sola_comilla($content)); ?></p>
            <?php if ($atts['source']) : ?>
            <cite class="newspaper-quote-source"><?php echo esc_html($atts['source']); ?></cite>
            <?php endif; ?>
        </blockquote>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('cita_prensa', 'libro_shortcode_cita_prensa');

/**
 * Shortcode: Drop Cap - Capitular dorada
 * Uso: [capitular]Texto del primer párrafo...[/capitular]
 */
function libro_shortcode_capitular($atts, $content = null) {
    if (empty($content)) return '';
    $first = mb_substr($content, 0, 1);
    $rest = mb_substr($content, 1);
    return '<p class="drop-cap-paragraph" data-reveal="none"><span class="drop-cap">' . esc_html($first) . '</span>' . wp_kses_post($rest) . '</p>';
}
add_shortcode('capitular', 'libro_shortcode_capitular');

/**
 * Shortcode: Article Block - Bloque de artículo legal
 * Uso: [articulo numero="1º"]Contenido del artículo[/articulo]
 */
function libro_shortcode_articulo($atts, $content = null) {
    $atts = shortcode_atts(array(
        'numero' => '',
    ), $atts, 'articulo');

    $html = '<div class="article-block">';
    if ($atts['numero']) {
        $html .= '<span class="article-number">Artículo ' . esc_html($atts['numero']) . '.</span>';
    }
    $html .= '<span class="article-text">' . wp_kses_post($content) . '</span>';
    $html .= '</div>';
    return $html;
}
add_shortcode('articulo', 'libro_shortcode_articulo');

/**
 * Shortcode: Prologue Layout - Maquetación de prólogos al estilo del libro
 * Uso: [prologo nombre="Fernando Clavijo" cargo="Presidente del Gobierno de Canarias" foto="url" posicion="center 20%"]Texto del prólogo[/prologo]
 */
function libro_shortcode_prologo($atts, $content = null) {
    $atts = shortcode_atts(array(
        'nombre' => '',
        'cargo'  => '',
        'foto'   => '',
        'posicion' => 'center 20%',
    ), $atts, 'prologo');

    ob_start();
    ?>
    <div class="prologue-layout" data-reveal="up">
        <div class="flex justify-center mb-8">
            <?php if ($atts['foto']) : ?>
            <div class="prologue-photo">
                <img src="<?php echo esc_url($atts['foto']); ?>" alt="<?php echo esc_attr($atts['nombre']); ?>" style="object-position: <?php echo esc_attr($atts['posicion']); ?>;" loading="lazy" />
            </div>
            <?php else : ?>
            <div class="prologue-photo-fallback">
                <span><?php
                    $words = explode(' ', $atts['nombre']);
                    echo esc_html(implode('', array_map(function($w) { return mb_substr($w, 0, 1); }, $words)));
                ?></span>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-center mb-2">
            <h3 class="prologue-name"><?php echo esc_html($atts['nombre']); ?></h3>
        </div>

        <p class="prologue-role"><?php echo esc_html($atts['cargo']); ?></p>

        <div class="reading-content" style="color: hsl(var(--foreground) / 0.85);">
            <?php echo wp_kses_post(wpautop($content)); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('prologo', 'libro_shortcode_prologo');

/**
 * Shortcode: [titulo_deportivo]
 * Layout 2 columnas:
 * - Izquierda: foto trofeo, estrella SVG + nombre título + año, texto narrativo
 * - Derecha: número grande (arriba), ficha técnica
 *
 * Cuando este shortcode está presente, oculta el <header> con el título de la página
 * en single-capitulo.php (via global $libro_has_titulo_deportivo).
 */
function libro_shortcode_titulo_deportivo($atts, $content = null) {
    global $libro_has_titulo_deportivo;
    $libro_has_titulo_deportivo = true;

    $atts = shortcode_atts(array(
        'numero'  => '',
        'nombre'  => '',
        'anio'    => '',
        'foto'    => '',
    ), $atts, 'titulo_deportivo');

    // Extraer ficha_tecnica y narrativa
    $ficha     = '';
    $narrativa = '';
    if (preg_match('/\[ficha_tecnica\](.*?)\[\/ficha_tecnica\]/s', $content, $m)) {
        $ficha = do_shortcode($m[1]);
    }
    if (preg_match('/\[narrativa\](.*?)\[\/narrativa\]/s', $content, $m)) {
        $narrativa = do_shortcode(wpautop($m[1]));
    }

    $foto_url    = $atts['foto'] ? libro_img($atts['foto']) : get_template_directory_uri() . '/assets/images/copa-default.jpg';
    $estrella_url = get_template_directory_uri() . '/assets/images/estrella-icon.svg';

    ob_start();
    ?>
    <div class="titulo-deportivo-wrapper" data-reveal="up">

        <!-- Bloque superior: foto + número -->
        <div class="titulo-deportivo-top">
            <div class="titulo-deportivo-foto">
                <?php if ($foto_url) : ?>
                <img src="<?php echo esc_url($foto_url); ?>" alt="<?php echo esc_attr($atts['nombre'] . ' ' . $atts['anio']); ?>">
                <?php endif; ?>
            </div>
            <div class="titulo-deportivo-numero-col">
                <?php if ($atts['numero']) : ?>
                <div class="titulo-deportivo-numero"><?php echo esc_html($atts['numero']); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bloque inferior: una columna — título, ficha, narrativa -->
        <div class="titulo-deportivo-bottom">

            <!-- Encabezado: estrella + nombre + año -->
            <div class="titulo-deportivo-encabezado">
                <img src="<?php echo esc_url($estrella_url); ?>" class="titulo-deportivo-estrella" alt="★" width="32" height="32">
                <h2 class="titulo-deportivo-nombre">
                    <span class="titulo-nombre-texto"><?php echo esc_html($atts['nombre']); ?></span>
                    <?php if ($atts['anio']) : ?>
                    <span class="titulo-nombre-anio"><?php echo esc_html($atts['anio']); ?></span>
                    <?php endif; ?>
                </h2>
            </div>

            <!-- Ficha técnica debajo del título -->
            <?php if ($ficha) : ?>
            <div class="titulo-deportivo-ficha">
                <span class="ficha-tecnica-titulo">Ficha técnica</span>
                <div class="ficha-tecnica-contenido">
                    <?php echo $ficha; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Narrativa al final -->
            <?php if ($narrativa) : ?>
            <div class="titulo-deportivo-narrativa">
                <?php echo $narrativa; ?>
            </div>
            <?php endif; ?>

        </div><!-- fin titulo-deportivo-bottom -->

    </div><!-- fin titulo-deportivo-wrapper -->
    <?php
    return ob_get_clean();
}
add_shortcode('titulo_deportivo', 'libro_shortcode_titulo_deportivo');

/**
 * Shortcode [dos_columnas] — divide contenido en dos columnas equilibradas
 * Usa ||| como separador entre columna izquierda y derecha
 * En mobile colapsa a una sola columna
 */
function libro_shortcode_dos_columnas($atts, $content = null) {
    $atts = shortcode_atts(array('igual' => 'false'), $atts);
    $igual_class = $atts['igual'] === 'true' ? ' dos-columnas--igual' : '';
    // Split on ||| delimiter
    $parts = explode('|||', $content, 2);
    $left  = isset($parts[0]) ? do_shortcode(trim($parts[0])) : '';
    $right = isset($parts[1]) ? do_shortcode(trim($parts[1])) : '';
    return '<div class="dos-columnas' . $igual_class . '"><div class="dos-columnas-col">' . $left . '</div><div class="dos-columnas-col">' . $right . '</div></div>';
}
add_shortcode('dos_columnas', 'libro_shortcode_dos_columnas');

/**
 * Shortcode [ficha_debut titulo=""] — bloque de ficha de debut con estrella y título
 * Reutiliza el mismo CSS de ficha_tecnica del titulo_deportivo
 */
function libro_shortcode_ficha_debut($atts, $content = null) {
    $atts = shortcode_atts(array(
        'titulo' => 'LA FICHA DEL DEBUT',
    ), $atts, 'ficha_debut');

    $estrella_url = get_template_directory_uri() . '/assets/images/estrella-icon.svg';

    ob_start();
    ?>
    <div class="ficha-debut-wrapper" data-reveal="up">
        <div class="ficha-debut-encabezado">
            <img src="<?php echo esc_url($estrella_url); ?>" class="ficha-debut-estrella" alt="★" width="40" height="40">
            <h2 class="ficha-debut-titulo"><?php echo esc_html($atts['titulo']); ?></h2>
        </div>
        <div class="titulo-deportivo-ficha">
            <div class="ficha-tecnica-contenido">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('ficha_debut', 'libro_shortcode_ficha_debut');


add_shortcode('ficha_tecnica', function($atts, $content = null) { return $content ?? ''; });
add_shortcode('narrativa',     function($atts, $content = null) { return $content ?? ''; });

/**
 * [equipo numero="3" nombre="GUAGUAS LAS PALMAS"]Jugadores...[/equipo]
 * Renderiza un bloque de equipo dentro de la ficha técnica
 */
add_shortcode('equipo', function($atts, $content = null) {
    $atts = shortcode_atts(array(
        'numero' => '',
        'nombre' => '',
    ), $atts, 'equipo');
    ob_start();
    ?>
    <div class="ficha-tecnica-equipo">
        <span class="ficha-equipo-numero"><?php echo esc_html($atts['numero']); ?></span>
        <div>
            <div class="ficha-equipo-nombre"><?php echo esc_html($atts['nombre']); ?></div>
            <div class="ficha-equipo-cuerpo"><?php echo wp_kses_post($content); ?></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
});

/**
 * Shortcode: [competiciones_europa] — infografía fullwidth de rivales europeos del Guaguas
 * Emite un marcador único que el filtro libro_content_inject_euro recoge y sustituye
 * por el bloque fullwidth, rompiendo el contenedor de texto limpiamente.
 */
function libro_shortcode_competiciones_europa($atts, $content = null) {
    $atts = shortcode_atts(array(
        'bg'     => '8cap_emba_compeuro_bg.jpg',
        'titulo' => '',
        'id'     => '',
    ), $atts, 'competiciones_europa');

    $bg_url    = libro_img(esc_attr($atts['bg']));
    $inner     = do_shortcode($content);
    $anchor_id = $atts['id'] ? ' id="' . esc_attr(sanitize_title($atts['id'])) . '"' : '';

    ob_start();
    ?>
    <div class="euro-infografia"<?php echo $anchor_id; ?>>
        <div class="euro-infografia__bg" style="background-image:url('<?php echo esc_url($bg_url); ?>');"></div>
        <div class="euro-infografia__overlay"></div>
        <div class="euro-infografia__inner">
            <?php if ($atts['titulo']) : ?>
            <div class="euro-infografia__titulo">
                <span class="euro-infografia__titulo-text"><?php echo esc_html(strtoupper($atts['titulo'])); ?></span>
            </div>
            <?php endif; ?>
            <div class="euro-infografia__grid">
                <?php echo $inner; ?>
            </div>
        </div>
    </div>
    <?php
    $html = ob_get_clean();

    return '<!--EURO_INFOGRAFIA_START-->' . $html . '<!--EURO_INFOGRAFIA_END-->';
}
add_shortcode('competiciones_europa', 'libro_shortcode_competiciones_europa');

/**
 * Filtro sobre the_content: no hace nada — los marcadores los procesa
 * directamente single-capitulo.php antes de que wpautop los toque.
 */

function libro_shortcode_temp($atts, $content = null) {
    $atts = shortcode_atts(array(
        'anio' => '',
        'comp' => '',
    ), $atts, 'temp');

    $rivals = do_shortcode($content);

    ob_start();
    ?>
    <div class="euro-temp">
        <div class="euro-temp__anio"><?php echo esc_html($atts['anio']); ?></div>
        <?php if ($atts['comp']) : ?>
        <div class="euro-temp__comp"><?php echo esc_html($atts['comp']); ?></div>
        <?php endif; ?>
        <ul class="euro-temp__rivales">
            <?php echo $rivals; ?>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('temp', 'libro_shortcode_temp');

function libro_shortcode_rival($atts, $content = null) {
    return '<li class="euro-rival"><span class="euro-rival__bullet"></span>' . wp_kses_post($content) . '</li>';
}
add_shortcode('rival', 'libro_shortcode_rival');

function libro_shortcode_nota_rival($atts, $content = null) {
    return '<p class="euro-nota">' . wp_kses_post($content) . '</p>';
}
add_shortcode('nota_rival', 'libro_shortcode_nota_rival');

/**
 * Redirigir capítulos padre al primer subcapítulo
 * Idéntico al comportamiento de React: Navigate to={children[0].slug}
 */
function libro_redirect_parent_chapters() {
    if (!is_singular('capitulo')) return;
    
    $children = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => 1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_parent'    => get_the_ID(),
    ));
    
    if (!empty($children)) {
        wp_redirect(get_permalink($children[0]->ID), 301);
        exit;
    }
}
add_action('template_redirect', 'libro_redirect_parent_chapters');
