<?php
/**
 * Sidebar con índice de capítulos - CV Guaguas
 * Soporta estructura jerárquica (capítulos con subcapítulos)
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
?>

<aside id="sidebar-indice" class="fixed left-0 top-0 h-screen z-40 bg-sidebar border-r border-sidebar-border w-[320px] flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full">
    
    <!-- Header con Logo -->
    <div class="p-6 border-b border-sidebar-border">
        <div class="flex items-center gap-3 mb-4">
            <img src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.png" alt="CV Guaguas" class="w-10 h-10 object-contain">
            <div>
                <h2 class="font-serif text-lg text-foreground leading-tight">CV Guaguas</h2>
                <p class="text-xs text-gold uppercase tracking-wider">50 Aniversario · 1976-2026</p>
            </div>
        </div>
        <p class="text-xs text-muted-foreground uppercase tracking-wider">
            Índice de contenidos
        </p>
    </div>

    <!-- Download Buttons Top -->
    <div class="p-4 border-b border-sidebar-border flex gap-2">
        <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download btn-download-primary flex-1 justify-center text-xs" download>
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

    <!-- Chapters List -->
    <nav class="flex-1 overflow-y-auto p-4" aria-label="Índice de capítulos">
        <ul class="lista-capitulos space-y-1">
            <?php foreach ($capitulos as $cap) : 
                $numero = libro_get_field('numero_capitulo', $cap->ID);
                $slug = sanitize_title($cap->post_title);
                
                // Obtener subcapítulos
                $subcapitulos = get_posts(array(
                    'post_type'      => 'capitulo',
                    'posts_per_page' => -1,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                    'post_parent'    => $cap->ID,
                ));
                
                $has_children = !empty($subcapitulos);
            ?>
            <li class="capitulo-item relative <?php echo $has_children ? 'has-children' : ''; ?>">
                <div class="flex items-center">
                    <?php if ($has_children) : ?>
                    <button 
                        type="button" 
                        class="sidebar-accordion-toggle p-2 text-muted-foreground hover:text-gold transition-colors"
                        aria-expanded="false"
                        aria-controls="subcapitulos-<?php echo $cap->ID; ?>"
                    >
                        <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <?php endif; ?>
                    
                    <a href="<?php echo get_permalink($cap->ID); ?>" 
                       class="capitulo-link sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm hover:bg-sidebar-accent hover:text-gold block text-sidebar-foreground"
                       data-section="<?php echo esc_attr($slug); ?>">
                        <span class="flex items-baseline gap-2">
                            <?php if ($numero) : ?>
                                <span class="text-gold/60 text-xs font-sans tracking-wider min-w-[1.5rem]"><?php echo esc_html($numero); ?></span>
                            <?php endif; ?>
                            <span><?php echo esc_html($cap->post_title); ?></span>
                        </span>
                    </a>
                </div>
                
                <?php if ($has_children) : ?>
                <ul id="subcapitulos-<?php echo $cap->ID; ?>" class="subcapitulos-list pl-8 mt-1 space-y-0.5 hidden">
                    <?php foreach ($subcapitulos as $sub) : 
                        $sub_slug = sanitize_title($sub->post_title);
                    ?>
                    <li class="subcapitulo-item">
                        <a href="<?php echo get_permalink($sub->ID); ?>" 
                           class="subcapitulo-link sidebar-active-indicator block py-2 px-3 text-sm text-sidebar-foreground/70 hover:text-gold hover:bg-sidebar-accent/50 rounded-sm transition-all duration-200"
                           data-section="<?php echo esc_attr($sub_slug); ?>">
                            <?php echo esc_html($sub->post_title); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Download Buttons Bottom -->
    <div class="p-4 border-t border-sidebar-border">
        <div class="flex gap-2">
            <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                PDF
            </a>
            <a href="<?php echo esc_url($epub_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                EPUB
            </a>
        </div>
    </div>
</aside>