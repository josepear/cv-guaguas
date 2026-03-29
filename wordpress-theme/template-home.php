<?php
/**
 * Template Name: Página 50 Aniversario CV Guaguas
 * Description: Plantilla para la página principal del 50 aniversario del CV Guaguas
 */

get_header();

// Obtener opciones del tema
$hero_title = get_option('libro_hero_title', 'Historia del CV Guaguas');
$hero_subtitle = get_option('libro_hero_subtitle', 'Un recorrido por la trayectoria del club que ha conquistado el voleibol español');
$pdf_url = get_option('libro_pdf_url', '#');
$epub_url = get_option('libro_epub_url', '#');

// Obtener el primer capítulo para el enlace CTA
$primer_capitulo = get_posts(array(
    'post_type'      => 'capitulo',
    'posts_per_page' => 1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_parent'    => 0,
));
$primer_capitulo_url = !empty($primer_capitulo) ? get_permalink($primer_capitulo[0]->ID) : '#';
?>

<!-- Hero Section - IDENTICAL to React HeroSection.tsx -->
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div 
        class="absolute inset-0 bg-cover bg-center bg-no-repeat"
        style="background-image: url('<?php echo LIBRO_URI; ?>/assets/images/hero-stadium.jpg');"
    ></div>
    
    <!-- Overlay - identical to React -->
    <div class="hero-overlay absolute inset-0"></div>
    
    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
        <!-- Logo -->
        <div class="mb-8 opacity-0 animate-fade-in-up">
            <img 
                src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.svg" 
                alt="CV Guaguas" 
                class="h-32 md:h-40 w-auto mx-auto drop-shadow-2xl"
            >
        </div>
        
        <!-- Anniversary marker -->
        <span class="chapter-marker inline-block mb-6 opacity-0 animate-fade-in-up [animation-delay:100ms]">
            50 Aniversario · 1976 - 2026
        </span>
        
        <!-- Main Title -->
        <h1 class="font-serif font-bold text-4xl md:text-5xl lg:text-7xl text-foreground mb-6 opacity-0 animate-fade-in-up [animation-delay:200ms]">
            <span class="text-gold-gradient"><?php echo esc_html($hero_title); ?></span>
        </h1>
        
        <!-- Subtitle -->
        <p class="font-sans text-lg md:text-xl text-foreground/80 max-w-2xl mx-auto mb-12 opacity-0 animate-fade-in-up [animation-delay:400ms]">
            <?php echo esc_html($hero_subtitle); ?>
        </p>
        
        <!-- Download buttons - ALWAYS visible like React -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12 opacity-0 animate-fade-in-up [animation-delay:600ms]">
            <a href="<?php echo esc_url($pdf_url ?: '#'); ?>" class="btn-download btn-download-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Descargar PDF
            </a>
            <a href="<?php echo esc_url($epub_url ?: '#'); ?>" class="btn-download btn-download-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Descargar EPUB
            </a>
        </div>
        
        <!-- CTA to start reading -->
        <a 
            href="<?php echo esc_url($primer_capitulo_url); ?>" 
            class="inline-flex items-center gap-2 text-gold hover:text-gold-light transition-colors duration-300 opacity-0 animate-fade-in-up [animation-delay:800ms] group"
        >
            <span class="text-sm uppercase tracking-widest font-sans">
                Comenzar a leer
            </span>
            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>
    </div>
    
    <!-- Bottom gradient fade -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent"></div>
</section>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<?php get_footer(); ?>