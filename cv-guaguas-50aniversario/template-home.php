<?php
/**
 * Template Name: Página 50 Aniversario CV Guaguas
 * Description: Plantilla para la página principal del 50 aniversario del CV Guaguas
 */

get_header();

$pdf_url  = get_option('libro_pdf_url', '#');
$epub_url = get_option('libro_epub_url', '#');
$btn_pdf_text  = get_option('libro_btn_pdf_text', 'Descargar PDF');
$btn_epub_text = get_option('libro_btn_epub_text', 'Descargar EPUB');
$btn_leer_text = get_option('libro_btn_leer_text', 'Comenzar a leer');

$hero_image      = get_option('libro_hero_image', LIBRO_URI . '/assets/images/hero-home.jpg');
$hero_title      = get_option('libro_hero_title', 'Guaguas:');
$hero_subtitle   = get_option('libro_hero_subtitle', "Una historia\nde leyenda");
$hero_year_start = get_option('libro_hero_year_start', '1976');
$hero_year_end   = get_option('libro_hero_year_end', '2026');
$hero_star       = get_option('libro_hero_star', '★');

$primer_capitulo = get_posts(array(
    'post_type'      => 'capitulo',
    'posts_per_page' => 1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_parent'    => 0,
));
$primer_capitulo_url = !empty($primer_capitulo) ? get_permalink($primer_capitulo[0]->ID) : '#';
?>

<style>
/* Poppins solo para la home */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800;900&display=swap');

#hero-home * {
    font-family: 'Poppins', sans-serif !important;
}

#hero-home .home-logo {
    /* Sin filtro — logo original */
}

#hero-home .home-title {
    font-size: clamp(2.8rem, 8vw, 6.5rem);
    font-weight: 700;
    line-height: 1.0;
    color: #FFC400;
    text-transform: uppercase;
    letter-spacing: -0.01em;
    margin: 0 0 0.3em;
    text-shadow: 0 2px 12px rgba(0,0,0,0.55);
}

#hero-home .home-subtitle {
    font-size: clamp(1.6rem, 4vw, 3.2rem);
    font-weight: 700;
    line-height: 1.1;
    color: #FFC400;
    text-transform: uppercase;
    letter-spacing: 0.01em;
    margin: 0 0 0.6em;
    text-shadow: 0 2px 12px rgba(0,0,0,0.55);
}

#hero-home .home-years {
    font-size: clamp(1rem, 2.5vw, 1.5rem);
    font-weight: 700;
    color: #FFC400;
    letter-spacing: 0.15em;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5em;
    margin-bottom: 2.5rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.50);
}

#hero-home .home-years .star {
    color: #e63030;
    font-size: 0.6em;
}

#hero-home .btn-pdf {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #FFC400;
    color: hsl(220, 50%, 10%);
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 0.75rem 1.75rem;
    border: 2px solid #FFC400;
    text-decoration: none;
    transition: all 0.2s;
}
#hero-home .btn-pdf:hover {
    background: #cc9e00;
    border-color: #cc9e00;
    color: hsl(220, 50%, 10%);
}

#hero-home .btn-epub {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: transparent;
    color: rgba(255,255,255,0.85);
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    padding: 0.75rem 1.75rem;
    border: 2px solid rgba(255,255,255,0.35);
    text-decoration: none;
    transition: all 0.2s;
}
#hero-home .btn-epub:hover {
    background: rgba(0,0,0,0.35);
    border-color: rgba(255,255,255,0.6);
    color: #ffffff;
}

#hero-home .btn-leer {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: #FFC400;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    text-decoration: none;
    transition: all 0.2s;
    margin-top: 1.5rem;
    padding: 0.6rem 1.25rem;
    border: 2px solid transparent;
    min-height: 44px;
    min-width: 44px;
}
#hero-home .btn-leer:hover {
    background: rgba(0,0,0,0.35);
    border-color: transparent;
    color: #FFC400;
}
#hero-home .btn-leer svg {
    transition: transform 0.2s;
}
#hero-home .btn-leer:hover svg {
    transform: translateX(4px);
}
</style>

<div class="guaguas-menu-layout">
<section id="hero-home" class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <!-- Imagen de fondo -->
    <img
        src="<?php echo esc_url($hero_image); ?>"
        alt=""
        fetchpriority="high"
        decoding="async"
        class="absolute inset-0 w-full h-full object-cover object-center"
    >

    <!-- Overlay oscuro suave -->
    <div class="absolute inset-0" style="background: rgba(5,12,30,0.38);"></div>

    <!-- Contenido centrado -->
    <div class="relative z-10 text-center px-6 max-w-3xl mx-auto flex flex-col items-center opacity-0 animate-fade-in-up">

        <!-- Logo todo amarillo -->
        <img
            src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.svg"
            alt="Club Voleibol Guaguas"
            class="home-logo mb-6"
            style="height: 120px; width: auto;"
        >

        <!-- Título -->
        <h1 class="home-title"><?php echo esc_html($hero_title); ?></h1>

        <!-- Subtítulo -->
        <p class="home-subtitle"><?php echo wp_kses_post(nl2br(esc_html($hero_subtitle))); ?></p>

        <!-- Años -->
        <div class="home-years">
            <span><?php echo esc_html($hero_year_start); ?></span>
            <span class="star"><?php echo esc_html($hero_star); ?></span>
            <span><?php echo esc_html($hero_year_end); ?></span>
        </div>

        <!-- Botones descarga -->
        <div style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;margin-bottom:0.5rem;">
            <a href="<?php echo esc_url($pdf_url ?: '#'); ?>" class="btn-pdf">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <?php echo esc_html($btn_pdf_text); ?>
            </a>
            <a href="<?php echo esc_url($epub_url ?: '#'); ?>" class="btn-epub">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <?php echo esc_html($btn_epub_text); ?>
            </a>
        </div>

        <!-- Comenzar a leer -->
        <a href="<?php echo esc_url($primer_capitulo_url); ?>" class="btn-leer">
            <?php echo esc_html($btn_leer_text); ?>
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
        </a>

    </div>

    <!-- Fade inferior -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent"></div>
</section>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>
</div>

<?php get_footer(); ?>
