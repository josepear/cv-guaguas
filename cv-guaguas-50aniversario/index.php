<?php
/**
 * La plantilla principal del tema
 * 
 * Esta es la plantilla más genérica y se usa como fallback
 * cuando no existe una plantilla más específica.
 *
 * @package CV_Guaguas_Libro
 */

get_header(); 
?>

<main class="main-content flex-1 overflow-y-auto lg:ml-[320px]">
    <div class="max-w-4xl mx-auto px-6 py-12">
        
        <?php if (have_posts()) : ?>
            
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('mb-12'); ?>>
                    <header class="mb-6">
                        <h1 class="font-serif text-3xl md:text-4xl text-foreground">
                            <?php the_title(); ?>
                        </h1>
                    </header>
                    
                    <div class="reading-content text-foreground/85">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
            
        <?php else : ?>
            
            <div class="text-center py-16">
                <h1 class="font-serif text-3xl text-foreground mb-4">
                    Bienvenido al Libro Institucional
                </h1>
                <p class="text-muted-foreground">
                    Configura la página de inicio en Ajustes → Lectura
                </p>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php 
get_sidebar('indice');
get_footer(); 
?>
