<?php
/**
 * Template para mostrar un capítulo individual
 * Diseño idéntico a React Chapter.tsx
 */

get_header();

// Obtener datos del capítulo actual
$capitulo_numero = get_post_meta(get_the_ID(), '_capitulo_numero', true);
$capitulo_subtitulo = get_post_meta(get_the_ID(), '_capitulo_subtitulo', true);

// Navegación entre capítulos
$prev_capitulo = get_adjacent_post(false, '', true);
$next_capitulo = get_adjacent_post(false, '', false);
?>

<!-- Reading Progress Bar - igual que React -->
<div id="reading-progress" class="fixed top-[52px] left-0 right-0 h-0.5 bg-border/20 z-40">
    <div id="reading-progress-bar" class="h-full bg-gradient-to-r from-gold via-gold-light to-gold transition-all duration-150 ease-out" style="width: 0%;"></div>
</div>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<!-- Main Content - estructura idéntica a React -->
<main class="pt-[56px] min-h-screen bg-background">
    <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-16 py-16">
        
        <!-- Chapter Section - igual que ChapterSection.tsx -->
        <section class="scroll-mt-24 py-16 md:py-24 border-b border-border/30 last:border-b-0">
            <header class="mb-8 md:mb-12">
                <?php if ($capitulo_numero) : ?>
                <span class="chapter-marker block mb-4">
                    Capítulo <?php echo esc_html($capitulo_numero); ?>
                </span>
                <?php endif; ?>
                
                <h2 class="font-serif text-3xl md:text-4xl lg:text-5xl text-foreground leading-tight">
                    <?php the_title(); ?>
                </h2>
            </header>
            
            <div class="reading-content text-foreground/85">
                <?php if (has_post_thumbnail()) : ?>
                <!-- Featured Image -->
                <figure class="my-8 md:my-12">
                    <div class="relative overflow-hidden rounded-lg shadow-2xl">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-auto object-cover')); ?>
                    </div>
                    <?php if (get_the_post_thumbnail_caption()) : ?>
                    <figcaption class="mt-4 text-center text-sm text-muted-foreground italic">
                        <?php echo get_the_post_thumbnail_caption(); ?>
                    </figcaption>
                    <?php endif; ?>
                </figure>
                <?php endif; ?>
                
                <?php 
                while (have_posts()) : the_post();
                    the_content();
                endwhile;
                ?>
                
                <?php
                // Sub-chapters (if any)
                $subcapitulos = get_posts(array(
                    'post_type' => 'capitulo',
                    'post_parent' => get_the_ID(),
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'numberposts' => -1
                ));
                
                if ($subcapitulos) :
                ?>
                <section class="mt-12 pt-8 border-t border-border/30">
                    <h3 class="text-xl font-serif font-semibold text-foreground mb-6">
                        En este capítulo
                    </h3>
                    
                    <div class="grid gap-4">
                        <?php foreach ($subcapitulos as $sub) : 
                            $sub_numero = get_post_meta($sub->ID, '_capitulo_numero', true);
                        ?>
                        <a 
                            href="<?php echo get_permalink($sub->ID); ?>" 
                            class="group flex items-center gap-4 p-4 rounded border border-border/50 bg-card/30 hover:border-gold/50 hover:bg-card/50 transition-all duration-300"
                        >
                            <?php if ($sub_numero) : ?>
                            <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded bg-gold/10 text-gold text-sm font-medium">
                                <?php echo esc_html($sub_numero); ?>
                            </span>
                            <?php endif; ?>
                            
                            <div class="flex-1 min-w-0">
                                <h4 class="font-serif font-medium text-foreground group-hover:text-gold transition-colors">
                                    <?php echo esc_html($sub->post_title); ?>
                                </h4>
                            </div>
                            
                            <svg class="w-5 h-5 text-muted-foreground group-hover:text-gold group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Chapter Navigation - idéntico a ChapterNavigation.tsx -->
        <nav class="mt-16 pt-8 border-t border-border/30">
            <div class="flex flex-col sm:flex-row items-stretch gap-4">
                
                <!-- Previous Chapter -->
                <?php if ($prev_capitulo) : 
                    $prev_numero = get_post_meta($prev_capitulo->ID, '_capitulo_numero', true);
                ?>
                <a 
                    href="<?php echo get_permalink($prev_capitulo->ID); ?>" 
                    class="flex-1 group flex items-center gap-4 p-4 rounded border border-border/50 bg-card/30 hover:border-gold/50 hover:bg-card/50 transition-all duration-300"
                >
                    <svg class="w-5 h-5 text-muted-foreground group-hover:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <div class="text-left">
                        <span class="text-xs uppercase tracking-wider text-muted-foreground block mb-1">
                            Anterior
                        </span>
                        <span class="font-serif text-foreground group-hover:text-gold transition-colors">
                            <?php if ($prev_numero) : ?>
                                <span class="text-gold/60 mr-2"><?php echo esc_html($prev_numero); ?></span>
                            <?php endif; ?>
                            <?php echo esc_html($prev_capitulo->post_title); ?>
                        </span>
                    </div>
                </a>
                <?php else : ?>
                <div class="flex-1"></div>
                <?php endif; ?>
                
                <!-- Next Chapter -->
                <?php if ($next_capitulo) : 
                    $next_numero = get_post_meta($next_capitulo->ID, '_capitulo_numero', true);
                ?>
                <a 
                    href="<?php echo get_permalink($next_capitulo->ID); ?>" 
                    class="flex-1 group flex items-center justify-end gap-4 p-4 rounded border border-border/50 bg-card/30 hover:border-gold/50 hover:bg-card/50 transition-all duration-300"
                >
                    <div class="text-right">
                        <span class="text-xs uppercase tracking-wider text-muted-foreground block mb-1">
                            Siguiente
                        </span>
                        <span class="font-serif text-foreground group-hover:text-gold transition-colors">
                            <?php if ($next_numero) : ?>
                                <span class="text-gold/60 mr-2"><?php echo esc_html($next_numero); ?></span>
                            <?php endif; ?>
                            <?php echo esc_html($next_capitulo->post_title); ?>
                        </span>
                    </div>
                    <svg class="w-5 h-5 text-muted-foreground group-hover:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
                <?php else : ?>
                <div class="flex-1"></div>
                <?php endif; ?>
                
            </div>
        </nav>
        
    </div>
</main>

<script>
// Reading Progress Bar - igual que ReadingProgressBar.tsx
document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.getElementById('reading-progress-bar');
    
    function updateProgress() {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? Math.min((scrollTop / docHeight) * 100, 100) : 0;
        progressBar.style.width = progress + '%';
    }
    
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();
});
</script>

<?php get_footer(); ?>
