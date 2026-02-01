<?php
/**
 * Template para mostrar un capítulo individual
 * Diseño idéntico a React Chapter.tsx
 */

get_header();

// Obtener datos del capítulo actual
$capitulo_numero = get_post_meta(get_the_ID(), '_capitulo_numero', true);
$capitulo_subtitulo = get_post_meta(get_the_ID(), '_capitulo_subtitulo', true);

// Hero fields
$hero_enabled = get_post_meta(get_the_ID(), '_hero_enabled', true);
$hero_image = get_post_meta(get_the_ID(), '_hero_image', true);
$hero_height = get_post_meta(get_the_ID(), '_hero_height', true);
$hero_overlay = get_post_meta(get_the_ID(), '_hero_overlay', true);
$hero_icon = get_post_meta(get_the_ID(), '_hero_icon', true) ?: 'star';
$hero_icon_color = get_post_meta(get_the_ID(), '_hero_icon_color', true) ?: '#D4AF37';
$hero_custom_icon = get_post_meta(get_the_ID(), '_hero_custom_icon', true);
$hero_icon_width = get_post_meta(get_the_ID(), '_hero_icon_width', true) ?: 80;
$hero_icon_height = get_post_meta(get_the_ID(), '_hero_icon_height', true) ?: 80;
$hero_alignment = get_post_meta(get_the_ID(), '_hero_alignment', true) ?: 'center';
$hero_vertical = get_post_meta(get_the_ID(), '_hero_vertical', true) ?: 'center';
$hero_title_lines = get_post_meta(get_the_ID(), '_hero_title_lines', true);
$hero_border_color = get_post_meta(get_the_ID(), '_hero_border_color', true);

// Navegación entre capítulos
$prev_capitulo = get_adjacent_post(false, '', true);
$next_capitulo = get_adjacent_post(false, '', false);

// Alignment classes for hero
$align_classes = array(
    'left' => 'items-start text-left',
    'center' => 'items-center text-center',
    'right' => 'items-end text-right',
);

$vertical_classes = array(
    'top' => 'justify-start pt-16',
    'center' => 'justify-center',
    'bottom' => 'justify-end pb-16',
);

// Font weight classes mapping
$font_weight_classes = array(
    'normal' => 'font-normal',
    'medium' => 'font-medium',
    'semibold' => 'font-semibold',
    'bold' => 'font-bold',
    'extrabold' => 'font-extrabold',
    'black' => 'font-black',
);

$alignment_class = isset($align_classes[$hero_alignment]) ? $align_classes[$hero_alignment] : $align_classes['center'];
$vertical_class = isset($vertical_classes[$hero_vertical]) ? $vertical_classes[$hero_vertical] : $vertical_classes['center'];

// Build hero height style
$hero_height_style = '';
if ($hero_height) {
    $hero_height_style = 'height: ' . esc_attr($hero_height) . '; min-height: auto;';
} else {
    $hero_height_style = 'min-height: 400px;';
}

// Icon HTML
$icon_html = '';
$icon_size_style = 'width: ' . intval($hero_icon_width) . 'px; height: ' . intval($hero_icon_height) . 'px;';

if ($hero_icon === 'custom' && $hero_custom_icon) {
    // Custom image icon (supports SVG, PNG, etc.)
    $icon_html = '<img src="' . esc_url($hero_custom_icon) . '" alt="" style="' . $icon_size_style . ' object-contain;">';
} elseif ($hero_icon === 'star') {
    $icon_html = '<svg style="' . $icon_size_style . ' color: ' . esc_attr($hero_icon_color) . ';" class="fill-current" viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>';
} elseif ($hero_icon === 'star-outline') {
    $icon_html = '<svg style="' . $icon_size_style . ' color: ' . esc_attr($hero_icon_color) . ';" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"/></svg>';
}
?>

<!-- Reading Progress Bar - igual que React -->
<div id="reading-progress" class="fixed top-[52px] left-0 right-0 h-0.5 bg-border/20 z-40">
    <div id="reading-progress-bar" class="h-full bg-gradient-to-r from-gold via-gold-light to-gold transition-all duration-150 ease-out" style="width: 0%;"></div>
</div>

<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<!-- Main Content - estructura idéntica a React -->
<main class="pt-[56px] min-h-screen bg-background">
    
    <?php if ($hero_enabled === '1' && $hero_image) : ?>
    <!-- Chapter Hero -->
    <div class="chapter-hero relative overflow-hidden w-full" style="<?php echo esc_attr($hero_height_style); ?>">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url($hero_image); ?>');"></div>
        
        <?php if ($hero_overlay) : ?>
        <div class="absolute inset-0" style="background-color: <?php echo esc_attr($hero_overlay); ?>;"></div>
        <?php endif; ?>
        
        <?php if ($hero_border_color) : ?>
        <div class="absolute inset-4 sm:inset-6 md:inset-8 border-2 pointer-events-none" style="border-color: <?php echo esc_attr($hero_border_color); ?>;"></div>
        <?php endif; ?>
        
        <div class="relative z-10 flex flex-col h-full w-full px-6 sm:px-8 md:px-12 py-8 <?php echo esc_attr($alignment_class . ' ' . $vertical_class); ?>" style="<?php echo esc_attr($hero_height_style); ?>">
            <?php if ($icon_html) : ?>
            <div class="mb-4"><?php echo $icon_html; ?></div>
            <?php endif; ?>
            
            <div class="flex flex-col gap-1 <?php echo $hero_alignment === 'center' ? 'items-center' : ($hero_alignment === 'right' ? 'items-end' : 'items-start'); ?>">
                <?php 
                if (!empty($hero_title_lines) && is_array($hero_title_lines)) :
                    foreach ($hero_title_lines as $line) :
                        $text = isset($line['text']) ? $line['text'] : '';
                        $color = isset($line['color']) ? $line['color'] : '#FFFFFF';
                        $highlight = isset($line['highlight']) ? $line['highlight'] : '';
                        $use_highlight = isset($line['use_highlight']) && $line['use_highlight'] === '1';
                        $font_weight = isset($line['font_weight']) ? $line['font_weight'] : 'black';
                        
                        $weight_class = isset($font_weight_classes[$font_weight]) ? $font_weight_classes[$font_weight] : 'font-black';
                        
                        $style = 'color: ' . esc_attr($color) . ';';
                        $classes = 'font-display ' . $weight_class . ' text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight';
                        
                        if ($use_highlight && $highlight) :
                            $style .= ' background-color: ' . esc_attr($highlight) . ';';
                            ?>
                            <span class="<?php echo esc_attr($classes); ?> inline-block px-2 py-1" style="<?php echo esc_attr($style); ?>">
                                <?php echo esc_html($text); ?>
                            </span>
                        <?php else : ?>
                            <span class="block <?php echo esc_attr($classes); ?>" style="<?php echo esc_attr($style); ?>">
                                <?php echo esc_html($text); ?>
                            </span>
                        <?php 
                        endif;
                    endforeach;
                else :
                    // Fallback: usar el título del capítulo
                    ?>
                    <span class="block font-display font-black text-2xl sm:text-3xl md:text-4xl lg:text-5xl uppercase tracking-tight leading-tight text-white">
                        <?php the_title(); ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-16 py-16">
        
        <!-- Chapter Section - igual que ChapterSection.tsx -->
        <section class="scroll-mt-24 py-16 md:py-24 border-b border-border/30 last:border-b-0">
            <?php if ($hero_enabled !== '1') : ?>
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
            <?php endif; ?>
            
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
