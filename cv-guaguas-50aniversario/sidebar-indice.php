<?php
/**
 * Sidebar con índice de capítulos - CV Guaguas
 * IDENTICAL to React SidebarIndex.tsx
 */

/**
 * Parsea el meta '_anclas_internas' de un post.
 * Formato: una línea por ancla, "Texto a mostrar | id-del-ancla"
 * Devuelve array de ['texto' => ..., 'id' => ...]
 */
function libro_parse_anclas_internas($post_id) {
    $raw = get_post_meta($post_id, '_anclas_internas', true);
    $anclas = array();
    if (!empty($raw)) {
        foreach (preg_split('/\r\n|\r|\n/', trim($raw)) as $linea) {
            $linea = trim($linea);
            if ($linea === '' || strpos($linea, '|') === false) continue;
            list($texto, $id) = array_map('trim', explode('|', $linea, 2));
            if ($texto === '' || $id === '') continue;
            $anclas[] = array('texto' => $texto, 'id' => sanitize_title($id));
        }
    }

    // Las cronologías se detectan solas: no hay que crear su submenú a mano.
    $content = get_post_field('post_content', $post_id);
    $has_timeline = stripos($content, 'timeline-container') !== false;
    $has_timeline_anchor = false;
    foreach ($anclas as $ancla) {
        if ($ancla['id'] === 'cronologia') {
            $has_timeline_anchor = true;
            break;
        }
    }
    if ($has_timeline && !$has_timeline_anchor) {
        $anclas[] = array('texto' => 'Cronología', 'id' => 'cronologia');
    }

    return $anclas;
}

// Obtener capítulos principales (sin padre)
$capitulos = get_posts(array(
    'post_type'      => 'capitulo',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_parent'    => 0,
));

// URLs de descarga desde opciones del tema
$pdf_url = get_option('libro_pdf_url', '#');
$epub_url = get_option('libro_epub_url', '#');

// Get current chapter slug for active state
$current_slug = is_singular('capitulo') ? get_post_field('post_name', get_the_ID()) : '';
?>

<!-- Sidebar - IDENTICAL to React SidebarIndex.tsx -->
<aside id="sidebar-indice" class="fixed left-0 top-[52px] h-[calc(100vh-52px)] z-40 bg-sidebar border-r border-sidebar-border w-full sm:w-[320px] flex flex-col transition-transform duration-300 ease-in-out -translate-x-full">
    
    <!-- Chapters List -->
    <nav class="flex-1 overflow-y-auto p-4">
        <ul class="space-y-1">
            <?php foreach ($capitulos as $cap) : 
                $numero = get_post_meta($cap->ID, '_numero_capitulo', true);
                $ocultar_numero = get_post_meta($cap->ID, '_ocultar_numero', true) === '1';
                $cap_slug = get_post_field('post_name', $cap->ID);
                $cap_permalink = get_permalink($cap->ID);
                $is_active = ($cap_slug === $current_slug);
                
                // Obtener subcapítulos reales
                $subcapitulos = get_posts(array(
                    'post_type'      => 'capitulo',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'post_parent'    => $cap->ID,
                ));
                
                // Anclas internas — subcapítulos "virtuales" que hacen scroll en la misma página
                $anclas_internas = libro_parse_anclas_internas($cap->ID);
                
                $has_children = !empty($subcapitulos) || !empty($anclas_internas);

                // El título abre la primera sección real; la flecha conserva
                // la función de desplegar o cerrar la lista de secciones.
                $cap_destination = $cap_permalink;
                if (!empty($subcapitulos)) {
                    $cap_destination = get_permalink($subcapitulos[0]->ID);
                }

                // El título padre ya abre este primer contenido: no repetimos
                // el enlace si ambos títulos son el mismo.
                $ocultar_primer_subcapitulo_duplicado = !empty($subcapitulos) &&
                    sanitize_title($cap->post_title) === sanitize_title($subcapitulos[0]->post_title);

                // Si el primer contenido comparte título con el capítulo, se oculta
                // para no repetirlo. Sus anclas, como Cronología, siguen disponibles.
                $anclas_primer_subcapitulo_oculto = $ocultar_primer_subcapitulo_duplicado
                    ? libro_parse_anclas_internas($subcapitulos[0]->ID)
                    : array();
                
                // Check if any child is active (real subchapter, or subchapter holding the current anchors)
                $has_active_child = false;
                if (!empty($subcapitulos)) {
                    foreach ($subcapitulos as $sub) {
                        if (get_post_field('post_name', $sub->ID) === $current_slug) {
                            $has_active_child = true;
                            break;
                        }
                    }
                }
                // Si el propio capítulo (el que tiene anclas) está activo, despliega también sus anclas
                if (!empty($anclas_internas) && $is_active) {
                    $has_active_child = true;
                }
            ?>
            <li class="relative capitulo-item <?php echo $has_children ? 'has-children' : ''; ?>">
                <div class="flex items-center">
                    <?php if ($has_children) : ?>
                    <button 
                        type="button" 
                        class="sidebar-accordion-toggle w-6 flex-shrink-0 flex items-center justify-center text-muted-foreground hover:text-gold transition-colors"
                        aria-expanded="<?php echo $has_active_child ? 'true' : 'false'; ?>"
                        aria-controls="subcapitulos-<?php echo $cap->ID; ?>"
                    >
                        <svg class="chevron-icon w-4 h-4 transition-transform duration-200 <?php echo $has_active_child ? 'rotate-90' : ''; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <?php else : ?>
                    <span class="w-6 flex-shrink-0"></span>
                    <?php endif; ?>
                    
                    <?php if ($has_children && !empty($subcapitulos)) : ?>
                    <a href="<?php echo esc_url($cap_destination); ?>"
                       class="sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm font-medium hover:bg-sidebar-accent hover:text-gold <?php echo $has_active_child ? 'text-gold/80' : 'text-sidebar-foreground'; ?>">
                        <span class="flex items-center gap-2.5">
                            <?php if (strlen($numero) > 0 && !$ocultar_numero) : ?>
                                <span class="chapter-number chapter-number--main"><?php echo esc_html($numero); ?></span>
                            <?php endif; ?>
                            <span><?php echo esc_html($cap->post_title); ?></span>
                        </span>
                    </a>
                    <?php elseif ($has_children && !empty($anclas_internas)) : ?>
                    <a href="<?php echo esc_url($cap_permalink); ?>"
                       class="sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm font-medium hover:bg-sidebar-accent hover:text-gold <?php echo $is_active ? 'active text-gold bg-sidebar-accent' : 'text-sidebar-foreground'; ?>"
                       data-section="<?php echo esc_attr($cap_slug); ?>">
                        <span class="flex items-center gap-2.5">
                            <?php if (strlen($numero) > 0 && !$ocultar_numero) : ?>
                                <span class="chapter-number chapter-number--main"><?php echo esc_html($numero); ?></span>
                            <?php endif; ?>
                            <span class="<?php echo $is_active ? 'text-gold' : ''; ?>"><?php echo esc_html($cap->post_title); ?></span>
                        </span>
                    </a>
                    <?php else : ?>
                    <a href="<?php echo $cap_permalink; ?>" 
                       class="sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm font-medium hover:bg-sidebar-accent hover:text-gold <?php echo $is_active ? 'active text-gold bg-sidebar-accent' : 'text-sidebar-foreground'; ?>"
                       data-section="<?php echo esc_attr($cap_slug); ?>">
                        <span class="flex items-center gap-2.5">
                            <?php if (strlen($numero) > 0 && !$ocultar_numero) : ?>
                                <span class="chapter-number chapter-number--main"><?php echo esc_html($numero); ?></span>
                            <?php endif; ?>
                            <span class="<?php echo $is_active ? 'text-gold' : ''; ?>"><?php echo esc_html($cap->post_title); ?></span>
                        </span>
                    </a>
                    <?php endif; ?>
                </div>
                
                <?php if ($has_children) : ?>
                <ul id="subcapitulos-<?php echo $cap->ID; ?>" class="subcapitulos-list ml-4 mt-1 space-y-0.5 border-l border-sidebar-border pl-2 <?php echo $has_active_child ? '' : 'hidden'; ?>">
                    <?php foreach ($subcapitulos as $sub_index => $sub) :
                        if ($ocultar_primer_subcapitulo_duplicado && $sub_index === 0) {
                            continue;
                        }
                        $sub_slug = get_post_field('post_name', $sub->ID);
                        $sub_is_active = ($sub_slug === $current_slug);
                        $sub_ocultar_numero = get_post_meta($sub->ID, '_ocultar_numero', true) === '1';
                        $sub_subtitulo = get_post_meta($sub->ID, '_subtitulo', true);
                        $sub_permalink = get_permalink($sub->ID);
                        
                        // Only show number if explicitly set in meta (matching React behavior)
                        $sub_numero = '';
                        if (!$sub_ocultar_numero) {
                            $sub_numero = get_post_meta($sub->ID, '_numero_capitulo', true);
                        }
                        
                        // Anclas internas propias de este subcapítulo
                        $sub_anclas_internas = libro_parse_anclas_internas($sub->ID);
                    ?>
                    <li class="subcapitulo-item">
                        <a href="<?php echo $sub_permalink; ?>" 
                           class="sidebar-active-indicator block py-2.5 px-3 text-sm rounded-sm transition-all duration-200 hover:bg-sidebar-accent hover:text-gold <?php echo $sub_is_active ? 'active text-gold bg-sidebar-accent' : 'text-sidebar-foreground/80'; ?>"
                           data-section="<?php echo esc_attr($sub_slug); ?>">
                            <span class="flex items-center gap-2.5">
                                <?php if ($sub_numero) : ?>
                                    <span class="chapter-number chapter-number--sub"><?php echo esc_html($sub_numero); ?></span>
                                <?php endif; ?>
                                <span class="flex flex-col">
                                    <span><?php echo esc_html($sub->post_title); ?></span>
                                    <?php if ($sub_subtitulo) : ?>
                                        <span class="text-[9px] uppercase tracking-wider text-muted-foreground font-medium leading-tight mt-0.5"><?php echo esc_html($sub_subtitulo); ?></span>
                                    <?php endif; ?>
                                </span>
                            </span>
                        </a>
                    </li>
                    <?php foreach ($sub_anclas_internas as $ancla) : ?>
                    <li class="subcapitulo-item">
                        <a href="<?php echo esc_url($sub_permalink . '#' . $ancla['id']); ?>"
                           class="sidebar-active-indicator sidebar-anchor-link block py-2 px-3 pl-6 text-sm rounded-sm transition-all duration-200 hover:bg-sidebar-accent hover:text-gold text-sidebar-foreground/70"
                           data-section="<?php echo esc_attr($sub_slug); ?>"
                           data-anchor="<?php echo esc_attr($ancla['id']); ?>">
                            <span class="flex items-center gap-2.5">
                                <span><?php echo esc_html($ancla['texto']); ?></span>
                            </span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php foreach ($anclas_primer_subcapitulo_oculto as $ancla) : ?>
                    <li class="subcapitulo-item">
                        <a href="<?php echo esc_url(get_permalink($subcapitulos[0]->ID) . '#' . $ancla['id']); ?>"
                           class="sidebar-active-indicator sidebar-anchor-link block py-2.5 px-3 text-sm rounded-sm transition-all duration-200 hover:bg-sidebar-accent hover:text-gold text-sidebar-foreground/80"
                           data-section="<?php echo esc_attr(get_post_field('post_name', $subcapitulos[0]->ID)); ?>"
                           data-anchor="<?php echo esc_attr($ancla['id']); ?>">
                            <span class="flex items-center gap-2.5">
                                <span><?php echo esc_html($ancla['texto']); ?></span>
                            </span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    <?php foreach ($anclas_internas as $ancla) : 
                        $ancla_is_active = $is_active && isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], '#' . $ancla['id']) !== false;
                    ?>
                    <li class="subcapitulo-item">
                        <a href="<?php echo esc_url($cap_permalink . '#' . $ancla['id']); ?>"
                           class="sidebar-active-indicator sidebar-anchor-link block py-2.5 px-3 text-sm rounded-sm transition-all duration-200 hover:bg-sidebar-accent hover:text-gold text-sidebar-foreground/80"
                           data-section="<?php echo esc_attr($cap_slug); ?>"
                           data-anchor="<?php echo esc_attr($ancla['id']); ?>">
                            <span class="flex items-center gap-2.5">
                                <span><?php echo esc_html($ancla['texto']); ?></span>
                            </span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Footer links - IDENTICAL to React -->
    <div class="p-4 pb-[calc(1rem+env(safe-area-inset-bottom))] border-t border-sidebar-border">
        <div class="flex gap-2">
            <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                PDF
            </a>
            <a href="<?php echo esc_url($epub_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                EPUB
            </a>
        </div>
    </div>
</aside>
