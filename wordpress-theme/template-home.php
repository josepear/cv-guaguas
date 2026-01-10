<?php
/**
 * Template Name: Página 50 Aniversario CV Guaguas
 * Description: Plantilla para la página principal del 50 aniversario del CV Guaguas
 */

get_header();

// Obtener opciones del tema
$hero_title = get_option('libro_hero_title', '50 Años de Historia');
$hero_subtitle = get_option('libro_hero_subtitle', 'Cinco décadas de pasión, títulos y leyendas del voleibol canario');
$pdf_url = get_option('libro_pdf_url', '#');
$epub_url = get_option('libro_epub_url', '#');
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center pt-header">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img 
            src="<?php echo LIBRO_URI; ?>/assets/images/hero-stadium.jpg" 
            alt="Estadio CV Guaguas" 
            class="w-full h-full object-cover"
            loading="eager"
        >
        <!-- Overlay gradient -->
        <div class="absolute inset-0 bg-gradient-to-b from-background/70 via-background/50 to-background"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 container mx-auto px-6 text-center">
        <!-- Logo -->
        <div class="mb-8 animate-fade-in-up">
            <img 
                src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.png" 
                alt="CV Guaguas Logo" 
                class="h-32 md:h-40 w-auto mx-auto drop-shadow-2xl"
            >
        </div>
        
        <!-- Anniversary Marker -->
        <p class="text-xs md:text-sm uppercase tracking-widest text-gold opacity-80 mb-4 font-sans animate-fade-in-up animation-delay-100">
            50 Aniversario · 1976 - 2026
        </p>
        
        <!-- Title -->
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif font-bold mb-6 text-gold-gradient animate-fade-in-up animation-delay-200">
            <?php echo esc_html($hero_title); ?>
        </h1>
        
        <!-- Subtitle -->
        <p class="text-lg md:text-xl lg:text-2xl text-foreground opacity-80 max-w-3xl mx-auto mb-12 font-sans animate-fade-in-up animation-delay-300">
            <?php echo esc_html($hero_subtitle); ?>
        </p>
        
        <!-- Download Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16 animate-fade-in-up animation-delay-400">
            <?php if ($pdf_url && $pdf_url !== '#') : ?>
            <a 
                href="<?php echo esc_url($pdf_url); ?>" 
                class="inline-flex items-center gap-2 px-6 py-3 bg-gold text-background font-medium rounded hover:bg-gold-light transition-colors"
                target="_blank"
                rel="noopener noreferrer"
            >
                <!-- FileText Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Descargar PDF
            </a>
            <?php endif; ?>
            
            <?php if ($epub_url && $epub_url !== '#') : ?>
            <a 
                href="<?php echo esc_url($epub_url); ?>" 
                class="inline-flex items-center gap-2 px-6 py-3 border border-gold-30 text-foreground font-medium rounded hover:bg-gold-10 transition-colors"
                target="_blank"
                rel="noopener noreferrer"
            >
                <!-- BookOpen Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Descargar EPUB
            </a>
            <?php endif; ?>
        </div>
        
        <!-- CTA - Start Reading -->
        <?php
        // Obtener el primer capítulo para el enlace
        $primer_capitulo = get_posts(array(
            'post_type'      => 'capitulo',
            'posts_per_page' => 1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'post_parent'    => 0,
        ));
        $primer_capitulo_url = !empty($primer_capitulo) ? get_permalink($primer_capitulo[0]->ID) : '#';
        ?>
        <a 
            href="<?php echo esc_url($primer_capitulo_url); ?>" 
            class="inline-flex items-center gap-2 text-gold hover:text-gold-light transition-colors animate-fade-in-up animation-delay-500"
        >
            <span class="text-sm uppercase tracking-widest font-sans">Comenzar a leer</span>
            <!-- Arrow Right Icon -->
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
    
    <!-- Bottom Gradient Fade -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent pointer-events-none"></div>
</section>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<?php get_footer(); ?>
