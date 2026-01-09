<?php
/**
 * Template para mostrar un capítulo individual
 * 
 * Este template se usa automáticamente cuando se accede a un capítulo
 * directamente por su URL (ej: /capitulo/historia-del-club/)
 */

get_header();

// Obtener datos del capítulo actual
$capitulo_numero = get_post_meta(get_the_ID(), '_capitulo_numero', true);
$capitulo_subtitulo = get_post_meta(get_the_ID(), '_capitulo_subtitulo', true);

// Navegación entre capítulos
$prev_capitulo = get_adjacent_post(false, '', true);
$next_capitulo = get_adjacent_post(false, '', false);

// Obtener página principal del libro para el enlace "Volver"
$libro_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'template-home.php',
    'number' => 1
));
$libro_url = $libro_page ? get_permalink($libro_page[0]->ID) : home_url();
?>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<!-- Main Content -->
<main class="main-content lg:ml-[320px] pt-header min-h-screen bg-background">
    
    <!-- Chapter Header -->
    <header class="border-b border-sidebar-border bg-sidebar/50">
        <div class="max-w-4xl mx-auto px-6 lg:px-12 py-8 md:py-12">
            
            <!-- Breadcrumb -->
            <nav class="mb-6 animate-fade-in-up" aria-label="Breadcrumb">
                <ol class="flex items-center gap-2 text-sm text-muted-foreground">
                    <li>
                        <a href="<?php echo esc_url($libro_url); ?>" class="hover:text-gold transition-colors">
                            50 Aniversario
                        </a>
                    </li>
                    <li>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </li>
                    <li class="text-foreground">
                        <?php if ($capitulo_numero) : ?>
                            Capítulo <?php echo esc_html($capitulo_numero); ?>
                        <?php else : ?>
                            <?php the_title(); ?>
                        <?php endif; ?>
                    </li>
                </ol>
            </nav>
            
            <!-- Chapter Number -->
            <?php if ($capitulo_numero) : ?>
            <p class="text-xs md:text-sm uppercase tracking-widest text-gold opacity-80 mb-4 font-sans animate-fade-in-up animation-delay-100">
                Capítulo <?php echo esc_html($capitulo_numero); ?>
            </p>
            <?php endif; ?>
            
            <!-- Title -->
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-serif font-bold mb-4 text-gold-gradient animate-fade-in-up animation-delay-200">
                <?php the_title(); ?>
            </h1>
            
            <!-- Subtitle -->
            <?php if ($capitulo_subtitulo) : ?>
            <p class="text-lg md:text-xl text-foreground opacity-70 font-sans animate-fade-in-up animation-delay-300">
                <?php echo esc_html($capitulo_subtitulo); ?>
            </p>
            <?php endif; ?>
            
        </div>
    </header>
    
    <!-- Chapter Content -->
    <article class="max-w-4xl mx-auto px-6 lg:px-12 py-12 md:py-16">
        
        <?php if (has_post_thumbnail()) : ?>
        <!-- Featured Image -->
        <figure class="content-image mb-12 animate-fade-in-up">
            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto rounded')); ?>
            <?php if (get_the_post_thumbnail_caption()) : ?>
            <figcaption class="mt-3 text-sm text-muted-foreground italic">
                <?php echo get_the_post_thumbnail_caption(); ?>
            </figcaption>
            <?php endif; ?>
        </figure>
        <?php endif; ?>
        
        <!-- Content -->
        <div class="reading-content prose prose-invert prose-gold animate-fade-in-up animation-delay-200">
            <?php 
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
        
        <!-- Sub-chapters (if any) -->
        <?php
        $subcapitulos = get_posts(array(
            'post_type' => 'capitulo',
            'post_parent' => get_the_ID(),
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'numberposts' => -1
        ));
        
        if ($subcapitulos) :
        ?>
        <section class="mt-16 pt-12 border-t border-sidebar-border">
            <h2 class="text-2xl font-serif font-semibold text-foreground mb-8">
                En este capítulo
            </h2>
            
            <div class="grid gap-4">
                <?php foreach ($subcapitulos as $sub) : 
                    $sub_numero = get_post_meta($sub->ID, '_capitulo_numero', true);
                ?>
                <a 
                    href="<?php echo get_permalink($sub->ID); ?>" 
                    class="group flex items-center gap-4 p-4 rounded border border-sidebar-border hover:border-gold/30 hover:bg-sidebar-accent/20 transition-all"
                >
                    <?php if ($sub_numero) : ?>
                    <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded bg-gold/10 text-gold text-sm font-medium">
                        <?php echo esc_html($sub_numero); ?>
                    </span>
                    <?php endif; ?>
                    
                    <div class="flex-1 min-w-0">
                        <h3 class="font-serif font-medium text-foreground group-hover:text-gold transition-colors">
                            <?php echo esc_html($sub->post_title); ?>
                        </h3>
                        <?php 
                        $sub_excerpt = get_the_excerpt($sub);
                        if ($sub_excerpt) :
                        ?>
                        <p class="text-sm text-muted-foreground mt-1 line-clamp-2">
                            <?php echo esc_html($sub_excerpt); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                    
                    <svg class="w-5 h-5 text-muted-foreground group-hover:text-gold group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
        
    </article>
    
    <!-- Chapter Navigation -->
    <nav class="border-t border-sidebar-border bg-sidebar/30" aria-label="Navegación entre capítulos">
        <div class="max-w-4xl mx-auto px-6 lg:px-12">
            <div class="flex flex-col md:flex-row">
                
                <!-- Previous Chapter -->
                <div class="flex-1 border-b md:border-b-0 md:border-r border-sidebar-border">
                    <?php if ($prev_capitulo) : 
                        $prev_numero = get_post_meta($prev_capitulo->ID, '_capitulo_numero', true);
                    ?>
                    <a 
                        href="<?php echo get_permalink($prev_capitulo->ID); ?>" 
                        class="group flex items-center gap-4 py-6 md:py-8 md:pr-8 hover:bg-sidebar-accent/20 transition-colors"
                    >
                        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full border border-sidebar-border group-hover:border-gold/50 transition-colors">
                            <svg class="w-5 h-5 text-muted-foreground group-hover:text-gold group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </div>
                        
                        <div class="min-w-0">
                            <p class="text-xs uppercase tracking-wider text-muted-foreground mb-1">
                                Capítulo anterior
                            </p>
                            <p class="font-serif font-medium text-foreground group-hover:text-gold transition-colors truncate">
                                <?php if ($prev_numero) : ?>
                                    <?php echo esc_html($prev_numero); ?>. 
                                <?php endif; ?>
                                <?php echo esc_html($prev_capitulo->post_title); ?>
                            </p>
                        </div>
                    </a>
                    <?php else : ?>
                    <div class="py-6 md:py-8 md:pr-8">
                        <a 
                            href="<?php echo esc_url($libro_url); ?>" 
                            class="group flex items-center gap-4 text-muted-foreground hover:text-gold transition-colors"
                        >
                            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full border border-sidebar-border group-hover:border-gold/50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <span class="text-sm">Volver al inicio</span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Next Chapter -->
                <div class="flex-1">
                    <?php if ($next_capitulo) : 
                        $next_numero = get_post_meta($next_capitulo->ID, '_capitulo_numero', true);
                    ?>
                    <a 
                        href="<?php echo get_permalink($next_capitulo->ID); ?>" 
                        class="group flex items-center justify-end gap-4 py-6 md:py-8 md:pl-8 hover:bg-sidebar-accent/20 transition-colors text-right"
                    >
                        <div class="min-w-0">
                            <p class="text-xs uppercase tracking-wider text-muted-foreground mb-1">
                                Siguiente capítulo
                            </p>
                            <p class="font-serif font-medium text-foreground group-hover:text-gold transition-colors truncate">
                                <?php if ($next_numero) : ?>
                                    <?php echo esc_html($next_numero); ?>. 
                                <?php endif; ?>
                                <?php echo esc_html($next_capitulo->post_title); ?>
                            </p>
                        </div>
                        
                        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full border border-sidebar-border group-hover:border-gold/50 transition-colors">
                            <svg class="w-5 h-5 text-muted-foreground group-hover:text-gold group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    <?php else : ?>
                    <div class="py-6 md:py-8 md:pl-8 text-right">
                        <a 
                            href="<?php echo esc_url($libro_url); ?>" 
                            class="group inline-flex items-center gap-4 text-muted-foreground hover:text-gold transition-colors"
                        >
                            <span class="text-sm">Fin del libro</span>
                            <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full border border-sidebar-border group-hover:border-gold/50 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </nav>
    
</main>

<?php get_footer(); ?>
