<?php
/**
 * Template Name: Página Libro CV Guaguas
 * 
 * Plantilla principal para mostrar el libro institucional
 */

get_header();

// Obtener opciones del tema
$hero_title = get_option('libro_hero_title', 'CV Guaguas: Historia de un Club');
$hero_subtitle = get_option('libro_hero_subtitle', 'Una crónica apasionante del voleibol en Las Palmas de Gran Canaria');
$pdf_url = get_option('libro_pdf_url', '#');
$epub_url = get_option('libro_epub_url', '#');
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img 
            src="<?php echo LIBRO_URI; ?>/assets/images/hero-stadium.jpg" 
            alt="CV Guaguas celebrando" 
            class="w-full h-full object-cover"
            loading="eager"
        >
        <!-- Overlay -->
        <div class="absolute inset-0 hero-overlay"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 container mx-auto px-6 py-20 text-center">
        <!-- Logo -->
        <div class="mb-8 fade-in-up">
            <img 
                src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.png" 
                alt="CV Guaguas" 
                class="w-20 h-20 md:w-24 md:h-24 mx-auto object-contain drop-shadow-2xl"
            >
        </div>
        
        <!-- Institutional Marker -->
        <p class="chapter-marker mb-6 fade-in-up delay-100">
            Libro Institucional
        </p>
        
        <!-- Title -->
        <h1 class="font-serif text-4xl md:text-5xl lg:text-7xl text-foreground leading-tight mb-6 fade-in-up delay-200 max-w-4xl mx-auto">
            <?php echo esc_html($hero_title); ?>
        </h1>
        
        <!-- Subtitle -->
        <p class="text-lg md:text-xl text-foreground/80 max-w-2xl mx-auto mb-12 fade-in-up delay-300 font-sans">
            <?php echo esc_html($hero_subtitle); ?>
        </p>
        
        <!-- Download Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-16 fade-in-up delay-400">
            <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download btn-download-primary" download>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Descargar PDF
            </a>
            <a href="<?php echo esc_url($epub_url); ?>" class="btn-download btn-download-outline" download>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Descargar EPUB
            </a>
        </div>
        
        <!-- Scroll Indicator -->
        <a href="#contenido" class="inline-flex flex-col items-center gap-2 text-foreground/60 hover:text-gold transition-colors fade-in-up delay-500">
            <span class="text-xs uppercase tracking-widest font-sans">Comenzar a leer</span>
            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </a>
    </div>
    
    <!-- Bottom Gradient Fade -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent z-10"></div>
</section>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<!-- Main Content -->
<main id="contenido" class="lg:ml-[320px] bg-background">
    <div class="container mx-auto px-6 lg:px-12 py-12 md:py-20 max-w-4xl">
        <?php echo do_shortcode('[contenido_libro]'); ?>
    </div>
</main>

<?php get_footer(); ?>
