<?php
/**
 * Meta Boxes nativos para el CPT Capítulos
 * Sin necesidad de ACF - campos personalizados nativos de WordPress
 *
 * @package CV_Guaguas_Libro
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Añadir meta box para datos del capítulo
 */
function libro_add_capitulo_meta_box() {
    add_meta_box(
        'libro_capitulo_datos',
        'Datos del Capítulo',
        'libro_capitulo_meta_box_html',
        'capitulo',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'libro_add_capitulo_meta_box');

/**
 * HTML del meta box
 */
function libro_capitulo_meta_box_html($post) {
    // Nonce para seguridad
    wp_nonce_field('libro_capitulo_meta_box', 'libro_capitulo_meta_box_nonce');
    
    // Obtener valores guardados
    $numero = get_post_meta($post->ID, '_numero_capitulo', true);
    $mostrar_marcador = get_post_meta($post->ID, '_mostrar_marcador', true);
    $cita = get_post_meta($post->ID, '_cita_destacada', true);
    $autor_cita = get_post_meta($post->ID, '_autor_cita', true);
    
    // Si es nuevo, marcador activado por defecto
    if ($mostrar_marcador === '') {
        $mostrar_marcador = '1';
    }
    ?>
    <style>
        .libro-meta-field {
            margin-bottom: 20px;
        }
        .libro-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .libro-meta-field input[type="text"],
        .libro-meta-field textarea {
            width: 100%;
        }
        .libro-meta-field .description {
            color: #666;
            font-style: italic;
            font-size: 12px;
            margin-top: 5px;
        }
        .libro-meta-field-inline {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
    
    <div class="libro-meta-field">
        <label for="libro_numero_capitulo">Número de Capítulo</label>
        <input 
            type="text" 
            id="libro_numero_capitulo" 
            name="libro_numero_capitulo" 
            value="<?php echo esc_attr($numero); ?>" 
            placeholder="Ej: 01, 02, 03..."
            style="max-width: 150px;"
        >
        <p class="description">Deja vacío para prólogos o secciones sin numeración.</p>
    </div>
    
    <div class="libro-meta-field">
        <div class="libro-meta-field-inline">
            <input 
                type="checkbox" 
                id="libro_mostrar_marcador" 
                name="libro_mostrar_marcador" 
                value="1" 
                <?php checked($mostrar_marcador, '1'); ?>
            >
            <label for="libro_mostrar_marcador" style="margin-bottom: 0; font-weight: normal;">
                Mostrar marcador de capítulo (ej: "Capítulo 01")
            </label>
        </div>
    </div>
    
    <div class="libro-meta-field">
        <label for="libro_cita_destacada">Cita Destacada</label>
        <textarea 
            id="libro_cita_destacada" 
            name="libro_cita_destacada" 
            rows="4" 
            placeholder="Una cita memorable de este capítulo..."
        ><?php echo esc_textarea($cita); ?></textarea>
        <p class="description">Esta cita aparecerá destacada al final del contenido del capítulo.</p>
    </div>
    
    <div class="libro-meta-field">
        <label for="libro_autor_cita">Autor de la Cita</label>
        <input 
            type="text" 
            id="libro_autor_cita" 
            name="libro_autor_cita" 
            value="<?php echo esc_attr($autor_cita); ?>" 
            placeholder="Ej: Historia del CV Guaguas"
            style="max-width: 400px;"
        >
    </div>
    <?php
}

/**
 * Guardar meta datos
 */
function libro_save_capitulo_meta($post_id) {
    // Verificar nonce
    if (!isset($_POST['libro_capitulo_meta_box_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['libro_capitulo_meta_box_nonce'], 'libro_capitulo_meta_box')) {
        return;
    }
    
    // Verificar autoguardado
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Verificar permisos
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Guardar número de capítulo
    if (isset($_POST['libro_numero_capitulo'])) {
        update_post_meta($post_id, '_numero_capitulo', sanitize_text_field($_POST['libro_numero_capitulo']));
    }
    
    // Guardar mostrar marcador (checkbox)
    $mostrar_marcador = isset($_POST['libro_mostrar_marcador']) ? '1' : '0';
    update_post_meta($post_id, '_mostrar_marcador', $mostrar_marcador);
    
    // Guardar cita destacada
    if (isset($_POST['libro_cita_destacada'])) {
        update_post_meta($post_id, '_cita_destacada', sanitize_textarea_field($_POST['libro_cita_destacada']));
    }
    
    // Guardar autor de la cita
    if (isset($_POST['libro_autor_cita'])) {
        update_post_meta($post_id, '_autor_cita', sanitize_text_field($_POST['libro_autor_cita']));
    }
}
add_action('save_post_capitulo', 'libro_save_capitulo_meta');

/**
 * Función helper para obtener campos (compatible con ACF)
 * Si ACF está instalado usa get_field(), si no, usa get_post_meta()
 */
function libro_get_field($field_name, $post_id = null) {
    if ($post_id === null) {
        $post_id = get_the_ID();
    }
    
    // Si ACF está disponible, usarlo
    if (function_exists('get_field')) {
        $value = get_field($field_name, $post_id);
        if ($value !== null) {
            return $value;
        }
    }
    
    // Fallback a post_meta nativo
    $meta_key = '_' . $field_name;
    return get_post_meta($post_id, $meta_key, true);
}

/**
 * Añadir columnas personalizadas en la lista de capítulos
 */
function libro_capitulos_columns($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        
        if ($key === 'title') {
            $new_columns['numero'] = 'Número';
            $new_columns['orden'] = 'Orden';
        }
    }
    
    return $new_columns;
}
add_filter('manage_capitulo_posts_columns', 'libro_capitulos_columns');

/**
 * Contenido de columnas personalizadas
 */
function libro_capitulos_column_content($column, $post_id) {
    switch ($column) {
        case 'numero':
            $numero = libro_get_field('numero_capitulo', $post_id);
            echo $numero ? esc_html($numero) : '—';
            break;
            
        case 'orden':
            $post = get_post($post_id);
            echo esc_html($post->menu_order);
            break;
    }
}
add_action('manage_capitulo_posts_custom_column', 'libro_capitulos_column_content', 10, 2);

/**
 * Hacer la columna de orden ordenable
 */
function libro_capitulos_sortable_columns($columns) {
    $columns['orden'] = 'menu_order';
    return $columns;
}
add_filter('manage_edit-capitulo_sortable_columns', 'libro_capitulos_sortable_columns');
