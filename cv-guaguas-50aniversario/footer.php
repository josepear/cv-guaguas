<?php
/**
 * Footer con logos institucionales configurables
 * CV Guaguas - 50 Aniversario
 * IDENTICAL to React InstitutionalFooter.tsx
 */

// Obtener logos desde opciones del tema
$logos = get_option('libro_footer_logos', array());

// Logos por defecto con las imágenes incluidas en el tema (identical to React sponsorLogos)
if (empty($logos)) {
    $base = get_template_directory_uri() . '/assets/images/sponsors/';
    $logos = array(
        array('alt' => 'Cabildo de Gran Canaria', 'src' => $base . 'cabildo-gran-canaria.png', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Instituto Insular de Deportes', 'src' => $base . 'instituto-insular-deportes.png', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Gobierno de Canarias', 'src' => $base . 'gobierno-canarias.png', 'url' => 'https://www.gobiernodecanarias.org'),
        array('alt' => 'Islas Canarias', 'src' => $base . 'islas-canarias.png', 'url' => 'https://www.islascanarias.org'),
        array('alt' => 'Ayuntamiento de Las Palmas de Gran Canaria', 'src' => $base . 'ayuntamiento-las-palmas.png', 'url' => 'https://www.laspalmasgc.es'),
        array('alt' => 'Instituto Municipal de Deportes', 'src' => $base . 'instituto-municipal-deportes.png', 'url' => 'https://www.laspalmasgc.es'),
        array('alt' => 'Turismo de Gran Canaria', 'src' => $base . 'turismo-gran-canaria.png', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Real Federación Española de Voleibol', 'src' => $base . 'rfevb.png', 'url' => 'https://www.rfevb.com'),
    );
}
?>

<footer class="bg-sidebar border-t border-sidebar-border">
    <!-- Logos Section -->
    <div class="py-12 md:py-16 border-b border-sidebar-border">
        <div class="container mx-auto px-6">
            <p class="text-center text-xs uppercase tracking-widest text-muted-foreground mb-8">
                Con el apoyo de
            </p>
            
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-10 lg:gap-14">
                <?php foreach ($logos as $logo) : ?>
                <a 
                    href="<?php echo esc_url($logo['url'] ?: '#'); ?>" 
                    class="group flex items-center justify-center p-2 transition-opacity duration-300 hover:opacity-80"
                    target="_blank" 
                    rel="noopener noreferrer"
                >
                    <?php if (!empty($logo['src'])) : ?>
                        <img 
                            src="<?php echo esc_url($logo['src']); ?>" 
                            alt="<?php echo esc_attr($logo['alt']); ?>"
                            class="h-8 md:h-10 lg:h-12 w-auto object-contain transition-all duration-500 grayscale opacity-40 group-hover:opacity-80 dark:invert dark:group-hover:opacity-90"
                            loading="lazy"
                        >
                    <?php else : ?>
                        <!-- Placeholder - identical to React -->
                        <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                            <?php echo esc_html($logo['alt']); ?>
                        </div>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
                <p>© <?php echo date('Y'); ?> Club Voleibol Guaguas. Todos los derechos reservados.</p>
                
                <nav class="flex items-center gap-6">
                    <a href="<?php echo home_url('/aviso-legal'); ?>" class="hover:text-gold transition-colors duration-300">
                        Aviso Legal
                    </a>
                    <a href="<?php echo home_url('/privacidad'); ?>" class="hover:text-gold transition-colors duration-300">
                        Privacidad
                    </a>
                    <a href="<?php echo home_url('/accesibilidad'); ?>" class="hover:text-gold transition-colors duration-300">
                        Accesibilidad
                    </a>
                </nav>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>