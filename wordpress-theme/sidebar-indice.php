<?php
/**
 * Sidebar con índice de capítulos - CV Guaguas
 * IDENTICAL to React SidebarIndex.tsx
 */

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
<aside id="sidebar-indice" class="fixed left-0 top-[52px] h-[calc(100vh-52px)] z-40 bg-sidebar border-r border-sidebar-border w-[320px] flex flex-col transition-transform duration-300 ease-in-out -translate-x-full">
    
    <!-- Chapters List -->
    <nav class="flex-1 overflow-y-auto p-4">
        <ul class="space-y-1">
            <?php foreach ($capitulos as $cap) : 
                $numero = libro_get_field('numero_capitulo', $cap->ID);
                $ocultar_numero = get_post_meta($cap->ID, '_ocultar_numero', true) === '1';
                $cap_slug = get_post_field('post_name', $cap->ID);
                $is_active = ($cap_slug === $current_slug);
                
                // Obtener subcapítulos
                $subcapitulos = get_posts(array(
                    'post_type'      => 'capitulo',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'post_parent'    => $cap->ID,
                ));
                
                $has_children = !empty($subcapitulos);
                
                // Check if any child is active
                $has_active_child = false;
                if ($has_children) {
                    foreach ($subcapitulos as $sub) {
                        if (get_post_field('post_name', $sub->ID) === $current_slug) {
                            $has_active_child = true;
                            break;
                        }
                    }
                }
            ?>
            <li class="relative capitulo-item <?php echo $has_children ? 'has-children' : ''; ?>">
                <div class="flex items-center">
                    <?php if ($has_children) : ?>
                    <button 
                        type="button" 
                        class="sidebar-accordion-toggle p-1 mr-1 text-muted-foreground hover:text-gold transition-colors"
                        aria-expanded="<?php echo $has_active_child ? 'true' : 'false'; ?>"
                        aria-controls="subcapitulos-<?php echo $cap->ID; ?>"
                    >
                        <!-- ChevronRight (closed) -->
                        <svg class="chevron-icon w-4 h-4 transition-transform duration-200 <?php echo $has_active_child ? 'rotate-90' : ''; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <?php endif; ?>
                    
                    <a href="<?php echo get_permalink($cap->ID); ?>" 
                       class="sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm font-medium hover:bg-sidebar-accent hover:text-gold <?php echo !$has_children ? 'ml-6' : ''; ?> <?php echo $is_active ? 'active text-gold bg-sidebar-accent' : 'text-sidebar-foreground'; ?> <?php echo $has_active_child ? 'text-gold/80' : ''; ?>"
                       data-section="<?php echo esc_attr($cap_slug); ?>">
                        <span class="flex items-center gap-2.5">
                            <?php if ($numero && !$ocultar_numero) : ?>
                                <span class="chapter-number chapter-number--main"><?php echo esc_html($numero); ?></span>
                            <?php endif; ?>
                            <span class="<?php echo $is_active ? 'text-gold' : ''; ?>"><?php echo esc_html($cap->post_title); ?></span>
                        </span>
                    </a>
                </div>
                
                <?php if ($has_children) : 
                    $sub_index = 1;
                ?>
                <ul id="subcapitulos-<?php echo $cap->ID; ?>" class="subcapitulos-list ml-4 mt-1 space-y-0.5 border-l border-sidebar-border pl-2 <?php echo $has_active_child ? '' : 'hidden'; ?>">
                    <?php foreach ($subcapitulos as $sub) : 
                        $sub_slug = get_post_field('post_name', $sub->ID);
                        $sub_is_active = ($sub_slug === $current_slug);
                        $sub_ocultar_numero = get_post_meta($sub->ID, '_ocultar_numero', true) === '1';
                        
                        // Priority: check if hidden > manual number > auto-generated from parent
                        $sub_numero = '';
                        if (!$sub_ocultar_numero) {
                            $sub_numero = libro_get_field('numero_capitulo', $sub->ID);
                            if (!$sub_numero && $numero) {
                                // Auto-generate only if parent has number and sub doesn't
                                $sub_numero = $numero . '.' . $sub_index;
                            }
                        }
                    ?>
                    <li class="subcapitulo-item">
                        <a href="<?php echo get_permalink($sub->ID); ?>" 
                           class="sidebar-active-indicator block py-2.5 px-3 text-sm rounded-sm transition-all duration-200 hover:bg-sidebar-accent hover:text-gold <?php echo $sub_is_active ? 'active text-gold bg-sidebar-accent' : 'text-sidebar-foreground/80'; ?>"
                           data-section="<?php echo esc_attr($sub_slug); ?>">
                            <span class="flex items-center gap-2.5">
                                <?php if ($sub_numero) : ?>
                                    <span class="chapter-number chapter-number--sub"><?php echo esc_html($sub_numero); ?></span>
                                <?php endif; ?>
                                <span><?php echo esc_html($sub->post_title); ?></span>
                            </span>
                        </a>
                    </li>
                    <?php 
                        $sub_index++;
                        endforeach; 
                    ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Footer links - IDENTICAL to React -->
    <div class="p-4 border-t border-sidebar-border">
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
