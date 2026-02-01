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
    
    // Hero fields
    $hero_enabled = get_post_meta($post->ID, '_hero_enabled', true);
    $hero_image = get_post_meta($post->ID, '_hero_image', true);
    $hero_height = get_post_meta($post->ID, '_hero_height', true) ?: '';
    $hero_overlay = get_post_meta($post->ID, '_hero_overlay', true);
    $hero_icon = get_post_meta($post->ID, '_hero_icon', true) ?: 'star';
    $hero_icon_color = get_post_meta($post->ID, '_hero_icon_color', true) ?: '#D4AF37';
    $hero_custom_icon = get_post_meta($post->ID, '_hero_custom_icon', true);
    $hero_custom_icon_color = get_post_meta($post->ID, '_hero_custom_icon_color', true);
    $hero_icon_width = get_post_meta($post->ID, '_hero_icon_width', true) ?: '80';
    $hero_icon_height = get_post_meta($post->ID, '_hero_icon_height', true) ?: '80';
    $hero_alignment = get_post_meta($post->ID, '_hero_alignment', true) ?: 'center';
    $hero_vertical = get_post_meta($post->ID, '_hero_vertical', true) ?: 'center';
    $hero_title_lines = get_post_meta($post->ID, '_hero_title_lines', true);
    $hero_border_color = get_post_meta($post->ID, '_hero_border_color', true);
    
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
        .libro-meta-field input[type="url"],
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
        .libro-meta-section {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 25px;
            border-radius: 4px;
        }
        .libro-meta-section h3 {
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .libro-title-line {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .libro-title-line-fields {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 10px;
        }
        .libro-color-preview {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            margin-left: 5px;
        }
    </style>
    
    <?php
    // Check if this is a subchapter (has parent)
    $parent_id = wp_get_post_parent_id($post->ID);
    $parent_numero = $parent_id ? get_post_meta($parent_id, '_numero_capitulo', true) : '';
    $is_subchapter = $parent_id > 0;
    
    // Count siblings to calculate auto-number
    $sibling_order = 1;
    if ($is_subchapter) {
        $siblings = get_posts(array(
            'post_type' => 'capitulo',
            'posts_per_page' => -1,
            'post_parent' => $parent_id,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'fields' => 'ids'
        ));
        $sibling_order = array_search($post->ID, $siblings);
        if ($sibling_order === false) {
            $sibling_order = count($siblings);
        }
        $sibling_order++; // 1-based index
    }
    ?>
    
    <div class="libro-meta-field">
        <label for="libro_numero_capitulo">Número de Capítulo / Subcapítulo</label>
        <div style="display: flex; align-items: center; gap: 15px;">
            <input 
                type="text" 
                id="libro_numero_capitulo" 
                name="libro_numero_capitulo" 
                value="<?php echo esc_attr($numero); ?>" 
                placeholder="<?php echo $is_subchapter ? 'Ej: 1.1, 1.2...' : 'Ej: 01, 02...'; ?>"
                style="max-width: 150px;"
            >
            
            <!-- Preview badge -->
            <div id="numero-preview-container" style="display: flex; align-items: center; gap: 10px;">
                <span style="color: #666; font-size: 12px;">Vista previa:</span>
                <span id="numero-preview" style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    min-width: <?php echo $is_subchapter ? '1.25rem' : '1.5rem'; ?>;
                    height: <?php echo $is_subchapter ? '1.25rem' : '1.5rem'; ?>;
                    font-size: <?php echo $is_subchapter ? '10px' : '11px'; ?>;
                    font-weight: 600;
                    border-radius: 2px;
                    background-color: <?php echo $is_subchapter ? '#fff' : '#FBBF24'; ?>;
                    color: #1a365d;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
                    padding: 0 6px;
                "><?php 
                    if ($numero) {
                        echo esc_html($numero);
                    } elseif ($is_subchapter && $parent_numero) {
                        echo esc_html($parent_numero . '.' . $sibling_order);
                    } else {
                        echo '—';
                    }
                ?></span>
                <?php if ($is_subchapter && !$numero && $parent_numero) : ?>
                    <span style="color: #666; font-size: 11px; font-style: italic;">(auto-generado)</span>
                <?php endif; ?>
            </div>
        </div>
        <p class="description">
            <?php if ($is_subchapter) : ?>
                Este es un subcapítulo. Si dejas vacío, se auto-generará como "<?php echo esc_html($parent_numero ?: 'X'); ?>.<?php echo $sibling_order; ?>" basado en el número del padre.
            <?php else : ?>
                Para capítulos principales usa "01", "02", etc. Los subcapítulos heredarán este número.
            <?php endif; ?>
        </p>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        var isSubchapter = <?php echo $is_subchapter ? 'true' : 'false'; ?>;
        var parentNumero = '<?php echo esc_js($parent_numero); ?>';
        var siblingOrder = <?php echo (int)$sibling_order; ?>;
        
        $('#libro_numero_capitulo').on('input', function() {
            var value = $(this).val().trim();
            var preview = $('#numero-preview');
            var container = $('#numero-preview-container');
            
            if (value) {
                preview.text(value);
                container.find('span[style*="italic"]').remove();
            } else if (isSubchapter && parentNumero) {
                preview.text(parentNumero + '.' + siblingOrder);
                if (container.find('span[style*="italic"]').length === 0) {
                    container.append('<span style="color: #666; font-size: 11px; font-style: italic;">(auto-generado)</span>');
                }
            } else {
                preview.text('—');
                container.find('span[style*="italic"]').remove();
            }
        });
    });
    </script>
    
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
    
    <!-- HERO SECTION -->
    <div class="libro-meta-section">
        <h3>🖼️ Cabecera del Capítulo (Hero)</h3>
        <p class="description" style="margin-top: -5px; margin-bottom: 15px;">
            Configura una imagen de cabecera personalizada con títulos estilizados.
        </p>
        
        <div class="libro-meta-field">
            <div class="libro-meta-field-inline">
                <input 
                    type="checkbox" 
                    id="libro_hero_enabled" 
                    name="libro_hero_enabled" 
                    value="1" 
                    <?php checked($hero_enabled, '1'); ?>
                >
                <label for="libro_hero_enabled" style="margin-bottom: 0; font-weight: normal;">
                    Activar cabecera personalizada
                </label>
            </div>
        </div>
        
        <div id="hero-fields" style="<?php echo $hero_enabled !== '1' ? 'display:none;' : ''; ?>">
            <div class="libro-meta-field">
                <label for="libro_hero_image">Imagen de fondo</label>
                <input 
                    type="url" 
                    id="libro_hero_image" 
                    name="libro_hero_image" 
                    value="<?php echo esc_attr($hero_image); ?>" 
                    placeholder="https://..."
                    style="max-width: 70%; display: inline-block;"
                >
                <button type="button" class="button libro-upload-hero-image">Seleccionar imagen</button>
            </div>
            
            <div class="libro-meta-field">
                <label for="libro_hero_height">Altura del hero (opcional)</label>
                <input 
                    type="text" 
                    id="libro_hero_height" 
                    name="libro_hero_height" 
                    value="<?php echo esc_attr($hero_height); ?>" 
                    placeholder="Ej: 500px, 60vh, auto"
                    style="max-width: 200px;"
                >
                <p class="description">Usa px para píxeles fijos o vh para porcentaje de pantalla. Deja vacío para altura automática.</p>
            </div>
            
            <div class="libro-meta-field">
                <label for="libro_hero_overlay">Color de overlay (opcional)</label>
                <input 
                    type="text" 
                    id="libro_hero_overlay" 
                    name="libro_hero_overlay" 
                    value="<?php echo esc_attr($hero_overlay); ?>" 
                    placeholder="Ej: rgba(212,175,55,0.8) o #1a237e"
                    style="max-width: 300px;"
                >
                <p class="description">Usa rgba() para transparencia. Ej: rgba(26,35,126,0.7) para azul oscuro</p>
            </div>
            
            <div class="libro-meta-field">
                <label for="libro_hero_border_color">Color del borde decorativo (opcional)</label>
                <input 
                    type="text" 
                    id="libro_hero_border_color" 
                    name="libro_hero_border_color" 
                    value="<?php echo esc_attr($hero_border_color); ?>" 
                    placeholder="Ej: #D4AF37 o rgba(212,175,55,0.8)"
                    style="max-width: 300px;"
                >
            </div>
            
            <div class="libro-meta-field">
                <label for="libro_hero_icon">Tipo de icono</label>
                <select id="libro_hero_icon" name="libro_hero_icon">
                    <option value="star" <?php selected($hero_icon, 'star'); ?>>★ Estrella rellena</option>
                    <option value="star-outline" <?php selected($hero_icon, 'star-outline'); ?>>☆ Estrella vacía</option>
                    <option value="custom" <?php selected($hero_icon, 'custom'); ?>>📷 Imagen personalizada</option>
                    <option value="none" <?php selected($hero_icon, 'none'); ?>>Sin icono</option>
                </select>
            </div>
            
            <div id="hero-icon-color-field" class="libro-meta-field" style="<?php echo $hero_icon === 'custom' ? 'display:none;' : ''; ?>">
                <label for="libro_hero_icon_color">Color del icono</label>
                <input 
                    type="color" 
                    id="libro_hero_icon_color" 
                    name="libro_hero_icon_color" 
                    value="<?php echo esc_attr($hero_icon_color ?: '#D4AF37'); ?>"
                    style="width: 60px; height: 35px; padding: 2px;"
                >
            </div>
            
            <div id="hero-custom-icon-field" class="libro-meta-field" style="<?php echo $hero_icon !== 'custom' ? 'display:none;' : ''; ?>">
                <label for="libro_hero_custom_icon">Imagen del icono (SVG, PNG, etc.)</label>
                <input 
                    type="url" 
                    id="libro_hero_custom_icon" 
                    name="libro_hero_custom_icon" 
                    value="<?php echo esc_attr($hero_custom_icon); ?>" 
                    placeholder="https://..."
                    style="max-width: 60%; display: inline-block;"
                >
                <button type="button" class="button libro-upload-custom-icon">Seleccionar imagen</button>
                <p class="description" style="margin-top: 5px;">Los archivos SVG permiten cambiar el color. Las imágenes PNG/JPG mantienen su color original.</p>
            </div>
            
            <div id="hero-custom-icon-color-field" class="libro-meta-field" style="<?php echo ($hero_icon !== 'custom' || !$hero_custom_icon) ? 'display:none;' : ''; ?>">
                <label for="libro_hero_custom_icon_color">Color del icono SVG (opcional)</label>
                <input 
                    type="color" 
                    id="libro_hero_custom_icon_color" 
                    name="libro_hero_custom_icon_color" 
                    value="<?php echo esc_attr($hero_custom_icon_color ?: '#D4AF37'); ?>"
                    style="width: 60px; height: 35px; padding: 2px;"
                >
                <input 
                    type="checkbox" 
                    id="libro_hero_use_custom_icon_color" 
                    name="libro_hero_use_custom_icon_color" 
                    value="1" 
                    <?php checked(!empty($hero_custom_icon_color)); ?>
                > Aplicar color
                <p class="description" style="margin-top: 5px;">Solo funciona con archivos SVG. Marca "Aplicar color" para colorear el icono.</p>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 15px;">
                <div class="libro-meta-field">
                    <label for="libro_hero_icon_width">Ancho del icono (px)</label>
                    <input 
                        type="number" 
                        id="libro_hero_icon_width" 
                        name="libro_hero_icon_width" 
                        value="<?php echo esc_attr($hero_icon_width); ?>" 
                        placeholder="80"
                        style="max-width: 100px;"
                        min="20"
                        max="300"
                    >
                </div>
                
                <div class="libro-meta-field">
                    <label for="libro_hero_icon_height">Alto del icono (px)</label>
                    <input 
                        type="number" 
                        id="libro_hero_icon_height" 
                        name="libro_hero_icon_height" 
                        value="<?php echo esc_attr($hero_icon_height); ?>" 
                        placeholder="80"
                        style="max-width: 100px;"
                        min="20"
                        max="300"
                    >
                </div>
                
                <div class="libro-meta-field">
                    <label for="libro_hero_alignment">Alineación horizontal</label>
                    <select id="libro_hero_alignment" name="libro_hero_alignment">
                        <option value="left" <?php selected($hero_alignment, 'left'); ?>>Izquierda</option>
                        <option value="center" <?php selected($hero_alignment, 'center'); ?>>Centro</option>
                        <option value="right" <?php selected($hero_alignment, 'right'); ?>>Derecha</option>
                    </select>
                </div>
                
                <div class="libro-meta-field">
                    <label for="libro_hero_vertical">Posición vertical</label>
                    <select id="libro_hero_vertical" name="libro_hero_vertical">
                        <option value="top" <?php selected($hero_vertical, 'top'); ?>>Arriba</option>
                        <option value="center" <?php selected($hero_vertical, 'center'); ?>>Centro</option>
                        <option value="bottom" <?php selected($hero_vertical, 'bottom'); ?>>Abajo</option>
                    </select>
                </div>
            </div>
            
            <div class="libro-meta-field">
                <label>Líneas de título</label>
                <p class="description" style="margin-bottom: 10px;">
                    Cada línea puede tener su propio color y resaltado. Deja vacío para usar el título del capítulo.
                </p>
                
                <div id="hero-title-lines">
                    <?php 
                    if (!empty($hero_title_lines) && is_array($hero_title_lines)) :
                        foreach ($hero_title_lines as $index => $line) :
                    ?>
                    <div class="libro-title-line">
                        <div class="libro-title-line-fields" style="grid-template-columns: 2fr 1fr 1fr 1fr;">
                            <div>
                                <label>Texto</label>
                                <input type="text" name="libro_hero_title_lines[<?php echo $index; ?>][text]" value="<?php echo esc_attr($line['text']); ?>" placeholder="Texto de la línea">
                            </div>
                            <div>
                                <label>Color del texto</label>
                                <input type="color" name="libro_hero_title_lines[<?php echo $index; ?>][color]" value="<?php echo esc_attr($line['color'] ?: '#FFFFFF'); ?>" style="width: 50px; height: 30px;">
                            </div>
                            <div>
                                <label>Resaltado</label>
                                <input type="color" name="libro_hero_title_lines[<?php echo $index; ?>][highlight]" value="<?php echo esc_attr($line['highlight'] ?: '#D4AF37'); ?>" style="width: 50px; height: 30px;">
                                <input type="checkbox" name="libro_hero_title_lines[<?php echo $index; ?>][use_highlight]" value="1" <?php checked(!empty($line['use_highlight'])); ?>> Usar
                            </div>
                            <div>
                                <label>Peso</label>
                                <select name="libro_hero_title_lines[<?php echo $index; ?>][font_weight]" style="width: 100%;">
                                    <option value="normal" <?php selected(($line['font_weight'] ?? 'black'), 'normal'); ?>>Normal</option>
                                    <option value="medium" <?php selected(($line['font_weight'] ?? 'black'), 'medium'); ?>>Medium</option>
                                    <option value="semibold" <?php selected(($line['font_weight'] ?? 'black'), 'semibold'); ?>>Semibold</option>
                                    <option value="bold" <?php selected(($line['font_weight'] ?? 'black'), 'bold'); ?>>Bold</option>
                                    <option value="extrabold" <?php selected(($line['font_weight'] ?? 'black'), 'extrabold'); ?>>Extrabold</option>
                                    <option value="black" <?php selected(($line['font_weight'] ?? 'black'), 'black'); ?>>Black</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="button libro-remove-title-line" style="margin-top: 10px; color: #a00;">Eliminar línea</button>
                    </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>
                
                <button type="button" id="add-title-line" class="button">+ Añadir línea de título</button>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // Toggle hero fields
        $('#libro_hero_enabled').on('change', function() {
            $('#hero-fields').toggle(this.checked);
        });
        
        // Toggle icon fields based on icon type
        $('#libro_hero_icon').on('change', function() {
            var isCustom = $(this).val() === 'custom';
            $('#hero-custom-icon-field').toggle(isCustom);
            $('#hero-icon-color-field').toggle(!isCustom && $(this).val() !== 'none');
            
            // Show color field for custom icon if it's an SVG
            var iconUrl = $('#libro_hero_custom_icon').val();
            var isSvg = iconUrl && iconUrl.toLowerCase().endsWith('.svg');
            $('#hero-custom-icon-color-field').toggle(isCustom && isSvg);
        });
        
        // Show/hide SVG color field based on file type
        $('#libro_hero_custom_icon').on('change input', function() {
            var iconUrl = $(this).val();
            var isSvg = iconUrl && iconUrl.toLowerCase().endsWith('.svg');
            var isCustom = $('#libro_hero_icon').val() === 'custom';
            $('#hero-custom-icon-color-field').toggle(isCustom && isSvg);
        });
        
        // Media uploader para imagen hero
        $('.libro-upload-hero-image').on('click', function(e) {
            e.preventDefault();
            var inputField = $(this).prev('input');
            
            var mediaUploader = wp.media({
                title: 'Seleccionar imagen de cabecera',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
            });
            
            mediaUploader.open();
        });
        
        // Media uploader para icono personalizado
        $('.libro-upload-custom-icon').on('click', function(e) {
            e.preventDefault();
            var inputField = $(this).prev('input');
            
            var mediaUploader = wp.media({
                title: 'Seleccionar icono',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });
            
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                inputField.val(attachment.url);
            });
            
            mediaUploader.open();
        });
        
        // Añadir línea de título
        var lineIndex = <?php echo !empty($hero_title_lines) ? count($hero_title_lines) : 0; ?>;
        
        $('#add-title-line').on('click', function() {
            var html = '<div class="libro-title-line">' +
                '<div class="libro-title-line-fields" style="grid-template-columns: 2fr 1fr 1fr 1fr;">' +
                '<div><label>Texto</label><input type="text" name="libro_hero_title_lines[' + lineIndex + '][text]" placeholder="Texto de la línea"></div>' +
                '<div><label>Color del texto</label><input type="color" name="libro_hero_title_lines[' + lineIndex + '][color]" value="#FFFFFF" style="width: 50px; height: 30px;"></div>' +
                '<div><label>Resaltado</label><input type="color" name="libro_hero_title_lines[' + lineIndex + '][highlight]" value="#D4AF37" style="width: 50px; height: 30px;"> ' +
                '<input type="checkbox" name="libro_hero_title_lines[' + lineIndex + '][use_highlight]" value="1"> Usar</div>' +
                '<div><label>Peso</label><select name="libro_hero_title_lines[' + lineIndex + '][font_weight]" style="width: 100%;">' +
                '<option value="normal">Normal</option><option value="medium">Medium</option><option value="semibold">Semibold</option>' +
                '<option value="bold">Bold</option><option value="extrabold">Extrabold</option><option value="black" selected>Black</option></select></div>' +
                '</div>' +
                '<button type="button" class="button libro-remove-title-line" style="margin-top: 10px; color: #a00;">Eliminar línea</button>' +
                '</div>';
            
            $('#hero-title-lines').append(html);
            lineIndex++;
        });
        
        // Eliminar línea de título
        $(document).on('click', '.libro-remove-title-line', function() {
            $(this).closest('.libro-title-line').remove();
        });
    });
    </script>
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
    
    // Guardar campos de Hero
    $hero_enabled = isset($_POST['libro_hero_enabled']) ? '1' : '0';
    update_post_meta($post_id, '_hero_enabled', $hero_enabled);
    
    if (isset($_POST['libro_hero_image'])) {
        update_post_meta($post_id, '_hero_image', esc_url_raw($_POST['libro_hero_image']));
    }
    
    if (isset($_POST['libro_hero_height'])) {
        update_post_meta($post_id, '_hero_height', sanitize_text_field($_POST['libro_hero_height']));
    }
    
    if (isset($_POST['libro_hero_overlay'])) {
        update_post_meta($post_id, '_hero_overlay', sanitize_text_field($_POST['libro_hero_overlay']));
    }
    
    if (isset($_POST['libro_hero_border_color'])) {
        update_post_meta($post_id, '_hero_border_color', sanitize_text_field($_POST['libro_hero_border_color']));
    }
    
    if (isset($_POST['libro_hero_icon'])) {
        update_post_meta($post_id, '_hero_icon', sanitize_text_field($_POST['libro_hero_icon']));
    }
    
    if (isset($_POST['libro_hero_icon_color'])) {
        update_post_meta($post_id, '_hero_icon_color', sanitize_hex_color($_POST['libro_hero_icon_color']));
    }
    
    if (isset($_POST['libro_hero_custom_icon'])) {
        update_post_meta($post_id, '_hero_custom_icon', esc_url_raw($_POST['libro_hero_custom_icon']));
    }
    
    // Guardar color del icono SVG personalizado
    if (isset($_POST['libro_hero_use_custom_icon_color']) && isset($_POST['libro_hero_custom_icon_color'])) {
        update_post_meta($post_id, '_hero_custom_icon_color', sanitize_hex_color($_POST['libro_hero_custom_icon_color']));
    } else {
        delete_post_meta($post_id, '_hero_custom_icon_color');
    }
    
    if (isset($_POST['libro_hero_icon_width'])) {
        update_post_meta($post_id, '_hero_icon_width', absint($_POST['libro_hero_icon_width']));
    }
    
    if (isset($_POST['libro_hero_icon_height'])) {
        update_post_meta($post_id, '_hero_icon_height', absint($_POST['libro_hero_icon_height']));
    }
    
    if (isset($_POST['libro_hero_alignment'])) {
        update_post_meta($post_id, '_hero_alignment', sanitize_text_field($_POST['libro_hero_alignment']));
    }
    
    if (isset($_POST['libro_hero_vertical'])) {
        update_post_meta($post_id, '_hero_vertical', sanitize_text_field($_POST['libro_hero_vertical']));
    }
    
    // Guardar líneas de título
    if (isset($_POST['libro_hero_title_lines']) && is_array($_POST['libro_hero_title_lines'])) {
        $title_lines = array();
        foreach ($_POST['libro_hero_title_lines'] as $line) {
            if (!empty($line['text'])) {
                $title_lines[] = array(
                    'text' => sanitize_text_field($line['text']),
                    'color' => isset($line['color']) ? sanitize_hex_color($line['color']) : '#FFFFFF',
                    'highlight' => isset($line['highlight']) ? sanitize_hex_color($line['highlight']) : '',
                    'use_highlight' => isset($line['use_highlight']) ? '1' : '0',
                    'font_weight' => isset($line['font_weight']) ? sanitize_text_field($line['font_weight']) : 'black',
                );
            }
        }
        update_post_meta($post_id, '_hero_title_lines', $title_lines);
    } else {
        delete_post_meta($post_id, '_hero_title_lines');
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
